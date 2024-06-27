<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends EduAppGT {

    /*
        Software: EduAppGT PRO - School Management System
        Author: GuateApps - Software, Web and Mobile developer.
        Author URI: https://guateapps.app.
        PHP: 5.6+
        Created: 27 September 16.
    */
    
    public function __construct() {
       parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');    
        $this->load->helper(array('url','html','form')); 
    }
 
    public function index() 
    {
        //$this->load->view('dropzone_view');
    }
    
    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'kb', 'MB', 'GB', 'TB');   
        return round(pow(1024, $base - floor($base)), $precision).$suffixes[floor($base)];
    }

    public function upload($param1 = '', $param2 = '', $param3 = '') 
    {
        $upload_folder = getcwd() . '/public/uploads/gallery/';
    	ini_set( 'memory_limit', '200M' );
        ini_set('upload_max_filesize', '200M');  
        ini_set('post_max_size', '200M');  
        ini_set('max_input_time', 3600);  
        ini_set('max_execution_time', 3600);
        
        if (!empty($_FILES)) 
        {
        	$tempFile = $_FILES['file']['tmp_name'];
        	$fileName = $_FILES['file']['name'];
        	$targetPath = $upload_folder;
        	$targetFile = $targetPath . $fileName;
        	move_uploaded_file($tempFile, $targetFile);
        	$data['name']  = $fileName;
        	$data['date']  = $this->crud->getDateFormat();
        	$data['size']  = $this->formatBytes($_FILES["file"]["size"]);
        	$this->db->insert('gallery', $data);
        }
    }

    
}