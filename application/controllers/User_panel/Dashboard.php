<?php
class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){   
        
        if($_REQUEST['ids']){
            $u_id=$_REQUEST['ids']; 
            $Order=$this->conn->runQuery('*',"orders","tx_type='repurchase' and u_code='$u_id'");   
            if($Order){
                $Order=$this->conn->runQuery('SUM(order_amount) as order_amt',"orders","tx_type='repurchase' and u_code='$u_id'");   
                $total_amts=$Order[0]->order_amt;
                if($total_amts>=5000){
                   
                    $check_Orders=$this->conn->runQuery('*',"meta_request","u_code='$u_id'"); 
                   if(empty($check_Orders)){
                        
                        $orderss['u_code']=$u_id;
                        $orderss['amount']=$total_amts;
                        $orderss['type']='admin';
                        $orderss['status']='0';
                        
                        $this->db->insert('meta_request',$orderss);
                        $users_detailss=$this->conn->runQuery('email',"users","id='$u_id'");
                        $msg2="success";
                        $this->message->send_mail($users_detailss[0]->email,'MT5',$msg2,$u_id);
                        
                        $this->session->set_flashdata("success", "Request detail send on your mail.");
                        redirect(base_url(uri_string()));
                    }else{
                        $this->session->set_flashdata("error", "Already Take Request.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $check_Orders=$this->conn->runQuery('*',"meta_request","u_code='$u_id'");   
                    if(empty($check_Orders)){
                        
                        $orderss['u_code']=$u_id;
                        $orderss['amount']=$total_amts;
                        $orderss['type']='user';
                        $this->db->insert('meta_request',$orderss);
                        
                        $users_detailss=$this->conn->runQuery('email',"users","id='$u_id'");
                        $msg2="success";
                        $this->message->send_mail($users_detailss[0]->email,'MT5',$msg2,$u_id);
                        
                        $this->session->set_flashdata("success", "Request detail send on your mail.");
                        redirect(base_url(uri_string()));
                        
                    }else{
                        $this->session->set_flashdata("error", "Already Take Request.");
                        redirect(base_url(uri_string()));
                    }    
                }
                
            }else{
                $this->session->set_flashdata("error", "Please take subcription package.");
                redirect(base_url(uri_string()));
            }
        }
        
        
        
        if(isset($_POST['withdrawals_btn'])){
                             
            $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable_withdrawal');            
            $this->form_validation->set_rules('amounts', 'Amount', 'required|callback_check_transfer_balance|greater_than[0]|callback_check_account_exists|callback_min_withdrawal_limit');
            
           $with_drawal_mode=$this->conn->setting('withdrawals_mode')=='in_cripto';
           if($with_drawal_mode){
               
               $this->form_validation->set_rules('selected_address', 'Address', 'callback_check_cripto_address_exists');
               
           }
           
           if($this->form_validation->run() != False){
                 
           $csrf_test_name=json_encode($_POST);
           $check_ex=$this->conn->runQuery('id','form_request',"request='$csrf_test_name'");
           if($check_ex){
              $this->session->set_flashdata("error", "You can not submit same request within 5 minutes.");
           }else{   
               
              $request['u_code']=$this->session->userdata('user_id');
              $request['request']=$csrf_test_name;
              $this->db->insert('form_request',$request);
              $userid=$this->session->userdata('user_id');
              $bank_details=$bank_details=$this->profile->my_default_account($userid);//$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
               
                   
                   
                   $inserttrans['bank_details']=json_encode($bank_details);
              
            $crncy=$this->conn->company_info('currency');
              $profile=$this->session->userdata('profile');
              $username=$profile->username;
              $name=$profile->name;
                
              $inserttrans['wallet_type']=$_POST['selected_wallet'];
              $inserttrans['tx_type']='withdrawal';
                  $inserttrans['debit_credit']="debit";             
               $inserttrans['u_code']=$this->session->userdata('user_id');
              $inserttrans['date']=date('Y-m-d H:i:s');
              $amnt=abs($_POST['amounts']);
              $tx_charge=$amnt*5/100;
              $inserttrans['amount']=$amnt-$tx_charge;
              $inserttrans['tx_charge']=$tx_charge;
              $inserttrans['status']=0;
              $inserttrans['open_wallet']=$this->update_ob->wallet($this->session->userdata('user_id'),$_POST['selected_wallet']);
              $inserttrans['closing_wallet']=$inserttrans['open_wallet']-$inserttrans['amount'];
              $inserttrans['remark']="$name ($username) Withdraw  $crncy $amnt";

              if($this->db->insert('transaction',$inserttrans)){
                  
                  //$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                  $this->update_ob->add_amnt($userid,$_POST['selected_wallet'],-$amnt);
                  $this->update_ob->add_amnt($userid,'total_withdrawal',$amnt);
                     
                 $smsg="Withdrawal request success of amount  $crncy $amnt .";
                 $this->session->set_flashdata("success", $smsg);
                 redirect(base_url(uri_string()));

              }else{
                 $this->session->set_flashdata("error", "Something wrong.");
              }
           }
            
        }
     }




     $u_Code=$this->session->userdata('user_id');
     $csrf_test_name=json_encode($_POST);
     if(isset($_POST['topup_btns'])){
         
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
     

         $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username|callback_already_topup');
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

             $orders['u_code']=$tx_u_code;
             $orders['tx_type']='purchase';
             $orders['order_amount']=$pin_details->pin_rate;
             $orders['order_bv']=$pin_details->business_volumn;
             $orders['pv']=$pin_details->pin_value;
             $orders['roi']=$pin_details->roi;
             $orders['status']=1;
             $orders['payout_id']=$currenct_payout_id;
             $orders['payout_status']=0;
             $orders['active_id']=$active_id;

             if($this->db->insert('orders',$orders)){
                 
                 $update=array(
                     'active_id' => $active_id,
                     'active_status' => 1,
                     'active_date' => date('Y-m-d H:i:s'),
                 );
                 $this->db->where('id',$tx_u_code);
                 $this->db->update('users',$update);
                 
                 $this->db->set('active_id',$active_id);
                 $this->db->where('u_code',$tx_u_code);
                 $this->db->update('user_wallets');

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
                      $this->distribute->level_destribute($tx_u_code,$pin_details->pin_rate,10);
                      $this->distribute->direct_destribute($tx_u_code,$pin_details->pin_rate,1);
                 }
                 
                
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

                 if($this->conn->plan_setting('matrix')=='1'){
                     $this->distribute->gen_pool($tx_u_code,$pin_details->pin_rate);
                      
                    /* $get_matrix_parent=$this->binary->get_matrix_parent(1);
                     $update_position['matrix_pool']=$get_matrix_parent['parent'];
                     $update_position['matrix_position']=$get_matrix_parent['position'];
                     $this->db->where('id',$tx_u_code);
                     $this->db->update('users',$update_position);*/
                 }
                 
                 $plan_type=$this->session->userdata('reg_plan'); 
                 if($plan_type=='single_leg'){
                      $this->update_ob->update_single_leg($tx_u_code,$active_id);
                 }
                 
                  
                 
                 $this->session->set_flashdata("success", "Package $pin_details->pin_type Activated successfully.");
                 redirect(base_url(uri_string()));
             }else{
                 $this->session->set_flashdata("error", "Something wrong.");
             }
         }
             }
     }
    
        $this->show->user_panel('index');
    }



    public function check_wallet_useable_withdrawal($str){
        $available_wallets=$this->conn->setting('withdrawal_wallets');
        $useable_wallet=json_decode($available_wallets);
        if(array_key_exists($str,$useable_wallet)){
            return true;
        }else{
              $this->form_validation->set_message('check_wallet_useable', "You can not Withdraw fund from this wallet");
               return false;
        }
    }


    public function check_transfer_balance($str){
        $wlt=$_POST['selected_wallet'];
        $balance=$this->update_ob->wallet($this->session->userdata('user_id'),$wlt);        
        if($balance>=$str){
            return true;
        }else{
            $this->form_validation->set_message('check_transfer_balance', "Insufficient Fund in wallet.");
            return false;
        }
    }

    public function min_withdrawal_limit($str){
        $min_withdrawal_limit=$this->conn->setting('min_withdrawal_limit');
       
        if(is_numeric($str)   && $str>=$min_withdrawal_limit){
            return true;
        }else{
            $curr=$this->conn->company_info('currency');
              $this->form_validation->set_message('min_withdrawal_limit', "Amount should be minimum $curr $min_withdrawal_limit");
               return false;
        }
    }


    public function check_account_exists($st){
        $userid = $this->session->userdata('user_id');
        $bank_details=$this->profile->my_default_account($userid);
        if(!empty($bank_details)){
            return true;
        }else{
              $this->form_validation->set_message('check_account_exists', "Add account details first.");
               return false;
        }
    }


