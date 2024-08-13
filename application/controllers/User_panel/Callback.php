<?php
class Callback extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function payment_coinpayment(){
        	$cp_merchant_id = $this->conn->company_info('coinpayment_merchant_id');
            $cp_ipn_secret = $this->conn->company_info('coinpayment_ipn_secret');  
            
            $request = file_get_contents('php://input');
            $rrr=json_encode($_POST);
    	    $arr['remark']=$rrr.'payment_coinpayment';
    	    //$arr['u_code']=1;
    	    $this->db->insert('testing',$arr);
    	     if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
                $this->errorAndDie('No or incorrect Merchant ID passed');
            }
            
            $txn_id = $_POST['txn_id'];
            $get_tr_data=$this->conn->runQuery('*','transaction',"tx_type='pay_by_coinpayments' and tx_record='$txn_id' and status='0'");
            if($get_tr_data){
                $tr_data=$get_tr_data[0];
                $status = intval($_POST['status']);
                $update=array();
                
                if ($status >= 100 || $status == 2) {
                    
                    $payment_id=$tr_data->payment_id;
                    $ress=$this->payment->payment_success($payment_id);
                    if($ress===true){
                        $update['status']=1;
                        $update['api_response']=$rrr;
                        $this->db->where('status','0');
                        $this->db->where('tx_record',$txn_id);
                        $this->db->update('transaction',$update);
                    }
                    // else{
                    //     $ress=$this->payment->payment_cancel($payment_id);
                    // }
                    
                }
                
            }
    	    die('IPN OK');
    }
    
    public function payment_withdrawal(){
        $cp_merchant_id = $this->conn->company_info('coinpayment_merchant_id');
        $cp_ipn_secret = $this->conn->company_info('coinpayment_ipn_secret');  
        
        $request = file_get_contents('php://input');
        $rrr=json_encode($_POST);
        $arr['remark']=$rrr.'payment_withdrawal';
        //$arr['u_code']=1;
        $this->db->insert('testing',$arr);
         if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
            $this->errorAndDie('No or incorrect Merchant ID passed');
        }
        
        $txn_id = $_POST['txn_id'];
        $get_tr_data=$this->conn->runQuery('*','transaction',"tx_type='withdrawal_by_coinpayments' and tx_record='$txn_id' and status='0'");
        if($get_tr_data){
            $tr_data=$get_tr_data[0];
            $status = intval($_POST['status']);
            $update=array();
            
            if ($status >= 100 || $status == 2) {
                
                $payment_id=$tr_data->payment_id;
                $ress=$this->payment->payment_success($payment_id);
                if($ress===true){
                    $update['status']=1;
                    $update['api_response']=$rrr;
                    $this->db->where('status','0');
                    $this->db->where('tx_record',$txn_id);
                    $this->db->update('transaction',$update);
                }
            }
        }
        die('IPN OK');
}


    public function coinpayment(){
	    
	    $cp_merchant_id = $this->conn->company_info('coinpayment_merchant_id');
        $cp_ipn_secret = $this->conn->company_info('coinpayment_ipn_secret');      
        
        $request = file_get_contents('php://input');
        $rrr=json_encode($_POST);
	    $arr['remark']=$rrr;
	    //$arr['u_code']=1;
	    $this->db->insert('testing',$arr);
	    
        if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
            $this->errorAndDie('No or incorrect Merchant ID passed');
        }
        
        $txn_id = $_POST['txn_id'];
        $get_tr_data=$this->conn->runQuery('*','transaction',"tx_type='btc_added' and tx_record='$txn_id' and status='0'");
        if($get_tr_data){
            $tr_data=$get_tr_data[0];
            $status = intval($_POST['status']);
            $update=array();
            
            if ($status >= 100 || $status == 2) {
                
                $u_cde=$tr_data->u_code;
                $amnt=$tr_data->amount;
                $update['status']=1;
                $update['api_response']=$rrr;
                 $this->db->where('status','0');
                 $this->db->where('tx_record',$txn_id);
                 $this->db->update('transaction',$update);
                 $this->update_ob->add_amnt($u_cde,'fund_wallet',$amnt);
                 
            } else if ($status < 0) {
                 
                //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
            } else {
                //payment is pending, you can optionally add a note to the order page
            }
            
            
        }
        
       /* 
        if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
            $this->errorAndDie('IPN Mode is not HMAC');
        }
    
        if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
            $this->errorAndDie('No HMAC signature sent.');
        }
    
        $request = file_get_contents('php://input');
        if ($request === FALSE || empty($request)) {
            $this->errorAndDie('Error reading POST data');
        }
    
        if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
            $this->errorAndDie('No or incorrect Merchant ID passed');
        }
    
        $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
        if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
        //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
            $this->errorAndDie('HMAC signature does not match');
        }
    
        // HMAC Signature verified at this point, load some variables.
    
        $ipn_type = $_POST['ipn_type'];
        $txn_id = $_POST['txn_id'];
        $item_name = $_POST['item_name'];
        $item_number = $_POST['item_number'];
        $amount1 = floatval($_POST['amount1']);
        $amount2 = floatval($_POST['amount2']);
        $currency1 = $_POST['currency1'];
        $currency2 = $_POST['currency2'];
        $status = intval($_POST['status']);
        $status_text = $_POST['status_text'];*/
    
        /*if ($ipn_type != 'button') { // Advanced Button payment
            die("IPN OK: Not a button payment");
        }*/
    
        //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point
    
        // Check the original currency to make sure the buyer didn't change it.
       /* if ($currency1 != $order_currency) {
            $this->errorAndDie('Original currency mismatch!');
        }
    
        // Check amount against order total
         if ($amount1 < $order_total) {
            $this->errorAndDie('Amount is less than order total!');
        } 
     
        if ($status >= 100 || $status == 2) {
            // payment is complete or queued for nightly payout, success
             
        } else if ($status < 0) {
             
            //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
        } else {
            //payment is pending, you can optionally add a note to the order page
        }
        
        $rrr=json_encode($_REQUEST);
	    $arr['remark']=$rrr;
	    $arr['u_code']=$status;
	    $this->db->insert('testing',$arr);*/
	    
        die('IPN OK');
	    
	    
        
    }
    
    public function errorAndDie($error_msg) {
        /*global $cp_debug_email;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($_POST as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
        }*/
        die('IPN Error: '.$error_msg);
    }
    
}