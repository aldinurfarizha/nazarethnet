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
$current_date = date('Y-m-d');
$filename = $branch .'-'. $current_date . '.xls';
header("Content-Disposition: attachment; filename=Class list of $filename.xls");
echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="4" align="center"><strong>'
    . 'Class list of '. $branch .'</strong></td></tr>';

echo '<tr>
        <th>No.</th>
        <th>Branch</th>
        <th>Class Name</th>
        <th>Section</th>
      </tr>';

      if($branch_id == '') {
        $where = [];
      } else {
        $where = ['branch_id' => $branch_id];
      }
$class = $this->db->get_where('class', $where)->result();
$no = 1;

foreach ($class as $row):

    if (!empty($branch_id) && $row->branch_id != $branch_id) continue;

    if (!empty($row->branch_id)) {
        $branch_data = getDetailBranch($row->branch_id);
        $branch_name = @$branch_data->name;
    }
    $section = $this->db->get_where('section', ['class_id' => $row->class_id])->result();
    $classSection = '';
    if(!$section) {
        $classSection .= 'No Section';
    }else{
        foreach ($section as $cs):
            $classSection .= $cs->name . "<br/>";
        endforeach;
    }

    echo '<tr>';
    echo '<td>' . $no++ . '</td>';
    echo '<td>' . $branch_name . '</td>';
    echo '<td>' . $row->name . '</td>';
    echo '<td>' . $classSection . '</td>';
    echo '</tr>';

endforeach;

echo '</table>';
