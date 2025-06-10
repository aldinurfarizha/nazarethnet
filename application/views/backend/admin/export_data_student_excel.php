<?php
// Aktifkan header untuk file Excel
header("Content-Type: application/vnd.ms-excel");

header("Pragma: no-cache");
header("Expires: 0");

if ($class_id == '') {
    $class_name = "All Classes";
} else {
    $class_name = $this->db->get_where('class', ['class_id' => $class_id])->row()->name;
}
if ($section_id == '') {
    $section_name = "All Sections";
} else {
    $section_name = $this->db->get_where('section', ['section_id' => $section_id])->row()->name;
}
if ($subject_id == '') {
    $subject_name = "All Subjects";
} else {
    $subject_name = $this->db->get_where('subject', ['subject_id' => $subject_id])->row()->name;
}
if ($branch_id == '') {
    $branch = "All Branches";
} else {
    $branch = $this->db->get_where('branch', ['branch_id' => $branch_id])->row()->name;
}
$current_date = date('Y-m-d');
$filename = 'Student list of '.$branch . ' - ' . $class_name . ' - ' . $section_name . ' - ' . $subject_name . ' - ' . $current_date . '.xls';
header("Content-Disposition: attachment; filename=$filename.xls");
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="6" align="center"><strong>'
    . $branch . ' - ' . $class_name . ' - ' . $section_name . ' - ' . $subject_name . ' - ' . $current_date . '</strong></td></tr>';

echo '<tr>
        <th>No.</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Username</th>
        <th>birthday</th>
        <th>Sex</th>
        <th>Address</th>
        <th>Since</th>
        <th>Branch & Shifts</th>
        <th>Class & Section</th>
      </tr>';

$where['is_active'] = 1;
$students = $this->db->get_where('student', $where)->result();
$no = 1;

foreach ($students as $row):
    // Filter berdasarkan branch & shifts
    if (!empty($branch_id) && $row->branch_id != $branch_id) continue;
    if (!empty($shifts_id) && $row->shifts_id != $shifts_id) continue;

    $branch_shifts = 'Not Assigned';
    if (!empty($row->branch_id) && !empty($row->shifts_id)) {
        $branch_data = getDetailBranch($row->branch_id);
        $shifts_data = getDetailShifts($row->shifts_id);
        $branch_shifts = @$branch_data->name . ' - ' . @$shifts_data->name;
    }

    $activeClassAndSection = getStudentClassAndSectionById($row->student_id);

    if (!empty($class_id)) {
        $matched = array_filter($activeClassAndSection, function ($cs) use ($class_id) {
            return $cs->class_id == $class_id;
        });
        if (count($matched) == 0) continue;
    }

    if (!empty($section_id)) {
        $matched = array_filter($activeClassAndSection, function ($cs) use ($section_id) {
            return $cs->section_id == $section_id;
        });
        if (count($matched) == 0) continue;
    }

    $classSection = 'Not Assigned';
    if (count($activeClassAndSection) > 0) {
        $classSection = '';
        foreach ($activeClassAndSection as $cs) {
            $classSection .= $cs->class_name . ' - ' . $cs->section_name . "<br/>";
        }
    }

    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . $row->first_name . ' ' . $row->last_name . '</td>';
    echo '<td>' . $row->phone . '</td>';
    echo '<td>' . $row->email . '</td>';
    echo '<td>' . $row->username . '</td>';
    echo '<td>' . $row->birthday . '</td>';
    echo '<td>' . $row->sex . '</td>';
    echo '<td>' . $row->address. '</td>';
    echo '<td>' . $row->since . '</td>';
    echo '<td>' . $branch_shifts . '</td>';
    echo '<td>' . $classSection . '</td>';
    echo '</tr>';

endforeach;

echo '</table>';
