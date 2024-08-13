<?php
class Invest extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->conn->plan_setting('invest_section')!=1){
            $panel_path=$this->conn->company_info('panel_path');
            redirect(base_url($panel_path.'/dashboard'));
            $this->currency=$this->conn->company_info('currency');
           
        }
         $this->panel_url=$this->conn->company_info('panel_path');
    }

    public function investment(){
       //  $this->show->user_panel('coming_soon');
        $u_Code=$this->session->userdata('user_id');
        $csrf_test_name=json_encode($_POST);
        if(isset($_POST['topup_btn'])){
            
            $pinvalidation='';
            $check_ex=$this->conn->runQuery('id','form_request',"request='$csrf_test_name' and u_code='$u_Code'");
            if($check_ex){
              $this->session->set_flashdata("error", "You can not submit same request within 5 minutes.");
                 redirect($_SERVER["HTTP_REFERER"]);
            }else{
                $request['u_code']=$u_Code;
                $request['request']=$csrf_test_name;
                $this->db->insert('form_request',$request);
                   
            if($this->conn->setting('topup_type')=='amount'){
                $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable|callback_check_wallet_balance');
            }elseif($this->conn->setting('topup_type')=='pin'){
                $pinvalidation="|callback_check_pin_available";
            }        

            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username');
            $this->form_validation->set_rules('selected_pin', 'Package', "required|callback_valid_package".$pinvalidation);
            
            $invest_toup_with_otp=$this->conn->setting('invest_toup_with_otp');
            if($invest_toup_with_otp=='yes'){
                $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
            }

            if($this->form_validation->run() != False){
                $mx_id=$this->conn->runQuery('MAX(active_id) as mx','users',"active_status='1'")[0]->mx;
                $active_id = ($mx_id ? $mx_id:0)+1;
                
                $currenct_payout_id=$this->wallet->currenct_payout_id();
                $tx_username=$_POST['tx_username'];
                $tx_u_code=$this->profile->id_by_username($tx_username);
                $pin_type=$_POST['selected_pin'];
                $pin_details=$this->pin->pin_details($pin_type);
                
                $check_user_sts=$this->conn->runQuery('subcription_date,active_status,subcription','users',"username='$tx_username'");
                $check_active_stss=$check_user_sts[0]->active_status;
                if($check_active_stss==0){
                    $stss="yes";
                }else{
                    $subcription_datess=$check_user_sts[0]->subcription_date;
                    $subcription_month=$check_user_sts[0]->subcription;
                    $join_date=$profile->added_on;
  
            	    $current_days=date("Y-m-d");
            	    $from= date("Y-m-d", strtotime($subcription_datess));
                    $dStart = new DateTime($from);
                    $dEnd  = new DateTime($current_days);
                    $dDiff = $dStart->diff($dEnd);
                    $ttl_dt_diff=$dDiff->format('%r%a');
                    
                    if($subcription_month=="3 Month"){
                        $total_days=114;
                    }elseif($subcription_month=="6 Month"){
                         $total_days=228;
                    }elseif($subcription_month=="12 Month"){
                         $total_days=461;
                    }
                    
                    if($ttl_dt_diff>=$total_days){
                       $stss="yes";
                    }else{
                         $stss="no";
                    }
                }
                
                if($stss=="yes"){
                
                $orders['u_code']=$tx_u_code;
                $orders['tx_type']='purchase';
                $orders['order_amount']=$pin_details->pin_rate;
                $orders['order_bv']=$pin_details->business_volumn;
                $orders['pv']=$pin_details->pin_value;
                $orders['subcription']=$pin_details->subcription;
                $orders['status']=1;
                $orders['payout_id']=$currenct_payout_id;
                $orders['payout_status']=0;
                $orders['active_id']=$active_id;

                if($this->db->insert('orders',$orders)){
                    
                if($check_active_stss==0){
                     $update=array(
                        'subcription' => $pin_details->subcription,
                        'subcription_date' => date('Y-m-d H:i:s'),
                        'active_id' => $active_id,
                        'active_status' => 1,
                        'active_date' => date('Y-m-d H:i:s'),
                        'selected_color' => 'green',
                    );
                    $this->db->where('id',$tx_u_code);
                    $this->db->update('users',$update);
                    
                    $this->db->set('active_id',$active_id);
                    $this->db->where('u_code',$tx_u_code);
                    $this->db->update('user_wallets');
                }else{
                    $update=array(
                        'subcription' => $pin_details->subcription,
                        'subcription_date' => date('Y-m-d H:i:s'),
                       
                    );
                    $this->db->where('id',$tx_u_code);
                    $this->db->update('users',$update);
                }
                    
                    
                   

                    if($this->conn->setting('topup_type')=='amount'){
                        $username=$this->session->userdata('profile')->username;
                        
                        $transaction['u_code']=$this->session->userdata('user_id');
                        $transaction['tx_u_code']=$tx_u_code;
                        $transaction['tx_type']="topup";
                        $transaction['debit_credit']="debit";
                        $transaction['wallet_type']=$_POST['selected_wallet'];
                        $transaction['amount']=$pin_details->pin_rate;
                        $transaction['date']=date('Y-m-d H:i:s');
                        $transaction['status']=1;
                        $transaction['open_wallet']=$this->update_ob->wallet($this->session->userdata('user_id'),$_POST['selected_wallet']);
                        $transaction['closing_wallet']=$transaction['open_wallet']-$transaction['amount'];
                        $transaction['remark']="$username topup $tx_username of amount $pin_details->pin_rate";
                        
                        if($this->db->insert('transaction',$transaction)){
                            $amnt=$transaction['amount'];
                            $this->update_ob->add_amnt($this->session->userdata('user_id'),$_POST['selected_wallet'],-$amnt);
                        }
                    }elseif($this->conn->setting('topup_type')=='pin'){
                        $pin_update_details=$this->pin->user_pins_by_type($this->session->userdata('user_id'),$pin_type);
                        $pin_id=$pin_update_details[0]->id;
                        $update_details['use_status']=1;
                        $update_details['used_in']='topup';
                        $update_details['usefor']=$tx_u_code;
                        $this->db->where('id',$pin_id);
                        $this->db->update('epins',$update_details);                        
                        $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details):0);

                        $pin_history['user_id']=$this->session->userdata('user_id');
                        $pin_history['debit']=1;
                        $pin_history['prev_pin']=$cnt_tx_pre_pins;
                        $pin_history['curr_pin']=$cnt_tx_pre_pins-1;
                        $pin_history['pin_type']=$pin_details->pin_type;
                        $pin_history['tx_type']='debit';
                        $name=$this->session->userdata('profile')->name;
                        $username=$this->session->userdata('profile')->username;
                        $pin_history['remark']="$name ( $username ) Topup $tx_username ";
                        $this->db->insert('pin_history',$pin_history);
                        
                        $this->update_ob->used_pin($this->session->userdata('user_id'));
                    }

                    if($this->conn->setting('level_distribution_on_topup')=='yes'){
                        $this->distribute->level_destribute($tx_u_code,$pin_details->pin_rate,30);
                    }
                    
                    
                    if($check_active_stss==0){
                   
                        $sponsor_info=$this->profile->sponsor_info($tx_u_code,'mobile,id');
                        
                        if($sponsor_info){
                            $sponsor_mobile = $sponsor_info->mobile;
                            $tx_profile_info=$this->profile->profile_info($tx_u_code,'name');
                            $tx_name=$tx_profile_info->name;
                            $website=$this->conn->company_info('title');
                            $msg="Congratulations!! $tx_name Has activated his Position. Team $website";
                            //$this->message->sms($sponsor_mobile,$msg);
                            $this->update_ob->active_gen($sponsor_info->id);
                            $this->update_ob->active_direct($sponsor_info->id);
                        }
                    }

                    if($this->conn->plan_setting('matrix')=='1'){
                        $this->distribute->gen_pool($tx_u_code,$pin_details->pin_rate);
                         
                       /* $get_matrix_parent=$this->binary->get_matrix_parent(1);
                        $update_position['matrix_pool']=$get_matrix_parent['parent'];
                        $update_position['matrix_position']=$get_matrix_parent['position'];
                        $this->db->where('id',$tx_u_code);
                        $this->db->update('users',$update_position);*/
                    }
                    $ip = $this->input->ip_address();
                    $login_details['u_code'] = $this->session->userdata('user_id');
                    $login_details['ip_address'] = $ip;
                    $login_details['type'] = 'investment';
                    $this->db->insert('login_details',$login_details);
                    $plan_type=$this->session->userdata('reg_plan'); 
                    if($plan_type=='single_leg'){
                         $this->update_ob->update_single_leg($tx_u_code,$active_id);
                    }
                    
                     
                    
                    $this->session->set_flashdata("success", "Package $pin_details->pin_type Activated successfully.");
                    redirect(base_url(uri_string()));
                }else{
                    $this->session->set_flashdata("error", "Something wrong.");
                }
                
                }else{
                     $this->session->set_flashdata("error", "Subcription Package not expire.");
                }
            }
                }
        }


       $this->show->user_panel('invest_topup');
    }

    

    public function reinvestment(){
        die();
       //  $this->show->user_panel('coming_soon');
        
            if(isset($_POST['topup_btn'])){
                $pinvalidation='';

                if($this->conn->setting('retopup_type')=='amount'){
                    $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable');
                    $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_wallet_balance1|callback_check_min_balance|callback_check_max_balance');
                }elseif($this->conn->setting('retopup_type')=='pin'){
                    $pinvalidation="|callback_check_pin_available";
                }
                

                $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username|callback_check_topup');
                $this->form_validation->set_rules('selected_pin', 'Package', "required|callback_valid_package".$pinvalidation);
                
                
                /*$reinvest_toup_with_otp=$this->conn->setting('reinvest_toup_with_otp');
                if($reinvest_toup_with_otp=='yes'){
                    $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
                }*/
               
                if($this->form_validation->run() != False){
					
					//echo "sasa";
					//die();
                    $tx_username=$_POST['tx_username'];
                    $amount=$_POST['amount'];
                    $tx_u_code=$this->profile->id_by_username($tx_username);
                    $pin_type=$_POST['selected_pin'];
                    $pin_details=$this->pin->pin_details($pin_type);
                    $currenct_payout_id=$this->wallet->currenct_payout_id();
                    $bonus=$pin_details->bonus;
                    
                    $bonus_amount=$amount*$bonus/100;
                    $total_amounts=$amount+$bonus_amount;
                    
                    $orders['u_code']=$tx_u_code;
                    $orders['tx_type']='repurchase';
                    $orders['order_amount']=$amount;
                    $orders['order_mrp']=$total_amounts;
                    $orders['order_bv']=$amount;
                    $orders['bonus']=$bonus;
                    $orders['pv']=$pin_details->pin_value;
                    $orders['status']=1;
                    $orders['payout_id']=$currenct_payout_id;
                    $orders['payout_status']=0;
                    
                    if($this->db->insert('orders',$orders)){
                        $check_retoup=$this->conn->runQuery("retopup_status",'users',"username='$tx_username'");
                        $retopup_status=$check_retoup[0]->retopup_status;  
                        if($retopup_status==0){
                            $my_ranks="STATAR";
                            $update=array(
                                'my_package' => $pin_details->rank,
                                'my_rank' => $my_ranks,
                                'rank_per' => 15,
                                'retopup_status' => 1,
                                'retopup_date' => date('Y-m-d H:i:s'),
                                'principal_status' => 1,
                            );
                        }else{
                            $update=array(
                                'my_package' => $pin_details->rank,
                                'retopup_status' => 1,
                                'retopup_date' => date('Y-m-d H:i:s'),
                                'principal_status' => 1,
                            ); 
                        }
                        
                        $this->db->where('id',$tx_u_code);
                        $this->db->update('users',$update);

                        if($this->conn->setting('retopup_type')=='amount'){
                            $username=$this->session->userdata('profile')->username;
                            
                            $transaction['u_code']=$this->session->userdata('user_id');
                            $transaction['tx_u_code']=$tx_u_code;
                            $transaction['tx_type']="retopup";
                            $transaction['debit_credit']="debit";
                            $transaction['wallet_type']=$_POST['selected_wallet'];
                            $transaction['amount']=$amount;
                            $transaction['date']=date('Y-m-d H:i:s');
                            $transaction['status']=1;
                            $transaction['open_wallet']=$this->wallet->balance($this->session->userdata('user_id'),$_POST['selected_wallet']);
                            $transaction['closing_wallet']=$transaction['open_wallet']-$transaction['amount'];
                            $transaction['remark']="$username topup $tx_username of amount $amount";
                           
                            if($this->db->insert('transaction',$transaction)){
                                $amnt=$transaction['amount'];
                                $this->update_ob->add_amnt($this->session->userdata('user_id'),$_POST['selected_wallet'],-$amnt);
                            }
                            
                            
                        }elseif($this->conn->setting('retopup_type')=='pin'){
                            $pin_update_details=$this->pin->user_pins_by_type($this->session->userdata('user_id'),$pin_type);
                            $pin_id=$pin_update_details[0]->id;
                            $update_details['use_status']=1;
                            $update_details['used_in']='retopup';
                            $update_details['usefor']=$tx_u_code;
                            $this->db->where('id',$pin_id);
                            $this->db->update('epins',$update_details);

                            $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details):0);
                            $pin_history['user_id']=$this->session->userdata('user_id');
                            $pin_history['debit']=1;
                            $pin_history['prev_pin']=$cnt_tx_pre_pins;
                            $pin_history['curr_pin']=$cnt_tx_pre_pins-1;
                            $pin_history['pin_type']=$pin_details->pin_type;
                            $pin_history['tx_type']='debit';
                            $name=$this->session->userdata('profile')->name;
                            $username=$this->session->userdata('profile')->username;
                            $pin_history['remark']="$name ( $username ) Retopup $tx_username ";
                            $this->db->insert('pin_history',$pin_history);
                            
                            $this->update_ob->used_pin($this->session->userdata('user_id'));
                            
                        }
                        
                        ///////////////////////////////bonus income/////////////////////////////////////////////
                        $source="self_bonus";
                        $income=array();
                        if($bonus_amount>0){
        					$income['u_code']=$tx_u_code;
        					$income['tx_type']='income';
        					$income['source']=$source;
        					$income['debit_credit']='credit';
        					$income['amount']=$bonus_amount; 				
        					$income['date']=date('Y-m-d H:i:s');             
        					$income['added_on']=date('Y-m-d H:i:s');
        					$income['status']=1;
        					$income['wallet_type']='main_wallet';
        					$income['remark']="Recieve $bonus_amount from Trading Bonus";
        					
        					if($this->db->insert('transaction',$income)){
        						$income_lvl=$income['amount'];//-$income['tx_charge'];
        						$this->update_ob->add_amnt($tx_u_code,$source,$income_lvl);
        						//$this->update_ob->add_amnt($tx_u_code,'main_wallet',$income_lvl); 
        				    }
                        }
                        ///////////////////////////////////////////////////////////////////////////////
                        
                        /*if($this->conn->setting('level_distribution_on_topup')=='yes'){
                            $this->distribute->level_destribute($tx_u_code,$pin_details->pin_rate,15);
                        }*/
                        $ip = $this->input->ip_address();
                        $login_details['u_code'] = $this->session->userdata('user_id');
                        $login_details['ip_address'] = $ip;
                        $login_details['type'] = 'investment';
                        $this->db->insert('login_details',$login_details);
                        $this->session->set_flashdata("success", "Package $amount Activated successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        $this->session->set_flashdata("error", "Something wrong.");
                    }
                }else{
                     $this->session->set_flashdata("error", validation_errors());
                }
            }
      $this->show->user_panel('invest_retopup');
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

     public function valid_package($str){
        $check_username=$this->conn->runQuery("id",'pin_details',"pin_type='$str' and status=1");
         
		if($check_username){
			
            return true;
        }else{
              $this->form_validation->set_message('valid_package', "Invalid Package! Please select valid package.");
               return false;
        }
    }
    
     public function valid_package_min_amount($str){
		$pin_type=$_POST['selected_pin'];
        $check_username=$this->conn->runQuery("id,pin_rate,pin_rate2",'pin_details',"pin_type='$pin_type' and status=1");
        if($check_username){
			$package_rate_min=$check_username[0]->pin_rate;
		    if($str>=$package_rate_min){
					return true;
			}else{
				$this->form_validation->set_message('valid_package_min_amount', "Invalid Amount! Amount Minimum $package_rate_min $ required.");
                return false;
			}
			
           
        }
    }
    public function check_min_balance($str){
		$pin_type=$_POST['selected_pin'];
        $check_username=$this->conn->runQuery("id,pin_rate",'pin_details',"pin_type='$pin_type' and status=1");
        if($check_username){
			$package_rate_min=$check_username[0]->pin_rate;
		    if($str>=$package_rate_min){
					return true;
			}else{
				$this->form_validation->set_message('check_min_balance', "Invalid Amount! Amount Minimum $package_rate_min $ required.");
                return false;
			}
			
           
        }
    }
    public function check_max_balance($str){
		$pin_type=$_POST['selected_pin'];
        $check_username=$this->conn->runQuery("id,pin_rate,max_amount",'pin_details',"pin_type='$pin_type' and status=1");
        if($check_username){
			$package_rate_max=$check_username[0]->max_amount;
		
			if($str<=$package_rate_max){
					return true;
			}else{
				$this->form_validation->set_message('check_max_balance', "Invalid Amount! Amount Maximum $package_rate_max $ required.");
                return false;
			}
			
           
        }
    }
     public function valid_package_max_amount($str){
		$pin_type=$_POST['selected_pin'];
        $check_username=$this->conn->runQuery("id,pin_rate,pin_rate2",'pin_details',"pin_type='$pin_type' and status=1");
        if($check_username){
			$package_rate_max=$check_username[0]->pin_rate2;
		
			if($str<=$package_rate_max){
					return true;
			}else{
				$this->form_validation->set_message('valid_package_max_amount', "Invalid Amount! Amount Maximum $package_rate_max $ required.");
                return false;
			}
			
           
        }
    }
    

    public function check_pin_available($str){
        $user_pins=$this->pin->user_pins_by_type($this->session->userdata('user_id'),$str);
            if($user_pins){
                return true;
            }else{
                $this->form_validation->set_message('check_pin_available', "Insufficient pin in account .");
                return false;
            }
    }

    public function check_wallet_useable($str){
        $available_wallets=$this->conn->setting('invest_wallets');
        $useable_wallet=json_decode($available_wallets);
        if(array_key_exists($str,$useable_wallet)){
            return true;
        }else{
              $this->form_validation->set_message('check_wallet_useable', "You can not Topup from this wallet");
               return false;
        }
    }

    public function check_wallet_balance($str){
       if(isset($_POST['selected_pin']) && $_POST['selected_pin']!=''){

        $checkable=$this->pin->pin_details($_POST['selected_pin'])->pin_rate;
            $balance=$this->update_ob->wallet($this->session->userdata('user_id'),$str);        
            if($balance>=$checkable){
                return true;
            }else{
                $this->form_validation->set_message('check_wallet_balance', "Insufficient Fund in wallet.");
                return false;
            }
       }else{
            $this->form_validation->set_message('check_wallet_balance', "Please Select valid pin.");
            return false;
       }
        
    }
    public function check_wallet_balance1($str){
       if(isset($_POST['selected_wallet']) && $_POST['selected_wallet']!=''){
            $wallet =$_POST['selected_wallet'];
            $checkable=$str;
            $balance=$this->update_ob->wallet($this->session->userdata('user_id'),$wallet);        
            if($balance>=$checkable){
                return true;
            }else{
                $this->form_validation->set_message('check_wallet_balance1', "Insufficient Fund in wallet.");
                return false;
            }
       }else{
            $this->form_validation->set_message('check_wallet_balance1', "Please Select valid pin.");
            return false;
       }
        
    }

    public function already_topup($str){
       if($str!=''){

        $chk=$this->conn->runQuery("id",'users',"username='$str' and active_status='1'");
            if($chk){
                $this->form_validation->set_message('already_topup', "User already have active package.");
                return false;                
            }else{
                return true;
            }
       }else{
            $this->form_validation->set_message('already_topup', "Please enter username.");
            return false;
       }
        
    }
    
    public function check_topup($str){
       if($str!=''){

        $chk=$this->conn->runQuery("id",'users',"username='$str' and active_status='1'");
               
		  if($chk){
				//echo "ssa";
				//die();   
                   return true;           
            }else{
               
                $this->form_validation->set_message('check_topup', "First Take AI Subcription Package.");
                return false;  
            }
       }else{
            $this->form_validation->set_message('check_topup', "Please enter username.");
            return false;
       }
        
    }
    
    public function pin_detail(){
        $type=trim($_POST['selected_pin']);
        $u_id=$this->session->userdata('user_id');
        $res='';
        $get_pin_detail=$this->conn->runQuery('*',"epins","pin_type LIKE '%$type%' and use_status='0' and u_code='$u_id'");
        //echo  $sql = $this->db->last_query();
        if($get_pin_detail){
            $res=count($get_pin_detail);
        } else{
            $res=0;
        }
        echo $res;
    }


 public  function check_otp_valid($str){
        if(isset($_SESSION['otp'])){
            if($_SESSION['otp']==$str){
                return true;
            }else{
                $this->form_validation->set_message('check_otp_valid', "Incorect OTP. Please try again.");
                return false;
            }
        }else{
            $this->form_validation->set_message('check_otp_valid', "OTP not Valid.");
            return false;
        }        
    }
    
     public function topup_history(){
        $data=array();
        $limit=$this->limit;
        
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $data['from_table']='transaction';
        $conditions['tx_type']=['topup','retopup'];
        $data['base_url']=$base_url=base_url().$this->panel_url.'/invest/topup-history';  
       
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
        if(isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']!='all'){
            $conditions['tx_type']=$_REQUEST['tx_type'];
        }
          
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $data['where']="date>='".$_REQUEST['start_date']."' and date<='".$_REQUEST['end_date']."'";
        }
        if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
        }
        
        $data['conditions']=$conditions;
        $data = $this->paging->search_response($data,$limit,$base_url);
        
        $data['base_url']=$base_url;
        
        $this->show->user_panel('invest_history',$data);
        
    }
    
    
    
    
}

