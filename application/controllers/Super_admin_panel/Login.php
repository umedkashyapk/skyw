<?php
class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){  
    
    
       
        
        if($this->session->has_userdata('super_admin_login')){

            redirect(base_url($this->conn->company_info('super_admin_path').'/dashboard'));
        }else{
            if(isset($_POST['login'])){
                $this->form_validation->set_rules('username', 'Username', 'required');
                   $this->form_validation->set_rules('password', 'Password', 'required');
                     if($this->form_validation->run() == TRUE){
                         $where = array(
                              'user'=>$_POST['username'],                   
                              'password'=>md5($_POST['password']) ,                  
                              'type'=> 'super_admin'                  
                          );
   
                          $res=$this->conn->runQuery('*','admin',$where);
                          if($res){
                               
                               $this->session->set_userdata("super_admin_login", true);                            
                               $this->session->set_userdata("super_admin_id", $res[0]->id);                            
                               $this->session->set_userdata("super_admin_type", $res[0]->type);                            
                               $this->session->set_flashdata("success", "You are logged in");
                                
                                $ip = $this->input->ip_address();
                            
                            $login_details['u_code'] = $res[0]->id;
                            $login_details['ip_address'] = $ip;
                            $login_details['type'] = 'super_admin';
                            $this->db->insert('login_details',$login_details);
                                
                               if(1!=1){
                                   redirect($this->session->userdata('login_redirect'), "refresh");
                               }else{
                                   redirect(base_url($this->conn->company_info('super_admin_path')."/dashboard"), "refresh");
                               }
                               
                          }else{
                              $this->session->set_flashdata("error", "Incorrect username or password.");
                           } 
                     }
           }


            $data['panel']=$panel=$this->conn->company_info('super_admin_panel');
            $data['super_admin_directory']=$admin_directory=$this->conn->company_info('super_admin_directory');
            $data['panel_url']=base_url().$admin_directory.'/'.$panel.'/';
            
            $this->load->view($admin_directory.'/pages/login',$data);

        }
    }
}