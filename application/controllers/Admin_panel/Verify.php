<?php
class Verify extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){  

   
            $data['panel']=$panel=$this->conn->company_info('admin_panel');
            $data['admin_directory']=$admin_directory=$this->conn->company_info('admin_directory');
            $data['panel_url']=base_url().$admin_directory.'/'.$panel.'/';
            
            $this->load->view($admin_directory.'/pages/verify',$data);

        
    }
}