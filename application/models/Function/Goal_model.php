<?php
class Goal_model extends CI_Model
{

    public function reward_with_status($userid)
    {
        $myRewards = array();
        $planArr = $this->conn->runQuery("*", 'plan', "1='1'");

        $matchedBusiness = $this->team->ben_pairs($userid, 'matching_pv');

        $leftBp = count($this->team->team_bp($userid, 1));
        $rightBp = count($this->team->team_bp($userid, 2));
        $matchedBp = min($leftBp, $rightBp);

        $profile = $this->profile->profile_info($userid);

        foreach ($planArr as $planRow) {
            $rewardBusiness = $planRow->reward_business;
            $rewardPoints = $planRow->reward_point;
            $rankId = $planRow->id;
            $myRewards[$rankId]['rank'] = $planRow->reward;
            $myRewards[$rankId]['reward_business'] = "$matchedBusiness / $rewardBusiness";
            $myRewards[$rankId]['reward_points'] = "$matchedBp / $rewardPoints";
            $myRewards[$rankId]['status'] = $goalstatus = ($matchedBusiness >= $rewardBusiness && $profile->active_status == 1 && $matchedBp >= $rewardPoints ? 'Achieved' : 'Pending');
            if ($goalstatus == "Achieved") {
                $check_rank_ = $this->conn->runQuery('u_code', 'rank', "rank_id='$rankId' and u_code='$userid'");
                if (!$check_rank_) {
                    $rankinsert['u_code'] = $userid;
                    $rankinsert['rank'] = $planRow->reward;
                    $rankinsert['rank_type'] = 'reward';
                    $rankinsert['status'] = 1;
                    $rankinsert['rank_id'] = $rankId;
                    $this->db->insert('rank', $rankinsert);
                }
            }
        }
        return $myRewards;
    }

    public function reward_bussiness($userid)
    {
        $res = array();
        $legs = $this->business->top_legs($userid);
        $top_leg = $legs[0];
        $leg_Sum = array_sum($legs);
        $other_legs = $leg_Sum - $top_leg;

        $plan = $this->conn->runQuery("*", 'plan', "id<='9'");
        if ($plan) {
            foreach ($plan as $planArr) {
                $reward_business = $planArr->reward_business;
                $leg_rew_buss = $reward_business / 2;
                $rank_id = $planArr->id;

                $around_top_leg = ($top_leg <= $leg_rew_buss ? $top_leg : $leg_rew_buss);
                $around_other_legs = ($other_legs <= $leg_rew_buss ? $other_legs : $leg_rew_buss);

                $res[$rank_id]['top_leg_business'] = "$around_top_leg / $leg_rew_buss ";
                $res[$rank_id]['other_legs_business'] = "$around_other_legs / $leg_rew_buss ";
                // $res[$rank_id]['reward_business']="$leg_Sum/$reward_business USD";
                $res[$rank_id]['rank'] = $planArr->package_name;
                $res[$rank_id]['reward'] = $planArr->reward;
                $res[$rank_id]['salary_month'] = $planArr->salary_month;
                $res[$rank_id]['prize'] = $planArr->prize;
                $res[$rank_id]['u_code'] = $userid;
                $res[$rank_id]['status'] = $goalstatus = (($leg_rew_buss <= $top_leg) && ($leg_rew_buss <= $other_legs) ? 'Achieved' : 'Pending');

                if ($goalstatus == "ok") {
                    // if($top_leg){
                    $rank = array();
                    $rank['rank'] = $planArr->package_name;
                    $rank['u_code'] = $userid;
                    // $rank['rank_per']=$planArr->r_per;
                    $rank['rank_id'] = $rank_id;
                    $rank['is_complete'] = 1;
                    $res['$rank_id']['complete_date'] = $rank['complete_date'] = date('Y-m-d H:i:s');

                    $this->db->insert('rank', $rank);
                }
            }
        }
        //   28
        return $res;
    }

    // public function goal_booster($user_id)
    // {

