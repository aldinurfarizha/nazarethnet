<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
    require_once('public/GoogleSDK/src/Google/autoload.php');
        
class Authorizeapp extends EduAppGT
{
    
  function __construct()
  {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT');
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

    public function index()
    {
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);
        try{
            $authCode = isset($_GET['code']) ? $_GET['code'] : '';
            if(!empty($authCode)){
                $client = new \Google_Client();
                $client->setApplicationName($this->db->get_where('settings', array('type' => 'system_name'))->row()->description);
        	    $client->setClientId($this->db->get_where('settings', array('type' => 'clientId'))->row()->description);
                $client->setClientSecret($this->db->get_where('settings', array('type' => 'ClientSecret'))->row()->description);
                $client->setRedirectUri(base_url().'authorizeapp');
                $client->setAccessType('online');           
                $client->authenticate($_GET['code']);
                $accessToken = $client->getAccessToken();

                $googleClient =  new \Google_Client();
                $googleClient->setAccessToken($accessToken);
                $googleDrive = new Google_Service_Drive($googleClient);
                
                $data['description'] = $accessToken;
                $this->db->where('type' , 'access_token');
                $this->db->update('settings' , $data);   ;
                
                $optParams = array(
                    'fields' => 'user'
                );
                if (is_array($accessToken) && array_key_exists('error', $accessToken)) {
                    echo implode(', ', $accessToken);
                    die;
                }
            } else {
                echo 'Drive Code not found';
            }
        } catch(\Exception $e){
            echo 'An error ocurred: '.$e->getMessage();
        }
        $this->saveUserInfo();
        echo '<script type="text/javascript">window.opener.parent.location.href = "'.base64_decode($_GET['state']).'"; window.close();</script>';
    }
    
    function saveUserInfo(){
        $response = $this->drive_model->getDrive()->about->get(['fields' => 'kind,storageQuota,user']);
        
        $data['description'] = $response->user->permissionId;
        $this->db->where('type' , 'account_id');
        $this->db->update('settings' , $data);
        
        $data['description'] = $response->user->displayName;
        $this->db->where('type' , 'account_name');
        $this->db->update('settings' , $data);      
        
        $data['description'] = $response->user->emailAddress;
        $this->db->where('type' , 'account_email');
        $this->db->update('settings' , $data);         
        
        $data['description'] = $response->storageQuota->limit;
        $this->db->where('type' , 'account_limit');
        $this->db->update('settings' , $data);         
        
        $data['description'] = $response->storageQuota->usage;
        $this->db->where('type' , 'account_usage');
        $this->db->update('settings' , $data);
        
        $data['description'] = $response->user->photoLink;
        $this->db->where('type' , 'account_image');
        $this->db->update('settings' , $data);
    }
}