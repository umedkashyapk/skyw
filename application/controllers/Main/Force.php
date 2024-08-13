<?php
class Force extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

   public function index(){
       $panel=$this->conn->company_info('main_theme');
        $this->load->view('Main/Dashboard/force_system.php');
    }
    
    
    
    
}