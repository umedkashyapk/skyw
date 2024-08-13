<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
//header("Access-Control-Allow-Headers: X-Requested-With");

use Razorpay\Api\Api;

class Membership extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $key_data2 = $this->conn->runQuery('*', 'api_key', "key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
        $this->limit = 20;
        if (!array_key_exists('token', $this->input->request_headers())) {

            $data['status'] = false;
            $data['tokenStatus'] = false;
            $data['message'] = "Invalid Token.";
            // print_r(json_encode($data));
            // die();
        } else {
            // $sdfg   = $this->input->request_headers()['token'];
            $sdfg = $this->input->get_request_header('token', true);
            $this->user_id = $this->token->userByToken($sdfg);
        }
    }

    public function upis()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $u_id = $input_data['u_id'];
            $amount = $input_data['amount'];
            $tx_id = time();
            $user_detail = $this->conn->runQuery('*', 'users', "id='$u_id'");
            $name = $user_detail[0]->name;
            $email = $user_detail[0]->email;
            $mobile = $user_detail[0]->mobile;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://merchant.upigateway.com/api/create_order',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
				"key": "1d5ad298-8c94-4f67-bab7-af0e12462b57",
				"client_txn_id": "' . $tx_id . '",
				"amount": "' . $amount . '",
				"p_info": "Product Name",
				"customer_name": "' . $name . '",
				"customer_email": "' . $email . '",
				"customer_mobile": "' . $mobile . '",
				"redirect_url": "https://theredwallet.in/ressucess",
				"udf1": "user defined field 1",
				"udf2": "user defined field 2",
				"udf3": "user defined field 3"
			}',

                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //$response1=json_encode($response);

            /////////////////////////////////////////////////////////////
            $inserttrans['wallet_type'] = 'service_wallet';
            $inserttrans['tx_type'] = 'upi';
            $inserttrans['debit_credit'] = "credit";
            $inserttrans['u_code'] = $u_id;
            $inserttrans['date'] = date('Y-m-d H:i:s');

            $inserttrans['amount'] = $amount;

            $inserttrans['status'] = 0;
            $inserttrans['tx_record'] = $tx_id;

            $inserttrans['remark'] = "Add Fund by UPI";

            if ($this->db->insert('transaction', $inserttrans)) {
            }
            /////////////////////////////////////////////////////////////

            //echo $response['status'];
            //echo $response1['status'];
            //print_R($response);
            //die();
            //echo $response;
            $result['res'] = 'success';
            $result['keys'] = $response;

            print_r(json_encode($result));
        }
    }

    public function invest_history()
    {

        $lmt = $this->limit;
        $input_data = $_POST;

        if (isset($_POST['u_id']) && isset($_POST['init_val'])) {

            $start_from = $_POST['init_val'];
            $u_id = $_POST['u_id'];

            //      if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            //     $idsn=$this->profile->column_like($_REQUEST['name'],'name');
            //     if(!empty($idsn)){
            //         $conditions['u_code']=$idsn;
            //     }else{
            //         $conditions['u_code']='';
            //     }
            // }
            if (isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date'] != '' && $_REQUEST['end_date'] != '') {

                $start_date = date('Y-m-d 00:00:00', strtotime($_REQUEST['start_date']));
                $end_date = date('Y-m-d 23:59:00', strtotime($_REQUEST['end_date']));
                $where .= " and (date BETWEEN '$start_date' and '$end_date')";
            }

            $txn = $this->conn->runQuery('*', 'orders', "u_code='$u_id' and status='1' $where order by id desc limit $start_from,$lmt");

            $total_earning = $this->conn->runQuery('SUM(order_amount) as amts', 'orders', "u_code='$u_id' and status='1' and tx_type='purchase'")[0]->amts;
            $total_txn = $this->conn->runQuery('COUNT(id) as ids', 'orders', "u_code='$u_id' and status='1'")[0]->ids;

            $ins_val = $start_from;

            $ttlcnt = 0;
            if ($txn) {

                foreach ($txn as $txn_details) {
                    $ttlcnt++;
                    $details = json_decode(json_encode($txn_details), true);

                    $data[] = $details;
                    $ins_val++;
                }

                $res['total_count'] = $total_txn;
                $res['total_earning'] = ($total_earning != "" ? $total_earning : 0);
                $res['data'] = $data;
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
            $res['next_init_val'] = 0;
            $res['next_page'] = 'no';
            $res['prev_page'] = 'no';
            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }

        print_r(json_encode($res));
    }

    public function prerequest()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $u_id = $input_data['u_id'];
            $pin_type = $input_data['pin_type'];
            $order_detail = $this->conn->runQuery('*', 'orders', "u_code='$u_id' and package='$pin_type'");
            if (!$order_detail) {
                //$u_id=$input_data['amount'];
                $tx_id = time();
                $key = 'rzp_live_wbKHxMaI009X5Y';

                /////////////////////////////////////////////
                $tx_id = time();
                $ttl_rzr = $input_data['amount'];
                ////////////////////////////////////////////////////////////////////////
                $key = 'rzp_live_wbKHxMaI009X5Y';
                APPPATH . 'third_party/razorpay/Razorpay.php';
                require_once APPPATH . 'third_party/razorpay/Razorpay.php';
                $api = new Api($key, 'QA8jnI9wfzAMMT5Tv5yQXybo');
                //print_R($api);
                $order = $api->order->create([
                    'receipt' => 'order_rcptid_' . $tx_id,
                    'amount' => $ttl_rzr * 100, // amount in the smallest currency unit
                    'currency' => 'INR', // <a href="/docs/payment-gateway/payments/international-payments/#supported-currencies" target="_blank">See the list of supported currencies</a>.)
                ]);
                $orderId = $order->id;
                /////////////////////////////////////////////////////////////////////////

                //$inserts['remark']=$payment_response;
                $inserts['u_code'] = $u_id;
                $inserts['tx_type'] = 'topup';
                $inserts['debit_credit'] = 'debit';
                $inserts['wallet_type'] = 'fund_wallet';
                $inserts['amount'] = $ttl_rzr;
                $inserts['status'] = 0;
                $inserts['api_key'] = $key;
                $inserts['tx_id'] = $orderId;

                //$inserts['remark']=$payment_response;
                //$inserts['api_response']=$razorpay_payment_id;
                $this->db->insert('transaction', $inserts);

                $result['message'] = '';
                $result['res'] = 'success';
                $result['key'] = $key;
                $result['tx_id'] = $orderId;
            } else {
                $result['res'] = 'error';
                $result['message'] = 'This Package Already Active';
            }
        } else {

            $result['res'] = 'error';
            $result['message'] = 'User Id Required.';
        }

        print_r(json_encode($result));
    }

    public function payment_success()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id']) && isset($input_data['order_id']) && isset($input_data['response'])) {
            $u_id = $input_data['u_id'];
            $order_id = $input_data['order_id'];
            $resp = $input_data['response'];

            $check_transaction = $this->conn->runQuery('*', 'transaction', "tx_id='$order_id'");
            if ($check_transaction) {
                $amts = $check_transaction[0]->amount;
                if ($resp == "success") {

                    $st = 1;
                } else {
                    $st = 2;
                }
                $this->db->set('status', $st);
                $this->db->where('tx_id', $order_id);
                $this->db->where('u_code', $u_id);
                $this->db->update('transaction');

                if ($st == 1) {

                    $tx_u_code = $u_id;
                    $pin_type = $input_data['pin_type'];
                    $pin_details = $this->pin->pin_details($pin_type);

                    $pin_type = $pin_details->pin_type;
                    $order_detail = $this->conn->runQuery('*', 'orders', "u_code='$tx_u_code' and package='$pin_type'");
                    if (!$order_detail) {
                        $amount = $input_data['amount'];
                        $orders['u_code'] = $tx_u_code;
                        $orders['tx_type'] = 'purchase';
                        $orders['package'] = $pin_details->pin_type;
                        $orders['order_amount'] = $pin_details->pin_rate;
                        $orders['order_bv'] = $pin_details->business_volumn;
                        $orders['pv'] = $pin_details->pin_value;
                        $orders['status'] = 1;
                        //$orders['payout_id']=$currenct_payout_id;
                        $orders['payout_status'] = 2;

                        // $orders['user_type']=$account_type;

                        // if($this->db->insert('orders',$orders)){
                        $order_id = $this->conn->get_insert_id('orders', $orders);

                        $order_st = $this->conn->runQuery('*', 'users', "id='$tx_u_code' and active_status=0");
                        if ($order_st) {

                            $update = array(

                                'active_status' => 1,
                                'active_date' => date('Y-m-d H:i:s'),
                            );

                            $this->db->where('id', $tx_u_code);
                            $this->db->update('users', $update);

                            if ($this->conn->setting('level_distribution_on_topup') == 'yes') {

                                $this->distribute->level_destribute($tx_u_code, $pin_details->pin_rate, 3);
                            }

                            $sponsor_info = $this->profile->sponsor_info($tx_u_code, 'mobile,id');

                            if ($sponsor_info) {
                                $sponsor_mobile = $sponsor_info->mobile;
                                $this->update_ob->active_gen($sponsor_info->id);
                                $this->update_ob->active_direct($sponsor_info->id);
                            }
                        }

                        $result['res'] = 'success';
                        $result['message'] = 'Package active successfully.';

                        // }
                    } else {
                        $result['res'] = 'error';
                        $result['message'] = 'Already Active Package.';
                    }
                } else {

                    $result['res'] = 'error';
                    $result['message'] = 'Invaild Request.';
                }
            } else {

                $result['res'] = 'error';
                $result['message'] = 'Invaild Request.';
            }
        } else {

            $result['res'] = 'error';
            $result['message'] = 'User Id Required.';
        }
        print_r(json_encode($result));
    }

    public function check_activation_eligible()
    {
        $sdfg = $this->input->get_request_header('token', true);
        //$sdfg   = $this->input->request_headers()['token'];
        $u_id = $this->token->userByToken($sdfg);
        $res = array();
        if ($u_id) {

            $amount = $_POST['amount'];
            $check_user_sts = $this->conn->runQuery('subcription_date,active_status,subcription', 'users', "id='$u_id'");
            $check_active_stss = $check_user_sts[0]->active_status;
            if ($check_active_stss == 0) {

                $stss = "yes";
            } else {
                $subcription_datess = $check_user_sts[0]->subcription_date;
                $subcription_month = $check_user_sts[0]->subcription;
                $join_date = $profile->added_on;

                $current_days = date("Y-m-d");
                $from = date("Y-m-d", strtotime($subcription_datess));
                $dStart = new DateTime($from);
                $dEnd = new DateTime($current_days);
                $dDiff = $dStart->diff($dEnd);
                $ttl_dt_diff = $dDiff->format('%r%a');

                if ($subcription_month == "12 Month") {
                    $total_days = 365;
                }

                if ($ttl_dt_diff >= $total_days) {
                    $stss = "yes";
                } else {
                    $stss = "no";
                }
            }

            if ($stss == "yes") {
                $res['res'] = 'success';
                $res['message'] = 'please activate your package';
            } else {
                $res['res'] = 'error';
                $res['message'] = 'Package Already activated';
            }
        } else {
            $res['res'] = 'error';
            $res['message'] = 'Token Expired!';
        }

        print_r(json_encode($res));
    }



   

        public function check_transfer_balance($str)
    {
        if (isset($_POST['offset_amount']) && $_POST['offset_amount'] != '') {
            $token = $this->input->get_request_header('token', true);
            $u_id = $this->token->userByToken($token);
             
            $amount = $str;
            $balance = $this->update_ob->wallet($u_id, 'offset');
            $balances=$balance * 0.2;
            $profile = $this->profile->profile_info($u_id);
            $active_status = $profile->active_status;
            $name = $profile->name;
            if ($balance >= $amount) {

            if ($active_status ==0 && $amount <= $balances ) {
                $this->form_validation->set_message('check_transfer_balance', "package purchase successfully");
                return true;
            }elseif($active_status ==1) {
                $this->form_validation->set_message('check_transfer_balance', "package repurchase successfully");
                return true;
           }
            else{
                $this->form_validation->set_message('check_transfer_balance', " You can only use 20% amount of offset wallet");
                return false;
            }
         }else{
            $this->form_validation->set_message('check_transfer_balance', "Insufficient Fund in wallet.");
                return false;
            }
            

        } else {
            $this->form_validation->set_message('check_transfer_balance', "Please enter amount.");
            return false;
        }
    }

    // public function offset_wallet()
    // {
       
    //     $sdfg = $this->input->get_request_header('token', true);
    //       $u_id = $this->token->userByToken($sdfg);
    //     if ($u_id) {

    //         $this->form_validation->set_data($_POST);
    //         $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required');
    //         $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_transfer_balance|greater_than[0]');
           
    //         if ($this->form_validation->run() != False) {
    //             $res['u_id']= $_POST['u_id'];
    //             $res['amount'] = $_POST['amount'];
    //             $res['selected_wallet'] = $_POST['selected_wallet'];
    //             $res['res'] = 'success';
    //             $res['message'] = "elegible";

    //         } else {
    //             $res['res'] = 'error';
    //             $res['error_wallet'] = form_error('selected_wallet');
    //             $res['error_amount'] = form_error('amount');
    //             $res['message'] = "Something Wrong.";
    //         }
    //     } else {

    //         $res['res'] = 'error';
    //         $res['message'] = "Invalid UserId.";
    //     }

    //     print_r(json_encode($res));

    //     }

    public function topup()
    {
        $sdfg = $this->input->get_request_header('token', true);
        $u_id = $this->token->userByToken($sdfg);
        if ($u_id) {
           
            $active_username = $u_id;
            $generation_teams = $this->team->my_generation($u_id);
            $tx_u_code = $u_id;
            $up_teams = $this->team->upline_team($u_id);

            $profile = $this->profile->profile_info($tx_u_code);
            //   $pin_type =$_POST['selected_pin'];
            // $pin_details = $this->pin->pin_details($pin_type);
            $pkg_amt = $amountss = $_POST['amount'];
            $this->form_validation->set_data($_POST);
            $this->form_validation->set_rules('selected_wallet', 'Wallet', 'required');
            if (isset($_POST['offset_amount']) && $_POST['offset_amount'] != '') {
            $this->form_validation->set_rules('offset_amount', 'Amount', 'callback_check_transfer_balance|greater_than[0]');
             }
             
             if ($this->form_validation->run() != False) {

               $offset_amount =$_POST['offset_amount']?$_POST['offset_amount']:0;
            $currency2 = $_POST['currency2'];
            // $amountss = $pin_details->pin_rate;
            $check_user_statuss = $this->conn->runQuery('active_status,name,my_package', 'users', "id='$tx_u_code'");
            $tx_name = $check_user_statuss[0]->name;
            $check_user_status = $check_user_statuss[0]->active_status;
            $USer_pkgs = $check_user_statuss[0]->my_package;

            $mx_id = $this->conn->runQuery('MAX(active_id) as mx', 'users', "active_status='1'")[0]->mx;
            $active_id = ($mx_id ? $mx_id : 0) + 1;
            $check_sts = "no";

            $check_user_sts = $this->conn->runQuery('*', 'users', "id='$u_id'");
            $check_active_stss = $check_user_sts[0]->active_status;

            $orders['u_code'] = $tx_u_code;
            $orders['tx_type'] = 'purchase';
            $orders['order_amount'] = $pkg_amt;
            $orders['order_bv'] = $pkg_amt;
            $orders['roi_capping']=$pkg_amt*2;
            $orders['status'] = 0;
            $orders['offset_amount'] = $offset_amount;
            $orders['payout_id'] = $currenct_payout_id;
            $orders['payout_status'] = 0;
            $orders['invoice_no'] = $_POST['invoice'];
            $orders['active_id'] = $active_id;
            $insert_id=$this->conn->get_insert_id('orders', $orders);
            if ($insert_id!=0) {
                $res['res'] = 'success';
                $res['message'] = $orders;
                $res['order_id'] = $insert_id;
                
                $this->update_ob->add_amnt($u_id, "offset", -$offset_amount);
                $pay_amt=$pkg_amt-$offset_amount;
                $res['coinpayment']=$ss['remark']=$this->crypto->coinPayments_createPayment($insert_id,$pay_amt,'USD',$currency2);
                $this->db->insert('testing',json_encode($ss));
            } else {
                $res['res'] = 'error';
                $res['message'] = "Somthing Wrong with database! Please try again.";
            }

        }
     else {
        $res['res'] = 'error';
        $res['error_wallet'] = form_error('selected_wallet');
        $res['error_amount'] = form_error('offset_amount');
        $res['message'] = "Something Wrong.";
    }

        } else {
            $res['res'] = 'error';
            $res['tokenStatus'] = 'false';
            $res['message'] = 'Token Expired! ';
        }

        print_r(json_encode($res));
    }

    public function confirm_topup()
    {
        $sdfg = $this->input->get_request_header('token', true);
        $u_id = $this->token->userByToken($sdfg);
        if ($u_id) {
            $invoice = $_POST['orderId'];
            $getOrder = $this->conn->runQuery('*', 'orders', "id='$invoice' and status=0");
            if ($getOrder && $invoice!=0) {
                $check_user_sts = $this->conn->runQuery('*', 'users', "id='$u_id'");
                $check_active_stss = $check_user_sts[0]->active_status;
                $this->db->set('status', 1);
                $this->db->where('id', $invoice);
                if ($this->db->update('orders')) {
                    $amount = $getOrder[0]->order_amount;

                    // $offset_amount = $getOrder[0]->offset_amount;
                    // $this->update_ob->add_amnt($u_id, "offset", -$offset_amount);
                    // $u_code=$getOrder[0]->u_code;
                    // if ($this->conn->setting('level_distribution_on_topup') == 'yes') {
                    //     $this->distribute->level_destribute($u_id, $amount, 10);

                    $sponsor_info = $this->profile->sponsor_info($u_id, 'mobile,id');
                    if ($check_active_stss == 0) {
                        $update = array(
                            'active_status' => 1,
                            'active_date' => date('Y-m-d H:i:s'),
                        );
                        $this->db->where('id', $u_id);
                        $this->db->update('users', $update);

                        if ($sponsor_info) {
                            // $sponsor_mobile = $sponsor_info->mobile;
                            $tx_profile_info = $this->profile->profile_info($u_id, 'name');
                            $tx_name = $tx_profile_info->name;
                            $website = $this->conn->company_info('title');
                            $msg = "Congratulations!! $tx_name Has activated his Position. Team $website";
                            //$this->message->sms($sponsor_mobile,$msg);
                            $this->update_ob->active_gen($sponsor_info->id);
                            $this->update_ob->active_direct($sponsor_info->id);
                        }
                        // $tx_profile_info = $this->profile->profile_info($tx_u_code, 'name');
                        // $res['message'] = "Package $pin_details->pin_type Activated successfully.";
                    }
                    $res['res'] = 'success';
                }else{
                    $res['res'] = 'error';
                    $res['tokenStatus'] = 'false';
                    $res['message'] = 'Somthing Wrong with database! ';
                }
            } else {
                $res['res'] = 'error';
                $res['tokenStatus'] = 'false';
                $res['message'] = 'No pending order not found!'.$invoice;
            }
        } else {
            $res['res'] = 'error';
            $res['tokenStatus'] = 'false';
            $res['message'] = 'Token Expired! '.$sdfg;
        }
        print_r(json_encode($res));
    }

    public function check_retopup__eligible()
    {
        $sdfg = $this->input->get_request_header('token', true);

        $u_id = $this->token->userByToken($sdfg);
        if ($u_id) {
            $check_user_statuss = $this->conn->runQuery('active_status', 'users', "id='$u_id'");
            $check_user_status = $check_user_statuss[0]->active_status;
            if ($check_user_status == 1) {

                $res['res'] = 'success';
                $res['message'] = 'Eligible For Retopup';
            } else {

                $res['res'] = 'error';
                $res['message'] = 'First Activate Your id'; //'Some Error in submittion';//$errors;//json_encode(['error'=>$errors]);

            }
        } else {
            $res['res'] = 'error';
            $res['tokenStatus'] = 'false';
            $res['message'] = 'Token Expired!';
        }

        print_r(json_encode($res));
        //$this->show->user_panel('invest_topup');

    }

    public function retopup()
    {
        $sdfg = $this->input->get_request_header('token', true);

        $u_id = $this->token->userByToken($sdfg);
        if ($u_id) {

            $amount = $_POST['amount'];
            $hash = $_POST['tx_hash'];
            $staking_period = $_POST['staking_period'];
            if ($hash && $amount) {
                // $u_id = $_POST['u_id'];
                $active_username = $u_id;
                $tx_u_code = $u_id; //$this->profile->id_by_username($tx_username);
                $pin_type = $_POST['selected_pin'];
                $pin_details = $this->pin->pin_details($pin_type);
                $profile = $this->profile->profile_info($tx_u_code);
                $pin_rts = $pin_details->pin_rate;
                $max_amounts = $pin_details->max_amount;

                if ($amount >= $pin_rts && $amount <= $max_amounts) {
                    $pkg_amt = $amount;
                    $amountss = $amount;
                    $check_user_statuss = $this->conn->runQuery('active_status,name,my_package', 'users', "id='$tx_u_code'");
                    $tx_name = $check_user_statuss[0]->name;
                    $check_user_status = $check_user_statuss[0]->active_status;
                    $USer_pkgs = $check_user_statuss[0]->my_package;
                    if ($check_user_status == 1) {
                        $st = "yes";
                        $rem = "UPGRADE";
                    } else {
                        $rem = "ACTIVATION";
                        $st = "no";
                        $check_conditions = "yes";
                    }

                    //if($check_conditions=="yes"){
                    if ($st == "yes") {

                        if ($st == "no") {

                            $mx_id = $this->conn->runQuery('MAX(active_id) as mx', 'users', "active_status='1'")[0]->mx;
                            $active_id = ($mx_id ? $mx_id : 0) + 1;
                            $check_sts = "no";
                        } else {
                            $active_id = 0;
                            $pkg_amt = $amount;
                            $check_sts = "yes";
                        }
                        $token_rate = $this->conn->company_info('token_rate');
                        $amnt = $amount / $token_rate;
                        $orders['u_code'] = $tx_u_code;
                        $orders['active_id'] = $tx_u_code;
                        $orders['tx_type'] = 'repurchase';
                        $orders['subcription'] = $pin_details->pin_type;
                        $orders['order_amount'] = $amount;
                        $orders['token_rate'] = $token_rate;
                        $orders['token'] = $amnt;
                        $orders['order_mrp'] = $amount;
                        $orders['order_bv'] = $amount;
                        $orders['pv'] = $amount;
                        $orders['status'] = 1;
                        $orders['staking_period'] = $staking_period;

                        $orders['payout_status'] = 2;
                        $orders['active_id'] = $active_id;

                        if ($this->db->insert('orders', $orders)) {
                            $check_retoup = $this->conn->runQuery("retopup_status", 'users', "username='$tx_username'");
                            $retopup_status = $check_retoup[0]->retopup_status;

                            $my_ranks = "";
                            $update = array(
                                'my_package' => $pin_details->rank,
                                'retopup_status' => 1,
                                'retopup_date' => date('Y-m-d H:i:s'),
                            );

                            $this->db->where('id', $tx_u_code);
                            $this->db->update('users', $update);

                            if ($this->conn->setting('topup_type') == 'amount') {

                                //$userdetails = $this->get_user_id();
                                $u_id = $active_username; //$userdetails['u_id'];
                                $profile_detaisd = $this->profile->profile_info($u_id);
                                $username = $profile_detaisd->username;

                                $transaction['u_code'] = $u_id;
                                $transaction['tx_u_code'] = $tx_u_code;
                                $transaction['tx_type'] = "retopup";
                                $transaction['debit_credit'] = "debit";
                                $transaction['wallet_type'] = "web3";
                                $transaction['amount'] = $amount;
                                $transaction['token_rate'] = $token_rate;
                                $transaction['token'] = $amnt;
                                $transaction['date'] = date('Y-m-d H:i:s');
                                $transaction['status'] = 1;
                                $transaction['open_wallet'] = "0";
                                $transaction['closing_wallet'] = "0";
                                $transaction['remark'] = "Staked Amount  $amount ";
                                //$transaction['user_type']=$account_type;
                                $token_rate = $this->conn->company_info('token_rate');
                                $amnt = $amount / $token_rate;
                                if ($this->db->insert('transaction', $transaction)) {
                                    $this->update_ob->add_amnt($u_id, "repurchase_coin_wallet", $amnt);
                                    // $this->distribute->level_destribute($tx_u_code, $amount, 10);

                                }
                            } elseif ($this->conn->setting('topup_type') == 'pin') {
                                $pin_update_details = $this->pin->user_pins_by_type($u_id, $pin_type);
                                $pin_id = $pin_update_details[0]->id;
                                $update_details['use_status'] = 1;
                                $update_details['used_in'] = 'topup';
                                $update_details['usefor'] = $tx_u_code;
                                $this->db->where('id', $pin_id);
                                $this->db->update('epins', $update_details);
                                $cnt_tx_pre_pins = ($pin_update_details ? count($pin_update_details) : 0);
                                $pin_history['user_id'] = $u_id;
                                $pin_history['debit'] = 1;
                                $pin_history['prev_pin'] = $cnt_tx_pre_pins;
                                $pin_history['curr_pin'] = $cnt_tx_pre_pins - 1;
                                $pin_history['pin_type'] = $pin_details->pin_type;
                                $pin_history['tx_type'] = 'debit';
                                $name = $profile_detaisd->name;
                                $username = $profile_detaisd->username;
                                $pin_history['remark'] = "$name ( $username ) Topup $tx_username ";
                                $this->db->insert('pin_history', $pin_history);
                                $this->update_ob->used_pin($u_id);
                            }

                            $res['res'] = 'success';
                            $res['message'] = "Package $pin_details->pin_type Activated successfully.";
                            //$this->session->set_flashdata("success", "Package $pin_details->pin_type Activated successfully.");
                            //redirect(base_url(uri_string()));
                        } else {

                            $res['res'] = 'error';
                            $res['message'] = " Somthing Wrong with database! Please try again later.";
                            //$this->session->set_flashdata("error", "Something wrong.");
                        }
                    } else {
                        $res['res'] = 'error';
                        $res['message'] = "First Take Activation Package.";
                    }
                } else {

                    $res['res'] = 'error';
                    $res['message'] = "Invalid Amount! Amount Minimum $pin_rts And Maximum $max_amounts $ required.";
                }
            } else {

                $res['res'] = 'error';
                $res['message'] = 'amount or hash not found'; //'Some Error in submittion';//$errors;//json_encode(['error'=>$errors]);

            }
        } else {
            $res['res'] = 'error';
            $res['tokenStatus'] = 'false';
            $res['message'] = 'Token Expired!';
        }

        print_r(json_encode($res));
        //$this->show->user_panel('invest_topup');

    }

    public function check_min_balance($str)
    {
        $pin_type = $_POST['selected_pin'];
        $check_username = $this->conn->runQuery("id,pin_rate", 'pin_details', "pin_type='$pin_type' and status=1");
        if ($check_username) {
            $package_rate_min = $check_username[0]->pin_rate;
            if ($str >= $package_rate_min) {
                return true;
            } else {
                $this->form_validation->set_message('check_min_balance', "Invalid Amount! Amount Minimum $package_rate_min $ required.");
                return false;
            }
        }
    }
    public function check_username_exist()
    {
        $res['res'] = 'error';
        if (isset($_POST['username']) && $_POST['username'] != '') {
            $where['username'] = $_POST['username'];
            $details = $this->conn->runQuery('name', 'users', $where);
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
    public function check_max_balance($str)
    {
        $pin_type = $_POST['selected_pin'];
        $check_username = $this->conn->runQuery("id,pin_rate,max_amount", 'pin_details', "pin_type='$pin_type' and status=1");
        if ($check_username) {
            $package_rate_max = $check_username[0]->max_amount;

            if ($str <= $package_rate_max) {
                return true;
            } else {
                $this->form_validation->set_message('check_max_balance', "Invalid Amount! Amount Maximum $package_rate_max $ required.");
                return false;
            }
        }
    }

    public function check_wallet_balance1($str)
    {
        if (isset($_POST['selected_wallet']) && $_POST['selected_wallet'] != '') {
            $wallet = $_POST['selected_wallet'];
            $checkable = $str;
            $u_id = $this->user_id;
            $balance = $this->update_ob->wallet($u_id, $wallet);
            if ($balance >= $checkable) {
                return true;
            } else {
                $this->form_validation->set_message('check_wallet_balance1', "Insufficient Fund in wallet.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_wallet_balance1', "Please Select valid pin.");
            return false;
        }
    }

    public function get_subscription()
    {
        $sdfg = $this->input->get_request_header('token', true);
        $u_id = $this->token->userByToken($sdfg);
        if ($u_id) {

            $latest_order = $this->conn->runQuery('*', 'orders', "u_code = '$u_id' and tx_type= 'purchase' and status ='1' order by  id DESC");

            if ($latest_order) {

                $pack_name = $this->conn->runQuery('pin_type', 'pin_details', "status = '1'");

                $daily_incm = $this->conn->runQuery('SUM(amount) as amnt', 'transaction', "tx_type='income' and u_code = '$u_id' and source='roi' and status= '1' and DATE(added_on) = DATE(NOW())")[0]->amnt;
                $total_order = $this->conn->runQuery('COUNT(id) as ids', 'orders', "tx_type='purchase' and u_code = '$u_id' and status= '1'")[0]->ids;
                if ($total_order) {
                    $res['total_order'] = $total_order;
                } else {
                    $res['total_order'] = '';
                }

                $res['total_days'] = $total_days;
                if ($daily_incm) {
                    $res['daily_income'] = $daily_incm;
                } else {
                    $res['daily_income'] = 0;
                }

                $order_amount = $this->conn->runQuery('SUM(order_amount) as amnt', 'orders', "u_code = '$u_id' and status ='1'")[0]->amnt;
                if ($order_amount) {
                    $res['total_investment'] = $order_amount;
                } else {
                    $res['total_investment'] = 0;
                }
                $res['res'] = 'success';
            } else {
                $res['res'] = 'error';
                $res['daily_income'] = '';

                $res['message'] = 'Data Not Found!';
            }
        } else {
            $res['res'] = 'error';
            $res['tokenStatus'] = 'false';
            $res['message'] = 'Token Expired!';
        }

        $data1 = $this->conn->runQuery('*', 'pin_details', "status='1'");
        // $data12 = $this->conn->runQuery('*', 'pin_details', "status='1'");

        $res['package_data'] = $data1;
        // $res['package_data1'] = $data12;

        print_r(json_encode($res));
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

    public function valid_package($str)
    {
        $check_username = $this->conn->runQuery("id", 'pin_details', "pin_type='$str' and status=1");
        if ($check_username) {
            return true;
        } else {
            $this->form_validation->set_message('valid_package', "Invalid Package! Please select valid package.");
            return false;
        }
    }

    public function valid_package_retopup($str)
    {
        $check_username = $this->conn->runQuery("id,pin_rate", 'pin_details', "pin_type='$str' and status=1");
        if ($check_username) {
            $check_pin_rate = $check_username[0]->pin_rate;
            $tx_username = $input_data['tx_username'];
            $tx_u_code = $this->profile->id_by_username($tx_username);
            $my_pkg = $this->business->my_package($tx_u_code);
            if ($check_pin_rate > $my_pkg) {
                return true;
            } else {
                $this->form_validation->set_message('valid_package', "Invalid Package! Please select valid package.");
                return false;
            }
        } else {
            $this->form_validation->set_message('valid_package', "Invalid Package! Please select valid package.");
            return false;
        }
    }

    public function check_pin_available($str)
    {

        $rsss = $this->get_user_id();
        if ($rsss['res'] == 'success') {
            $u_id = $rsss['u_id'];

            $user_pins = $this->pin->user_pins_by_type($u_id, $str);
            if ($user_pins) {
                return true;
            } else {
                $this->form_validation->set_message('check_pin_available', "Insufficient pin in account .");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_pin_available', $rsss['message']);
            return false;
        }
    }

    public function check_wallet_useable($str)
    {
        $available_wallets = $this->conn->setting('invest_wallets');
        $useable_wallet = json_decode($available_wallets);
        if (array_key_exists($str, $useable_wallet)) {
            return true;
        } else {
            $this->form_validation->set_message('check_wallet_useable', "You can not Topup from this wallet");
            return false;
        }
    }

    public function get_packages()
    {
        $chk['data'] = $this->conn->runQuery("*", 'pin_details', "status='1' ");
        //$chk['level_income'] = $this->conn->runQuery("SUM(level_income) as incm", 'plan', "level_income !='NULL'")[0]->incm;
        // $chk['last_level'] = $this->conn->runQuery("COUNT(id) as ids", 'plan', "level_income !='NULL'")[0]->ids;
        // $chk['retopup_data'] = $this->conn->runQuery("pin_type", 'pin_details', "status='1' and topup_status='0'");
        // $chk['wallet_type'] = $this->conn->runQuery("*", 'invest_wallet', "type='investment'");

        $investment_conditions = $this->conn->setting('investment_conditions');
        $sts = "false";
        $days_allowed = $this->conn->setting('invest_days');

        if ($days_allowed) {

            $daysjson_decode = json_decode($days_allowed);

            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('invest_days_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('invest_days_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time && $nw_tm < $wd_end_time) {
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

        $chk['investment_message'] = $investment_conditions;
        $chk['investment_status'] = $sts;
        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function upi_detail()
    {
        $chk['data'] = $this->conn->company_info('upi');

        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }

    public function upi_success()
    {
        $input_data = $this->conn->get_input();
        if (isset($_POST['u_id']) && isset($_POST['amount'])) {

            $u_Code = $_POST['u_id'];
            $amnt = abs($_POST['amount']);
            $this->update_ob->add_amnt($u_Code, 'income_wallet', $amnt);
            $smsg = "Fund Add Sucessfully";
            $res['res'] = 'success';
            $res['message'] = $smsg;
        } else {
            $res['res'] = 'error';
            $res['message'] = "Invalid UserId.";
        }
        print_r(json_encode($res));
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

    public function check_wallet_balance_new($str)
    {
        //$input_data = $this->conn->get_input();
        if (isset($_POST['selected_pin']) && $_POST['selected_pin'] != '') {
            $checkable = $this->pin->pin_details($_POST['selected_pin'])->pin_rate;

            if ($str == 'activation_wallet') {
                $sts = 0;
            } else {
                $sts = 1;
            }

            if ($sts == 1) {

                $u_id = $this->user_id;
                $balance = $this->update_ob->wallet($u_id, $str);
                if ($balance >= $checkable) {
                    return true;
                } else {
                    $this->form_validation->set_message('check_wallet_balance_new', "Insufficient Fund in wallet.");
                    return false;
                }
            } else {

                $str1 = 'activation_wallet';
                $str2 = 'fund_wallet';

                $checkable1 = $this->pin->pin_details($_POST['selected_pin'])->pin_rate;
                $checkable = $checkable1 / 2;

                $u_id = $this->user_id;

                $balance = $this->update_ob->wallet($u_id, $str1);
                $balance1 = $this->update_ob->wallet($u_id, $str2);
                if ($balance >= $checkable && $balance1 >= $checkable) {
                    return true;
                } else {
                    $this->form_validation->set_message('check_wallet_balance_new', "Insufficient Fund in wallet.");
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('check_wallet_balance_new', "Please Select valid pin.");
            return false;
        }
    }

    public function check_wallet_balance($str)
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['selected_pin']) && $input_data['selected_pin'] != '') {

            if ($str == 'activation_wallet') {
                $sts = 0;
            } else {
                $sts = 1;
            }

            if ($sts == 1) {
                $checkable = $this->pin->pin_details($input_data['selected_pin'])->pin_rate;
                $rsss = $this->get_user_id();
                if ($rsss['res'] == 'success') {
                    $u_id = $rsss['u_id'];
                    $balance = $this->update_ob->wallet($u_id, $str);
                    if ($balance >= $checkable) {
                        return true;
                    } else {
                        $this->form_validation->set_message('check_wallet_balance', "Insufficient Fund in wallet.");
                        return false;
                    }
                } else {
                    $this->form_validation->set_message('check_wallet_balance', $rsss['message']);
                    return false;
                }
            } else {

                $str1 = 'activation_wallet';
                $str2 = 'fund_wallet';

                $checkable1 = $this->pin->pin_details($input_data['selected_pin'])->pin_rate;
                $checkable = $checkable1 / 2;
                $rsss = $this->get_user_id();
                if ($rsss['res'] == 'success') {
                    $u_id = $rsss['u_id'];

                    $balance = $this->update_ob->wallet($u_id, $str1);
                    $balance1 = $this->update_ob->wallet($u_id, $str2);
                    if ($balance >= $checkable && $balance1 >= $checkable) {
                        return true;
                    } else {
                        $this->form_validation->set_message('check_wallet_balance', "Insufficient Fund in wallet.");
                        return false;
                    }
                } else {
                    $this->form_validation->set_message('check_wallet_balance', $rsss['message']);
                    return false;
                }
            }
        } else {
            $this->form_validation->set_message('check_wallet_balance', "Please Select valid pin.");
            return false;
        }
    }

    public function check_pre_topup($str)
    {
        if ($str != '') {

            $chk = $this->conn->runQuery("id", 'users', "username='$str' and active_status='1'");
            if ($chk) {
                return true;
            } else {
                $this->form_validation->set_message('check_pre_topup', "Please activate your account before repurchase token.");
                return false;
            }
        } else {
            $this->form_validation->set_message('check_pre_topup', "Please enter username.");
            return false;
        }
    }
    public function already_topup($str)
    {
        if ($str != '') {

            $chk = $this->conn->runQuery("id", 'users', "username='$str' and active_status='1'");
            if ($chk) {
                $this->form_validation->set_message('already_topup', "User already have active package.");
                return false;
            } else {
                return true;
            }
        } else {
            $this->form_validation->set_message('already_topup', "Please enter username.");
            return false;
        }
    }

    public function pin_detail()
    {
        $type = trim($_POST['selected_pin']);
        $u_id = $this->session->userdata('user_id');
        $res = '';
        $get_pin_detail = $this->conn->runQuery('*', "epins", "pin_type LIKE '%$type%' and use_status='0' and u_code='$u_id'");
        //echo  $sql = $this->db->last_query();
        if ($get_pin_detail) {
            $res = count($get_pin_detail);
        } else {
            $res = 0;
        }
        echo $res;
    }

    public function get_invest_time()
    {
        $sts = false;
        $days_allowed = $this->conn->setting('invest_days');
        if ($days_allowed) {
            $daysjson_decode = json_decode($days_allowed);
            if (in_array(date('l'), $daysjson_decode)) {

                $wd_start_time = $this->conn->setting('invest_days_start_time');
                $str_time = date('H:i:s', strtotime($wd_start_time));
                $wd_end_time = $this->conn->setting('invest_days_end_time');
                $end_time = date('H:i:s', strtotime($wd_end_time));
                $nw_tm = date('H:i:s');
                if ($nw_tm >= $str_time && $nw_tm < $wd_end_time) {
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

        $chk['investment_status'] = $sts;
        // $chk['wallet_type']= $this->conn->runQuery("*",'invest_wallet',"type='withdrawal'");
        $chk['res'] = 'success';
        print_r(json_encode($chk));
    }
}
