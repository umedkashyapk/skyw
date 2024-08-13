<?php
class Pages extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
        
        $this->limit = 20;
    }
    
    public function about_us(){
        
        $about_info=$this->conn->runQuery('*','legal_data',"lega_page_type='about_us'");
        
        if($about_info){
            $content_decode = $about_info[0]->legal_desc;
            
            $content = $content_decode;

            $plainText = strip_tags($content);
            
           $result['res']='success';
           $result['data']=$about_info;
           $result['legal_desc']=$plainText;
        }else{
            $result['res']='error';
            $result['message']='Data Not Found!';
            $result['data']=array();
            
            
        }
        
        print_r(json_encode($result));
    }
       
}