<?php
class Companyprofile extends CI_Controller {
   
    public function __construct()
    {
        parent::__construct();
    }

   
    public function index(){ 
       
      $this->load->view('Main/pages/company-profile.php');
    }
    
}
