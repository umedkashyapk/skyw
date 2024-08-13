<?php
class Distribute_model extends CI_Model
{
    public function __construct()
    {
        $this->gen_plan = array(
            1 => array(
                37 => array(1 => '7', 2 => '1.5', 3 => '1'),
                41 => array(1 => '3', 2 => '1', 3 => '0.5'),
                42 => array(1 => '0.6', 2 => '0.3', 3 => '0.2'),
            ),
            2 => array(
                37 => array(1 => '7', 2 => '4', 3 => '2', 4 => '1.5', 5 => '1'),
                41 => array(1 => '3', 2 => '2', 3 => '1', 4 => '1', 5 => '0.5'),
                42 => array(1 => '0.6', 2 => '0.5', 3 => '0.4', 4 => '0.3', 5 => '0.2'),
            ),
        );
    }

    public function same_rank_distribute($to, $from, $amount, $rank)
    {
        $incomes = array();
        $res['source'] = $source = 'same_rank';
        $profile_info = $this->conn->runQuery('name,username', 'users', "id='$from'")[0];
        $name = $profile_info->name;
        $username = $profile_info->username;
        $res['amount'] = $amount = round($amount * 1 / 100, 4);
        $res['netcapping'] = $net_capping = $this->business->capping_level($to);
        $res['already paid'] = $wallet_sum = $this->wallet->income($to, 'main_wallet');
        if ($amount + $wallet_sum > $net_capping) {
            $amount = $net_capping - $wallet_sum;
        }
        $res['final amount'] = $amount;
        if ($amount > 0 && $to != '') {
            $income['u_code'] = $to;
            $income['tx_u_code'] = $from;
            $income['tx_type'] = 'income';
            $income['source'] = $source;
            $income['debit_credit'] = 'credit';
            $income['amount'] = $amount;
            $income['date'] = date('Y-m-d H:i:s');
            $income['status'] = 1;
            $income['tx_record'] = $rank;
            $income['remark'] = "Recieve same rank income of amount $amount from $name ($username)";
            if ($this->db->insert('transaction', $income)) {
                $this->update_ob->add_amnt($to, $source, $amount);
                $this->update_ob->add_amnt($to, 'main_wallet', $amount);
            }
        }
        $res['income'] = $income;
        return $res;
    }

    public function roi_all_orders($user_id)
    {
        if (!$this->action->call_limit_check($user_id)) {
            return;   /// To stop multiple calls within same time
        }

        $all_cr_array = $this->conn->runQuery('*', 'orders', "status=1 and tx_type='purchase' and u_code='$user_id'");
        foreach ($all_cr_array as $user_details) {
            sleep(1);
            $res[] = $this->roi_destribute($user_details->id);
        }
        return $res;
    }


