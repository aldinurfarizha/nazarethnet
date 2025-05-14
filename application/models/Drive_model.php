<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('public/GoogleSDK/src/Google/autoload.php');

class Drive_model extends School
{
    private $runningYear = '';

    function __construct()
    {
        parent::__construct();
    }

    function getDrive()
    {
        $client = $this->getClient();

        if (!($client instanceof \Google_Client)) {
            throw new \Exception('Google Client is not available. Reason: ' . (is_string($client) ? 'Auth URL returned instead of client' : 'Unexpected error.'));
        }

        $drive_service = new \Google_Service_Drive($client);
        return $drive_service;
    }


    function magicDownloadLink($webContentLink)
    {
        $request     = new Google_Http_Request($webContentLink, 'GET');
        $this->getClient()->getIo()->setOptions([CURLOPT_FOLLOWLOCATION => 0]);
        $httpRequest = $this->getClient()->getIo()->makeRequest($request);
        $headers = $httpRequest->getResponseHeaders();

        if (isset($headers['set-cookie']) && false !== strpos($headers['set-cookie'], 'download_warning')) {
            preg_match('/download_warning.*=(.*);/iU', $headers['set-cookie'], $confirm);
            $new_download_link = $webContentLink . '&confirm=' . $confirm[1];
            $request = new Google_Http_Request($new_download_link, 'HEAD', ['Cookie' => $headers['set-cookie']]);
            $this->getClient()->getIo()->setOptions([CURLOPT_FOLLOWLOCATION => 0, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0, CURLOPT_NOBODY => true]);
            curl_close($this->getClient()->getIo()->getHandler());
            usleep(500000);
            $httpRequest = $this->getClient()->getIo()->makeRequest($request);
            $headers = $httpRequest->getResponseHeaders();
        }
        if (isset($headers['location'])) {
            echo $headers['location'];
        } else {
            exit();
        }
    }

    function refreshToken($token)
    {
        $update_data['description'] = $token;
        $this->db->where('type', 'access_token');
        return $this->db->update('settings', $update_data);

        $update_data2['description'] = $token;
        $this->db->where('type', 'refreshed');
        return $this->db->update('settings', $update_data2);
    }

    function getDriveFile()
    {
        $googledrive_file = new \Google_Service_Drive_DriveFile();
        return $googledrive_file;
    }

    function formatBytes($size, $precision = 2)
    {
        if ($size != '') {
            if ($size) {
                $size2 = $size;
                $base = log($size2, 1024);
                $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
                return round(pow(1024, $base - floor($base)), $precision) . '' . $suffixes[floor($base)];
            } else {
                return '0MB';
            }
        } else {
            return 'Unlimited';
        }
    }

    function deleteFile($fileId)
    {
        if ($this->db->get_where('settings', array('type' => 'account_id'))->row()->description != '') {
            $api      = $this->getDrive();
            $response = $api->files->delete($fileId);
        } else {
            return true;
        }
    }

    public function createSubjectFolder($subjectID)
    {
        try {
            $drive_service = $this->getDrive();
        } catch (\Exception $e) {
            $this->session->set_flashdata('flash_message_failed', 'failed automatic creae folder in GDrive. This subject doesnt have folder in GDrive ');
            return false;
        }
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $parent = $this->db->get_where('settings', array('type' => 'school_folderId'))->row()->description;
        $classID  = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->class_id;
        $className  = $this->db->get_where('class', array('class_id' => $classID))->row()->name;
        $sectionID = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->section_id;
        $sectionName = $this->db->get_where('section', array('section_id' => $sectionID))->row()->name;
        $subjectName = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->name;
        $api = $this->getDrive();
        $file = $this->getDriveFile();
        $file->setName($className . ' - ' . $sectionName . ' - ' . $subjectName . ' - ' . $year);
        $file->setParents([$parent]);
        $file->setMimeType('application/vnd.google-apps.folder');
        $reponse = $api->files->create($file);
        if ($reponse->id != '') {
            $data2['drive_folder'] = $reponse->id;
            $this->db->where('subject_id', $subjectID);
            $this->db->update('subject', $data2);
        }
    }

