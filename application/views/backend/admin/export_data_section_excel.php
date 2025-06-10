<?php
// Aktifkan header untuk file Excel
header("Content-Type: application/vnd.ms-excel");

header("Pragma: no-cache");
header("Expires: 0");

if ($branch_id == '') {
    $branch = "All Branches";
} else {
    $branch = $this->db->get_where('branch', ['branch_id' => $branch_id])->row()->name . ' Branch';
}
if ($class_id == '') {
    $class = "All Class";
} else {
    $class = $this->db->get_where('class', ['class_id' => $class_id])->row()->name . ' Class';
}
$current_date = date('Y-m-d');
$filename = $branch . ' ' . $class . '-' . $current_date . '.xls';
header("Content-Disposition: attachment; filename=Section list of $filename.xls");
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="4" align="center"><strong>'
    . 'Section list of ' . $branch . ' ' . $class . '</strong></td></tr>';

echo '<tr>
        <th>No.</th>
        <th>Section Name</th>
        <th>Class</th>
        <th>Branch</th>
      </tr>';

if ($class_id == '') {
    $where = [];
} else {
    $where = ['class_id' => $class_id];
}
$section = $this->db->get_where('section', $where)->result();
$no = 1;

foreach ($section as $row):
    $classDetail = $this->db->get_where('class', ['class_id' => $row->class_id])->row();
    $branchDetail = $this->db->get_where('branch', ['branch_id' => @$classDetail->branch_id])->row();

    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . $row->name . '</td>';
    echo '<td>' . @$classDetail->name . '</td>';
    echo '<td>' . @$branchDetail->name . '</td>';
    echo '</tr>';

endforeach;

echo '</table>';
