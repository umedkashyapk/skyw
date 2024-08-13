<?php
class Kyc extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

    public function index(){

        $this->pending();
        
    }

    public function pending(){
      
        
      //  $searchdata['where']="(kyc_status='submitted')";
        $searchdata['from_table']='user_accounts';
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/kyc/pending');
        $this->show->admin_panel('kyc_pending',$data); 
    }
    
    public function approved(){
        
        
        $searchdata['where']="(kyc_status='approved')";
        $searchdata['from_table']='user_accounts';
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/kyc/approved');
        $this->show->admin_panel('kyc_approved',$data); 
    }
    
    public function cancelled(){
      
        
        $searchdata['where']="(kyc_status='rejected')";
        $searchdata['from_table']='user_accounts';
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/kyc/cancelled');
        $this->show->admin_panel('kyc_cancelled',$data); 
        
    }
  
   
     public function view(){
        $kyc_type=$_REQUEST['type'];
        
      
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_kyc_id',$_REQUEST['id']);
        }
        $wd_id=$this->session->userdata('admin_kyc_id');

        if(isset($_POST['approve_btn'])){
             $kyc_type=$_REQUEST['type'];
            
        if($kyc_type=="bank"){
            $tx_type1="kyc_status_bank";
        }elseif($kyc_type=="pan"){
             $tx_type1="kyc_status_pan";
        }elseif($kyc_type=="identity"){
             $tx_type1="kyc_status_identity";
        }elseif($kyc_type=="nominee"){
             $tx_type1="kyc_status_nominee";
            
        }elseif($kyc_type=="personal"){
             $tx_type1="kyc_status_personal";
            
        }
        $chk_exists=$this->conn->runQuery('id','user_accounts',"id='$wd_id' and $tx_type1='submitted'");
        if($chk_exists){
            /*if($kyc_type=="bank"){
               $set['bank_name']=$_POST['bank_name'];
               $set['account_holder_name']=$_POST['account_holder_name'];
               $set['account_no']=$_POST['account_no'];
               $set['ifsc_code']=$_POST['ifsc_code'];
               $set['bank_branch']=$_POST['bank_branch'];
            }
            if($kyc_type=="pan"){
               $set['pan_no']=$_POST['pan_no'];
               
            }*/
            $set['added_on']=date('Y-m-d H:i:s');
            $set[$tx_type1]='approved';
            $this->db->where('id',$wd_id);
            $this->db->update('user_accounts',$set);
        }
            
        $this->session->set_flashdata("success", "Kyc Approved.");
        redirect($this->admin_url.'/kyc/pending'); 
        }

        if(isset($_POST['cancel_btn'])){
            
            $type=$_POST['tx_type'];
            $kyc_type=$_REQUEST['type']; 
            
            if($kyc_type=="bank"){
                
                $tx_type1="kyc_status_bank";
                $reject_reason="bank_remark";
                
            }elseif($kyc_type=="pan"){
                
                 $tx_type1="kyc_status_pan";
                 $reject_reason="pan_remark";
                  
            }elseif($kyc_type=="identity"){
                 
                 $tx_type1="kyc_status_identity";
                 $reject_reason="kyc_remark";
                 
            }elseif($kyc_type=="nominee"){
                
                $tx_type1="kyc_status_nominee";
                $reject_reason="nominee_remark";
                
            }elseif($kyc_type=="personal"){
                
                $tx_type1="kyc_status_personal";
                $reject_reason="personal_remark";
                
            }
            
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                
                
                $set[$tx_type1]="rejected";
                $set[$reject_reason]=$_POST['reason'];
                $set['added_on']=date('Y-m-d H:i:s');
                $this->db->where('id',$wd_id);
                $this->db->update('user_accounts',$set);
               
                 $this->session->set_flashdata("error", "Kyc Rejected.");
                redirect(base_url($this->conn->company_info('admin_path').'/kyc/pending'));
            }
        }

        $data['wd_id']=$wd_id;
        $data['kyc_type']=$kyc_type;
        $this->show->admin_panel('kyc_view',$data);
        
    }

    

    public function view_all(){
         $kyc_type=$_REQUEST['type'];
        
      
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_new_kyc_id',$_REQUEST['id']);
        }
        $wd_id=$this->session->userdata('admin_new_kyc_id');

        if(isset($_POST['approve_btn'])){
             $kyc_type=$_REQUEST['type'];
            
        if($kyc_type=="bank"){
            $tx_type1="kyc_status_bank";
        }elseif($kyc_type=="pan"){
             $tx_type1="kyc_status_pan";
        }elseif($kyc_type=="identity"){
             $tx_type1="kyc_status_identity";
        }elseif($kyc_type=="nominee"){
             $tx_type1="kyc_status_nominee";
            
        }elseif($kyc_type=="personal"){
             $tx_type1="kyc_status_personal";
            
        }
        $chk_exists=$this->conn->runQuery('id','user_accounts',"id='$wd_id' and $tx_type1='submitted'");
        if($chk_exists){
            
            $set['added_on']=date('Y-m-d H:i:s');
            $set[$tx_type1]='approved';
            $this->db->where('id',$wd_id);
            $this->db->update('user_accounts',$set);
        }
            
        $this->session->set_flashdata("success", "Kyc Approved.");
        redirect($this->admin_url.'/kyc/pending'); 
        }

        if(isset($_POST['cancel_btn'])){
            
            $type=$_POST['tx_type'];
            $kyc_type=$_REQUEST['type']; 
            
            if($kyc_type=="bank"){
                
                $tx_type1="kyc_status_bank";
                $reject_reason="bank_remark";
                
            }elseif($kyc_type=="pan"){
                
                 $tx_type1="kyc_status_pan";
                 $reject_reason="pan_remark";
                  
            }elseif($kyc_type=="identity"){
                 
                 $tx_type1="kyc_status_identity";
                 $reject_reason="kyc_remark";
                 
            }elseif($kyc_type=="nominee"){
                
                $tx_type1="kyc_status_nominee";
                $reject_reason="nominee_remark";
                
            }elseif($kyc_type=="personal"){
                
                $tx_type1="kyc_status_personal";
                $reject_reason="personal_remark";
                
            }
            
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                
                
                $set[$tx_type1]="rejected";
                $set[$reject_reason]=$_POST['reason'];
                $set['added_on']=date('Y-m-d H:i:s');
                $this->db->where('id',$wd_id);
                $this->db->update('user_accounts',$set);
               
                 $this->session->set_flashdata("error", "Kyc Rejected.");
                redirect(base_url($this->conn->company_info('admin_path').'/kyc/pending'));
            }
        }

        $data['wd_id']=$wd_id;
        $data['kyc_type']=$kyc_type;
        $this->show->admin_panel('kyc_view_all',$data);
        
    }













	
	public function action_multiple(){
        if(isset($_POST['withdrawal_btn'])){
            
            if(isset($_POST['wd_ids'])){
               // print_r($_POST['wd_ids']);
                $wd_id=$_POST['wd_ids'];
                $set['status']=1;
                $this->db->where_in('id',$wd_id);
                $this->db->update('transaction',$set);
                $this->session->set_flashdata("success", "Withdrawal Approved.");
                redirect($this->admin_url.'/withdrawal/approved');
            }else{
                $this->session->set_flashdata("error", "Invalid Request. Please Select User1");
                redirect($this->admin_url.'/withdrawal/pending'); 
            }
        }

        if(isset($_POST['reject_btn'])){
            
            if(isset($_POST['wd_ids'])){
                if(isset($_POST['reject_reason']) && $_POST['reject_reason']!=''){
                    $wd_id=$_POST['wd_ids'];
                    $set['status']=2;
                    $set['reason']=$_POST['reject_reason'];
                    $this->db->where_in('id',$wd_id);
                    $this->db->update('transaction',$set);
                    $this->session->set_flashdata("success", "Withdrawal Rejected.");
                    redirect($this->admin_url.'/withdrawal/cancelled');
                }else{
                    $this->session->set_flashdata("error", "Invalid Request. Please Give Reject reason.");
                    redirect($this->admin_url.'/withdrawal/pending'); 
                }
            }else{
                $this->session->set_flashdata("error", "Invalid Request. Please Select User");
                redirect($this->admin_url.'/withdrawal/pending'); 
            }
        }
    }
    public function approve($wd_id,$type){
        if($type=="bank"){
            $tx_type="kyc_status";
        }
        $chk_exists=$this->conn->runQuery('id','user_accounts',"id='$wd_id' and $tx_type='submitted'");
        if($chk_exists){
            if($tx_type=="bank"){
               $set['bank_name']='approved';
               $set['account_holder_name']='approved';
               $set['account_no']='approved';
               $set['ifsc_code']='approved';
               $set['bank_branch']='approved';
            }
            
            $set[$tx_type]='approved';
            $this->db->where('id',$wd_id);
            $this->db->update('user_accounts',$set);
        }
    }


public function approve_rejected(){
                $kyc_id=$_POST['cancel_id'];
                  
         if(isset($_POST['app_cancel_btn'])){
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                    $set['status']=2;
                    $set['reason']=$_POST['reason'];
                    $set['added_on']=date('Y-m-d H:i:s');
                    $this->db->where('id',$kyc_id);
                    $this->db->update('transaction',$set);
                    $this->session->set_flashdata("success", "Kyc Rejected.");
                    redirect($this->admin_url.'/kyc/cancelled');
           
            }
        }

        
    }
}