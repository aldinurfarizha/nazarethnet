<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Certificate extends EduAppGT 
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
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Index function.
    public function index()
    {
       
        $data['page_name']        =    'certificate';
        $data['page_title']        =    getEduAppGTLang('certificate');
        $this->load->view('frontend/index', $data);
    }
    public function check()
    {
        $certCode = strtoupper($this->input->post('certCode'));
        $certCode = preg_replace("/[^A-Z0-9]/", "", $certCode);
        if(strlen($certCode)!= 10){
            redirect(base_url() . 'certificate/invalid/'.$certCode);
        }
        $data['student_subject'] = $this->db->get_where('student_subject', array('cert_code' => $certCode))->row();
        if(!$data['student_subject']){
            redirect(base_url() . 'certificate/invalid');
        }
        $data['student'] = $this->db->get_where('student', array('student_id' => $data['student_subject']->student_id))->row();
        if(!$data['student']){
            redirect(base_url() . 'certificate/invalid');
        }
        $data['subject'] = $this->db->get_where('subject', array('subject_id' => $data['student_subject']->subject_id))->row();
        if(!$data['subject']){
            redirect(base_url() . 'certificate/invalid');
        }
        $data['page_name']        =    'certificate_found';
        $data['page_title']        =    getEduAppGTLang('certificate_verified');
        $this->load->view('frontend/index', $data);
    }
    public function invalid($certCode = '')
    {
        $data['certCode'] = $certCode;
        $data['certificate_status'] = 'invalid';
        $data['page_name']        =    'certificate';
        $data['page_title']        =    getEduAppGTLang('certificate');
        $this->load->view('frontend/index', $data);
    }
    function download($certCode,$type='download')
    {
        $certCode = preg_replace("/[^A-Z0-9]/", "", $certCode);
        if (strlen($certCode) != 10) {
            redirect(base_url() . 'certificate/invalid/' . $certCode);
        }
        $this->load->library('pdf_generator');
        if ($certCode === "TESTING123") {
            $backgroundimage = $this->db->get_where('certificate_image', ['id' => 1])->row()->image ?? "default.png";
            $backgroundFilePath = FCPATH . "public/certificates/$backgroundimage";

            $qrCodeFilePath = FCPATH . "public/uploads/certificateqr/TESTING.png";

            $data = [
                'studentName' => 'John Doe',
                'courseTitle' => 'Dummy Course Title',
                'certificateCode' => 'TESTING',
                'issueDate' => date('Y-m-d'),
                'backgroundFilePath' => $backgroundFilePath,
                'qrCodeFilePath' => $qrCodeFilePath,
            ];
        } else {
            $studentSubject = $this->db->get_where('student_subject', ['cert_code' => $certCode])->row();
            if (!$studentSubject) {
                redirect(base_url(), 'refresh');
            }
            $student = $this->db->get_where('student', ['student_id' => $studentSubject->student_id])->row();
            if (!$student) {
                redirect(base_url(), 'refresh');
            }
            $subject = $this->db->get_where('subject', ['subject_id' => $studentSubject->subject_id])->row();
            if (!$subject) {
                redirect(base_url(), 'refresh');
            }

            $backgroundimage = $this->db->get_where('certificate_image', ['id' => 1])->row()->image ?? "default.png";
            $backgroundFilePath = FCPATH . "public/certificates/$backgroundimage";
            $qrCodeFilePath = FCPATH . "public/uploads/certificateqr/{$certCode}.png";
            $issueDateFormatted = date('Y-m-d', strtotime($studentSubject->cert_generated_at));

            $data = [
                'studentName' => $student->first_name . ' ' . $student->last_name,
                'courseTitle' => $subject->name,
                'certificateCode' => $certCode,
                'issueDate' => $issueDateFormatted,
                'backgroundFilePath' => $backgroundFilePath,
                'qrCodeFilePath' => $qrCodeFilePath,
            ];
        }

        $html = $this->load->view('certificates/certificate_template', $data, true);
        if($type == 'view'){
            $mode= 'I';
        }else{
            $mode= 'D';
        }
        $this->pdf_generator->generate($html, "nazarethnet-certificate-{$certCode}.pdf", $mode, [
            'format' => 'A4-L',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);
    }
}