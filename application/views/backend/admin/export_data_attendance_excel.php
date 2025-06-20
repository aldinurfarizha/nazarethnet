<?php
header('Content-Type: application/vnd.ms-excel');

$class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$section_name = $this->db->get_where('section', array('section_id' => $section_id))->row()->name;
$subject_name = $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name;
$branch       = $this->db->get_where('branch', array('branch_id' => $branch_id))->row()->name;
if($student_id != '') {
    $student_name = $this->crud->get_name('student', $student_id);
    $student = $student_name;
} else {
    $student = 'All Students';
}
$current_date = date('Y-m-d');

$filename = 'Attendance Report of ' . $student . ' - ' . $branch . ' - ' . $class_name . ' - ' . $section_name . ' - ' . $subject_name . $current_date . '.xls';
header('Content-Disposition: attachment; filename="' . $filename . '"');

$running_year = $this->crud->getInfo('running_year');

if ($class_id != '' && $section_id != '' && $subject_id != ''):

    // Buat array tanggal dalam range
    $dates = [];
    $from = strtotime($from_date);
    $to   = strtotime($to_date);
    while ($from <= $to) {
        $dates[] = $from;
        $from = strtotime('+1 day', $from);
    }

    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr><td colspan="' . (count($dates) + 1) . '" align="center"><strong>'
        . $branch . ' - '
        . $class_name . ' - '
        . $section_name . ' - '
        . $subject_name . ' - '
        . 'Attendance Report (' . $from_date . ' - ' . $to_date . ')'
        . '</strong></td></tr>';

    // Header kolom
    echo '<tr>';
    echo '<td><strong>Student</strong></td>';
    foreach ($dates as $timestamp) {
        echo '<td><strong>' . date('d M Y', $timestamp) . '</strong></td>';
    }
    echo '</tr>';

    // Ambil data siswa
    if($student_id != '') {
        $students = $this->db->get_where('enroll', array(
            'class_id'   => $class_id,
            'section_id' => $section_id,
            'year'       => $running_year,
            'student_id' => $student_id
        ))->result_array();
    } else {
        $students = $this->db->get_where('enroll', array(
            'class_id'   => $class_id,
            'section_id' => $section_id,
            'year'       => $running_year
        ))->result_array();
    }

    foreach ($students as $row):
        if (!isStudentActiveEnroll($row['student_id'], $class_id, $section_id, $running_year)) continue;
        if (isStudentDeactive($row['student_id'])) continue;
        if (isStudentFinishSubject($row['student_id'], $subject_id)) continue;
        if (!isActiveSubject($row['student_id'], $subject_id)) continue;

        $student_id   = $row['student_id'];
        $student_name = $this->crud->get_name('student', $student_id);

        echo '<tr>';
        echo '<td>' . htmlspecialchars($student_name) . '</td>';

        foreach ($dates as $timestamp) {
            $status = '-';
            $takenTime = '';

            $attendance = $this->db->get_where('attendance', array(
                'subject_id'  => $subject_id,
                'section_id'  => $section_id,
                'class_id'    => $class_id,
                'year'        => $running_year,
                'timestamp'   => $timestamp,
                'student_id'  => $student_id
            ))->row();

            if ($attendance) {
                switch ($attendance->status) {
                    case 1:
                        $status = 'Present';
                        break;
                    case 2:
                        $status = 'Absent';
                        break;
                    case 3:
                        $status = 'Late';
                        break;
                    default:
                        $status = getStatusNameFromId($attendance->status);
                        break;
                }

                $takenTime = ($attendance->updated_at != '0000-00-00 00:00:00') ? $attendance->updated_at : '';
                $status .= $takenTime ? ' @ ' . $takenTime : '';
            }

            echo '<td>' . $status . '</td>';
        }

        echo '</tr>';
    endforeach;

    echo '</table>';
endif;
