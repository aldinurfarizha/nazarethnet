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
        ->where(['enroll.student_id' => $student_id, 'enroll.is_active' => 1])
        ->get();
    return $data->result();
}
function getStudentClassAndSectionByIdAll($student_id)
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
function getStudentGroupClassById($student_id)
{
    $ci = &get_instance();
    $runningYear = getRunningYear();
    $data = $ci->db->select('enroll.*, class.name as class_name')
        ->from('enroll')
        ->join('class', 'class.class_id = enroll.class_id')
        ->where(['enroll.student_id' => $student_id, 'enroll.year' => $runningYear])
        ->group_by('enroll.class_id')
        ->get();
    return $data->result();
}
function getEnrollById($enroll_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('enroll.*, class.name as class_name, section.name as section_name')
        ->from('enroll')
        ->join('class', 'class.class_id = enroll.class_id')
        ->join('section', 'section.section_id = enroll.section_id')
        ->where('enroll_id', $enroll_id)
        ->get();
    return $data->row();
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

function getSubjectByClassIdandSectionId($classId, $sectionId)
{
    $ci = &get_instance();
    $runningYear = getRunningYear();
    $data = $ci->db->select('subject.*, class.name as class_name, section.name as section_name')
        ->from('subject')
        ->join('class', 'class.class_id = subject.class_id')
        ->join('section', 'section.section_id = subject.section_id')
        ->where(['subject.class_id' => $classId, 'subject.section_id' => $sectionId, 'subject.year' => $runningYear])
        ->get();
    if ($data->num_rows() > 0) {
        return $data->result();
    } else {
        return false;
    }
}
function getSubjectDetailBySubjectId($subjectId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('subject')
        ->where(['subject_id' => $subjectId])
        ->get();
    if ($data->num_rows() > 0) {
        return $data->row();
    } else {
        return false;
    }
}
function getAvailabeSubject($student_id)
{
    $classSection = getStudentClassAndSectionById($student_id);
    $temp = array();
    foreach ($classSection as $cs) {
        $subject = getSubjectByClassIdandSectionId($cs->class_id, $cs->section_id);
        foreach ($subject as $data) {
            $temp[] = (object) $data;
        }
    }
    return $temp;
}
function isStudentEnrolled($student_id, $class_id, $section_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('enroll')
        ->where([
            'class_id' => $class_id,
            'section_id' => $section_id,
            'student_id' => $student_id
        ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
function isActiveSubject($student_id, $subject_id)
{
    $ci = &get_instance();
    $subjectData = getSubjectDetailBySubjectId($subject_id);
    if (isStudentEnrolled($student_id, $subjectData->class_id, $subjectData->section_id) == false) {
        return false;
    }
    $data = $ci->db->select('*')
        ->from('student_subject')
        ->where(['student_id' => $student_id, 'subject_id' => $subject_id])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
function activateStudentSubject($student_id, $subject_id)
{
    if (isActiveSubject($student_id, $subject_id)) {
        return false;
    }
    $ci = &get_instance();
    $data = array(
        'student_id' => $student_id,
        'subject_id' => $subject_id
    );
    $insert = $ci->db->insert('student_subject', $data);

    return $insert ? true : false;
}
function deactiveStudentSubject($student_id, $subject_id)
{
    $ci = &get_instance();
    $where = array(
        'student_id' => $student_id,
        'subject_id' => $subject_id
    );
    $delete = $ci->db->delete('student_subject', $where);
    return $delete;
}
function generateSubjectAllStudent()
{
    $success = 0;
    $failed = 0;
    $totalSubjectAdded = 0;
    $runningYear = getRunningYear();
    $ci = &get_instance();

    $enrollData = $ci->db->select('*')
        ->from('enroll')
        ->where(['year' => $runningYear, 'is_active' => 1])
        ->get();

    if ($enrollData->num_rows() > 0) {
        foreach ($enrollData->result() as $data) {
            $student_id = $data->student_id;
            $subjectData = getSubjectByClassIdandSectionId($data->class_id, $data->section_id);

            if (!empty($subjectData)) {
                foreach ($subjectData as $sbjd) {
                    if (activateStudentSubject($student_id, $sbjd->subject_id)) {
                        $success++;
                    } else {
                        $failed++;
                    }
                    $totalSubjectAdded++;
                }
            }
        }
    }

    $result = array(
        'SUCCESS' => $success,
        'Failed' => $failed,
        'total_subject_added' => $totalSubjectAdded
    );

    return $result;
}
function generateSubjectNewStudent($student_id)
{
    $success = 0;
    $failed = 0;
    $totalSubjectAdded = 0;
    $runningYear = getRunningYear();
    $ci = &get_instance();

    $enrollData = $ci->db->select('*')
        ->from('enroll')
        ->where(['year' => $runningYear, 'is_active' => 1, 'student_id' => $student_id])
        ->get();

    if ($enrollData->num_rows() > 0) {
        foreach ($enrollData->result() as $data) {
            $student_id = $data->student_id;
            $subjectData = getSubjectByClassIdandSectionId($data->class_id, $data->section_id);

            if (!empty($subjectData)) {
                foreach ($subjectData as $sbjd) {
                    if (activateStudentSubject($student_id, $sbjd->subject_id)) {
                        $success++;
                    } else {
                        $failed++;
                    }
                    $totalSubjectAdded++;
                }
            }
        }
    }

    $result = array(
        'SUCCESS' => $success,
        'Failed' => $failed,
        'total_subject_added' => $totalSubjectAdded
    );

    return $result;
}
