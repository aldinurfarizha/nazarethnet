<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends EduAppGT
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
		$this->load->library('user_agent');
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }
   
    public function index()
    {
      
		$data['page_name']		=	'home';
		$data['page_title']		=	getEduAppGTLang('home_page');
		$this->load->view('frontend/index' , $data);
    }
    public function comment()
    {
        if($this->input->is_ajax_request() == false){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Unauthorized'
                ]));
        }
        $login_type = $this->session->userdata('login_type');
        $login_user_id = $this->session->userdata('login_user_id');
        $allowed_types = ['admin', 'teacher', 'student', 'parent'];
        if ($login_user_id == null) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Unauthorized'
                ]));
        }
        if (in_array($login_type, $allowed_types) == false) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Unauthorized Login Type'
                ]));
        }
        $comment = $this->input->post('comment');
        if (empty($comment)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Comment cannot be empty'
                ]));
        }
        $id = $this->input->post('id');
        if (empty($id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'ID cannot be empty'
                ]));
        }
        $table = $this->input->post('table');
        if (empty($table)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Table cannot be empty'
                ]));
        }
        $comment=post_comment($id, $comment, $table);
        if($comment==false){
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Error saving comment'
                ]));
        }
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode([
                'status' => 'Success',
                'messages' => getEduAppGTLang('comment_sent')
            ]));
    }
    public function reaction()
    {
        if ($this->input->is_ajax_request() == false) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Unauthorized'
                ]));
        }
        $login_type = $this->session->userdata('login_type');
        $login_user_id = $this->session->userdata('login_user_id');
        $allowed_types = ['admin', 'teacher', 'student', 'parent'];
        if ($login_user_id == null) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Unauthorized'
                ]));
        }
        if (in_array($login_type, $allowed_types) == false) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Unauthorized Login Type'
                ]));
        }
        $content_id= $this->input->post('content$content_id');
        if (empty($content_id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Content id cannot be empty'
                ]));
        }
        $reaction_id = $this->input->post('reaction_id');
        if (empty($reaction_id)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Reaction ID cannot be empty'
                ]));
        }
        $table = $this->input->post('table');
        if (empty($table)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Table cannot be empty'
                ]));
        }
        $table_id_fields = [
            'news_reactions'     => 'news_id',
            'document_reactions' => 'document_id',
            'forum_reactions'    => 'forum_id',
            'homework_reactions' => 'homework_id',
        ];
        if (!array_key_exists($table, $table_id_fields)) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => 'error',
                    'messages' => 'Invalid table name'
                ]));
        }
        $content_field = $table_id_fields[$table];
        $dataInsert = [
            $content_field   => $content_id,
            'reaction_id'    => $reaction_id,
            'student_id'     => 0,
            'teacher_id'     => 0,
            'admin_id'       => 0,
            'created_at'     => date('Y-m-d H:i:s'),
        ];
        $user_field = "{$login_type}_id";
        $dataInsert[$user_field] = $login_user_id;
        $this->db->where($content_field, $content_id);
        $this->db->where($user_field, $login_user_id);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            $this->db->where($content_field, $content_id);
            $this->db->where($user_field, $login_user_id);
            $this->db->update($table, [
                'reaction_id' => $reaction_id,
                'created_at'  => date('Y-m-d H:i:s')
            ]);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => 'success',
                    'messages' => 'Reaction updated successfully'
                ]));
        } else {
            $this->db->insert($table, $dataInsert);
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode([
                    'status' => 'success',
                    'messages' => 'Reaction Insert successfully'
                ]));
        }

    }
}