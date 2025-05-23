<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends EduAppGT
{
    /*
        Software: EduAppGT PRO - School Management System
        Author: GuateApps - Software, Web and Mobile developer.
        Author URI: https://guateapps.app.
        PHP: 5.6+
        Created: 27 September 16.
    */

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function upload_video($video_name)
    {
        move_uploaded_file($_FILES["video"]["tmp_name"], "public/uploads/homework_delivery/video/" . $video_name . '.mp4');
        $fileURL = "public/uploads/homework_delivery/video/" . $video_name . '.mp4';
        echo $fileURL;
    }

    function upload_audio($audio_name)
    {
        move_uploaded_file($_FILES["audio"]["tmp_name"], "public/uploads/homework_delivery/audio/" . $audio_name . '.mp3');
        $fileURL = "public/uploads/homework_delivery/audio/" . $audio_name . '.mp3';
        echo $fileURL;
    }

    function viewFile($id)
    {
        $this->drive_model->setPermissions($id);
        header("Location: " . $this->drive_model->get_embed_url($id));
    }

    function calculate_quiz_mark($online_exam_id)
    {

        $checker = array(
            'quiz_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('online_quiz_result', $checker);
        if ($online_exam_result->num_rows() == 0) {
            $data['obtained_mark'] = 0;
        } else {
            $results = $online_exam_result->row_array();
            $answer_script = json_decode($results['answer_script'], true);
            foreach ($answer_script as $row) {
                if ($row['submitted_answer'] == $row['correct_answers']) {
                    $obtained_marks = $obtained_marks + $this->get_quiz_details_by_id($row['quiz_bank_id'], 'mark');
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        $total_mark = $this->get_total_mark_quiz($online_exam_id);
        $data['result'] = $total_mark;

        $this->db->where($checker);
        $this->db->update('online_quiz_result', $data);
    }

    function get_quiz_details_by_id($question_bank_id, $column_name = "")
    {
        return $this->db->get_where('quiz_bank', array('quiz_bank_id' => $question_bank_id))->row()->$column_name;
    }

    function get_total_mark_quiz($online_exam_id)
    {
        $added_question_info = $this->db->get_where('quiz_bank', array('quiz_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if (sizeof($added_question_info) > 0) {
            foreach ($added_question_info as $single_question) {
                $total_mark = $total_mark + $single_question['mark'];
            }
        }
        return $total_mark;
    }

    function quiz_result($param1  = '', $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['quiz_id']              = $param2;
        $page_data['online_course_id']     = $param1;
        $page_data['page_name']            = 'quiz_result';
        $page_data['page_title']           = getEduAppGTLang('quiz_result');
        $this->load->view('backend/index', $page_data);
    }

    function get_correct_answer_quiz($question_bank_id = "")
    {
        $question_details = $this->db->get_where('quiz_bank', array('quiz_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }


    function submit_online_quiz($online_exam_id = "", $answer_script = "")
    {
        $checker = array(
            'quiz_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );
        $this->db->where($checker);
        $this->db->update('online_quiz_result', $updated_array);
        $this->calculate_quiz_mark($online_exam_id);
    }

    function submit_quiz($quiz_id = '')
    {
        $course_id = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row()->online_course_id;
        $answer_script = array();
        $question_bank = $this->db->get_where('quiz_bank', array('quiz_id' => $quiz_id))->result_array();
        foreach ($question_bank as $question) {
            $correct_answers  = $this->get_correct_answer_quiz($question['quiz_bank_id']);
            $container_2 = array();
            if (isset($_POST[$question['quiz_bank_id']])) {
                foreach ($this->input->post($question['quiz_bank_id']) as $row) {
                    $submitted_answer = "";
                    if ($question['type'] == 'true_false') {
                        $submitted_answer = $row;
                    } elseif ($question['type'] == 'fill_in_the_blanks') {
                        $suitable_words = array();
                        $suitable_words_array = explode(',', $row);
                        foreach ($suitable_words_array as $key) {
                            array_push($suitable_words, strtolower($key));
                        }
                        $submitted_answer = json_encode(array_map('trim', $suitable_words));
                    } else {
                        array_push($container_2, strtolower($row));
                        $submitted_answer = json_encode($container_2);
                    }
                    $container = array(
                        "quiz_bank_id" => $question['quiz_bank_id'],
                        "submitted_answer" => $submitted_answer,
                        "correct_answers"  => $correct_answers
                    );
                }
            } else {
                $container = array(
                    "quiz_bank_id" => $question['quiz_bank_id'],
                    "submitted_answer" => "",
                    "correct_answers"  => $correct_answers
                );
            }
            array_push($answer_script, $container);
        }

        $this->submit_online_quiz($quiz_id, json_encode($answer_script));
        redirect(base_url() . 'student/quiz_result/' . $course_id . '/' . $quiz_id . '/', 'refresh');
    }

    function check_for_student($online_exam_id)
    {
        $result = $this->db->get_where('online_quiz_result', array('quiz_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }

    function change_quiz_status($online_exam_id = "")
    {
        $checker = array(
            'quiz_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        if ($this->db->get_where('online_quiz_result', $checker)->num_rows() == 0) {
            $inserted_array = array(
                'status' => 'attended',
                'quiz_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
            );
            $this->db->insert('online_quiz_result', $inserted_array);
        }
    }

    function quiz_contest($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }

        $less  = $this->db->get_where('progress_course', array('online_course_id' => $param1, 'student_id' => $this->session->userdata('login_user_id'), 'quiz_id' => $param2))->num_rows();

        if ($less < 1) {
            $data['quiz_id']                  =  $param2;
            $data['online_course_id']         =  $param1;
            $data['student_id']               =  $this->session->userdata('login_user_id');
            $this->db->insert('progress_course', $data);
        }

        $student_id = $this->session->userdata('login_user_id');
        $check = array('student_id' => $student_id, 'quiz_id' => $param2);
        $taken = $this->db->where($check)->get('online_quiz_result')->num_rows();
        $this->change_quiz_status($param2);
        $status = $this->check_for_student($param2);

        if ($status == 'submitted') {
            redirect(base_url() . 'student/quiz_result/' . $param1 . '/' . $param2 . '/', 'refresh');
        } else {

            $page_data['online_course_id']    = $param1;
            $page_data['quiz_id']             = $param2;
            $page_data['lesson_id']           = $param3;
            $page_data['page_name']           = 'quiz_contest';
            $page_data['page_title']          = getEduAppGTLang('quiz_contest');
            $this->load->view('backend/index', $page_data);
        }
    }

    function view_lesson($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
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
        $less  = $this->db->get_where('progress_course', array('online_course_id' => $param2, 'student_id' => $this->session->userdata('login_user_id'), 'lesson_id' => $param3))->num_rows();
        if ($less == 0) {
            $data['lesson_id']                =  $param3;
            $data['online_course_id']         =  $param2;
            $data['student_id']               =  $this->session->userdata('login_user_id');
            $data['quiz_id']                  =  0;
            $this->db->insert('progress_course', $data);
        }
        $page_data['type']                = $param1;
        $page_data['online_course_id']    = $param2;
        $page_data['lesson_id']           = $param3;
        $page_data['page_name']           = 'view_lesson';
        $page_data['page_title']          = getEduAppGTLang('view_lesson');
        $this->load->view('backend/index', $page_data);
    }

    function online_courses($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            redirect(site_url('login'), 'refresh');
        }
        $page_data['data']       = $param1;
        $page_data['page_name']  = 'online_courses';
        $page_data['page_title'] = getEduAppGTLang('online_courses');
        $this->load->view('backend/index', $page_data);
    }

    function watch($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        $cont = $this->db->get_where('progress_course', array('online_course_id' => $param1, 'student_id' => $this->session->userdata('login_user_id')))->num_rows();
        if ($cont < 1) {
            $data['student_id']              =  $this->session->userdata('login_user_id');
            $data['online_course_id']        =  $param1;
            $data['count_lesson']            =  0;
            $data['lesson_id']               =  0;
            $data['quiz_id']                 =  0;
            $this->db->insert('progress_course', $data);
        }
        $page_data['online_course_id']    = $param1;
        $page_data['page_name']           = 'watch';
        $page_data['page_title']          = getEduAppGTLang('watch');
        $this->load->view('backend/index', $page_data);
    }

    /*function takeAttendance()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        $data = base64_decode($_GET['data']);
        $info = explode('-', $data);
        if($this->crud->setAttendance($info[0],$info[1], $info[2]) == true){
            redirect(base_url().'student/success', 'refresh');   
        }else{
            redirect(base_url().'student/denied', 'refresh');   
        }
    }*/

    function gamification($task = "", $document_id = "")
    {
        $this->isStudent();
        $data['page_name']              = 'gamification';
        $data['data']                 = $task;
        $data['page_title']             = getEduAppGTLang('gamification');
        $this->load->view('backend/index', $data);
    }



    function exportPDF($onlineExamId)
    {
        if ($this->crud->calculate_average($onlineExamId, $this->session->userdata('login_user_id')) == 1) {
            $this->crud->getCertificatePDF($onlineExamId);
        } else {
            redirect(base_url() . 'student/panel/', 'refresh');
        }
    }

    function whiteboards($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param1;
        $page_data['page_name']  = 'whiteboards';
        $page_data['page_title'] = getEduAppGTLang('whiteboards');
        $this->load->view('backend/index', $page_data);
    }

    function view_whiteboard($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('student_login') != 1) {
            redirect(base_url(), 'refresh');
        }
        $page_data['data']  = $param2;
        $page_data['board_id']  = $param1;
        $page_data['page_title'] = getEduAppGTLang('view_whiteboard');
        $this->load->view('backend/student/view_whiteboard', $page_data);
    }

    //Live classes function.
    function meet($task = "", $document_id = "")
    {
        $this->isStudent();
        $data['page_name']              = 'meet';
        $data['data']              = $task;
        $data['page_title']             = getEduAppGTLang('live');
        $this->load->view('backend/index', $data);
    }

    //Update delivery function.
    function homework_edit($param1 = "", $param2 = "")
    {
        $this->isStudent();
        $data['page_name']         = 'homework_edit';
        $data['delivery_id']       = base64_decode($param1);
        $data['page_title']        = getEduAppGTLang('edit_delivery');
        $this->load->view('backend/index', $data);
    }

    //Enter to Live Class function.
    function liveClass($param1 = '', $param2 = '')
    {
        $this->isStudent();
        $live_id  = base64_decode($param1);
        $url = $this->db->get_where('live', array('live_id' => $live_id))->row()->siteUrl;
        $this->crud->saveLiveAttendance($live_id);
        if ($liveType == 2) {
            header('Location: ' . $url . '');
        } else {
            redirect(base_url() . 'student/live/' . base64_encode($live_id), 'refresh');
        }
    }

    //Student progress function.
    function progress($task = "", $document_id = "")
    {
        $this->isStudent();
        $data['page_name']              = 'progress';
        $data['page_title']             = getEduAppGTLang('progress');
        $this->load->view('backend/index', $data);
    }

    //Live Class Function.
    function live($task = "", $document_id = "")
    {
        $this->isStudent();
        $_id = base64_decode($task);
        $this->crud->saveLiveStatus($_id);
        $data['page_name']              = 'live';
        $page_data['zoom_id']                = $task;
        $data['page_title']             = getEduAppGTLang('live');
        $this->load->view('backend/student/live', $page_data);
    }

    //Create teacher report function.
    function listado_de_reportes($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        if ($param1 == 'create') {
            $this->crud->createTeacherReport();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'student/send_report/', 'refresh');
        }
    }

    //Marks print view function.
    function marks_print_view($student_id, $exam_id = '')
    {
        $this->isStudent();
        $ex = explode('-', base64_decode($student_id));
        $page_data['student_id'] =   $student_id;
        $page_data['sc_student'] = getExamDetail($ex[1]);
        $page_data['exam_id']    =   $exam_id;
        $this->load->view('backend/student/marks_print_view', $page_data);
    }

    //Submit online exam function.
    function submit_online_exam($online_exam_id = "")
    {
        $this->isStudent();
        $this->academic->submitExam($online_exam_id);
        redirect(base_url() . 'student/online_exams/' . $this->input->post('datainfo') . '/', 'refresh');
    }

    //View online exam result function.
    function online_exam_result($param1 = '', $param2 = '')
    {
        $this->isStudent();
        //Online exam validator
        $results      = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->results;
        $exam_date    = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->exam_date;
        $time_start   = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->time_start;
        $time_end     = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->time_end;
        $classId      = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->class_id;
        $sectionId    = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->section_id;
        $subjectId    = $this->db->get_where('online_exam', array('online_exam_id' => $param1))->row()->subject_id;
        $redirect = base64_encode($classId . '-' . $sectionId . '-' . $subjectId);
        if ($results == 3) {
            $addMinutes = 15;
        } elseif ($results == 4) {
            $addMinutes = 30;
        }
        $current_time          = time();
        $exam_start_time       = strtotime(date('Y-m-d', $exam_date) . ' ' . $time_start);
        $exam_end_time         = strtotime(date('Y-m-d', $exam_date) . ' ' . $time_end);

        $startResult           = strtotime($time_end);
        $endResult             = $addMinutes * 60;
        $newResult             = date("H:i", $startResult + $endResult) . ':00';
        $exam_end_time_results = strtotime(date('Y-m-d', $exam_date) . ' ' . $newResult);

        if ($results == 0 || $results == 1) {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('ask_for_results'));
            redirect(base_url() . 'student/online_exams/' . $redirect, 'refresh');
        } elseif ($current_time < $exam_end_time && $current_time < $exam_end_time_results && $results != 2) {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('waiting_for_results'));
            redirect(base_url() . 'student/online_exams/' . $redirect, 'refresh');
        }
        //Online exam validator.                                  
        $page_data['page_name'] = 'online_exam_result';
        $page_data['param2'] = $param1;
        $page_data['page_title'] = getEduAppGTLang('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }

    //Take online exam function.
    function take_online_exam($param1  = '', $param2 = '')
    {
        $this->isStudent();
        if ($param1 == 'start') {
            $password = md5($this->db->get_where('online_exam', array('code' => html_escape($this->input->post('rand'))))->row()->password);
            $user_password = md5($this->input->post('password'));
            if ($password == $user_password) {
                $online_exam_id = $this->db->get_where('online_exam', array('code' => html_escape($this->input->post('rand'))))->row()->online_exam_id;
                $student_id = $this->session->userdata('login_user_id');
                $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
                $taken = $this->db->where($check)->get('online_exam_result')->num_rows();
                $this->crud->change_online_exam_status_to_attended_for_student($online_exam_id);

                $status = $this->crud->check_availability_for_student($online_exam_id);
                if ($status == 'submitted') {
                    $page_data['page_name']  = 'page_not_found';
                } else {
                    $page_data['page_name']  = 'online_exam_take';
                }
            } else {
                $this->session->set_flashdata('flash_message', getEduAppGTLang('password_does_not_match'));
                redirect(base_url() . 'student/examroom/' . $this->input->post('rand'), 'refresh');
            }
        }
        $page_data['page_title'] = getEduAppGTLang('online_exam');
        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['exam_info'] = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id));
        $this->load->view('backend/index', $page_data);
    }

    //Index function.
    public function index()
    {
        if ($this->session->userdata('student_login') != 1) {
            redirect(base_url(), 'refresh');
        } else {
            redirect(base_url() . 'student/panel/', 'refresh');
        }
    }

    //Subject dashboard function
    function subject_dashboard($data  = '')
    {
        $this->isStudent();
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_dashboard';
        $page_data['page_title']   = getEduAppGTLang('subject_dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Birthdays function.
    function birthdays()
    {
        $this->isStudent();
        $page_data['page_name']  = 'birthdays';
        $page_data['page_title'] = getEduAppGTLang('birthdays');
        $this->load->view('backend/index', $page_data);
    }

    //Calendar function.
    function calendar($param1 = '', $param2 = '')
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'calendar';
        $page_data['page_title'] = getEduAppGTLang('calendar');
        $page_data['code']   = $code;
        $this->load->view('backend/index', $page_data);
    }

    //Chat group function.
    function group($param1 = "group_message_home", $param2 = "")
    {
        $this->isStudent();
        if ($param1 == 'group_message_read') {
            $page_data['current_message_thread_code'] = $param2;
        } else if ($param1 == 'send_reply') {
            $this->crud->send_reply_group_message($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            redirect(base_url() . 'student/group/group_message_read/' . $param2, 'refresh');
        }
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'group';
        $page_data['page_title']                = getEduAppGTLang('message_group');
        $this->load->view('backend/index', $page_data);
    }

    //Submit poll response function
    function polls($param1 = '', $param2 = '')
    {
        $this->isStudent();
        if ($param1 == 'response') {
            $this->crud->pollReponse();
        }
    }

    //Take online exam function.
    function take($exam_code  = '')
    {
        $this->isStudent();
        $page_data['questions'] = $this->db->get_where('questions', array('exam_code' => $exam_code))->result_array();
        if ($this->db->get_where('student_question', array('exam_code' => $exam_code, 'student_id' => $this->session->userdata('login_user_id')))->row()->answered == 'answered') {
            redirect(base_url() . 'student/online_exams/', 'refresh');
        }
        $page_data['exam_code'] = $exam_code;
        $page_data['page_name']   = 'take';
        $page_data['page_title']  = "";
        $this->load->view('backend/index', $page_data);
    }

    //Attendance report function.
    function attendance_report($data = '', $month = '', $year = '')
    {
        $this->isStudent();
        $page_data['month']        = $month;
        $page_data['data']         = $data;
        $page_data['year']         = $year;
        $page_data['page_name']    = 'attendance_report';
        $page_data['page_title']   = getEduAppGTLang('attendance_report');
        $this->load->view('backend/index', $page_data);
    }

    //Exam room function.
    function examroom($online_exam_code = "")
    {
        $this->isStudent();
        $online_exam_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->online_exam_id;
        $class_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->class_id;
        $section_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->section_id;
        $subject_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->subject_id;
        $student_id = $this->session->userdata('login_user_id');
        $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
        $taken = $this->db->where($check)->get('online_exam_result')->num_rows();
        $this->crud->change_online_exam_status_to_attended_for_student($online_exam_id);
        $status = $this->crud->check_availability_for_student($online_exam_id);
        if ($status == 'submitted') {
            redirect(base_url() . 'student/online_exams/' . base64_encode($class_id . '-' . $section_id . '-' . $subject_id) . '/', 'refresh');
        } else {
            $page_data['page_name']    = 'examroom';
        }
        $page_data['code'] = $online_exam_code;
        $page_data['page_title']   = getEduAppGTLang('take_exam');
        $this->load->view('backend/index', $page_data);
    }

    //Exam function.
    function exam($code = "")
    {
        $this->isStudent();
        $page_data['questions'] = $this->db->get_where('questions', array('exam_code' => $code))->result_array();
        if ($this->db->get_where('student_question', array('exam_code' => $code, 'student_id' => $this->session->userdata('login_user_id')))->row()->answered == 'answered') {
            redirect(base_url() . 'student/online_exams/', 'refresh');
        }
        $page_data['exam_code'] = $code;
        $page_data['page_name']    = 'exam';
        $page_data['page_title']   = getEduAppGTLang('online_exam');
        $this->load->view('backend/index', $page_data);
    }

    //Exam results function.
    function exam_results($code = '')
    {
        $this->isStudent();
        $page_data['exam_code'] = $code;
        $page_data['page_name']     = 'exam_results';
        $page_data['page_title']    = getEduAppGTLang('exam_results');
        $this->load->view('backend/index', $page_data);
    }

    //Print marks function.
    function print_marks()
    {
        $this->isStudent();
        $page_data['month']        = date('m');
        $page_data['page_name']    = 'print_marks';
        $page_data['page_title']   = "";
        $this->load->view('backend/index', $page_data);
    }

    //Subject marks function.
    function subject_marks($data  = '', $param2  = '')
    {
        $this->isStudent();
        if ($param2 != "") {
            $page = $param2;
        } else {
            $info = base64_decode($data);
            $ex = explode('-', $info);

            $query = $this->db->get_where('exam', array('section_id' => $ex[1], 'class_id' => $ex[0], 'subject_id' => $ex[2]))->first_row()->exam_id;

            $page = $query;
        }
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['exam_id'] = $page;
        $page_data['data'] = $data;
        $page_data['page_name']    = 'subject_marks';
        $page_data['page_title']   =  getEduAppGTLang('subject_marks');
        $this->load->view('backend/index', $page_data);
    }

    //View invoice function.
    function view_invoice($id  = '')
    {
        $this->isStudent();
        $page_data['invoice_id'] = $id;
        $page_data['page_name']    = 'view_invoice';
        $page_data['page_title']   = getEduAppGTLang('invoice');
        $this->load->view('backend/index', $page_data);
    }

    //View behavior report function.
    function view_report($code  = '')
    {
        $this->isStudent();
        $page_data['code'] = $code;
        $page_data['page_name']    = 'view_report';
        $page_data['page_title']   = getEduAppGTLang('view_report');
        $this->load->view('backend/index', $page_data);
    }

    //My Profile function.
    function my_profile($param1 = '', $param2 = '')
    {
        $this->isStudent();
        if ($param1 == 'remove_facebook') {
            $this->user->removeFacebook();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('facebook_delete'));
            redirect(base_url() . 'student/my_profile/', 'refresh');
        }
        if ($param1 == '1') {
            $this->session->set_flashdata('error_message', getEduAppGTLang('google_err'));
            redirect(base_url() . 'student/my_profile/', 'refresh');
        }
        if ($param1 == '3') {
            $this->session->set_flashdata('error_message', getEduAppGTLang('facebook_err'));
            redirect(base_url() . 'student/my_profile/', 'refresh');
        }
        if ($param1 == '2') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('google_true'));
            redirect(base_url() . 'student/my_profile/', 'refresh');
        }
        if ($param1 == '4') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('facebook_true'));
            redirect(base_url() . 'student/my_profile/', 'refresh');
        }
        if ($param1 == 'remove_google') {
            $this->user->removeGoogle();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('google_delete'));
            redirect(base_url() . 'student/my_profile/', 'refresh');
        }
        if ($param1 == 'update') {
            $this->user->updateCurrentStudent();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/student_update/', 'refresh');
        }
        $page_data['output']       = $this->crud->getGoogleURL();
        $page_data['page_name']    = 'my_profile';
        $page_data['page_title']   = getEduAppGTLang('profile');
        $this->load->view('backend/index', $page_data);
    }

    //Attendance report selectior.
    function attendance_report_selector()
    {
        $this->isStudent();
        $data['year']       = $this->input->post('year');
        $data['month']      = $this->input->post('month');
        $data['data']       = $this->input->post('data');
        redirect(base_url() . 'student/attendance_report/' . $data['data'] . '/' . $data['month'] . '/' . $data['year'], 'refresh');
    }

    //Student dashboard function.
    function panel()
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (@html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['page_name']  = 'panel';
        $page_data['page_title'] = getEduAppGTLang('dashboard');
        $this->load->view('backend/index', $page_data);
    }

    //Teachers function.
    function teachers($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        $page_data['page_name']  = 'teachers';
        $page_data['page_title'] = getEduAppGTLang('teachers');
        $this->load->view('backend/index', $page_data);
    }

    //Subject function.
    function subject($param1 = '', $param2 = '')
    {
        $this->isStudent();
        $student_profile         = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
        $page_data['class_Section']   = getStudentClassAndSectionById($student_profile->student_id);
        $page_data['student_id'] = $student_profile->student_id;
        $page_data['page_name']  = 'subject';
        $page_data['page_title'] = getEduAppGTLang('subjects');
        $this->load->view('backend/index', $page_data);
    }

    //My Marks function.
    function my_marks($student_id = '')
    {
        $this->isStudent();
        if ($student_id == 'apply') {
            redirect(base_url() . 'student/my_marks/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['page_name']  =   'my_marks';
        $page_data['subject_id']  =   $student_id;
        $page_data['page_title'] =   getEduAppGTLang('marks');
        $this->load->view('backend/index', $page_data);
    }

    //Class routine function.
    function class_routine($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        $student_profile         = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row();
        $page_data['class_id']   = $this->db->get_where('enroll', array('student_id' => $student_profile->student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row()->class_id;
        $page_data['student_id'] = $student_profile->student_id;
        $page_data['page_name']  = 'class_routine';
        $page_data['page_title'] = getEduAppGTLang('class_routine');
        $this->load->view('backend/index', $page_data);
    }

    //Homework function.
    function homework($student_id = '')
    {
        $this->isStudent();
        $page_data['page_name']  = 'homework';
        $page_data['page_title'] = getEduAppGTLang('homework');
        $page_data['data']   = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Manage online exams function.
    function online_exams($student_id = '')
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $info = base64_decode($student_id);
        $ex = explode('-', $info);
        $page_data['exams']      = $this->crud->available_exams($this->session->userdata('login_user_id'), $ex[2]);
        $page_data['data']       = $student_id;
        $page_data['page_name']  = 'online_exams';
        $page_data['page_title'] = getEduAppGTLang('online_exams');
        $page_data['student_id'] = $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Download book function.
    function descargar_libro($libro_code = '')
    {
        $this->isStudent();
        $file_name = $this->db->get_where('libreria', array('libro_code' => $libro_code))->row()->file_name;
        $this->load->helper('download');
        $data = file_get_contents("public/uploads/libreria/" . $file_name);
        $name = $file_name;
        force_download($name, $data);
    }

    //Invoices function.
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        if ($param1 == 'make_payment') {
            $this->payment->makePayPal();
        }
        if ($param1 == 'paypal_cancel') {
            redirect(base_url() . 'student/invoice/', 'refresh');
        }
        $student_profile         = $this->db->get_where('student', array('student_id'   => $this->session->userdata('student_id')))->row();
        $student_id              = $student_profile->student_id;
        $page_data['invoices']   = $this->db->get_where('invoice', array('student_id' => $student_id))->result_array();
        $page_data['page_name']  = 'invoice';
        $page_data['page_title'] = getEduAppGTLang('invoice');
        $this->load->view('backend/index', $page_data);
    }

    //Student info function.
    function student_info($student_id  = '', $param1 = '')
    {
        $this->isStudent();
        $page_data['output']     = $this->crud->getGoogleURL();
        $page_data['page_name']  = 'student_info';
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Student update info function.
    function student_update($student_id = '', $param1 = '')
    {
        $this->isStudent();
        $page_data['page_name']  = 'student_update';
        $page_data['output']     = $this->crud->getGoogleURL();
        $page_data['page_title'] =  getEduAppGTLang('student_portal');
        $page_data['student_id'] =  $student_id;
        $this->load->view('backend/index', $page_data);
    }

    //Manage notifications function.    
    function notifications()
    {
        $this->isStudent();
        $page_data['page_name']  =  'notifications';
        $page_data['page_title'] =  getEduAppGTLang('your_notifications');
        $this->load->view('backend/index', $page_data);
    }

    //Send teacher report function.
    function send_report()
    {
        $this->isStudent();
        $page_data['page_name'] = 'send_report';
        $page_data['page_title'] = getEduAppGTLang('teacher_report');
        $this->load->view('backend/index', $page_data);
    }

    //Noticeboard function.
    function noticeboard($param1 = '', $param2 = '')
    {
        $this->isStudent();
        $page_data['page_name'] = 'noticeboard';
        $page_data['page_title'] = getEduAppGTLang('news');
        $this->load->view('backend/index', $page_data);
    }

    //Chat message function.
    function message($param1 = 'message_home', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == 'send_new') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('message_sent'));
            $message_thread_code = $this->crud->send_new_private_message();
            redirect(base_url() . 'student/message/message_read/' . $message_thread_code, 'refresh');
        }
        if ($param1 == 'send_reply') {
            $this->session->set_flashdata('flash_message', getEduAppGTLang('reply_sent'));
            $this->crud->send_reply_message($param2);
            redirect(base_url() . 'student/message/message_read/' . $param2, 'refresh');
        }
        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;
            $this->crud->mark_thread_messages_read($param2);
        }
        $page_data['infouser']                  = $param2;
        $page_data['message_inner_page_name']   = $param1;
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = getEduAppGTLang('private_message');
        $this->load->view('backend/index', $page_data);
    }

    //Study material function
    function study_material($task = "", $document_id = "")
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $data['page_name']              = 'study_material';
        $data['data']                   = $task;
        $data['page_title']             = getEduAppGTLang('study_material');
        $this->load->view('backend/index', $data);
    }

    //Manage library function.
    function library($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == "request") {
            $this->academic->requestStudentBook();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/library/' . $param2, 'refresh');
        }
        $page_data['page_name']  = 'library';
        $page_data['page_title'] = getEduAppGTLang('library');
        $this->load->view('backend/index', $page_data);
    }

    //Homework detials function.
    function homeworkroom($param1 = '', $param2 = '')
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        $page_data['homework_code'] = $param1;
        $page_data['page_name']   = 'homework_room';
        $page_data['page_title']  = getEduAppGTLang('homework');
        $this->load->view('backend/index', $page_data);
    }

    //Send homework function.
    function delivery($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        if ($param1 == 'file') {
            $this->academic->sendFileHomework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/homeworkroom/' . $param2, 'refresh');
        }
        if ($param1 == 'text') {
            $this->academic->sendTextHomework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/homeworkroom/' . $param2, 'refresh');
        }
        if ($param1 == 'update_text') {
            $this->academic->updateTextHomework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/homeworkroom/' . $param3, 'refresh');
        }
        if ($param1 == 'update_file') {
            $this->academic->updateFileHomework($param2, $param3);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/homeworkroom/' . $param3, 'refresh');
        }
        if ($param1 == 'delete') {
            $this->academic->deleteFileHomework($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'student/homeworkroom/' . $param3, 'refresh');
        }
    }

    //Homework file function.
    function homework_file($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        $homework_code = $this->db->get_where('homework', array('homework_id'))->row()->homework_code;
        if ($param1 == 'upload') {
            $this->crud->upload_homework_file($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_updated'));
            redirect(base_url() . 'student/homeworkroom/file/' . $param2, 'refresh');
        } else if ($param1 == 'download') {
            $this->crud->download_homework_file($param2);
        }
    }

    //Forum function.
    function forumroom($param1 = '', $param2 = '')
    {
        $this->isStudent();
        $page_data['post_code'] = $param1;
        $page_data['page_name']   = 'forum_room';
        $page_data['page_title']  = getEduAppGTLang('forum');
        $this->load->view('backend/index', $page_data);
    }

    //Create report message function.
    function create_report_message($code = '')
    {
        $this->isStudent();
        $this->crud->createReportMessage();
    }

    //Delete notifications function.
    function notification($param1 = '', $param2 = '')
    {
        $this->isStudent();
        if ($param1 == 'delete') {
            $this->crud->deleteNotification($param2);
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_deleted'));
            redirect(base_url() . 'student/notifications/', 'refresh');
        }
    }

    //Create forum message function.
    function forum_message($param1 = '', $param2 = '', $param3 = '')
    {
        $this->isStudent();
        if ($param1 == 'add') {
            $this->crud->create_post_message(html_escape($this->input->post('post_code')));
        }
    }

    //Forum page function.
    function forum($param1 = '', $param2 = '', $student_id = '')
    {
        $this->isStudent();
        if ($param1 == 'create') {
            $post_code = $this->crud->create_post();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'student/forumroom/post/' . $post_code, 'refresh');
        }
        $page_data['page_name'] = 'forum';
        $page_data['page_title'] = getEduAppGTLang('forum');
        $page_data['data']   = $param1;
        $this->load->view('backend/index', $page_data);
    }

    //Request permission function.
    function request($param1 = "", $param2 = "")
    {
        $this->isStudent();
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        if (html_escape($_GET['id']) != "") {
            $notify['status'] = 1;
            $this->db->where('id', html_escape($_GET['id']));
            $this->db->update('notification', $notify);
        }
        if ($param1 == "create") {
            $this->crud->studentRequestPermission();
            $this->session->set_flashdata('flash_message', getEduAppGTLang('successfully_added'));
            redirect(base_url() . 'student/request/', 'refresh');
        }
        $data['page_name']  = 'request';
        $data['page_title'] = getEduAppGTLang('permissions');
        $this->load->view('backend/index', $data);
    }

    //Check student session.
    function isStudent()
    {
        if ($this->session->userdata('student_login') != 1) {
            redirect(base_url(), 'refresh');
        }
    }

    //End of Student.php
}