    public function roi_destribute($tx)
    {
        $user_details = $this->conn->runQuery('*', 'orders', "status=1 and id='$tx'");

        $type='roi';
  // Acquire the lock
    $lockFile = $this->secure->acquireLock($tx,$type);

        if (empty($user_details)) {
            echo "No user details found for Transaction ID: $tx\n";
            return;
        }

        $userid = $user_details[0]->u_code;
        $net_capping = $this->business->capping($userid, $tx);
        $res['orderAmount'] = $order_amount = $user_details[0]->order_amount;
        $res['roiPaid'] = $roi_paid = $user_details[0]->roi_paid;
        $res['roiCapping'] = $roi_capping = $user_details[0]->roi_capping;
        $res['lastClaminedRoi'] = $last_claimed_roi = $user_details[0]->last_claimed_roi;

        $lastClaimedDateTime = new DateTime($last_claimed_roi);
        $currentDateTime = new DateTime();

        $res['interval'] = $interval = $currentDateTime->diff($lastClaimedDateTime);
        $daysDifference = $interval->days;
        $hoursDifference = $interval->h + ($daysDifference * 24);
        $minutesDifference = ($daysDifference * 24 * 60) + ($interval->h * 60) + $interval->i;

        $plan = $this->conn->runQuery('roi, id', 'plan', '1=1');

        if (empty($plan)) {
            $res[] = "No plan details found.\n";
            return;
        }

        $roi_income = $plan[0]->roi / 30;
        // $roi = $minutesDifference * $roi_income;
        $roi = $daysDifference * $roi_income;
        $payable_amt = $order_amount * $roi / 100;
        $wallet_sum = $this->wallet->income($userid, 'main_wallet');
        if ($payable_amt + $wallet_sum > $net_capping) {
            $payable_amt = $net_capping - $wallet_sum;
        }
        if ($payable_amt > 0) {
            // if ($payable_amt + $roi_paid > $roi_capping) {
            //     $payable_amt = $roi_capping - $roi_paid;
            // }

            $user_status = $this->conn->runQuery('*', 'users', "id='$userid'");

            if (empty($user_status)) {
                $res[] = "No user status found for User ID: $userid\n";
                return;
            }

            $res['incomeStatus'] = $income_status = $user_status[0]->income_status;
            $res['rank'] = $my_rank = $user_status[0]->my_rank;
            $res['isBlock'] = $block_status = $user_status[0]->block_status;
            $res['userid'] = $userid;
            $res['minutes'] = $minutesDifference;
            $res['amount'] = $payable_amt;
            // if ($userid != '' && $payable_amt > 0 && $income_status == 1 && $block_status == 0 ) {
            if ($userid != '' && $payable_amt > 0 && $income_status == 1 && $block_status == 0 && $daysDifference >= 1) {
                $source = 'roi';
                $amount = $payable_amt;
                $income = array(
                    'u_code' => $userid,
                    'tx_type' => 'income',
                    'source' => $source,
                    'debit_credit' => 'credit',
                    'amount' => $payable_amt,
                    'date' => $currentDateTime->format('Y-m-d H:i:s'),
                    'added_on' => $currentDateTime->format('Y-m-d H:i:s'),
                    'status' => 1,
                    'open_wallet' => '0',
                    'closing_wallet' => '0',
                    'tx_record' => $tx,
                    'txs_res' => 1,
                    'remark' => "Receive $source income of amount $payable_amt",
                );
                $res['income'] = $income;
                // $checked = $this->conn->runQuery("*", 'closing', "u_code='$userid' and order_id='$tx' order by id desc");
                // $checkss = $checked[0]->add_on;

                // $lastClosingDateTime = new DateTime($checkss);
                // $currentDateTime = new DateTime();

                // $interval_time = $currentDateTime->diff($lastClosingDateTime);
                // $daysDifferences = $interval_time->days;
                // $secondsDeff = (($daysDifferences * 24 * 60) + ($interval_time->h * 60) + $interval_time->i) * 60;

                // $change = true;
                // $secondsDeffss = $secondsDeff ? $secondsDeff : 2;
                // if ($secondsDeffss > 1 && $change) {
                //     $insert = array(
                //         'u_code' => $userid,
                //         'type' => $source,
                //         'add_on' => $currentDateTime->format('Y-m-d H:i:s'),
                //         'order_id' => $tx,
                //     );

                // $this->db->insert('closing', $insert);
                // $change = false;
                if ($this->db->insert('transaction', $income)) {
                    // $total_payout = $roi_paid ? $roi_paid : 0;
                    // $total_payout_amount = $total_payout + $payable_amt;

                    // $this->db->set('roi_paid', $total_payout_amount);
                    $this->db->set('last_claimed_roi', $currentDateTime->format('Y-m-d H:i:s'));
                    $this->db->where('id', $tx);
                    $this->db->update('orders');



                    $res[] = "Closing record inserted for User ID: $userid, Order ID: $tx\n";

                    $this->update_ob->add_amnt($userid, $source, $payable_amt);
                    $this->update_ob->add_amnt($userid, 'main_wallet', $payable_amt);

                    $this->update_ob->add_amnt(1, 'runner_bonus_pool', $payable_amt * 2 / 100);
                    $this->update_ob->add_amnt(1, 'vip_global_bonus', $payable_amt * 15 / 100);



                    $this->level_on_roi_destribute($userid, $amount, 6, $tx);
                    $this->distribute_income($userid, $amount, 100, $tx);
                }
                // }
            }
            // else {
            //     echo "Failed to insert income transaction for User ID: $userid\n";
            // }
        }
        // else {
        //     echo "Conditions not met for ROI distribution. Skipping User ID: $userid\n";
        // }

        $this->secure->releaseLock($lockFile['file'], $lockFile['path']);
        return $res;
    }



