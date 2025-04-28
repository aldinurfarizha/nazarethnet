<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Teacher extends EduAppGT
{
    /*
        Software: EduAppGT PRO - School Management System
        Author: GuateApps - Software, Web and Mobile developer.
        Author URI: https://guateapps.app.
        PHP: 5.6+
        Created: 27 September 16.
    */
    private $runningYear = '';
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        $this->runningYear = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    }
    
    //Manage marks(competences - capacities)
    function manage_marks($param1 = '', $datainfo = '', $exam_id = '', $orden = '', $foreign_id = '')
    {
        if ($this->session->userdata('teacher_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'new_activity')
        {
            $this->mark->newActivity($datainfo, $exam_id);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_created'));
        }
        if ($param1 == 'edit_capacities')
        {
            $this->mark->updateActivity($foreign_id);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        }
        if ($param1 == 'delete_capacity')
        {
            $this->mark->delete_capacity($foreign_id, $orden);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
        }
        redirect(base_url() . 'teacher/upload_marks/' . $datainfo . '/' . $exam_id . '/' . $orden . '/', 'refresh');
    }
    
    //Update marks function.
    function notas_update($datainfo = '', $exam_id = '', $orden = '')
    {
        $this->mark->notasUpdate($datainfo, $exam_id, $orden);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'teacher/upload_marks/' . $datainfo . '/' . $exam_id . '/' . $orden . '/', 'refresh');
    }
    
    function team_conferences($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']           = 'team_conferences';
        $page_data['page_title']          = getEduAppGTLang('team_conferences');
        $this->load->view('backend/index', $page_data);
    }
    
    function upload_video($video_name)
    {
        move_uploaded_file($_FILES["video"]["tmp_name"], "public/uploads/homework/video/" . $video_name.'.mp4');
        $fileURL = "public/uploads/homework/video/" . $video_name.'.mp4';
        echo $fileURL;
    }

    function upload_audio($audio_name)
    {
        move_uploaded_file($_FILES["audio"]["tmp_name"],"public/uploads/homework/audio/" . $audio_name.'.mp3');
        $fileURL = "public/uploads/homework/audio/" . $audio_name.'.mp3';
        echo $fileURL;
    }

    function create_homework($data = '')
    {
        $this->isTeacher();
        $page_data['data'] = $data;
        $page_data['page_name']  = 'create_homework';
        $page_data['page_title'] = getEduAppGTLang('create_homework');
        $this->load->view('backend/index', $page_data);
    }
    
    function team_live($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['team_conference_id']  = $param1;
        $page_data['page_name']                     = 'team_live';
        $page_data['page_title']                    = getEduAppGTLang('team_live');
        $this->load->view('backend/teacher/team_live' , $page_data);
    }
    
    function new_online_course($data = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']  = 'new_online_course';
        $page_data['page_title'] = getEduAppGTLang('new_online_course');
        $this->load->view('backend/index', $page_data);
    }
    
    function watch($param1= '', $param2= '') 
    { 
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }   
        
        $page_data['online_course_id']    = $param1;
        $page_data['page_name']           = 'watch';
        $page_data['page_title']          = getEduAppGTLang('watch');
        $this->load->view('backend/index', $page_data);
    }
    
    function quiz_contest($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_course_id']    = $param1;
        $page_data['quiz_id']             = $param2;
        $page_data['lesson_id']           = $param3;
        $page_data['page_name']           = 'quiz_contest';
        $page_data['page_title']          = getEduAppGTLang('quiz_contest');
        $this->load->view('backend/index', $page_data);
    }

    function get_subjects($class_id)
    {
        $subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        foreach ($subjects as $row) 
        {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function get_sectionss($class_id)
    {
        $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
        foreach ($sections as $row) 
        {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

     function view_lesson($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        if($param1 == "download")
        {
            $file_name = $this->db->get_where('lesson_online', array('lesson_online_id' => $param3))->row()->attachment;
            $this->load->helper('download');
            $info = file_get_contents("public/uploads/online_course_file/" . $file_name);
            $name = $file_name;
            force_download($name, $info);
        }
        
        $page_data['type']                = $param1;
        $page_data['online_course_id']    = $param2;
        $page_data['lesson_id']           = $param3;
        $page_data['page_name']           = 'view_lesson';
        $page_data['page_title']          = getEduAppGTLang('view_lesson');
        $this->load->view('backend/index', $page_data);
    }
    
    function lessons($param1 = '', $param2 = '') 
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if($param1 == 'create_section'){
            $sections = $this->db->get_where('online_course', array('online_course_id'=>$this->input->post('online_course_id')))->row()->section;
            $data['name']               =  $this->input->post('title_section');
            $data['online_course_id']   =  $this->input->post('online_course_id');
            $this->db->insert('section_online',$data);
            
            $data2['section']  = $sections+1;
            $this->db->where('online_course_id',$this->input->post('online_course_id'));
            $this->db->update('online_course',$data2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/lessons/'.$this->input->post('online_course_id') , 'refresh');
        }
        if($param1 == 'update_section'){
            $idd = $this->db->get_where('section_online', array('section_online_id'=>$param2))->row()->online_course_id;
            $data['name']   =  $this->input->post('title_section');
            $this->db->where('section_online_id',$param2);
            $this->db->update('section_online',$data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
        }
        if($param1 == 'delete_section'){
            $idd = $this->db->get_where('section_online', array('section_online_id'=>$param2))->row()->online_course_id;
            $section = $this->db->get_where('online_course', array('online_course_id' => $idd))->row()->section;
            
            $data['section']  =   $section-1;
            $this->db->where('online_course_id',$idd);
            $this->db->update('online_course',$data);
            
            $this->db->where('section_online_id',$param2);
            $this->db->delete('section_online');
            
            $this->db->where('section_online_id',$param2);
            $this->db->delete('lesson_online');
            
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_eliminated'));
            redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
        }
        if($param1 == 'create_lesson')
        {
            $lessons                    = $this->db->get_where('online_course', array('online_course_id'=>$param2))->row()->lesson;
            $md5                        = md5(date('d-m-Y H:i:s'));
            
            $data['section_online_id']  = $this->input->post('section_online_id');
            $data['type']               = $this->input->post('type');
            $data['name']               = $this->input->post('title_lesson');
            
            if($this->input->post('type') == 'text' || $this->input->post('type') == 'pdf' || $this->input->post('type') == 'document' || $this->input->post('type') == 'image')
            {
                $data['attachment']         =  $md5.$_FILES['attachment']['name'];
                $data['summary']            =  $this->input->post('summary');
                $this->db->insert('lesson_online',$data);
                move_uploaded_file($_FILES['attachment']['tmp_name'], 'public/uploads/online_course_file/' .$md5.str_replace(' ', '', $_FILES['attachment']['name']));
                
                $data2['lesson']  = $lessons+1;
                $this->db->where('online_course_id',$param2);
                $this->db->update('online_course',$data2);
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/lessons/'.$param2, 'refresh');
            }
            
            if($this->input->post('type') == 'videos')
            {
                if($this->input->post('provider') == 'youtube'){
                    $data['name_video']         = $this->input->post('embed');
                    $data['url']                = $this->input->post('url_youtube');
                    $data['duration']           = $this->input->post('duration_youtube');
                    $data['section_online_id']  = $this->input->post('section_online_id');
                    $data['summary']            = $this->input->post('summary');
                    $data['type_video']         = 'youtube';
                    $this->db->insert('lesson_online',$data);
                    $data2['lesson']  = $lessons+1;
                    $this->db->where('online_course_id',$param2);
                    $this->db->update('online_course',$data2);
                    $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'teacher/lessons/'.$param2, 'refresh');
                }
                if($this->input->post('provider') == 'vimeo'){
                    $data['name_video']         = substr(parse_url($this->input->post('url_vimeo'), PHP_URL_PATH), 1);
                    $data['url']                = $this->input->post('url_vimeo');
                    $data['duration']           = $this->input->post('duration_vimeo');
                    $data['section_online_id']  = $this->input->post('section_online_id');
                    $data['summary']            = $this->input->post('summary');
                    $data['type_video']         = 'vimeo';
                    $this->db->insert('lesson_online',$data);
                    $data2['lesson']  = $lessons+1;
                    $this->db->where('online_course_id',$param2);
                    $this->db->update('online_course',$data2);
                    $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'teacher/lessons/'.$param2, 'refresh');
                }
                if($this->input->post('provider') == 'html5'){
                    $data['url']                =  $this->input->post('url_html');
                    $data['duration']           =  $this->input->post('duration_html');
                    $data['section_online_id']  =  $this->input->post('section_online_id');
                    $data['image_video']        =  $md5.$_FILES['image']['name'];
                    $data['summary']            =  $this->input->post('summary');
                    $data['type_video']         = 'html5';
                    $this->db->insert('lesson_online',$data);
                    move_uploaded_file($_FILES['image']['tmp_name'], 'public/uploads/online_course_image/' .$md5.str_replace(' ', '', $_FILES['image']['name']));
                    $data2['lesson']  = $lessons+1;
                    $this->db->where('online_course_id',$param2);
                    $this->db->update('online_course',$data2);
                    $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'teacher/lessons/'.$param2, 'refresh');
                }
                if($this->input->post('provider') == 'local'){
                    $data['name_video']         =  $md5.$_FILES['video_local']['name'];
                    $data['section_online_id']  =  $this->input->post('section_online_id');
                    $data['duration']           =  $this->input->post('duration_local');
                    $data['image_video']        =  $md5.$_FILES['image_local']['name'];
                    $data['summary']            =  $this->input->post('summary');
                    $data['type_video']         = 'local';
                    $this->db->insert('lesson_online',$data);
                    move_uploaded_file($_FILES['video_local']['tmp_name'], 'public/uploads/online_course_video/' .$md5.str_replace(' ', '', $_FILES['video_local']['name']));
                    move_uploaded_file($_FILES['image_local']['tmp_name'], 'public/uploads/online_course_image/' .$md5.str_replace(' ', '', $_FILES['image_local']['name']));
                    
                    $data2['lesson']  = $lessons+1;
                    $this->db->where('online_course_id',$param2);
                    $this->db->update('online_course',$data2);
                    $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'teacher/lessons/'.$param2, 'refresh');
                }
            }
        }
        if($param1 == 'lesson_change')
        {
            if($this->input->post('submit') == 'update')
            {
                $sec_id                     = $this->db->get_where('lesson_online', array('lesson_online_id'=>$param2))->row()->section_online_id;
                $idd                        = $this->db->get_where('section_online', array('section_online_id'=>$sec_id))->row()->online_course_id;
                $md5                        = md5(date('d-m-Y H:i:s'));
                $data['section_online_id']  = $this->input->post('section_online_id');
                $data['type']               = $this->input->post('type');
                $data['name']               = $this->input->post('title_lesson');
                if($this->input->post('type') == 'text' || $this->input->post('type') == 'pdf' || $this->input->post('type') == 'document' || $this->input->post('type') == 'image')
                {
                    if($_FILES['attachment']['size']>0)
                    {
                        $data['attachment']         =  $md5.$_FILES['attachment']['name'];
                    }
                    $data['summary']            =  $this->input->post('summary');
                    $this->db->where('lesson_online_id',$param2);
                    $this->db->update('lesson_online',$data);
                    if($_FILES['attachment']['size']>0)
                    {
                        move_uploaded_file($_FILES['attachment']['tmp_name'], 'public/uploads/online_course_file/' .$md5.str_replace(' ', '', $_FILES['attachment']['name']));
                    }
                    $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_update'));
                    redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
                }
                
                if($this->input->post('type') == 'videos')
                {
                    if($this->input->post('provider') == 'youtube'){
                        $data['name_video']         = $this->input->post('embed');
                        $data['url']                = $this->input->post('url_youtube');
                        $data['duration']           = $this->input->post('duration_youtube');
                        $data['section_online_id']  = $this->input->post('section_online_id');
                        $data['summary']            = $this->input->post('summary');
                        $data['type_video']         = 'youtube';
                        $this->db->where('lesson_online_id',$param2);
                        $this->db->update('lesson_online',$data);
                       
                        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
                    }
                    
                    if($this->input->post('provider') == 'vimeo'){
                        $data['name_video']         = substr(parse_url($this->input->post('url_vimeo'), PHP_URL_PATH), 1);
                        $data['url']                = $this->input->post('url_vimeo');
                        $data['duration']           = $this->input->post('duration_vimeo');
                        $data['section_online_id']  = $this->input->post('section_online_id');
                        $data['summary']            = $this->input->post('summary');
                        $data['type_video']         = 'vimeo';
                        $this->db->where('lesson_online_id',$param2);
                        $this->db->update('lesson_online',$data);
                       
                        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
                    }
                    
                    if($this->input->post('provider') == 'html5'){
                        $data['url']                =  $this->input->post('url_html');
                        $data['duration']           =  $this->input->post('duration_html');
                        $data['section_online_id']  =  $this->input->post('section_online_id');
                        if($_FILES['image']['size'] > 0){
                            $data['image_video']        =  $md5.$_FILES['image']['name'];}
                        $data['summary']            =  $this->input->post('summary');
                        $data['type_video']         = 'html5';
                        $this->db->where('lesson_online_id',$param2);
                        $this->db->update('lesson_online',$data);
                        
                        if($_FILES['image']['size'] > 0){
                        move_uploaded_file($_FILES['image']['tmp_name'], 'public/uploads/online_course_image/' .$md5.str_replace(' ', '', $_FILES['image']['name']));}
                        
                        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
                    }
                    
                    if($this->input->post('provider') == 'local'){
                       
                        $data['section_online_id']  =  $this->input->post('section_online_id');
                        $data['duration']           =  $this->input->post('duration_local');
                        $data['summary']            =  $this->input->post('summary');
                        $data['type_video']         = 'local';
                        if($_FILES['image_local']['name'] > 0){
                        $data['image_video']        =  $md5.$_FILES['image_local']['name'];}
                        if($_FILES['video_local']['name'] > 0){
                        $data['name_video']         =  $md5.$_FILES['video_local']['name'];}
                        $this->db->where('lesson_online_id',$param2);
                        $this->db->update('lesson_online',$data);
                        
                        if($_FILES['image_local']['size'] > 0){
                        move_uploaded_file($_FILES['image_local']['tmp_name'], 'public/uploads/online_course_image/' .$md5.str_replace(' ', '', $_FILES['image_local']['name']));}
                        if($_FILES['video_local']['size'] > 0){
                        move_uploaded_file($_FILES['video_local']['tmp_name'], 'public/uploads/online_course_video/' .$md5.str_replace(' ', '', $_FILES['video_local']['name']));}
                        
                        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
                    }
                }
            }
            
            if($this->input->post('submit') == 'delete')
            {
                $sec_id = $this->db->get_where('lesson_online', array('lesson_online_id'=>$param2))->row()->section_online_id;
                $idd = $this->db->get_where('section_online', array('section_online_id'=>$sec_id))->row()->online_course_id;
                $lessons = $this->db->get_where('online_course', array('online_course_id' => $idd))->row()->lesson;
                $data['lesson']  =   $lessons-1;
                $this->db->where('online_course_id',$idd);
                $this->db->update('online_course',$data);
                $this->db->where('lesson_online_id',$param2);
                $this->db->delete('lesson_online');
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_eliminated'));
                redirect(base_url() . 'teacher/lessons/'.$idd, 'refresh');
            }
        }
        if($param1 == 'create_quiz'){
            
            $data['title']              =  $this->input->post('title_quiz');           
            $data['section_online_id']  =  $this->input->post('section_online_id');
            $data['online_course_id']   =  $this->input->post('online_course_id');
            $data['instruction']        =  $this->input->post('instruction');
            $this->db->insert('quiz',$data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/lessons/'.$this->input->post('online_course_id'), 'refresh');
        
        }
        if($param1 == 'change_quiz')
        {
            if($this->input->post('submit') == 'delete')
            {
                $this->db->where('quiz_id',$param2);
                $this->db->delete('quiz');
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
                redirect(base_url() . 'teacher/lessons/'.$this->input->post('online_course_id'), 'refresh');
            }
            if($this->input->post('submit') == 'update')
            {
                $data['title']              =  $this->input->post('title_quiz');           
                $data['section_online_id']  =  $this->input->post('section_online_id');
                $data['instruction']        =  $this->input->post('instruction');
                $this->db->where('quiz_id',$param2);
                $this->db->update('quiz',$data);
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_update'));
                redirect(base_url() . 'teacher/lessons/'.$this->input->post('online_course_id'), 'refresh');
            }
        }
        if($param1 == 'create_question')
        {
            $course_id = $this->db->get_where('quiz', array('quiz_id'=>$this->input->post('quiz_id')))->row()->online_course_id;
            if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
                $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
                return;
            }
            foreach ($this->input->post('options') as $option) {
                if ($option == "") {
                    $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
                    return;
                }
            }
            if (sizeof($this->input->post('correct_answers')) == 0) {
                $correct_answers = [""];
            }
            else{
                $correct_answers = $this->input->post('correct_answers');
            }
            $data['quiz_id']            = $this->input->post('quiz_id');
            $data['question_title']     = html_escape($this->input->post('question_title'));
            $data['mark']               = html_escape($this->input->post('mark'));
            $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
            $data['options']            = json_encode($this->input->post('options'));
            $data['correct_answers']    = json_encode($correct_answers);
            $this->db->insert('quiz_bank', $data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/lessons/'.$course_id, 'refresh');
        }
        if($param1 == 'update_question')
        {
            $quiz_id   = $this->db->get_where('quiz_bank', array('quiz_bank_id' => $param2))->row()->quiz_id;
            $course_id = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row()->online_course_id;
            foreach ($this->input->post('options') as $option) {
                if ($option == "") {
                    $this->session->set_flashdata('error_message' , getEduAppGTLang('no_options_can_be_blank'));
                    return;
                }
            }
            if (sizeof($this->input->post('correct_answers')) == 0) {
                $correct_answers = [""];
            }
            else{
                $correct_answers = $this->input->post('correct_answers');
            }
            $data['question_title']     = html_escape($this->input->post('question_title'));
            $data['mark']               = html_escape($this->input->post('mark'));
            $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
            $data['options']            = json_encode($this->input->post('options'));
            $data['correct_answers']    = json_encode($correct_answers);
            $this->db->where('quiz_bank_id', $param2);
            $this->db->update('quiz_bank', $data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/lessons/'.$course_id, 'refresh');
            
        }
        if($param1 == 'delete_question')
        {
            $quiz_id   = $this->db->get_where('quiz_bank', array('quiz_bank_id' => $param2))->row()->quiz_id;
            $course_id = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row()->online_course_id;
            
            $this->db->where('quiz_bank_id', $param2);
            $this->db->delete('quiz_bank');
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/lessons/'.$course_id, 'refresh');
        }
        $page_data['course_id']             = $param1;
        $page_data['page_name']             = 'lessons';
        $page_data['page_title']            = getEduAppGTLang('lessons');
        $this->load->view('backend/index', $page_data);
    }
    
    function update_online_course($param1 = '')
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        
        $md5                   =  md5(date('d-m-y H:i:s'));
       
        if($this->input->post('type') == 'local' && $_FILES['video']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['video']['name']);
            move_uploaded_file($_FILES['video']['tmp_name'], 'public/uploads/online_course_video/' . $md5.str_replace(' ', '', $_FILES['video']['name']));
        }
        
        if($this->input->post('type') == 'vimeo' && $_FILES['imgVimeo']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgVimeo']['name']);
            move_uploaded_file($_FILES['imgVimeo']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgVimeo']['name']));
        }
        if($this->input->post('type') == 'local' && $_FILES['imgLocal']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgLocal']['name']);
            move_uploaded_file($_FILES['imgLocal']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgLocal']['name']));
        }
        if($this->input->post('type') == 'youtube' && $_FILES['imgYoutube']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgYoutube']['name']);
            move_uploaded_file($_FILES['imgYoutube']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgYoutube']['name']));
        }
        if($this->input->post('type') == 'hmtl5' && $_FILES['imgHtml5']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgHtml5']['name']);
            move_uploaded_file($_FILES['imgHtml5']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgHtml5']['name']));
        }
        
        $data['title']         = html_escape($this->input->post('title'));
        $data['class_id']      = $this->input->post('class_id');
        $data['section_id']    = $this->input->post('section_id');
        $data['subject_id']    = $this->input->post('subject_id');
        $data['outcomes']      = $this->input->post('outcomes');
        $data['user']          = $this->session->userdata('login_type');
        $data['user_id']       = $this->session->userdata('login_user_id');
        $data['provider']      = $this->input->post('type');
        $data['embed']         = $this->input->post('embed');
        $data['description']   = $this->input->post('description');
        if($this->input->post('type') == 'html5' && $this->input->post('url_html5') != ""){
            $data['url_video']          = $this->input->post('url_html5');
        }
        if($this->input->post('type') == 'vimeo' && $this->input->post('url_vimeo') != ""){
            $data['url_video']          = $this->input->post('url_vimeo');
        }
        
        if($this->input->post('type') == 'youtube' && $this->input->post('url_youtube') != ""){
            $data['url_video']          = $this->input->post('url_youtube');
        }
        
        if($this->input->post('type') == 'local' && $_FILES['video']['name'] != ""){
            $data['url_video']          = $md5.str_replace(' ', '', $_FILES['video']['name']);
        }
        if($this->input->post('type') == 'vimeo' && $_FILES['imgVimeo']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgVimeo']['name']);
        }
        if($this->input->post('type') == 'local' && $_FILES['imgLocal']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgLocal']['name']);
        }
        if($this->input->post('type') == 'youtube' && $_FILES['imgYoutube']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgYoutube']['name']);
        }
        if($this->input->post('type') == 'html5' && $_FILES['imgHtml5']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgHtml5']['name']);
        }
        $this->db->where('online_course_id', $param1);
        $this->db->update('online_course', $data);
        
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        redirect(base_url().'teacher/online_courses/', 'refresh');
    }
    
    function create_online_course()
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $md5                   =  md5(date('d-m-y H:i:s'));
        $year                  =  $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        if($_FILES['video']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['video']['name']);
            move_uploaded_file($_FILES['video']['tmp_name'], 'public/uploads/online_course_video/' . $md5.str_replace(' ', '', $_FILES['video']['name']));
        }
        
        if($_FILES['imgVimeo']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgVimeo']['name']);
            move_uploaded_file($_FILES['imgVimeo']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgVimeo']['name']));
        }
        if($_FILES['imgLocal']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgLocal']['name']);
            move_uploaded_file($_FILES['imgLocal']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgLocal']['name']));
        }
        if($_FILES['imgYoutube']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgYoutube']['name']);
            move_uploaded_file($_FILES['imgYoutube']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgYoutube']['name']));
        }
        if($_FILES['imgHtml5']['size'] > 0)
        {
            $md5.str_replace(' ', '', $_FILES['imgHtml5']['name']);
            move_uploaded_file($_FILES['imgHtml5']['tmp_name'], 'public/uploads/online_course_image/' . $md5.str_replace(' ', '', $_FILES['imgHtml5']['name']));
        }
        
        
        $data['publish_date']  = date('Y-m-d H:i:s');
        $data['title']         = html_escape($this->input->post('title'));
        $data['class_id']      = $this->input->post('class_id');
        $data['section_id']    = $this->input->post('section_id');
        $data['subject_id']    = $this->input->post('subject_id');
        $data['outcomes']      = $this->input->post('outcomes');
        $data['status']        = 0;
        $data['lesson']        = 0;
        $data['section']       = 0;
        $data['user']          = $this->session->userdata('login_type');
        $data['user_id']       = $this->session->userdata('login_user_id');
        $data['provider']      = $this->input->post('type');
        
        $data['embed']         = $this->input->post('embed');
        $data['description']   = $this->input->post('description');
        if($this->input->post('url_html5') != ""){
            $data['url_video']          = $this->input->post('url_html5');
        }
        
        if($this->input->post('url_vimeo') != ""){
            $data['url_video']          = $this->input->post('url_vimeo');
        }
        
        if($this->input->post('url_youtube') != ""){
            $data['url_video']          = $this->input->post('url_youtube');
        }
        
        if($_FILES['video']['name'] != ""){
            $data['url_video']          = $md5.str_replace(' ', '', $_FILES['video']['name']);
        }
        if($_FILES['imgVimeo']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgVimeo']['name']);
        }
        if($_FILES['imgLocal']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgLocal']['name']);
        }
        if($_FILES['imgYoutube']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgYoutube']['name']);
        }
        if($_FILES['imgHtml5']['name'] != ""){
            $data['thumbnail']          = $md5.str_replace(' ', '', $_FILES['imgHtml5']['name']);
        }
        $data['year']          = $year;
        $this->db->insert('online_course', $data);
        
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        redirect(base_url().'teacher/online_courses/', 'refresh');
    }
    
    function online_courses($param1 = '', $param2 = '', $param3 ='') 
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if($param1 == 'delete')
        {
            $this->db->where('online_course_id', $param2);
            $this->db->delete('online_course');
            redirect(base_url() . 'teacher/online_courses/', 'refresh');
        }
        if($param1 == 'active')
        {
            $data['status']  =  1;
            $this->db->where('online_course_id', $param2);
            $this->db->update('online_course', $data);
            redirect(base_url() . 'teacher/online_courses/', 'refresh');
        }
        if($param1 == 'inactive')
        {
            $data['status']  =  0;
            $this->db->where('online_course_id', $param2);
            $this->db->update('online_course', $data);
            redirect(base_url() . 'teacher/online_courses/', 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['page_name']  = 'online_courses';
        $page_data['page_title'] = getEduAppGTLang('online_courses');
        $this->load->view('backend/index', $page_data);
    }
    
    function gamification($data = '', $page = '', $param3 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        if($data == 'update_level'){
            $insert_data['point']           = $this->input->post('require');
            $insert_data['description']     = $this->input->post('description');
            $this->db->where('id', $page);
            $this->db->update('gamification', $insert_data);
            
            $base = base64_encode($this->input->post('class_id').'-'.$this->input->post('section_id').'-'.$this->input->post('subject_id'));
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url().'teacher/gamification/'.$base.'/levels/', 'refresh');
        }
        if($data == 'update_settings'){
            $info = base64_decode($page);
            $ex = explode('-', $info);
        
            $insert_data['levels']              = $this->input->post('levels');
            $insert_data['addon_title']         = $this->input->post('addon_title');
            $insert_data['addon_description']   = $this->input->post('addon_description');
            $insert_data['gamification']        = $this->input->post('gamification');
            $this->db->where('subject_id', $ex[2]);
            $this->db->update('subject', $insert_data);
            
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url().'teacher/gamification/'.$page.'/settings/', 'refresh');
        }
        if($data == 'delete'){
            $info = base64_decode($page);
            $ex = explode('-', $info);
            $this->db->where('section_id', $ex[1]);
            $this->db->where('class_id', $ex[0]);
            $this->db->where('subject_id', $ex[2]);
            $this->db->where('student_id', $param3);
            $this->db->delete('student_gamification');
            
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url().'teacher/gamification/'.$page.'/', 'refresh');
        }
        if($data == 'update_rules'){
            $info = base64_decode($page);
            $ex = explode('-', $info);
        
            $insert_data['online_exam']         = $this->input->post('online_exam');
            $insert_data['homework']            = $this->input->post('homework');
            $insert_data['forum']               = $this->input->post('forum');
            $insert_data['live_class']          = $this->input->post('live_class');
            $this->db->where('subject_id', $ex[2]);
            $this->db->update('subject', $insert_data);
            
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url().'teacher/gamification/'.$page.'/rules/', 'refresh');
        }
        $info = base64_decode($data);
        $ex = explode('-', $info);
        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
        $query = $this->db->get_where('gamification', array('class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $year));
        if($query->num_rows() == 0){
            for($i = 1; $i <= 10; $i++){
                $insert_data['class_id']   = $ex[0];
                $insert_data['section_id'] = $ex[1];
                $insert_data['subject_id'] = $ex[2];   
                $insert_data['year']       = $year;
                $insert_data['point']      = 0;
                $insert_data['level']      = $i;
                $this->db->insert('gamification', $insert_data);
            }
        }
        $page_data['data'] = $data;
        $page_data['page'] = $page;
        $page_data['page_name']  = 'gamification';
        $page_data['page_title'] = getEduAppGTLang('gamification');
        $this->load->view('backend/index', $page_data);
    }   
    
    function uploadPDF()
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        if($this->input->post('file_name') != ''){
            $info['edited_file_name'] = 'edited-'.$this->input->post('file_name');
        }
        $info['edited']           = 1;
        $this->db->where('fhomework_file_id', $this->input->post('fhomework_file_id'));
        $this->db->update('homework_files', $info);
        move_uploaded_file($_FILES['pdf']['tmp_name'], 'public/uploads/homework_delivery/edited/edited-'.$info['edited_file_name']);
    }

    function annotator($fileID = '', $homeworkCode = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['fileID']  = $fileID;
        $page_data['homework_code']  = $homeworkCode;
        $this->load->view('backend/teacher/annotator', $page_data);
    }
    
    function whiteboards($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param1;
        $page_data['page_name']  = 'whiteboards';
        $page_data['page_title'] = getEduAppGTLang('whiteboards');
        $this->load->view('backend/index', $page_data);
    }
    
    function new_whiteboard($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param1;
        $page_data['page_title'] = getEduAppGTLang('new_whiteboard');
        $this->load->view('backend/teacher/new_whiteboard' , $page_data);
    }
    
    function view_whiteboard($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('teacher_login') != 1)
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param2;
        $page_data['board_id']  = $param1;
        $page_data['page_title'] = getEduAppGTLang('view_whiteboard');
        $this->load->view('backend/teacher/view_whiteboard' , $page_data);
    }
    
    function deleteBoard($param1 = '', $param2 = '')
    {
        $this->db->where('board_id',$param1);
        $this->db->delete('boards');
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'teacher/whiteboards/'.$param2, 'refresh');
    }
    
    function saveboard()
    {
        $info = base64_decode($this->input->post('data'));
        $ex = explode('-', $info);

        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['board_data'] = $this->input->post('board');
        $data['board_title']= $this->input->post('board_name');
        $data['year']       = date('Y');
        $data['date']       = date('Y-m-d H:i');
        $this->db->insert('boards',$data);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'teacher/whiteboards/'.$this->input->post('data'), 'refresh');
    }

    //Live class function.
    function live($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        $page_data['zoom_id']    = $param1;
        $page_data['page_title'] = getEduAppGTLang('live');
        $this->load->view('backend/teacher/live' , $page_data);
    }
    
    //Delete student delivey
    function delete_delivery($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 != ''){
            $this->academic->deleteDelivery($param1);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/homework_details/'.$param2.'/', 'refresh');
        }
    }

    //Live classes function.
    function meet($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        if($param1 == 'create')
        {
            $data['title']            = $this->input->post('title');
            $data['meeting_id']       = $this->input->post('zoom_meeting_id');
            $data['meeting_password'] = $this->input->post('zoom_meeting_password');
            $data['class_id']         = $this->input->post('class_id');
            $data['section_id']       = $this->input->post('section_id');
            $data['subject_id']       = $this->input->post('subject_id');
            $data['exp']              = $this->input->post('exp');
            $data['user_type']        = $this->session->userdata('login_type');
            $data['user_id']          = $this->session->userdata('login_user_id');
            $data['year']             = $this->runningYear;
            $data['wall_type']        = 'live';
            $data['publish_date']     = date('Y-m-d H:i:s');
            $data['upload_date']      = date('d M. H:iA');
            $data['date']             = $this->input->post('start_date');
            $data['description']      = $this->input->post('description');
            $data['start_time']       = $this->input->post('start_time');
            $data['end_time']         = $this->input->post('end_time');
            $this->db->insert('zoom',$data);  
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/meet/'.$param2, 'refresh');
        }
        if($param1 == 'update')
        {
            $data['title']            = $this->input->post('title');
            $data['meeting_id']       = $this->input->post('zoom_meeting_id');
            $data['exp']              = $this->input->post('exp');
            $data['meeting_password'] = $this->input->post('zoom_meeting_password');
            $data['description']      = $this->input->post('description');
            $data['date']             = $this->input->post('start_date');
            $data['start_time']       = $this->input->post('start_time');
            $data['end_time']         = $this->input->post('end_time');
            $this->db->where('zoom_id', $param2);
            $this->db->update('zoom',$data);  
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/meet/'.$param3, 'refresh');
        }
        if($param1 == 'delete')
        {
            $this->db->where('zoom_id', $param2);
            $this->db->delete('zoom');
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/meet/'.$param3, 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet';
        $page_data['page_title'] = getEduAppGTLang('meet');
        $this->load->view('backend/index', $page_data);
    }

    //Online exam result function.
    function online_exam_result($param1 = '', $param2 = '') 
    {
        $this->isTeacher();
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = getEduAppGTLang('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    //Index function.
    public function index()
    {
        if($this->session->userdata('teacher_login') != 1) 
        {
            redirect(base_url(), 'refresh');
        }else{
            redirect(base_url().'teacher/panel/', 'refresh');
        }
    }
    
    //Manage online exam status function.
    function manage_online_exam_status($online_exam_id = "", $status = "", $data = '')
    {
        $this->crud->manage_online_exam_status($online_exam_id, $status);
        redirect(base_url() . 'teacher/online_exams/'.$data."/", 'refresh');
    }
    
    //Create exam function.
    function new_exam($data = '')
    {
        $this->isTeacher();
        $page_data['data'] = $data;
        $page_data['page_name']  = 'new_exam';
        $page_data['page_title'] = getEduAppGTLang('homework_details');
        $this->load->view('backend/index', $page_data);
    }
    
    //Teacher dashboard function.
    function panel()
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if(html_escape($_GET['id']) != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = getEduAppGTLang('dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Classes function.
    function grados($param1 = '', $param2 = '' , $param3 = '')
    {
        $this->isTeacher();
        $page_data['class_id']   = $class_id;
        $page_data['page_name']  = 'grados';
        $page_data['page_title'] = getEduAppGTLang('classes');
        $this->load->view('backend/index', $page_data);
    }

    //Group chat function.
    function group($param1 = "group_message_home", $param2 = "")
    {
        $this->isTeacher();
        if ($param1 == "create_group") 
        {
            $this->crud->create_group();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        }
        else if ($param1 == 'group_message_read') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        elseif ($param1 == "edit_group") 
        {
            $this->crud->update_group($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        }
        elseif($param1 == "delete_group")
        {
            $this->crud->deleteGroup($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/group/', 'refresh');
        }
        else if($param1 == 'send_reply')
        {
            $this->crud->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'teacher/group/group_message_read/'.$param2, 'refresh');
        }
        else if ($param1 == 'update_group') 
        {
            $page_data['current_message_thread_code'] = $param2;
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }

    //Marks print function.
    function marks_print_view($student_id  = '', $exam_id = '') 
    {
        $this->isTeacher();
        $class_id     = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $this->runningYear))->row()->class_id;
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/teacher/marks_print_view', $page_data);
    }
    
    //View marks function.
    function view_marks($student_id = '', $param2 = '')
    {
        $this->isTeacher();
        $class_id                 = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $this->runningYear))->row()->class_id;
        if($student_id == 'apply')
        {
            redirect(base_url().'teacher/view_marks/'.$this->input->post('student_id').'/'.$this->input->post('subject_id').'/','refresh');
        }
        $page_data['class_id']    =   $class_id;
        $page_data['subject_id']    =   $param2;
        $page_data['page_name']   = 'view_marks';
        $page_data['page_title']  = getEduAppGTLang('view_marks');
        $page_data['student_id']  = $student_id;
        $this->load->view('backend/index', $page_data);    
    }

    //Poll response function.
    function polls($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'create')
        {
            $data['question']       = $this->input->post('question');
            foreach ($this->input->post('options') as $row)
            {
                $data['options']     .= $row . ',';
            }
            $data['user']           = $this->input->post('user');
            $data['status']         = 1;
            $data['date']           = $this->crud->getDateFormat();
            $data['date2']          = date('h:i A');
            $data['admin_id']       = $this->session->userdata('login_user_id');
            $data['type']           = "polls";
            $data['publish_date']   = date('Y-m-d H:i:s');
            $data['poll_code']      = substr(md5(rand(0, 1000000)), 0, 7);
            $this->crud->send_polls_notify();
            
            if($param2 != '')
            {
                $info   = base64_decode($param2);
                $ex     = explode('-', $info);
                
                $data['class_id']           = $ex[0];
                $data['section_id']         = $ex[1];
                $data['subject_id']         = $ex[2];
                $this->db->insert('polls', $data);
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param2, 'refresh');
            }
            else
            {
                $data['class_id']           = 0;
                $data['section_id']         = 0;
                $data['subject_id']         = 0;
                $this->db->insert('polls', $data);
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if($param1 == 'create_wall')
        {
            $data['question'] = $this->input->post('question');
            foreach ($this->input->post('options') as $row)
            {
                $data['options'] .= $row . ',';
            }
            $data['user'] = $this->input->post('user');
            $data['status'] = 1;
            $data['date'] = $this->crud->getDateFormat();
            $this->crud->send_polls_notify();
            $data['date2'] = date('h:i A');
            $data['admin_id']        = $this->session->userdata('login_user_id');
            $data['type'] = "polls";
            $data['publish_date']        = date('Y-m-d H:i:s');
            $data['poll_code'] = substr(md5(rand(0, 1000000)), 0, 7);
            $this->db->insert('polls', $data);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/polls/', 'refresh');
        }
        if($param1 == 'response')
        {
            $this->crud->pollReponse();
        }
        if($param1 == 'delete')
        {
            $this->db->where('poll_code', $param2);
            $this->db->delete('polls');
            if($param3 != '')
            {
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param3, 'refresh');
            }
            else
            {
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if($param1 == 'delete2')
        {
            $this->db->where('poll_code', $param2);
            $this->db->delete('polls');
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/polls/', 'refresh');
        }
        $page_data['page_name']  = 'polls';
        $page_data['page_title'] = getEduAppGTLang('polls');
        $this->load->view('backend/index', $page_data);
    }

    //My routine function.
    function my_routine()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'my_routine';
        $page_data['page_title'] = getEduAppGTLang('teacher_routine');
        $this->load->view('backend/index', $page_data);
    }

    //Behavior report function.
    function student_report($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'send')
        {
            $this->academic->createReport();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/student_report/', 'refresh');
        }
        if($param1 == 'response')
        {
            $this->academic->reportResponse();
        }
        $page_data['page_name']  = 'student_report';
        $page_data['page_title'] = getEduAppGTLang('reports');
        $this->load->view('backend/index', $page_data);
    }

    //View behavior report function.
    function view_report($report_code = '') 
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if(html_escape($_GET['id']) != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'view_report';
        $page_data['page_title'] = getEduAppGTLang('report_details');
        $this->load->view('backend/index', $page_data);
    }
    
    //Birthdays function
    function birthdays()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }
    
    //Calendar function.
    function calendar($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = getEduAppGTLang('calendar');
        $this->load->view('backend/index', $page_data); 
    }

    //Manage news function.
    function news()
    {
        $this->isTeacher();
        if ($param1 == 'create') 
        {
            if($param2 != '')
            {
                $this->crud->create_news_dash($param2);
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param2, 'refresh');
            }
            else
            {
                $this->crud->create_news();
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if ($param1 == 'update_panel') 
        {
            $this->crud->update_panel_news($param2);
            if($param3 != '')
            {
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param3, 'refresh');
            }
            else
            {
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if ($param1 == 'create_video') 
        {
            
            if($param2 != '')
            {   
                $this->crud->create_video_dash($param2);
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param2, 'refresh');
            }
            else
            {
                $this->crud->create_video();
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if ($param1 == 'create_vimeo') 
        {
            
            if($param2 != '')
            {
                $this->crud->create_vimeo_dash($param2);
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param2, 'refresh');
            }
            else
            {
                $this->crud->create_vimeo();
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if ($param1 == 'update_news') 
        {
            $this->crud->update_panel_news($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/news/', 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->crud->delete_news($param2);
            if($param3 != '')
            {
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/subject_dashboard/'.$param3, 'refresh');
            }
            else
            {
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'teacher/panel/', 'refresh');    
            }
        }
        if ($param1 == 'delete2') 
        {
            $this->crud->delete_news($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/news/', 'refresh');
        }
        $page_data['page_name']  = 'news';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }

    //Update Subject Activity function
    function courses($param1 = '', $param2 = '' , $param3 = '')
    {
        $this->isTeacher();
        if ($param1 == 'update_labs') 
        {
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $this->academic->updateCourseActivity($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/upload_marks/'.base64_encode($class_id."-".$this->input->post('section_id')."-".$param2).'/', 'refresh');
        }
    }

    //Tabulation sheet function.
    function tab_sheet($class_id = '' , $exam_id = '', $section_id = '') 
    {
        $this->isTeacher();
        if ($this->input->post('operation') == 'selection') 
        {
            $page_data['exam_id']    = $this->input->post('exam_id');
            $page_data['section_id'] = $this->input->post('section_id');
            $page_data['class_id']   = $this->input->post('class_id');
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) 
            {
                redirect(base_url() . 'teacher/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['exam_id'] . '/' . $page_data['section_id'] , 'refresh');
            } else {
                redirect(base_url() . 'teacher/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['section_id'] = $section_id;
        $page_data['class_id']   = $class_id;
        $page_data['page_name']  = 'tab_sheet';
        $page_data['page_title'] = getEduAppGTLang('tabulation_sheet');
        $this->load->view('backend/index', $page_data);
    }

    //Print tabulation sheet function.
    function tab_sheet_print($class_id  = '', $exam_id = '', $section_id = '') 
    {
        $this->isTeacher();
        $page_data['class_id']    = $class_id;
        $page_data['exam_id']     = $exam_id;
        $page_data['section_id']  = $section_id;
        $this->load->view('backend/teacher/tab_sheet_print' , $page_data);
    }

    //Get sections by ClassId function.
    function get_class_section($class_id = '')
    {
        $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
        foreach ($sections as $row) 
        {
            echo '<option value="' . $row['section_id'].'">' . $row['name'] . '</option>';
        }
    }
    
    //Get Subjects by classId function.
    function get_class_subject($class_id = '') 
    {
        $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) 
        {
            if ($this->session->userdata('login_user_id') == $row['teacher_id'])
            {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
            }
        }
    }

    //Teachers function.
    function teacher_list($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = getEduAppGTLang('teachers');
        $this->load->view('backend/index', $page_data);
    }

    //Student list function.
    function students_area($id = '')
    {
        $this->isTeacher();
        $id = $this->input->post('class_id');
        if ($id == '')
        {
            $class=getClassByTeacher($this->session->userdata('login_user_id'));
            foreach($class as $data){
                $id=$data['class_id'];
                break;
            }
        }
        $page_data['page_name']   = 'students_area';
        $page_data['page_title']  = getEduAppGTLang('students');
        $page_data['class_id']    = $id;
        $this->load->view('backend/index', $page_data);
    }
    
    //Upload marks function.
    function upload_marks($datainfo = '', $param2 = '', $param3= '')
    {
        $this->isTeacher();
        if($param2 != ""){
                $page = $param2;
            }else{
                $info = base64_decode($datainfo);
                $ex = explode('-', $info);
                
                $query = $this->db->get_where('exam', array('section_id' => $ex[1], 'class_id' => $ex[0], 'subject_id' => $ex[2]))->first_row()->exam_id;
                if($query > 0){
                    $page = $query;
                }else{
                    $insert['section_id'] = $ex[1];
                    $insert['class_id']   = $ex[0];
                    $insert['subject_id'] = $ex[2];
                    $insert['name']       = 'First exam';
                    $this->db->insert('exam', $insert);
                    $page = $this->db->insert_id();
                }
            }
            if($param3 != ""){
                $order = $param3;
            } 
            else{
                $order = 1;
            }
            $this->mark->uploadMarks($datainfo,$page, $order);
        $this->academic->uploadMarks($datainfo,$page);
        $page_data['exam_id'] = $page;
        $page_data['order']         = $order;
        $page_data['data'] = $datainfo;
        $page_data['page_name']  =   'upload_marks';
        $page_data['page_title'] = getEduAppGTLang('upload_marks');
        $this->load->view('backend/index', $page_data);
    }
    
    //Update teacher profile.
    function teacher_update()
    {
        $this->isTeacher();
        $page_data['page_name']  = 'teacher_update';
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $page_data['output']     = $this->crud->getGoogleURL();
        $this->load->view('backend/index', $page_data);
    }
    
    //Marks update function.
    function marks_update($exam_id = '' , $class_id = '' , $section_id = '' , $subject_id = '')
    {
        $this->isTeacher();
        $info = $this->academic->updateMarks($exam_id, $class_id, $section_id, $subject_id);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
        redirect(base_url().'teacher/upload_marks/'.$info.'/'.$exam_id.'/' , 'refresh');
    }
    
    //Subject marks function.
    function subject_marks($data = '') 
    {
        $this->isTeacher();
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   = getEduAppGTLang('subject_marks');
        $this->load->view('backend/index',$page_data);
    }
    
    //Manage homeworks function.
    function homework($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        if ($param1 == 'create') 
        {
            $homework_code = $this->academic->createHomework();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/homeworkroom/' . $homework_code , 'refresh');
        }
        if($param1 == 'update')
        {
            $this->academic->updateHomework($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/homework_edit/' . $param2 , 'refresh');
        }
        if($param1 == 'review')
        {
            $this->academic->reviewHomework();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/homework_details/' . $param2 , 'refresh');
        }
        if($param1 == 'single')
        {
            $this->academic->singleHomework();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/single_homework/' . $this->input->post('id') , 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud->update_homework($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/homeworkroom/edit/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete')
        {
            $this->crud->delete_homework($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/homework/'.$param3."/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'homework';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }
    
    //Send notify function.
    function notify($param1 = '', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'send_emails')
        {
            $this->mail->teacherSendEmail();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('sent_successfully'));
            redirect(base_url() . 'teacher/notify/', 'refresh');
        }
        if($param1 == 'sms')
        {       
            $this->crud->teacherSendSMS();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('sent_successfully'));
            redirect(base_url() . 'teacher/notify/', 'refresh');
        }
        $page_data['page_name']  = 'notify';
        $page_data['page_title'] = getEduAppGTLang('notifications');
        $this->load->view('backend/index', $page_data);
    }
    
    //Subject dashboard function.
    function subject_dashboard($data = '') 
     {
         $this->isTeacher();
        if($this->db->get_where('settings' , array('type' => 'account_id'))->row()->description != ''){
            $explode = explode('-',base64_decode($data));
            $haveFolder = $this->db->get_where('subject', array('subject_id' => $explode[2]))->row()->drive_folder;
            if($haveFolder == ''){
                $this->drive_model->createSubjectFolder($explode[2]);
            }
        }
         $page_data['data'] = $data;
         $page_data['page_name']    = 'subject_dashboard';
         $page_data['page_title']   = getEduAppGTLang('subject_marks');
         $this->load->view('backend/index',$page_data);
     }
     
    function viewFile($id){
        $this->drive_model->setPermissions($id);
        header("Location: ". $this->drive_model->get_embed_url($id));
    }
    
    //Subjects function.
    function cursos($class_id = '')
    {
        $this->isTeacher();
        $page_data['class_id']  = $class_id;
        $page_data['page_name']  = 'cursos';
        $page_data['page_title'] = getEduAppGTLang('subjects');
        $this->load->view('backend/index', $page_data);
    }
    
    //Class Routine function.
    function class_routine($class_id = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'class_routine';
        $page_data['class_id']  =   $class_id;
        $page_data['page_title'] = getEduAppGTLang('Class-Routine');
        $this->load->view('backend/index', $page_data);
    }

    //My account function.
    function my_account($param1 = "", $page_id = "")
    {
        $this->isTeacher();
        if($param1 == 'remove_facebook')
        {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '1')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('google_err'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '3')
        {
            $this->session->set_flashdata('error_message' , getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '2')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_true'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if($param1 == '4')
        {
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }  
        if($param1 == 'remove_google')
        {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('google_delete'));
            redirect(base_url() . 'teacher/my_account/', 'refresh');
        }
        if ($param1 == 'update_profile') 
        {
            $this->user->updateCurrentTeacher();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/teacher_update/', 'refresh');
        }
        $data['page_name']          = 'my_account';
        $data['output']             = $this->crud->getGoogleURL();
        $data['page_title']         = getEduAppGTLang('profile');
        $this->load->view('backend/index', $data);
    }

    //Manage attendance function.
    function attendance($data = '', $timestamp = '')
    {
        $this->isTeacher();
        $page_data['page_name']    =  'manage_attendance';
        $page_data['data']         =  $data;
        $page_data['timestamp']    =  $timestamp;
        $page_data['page_title']   =  getEduAppGTLang('attendance');
        $this->load->view('backend/index', $page_data);
    }
    function attendance_report($data = '' )
    {
        $this->isTeacher();
        $page_data['page_name']    =  'attendance_report';
        $page_data['data']         =  $data;
        $page_data['year']         =  $this->input->post('year');
        $page_data['month']        = $this->input->post('month');
        $page_data['page_title']   =  getEduAppGTLang('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    //Attendance selector function.
    function attendance_selector()
    {
        $this->isTeacher();
        $timestamp = $this->crud->attendanceSelector();
        redirect(base_url().'teacher/attendance/'.$this->input->post('data').'/'.$timestamp,'refresh');
    }
    
    //Attendance update function.
    function attendance_update($class_id = '' , $section_id = '', $subject_id = '' , $timestamp = '')
    {
        $this->isTeacher();
        $this->crud->attendanceUpdate($class_id, $section_id,$subject_id, $timestamp);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
        redirect(base_url().'teacher/attendance/'.base64_encode($class_id.'-'.$section_id.'-'.$subject_id).'/'.$timestamp , 'refresh');
    }
    
    //Manage Study material function.
    function study_material($task = "", $document_id = "", $data = '')
    {
        $this->isTeacher();
        if ($task == "create")
        {
            $this->academic->createMaterial();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_uploaded'));
            redirect(base_url() . 'teacher/study_material/'.$document_id."/" , 'refresh');
        }
        if ($task == "delete")
        {
            $this->crud->delete_study_material_info($document_id);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/study_material/'.$data."/");
        }
        $page_data['data'] = $task;
        $page_data['page_name']              = 'study_material';
        $page_data['page_title']             = getEduAppGTLang('study_material');
        $this->load->view('backend/index', $page_data);
    }

    //Library function
    function library($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        $id = $this->input->post('class_id');
        if ($id == '')
        {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['id']  = $id;
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = getEduAppGTLang('library');
        $this->load->view('backend/index', $page_data);
    }
    
    //Query for search function.
    function query($search_key = '') 
    {        
        if ($_POST)
        {
            redirect(base_url() . 'teacher/search_results?query=' . base64_encode(html_escape($this->input->post('search_key'))), 'refresh');
        }
    }

    //Search results function.
    function search_results()
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['query']) == "")
        {
            redirect(base_url(), 'refresh');
        }
        $page_data['search_key'] =  html_escape($_GET['query']);
        $page_data['page_name']  =  'search_results';
        $page_data['page_title'] =  getEduAppGTLang('search_results');
        $this->load->view('backend/index', $page_data);
    }

    //Notifications function.
    function notifications()
    {
        $this->isTeacher();
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    //Chat messages function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if(html_escape($_GET['id']) != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') 
        {
            $message_thread_code = $this->crud->send_new_private_message();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('message_sent'));
            redirect(base_url() . 'teacher/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') 
        {
            $this->crud->send_reply_message($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('reply_sent'));
            redirect(base_url() . 'teacher/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') 
        {
            $page_data['current_message_thread_code'] = $param2; 
            $this->crud->mark_thread_messages_read($param2);
        }
        $page_data['infouser'] = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = getEduAppGTLang('private_messages');
        $this->load->view('backend/index', $page_data);
    }

    //Manage permissions function.
    function request($param1 = "", $param2 = "")
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if(html_escape($_GET['id']) != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create")
        {
            $this->crud->permission_request();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/request', 'refresh');
        }
        $data['page_name']  = 'request';
        $data['page_title'] = getEduAppGTLang('permissions');
        $this->load->view('backend/index', $data);
    }

    //Homework details function.
    function homeworkroom($param1 = '' , $param2 = '')
    {
        $this->isTeacher();
        if ($param1 == 'file') 
        {
            $page_data['room_page']    = 'homework_file';
            $page_data['homework_code'] = $param2;
        }  
        else if ($param1 == 'details') 
        {
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        }
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }
        $page_data['homework_code'] =   $param1;
        $page_data['page_name']   = 'homework_room'; 
        $page_data['page_title']  = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Homework file function.
    function homework_file($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        $homework_code = $this->db->get_where('homework', array('homework_id'))->row()->homework_code;
        if ($param1 == 'upload')
        {
            $this->crud->upload_homework_file($param2);
        }
        else if ($param1 == 'download')
        {
            $this->crud->download_homework_file($param2);
        }
        else if ($param1 == 'delete')
        {
            $this->crud->delete_homework_file($param2);
            redirect(base_url() . 'teacher/homeworkroom/details/' . $homework_code , 'refresh');
        }
    }

    //Manage forums function.
    function forum($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        if ($param1 == 'create') 
        {
            $this->academic->createForum();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/forum/' . $param2."/" , 'refresh');
        }
        if ($param1 == 'update') 
        {
            $this->academic->updateForum($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'teacher/edit_forum/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete')
        {
            $this->crud->delete_post($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/forum/'.$param3."/" , 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Single homework function.
    function single_homework($param1 = '', $param2 = '') 
    {
       $this->isTeacher();
       $page_data['answer_id'] = $param1;
       $page_data['page_name'] = 'single_homework';
       $page_data['page_title'] = getEduAppGTLang('homework');
       $this->load->view('backend/index', $page_data);
    }
    
    //Create online exam function.
    function create_online_exam($info = '') 
    {
        $this->isTeacher();
        $this->academic->createOnlineExam();
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
        redirect(base_url().'teacher/online_exams/'.$info."/", 'refresh');
    }

    //Delete exams function.
    function manage_exams($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        if($param1 == 'delete')
        {
            $this->crud->deleteExam($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/online_exams/'.$param3."/", 'refresh');
        }
    }

    //Homework details function.
    function homework_details($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isTeacher();
        $page_data['homework_code'] = $param1;
        $page_data['page_name']  = 'homework_details';
        $page_data['page_title'] = getEduAppGTLang('homework_details');
        $this->load->view('backend/index', $page_data);
    }

    //Online exams function.
    function online_exams($param1 = '', $param2 = '', $param3 ='') 
    {
        $this->isTeacher();
        if ($param1 == 'edit') 
        {
            if ($this->input->post('class_id') > 0 && $this->input->post('section_id') > 0 && $this->input->post('subject_id') > 0) {
                $this->crud->update_online_exam();
                $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'teacher/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            }
            else{
                $this->session->set_flashdata('error_message' , getEduAppGTLang('error'));
                redirect(base_url() . 'teacher/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            }
        }
        if ($param1 == 'questions') 
        {
            $this->crud->add_questions();
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'teacher/exam_questions/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete_questions') 
        {
            $this->db->where('question_id', $param2);
            $this->db->delete('questions');
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/exam_questions/'.$param3, 'refresh');
        }
        if ($param1 == 'delete'){
            $this->crud->delete_exam($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/online_exams/', 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'online_exams';
        $page_data['page_title'] = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Online exam details function.
    function examroom($param1 = '' , $param2 = '')
    {
        $this->isTeacher();
        $page_data['page_name']   = 'exam_room'; 
        $page_data['online_exam_id']  = $param1;
        $page_data['page_title']  = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Exam question function.
    function exam_questions($exam_code = '') 
    {    
        $this->isTeacher();
        $page_data['exam_code'] = $exam_code;
        $page_data['page_name'] = 'exam_questions';
        $page_data['page_title'] = getEduAppGTLang('exam_questions');
        $this->load->view('backend/index', $page_data);
    }
    
    //Delete online exam question function.
    function delete_question_from_online_exam($question_id = '')
    {
        $this->isTeacher();
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud->delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
        redirect(base_url() . 'teacher/examroom/'.$online_exam_id, 'refresh');
    }

    //Update online exam question function.
    function update_online_exam_question($question_id = "", $task = "", $online_exam_id = "") 
    {
        $this->isTeacher();
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
                $this->crud->update_multiple_choice_question($question_id);
            }
            elseif($type == 'true_false'){
                $this->crud->update_true_false_question($question_id);
            }
            elseif($type == 'image'){
                $this->crud->update_image_question($question_id);
            }
            elseif($type == 'fill_in_the_blanks'){
                $this->crud->update_fill_in_the_blanks_question($question_id);
            }
            redirect(base_url() . 'teacher/examroom/'.$online_exam_id, 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'update_online_exam_question';
        $page_data['page_title'] = getEduAppGTLang('update_questions');
        $this->load->view('backend/index', $page_data);
    }
    
    //Manage online exam questions function.
    function manage_online_exam_question($online_exam_id = "", $task = "", $type = "")
    {
        $this->isTeacher();
        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud->add_multiple_choice_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'true_false') {
                $this->crud->add_true_false_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'image') {
                $this->crud->add_image_question_to_online_exam($online_exam_id);
            }
            elseif ($type == 'fill_in_the_blanks') {
                $this->crud->add_fill_in_the_blanks_question_to_online_exam($online_exam_id);
            }
            redirect(base_url() . 'teacher/examroom/'.$online_exam_id, 'refresh');
        }
    }
    
    //Manage image questions function.
    function manage_image_options() 
    {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/teacher/manage_image_options', $page_data);
    }
    
    //Manage multiple choice questions function.
    function manage_multiple_choices_options() 
    {
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/teacher/manage_multiple_choices_options', $page_data);
    }
    
    //Load question by type function.
    function load_question_type($type = '', $online_exam_id = '') 
    {
        $page_data['question_type'] = $type;
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/teacher/online_exam_add_'.$type, $page_data);
    }

    //See exam results function.
    function exam_results($exam_code = '') 
    { 
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if(html_escape($_GET['id']) != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name'] = 'exam_results';
        $page_data['page_title'] = getEduAppGTLang('exams_results');
        $this->load->view('backend/index', $page_data);
    }

    //Edit exam function.
    function exam_edit($exam_code= '') 
    { 
        $this->isTeacher();
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name'] = 'exam_edit';
        $page_data['page_title'] = getEduAppGTLang('update_exam');
        $this->load->view('backend/index', $page_data);
    }

    //Edit homework function.
    function homework_edit($homework_code = '') 
    {   
        $this->isTeacher();
        $page_data['homework_code'] = $homework_code;
        $page_data['page_name'] = 'homework_edit';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Forum details function.
    function forumroom($param1 = '' , $param2 = '')
    {
        $this->isTeacher();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if(html_escape($_GET['id']) != "")
        {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'comment') 
        {
            $page_data['room_page']    = 'comments';
            $page_data['post_code'] = $param2; 
        }
        else if ($param1 == 'posts') 
        {
            $page_data['room_page'] = 'post';
            $page_data['post_code'] = $param2; 
        }
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'post_edit';
            $page_data['post_code'] = $param2;
        }
        $page_data['page_name']   = 'forum_room'; 
        $page_data['post_code']   = $param1;
        $page_data['page_title']  = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Delete notification function.
    function notification($param1 ='', $param2 = '')
    {
        $this->isTeacher();
        if($param1 == 'delete')
        {
            $this->crud->deleteNotification($param2);
            $this->session->set_flashdata('flash_message' , getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'teacher/notifications/', 'refresh');
        }
    }

    //Edit forum function.
    function edit_forum($code = '')
    {
        $this->isTeacher();
        $page_data['page_name']  = 'edit_forum';
        $page_data['page_title'] = getEduAppGTLang('update_forum');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);    
    }

    //Create forum message function.
    function forum_message($param1 = '', $param2 = '', $param3 = '') 
    {
        $this->isTeacher();
        if ($param1 == 'add') 
        {
            $this->crud->create_post_message(html_escape($this->input->post('post_code')));
        }
    }
    
    //Check teacher session function.
    function isTeacher()
    {
        if ($this->session->userdata('teacher_login') != 1) 
        {
            redirect(base_url(), 'refresh');
        }
    }
    function add_custom_status_attendance()
    {
        $teacher_id = $this->input->post('teacher_id');
        $status_name = $this->input->post('status_name');
        $course=$this->input->post('course');
        $data=array(
            'teacher_id'=>$teacher_id,
            'status_name'=>$status_name
        );
        $this->db->insert('custom_status', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'teacher/attendance/' . $course);
    }
    
    //End of Teacher.php
}