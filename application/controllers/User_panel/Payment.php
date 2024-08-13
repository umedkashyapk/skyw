<?php
class Payment extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_account(){ 
        $u_code=$this->session->userdata('user_id');
        
        if($_REQUEST['default']){
            $default=$_GET['default']-1;
            $update=array();
            $update['default_account']=$default;
            $this->db->where('u_code',$u_code);
            $this->db->update('user_payment_methods',$update);
            redirect(base_url(uri_string()));
        }
        if($_REQUEST['delete']){
            $default=$_GET['delete']-1;
            $check_user_account=$this->conn->runQuery('*','user_payment_methods',"u_code='$u_code'");
            if($check_user_account){
                    //$acc=array();
                    $accnts=$check_user_account[0]->accounts!='' ? json_decode($check_user_account[0]->accounts,true):array();
                    $update=array();
                    
                    unset($accnts[$default]);
                     
                    $update['accounts']=json_encode($accnts);
                    $this->db->where('u_code',$u_code);
                    $this->db->update('user_payment_methods',$update);
                
            }
            
            
            redirect(base_url(uri_string()));
        }
        
        if(isset($_POST['add_btn'])){
            
            $account_with_otp=$this->conn->setting('account_with_otp');
            if($account_with_otp=='yes'){
                $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
            }
            $this->form_validation->set_rules('account_type', 'Account type', 'required');
            
            $payment_type=$_POST['account_type'];
            $method_details_arr=$this->conn->runQuery('*','company_payment_methods',"status='1' and unique_name='$payment_type'");
            $method_details=$method_details_arr && $method_details_arr[0]->fields_required!='' ? json_decode($method_details_arr[0]->fields_required,true) :false;
            if($method_details){
                foreach($method_details as $_key=>$method_detail){
                    $this->form_validation->set_rules("account[$_key]", $method_detail, '');
                }
                
            }
           // $params['upload_path']= 'users'; 
           // $upload_pic=$this->upload_file->upload_image('img',$params);
            // && $upload_pic['upload_error']==false
            if($this->form_validation->run() != False ){
                
                $check_user_account=$this->conn->runQuery('*','user_payment_methods',"u_code='$u_code'");
                
                if($check_user_account){
                    //$acc=array();
                    $acc=$check_user_account[0]->accounts!='' ? json_decode($check_user_account[0]->accounts,true):array();
                    $account_details=$_POST['account'];
                    $account_details['account_type']=$_POST['account_type'];
                    $acc[]=$account_details;
                    
                    $update=array();
                   // $update['img'] = base_url().'images/users/'.$upload_pic['file_name'];
                    
                    $update['accounts']=json_encode($acc);
                    $update['default_account']=0;
                    
                    $this->db->where('u_code',$u_code);
                    $this->db->update('user_payment_methods',$update);
                  /* echo $this->db->last_query();
                   die();*/
                }else{
                    
                    
                    $acc=array();
                    $account_details=$_POST['account'];
                    $account_details['account_type']=$_POST['account_type'];
                    $acc[]=$account_details;
                    
                    $update=array();
                    //$update['img'] = base_url().'images/users/'.$upload_pic['file_name'];
                    $update['accounts']=json_encode($acc);
                    $update['u_code']=$u_code;
                    $this->db->insert('user_payment_methods',$update);
                    
                }
                
            }
        }
        $this->show->user_panel('payment_section/payment_methods');
    }
    
    
    
    public function get_section(){         
        $data['payment_type']=$payment_type=$_POST['acc_type'];
        
        $panel_directory=$this->conn->company_info('panel_directory');
        $this->load->view($panel_directory.'/pages/payment_section/payment_section',$data);
        
    }
    
    public function pay(){
        
        $session_data['payment_id']=1;
        $session_data['receiving_method']='receiving_add_fund_methods';
        $this->session->set_userdata('payment_data',$session_data);
        
        $u_code=$this->session->userdata('user_id');
        $gen_method_types='receiving_add_fund_methods';// use from session
        $get_data=$this->conn->setting($gen_method_types);
        $data['methods']=json_decode($get_data,true);
        
        //////////////////// main wallet section /////////////
        $payment_details=$this->session->userdata('payment_data');
        $payment_id=$payment_details['payment_id'];
        
        if(isset($_POST['main_wallet_submit'])){
            $wlt_type='main_wallet';
            
            $get_data=$this->conn->runQuery('*','capture_payments',"id='$payment_id'");
            if($get_data && $get_data[0]->payment_status==0){
               $trx_data=json_decode($get_data[0]->data,true);
                $tx_amnt=$trx_data['amount'];
                $my_wallet_balance=$this->update_ob->wallet($u_code,$wlt_type);
                if($my_wallet_balance>=$tx_amnt){
                    $this->update_ob->add_amnt($u_code,$wlt_type,-$tx_amnt);
                    $ress=$this->payment->payment_success($payment_id);
                    if($ress===true){
                        
                    }else{
                        $this->update_ob->add_amnt($u_code,$wlt_type,$tx_amnt);
                        ////////// unable to action //////
                    }
                }else{
                    ////// insuficient fund error //////
                    $this->session->set_flashdata('error',' Insufficient Balance.');
                    //$this->session->set_flashdata('error',"Insufficient Balance.");
                    $this->show->user_panel('payment_section/receiving_pay',$data);
                }
            }else{
                
            }
        }
        //////////////////// fund wallet section /////////////
        
        if(isset($_POST['fund_wallet_submit'])){
            $wlt_type='fund_wallet';
            
            $get_data=$this->conn->runQuery('*','capture_payments',"id='$payment_id'");
            if($get_data && $get_data[0]->payment_status==0){
               $trx_data=json_decode($get_data[0]->data,true);
                $tx_amnt=$trx_data['amount'];
                $my_wallet_balance=$this->update_ob->wallet($u_code,$wlt_type);
                if($my_wallet_balance>=$tx_amnt){
                    $this->update_ob->add_amnt($u_code,$wlt_type,-$tx_amnt);
                    $ress=$this->payment->payment_success($payment_id);
                    if($ress===true){
                        
                    }else{
                        $this->update_ob->add_amnt($u_code,$wlt_type,$tx_amnt);
                        ////////// unable to action //////
                    }
                }else{
                    ////// insuficient fund error //////
                    $this->session->set_flashdata('error',' Insufficient Balance.');
                    $this->show->user_panel('payment_section/receiving_pay',$data);
                }
            }else{
                
            }
        }
        
        
        //////////////////// coinpayment section /////////////
        if(isset($_POST['coinpayments_submit'])){
            
            $currency1='USD';
            
            $this->form_validation->set_rules('coinpayments', 'Coinpayment', 'required');
            if($this->form_validation->run() != False){
                $get_data=$this->conn->runQuery('*','capture_payments',"id='$payment_id'");
                
                $this->load->library('coinpayment');
                
                $private_key= $this->conn->company_info('coinpayment_private_key');
                $public_key=  $this->conn->company_info('coinpayment_public_key');
                $cps = $this->coinpayment->load($private_key,$public_key);
                
                $currency2=$_POST['coinpayments'];
                if($get_data && $get_data[0]->payment_status==0){
                    $trx_data=json_decode($get_data[0]->data,true);
                    $tx_amnt=$trx_data['amount'];
                
                    $req = array(
                		'amount' => $tx_amnt,
                		'currency1' => $currency1,
                		'currency2' => $currency2,
                		'buyer_email' => $this->conn->company_info('company_email'),
                		'item_name' => "$payment_id payment",
                		'address' => '', // leave blank send to follow your settings on the Coin Settings page
                		'ipn_url' => base_url().'user/callback/payment_coinpayment',
                	);
                	
                	$result = $cps->CreateTransaction($req);
                	
                	if ($result['error'] == 'ok') {
                	   
                	    $payable=$tx_amnt;
                	    $txchrg=0;
                	    
                	    $tx__id=$result['result']['txn_id'];
            		
                		$txs_res=json_encode($result);
                		$rr['u_code']=$u_code;
                		$rr['tx_type']='pay_by_coinpayments';
                		$rr['amount']=$tx_amnt;
                		$rr['tx_charge']=$txchrg;
                		$rr['wallet_type']='fund_wallet';
                		$rr['status']=0;
                		$rr['txs_res']=$txs_res;
                		$rr['debit_credit']='credit';
                		$rr['tx_record']=$tx__id;
                		$rr['payment_id']=$payment_id;
                		$this->db->insert('transaction',$rr);
                		
                		$data_page['status_url']=$result['result']['status_url'];
                	    $data_page['txn_address']=$result['result']['address'];
                	    $data_page['checkout_url']=$result['result']['checkout_url'];
                	    $data_page['qrcode_url']=$result['result']['qrcode_url'];
                	    $data_page['tx_amount']=$result['result']['amount'];
                	    $data_page['amount']=$tx_amnt;
                	    $data_page['payable']=$payable;
                	    $data_page['currency']=$currency1;
                	    $data_page['currency2']=$currency2;
                	    
                		$this->show->user_panel('payment_section/receiving_pay_coinpaymnts',$data_page);
                		 
                	}
                	
                }
            }
        }
        
        
        if(empty($_POST)){
            $this->show->user_panel('payment_section/receiving_pay',$data);
        }
        
        
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
    
    
}