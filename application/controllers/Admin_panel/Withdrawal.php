<?php
class Withdrawal extends CI_Controller{
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


    /*public function pending(){
        $data['limit']=10;
        $data['search_string']='withdrawal_search';
        $conditions['tx_type']='withdrawal';
        $conditions['status']=0;
        $data['from_table']='transaction';
        $data['base_url']=$this->panel_url.'/withdrawal/pending'; 
        
        if(!empty($conditions)){
            $data['conditions']=$conditions;
        }

        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];
        if(isset($_POST['export_to_excel'])){
            /* $dta[0]=array('Debit Ac No','Beneficiary Ac No','Beneficiary Name','Amt','Pay Mod','Date','IFSC');
            $whr="tx_type='withdrawal' and status='0'";
           $get_data=$this->conn->runQuery('bank_details,amount,date','transaction', $whr);          
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $bank_details=json_decode($get_data[$f]->bank_details); 
                $dta['Debit Ac No']=0;//$bank_details->account_no;
                $dta['Beneficiary Ac No']=$bank_details->account_no;
                $dta['Beneficiary Name']=$bank_details->account_holder_name;
                $dta['Amt']=$get_data[$f]->amount;
                $dta['Pay Mod']='N';
                $dta['Date']= $get_data[$f]->date;
                $dta['IFSC']= $bank_details->ifsc_code;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
        
        $data['sr_no']=$res['sr_no'];
        $data['total_rows']=$res['total_rows'];  

        $this->show->admin_panel('withdrawal_pending',$data);
    }
    
    public function approved(){

        $data['limit']=10;
        $data['search_string']='withdrawal_search';
        $conditions['tx_type']='withdrawal';
        $conditions['status']=1;
        

        $data['from_table']='transaction';
        $data['base_url']=$this->panel_url.'/withdrawal/approved';  
        
        
        if(!empty($conditions)){
            $data['conditions']=$conditions;
        }       


        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];      
        $data['total_rows']=$res['total_rows'];      
        $data['sr_no']=$res['sr_no'];
              
       
        $this->show->admin_panel('withdrawal_approved',$data);
    }
    
    public function cancelled(){
        $data['limit']=10;
        $data['search_string']='withdrawal_search';
        $conditions['tx_type']='withdrawal';
        $conditions['status']=2;
        $data['from_table']='transaction';
        $data['base_url']=$this->panel_url.'/withdrawal/pending'; 
        
        if(!empty($conditions)){
            $data['conditions']=$conditions;
        }       


        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];
        $data['sr_no']=$res['sr_no'];
        $data['total_rows']=$res['total_rows'];  
        $this->show->admin_panel('withdrawal_cancelled',$data);
        
    }*/
    
