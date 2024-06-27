<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Drive extends EduAppGT
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

    }

    function authorizePermissions(){
        $fileId = $this->input->post('fileId');
        $new_permission = new \Google_Service_Drive_Permission();
        $new_permission->setType('anyone');
        $new_permission->setRole('reader');
        $new_permission->setAllowFileDiscovery(false); 
        $params = [
            'supportsAllDrives' => true,
        ];
        try {
            $updated_permission =  $this->crud_model->getDrive()->permissions->create(base64_decode($fileId), $new_permission, $params);
            echo 'success';
        } catch (\Exception $ex) {
            echo 'error';
        }
    }

    public function getUrl()
    {
        $id = base64_decode($this->input->post('fileId'));
        $mimetype = base64_decode($this->input->post('mimeType'));
        $preview = 'https://drive.google.com/file/d/'.$id.'/preview?rm=demo';
        echo $preview;
    }

    function accessToken() 
    {
        $response                       = array();
        $key             = $this->input->post('access_key');
        $query = $this->db->get_where('tokens_autorizados', array('token' => $key));
        if ($query->num_rows() > 0) 
        {
            $row = $query->row();
            $response['status']             = 'success';
        }
        else {
            $response['status']         =   'denied';
        }
        return json_encode($response['status'],true);
    }

    function createFolder(){
        $api = $this->crud_model->getDrive();
        $file = $this->crud_model->getDriveFile();
        $file->setName($this->input->post('folderName'));
        $file->setParents('root');
        $file->setMimeType('application/vnd.google-apps.folder');
        $reponse = $api->files->create($file);
        echo $reponse->id;
    }

    function deleteFile(){
        $fileId  = $this->input->post('fileId');
        $api     = $this->crud_model->getDrive();
        $response = $api->files->delete($fileId);
        echo 'success';
    }

    function createFile(){
        $file_type  = $this->input->post('fileType');
        $parent     = $this->input->post('folderName');
        $file_name  = basename($this->input->post('fileName'));
        $file_data = file_get_contents(base64_decode($this->input->post('url'))."public/uploads/patient_files/".$file_name);
        $googledrive_file = $this->crud_model->getDriveFile();
        $googledrive_file->setName($file_name);
        $googledrive_file->setMimeType($file_type);
        $googledrive_file->setParents([$parent]);
        $file_content = array(
            'data' => $file_data,
            'uploadType' => 'multipart',
            'supportsAllDrives' => true
        );
        try {
            $request = $this->crud_model->getDrive()->files->create($googledrive_file, $file_content);
            echo $request->id;
        } catch (\Exception $ex) {
            echo 'error';
        }
    }
}