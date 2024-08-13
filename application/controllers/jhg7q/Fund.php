<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
// header("Access-Control-Allow-Headers: X-Requested-With");
class Fund extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->limit = 20;
        $key_data2 = $this->conn->runQuery('*', 'api_key', "key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
        // $this->payment_type =  "CRYPADD";
        // $this->api_key = "e7c8045bd5373dfe39d37b69e8182e22323232332";

        $api_key = "325b5081c7d3317d1c7b6fe744a91a61"; //"329fa83f6589850e3adf2b5c8acb4f1c";//$this->conn->company_info('api_key');
        $api_key_trc = "7f0b9bbfe097f95261ca4c32c3f01708"; //$this->conn->company_info('api_key');
        $this->payment_type =  "CRYPADD";
        $this->api_key = $api_key;
        $this->api_key_trc = $api_key_trc;


        if (!array_key_exists('token', $this->input->request_headers())) {


            $data['status'] = false;
            $data['tokenStatus'] = false;
            $data['message'] = "Invalid Token.";
            // print_r(json_encode($data));
            // die();
        } else {
            // $sdfg   = $this->input->request_headers()['token'];
            $sdfg = $this->input->get_request_header('token', TRUE);
            $this->user_id =  $this->token->userByToken($sdfg);
        }
    }


    public function fund_history()
    {

        $sdfg = $this->input->get_request_header('token', TRUE);
        //$sdfg   = $this->input->request_headers()['token'];
        $u_id =  $this->token->userByToken($sdfg);
        if ($u_id) {

            if (isset($_POST['init_val']) && isset($_POST['type'])) {
                $lmt = $this->limit;
                $type = $_POST['type'];

                $start_from = $_POST['init_val'];
                if ($type == 'transfer') {


                    if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                        $spo = $this->profile->column_like($_REQUEST['name'], 'name');
                        $arr = implode(',', $spo);

                        if ($spo) {
                            $where = " and tx_u_code IN ($arr)";
                        }
                    }
                    if (isset($_REQUEST['username']) && $_REQUEST['username'] != '') {
                        $spo = $this->profile->column_like($_REQUEST['username'], 'username');
                        $arr = implode(',', $spo);

                        if ($spo) {
                            $where = " and tx_u_code = '$arr'";
                        }
                    }

                    if (isset($_REQUEST['debit_credit']) && $_REQUEST['debit_credit'] != 'all') {
                        $creadur = $_REQUEST['debit_credit'];
                        $where = " and debit_credit = '$creadur'";
                    }

                    if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date'] != '' && $_REQUEST['end_date'] != '') {
                        $start_date = date('Y-m-d 00:00:00', strtotime($_REQUEST['start_date']));
                        $end_date = date('Y-m-d 23:59:00', strtotime($_REQUEST['end_date']));
                        $where = " and (date BETWEEN '$start_date' and '$end_date')";
                    }

                    $Fund_transfer = $this->conn->runQuery('*', 'transaction ', "u_code = '$u_id' and tx_type='transfer' and status='1' $where order by id desc");

                    $total_txn = $this->conn->runQuery('COUNT(id) as ids', 'transaction ', "u_code = '$u_id' and tx_type='transfer' and status='1' $where")[0]->ids;
                    $ins_val = $start_from;

                    $ttlcnt = 0;

                    if ($Fund_transfer) {

                        foreach ($Fund_transfer as $txn_details) {
                            $ttlcnt++;

                            $details = json_decode(json_encode($txn_details), true);

                            if ($details['u_code'] != '') {

                                $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'], 'username')->username;
                            } else {
                                $details['tx_to_ucode'] = '';
                            }

                            if ($details['tx_u_code'] != '') {
                                $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'], 'username')->username;
                                $details['tx_from_name'] = $this->profile->profile_info($details['tx_u_code'], 'name')->name;
                                // print_r($this->db->last_query());
                                // die();
                            } else {
                                $details['tx_from_ucode'] = '';
                                $details['tx_from_name'] = '';
                            }
                            $data[] = $details;
                            $ins_val++;
                        }

                        $res['res'] = 'success';
                        $res['tokenStatus'] = 'true';
                        $res['data'] = $data;
                        $res['total_count'] = $total_txn;
                        $res['message'] = "";



                        //  $res['res'] ='success';
                        //         $res['tokenStatus'] ='true';
                        //         $res['data']= $Fund_transfer;
                    } else {


                        $res['total_count'] = 0;
                        $res['total_earning'] = 0;
                        $res['data'] = array();
                        $res['message'] = "No data found";
                    }

                    $res['start_from'] = $start_from;
                    $res['prev_page'] = $start_from > 0 ? 'yes' : 'no';
                    $res['next_init_val'] = $ins_val;
                    $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
                    $res['res'] = 'success';
                } elseif ($type == 'convert_send') {

                    if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date'] != '' && $_REQUEST['end_date'] != '') {
                        $start_date = date('Y-m-d 00:00:00', strtotime($_REQUEST['start_date']));
                        $end_date = date('Y-m-d 23:59:00', strtotime($_REQUEST['end_date']));
                        $where = " and (date BETWEEN '$start_date' and '$end_date')";
                    }
                    $Fund_convert = $this->conn->runQuery('*', 'transaction ', "u_code = '$u_id' and tx_type='convert_receive' and status='1' $where");
                    $total_txn = $this->conn->runQuery('COUNT(id) as ids', 'transaction ', "u_code = '$u_id' and tx_type='convert_receive' and status='1' $where")[0]->ids;
                    $ins_val = $start_from;

                    $ttlcnt = 0;

                    if ($Fund_convert) {


                        foreach ($Fund_convert as $txn_details) {
                            $ttlcnt++;
                            $details = json_decode(json_encode($txn_details), true);

                            if ($details['u_code'] != '') {
                                $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'], 'username')->username;
                            } else {
                                $details['tx_to_ucode'] = '';
                            }

                            // if($details['tx_u_code']!=''){
                            //     $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                            //     $details['tx_from_name'] = $this->profile->profile_info($details['tx_u_code'],'name')->name;
                            // }else{
                            //     $details['tx_from_ucode'] = '';
                            //     $details['tx_from_name'] = '';
                            // }
                            $data[] = $details;
                            $ins_val++;
                        }

                        $res['res'] = 'success';
                        $res['tokenStatus'] = 'true';
                        $res['data'] = $data;
                        $res['total_count'] = $total_txn;
                        $res['message'] = "";
                    } else {


                        $res['total_count'] = 0;
                        $res['total_earning'] = 0;
                        $res['data'] = array();
                        $res['message'] = "No data found";
                    }

                    $res['start_from'] = $start_from;
                    $res['prev_page'] = $start_from > 0 ? 'yes' : 'no';
                    $res['next_init_val'] = $ins_val;
                    $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
                    $res['res'] = 'success';
                } else {
                    if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date'] != '' && $_REQUEST['end_date'] != '') {
                        $start_date = date('Y-m-d 00:00:00', strtotime($_REQUEST['start_date']));
                        $end_date = date('Y-m-d 23:59:00', strtotime($_REQUEST['end_date']));
                        $where = " and (date BETWEEN '$start_date' and '$end_date')";
                    }

                    $add_Fund_transfer = $this->conn->runQuery('*', 'transaction ', "u_code = '$u_id' and tx_type='CRYPADD' and status='0' $where");
                    $total_txn = $this->conn->runQuery('COUNT(id) as ids', 'transaction ', "u_code = '$u_id' and tx_type='CRYPADD' and status='0' $where")[0]->ids;
                    $ins_val = $start_from;

                    $ttlcnt = 0;
                    if ($add_Fund_transfer) {


                        foreach ($add_Fund_transfer as $txn_details) {
                            $ttlcnt++;
                            $details = json_decode(json_encode($txn_details), true);

                            if ($details['u_code'] != '') {
                                $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'], 'username')->username;
                            } else {
                                $details['tx_to_ucode'] = '';
                            }

                            // if($details['tx_u_code']!=''){
                            //     $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                            //     $details['tx_from_name'] = $this->profile->profile_info($details['tx_u_code'],'name')->name;
                            // }else{
                            //     $details['tx_from_ucode'] = '';
                            //     $details['tx_from_name'] = '';
                            // }
                            $data[] = $details;
                            $ins_val++;
                        }

                        $res['res'] = 'success';
                        $res['tokenStatus'] = 'true';
                        $res['data'] = $data;
                        $res['total_count'] = $total_txn;
                        $res['message'] = "";
                    } else {


                        $res['total_count'] = 0;
                        $res['total_earning'] = 0;
                        $res['data'] = array();
                        $res['message'] = "No data found";
                    }

                    $res['start_from'] = $start_from;
                    $res['prev_page'] = $start_from > 0 ? 'yes' : 'no';
                    $res['next_init_val'] = $ins_val;
                    $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
                    $res['res'] = 'success';
                }
            } else {

                $res['next_init_val'] = 0;
                $res['next_page'] = 'no';
                $res['prev_page'] = 'no';
                $res['res'] = 'error';
                $res['data'] = array();
                $res['message'] = "Invalid parameters.";
            }
        } else {
            $res['res'] = 'error';
            $res['tokenStatus'] = 'false';
            $res['message'] = 'Token Expired!';
        }

        print_r(json_encode($res));
    }

    public function add_fund()
    {
        $input_data = $this->conn->get_input();
        $type = $this->payment_type;
        if (isset($input_data['u_id'])) {
            $this->form_validation->set_data($input_data);
            $crncy = $this->conn->company_info('currency');
            $this->form_validation->set_rules('amount', 'Amount', 'required|greater_than[0]');
            if ($this->form_validation->run() != False) {
                $u_code = $u_Code = $input_data['u_id'];
                $amnt = abs($input_data['amount']);
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
                        "Content-Type: application/x-www-form-urlencoded"
                    ];

                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

                    $data = http_build_query([
                        "api_key" => $this->api_key,
                        "action" => "create_payment",
                        "payment_amount" => $payable,
                        "token" => "USDT-BEP20",
                        "network" => "tron"
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
                            'Content-Type: application/x-www-form-urlencoded'
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
                    $inserttrans['cryp_expiryDate'] = $result['expiryDate'];


                    if ($this->db->insert('transaction', $inserttrans)) {

                        $check_exists = $this->conn->runQuery('*', 'transaction', "u_code='$u_code' and tx_type='$type' and status='0'");

                        if ($check_exists) {
                            $smsg = "Send full amount to give address before " . $result['expiryDate'];
                            $res['res'] = 'success';
                            $res['address11'] = $result;
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

    ///////////////////////////////////////////////////

    public function cancel_withdraw()
    {
        if (isset($_POST['u_id']) && isset($_POST['trx_id'])) {
            $u_id = $_POST['u_id'];
            $trx_id = $_POST['trx_id'];


            $chk_exists = $this->conn->runQuery('*', 'transaction', "status=0 and id='$trx_id' and u_code='$u_id' and tx_type='withdrawal' ");
            if ($chk_exists) {
                $u_code = $chk_exists[0]->u_code;
                $amunt = $chk_exists[0]->amount;
                $tx_chg = $chk_exists[0]->tx_charge;
                $total_amt = $amunt + $tx_chg;
                $walet = $chk_exists[0]->wallet_type;
                $profile = $this->profile->profile_info($u_code);
                $set['status'] = 3;
                $set['reason'] = "by user";
                $this->db->where('id', $trx_id);
                $this->db->update('transaction', $set);

                $this->update_ob->add_amnt($u_id, $walet, $total_amt);
                $this->update_ob->add_amnt($u_id, 'total_withdrawal', -$total_amt);

                $company_name = $this->conn->company_info('title');
                $company_url = $this->conn->company_info('base_url');
                $sms = "Withrawal request cancel Successfully.";

                $msg['res'] = 'success';
                $msg['msg'] = $sms;
                // $this->message->send_mail_reg($profile->email,'Fund Request Rejected',$sms,$profile->username);


            } else {
                $msg['res'] = 'error';
                $msg['msg'] = 'transaction not exist';
            }
        } else {
            $msg['res'] = 'error';
            $msg['msg'] = 'invalid value!';
        }

        print_r(json_encode($msg));
    }














    //////////////////////////////////////////////////////////


    public function check_transaction()
    {


        $sts = false;
        $days_allowed = $this->conn->setting('fund_days');
        if ($days_allowed) {
            $daysjson_decode = json_decode($days_allowed);
            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('fund_days_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('fund_days_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time  && $nw_tm < $wd_end_time) {
                    $sts = true;
                } else {
                    $sts = false;
                }
            } else {
                $sts = false;
            }
        } else {
            $sts = false;
        }

        $investment_conditions = $this->conn->setting('fund_conditions');
        $res['fund_message'] = $investment_conditions;
        $res['fund_status'] = $sts;


        $input_data = $this->conn->get_input();
        $type = $this->payment_type;
        if (isset($input_data['u_id'])) {
            $this->form_validation->set_data($input_data);
            $u_code = $u_Code = $input_data['u_id'];
            $check_exists = $this->conn->runQuery('*', 'transaction', "u_code='$u_code' and tx_type='$type' and status='0'");

            if ($check_exists) {
                $daysss = $check_exists[0]->cryp_expiryDate;

                $smsg = "Send full amount to give address before $daysss";
                $res['res'] = 'success';
                $res['amount'] = $check_exists[0]->cryp_paymentAmount;
                $res['address'] = $check_exists[0]->cryp_paymentWallet;
                $res['message'] = $smsg;
                $res['show_qr'] = "yes";
            } else {
                $res['res'] = 'success';
                $res['amount'] = "";
                $res['address'] = "";
                $res['message'] = "";
                $res['show_qr'] = "no";
            }
        }
        print_r(json_encode($res));
    }

    public function get_wallet()
    {
        $sts = false;
        $days_allowed = $this->conn->setting('wd_days');
        if ($days_allowed) {
            $daysjson_decode = json_decode($days_allowed);
            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('wd_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('wd_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time  && $nw_tm < $wd_end_time) {
                    $sts = "true";
                } else {
                    $sts = "false";
                }
            } else {
                $sts = "false";
            }
        } else {
            $sts = "false";
        }

        $chk['withdrawal_status'] = $sts;
        $investment_conditions = $this->conn->setting('fund_conditions');
        $chk['fund_message'] = $investment_conditions;
        $chk['condition'] = $this->conn->setting('wd_conditions');
        $chk['withdrawal_status'] = $sts;
        $chk['wallet_type'] = $this->conn->runQuery("*", 'invest_wallet', "type='withdrawal'");
        $chk['wallet_amount'] = $this->conn->runQuery("*", 'invest_wallet', "type='withdrawal'");
        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function get_fund_time()
    {
        $sts = false;
        $days_allowed = $this->conn->setting('fund_days');
        if ($days_allowed) {
            $daysjson_decode = json_decode($days_allowed);
            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('fund_days_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('fund_days_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time  && $nw_tm < $wd_end_time) {
                    $sts = false;
                } else {
                    $sts = true;
                }
            } else {
                $sts = true;
            }
        } else {
            $sts = false;
        }


        $chk['fund_status'] = $sts;
        // $chk['wallet_type']= $this->conn->runQuery("*",'invest_wallet',"type='withdrawal'");
        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function get_transfer_wallet()
    {
        $u_id = $_POST['u_id'];
        $sts = false;
        $days_allowed = $this->conn->setting('fund_days');
        if ($days_allowed) {
            $daysjson_decode = json_decode($days_allowed);
            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('fund_days_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('fund_days_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time  && $nw_tm < $wd_end_time) {
                    $sts = true;
                } else {
                    $sts = false;
                }
            } else {
                $sts = false;
            }
        } else {
            $sts = false;
        }

        $investment_conditions = $this->conn->setting('fund_conditions');
        $chk['fund_message'] = $investment_conditions;
        $chk['fund_status'] = $sts;
        $chk['wallet_amount'] = $balance = $this->update_ob->wallet($u_id, 'fund_wallet');
        $chk['wallet_type'] = $this->conn->runQuery("*", 'invest_wallet', "type='transfer'");
        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function get_fd_month()
    {

        $chk['wallet_type'] = $this->conn->runQuery("*", 'fd_month', "status='1'");
        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function get_covert_wallet()
    {
        $investment_conditions = $this->conn->setting('fund_conditions');
        $sts = false;
        $days_allowed = $this->conn->setting('fund_days');
        if ($days_allowed) {
            $daysjson_decode = json_decode($days_allowed);
            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('fund_days_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('fund_days_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time  && $nw_tm < $wd_end_time) {
                    $sts = true;
                } else {
                    $sts = false;
                }
            } else {
                $sts = false;
            }
        } else {
            $sts = false;
        }


        $chk['fund_status'] = $sts;

        $chk['fund_message'] = $investment_conditions;
        $chk['wallet_to'] = $this->conn->runQuery("*", 'invest_wallet', "type='convert_wallet_to'");
        $chk['wallet_from'] = $this->conn->runQuery("*", 'invest_wallet', "type='convert_wallet_from'");

        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function convert()
    {
        //$input_data = $this->conn->get_input(); 
        if (isset($_POST['u_id'])) {

            $this->form_validation->set_data($_POST);
            $crncy = $this->conn->company_info('currency');

            $this->form_validation->set_rules('from_wallet', 'From Wallet', 'required|callback_check_from_wallet_useable|callback_check_wallet_balance');
            $this->form_validation->set_rules('to_wallet', 'To Wallet', 'required|callback_check_to_wallet_useable');
            $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_convert_balance|callback_min_convert_limit');

            if ($this->form_validation->run() != False) {

                $u_Code = $_POST['u_id'];
                $amnt = $debit_amnt = abs($_POST['amount']);
                $tx_amnt = $debit_amnt * 2 / 100;
                $credits = $debit_amnt - $tx_amnt;
                //if($input_data['from_wallet']=="main_wallet"){
                $credit = $credits;

                $date = date('Y-m-d H:i:s');
                //$collection_amnt=$debit_amnt*5/100;

                //$u_code_remark="You Converted $debit_amnt Trx from ".$input_data['from_wallet'].' to '.$input_data['to_wallet'];
                //$tx_u_code_remark="You received $credit Trx from fund convert";
                $collection_remark = "You received 5% from fund convert";

                $u_code_remark = "Fund Send from " . $_POST['from_wallet'] . ' to ' . $_POST['to_wallet'];
                $tx_u_code_remark = "Fund Receive from " . $_POST['from_wallet'] . ' to ' . $_POST['to_wallet'];
                $inserttrans = array(

                    array(
                        'wallet_type'  => $_POST['from_wallet'],
                        'tx_type'  => 'convert_send',
                        'debit_credit'  => 'debit',
                        'tx_u_code'  => $u_Code,
                        'u_code'  => $u_Code,
                        'amount'  => $credits,
                        'tx_charge'  => $tx_amnt,
                        'date'  => $date,
                        'status'  => 1,
                        'remark'  => $u_code_remark,
                    ),
                    array(
                        'wallet_type'  => $_POST['to_wallet'],
                        'tx_type'  => 'convert_receive',
                        'debit_credit'  => 'credit',
                        'tx_u_code'  => $u_Code,
                        'u_code'  => $u_Code,
                        'amount'  => $credits,
                        'tx_charge'  => 0,
                        'date'  => $date,
                        'status'  => 1,
                        'remark'  => $tx_u_code_remark,
                    )
                );

                if ($this->db->insert_batch('transaction', $inserttrans)) {
                    $this->update_ob->add_amnt($u_Code, $_POST['to_wallet'], $credit);
                    $this->update_ob->add_amnt($u_Code, $_POST['from_wallet'], -$debit_amnt);
                    //$this->update_ob->add_amnt($u_Code,'collection',$collection_amnt);
                    /////////////////////////////////////////////////////////////////////////////

                    //////////////////////////////////////////////////////////////////////////
                    $smsg = " Convert Successful. You Convert $amnt Trx";

                    $res['res'] = 'success';
                    $res['error_from_wallet'] = '';
                    $res['error_to_wallet'] = '';
                    $res['error_amount'] = '';
                    $res['main_wallet'] = $this->update_ob->wallet($u_Code, 'main_wallet');
                    $res['fund_wallet'] = $this->update_ob->wallet($u_Code, 'fund_wallet');


                    $res['message'] = $smsg;
                }
            } else {

                $res['res'] = 'error';
                $res['error_from_wallet'] = form_error('from_wallet');
                $res['error_to_wallet'] = form_error('to_wallet');
                $res['error_amount'] = form_error('amount');
                $res['message'] = "Something Wrong.";
            }
        } else {

            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }
        print_r(json_encode($res));
    }

    public function convert2()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {

            $this->form_validation->set_data($input_data);
            $crncy = $this->conn->company_info('currency');

            $this->form_validation->set_rules('from_wallet2', 'From Wallet', 'required|callback_check_from_wallet_useable2|callback_check_wallet_balance2');
            $this->form_validation->set_rules('to_wallet2', 'To Wallet', 'required|callback_check_to_wallet_useable2');
            $this->form_validation->set_rules('amount2', 'Amount', 'required|callback_check_convert_balance2');

            if ($this->form_validation->run() != False) {

                $u_Code = $input_data['u_id'];
                $amnt = $debit_amnt = abs($input_data['amount2']);
                $tx_amnt = 0; //$debit_amnt*10/100;
                $credit = $debit_amnt - $tx_amnt;
                $date = date('Y-m-d H:i:s');

                //$collection_amnt=$debit_amnt*5/100;

                $u_code_remark = "You convert $debit_amnt from " . $input_data['from_wallet2'] . ' to ' . $input_data['to_wallet2'];
                $tx_u_code_remark = "You recieve $credit from fund convert";
                $collection_remark = "You recieve 5% from fund convert";

                $inserttrans = array(

                    array(
                        'wallet_type'  => $input_data['from_wallet2'],
                        'tx_type'  => 'convert_send',
                        'debit_credit'  => 'debit',
                        'tx_u_code'  => $u_Code,
                        'u_code'  => $u_Code,
                        'amount'  => $credit,
                        'tx_charge'  => $tx_amnt,
                        'date'  => $date,
                        'status'  => 1,
                        'remark'  => $u_code_remark,
                    ),
                    array(
                        'wallet_type'  => $input_data['to_wallet2'],
                        'tx_type'  => 'convert_recieve',
                        'debit_credit'  => 'credit',
                        'tx_u_code'  => $u_Code,
                        'u_code'  => $u_Code,
                        'amount'  => $credit,
                        'tx_charge'  => 0,
                        'date'  => $date,
                        'status'  => 1,
                        'remark'  => $tx_u_code_remark,
                    )

                );

                if ($this->db->insert_batch('transaction', $inserttrans)) {
                    $this->update_ob->add_amnt($u_Code, $input_data['to_wallet2'], $credit);
                    $this->update_ob->add_amnt($u_Code, $input_data['from_wallet2'], -$debit_amnt);
                    //$this->update_ob->add_amnt($u_Code,'collection',$collection_amnt);

                    $smsg = " Convert Successful. You Convert $crncy $amnt";
                    $res['res'] = 'success';
                    $res['error_from_wallet'] = '';
                    $res['error_to_wallet'] = '';
                    $res['error_amount'] = '';
                    $res['message'] = $smsg;
                }
            } else {

                $res['res'] = 'error';
                $res['error_from_wallet'] = form_error('from_wallet2');
                $res['error_to_wallet'] = form_error('to_wallet2');
                $res['error_amount'] = form_error('amount2');
                $res['message'] = "Something Wrong.";
            }
        } else {

            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }

        print_r(json_encode($res));
    }
    public function transfer_enable_disable()
    {
        $status = $this->conn->setting('transfer_status');

        print_r(json_encode($status));
    }

    public function offset_wallet()
    {

        $u_id= $_POST["u_id"];
        if ($u_id) {
            $res=[];
            $offset_wallet = $this->update_ob->wallet($u_id,'offset');
            $profile = $this->profile->profile_info($u_id);
            $active_status = $profile->active_status;
            $res['res'] = 'success';
            $res['wallet'] = "Offset Wallet";
            $res['condition'] = "You can use only 20% offset wallet";
            $res['active_status'] = $active_status;
            $res['amount'] = $offset_wallet;
        }
        else{
            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }
        print_r(json_encode($res));
    }

    public function transfer()
    {

        $sdfg = $this->input->get_request_header('token', true);
        $u_id = $this->token->userByToken($sdfg);
        if ($u_id) {

            $this->form_validation->set_data($_POST);
            $crncy = $this->conn->company_info('currency');
            $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable');
            $this->form_validation->set_rules('tx_username', 'Username', 'required|callback_valid_username');
            $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_transfer_balance|greater_than[0]');
            $withdrawal_with_otp = $this->conn->setting('withdrawal_with_otp');
            if ($withdrawal_with_otp == 'yes') {
                $this->form_validation->set_rules('otp_input', 'OTP', 'required|trim|callback_check_otp_valid');
            }
            if ($this->form_validation->run() != False) {
                $u_id = $_POST['u_id'];
                $profile = $this->profile->profile_info($u_id);
                $username = $profile->username;
                $name = $profile->name;

                $tx_username = $_POST['tx_username'];
                $wallet_type = $_POST['selected_wallet'];
                $transfer = 'transfer';
                $tx_u_code = $this->profile->id_by_username($tx_username);
                $u_code = $u_id;
                $amnt = abs($_POST['amount']);
                $date = date('Y-m-d H:i:s');

                
                    $u_code_open_wallet = $this->update_ob->wallet($u_code, $wallet_type);
                    $u_code_closing_wallet = $u_code_open_wallet - $amnt;

                    $tx_u_code_open_wallet = $this->update_ob->wallet($tx_u_code, $wallet_type);
                    $tx_u_code_closing_wallet = $tx_u_code_open_wallet + $amnt;

                    $txuser = $check = $this->conn->runQuery('name', 'users', "id='$tx_u_code'");
                    $txname = $txuser[0]->name;
                    //$u_code_remark="$name ($username) sent fund $amnt Trx to $txname($tx_username)";
                    //$tx_u_code_remark="$txname($tx_username) receive fund $amnt Trx from $name ( $username )";

                    $u_code_remark = "Fund Sent to $txname ($tx_username)";
                    $tx_u_code_remark = "Fund Received From $name ($username )";

                    $inserttrans = array(
                        array(
                            'wallet_type'  => $wallet_type,
                            'tx_type'  => $transfer,
                            'debit_credit'  => 'debit',
                            'tx_u_code'  => $tx_u_code,
                            'u_code'  => $u_code,
                            'amount'  => $amnt,
                            'date'  => $date,
                            'status'  => 1,
                            'open_wallet'  => $u_code_open_wallet,
                            'closing_wallet'  => $u_code_closing_wallet,
                            'remark'  => $u_code_remark,
                        ),
                        array(
                            'wallet_type'  => $wallet_type,
                            'tx_type'  => $transfer,
                            'debit_credit'  => 'credit',
                            'tx_u_code'  => $u_code,
                            'u_code'  => $tx_u_code,
                            'amount'  => $amnt,
                            'date'  => $date,
                            'status'  => 1,
                            'open_wallet'  => $tx_u_code_open_wallet,
                            'closing_wallet'  => $tx_u_code_closing_wallet,
                            'remark'  => $tx_u_code_remark,
                        )

                    );

                    if ($this->db->insert_batch('transaction', $inserttrans)) {
                        $this->update_ob->add_amnt($tx_u_code, $wallet_type, $amnt);
                        $this->update_ob->add_amnt($u_code, $wallet_type, -$amnt);

                        $smsg = " Transaction Successful. You transfer $amnt  to $tx_username";
                        $res['res'] = 'success';
                        $res['error_wallet'] = '';
                        $res['error_tx_username'] = '';
                        $res['error_amount'] = '';
                        $res['error_otp'] = '';
                        $res['message'] = $smsg;
                    }
               
            } else {
                $res['res'] = 'error';
                $res['error_wallet'] = form_error('selected_wallet');
                $res['error_tx_username'] = form_error('tx_username');
                $res['error_amount'] = form_error('amount');
                $res['error_otp'] = form_error('otp_input');
                $res['message'] = "Something Wrong.";
            }
        } else {

            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }

        print_r(json_encode($res));
    }

    public function send_otp()
    {
        //  $input_data = $this->conn->get_input();

        if ($_POST["u_code"] != '' && $_POST["otp_type"] != '') {
            $otp_type = $_POST["otp_type"];
            $u_id = $_POST["u_code"];
            $profile = $this->profile->profile_info($_POST["u_code"]);
            $transfer_status = $this->conn->setting('transfer_status');
            if ($profile) {
                $mobile = $profile->mobile;
                $email = $profile->email;
                $username = $profile->username;
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
                if ($sel_qq1) {
                    $otp = rand(100000, 999999);
                    $this->db->set('otp', $otp);
                    $this->db->set('otp_type', $otp_type);
                    $this->db->set('user_mobile', $mobile);
                    $this->db->where('u_id', $u_id);
                    $this->db->update('api_otp');

                    // $otp = $sel_qq1[0]->otp;    
                } else {
                    $otp = rand(100000, 999999);
                    $arr = array();
                    $arr['u_id'] = $u_id;
                    $arr['otp_type'] = $otp_type;
                    $arr['otp'] = $otp;
                    $arr['user_mobile'] = $mobile;
                    $this->db->insert('api_otp', $arr);
                }

                $company_url = $this->conn->company_info('base_url');
                $company_name = $this->conn->company_info('company_name');

                if ($otp_type == 'forgot_security_pin' || $otp_type == 'change_security_pin') {
                    $ottp = "$otp is OTP for changing the security pin. Thanks $company_name team. For more visit $company_url, $company_name";
                } else if ($otp_type == 'forgot_tx_pin' || $otp_type == 'change_tx_pin') {
                    $ottp = "$otp is OTP for changing transaction pin. Thanks $company_name team. For more visit $company_url, $company_name";
                } elseif ($otp_type == 'withdrawal') {
                    $ottp = "$otp is OTP for withdrawal. Thanks $company_name team.";
                } elseif ($otp_type == 'transfer') {

                    if ($transfer_status == "yes") {
                        $ottp = "$otp is OTP for trnsafer. Thanks $company_name team.";
                    } else {
                        $ottp = "fund transfer disabled this time";
                    }
                } elseif ($otp_type == 'edit_profile') {
                    $ottp = "$otp is OTP for Edit Profile. Thanks $company_name team.";
                } else {
                }

                $this->message->send_mail($email, 'OTP Send', $ottp, $username);
                // $this->message->sms($mobile,$ottp);

                // $res['sms'] = $ottp;
                if ($transfer_status == "no" && $otp_type == 'transfer') {
                    $res['res'] = "error";
                    $res['message'] = "fund transfer disabled this time";
                } else {
                    $res['res'] = "success";
                    $res['message'] = "OTP sent Successfully!";
                }
            } else {
                $res['res'] = 'error';
                $res['res'] = 'User not found!';
            }
        } else {
            $res['res'] = 'Error';
            $res['res'] = 'All parameter are required.';
        }

        print_r(json_encode($res));
    }

    public function payment_request()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $this->form_validation->set_data($input_data);
            $crncy = $this->conn->company_info('currency');
            //$_SESSION['form_submitted'] = TRUE;
            //$this->form_validation->set_rules('address', 'Address', 'required');            

            $this->form_validation->set_rules('amount', 'Amount', 'required');

            $params['upload_path'] = 'payment_slip';

            $upload_pic = $this->upload_file->upload_image('payment_slip', $params);

            if ($this->form_validation->run() != False) {
                $u_id = $input_data['u_id'];

                $server_root = $_SERVER['DOCUMENT_ROOT'] . "/";
                $base64_string = $input_data['payment_slip'];
                $image_name = rand(1000000, 9999999) . $input_data['u_id'] . "_paymentslip_.png";
                $payment_slip_image_path = "images/payment_slip/" . $image_name;
                $ifp = fopen($server_root . "images/payment_slip/" . $image_name, "wb"); // use your folder path
                fwrite($ifp, base64_decode(str_replace(' ', '', $base64_string)));
                fclose($ifp);


                $request['u_code'] = $u_id;
                $request['request'] = $ifp;
                $this->db->insert('form_request', $request);

                $inserttrans['payment_slip'] = base_url() . 'images/payment_slip/' . $image_name;

                $profile = $this->profile->profile_info($u_id);
                $username = $profile->username;
                $name = $profile->name;



                $inserttrans['wallet_type'] = 'income_wallet';
                $inserttrans['tx_type'] = 'payment_request';

                $inserttrans['debit_credit'] = "credit";
                $inserttrans['u_code'] = $u_id;
                $inserttrans['amount'] = abs($input_data['amount']);
                $amnt = $inserttrans['amount'];
                $inserttrans['date'] = date('Y-m-d H:i:s');
                $inserttrans['status'] = 0;
                // $inserttrans['user_type']=$account_type;
                $inserttrans['remark'] = "$name ($username) payment Request $crncy $amnt";


                if ($this->db->insert('transaction', $inserttrans)) {


                    $smsg = "fund request success of amount  $crncy $amnt .";

                    $res['res'] = 'success';
                    $res['error_address'] = '';
                    $res['error_payment_type'] = '';
                    $res['error_amount'] = '';

                    $res['error_utr_number'] = '';
                    $res['message'] = $smsg;
                    //$this->session->set_flashdata("success", $smsg);
                    //	redirect(base_url(uri_string()));

                } else {
                    $res['res'] = 'error';
                    $res['error_address'] = form_error('address');
                    $res['error_payment_type'] = form_error('payment_type');
                    $res['error_amount'] = form_error('amount');

                    $res['error_utr_number'] = form_error('utr_number');
                    $res['message'] = "Something Wrong.";
                    //$this->session->set_flashdata("error", "Something wrong.");
                }
            }
        } else {

            $res['res'] = 'error';

            $res['message'] = "Invalid UserId.";
        }
        print_r(json_encode($res));
    }

    public function fund_request()
    {

        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $this->form_validation->set_data($input_data);
            $crncy = $this->conn->company_info('currency');
            //$_SESSION['form_submitted'] = TRUE;
            //$this->form_validation->set_rules('address', 'Address', 'required');            
            $this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|callback_min_max_addfund_limit');
            $this->form_validation->set_rules('utr_number', 'UTR', 'required');
            $params['upload_path'] = 'payment_slip';

            $upload_pic = $this->upload_file->upload_image('payment_slip', $params);

            if ($this->form_validation->run() != False) {
                $u_id = $input_data['u_id'];

                $server_root = $_SERVER['DOCUMENT_ROOT'] . "/";
                $base64_string = $input_data['payment_slip'];
                $image_name = rand(1000000, 9999999) . $input_data['u_id'] . "_paymentslip_.png";
                $payment_slip_image_path = "images/payment_slip/" . $image_name;
                $ifp = fopen($server_root . "images/payment_slip/" . $image_name, "wb"); // use your folder path
                fwrite($ifp, base64_decode(str_replace(' ', '', $base64_string)));
                fclose($ifp);


                $request['u_code'] = $u_id;
                $request['request'] = $ifp;
                $this->db->insert('form_request', $request);

                $inserttrans['payment_slip'] = base_url() . 'images/payment_slip/' . $image_name;


                $profile = $this->profile->profile_info($u_id);
                $username = $profile->username;
                $name = $profile->name;
                //  $account_type=$profile->account_type;

                $inserttrans['wallet_type'] = 'fund_wallet';
                $inserttrans['tx_type'] = 'fund_request';
                $inserttrans['payment_type'] = $input_data['payment_type'];
                //$inserttrans['cripto_type']=$input_data['address'];
                $inserttrans['cripto_address'] = $input_data['utr_number'];
                $inserttrans['debit_credit'] = "credit";
                $inserttrans['u_code'] = $u_id;
                $inserttrans['amount'] = abs($input_data['amount']);
                $amnt = $inserttrans['amount'];
                $inserttrans['date'] = date('Y-m-d H:i:s');
                $inserttrans['status'] = 0;
                // $inserttrans['user_type']=$account_type;
                $inserttrans['remark'] = "$name ($username) fund Request $crncy $amnt";


                if ($this->db->insert('transaction', $inserttrans)) {


                    $smsg = "fund request success of amount  $crncy $amnt .";

                    $res['res'] = 'success';
                    $res['error_address'] = '';
                    $res['error_payment_type'] = '';
                    $res['error_amount'] = '';
                    $res['error_utr_number'] = '';
                    $res['message'] = $smsg;
                    //$this->session->set_flashdata("success", $smsg);
                    //	redirect(base_url(uri_string()));

                } else {
                    $res['res'] = 'error';
                    $res['error_address'] = form_error('address');
                    $res['error_payment_type'] = form_error('payment_type');
                    $res['error_amount'] = form_error('amount');
                    $res['error_utr_number'] = form_error('utr_number');
                    $res['message'] = "Something Wrong.";
                    //$this->session->set_flashdata("error", "Something wrong.");
                }
            }
        } else {

            $res['res'] = 'error';

            $res['message'] = "Invalid UserId.";
        }
        print_r(json_encode($res));
    }

    public function payment_methods()
    {
        $input_data = $this->conn->get_input();
        $payment_method = $check = $this->conn->runQuery('*', 'payment_method', "status='1' and is_parent='1'");
        if ($payment_method) {
            foreach ($payment_method as $payment_method1) {
                $slg = $payment_method1->slug;
                $data[$slg]['name'] = $payment_method1->name;
                $check = $this->conn->runQuery('*', 'payment_method', "parent_method='$slg' and status='1'");
                $data1 = array();
                if ($check) {
                    foreach ($check as $check_mathods) {
                        $slg1 = $check_mathods->slug;
                        $data1[$slg1] = $check_mathods->name;
                    }
                }
                $data[$slg]['data'] = $data1;
            }
        }
        $u_id = $input_data['u_id'];
        $pin_details = $this->conn->runQuery('*', 'pin_details', "status='1'");
        $total_credit = $this->conn->runQuery('SUM(amount) as amt', 'transaction', "status='1' and u_code='$u_id' and debit_credit='credit' and wallet_type='service_wallet'");
        $total_bal = $total_credit[0]->amt != "" ? $total_credit[0]->amt : "0";
        $res['total_credit'] = $total_bal;
        $res['total_balance'] = $this->update_ob->wallet($input_data['u_id'], 'fund_wallet');
        $res['remark'] = "Min. Rs 100/- & Max. Rs 5000/-";
        $res['image'] = '';
        $res['res'] = 'success';
        $res['pin_rate'] = $pin_details[0]->pin_rate;
        $res['message'] = '';
        $res['data'] = $data;
        print_r(json_encode($res));
    }

    public function fund_withdraw()
    {

        //$input_data = $this->conn->get_input();
        if (isset($_POST['u_id'])) {
            if (1 == 1) {


                $this->form_validation->set_data($_POST);
                $this->form_validation->set_rules('otp_input', 'OTP', 'required');
                $_SESSION['form_submitted'] = TRUE;
                $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable_withdrawal');
                $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_transfer_balance|greater_than[0]|callback_check_account_exists|callback_min_withdrawal_limit|callback_check_withdrawal_today');
                $this->form_validation->set_rules('withdraw_type', 'Withdraw Type', 'required');
                $this->form_validation->set_rules('payment_address', 'Payment Address', 'required');
                $userid = $_POST['u_id'];
                $type = $_POST['withdraw_type'];
                $payment_address = $_POST['payment_address'];
                $entered_otp = $_POST['otp_input'];
                // $testing = array();
                // $testing['remark'] = $entered_otp;
                // $this->db->insert('testing');
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$userid' AND  otp_type='withdrawal'");
                if ($sel_qq1) {

                    $otp = $sel_qq1[0]->otp;
                    if ($otp == $entered_otp) {
                        if ($this->form_validation->run() != False) {

                            //$rsss =  $this->get_user_id();

                            if (1 == 1) {

                                $request['u_code'] = $userid;
                                // $request['request'] = $csrf_test_name;
                                //$this->db->insert('form_request',$request);


                                $check_transactions = $this->conn->runQuery('*', "transaction", "status='0' and tx_type='withdrawal' and u_code='$userid'");
                                if (!$check_transactions) {

                                    //$bank_details=$bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");



                                    $inserttrans['bank_details'] = $payment_address;

                                    //$inserttrans['cripto_address']=$tron_address[0]->tron_address;

                                    $crncy = $this->conn->company_info('currency');
                                    $profile = $this->profile->profile_info($userid);
                                    $username = $profile->username;
                                    $name = $profile->name;
                                    $account_type = $profile->account_type;

                                    $admin_charge = $this->conn->setting('admin_charge');
                                    $offset_wallet = $this->conn->setting('offset_wallet');
                                    $inserttrans['wallet_type'] = $_POST['selected_wallet'];

                                    $inserttrans['payment_type'] = $type;

                                    $inserttrans['tx_type'] = 'withdrawal';
                                    $inserttrans['debit_credit'] = "debit";
                                    $inserttrans['u_code'] = $userid;
                                    $inserttrans['date'] = date('Y-m-d H:i:s');
                                    $amnt_value = abs($_POST['amount']);

                                    $offset_value = $amnt_value * $offset_wallet / 100;
                                    $amnt = $amnt_value - $offset_value;

                                    $tx_charge = $amnt * $admin_charge / 100;
                                    $amnt = $amnt - $tx_charge;



                                    $inserttrans['amount'] = $amnt;
                                    $inserttrans['tx_charge'] = $tx_charge;

                                    $inserttrans['open_wallet'] = $this->update_ob->wallet($userid, $_POST['selected_wallet']);
                                    $inserttrans['closing_wallet'] = $inserttrans['open_wallet'] - $inserttrans['amount'];
                                    $inserttrans['remark'] = "$name ($username) Withdraw  $amnt $crncy";

                                    $inserttrans['status'] = 0;

                                    if ($this->db->insert('transaction', $inserttrans)) {
                                        //$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                                        $this->update_ob->add_amnt($userid, $_POST['selected_wallet'], -$amnt_value);
                                        $this->update_ob->add_amnt($userid, 'total_withdrawal', $amnt_value);
                                        $off_tx_charge = $offset_value * $admin_charge / 100;
                                        $inserttrans['tx_charge'] = $off_tx_charge;
                                        $inserttrans['amount'] = $offsetAmount = $offset_value - $off_tx_charge;
                                        $inserttrans['wallet_type'] = 'offset_wallet';
                                        $inserttrans['debit_credit'] = "credit";
                                        $inserttrans['tx_type'] = 'withdrawal_offset';
                                        $inserttrans['open_wallet'] = $this->update_ob->wallet($userid, 'offset');
                                        $inserttrans['closing_wallet'] = $inserttrans['open_wallet'] + $inserttrans['amount'];
                                        if ($this->db->insert('transaction', $inserttrans)) {
                                            $this->update_ob->add_amnt($userid, 'offset', $offsetAmount);
                                        }

                                        $smsg = "Withdrawal request success of amount $amnt $crncy .";
                                        $res['res'] = 'success';

                                        $res['message'] = $smsg;
                                        //$this->session->set_flashdata("success", $smsg);
                                        //redirect(base_url(uri_string()));

                                    } else {
                                        $res['res'] = 'error';
                                        $res['message'] = "Something Wrong.";
                                        //$this->session->set_flashdata("error", "Something wrong.");
                                    }
                                } else {
                                    $res['res'] = 'error';
                                    $res['message'] = "Already Pending Withdrawal";
                                }
                            } else {
                                $res['res'] = 'error';
                                $res['message'] =  $rsss['message'];
                            }
                        } else {
                            $res['res'] = 'error';
                            $res['message'] =  validation_errors();
                        }
                    } else {
                        $res['res'] = 'error';
                        $res['message'] =  "Invalid  OTP!";
                    }
                } else {
                    $res['res'] = 'error';
                    $res['message'] =  "Wrong OTP!";
                }
            } else {
                $res['res'] = 'error';
                $res['message'] = "Server Down!";
            }
        } else {
            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }

        print_r(json_encode($res));
    }

    public function fund_withdraw_test()
    {

        if (isset($_POST['u_id'])) {
            if (1 == 1) {
                $this->form_validation->set_data($_POST);
                $this->form_validation->set_rules('otp_input', 'OTP', 'required');
                $_SESSION['form_submitted'] = TRUE;
                $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required|callback_check_wallet_useable_withdrawal');
                $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_transfer_balance|greater_than[0]|callback_check_account_exists|callback_min_withdrawal_limit|callback_check_withdrawal_today');
                $this->form_validation->set_rules('withdraw_type', 'Withdraw Type', 'required');
                $this->form_validation->set_rules('payment_address', 'Payment Address', 'required');
                $userid = $_POST['u_id'];
                $type = $_POST['withdraw_type'];
                $payment_address = $_POST['payment_address'];
                $entered_otp = $_POST['otp_input'];
                // $testing = array();
                // $testing['remark'] = $entered_otp;
                // $this->db->insert('testing');
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$userid' AND  otp_type='withdrawal'");
                if ($sel_qq1) {

                    $otp = $sel_qq1[0]->otp;
                    if ($otp == $entered_otp) {
                        if ($this->form_validation->run() != False) {

                            //$rsss =  $this->get_user_id();

                            if (1 == 1) {

                                $request['u_code'] = $userid;
                                $request['request'] = $csrf_test_name;
                                //$this->db->insert('form_request',$request);


                                $check_transactions = $this->conn->runQuery('*', "transaction", "status='0' and tx_type='withdrawal' and u_code='$userid'");
                                if (!$check_transactions) {

                                    //$bank_details=$bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");



                                    $inserttrans['bank_details'] = $payment_address;

                                    //$inserttrans['cripto_address']=$tron_address[0]->tron_address;

                                    $crncy = $this->conn->company_info('currency');
                                    $profile = $this->profile->profile_info($userid);
                                    $username = $profile->username;
                                    $name = $profile->name;
                                    $account_type = $profile->account_type;

                                    $admin_charge = 10; //$this->conn->setting('admin_charge');
                                    $inserttrans['wallet_type'] = $_POST['selected_wallet'];

                                    $inserttrans['payment_type'] = $type;

                                    $inserttrans['tx_type'] = 'withdrawal';
                                    $inserttrans['debit_credit'] = "debit";
                                    $inserttrans['u_code'] = $userid;
                                    $inserttrans['date'] = date('Y-m-d H:i:s');
                                    $amnt = abs($_POST['amount']);
                                    $tx_charge = $amnt * $admin_charge / 100;
                                    $inserttrans['amount'] = $amnt - $tx_charge;
                                    $inserttrans['tx_charge'] = $tx_charge;

                                    $inserttrans['open_wallet'] = $this->update_ob->wallet($userid, $_POST['selected_wallet']);
                                    $inserttrans['closing_wallet'] = $inserttrans['open_wallet'] - $inserttrans['amount'];
                                    $inserttrans['remark'] = "$name ($username) Withdraw  $amnt $crncy";

                                    $inserttrans['status'] = 0;

                                    if ($this->db->insert('transaction', $inserttrans)) {

                                        //$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                                        $this->update_ob->add_amnt($userid, $_POST['selected_wallet'], -$amnt);
                                        $this->update_ob->add_amnt($userid, 'total_withdrawal', $amnt);

                                        $smsg = "Withdrawal request success of amount $amnt $crncy .";
                                        $res['res'] = 'success';

                                        $res['message'] = $smsg;
                                        //$this->session->set_flashdata("success", $smsg);
                                        //redirect(base_url(uri_string()));

                                    } else {
                                        $res['res'] = 'error';

                                        $res['message'] = "Something Wrong.";
                                        //$this->session->set_flashdata("error", "Something wrong.");
                                    }
                                } else {
                                    $res['res'] = 'error';
                                    $res['message'] = "Already Pending Withdrawal";
                                }
                            } else {

                                $res['res'] = 'error';
                                $res['message'] =  $rsss['message'];
                            }
                        } else {
                            $res['res'] = 'error';
                            $res['message'] =  validation_errors();
                        }
                    } else {
                        $res['res'] = 'error';
                        $res['message'] =  "Invalid  OTP!";
                    }
                } else {
                    $res['res'] = 'error';
                    $res['message'] =  "Wrong OTP!";
                }
            } else {
                $res['res'] = 'error';
                $res['message'] = "Server Down!";
            }
        } else {
            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }

        print_r(json_encode($res));
    }

    public function check_fund_detail($str)
    {

        $input_data = $this->conn->get_input();
        $rsss =  $this->get_user_id();
        $userid = $rsss['u_id'];
        $sel_qq1 = $this->conn->runQuery('*', 'fd_detail', " u_code='$userid' and status=1");
        if ($sel_qq1) {
            $this->form_validation->set_message('check_fund_detail', "Already Generate Request.");
            return false;
        } else {
            return true;
        }
    }

    public function min_convert_limit($str)
    {
        $min_transfer_limit = $this->conn->setting('min_convert_limit');
        //$max_transfer_limit=$this->conn->setting('max_convert_limit');

        if (is_numeric($str) && $str >= $min_transfer_limit) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('min_convert_limit', "Amount should be minimum $min_transfer_limit $curr ");
            return false;
        }
    }

    public function min_transfer_limit($str)
    {
        $min_transfer_limit = $this->conn->setting('min_transfer_limit');
        // $max_transfer_limit=$this->conn->setting('max_transfer_limit');

        if (is_numeric($str) && $str >= $min_transfer_limit) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('min_transfer_limit', "Amount should be minimum $min_transfer_limit $curr ");
            return false;
        }
    }

    public function valid_username($str)
    {
        $check_username = $this->conn->runQuery("id", 'users', "username='$str'");
        if ($check_username) {
            return true;
        } else {
            $this->form_validation->set_message('valid_username', "Invalid Username! Please check username.");
            return false;
        }
    }

    public  function check_otp_valid($str)
    {

        $u_id = $_POST['u_id'];

        $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp='$str' AND otp_type='transfer'");

        if ($sel_qq1) {
            if ($sel_qq1[0]->otp == $str) {

                return true;
            } else {

                $this->form_validation->set_message('check_otp_valid', "Incorect OTP. Please try again.");
                return false;
            }
        } else {

            $this->form_validation->set_message('check_otp_valid', "OTP not Valid.");
            return false;
        }
    }

    public function check_convert_balance($str)
    {
        //$input_data = $this->conn->get_input();
        //$rsss =  $this->get_user_id();
        $userid = $_POST['u_id'];
        $min_convert_fund_limit = $this->conn->setting('min_convert_fund_limit');
        if ($str >= $min_convert_fund_limit) {
            $wlt = $_POST['from_wallet'];
            $balance = $this->update_ob->wallet($userid, $wlt);
            if ($balance >= $str) {
                return true;
            } else {
                $this->form_validation->set_message('check_convert_balance', "Insufficient Fund in wallet.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_convert_balance', "Minimum Fund convert limit $min_convert_fund_limit.");
            return false;
        }
    }

    public function check_convert_balance2($str)
    {
        $input_data = $this->conn->get_input();
        $rsss =  $this->get_user_id();
        $userid = $rsss['u_id'];
        $min_convert_fund_limit = $this->conn->setting('min_convert_fund_limit');

        if ($str >= $min_convert_fund_limit) {
            $wlt = $input_data['from_wallet2'];
            $balance = $this->update_ob->wallet($userid, $wlt);
            if ($balance >= $str) {
                return true;
            } else {
                $this->form_validation->set_message('check_convert_balance2', "Insufficient Fund in wallet.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_convert_balance2', "Minimum Fund convert limit $min_convert_fund_limit.");
            return false;
        }
    }

    public function check_wallet_balance($str)
    {
        //$input_data = $this->conn->get_input();
        //$rsss =  $this->get_user_id();
        $userid = $_POST['u_id'];
        if (isset($_POST['amount']) && $_POST['amount'] != '' && $_POST['amount'] > 0) {
            $amnt = $_POST['amount'];
            $balance = $this->update_ob->wallet($userid, $str);
            if ($amnt <= $balance) {
                return true;
            } else {
                $this->form_validation->set_message('check_wallet_balance', "Insufficient wallet Balance.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_wallet_balance', "Please enter valid amount.");
            return false;
        }
    }

    public function check_wallet_balance2($str)
    {
        $input_data = $this->conn->get_input();
        $rsss =  $this->get_user_id();
        $userid = $rsss['u_id'];
        if (isset($input_data['amount2']) && $input_data['amount2'] != '' && $input_data['amount2'] > 0) {
            $amnt = $input_data['amount'];
            $balance = $this->update_ob->wallet($userid, $str);
            if ($amnt <= $balance) {
                return true;
            } else {
                $this->form_validation->set_message('check_wallet_balance2', "Insufficient wallet Balance.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_wallet_balance2', "Please enter valid amount.");
            return false;
        }
    }

    public function get_user_id()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['session_key']) && $input_data['session_key'] != '') {
            $session_key = $input_data['session_key'];
            $session_data = $this->conn->aes128Decrypt($session_key, $this->session_encryption_key);


            $session_data_array = explode("_", $session_data);
            $session_username = $session_data_array[0];
            $session_password_md5 = $session_data_array[1];

            $u_id = $this->profile->id_by_username($session_username);
            if ($u_id) {
                $res['u_id'] = $u_id;
                $res['res'] = 'success';
            } else {
                $res['message'] = 'User not exists.';
                $res['res'] = 'error';
            }
        } else {
            $res['message'] = 'User not exists.';
            $res['res'] = 'error';
        }
        return $res;
    }

    public function check_account_exists($st)
    {
        //$rsss =  $this->get_user_id();
        //if($rsss['res']=='success'){
        $userid = $_POST['u_id'];
        $user_details = $this->conn->runQuery('*', "users", "active_status='1' and id='$userid'");
        if ($user_details) {
            $bank_details = $bank_details = $this->conn->runQuery('*', "user_accounts", "status='1' and u_code='$userid'");
            //$bank_details=$this->profile->my_default_account($userid);
            //if(!empty($bank_details)){
            if ($bank_details) {
                return true;
            } else {
                $this->form_validation->set_message('check_account_exists', "Add account details first.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_account_exists', "To Take Withdrawal Please Active Userid");
            return false;
        }

        /*}else{
            $this->form_validation->set_message('check_account_exists', $rsss['message']);
            return false;
        }*/
    }

    public function check_wallet_useable_withdrawal($str)
    {
        $available_wallets = $this->conn->setting('withdrawal_wallets');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_wallet_useable_withdrawal', "You can not Withdraw fund from this wallet");
            return false;
        }
    }

    public function check_wallet_useable($str)
    {
        $available_wallets = $this->conn->setting('transfer_wallets');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_wallet_useable', "You can not transfer fund from this wallet");
            return false;
        }
    }

    public function check_from_wallet_useable($str)
    {
        $available_wallets = $this->conn->setting('convert_from_wallets');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_from_wallet_useable', "You can not Convert fund from this wallet");
            return false;
        }
    }

    public function check_to_wallet_useable($str)
    {
        $available_wallets = $this->conn->setting('convert_to_wallets');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_to_wallet_useable', "You can not Convert fund to this wallet");
            return false;
        }
    }

    public function check_from_wallet_useable2($str)
    {
        $available_wallets = $this->conn->setting('convert_from_wallets2');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_from_wallet_useable2', "You can not Convert fund from this wallet");
            return false;
        }
    }

    public function check_to_wallet_useable2($str)
    {
        $available_wallets = $this->conn->setting('convert_to_wallets2');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_to_wallet_useable2', "You can not Convert fund to this wallet");
            return false;
        }
    }

    public function check_withdrawal_today_old($str)
    {
        $cur_dt = date('Y-m-d H:i:s');
        $rsss =  $this->get_user_id();
        $userid = $rsss['u_id'];

        $check_ex = $this->conn->runQuery('id,date', 'transaction', "tx_type='withdrawal' and u_code='$userid' and (status=1 or status=0)");
        if ($check_ex) {
            $dts = $check_ex[0]->date;
            $nextDate = date('Y-m-d  H:i:s', strtotime("+1 day", strtotime($dts)));


            if ($cur_dt >= $nextDate) {
                //if($nextDate>=$cur_dt){
                return true;
            } else {

                $this->form_validation->set_message('check_withdrawal_today', "Next Withdrawal request will be generated  after 24 hour");
                return false;
            }
        } else {
            return true;
        }
    }

    public function check_withdrawal_today($str)
    {
        $daily_withdrawal_limit = $this->conn->setting('daily_withdrawal_limit');
        $cur_dt = date('Y-m-d H:i:s');
        $rsss =  $this->get_user_id();
        $userid = $rsss['u_id'];
        $check_ex = $this->conn->runQuery('SUM(amount) as sum', 'transaction', "tx_type='withdrawal' and u_code='$userid' and DATE(added_on)=DATE('$cur_dt')");
        $amnt = $check_ex[0]->sum;

        if ($amnt >= $daily_withdrawal_limit) {

            $this->form_validation->set_message('check_withdrawal_today', "Next withdrawal request will be generated after 24 hours.");
            return false;
        } else {

            return true;
        }
    }

    public function check_withdrawal_today_old1($str)
    {
        $daily_withdrawal_limit = $this->conn->setting('daily_withdrawal_limit');
        $cur_dt = date('Y-m-d H:i:s');
        $rsss =  $this->get_user_id();
        $userid = $rsss['u_id'];

        $check_ex = $this->conn->runQuery('id,date', 'transaction', "tx_type='withdrawal' and u_code='$userid' and (status=1 or status=0) and DATE(date)=DATE('$cur_dt')");
        if ($check_ex) {

            $this->form_validation->set_message('check_withdrawal_today', "Next Withdrawal request will be generated  after 24 hour");
            return false;
        } else {
            return true;
        }
    }

    public function min_withdrawal_limit($str)
    {
        $min_withdrawal_limit = $this->conn->setting('min_withdrawal_limit');
        $max_withdrawal_limit = $this->conn->setting('max_withdrawal_limit');
        $withdrawal_multiple_of = $this->conn->setting('withdrawal_multiple_of');

        if (is_numeric($str)   && $str >= $min_withdrawal_limit && $str <= $max_withdrawal_limit) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('min_withdrawal_limit', "Amount should be minimum $curr $min_withdrawal_limit  and Maximum $curr $max_withdrawal_limit");
            return false;
        }
    }


    public function min_max_addfund_limit($str)
    {
        $min_withdrawal_limit = 10;
        $max_withdrawal_limit = 5000;
        if (is_numeric($str)   && $str >= $min_withdrawal_limit && $str <= $max_withdrawal_limit) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('min_max_addfund_limit', "Amount should be minimum $curr $min_withdrawal_limit and Maximum $max_withdrawal_limit");
            return false;
        }
    }

    public function max_withdrawal_limit($str)
    {
        $max_withdrawal_limit = $this->conn->setting('max_withdrawal_limit');
        /* $select_wallet=$_POST['selected_wallet'];
        if($select_wallet=="direct_cashback_wallet"){
            $max_withdrawal_limit=200;
        }else{
            $max_withdrawal_limit=200;
            
        }*/

        if (is_numeric($str)   && $str <= $max_withdrawal_limit) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('max_withdrawal_limit', "Maximum Amount Limit $curr $max_withdrawal_limit");
            return false;
        }
    }

    public function check_kyc($str)
    {

        $rsss =  $this->get_user_id();
        $u_id = $rsss['u_id'];
        $check_ex = $this->conn->runQuery('id', 'user_accounts', "u_code='$u_id' and pan_kyc_status='approved' and adhaar_kyc_status='approved'");

        if ($check_ex) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('check_kyc', "Kyc Requried");
            return false;
        }
    }

    public function check_direct($str)
    {

        $rsss =  $this->get_user_id();
        $u_id = $rsss['u_id'];
        $my_directs = $this->team->my_actives($u_id);
        $total_directs = COUNT($my_directs);
        if ($total_directs >= 3) {
            return true;
        } else {
            $curr = $this->conn->company_info('currency');
            $this->form_validation->set_message('check_direct', "3 Direct Requried To Take Withdrawal");
            return false;
        }
    }

    public function check_transfer_balance($str)
    {
        //$input_data = $this->conn->get_input();         
        if (isset($_POST['selected_wallet']) && $_POST['selected_wallet'] != '') {
            $wlt = $_POST['selected_wallet'];
            $u_id = $_POST['u_id'];
            $balance = $this->update_ob->wallet($u_id, $wlt);
            $testing = array();
            $testing['remark'] = $balance;
            $this->db->insert('testing', $testing);
            if ($balance >= $str) {
                return true;
            } else {
                $this->form_validation->set_message('check_transfer_balance', "Insufficient Fund in wallet.");
                return false;
            }
        } else {
            
            $this->form_validation->set_message('check_transfer_balance', "Please Select valid pin.");
            return false;
        }
    }

    public function fd_list()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $u_id = $input_data['u_id'];

            $statements = $this->conn->runQuery('*', 'fd_detail', "u_code='$u_id'");
            if ($statements) {
                $statements = json_decode(json_encode($statements), true);
            } else {
                $statements = array();
            }
            //$result['sql'] = "select * from support where u_id='$u_id'";
            $result['res'] = "success";
            $result['message'] = "Statements fetched successfully.";
            $result['statements'] = $statements;
            $result['total_count'] = count($statements);
        } else {
            $result['res'] = "error";
            $result["message"] = "All parameters are required";
        }
        print_r(json_encode($result));
    }
    public  function check_username_exist()
    {

        if (isset($_POST['username']) && $_POST['username'] != '') {
            $where['username'] = $_POST['username'];
            $details  =  $this->conn->runQuery('name', 'users', $where);
            if ($details) {
                $res['name'] = $details[0]->name;
                $res['res'] = 'success';
                $res['message'] = "Username Exists";
            } else {

                $res['res'] = 'error';
                $res['message'] = "Invalid username";
            }
        } else {
            $res['res'] = 'error';
            $res['message'] = "Please Enter username";
        }
        print_r(json_encode($res));
    }

    public function find_name()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['tx_username'])) {
            $tx_username = $input_data['tx_username'];
            $statements = $this->conn->runQuery('name', 'users', "username='$tx_username'");
            if ($statements) {
                $result['res'] = "success";
                $result['name'] = $statements[0]->name;
                $result["message"] = "Username Fetched";
            } else {
                $result['res'] = "error";
                $result["message"] = "Invalid Username";
            }
        } else {
            $result['res'] = "error";
            $result["message"] = "All parameters are required";
        }
        print_r(json_encode($result));
    }
}
