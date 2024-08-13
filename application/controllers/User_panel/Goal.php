<?php
class Goal extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

       
        $this->panel_url=$this->conn->company_info('panel_path');
        $this->limit=10;
    }

    public function index(){ 
        $this->show->user_panel('goal');
    }
    
    public function royalty(){ 
        $this->show->user_panel('goal_royalty');
    }
    
    
    
}