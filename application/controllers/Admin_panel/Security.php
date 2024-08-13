<?php
require_once APPPATH . 'libraries/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';

class Security extends CI_Controller {

    public function __construct() {
        parent::__construct();
        /* error_reporting(E_ALL);
        
        // Display errors
        ini_set('display_errors', 1);*/
        $this->ga = new PHPGangsta_GoogleAuthenticator();
        $this->admin_path=$this->conn->company_info('admin_directory');
    }
    
    public function index() {
       $user_id = $this->session->userdata('admin_id');
        
        // Check if 2FA is enabled for the user
        $is_2fa_enabled = $this->secure->getStatus($user_id,'admin');
    
        $data = [];
        if (!$is_2fa_enabled) {
            // Generate QR code URL
              $secret=$this->secure->getSecret();
            $data['qr_code_url'] = $this->secure->getQr($secret);
            $data['tfa_secret']=$secret;
        }
    
        $data['is_2fa_enabled'] = $is_2fa_enabled;
       
        $this->show->admin_panel('security', $data);
    }
    
    public function enable2FA() {
        /*echo $this->admin_path;
        die();*/
        if(isset($_POST['secret'])){
            $secret=$_POST['secret'];
            $user_id = $this->session->userdata('admin_id');
            $res=$this->secure->saveSecret($user_id,$secret,'admin');
            $this->session->set_flashdata("success", "2FA Enabled successfully");
            
        }
        redirect($this->admin_path.'/security');
    }
    
    public function disable2FA() {
        if(isset($_POST['otp'])){
            $otp=$_POST['otp'];
            $user_id = $this->session->userdata('admin_id');
            if($this->secure->verify2FA($user_id,$otp,'admin')){
                $this->db->where('id',$user_id);
                $update['tfa_status']=false;
                if($this->db->update('admin',$update)){
                    $this->session->set_flashdata("success", "2FA disabled successfully.");
                }  
            }else{
                $this->session->set_flashdata("error", " Wrong 2FA code.");
            }
        }
        redirect($this->admin_path.'/security');
    }
    
}
?>