    //     $all_team = array();
    //     $curr_dts = date('Y-m-d  H:i:s');
    //     $userid = $user_id = $this->session->userdata('user_id');
    //     // print_r($userid);
    //     // die();
    //     $profile = $this->session->userdata("profile");
    //     $join_date = $profile->active_date;
    //     $arr = $this->conn->runQuery("*", 'plan', "id<='4'");
    //     $i = 0;
    //     if ($arr) {
    //         foreach ($arr as $arr_vl) {
    //             $p = $i + 1;
    //             $our_rank = $arr_vl->rank;

    //             $booster_day = $arr_vl->booster_day;
    //             //frst
    //             $res[$p]['booster_day_next'] = $booster_day_next = $arr_vl->booster_day_next;
    //             $booster_direct = $arr_vl->booster_direct;

    //             $res[$p]['booster_roi'] = $booster_daily_roi = $arr_vl->booster_daily_roi;
    //             $booster_total_day = $arr_vl->booster_total_day;

    //             $effectiveDate = date('Y-m-d  H:i:s', strtotime("+$booster_total_day day", strtotime($join_date)));

    //             $my_act = $this->team->my_actives_date($userid, $effectiveDate);
    //             $total_directs = COUNT($my_act);
    //             $ttl_directs = ($total_directs >= $booster_direct ? $booster_direct : $total_directs);
    //             //second
    //             $res[$p]['directs'] = "$ttl_directs/$booster_direct";
    //             // third
    //             $res[$p]['status'] = $goalstatus = ($total_directs >= $booster_direct && $profile->active_status == 1 ? 'Achieved' : 'Pending');

    //             if ($goalstatus == "Achieved") {
    //                 $check_rank_ = $this->conn->runQuery('u_code', 'rank_booster', "rank_id='$p' and u_code='$user_id'");
    //                 if (!$check_rank_) {
    //                     $rankinsert['u_code'] = $user_id;
    //                     $rankinsert['rank'] = $our_rank;
    //                     $rankinsert['is_complete'] = 1;
    //                     $rankinsert['rank_id'] = $p;
    //                     $this->db->insert('rank_booster', $rankinsert);

    //                     $update_rank['booster_rank'] = $our_rank;
    //                     $this->db->where('id', $user_id);
    //                     $this->db->update('users', $update_rank);
    //                 }
    //             }
    //             $i++;
    //         }
    //     }
    //     return $res;
    // }

    // public function booster($order_id, $roi)
    // {
    //     $user_id = $this->conn->runQuery("u_code", 'orders', "id='$order_id'")[0]->u_code;
    //     $res[0]['activation_date'] = $originalDate = $this->conn->runQuery("active_date", 'users', "id='$userid'")[0]->active_date;
    //     $res[0]['curr date'] = $currentDate = date('Y-m-d H:i:s');
    //     $res[0]['source'] = $source = "booster";
    //     $tx = $order_id;
    //     $i = 0;
    //     $plan = $this->conn->runQuery("*", 'plan', "id<='4'");
    //     if ($plan) {
    //         foreach ($plan as $planArr) {
    //             $p = $i + 1;
    //             $res[$p]['booster_total_day'] = $booster_total_day = $planArr->booster_total_day;
    //             $res[$p]['booster_direct'] = $booster_direct = $planArr->booster_direct;
    //             $booster_daily_roi = $planArr->booster_daily_roi;
    //             $our_rank = $planArr->booster_rank;
    //             $res[$p]['newdate'] = $newDate = date("Y-m-d H:i:s", strtotime($originalDate . "+$booster_total_day days"));

    //             $matched_boost = $this->team->my_actives_date($userid, $newDate);
    //             $res[$p]['directs'] = $total_directs = COUNT($matched_boost);
    //             $res[$p]['status'] = ($total_directs >= $booster_direct ? "Achieved" : "pending");
    //             if ($total_directs >= $booster_direct) {

    //                 $check_rank_ = $this->conn->runQuery('u_code', 'rank_booster', "rank_id='$p' and u_code='$user_id' ");
    //                 if (!$check_rank_) {
    //                     $rankinsert['u_code'] = $user_id;
    //                     $rankinsert['rank'] = $our_rank;
    //                     $rankinsert['is_complete'] = 1;
    //                     $rankinsert['rank_id'] = $p;
    //                     $this->db->insert('rank_booster', $rankinsert);
    //                     $res['payable'] = $payable_amt = $roi * $booster_daily_roi;
    //                     $datetime = date('Y-m-d H:i:s');

