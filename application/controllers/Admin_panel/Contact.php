<?php
class Contact extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

   
    
    
   
     public function index(){
       // $searchdata['search_string']='fund_transfer_history_search';
      
      $searchdata['from_table']='contact_us';        
        
      
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/contact'); 
         
            
        $this->show->admin_panel('contact_detail',$data);
              
    }
    
  
    
   
    
    
}