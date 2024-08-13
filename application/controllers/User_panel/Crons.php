<?php
header('Access-Control-Allow-Origin: *');
class Crons extends CI_Controller
{
    public function __construct()
    {
        error_reporting(-1);
        ini_set('display_errors', 0);
        parent::__construct();
    }

    public function testincomes()
    {
        // $timestamp = new DateTime();
        // echo $timestamp->getTimestamp();
        // die;

        $user_id = 15;
        $res = $this->distribute->same_rank_distribute($user_id, 17, 20, 2);
        // $res = $this->action->call_limit_check();

        print_r(json_encode($res));
    }


    // need to set cron every day //
    public function hours()
    {
        $user_details = $this->conn->runQuery('*', 'orders', "status=1 AND id=7");
        $last_claimed_roi = $user_details[0]->last_claimed_roi;

        $lastClaimedDateTime = new DateTime($last_claimed_roi);
        $currentDateTime = new DateTime($datetime);

        $interval = $currentDateTime->diff($lastClaimedDateTime);
        $daysDifference = $interval->days;
        $hoursDifference = $interval->h + ($daysDifference * 24);
        echo $minutesDifference = $interval->i + ($hoursDifference * 60);
    }
    public function check_activation_package()
    {
        $currs = date('Y-m-d  H:i:s');
        $purchase = $this->conn->runQuery('*', 'users', "active_status='1'");
        if ($purchase) {
            foreach ($purchase as $purchases) {
                echo $u_id = $purchases->id;
                $usernames = $purchases->username;
                $order_details = $this->conn->runQuery('*', 'orders', "u_code='$u_id' and tx_type='purchase' order by id desc");
                $order_details_dts = $order_details[0]->added_on;

                if ($order_details[0]->order_amount == '25') {
                    $subscription_month = '12 month';
                    $total_days = 365;
                }

                $effectiveDate = date('Y-m-d  H:i:s', strtotime("+$total_days day", strtotime($order_details_dts)));
                //die();
                if ($currs > $effectiveDate) {

                    $this->db->set('income_status', 0);
                    $this->db->set('active_status', 0);
                    $this->db->set('subcription_date', '');
                    $this->db->set('subcription', '');
                    $this->db->where('id', $u_id);
                    $this->db->update('users');
                    echo $this->db->last_query();

                    /////////////////////////////////////////////////////////////

                    $arr = array();
                    $user_type = 'user';
                    $arr['type'] = $user_type;
                    if ($user_type == 'user') {
                        $get_id = $this->profile->id_by_username($usernames);
                        $arr['u_code'] = $get_id;
                    }
                    $arr['title'] = "Activation Expire";
                    $arr['message'] = "Your Activation Package Expire";
                    if ($this->db->insert('notifications_list', $arr)) {

                        $this->db->set('notifications', "notifications+1", false);
                        if ($user_type == 'user') {
                            $this->db->where('id', $get_id);
                        }
                        $this->db->where("1=1");
                        $this->db->update('users');
                    }
                    ///////////////////////////////////////////////////////////////

                }
                //   else {
                //     $this->db->set('income_status', 1);
                //     $this->db->where('id', $u_id);
                //     $this->db->update('users');
                //     echo $this->db->last_query();

                // }
            }
        }
    }

    // public function fast_income_closing_stoped()
    // {

    //     $source = "fast_moving_income";
    //     $repurchase = $this->conn->runQuery('*', 'users', "retopup_status='1'");
    //     $res = [];
    //     if ($repurchase) {
    //         foreach ($repurchase as $purchases) {
    //             $u_id = $purchases->id;
    //             $my_rank_id = $purchases->rank_id;
    //             $order_details = $this->conn->runQuery('*', 'orders', "u_code=$u_id and tx_type='repurchase' order by id desc");

    //             if ($order_details) {
    //                 $order_details_dts = $order_details[0]->added_on;
    //                 $current_date = new DateTime();
    //                 $start_date = new DateTime($order_details_dts);
    //                 $interval = $current_date->diff($start_date);
    //                 $total_days = $interval->days;

    //                 $plan = $this->conn->runQuery('*', 'plan', "id<=3");
    //                 foreach ($plan as $plans) {

