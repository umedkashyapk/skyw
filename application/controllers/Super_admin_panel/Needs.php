<?php
class Needs extends CI_Controller{
    
     public function __construct()
    {
        parent::__construct();
        $this->limit=10;
        $this->super_admin_url=$this->conn->company_info('super_admin_path');
    }

    public function index(){
        
        
        if(isset($_GET['accept'])){
            $accept_id=$_GET['accept'];
            
            $this->db->set('status','1');
            $this->db->where('id',$accept_id);
            $this->db->update('needs');
            $this->session->set_flashdata('success',"Need Accepted.");
            $al_dertails=$this->conn->runQuery('*','needs',"id='$accept_id'");
            
            $name=$al_dertails[0]->name;
            $mobile=$al_dertails[0]->mobile;
            $sms="Hello $name Ji, 
            Sukhbir Singh is here from Eracom Technologies Private limited.
            I saw you visited our website www.mlmreadymade.com, are you looking for any MLM software or website, please let me know so that I can help you";
            $msg = urlencode($sms);
            redirect("https://wa.me/91".$mobile."?text=".$msg);
            
            }
        
        $searchdata['from_table']='needs';
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
      /*  if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }*/
         if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!=''){
            $likeconditions['mobile']=$_REQUEST['mobile'];
        }
         if(isset($_REQUEST['email']) && $_REQUEST['email']!=''){
            $likeconditions['email']=$_REQUEST['email'];
        }
        
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
            $conditions['status'] = $_REQUEST['status'];
        }
          if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        } 
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->super_admin_url.'/needs');
       
       $this->show->super_admin_panel('needs/list',$data);
        
         
    }
    
    
    public function contact(){
         
       $searchdata['from_table']='contact_us';
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
      /*  if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }*/
         if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!=''){
            $likeconditions['mobile']=$_REQUEST['mobile'];
        }
         if(isset($_REQUEST['email']) && $_REQUEST['email']!=''){
            $likeconditions['email']=$_REQUEST['email'];
        }
        
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
            $conditions['status'] = $_REQUEST['status'];
        }
          if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        } 
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->super_admin_url.'/needs/contact');
        $this->show->super_admin_panel('contact_detail',$data);
    } 
    
}