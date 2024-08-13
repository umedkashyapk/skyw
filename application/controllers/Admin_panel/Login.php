<?php
class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){  

        if($this->session->has_userdata('admin_login')){

            redirect(base_url($this->conn->company_info('admin_path').'/dashboard'));
        }else{
            if(isset($_POST['login'])){
                $this->form_validation->set_rules('username', 'Username', 'required');
                   $this->form_validation->set_rules('password', 'Password', 'required');
                     if($this->form_validation->run() == TRUE){
                         $where = array(
                              'user'=>$_POST['username'],                   
                              'password'=>md5($_POST['password'])                   
                          );
   
                          $res=$this->conn->runQuery('*','admin',$where);
                          if($res){
                               
                               $this->session->set_userdata("admin_login", true);                            
                               $this->session->set_userdata("admin_id", $res[0]->id);  
                                $this->session->set_userdata("admin_rights", $res[0]->rights);  
                               $this->session->set_userdata("admin_type", $res[0]->type);                            
                               $this->session->set_flashdata("success", "You are logged in");
   
                               if(1!=1){
                                   redirect($this->session->userdata('login_redirect'), "refresh");
                               }else{
                                   redirect(base_url($this->conn->company_info('admin_path')."/dashboard"), "refresh");
                               }
                               
                          }else{
                              $this->session->set_flashdata("error", "Incorrect username or password.");
                           } 
                     }
           }


            $data['panel']=$panel=$this->conn->company_info('admin_panel');
            $data['admin_directory']=$admin_directory=$this->conn->company_info('admin_directory');
            $data['panel_url']=base_url().$admin_directory.'/'.$panel.'/';
            
            $this->load->view($admin_directory.'/pages/login',$data);

        }
    }
    public function verify_2fa(){
        $user_id = $this->session->userdata('admin_id');
        // Check if 2FA is enabled for the user
        $is_2fa_enabled = $this->secure->getStatus($user_id,'admin');
         $data['is_2fa_enabled'] = $is_2fa_enabled;
         $data['admin_directory']=$admin_directory=$this->conn->company_info('admin_directory');
         $this->load->view($admin_directory.'/pages/verify_2fa', $data);
    }
    public function get_verify_2fa(){
       $code=$_POST['2fa_code'];
        $user_id = $this->session->userdata('admin_id');
        print_r($this->secure->verify2FA($user_id,$code,'admin'));
        die();
        if($this->secure->verify2FA($user_id,$code,'admin')){
            
            $this->session->set_userdata("tfa_verified", true); 
            $is_2fa_verified = $this->session->userdata('tfa_verified');
            $this->session->set_flashdata("success", "2FA verified");
            
        }
        // print_r("hlo");
        //     die();
        redirect(base_url($this->conn->company_info('admin_path')."/dashboard"), "refresh");
    }
}