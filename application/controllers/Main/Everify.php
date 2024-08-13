<?php
class Everify extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){ 
        if(isset($_POST['verify'])){
            $username=$_POST['username'];
            $code=$_POST['code'];
             
            $details=$this->conn->runQuery('id,active_status,email_code,is_email_verify','users',"username='$username'");
            $emailcode=$details[0]->email_code;
            if($emailcode==$code){
                $this->db->set('is_email_verify',1);
                $this->db->where('username',$username);
                $this->db->update('users');
                redirect(base_url('success'),"refresh"); 
            }else{
                
                $this->session->set_flashdata("error", "Invalid Email Code. Please check!");
                redirect(base_url(uri_string()));
            }
            
        }
        
        $this->show->main('register_email');
    }
}