    public function level_on_roi_destribute($u_code, $amount, $no_of_levels = 6, $tx)
    {
        $code = $u_code;
        $ben_from = $u_code;
        $profile_info = $this->profile->profile_info($ben_from, 'name,username');
        $name = $profile_info->name;
        $username = $profile_info->username;

        $l = 1;
        $plan = $this->conn->runQuery('level_on_roi,id', 'plan', 'id < 7');
        if ($plan) {
            $level_income = array_column($plan, 'level_on_roi', 'id');
            while ($code != '') {
                $source = 'level_on_roi';
                /* $profile_info = $this->conn->runQuery('*', 'users', " id =$code");
                $name = $profile_info[0]->name;
                $username = $profile_info[0]->username;
                $active_status = $profile_info[0]->active_status;
                $income_status = $profile_info[0]->income_status;*/

                $level_distribution_in = $this->conn->setting('level_distribution_in');
                if ($level_distribution_in == 'fix') {
                    $level_per = $level_income[$l];
                    $payable_amt = round($level_per, 4);
                } else {
                    $level_per = $level_income[$l];
                    $payable_amt = round($amount * $level_per / 100, 4);
                }

                $sponsor = $this->profile->sponsor_info($code, 'id,active_status,income_status');
                $code = ($sponsor && $sponsor->active_status == '1' ? $sponsor->id : '');

                $net_capping = $this->business->capping_level($code);
                $wallet_sum = $this->wallet->income($code, 'main_wallet');
                if ($payable_amt + $wallet_sum > $net_capping) {
                    $payable_amt = $net_capping - $wallet_sum;
                }
                if ($payable_amt > 0) {
                    if ($code != '') {
                        $income = array();
                        $income['u_code'] = $code;
                        $income['tx_u_code'] = $u_code;
                        $income['tx_type'] = 'income';
                        $income['source'] = $source;
                        $income['debit_credit'] = 'credit';
                        $income['amount'] = $payable_amt;
                        $income['date'] = date('Y-m-d H:i:s');
                        $income['added_on'] = date('Y-m-d H:i:s');
                        $income['status'] = 1;
                        $income['open_wallet'] = '0';
                        $income['closing_wallet'] = "0";
                        $income['tx_record'] = $tx;
                        $income['txs_res'] = 1;
                        $income['wallet_type'] = 'main_wallet';
                        $income['remark'] = "Receive $source income of amount $payable_amt from $name ($username) from level $l";
                        $this->db->insert('transaction', $income);
                        if ($this->db->insert('transaction', $income)) {
                            $this->update_ob->add_amnt($code, $source, $payable_amt);
                            $this->update_ob->add_amnt($code, 'main_wallet', $payable_amt);
                            // echo "closing done" . $userid;
                        }
                    }
                }
                if ($l >= $no_of_levels) {
                    break;
                }
                $l++;
            }

            }
        return  print_r($this->db->last_query());
    }

    public function distribute_income($u_code, $amnt, $level = 100, $tx)
    {
        $ben_from = $u_code;
        $source = 'compensation_bonus';
        $source1 = 'referral_bonus';
        $pre_level_per = $level_per = 0;
        $l = 0;
        $res1 = array();
        $address = array();
        $amounts = array();
        $res1['id'] = $u_code;
        $res1['level'] = $level;

        $plan = $this->conn->runQuery('id,compensation_bonus', 'plan', "id<=14");
        $planAr = array_column($plan, 'compensation_bonus', 'id');
        $pre_rankId = $this->profile->my_rank($u_code);
        $samerank = true;
        while ($u_code && $l < $level) {
            $res1[$u_code]['sponsor'] = $u_code = $this->profile->sponsor($u_code);
            // $res1[$u_code]['lastQuery'] = $this->db->last_query();
            $res1[$u_code]['rank '] = $rankId = $this->profile->my_rank($u_code);
            $res1[$u_code]['pre rank '] = $pre_rankId;
            $res1[$u_code]['vip rank '] = $vipRankId = $this->profile->my_rank($u_code, 'vip');
            $res1[$u_code]['rank per'] = $my_rank_per = $planAr[$rankId];

            if (($rankId == $pre_rankId || ($rankId < $pre_rankId && $vipRankId > 0)) && $samerank) {
                $res1[$u_code]['same rank paid'] = 'yes';
                $this->same_rank_distribute($u_code, $ben_from, $amnt, $rankId);
            }

            $samerank = false;
            $pre_rankId = $rankId;
            $pre_level_per = $level_per;
            if ($my_rank_per && $my_rank_per > $level_per) {
                $res[$u_code]['cur per'] = $curr_per = $my_rank_per - $level_per;
                $level_per = $my_rank_per;
                $res[$u_code]['payable'] = $payable = $amnt * $curr_per / 100;

                $net_capping = $this->business->capping_level($u_code);
                $wallet_sum = $this->wallet->income($u_code, 'main_wallet');
                if ($payable + $wallet_sum > $net_capping) {
                    $payable = $net_capping - $wallet_sum;
                }
                if ($payable > 0) {
                    $income = array();
                    $income['tx_u_code'] = $ben_from;
                    $income['u_code'] = $u_code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $payable;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['tx_record'] = $tx;
                    $income['user_prsnt'] = $my_rank_per;
                    $income['distribute_per'] = $curr_per;
                    $income['remark'] = "$source income $payable paid";
                    $res1['income'] = $income;

                    // $res1['query']=$this->db->last_query();

                    if ($this->db->insert('transaction', $income)) {
                        if($l==1){
                           $this->update_ob->add_amnt($u_code, $source1, $payable);   
                        }else{
                           $this->update_ob->add_amnt($u_code, $source, $payable);
                        }
                        $this->update_ob->add_amnt($u_code, 'main_wallet', $payable);
                        $l++;
                    }
                }
            }
        }
        return $res1;
    }