    //                     $id = $plans->id;
    //                     $res[$id]['$fast_moving_income'] = $plans->fast_moving_income;
    //                     $res[$id]['$fast_income_days'] = $plans->fast_income_days;
    //                     $res[$id]['$rank_id'] = $plans->id;
    //                     $details['data'] = $res;
    //                     if ($total_days > $fast_income_days && $my_rank_id == $rank_id) {
    //                         $arr1 = array(
    //                             'source' => $source,
    //                             'u_code' => $u_id,
    //                             'tx_type' => 'income',
    //                             'debit_credit' => 'credit',
    //                             'wallet_type' => 'main_wallet',
    //                             'amount' => $fast_moving_income,
    //                             'date' => date('Y-m-d H:i:s'),
    //                             'status' => 1,
    //                             'remark' => "Received $fast_moving_income fast moving income of rank $rank_id",
    //                         );

    //                         print_r($arr1); // Debug output
    //                         echo "done"; // Debug output
    //                         // Uncomment below to insert into transaction table
    //                         // $qury = $this->conn->get_insert_id('transaction', $arr1);
    //                     }
    //                 }
    //             } else {
    //                 echo "Error: No repurchase orders found for user with ID $u_id <br>"; // Error message
    //             }
    //         }
    //     } else {
    //         echo "Error: No users found with retopup status"; // Error message
    //     }
    //     print_r(json_encode($details));
    // }

    // public function bonanza_closing_stoped()
    // {
    //     $datetime = date('Y-m-d H:i:s');
    //     $plan = $this->conn->runQuery("*", 'plan', "1='1'");
    //     $all_cr_array = $this->conn->runQuery('*', 'users', "active_status=1");
    //     $crncy = $this->conn->company_info('currency');
    //     $insertincome = array();
    //     foreach ($all_cr_array as $user_details) {
    //         $user_id = $userid = $user_details->id;

    //         $my_plan = $this->conn->runQuery('*', 'plan', "1=1");

    //         // $top_legs1=$this->business->top_legs($user_id);
    //         //$max_leg_business=$top_legs1[0];
    //         //echo "<br>";
    //         //$other_leg=array_sum($top_legs1)-max($top_legs1);
    //         $self_package = $this->business->package($user_id);
    //         if ($my_plan) {
    //             $sno = 0;
    //             for ($i = 0; $i < 1; $i++) {
    //                 $bonanza_direct_business = $my_plan[$i]->bonanza_business;
    //                 $our_rank = $my_plan[$i]->package_name;

    //                 $bonanza_self_business = $my_plan[$i]->bonanza_self_business;
    //                 $bonanza_team_business = $my_plan[$i]->bonanza_team_business;
    //                 $bonanza_reward = $my_plan[$i]->bonanza_reward;
    //                 $bonanza_start_date = $my_plan[$i]->bonanza_start_date;
    //                 $bonanza_end_date = $my_plan[$i]->bonanza_end_date;

    //                 $goalstatus = ($self_package >= $bonanza_self_business ? 'Achieved' : 'Pending');
    //                 if ($goalstatus == "Achieved") {

    //                     $check_rank_ = $this->conn->runQuery('u_code', 'rank_bonanza', "rank_id='$i' and u_code='$user_id' and rank='$our_rank'");
    //                     if (!$check_rank_) {
    //                         $rankinsert['u_code'] = $user_id;
    //                         $rankinsert['rank'] = $our_rank;
    //                         $rankinsert['is_complete'] = 1;
    //                         $rankinsert['rank_id'] = $i;
    //                         $this->db->insert('rank_bonanza', $rankinsert);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    public function reverse_withdrawal()
    {
        $dt = date("Y-m-06 06:00:01");
        //SELECT * FROM `transaction` WHERE `id` >= 2794 and tx_type='income' ORDER BY `id` ASC;
        $all_cr_array = $this->conn->runQuery('*', 'transaction', "`added_on>='$dt' and tx_type='withdrawal'");
        echo $this->db->last_query();
        die();
        if ($all_cr_array) {
            foreach ($all_cr_array as $user_details) {
                echo "<br><br>";
                echo "<br>" . $u_codes = $user_details->u_code;
                echo "<br>" . $amt = $user_details->amount + $user_details->tx_charge;
                $id = $user_details->id;
                $source = $user_details->source;
                //$income
                //die();
                echo "<br>";
                //$this->update_ob->add_amnt($u_codes,$source,-$amt);
                $this->update_ob->add_amnt($u_codes, 'main_wallet', $amt);
                //echo $this->db->last_query();
                //die();
                $this->db->set('payout_status', 6);
                $this->db->where('id', $id);
                $this->db->update('transaction');
                //    break;
            }
        }
    }