    //                     $update_rank['booster_rank'] = $our_rank;
    //                     $this->db->where('id', $user_id);
    //                     $this->db->update('users', $update_rank);
    //                 }
    //             }

    //             $i++;
    //         }
    //     }
    //     if ($payable_amt > 0) {

    //         $income = array();
    //         $income['u_code'] = $userid;
    //         $income['tx_type'] = 'income';
    //         $income['source'] = $source;
    //         $income['debit_credit'] = 'credit';
    //         $income['amount'] = $payable_amt;
    //         $income['date'] = date('Y-m-d H:i:s');
    //         $income['added_on'] = date('Y-m-d H:i:s');
    //         $income['status'] = 1;
    //         $income['tx_record'] = $tx;
    //         $income['txs_res'] = 1;
    //         $income['wallet_type'] = 'main_wallet';
    //         $income['remark'] = "Staking Bonus ($datetime)";
    //     }
    //     if ($this->db->insert('transaction', $income)) {

    //         $this->update_ob->add_amnt($userid, $source, $payable_amt);
    //         $this->update_ob->add_amnt($userid, 'main_wallet', $payable_amt);
    //     }

    //     return json_encode($res);
    // }

    /////////Rank function start //////////////////////////

    public function rank_all_orders($user_id)
    {
        if (!$this->action->call_limit_check($user_id)) {
            return;   /// To stop multiple calls within same time
        }
        else{
        
            sleep(1);
            $res = $this->rank($user_id);
            return $res;
    }
    }

   

