<?php



function print_json($data)
{
    echo json_encode($data, JSON_PRETTY_PRINT);
}
function getStudentClassAndSectionById($student_id)
{
    $ci = &get_instance();
    $runningYear = getRunningYear();
    $data = $ci->db->select('enroll.*, class.name as class_name, section.name as section_name')
        ->from('enroll')
        ->join('class', 'class.class_id = enroll.class_id')
        ->join('section', 'section.section_id = enroll.section_id')
        ->where(['enroll.student_id' => $student_id, 'enroll.year' => $runningYear])
        ->get();
    return $data->result();
}
function getStudentInfo($student_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('student')
        ->where('student_id', $student_id)
        ->get();
    return $data->row();
}
function getRunningYear()
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('settings')
        ->where(['type' => 'running_year'])
        ->get();
    if ($data->num_rows() > 0) {
        return $data->row()->description;
    } else {
        return false;
    }
}
