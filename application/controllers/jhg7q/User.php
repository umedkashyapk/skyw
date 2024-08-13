<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $key_data2 = $this->conn->runQuery('*', 'api_key', "key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }

    /*    $check_status=$this->notification->read_status($u_code,$n_id);
    if($check_status===false){
    $arr=array();
    $arr['n_id']=$n_id;
    $arr['u_code']=$u_code;
    $this->db->insert('notifications_viewers',$arr);

    $this->db->set('notifications', "notifications-1", FALSE);
    $this->db->where('id', $u_code);
    $this->db->update('users');
    }*/

    public function other_content()
    {

        $other_info = $this->conn->runQuery('*', 'home_sliders', "status='1'");
        if ($other_info) {
            $details['banner'] = $other_info;
        } else {
            $details['banner'] = array();
        }

        $noti_info = $this->conn->runQuery('*', 'notice_board', "type='marquee' order by id desc LIMIT 1");

        if ($noti_info) {
            $details['news'] = $noti_info;
        } else {
            $details['news'] = array();
        }
        $pop_info = $this->conn->runQuery('*', 'notice_board', "type='popup' order by id desc LIMIT 1");

        if ($pop_info) {
            $details['popup'] = $pop_info;
        } else {
            $details['popup'] = array();
        }

        $video = $this->conn->runQuery('*', 'youtube_video', "1=1");
        if ($video) {
            $details['video'] = $video;
        } else {
            $details['video'] = array();
        }

        $details['res'] = 'success';
        $details['message'] = '';
        $result = $details;

        print_r(json_encode($result));
    }

    public function legal()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $all_legal = $this->conn->runQuery("*", 'legal_data', "lega_page_type='legals'");
            if (!empty($all_legal)) {
                $nn = 0;
                foreach ($all_legal as $all_legal1) {
                    $nn++;
                    $detailss = json_decode(json_encode($all_legal1), true);
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;
                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;
        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();
        }
        print_r(json_encode($result));
    }

    public function orders()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $u_ids = $input_data['u_id'];
            $all_legal = $this->conn->runQuery("order_amount,added_on", 'orders', "u_code='$u_ids'");
            if (!empty($all_legal)) {
                $nn = 0;
                foreach ($all_legal as $all_legal1) {
                    $nn++;
                    $detailss = json_decode(json_encode($all_legal1), true);
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;
                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;
        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();
        }
        print_r(json_encode($result));
    }

    public function notification()
    {
        //$input_data = $this->conn->get_input();
        if (isset($_POST['u_id'])) {
            $u_code = $_POST['u_id'];
            //    $join_date=$input_data['join_date'];
            $all_notifications = $this->notification->all_notifications($u_code);
            if (!empty($all_notifications)) {
                $nn = 0;
                foreach ($all_notifications as $notification) {
                    $nn++;
                    $n_id = $notification->id;
                    $check_read = $this->notification->read_status($u_code, $n_id);
                    $detailss = json_decode(json_encode($notification), true);

                    if ($check_read === false) {
                        $arr = array();
                        $arr['n_id'] = $n_id;
                        $arr['u_code'] = $u_code;
                        $this->db->insert('notifications_viewers', $arr);

                        $this->db->set('notifications', "notifications-1", false);
                        $this->db->where('id', $u_code);
                        $this->db->update('users');
                    }

                    $detailss['status'] = $check_read;
                    $data[] = $detailss;
                    $details['data'] = $data;
                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;
        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();
        }
        print_r(json_encode($result));
    }

    public function sponsor_info()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {

            $details = json_decode(json_encode($this->profile->profile_info($input_data['u_id'])), true);
            $sponsor = $details['u_sponsor'];
            if ($sponsor != '' && $sponsor != 0) {
                $sp_details = $this->profile->profile_info($sponsor);
                $result['sponsor_name'] = $sp_details->name;
                $result['username'] = $sp_details->username;
                $result['wallet_address'] = $sp_details->wallet_address;
            } else {
                $result['massage'] = "does not have sponssor";
            }
        } else {
            $result['massage'] = "does not post u_id";
        }

        print_r(json_encode($result));
    }
    public function info()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {

            $details = json_decode(json_encode($this->profile->profile_info($input_data['u_id'])), true);
            $sponsor = $details['u_sponsor'];

            if ($sponsor != '' && $sponsor != 0) {
                $sp_details = $this->profile->profile_info($sponsor);
                $details['sponsor_name'] = $sp_details->name;
                $details['sponsor_username'] = $sp_details->username;
                $details['sponsor_mobile'] = $sp_details->mobile;
            } else {
                $details['sponsor_name'] = '';
                $details['sponsor_username'] = '';
                $details['sponsor_mobile'] = '';
            }

            $result['message'] = '';
            $result['res'] = 'success';
            $result['myaccount_info'] = $details;
            $result['wallet']['balance'] = $this->update_ob->wallet($input_data['u_id'], 'main_wallet');
        } else {
            $result['res'] = 'error';
            $result['message'] = 'User Id Required.';
            $result['myaccount_info'] = array();
            $result['wallet']['balance'] = 0;
        }

        print_r(json_encode($result));
    }
    public function pool_data()
    {

        $user_id = $this->input->post('u_id');
        $result['g1'] = $this->team->matrix_pool_data($u_id, 'g1');
        print_r(json_encode($result));
    }

    public function business_info()
    {
        $user_id = $this->input->post('u_id');
        if (isset($user_id)) {
            $profile_info = $this->conn->runQuery('*', 'users', "id='$user_id'");
            $details['profile'] = $profile_info;
            $result = $details;
            $result['rank'] = $this->goal->rank($user_id);
        } else {
            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
        }

        print_r(json_encode($result));
    }

    public function dashboard()
    {

        $user_id = $this->input->post('u_id');

        $etsting = array();
        $etsting['remark'] = $_POST['u_id'];
        $this->db->insert('testing', $etsting);
        if (isset($user_id)) {
            // $user_id = $_POST['u_id'];
            $details['rank'] = $this->goal->rank($user_id);

            $this->distribute->roi_all_orders($user_id);  ///Distribute income on all pending orders

            $plan_type = $this->conn->setting('reg_type');
            $currency = $this->conn->company_info('currency');
            $incomes = $this->conn->runQuery("*", 'wallet_types', "wallet_type='income' and  status='1' and $plan_type='1'");
            $team = $this->conn->runQuery("*", 'wallet_types', "wallet_type='team' and  status='1' and $plan_type='1'");
            $wallets = $this->conn->runQuery("*", 'wallet_types', "wallet_type IN ('wallet','pin') and  status='1'  and $plan_type='1'");

            $w_balance = $this->conn->runQuery('*', 'user_wallets', "u_code='$user_id'");
            $wallet_balance = $w_balance ? $w_balance[0] : array();

            //$total_earning1=$this->conn->runQuery('SUM(amount) as total','transaction',"u_code='$user_id' and tx_type='income'")[0]->total;
            // $total_earning1 = $this->conn->runQuery('SUM(`c3`+`c4`+`c5`+`c6`+`c7`+`c15`+`c16`+`c17`) as total', 'user_wallets', "u_code='$user_id'")[0]->total;
            $total_earning1 = $this->wallet->income($user_id, 'main_wallet');
            $total_earning = $total_earning1 != '' ? $total_earning1 : "0";

            $my_pkgs = $this->business->my_package($user_id);
            $my_pkg = $my_pkgs != '' ? $my_pkgs : 0;


            $total_community_buss = $this->business->total_community_business($user_id);
            $totals_community_bv = array_SUM($total_community_buss);
            $total_team_bv = $this->business->team_business($user_id);

            $orders_details = $this->conn->runQuery('order_amount,roi_capping', 'orders', "u_code='$user_id' and status=1");

            if ($orders_details) {
                $sr = 1;
                foreach ($orders_details as $orders_details1) {
                    $order_amount = $orders_details1->order_amount;
                    $detailss = json_decode(json_encode($orders_details1), true);

                    $detailss['capping'] = $total_cappi = $orders_details1->roi_capping;
                    $detailss['pkg_earning'] = $total_earning;
                    // $detailss['pkg_percentage'] = round($total_earning * 100 / $total_cappi);

                    $data[] = $detailss;
                    $details['pkg_info'] = $data;
                    $sr++;
                }
            } else {
                $details['pkg_info'] = array();
            }


            $crypto = $this->conn->runQuery('news', 'crypto_news', "id=1");
            if ($crypto) {
                $pri = json_decode($crypto[0]->news, true);
                $details['latest_news'] = $pri['articles'][0];
            }

            $other_info = $this->conn->runQuery('*', 'home_sliders', "status='1'");
            if ($other_info) {
                $details['banner'] = $other_info;
            } else {
                $details['banner'] = array();
            }

            $telegram = $this->conn->runQuery('value', 'company_info', "label='company_telegram_link'")[0];
            if ($telegram) {

                $details['telegram_link'] = $telegram->value;
            }

            $facebook = $this->conn->runQuery('value', 'company_info', "label='company_facebook_link'")[0];
            if ($facebook) {

                $details['facebook_link'] = $facebook->value;
            }

            $twitter = $this->conn->runQuery('value', 'company_info', "label='company_twitter_link'")[0];
            if ($twitter) {

                $details['twitter_link'] = $twitter->value;
            }

            $noti_info = $this->conn->runQuery('*', 'notice_board', "type='marquee' order by id desc LIMIT 1");

            if ($noti_info) {
                $details['news'] = $noti_info;
            } else {
                $details['news'] = array();
            }
            $pop_info = $this->conn->runQuery('*', 'notice_board', "type='popup' order by id desc LIMIT 1");

            if ($pop_info) {
                $details['popup'] = $pop_info;
            } else {
                $details['popup'] = array();
            }




            $company_url = $this->conn->company_info('base_url');
            $incomearr = array();
            if ($incomes) {
                $i = 1;
                foreach ($incomes as $income) {
                    $obj = new stdClass();
                    $obj->name = $income->name;
                    $obj->value = (!empty($wallet_balance) && isset($wallet_balance->{$income->wallet_column})) ? $wallet_balance->{$income->wallet_column} : 0;
                    $obj->icons = $company_url . '/images/icons/' . $i . '.svg';
                    $incomearr[] = $obj;
                    $i++;
                }
            }

            $teamarr = array();
            if ($team) {
                foreach ($team as $teama) {
                    $slug = $teama->wallet_column;
                    $teamarr[$teama->slug] = (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0);
                }
            }

            $walletarr = array();
            if ($wallets) {
                foreach ($wallets as $walletss) {
                    $obj = new stdClass();
                    $slug = $walletss->wallet_column;
                    $obj->name = $walletss->name;
                    $walletarr[$walletss->slug] = (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0);
                    $walletarr[] = $obj;
                }
            }

            $account_info = $this->conn->runQuery('*', 'user_accounts', "u_code = '$user_id'");
            $profile_info = $this->conn->runQuery('*', 'users', "id='$user_id'");
            $details['profile'] = $profile_info;
            $details['account_info'] = $account_info;
            $sponsor = $profile_info[0]->u_sponsor;
            if ($sponsor != '' && $sponsor != 0) {
                $sp_details = $this->profile->profile_info($sponsor);
                $details['sponsor_name'] = $sp_details->name;
                $details['sponsor_username'] = $sp_details->username;
                $details['sponsor_mobile'] = $sp_details->mobile;
            } else {
                $details['sponsor_name'] = '';
                $details['sponsor_username'] = '';
                $details['sponsor_mobile'] = '';
            }

            $my_universal = $this->team->my_active_single_leg($user_id);




            $first_date = date('Y-m-d H:i:s', strtotime('first day of last month'));
            $last_date = date('Y-m-d H:i:s', strtotime('last day of this month'));
            $community_buss = $this->business->community_business($user_id, $first_date, $last_date);
            $total_community_inc = array_SUM($community_buss);

            $check_directs = $this->conn->runQuery('SUM(amount) as amts', 'transaction', "tx_type='income' and u_code='$user_id' and date>='$first_date' and date<='$last_date' and source!='self_bonus'");
            $total_income1 = $check_directs[0]->amts;

            // $lastest_repurchase = $this->conn->runQuery('*', 'orders', "u_code='$user_id' and tx_type='repurchase' and status=1 order by id desc LIMIT 1");
            $purchase = $this->conn->runQuery('SUM(order_amount) as order_amount', 'orders', "u_code='$user_id' and tx_type='purchase' and status=1");
            if ($purchase) {
                $total_investment = $purchase[0]->order_amount;
            }
            $pool_wallets = $this->conn->runQuery('c26,c27', 'user_wallets', "u_code=1");
            $details['level_pool'] = $pool_wallets[0]->c26;
            $details['runner_pool'] = $pool_wallets[0]->c27;

            $details['universal_team'] = $my_universal != "" ? COUNT($my_universal) : 0;
            $details['wallets'] = $walletarr;
            $details['incomes'] = $incomearr;
            $details['teams'] = $teamarr;
            $details['package'] = $total_investment;
            $details['total_earning'] = $total_earning;
            $details['current_month_community'] = $total_community_inc + $total_income1;
            $details['total_community'] = $totals_community_bv;
            $details['team_business'] = ($total_team_bv ? $total_team_bv : 0);
            $details['directs_business'] = $this->business->directs_business($user_id);
            $details['token_rate'] = $this->conn->company_info('token_rate');
            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;
        } else {
            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['weekly_income'] = array();
            $result['incomes'] = array();
            $result['teams'] = array();
            $result['wallets'] = array();
            $details['package'] = 0;
        }
        print_r(json_encode($result));
    }

    public function meta_request()
    {
        $u_id = $this->input->post('u_id');
        if ($u_id != '') {

            $Order = $this->conn->runQuery('*', "orders", "tx_type='repurchase' and u_code='$u_id'");
            if ($Order) {
                $Order = $this->conn->runQuery('SUM(order_amount) as order_amt', "orders", "tx_type='repurchase' and u_code='$u_id'");
                $total_amts = $Order[0]->order_amt;
                if ($total_amts >= 5000) {

                    $check_Orders = $this->conn->runQuery('*', "meta_request", "u_code='$u_id'");
                    if (empty($check_Orders)) {

                        $orderss['u_code'] = $u_id;
                        $orderss['amount'] = $total_amts;
                        $orderss['type'] = 'admin';
                        $orderss['status'] = '0';

                        $this->db->insert('meta_request', $orderss);
                        $result['res'] = 'success';
                        $result['message'] = 'Request detail send on your mail';
                    } else {
                        $result['res'] = 'error';
                        $result['message'] = 'Already Take Request';
                    }
                } else {
                    $check_Orders = $this->conn->runQuery('*', "meta_request", "u_code='$u_id'");
                    if (empty($check_Orders)) {

                        $orderss['u_code'] = $u_id;
                        $orderss['amount'] = $total_amts;
                        $orderss['type'] = 'user';
                        $this->db->insert('meta_request', $orderss);

                        $users_detailss = $this->conn->runQuery('email', "users", "id='$u_id'");
                        $msg2 = "success";
                        //$this->message->send_mail($users_detailss[0]->email,'MT5',$msg2,$u_id); //please uncomment this line after live
                        $result['res'] = 'success';
                        $result['message'] = 'Request detail send on your mail.';
                    } else {

                        $result['res'] = 'error';
                        $result['message'] = 'Already Take Request.';
                    }
                }
            } else {
                $result['res'] = 'error';
                $result['message'] = 'Please take subcription package.';
            }
        } else {
            $result['res'] = 'error';
            $result['message'] = 'Data Not Found!';
        }
        print_r(json_encode($result));
    }

    public function mission()
    {

        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $user_id = $input_data['u_id'];

            $plan_type = $this->conn->setting('reg_type');
            $currency = $this->conn->company_info('currency');
            $incomes = $this->conn->runQuery("*", 'wallet_types', "wallet_type='income' and  status='1' and $plan_type='1'");
            $team = $this->conn->runQuery("*", 'wallet_types', "wallet_type='team' and  status='1' and $plan_type='1'");
            $wallets = $this->conn->runQuery("*", 'wallet_types', "wallet_type IN ('wallet','pin') and  status='1'  and $plan_type='1'");

            $w_balance = $this->conn->runQuery('*', 'user_wallets', "u_code='$user_id'");
            $wallet_balance = $w_balance ? $w_balance[0] : array();

            $total_earning1 = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='income'")[0]->total;
            $total_earning = $total_earning1 != '' ? $total_earning1 : "0";
            $my_pkg = $this->business->my_package($user_id);

            $datetime = date('Y-m-d H:i:s');
            $curr_total_earning1 = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='income' and DATE(date)=DATE('$datetime')")[0]->total;
            $total_earning_curr = $curr_total_earning1 != '' ? $curr_total_earning1 : "0";

            $effectiveDate = date('Y-m-d  H:i:s', strtotime("-1 day", strtotime($datetime)));
            $yes_total_earning1 = $this->conn->runQuery('SUM(amount) as total', 'transaction', "u_code='$user_id' and tx_type='income' and DATE(date)=DATE('$effectiveDate')")[0]->total;
            $total_earning_yes = $yes_total_earning1 != '' ? $yes_total_earning1 : "0";

            $incomearr = array();
            if ($incomes) {
                foreach ($incomes as $income) {
                    $slug = $income->wallet_column;
                    $incomearr[$income->slug] = (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0);
                }
            }

            $walletarr = array();
            if ($wallets) {
                foreach ($wallets as $walletss) {
                    $slug = $walletss->wallet_column;
                    $walletarr[$walletss->slug] = (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0);
                }
            }

            $details['wallets'] = $walletarr;
            $details['incomes'] = $incomearr;
            $details['teams'] = $teamarr;
            $details['package'] = (int) $my_pkg;
            $details['total_earning'] = $total_earning;
            $details['current_day'] = $total_earning_curr;
            $details['yesterday'] = $total_earning_yes;

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;
        } else {
            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['weekly_income'] = array();
            $result['incomes'] = array();
            $result['teams'] = array();
            $result['wallets'] = array();
            $details['package'] = 0;
            $details['total_earning'] = array();
        }

        print_r(json_encode($result));
    }

    public function graph()
    {
        //echo strtotime(date('Y-11-12 H:i:s'));
        // die();
        $data['var'] = strtotime(date('Y-m-d H:i:s')) . '000';
        $this->load->view('User_panel/pages/graph', $data);
    }

    public function send_otp()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_code"]) && isset($input_data["otp_type"])) {
            $otp_type = $input_data["otp_type"];
            $u_id = $input_data["u_code"];
            $profile = $this->profile->profile_info($input_data["u_code"]);
            if ($profile) {
                $email = $profile->email;
                $mobile = $profile->mobile;
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
                if ($sel_qq1) {
                    $otp = $sel_qq1[0]->otp;
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
                    $ottp = "$otp is your OTP for changing the security pin. Thanks $company_name team. For more visit $company_url, $company_name";
                } else if ($otp_type == 'forgot_tx_pin' || $otp_type == 'change_tx_pin') {
                    $ottp = "$otp is your OTP for changing transaction pin. Thanks $company_name team. For more visit $company_url, $company_name";
                } elseif ($otp_type == 'withdrawal') {
                    $ottp = "$otp is your OTP for withdrawal. Thanks $company_name team.";
                    
                } elseif ($otp_type == 'edit_profile') {
                    $ottp = "$otp is your OTP for Edit Profile. Thanks $company_name team.";
                } else {
                    $this->message->send_mail($email, 'OTP Send', $ottp,$u_id);
                }
                 $this->message->send_mail($email, 'OTP Send', $ottp,$u_id);
                // $this->message->sms($mobile,$ottp);

                $res['sms'] = $ottp;
                $res['res'] = "success";
                $res['message'] = "$otp OTP sent Successfully!";
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

    public function send_forget_otp()
    {
        //$input_data = $this->conn->get_input();
        if (isset($_POST["u_code"]) && isset($_POST["otp_type"])) {
            $otp_type = $_POST["otp_type"];
            $u_code = $_POST["u_code"];
            $u_id = $this->profile->id_by_username($u_code);

            if ($u_id) {
                $profile = $this->profile->profile_info($u_id);

                if ($profile) {
                    $mobile = $profile->mobile;
                    $email = $profile->email;
                    $name = $profile->name;
                    $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");

                    if ($sel_qq1) {
                        $otp = $sel_qq1[0]->otp;
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
                       // $ottp = "Your OTP for withdrawal";
                        $ottp="$otp is your OTP for changing the security pin. Thanks $company_name team. For more visit $company_url, $company_name";
                    } else if ($otp_type == 'forgot_tx_pin' || $otp_type == 'change_tx_pin') {
                        $ottp = "Your OTP for changing transaction pin";
                    } else {
                       // $ottp = "Your OTP for forget password";
                        $ottp="$otp is your OTP for forgot password. Thanks $company_name team. For more visit $company_url,";
                    }

                    // $this->message->send_mail_reg2($email,'OTP',$ottp); //please uncomment this line after live
                    $this->message->send_mail($email, 'OTP', $ottp, $u_id); //please uncomment this line after live
                   
                    //$res['sms'] = $ottp;
                    $res['res'] = "success";
                    $res['message'] = "OTP sent Successfully!";
                } else {
                    $res['res'] = 'error';
                    $res['res'] = 'User not found!';
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

    public function profile_update()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_code"]) && isset($input_data["otp_type"]) && isset($input_data["entered_otp"]) && isset($input_data["new_address"])) {
            $u_code = $input_data["u_code"];
            $otp_type = $input_data["otp_type"];

            $entered_otp = $input_data["entered_otp"];
            $new_password = $input_data["new_address"];
            $check_username = $this->conn->runQuery('*', 'users', "username='$u_code'");
            if ($check_username) {
                $profile = $check_username[0];
                $u_id = $profile->id;
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
                if ($sel_qq1) {
                    $otp = $sel_qq1[0]->otp;

                    if ($otp == $entered_otp) {

                        $change = array();
                        $change['tron_address'] = $new_password;
                        $this->db->where('u_code', $u_id);
                        if ($this->db->update('user_accounts', $change)) {

                            $res['res'] = "success";
                            $res['message'] = "Profile Updated Successfully";
                        } else {
                            $res['res'] = "error";
                            $res['message'] = "Error in database.";
                        }
                    } else {
                        $res['res'] = "otp_not_matched";
                        $res['message'] = "Otp does not match";
                    }
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Not have otp.";
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "User account not found for this username";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }
    public function change_password()
    {
        ///$input_data = $this->conn->get_input();
        if (isset($_POST["u_id"]) && isset($_POST["old_password"]) && isset($_POST["new_password"])) {
            $u_id = $_POST["u_id"];
            $old_password = md5($_POST["old_password"]);
            $new_password = md5($_POST["new_password"]);
            $profile = $this->profile->profile_info($u_id);
            $db_old_pass = $profile->password;
            if ($db_old_pass == $old_password) {
                $change = array();
                $change['password'] = $new_password;
                $this->db->where('id', $u_id);
                if ($this->db->update('users', $change)) {

                    $res['session_key'] = stripslashes($this->conn->aes128Encrypt($profile->username . "_" . $new_password, $this->session_encryption_key));

                    $res['res'] = "success";
                    $res['message'] = "Password Updated Successfully";
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Error in database.";
                }
            } else {
                $res['res'] = "failure";
                $res['message'] = "Old password does not match";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function change_security_pin()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_id"]) && isset($input_data["old_securitypin"]) && isset($input_data["new_securitypin"])) {
            $u_id = $input_data["u_id"];
            $old_password = $input_data["old_securitypin"];
            $new_password = $input_data["new_securitypin"];
            $profile = $this->profile->profile_info($u_id);
            $db_old_pass = $profile->security_pin;
            if ($db_old_pass == $old_password) {
                $change = array();
                $change['security_pin'] = $new_password;
                $this->db->where('id', $u_id);
                if ($this->db->update('users', $change)) {

                    //$res['session_key'] = stripslashes($this->conn->aes128Encrypt($profile->username."_".$new_password,$this->session_encryption_key));

                    $res['res'] = "success";
                    $res['message'] = "Security Pin Updated Successfully";
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Error in database.";
                }
            } else {
                $res['res'] = "failure";
                $res['message'] = "Old Security Pin does not match";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function change_tx_pin()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_id"]) && isset($input_data["old_tx_pin"]) && isset($input_data["new_tx_pin"])) {
            $u_id = $input_data["u_id"];
            $old_password = $input_data["old_tx_pin"];
            $new_password = $input_data["new_tx_pin"];
            $profile = $this->profile->profile_info($u_id);
            $db_old_pass = $profile->tx_password;
            if ($db_old_pass == $old_password) {
                $change = array();
                $change['tx_password'] = $new_password;
                $this->db->where('id', $u_id);
                if ($this->db->update('users', $change)) {

                    //$res['session_key'] = stripslashes($this->conn->aes128Encrypt($profile->username."_".$new_password,$this->session_encryption_key));

                    $res['res'] = "success";
                    $res['message'] = "TX Pin Updated Successfully";
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Error in database.";
                }
            } else {
                $res['res'] = "failure";
                $res['message'] = "Old TX Pin does not match";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function change_password_otp()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_id"]) && isset($input_data["otp_type"]) && isset($input_data["old_password"]) && isset($input_data["entered_otp"]) && isset($input_data["new_password"])) {
            $u_id = $input_data["u_id"];
            $otp_type = $input_data["otp_type"];
            $old_password = md5($input_data["old_password"]);
            $entered_otp = $input_data["entered_otp"];
            $new_password = md5($input_data["new_password"]);
            $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
            if ($sel_qq1) {
                $otp = $sel_qq1[0]->otp;

                if ($otp == $entered_otp) {
                    $profile = $this->profile->profile_info($u_id);
                    $db_old_pass = $profile->password;
                    if ($db_old_pass == $old_password) {
                        $change = array();
                        $change['password'] = $new_password;
                        $this->db->where('id', $u_id);
                        if ($this->db->update('users', $change)) {

                            $res['session_key'] = stripslashes($this->conn->aes128Encrypt($profile->username . "_" . $new_password, $this->session_encryption_key));

                            $res['res'] = "success";
                            $res['message'] = "Password Updated Successfully";
                        } else {
                            $res['res'] = "error";
                            $res['message'] = "Error in database.";
                        }
                    } else {
                        $res['res'] = "failure";
                        $res['message'] = "Old password does not match";
                    }
                } else {
                    $res['res'] = "otp_not_matched";
                    $res['message'] = "Otp does not match";
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "Not have otp.";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function forget_password()
    {
        // $input_data = $this->conn->get_input();
        if (isset($_POST["u_code"]) && isset($_POST["otp_type"]) && isset($_POST["entered_otp"]) && isset($_POST["new_password"])) {
            $u_code = $_POST["u_code"];
            $otp_type = $_POST["otp_type"];

            $entered_otp = $_POST["entered_otp"];
            $new_password = md5($_POST["new_password"]);
            $check_username = $this->conn->runQuery('*', 'users', "username='$u_code'");
            if ($check_username) {
                $profile = $check_username[0];
                $u_id = $profile->id;
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
                if ($sel_qq1) {
                    $otp = $sel_qq1[0]->otp;

                    if ($otp == $entered_otp) {

                        $change = array();
                        $change['password'] = $new_password;
                        $this->db->where('id', $u_id);
                        if ($this->db->update('users', $change)) {

                            $res['res'] = "success";
                            $res['message'] = "Password Updated Successfully";
                        } else {
                            $res['res'] = "error";
                            $res['message'] = "Error in database.";
                        }
                    } else {
                        $res['res'] = "otp_not_matched";
                        $res['message'] = "Otp does not match";
                    }
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Not have otp.";
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "User account not found for this username";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function forget_securitypin()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_code"]) && isset($input_data["otp_type"]) && isset($input_data["entered_otp"]) && isset($input_data["new_securitypin"])) {
            $u_code = $input_data["u_code"];
            $otp_type = $input_data["otp_type"];

            $entered_otp = $input_data["entered_otp"];
            $new_securitypin = $input_data["new_securitypin"];
            $check_username = $this->conn->runQuery('*', 'users', "username='$u_code'");
            if ($check_username) {
                $profile = $check_username[0];
                $u_id = $profile->id;
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
                if ($sel_qq1) {
                    $otp = $sel_qq1[0]->otp;

                    if ($otp == $entered_otp) {

                        $change = array();
                        $change['security_pin'] = $new_securitypin;
                        $this->db->where('id', $u_id);
                        if ($this->db->update('users', $change)) {

                            $res['res'] = "success";
                            $res['message'] = "Security Pin has been reset successfully";
                        } else {
                            $res['res'] = "error";
                            $res['message'] = "Error in database.";
                        }
                    } else {
                        $res['res'] = "otp_not_matched";
                        $res['message'] = "Otp does not match";
                    }
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Not have otp.";
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "User account not found for this username";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function forget_tx_pin()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_code"]) && isset($input_data["otp_type"]) && isset($input_data["entered_otp"]) && isset($input_data["new_securitypin"])) {
            $u_code = $input_data["u_code"];
            $otp_type = $input_data["otp_type"];

            $entered_otp = $input_data["entered_otp"];
            $new_securitypin = $input_data["new_securitypin"];
            $check_username = $this->conn->runQuery('*', 'users', "username='$u_code'");
            if ($check_username) {
                $profile = $check_username[0];
                $u_id = $profile->id;
                $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
                if ($sel_qq1) {
                    $otp = $sel_qq1[0]->otp;

                    if ($otp == $entered_otp) {

                        $change = array();
                        $change['tx_password'] = $new_securitypin;
                        $this->db->where('id', $u_id);
                        if ($this->db->update('users', $change)) {

                            $res['res'] = "success";
                            $res['message'] = "Tx Pin has been reset successfully";
                        } else {
                            $res['res'] = "error";
                            $res['message'] = "Error in database.";
                        }
                    } else {
                        $res['res'] = "otp_not_matched";
                        $res['message'] = "Otp does not match";
                    }
                } else {
                    $res['res'] = "error";
                    $res['message'] = "Not have otp.";
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "User account not found for this username";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function change_security_pin_old()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data["u_id"]) && isset($input_data["otp_type"]) && isset($input_data["old_securitypin"]) && isset($input_data["entered_otp"]) && isset($input_data["new_securitypin"])) {
            $u_id = $input_data["u_id"];
            $otp_type = $input_data["otp_type"];
            $old_securitypin = $input_data["old_securitypin"];
            $entered_otp = $input_data["entered_otp"];
            $new_securitypin = $input_data["new_securitypin"];
            $sel_qq1 = $this->conn->runQuery('*', 'api_otp', " u_id='$u_id' AND  otp_type='$otp_type'");
            if ($sel_qq1) {
                $otp = $sel_qq1[0]->otp;

                if ($otp == $entered_otp) {
                    $profile = $this->profile->profile_info($u_id);
                    $db_old_pass = $profile->security_pin;
                    if ($db_old_pass == $old_securitypin) {
                        $change = array();
                        $change['security_pin'] = $new_securitypin;
                        $this->db->where('id', $u_id);
                        if ($this->db->update('users', $change)) {

                            // $res['session_key'] = stripslashes($this->conn->aes128Encrypt($profile->username."_".$new_password,$this->session_encryption_key));

                            $res['res'] = "success";
                            $res['message'] = "Security Pin Updated Successfully";
                        } else {
                            $res['res'] = "error";
                            $res['message'] = "Error in database.";
                        }
                    } else {
                        $res['res'] = "failure";
                        $res['message'] = "Old Security Pin does not match";
                    }
                } else {
                    $res['res'] = "otp_not_matched";
                    $res['message'] = "Otp does not match";
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "Not have otp.";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function accounts()
    {

        $company_payment_methods = $this->conn->runQuery('*', 'company_payment_methods', "status='1'");

        $data = json_decode(json_encode($company_payment_methods), true);

        $res['res'] = 'success';
        $res['message'] = '';
        $res['data'] = $data;
        print_r(json_encode($res));
    }

    public function add_account()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['account_type']) && isset($input_data['u_id'])) {

            $payment_type = $input_data['account_type'];
            $u_code = $input_data['u_id'];

            $method_details_arr = $this->conn->runQuery('*', 'company_payment_methods', "status='1' and unique_name='$payment_type'");
            $method_details = $method_details_arr && $method_details_arr[0]->fields_required != '' ? json_decode($method_details_arr[0]->fields_required, true) : false;
            if ($method_details) {
                $check_user_account = $this->conn->runQuery('*', 'user_payment_methods', "u_code='$u_code'");
                $account_details = array();
                if ($payment_type != 'bank') {
                    $val = $input_data['account_val'];
                    foreach ($method_details as $_key => $method_detail) {
                        $account_details[$_key] = $val;
                    }
                } else {
                    foreach ($method_details as $_key => $method_detail) {
                        $account_details[$_key] = $input_data[$_key];
                    }
                }
                $account_details['account_type'] = $input_data['account_type'];

                if ($check_user_account) {
                    $acc = $check_user_account[0]->accounts != '' ? json_decode($check_user_account[0]->accounts, true) : array();

                    $account_details['account_type'] = $input_data['account_type'];
                    $acc[] = $account_details;

                    $update = array();
                    $update['accounts'] = json_encode($acc);

                    $this->db->where('u_code', $u_code);
                    if ($this->db->update('user_payment_methods', $update)) {
                        $res['res'] = "success";
                        $res['message'] = "Account added successfully.";
                    } else {
                        $res['res'] = "error";
                        $res['message'] = "Error in database.";
                    }
                } else {
                    $account_details['account_type'] = $input_data['account_type'];
                    $acc = $account_details;
                    $update = array();
                    $update['accounts'] = json_encode($acc);
                    $update['u_code'] = $u_code;

                    if ($this->db->insert('user_payment_methods', $update)) {
                        $res['res'] = "success";
                        $res['message'] = "Account added successfully.";
                    } else {
                        $res['res'] = "error";
                        $res['message'] = "Error in database.";
                    }
                }
            } else {
                $res['res'] = "error";
                $res['message'] = "No Account type.";
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }

        print_r(json_encode($res));
    }

    public function user_accounts()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $u_id = $input_data['u_id'];
            $check_user_account = $this->conn->runQuery('*', 'user_payment_methods', "u_code='$u_id'");
            if ($check_user_account) {
                $acc = $check_user_account[0]->accounts != '' ? json_decode($check_user_account[0]->accounts, true) : array();
                $acnt = array();
                foreach ($acc as $keys => $val) {
                    $scc = array();
                    $account_type = $val['account_type'];
                    $check_done = $this->conn->runQuery('*', 'company_payment_methods', "unique_name='$account_type'");
                    $decode = json_decode($check_done[0]->fields_required, true);
                    if ($account_type != 'bank') {
                        foreach ($decode as $ksss => $decode_details) {
                            $scc['val'] = $val[$ksss];
                        }
                    } else {
                        foreach ($decode as $ksss => $decode_details) {
                            $scc[$ksss] = $val[$ksss];
                        }
                    }

                    $scc['account_type'] = $account_type;
                    $acnt[] = $scc;
                }

                $data['data'] = $acnt;
                $data['dafault'] = $check_user_account[0]->default_account;
                $res = $data;
                $res['res'] = "success";
            } else {
                $res['res'] = "success";
                $data['data'] = array();
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }
        print_r(json_encode($res));
    }

    public function change_default()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['default_account']) && isset($input_data['u_id'])) {
            $default = $input_data['default_account'];
            $u_code = $input_data['u_id'];
            $update = array();
            $update['default_account'] = $default;
            $this->db->where('u_code', $u_code);
            $this->db->update('user_payment_methods', $update);
            $res['res'] = "success";
            $res['message'] = "Default account changed successfully";
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }
        print_r(json_encode($res));
    }
    public function delete_account()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['delete_account']) && isset($input_data['u_id'])) {
            $delete = $input_data['delete_account'];
            $u_code = $input_data['u_id'];

            $check_user_account = $this->conn->runQuery('*', 'user_payment_methods', "u_code='$u_code'");
            if ($check_user_account) {
                //$acc=array();
                $default_account = $check_user_account[0]->default_account;
                if ($default_account != $delete) {
                    $accnts = $check_user_account[0]->accounts != '' ? json_decode($check_user_account[0]->accounts, true) : array();
                    $update = array();

                    unset($accnts[$delete]);

                    $update['accounts'] = json_encode($accnts);
                    $this->db->where('u_code', $u_code);
                    $this->db->update('user_payment_methods', $update);

                    $res['res'] = "success";
                    $res['message'] = "Account deleted successfully.";
                } else {
                    $res['res'] = "error";
                    $res['message'] = "you can not delete default account";
                }
            }
        } else {
            $res['res'] = "error";
            $res['message'] = "All parameters are required";
        }
        print_r(json_encode($res));
    }

    public function matrix_data()
    {
        $user_id = $this->input->post('u_id');
        $result['g1'] = $this->team->matrix_pool_data($user_id, 'g1');
        $result['g2'] = $this->team->matrix_pool_data($user_id, 'g2');
        $result['g3'] = $this->team->matrix_pool_data($user_id, 'g3');
        $ar[] = $result;
        print_r(json_encode($ar));
    }
}
