<?php
header('Content-Type: application/vnd.ms-excel');

$class_name   = $this->db->get_where('class', ['class_id' => $class_id])->row()->name;
$branch       = $this->db->get_where('branch', ['branch_id' => $branch_id])->row()->name;
$student_name = $student_id != '' ? $this->crud->get_name('student', $student_id) : 'All Students';
$current_date = date('Y-m-d');
$filename = 'Attendance Report - ' . $student_name . ' - ' . $branch . ' - ' . $class_name . ' - ' . $current_date . '.xls';
header('Content-Disposition: attachment; filename="' . $filename . '"');

$running_year = $this->crud->getInfo('running_year');

// Generate tanggal dalam range
$dates = [];
$from = strtotime($from_date);
$to   = strtotime($to_date);
while ($from <= $to) {
    $dates[] = $from;
    $from = strtotime('+1 day', $from);
}

echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="' . (count($dates) + 1) . '" align="center"><strong>'
    . $branch . ' - ' . $class_name . ' - Attendance Report (' . $from_date . ' - ' . $to_date . ')'
    . '</strong></td></tr>';

// Ambil section dan subject
$sectionList = !empty($section_id)
    ? [$this->db->get_where('section', ['section_id' => $section_id])->row()]
    : $this->db->get_where('section', ['class_id' => $class_id])->result();

$subjectList = !empty($subject_id)
    ? [$this->db->get_where('subject', ['subject_id' => $subject_id])->row()]
    : $this->db->get_where('subject', ['class_id' => $class_id])->result();

foreach ($sectionList as $section):
    if (!$section) continue;
    foreach ($subjectList as $subject):
        if (!$subject) continue;

        echo '<tr><td colspan="' . (count($dates) + 1) . '"><strong>Section:</strong> ' . $section->name . ' &nbsp;&nbsp; <strong>Subject:</strong> ' . $subject->name . '</td></tr>';

        // Header tanggal
        echo '<tr>';
        echo '<td><strong>Student</strong></td>';
        foreach ($dates as $timestamp) {
            echo '<td><strong>' . date('d M Y', $timestamp) . '</strong></td>';
        }
        echo '</tr>';

        // Ambil siswa berdasarkan section
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section->section_id);
        if (!empty($student_id)) $this->db->where('student_id', $student_id);
        $this->db->where('year', $running_year);
        $students = $this->db->get('enroll')->result_array();

        foreach ($students as $stu):
            $sid = $stu['student_id'];
            if (!isStudentActiveEnroll($sid, $class_id, $section->section_id, $running_year)) continue;
            if (isStudentDeactive($sid)) continue;
            if (isStudentFinishSubject($sid, $subject->subject_id)) continue;
            if (!isActiveSubject($sid, $subject->subject_id)) continue;

            $studentName = htmlspecialchars($this->crud->get_name('student', $sid));
            echo '<tr>';
            echo '<td>' . $studentName . '</td>';

            foreach ($dates as $timestamp):
                $this->db->where([
                    'class_id'   => $class_id,
                    'section_id' => $section->section_id,
                    'subject_id' => $subject->subject_id,
                    'student_id' => $sid,
                    'year'       => $running_year,
                    'timestamp'  => $timestamp
                ]);
                $attendance = $this->db->get('attendance')->row();

                $status = '-';
                if ($attendance) {
                    switch ($attendance->status) {
                        case 1: $status = 'Present'; break;
                        case 2: $status = 'Absent'; break;
                        case 3: $status = 'Late'; break;
                        default: $status = getStatusNameFromId($attendance->status); break;
                    }

                    if ($attendance->updated_at != '0000-00-00 00:00:00') {
                        $status .= ' @ ' . $attendance->updated_at;
                    }
                }

                echo '<td>' . $status . '</td>';
            endforeach;

            echo '</tr>';
        endforeach;

    endforeach;
endforeach;

echo '</table>';
?>
