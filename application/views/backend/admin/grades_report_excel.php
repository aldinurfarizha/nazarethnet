<?php
// Pengaturan header agar file langsung diunduh sebagai Excel
header('Content-Type: application/vnd.ms-excel');

// Ambil nama file dari kombinasi class, section, subject, exam dan tanggal saat ini
$class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
$subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
$exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
$current_date = date('Y-m-d'); // Menambahkan tanggal saat ini

// Menyusun nama file
$filename = $class_name . ' - ' . $section_name . ' - ' . $subject_name . ' - ' . $exam_name . ' - ' . $current_date . '.xls';

// Mengatur header download
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Pengaturan Tahun Ajaran yang sedang berjalan
$running_year = $this->crud->getInfo('running_year');
if ($class_id != '' && $section_id != '' && $subject_id != '' && $exam_id != ''):
    $finalEvaluaciones = 0;
    $is_final = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->is_final;

    // Output HTML untuk konversi ke Excel
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    
    // Header kelas, section, subject, dan exam
    echo '<tr><td colspan="5" align="center"><strong>' . $class_name . ' - ' 
        . $section_name . ' - ' 
        . $subject_name . ' - ' 
        . $exam_name . '</strong></td></tr>';

    // Header tabel untuk data siswa dan nilai
    echo '<tr>';
    echo '<td><strong>Student</strong></td>';
    
    // Mengambil aktivitas mark
    $mark_activity = $this->db->get_where('mark_activity', array('exam_id' => $exam_id))->result_array();
    foreach ($mark_activity as $row) {
        echo '<td><strong>' . $row['name'] . '</strong></td>';
    }

    // Menambahkan kolom evaluasi atau prom
    if ($is_final) {
        echo '<td><strong>Evaluaciones Finales</strong></td>';
    } else {
        echo '<td><strong>Prom</strong></td>';
    }
    echo '</tr>';

    // Mendapatkan data siswa dan nilai
    $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
    foreach ($students as $row):
        if (!isStudentActiveEnroll($row['student_id'], $class_id, $section_id, $running_year)) {
            continue;
        }
        if (isStudentDeactive($row['student_id'])) {
            continue;
        }
        if (isStudentFinishSubject($row['student_id'], $subject_id)) {
            continue;
        }
        if (!isActiveSubject($row['student_id'], $subject_id)) {
            continue;
        }

        // Menampilkan data siswa
        $student_id = $row['student_id'];
        $student_name = $this->crud->get_name('student', $student_id);
        echo '<tr>';
        echo '<td>' . htmlspecialchars($student_name) . '</td>';

        $finalEvaluaciones = 0;
        foreach ($mark_activity as $row2) {
            $nota_row = $this->db
                ->order_by('nota_capacidad_id', 'ASC')
                ->get_where('nota_capacidad', [
                    'mark_activity_id' => $row2['mark_activity_id'],
                    'student_id'       => $student_id
                ])
                ->row();
            $nota = isset($nota_row->nota) ? $nota_row->nota : '-';
            $finalEvaluaciones += ((int)$nota_row->nota * $row2['percent'] / 100);
            echo '<td>' . htmlspecialchars($nota) . '</td>';
        }

        if ($is_final) {
            echo '<td>' . $finalEvaluaciones . '</td>';
        } else {
            echo '<td>' . getFinalMark($student_id, $subject_id, $exam_id, $running_year) . '</td>';
        }
        echo '</tr>';
    endforeach;

    echo '</table>';

endif;
?>