    public function rank($user_id)
    {
        $type='rank';
  // Acquire the lock
    $lockFile = $this->secure->acquireLock($user_id,$type);

    // Check if the lock was acquired successfully
    if (!$lockFile) {
        // Lock could not be acquired, return an error response
        return ['error' => 'Could not acquire lock. Another process may be running.'];
    }

        $result = array();
        $details = [];
        $plan = $this->conn->runQuery('*', 'plan', "id >=1 And id<15");
        $check_rank = $this->conn->runQuery('*', 'rank', "rank_type='rank' and u_code='$user_id' order by rank_id desc");
        if ($check_rank) {
            $my_rank_id = $check_rank[0]->rank_id;
        } else {
            $my_rank_id = 0;
        }
        $my_actives = $this->team->my_actives($user_id);
        $top_leg_business = $this->business->top_legs($user_id);
        $count_legs = COUNT($top_leg_business);
        $total_legs = array_sum($top_leg_business);
        $top_leg = $top_leg_business[0];
        $other_leg = $total_legs - $top_leg;
        $change = true;
        $profile = $this->conn->runQuery('active_date,active_status', 'users', "id='$user_id'");
        foreach ($plan as $plans) {
            
            $id = $plans->id;
            $fourty = $plans->team_business * 40 / 100;
            $sixty = $plans->team_business * 60 / 100;
            $club_income = $plans->club_income;
            $goalstatus = ($profile[0]->active_status == 1 && $top_leg >= $fourty && $other_leg >= $sixty && $count_legs >= $plans->direct_required ? 'Achieved' : 'Pending');
            $disTop = ($top_leg > $fourty ? $fourty : $top_leg);
            $disOther = ($other_leg > $sixty ? $sixty : $other_leg);
            $details[$id]['rank'] = $plans->rank;
            $details[$id]['team_business'] = $disTop . "/" . $fourty . " || " . $disOther . "/" . $sixty;
            $details[$id]['direct_required'] = $count_legs . "/" . $plans->direct_required;
            $details[$id]['income'] = $plans->compensation_bonus;
            $details[$id]['status'] = $goalstatus;
            $result['data'] = $details;
            if ($change && $goalstatus == 'Pending') {
                $change = false;
                $result['next_rank'] = [
                    "topLegReq" => $fourty,
                    "topLegAch" => $disTop,
                    "otherLegReq" => $sixty,
                    "otherLegAch" => $disOther,
                    "directReq" => $plans->direct_required,
                    "directAch" => $count_legs,
                ];
            }
            $rank_insert = array();
            if ($change && $goalstatus == 'Achieved' && $id > $my_rank_id) {
                //  $change = false;
                $my_rank_id = $id;
                $rank_insert['u_code'] = $user_id;
                $rank_insert['rank'] = $plans->rank;
                $rank_insert['rank_type'] = "rank";
                $rank_insert['rank_income'] = $plans->rank_income;
                $rank_insert['rank_per'] = $plans->compensation_bonus;
                $rank_insert['rank_closing_income'] = 1;
                $rank_insert['rank_id'] = $id;
                $checkss = $this->conn->runQuery('*', 'rank', "rank_type='rank' and rank_id='$my_rank_id' and u_code='$user_id'");
                if (empty($checkss)) {
                    // sleep(2);
                    $this->db->insert('rank', $rank_insert);
                    $update_rank['my_rank'] = $plans->rank;
                    $this->db->where('id', $user_id);
                    $this->db->update('users', $update_rank);

                    $net_capping = $this->business->capping_level($user_id);
                    $wallet_sum = $this->wallet->income($user_id, 'main_wallet');
                    if ($plans->rank_income + $wallet_sum > $net_capping) {
                        $payable_amt = $net_capping - $wallet_sum;
                    } else {
                        $payable_amt = $plans->rank_income;
                    }
                    if ($payable_amt > 0) {

                        $income = array();
                        $income['u_code'] = $user_id;
                        $income['tx_type'] = 'income';
                        $income['source'] = 'rank_bonus';
                        $income['debit_credit'] = 'credit';
                        $income['amount'] = $payable_amt;
                        $income['date'] = date('Y-m-d H:i:s');
                        $income['added_on'] = date('Y-m-d H:i:s');
                        $income['status'] = 1;
                        $income['tx_record'] = $id;
                        $income['txs_res'] = 1;
                        $income['wallet_type'] = 'main_wallet';
                        $income['remark'] = "$ $payable_amt One Time  Rank  Bonus  Credited of rank $plans->rank ";

                        if ($this->db->insert('transaction', $income)) {
                             $this->update_ob->add_amnt($user_id, 'rank_bonus', $payable_amt);
                             $this->update_ob->add_amnt($user_id, 'main_wallet', $payable_amt);
                        }
                    }
                }
                $plans = $this->conn->runQuery('vip_rank,id', 'plan', "id<'6'");
                if ($id == 5) {
                    $vip_rank = $plans[0]->vip_rank;
                    $vip_rank_id = $plans[0]->id;
                } elseif ($id == 7) {
                    $vip_rank = $plans[1]->vip_rank;
                    $vip_rank_id = $plans[1]->id;
                } elseif ($id == 9) {
                    $vip_rank = $plans[2]->vip_rank;
                    $vip_rank_id = $plans[2]->id;
                } elseif ($id == 11) {
                    $vip_rank = $plans[3]->vip_rank;
                    $vip_rank_id = $plans[3]->id;
                } elseif ($id == 13) {
                    $vip_rank = $plans[4]->vip_rank;
                    $vip_rank_id = $plans[4]->id;
                }
                $checkss = $this->conn->runQuery('*', 'rank', "rank_type='vip' and rank='$vip_rank' and u_code='$user_id'");
                if (empty($checkss)) {
                    if ($vip_rank) {
                        $rankinsert['u_code'] = $user_id;
                        $rankinsert['rank'] = $vip_rank;
                        $rankinsert['rank_type'] = 'vip';
                        $rankinsert['rank_per'] = 3;
                        $rankinsert['is_complete'] = 0;
                        $rankinsert['rank_id'] = $vip_rank_id;
                        $this->db->insert('rank', $rankinsert);
                    }
                }
            }
        }
        $result['top_leg'] = $top_leg;
        $result['other_leg'] = $other_leg;
        $result['active_directs'] = $count_legs;

        $this->secure->releaseLock($lockFile['file'], $lockFile['path']);
        return $result;


    }
    //////////////////// Rank function end ///////////////////////////





