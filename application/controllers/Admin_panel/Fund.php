<?php
class Fund extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->currency=$this->conn->company_info('currency');
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

    public function index(){ 
        $this->fund_transfer();
    }



 public function api(){ 
        $this->show->admin_panel('api');
    }
    public function fund_transfer(){

        if(isset($_POST['transfer_btn'])){
            $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable');
            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username');

            $min_transfer_limit=$this->conn->setting('min_transfer_limit');
            if($min_transfer_limit){
                $tr_validation='|callback_min_transfer_limit';
            }else{
                $tr_validation='';
            }

            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]'.$tr_validation);
            if($this->form_validation->run() != False){
                $crncy=$this->conn->company_info('currency');

                $tx_username=$_POST['tx_username'];
                $wallet_type=$_POST['selected_wallet'];
                $transfer='admin_credit';
                $tx_u_code=$this->profile->id_by_username($tx_username);
                 
                $amnt=abs($_POST['amount']);
                $date=date('Y-m-d H:i:s');

                $tx_u_code_open_wallet=$this->wallet->balance($tx_u_code,$wallet_type);
                $tx_u_code_closing_wallet=$tx_u_code_open_wallet+$amnt;

                
                $tx_u_code_remark="$tx_username recieve $crncy $amnt from admin";

                $inserttrans = array(
                   
                    array(
                        'wallet_type'  => $wallet_type,
                        'tx_type'  => $transfer,
                        'debit_credit'  => 'credit',                        
                        'u_code'  => $tx_u_code,
                        'amount'  => $amnt,
                        'date'  => $date,
                        'status'  => 1,
                        'open_wallet'  => $tx_u_code_open_wallet,
                        'closing_wallet'  => $tx_u_code_closing_wallet,
                        'remark'  => $tx_u_code_remark,
                    )
                    
                );

                if($this->db->insert_batch('transaction',$inserttrans)){ 
                    
                    $this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                    
                    $smsg=" Transaction Successful. You transfer $crncy $amnt to $tx_username";
                    $this->session->set_flashdata("success", $smsg);
                    redirect(base_url(uri_string()));

                }else{
                    $this->session->set_flashdata("error", "Something wrong.");
                }
            } 
        }


        $this->show->admin_panel('fund_transfer');
    }

    public function valid_username($str){
        $check_username=$this->conn->runQuery("id",'users',"username='$str'");
        if($check_username){
            return true;
        }else{
              $this->form_validation->set_message('valid_username', "Invalid Username! Please check username.");
               return false;
        }
    }

    

   
     
    
    public function min_transfer_limit($str){
        $min_transfer_limit=$this->conn->setting('min_transfer_limit');
       
        if(is_numeric($str) && $str>=$min_transfer_limit){
            return true;
        }else{
            $curr=$this->conn->company_info('currency');
              $this->form_validation->set_message('min_transfer_limit', "Amount should be minimum $curr $min_transfer_limit");
               return false;
        }
    }

    public function send_otp(){ 
        $ret['error']=true;
        
        if(isset($_POST['tx_username'])){
            $username=$_POST['tx_username'];
            if(isset($_POST['amount'])){
                $amount=$_POST['amount'];
                $check_username=$this->conn->runQuery('id,name','users',"username='$username'");
                if($check_username){
                    $otp=random_string('numeric', 6);
                    $this->session->set_tempdata('admin_otp', $otp, 300);
                    $company_name=$this->conn->company_info('title');
                    $name=$check_username[0]->name;
                    $msg="$otp is your OTP for send $amount to $name. Team $company_name";
                    $mobile=7827540939;
                   
                    $this->message->sms($mobile,$msg);
                    $ret['error']=false;
                    $ret['msg']="Success!. OTP has been sent to admin mobile number.";
                }else{
                    $ret['msg']="Invalid Username. Please check username.";
                }
            }else{
                $ret['msg']="Enter Amount.";
            }
            
        }else{
            $ret['msg']="Enter Username.";
        }
        
        return print_r(json_encode($ret));
    }
    
      public function pending(){
      
        
        $conditions['tx_type']='fund_request';
        $conditions['status']=0;
        $searchdata['from_table']='transaction';
       // $data['base_url']=$this->panel_url.'/fund/pending'; 
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/pending');
        $this->show->admin_panel('fund_request_pending',$data); 
    }
    
    
    public function approved(){
      
        
       $conditions['tx_type']='fund_request';
        $conditions['status']=1;
        $searchdata['from_table']='transaction';
       // $data['base_url']=$this->panel_url.'/fund/pending'; 
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/approved');
        $this->show->admin_panel('fund_request_approved',$data); 
    }
    
    
    public function cancelled(){
      
        
       $conditions['tx_type']='fund_request';
        $conditions['status']=2;
        $searchdata['from_table']='transaction';
       // $data['base_url']=$this->panel_url.'/fund/pending'; 
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/cancelled');
        $this->show->admin_panel('fund_request_cancelled',$data); 
    }
    
    public function view(){
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_request_id',$_REQUEST['id']);
        }
        $rq_id=$this->session->userdata('admin_request_id');

        if(isset($_POST['approve_btn'])){
           
        $chk_exists=$this->conn->runQuery('id,u_code,amount,wallet_type','transaction',"status=0 and id='$rq_id'");


        if($chk_exists){
            $u_code=$chk_exists[0]->u_code;
            $amount=$chk_exists[0]->amount;
            $wallet_type=$chk_exists[0]->wallet_type;
            $profile=$this->profile->profile_info($u_code);
            $set['status']=1;
            $this->db->where('id',$rq_id);
           
             if($this->db->update('transaction',$set)){
                $this->update_ob->add_amnt($u_code,$wallet_type,$amount); 
                 
                 $company_name=$this->conn->company_info('title');
                 $company_url=$this->conn->company_info('base_url');
                 $sms="Fund request Approved Successfully!. Thanks $company_name team. For more visit $company_url,";
                // $this->message->send_mail_reg($profile->email,'Fund Request Approved',$sms,$profile->username);
     
                       
                    }
        }
   
           
            $this->session->set_flashdata("success", "Fund Request Approved.");
            redirect(base_url($this->conn->company_info('admin_path').'/fund/approved'));
        }

        if(isset($_POST['cancel_btn'])){
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                 $chk_exists=$this->conn->runQuery('id,u_code','transaction',"status=0 and id='$rq_id'");
                if($chk_exists){
                    $u_code=$chk_exists[0]->u_code; 
                    $profile=$this->profile->profile_info($u_code);  
                    $set['status']=2;
                    $set['reason']=$_POST['reason'];
                    $this->db->where('id',$rq_id);
                   $this->db->update('transaction',$set);  
                   
                 $company_name=$this->conn->company_info('title');
                 $company_url=$this->conn->company_info('base_url');
                 $sms="Fund request Rejected Successfully!. Thanks $company_name team. For more visit $company_url,";
                 $this->message->send_mail_reg($profile->email,'Fund Request Rejected',$sms,$profile->username);
        
                  
                }
                 $this->session->set_flashdata("success", "Fund Request Reject.");
                redirect(base_url($this->conn->company_info('admin_path').'/fund/cancelled'));
            }
        }

        $data['rq_id']=$rq_id;
        $this->show->admin_panel('fund_request_view',$data);
        
    }
    
    public function fund_retrieve(){
        if(isset($_POST['retrieve_btn'])){
            $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable_retrive');
            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username');

            $min_transfer_limit=$this->conn->setting('min_transfer_limit');
            if($min_transfer_limit){
                $tr_validation='|callback_min_transfer_limit';
            }else{
                $tr_validation='';
            }

            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]'.$tr_validation);
            if($this->form_validation->run() != False){
                $crncy=$this->conn->company_info('currency');
                $tx_username=$_POST['tx_username'];
                $wallet_type=$_POST['selected_wallet'];
                $transfer='admin_debit';
                $tx_u_code=$this->profile->id_by_username($tx_username);
                $amnt=abs($_POST['amount']);
                $remark=$_POST['remark'];
                $date=date('Y-m-d H:i:s');
                $tx_u_code_open_wallet=$this->update_ob->wallet($tx_u_code,$wallet_type);
                //if($amnt<=$tx_u_code_open_wallet ){
                   $tx_u_code_closing_wallet=$tx_u_code_open_wallet-$amnt;
                $tx_u_code_remark="Admin retrieve $crncy $amnt from $tx_username";

                $inserttrans = array(
                    array(
                        'wallet_type'  => $wallet_type,
                        'tx_type'  => $transfer,
                        'debit_credit'  => 'debit',                        
                        'u_code'  => $tx_u_code,
                        'amount'  => $amnt,
                        'date'  => $date,
                        'status'  => 1,
                        'open_wallet'  => $tx_u_code_open_wallet,
                        'closing_wallet'  => $tx_u_code_closing_wallet,
                        'remark'  => $remark,
                    )
                );

                if($this->db->insert_batch('transaction',$inserttrans)){ 
                    $this->wallet->balance($tx_u_code,$wallet_type);
                    $this->update_ob->add_amnt($tx_u_code,$wallet_type,-$amnt);
                    $smsg=" Transaction Successful. You retrieve $crncy $amnt to $tx_username";
                    $this->session->set_flashdata("success", $smsg);
                    redirect(base_url(uri_string()));

                }else{
                    $this->session->set_flashdata("error", "Something wrong.");
                } 
                    
                /*}else{
                    $this->session->set_flashdata("error", "Insufficant Fund.");
                }*/
                
            } 
        }


        $this->show->admin_panel('fund_retrieve');
    }
    
    
     public function check_wallet_useable($str){
        $available_wallets=$this->conn->setting('transfer_wallets');
        
        $useable_wallet=json_decode($available_wallets);
       /* print_r($useable_wallet);
        die();*/
        if(array_key_exists($str,$useable_wallet)){
            return true;
        }else{
              $this->form_validation->set_message('check_wallet_useable', "You can not transfer fund from this wallet");
               return false;
        }
    }
    
    
    public function check_wallet_useable_retrive($str){
        $available_wallets=$this->conn->setting('retrive_wallets');
        
        $useable_wallet=json_decode($available_wallets);
       /* print_r($useable_wallet);
        die();*/
        if(array_key_exists($str,$useable_wallet)){
            return true;
        }else{
              $this->form_validation->set_message('check_wallet_useable_retrive', "You can not transfer fund from this wallet");
               return false;
        }
    }

     public function fund_retrieve_history(){
        $searchdata['search_string']='fund_retrieve_history_search';
        $conditions['tx_type']='admin_debit';
        $conditions['status']=1;      
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
         
          if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/fund_retrieve_history'); 
         
            
        $this->show->admin_panel('fund_retrieve_history',$data);
              
    }
    
    
    public function fund_transfer_history(){
         if(isset($_REQUEST['export_to_excel'])){
             
           $whr="tx_type='admin_credit'";
           $get_data=$this->conn->runQuery('*','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['User id']=$tx_profile->username;
                $dta['Full Name']=$tx_profile->name;
                $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                $dta['Wallet type']=$get_data[$f]->wallet_type;
                $dta['Date']= $get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        $searchdata['search_string']='fund_transfer_history_search';
        $conditions['tx_type']='admin_credit';
        $conditions['status']=1;      
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
         
          if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/fund_transfer_history'); 
         
            
        $this->show->admin_panel('fund_transfer_history',$data);
              
    }
    
     public function carry(){
          if(isset($_POST['carry_btn'])){
            $this->form_validation->set_rules('selected_Position', 'Position', 'required');
            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username');
            $this->form_validation->set_rules('carry', 'Carry','required');
           if($this->form_validation->run() != False){
               $tx_username=$_POST['tx_username'];
                $tx_u_code=$this->profile->id_by_username($tx_username);
                $inserttrans['Position']=$_POST['selected_Position'];
                $inserttrans['u_code']=$tx_u_code;
                $inserttrans['carry']=$_POST['carry'];
                $inserttrans['status']=1;
                if($this->db->insert('dummy_carry',$inserttrans)){
                    $this->update_ob->update_binary($tx_u_code);
                    $smsg=" Carry Successful. You transfer";
                    $this->session->set_flashdata("success", $smsg);
                    redirect(base_url(uri_string()));

                }else{
                    $this->session->set_flashdata("error", "Something wrong.");
                }
            } 
        }
        $this->show->admin_panel('carry');
    } 
    
    
    public function carry_detail(){
        
        if(isset($_REQUEST['export_to_excel'])){
             
           $whr="status='1'";
           $get_data=$this->conn->runQuery('*','dummy_carry', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
                if($get_data[$f]->Position==2){
                    $pos='Right';
                }else{
                    $pos='Left';
                }
                $dta['User id']=$tx_profile->username;
                $dta['Full Name']=$tx_profile->name;
                $dta['Amount']=$get_data[$f]->amount;
                $dta['Carry']=$get_data[$f]->carry;
                $dta['Position']=$pos;
                
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        
        
        $conditions['status']=1;
        $searchdata['from_table']='dummy_carry';
       // $data['base_url']=$this->panel_url.'/fund/pending'; 
       
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/carry_detail');
        $this->show->admin_panel('fund_carry_detail',$data); 
    }
    
    
     public function fund_convert_history(){
        $searchdata['search_string']='fund_transfer_history_search';
        $conditions['tx_type']=['convert_send','convert_recieve'];
        //$conditions['status']=1;      
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
         
         
        if(isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']!=''){
            $conditions['debit_credit'] = $_REQUEST['tx_type'];
        }
        
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/fund_convert_history'); 
         
            
        $this->show->admin_panel('fund_convert_history',$data);
              
    }
    
    
    public function fund_add_history(){
        if(isset($_REQUEST['export_to_excel'])){
             
           $whr="tx_type='CRYPADD'";
           $get_data=$this->conn->runQuery('*','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['User id']=$tx_profile->username;
                $dta['Full Name']=$tx_profile->name;
                $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                $dta['Wallet type']=$get_data[$f]->wallet_type;
                $dta['Date']= $get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        $searchdata['search_string']='add_fund_history';
        $conditions['tx_type']='CRYPADD';
        //$conditions['status']=1;      
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
         
          if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/fund/fund_add_history'); 
         
            
        $this->show->admin_panel('fund_add_history',$data);
              
    }
    
}