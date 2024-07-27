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
function getAllExamBySubject($subjectId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('exam')
        ->where([
            'subject_id'=>$subjectId
        ])
        ->get();
    return $data->result();
}
function getAllMarkActivityByExam($examId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('mark_activity')
        ->where([
            'exam_id'=>$examId,
        ])
        ->get();
    return $data->result();
}
function isStudentExistMark($student_id,$examId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('mark')
        ->where([
            'student_id' => $student_id,
            'exam_id' => $examId,
        ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
function addStudentToMark($student_id, $subject_id, $class_id, $section_id,$exam_id)
{
    if(isStudentExistMark($student_id,$exam_id)){
        return false;
    }
    $runningYear = getRunningYear();
    $data=[
        'student_id'=>$student_id,
        'subject_id'=>$subject_id,
        'class_id'=>$class_id,
        'section_id'=>$section_id,
        'exam_id'=>$exam_id,
        'mark_obtained'=>0,
        'comment'=>'',
        'year'=>$runningYear,
        'final'=>0,
    ];
    $ci = &get_instance();
    $insert = $ci->db->insert('mark', $data);
    return $insert ? true : false;
}
function isStudentExistNotaCapacidad($student_id,$markActivtyId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('nota_capacidad')
        ->where([
            'student_id' => $student_id,
            'mark_activity_id' => $markActivtyId,
        ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
function addStudentToNotacapacidad($student_id, $markActivtyId)
{
    if(isStudentExistNotaCapacidad($student_id,$markActivtyId)){
        return false;
    }
    $data=[
        'student_id'=>$student_id,
        'mark_activity_id'=>$markActivtyId,
        'nota'=>0
    ];
    $ci = &get_instance();
    $insert = $ci->db->insert('nota_capacidad', $data);
    return $insert ? true : false;
}
function addStudentToMarkAndNotaCapacidadFromSubject($student_id,$subject_id)
{
    $markadded=0;
    $notacapacidadadded=0;
    foreach(getAllExamBySubject($subject_id) as $examSubject)
    {
        foreach(getAllMarkActivityByExam($examSubject->exam_id) as $markActivity)
        {
            $tomark=addStudentToMark($student_id,$markActivity->subject_id, $markActivity->class_id, $markActivity->section_id, $markActivity->exam_id);
            if($tomark){
                $markadded++;
            }
            $tocapcidad=addStudentToNotacapacidad($student_id, $markActivity->mark_activity_id);
            if($tocapcidad){
                $notacapacidadadded++;
            }
        }
    }
    $data=[
        'mark'=>$markadded,
        'notacapacided'=>$notacapacidadadded
    ];
    return $data;
}
    function sendMailNotif() {
        $ci =& get_instance();
        $smtpUser="setting@nazarethnet.com";
        $smtpPass="C@{&9LM,VccT";
        $senderMail="setting@nazarethnet.com";
        $targetMail=$ci->db->get_where('settings', array('type' => 'account_email'))->row()->description;
        $ci->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'localhost';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = $smtpUser;
        $config['smtp_pass']    = $smtpPass;
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $ci->email->initialize($config);
        $ci->email->from($senderMail, 'nazarethnet.com');
        $ci->email->to($targetMail); 
        $ci->email->subject("GDrive Account Issues Report");
        $ci->email->message("Please Re Authorized your GDrive Account in nazarethnet.com, open setting and google drive and link again your account.");    
         if ($ci->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    function sendMailNotifTesting() {
        $ci =& get_instance();
        $smtpUser="setting@nazarethnet.com";
        $smtpPass="C@{&9LM,VccT";
        $senderMail="setting@nazarethnet.com";
        $targetMail=$ci->db->get_where('settings', array('type' => 'account_email'))->row()->description;
        $ci->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'localhost';
        $config['smtp_port']    = '25';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = $smtpUser;
        $config['smtp_pass']    = $smtpPass;
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $ci->email->initialize($config);
        $ci->email->from($senderMail, 'nazarethnet.com');
        $ci->email->to($targetMail); 
        $ci->email->subject("TESTING MODE GDrive Account Issues Report");
        $ci->email->message("TESTING MODE Please Re Authorized your GDrive Account in nazarethnet.com, open setting and google drive and link again your account.");    
         if ($ci->email->send()) {
            return true;
        } else {
            return false;
        }
}

