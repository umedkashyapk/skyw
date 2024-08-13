<?php
class API extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->currency=$this->conn->company_info('currency');
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }


    public function api(){ 
        $this->show->admin_panel('api');
    }
   
    
}