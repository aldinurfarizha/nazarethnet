<?php
// Aktifkan header untuk file Excel
header("Content-Type: application/vnd.ms-excel");

header("Pragma: no-cache");
header("Expires: 0");

if ($branch_id == '') {
    $branch = "All Branches";
} else {
    $branch = $this->db->get_where('branch', ['branch_id' => $branch_id])->row()->name.' Branch';
}
if ($class_id == '') {
    $class = "All Class";
} else {
    $class = $this->db->get_where('class', ['class_id' => $class_id])->row()->name . ' Class';
}
if ($section_id == '') {
    $section = "All Section";
} else {
    $section = $this->db->get_where('section', ['section_id' => $class_id])->row()->name . ' Section';
}
$current_date = date('Y-m-d');
$filename = $branch .' '.$class.'-'. $current_date . '.xls';
header("Content-Disposition: attachment; filename=Subject list of $filename.xls");
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="5" align="center"><strong>'
    . 'Subject list of '. $branch .' '.$class.' '.$section.'</strong></td></tr>';

echo '<tr>
        <th>No.</th>
        <th>Subject Name</th>
        <th>Branch</th>
        <th>Class</th>
        <th>Section</th>
      </tr>';

      if($class_id == '') {
        $where = [];
      } else {
        $where = ['class_id' => $class_id];
      }
      if($section_id != '') {
        $where['section_id'] = $section_id;
      }
$subject = $this->db->get_where('subject', $where)->result();
$no = 1;

foreach ($subject as $row):
    $classDetail= $this->db->get_where('class', ['class_id' => $row->class_id])->row();
    $sectionDetail = $this->db->get_where('section', ['section_id' => $row->section_id])->row();
    $branchDetail = $this->db->get_where('branch', ['branch_id' => @$classDetail->branch_id])->row();
    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . $row->name . '</td>';
    echo '<td>' . @$branchDetail->name . '</td>';
    echo '<td>' . @$classDetail->name . '</td>';
    echo '<td>' . @$sectionDetail->name . '</td>';
    echo '</tr>';

endforeach;

echo '</table>';