    public function schoolFolders()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $parent = $this->db->get_where('settings', array('type' => 'school_folderId'))->row()->description;
        $classes  = $this->db->get_where('class')->result_array();
        foreach ($classes as $sclass) {
            $sections = $this->db->get_where('section', array('class_id' => $sclass['class_id']))->result_array();
            foreach ($sections as $secclass) {
                $subjects = $this->db->get_where('subject', array('class_id' => $sclass['class_id'], 'section_id' => $secclass['section_id'], 'year' => $year))->result_array();
                foreach ($subjects as $row) {
                    $have_folder = $row['drive_folder'];
                    if ($have_folder == '') {
                        $api = $this->getDrive();
                        $file = $this->getDriveFile();
                        $file->setName($sclass['name'] . ' - ' . $secclass['name'] . ' - ' . $row['name'] . ' - ' . $year);
                        $file->setParents([$parent]);
                        $file->setMimeType('application/vnd.google-apps.folder');
                        $reponse = $api->files->create($file);
                        if ($reponse->id != '') {
                            $data2['drive_folder'] = $reponse->id;
                            $this->db->where('subject_id', $row['subject_id']);
                            $this->db->update('subject', $data2);
                        }
                    }
                }
            }
        }
    }

    function academicFolder($subjectID, $type)
    {
        if ($type == 'deliveries') {
            $parent = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->homeworks;
        } else {
            $parent = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->drive_folder;
        }
        $api = $this->getDrive();
        $file = $this->getDriveFile();
        $file->setName(getEduAppGTLang($type));
        $file->setParents([$parent]);
        $file->setMimeType('application/vnd.google-apps.folder');
        $reponse = $api->files->create($file);
        $data2[$type] = $reponse->id;
        $this->db->where('subject_id', $subjectID);
        $this->db->update('subject', $data2);
        return $reponse->id;
    }

    function uploadHomework($subjectId)
    {
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectId))->row()->homeworks;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectId, 'homeworks');
        }
        $result = 0;
        $file_tmp  = $_FILES["file_name"]["tmp_name"];
        $file_type = $_FILES["file_name"]["type"];
        $file_name = basename($_FILES["file_name"]["name"]);
        if (@move_uploaded_file($file_tmp, 'public/uploads/homework/' . $file_name)) {
            $result = 1;
        }
        $file_data = file_get_contents("public/uploads/homework/" . $file_name);
        $googledrive_file = $this->getDriveFile();
        $googledrive_file->setName($file_name);
        $googledrive_file->setMimeType($file_type);
        $googledrive_file->setParents([$folder]);
        $file_content = array(
            'data' => $file_data,
            'uploadType' => 'multipart',
            'supportsAllDrives' => true
        );
        try {
            $request = $this->getDrive()->files->create($googledrive_file, $file_content);
            if ($request->id != '') {
                return $request->id;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            return false;
        }
        unlink('public/uploads/homework/' . $file_name);
    }

    function uploadDeliveryHomework($subjectId, $file_name)
    {
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectId))->row()->deliveries;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectId, 'deliveries');
        }
        $file_type = mime_content_type("public/uploads/homework_delivery/" . basename($file_name));
        $file_data = file_get_contents("public/uploads/homework_delivery/" . basename($file_name));
        $googledrive_file = $this->getDriveFile();
        $googledrive_file->setName(basename($file_name));
        $googledrive_file->setMimeType($file_type);
        $googledrive_file->setParents([$folder]);
        $file_content = array(
            'data' => $file_data,
            'uploadType' => 'multipart',
            'supportsAllDrives' => true
        );
        //unlink('public/uploads/homework_delivery/'.$file_name);
        try {
            $request = $this->getDrive()->files->create($googledrive_file, $file_content);
            if ($request->id != '') {
                return $request->id;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            return false;
        }
    }

    function uploadStudyMaterial($subjectId)
    {
        try {
            $drive_service = $this->getDrive();
        } catch (\Exception $e) {
            $this->session->set_flashdata('flash_message_failed', 'failed automatic creae folder in GDrive. This subject doesnt have folder in GDrive ');
            return false;
        }
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectId))->row()->study_material;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectId, 'study_material');
        }
        $result = 0;
        $file_tmp  = $_FILES["file_name"]["tmp_name"];
        $file_type = $_FILES["file_name"]["type"];
        $file_name = basename($_FILES["file_name"]["name"]);
        if (@move_uploaded_file($file_tmp, 'public/uploads/document/' . $file_name)) {
            $result = 1;
        }
        $file_data = file_get_contents("public/uploads/document/" . $file_name);
        $googledrive_file = $this->getDriveFile();
        $googledrive_file->setName($file_name);
        $googledrive_file->setMimeType($file_type);
        $googledrive_file->setParents([$folder]);
        $file_content = array(
            'data' => $file_data,
            'uploadType' => 'multipart',
            'supportsAllDrives' => true
        );
        unlink('public/uploads/document/' . $file_name);
        try {
            $request = $this->getDrive()->files->create($googledrive_file, $file_content);
            if ($request->id != '') {
                return $request->id;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            return false;
        }
    }

    function uploadForum($subjectId)
    {
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectId))->row()->forums;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectId, 'forum');
        }
        $result = 0;
        $file_tmp  = $_FILES["userfile"]["tmp_name"];
        $file_type = $_FILES["userfile"]["type"];
        $file_name = basename($_FILES["userfile"]["name"]);
        if (@move_uploaded_file($file_tmp, 'public/uploads/forum/' . $file_name)) {
            $result = 1;
        }
        $file_data = file_get_contents("public/uploads/forum/" . $file_name);
        $googledrive_file = $this->getDriveFile();
        $googledrive_file->setName($file_name);
        $googledrive_file->setMimeType($file_type);
        $googledrive_file->setParents([$folder]);
        $file_content = array(
            'data' => $file_data,
            'uploadType' => 'multipart',
            'supportsAllDrives' => true
        );
        unlink('public/uploads/forum/' . $file_name);
        try {
            $request = $this->getDrive()->files->create($googledrive_file, $file_content);
            if ($request->id != '') {
                return $request->id;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            return false;
        }
    }

    function uploadForums($subjectID)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->forums;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectID, 'forum');
        }
        $forums = $this->db->get_where('forum', array('subject_id' => $subjectID, 'file_name !=' => '', 'sync_status' => 0))->result_array();
        foreach ($forums as $forum) {
            $file_name = basename($forum['file_name']);
            $file_type = mime_content_type("public/uploads/forum/" . $file_name);
            $file_data = file_get_contents("public/uploads/forum/" . $file_name);
            $googledrive_file = $this->getDriveFile();
            $googledrive_file->setName($file_name);
            $googledrive_file->setMimeType($file_type);
            $googledrive_file->setParents([$folder]);
            $file_content = array(
                'data' => $file_data,
                'uploadType' => 'multipart',
                'supportsAllDrives' => true
            );
            if ($this->db->get_where('settings', array('type' => 'delete_drive'))->row()->description == '1') {
                unlink('public/uploads/forum/' . $file_name);
            }
            sleep(1);
            try {
                $request = $this->getDrive()->files->create($googledrive_file, $file_content);
                if ($request->id != '') {
                    $dbdata['file_name'] = $request->id;
                    $dbdata['sync_status'] = 1;
                    $this->db->where('post_id', $forum['post_id']);
                    $this->db->update('forum', $dbdata);
                }
            } catch (\Exception $ex) {
                return false;
            }
        }
    }

    function uploadMaterial($subjectID)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->study_material;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectID, 'study_material');
        }
        $material = $this->db->get_where('document', array('subject_id' => $subjectID, 'file_name !=' => '', 'sync_status' => 0, 'year' => $year))->result_array();
        foreach ($material as $mat) {
            $file_name = basename($mat['file_name']);
            $file_type = mime_content_type("public/uploads/document/" . $file_name);
            $file_data = file_get_contents("public/uploads/document/" . $file_name);
            $googledrive_file = $this->getDriveFile();
            $googledrive_file->setName($file_name);
            $googledrive_file->setMimeType($file_type);
            $googledrive_file->setParents([$folder]);
            $file_content = array(
                'data' => $file_data,
                'uploadType' => 'multipart',
                'supportsAllDrives' => true
            );
            if ($this->db->get_where('settings', array('type' => 'delete_drive'))->row()->description != '') {
                unlink('public/uploads/document/' . $file_name);
            }
            sleep(1);
            try {
                $request = $this->getDrive()->files->create($googledrive_file, $file_content);
                if ($request->id != '') {
                    $dbdata['file_name'] = $request->id;
                    $dbdata['sync_status'] = 1;
                    $this->db->where('document_id', $mat['document_id']);
                    $this->db->update('document', $dbdata);
                }
            } catch (\Exception $ex) {
                return false;
            }
        }
    }

    function uploadHomeworks($subjectID)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $parent = $this->db->get_where('subject', array('subject_id' => $subjectID))->row()->homeworks;
        if ($parent != '') {
            $folder = $parent;
        } else {
            $folder = $this->academicFolder($subjectID, 'homeworks');
        }
        $homeworks = $this->db->get_where('homework', array('subject_id' => $subjectID, 'file_name !=' =>  '', 'sync_status' => 0, 'year' => $year))->result_array();
        foreach ($homeworks as $home) {
            $file_name = basename($home['file_name']);
            $file_type = mime_content_type("public/uploads/homework/" . $file_name);
            $file_data = file_get_contents("public/uploads/homework/" . $file_name);
            $googledrive_file = $this->getDriveFile();
            $googledrive_file->setName($file_name);
            $googledrive_file->setMimeType($file_type);
            $googledrive_file->setParents([$folder]);
            $file_content = array(
                'data' => $file_data,
                'uploadType' => 'multipart',
                'supportsAllDrives' => true
            );
            if ($this->db->get_where('settings', array('type' => 'delete_drive'))->row()->description == '1') {
                unlink('public/uploads/homework/' . $file_name);
            }
            sleep(1);
            try {
                $request = $this->getDrive()->files->create($googledrive_file, $file_content);
                if ($request->id != '') {
                    $dbdata['file_name'] = $request->id;
                    $dbdata['sync_status'] = 1;
                    $this->db->where('homework_id', $home['homework_id']);
                    $this->db->update('homework', $dbdata);
                }
            } catch (\Exception $ex) {
                return false;
            }
        }
    }

    function uploadFolder($subjectID)
    {
        $this->uploadHomeworks($subjectID);
        $this->uploadForums($subjectID);
        $this->uploadMaterial($subjectID);
        echo 'success';
    }

    function createAcademicFolder($name, $id, $parent, $type)
    {
        $api = $this->getDrive();
        $file = $this->getDriveFile();
        $file->setName($name);
        $file->setParents('root');
        $file->setMimeType('application/vnd.google-apps.folder');
        $reponse = $api->files->create($file);
        if ($reponse->id != '') {
            $data['description'] = $this->getFolder();
            $this->db->where('type', 'school_folder');
            $this->db->update('settings', $data);

            $data2['description'] = $reponse->id;
            $this->db->where('type', 'school_folderId');
            $this->db->update('settings', $data2);
        }
    }

    function checkFolder()
    {
        $have_folder = $this->db->get_where('settings', array('type' => 'school_folder'))->row()->description;
        if ($have_folder != '') {
            return true;
        } else {
            $api = $this->getDrive();
            $file = $this->getDriveFile();
            $file->setName($this->db->get_where('settings', array('type' => 'system_name'))->row()->description . ' - ' . $this->db->get_where('settings', array('type' => 'system_title'))->row()->description);
            $file->setParents('root');
            $file->setMimeType('application/vnd.google-apps.folder');
            $reponse = $api->files->create($file);
            if ($reponse->id != '') {
                $data['description'] = $this->getFolder();
                $this->db->where('type', 'school_folder');
                $this->db->update('settings', $data);

                $data2['description'] = $reponse->id;
                $this->db->where('type', 'school_folderId');
                $this->db->update('settings', $data2);
            }
        }
    }
    function generateNewFolder()
    {
        
            $api = $this->getDrive();
            $file = $this->getDriveFile();
            $file->setName($this->db->get_where('settings', array('type' => 'system_name'))->row()->description . ' - ' . $this->db->get_where('settings', array('type' => 'system_title'))->row()->description);
            $file->setParents('root');
            $file->setMimeType('application/vnd.google-apps.folder');
            $reponse = $api->files->create($file);
            if ($reponse->id != '') {
                $data['description'] = $this->getFolder();
                $this->db->where('type', 'school_folder');
                $this->db->update('settings', $data);

                $data2['description'] = $reponse->id;
                $this->db->where('type', 'school_folderId');
                $this->db->update('settings', $data2);
            }
        
    }

    function getFolder()
    {
        $have_folder = $this->db->get_where('settings', array('type' => 'school_folderId'))->row()->description;
        if ($have_folder != "") {
            return $have_folder;
        } else {
            return  base64_encode(base_url());
        }
    }

    function getImage($image)
    {
        if ($image != '') {
            return $image;
        } else {
            return $this->get_image_url('admin', $this->session->userdata('login_user_id'));
        }
    }

    function removeAccount()
    {
        $data['description'] = '';
        $this->db->where('type', 'account_id');
        $this->db->update('settings', $data);

        $data['description'] = '';
        $this->db->where('type', 'account_name');
        $this->db->update('settings', $data);

        $data['description'] = '';
        $this->db->where('type', 'account_email');
        $this->db->update('settings', $data);

        $data['description'] = '';
        $this->db->where('type', 'account_limit');
        $this->db->update('settings', $data);

        $data['description'] = '';
        $this->db->where('type', 'account_usage');
        $this->db->update('settings', $data);

        $data['description'] = '';
        $this->db->where('type', 'account_image');
        $this->db->update('settings', $data);

        $data['description'] = '';
        $this->db->where('type', 'access_token');
        $this->db->update('settings', $data);

        $this->removeSubjectsAccount();
    }

    function removeSubjectsAccount()
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        $subjects = $this->db->get_where('subject', array('year' => $year))->result_array();
        foreach ($subjects as $row) {
            $data['drive_folder']   = '';
            $data['online_exams']   = '';
            $data['homeworks']      = '';
            $data['forum']          = '';
            $data['study_material'] = '';
            $data['deliveries']     = '';
            $this->db->where('subject_id', $row['subject_id']);
            $this->db->update('subject', $data);
        }
    }

    function getClient()
    {
        $state = base_url() . 'admin/drive/';
        try {
            $client = new \Google_Client();
            $client->getLibraryVersion();
        } catch (\Exception $ex) {
            return $ex;
        }

        // Set application name and credentials
        $client->setApplicationName($this->db->get_where('settings', array('type' => 'system_name'))->row()->description);
        $client->setClientId($this->db->get_where('settings', array('type' => 'clientId'))->row()->description);
        $client->setClientSecret($this->db->get_where('settings', array('type' => 'ClientSecret'))->row()->description);
        $client->setRedirectUri('https://nazarethnet.com/authorizeapp');
        $client->setApprovalPrompt('force');
        $client->setAccessType('offline'); // Ensure offline access to get refresh token
        $client->setScopes([
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ]);
        $client->setState(strtr(base64_encode($state), '+/=', '-_~'));

        // Get access token from the database
        $accessToken = $this->db->get_where('settings', array('type' => 'access_token'))->row()->description;

        if ($accessToken != '') {
            try {
                $client->setAccessToken($accessToken);
            } catch (\Exception $ex) {
                $authUrl = $client->createAuthUrl();
                return $authUrl;
            }
        }

        // Check if the access token is expired
        if (false === $client->isAccessTokenExpired() && $accessToken != '') {
            return $client;
        } else if ($accessToken != '') {
            // Refresh Access Token using the refresh token
            $refreshToken = $client->getRefreshToken();
            if ($refreshToken) {
                try {
                    $client->refreshToken($refreshToken);
                    $accessToken = $client->getAccessToken();
                    $client->setAccessToken($accessToken);
                    // Update the access token in the database
                    $this->refreshToken($accessToken);
                    return $client;
                } catch (\Exception $ex) {
                    // If refresh token fails, generate auth URL
                    $authUrl = $client->createAuthUrl();
                    return $authUrl;
                }
            }
        }

        // If no access token or refresh token is available, create auth URL
        $authUrl = $client->createAuthUrl();
        return $authUrl;
    }
    function refreshTokenManual()
    {
         $state = base_url() . 'admin/drive/';
        try {
            $client = new \Google_Client();
            $client->getLibraryVersion();
        } catch (\Exception $ex) {
            return $ex;
        }

        // Set application name and credentials
        $client->setApplicationName($this->db->get_where('settings', array('type' => 'system_name'))->row()->description);
        $client->setClientId($this->db->get_where('settings', array('type' => 'clientId'))->row()->description);
        $client->setClientSecret($this->db->get_where('settings', array('type' => 'ClientSecret'))->row()->description);
        $client->setRedirectUri(base_url() . 'authorizeapp');
        $client->setApprovalPrompt('force');
        $client->setAccessType('offline'); // Ensure offline access to get refresh token
        $client->setScopes([
            'https://www.googleapis.com/auth/drive',
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
        ]);
        $client->setState(strtr(base64_encode($state), '+/=', '-_~'));

        // Get access token from the database
        $accessToken = $this->db->get_where('settings', array('type' => 'access_token'))->row()->description;

        if ($accessToken != '') {
            try {
                $client->setAccessToken($accessToken);
            } catch (\Exception $ex) {
                $authUrl = $client->createAuthUrl();
                return $authUrl;
            }
        }
        $refreshToken = $client->getRefreshToken();
        $client->refreshToken($refreshToken);
        $newAccessToken = $client->getAccessToken();
        $client->setAccessToken($newAccessToken);
        $this->refreshToken($newAccessToken);
        return $client;
        die();
        // Check if the access token is expired
        if (false === $client->isAccessTokenExpired() && $accessToken != '') {
            return $client;
        } else if ($accessToken != '') {
            // Refresh Access Token using the refresh token
            $refreshToken = $client->getRefreshToken();
            if ($refreshToken) {
                try {
                    $client->refreshToken($refreshToken);
                    $accessToken = $client->getAccessToken();
                    $client->setAccessToken($accessToken);
                    // Update the access token in the database
                    $this->refreshToken($accessToken);
                    return $client;
                } catch (\Exception $ex) {
                    // If refresh token fails, generate auth URL
                    $authUrl = $client->createAuthUrl();
                    return $authUrl;
                }
            }
        }

        // If no access token or refresh token is available, create auth URL
        $authUrl = $client->createAuthUrl();
        return $authUrl;
    }

    function getCode()
    {
        return strtoupper(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 15));
    }

    function checkSyncStatus($subjectID)
    {
        if ($this->countByType($subjectID, 'forum') > 0 || $this->countByType($subjectID, 'homework') > 0 || $this->countByType($subjectID, 'document') > 0) {
            return 'yet';
        } else {
            return 'done';
        }
    }

    function countByType($subjectID, $type)
    {
        $year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
        if ($type != 'forum') {
            $this->db->where('year', $year);
        }
        $this->db->where('subject_id', $subjectID);
        $this->db->where('sync_status', 0);
        $this->db->where('file_name !=', '');
        return $this->db->get($type)->num_rows();
    }

    public function get_embed_url($id)
    {
        $response = $this->setPermissions($id);
        $preview = 'https://drive.google.com/file/d/' . $id . '/preview?rm=minimal';
        return $preview;
    }

    public function setPermissions($fileId)
    {
        $new_permission = new \Google_Service_Drive_Permission();
        $new_permission->setType('anyone');
        $new_permission->setRole('reader');
        $new_permission->setAllowFileDiscovery(false);
        $params = [
            'supportsAllDrives' => true,
        ];
        try {
            $updated_permission =  $this->getDrive()->permissions->create($fileId, $new_permission, $params);
        } catch (\Exception $ex) {
            return false;
        }
        return true;
    }
}