//         topup validations start    //
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
                   return true;           
            }else{
               
                $this->form_validation->set_message('check_topup', "First topup account.");
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
    


    public  function meta(){ 
        
    }

















    
    
     public function test_mail(){
        echo $email='kamaljitsandal1510@gmail.com';
        $Subject='test';
        $message='Test message.';
    	echo $this->message->send_mail1($email,$Subject,$message);
    }
    
    public function test_trongrid(){         
           
         $u_code=$this->session->userdata('user_id');
            $rr=$this->trongrid->getAddress($u_code);
            echo '<pre>';
            print_r($rr);
            echo '</pre>';
        
    }
    
    public function ttt(){
        ?>
        <form action="https://www.coinpayments.net/index.php" method="post">
        	<input type="hidden" name="cmd" value="_pay_simple">
        	<input type="hidden" name="reset" value="1">
        	<input type="hidden" name="merchant" value="49a70086fde6f8998b3f4b18fb99574f">
        	<input type="hidden" name="item_name" value="eracom">
        	<input type="hidden" name="currency" value="INR">
        	<input type="hidden" name="amountf" value="5.00000000">
        	<input type="hidden" name="want_shipping" value="0">
        	<input type="hidden" name="invoice" value="44">
        	<input type="hidden" name="success_url" value="http://test.eracom.in/demo_new/user/dashboard/check">
        	<input type="hidden" name="cancel_url" value="http://test.eracom.in/demo_new/user/dashboard/check">
        	<input type="hidden" name="ipn_url" value="http://test.eracom.in/demo_new/user/dashboard/ipn">
        	<input type="image" id="sbmt" >
        </form>
        <script>
           window.onload = function(){
            var button = document.getElementById('sbmt');
                button.form.submit();
            }
        </script>
        <?php
    }
    public function check(){
        
       // $this->load->view('check/cryption-dark/index.html');
        
       
       print_r($_POST);
       // echo 'here';
    } 
    public function ipn(){
        
       $request = file_get_contents('php://input');
        $rrr=json_encode($_POST);
	    $arr['remark']=$rrr;
	    //$arr['u_code']=1;
	    $this->db->insert('testing',$arr);
    } 
    
}