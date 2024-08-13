<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class News extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    
    public function index(){
        $details['res'] ='error';
        
        $all_blog = $this->conn->runQuery('*','crypto_news',"id=1");
        if($all_blog){
            $details['res']='success';
          
            $details['data']=json_decode($all_blog[0]->news,true);
        }else{
            $details['res']='error';
            $details['message']='somthing went wrong!';
        } 
        
        print_r(json_encode($details));
        
        
    }
    
     
}