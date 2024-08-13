<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Blog extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function index(){
        $details['res'] ='fail!';
        
        $all_blog = $this->conn->runQuery('*','ad_blogs',"status ='1'");
        if($all_blog){
            $details['res']='success';
          
            $details['data']=$all_blog;
        }else{
              $details['res']='error';
            $details['message']='somthing went wrong!';
        } 
        
        print_r(json_encode($details));
        
        
    }
}