    public function direct_destribute($u_code, $amount, $no_of_levels = 15)
    {
        $code = $u_code;
        $ben_from = $u_code;
        $incomes = array();
        $l = 1;
        $profile_info = $this->profile->profile_info($ben_from, 'name,username');
        $name = $profile_info->name;
        $username = $profile_info->username;

        $plan = $this->conn->runQuery('direct_income,id', 'plan', '1=1');
        if ($plan) {
            $level_income = array_column($plan, 'direct_income', 'id');
            while ($code != '') {
                $source = ($l == 1 ? 'direct' : "direct");
                $currenct_payout_id = $this->wallet->currenct_payout_id();
                $level_distribution_in = $this->conn->setting('level_distribution_in');
                if ($level_distribution_in == 'fix') {
                    $level_per = $level_income[$l];
                    $payable = $level_per;
                } else {
                    $level_per = $level_income[$l];
                    $payable = $amount * $level_per / 100;
                }
                $sponsor = $this->profile->sponsor_info($code, 'id,active_status,income_status');
                $code = ($sponsor && $sponsor->active_status == '1' ? $sponsor->id : '');

                $income = array();
                if ($payable > 0 && $code != '' && $sponsor->income_status) {

                    $income['tx_u_code'] = $ben_from;
                    $income['u_code'] = $code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $payable;
                    //$income['tx_charge']=$payable*5/100;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['payout_id'] = $currenct_payout_id;
                    $income['tx_record'] = $l;
                    $income['remark'] = "Recieve $source income of amount $payable from $name ($username) from level $l";
                    if ($this->db->insert('transaction', $income)) {

                        $income_lvl = $income['amount']; //-$income['tx_charge'];
                        $this->update_ob->add_amnt($code, $source, $income_lvl);
                        $this->update_ob->add_amnt($code, 'main_wallet', $income_lvl);
                    }
                    // $incomes[]=$income;

                }

                if ($l >= $no_of_levels) {
                    break;
                }
                $l++;
            }
        }

        /*if(!empty($incomes)){
    //$this->db->insert_batch('transaction',$incomes);
    }*/
    }

    public function matrix_destribute($matrix_id, $amount, $no_of_levels = 15)
    {
        $source = 'matrix_level';
        $pool_info = $this->profile->pool_info($matrix_id);
        if (!$pool_info) {
            return false;
        }
        $u_code = $pool_info[0]->u_id;
        $ben_from = $u_code;
        $profile_info = $this->profile->profile_info($ben_from, 'name,username');
        $name = $profile_info->name;
        $username = $profile_info->username;

        $incomes = array();
        $plan = $this->conn->runQuery('matrix_income,id', 'plan', '1=1');
        $level_income = array_column($plan, 'matrix_income', 'id');

        $currenct_payout_id = $this->wallet->currenct_payout_id();
        $level_distribution_in = $this->conn->setting('level_distribution_in');

        for ($l = 1; $l <= $no_of_levels; $l++) {

            $pool_parent = $this->profile->pool_parent($matrix_id);
            if ($pool_parent) {
                $matrix_id = $pool_parent;
                $parent_info = $this->profile->pool_info($matrix_id);
                $u_code = $parent_info[0]->u_id;

                if ($level_distribution_in == 'fix') {
                    $level_per = $level_income[$l];
                    $payable = $level_per;
                } else {
                    $level_per = $level_income[$l];
                    $payable = $amount * $level_per / 100;
                }

                if ($payable > 0) {
                    $income['tx_u_code'] = $ben_from;
                    $income['u_code'] = $u_code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $payable;
                    /// $income['tx_charge']=$payable*5/100;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['payout_id'] = $currenct_payout_id;
                    $income['tx_record'] = $l;
                    $income['remark'] = "Recieve $source income of amount $payable from $name ($username) from level $l";
                    if ($this->db->insert('transaction', $income)) {
                        $income_lvl = $payable;
                        $this->update_ob->add_amnt($u_code, $source, $income_lvl);
                        $this->update_ob->add_amnt($u_code, 'main_wallet', $income_lvl);
                    }
                    // $incomes[]=$income;
                }
            }
        }
        /*if(!empty($incomes)){
    //$this->db->insert_batch('transaction',$incomes);
    }*/
    }

