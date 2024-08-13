<?php
class Meta extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->currency=$this->conn->company_info('currency');
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

    public function index(){ 
        $this->pending();
    }



 
      public function pending(){
      
        
        $conditions['type']='admin';
        $conditions['status']=0;
        $searchdata['from_table']='meta_request';
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/meta/pending');
        $this->show->admin_panel('meta/meta_request_pending',$data); 
    }
    
    
    public function approved(){
      
        
        $conditions['type']='admin';
        $conditions['status']=1;
        $searchdata['from_table']='meta_request';
     
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/meta/approved');
        $this->show->admin_panel('meta/meta_request_approved',$data); 
    }
    
    
    public function cancelled(){
      
        
        $conditions['type']='admin';
        $conditions['status']=2;
        $searchdata['from_table']='meta_request';
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/meta/cancelled');
        $this->show->admin_panel('meta/meta_request_cancelled',$data); 
    }
    
    public function view(){
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_request_id',$_REQUEST['id']);
        }
        $rq_id=$this->session->userdata('admin_request_id');

        if(isset($_POST['approve_btn'])){
          $username=$_POST['username']; 
          $pass=$_POST['password']; 
        $chk_exists=$this->conn->runQuery('*','meta_request',"status=0 and id='$rq_id'");
        if($chk_exists){
            $u_code=$chk_exists[0]->u_code;
            $amount=$chk_exists[0]->amount;
            $profile=$this->profile->profile_info($u_code);
            $msg2="Meta Request Approved";
            $set['status']=1;
            $this->db->where('id',$rq_id);
           
            if($this->db->update('meta_request',$set)){
                
               //$this->update_ob->add_amnt($u_code,$wallet_type,$amount); 
               
            $this->message->send_mail_admin_new($profile->email,'MT5',$msg2,$username,$pass);
            }
        }
   
           
            $this->session->set_flashdata("success", "Meta Request Approved.");
            redirect(base_url($this->conn->company_info('admin_path').'/meta/approved'));
        }

        if(isset($_POST['cancel_btn'])){
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                 $chk_exists=$this->conn->runQuery('id','meta_request',"status=0 and id='$rq_id'");
                if($chk_exists){
                    $set['status']=2;
                    $set['reason']=$_POST['reason'];
                    $this->db->where('id',$rq_id);
                   $this->db->update('meta_request',$set);                     
                       
                  
                }
                 $this->session->set_flashdata("success", "Meta Request Reject.");
                redirect(base_url($this->conn->company_info('admin_path').'/meta/cancelled'));
            }
        }

        $data['rq_id']=$rq_id;
        $this->show->admin_panel('meta/meta_request_view',$data);
        
    }
    
  
}