      public function pending(){
           if(isset($_REQUEST['export_to_excel'])){
          
         $whr="tx_type='withdrawal' and status='0'";
           $get_data=$this->conn->runQuery('u_code,bank_details,tx_charge,remark,amount,added_on','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
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
        $conditions['tx_type']='withdrawal';
        $conditions['status']=0;      
        // $searchdata['order_by']='date desc';
        $searchdata['from_table']='transaction';        
        
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
         if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
           $spo=$this->profile->column_like($_REQUEST['name'],'name');     
            
            if($spo){
                $conditions['u_code'] = array($spo);
            }
        }
        /*if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
          
          
            $spo=$this->profile->column_like($_REQUEST['username'],'username');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
           
        }*/
        if(isset($_REQUEST['username'])){
            $self=$spos=$this->profile->column_like($_REQUEST['username'],'username'); 
            // $ser = $_REQUEST['username'];
            // $spos=$this->profile->id_by_username($ser); 
          /**/
           
            if(isset($_REQUEST['select_team']) && $_REQUEST['select_team']!=''){
               $spos=$team= $this->team->team_power_leg_and_other($spos[0],$_REQUEST['select_team']);
               // $spo=$this->profile->column_like($team,'id');
                /*print_r($spos);
                die();*/
                if($spos){
                    $or_conditions['u_code'] = ($spos);
                }else{
                    $or_conditions['u_code'] = ($self);
                }
           
               //$spo_string = implode(',', $spos);
           
               
            }else{
             $spo=$this->profile->column_like($_REQUEST['username'],'username'); 
             /*print_r($spo);
             die();*/
                if($spo){
                    $conditions['u_code'] = $spo;
                }
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
        if(!empty($or_conditions)){
            $searchdata['or_conditions'] = $or_conditions;
        }
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/withdrawal/pending'); 
       /* print_r($this->db->last_query());
        die();*/
        $this->show->admin_panel('withdrawal_pending',$data);
        
       
       
    }
    
    public function call_team(){
        $res=$this->team->team_power_leg_and_other(2045,'power_leg');
        print_r($res);
    }
    
     public function approved(){

       $searchdata['search_string']='withdrawal_approved_search';
        $conditions['tx_type']='withdrawal';
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
         
            
        $this->show->admin_panel('withdrawal_approved',$data);
          if(isset($_REQUEST['export_to_excel'])){
          
         $whr="tx_type='withdrawal' and status='1'";
           $get_data=$this->conn->runQuery('u_code,bank_details,tx_charge,remark,amount,added_on','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
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
        $conditions['tx_type']='withdrawal';
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
         
            
        $this->show->admin_panel('withdrawal_cancelled',$data);
        
         if(isset($_REQUEST['export_to_excel'])){
          
         $whr="tx_type='withdrawal' and status='2'";
           $get_data=$this->conn->runQuery('u_code,bank_details,tx_charge,remark,amount,added_on','transaction', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $bank_details=json_decode($get_data[$f]->bank_details);
               
                $dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
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
            $this->session->set_userdata('admin_withdrawal_id',$_REQUEST['id']);
        }

        $wd_id=$this->session->userdata('admin_withdrawal_id');

        if(isset($_POST['approve_btn'])){
            $response = $this->approve($wd_id);
           
            if($response['res']==true){
                $this->session->set_flashdata("success", "Withdrawal Approved.");
                redirect(base_url($this->conn->company_info('admin_path').'/withdrawal/pending'));

            }else{
                $msg = $response['msg'];
                $this->session->set_flashdata("error", $msg);
                redirect(base_url($this->conn->company_info('admin_path').'/withdrawal/pending'));
            }

            
        }



       if(isset($_POST['cancel_btn'])){
            $this->form_validation->set_rules('reason', 'Reason', 'required');
            if($this->form_validation->run() != False){
                 $chk_exists=$this->conn->runQuery('u_code,amount,tx_charge,wallet_type','transaction',"status=0 and id='$wd_id'");
                if($chk_exists){
                    $u_code=$chk_exists[0]->u_code;
                    
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
                       $this->update_ob->add_amnt($u_code,'total_withdrawal',-$ttl_amnt); 
                       
                    }
                }
                
                redirect(base_url($this->conn->company_info('admin_path').'/withdrawal/cancelled'));
            }
        }


        $data['wd_id']=$wd_id;
        $this->show->admin_panel('withdrawal_view',$data);
        
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
                $this->session->set_flashdata("success", "Withdrawal Approved.");
                redirect($this->admin_url.'/withdrawal/pending');
            }else{
                $this->session->set_flashdata("error", "Invalid Request. Please Select User1");
                redirect($this->admin_url.'/withdrawal/pending'); 
            }
        }

        if(isset($_POST['reject_btn'])){
            
            if(isset($_POST['wd_ids'])){
                if(isset($_POST['reject_reason']) && $_POST['reject_reason']!=''){
                    $wd_id=$_POST['wd_ids'];
                    if(!empty($wd_id)){
                        foreach($wd_id as $wdid){
                            $chk_exists=$this->conn->runQuery('amount,tx_charge,wallet_type,u_code','transaction',"status=0 and id='$wdid'");
                            if($chk_exists){
                                $u_code=$chk_exists[0]->u_code;
                                $amnt=$chk_exists[0]->amount;
                                $tx_charge=$chk_exists[0]->tx_charge;
                                $ttl_amnt=$amnt+$tx_charge;
                                $wallet_type=$chk_exists[0]->wallet_type;
                                
                                $set=array();
                                $set['status']=2;
                                $set['reason']=$_POST['reject_reason'];
                                $set['added_on']=date('Y-m-d H:i:s');
                                $this->db->where('id',$wdid);
                                if($this->db->update('transaction',$set)){
                                   $this->update_ob->add_amnt($u_code,$wallet_type,$ttl_amnt); 
                                   $this->update_ob->add_amnt($u_code,'total_withdrawal',-$ttl_amnt); 
                                   
                                }
                            }
                        }
                    }
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
    public function approve($wd_id){
        $res['res'] = false; 
       $chk_exists=$this->conn->runQuery('id','transaction',"status=0 and id='$wd_id'");
        if($chk_exists){
            $set['status']=1;
            $set['added_on']=date('Y-m-d H:i:s');
            $this->db->where('id',$wd_id);
            $this->db->update('transaction',$set);
             $res['res'] = true; 
                              
        }
        return $res;
    }
	 public function approve_stop($wd_id){
        $res['res'] = false; 
        $chk_exists=$this->conn->runQuery('*','transaction',"status=0 and id='$wd_id'");
        if($chk_exists){
             ////////////////////////////////api/////////////////////////////////////////////////
                       $trx_address_pattern = '/^T[0-9A-HJ-NP-Za-km-z]{33}$/';
					    $u_code=$chk_exists[0]->u_code;
					    $withdraw_status=$chk_exists[0]->withdraw_status;
					    $transferAmts=$chk_exists[0]->amount;
					   // $bank_details111=$this->profile->my_default_account($u_code);
        //                 $user_address=json_encode($bank_details111['bep20']);
                        $bsc_address_pattern = '/^(0x)?[0-9a-fA-F]{40}$/';
                        $user_address = '';
                        $bank_details = json_decode($chk_exists[0]->bank_details,true);
                        if($withdraw_status == 7){
                            if(array_key_exists('BEP20',$bank_details)){
                             $user_address = $bank_details['BEP20'];
                             
                             
					    $withdrawal_ty1="USDT-BEP20";
					   
					    if($user_address !='' && preg_match($bsc_address_pattern, $user_address)){
					  
					   
					    $url =  "https://test.eracom.in/sendcryp/";
					  
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            
                            $headers = [
                              "Content-Type: application/x-www-form-urlencoded"
                            ];
                            
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                            
                            $data = http_build_query([
                              "api_key" => "",
                               "action" => "transfer",
                              "to_address" => $user_address,
                              "payment_amount" => $transferAmts,
                              "token" => $withdrawal_ty1,
                               "network" => "BSC"
                            ]);
                             
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                           
                            $result = json_decode(curl_exec($curl), true);
                            curl_close($curl);
                            
                      
                           $smsg= $result['message'];
        			 
                            
                            if($result['success']==true){  
        					    $hash=$msg;
        					   // $this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                                $set['tx_hash']=$smsg;
                                $set['status']=1;
                                $set['added_on']=date('Y-m-d H:i:s');
                                $this->db->where('id',$wd_id);
                                $this->db->update('transaction',$set);

                                $profiles=$this->profile->profile_info($u_code);
				                $company_name=$this->conn->company_info('company_name');
                                $msg="Your withdrawal Successfully Approved. Team $company_name";
				                $this->message->send_mail_reg($profiles->email,'Withdrawal Approved',$msg,$profiles->username);

                                $res['res'] = true; 
                                $res['msg'] = $msg; 
    
                            }else{
                                 $res['res'] = false; 
                                 $res['msg'] = $smsg; 
                            }
                            
                        }else{
                                 $res['res'] = false; 
                                 $res['msg'] = "Please Enter Account Details!"; 
                        }
                            
                        }elseif(array_key_exists('trc20',$bank_details)){
                            
                            
                             $user_address = $bank_details['trc20'];
                             //die();
                             
					    $withdrawal_ty1="USDT-TRC20";
					  
					    if($user_address !='' && preg_match($trx_address_pattern, $user_address)){
					  
					   
					    $url =  "https://test.eracom.in/sendcryp/";
					  
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            
                            $headers = [
                              "Content-Type: application/x-www-form-urlencoded"
                            ];
                            
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                            
                            $data = http_build_query([
                              "api_key" => "7f0b9bbfe097f95261ca4c32c3f01708",
                               "action" => "transfer",
                              "to_address" => $user_address,
                              "payment_amount" => $transferAmts,
                              "token" => $withdrawal_ty1,
                               "network" => "tron"
                            ]);
                             
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                           
                            $result = json_decode(curl_exec($curl), true);
                            curl_close($curl);
                          
                        
                          $smsg= $result['message']['txid'];
        			      $testing = array();
        			      $testing['remark'] = $result['message'];
        			      $this->db->insert('testing',$testing);
                            
                            if($result['success']){  
                               
        					    $hash=$smsg;
        					    //$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                                $set['tx_hash']=$smsg;
                                $set['status']=1;
                                $set['added_on']=date('Y-m-d H:i:s');
                                $this->db->where('id',$wd_id);
                                $this->db->update('transaction',$set);

                                $profiles=$this->profile->profile_info($u_code);
				                $company_name=$this->conn->company_info('company_name');
                                $msg="Your withdrawal Successfully Approved. Team $company_name";
				                $this->message->send_mail_reg($profiles->email,'Withdrawal Approved',$msg,$profiles->username);

                                $res['res'] = true; 
                                $res['msg'] = $msg; 
    
                            }else{
                                 $res['res'] = false; 
                                 $res['msg'] = $smsg; 
                            }
                            
                        }else{
                                 $res['res'] = false; 
                                 $res['msg'] = "Please Enter Account Details!"; 
                        }
                            
                            
                            
                            
                        } 
           
                        }else{
                            
                           
                            $user_address = $chk_exists[0]->bank_details;
                           //die();
                            $payment_type = $chk_exists[0]->payment_type;
                            if($payment_type == 'BEP20'){
                                $api = '325b5081c7d3317d1c7b6fe744a91a61';
                                $peg_mathc = $bsc_address_pattern;
                                $withdrawal_ty1 = 'USDT-BEP20';
                                $nnetwork = 'BSC';
                            }else{
                                $api = '7f0b9bbfe097f95261ca4c32c3f01708';
                                $peg_mathc = $trx_address_pattern;
                                $withdrawal_ty1 = 'USDT-TRC20';
                                $nnetwork = 'tron';
                            }
                            
                            if($user_address !='' && preg_match($peg_mathc, $user_address)){
					  
					   
					        $url =  "https://test.eracom.in/sendcryp/";
					  
                            $curl = curl_init($url);
                            curl_setopt($curl, CURLOPT_URL, $url);
                            curl_setopt($curl, CURLOPT_POST, true);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            
                            $headers = [
                              "Content-Type: application/x-www-form-urlencoded"
                            ];
                            
                            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                            
                            $data = http_build_query([
                              "api_key" => $api,
                               "action" => "transfer",
                              "to_address" => $user_address,
                              "payment_amount" => $transferAmts,
                              "token" => $withdrawal_ty1,
                               "network" => $nnetwork
                            ]);
                             
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                           
                            $result = json_decode(curl_exec($curl), true);
                            curl_close($curl);
                            
                           //print_R($result);
                           //die();
                           $smsg= $result['message'];
        			       
                            
                            if($result['success']==true){  
        					    $hash=$msg;
        					   // $this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                                $set['tx_hash']=$smsg;
                                $set['status']=1;
                                $set['added_on']=date('Y-m-d H:i:s');
                                $this->db->where('id',$wd_id);
                                $this->db->update('transaction',$set);
                                
                               // echo $this->db->last_query();
                               // die();
                                
                                $profiles=$this->profile->profile_info($u_code);
				                $company_name=$this->conn->company_info('company_name');
                                $msg="Your withdrawal Successfully Approved. Team $company_name";
				                $this->message->send_mail_reg($profiles->email,'Withdrawal Approved',$msg,$profiles->username);

                                $res['res'] = true; 
                                $res['msg'] = $msg; 
    
                            }else{
                                 $res['res'] = false; 
                                 $res['msg'] = $smsg; 
                            }
                            
                        }else{
                                 $res['res'] = false; 
                                 $res['msg'] = "Please Enter Account Details!"; 
                        }
                       
                        }
                        
                        
        }else{
            $res['res'] = false; 
        }
        return $res;
    }

  public function franchise_pending(){
        $searchdata['search_string']='withdrawal_search';
        $conditions['tx_type']='withdrawal';
        $conditions['status']=0;      
        // $searchdata['order_by']='date desc';
        $searchdata['from_table']='transaction_franchise';        
        
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
         if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
           $spo=$this->profile->column_like_franchise($_REQUEST['name'],'name');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
          
          
            $spo=$this->profile->column_like_franchise($_REQUEST['username'],'username');     
            
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/withdrawal/franchise-pending'); 
         
            
        $this->show->admin_panel('franchise_withdrawal_pending',$data);
              
    }   
    
    public function franchise_approved(){

       $searchdata['search_string']='withdrawal_approved_search';
        $conditions['tx_type']='withdrawal';
        $conditions['status']=1;      
        $searchdata['order_by']='date desc'; 
        $searchdata['from_table']='transaction_franchise';
       // $data['base_url']=$this->panel_url.'/withdrawal/approved';
          
         if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
           $spo=$this->profile->column_like_franchise($_REQUEST['name'],'name');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
        }
       if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
          
          
            $spo=$this->profile->column_like_franchise($_REQUEST['username'],'username');     
            
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
        
         $searchdata['order_by']='updated_on desc';
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/withdrawal/franchise-approved'); 
         
            
        $this->show->admin_panel('franchise_withdrawal_approved',$data);
    }
    
    
     public function franchise_view(){
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_withdrawal_id',$_REQUEST['id']);
        }
        $wd_id=$this->session->userdata('admin_withdrawal_id');

        if(isset($_POST['approve_btn'])){
            $this->approves($wd_id);
            $this->session->set_flashdata("success", "Franchise Withdrawal Approved.");
            redirect(base_url($this->conn->company_info('admin_path').'/withdrawal/franchise-approved'));
        }
         

        $data['wd_id']=$wd_id;
        $this->show->admin_panel('franchise_withdrawal_view',$data);
        
    }
    
      public function approves($wd_id){
        $chk_exists=$this->conn->runQuery('id','transaction_franchise',"status=0 and id='$wd_id'");
        if($chk_exists){
            $set['status']=1;
            $set['approve_date']=date('Y-m-d H:i:s');
            $set['added_on']=date('Y-m-d H:i:s');
            $this->db->where('id',$wd_id);
            $this->db->update('transaction_franchise',$set);
        }
    }
    
    
    
  public function daily(){
      
   
    if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
       $s_by_name_arr=$this->profile->column_like($_REQUEST['name'],'name');   
       if(!empty($s_by_name_arr)){
       	$s_names=implode(',',$s_by_name_arr);
       	 $whr .= "u_code IN ($s_names) ";
       } 
       
    }
    
     
          
    if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
       $s_by_username_arr=$this->profile->column_like($_REQUEST['username'],'username');    
       if(!empty($s_by_username_arr)){
       	$s_usernames=implode(',',$s_by_username_arr);
       	$whr .= "u_code IN ($s_usernames) ";
       } 
    }
    
    if(isset($_REQUEST['username']) || isset($_REQUEST['name'])==''){
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
                 $data['status']=$_REQUEST['status'];
        }
    }  
    
  $data['date_today']=$whr;
  $this->show->admin_panel('withdrawal_daily',$data);
        
    }

  
    
}