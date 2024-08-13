<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
// header("Access-Control-Allow-Headers: X-Requested-With");

class Google_authenticator extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }
    
    
      public function get_2fa_call() {
          $sdfg = $this->input->get_request_header('token', TRUE);
        // $sdfg   = $this->input->request_headers()['token'];
        $user_id =  $this->token->userByToken($sdfg);
        // $user_id = 11;
        
        if($user_id){
        $is_2fa_enabled = $this->secure->getStatus($user_id);
    
        $res = [];
        if (!$is_2fa_enabled) {
            // Generate QR code URL
              $secret=$this->secure->getSecret();
            $res['qr_code_url'] = $this->secure->getQr($secret);
            $res['tfa_secret']=$secret;
        }
    
            $res['is_2fa_enabled'] = $is_2fa_enabled;
                    $res['res']= 'success';
                    $res['message']= "chal gai";
            
        }else{
            $res['res'] ='error';
            $res['tokenStatus'] ='false';
            $res['message']= 'Token Expired!';
        }
        
    //   $user_id = $this->session->userdata('admin_id');
        
        // Check if 2FA is enabled for the user
        $is_2fa_enabled = $this->secure->getStatus($user_id);
    
        $data = [];
        if (!$is_2fa_enabled) {
            // Generate QR code URL
              $secret=$this->secure->getSecret();
            $data['qr_code_url'] = $this->secure->getQr($secret);
            $data['tfa_secret']=$secret;
        }
    
        $data['is_2fa_enabled'] = $is_2fa_enabled;
       
       print_r(json_encode($res));
        // $this->show->admin_panel('security', $data);
    }
    
    public function enable2FA() {
        $sdfg = $this->input->get_request_header('token', TRUE);
        // $sdfg   = $this->input->request_headers()['token'];
        $user_id =  $this->token->userByToken($sdfg);
        $input_data = $this->conn->get_input();
        if($user_id){
        if(isset($_POST['token_data'])){
            $secret=$_POST['token_data'];
            // $user_id = $this->session->userdata('admin_id');
            $res['res']=$this->secure->saveSecret($user_id,$secret);
            // $res['tokenStatus'] ='true';
            // $res['message']= 'Token Expired!';
            // $this->session->set_flashdata("success", "2FA Enabled successfully");
            
        }
        // else{$res['res'] ='user';
        //     $res['tokenStatus'] ='false';
        //     $res['message']= 'Token Expired!';}
        }
        else{
             $res['res'] ='error';
            $res['tokenStatus'] ='false';
            $res['message']= 'Token Expired!';
        }
         print_r(json_encode($res));
        // redirect($this->admin_path.'/security');
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
    
    
    
}?>