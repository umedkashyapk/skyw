<?php
class Logout extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){         
        $this->session->unset_userdata('user_id');  
        $this->session->unset_userdata('profile');  
        $this->session->unset_userdata('admin_login'); 
        $this->session->unset_userdata('tfa_verified');
       redirect(base_url($this->conn->company_info('admin_path')."/login"), "refresh");
    }
}