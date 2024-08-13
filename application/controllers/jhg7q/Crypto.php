<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Crypto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->payment_type =  "CRYPADD";
        // $this->api_key = "e7c8045bd5373dfe39d37b69e8182e22";

        $api_key = "325b5081c7d3317d1c7b6fe744a91a61"; //"329fa83f6589850e3adf2b5c8acb4f1c";//$this->conn->company_info('api_key');
        $api_key_trc = "7f0b9bbfe097f95261ca4c32c3f01708"; //$this->conn->company_info('api_key');
        $this->payment_type = "CRYPADD";
        $this->api_key = $api_key;
        $this->api_key_trc = $api_key_trc;

    }

    public function check()
    {
        $url = "https://test.eracom.in/sendcryp/";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "Content-Type: application/x-www-form-urlencoded",
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = http_build_query([
            "api_key" => $this->api_key,
            "action" => "get_payment",
            "payment_id" => 112,
        ]);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);

        print_R($result);

    }
    public function auto_approve_trx()
    {
        $type = $this->payment_type;
        $get_all_pending_paments = $this->conn->runQuery('*', 'transaction', " tx_type='$type' and status='0' ");
        if ($get_all_pending_paments) {
            foreach ($get_all_pending_paments as $payment_details) {
                $cryp_status = $payment_details->cryp_status;
                $u_code = $payment_details->u_code;
                $wallet_type = $payment_details->wallet_type;
                $amount = $payment_details->amount;
                $cryp_paymentId = $payment_details->cryp_paymentId;
                $url = "https://test.eracom.in/sendcryp/";
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $headers = [
                    "Content-Type: application/x-www-form-urlencoded",
                ];

                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                $data = http_build_query([
                    "api_key" => $this->api_key_trc,
                    "action" => "get_payment",
                    "payment_id" => $cryp_paymentId,
                ]);

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                $result = json_decode(curl_exec($curl), true);
                curl_close($curl);

                //  print_R($result);
                //die();
                if ($result['success'] == true) {
                    $ary = array();
                    if ($result['status'] == 'expired') {
                        $ary['status'] = 3;
                        $ary['approveData'] = json_encode($result);
                        $ary['cryp_status'] = $result['status'];
                        $ary['updated_on'] = date('Y-m-d H:i:s');
                        $this->db->where('cryp_paymentId', $cryp_paymentId);
                        $this->db->update('transaction', $ary);
                    }

                    if ($result['status'] == 'paid') {

                        $ary['amount'] = $result['paidAmount'] + $result['fee'];
                        $ary['paidAmount'] = $result['paidAmount'] + $result['fee'];
                        $ary['approveData'] = json_encode($result);
                        $ary['status'] = 1;
                        $ary['cryp_status'] = $result['status'];
                        $ary['updated_on'] = date('Y-m-d H:i:s');

                        $ary['open_wallet'] = $this->update_ob->wallet($u_code, 'fund_wallet');
                        $ary['closing_wallet'] = $ary['open_wallet'] + $ary['amount'];

                        $this->db->where('cryp_paymentId', $cryp_paymentId);
                        $paid = $result['paidAmount'] + $result['fee'];
                        //$fee = $this->fee($paid);
                        $addable = $paid;

                        if ($this->db->update('transaction', $ary)) {
                            $this->update_ob->add_amnt($u_code, $wallet_type, $addable);
                        }
                    }
                }
            }
        }
    }

    public function auto_approve()
    {
        $type = $this->payment_type;
        $get_all_pending_paments = $this->conn->runQuery('*', 'transaction', " tx_type='$type' and status='0' ");
        if ($get_all_pending_paments) {
            foreach ($get_all_pending_paments as $payment_details) {
                $cryp_status = $payment_details->cryp_status;
                $u_code = $payment_details->u_code;
                $wallet_type = $payment_details->wallet_type;
                $amount = $payment_details->amount;
                $cryp_paymentId = $payment_details->cryp_paymentId;
                $url = "https://test.eracom.in/sendcryp/";
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $headers = [
                    "Content-Type: application/x-www-form-urlencoded",
                ];

                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                $data = http_build_query([
                    "api_key" => $this->api_key,
                    "action" => "get_payment",
                    "payment_id" => $cryp_paymentId,
                ]);

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                $result = json_decode(curl_exec($curl), true);
                curl_close($curl);

                //  print_R($result);
                //die();
                if ($result['success'] == true) {
                    $ary = array();
                    if ($result['status'] == 'expired') {
                        $ary['status'] = 3;
                        $ary['approveData'] = json_encode($result);
                        $ary['cryp_status'] = $result['status'];
                        $this->db->where('cryp_paymentId', $cryp_paymentId);
                        $this->db->update('transaction', $ary);
                    }

                    if ($result['status'] == 'paid') {

                        $ary['paidAmount'] = $result['paidAmount'] + $result['fee'];
                        $ary['approveData'] = json_encode($result);
                        $ary['status'] = 1;
                        $ary['cryp_status'] = $result['status'];
                        $this->db->where('cryp_paymentId', $cryp_paymentId);
                        $paid = $result['paidAmount'] + $result['fee'];
                        //$fee = $this->fee($paid);
                        $addable = $paid;

                        if ($this->db->update('transaction', $ary)) {
                            $this->update_ob->add_amnt($u_code, $wallet_type, $addable);
                        }
                    }
                }
            }
        }
    }

    public function fee($amnt)
    {
        /*if($amnt<200){
        return 1;
        }else{
        return $amnt*0.5/100;
        }*/
        return 0;
    }

    public function add_fund_expire()
    {

        if (isset($_GET['id'])) {

            $txid = $_GET['id'];
            // die();
            $trsac_detail = $this->conn->runQuery('*', 'transaction', "cryp_paymentId='$txid' and tx_type='CRYPADD' ");
            if ($trsac_detail) {
                $amts = $trsac_detail[0]->amount;
                $u_code = $this->session->userdata('user_id');
                $type = $this->payment_type;
                $url = "https://test.eracom.in/sendcryp/";
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $headers = [
                    "Content-Type: application/x-www-form-urlencoded",
                ];

                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                $data = http_build_query([
                    "api_key" => $this->api_key,
                    "action" => "review_transaction",
                    "txId" => $txid,
                ]);

                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                $result = json_decode(curl_exec($curl), true);
                curl_close($curl);
                // print_R($result);
                //die();
                if ($result['success'] == true) {

                    $this->session->set_flashdata("success", "Transaction Review Successfully");

                    $ary = array();
                    $ary['status'] = 0;
                    $ary['cryp_status'] = "";
                    $this->db->where('cryp_paymentId', $txid);
                    if ($this->db->update('transaction', $ary)) {

                    }

                } else {
                    $this->session->set_flashdata("error", "Request can not be submitted.");
                }
                ?>
          <script>window.location.href = 'https://follicleglobal.com/user/fund/add-fund-history';</script>
     <?php
//redirect(base_url(uri_string()));
                //$this->show->user_panel('fund/add-fund-history');

            } else {
                $this->session->set_flashdata("error", "Invalid Transaction Id");
                ?>
          <script>window.location.href = 'https://follicleglobal.com/user/fund/add-fund-history';</script>
     <?php
}

        } else {
            $this->session->set_flashdata("error", "Invalid Request");
            ?>
          <script>window.location.href = 'https://follicleglobal.com/user/fund/add-fund-history';</script>
     <?php
}

    }

    public function add_fund()
    {
        //$input_data = $this->conn->get_input();
        $type = $this->payment_type;
        if (isset($_POST['u_id'])) {
            //$this->form_validation->set_data($_POST);
            $crncy = $this->conn->company_info('currency');
            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
            if ($this->form_validation->run() != false) {
                $u_code = $u_Code = $_POST['u_id'];
                $amnt = abs($_POST['amount']);
                $fee = 0; //$this->fee($amnt);
                $payable = $amnt + $fee;

                $payment_type = $_POST['payment_type'];

                if ($payment_type == 'BEP20') {
                    $url = "https://test.eracom.in/sendcryp/";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                    $headers = [
                        "Content-Type: application/x-www-form-urlencoded",
                    ];

                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                    $data = http_build_query([
                        "api_key" => $this->api_key,
                        "action" => "create_payment",
                        "payment_amount" => $payable,
                        "token" => "USDT-BEP20",
                        "network" => "BSC",
                    ]);

                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

                    $result = json_decode(curl_exec($curl), true);
                    curl_close($curl);

                } else {
                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://test.eracom.in/sendcryp/',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => 'api_key=' . $this->api_key_trc . '&action=create_payment&payment_amount=' . $payable . '&token=USDT-TRC20&network=tron',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/x-www-form-urlencoded',
                        ),
                    ));

                    $result = json_decode(curl_exec($curl), true);

                    curl_close($curl);
                }

                if ($result['success'] == true) {
                    $inserttrans['wallet_type'] = 'fund_wallet';
                    $inserttrans['tx_type'] = $type;
                    $inserttrans['payment_type'] = 'crypto';
                    $inserttrans['cripto_type'] = "USDT";
                    // $inserttrans['cripto_address']=$result;

                    $inserttrans['debit_credit'] = "credit";
                    $inserttrans['u_code'] = $u_code;
                    $inserttrans['amount'] = $amnt;
                    $inserttrans['tx_charge'] = $fee;
                    $inserttrans['txs_res'] = json_encode($result);

                    $inserttrans['date'] = date('Y-m-d H:i:s');
                    $inserttrans['status'] = 0;

                    $inserttrans['remark'] = "fund Request $crncy $amnt";

                    $inserttrans['cryp_status'] = $result['status'];
                    $inserttrans['cryp_paymentId'] = $result['paymentId'];
                    $inserttrans['cryp_paymentAmount'] = $result['paymentAmount'];
                    $inserttrans['cryp_paymentWallet'] = $result['paymentWallet'];
                    $currss = date('Y-m-d H:i:s');
                    $inserttrans['cryp_expiryDate'] = date('Y-m-d  H:i:s', strtotime("+5 minutes", strtotime($currss))); //$result['expiryDate'];

                    if ($this->db->insert('transaction', $inserttrans)) {

                        $check_exists = $this->conn->runQuery('*', 'transaction', "u_code='$u_code' and tx_type='$type' and status='0'");

                        if ($check_exists) {
                            $res['address11'] = $result;
                            $smsg = "Send full amount to give address before " . $result['expiryDate'];
                            $res['res'] = 'success';
                            $res['amount'] = $check_exists[0]->cryp_paymentAmount;
                            $res['address'] = $check_exists[0]->cryp_paymentWallet;

                            $res['message'] = $smsg;
                        }
                    } else {
                        $res['res'] = 'error';
                        $res['amount'] = "";
                        $res['address'] = "";
                        $res['message'] = "Something Wrong.";
                    }
                }
            }

        } else {
            $res['res'] = 'error';
            $res['amount'] = "";
            $res['address'] = "";
            $res['message'] = "Invalid Userid.";
        }

        print_r(json_encode($res));
    }

    public function check_transaction()
    {
        //$crncy=$this->conn->company_info('currency');

        $sts = true;
//         $days_allowed=$this->conn->setting('fund_days');
        //         if($days_allowed){
        //             $daysjson_decode=json_decode($days_allowed);
        //             if(in_array(date('l'),$daysjson_decode)){

//             $wd_start_time=$this->conn->setting('fund_days_start_time');
        //             $str_time=date('H:i:s',strtotime($wd_start_time));
        //             $wd_end_time=$this->conn->setting('fund_days_end_time');
        //             $end_time=date('H:i:s',strtotime($wd_end_time));
        //             $nw_tm=date('H:i:s');
        //             if($nw_tm>=$str_time  && $nw_tm<$wd_end_time){
        //               $sts=true;
        //             }else{
        //                 $sts=false;
        //             }
        //             }else{
        //               $sts=false;
        //             }
        //         }else{
        //           $sts=false;
        //         }

        $investment_conditions = "Fund Status Active";
        $res['fund_message'] = $investment_conditions;
        $res['fund_status'] = $sts;

        //$input_data = $this->conn->get_input();
        $type = $this->payment_type;
        if (isset($_POST['u_id'])) {
            // $this->form_validation->set_data($input_data);
            $u_code = $u_Code = $_POST['u_id'];
            $check_exists = $this->conn->runQuery('*', 'transaction', "u_code='$u_code' and tx_type='$type' and status='0' order by id desc limit 1");

            if ($check_exists) {
                $daysss = $check_exists[0]->cryp_expiryDate;
                $addedss = $check_exists[0]->date;
                //  $global_dts=$check_exists[0]->global_dt;
                $amnt = $check_exists[0]->amount;
                $tx_charge = $check_exists[0]->tx_charge;
                $payable = $amnt + $tx_charge;
                $effectiveDate = date('Y-m-d  H:i:s', strtotime("+5 minutes", strtotime($addedss)));
                $global_effectiveDate = date('Y-m-d  H:i:s', strtotime("+5 minutes", strtotime($daysss)));
                $smsg = "You have to Pay  $payable $crncy to given address before " . $effectiveDate . " and $tx_charge $crncy Extra fees will be charged.";
                // $smsg="Send full amount to give address before $effectiveDate";
                $res['res'] = 'success';
                $res['amount'] = $check_exists[0]->cryp_paymentAmount;
                $res['address'] = $check_exists[0]->cryp_paymentWallet;
                $res['message'] = $smsg;

                //$currentDatetime = date('Y-m-d  H:i:s');

                // Add 10 minutes to the current time
                //$effectiveDate = date('Y-m-d H:i:s', strtotime($currentDatetime) + 200);
                $res['expiryDate'] = $effectiveDate;
                // $res['timer']=$effectiveDate;
                $res['global_timer'] = $global_effectiveDate;
                // $res['show_qr']="yes";
                $currentTime = strtotime("now");
                $effectiveTime = strtotime($effectiveDate);
                if ($currentTime >= $effectiveTime) {
                    $res['show_qr'] = 'no';
                } else {
                    $res['show_qr'] = 'yes';
                }
            } else {
                $res['res'] = 'success';
                $res['amount'] = "";
                $res['address'] = "";
                $res['message'] = "";
                $res['timer'] = "";
                $res['show_qr'] = "no";
                $res['global_timer'] = "";
            }
        }
        print_r(json_encode($res));
    }

    public function min_deposit_limit($str)
    {
        $min_transfer_limit = $this->conn->setting('min_deposit_limit');
        $max_transfer_limit = $this->conn->setting('max_deposit_limit');

        if (is_numeric($str) && $str >= $min_transfer_limit && $str <= $max_transfer_limit) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('min_deposit_limit', "Amount should be minimum $min_transfer_limit $curr and maximum $max_transfer_limit");
            return false;
        }
    }

    public function create_payment()
{
    $payment_id = rand(111111, 99999999);

    $u_code =1;// $this->input->post('u_id');
    $amount =100; $this->input->post('amount');

    if (isset($u_code) && !empty($amount)) {

        $currency1 = 'USD';
        $currency2 = 'USD';
        $private_key = $this->conn->company_info('coinpayment_private_key');
        $public_key = $this->conn->company_info('coinpayment_public_key');
        $this->load->library('coinpayment');
        $cps = $this->coinpayment->load($private_key, $public_key);

        $req = array(
            'amount' => $amount,
            'currency1' => $currency1,
            'currency2' => $currency2,
            'buyer_email' => "gouravbawa377@gmail.com",
            'item_name' => "$payment_id payment",
            'address' => '',
            'ipn_url' => base_url() . 'user/callback/payment_coinpayment',
        );

        $result = $cps->CreateTransaction($req);
print_r($result);
exit;
        if ($result['error'] == 'ok') {
            $tx_amnt = $result['result']['amount'];
            $payable = $amount;
            $txchrg = 0;
            $tx__id = $result['result']['txn_id'];

            $txs_res = json_encode($result);
            $rr = array(
                'u_code' => $u_code,
                'tx_type' => 'pay_by_coinpayments',
                'amount' => $tx_amnt,
                'tx_charge' => $txchrg,
                'wallet_type' => 'fund_wallet',
                'status' => 0,
                'txs_res' => $txs_res,
                'debit_credit' => 'credit',
                'tx_record' => $tx__id,
                'payment_id' => $payment_id
            );
            $this->db->insert('transaction', $rr);

            $data_page = array(
                'status_url' => $result['result']['status_url'],
                'txn_address' => $result['result']['address'],
                'checkout_url' => $result['result']['checkout_url'],
                'qrcode_url' => $result['result']['qrcode_url'],
                'tx_amount' => $tx_amnt,
                'amount' => $tx_amnt,
                'payable' => $payable,
                'currency' => $currency1,
                'currency2' => $currency2,
            );
            $res = $data_page;
        } else {
            $res['res'] = 'error';
            $res['message'] = "Transaction creation failed: " . $result['error'];
        }

    } else {
        $res['res'] = 'error';
        $res['message'] = "Invalid UserId or Amount.";
    }
    print_r(json_encode($res));
}

}