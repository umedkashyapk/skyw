<?php
class Login_detail extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->currency=$this->conn->company_info('currency');
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

    public function index(){ 
        $searchdata['from_table']='login_details';
       
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
           $spo=$this->profile->column_like($_REQUEST['name'],'name');     
                
            if($spo){
                $conditions['u_code'] = $spo;
            }
        }
       if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
          
          
            $spo=$this->profile->column_like($_REQUEST['username'],'username');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
           
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'login_detail');
       
        $this->show->admin_panel('login_detail',$data); 
    }

}