    public function news_closing()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://newsapi.org/v2/everything?q=stock%20market&apiKey=1ccd7212108d46a98f9291377e960949',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        $pri = json_decode($response, true);
        curl_close($curl);
        $update = array(
            'news' => $response,
        );
        $this->db->where('id', 1);
        $this->db->update('crypto_news', $update);
    }



    public function test()
    {
        $res = $this->crypto->coinPayments_withdrawal('1', 'usd', '0x0C2E39c4f3480BF312d9937Aa2621BbebaFE9152');

        print_r($res);
    }
    public function roi_closing()
    {

        $source = "roi";
        $id = 2;
        $details = array();
        $datetime = date('Y-m-d H:i:s');
        $all_cr_array = $this->conn->runQuery('*', 'orders', "status=1 and tx_type='purchase'");
        // $all_cr_array = $this->conn->runQuery('*', 'orders', "status=1 and tx_type='purchase' and u_code='$id'");

        foreach ($all_cr_array as $user_details) {
            // $userid = $user_details->u_code;
            // $tx = $user_details->id;

            // $check = $this->conn->runQuery('u_code', 'closing', "u_code='$userid' and order_id='$tx' and DATE(add_on) = date('$datetime') and type='$source'");
            // if (empty($check)) {

            $this->distribute->roi_destribute($user_details->id);
            // }
        }
    }

    public function runner_bonus_closing()
    {

        $source = 'runner_bonus';

        $eligible = $this->conn->runQuery('*', 'rank', "rank_type='runner_bonus' AND is_complete < 10");
        if (empty($eligible)) {
            return;
        }

        $pool_wallets = $this->conn->runQuery('c26', 'user_wallets', "u_code=1");
        $turnover = $pool_wallets[0]->c26;

        $per_user = $turnover / COUNT($eligible);

        foreach ($eligible as $eligibl) {
            $res[] = $u_code = $eligibl->u_code;
            $rank_order_id = $eligibl->id;

            $check = $this->conn->runQuery('*', 'closing', "u_code='$u_code'  and type='$source' and DATE(add_on) = date('$datetime') ");
            // if (empty($check)) {
            if (1==1) {
                $net_capping = $this->business->capping_level($u_code);
                $wallet_sum = $this->wallet->income($u_code, 'main_wallet');
                if ($per_user + $wallet_sum > $net_capping) {
                    $per_user = $net_capping - $wallet_sum;
                }
                if ($per_user > 0) {
                    $is_complete = $eligibl->is_complete;
                    $completed = $is_complete + 1;


                    $this->db->set('is_complete', $completed);
                    $this->db->where('u_code', $u_code);
                    $this->db->where('rank', 'runner_bonus');
                    $this->db->update('rank');

                    $income['tx_u_code'] = '';
                    $income['u_code'] = $u_code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $per_user;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['payment_slip'] = '';
                    $income['payout_id'] = $rank_order_id;
                    $income['tx_record'] = '';
                    $income['remark'] = "Received Runner Bonus income of amount $per_user for $completed month(s)";

                    if ($this->db->insert('transaction', $income)) {

                        $this->update_ob->add_amnt($u_code, $source, $per_user);
                        $this->update_ob->add_amnt($u_code, 'main_wallet', $per_user);
                    }
                    $this->db->set('u_code', $u_code);
                    $this->db->set('type', $source);
                    $this->db->set('order_id', $rank_order_id);
                    $this->db->insert('closing');
                }
            }
        }
        $this->update_ob->any_update(1, "runner_bonus_pool", 0);
        print_r($res);
    }


    public function create_file()
    {
        // Acquire the lock
        $lockFile = $this->secure->acquireLock(5);
    
        // Check if the lock was acquired successfully
        if (!$lockFile) {
            // Handle the error if the lock could not be acquired
            echo 'Could not acquire lock. Another process may be running.';
            return;
        }
        
        // Perform the necessary file creation or other operations here
        // For demonstration purposes, let's just print a message
        echo 'Lock acquired, performing operations...';
    
        // Release the lock and get the status
        $lockStatus = $this->secure->releaseLock($lockFile['file'], $lockFile['path']);
        
        // Check and print the status of lock release and file deletion
        if ($lockStatus['lockReleased'] && $lockStatus['fileDeleted']) {
            echo 'Lock released and file deleted successfully.';
        } else {
            echo 'Failed to release lock or delete file.';
        }
    }

   
    public function vip_rank_closing()
    {

        $source = 'vip_bonus';
        $datetime = date('Y-m-d H:i:s');
        $plan = $this->conn->runQuery('*', 'plan', "1=1");
        $royalty_company_turnover = $plan[0]->royalty_company_turnover;
        $currentDate = date('Y-m-d h-i-s');

        $rank_Achieved = $this->conn->runQuery('*', 'rank', "  rank_type='vip'");

        $pool_wallets = $this->conn->runQuery('c27', 'user_wallets', "u_code=1");
        $turnover = $pool_wallets[0]->c27;
        // $turnover = $this->conn->runQuery('SUM(order_amount) as total', 'orders', " status='1'")[0]->total;
        // $all_royality=$turnover*(3/100);
        // $payable=$royality_peruser=$all_royality/ COUNT($rank_Achieved);

        //   print_r($royality_peruser);

        // die();
        foreach ($rank_Achieved as $rank_Achieved) {
            $code = $rank_Achieved->u_code;
            $rank_order_id = $rank_Achieved->id;
            $rank_id = $rank_Achieved->rank_id;

            $is_complete = $rank_Achieved->is_complete;
           
            $plan = $this->conn->runQuery('*', 'plan', "id='$rank_id'");
           $rank_per = $plan[0]->vip_bonus;
            $currentDate = date('Y-m-d h-i-s');

            $all_royality = $turnover * ($rank_per / 100);
            $payable = $royality_peruser = $all_royality / COUNT($rank_Achieved);


            $check = $this->conn->runQuery('*', 'closing', "u_code=$code  and type='$source' and DATE(add_on) = date('$datetime') ");
            if (empty($check)) {

                $net_capping = $this->business->capping_level($code);
                $wallet_sum = $this->wallet->income($code, 'main_wallet');
                if ($payable + $wallet_sum > $net_capping) {
                    $payable = $net_capping - $wallet_sum;
                    
                }
               
                if ($payable > 0) {

                    $income['tx_u_code'] = '';
                    $income['u_code'] = $code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $payable;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['payment_slip'] = '';
                    $income['payout_id'] = $rank_order_id;
                    $income['tx_record'] = '';
                    $income['remark'] = "Recieve VIP Bonus income of amount $payable";
                    $res[] = $income;
                    if ($this->db->insert('transaction', $income)) {

                        $this->update_ob->add_amnt($code, $source, $payable);
                        $this->update_ob->add_amnt($code, 'main_wallet', $payable);
                    }

                    $this->db->set('is_complete', $is_complete + 1);
                    $this->db->where('u_code', $code);
                    $this->db->where('rank_type', $source);
                    $this->db->update('rank');


                    $this->db->set('u_code', $code);
                    $this->db->set('type', $source);
                    $this->db->set('order_id', $rank_order_id);
                    $this->db->insert('closing');
                }
            }
        }
        $this->update_ob->any_update(1, "vip_global_bonus", 0);
    }


    public function compensation_bonus_rank_closing()
    {
        $source = 'compensation_bonus';
        $eligible = $this->conn->runQuery('*', 'rank', "rank_type!='vip'");
        if ($eligible) {
            foreach ($eligible as $eligibl) {
                $u_code = $eligibl->u_code;
                $rank_per = $eligibl->rank_per;
                $rank = $eligibl->rank;
                $my_pkgss = $this->business->package($u_code);
                $rank_income = $my_pkgss * $rank_per / 100;
                if ($u_code) {

                    $income['u_code'] = $u_code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $rank_income;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['remark'] = "Recieve $source income of amount $rank_income from rank $rank";
                    if ($this->db->insert('transaction', $income)) {

                        $this->update_ob->add_amnt($u_code, $source, $rank_income);
                        $this->update_ob->add_amnt($u_code, 'main_wallet', $rank_income);
                    }
                }
            }
        }
    }

    public function clear_form_submit()
    {
        $this->db->empty_table('form_request');
    }

    public function clear_api_otp()
    {
        $this->db->empty_table('api_otp');
    }

    public function auto_withdrawal()
    {
        $datetime = date('Y-m-d');
        $all_cr_array = $this->conn->runQuery('id,name,username,my_rank,active_date', 'users', "active_status=1");

        $min_wd_limit = $this->conn->setting('min_withdrawal_limit');
        $crncy = $this->conn->company_info('currency');
        $insertincome = array();

        foreach ($all_cr_array as $user_details) {
            echo $userid = $user_details->id;
            $wallet_amt = $this->update_ob->wallet($userid, 'main_wallet');
            $bank_details = $this->profile->my_default_account($userid);
            $direct_details = $this->team->my_actives($userid);
            if (!empty($bank_details)) {
                if ($wallet_amt > $min_wd_limit && count($direct_details) >= 2) {
                    $bank_details = $bank_details = $this->profile->my_default_account($userid); //$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                    $inserttrans['bank_details'] = json_encode($bank_details);

                    $crncy = $this->conn->company_info('currency');

                    $inserttrans['wallet_type'] = 'main_wallet';
                    $inserttrans['tx_type'] = 'withdrawal';
                    $inserttrans['debit_credit'] = "debit";
                    $inserttrans['u_code'] = $userid;
                    $inserttrans['date'] = date('Y-m-d H:i:s');
                    $amnt = abs($wallet_amt);
                    $tx_charge = $amnt * 15 / 100;
                    $inserttrans['amount'] = $amnt - $tx_charge;
                    $inserttrans['tx_charge'] = $tx_charge;
                    $inserttrans['status'] = 0;
                    $inserttrans['open_wallet'] = $this->update_ob->wallet($userid, 'main_wallet');
                    $inserttrans['closing_wallet'] = $inserttrans['open_wallet'] - $inserttrans['amount'];
                    $inserttrans['remark'] = " Withdraw  $crncy $amnt";

                    if ($this->db->insert('transaction', $inserttrans)) {

                        //$this->update_ob->add_amnt($tx_u_code,$wallet_type,$amnt);
                        $this->update_ob->add_amnt($userid, 'main_wallet', -$amnt);
                        $this->update_ob->add_amnt($userid, 'total_withdrawal', $amnt);
                    }
                }
            }
        }
    }

    public function mail_check()
    {

        //  echo $this->message->send_mail('gouravbawa377@gmail.com','hello','test','test');
        //$email="gouravbawa377@gmail.com";
        $email = "";
        $Subject = "testing otp";
        $message = "this is your otp";
        $userid = 2;
        $otp = 5543;
        echo $this->message->send_mail_new($email, $Subject, $message, $userid, $otp);
    }

    public function check_curl_version()
    {

        if (in_array('curl', get_loaded_extensions())) {
            echo "CURL is available on your web server";
        } else {
            echo "CURL is not available on your web server";
        }
    }

    public function sendnoti()
    {
        $to = "e76GNNW9Q4-e840U3C5dFC:APA91bGOmB-PTwXQmUf641f_jCObGRS6Y8b0yar1xkw4-MaqLeECIjtHJ5MKk1JGAR7vHlR15rfSeQlR3QQ1z7l_tNcwvE4aX7wB2-K2nYWGV78MJNPUnPIVQ83MSfw9c5RWnCdbC14q";
        $key = "AIzaSyCSNFyAJlOas9waPO93n7sa9TtYHT8n9wQ";

        $this->message->testin_noti();
    }
}
