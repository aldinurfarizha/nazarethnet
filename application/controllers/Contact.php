<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends EduAppGT
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
		$data['page_name']		=	'contact';
		$data['page_title']		=	getEduAppGTLang('contact_us');
		$this->load->view('frontend/index' , $data);
    }
    
    public function submitForm()
    {
        $recaptcha = $_POST["g-recaptcha-response"];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => $this->crud->getFront('secret_key'),
            'response' => $recaptcha
        );
        $options = array(
                'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success = json_decode($verify);

        if($captcha_success->success)
        {
            $this->mail->sendForm();
            $this->session->set_flashdata('message' , 'success');
            redirect(base_url() . 'contact/', 'refresh');
        }else{
            $this->session->set_flashdata('error' , 'success');
            redirect(base_url() . 'contact/', 'refresh');
        }
    }
}