<?php
class Notification extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function index(){
        $details['res'] ='fail!';
        
        $all_notifications_list = $this->conn->runQuery('*','notifications_list',"type ='all_users'");
        if($all_notifications_list){
            $details['res']='success';
          
            $details['data']=$all_notifications_list;
        }else{
              $details['res']='error';
            $details['message']='somthing went wrong!';
        } 
        
        print_r(json_encode($details));
        
        
    }
}