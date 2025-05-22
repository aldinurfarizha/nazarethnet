<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends EduAppGT
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
        $this->load->library('session');
        $this->load->database();
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->runningYear = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
    }

    function gdrive()
    {
        $this->drive_model->checkFolder();
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/drive/', 'refresh');
    }
    function generategdrive()
    {
        $this->drive_model->generateNewFolder();
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/drive/', 'refresh');
    }
    

    function upload_video($video_name)
    {
        move_uploaded_file($_FILES["video"]["tmp_name"], "public/uploads/homework/video/" . $video_name . '.mp4');
        $fileURL = "public/uploads/homework/video/" . $video_name . '.mp4';
        echo $fileURL;
    }

    function create_homework($data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']       = $data;
        $page_data['page_name']  = 'create_homework';
        $page_data['page_title'] = getEduAppGTLang('create_homework');
        $this->load->view('backend/index', $page_data);
    }

    function upload_audio($audio_name)
    {
        move_uploaded_file($_FILES["audio"]["tmp_name"], "public/uploads/homework/audio/" . $audio_name . '.mp3');
        $fileURL = "public/uploads/homework/audio/" . $audio_name . '.mp3';
        echo $fileURL;
    }

    function drive($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'remove_drive') {
            $this->drive_model->removeAccount();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('success_update'));
            redirect(base_url() . 'admin/drive/', 'refresh');
        }
        if ($param1 == 'settings') {
            $this->crud->driveSettings();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('success_update'));
            redirect(base_url() . 'admin/drive/', 'refresh');
        }
        if ($param1 == 'drive') {
            $this->crud->updateDrive();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('success_update'));
            redirect(base_url() . 'admin/drive/', 'refresh');
        }
        $page_data['page_name']  = 'gdrive';
        $page_data['page_title'] =  getEduAppGTLang('google_drive');
        $this->load->view('backend/index', $page_data);
    }

    function syncFilesToDrive($subjectID)
    {
        $this->drive_model->uploadFolder($subjectID);
    }

    function viewFile($id)
    {
        $this->drive_model->setPermissions($id);
        header("Location: " . $this->drive_model->get_embed_url($id));
    }

    function teachers_live($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_course_id']    = $param1;
        $page_data['quiz_id']             = $param2;
        $page_data['page_name']           = 'teachers_live';
        $page_data['page_title']          = getEduAppGTLang('teachers_live');
        $this->load->view('backend/index', $page_data);
    }

    function team_admin_live($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'apply') {
            $checked_permissions = $this->input->post('admins');
            $total_checked_values = count($checked_permissions);
            $permissions = '';
            for ($i = 0; $i < $total_checked_values; $i++) {
                $permissions .= $checked_permissions[$i] . ",";
            }
            $permissions .= $this->session->userdata('login_user_id') . ",";

            $data2['admin_members']     = $permissions;
            $this->db->where('team_conference_id', $param2);
            $this->db->update('team_conference', $data2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_applied'));
            redirect(base_url() . 'admin/team_admin_live/' . $param2 . '/', 'refresh');
        }
        $page_data['team_conference_id']  = $param1;
        $page_data['page_name']           = 'team_admin_live';
        $page_data['page_title']          = getEduAppGTLang('team_admin_live');
        $this->load->view('backend/index', $page_data);
    }

    function team_teacher_live($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'apply') {
            $checked_permissions = $this->input->post('teachers');
            $total_checked_values = count($checked_permissions);
            $permissions = '';
            for ($i = 0; $i < $total_checked_values; $i++) {
                $permissions .= $checked_permissions[$i] . ",";
            }
            $data2['members']        = $permissions;
            $this->db->where('team_conference_id', $param2);
            $this->db->update('team_conference', $data2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_applied'));
            redirect(base_url() . 'admin/team_teacher_live/' . $param2 . '/', 'refresh');
        }
        $page_data['team_conference_id']  = $param1;
        $page_data['page_name']           = 'team_teacher_live';
        $page_data['page_title']          = getEduAppGTLang('team_teacher_live');
        $this->load->view('backend/index', $page_data);
    }

    function team_live($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['team_conference_id']  = $param1;
        $page_data['page_name']                     = 'team_live';
        $page_data['page_title']                    = getEduAppGTLang('team_live');
        $this->load->view('backend/admin/team_live', $page_data);
    }

    function team_conferences($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['user_id']               = $this->session->userdata('login_user_id');
            $data['user_type']             = $this->session->userdata('login_type');
            $data['title']                 = $this->input->post('title');
            $data['description']           = $this->input->post('description');
            $data['zoom_meeting_password'] = $this->input->post('zoom_meeting_password');
            $data['zoom_meeting_id']       = $this->input->post('zoom_meeting_id');
            $data['upload_date']           = date('d M. H:iA');
            $data['start_date']            = $this->input->post('start_date');
            $data['start_time']            = $this->input->post('start_time');
            $data['end_time']              = $this->input->post('end_time');
            $data['admin_members']         = $this->session->userdata('login_user_id');
            $data['publish_date']          = date('Y-m-d H:i:s');
            $data['room']                  =  md5(date('d-m-Y H:i:s')) . substr(md5(rand(100000000, 200000000)), 0, 10);
            $data['year']                  = $year;
            $this->db->insert('team_conference', $data);
            $id_room = $this->db->insert_id();

            $this->db->order_by('teacher_id', 'asc');
            $checked_permissions = $this->db->get('teacher')->result_array();

            $permissions = '';
            foreach ($checked_permissions as $rr) {
                $permissions .= $rr['teacher_id'] . ",";
            }
            $data2['members']        = $permissions;
            $this->db->where('team_conference_id', $id_room);
            $this->db->update('team_conference', $data2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_created'));
            redirect(base_url() . 'admin/team_conferences/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['zoom_meeting_password'] = $this->input->post('zoom_meeting_password');
            $data['zoom_meeting_id']       = $this->input->post('zoom_meeting_id');
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['upload_date']        = date('d M. H:iA');
            $data['start_date']         = $this->input->post('start_date2');
            $data['start_time']         = $this->input->post('start_time2');
            $data['end_time']           = $this->input->post('end_time2');
            $this->db->where('team_conference_id', $param2);
            $this->db->update('team_conference', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/team_conferences/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('team_conference_id', $param2);
            $this->db->delete('team_conference');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/team_conferences/', 'refresh');
        }
        $page_data['page_name']           = 'team_conferences';
        $page_data['page_title']          = getEduAppGTLang('team_conferences');
        $this->load->view('backend/index', $page_data);
    }

    //Index function for Admin controller.
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($this->session->userdata('admin_login') == 1) {
            redirect(base_url() . 'admin/panel/', 'refresh');
        }
    }

    function quiz_response($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_course_id']    = $param1;
        $page_data['quiz_id']             = $param2;
        $page_data['page_name']           = 'quiz_response';
        $page_data['page_title']          = getEduAppGTLang('quiz_response');
        $this->load->view('backend/index', $page_data);
    }

    function online_quiz_result($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['quiz_id']             = $param1;
        $page_data['online_course_id']    = $param2;
        $page_data['student_id']          = $param3;
        $page_data['page_name']           = 'online_quiz_result';
        $page_data['page_title']          = getEduAppGTLang('online_quiz_result');
        $this->load->view('backend/index', $page_data);
    }

    function create_online_course()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $md5                   =  md5(date('d-m-y H:i:s'));
        $year                  =  $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if ($this->input->post('type') == 'local' && $_FILES['video']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['video']['name']);
            move_uploaded_file($_FILES['video']['tmp_name'], 'public/uploads/online_course_video/' . $md5 . str_replace(' ', '', $_FILES['video']['name']));
        }
        if ($this->input->post('type') == 'vimeo' && $_FILES['imgVimeo']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgVimeo']['name']);
            move_uploaded_file($_FILES['imgVimeo']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgVimeo']['name']));
        }
        if ($this->input->post('type') == 'local' && $_FILES['imgLocal']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgLocal']['name']);
            move_uploaded_file($_FILES['imgLocal']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgLocal']['name']));
        }
        if ($this->input->post('type') == 'youtube' && $_FILES['imgYoutube']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgYoutube']['name']);
            move_uploaded_file($_FILES['imgYoutube']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgYoutube']['name']));
        }
        if ($this->input->post('type') == 'html5' && $_FILES['imgHtml5']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgHtml5']['name']);
            move_uploaded_file($_FILES['imgHtml5']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgHtml5']['name']));
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
        $data['description']   = $this->input->post('description');
        if ($this->input->post('type') == 'html5' && $this->input->post('url_html5') != "") {
            $data['url_video']          = $this->input->post('url_html5');
        }
        if ($this->input->post('type') == 'vimeo' && $this->input->post('url_vimeo') != "") {
            $data['url_video']          = $this->input->post('url_vimeo');
            $data['embed']              = substr(parse_url($this->input->post('url_vimeo'), PHP_URL_PATH), 1);
        }
        if ($this->input->post('type') == 'youtube' && $this->input->post('url_youtube') != "") {
            $data['url_video']          = $this->input->post('url_youtube');
            $data['embed']              = $this->input->post('embed');
        }
        if ($this->input->post('type') == 'local' && $_FILES['video']['name'] != "") {
            $data['url_video']          = $md5 . str_replace(' ', '', $_FILES['video']['name']);
        }
        if ($this->input->post('type') == 'vimeo' && $_FILES['imgVimeo']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgVimeo']['name']);
        }
        if ($this->input->post('type') == 'local' && $_FILES['imgLocal']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgLocal']['name']);
        }
        if ($this->input->post('type') == 'youtube' && $_FILES['imgYoutube']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgYoutube']['name']);
        }
        if ($this->input->post('type') == 'html5' && $_FILES['imgHtml5']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgHtml5']['name']);
        }
        $data['year']          = $year;
        $this->db->insert('online_course', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/online_courses/', 'refresh');
    }

    function get_subjects($class_id)
    {
        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    function quiz_contest($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
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

    function view_lesson($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == "download") {
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

    function watch($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_course_id']    = $param1;
        $page_data['page_name']           = 'watch';
        $page_data['page_title']          = getEduAppGTLang('watch');
        $this->load->view('backend/index', $page_data);
    }

    function new_online_course($data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']  = 'new_online_course';
        $page_data['page_title'] = getEduAppGTLang('new_online_course');
        $this->load->view('backend/index', $page_data);
    }

    function lessons($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create_section') {
            $sections = $this->db->get_where('online_course', array('online_course_id' => $this->input->post('online_course_id')))->row()->section;
            $data['name']               =  $this->input->post('title_section');
            $data['online_course_id']   =  $this->input->post('online_course_id');
            $this->db->insert('section_online', $data);
            $data2['section']  = $sections + 1;
            $this->db->where('online_course_id', $this->input->post('online_course_id'));
            $this->db->update('online_course', $data2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/lessons/' . $this->input->post('online_course_id'), 'refresh');
        }
        if ($param1 == 'update_section') {
            $idd = $this->db->get_where('section_online', array('section_online_id' => $param2))->row()->online_course_id;
            $data['name']   =  $this->input->post('title_section');
            $this->db->where('section_online_id', $param2);
            $this->db->update('section_online', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
        }
        if ($param1 == 'delete_section') {
            $idd = $this->db->get_where('section_online', array('section_online_id' => $param2))->row()->online_course_id;
            $section = $this->db->get_where('online_course', array('online_course_id' => $idd))->row()->section;
            $data['section']  =   $section - 1;
            $this->db->where('online_course_id', $idd);
            $this->db->update('online_course', $data);
            $this->db->where('section_online_id', $param2);
            $this->db->delete('section_online');
            $this->db->where('section_online_id', $param2);
            $this->db->delete('lesson_online');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_eliminated'));
            redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
        }
        if ($param1 == 'create_lesson') {
            $lessons                    = $this->db->get_where('online_course', array('online_course_id' => $param2))->row()->lesson;
            $md5                        = md5(date('d-m-Y H:i:s'));
            $data['section_online_id']  = $this->input->post('section_online_id');
            $data['type']               = $this->input->post('type');
            $data['name']               = $this->input->post('title_lesson');
            if ($this->input->post('type') == 'text' || $this->input->post('type') == 'pdf' || $this->input->post('type') == 'document' || $this->input->post('type') == 'image') {
                $data['attachment']         =  $md5 . $_FILES['attachment']['name'];
                $data['summary']            =  $this->input->post('summary');
                $this->db->insert('lesson_online', $data);
                move_uploaded_file($_FILES['attachment']['tmp_name'], 'public/uploads/online_course_file/' . $md5 . str_replace(' ', '', $_FILES['attachment']['name']));
                $data2['lesson']  = $lessons + 1;
                $this->db->where('online_course_id', $param2);
                $this->db->update('online_course', $data2);
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/lessons/' . $param2, 'refresh');
            }
            if ($this->input->post('type') == 'videos') {
                if ($this->input->post('provider') == 'youtube') {
                    $data['name_video']         = $this->input->post('embed');
                    $data['url']                = $this->input->post('url_youtube');
                    $data['duration']           = $this->input->post('duration_youtube');
                    $data['section_online_id']  = $this->input->post('section_online_id');
                    $data['summary']            = $this->input->post('summary');
                    $data['type_video']         = 'youtube';
                    $this->db->insert('lesson_online', $data);

                    $data2['lesson']  = $lessons + 1;
                    $this->db->where('online_course_id', $param2);
                    $this->db->update('online_course', $data2);
                    $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'admin/lessons/' . $param2, 'refresh');
                }
                if ($this->input->post('provider') == 'vimeo') {
                    $data['name_video']         = substr(parse_url($this->input->post('url_vimeo'), PHP_URL_PATH), 1);
                    $data['url']                = $this->input->post('url_vimeo');
                    $data['duration']           = $this->input->post('duration_vimeo');
                    $data['section_online_id']  = $this->input->post('section_online_id');
                    $data['summary']            = $this->input->post('summary');
                    $data['type_video']         = 'vimeo';
                    $this->db->insert('lesson_online', $data);

                    $data2['lesson']  = $lessons + 1;
                    $this->db->where('online_course_id', $param2);
                    $this->db->update('online_course', $data2);
                    $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'admin/lessons/' . $param2, 'refresh');
                }
                if ($this->input->post('provider') == 'html5') {
                    $data['url']                =  $this->input->post('url_html');
                    $data['duration']           =  $this->input->post('duration_html');
                    $data['section_online_id']  =  $this->input->post('section_online_id');
                    $data['image_video']        =  $md5 . $_FILES['image']['name'];
                    $data['summary']            =  $this->input->post('summary');
                    $data['type_video']         = 'html5';
                    $this->db->insert('lesson_online', $data);
                    move_uploaded_file($_FILES['image']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['image']['name']));

                    $data2['lesson']  = $lessons + 1;
                    $this->db->where('online_course_id', $param2);
                    $this->db->update('online_course', $data2);
                    $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'admin/lessons/' . $param2, 'refresh');
                }

                if ($this->input->post('provider') == 'local') {
                    $data['name_video']         =  $md5 . $_FILES['video_local']['name'];
                    $data['section_online_id']  =  $this->input->post('section_online_id');
                    $data['duration']           =  $this->input->post('duration_local');
                    $data['image_video']        =  $md5 . $_FILES['image_local']['name'];
                    $data['summary']            =  $this->input->post('summary');
                    $data['type_video']         = 'local';
                    $this->db->insert('lesson_online', $data);
                    move_uploaded_file($_FILES['video_local']['tmp_name'], 'public/uploads/online_course_video/' . $md5 . str_replace(' ', '', $_FILES['video_local']['name']));
                    move_uploaded_file($_FILES['image_local']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['image_local']['name']));
                    $data2['lesson']  = $lessons + 1;
                    $this->db->where('online_course_id', $param2);
                    $this->db->update('online_course', $data2);
                    $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                    redirect(base_url() . 'admin/lessons/' . $param2, 'refresh');
                }
            }
        }
        if ($param1 == 'lesson_change') {
            if ($this->input->post('submit') == 'update') {
                $sec_id                     = $this->db->get_where('lesson_online', array('lesson_online_id' => $param2))->row()->section_online_id;
                $idd                        = $this->db->get_where('section_online', array('section_online_id' => $sec_id))->row()->online_course_id;

                $md5                        = md5(date('d-m-Y H:i:s'));

                $data['section_online_id']  = $this->input->post('section_online_id');
                $data['type']               = $this->input->post('type');
                $data['name']               = $this->input->post('title_lesson');

                if ($this->input->post('type') == 'text' || $this->input->post('type') == 'pdf' || $this->input->post('type') == 'document' || $this->input->post('type') == 'image') {
                    if ($_FILES['attachment']['size'] > 0) {
                        $data['attachment']         =  $md5 . $_FILES['attachment']['name'];
                    }
                    $data['summary']            =  $this->input->post('summary');
                    $this->db->where('lesson_online_id', $param2);
                    $this->db->update('lesson_online', $data);
                    if ($_FILES['attachment']['size'] > 0) {
                        move_uploaded_file($_FILES['attachment']['tmp_name'], 'public/uploads/online_course_file/' . $md5 . str_replace(' ', '', $_FILES['attachment']['name']));
                    }
                    $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
                    redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
                }
                if ($this->input->post('type') == 'videos') {
                    if ($this->input->post('provider') == 'youtube') {
                        $data['name_video']         = $this->input->post('embed');
                        $data['url']                = $this->input->post('url_youtube');
                        $data['duration']           = $this->input->post('duration_youtube');
                        $data['section_online_id']  = $this->input->post('section_online_id');
                        $data['summary']            = $this->input->post('summary');
                        $data['type_video']         = 'youtube';
                        $this->db->where('lesson_online_id', $param2);
                        $this->db->update('lesson_online', $data);

                        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
                    }
                    if ($this->input->post('provider') == 'vimeo') {
                        $data['name_video']         = substr(parse_url($this->input->post('url_vimeo'), PHP_URL_PATH), 1);
                        $data['url']                = $this->input->post('url_vimeo');
                        $data['duration']           = $this->input->post('duration_vimeo');
                        $data['section_online_id']  = $this->input->post('section_online_id');
                        $data['summary']            = $this->input->post('summary');
                        $data['type_video']         = 'vimeo';
                        $this->db->where('lesson_online_id', $param2);
                        $this->db->update('lesson_online', $data);

                        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
                    }
                    if ($this->input->post('provider') == 'html5') {
                        $data['url']                =  $this->input->post('url_html');
                        $data['duration']           =  $this->input->post('duration_html');
                        $data['section_online_id']  =  $this->input->post('section_online_id');
                        if ($_FILES['image']['size'] > 0) {
                            $data['image_video']        =  $md5 . $_FILES['image']['name'];
                        }
                        $data['summary']            =  $this->input->post('summary');
                        $data['type_video']         = 'html5';
                        $this->db->where('lesson_online_id', $param2);
                        $this->db->update('lesson_online', $data);
                        if ($_FILES['image']['size'] > 0) {
                            move_uploaded_file($_FILES['image']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['image']['name']));
                        }
                        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
                    }
                    if ($this->input->post('provider') == 'local') {
                        $data['section_online_id']  =  $this->input->post('section_online_id');
                        $data['duration']           =  $this->input->post('duration_local');
                        $data['summary']            =  $this->input->post('summary');
                        $data['type_video']         = 'local';
                        if ($_FILES['image_local']['name'] > 0) {
                            $data['image_video']        =  $md5 . $_FILES['image_local']['name'];
                        }
                        if ($_FILES['video_local']['name'] > 0) {
                            $data['name_video']         =  $md5 . $_FILES['video_local']['name'];
                        }
                        $this->db->where('lesson_online_id', $param2);
                        $this->db->update('lesson_online', $data);
                        if ($_FILES['image_local']['size'] > 0) {
                            move_uploaded_file($_FILES['image_local']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['image_local']['name']));
                        }
                        if ($_FILES['video_local']['size'] > 0) {
                            move_uploaded_file($_FILES['video_local']['tmp_name'], 'public/uploads/online_course_video/' . $md5 . str_replace(' ', '', $_FILES['video_local']['name']));
                        }
                        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
                        redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
                    }
                }
            }
            if ($this->input->post('submit') == 'delete') {
                $sec_id = $this->db->get_where('lesson_online', array('lesson_online_id' => $param2))->row()->section_online_id;
                $idd = $this->db->get_where('section_online', array('section_online_id' => $sec_id))->row()->online_course_id;
                $lessons = $this->db->get_where('online_course', array('online_course_id' => $idd))->row()->lesson;
                $data['lesson']  =   $lessons - 1;
                $this->db->where('online_course_id', $idd);
                $this->db->update('online_course', $data);
                $this->db->where('lesson_online_id', $param2);
                $this->db->delete('lesson_online');
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_eliminated'));
                redirect(base_url() . 'admin/lessons/' . $idd, 'refresh');
            }
        }
        if ($param1 == 'create_quiz') {

            $data['title']              =  $this->input->post('title_quiz');
            $data['section_online_id']  =  $this->input->post('section_online_id');
            $data['online_course_id']   =  $this->input->post('online_course_id');
            $data['instruction']        =  $this->input->post('instruction');
            $this->db->insert('quiz', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/lessons/' . $this->input->post('online_course_id'), 'refresh');
        }
        if ($param1 == 'change_quiz') {
            if ($this->input->post('submit') == 'delete') {
                $this->db->where('quiz_id', $param2);
                $this->db->delete('quiz');
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
                redirect(base_url() . 'admin/lessons/' . $this->input->post('online_course_id'), 'refresh');
            }
            if ($this->input->post('submit') == 'update') {
                $data['title']              =  $this->input->post('title_quiz');
                $data['section_online_id']  =  $this->input->post('section_online_id');
                $data['instruction']        =  $this->input->post('instruction');
                $this->db->where('quiz_id', $param2);
                $this->db->update('quiz', $data);
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
                redirect(base_url() . 'admin/lessons/' . $this->input->post('online_course_id'), 'refresh');
            }
        }
        if ($param1 == 'create_question') {
            $course_id = $this->db->get_where('quiz', array('quiz_id' => $this->input->post('quiz_id')))->row()->online_course_id;
            if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
                $this->session->set_flashdata('error_message', getEduAppGTLang('no_options_can_be_blank'));
                return;
            }
            foreach ($this->input->post('options') as $option) {
                if ($option == "") {
                    $this->session->set_flashdata('error_message', getEduAppGTLang('no_options_can_be_blank'));
                    return;
                }
            }
            if (sizeof($this->input->post('correct_answers')) == 0) {
                $correct_answers = [""];
            } else {
                $correct_answers = $this->input->post('correct_answers');
            }
            $data['quiz_id']            = $this->input->post('quiz_id');
            $data['question_title']     = html_escape($this->input->post('question_title'));
            $data['mark']               = html_escape($this->input->post('mark'));
            $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
            $data['options']            = json_encode($this->input->post('options'));
            $data['correct_answers']    = json_encode($correct_answers);
            $this->db->insert('quiz_bank', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/lessons/' . $course_id, 'refresh');
        }
        if ($param1 == 'update_question') {
            $quiz_id   = $this->db->get_where('quiz_bank', array('quiz_bank_id' => $param2))->row()->quiz_id;
            $course_id = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row()->online_course_id;


            foreach ($this->input->post('options') as $option) {
                if ($option == "") {
                    $this->session->set_flashdata('error_message', getEduAppGTLang('no_options_can_be_blank'));
                    return;
                }
            }
            if (sizeof($this->input->post('correct_answers')) == 0) {
                $correct_answers = [""];
            } else {
                $correct_answers = $this->input->post('correct_answers');
            }
            $data['question_title']     = html_escape($this->input->post('question_title'));
            $data['mark']               = html_escape($this->input->post('mark'));
            $data['number_of_options']  = html_escape($this->input->post('number_of_options'));
            $data['options']            = json_encode($this->input->post('options'));
            $data['correct_answers']    = json_encode($correct_answers);
            $this->db->where('quiz_bank_id', $param2);
            $this->db->update('quiz_bank', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/lessons/' . $course_id, 'refresh');
        }
        if ($param1 == 'delete_question') {
            $quiz_id   = $this->db->get_where('quiz_bank', array('quiz_bank_id' => $param2))->row()->quiz_id;
            $course_id = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row()->online_course_id;

            $this->db->where('quiz_bank_id', $param2);
            $this->db->delete('quiz_bank');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/lessons/' . $course_id, 'refresh');
        }
        $page_data['course_id']             = $param1;
        $page_data['page_name']             = 'lessons';
        $page_data['page_title']            = getEduAppGTLang('lessons');
        $this->load->view('backend/index', $page_data);
    }

    function update_online_course($param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $md5  =  md5(date('d-m-y H:i:s'));

        if ($this->input->post('type') == 'local' && $_FILES['video']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['video']['name']);
            move_uploaded_file($_FILES['video']['tmp_name'], 'public/uploads/online_course_video/' . $md5 . str_replace(' ', '', $_FILES['video']['name']));
        }

        if ($this->input->post('type') == 'vimeo' && $_FILES['imgVimeo']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgVimeo']['name']);
            move_uploaded_file($_FILES['imgVimeo']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgVimeo']['name']));
        }
        if ($this->input->post('type') == 'local' && $_FILES['imgLocal']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgLocal']['name']);
            move_uploaded_file($_FILES['imgLocal']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgLocal']['name']));
        }
        if ($this->input->post('type') == 'youtube' && $_FILES['imgYoutube']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgYoutube']['name']);
            move_uploaded_file($_FILES['imgYoutube']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgYoutube']['name']));
        }
        if ($this->input->post('type') == 'hmtl5' && $_FILES['imgHtml5']['size'] > 0) {
            $md5 . str_replace(' ', '', $_FILES['imgHtml5']['name']);
            move_uploaded_file($_FILES['imgHtml5']['tmp_name'], 'public/uploads/online_course_image/' . $md5 . str_replace(' ', '', $_FILES['imgHtml5']['name']));
        }

        $data['title']         = html_escape($this->input->post('title'));
        $data['class_id']      = $this->input->post('class_id');
        $data['section_id']    = $this->input->post('section_id');
        $data['subject_id']    = $this->input->post('subject_id');
        $data['outcomes']      = $this->input->post('outcomes');
        $data['provider']      = $this->input->post('type');
        $data['description']   = $this->input->post('description');
        if ($this->input->post('type') == 'html5' && $this->input->post('url_html5') != "") {
            $data['url_video']          = $this->input->post('url_html5');
        }
        if ($this->input->post('type') == 'vimeo' && $this->input->post('url_vimeo') != "") {
            $data['url_video']          = $this->input->post('url_vimeo');
            $data['embed']              = substr(parse_url($this->input->post('url_vimeo'), PHP_URL_PATH), 1);
        }

        if ($this->input->post('type') == 'youtube' && $this->input->post('url_youtube') != "") {
            $data['url_video']          = $this->input->post('url_youtube');
            $data['embed']         = $this->input->post('embed');
        }

        if ($this->input->post('type') == 'local' && $_FILES['video']['name'] != "") {
            $data['url_video']          = $md5 . str_replace(' ', '', $_FILES['video']['name']);
        }
        if ($this->input->post('type') == 'vimeo' && $_FILES['imgVimeo']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgVimeo']['name']);
        }
        if ($this->input->post('type') == 'local' && $_FILES['imgLocal']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgLocal']['name']);
        }
        if ($this->input->post('type') == 'youtube' && $_FILES['imgYoutube']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgYoutube']['name']);
        }
        if ($this->input->post('type') == 'html5' && $_FILES['imgHtml5']['name'] != "") {
            $data['thumbnail']          = $md5 . str_replace(' ', '', $_FILES['imgHtml5']['name']);
        }
        $this->db->where('online_course_id', $param1);
        $this->db->update('online_course', $data);

        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/online_courses/', 'refresh');
    }

    function online_courses($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('online_course_id', $param2);
            $this->db->delete('online_course');
            redirect(base_url() . 'admin/online_courses/', 'refresh');
        }
        if ($param1 == 'active') {
            $data['status']  =  1;
            $this->db->where('online_course_id', $param2);
            $this->db->update('online_course', $data);
            redirect(base_url() . 'admin/online_courses/', 'refresh');
        }
        if ($param1 == 'inactive') {
            $data['status']  =  0;
            $this->db->where('online_course_id', $param2);
            $this->db->update('online_course', $data);
            redirect(base_url() . 'admin/online_courses/', 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['page_name']  = 'online_courses';
        $page_data['page_title'] = getEduAppGTLang('online_courses');
        $this->load->view('backend/index', $page_data);
    }

    function gamification($data = '', $page = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($data == 'update_level') {
            $insert_data['point']           = $this->input->post('require');
            $insert_data['description']     = $this->input->post('description');
            $this->db->where('id', $page);
            $this->db->update('gamification', $insert_data);

            $base = base64_encode($this->input->post('class_id') . '-' . $this->input->post('section_id') . '-' . $this->input->post('subject_id'));
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/gamification/' . $base . '/levels/', 'refresh');
        }
        if ($data == 'update_settings') {
            $info = base64_decode($page);
            $ex = explode('-', $info);

            $insert_data['levels']              = $this->input->post('levels');
            $insert_data['addon_title']         = $this->input->post('addon_title');
            $insert_data['addon_description']   = $this->input->post('addon_description');
            $insert_data['gamification']        = $this->input->post('gamification');
            $this->db->where('subject_id', $ex[2]);
            $this->db->update('subject', $insert_data);

            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/gamification/' . $page . '/settings/', 'refresh');
        }
        if ($data == 'delete') {
            $info = base64_decode($page);
            $ex = explode('-', $info);
            $this->db->where('section_id', $ex[1]);
            $this->db->where('class_id', $ex[0]);
            $this->db->where('subject_id', $ex[2]);
            $this->db->where('student_id', $param3);
            $this->db->delete('student_gamification');

            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/gamification/' . $page . '/', 'refresh');
        }
        if ($data == 'update_rules') {
            $info = base64_decode($page);
            $ex = explode('-', $info);

            $insert_data['online_exam']         = $this->input->post('online_exam');
            $insert_data['homework']            = $this->input->post('homework');
            $insert_data['forum']               = $this->input->post('forum');
            $insert_data['live_class']          = $this->input->post('live_class');
            $this->db->where('subject_id', $ex[2]);
            $this->db->update('subject', $insert_data);

            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/gamification/' . $page . '/rules/', 'refresh');
        }
        $info = base64_decode($data);
        $ex = explode('-', $info);
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $query = $this->db->get_where('gamification', array('class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $year));
        if ($query->num_rows() == 0) {
            for ($i = 1; $i <= 10; $i++) {
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
        if ($this->input->post('file_name') != '') {
            $info['edited_file_name'] = 'edited-' . $this->input->post('file_name');
        }
        $info['edited']           = 1;
        $this->db->where('fhomework_file_id', $this->input->post('fhomework_file_id'));
        $this->db->update('homework_files', $info);
        move_uploaded_file($_FILES['pdf']['tmp_name'], 'public/uploads/homework_delivery/edited/' . $info['edited_file_name']);
    }

    function annotator($fileID = '', $homeworkCode = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['fileID']  = $fileID;
        $page_data['homework_code']  = $homeworkCode;
        $this->load->view('backend/admin/annotator', $page_data);
    }

    function certificates($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->updateCertificates();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/certificates/', 'refresh');
        }
        $page_data['page_name']           = 'certificates';
        $page_data['page_title']          = getEduAppGTLang('certificates');
        $this->load->view('backend/index', $page_data);
    }

    function whiteboards($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param1;
        $page_data['page_name']  = 'whiteboards';
        $page_data['page_title'] = getEduAppGTLang('whiteboards');
        $this->load->view('backend/index', $page_data);
    }

    function new_whiteboard($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param1;
        $page_data['page_title'] = getEduAppGTLang('new_whiteboard');
        $this->load->view('backend/admin/new_whiteboard', $page_data);
    }

    function view_whiteboard($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param2;
        $page_data['board_id']  = $param1;
        $page_data['page_title'] = getEduAppGTLang('view_whiteboard');
        $this->load->view('backend/admin/view_whiteboard', $page_data);
    }

    function deleteBoard($param1 = '', $param2 = '')
    {
        $this->db->where('board_id', $param1);
        $this->db->delete('boards');
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/whiteboards/' . $param2, 'refresh');
    }

    function saveboard()
    {
        $info = base64_decode($this->input->post('data'));
        $ex = explode('-', $info);

        $data['class_id']   = $ex[0];
        $data['section_id'] = $ex[1];
        $data['subject_id'] = $ex[2];
        $data['board_data'] = $this->input->post('board');
        $data['board_title'] = $this->input->post('board_name');
        $data['year']       = date('Y');
        $data['date']       = date('Y-m-d H:i');
        $this->db->insert('boards', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/whiteboards/' . $this->input->post('data'), 'refresh');
    }

    //Payments Gateways settings.
    function accounting_settings($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            if ($param2 == 'paypal') {
                $this->payment->updatePayPal();
            }
            if ($param2 == 'stripe') {
                $this->payment->updateStripe();
            }
            if ($param2 == 'razorpay') {
                $this->payment->updateRazorpay();
            }
            if ($param2 == 'paystack') {
                $this->payment->updatePaystack();
            }
            if ($param2 == 'flutterwave') {
                $this->payment->updateFlutterwave();
            }
            if ($param2 == 'pesapal') {
                $this->payment->updatePesapal();
            }
            if ($param2 == 'gpay') {
                $this->payment->updateGpay();
            }
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/accounting_settings/', 'refresh');
        }
        $page_data['page_name']  = 'accounting_settings';
        $page_data['page_title'] = getEduAppGTLang('accounting_settings');
        $this->load->view('backend/index', $page_data);
    }

    //Get expense data.
    function get_expense()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        echo $this->crud->get_expense(date('M'));
    }

    //Get payment data.
    function get_payments()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        echo $this->crud->get_payments(date('M'));
    }

    function graphIncome()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        echo $this->crud->income();
    }

    function graphExpense()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        echo $this->crud->expense();
    }

    //Generate PDF after Admission form.
    function generate($student_id, $pw)
    {
        $this->crud->getPDF($student_id, $pw);
    }

    //Update SMTP Settings function.
    function smtp($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->updateSMTP();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('success_update'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'smtp';
        $page_data['page_title'] = getEduAppGTLang('smtp_settings');
        $this->load->view('backend/index', $page_data);
    }


    //Send Marks by SMS to Parents and Students.
    function send_marks($param1 = '', $param2 = '')
    {
        if ($param1 == 'email') {
            if ($this->input->post('receiver') == 'student') {
                $this->mail->sendStudentMarks();
            } else {
                $this->mail->sendParentsMarks();
            }
        }
        $this->session->set_flashdata('flash_message', getEduAppGTLang('marks_sent'));
        redirect(base_url() . 'admin/grados/', 'refresh');
    }

    //Download admission sheet function.
    function download_file($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['pw']  = $param2;
        $page_data['student_id']  = $param1;
        $page_data['page_name']  = 'download_file';
        $page_data['page_title'] = getEduAppGTLang('download_file');
        $this->load->view('backend/index', $page_data);
    }

    //Enter to live class function.
    function live($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['zoom_id']  = $param1;
        $page_data['page_name']  = 'live';
        $page_data['page_title'] = getEduAppGTLang('live');
        $this->load->view('backend/admin/live', $page_data);
    }

    //Meet for Live Classes function.
    function meet($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
            $data['title']            = $this->input->post('title');
            $data['meeting_id']       = $this->input->post('zoom_meeting_id');
            $data['meeting_password'] = $this->input->post('zoom_meeting_password');
            $data['class_id']         = $this->input->post('class_id');
            $data['section_id']       = $this->input->post('section_id');
            $data['subject_id']       = $this->input->post('subject_id');
            $data['exp']              = $this->input->post('exp');
            $data['user_type']        = $this->session->userdata('login_type');
            $data['user_id']          = $this->session->userdata('login_user_id');
            $data['year']             = $year;
            $data['wall_type']        = 'live';
            $data['publish_date']     = date('Y-m-d H:i:s');
            $data['upload_date']      = date('d M. H:iA');
            $data['date']             = $this->input->post('start_date');
            $data['description']      = $this->input->post('description');
            $data['start_time']       = $this->input->post('start_time');
            $data['end_time']         = $this->input->post('end_time');
            $this->db->insert('zoom', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/meet/' . $param2, 'refresh');
        }
        if ($param1 == 'update') {
            $data['exp']              = $this->input->post('exp');
            $data['title']            = $this->input->post('title');
            $data['meeting_id']       = $this->input->post('zoom_meeting_id');
            $data['meeting_password'] = $this->input->post('zoom_meeting_password');
            $data['description']      = $this->input->post('description');
            $data['date']             = $this->input->post('start_date');
            $data['start_time']       = $this->input->post('start_time');
            $data['end_time']         = $this->input->post('end_time');
            $this->db->where('zoom_id', $param2);
            $this->db->update('zoom', $data);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/meet/' . $param3, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('zoom_id', $param2);
            $this->db->delete('zoom');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/meet/' . $param3, 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name']  = 'meet';
        $page_data['page_title'] = getEduAppGTLang('meet');
        $this->load->view('backend/index', $page_data);
    }

    //Admin dashboard function.
    function panel($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = getEduAppGTLang('dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Read and manage news function.
    function news($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            if ($param2 != '') {
                $this->crud->create_news_dash($param2);
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param2, 'refresh');
            } else {
                $this->crud->create_news();
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'update_panel') {
            $this->crud->update_panel_news($param2);
            if ($param3 != '') {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param3, 'refresh');
            } else {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'create_video') {
            if ($param2 != '') {
                $this->crud->create_video_dash($param2);
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param2, 'refresh');
            } else {
                $this->crud->create_video();
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'create_vimeo') {

            if ($param2 != '') {
                $this->crud->create_vimeo_dash($param2);
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param2, 'refresh');
            } else {
                $this->crud->create_vimeo();
                $this->crud->send_news_notify();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'update_news') {
            $this->crud->update_panel_news($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/news/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->delete_news($param2);
            if ($param3 != '') {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param3, 'refresh');
            } else {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'delete2') {
            $this->crud->delete_news($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/news/', 'refresh');
        }
        $page_data['page_name'] = 'news';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }

    //Private messages function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud->send_new_private_message();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'admin/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') {
            $this->crud->send_reply_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('reply_sent'));
            redirect(base_url() . 'admin/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;
            $this->crud->mark_thread_messages_read($param2);
        }
        $page_data['infouser'] = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = getEduAppGTLang('private_messages');
        $this->load->view('backend/index', $page_data);
    }

    //Chat groups function.
    function group($param1 = "group_message_home", $param2 = "", $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == "create_group") {
            $this->crud->create_group();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/group/', 'refresh');
        } elseif ($param1 == "delete_group") {
            $this->crud->deleteGroup($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/group/', 'refresh');
        } elseif ($param1 == "edit_group") {
            $this->crud->update_group($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/group/', 'refresh');
        } else if ($param1 == 'group_message_read') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'create_message_group') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'update_group') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'send_reply') {
            $this->crud->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'admin/group/group_message_read/' . $param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }

    //Pending users function.
    function pending($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'pending';
        $page_data['page_title'] = getEduAppGTLang('pending_users');
        $this->load->view('backend/index', $page_data);
    }

    //Students reports function.
    function students_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']   = html_escape($this->input->post('class_id'));
        $page_data['section_id']   = html_escape($this->input->post('section_id'));
        $page_data['subject_id']   = html_escape($this->input->post('subject_id'));
        $page_data['page_name']   = 'students_report';
        $page_data['page_title']  = getEduAppGTLang('students_report');
        $this->load->view('backend/index', $page_data);
    }

    //General reports function.
    function general_reports($class_id = '', $section_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']   = 'general_reports';
        $page_data['class_id']   = html_escape($this->input->post('class_id'));
        $page_data['section_id']   = html_escape($this->input->post('section_id'));
        $page_data['subject_id']   = html_escape($this->input->post('subject_id'));
        $page_data['page_title']  = getEduAppGTLang('general_reports');
        $this->load->view('backend/index', $page_data);
    }

    //Manage birthdays function.
    function birthdays()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }

    //Manage Librarians function.
    function librarian($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->user->createLibrarian();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/librarian/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->user->updateLibrarian($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/librarian/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $this->user->updateLibrarian($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/librarian_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->user->deleteLibrarian($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/librarian/', 'refresh');
        }
        $page_data['page_name']  = 'librarian';
        $page_data['page_title'] = getEduAppGTLang('librarians');
        $this->load->view('backend/index', $page_data);
    }

    //Create Invoice function.
    function new_payment($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'new_payment';
        $page_data['page_title'] = getEduAppGTLang('new_payment');
        $this->load->view('backend/index', $page_data);
    }

    //Manage accountants function.
    function accountant($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->user->createAccountant();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/accountant/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->user->updateAccountant($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/accountant/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $this->user->updateAccountant($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/accountant_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->user->deleteAccountant($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/accountant/', 'refresh');
        }
        $page_data['page_name']  = 'accountant';
        $page_data['page_title'] = getEduAppGTLang('accountants');
        $this->load->view('backend/index', $page_data);
    }

    //System notifications function.
    function notifications($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('id', $param2);
            $this->db->delete('notification');
            redirect(base_url() . 'admin/notifications/', 'refresh');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
        }
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    //Update academic settings function.
    function academic_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'do_update') {
            $this->crud->updateAcademicSettings();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/academic_settings/', 'refresh');
        }
        $page_data['page_name']  = 'academic_settings';
        $page_data['page_title'] = getEduAppGTLang('academic_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    //Check if student exist function.
    function query()
    {
        if (html_escape($_POST['b']) != "") {
            $this->db->like('name', html_escape($_POST['b']));
            $query = $this->db->get_where('student')->result_array();
            if (count($query) > 0) {
                foreach ($query as $row) {
                    echo '<p class="text-left text-white px15"><a class="text-left text-white text-bold" href="' . base_url() . 'admin/student_portal/' . $row['student_id'] . '/">' . $row['name'] . '</a>' . " &nbsp;" . $status . "" . "</p>";
                }
            } else {
                echo '<p class="col-md-12 text-left text-white text-bold">' . getEduAppGTLang('no_results') . '</p>';
            }
        }
    }

    //Create Student function.
    function new_student($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name']  = 'new_student';
        $page_data['page_title'] = getEduAppGTLang('admissions');
        $this->load->view('backend/index', $page_data);
    }

    //Grade Leves function.
    function grade($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic->createLevel();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/grade/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic->updateLevel($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/grade/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->academic->deleteLevel($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/grade/', 'refresh');
        }
        $page_data['page_name']  = 'grade';
        $page_data['page_title'] = getEduAppGTLang('grades');
        $this->load->view('backend/index', $page_data);
    }

    //All users and manage admin permissions function.
    function users($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'permissions') {
            $this->crud->setPermissions();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/users/', 'refresh');
        }
        $page_data['page_name']                 = 'users';
        $page_data['page_title']                = getEduAppGTLang('users');
        $this->load->view('backend/index', $page_data);
    }

    //Manage Admins function.
    function admins($param1 = '', $param2 = '')
    {
        if(isSuperAdmin()===false){
            redirect(base_url('admin/panel'), 'refresh');
        }
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->user->createAdmin();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/admins/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->user->updateAdmin($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/admins/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $this->user->updateAdmin($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/admin_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->db->where('admin_id', $param2);
            $this->db->delete('admin');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/admins/', 'refresh');
        }
        $page_data['page_name']     = 'admins';
        $page_data['page_title']    = getEduAppGTLang('admins');
        $this->load->view('backend/index', $page_data);
    }

    //Manage students function.
    function students($id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['page_name']   = 'students';
        $page_data['page_title']  = getEduAppGTLang('students');
        $page_data['class_id']  = $id;
        $this->load->view('backend/index', $page_data);
    }

    //Admin Profile function.
    function admin_profile($admin_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'admin_profile';
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $page_data['admin_id']  =  $admin_id;
        $this->load->view('backend/index', $page_data);
    }

    //Accountant profile function.
    function accountant_profile($accountant_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'accountant_profile';
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $page_data['accountant_id']  =  $accountant_id;
        $this->load->view('backend/index', $page_data);
    }

    //Librarian Profile function.
    function librarian_profile($librarian_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'librarian_profile';
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $page_data['librarian_id']  =  $librarian_id;
        $this->load->view('backend/index', $page_data);
    }

    //Librarian update profile function.
    function librarian_update($librarian_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'librarian_update';
        $page_data['page_title'] =  getEduAppGTLang('librarian_update');
        $page_data['librarian_id']  =  $librarian_id;
        $this->load->view('backend/index', $page_data);
    }

    //Accountant update profile function.
    function accountant_update($accountant_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'accountant_update';
        $page_data['page_title'] =  getEduAppGTLang('update_information');
        $page_data['accountant_id']  =  $accountant_id;
        $this->load->view('backend/index', $page_data);
    }

    //Admin update profile function.
    function admin_update($admin_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'admin_update';
        $page_data['page_title'] =  getEduAppGTLang('update_information');
        $page_data['admin_id']  =  $admin_id;
        $this->load->view('backend/index', $page_data);
    }

    //Update account for Admin function.
    function update_account($admin_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $output                  = $this->crud->getGoogleURL();
        $page_data['page_name']  = 'update_account';
        $page_data['output']     = $output;
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $this->load->view('backend/index', $page_data);
    }

    //Manage teachers function.
    function teachers($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'accept') {
            $this->user->acceptTeacher($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        if ($param1 == 'create') {
            $this->user->createTeacher();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->user->updateTeacher($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $this->user->updateTeacher($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/teacher_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->user->deleteTeacher($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/teachers/', 'refresh');
        }
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = getEduAppGTLang('teachers');
        $this->load->view('backend/index', $page_data);
    }

    //Teacher Profile function.
    function teacher_profile($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_profile';
        $page_data['page_title'] =  getEduAppGTLang('profile');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    //Teacher Update info function.
    function teacher_update($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_update';
        $page_data['page_title'] =  getEduAppGTLang('update_information');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    //Teacher Schedules function.
    function teacher_schedules($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_schedules';
        $page_data['page_title'] =  getEduAppGTLang('teacher_schedules');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    //Teacher subjects function.
    function teacher_subjects($teacher_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'teacher_subjects';
        $page_data['page_title'] =  getEduAppGTLang('teacher_subjects');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('backend/index', $page_data);
    }

    //Manage parents function.
    function parents($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->user->createParent();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->user->updateParent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $this->user->updateParent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/parent_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'accept') {
            $this->user->acceptParent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->user->deleteParent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/parents/', 'refresh');
        }
        $page_data['page_title']  = getEduAppGTLang('parents');
        $page_data['page_name']  = 'parents';
        $this->load->view('backend/index', $page_data);
    }

    //Delete student homework delivery function.
    function delete_delivery($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 != '') {
            $this->academic->deleteDelivery($param1);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/homework_details/' . $param2 . '/', 'refresh');
        }
    }

    //Notification center function.
    function notify($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send_emails') {
            $this->mail->sendEmailNotify();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('sent_successfully'));
            redirect(base_url() . 'admin/notify/', 'refresh');
        }
        if ($param1 == 'sms') {
            $this->crud->sendSMS();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('sent_successfully'));
            redirect(base_url() . 'admin/notify/', 'refresh');
        }
        $page_data['page_name']  = 'notify';
        $page_data['page_title'] = getEduAppGTLang('notifications');
        $this->load->view('backend/index', $page_data);
    }

    //Parent profile function.
    function parent_profile($parent_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['parent_id']  = $parent_id;
        $page_data['page_name']  = 'parent_profile';
        $page_data['page_title'] = getEduAppGTLang('profile');
        $this->load->view('backend/index', $page_data);
    }

    //Parent update profile function.
    function parent_update($parent_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['parent_id']  = $parent_id;
        $page_data['page_name']  = 'parent_update';
        $page_data['page_title'] = getEduAppGTLang('update_information');
        $this->load->view('backend/index', $page_data);
    }

    //Parent childs function.
    function parent_childs($parent_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['parent_id']  = $parent_id;
        $page_data['page_name']  = 'parent_childs';
        $page_data['page_title'] = getEduAppGTLang('parent_childs');
        $this->load->view('backend/index', $page_data);
    }

    //Delete Student function.
    function delete_student($student_id = '', $class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $this->crud->deleteStudent($student_id);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
        redirect(base_url() . 'admin/students/', 'refresh');
    }

    //Attendance selector function.
    function attendance_selector()
    {
        $timestamp = $this->crud->attendanceSelector();
        redirect(base_url() . 'admin/attendance/' . $this->input->post('data') . '/' . $timestamp, 'refresh');
    }

    //Attendance Update function.
    function attendance_update($class_id = '', $section_id = '', $subject_id = '', $timestamp = '')
    {
        $this->crud->attendanceUpdate($class_id, $section_id, $subject_id, $timestamp);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/attendance/' . base64_encode($class_id . '-' . $section_id . '-' . $subject_id) . '/' . $timestamp, 'refresh');
    }

    //Database tools function.
    function database($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'restore') {
            $this->crud->import_db();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('restored'));
            redirect(base_url() . 'admin/database/', 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud->create_backup();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('backup_created'));
            redirect(base_url() . 'admin/database/', 'refresh');
        }
        $page_data['page_name']                 = 'database';
        $page_data['page_title']                = getEduAppGTLang('database');
        $this->load->view('backend/index', $page_data);
    }

    //SMS API's Settings function.
    function sms($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->smsStatus();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'msg91') {
            $this->crud->msg91();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'clickatell') {
            $this->crud->clickatellSettings();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'twilio') {
            $this->crud->twilioSettings();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        if ($param1 == 'services') {
            $this->crud->services();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/sms/', 'refresh');
        }
        $page_data['page_name']  = 'sms';
        $page_data['page_title'] = getEduAppGTLang('sms');
        $this->load->view('backend/index', $page_data);
    }

    //Email settings function.
    function email($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'template') {
            $this->crud->emailTemplate($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/email/', 'refresh');
        }
        $page_data['page_name']  = 'email';
        $page_data['current_email_template_id']  = 1;
        $page_data['page_title'] = getEduAppGTLang('email_settings');
        $this->load->view('backend/index', $page_data);
    }

    //View teacher report function.
    function view_teacher_report()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'view_teacher_report';
        $page_data['page_title'] = getEduAppGTLang('teacher_report');
        $this->load->view('backend/index', $page_data);
    }

    //System translation function.
    function translate($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'update') {
            $page_data['edit_profile']  = $param2;
        }
        if ($param1 == 'update_language') {
            $this->crud->updateLang($param2);
        }
        if ($param1 == 'add') {
            $this->crud->createLang();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/translate/', 'refresh');
        }
        $page_data['page_name']  = 'translate';
        $page_data['page_title'] = getEduAppGTLang('translate');
        $this->load->view('backend/index', $page_data);
    }

    //Manage polls function.
    function polls($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $data['question']       = $this->input->post('question');
            foreach ($this->input->post('options') as $row) {
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

            if ($param2 != '') {
                $info   = base64_decode($param2);
                $ex     = explode('-', $info);

                $data['class_id']           = $ex[0];
                $data['section_id']         = $ex[1];
                $data['subject_id']         = $ex[2];
                $this->db->insert('polls', $data);
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param2, 'refresh');
            } else {
                $data['class_id']           = 0;
                $data['section_id']         = 0;
                $data['subject_id']         = 0;
                $this->db->insert('polls', $data);
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'create_wall') {
            $data['question'] = $this->input->post('question');
            foreach ($this->input->post('options') as $row) {
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
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/polls/', 'refresh');
        }
        if ($param1 == 'response') {
            $data['poll_code'] = $this->input->post('poll_code');
            $data['answer'] = $this->input->post('answer');
            $data['date2'] = date('h:i A');
            $user = $this->session->userdata('login_user_id');
            $user_type = $this->session->userdata('login_type');
            $data['user'] = $user_type . "-" . $user;
            $data['date'] = $this->crud->getDateFormat();
            $this->db->insert('poll_response', $data);
        }
        if ($param1 == 'delete') {
            $this->db->where('poll_code', $param2);
            $this->db->delete('polls');
            if ($param3 != '') {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/subject_dashboard/' . $param3, 'refresh');
            } else {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/panel/', 'refresh');
            }
        }
        if ($param1 == 'delete2') {
            $this->db->where('poll_code', $param2);
            $this->db->delete('polls');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/polls/', 'refresh');
        }
        $page_data['page_name']  = 'polls';
        $page_data['page_title'] = getEduAppGTLang('polls');
        $this->load->view('backend/index', $page_data);
    }

    //View poll details function.
    function view_poll($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['code'] = $code;
        $page_data['page_name']  = 'view_poll';
        $page_data['page_title'] = getEduAppGTLang('poll_details');
        $this->load->view('backend/index', $page_data);
    }

    //New poll function.
    function new_poll($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'new_poll';
        $page_data['page_title'] = getEduAppGTLang('new_poll');
        $this->load->view('backend/index', $page_data);
    }

    //Teacher Routine function.
    function teacher_routine()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $teacher_id = $this->input->post('teacher_id');
        $page_data['page_name']  = 'teacher_routine';
        $page_data['teacher_id']  = $teacher_id;
        $page_data['page_title'] = getEduAppGTLang('teacher_routine');
        $this->load->view('backend/index', $page_data);
    }

    //Student Profile function.
    function student_portal($student_id, $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->runningYear))->row()->class_id;
        $page_data['page_name']  = 'student_portal';
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $page_data['class_id']   =  $class_id;
        $this->load->view('backend/index', $page_data);
    }

    //Student update function.
    function student_update($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_update';
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Sutdent invoices function.
    function student_invoices($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_invoices';
        $page_data['page_title'] =  getEduAppGTLang('student_invoices');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //student class
    function student_profile_class_section($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_class_section';
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }
    function student_profile_active_course($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_active_course';
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }
    function activate_subject_student($student_id, $subject_id)
    {
        if(activateStudentSubject($student_id, $subject_id)){
            addStudentToMarkAndNotaCapacidadFromSubject($student_id, $subject_id);
        }
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/student_profile_active_course/' . $student_id);
    }
    function deactive_subject_student($student_id, $subject_id)
    {
        deactiveStudentSubject($student_id, $subject_id);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/student_profile_active_course/' . $student_id);
    }
    //add class and section
    function add_student_class_section()
    {
        $student_id = $this->input->post('student_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $roll = $this->input->post('roll');
        $is_active = $this->input->post('is_active');
        $running_year = getRunningYear();
        $this->db->where('student_id', $student_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        $this->db->where('year', $running_year);
        $query = $this->db->get('enroll');

        if ($query->num_rows() > 0) {
            $this->session->set_flashdata('flash_message_failed', "Failed! Duplicate Section Or class with same year");
            redirect(base_url() . 'admin/student_profile_class_section/' . $student_id);
        } else {
            $data = array(
                'student_id' => $student_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'year' => $running_year,
                'roll' => $roll,
                'is_active' => $is_active,
                'enroll_code' => substr(md5(rand(0, 1000000)), 0, 7),
                'date_added' => strtotime(date("Y-m-d H:i:s")),
            );
            $this->db->insert('enroll', $data);
            generateSubjectNewStudent($student_id);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/student_profile_class_section/' . $student_id);
        }
    }
    function edit_student_class_section()
    {
        $enroll_id = $this->input->post('enroll_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $roll = $this->input->post('roll');
        $student_id = $this->input->post('student_id');
        $is_active = $this->input->post('is_active');
        $running_year = getRunningYear();

        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        $this->db->where('year', $running_year);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get('enroll');

        if ($query->row()->enroll_id != $enroll_id) {
            $this->session->set_flashdata('flash_message_failed', "Failed! Duplicate Section or class with the same year for this student");
            redirect(base_url() . 'admin/student_profile_class_section/' . $student_id);
        } else {
            $data = array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'roll' => $roll,
                'is_active' => $is_active
            );

            $this->db->where('enroll_id', $enroll_id);
            $this->db->update('enroll', $data);

            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/student_profile_class_section/' . $student_id);
        }
    }
    function delete_student_class_section($enroll_id, $student_id)
    {
        $this->db->where('enroll_id', $enroll_id);
        $this->db->delete('enroll');
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/student_profile_class_section/' . $student_id);
    }


    //Student marks function.
    function student_marks($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($student_id == 'apply') {
            redirect(base_url() . 'admin/student_marks/' . $this->input->post('student_id') . '/' . $this->input->post('subject_id') . '/', 'refresh');
        }
        $page_data['page_name']  = 'student_marks';
        $page_data['page_title'] =  getEduAppGTLang('student_marks');
        $page_data['student_id'] =  $student_id;
        $page_data['subject_id'] =  $param1;
        $this->load->view('backend/index', $page_data);
    }

    //Student attendance report selector function.
    function student_attendance_report_selector()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['year']       = $this->input->post('year');
        $data['month']      = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url() . 'admin/student_profile_attendance/' . $this->input->post('student_id') . '/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] . '/' . $data['month'] . '/' . $data['year'] . '/', 'refresh');
    }

    //Student Profile Attendance function.
    function student_profile_attendance($student_id = '', $param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_attendance';
        $page_data['page_title'] =  getEduAppGTLang('student_attendance');
        $page_data['student_id'] =  $student_id;
        $page_data['subject_id'] =  $param3;
        $page_data['class_id'] =  $param1;
        $page_data['section_id'] =  $param2;
        $page_data['month'] =  $param4;
        $page_data['year'] =  $param5;
        $this->load->view('backend/index', $page_data);
    }

    //Student profile report function.
    function student_profile_report($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_profile_report';
        $page_data['page_title'] =  getEduAppGTLang('behavior');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Student info function.
    function student_info($student_id = '', $param1 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'student_info';
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //My account function.
    function my_account($param1 = "", $page_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'remove_facebook') {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '1') {
            $this->session->set_flashdata('error_message', getEduAppGTLang('google_err'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '3') {
            $this->session->set_flashdata('error_message', getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '2') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('google_true'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == '4') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == 'remove_google') {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('google_delete'));
            redirect(base_url() . 'admin/my_account/', 'refresh');
        }
        if ($param1 == 'update_profile') {
            $this->user->updateCurrentAdmin();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/update_account/', 'refresh');
        }
        $output                 = $this->crud->getGoogleURL();
        $data['page_name']      = 'my_account';
        $data['output']         = $output;
        $data['page_title']     = getEduAppGTLang('profile');
        $this->load->view('backend/index', $data);
    }

    //Book request function.
    function book_request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == "accept") {
            $this->academic->acceptBook($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('request_accepted_successfully'));
            redirect(site_url('admin/book_request/'), 'refresh');
        }
        if ($param1 == "reject") {
            $this->academic->rejectBook($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('request_rejected_successfully'));
            redirect(site_url('admin/book_request/'), 'refresh');
        }
        $data['page_name']  = 'book_request';
        $data['page_title'] = getEduAppGTLang('book_request');
        $this->load->view('backend/index', $data);
    }

    //Permissions request for teachers function.
    function request($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == "accept") {
            $this->crud->acceptRequest($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/request/', 'refresh');
        }
        if ($param1 == "reject") {
            $this->crud->rejectRequest($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('rejected_successfully'));
            redirect(base_url() . 'admin/request/', 'refresh');
        }
        $data['page_name']  = 'request';
        $data['page_title'] = getEduAppGTLang('permissions');
        $this->load->view('backend/index', $data);
    }

    //Permissions request for students function.
    function request_student($param1 = "", $param2 = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == "accept") {
            $this->crud->acceptStudentRequest($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/request/', 'refresh');
        }
        if ($param1 == "reject") {
            $this->crud->rejectStudentRequest($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('rejected_successfully'));
            redirect(base_url() . 'admin/request/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->deletePermission($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/request_student/', 'refresh');
        }
        if ($param1 == 'delete_teacher') {
            $this->crud->deleteTeacherPermission($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/request_student/', 'refresh');
        }
        $data['page_name']  = 'request_student';
        $data['page_title'] = getEduAppGTLang('reports');
        $this->load->view('backend/index', $data);
    }

    //Create message for reports function.
    function create_report_message($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $this->crud->createReportMessage();
    }

    //View report function.
    function view_report($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'update') {
            $this->crud->updateReport($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/view_report/' . $param2, 'refresh');
        }
        $page_data['report_code'] = $param1;
        $page_data['page_title']  =   getEduAppGTLang('report_details');
        $page_data['page_name']   = 'view_report';
        $this->load->view('backend/index', $page_data);
    }

    //Manage Online exam status function.
    function manage_online_exam_status($online_exam_id = "", $status = "", $data)
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $this->crud->manage_online_exam_status($online_exam_id, $status);
        redirect(base_url() . 'admin/online_exams/' . $data . "/", 'refresh');
    }

    //Online exams function.
    function online_exams($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'edit') {
            if ($this->input->post('class_id') > 0 && $this->input->post('section_id') > 0 && $this->input->post('subject_id') > 0) {
                $this->crud->update_online_exam();
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
                redirect(base_url() . 'admin/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', getEduAppGTLang('error_updated'));
                redirect(base_url() . 'admin/exam_edit/' . $this->input->post('online_exam_id'), 'refresh');
            }
        }
        if ($param1 == 'questions') {
            $this->crud->add_questions();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/exam_questions/' . $param2, 'refresh');
        }
        if ($param1 == 'delete_questions') {
            $this->db->where('question_id', $param2);
            $this->db->delete('questions');
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/exam_questions/' . $param3, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->academic->deleteOnlineExam($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/online_exams/' . $param3 . "/", 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['page_name']  = 'online_exams';
        $page_data['page_title'] = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Update online exam function.
    function exam_edit($exam_code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name']      = 'exam_edit';
        $page_data['page_title']     = getEduAppGTLang('update_exam');
        $this->load->view('backend/index', $page_data);
    }

    //View exam results function.
    function exam_results($exam_code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['online_exam_id'] = $exam_code;
        $page_data['page_name']      = 'exam_results';
        $page_data['page_title']     = getEduAppGTLang('exams_results');
        $this->load->view('backend/index', $page_data);
    }

    //Homework details function.
    function homeworkroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'file') {
            $page_data['room_page']    = 'homework_file';
            $page_data['homework_code'] = $param2;
        } else if ($param1 == 'details') {
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }
        $page_data['homework_code'] =   $param1;
        $page_data['page_name']   = 'homework_room';
        $page_data['page_title']  = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Homework Edit function.
    function homework_edit($homework_code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['homework_code'] = $homework_code;
        $page_data['page_name'] = 'homework_edit';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Single Homework Function.
    function single_homework($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['answer_id'] = $param1;
        $page_data['page_name'] = 'single_homework';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Homework details function.
    function homework_details($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['homework_code'] = $param1;
        $page_data['page_name']     = 'homework_details';
        $page_data['page_title']    = getEduAppGTLang('homework_details');
        $this->load->view('backend/index', $page_data);
    }

    //New online exam function.
    function new_exam($data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']  = 'new_exam';
        $page_data['page_title'] = getEduAppGTLang('new_exam');
        $this->load->view('backend/index', $page_data);
    }

    //Homework function.
    function homework($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $homework_code = $this->academic->createHomework();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/homeworkroom/' . $homework_code . '/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic->updateHomework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/homework_edit/' . $param2, 'refresh');
        }
        if ($param1 == 'review') {
            $this->academic->reviewHomework();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/homework_details/' . $param2, 'refresh');
        }
        if ($param1 == 'single') {
            $this->academic->singleHomework();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/single_homework/' . $this->input->post('id'), 'refresh');
        }
        if ($param1 == 'edit') {
            $this->crud->update_homework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/homeworkroom/edit/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->delete_homework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/homework/' . $param3 . "/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'homework';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Manage Forums funcion.
    function forum($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic->createForum();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/forum/' . $param2 . "/", 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic->updateForum($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/edit_forum/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->delete_post($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/forum/' . $param3 . "/", 'refresh');
        }
        $page_data['data'] = $param1;
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Study Material Function.
    function study_material($task = "", $document_id = "", $data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($task == "create") {
            $this->academic->createMaterial();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_uploaded'));
            redirect(base_url() . 'admin/study_material/' . $document_id . "/", 'refresh');
        }
        if ($task == "delete") {
            $this->crud->delete_study_material_info($document_id);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/study_material/' . $data . "/");
        }
        $page_data['data']          = $task;
        $page_data['page_name']     = 'study_material';
        $page_data['page_title']    = getEduAppGTLang('study_material');
        $this->load->view('backend/index', $page_data);
    }

    //Edit forum function
    function edit_forum($code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'edit_forum';
        $page_data['page_title'] = getEduAppGTLang('update_forum');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }

    //Forum details function.
    function forumroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'comment') {
            $page_data['room_page']    = 'comments';
            $page_data['post_code'] = $param2;
        } else if ($param1 == 'posts') {
            $page_data['room_page'] = 'post';
            $page_data['post_code'] = $param2;
        } else if ($param1 == 'edit') {
            $page_data['room_page'] = 'post_edit';
            $page_data['post_code'] = $param2;
        }
        $page_data['page_name']   = 'forum_room';
        $page_data['post_code']   = $param1;
        $page_data['page_title']  = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Forum Message Function.
    function forum_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'add') {
            $this->crud->create_post_message(html_escape($this->input->post('post_code')));
        }
    }

    //Manage multiple choice questions function.
    function manage_multiple_choices_options()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/admin/manage_multiple_choices_options', $page_data);
    }

    //Manage image questions function.
    function manage_image_options()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['number_of_options'] = $this->input->post('number_of_options');
        $this->load->view('backend/admin/manage_image_options', $page_data);
    }

    //Load question type function.
    function load_question_type($type, $online_exam_id)
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['question_type']  = $type;
        $page_data['online_exam_id'] = $online_exam_id;
        $this->load->view('backend/admin/online_exam_add_' . $type, $page_data);
    }

    //Online exam questions function.
    function manage_online_exam_question($online_exam_id = "", $task = "", $type = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($task == 'add') {
            if ($type == 'multiple_choice') {
                $this->crud->add_multiple_choice_question_to_online_exam($online_exam_id);
            } elseif ($type == 'true_false') {
                $this->crud->add_true_false_question_to_online_exam($online_exam_id);
            } elseif ($type == 'image') {
                $this->crud->add_image_question_to_online_exam($online_exam_id);
            } elseif ($type == 'fill_in_the_blanks') {
                $this->crud->add_fill_in_the_blanks_question_to_online_exam($online_exam_id);
            }
            redirect(base_url() . 'admin/examroom/' . $online_exam_id, 'refresh');
        }
    }

    //Online exam details function.
    function examroom($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']   = 'exam_room';
        $page_data['online_exam_id']  = $param1;
        $page_data['page_title']  = getEduAppGTLang('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    //Create Online Exam function.
    function create_online_exam($info = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $this->academic->createOnlineExam();
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/online_exams/' . $info . "/", 'refresh');
    }

    //Manage invoices function.
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'bulk') {
            $this->payment->createBulkInvoice();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/students_payments/', 'refresh');
        }
        if ($param1 == 'create') {
            $this->payment->singleInvoice();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/students_payments/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $this->payment->updateInvoice($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/students_payments/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->payment->deleteInvoice($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/students_payments/', 'refresh');
        }
    }

    //Get all students to Bulk invoice function.
    function get_class_students_mass($class_id = '')
    {
        $this->crud->fetchStudents($class_id);
    }

    //Delete question from online exam function.
    function delete_question_from_online_exam($question_id)
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $this->crud->delete_question_from_online_exam($question_id);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
        redirect(base_url() . 'admin/examroom/' . $online_exam_id, 'refresh');
    }

    //Update online exam question function.
    function update_online_exam_question($question_id = "", $task = "", $online_exam_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $online_exam_id = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->online_exam_id;
        $type = $this->db->get_where('question_bank', array('question_bank_id' => $question_id))->row()->type;
        if ($task == "update") {
            if ($type == 'multiple_choice') {
                $this->crud->update_multiple_choice_question($question_id);
            } elseif ($type == 'true_false') {
                $this->crud->update_true_false_question($question_id);
            } elseif ($type == 'image') {
                $this->crud->update_image_question($question_id);
            } elseif ($type == 'fill_in_the_blanks') {
                $this->crud->update_fill_in_the_blanks_question($question_id);
            }
            redirect(base_url() . 'admin/examroom/' . $online_exam_id, 'refresh');
        }
        $page_data['question_id'] = $question_id;
        $page_data['page_name'] = 'update_online_exam_question';
        $page_data['page_title'] = getEduAppGTLang('update_questions');
        $this->load->view('backend/index', $page_data);
    }

    //Search query function.
    function search_query($search_key = '')
    {
        if ($_POST) {
            redirect(base_url() . 'admin/search_results?query=' . base64_encode(html_escape($this->input->post('search_key'))), 'refresh');
        }
    }

    //Search results function.
    function search_results()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['query']) == "") {
            redirect(base_url(), 'refresh');
        }
        $page_data['search_key'] =  html_escape($_GET['query']);
        $page_data['page_name']  =  'search_results';
        $page_data['page_title'] =  getEduAppGTLang('search_results');
        $this->load->view('backend/index', $page_data);
    }

    //Invoice details function.
    function invoice_details($id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['invoice_id'] = $id;
        $page_data['page_title'] = getEduAppGTLang('invoice_details');
        $page_data['page_name']  = 'invoice_details';
        $this->load->view('backend/index', $page_data);
    }

    //Loking behavior report function.
    function looking_report($report_code = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['code'] = $report_code;
        $page_data['page_name'] = 'looking_report';
        $page_data['page_title'] = getEduAppGTLang('report_details');
        $this->load->view('backend/index', $page_data);
    }

    //Manage students function.
    function student($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'reject') {
            $this->user->rejectStudent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/pending/', 'refresh');
        }
        if ($param1 == 'excel') {
            $this->user->downloadExcel();
        }
        if ($param1 == 'addmission') {
            $student_id = $this->user->studentAdmission();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            if ($this->input->post('download_pdf') == '1') {
                redirect(base_url() . 'admin/download_file/' . $student_id . '/' . base64_encode($this->input->post('password')), 'refresh');
            } else {
                redirect(base_url() . 'admin/new_student/', 'refresh');
            }
        }
        if ($param1 == 'do_update') {
            $this->user->updateStudent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/student_update/' . $param2 . '/', 'refresh');
        }
        if ($param1 == 'do_updates') {
            $this->user->updateModalStudent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/students/', 'refresh');
        }
        if ($param1 == 'accept') {
            $this->user->acceptStudent($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/students/', 'refresh');
        }
        if ($param1 == 'bulk') {
            $this->user->bulkStudents();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/students/', 'refresh');
        }
    }

    //Promote students function.
    function student_promotion($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'promote') {
            $this->academic->promoteStudents();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_promoted'));
            redirect(base_url() . 'admin/student_promotion', 'refresh');
        }
        $page_data['page_title']    = getEduAppGTLang('student_promotion');
        $page_data['page_name']  = 'student_promotion';
        $this->load->view('backend/index', $page_data);
    }

    //Get students to promote function.
    function get_students_to_promote($class_id_from = '', $class_id_to  = '', $running_year  = '', $promotion_year = '', $section_id_from = '')
    {
        $page_data['class_id_from']     =   $class_id_from;
        $page_data['section_id_from']   =   $section_id_from;
        $page_data['class_id_to']       =   $class_id_to;
        $page_data['running_year']      =   $running_year;
        $page_data['promotion_year']    =   $promotion_year;
        $this->load->view('backend/admin/student_promotion_selector', $page_data);
    }

    //View marks function.
    function view_marks($student_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id                = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->runningYear))->row()->class_id;
        $page_data['class_id']   =   $class_id;
        $page_data['page_name']  = 'view_marks';
        $page_data['page_title'] = getEduAppGTLang('marks');
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Subject marks function.
    function subject_marks($data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   = getEduAppGTLang('subject_marks');
        $this->load->view('backend/index', $page_data);
    }

    //Subject dashboard function.
    function subject_dashboard($data = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        if ($this->db->get_where('settings', array('type' => 'account_id'))->row()->description != '') {
            $explode = explode('-', base64_decode($data));
            $haveFolder = $this->db->get_where('subject', array('subject_id' => $explode[2]))->row()->drive_folder;

            if ($haveFolder == '') {
                try {
                    $this->drive_model->createSubjectFolder($explode[2]);
                } catch (\Throwable $e) {
                    $this->session->set_flashdata('flash_message_failed', 'failed automatic creae folder in GDrive. This subject doesnt have folder in GDrive ');
                }
            }
        }

        $page_data['data']         = $data;
        $page_data['page_name']    = 'subject_dashboard';
        $page_data['page_title']   = getEduAppGTLang('subject_dashboard');
        $this->load->view('backend/index', $page_data);
    }


    //Manage subjects function.
    function courses($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic->createCourse();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/cursos/' . base64_encode($param2) . "/", 'refresh');
        }
        if ($param1 == 'update_labs') {
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $this->academic->updateCourseActivity($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/upload_marks/' . base64_encode($class_id . "-" . $this->input->post('section_id') . "-" . $param2) . '/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic->updateCourse($param2);
            $class_id = $this->db->get_where('subject', array('subject_id' => $param2))->row()->class_id;
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/cursos/' . base64_encode($class_id . "-" . $this->input->post('section_id') . '-' . $param2) . "/", 'refresh');
        }
        if ($param1 == 'delete') {
            $this->academic->deleteCourse($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/cursos/', 'refresh');
        }
        if ($param1 == 'duplicate') {
            $this->academic->duplicateCourse();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_duplicated'));
            redirect(base_url() . 'admin/cursos/' . base64_encode($param2) . "/", 'refresh');
        }
    }

    //Online exam result function.
    function online_exam_result($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name']  = 'online_exam_result';
        $page_data['param2']     = $param1;
        $page_data['student_id'] = $param2;
        $page_data['page_title'] = getEduAppGTLang('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    //Manage your classes.
    function manage_classes($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic->createClass();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic->updateClass($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->academic->deleteClass($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/grados/', 'refresh');
        }
    }

    //Get subjects by classId function
    function get_subject($class_id = '')
    {
        $subject = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    //Download virtual book function.
    function download_book($libro_code = '')
    {
        $file_name = $this->db->get_where('libreria', array('libro_code' => $libro_code))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("public/uploads/libreria/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

    //Manage school sections function.
    function section($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class = $this->input->post('class_id');
        if ($class == '') {
            $class = $this->db->get('class')->first_row()->class_id;
        }
        if ($param1 == 'create') {
            $this->academic->createSection();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/section/' . $this->input->post('class_id') . "/", 'refresh');
        }
        if ($param1 == 'update') {
            $this->academic->updateSection($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/section/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->academic->deleteSection($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/section/', 'refresh');
        }
        $page_data['page_name']  = 'section';
        $page_data['page_title'] = getEduAppGTLang('sections');
        $page_data['class_id']   = $class;
        $this->load->view('backend/index', $page_data);
    }

    //Get sections by classId function.
    function get_class_section($class_id = '')
    {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        echo '<option value="">' . getEduAppGTLang('select') . '</option>';
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    //Get Students by sectionId function.
    function get_class_stundets($section_id = '')
    {
        $students = $this->db->get_where('enroll', array('section_id' => $section_id, 'year' => $this->runningYear))->result_array();
        foreach ($students as $row) {
            echo '<option value="' . $row['student_id'] . '">' . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->first_name . " " . $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->last_name  . '</option>';
        }
    }

    //Get subjects by sectionId function.
    function get_class_subject($section_id = '')
    {
        $subjects = $this->db->get_where('subject', array('section_id' => $section_id))->result_array();
        echo '<option value="">' . getEduAppGTLang('select') . '</option>';
        foreach ($subjects as $row) {
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
        }
    }

    //Get Students by SectionId function.
    function get_class_students_section($section_id = '')
    {
        $students = $this->db->get_where('enroll', array('section_id' => $section_id, 'year' => $this->runningYear))->result_array();
        foreach ($students as $row) {
            echo '<option value="' . $row['student_id'] . '">' . $this->crud->get_name('student', $row['student_id']) . '</option>';
        }
    }

    function get_exm_($section_id = '')
    {
        $students = $this->db->get_where('exam', array('subject_id' => $section_id))->result_array();
        echo '<option value="">' . getEduAppGTLang('select') . '</option>';
        foreach ($students as $row) {
            echo '<option value="' . $row['exam_id'] . '">' . $row['name'] . '</option>';
        }
    }

    //Manage semesters function.
    function semesters($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'apply') {
            redirect(base_url() . 'admin/semesters/' . $this->input->post('class_id') . '/' . $this->input->post('section_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        if ($param1 == 'create') {
            $this->academic->createSemester();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/semesters/' . $this->input->post('class_id') . '/' . $this->input->post('section_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        if ($param1 == 'update') {
            $qrd = $this->db->get_where('exam', array('exam_id' => $param2))->row();
            $this->academic->updateSemester($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/semesters/' . $qrd->class_id . '/' . $qrd->section_id . '/' . $qrd->subject_id, 'refresh');
        }
        if ($param1 == 'delete') {
            $qrd = $this->db->get_where('exam', array('exam_id' => $param2))->row();
            $this->academic->deleteSemester($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/semesters/' . $qrd->class_id . '/' . $qrd->section_id . '/' . $qrd->subject_id, 'refresh');
        }
        $page_data['class_id']  = $param1;
        $page_data['section_id']  = $param2;
        $page_data['subject_id']  = $param3;
        $page_data['page_name']  = 'semester';
        $page_data['page_title'] = getEduAppGTLang('semesters');
        $this->load->view('backend/index', $page_data);
    }

    //Update Book Function.
    function update_book($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['book_id'] = $param1;
        $page_data['page_name']  =   'update_book';
        $page_data['page_title'] = getEduAppGTLang('update_book');
        $this->load->view('backend/index', $page_data);
    }

    //Manage marks(competences - capacities)
    function manage_marks($param1 = '', $datainfo = '', $exam_id = '', $orden = '', $foreign_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'new_activity') {
            $this->mark->newActivity($datainfo, $exam_id);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_created'));
        }
        if ($param1 == 'edit_capacities') {
            $this->mark->updateActivity($foreign_id);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        }
        if ($param1 == 'delete_capacity') {
            $this->mark->delete_capacity($foreign_id, $orden);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
        }
        redirect(base_url() . 'admin/upload_marks/' . $datainfo . '/' . $exam_id . '/' . $orden . '/', 'refresh');
    }

    //Update marks function.
    function notas_update($datainfo = '', $exam_id = '', $orden = '')
    {
        $this->mark->notasUpdate($datainfo, $exam_id, $orden);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/upload_marks/' . $datainfo . '/' . $exam_id . '/' . $orden . '/', 'refresh');
    }

    //Upload your marks function.
    function upload_marks($datainfo = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param2 != "") {
            $page = $param2;
        } else {
            $info = base64_decode($datainfo);
            $ex = explode('-', $info);

            $query = $this->db->get_where('exam', array('section_id' => $ex[1], 'class_id' => $ex[0], 'subject_id' => $ex[2]))->first_row()->exam_id;
            if ($query > 0) {
                $page = $query;
            } else {
                $insert['section_id'] = $ex[1];
                $insert['class_id']   = $ex[0];
                $insert['subject_id'] = $ex[2];
                $insert['name']       = 'First exam';
                $this->db->insert('exam', $insert);
                $page = $this->db->insert_id();
            }
        }
        if ($param3 != "") {
            $order = $param3;
        } else {
            $order = 1;
        }
        $this->mark->uploadMarks($datainfo, $page, $order);
        $page_data['exam_id'] = $page;
        $page_data['data'] = $datainfo;
        $page_data['order']         = $order;
        $page_data['page_name']  =   'upload_marks';
        $page_data['page_title'] = getEduAppGTLang('upload_marks');
        $this->load->view('backend/index', $page_data);
    }
    function blocked_mark($datainfo = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param2 != "") {
            $page = $param2;
        } else {
            $info = base64_decode($datainfo);
            $ex = explode('-', $info);

            $query = $this->db->get_where('exam', array('section_id' => $ex[1], 'class_id' => $ex[0], 'subject_id' => $ex[2]))->first_row()->exam_id;
            if ($query > 0) {
                $page = $query;
            } else {
                $insert['section_id'] = $ex[1];
                $insert['class_id']   = $ex[0];
                $insert['subject_id'] = $ex[2];
                $insert['name']       = 'First exam';
                $this->db->insert('exam', $insert);
                $page = $this->db->insert_id();
            }
        }
        if ($param3 != "") {
            $order = $param3;
        } else {
            $order = 1;
        }
        $this->mark->uploadMarks($datainfo, $page, $order);
        $page_data['exam_id'] = $page;
        $page_data['data'] = $datainfo;
        $page_data['order']         = $order;
        $page_data['page_name']  =   'blocked_mark';
        $page_data['page_title'] = getEduAppGTLang('blocked_mark');
        $this->load->view('backend/index', $page_data);
    }

    //Update marks function.
    function marks_update($exam_id = '', $class_id = '', $section_id = '', $subject_id = '')
    {
        $info = $this->academic->updateMarks($exam_id, $class_id, $section_id, $subject_id);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/upload_marks/' . $info . '/' . $exam_id . '/', 'refresh');
    }

    //Tabulation sheet function.
    function tab_sheet_print($class_id  = '', $section_id = '', $subject_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']    = $class_id;
        $page_data['exam_id']     = $exam_id;
        $page_data['section_id']  = $section_id;
        $page_data['subject_id']  = $subject_id;
        $this->load->view('backend/admin/tab_sheet_print', $page_data);
    }

    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if ($param1 == 'save') {
            $section_id = $_GET['section_id'];
            $class_id = $_GET['class_id'];
            $this->db->where('class_id', $class_id);
            $this->db->where('section_id', $section_id);
            $this->db->delete('class_routine');
            $arr = $_GET['p'];
            if (is_array($arr)) {
                foreach ($arr as $p) {
                    list($sub_id, $row, $col) = explode('_', $p);
                    $sub_id = substr($sub_id, 0, 2);
                    $teacher_id = $this->db->get_where('subject', array('subject_id' => $sub_id))->row()->teacher_id;
                    $this->db->query("insert into class_routine (subject_id, tbl_row, tbl_col,section_id, class_id, teacher_id) values ('$sub_id', $row, $col,$section_id, $class_id, $teacher_id)");
                }
            }
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/class_routine_view/' . $class_id . '/' . $section_id . '/', 'refresh');
        }
    }

    function class_routine_view($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'apply') {
            redirect(base_url() . 'admin/class_routine_view/' . $this->input->post('class_id') . '/' . $this->input->post('section_id'), 'refresh');
        }
        $page_data['page_name']  = 'class_routine_view';
        $page_data['id']  =   $param1;
        $page_data['section_id']  =   $param2;
        $page_data['page_title'] = getEduAppGTLang('class_routine');
        $this->load->view('backend/index', $page_data);
    }
     function branch_and_shifts()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'branch_and_shifts';
        $page_data['page_title'] = getEduAppGTLang('branch_and_shifts');
        $this->load->view('backend/index', $page_data);
    }
    function transfer_data($param1=null,$param2=null)
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if($param1 == 'failed'){
            $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('failed_to_transfer').' '. urldecode($param2));
        }
        $page_data['page_name']  = 'transfer_data';
        $page_data['page_title'] = getEduAppGTLang('transfer_data');
        $this->load->view('backend/index', $page_data);
    }
    // function transfer_data_action()
    // {
    //     if ($this->session->userdata('admin_login') != 1) {
    //         redirect(base_url(), 'refresh');
    //     }
    //     $subject_id_source= $this->input->post('subject_id_source');
    //     $subject_id_target= $this->input->post('subject_id_target');
    //     if($subject_id_source == $subject_id_target){
    //         redirect(base_url() . 'admin/transfer_data/failed/'.getEduAppGTLang('source_and_target_subjects_are_same'));
    //     }
    //     $response = $this->academic->transferSubject($subject_id_source,$subject_id_target);
    //     if ($response['status'] === true) {
    //         $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_transfer'));
    //         redirect(base_url() . 'admin/transfer_data/');
    //     } else {
    //         redirect(base_url() . 'admin/transfer_data/failed/' . $response['message']);
    //     }
    // }
    function transfer_data_action($subject_id_source, $subject_id_target)
    {
        $this->output->enable_profiler(TRUE);

        $exam= true;
        $activity= true;
        $grade = true;
        $attendance = true;
        $subject_source = getSubjectDetailBySubjectId($subject_id_source);
       
        $exam_source = getAllExamBySubjectDetail($subject_id_source,$subject_source->class_id,$subject_source->section_id);

        $subject_target = getSubjectDetailBySubjectId($subject_id_target);
        
        if($exam){
            if ($exam_source) {
                foreach ($exam_source as $exam_sources) {
                    $this->db->insert('exam', array('name' => $exam_sources->name, 'subject_id' => $subject_id_target, 'class_id' => $subject_target->class_id, 'section_id' => $subject_target->section_id));
                    $new_exam_id = $this->db->insert_id();


                    if($activity){
                        $mark_activity_source = $this->db->get_where('mark_activity', array('exam_id' => $exam_sources->exam_id))->result();
                        if ($mark_activity_source) {
                            foreach ($mark_activity_source as $mark_activity_sources) {
                                $this->db->insert('mark_activity', array(
                                    'name' => $mark_activity_sources->name,
                                    'exam_id' => $new_exam_id,
                                    'promedio' => $mark_activity_sources->promedio,
                                    'class_id' => $subject_target->class_id,
                                    'section_id' => $subject_target->section_id,
                                    'subject_id' => $subject_id_target,
                                    'year' => $subject_target->year,
                                    'is_calculate_avg' => $mark_activity_sources->is_calculate_avg,
                                    'percent' => $mark_activity_sources->percent,
                                    'reason' => $mark_activity_sources->reason,
                                ));
                                $new_mark_activity_id = $this->db->insert_id();


                                if($grade){
                                    $student_subject_source = getStudentBySubjectId($subject_id_source);
                                    
                                    //insert new student to subject
                                    foreach($student_subject_source as $students){
                                        //cek enroll
                                        $isStudentEnrolled=isStudentEnrolled($students, $subject_target->class_id, $subject_target->section_id);
                                        if($isStudentEnrolled==false){
                                            $data=[
                                                'student_id' => $students,
                                                'enroll_code' => substr(md5(rand(0, 1000000)), 0, 7),
                                                'class_id' => $subject_target->class_id,
                                                'section_id' => $subject_target->section_id,
                                                'roll' => getRollByClassAndSection($subject_source->class_id, $subject_source->section_id)->roll,
                                                'is_active' => 1,
                                                'date_added' => strtotime(date("Y-m-d H:i:s")),
                                                'year' =>getRunningYear(),
                                            ];
                                            $this->db->insert('enroll', $data);
                                        }
                                        addStudentToSubject($students,$subject_id_target);
                                        addStudentToMark($students,$subject_id_target,$subject_target->class_id,$subject_target->section_id,$new_exam_id);
                                        addStudentToNotacapacidad($students,$new_mark_activity_id);
                                        //masukan nilai mark lama ke mark subject baru
                                        transferMarkOldToMarkNew($students, $exam_sources->exam_id, $new_exam_id, $subject_id_target, $subject_target->class_id, $subject_target->section_id);
                                        transferNotaCapacidadOldTonotaCapacidadNew($students, $mark_activity_sources->mark_activity_id, $new_mark_activity_id);
                                    }
                                    $student_subject_source = getStudentBySubjectId($subject_id_source);
                                    foreach($student_subject_source as $studentExiting){
                                        addStudentToMark($students, $subject_id_target, $subject_target->class_id, $subject_target->section_id, $new_exam_id);
                                        addStudentToNotacapacidad($students, $new_mark_activity_id);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        if($attendance){
            $student_subject_source = getStudentBySubjectId($subject_id_source);
            foreach($student_subject_source as $students){
                //cek enroll
                $isStudentEnrolled=isStudentEnrolled($students, $subject_target->class_id, $subject_target->section_id);
                if($isStudentEnrolled==false){
                    $data=[
                        'student_id' => $students,
                        'enroll_code' => substr(md5(rand(0, 1000000)), 0, 7),
                        'class_id' => $subject_target->class_id,
                        'section_id' => $subject_target->section_id,
                        'roll' => getRollByClassAndSection($subject_source->class_id, $subject_source->section_id)->roll,
                        'is_active' => 1,
                        'date_added' => strtotime(date("Y-m-d H:i:s")),
                        'year' =>getRunningYear(),
                    ];
                    $this->db->insert('enroll', $data);
                }
                addStudentToSubject($students, $subject_id_target);
                addStudentToMarkIfNotExist($students, $subject_id_target, $subject_target->class_id, $subject_target->section_id);
                addStudentToNotacapacidadIfNotExist($students, $subject_id_target, $subject_target->class_id, $subject_target->section_id);
                //belum ada fitur cek dulu sebelum insert
                transferOldAttendanceToNew($students, $subject_id_source, $subject_id_target, $subject_target->class_id, $subject_target->section_id);
            }
        }



       
    }
    function import($type)
    {
        if($type == 'student'){
            $response = $this->user->importStudent();
            if ($response['status'] === true) {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
                redirect(base_url() . 'admin/import_data/');
            } else {
                redirect(base_url() . 'admin/import_data/failed/'.$response['message']);
            }
        }
    }

    //Manage attendance function.
    function attendance($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['timestamp']  = $param2;
        $page_data['page_name']  =  'attendance';
        $page_data['page_title'] =  getEduAppGTLang('attendance');
        $this->load->view('backend/index', $page_data);
    }
    function student_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['timestamp']  = $param2;
        $page_data['page_name']  =  'student_list';
        $page_data['page_title'] =  getEduAppGTLang('student_list');
        $this->load->view('backend/index', $page_data);
    }
    function certificate_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['timestamp']  = $param2;
        $page_data['page_name']  =  'certificate_list';
        $page_data['page_title'] =  getEduAppGTLang('certificate_list');
        $this->load->view('backend/index', $page_data);
    }
    function generate_certificate()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $student_id = $this->input->post('student_id');
        $subject_id = $this->input->post('subject_id');
        $course= $this->input->post('course');
        $certCode=generateRandomString(10);
        do {
            $certCode = generateRandomString(10);
        } while (!isCertCodeCanUse($certCode));
        $this->load->library('ciqrcode');

        $qr_folder = FCPATH . "public/uploads/certificateqr/";
        $qr_filename = $certCode . ".png";

        if (!file_exists($qr_folder)) {
            mkdir($qr_folder, 0755, true);
        }
        $params['data'] = base_url() . 'verification/course_certificate/' . $certCode;
        $params['level'] = 'H';
        $params['size'] = 20;
        $params['savename'] = $qr_folder . $qr_filename;

        // Generate QR Code
        $this->ciqrcode->generate($params);

        $data = [
            'cert_code' => $certCode,
            'cert_generated_at' => date('Y-m-d H:i:s'),
            'is_finish'=> 1,
        ];

        $this->db->where('student_id', $student_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->update('student_subject', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        } else {
            $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('failed_to_update'));
        }
        redirect(base_url() . 'admin/certificate_list/'.$course,'refresh');
    }

    //Manage attendance function.
    function manage_attendance($class_id = '', $section_id = '', $timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id'] = $class_id;
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'manage_attendance';
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = getEduAppGTLang('attendance');
        $this->load->view('backend/index', $page_data);
    }

    //Get Sections by ClassId in dropdown function.
    function get_sectionss($class_id = '')
    {
        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_shifts($branch_id = '')
    {
        $sections = $this->db->get_where('shifts', array('branch_id' => $branch_id,'status'=>'ACTIVE'))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['shifts_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_class($branch_id = '')
    {
        $sections = $this->db->get_where('class', array('branch_id' => $branch_id))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_exam($subject_id = '')
    {
        $exam = $this->db->get_where('exam', array('subject_id' => $subject_id,'is_final'=>0))->result_array();
        foreach ($exam as $row) {
            echo '<option value="' . $row['exam_id'] . '">' . $row['name'] . '</option>';
        }
    }
    function get_exam_section($section_id = '')
    {
        $this->db->select('exam.*, subject.name as subject_name');
        $this->db->from('exam');
        $this->db->join('subject', 'exam.subject_id = subject.subject_id', 'inner');
        $this->db->where('exam.section_id', $section_id);
        $exam = $this->db->get()->result_array();
        foreach ($exam as $row) {
            echo '<option value="' . $row['exam_id'] . '">' . $row['name'].' ('.$row['subject_name'].')' . '</option>';
        }
    }
    

    //Attendance report function.
    function attendance_report($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '')
    {
        if ($param1 == 'check') {
            $data['class_id']    = $this->input->post('class_id');
            $data['subject_id']  = $this->input->post('subject_id');
            $data['year']        = $this->input->post('year');
            $data['month']       = $this->input->post('month');
            $data['section_id']  = $this->input->post('section_id');
            redirect(base_url() . 'admin/attendance_report/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] . '/' . $data['month'] . '/' . $data['year'], 'refresh');
        }
        $page_data['class_id']    = $param1;
        $page_data['section_id']  = $param2;
        $page_data['subject_id']  = $param3;
        $page_data['month']       = $param4;
        $page_data['year']        = $param5;
        $page_data['page_name']   = 'attendance_report';
        $page_data['page_title']  = getEduAppGTLang('attendance_report');
        $this->load->view('backend/index', $page_data);
    }
    function grades_report($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '')
    {
        if ($param1 == 'check') {
            $data['class_id']    = $this->input->post('class_id');
            $data['subject_id']  = $this->input->post('subject_id');
            $data['exam_id']        = $this->input->post('exam_id');
            $data['section_id']  = $this->input->post('section_id');
            redirect(base_url() . 'admin/grades_report/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['subject_id'] . '/' . $data['exam_id'] . '/' , 'refresh');
        }
        $page_data['class_id']    = $param1;
        $page_data['section_id']  = $param2;
        $page_data['subject_id']  = $param3;
        $page_data['exam_id']       = $param4;
        $page_data['page_name']   = 'grades_report';
        $page_data['page_title']  = getEduAppGTLang('grades_report');
        $this->load->view('backend/index', $page_data);
    }
    function grades_report_excel($param1 = '', $param2 = '', $param3 = '', $param4 = '', $param5 = '')
    {
        $page_data['class_id']    = $param1;
        $page_data['section_id']  = $param2;
        $page_data['subject_id']  = $param3;
        $page_data['exam_id']       = $param4;
        $this->load->view('backend/admin/grades_report_excel', $page_data);
    }

    //Get Students by SectionId
    function get_class_studentss($section_id = '')
    {
        $students = $this->db->get_where('enroll', array('section_id' => $section_id, 'year' => $this->runningYear))->result_array();
        foreach ($students as $row) {
            echo '<option value="' . $row['student_id'] . '">' . $this->crud->get_name('student', $row['student_id'])  . '</option>';
        }
    }

    //Tabulation report function.
    function tabulation_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['section_id']   = $this->input->post('section_id');
        $page_data['subject_id']   = $this->input->post('subject_id');
        $page_data['page_name']   = 'tabulation_report';
        $page_data['page_title']  = getEduAppGTLang('tabulation_report');
        $this->load->view('backend/index', $page_data);
    }

    //Accounting report function.
    function accounting_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']   = 'accounting_report';
        $page_data['page_title']  = getEduAppGTLang('accounting_report');
        $this->load->view('backend/index', $page_data);
    }

    //Marks report function.
    function marks_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'generate') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/marks_report/', 'refresh');
        }
        $page_data['class_id']   = $this->input->post('class_id');
        $page_data['subject_id']   = $this->input->post('subject_id');
        $page_data['section_id']   = $this->input->post('section_id');
        $page_data['student_id']   = $this->input->post('student_id');
        $page_data['exam_id']   = $this->input->post('exam_id');
        $page_data['page_name']   = 'marks_report';
        $page_data['page_title']  = getEduAppGTLang('marks_report');
        $this->load->view('backend/index', $page_data);
    }

    //Report attendance view function.
    function report_attendance_view($class_id = '', $section_id = '', $month = '', $year = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']   = $class_id;
        $page_data['month']      = $month;
        $page_data['year']       = $year;
        $page_data['page_name']  = 'report_attendance_view';
        $page_data['section_id'] = $section_id;
        $page_data['page_title'] = getEduAppGTLang('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    //Manage behavior report function.
    function create_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'send') {
            $this->academic->createReport();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/request_student/', 'refresh');
        }
        if ($param1 == 'response') {
            $this->academic->reportResponse();
        }
        if ($param1 == 'update') {
            $this->academic->updateReport($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/looking_report/' . $param2, 'refresh');
        }
    }

    //Calendar events function.
    function calendar($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (isset($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'create') {
            $this->crud->createCalendarEvent();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/calendar/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->updateCalendarEvent();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/calendar/', 'refresh');
        }
        if ($param1 == 'update_date') {
            $this->crud->updateCalendarDate();
        }
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = getEduAppGTLang('calendar');
        $this->load->view('backend/index', $page_data);
    }

    //Attendance report selector function.
    function attendance_report_selector()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
        redirect(base_url() . 'admin/report_attendance_view/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['month'] . '/' . $data['year'], 'refresh');
    }

    //Manage student payments function.
    function students_payments($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'students_payments';
        $page_data['page_title'] = getEduAppGTLang('student_payments');
        $this->load->view('backend/index', $page_data);
    }

    //Manage payments function.
    function payments($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'payments';
        $page_data['page_title'] = getEduAppGTLang('payments');
        $this->load->view('backend/index', $page_data);
    }

    //Manage expenses function.
    function expense($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud->createExpense();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/expense', 'refresh');
        }
        if ($param1 == 'edit') {
            $this->crud->updateExpense($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/expense', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->deleteExpense($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/expense/', 'refresh');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = getEduAppGTLang('expense');
        $this->load->view('backend/index', $page_data);
    }

    //Manage expense categoies function.
    function expense_category($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud->createCategory();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/expense');
        }
        if ($param1 == 'update') {
            $this->crud->updateCategory($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/expense');
        }
        if ($param1 == 'delete') {
            $this->crud->deleteCategory($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/expense');
        }
        $page_data['page_name']  = 'expense';
        $page_data['page_title'] = getEduAppGTLang('expense');
        $this->load->view('backend/index', $page_data);
    }

    //Teacher attendance function.
    function teacher_attendance()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  =  'teacher_attendance';
        $page_data['page_title'] =  getEduAppGTLang('teacher_attendance');
        $this->load->view('backend/index', $page_data);
    }

    //Teacher attendance report function.
    function teacher_attendance_report()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $page_data['month']        =  date('m');
        $page_data['page_name']    = 'teacher_attendance_report';
        $page_data['page_title']   = getEduAppGTLang('teacher_attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    //Teacher report selector function.
    function teacher_report_selector()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $data['year']       = $this->input->post('year');
        $data['month']      = $this->input->post('month');
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/teacher_report_view/' . $data['month'] . '/' . $data['year'], 'refresh');
    }

    //Teachers report view function.
    function teacher_report_view($month = '', $year = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['month']      = $month;
        $page_data['year']       = $year;
        $page_data['page_name']  = 'teacher_report_view';
        $page_data['page_title'] = getEduAppGTLang('teacher_attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    //Attendance for teachers function.
    function attendance_teacher()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $timestamp = $this->crud->teacherAttendance();
        redirect(base_url() . 'admin/teacher_attendance_view/' . $timestamp, 'refresh');
    }

    //Update attendance for teachers function.
    function attendance_update2($timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $this->crud->updateAttendance($timestamp);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        redirect(base_url() . 'admin/teacher_attendance_view/' . $timestamp, 'refresh');
    }

    //View teacher attendance function.
    function teacher_attendance_view($timestamp = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['timestamp'] = $timestamp;
        $page_data['page_name'] = 'teacher_attendance_view';
        $page_data['page_title'] = getEduAppGTLang('teacher_attendance');
        $this->load->view('backend/index', $page_data);
    }

    //Manage school bus function.
    function school_bus($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud->createBus();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/school_bus/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->updateBus($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/school_bus', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->deleteBus($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/school_bus/', 'refresh');
        }
        $page_data['page_name']  = 'school_bus';
        $page_data['page_title'] = getEduAppGTLang('school_bus');
        $this->load->view('backend/index', $page_data);
    }

    //Manage your classrooms function.
    function classrooms($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {

            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud->createClassroom();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'admin/classrooms/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->updateClassroom($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/classrooms/', 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->deleteClassroom($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/classrooms/', 'refresh');
        }
        $page_data['page_name']   = 'classroom';
        $page_data['page_title']  = getEduAppGTLang('classrooms');
        $this->load->view('backend/index', $page_data);
    }

    //Update social login function.
    function social($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'login') {
            $this->crud->updateSocialLogin();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
    }

    //System settings function.
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'zoom') {
            $data['description'] = $this->input->post('zoom_key');
            $this->db->where('type', 'zoom_key');
            $this->db->update('settings', $data);

            $data['description'] = $this->input->post('zoom_secret');
            $this->db->where('type', 'zoom_secret');
            $this->db->update('settings', $data);

            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $this->crud->updateSettings();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'skin') {
            $this->crud->updateSkins();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        if ($param1 == 'social') {
            $this->crud->updateSocial();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/system_settings/', 'refresh');
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['page_title'] = getEduAppGTLang('system_settings');
        $this->load->view('backend/index', $page_data);
    }
    function certificate()
    {
        if($this->db->get_where('certificate_image', array('id' => '1'))->row()->image){
            $image=$this->db->get_where('certificate_image', array('id' => '1'))->row()->image;
        }else{
            $image="default.png";
        }
        $page_data['image']=$image;
        $page_data['page_name']  = 'certificate';
        $page_data['page_title'] = getEduAppGTLang('certificate');
        $this->load->view('backend/index', $page_data);
    }
    public function change_certificate_image()
{
    if (!empty($_FILES['certificate_image']['name'])) {

        $check = getimagesize($_FILES["certificate_image"]["tmp_name"]);

        // Validasi ukuran HARUS 1122 x 794
        if ($check[0] != 1122 || $check[1] != 794) {
            $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('image_must_1122_x_794'));
            redirect(base_url('admin/certificate'));
            return;
        }

        // Lokasi folder upload
        $upload_dir = 'public/certificates/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate nama file acak
        $ext = pathinfo($_FILES["certificate_image"]["name"], PATHINFO_EXTENSION);
        $new_filename = uniqid('cert_', true) . '.' . $ext;

        // Path akhir file
        $target_file = $upload_dir . $new_filename;

        // Pindahkan file
        if (move_uploaded_file($_FILES["certificate_image"]["tmp_name"], $target_file)) {
            // Update database
            $this->db->where('id', 1);
            $this->db->update('certificate_image', [
                'image' => $new_filename,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
        } else {
            $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('failed_to_upload_image'));
        }

    } else {
        $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('no_image_selected'));
    }

    redirect(base_url('admin/certificate'));
}



    //Frontend function.
    function frontend($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'home_widget') {
            $this->crud->homeWidget();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/frontend/', 'refresh');
        }
        if ($param1 == 'why_us') {
            $this->crud->whyUS();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/frontend/', 'refresh');
        }
        if ($param1 == 'principal') {
            $this->crud->principal();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/frontend/', 'refresh');
        }
        if ($param1 == 'second') {
            $this->crud->second();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/frontend/', 'refresh');
        }
        if ($param1 == 'about') {
            $this->crud->about();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/about/', 'refresh');
        }
        if ($param1 == 'footer') {
            $this->crud->footer();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/footer/', 'refresh');
        }
        if ($param1 == 'recaptcha') {
            $this->crud->recaptcha();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/recaptcha/', 'refresh');
        }
        if ($param1 == 'contact') {
            $this->crud->contact();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'admin/frontend/', 'refresh');
        }
        $page_data['page_name']  = 'frontend';
        $page_data['page_title'] = getEduAppGTLang('frontend');
        $this->load->view('backend/index', $page_data);
    }

    //Footer function.
    function footer($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'footer';
        $page_data['page_title'] = getEduAppGTLang('footer');
        $this->load->view('backend/index', $page_data);
    }

    //Footer function.
    function recaptcha($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'recaptcha';
        $page_data['page_title'] = getEduAppGTLang('recaptcha');
        $this->load->view('backend/index', $page_data);
    }

    //Footer function.
    function images($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->deleteImage($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/images/', 'refresh');
        }
        $page_data['page_name']  = 'images';
        $page_data['page_title'] = getEduAppGTLang('gallery_images');
        $this->load->view('backend/index', $page_data);
    }

    //Gallery function.
    function gallery($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'gallery';
        $page_data['page_title'] = getEduAppGTLang('gallery');
        $this->load->view('backend/index', $page_data);
    }

    //About Us function.
    function about($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['page_name']  = 'about';
        $page_data['page_title'] = getEduAppGTLang('about_us');
        $this->load->view('backend/index', $page_data);
    }

    //Classes functions.
    function grados($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if($param1){
            $page_data['selected_branch'] = $param1;
            $page_data['page_name']  = 'grados';
            $page_data['page_title'] = getEduAppGTLang('classes');
            $this->load->view('backend/index', $page_data);
        }else{
            $page_data['page_name']  = 'select_branch';
            $page_data['page_title'] = getEduAppGTLang('select_branch');
            $this->load->view('backend/index', $page_data);
        }
      
    }

    //Subjects function.
    function cursos($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['class_id']  = $class_id;
        $page_data['page_name']  = 'cursos';
        $page_data['page_title'] =  getEduAppGTLang('subjects');
        $this->load->view('backend/index', $page_data);
    }

    //Manage Library function.
    function library($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        if ($param1 == 'create') {
            $this->crud->createBook();
            redirect(base_url() . 'admin/library/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->crud->updateBook($param2);
            redirect(base_url() . 'admin/update_book/' . $param2, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->crud->deleteBook($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'admin/library', 'refresh');
        }
        $id = $this->input->post('class_id');
        if ($id == '') {
            $id = $this->db->get('class')->first_row()->class_id;
        }
        $page_data['id']         = $id;
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = getEduAppGTLang('library');
        $this->load->view('backend/index', $page_data);
    }

    //Marks print view function.
    function marks_print_view($student_id  = '', $exam_id = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $class_id     = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->runningYear))->row()->class_id;
        $class_name   = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
        $page_data['student_id'] =   $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/admin/marks_print_view', $page_data);
    }
    function add_all_student_from_enroll_to_subject_by_class_and_section()
    {
        $data = generateSubjectAllStudent();
        print_r($data);
    }
    function testing_fungsi($student_id, $subject_id){
        $data=addStudentToMarkAndNotaCapacidadFromSubject($student_id,$subject_id);
        print_r($data);
    }
    function testing_mail_notif(){
        if(sendMailNotifTesting()){
            $this->session->set_flashdata('flash_message', "E-mail notif testing sent.");
            redirect(base_url() . 'admin/drive/', 'refresh');
        }else{
            $this->session->set_flashdata('flash_message_failed', "Failed! send E-mail Notif");
            redirect(base_url() . 'admin/drive/', 'refresh');
        }
    }
    function testing_reset_mark_coloumn(){
        $data= refreshMarkColoum();
        print_r($data);
    }
    function testing_refresh_token(){
        $getClient=$this->drive_model->refreshTokenManual();
        var_dump($getClient);
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
        redirect(base_url() . 'admin/custom_attendance_status/' . $course);
    }
    function edit_custom_status_attendance()
    {
        $custom_status_id = $this->input->post('custom_status_id');
        $status_name = $this->input->post('status_name');
        $course = $this->input->post('course');
        $data = array(
            'status_name' => $status_name
        );
        $this->db->where('custom_status_id', $custom_status_id);
        $this->db->update('custom_status', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/custom_attendance_status/' . $course);
    }
    function delete_custom_status_attendance($course,$custom_status_id)
    {
        $this->db->where('custom_status_id', $custom_status_id);
        $this->db->delete('custom_status');
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_delete'));
        redirect(base_url() . 'admin/custom_attendance_status/' . $course);
    }
    function final_evaluation()
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['page_name']  = 'final_evaluation';
        $page_data['page_title'] = 'Evaluaciones Finales';
        $this->load->view('backend/index', $page_data);
    }
    function final_evaluation_weight($exam_id='')
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['exam'] = $this->db->query("SELECT * FROM exam where exam_id=$exam_id")->row();
        $page_data['page_name']  = 'final_evaluation_weight';
        $page_data['page_title'] = 'Pesos de evaluaci��n final';
        $this->load->view('backend/index', $page_data);
    }
    function final_evaluation_selected($exam_id,$mark_activity_id)
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $subject_id=getSubjectIdByExamId($exam_id);
        $page_data['exam_id']=$exam_id;
        $page_data['exam'] = $this->db->query("SELECT * FROM exam where is_final=0 and subject_id=$subject_id")->result();
        $page_data['mark_activity']=getMarkDetail($mark_activity_id);
        $page_data['page_name']  = 'final_evaluation_selected';
        $page_data['page_title'] = 'Seleccionada';
        $this->load->view('backend/index', $page_data);
    }
    function final_evaluation_add_exam()
    {
        $exam_id = $this->input->post('exam_id');
        $data = array(
            'is_final' => 1,
        );
        $this->db->where('exam_id', $exam_id);
        $this->db->update('exam', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/final_evaluation/');
    }
    function shifts_add()
    {
        $branch_id = $this->input->post('branch_id');
        $name = $this->input->post('name');
        $status = $this->input->post('status');
        $data = array(
            'branch_id' => $branch_id,
            'name' => $name,
            'status'=> $status
        );
        $this->db->insert('shifts', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/branch_and_shifts/');
    }
    function branch_add()
    {
        $name = $this->input->post('name');
        $telephone = $this->input->post('telephone');
        $direction = $this->input->post('direction');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $status = $this->input->post('status');
        $data = array(
            'name' => $name,
            'telephone' => $telephone,
            'direction' => $direction,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'status' => $status
        );
        $this->db->insert('branch', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
        redirect(base_url() . 'admin/branch_and_shifts/');
    }
    function branch_edit()
    {
        $name = $this->input->post('name');
        $telephone = $this->input->post('telephone');
        $direction = $this->input->post('direction');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $branch_id = $this->input->post('branch_id');
        $status = $this->input->post('status');
        $data = array(
            'name' => $name,
            'telephone' => $telephone,
            'direction' => $direction,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'status' => $status
        );
        $this->db->where('branch_id', $branch_id);
        $this->db->update('branch', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/branch_and_shifts/' . $exam_id);
    }
    function branch_delete($branch_id)
    {
        $shiftsData=$this->db->get_where('shifts', array('branch_id' => $branch_id))->row();
        if($shiftsData){
            $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('branch_cannot_be_deleted_because_it_is_already_in_use_in_shifts'));
            redirect(base_url() . 'admin/branch_and_shifts/' );
            return;
            die();
        }
        if($this->db->get_where('class', array('branch_id' => $branch_id))->num_rows() > 0) {
            $this->session->set_flashdata('flash_message_failed', getEduAppGTLang('branch_cannot_be_deleted_because_it_is_already_in_use_in_classes'));
            redirect(base_url() . 'admin/branch_and_shifts/' );
            return;
            die();
        }
        $this->db->where('branch_id', $branch_id);
        $this->db->delete('branch');
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_delete'));
        redirect(base_url() . 'admin/branch_and_shifts/');
    }
    function shifts_edit()
    {
        $branch_id = $this->input->post('branch_id');
        $name = $this->input->post('name');
        $status = $this->input->post('status');
        $shifts_id= $this->input->post('shifts_id');
        $data = array(
            'branch_id' => $branch_id,
            'name' => $name,
            'status' => $status,
        );
        $this->db->where('shifts_id', $shifts_id);
        $this->db->update('shifts', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/branch_and_shifts/');
    }
    function shifts_delete($shifts_id)
    {
        $this->db->where('shifts_id', $shifts_id);
        $this->db->delete('shifts');
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_delete'));
        redirect(base_url() . 'admin/branch_and_shifts/');
    }
    function final_evaluation_delete_exam($exam_id='')
    {
        $data = array(
            'is_final' => 0,
        );
        $this->db->where('exam_id', $exam_id);
        $this->db->update('exam', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_delete'));
        redirect(base_url() . 'admin/final_evaluation/');
    }
    function final_evaluation_update_percent()
    {
        $mark_activity_id=$this->input->post('mark_activity_id');
        $percent=$this->input->post('percent');
        $exam_id=$this->input->post('exam_id');
        $data=array(
            'percent'=>$percent
        );
        $this->db->where('mark_activity_id', $mark_activity_id);
        $this->db->update('mark_activity', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/final_evaluation_weight/'.$exam_id);
    }
    function deactive_student_status($student_id)
    {
        $data=array(
            'is_active'=>0
        );
        $this->db->where('student_id', $student_id);
        $this->db->update('student', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/student_portal/'.$student_id);
    }
    function active_student_status($student_id)
    {
        $data=array(
            'is_active'=>1
        );
        $this->db->where('student_id', $student_id);
        $this->db->update('student', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/student_portal/'.$student_id);
    }
    function block_mark()
    {
        $student_id=$this->input->post('student_id');
        $subject_id=$this->input->post('subject_id');
        $course=$this->input->post('course');
        $reason=$this->input->post('reason');
        $data=array(
            'is_block'=>1,
            'reason'=>$reason
        );
        $where=array(
            'student_id'=>$student_id,
            'subject_id'=>$subject_id
        );
        $this->db->where($where);
        $this->db->update('student_subject', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/student_list/'.$course);
    }
    function unblock_mark($student_id,$subject_id,$course)
    {
        $data=array(
            'is_block'=>0,
            'reason'=>''
        );
        $where=array(
            'student_id'=>$student_id,
            'subject_id'=>$subject_id
        );
        $this->db->where($where);
        $this->db->update('student_subject', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/student_list/'.$course);
    }
    function change_marks_status()
    {
        $nota_capacidad_id=$this->input->post('nota_capacidad_id');
        $course=$this->input->post('course');
        $is_block=$this->input->post('is_block');
        $reason=$this->input->post('reason');
        $exam_id = $this->input->post('exam_id');
        if($is_block==1){
            $data=array(
                'is_block'=>$is_block,
                'reason'=>$reason
            );
        }else{
            $data=array(
                'is_block'=>$is_block,
                'reason'=>''
            );
        }
        
        $where=array(
            'nota_capacidad_id'=>$nota_capacidad_id
        );
        $this->db->where($where);
        $this->db->update('nota_capacidad', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/blocked_mark/'.$course.'/'.$exam_id);
    }
    function finish_student_subject($student_id,$subject_id)
    {
      
        $where = array(
            'student_id' => $student_id,
            'subject_id' => $subject_id
        );
    

        $data = array(
            'is_finish' => 1
        );
        $this->db->where($where);
        $this->db->update('student_subject', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/student_profile_active_course/' . $student_id);
    }
    function process_student_subject($student_id, $subject_id)
    {

        $where = array(
            'student_id' => $student_id,
            'subject_id' => $subject_id
        );


        $data = array(
            'is_finish' => 0
        );
        $this->db->where($where);
        $this->db->update('student_subject', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/student_profile_active_course/' . $student_id);
    }
    function custom_attendance_status($data)
    {
        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']       = $data;
        $page_data['page_name']  =  'custom_attendance_status';
        $page_data['page_title'] =  getEduAppGTLang('custom_attendance_status');
        $this->load->view('backend/index', $page_data);
    }
    function update_is_calculate_avg()
    {
        $exam_id=$this->input->post('exam_id');
        $mark_activity_id=$this->input->post('mark_activity_id');

        $where = array(
            'exam_id' => $exam_id,
            'mark_activity_id' => $mark_activity_id
        );
        $data = array(
            'is_calculate_avg' => 1
        );
        $this->db->where($where);
        $this->db->update('mark_activity', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/final_evaluation_weight/' . $exam_id);
    }
    function disable_calculate_avg($exam_id,$mark_activity_id)
    {
        $whereSetZero = array(
            'mark_activity_id' => $mark_activity_id,
        );

        $data = array(
            'is_calculate_avg' => 0
        );
        $this->db->where($whereSetZero);
        $this->db->update('mark_activity', $data);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/final_evaluation_weight/' . $exam_id);
    }
     function final_evaluation_selected_update()
    {
        $exam_id=$this->input->post('exam_id');
        $is_count=$this->input->post('is_count');
        $exam_id_final=$this->input->post('exam_id_final');
        $mark_activity_id=$this->input->post('mark_activity_id');

        if($is_count==1)
        {
            $data=array(
                'exam_id'=>$exam_id,
                'mark_activity_id'=>$mark_activity_id
            );
            $this->db->insert('auto_fill_exam',$data);
        }else{
            $where=array(
                'exam_id'=>$exam_id,
                'mark_activity_id'=>$mark_activity_id
            );
            $this->db->where($where);
            $this->db->delete('auto_fill_exam');
        }
        $examDetail=getExamDetail($exam_id);
        recalculateMarkProm($examDetail->subject_id,$examDetail->class_id,$examDetail->section_id,$examDetail->year);
        $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_update'));
        redirect(base_url() . 'admin/final_evaluation_selected/' . $exam_id_final.'/'.$mark_activity_id);
    }
    
    //End of Admin.php content.
}