    public function order_distribute($u_code, $id)
    {
        $amnt_8000 = 8000;

        $order_details = $this->conn->runQuery('*', 'orders', "id='$id' and closing_status='0' and status='1'");

        if ($order_details) {
            $order_detail = $order_details[0];
            $order_bv = $order_detail->order_bv;
            switch ($order_bv) {
                case $order_bv <= $amnt_8000:
                    if ($order_bv != '') {
                        $this->distribute_income($u_code, $order_bv);
                        $this->upgrade_rank($u_code, $order_bv);
                    }
                    break;
                case $order_bv > $amnt_8000:
                    if ($order_bv != '') {
                        $this->distribute_income($u_code, $amnt_8000);
                        $this->upgrade_rank($u_code, $amnt_8000);
                        $pnding_amnt = $order_bv - $amnt_8000;
                        $this->distribute_income($u_code, $pnding_amnt);
                        $this->upgrade_rank($u_code, $pnding_amnt);
                    }
                    break;
            }
            $order_id = $order_detail->id;
            $this->db->set('closing_status', '1');
            $this->db->where('id', $order_id);
            $this->db->update('orders');
        }
    }

    public function distribute_income_old($u_code, $amnt)
    {

        $ben_from = $u_code;
        $source = 'test';
        $pre_level_per = $level_per = 0;
        $l = 0;

        $nxt = 'yes';

        $currenct_payout_id = $this->wallet->currenct_payout_id();

        while ($nxt == 'yes') {
            $nxt = 'no';

            $my_rank_per = $this->profile->my_rank_per($u_code);
            $pre_level_per = $level_per;
            if ($my_rank_per && $my_rank_per > $level_per) {
                $curr_per = $my_rank_per - $level_per;
                $level_per = $my_rank_per;
                $payable = $amnt * $curr_per / 100;

                if ($payable > 0) {
                    $income = array();
                    $income['tx_u_code'] = $ben_from;
                    $income['u_code'] = $u_code;
                    $income['tx_type'] = 'income';
                    $income['source'] = $source;
                    $income['debit_credit'] = 'credit';
                    $income['amount'] = $payable;
                    $income['date'] = date('Y-m-d H:i:s');
                    $income['status'] = 1;
                    $income['payout_id'] = $currenct_payout_id;
                    $income['user_prsnt'] = $my_rank_per;
                    $income['distribute_per'] = $curr_per;
                    $income['remark'] = "Recieve $source income of amount $payable from level $l";
                    $this->db->insert('transaction', $income);
                    $l++;
                }
            }

            if ($my_rank_per >= 37 && $pre_level_per == $my_rank_per) {
                $this->gen_distribute($u_code, $my_rank_per, $amnt);
            }

            $u_code = $this->profile->sponsor($u_code);
            if ($u_code) {
                $nxt = 'yes';
            }
        }
    }

    public function upgrade_rank($u_code, $amnt)
    {

        $my_rank_per = $this->profile->my_rank_per($u_code);

        echo "<br>$u_code $amnt $my_rank_per";
        switch ($my_rank_per) {
            case 0:
                $this->upgrade($u_code, 1);
                break;
            case 17:
                $this->upgrade($u_code, 2);
                break;
            case 27:
                $this->rank_check_nxt($u_code, 3);
                break;
        }
        //echo "<br>upgrade $u_code $amnt";
    }

    public function upgrade($u_code, $rank_id)
    {
        echo "<br>$u_code $rank_id";

        $plan = $this->conn->runQuery('*', 'plan', "id='$rank_id'")[0];
        if ($rank_id == '1') {
            $check_order = $this->conn->runQuery('SUM(order_bv) as amnt', 'orders', "u_code='$u_code' and status='1'");

            if ($check_order && $check_order[0]->amnt != '' && $check_order[0]->amnt >= 8000) {

                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 1;
                    $rank['complete_date'] = date('Y-m-d H:i:s');
                    $this->db->insert('rank', $rank);
                    $sponsor = $this->profile->sponsor($u_code);
                    if ($sponsor) {
                        $this->upgrade($sponsor, 2);
                    }
                    echo '<br>rank updated';
                }
            }
        }

