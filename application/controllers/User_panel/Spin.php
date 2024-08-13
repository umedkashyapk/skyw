<?php
class Spin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

       
        $this->limit=20;
         $this->panel_url=$this->conn->company_info('panel_path');
    }
   
    public function index(){ 
        $this->show->user_panel('spin');
    }

}