<?php



function print_json($data)
{
    echo json_encode($data, JSON_PRETTY_PRINT);
}
function generateRandomString($length = 10)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        if (function_exists('random_int')) {
            $index = random_int(0, $charactersLength - 1);
        } else {
            $index = mt_rand(0, $charactersLength - 1);
        }
        $randomString .= $characters[$index];
    }

    return $randomString;
}
function isCertCodeCanUse($certCode)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('student_subject')
        ->where('cert_code', $certCode)
        ->get();
    if ($data->num_rows() > 0) {
        return false;
    } else {
        return true;
    }
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
function getStudentSubject($student_id, $subject_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('student_subject')
        ->where(['student_id' => $student_id, 'subject_id' => $subject_id])
        ->get();
    return $data->row();
}
function getStudentBySubjectId($subject_id)
{
    $ci = &get_instance();
    $subjectData = getSubjectDetailBySubjectId($subject_id);
    $student = $ci->db->select('student.student_id')
        ->from('student_subject')
        ->join('student', 'student.student_id = student_subject.student_id')
        ->where(['student_subject.subject_id' => $subject_id])
        ->get();
    $student=$student->result();
    $student_id = array();
    foreach($student as $data){
        if (!isStudentActiveEnroll($data->student_id, $subjectData->class_id, $subjectData->section_id, getRunningYear())) {
            continue;
        }
        if (isStudentDeactive($data->student_id)) {
            continue;
        }
        if (isStudentFinishSubject($data->student_id, $subject_id)) {
            continue;
        }
        if (isActiveSubject($data->student_id, $subject_id)) {
            $student_id[] = $data->student_id;
        }
    }
    return $student_id;
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
function getAvailabeSubjectAll($student_id)
{
    $classSection = getStudentClassAndSectionByIdAll($student_id);
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
function getRollByClassAndSection($class_id, $section_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('roll')
        ->from('enroll')
        ->where(['class_id' => $class_id, 'section_id' => $section_id])
        ->get();
    return $data->row();
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
function deleteStudentFromSubject($student_id, $subject_id)
{
    $ci = &get_instance();
    return $ci->db->delete('student_subject', [
        'student_id' => $student_id,
        'subject_id' => $subject_id
    ]);
}
function deleteStudentMarks($student_id, $subject_id, $class_id, $section_id)
{
    $ci = &get_instance();
    return $ci->db->delete('mark', [
        'student_id' => $student_id,
        'subject_id' => $subject_id,
        'class_id' => $class_id,
        'section_id' => $section_id
    ]);
}
function deleteStudentNotaCapacidad($student_id, $subject_id, $class_id, $section_id)
{
    $ci = &get_instance();

    // Ambil mark_id yang relevan
    $ci->db->select('mark_id');
    $ci->db->where([
        'student_id' => $student_id,
        'subject_id' => $subject_id,
        'class_id' => $class_id,
        'section_id' => $section_id
    ]);
    $mark_ids = $ci->db->get('mark')->result_array();

    if (!empty($mark_ids)) {
        $mark_activity_ids = array_column($mark_ids, 'mark_id');
        $ci->db->where_in('mark_activity_id', $mark_activity_ids);
        $ci->db->where('student_id', $student_id);
        return $ci->db->delete('nota_capacidad');
    }

    return true;
}
function deleteStudentAttendance($student_id, $subject_id)
{
    $ci = &get_instance();
    return $ci->db->delete('attendance', [
        'student_id' => $student_id,
        'subject_id' => $subject_id
    ]);
}
function deleteStudentDeliveries($student_id,$homework_code)
{
    $ci = &get_instance();
    return $ci->db->delete('deliveries', [
        'student_id' => $student_id,
        'homework_code' => $homework_code,
    ]);
}
function deleteStudentOnlineExamResults($student_id, $online_exam_result_id)
{
    $ci = &get_instance();
    return $ci->db->delete('online_exam_result', [
            'student_id' => $student_id,
            'online_exam_result_id' => $online_exam_result_id,
    ]);
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
                        addStudentToMarkAndNotaCapacidadFromSubject($student_id, $sbjd->subject_id);
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
            'subject_id'=>$subjectId,
        ])
        ->get();
    return $data->result();
}
function getAllExamBySubjectDetail($subjectId,$classId,$sectionId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('exam')
        ->where([
            'subject_id'=>$subjectId,
            'class_id'=>$classId,
            'section_id'=>$sectionId
        ])
        ->get();
    return $data->result();
}
function getAllExamByMarkActivityIdFromAutoFillExam($mark_activity_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('auto_fill_exam')
        ->where([
            'mark_activity_id'=>$mark_activity_id
        ])
        ->get();
    return $data->result();
}
function getAllExamBySubjectAndStudentid($subjectId,$studentId)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('exam')
        ->where([
            'subject_id'=>$subjectId,
            'student_id'=>$studentId
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
function getAllMarkActivityIdBySubjectIdAndIsCalculate($subject_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('mark_activity')
        ->where([
            'is_calculate_avg'=>1,
            'subject_id'=>$subject_id,
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
function addStudentToMarkIfNotExist($student_id, $subject_id, $class_id, $section_id)
{
    $exam =  getAllExamBySubjectDetail($subject_id,$class_id,$section_id);
    foreach ($exam as $ex) {
        $exam_id = $ex->exam_id;
        if(isStudentExistMark($student_id,$exam_id)){
        continue;
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
        $ci->db->insert('mark', $data);
    }
    
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
function addStudentToNotacapacidadIfNotExist($student_id, $subject_id, $class_id,$section_id)
{
    $ci = &get_instance();
    $exam =  getAllExamBySubjectDetail($subject_id,$class_id,$section_id);
    foreach($exam as $ex){
        $exam_id = $ex->exam_id;
        $markActivity = $ci->db->select('*')
        ->from('mark_activity')
        ->where([
            'exam_id'=>$exam_id,
            'subject_id'=>$subject_id,
            'class_id'=>$class_id,
            'section_id'=>$section_id
        ])
        ->get()->result();
        foreach($markActivity as $mark){
            $markActivtyId = $mark->mark_activity_id;
            if(isStudentExistNotaCapacidad($student_id,$markActivtyId)){
                continue;
            }
            $data=[
                'student_id'=>$student_id,
                'mark_activity_id'=>$markActivtyId,
                'nota'=>0
            ];
            $ci = &get_instance();
            $ci->db->insert('nota_capacidad', $data);
        }
    }
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
    function getNotaCapcidadValue($markActivityId, $student_id) {
        $ci = &get_instance();
        $data = $ci->db->select('nota')
            ->from('nota_capacidad')
            ->where('mark_activity_id', $markActivityId)
            ->where('student_id', $student_id)
            ->get();
        
        $result = $data->row();

        return $result ? (int) ($result->nota !== null ? $result->nota : 0) : 0;
    }
    function recalculateMarkObtainedAndFinal($student_id, $subject_id,$exam_id,$class_id,$section_id,$year)
    {
        $markObtained=0;
        $final=0;
        $row=0;
        foreach(getAllMarkActivityByExam($exam_id) as $markActivity){
            $nota=getNotaCapcidadValue($markActivity->mark_activity_id,$student_id);
            $markObtained+=$nota;
            $row++;
        }
        $final=$markObtained/$row;
        $final=number_format($final,2,".",",");
        $data=array(
            'mark_obtained'=>$markObtained,
            'final'=>$final
        );
        $ci = &get_instance();
        $ci->db->where('student_id', $student_id);
        $ci->db->where('subject_id', $subject_id);
        $ci->db->where('exam_id', $exam_id);
        $ci->db->where('class_id', $class_id);
        $ci->db->where('section_id', $section_id);
        $ci->db->where('year', $year);
        $ci->db->update('mark', $data);
    }
    function refreshMarkColoum()
    {
    $ci = &get_instance();
    $totalMark=0;
    $totalNotaCapacidad=0;
    $allSubject=$ci->db->query("SELECT * FROM subject")->result();
    foreach($allSubject as $subject)
    {
        $allStudentBySubject=$ci->db->query("SELECT * from student_subject where subject_id=$subject->subject_id")->result();
        foreach($allStudentBySubject as $student)
        {
            $data=addStudentToMarkAndNotaCapacidadFromSubject($student->student_id, $subject->subject_id);
            $totalMark += $data['mark'];
            $totalNotaCapacidad += $data['notacapacided'];
        }

    }
    $result=array(
        'total_mark'=>$totalMark,
        'total_nota_capacidad'=>$totalNotaCapacidad
    );
    return $result;
    }
    function getCustomStatusAttendanceByTeacherId($teacher_id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM custom_status where teacher_id=$teacher_id")->result();
    }
    function getStatusNameFromId($custom_status_id)
    {
        $ci = &get_instance();
        $query = $ci->db->query("SELECT status_name FROM custom_status WHERE custom_status_id = $custom_status_id")->row();

        return $query ? $query->status_name : 'N/A';
    }
    function getTeacherIdFromSubject($subject_id)
    {
        $ci = &get_instance();
        $query = $ci->db->query("SELECT teacher_id FROM subject WHERE subject_id = $subject_id")->row();

        return $query ? $query->teacher_id : '0';
    }
    function getSubjectNameById($subject_id)
    {
    $ci = &get_instance();
    $query=$ci->db->query("SELECT name from subject where subject_id=$subject_id")->row();
    return $query ? $query->name : '-';
    }
    function getClassNameById($class_id)
    {
        $ci = &get_instance();
        $query = $ci->db->query("SELECT name from class where class_id=$class_id")->row();
        return $query ? $query->name : '-';
    }
    function getSectionNameById($section_id)
    {
        $ci = &get_instance();
        $query = $ci->db->query("SELECT name from section where section_id=$section_id")->row();
        return $query ? $query->name : '-';
    }
    function getClassByTeacher($teacher_id)
    {
        $ci = &get_instance();
        return $ci->db->query("SELECT * FROM subject WHERE teacher_id = $teacher_id GROUP BY class_id")->result_array();
    }
    function isStudentDeactive($student_id)
    {
        $ci = &get_instance();
        $data = $ci->db->select('*')
        ->from('student')
        ->where(['student_id' => $student_id, 'is_active' => 0])
        ->get();
        if ($data->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function isMarkBlocked($student_id, $subject_id)
    {
        $ci = &get_instance();
        $data = $ci->db->select('*')
        ->from('student_subject')
        ->where(['student_id' => $student_id,'subject_id'=>$subject_id, 'is_block' => 1])
        ->get();
        if ($data->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function getMarkBlockedReason($student_id,$subject_id)
    {
        $ci = &get_instance();
        $data = $ci->db->select('*')
        ->from('student_subject')
        ->where(['student_id' => $student_id,'subject_id'=>$subject_id,])
        ->get()->row();
        return $data ? $data->reason : '-';
    }
    function countMissingClass($student_id,$subject_id)
    {
        $ci = &get_instance();
        $data = $ci->db->select('*')
        ->from('attendance')
        ->where(['student_id' => $student_id,'subject_id'=>$subject_id, 'status' => 2])
        ->get();
        return $data->num_rows();
    }
    function isStudentFinishSubject($student_id, $subject_id)
    {
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('student_subject')
        ->where([
            'student_id' => $student_id,
            'subject_id' => $subject_id,
            'is_finish'=>1
        ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}
    function isStudentActiveEnroll($student_id,$class_id,$section_id,$year)
    {
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('enroll')
        ->where([
            'student_id' => $student_id,
            'section_id' => $section_id,
            'year' => $year,
            'student_id'=>$student_id,
            'is_active'=>1
        ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
    }
    function getFinalMark($student_id, $subject_id, $exam_id, $year)
    {
        $ci = &get_instance();
        $query = $ci->db->get_where('mark', [
            'subject_id' => $subject_id,
            'exam_id'    => $exam_id,
            'student_id' => $student_id,
            'year'       => $year
        ]);

        $row = $query->row();
        return $row && isset($row->final) ? $row->final : 0;
    }

function countEvaluacionesFinales($exam_id,$student_id)
    {
        $ci = &get_instance();
        $examDetail = $ci->db->get_where('exam', array('exam_id' => $exam_id))->row();
        if($examDetail->is_final==0){
            return 0;
        }
        $finalValue=0;
        $markActivity= $ci->db->get_where('mark_activity', array('exam_id' => $exam_id))->result();
        foreach($markActivity as $markActivitys)
        {
            $percent=$markActivitys->percent;
            $notas = $ci->db->order_by('nota_capacidad_id', 'ASC')->get_where('nota_capacidad', array('mark_activity_id' => $markActivitys->mark_activity_id, 'student_id' => $student_id))->row()->nota;
            $finalValue+=(int)$notas*(int)$percent/100;
        }
        return $finalValue;
    }
    function getSubjectIdByExamId($exam_id)
    {
        $ci = &get_instance();
        $avg = $ci->db->get_where('exam', array('exam_id' => $exam_id))->row()->subject_id;
        return $avg;
    }
    function countAllFinalMark($student_id,$subject_id,$year)
    {
        $total=0;
        $count=0;
        $data=getAllExamBySubject($subject_id);
        foreach($data as $datar)
        {
            if($datar->is_final==0 && $datar->is_count==1){
                $total+=getFinalMark($student_id,$subject_id,$datar->exam_id,$year);
                $count++;
            }
        }
        $average=$total/$count;
    $average = round($average, 2);
        return $average;
    }
    function countAllFinalMarkAutoFillExam($student_id,$subject_id,$year,$mark_activity_id)
    {
        $total=0;
        $count=0;
        $data=getAllExamByMarkActivityIdFromAutoFillExam($mark_activity_id);
        foreach($data as $datar)
        {
                $total+=getFinalMark($student_id,$subject_id,$datar->exam_id,$year);
                $count++;
        }
        if ($count === 0) {
            $average = 0;
        } else {
            $average = $total / $count;
            $average = round($average, 2);
        }
        return $average;
    }
    function countAllFinalMarkExplain($student_id,$subject_id,$year)
    {
        $total='';
        $count=0;
        $data=getAllExamBySubject($subject_id);
        foreach($data as $datar)
        {
            if($datar->is_final==0 && $datar->is_count==1){
                $total.=getFinalMark($student_id,$subject_id,$datar->exam_id,$year);
                $total.='+';
                $count++;
            }
        }
        $average=$total.'/'.$count;
        return $average;
    }
    function countAllFinalMarkExplainAutoFillExam($student_id,$subject_id,$year,$mark_activity_id)
    {
        $total='';
        $count=0;
        $data=getAllExamByMarkActivityIdFromAutoFillExam($mark_activity_id);
        foreach($data as $datar)
        {
                $total.=getFinalMark($student_id,$subject_id,$datar->exam_id,$year);
                $total.='+';
                $count++;
        }
        $average=$total.'/'.$count;
        return $average;
    }
    function getEnrollActiveStudent($subject_id,$class_id,$section_id,$year)
    {
        $ci = &get_instance();
         $data = $ci->db->query('SELECT s.student_id, e.roll FROM student AS s INNER JOIN enroll AS e ON s.student_id = e.student_id INNER JOIN subject AS su ON su.section_id = e.section_id WHERE su.subject_id = ' . $subject_id . ' AND e.class_id = ' . $class_id . ' AND e.section_id = ' . $section_id . ' AND e.year = ' . $year . ' AND e.is_active=1 ORDER BY s.first_name ASC')->result();
        return $data;
    }
    function getNotasByMarkActivityId($markActivityId)
    {
        $ci = &get_instance();
        $notas = $ci->db->order_by('nota_capacidad_id', 'ASC')->get_where('nota_capacidad', array('mark_activity_id' => $markActivityId));
        return $notas->result();
    }
    function recalculateMarkProm($subject_id,$class_id,$section_id,$year)
    {
        $markActivitys=getAllMarkActivityIdBySubjectIdAndIsCalculate($subject_id);
        foreach($markActivitys as $markActivity){
            $notas=getNotasByMarkActivityId($markActivity->mark_activity_id);
            foreach($notas as $row)
            {
                if (!isStudentActiveEnroll($row->student_id, $class_id, $section_id, $year)) {
                        continue;
                    }
                if (!isActiveSubject($row->student_id,$subject_id)){
                    continue;
                }    
                $newNota=countAllFinalMarkAutoFillExam($row->student_id,$subject_id,$year,$markActivity->mark_activity_id);
                updateNotaCapacidadesById($row->student_id,$row->nota_capacidad_id,$newNota);
            }
        }
    }
    function updateNotaCapacidadesById($student_id,$nota_capacidad_id,$nota)
    {
        if (!is_numeric($nota) || is_nan($nota)) {
            $nota = 0; // Atur ke nilai default
        } else {
            $nota = round($nota, 2); // Bulatkan nilai jika valid
        }
    
        $data = array(
            'nota' => $nota
        );
    
        $ci = &get_instance();
        $ci->db->where('student_id', $student_id);
        $ci->db->where('nota_capacidad_id', $nota_capacidad_id);
        $ci->db->update('nota_capacidad', $data);
    }
    function getExamDetail($exam_id)
    {
            $ci = &get_instance();
            $data = $ci->db->query("SELECT exam.*, mark_activity.year as year
            FROM exam
            INNER JOIN mark_activity ON exam.exam_id = mark_activity.exam_id
            WHERE exam.exam_id = $exam_id")->row();
            return $data; 
    }
    function getMarkDetail($mark_activity_id)
    {
            $ci = &get_instance();
            $data = $ci->db->query("SELECT * FROM mark_activity where mark_activity_id = $mark_activity_id")->row();
            return $data; 
    }
    function isExamCounted($exam_id,$mark_activity_id)
    {
        $ci = &get_instance();
        $data = $ci->db->select('*')
        ->from('auto_fill_exam')
        ->where([
            'exam_id' => $exam_id,
            'mark_activity_id' => $mark_activity_id,
        ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
    }
function getStudentIdByParentId($parentId)
{
    $ci = &get_instance();
    $student_id = $ci->db->get_where('student', array('parent_id' => $parentId))->row()->student_id;
    return $student_id;
}
function insertLogger($text)
{
    $ci = &get_instance();
    $data=array(
        'deskripsi'=>$text
    );
    $ci->db->insert('logger', $data);
}
function getFirstExamId($subject_id)
{
    $ci = &get_instance(); // Mengambil instance CI
    $data = $ci->db->select('exam_id') // Hanya mengambil kolom yang diperlukan
                   ->from('exam')
                   ->where('subject_id', $subject_id)
                   ->limit(1) // Membatasi hasil menjadi satu baris
                   ->get();

    return ($data->num_rows() > 0) ? $data->row()->exam_id : '';
}
function getActiveStudentBySubjectId($subject_id,$class_id,$section_id,$year)
{
    $ci = &get_instance();

 
    $data = $ci->db->select('student_subject.*, student.*') 
    ->from('student_subject') 
    ->join('student', 'student_subject.student_id = student.student_id') 
    ->where('student_subject.subject_id', $subject_id)
    ->where('student_subject.is_finish', 0) 
    ->get();

    $onlyActiveStudent = []; 
    foreach($data->result() as $datax){
    if(isStudentActiveEnroll($datax->student_id,$class_id,$section_id,$year)){
            $onlyActiveStudent[] = $datax;
        };
    }
    return $onlyActiveStudent;
}
function getRoll($student_id,$class_id,$section_id,$runningYear){
    $ci = &get_instance();
    $roll = $ci->db->get_where('enroll', array('student_id' => $student_id,'class_id'=>$class_id,'section_id'=>$section_id))->row()->roll;
    return $roll;
}
function isClassExist($class_id)
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
    ->from('class')
    ->where([
        'class_id' => $class_id,
    ])
        ->get();
    if ($data->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
    
}
function writeNotaCapacidadHistory($nota_capacidad_id,$value)
{
    $ci = &get_instance();
    $exitingNotaCapacidadValueHistory=$ci->db->query("SELECT * FROM nota_capacidad_history where nota_capacidad_id=$nota_capacidad_id ORDER BY nota_capacidad_history_id DESC")->row();
    if($exitingNotaCapacidadValueHistory){
        if ($exitingNotaCapacidadValueHistory->value == $value) {
            return;
        }
    }else{
        $exitingNotaCapacidadValue = $ci->db->query("SELECT * FROM nota_capacidad where nota_capacidad_id=$nota_capacidad_id")->row();
        if ($exitingNotaCapacidadValue) {
            $data = array(
                'nota_capacidad_id' => $nota_capacidad_id,
                'value' => $exitingNotaCapacidadValue->nota,
                'created_at' => date('Y-m-d H:i:s')
            );
            $ci->db->insert('nota_capacidad_history', $data);
            return;
        }
    }
    $exitingNotaCapacidadValue=$ci->db->query("SELECT * FROM nota_capacidad where nota_capacidad_id=$nota_capacidad_id")->row()->nota;
    if($exitingNotaCapacidadValue==$value){
        return;
    }
    $data = array(
        'nota_capacidad_id' => $nota_capacidad_id,
        'value' => $value,
        'created_at' => date('Y-m-d H:i:s')
    );
    $ci->db->insert('nota_capacidad_history', $data);
}
function getHistoryNotaCapacidad($nota_capacidad_id)
{
    $ci = &get_instance();
    $query = $ci->db->query("SELECT value, created_at FROM nota_capacidad_history WHERE nota_capacidad_id = ? ORDER BY nota_capacidad_history_id DESC", [$nota_capacidad_id]);
    $result = $query->result_array();

    $output = [];
    for ($i = 1; $i < count($result); $i++) {
        $output[] = $result[$i]['created_at'] . '=' . $result[$i]['value'];
    }

    return implode('<br>', $output);
}

function getActiveBranch(){
    $ci = &get_instance();
    $branch = $ci->db->get_where('branch', array('status' => "ACTIVE"))->result();
    return $branch;
}
function getClassByBranchId($branch_id)
{
    $ci = &get_instance();
    $class = $ci->db->get_where('class', array('branch_id' => $branch_id))->result();    
    return $class;
}
function getDetailBranch($branch_id)
{
    $ci = &get_instance();
    $branch = $ci->db->get_where('branch', array('branch_id' => $branch_id))->row();
    return $branch;
}
function getDetailShifts($shifts_id)
{
    $ci = &get_instance();
    $shifts = $ci->db->get_where('shifts', array('shifts_id' => $shifts_id))->row();
    return $shifts;
}
function isSuperAdmin() {
    $ci = &get_instance(); // Ambil instance CodeIgniter
    $ci->load->database(); // Pastikan database sudah diload
    $ci->load->library('session'); // Pastikan session diload

    $admin_id = $ci->session->userdata('login_user_id'); // Ganti sesuai nama sesi ID yang digunakan

    if (!$admin_id) return false;

    $admin = $ci->db->get_where('admin', ['admin_id' => $admin_id, 'owner_status' => 1])->row();

    return $admin ? true : false;
}
function getMyBranchId(){
    $ci = &get_instance(); // Ambil instance CodeIgniter
    $ci->load->database(); // Pastikan database sudah diload
    $ci->load->library('session'); // Pastikan session diload

    $admin_id = $ci->session->userdata('login_user_id'); // Ganti sesuai nama sesi ID yang digunakan

    if (!$admin_id) return false;

    $admin = $ci->db->get_where('admin', ['admin_id' => $admin_id])->row();

    return $admin;
}
function getBranchByAdminId($admin_id){
     $ci = &get_instance();
    $admin = $ci->db->get_where('admin', array('admin_id' => $admin_id))->row();
    if($admin==null){
        return null;
    }
    $branch = $ci->db->get_where('branch', array('branch_id' => $admin->branch_id,'status' => "ACTIVE"))->row();
    return $branch;
}
function getShiftsByBranchId($branch_id){
    $ci = &get_instance();
    $shifts = $ci->db->get_where('shifts', array('branch_id' => $branch_id))->result();
    return $shifts;
}
function isStudentEnrolledToSubject($student_id, $subject_id)
{
    $ci = &get_instance();
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
function addStudentToSubject($student_id, $subject_id)
{
    if (isStudentEnrolledToSubject($student_id, $subject_id)) {
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
function transferMarkOldToMarkNew($student_id, $oldExamId, $newExamId, $targetSubjectId, $targetClassId, $targetSectionId)
{
    $ci = &get_instance();

    // Ambil data dari ujian lama
    $data = $ci->db->select('*')
        ->from('mark')
        ->where([
            'student_id' => $student_id,
            'exam_id' => $oldExamId
        ])
        ->get();

    if ($data->num_rows() > 0) {
        foreach ($data->result() as $row) {
            // Cek apakah data target sudah ada
            $target = $ci->db->select('mark_id')
                ->from('mark')
                ->where([
                    'student_id' => $student_id,
                    'subject_id' => $targetSubjectId,
                    'class_id' => $targetClassId,
                    'section_id' => $targetSectionId,
                    'exam_id' => $newExamId
                ])
                ->get()
                ->row();

            if ($target) {
                // Update jika ditemukan
                $updateData = array(
                    'mark_obtained' => $row->mark_obtained,
                    'comment'       => $row->comment,
                    'year'          => $row->year,
                    'final'         => $row->final
                );

                $ci->db->where('mark_id', $target->mark_id);
                $ci->db->update('mark', $updateData);
            }
        }
        return true;
    } else {
        return false;
    }
}

function transferNotaCapacidadOldTonotaCapacidadNew($student_id, $oldMarkActivityId, $newMarkActivityId)
{
    $ci = &get_instance();

    // Ambil data lama berdasarkan mark_activity_id yang lama
    $data = $ci->db->select('*')
        ->from('nota_capacidad')
        ->where([
            'student_id' => $student_id,
            'mark_activity_id' => $oldMarkActivityId
        ])
        ->get();

    if ($data->num_rows() > 0) {
        foreach ($data->result() as $row) {
            // Cari apakah data target sudah ada
            $target = $ci->db->select('nota_capacidad_id') // Ganti dengan nama primary key tabel nota_capacidad
                ->from('nota_capacidad')
                ->where([
                    'student_id' => $student_id,
                    'mark_activity_id' => $newMarkActivityId
                ])
                ->get()
                ->row();

            if ($target) {
                // Update jika data sudah ada
                $updateData = array(
                    'nota' => $row->nota
                );

                $ci->db->where('nota_capacidad_id', $target->nota_capacidad_id); // Ganti 'id' dengan nama primary key tabel kamu
                $ci->db->update('nota_capacidad', $updateData);
            }
        }
        return true;
    } else {
        return false;
    }
}
function transferOldAttendanceToNew($students_id, $subject_id_source, $subject_id_target, $target_class_id, $target_section_id) 
{
    $ci = &get_instance();

    $attendances = $ci->db->select('*')
        ->from('attendance')
        ->where([
            'student_id'    => $students_id,
            'subject_id'    => $subject_id_source,
        ])
        ->get();

    if ($attendances->num_rows() > 0) {
        foreach ($attendances->result() as $row) {
            $insertData = array(
                'timestamp'     => $row->timestamp,
                'year'          => $row->year,
                'class_id'      => $target_class_id,
                'section_id'    => $target_section_id,
                'student_id'    => $row->student_id,
                'subject_id'    => $subject_id_target,
                'status'        => $row->status,
                'time'          => $row->time,
                'updated_at'    => date('Y-m-d H:i:s')
            );
            $ci->db->insert('attendance', $insertData);
        }
        return true;
    }

    return false;
}
function getAllReaction()
{
    $ci = &get_instance();
    $data = $ci->db->select('*')
        ->from('reaction')
        ->get();
    return $data->result();
}
function insertAllReaction()
{
    if(sizeof(getAllReaction()) > 0){
        return false;
    }
    $reaction = [
        ['reaction_type' => '👍'],
        ['reaction_type' => '❤️'],
        ['reaction_type' => '😂'],
        ['reaction_type' => '😮'],
        ['reaction_type' => '😢'],
        ['reaction_type' => '😡'],
        ['reaction_type' => '👏'],
        ['reaction_type' => '🔥'],
        ['reaction_type' => '🎉'],
        ['reaction_type' => '💯'],
    ];

    $ci = &get_instance();
    $ci->db->insert_batch('reaction', $reaction);
    return true;
}
function countReaction($id, $table_name)
{
    $ci = &get_instance();

    $table_id_fields = [
        'news_reactions'     => 'news_id',
        'document_reactions' => 'document_id',
        'forum_reactions'    => 'forum_id',
        'homework_reactions' => 'homework_id'
    ];

    if (!array_key_exists($table_name, $table_id_fields)) {
        return [];
    }

    $id_field = $table_id_fields[$table_name];

    $ci->db->select('r.reaction_id, r.reaction_type, COUNT(nr.reaction_id) as total');
    $ci->db->from("$table_name nr");
    $ci->db->join('reaction r', 'r.reaction_id = nr.reaction_id');
    $ci->db->where("nr.$id_field", $id);
    $ci->db->group_by('nr.reaction_id');
    $ci->db->order_by('total', 'DESC');
    $query = $ci->db->get();

    return $query->result();
}
function getComments($content_id,$table_name)
{
    $ci = &get_instance();

    // Mapping nama tabel ke field ID yang sesuai
    $table_id_fields = [
        'news_comments'     => 'news_id',
        'document_comments' => 'document_id',
        'forum_comments'    => 'forum_id',
        'homework_comments' => 'homework_id'
    ];

    if (!array_key_exists($table_name, $table_id_fields)) {
        return [];
    }

    $id_field = $table_id_fields[$table_name];

    $ci->db->from($table_name);
    $ci->db->where($id_field, $content_id);
    $ci->db->order_by('created_at', 'ASC');
    $comments = $ci->db->get()->result_array();

    $results = [];

    foreach ($comments as $comment) {
        $comment_id = $comment[$table_name . '_id'];
        $student_id = $comment['student_id'];
        $admin_id   = $comment['admin_id'];
        $teacher_id = isset($comment['teacher_id']) ? $comment['teacher_id'] : 0;

        $name = '';
        $role = '';
        
        if ($student_id && $student_id != 0) {
            $ci->db->where('student_id', $student_id);
            $user = $ci->db->get('student')->row();
            $name = $user ? $user->first_name : '';
            $role = 'student';
        } elseif ($teacher_id && $teacher_id != 0) {
            $ci->db->where('teacher_id', $teacher_id);
            $user = $ci->db->get('teacher')->row();
            $name = $user ? $user->first_name : '';
            $role = 'teacher';
        } elseif ($admin_id && $admin_id != 0) {
            $ci->db->where('admin_id', $admin_id);
            $user = $ci->db->get('admin')->row();
            $name = $user ? $user->first_name : '';
            $role = 'admin';
        }

        $results[] = [
            'comments_id' => $comment_id,
            'comments'    => $comment['comments'],
            'student_id'  => $student_id,
            'teacher_id'  => $teacher_id,
            'admin_id'    => $admin_id,
            'first_name'  => $name,
            'role'        => $role,
            'created_at'  => $comment['created_at']
        ];
    }

    return $results;
}
if (!function_exists('getUserIcon')) {
    function getUserIcon($student_id, $teacher_id, $admin_id)
    {
        if (!empty($student_id) && $student_id != 0) {
            return '<i class="picons-thin-icon-thin-0704_users_profile_group_couple_man_woman text-secondary" title="Student"></i> ';
        } elseif (!empty($teacher_id) && $teacher_id != 0) {
            return '<i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate text-primary" title="Teacher"></i> ';
            
        } elseif (!empty($admin_id) && $admin_id != 0) {
            return '<i class="os-icon picons-thin-icon-thin-0047_home_flat text-success" title="Admin"></i> ';
            
        } else {
            return ''; // atau bisa juga return default icon
        }
    }
}
if (!function_exists('hasReacted')) {
    function hasReacted($table, $content_id, $id_user)
    {
        $ci = &get_instance();

        $table_id_fields = [
            'news_reactions'     => 'news_id',
            'document_reactions' => 'document_id',
            'forum_reactions'    => 'forum_id',
            'homework_reactions' => 'homework_id',
        ];
        if (!isset($table_id_fields[$table])) {
            return false; 
        }

        $content_id_field = $table_id_fields[$table];
        $ci->db->from($table);
        $ci->db->where($content_id_field, $content_id);
        $login_type = $ci->session->userdata('login_type');
        switch ($login_type) {
            case 'student':
                $ci->db->where('student_id',$id_user);
                break;
            case 'teacher':
                $ci->db->where('teacher_id', $id_user);
                break;
            case 'admin':
                $ci->db->where('admin_id', $id_user);
                break;
            default:
                return false;
        }

        return $ci->db->count_all_results() > 0;
    }
}
function give_reaction($content_id, $reaction_id, $table)
    {
        $ci = &get_instance();

        $table_id_fields = [
            'news_reactions'     => 'news_id',
            'document_reactions' => 'document_id',
            'forum_reactions'    => 'forum_id',
            'homework_reactions' => 'homework_id',
        ];

        if (!isset($table_id_fields[$table])) {
            return false;
        }

        $content_field = $table_id_fields[$table];
        $user_id   = $ci->session->userdata('login_user_id');
        $user_type = $ci->session->userdata('login_type');
        $user_field = "{$user_type}_id";

        if (!in_array($user_field, ['admin_id', 'teacher_id', 'student_id'])) {
            return false;
        }
        $dataInsert = [
            $content_field   => $content_id,
            'reaction_id'    => $reaction_id,
            'student_id'     => 0,
            'teacher_id'     => 0,
            'admin_id'       => 0,
            'created_at'     => date('Y-m-d H:i:s'),
        ];

        $dataInsert[$user_field] = $user_id;
        $ci->db->where($content_field, $content_id);
        $ci->db->where($user_field, $user_id);
        $query = $ci->db->get($table);

        if ($query->num_rows() > 0) {
            // Update
            $ci->db->where($content_field, $content_id);
            $ci->db->where($user_field, $user_id);
            return $ci->db->update($table, [
                'reaction_id' => $reaction_id,
                'created_at'  => date('Y-m-d H:i:s')
            ]);
        } else {
            // Insert
            return $ci->db->insert($table, $dataInsert);
        }
    }
    function post_comment($content_id, $comment_text, $table)
    {
        $ci = &get_instance();

        $table_id_fields = [
            'news_comments'     => 'news_id',
            'document_comments' => 'document_id',
            'forum_comments'    => 'forum_id',
            'homework_comments' => 'homework_id',
        ];

        if (!isset($table_id_fields[$table])) return false;

        $content_field = $table_id_fields[$table];
        $user_id   = $ci->session->userdata('login_user_id');
        $user_type = $ci->session->userdata('login_type');
        $user_field = "{$user_type}_id";

        if (!in_array($user_field, ['admin_id', 'teacher_id', 'student_id'])) return false;

        $data = [
            $content_field   => $content_id,
            'comments'        => $comment_text,
            'student_id'     => 0,
            'teacher_id'     => 0,
            'admin_id'       => 0,
            'created_at'     => date('Y-m-d H:i:s'),
        ];
        $data[$user_field] = $user_id;

        return $ci->db->insert($table, $data);
    }
    function timeElapsed($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7); // optional: weeks
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];
        
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }










