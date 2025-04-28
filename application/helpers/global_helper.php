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
            'subject_id'=>$subjectId
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
    function getFinalMark($student_id, $subject_id,$exam_id, $year)
    {
        $ci = &get_instance();
        $avg = $ci->db->get_where('mark', array('subject_id' => $subject_id, 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $year))->row()->final;
        return $avg;
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



