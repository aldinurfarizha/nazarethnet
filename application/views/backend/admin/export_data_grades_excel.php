<?php
header('Content-Type: application/vnd.ms-excel');

$class_name = $this->db->get_where('class', ['class_id' => $class_id])->row()->name;
$section_name = $section_id ? $this->db->get_where('section', ['section_id' => $section_id])->row()->name : 'All Sections';
$subject_name = $subject_id ? $this->db->get_where('subject', ['subject_id' => $subject_id])->row()->name : 'All Subjects';
$branch = $this->db->get_where('branch', ['branch_id' => $branch_id])->row()->name;

$student = $student_id != '' ? $this->crud->get_name('student', $student_id) : 'All Students';
$current_date = date('Y-m-d');
$exam_label = $exam_id != '' ? $this->db->get_where('exam', ['exam_id' => $exam_id])->row()->name : 'All Exams';

$filename = 'Grades Vertical Report - ' . $student . ' - ' . $branch . ' - ' . $class_name . ' - ' . $section_name . ' - ' . $subject_name . ' - ' . $exam_label . ' - ' . $current_date . '.xls';
header('Content-Disposition: attachment; filename="' . $filename . '"');

$running_year = $this->crud->getInfo('running_year');

if (!empty($class_id)):

    // Ambil daftar exam
    $exam_ids = [];
    if (!empty($exam_id)) {
        $exam_ids = [$exam_id];
    } else {
        $this->db->where('class_id', $class_id);
        if (!empty($section_id)) $this->db->where('section_id', $section_id);
        if (!empty($subject_id)) $this->db->where('subject_id', $subject_id);
        $exams = $this->db->get('exam')->result_array();
        foreach ($exams as $ex) $exam_ids[] = $ex['exam_id'];
    }

    // Ambil daftar siswa
    $this->db->where('class_id', $class_id);
    if (!empty($section_id)) $this->db->where('section_id', $section_id);
    if (!empty($student_id)) $this->db->where('student_id', $student_id);
    $this->db->where('year', $running_year);
    $students = $this->db->get('enroll')->result_array();

    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr><th colspan="8" style="text-align:center; font-size:16px;">' . $branch . ' - ' . $class_name . '</th></tr>';
    echo '<tr>
        <th>No</th>
        <th>Student Name</th>
        <th>Section</th>
        <th>Subject</th>
        <th>Exam</th>
        <th>Activity</th>
        <th>Score</th>
        <th>Last Updated</th>
    </tr>';

    $no = 1;

    foreach ($students as $stu):
        $sid = $stu['student_id'];
        if (!isStudentActiveEnroll($sid, $class_id, $stu['section_id'], $running_year)) continue;
        if (isStudentDeactive($sid)) continue;
        if ($subject_id && isStudentFinishSubject($sid, $subject_id)) continue;
        if ($subject_id && !isActiveSubject($sid, $subject_id)) continue;

        // Cek apakah siswa punya data nilai
        $this->db->select('nc.nota_capacidad_id');
        $this->db->from('nota_capacidad nc');
        $this->db->join('mark_activity ma', 'ma.mark_activity_id = nc.mark_activity_id');
        $this->db->where('nc.student_id', $sid);
        if (!empty($exam_ids)) $this->db->where_in('ma.exam_id', $exam_ids);
        $has_data = $this->db->get()->num_rows() > 0;
        if (!$has_data) continue;

        $student_name = htmlspecialchars($this->crud->get_name('student', $sid));
        $sectionNamePerRow = $this->db->get_where('section', ['section_id' => $stu['section_id']])->row()->name ?? '-';

        foreach ($exam_ids as $ex_id):
            $exam = $this->db->get_where('exam', ['exam_id' => $ex_id])->row();
            if (!$exam) continue;
            $exam_name = $exam->name;

            $subjectPerExam = $subject_id ? $subject_name : ($this->db->get_where('subject', ['subject_id' => $exam->subject_id])->row()->name ?? '-');

            $activities = $this->db->get_where('mark_activity', ['exam_id' => $ex_id])->result_array();

            foreach ($activities as $act):
                $nota_row = $this->db
                    ->order_by('nota_capacidad_id', 'ASC')
                    ->get_where('nota_capacidad', [
                        'mark_activity_id' => $act['mark_activity_id'],
                        'student_id'       => $sid
                    ])
                    ->row();

                $score = isset($nota_row->nota) ? $nota_row->nota : '-';
                $updated = isset($nota_row->updated_at) ? $nota_row->updated_at : '-';
                if(isset($nota_row->updated_at)==false){
                    continue;
                }
                if(isset($nota_row->nota_capacidad_id)==false){
                    continue;
                }

                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . $student_name . '</td>';
                echo '<td>' . $sectionNamePerRow . '</td>';
                echo '<td>' . $subjectPerExam . '</td>';
                echo '<td>' . $exam_name . '</td>';
                echo '<td>' . $act['name'] . ' (' . $act['percent'] . '%)</td>';
                echo '<td style="text-align:center;">' . $score . '</td>';
                echo '<td>' . $updated . '</td>';
                echo '</tr>';
            endforeach;

            // Final mark row
            $final_mark = getFinalMark($sid, $subject_id, $ex_id, $running_year);
            echo '<tr style="background:#f0f0f0;">';
            echo '<td>' . $no++ . '</td>';
            echo '<td>' . $student_name . '</td>';
            echo '<td>' . $sectionNamePerRow . '</td>';
            echo '<td>' . $subjectPerExam . '</td>';
            echo '<td>' . $exam_name . '</td>';
            echo '<td><strong>Final/Prom</strong></td>';
            echo '<td style="text-align:center;"><strong>' . $final_mark . '</strong></td>';
            echo '<td>-</td>';
            echo '</tr>';

        endforeach;
    endforeach;

    echo '</table>';

endif;
?>
