<?php
class About extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){  
        $this->show->main('about',array());
    }
    public function any($aaa){  
        echo $aaa;//$this->show->main('about',array());
    }
    
     
    
    
}