        if ($rank_id == '2') {
            $rank_ids = $this->team->downline_rank_team($u_code, 17);
            if (!empty($rank_ids) && count($rank_ids) >= 4) {
                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 1;
                    $rank['complete_date'] = date('Y-m-d H:i:s');
                    $this->db->insert('rank', $rank);
                    $sponsor = $this->profile->sponsor($u_code);
                    if ($sponsor) {
                        $this->rank_check_nxt($sponsor, 3);
                    }
                }
            }

            $check_order = $this->conn->runQuery('SUM(order_bv) as amnt', 'orders', "u_code='$u_code' and status='1'");
            if ($check_order && $check_order[0]->amnt != '' && $check_order[0]->amnt >= $plan->required_business) {

                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 1;
                    $rank['complete_date'] = date('Y-m-d H:i:s');
                    $this->db->insert('rank', $rank);

                    $free_pin = 4;
                    for ($f = 0; $f < $free_pin; $f++) {
                        $pin = random_string('alnum', 14);
                        $insert_pin = array();
                        $insert_pin['pin'] = $pin;
                        $insert_pin['u_code'] = $u_code;
                        $insert_pin['status'] = 1;
                        $insert_pin['use_status'] = 0;
                        $insert_pin['pin_type'] = 'free_pin';
                        $this->db->insert('epins', $insert_pin);
                    }
                    $sponsor = $this->profile->sponsor($u_code);
                    if ($sponsor) {
                        $this->rank_check_nxt($sponsor, 3);
                    }
                }
            }
        }
    }

    public function rank_check_nxt($u_code, $rank_id)
    {
        $plan = $this->conn->runQuery('*', 'plan', "id='$rank_id'")[0];
        if ($rank_id == 3) {
            $rank_ids = $this->team->downline_rank_team($u_code, 27);
            if (!empty($rank_ids) && count($rank_ids) >= 3) {
                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 1;
                    $rank['complete_date'] = date('Y-m-d H:i:s');
                    $this->db->insert('rank', $rank);
                    $sponsor = $this->profile->sponsor($u_code);
                    if ($sponsor) {
                        $this->rank_check_nxt($sponsor, 4);
                    }
                }
            }
            $check_order = $this->conn->runQuery('SUM(order_bv) as amnt', 'orders', "u_code='$u_code' and status='1'");
            if ($check_order && $check_order[0]->amnt != '' && $check_order[0]->amnt >= $plan->required_business) {

                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 1;
                    $rank['complete_date'] = date('Y-m-d H:i:s');
                    $this->db->insert('rank', $rank);

                    $free_pin = 12;
                    for ($f = 0; $f < $free_pin; $f++) {
                        $pin = random_string('alnum', 14);
                        $insert_pin = array();
                        $insert_pin['pin'] = $pin;
                        $insert_pin['u_code'] = $u_code;
                        $insert_pin['status'] = 1;
                        $insert_pin['use_status'] = 0;
                        $insert_pin['pin_type'] = 'free_pin';
                        $this->db->insert('epins', $insert_pin);
                    }
                    $sponsor = $this->profile->sponsor($u_code);
                    if ($sponsor) {
                        $this->rank_check_nxt($sponsor, 4);
                    }
                }
            }
        }
        if ($rank_id == 4) {
            $rank_ids = $this->team->downline_rank_team($u_code, 37);
            if (!empty($rank_ids) && count($rank_ids) >= 4) {
                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 0;
                    $this->db->insert('rank', $rank);
                }
            }
            $check_order = $this->conn->runQuery('SUM(order_bv) as amnt', 'orders', "u_code='$u_code' and status='1'");
            if ($check_order && $check_order[0]->amnt != '' && $check_order[0]->amnt >= $plan->required_business) {

                $check_exists = $this->conn->runQuery('*', 'rank', "u_code='$u_code' and rank_id='$plan->id'");
                if (!$check_exists) {
                    $rank = array();
                    $rank['rank'] = $plan->rank;
                    $rank['u_code'] = $u_code;
                    $rank['rank_per'] = $plan->r_per;
                    $rank['rank_id'] = $plan->id;
                    $rank['is_complete'] = 0;
                    $this->db->insert('rank', $rank);
                }
            }
        }
        if ($rank_id == 3) {
            $sponsor = $this->profile->sponsor($u_code);
            if ($sponsor) {
                $this->rank_check_nxt($sponsor, $rank_id);
            }
        }
    }

    public function gen_distribute($u_code, $my_rank_per, $amnt)
    {

        ///////////////// plan //////////////
        $plan = $this->gen_plan;
        $ben_from = $u_code;
        $source = 'gen';
        $nxt = 'yes';
        $lvl = 1;
        $currenct_payout_id = $this->wallet->currenct_payout_id();

        while ($nxt == 'yes') {
            $nxt = 'no';
            $rankper = $this->profile->my_rank_per($u_code);

            $curr_business = $this->conn->runQuery('SUM(order_bv) as sm', 'orders', "u_code='$u_code' and payout_id='$currenct_payout_id'")[0]->sm;
            if ($curr_business != '' && $curr_business >= 2251) {
                if ($rankper >= $my_rank_per) {

                    $directs = $this->team->my_actives($u_code);
                    if (!empty($directs)) {
                        $dir_implode = implode(',', $directs);
                        $check_directs = $this->conn->runQuery('*', 'rank', "u_code IN ($dir_implode) and is_complete='1' and rank_per>='$my_rank_per'");
                        if ($check_directs && count($check_directs) >= 2) {
                            $dir3 = $plan[2];
                        } else {
                            $dir3 = $plan[1];
                        }

                        if (array_key_exists($my_rank_per, $dir3)) {
                            $pay_per = $dir3[$my_rank_per];
                            if (array_key_exists($lvl, $pay_per)) {
                                $persnt = $pay_per[$lvl];
                                $payable = $amnt * $persnt / 100;
                                if ($payable > 0) {
                                    $income = array();
                                    $income['tx_u_code'] = $ben_from;
                                    $income['u_code'] = $u_code;
                                    $income['tx_type'] = 'income';
                                    $income['source'] = $source;
                                    $income['debit_credit'] = 'credit';
                                    $income['amount'] = $payable;
                                    $income['date'] = date('Y-m-d H:i:s');
                                    $income['status'] = 1;
                                    $income['payout_id'] = $currenct_payout_id;
                                    $income['user_prsnt'] = $my_rank_per;
                                    $income['distribute_per'] = $persnt;
                                    $income['remark'] = "Recieve $source income of amount $payable from level $lvl";
                                    $this->db->insert('transaction', $income);
                                    $lvl++;
                                }
                            }
                        }
                    }
                }
            }
            $u_code = $this->profile->sponsor($u_code);
            if ($lvl <= 5 && $u_code) {
                $nxt = 'yes';
            }
        }
    }

    public function distribute_pool_level($p_id, $amount, $no_of_levels = 10, $pool_id)
    {
        $res = array();
        $details = $this->team->pool_details($p_id, $pool_id);
        $planAr = $this->general->plan();
        $plan_type = array_column($planAr, 'type', 'id');
        $planName = $plan_type[$pool_id];
        $res['source'] = $source = $planName . "_pool_income";
        $matrix = $planName . "_matrix_node";
        $res['number of nodes'] = $node = $this->conn->setting($matrix);
        $res['details'] = $details;
        if ($details) {
            $u_code = $details->u_id;
            $pool_income = array_column($planAr, 'pool_income', 'id');
            $pool_recycle = array_column($planAr, 'pool_cycle', 'id');
            $pool_upgrade = array_column($planAr, 'pool_updrade', 'id');

            $p_id = $details->parent_id;
            $res['p id'] = $p_id;
            for ($l = 1; $l <= $no_of_levels; $l++) {
                $pdetails = $this->team->pool_details($p_id, $pool_id);
                $res['p details'] = $pdetails;
                if ($pdetails) {
                    $res['req on level'] = $req_on_level = $node * pow($node, $l - 1);
                    $p_id = $pdetails->parent_id;
                    $res['p id in loop'] = $p_id;
                    $code = $pdetails->u_id;
                    $ids = $pdetails->id;
                    $payble = $pool_income[$pool_id];
                    $res['level'] = $l;
                    $res['no of levels'] = $no_of_levels;
                    if ($l == $no_of_levels) { ///income only on last row
                        $income = array();
                        $income['tx_u_code'] = $u_code;
                        $income['u_code'] = $code;
                        $income['tx_type'] = 'income';
                        $income['source'] = $source;
                        $income['debit_credit'] = 'credit';
                        $income['amount'] = $payble;
                        $income['date'] = date('Y-m-d H:i:s');
                        $income['status'] = 1;
                        $income['remark'] = "Recieve $source income of amount $payble from level $l";
                        if ($this->db->insert('transaction', $income)) {
                            $this->update_ob->add_amnt($code, $source, $payble);
                            $this->update_ob->add_amnt($code, 'main_wallet', $payble);
                            $res['income'] = $income;

                            $all_team = $this->team->my_pool_team($ids, $pool_id, $no_of_levels);
                            $level_count = (!empty($all_team) ? count($all_team[$l]) : 0);
                            $res['level count'] = $level_count;

                            ////process to recycle and check for updagrade on recycle////////
                            if ($level_count == $req_on_level) {
                                $res['recycle'] = "recycle";
                                $pool_recycle_amount = $pool_recycle[$pool_id];
                                /////=====recycle in the same pool======////
                                $this->gen_pool($code, $pool_recycle_amount, $pool_id);
                                $recycle['u_code'] = $code;
                                $recycle['tx_type'] = 'recycle';
                                $recycle['debit_credit'] = 'debit';
                                $recycle['amount'] = $pool_recycle_amount;
                                $recycle['date'] = date('Y-m-d H:i:s');
                                $recycle['status'] = 1;
                                $recycle['remark'] = "Recycled for $pool_id pool";
                                if ($this->db->insert('transaction', $recycle)) {
                                    $this->update_ob->add_amnt($code, 'main_wallet', -$pool_recycle_amount);
                                }
                                /////=====////////======//////====//////=====/////

                                ////////process to next pool upgrade/////
                                $res["cycle in $pool_id pool"] = $cycles_in_pool = $this->team->get_user_cycle($code, $pool_id);
                                $next_pool_id = $pool_id + 1;
                                $res["cycle in $next_pool_id pool"] = $cycles_in_next_pool = $this->team->get_user_cycle($code, $next_pool_id);
                                if ($cycles_in_pool == 2 && $cycles_in_next_pool == 0) {
                                    $values = array_keys($plan_type, $planName);
                                    $last_pool = end($values);
                                    //=====upgrade when user have 2 cycle in current pool and 0 in next pool, means on first time recycle
                                    ///=====and no upgrade if pool is last=========//////////////
                                    $res['total pools'] = $last_pool;
                                    if ($last_pool != 0 && $pool_id < $last_pool) {
                                        $pool_upgrade_amount = $pool_upgrade[$pool_id];
                                        $res['upgrade'] = $next_pool_id;
                                        ///////======/////upgrade in next pool=====//////==////
                                        $this->gen_pool($code, $pool_upgrade_amount, $next_pool_id);
                                        $updrade['u_code'] = $code;
                                        $updrade['tx_type'] = 'upgraded';
                                        $updrade['debit_credit'] = 'debit';
                                        $updrade['amount'] = $pool_upgrade_amount;
                                        $updrade['date'] = date('Y-m-d H:i:s');
                                        $updrade['status'] = 1;
                                        $updrade['remark'] = "Upgraded for $pool_id pool";
                                        if ($this->db->insert('transaction', $updrade)) {
                                            $this->update_ob->add_amnt($code, 'main_wallet', -$pool_upgrade_amount);
                                        }
                                        /////=====////////======//////====//////=====/////
                                    }
                                }
                            }
                        }
                    }
                } else {
                    break;
                }
            }
        }
        return $res;
    }
    public function getSponsor($u_code, $type)
    {
        $uso = $this->profile->sponsor($u_code);
        if ($uso != '' && $uso != false) {
            $poolinfo = $this->conn->runQuery('id', 'pool', "u_id='$uso' and pool_id='$type' order by id desc");
            if ($poolinfo) {
                return $poolinfo[0]->id;
            } else {
                return $this->getSponsor($uso, $type);
            }
        } else {
            return 1;
        }
    }

    public function gen_pool($u_code, $top_amt = 0, $pool_id)
    {
        $res = array();
        $res['u_code'] = $u_code;
        $res['pool_id'] = $pool_id;
        if ($pool_id == 13) {
            $sp_parent_id = 1;
        } else {
            $sp_parent_id = $this->getSponsor($u_code, $pool_id);
        }
        $planAr = $this->general->plan();
        $plan_type = array_column($planAr, 'type', 'id');
        $planName = $plan_type[$pool_id];
        $res['sp parent'] = $sp_parent_id;
        $matrix = $planName . "_matrix_level";
        $level = $this->conn->setting($matrix);
        $get_matrix_parent = $this->binary->get_matrix_parent($sp_parent_id, $pool_id);
        $update_position['parent_id'] = $get_matrix_parent['parent'];
        $update_position['pool_position'] = $get_matrix_parent['position'];
        $update_position['u_id'] = $u_code;
        $update_position['pool_type'] = "pool" . $pool_id;
        $update_position['pool_id'] = $pool_id;
        $res['b data'] = $get_matrix_parent;
        $pidd = $this->conn->get_insert_id('pool', $update_position);
        $res["distribution"] = $this->distribute->distribute_pool_level($pidd, $top_amt, $level, $pool_id);
        return $res;
    }
}
