<?php
class Withdrawal_principal extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->admin_url=$this->conn->company_info('admin_path');
      //  $this->load->library('excel');
        $this->limit=10;
    }

    public function index(){

        $this->pending();
        
    }
    public function pending(){
           if(isset($_REQUEST['export_to_excel'])){
          
         $whr="tx_type='principal_withdrawal' and status='0'";
           $get_data=$this->conn->runQuery('u_code,bank_details,tx_charge,remark,amount,principal_amount,added_on','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Principal Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                $dta['Tx Charge']=$get_data[$f]->tx_charge;
                $dta['PAYABLE AMOUNT']=$get_data[$f]->amount;
                $dta['Account Holder Name']=$bank_details->account_holder_name;
                $dta['Account Number']=$bank_details->account_number;
                 $dta['Ifsc']=$bank_details->bank_ifsc;
                $dta['Date']= $get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        
        $searchdata['search_string']='withdrawal_search';
        $conditions['tx_type']='principal_withdrawal';
        $conditions['status']=0;      
        // $searchdata['order_by']='date desc';
        $searchdata['from_table']='transaction';        
        
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/withdrawal/pending'); 
         
            
        $this->show->admin_panel('withdrawal_principle/withdrawal_principal_pending',$data);
        
       
       
    }
    
     public function approved(){

       $searchdata['search_string']='withdrawal_approved_search';
        $conditions['tx_type']='principal_withdrawal';
        $conditions['status']=1;      
        $searchdata['order_by']='date desc'; 
        $searchdata['from_table']='transaction';
       // $data['base_url']=$this->panel_url.'/withdrawal/approved';
          
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
        
         $searchdata['order_by']='updated_on desc';
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/withdrawal/approved'); 
         
            
        $this->show->admin_panel('withdrawal_principle/withdrawal_principal_approved',$data);
          if(isset($_REQUEST['export_to_excel'])){
          
         $whr="tx_type='principal_withdrawal' and status='1'";
           $get_data=$this->conn->runQuery('u_code,bank_details,tx_charge,remark,amount,principal_amount,added_on','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Principal Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                $dta['Tx Charge']=$get_data[$f]->tx_charge;
                $dta['PAYABLE AMOUNT']=$get_data[$f]->amount;
                $dta['ACCOUNT DETAILS']=$bank_details->google_pay_id;
                $dta['Date']= $get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        
    }
    
    
    public function cancelled(){
          
         $searchdata['search_string']='withdrawal_cancel_search';
         $conditions['tx_type']='principal_withdrawal';
         $conditions['status']=2;      
         $searchdata['order_by']='date desc';
        $searchdata['from_table']='transaction';
       // $data['base_url']=$this->panel_url.'/withdrawal/approved';  
       
          
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
        
       
         $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/withdrawal/cancelled'); 
         
            
        $this->show->admin_panel('withdrawal_principle/withdrawal_principal_cancelled',$data);
        
         if(isset($_REQUEST['export_to_excel'])){
          
         $whr="tx_type='principal_withdrawal' and status='2'";
           $get_data=$this->conn->runQuery('u_code,bank_details,tx_charge,remark,amount,principal_amount,added_on','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Principal Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                $dta['Tx Charge']=$get_data[$f]->tx_charge;
                $dta['PAYABLE AMOUNT']=$get_data[$f]->amount;
                $dta['ACCOUNT DETAILS']=$bank_details->google_pay_id;
                $dta['Date']= $get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        
        
        
    }
    
    public function view(){
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_principal_withdrawal_id',$_REQUEST['id']);
        }
        $wd_id=$this->session->userdata('admin_principal_withdrawal_id');

        if(isset($_POST['approve_btn'])){
            $this->approve($wd_id);
            $this->session->set_flashdata("success", "Principal Withdrawal Approved.");
            redirect(base_url($this->conn->company_info('admin_path').'/withdrawal_principal/approved'));
        }

        if(isset($_POST['cancel_btn'])){
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                 $chk_exists=$this->conn->runQuery('*','transaction',"status=0 and id='$wd_id'");
                if($chk_exists){
                    $u_code=$chk_exists[0]->u_code;
                    $order_id=$chk_exists[0]->order_id;           
					
                  
					/*$this->db->set('principal_status',1);
					//$this->db->set('principal_date',date('Y-m-d H:i:s'));
                    $this->db->where('id',$order_id);
                    $this->db->update('orders');
					
					$this->db->set('principal_status',1);
                    $this->db->where('id',$u_code);
                    $this->db->update('users');
                  */
                    $amnt=$chk_exists[0]->amount;
                    $tx_charge=$chk_exists[0]->tx_charge;
                    $ttl_amnt=$amnt+$tx_charge;
                    $wallet_type=$chk_exists[0]->wallet_type;  
                    
                    $set['status']=2;
                    $set['reason']=$_POST['reason'];
                    $set['added_on']=date('Y-m-d H:i:s');
                    $this->db->where('id',$wd_id);
                    if($this->db->update('transaction',$set)){
                        
                       
                     
                       $this->update_ob->add_amnt($u_code,$wallet_type,$ttl_amnt); 
                       //$this->update_ob->add_amnt($u_code,'total_withdrawal',-$ttl_amnt); 
                       
                    }
                }
                
                redirect(base_url($this->conn->company_info('admin_path').'/withdrawal_principal/cancelled'));
            }
        }

        $data['wd_id']=$wd_id;
        $this->show->admin_panel('withdrawal_principle/withdrawal_principal_view',$data);
        
    }
	
	public function action_multiple(){
        if(isset($_POST['withdrawal_btn'])){
            
            if(isset($_POST['wd_ids'])){
               // print_r($_POST['wd_ids']);
                $wd_id=$_POST['wd_ids'];
                $set['status']=1;
                $set['added_on']=date('Y-m-d H:i:s');
                $this->db->where_in('id',$wd_id);
                $this->db->update('transaction',$set);
                
                /*$implode=implode(',',$wd_id);
                foreach($wd_id as $wd_id1){
                
                //$chk_exists=$this->conn->runQuery('amount,tx_charge,wallet_type,u_code','transaction',"id IN($implode)");
                $chk_exists=$this->conn->runQuery('amount,tx_charge,wallet_type,u_code','transaction',"id='$wd_id1'");
            
                echo $this->db->last_query();
                }
                die();*/
                $this->session->set_flashdata("success", "Principal Withdrawal Approved.");
                redirect($this->admin_url.'/withdrawal_principal/approved');
            }else{
                $this->session->set_flashdata("error", "Invalid Request. Please Select User1");
                redirect($this->admin_url.'/withdrawal_principal/pending'); 
            }
        }

        if(isset($_POST['reject_btn'])){
            
            if(isset($_POST['wd_ids'])){
                if(isset($_POST['reject_reason']) && $_POST['reject_reason']!=''){
                    $wd_id=$_POST['wd_ids'];
                    if(!empty($wd_id)){
                        foreach($wd_id as $wdid){
                            $chk_exists=$this->conn->runQuery('*','transaction',"status=0 and id='$wdid'");
                            if($chk_exists){
                                $u_code=$chk_exists[0]->u_code;
                                $order_id=$chk_exists[0]->u_code;
                                $amnt=$chk_exists[0]->amount;
                                $tx_charge=$chk_exists[0]->tx_charge;
                                $ttl_amnt=$amnt+$tx_charge;
                                $wallet_type=$chk_exists[0]->wallet_type;                              
                              
                              
                                $u_code=$chk_exists[0]->u_code;
                                $order_id=$chk_exists[0]->order_id;           


                               /* $this->db->set('principal_status',1);
                                //$this->db->set('principal_date',date('Y-m-d H:i:s'));
                                $this->db->where('id',$order_id);
                                $this->db->update('orders');
                                
                                
                              
                                  $this->db->set('principal_status',1);
                                  $this->db->where('id',$u_code);
                                  $this->db->update('users');*/
                               
                              
                                $set=array();
                                $set['status']=2;
                                $set['reason']=$_POST['reject_reason'];
                                $set['added_on']=date('Y-m-d H:i:s');
                                $this->db->where('id',$wdid);
                                if($this->db->update('transaction',$set)){
                                   $this->update_ob->add_amnt($u_code,$wallet_type,$ttl_amnt); 
                                   //$this->update_ob->add_amnt($u_code,'total_withdrawal',-$ttl_amnt); 
                                   
                                }
                            }
                        }
                    }
                    $this->session->set_flashdata("success", "Principal Withdrawal Rejected.");
                    redirect($this->admin_url.'/withdrawal_principal/cancelled');
                }else{
                    $this->session->set_flashdata("error", "Invalid Request. Please Give Reject reason.");
                    redirect($this->admin_url.'/withdrawal_principal/pending'); 
                }
            }else{
                $this->session->set_flashdata("error", "Invalid Request. Please Select User");
                redirect($this->admin_url.'/withdrawal_principal/pending'); 
            }
        }
    }
    public function approve($wd_id){
        $chk_exists=$this->conn->runQuery('id','transaction',"status=0 and id='$wd_id'");
        if($chk_exists){
            $set['status']=1;
            $set['added_on']=date('Y-m-d H:i:s');
            $this->db->where('id',$wd_id);
            $this->db->update('transaction',$set);
        }
    }

 
    
     
    
}