    public function runner_bonus($user_id)
    {
        $ret = array();
        $profile = $this->conn->runQuery('*', 'users', "id='$user_id'");
        $join_date = $profile[0]->added_on;

        $effectiveDate = date('Y-m-d H:i:s', strtotime("+30 days", strtotime($join_date)));
        $currentDate = date('Y-m-d H:i:s');

        $my_actives = $this->team->my_actives($user_id);
        $top_leg_business = $this->business->top_legs($user_id);
        $total_business = array_sum($top_leg_business);
        $plan = $this->conn->runQuery('*', 'plan', "id=1");
        $runner_team_business = $plan[0]->runner_team_business;
        $runner_direct = $plan[0]->runner_direct;
        $ret[0]['team_business'] = $total_business;
        $ret[0]['target'] = $businessReq = $runner_team_business;
        $ret[0]['direct_req'] = $directReq =$runner_direct;
        $ret[0]['directs'] = $myActives = count($my_actives);
        $ret[0]['target_date'] = $effectiveDate;
        $ret[0]['joining_date'] = $join_date;

        $goalAchieved = ($profile[0]->active_status == 1 && count($my_actives) >= $runner_direct && $total_business >= $runner_team_business && $currentDate <= $effectiveDate);
        $ret[0]['status'] = $goalAchieved ? 'Achieve' : 'Pending';

        if ($goalAchieved) {
            $eligible = $this->conn->runQuery('*', 'rank', "rank_type='runner_bonus' AND u_code='$user_id'");
            if (empty($eligible)) {
                $rankinsert = [
                    'u_code' => $user_id,
                    'rank' => 'runner_bonus',
                    'rank_type' => 'runner_bonus',
                    'is_complete' => 0,
                    'rank_id' => 1,
                ];
                $this->db->insert('rank', $rankinsert);
            }
        }
        return $ret;
    }

    public function retreat_bonus($user_id)
    {
        $ret = [];
        $details = [];
        // Fetch user profile 
        $profile = $this->conn->runQuery('active_date', 'users', "id='$user_id'");
        if ($profile) {
            $join_date = $profile[0]->active_date;
            $start_date = new DateTime($join_date);
            $current_date = new DateTime();
            $interval = $current_date->diff($start_date);
            $total_days = $interval->days;
        } else {
            $total_days = 0;
            // $join_date = date('Y-m-d');
            // $start_date = new DateTime($join_date);
        }

        $my_packages = $this->business->package($user_id);
        $plans = $this->conn->runQuery('*', 'plan', "id<4");
        $top_leg_business = $this->business->top_legs($user_id);
        $total_business = array_sum($top_leg_business);

        foreach ($plans as $plan) {
            $id = $plan->id;
            $psv = $plan->psv;
            $tsv = $plan->tsv;
            $retreat_bonus = $plan->retreat_bonus;
            $time_limit = $plan->retreat_bonus_time_limit;
            $reward = $plan->reward;

            $effectiveDate = date('Y-m-d H:i:s', strtotime("+$time_limit days", strtotime($join_date)));

            $goalAchieved = ($my_packages >= $psv && $total_business >= $tsv && $total_days <= $time_limit);
            $goalstatus = $goalAchieved ? 'Achieved' : 'Pending';
            $eligible = $this->conn->runQuery('*', 'retreat_bonus', "rank_type='$retreat_bonus' AND u_code='$user_id'");
            $rank_type = $eligible->rank_type;
            if ($goalstatus == 'Achieved') {
                if (empty($eligible)) {
                    $rankinsert = [
                        'u_code' => $user_id,
                        'rank' => $reward,
                        'rank_type' => $retreat_bonus,
                        'status' => $goalstatus,
                        'is_complete' => 1,
                        'rank_id' => $id,
                    ];
                    $this->db->insert('retreat_bonus', $rankinsert);
                    $this->update_ob->add_amnt($user_id, 'retreat_bonus', $retreat_bonus);
                    $this->update_ob->add_amnt($user_id, 'main_wallet', $retreat_bonus);
                }
            }

            $company_url = $this->conn->company_info('base_url');
            $ret[$id] = [
                'psv' => $my_packages . "|" . $psv,
                'tsv' => $total_business . "|" . $tsv,
                'bonus' => "$" . $retreat_bonus,
                'target_date' => $effectiveDate,
                'joining_date' => $join_date,
                'tour' => $reward,
                'status' => $rank_type ? "Achieved" : $goalstatus,
                'img' => $company_url . '/images/reward/' . $id . '.jpg',
            ];
        }

        $details['data'] = $ret;
        $details['note'] = "Flight, Hotel & Visa 5 Days / 4 Nights";

        return $details;
    }
}
