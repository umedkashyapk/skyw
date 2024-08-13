<?php
class Team_model extends CI_Model
{


    public function genealogy_data($userid)
    {
        $result = array();
        $res['id'] = $userid;
        $mProfile = $this->profile->profile_info($userid, "id,username as Username,name as Name,my_rank as Rank");
        $res['attributes'] = $mProfile;
        $res['children'] = $this->genealogy_set($userid);
        $result[] = $res;
        return $result;
    }

    public function genealogy_set($userid)
    {
        $child = array();
        $directs = $this->directs($userid);
        foreach ($directs as $direct) {
            $dProfile = $this->profile->profile_info($direct, "id,username as Username,name as Name,my_rank as Rank");
            $child[] = array(
                'id' => $direct,
                'attributes' => $dProfile,
                'children' => $this->genealogy_set($direct)
            );
        }

        // Always return an array
        return $child;
    }
    public function directs($userid)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid'");
        return ($resp ? array_column($resp, 'id') : array());
    }
    public function up_directs($userid)
    {
        $resp = $this->conn->runQuery("u_sponsor", 'users', "id='$userid'");
        return ($resp ? array_column($resp, 'u_sponsor') : array());
    }

    public function my_actives($userid)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and active_status=1");
        return ($resp ? array_column($resp, 'id') : array());
    }

    public function my_retopup_actives($userid)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and retopup_status=1");
        return ($resp ? array_column($resp, 'id') : array());
    }


    public function my_ranks($rank_id)
    {
        $resp = $this->conn->runQuery("id", 'users', "rank_id>='$rank_id'");
        return ($resp ? array_column($resp, 'id') : array());
    }


    public function my_actives_date($userid, $end_date)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and active_status=1 and active_date<='$end_date'");

        return ($resp ? array_column($resp, 'id') : array());
    }
    //new//
    public function my_actives_left_right($userid, $position)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and active_status=1 and position='$position'");

        return ($resp ? array_column($resp, 'id') : array());
    }
    //new//
    public function my_inactives_left_right($userid, $position)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and active_status=0 and position='$position'");


        return ($resp ? array_column($resp, 'id') : array());
    }

    //new//
    public function my_inactives($userid)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and active_status=0");
        return ($resp ? array_column($resp, 'id') : array());
    }

    public function my_actives_position($userid, $position)
    {
        $resp = $this->conn->runQuery("id", 'users', "u_sponsor='$userid' and position='$position' and active_status=1");
        return ($resp ? array_column($resp, 'id') : array());
    }
    public function actives()
    {
        $resp = $this->conn->runQuery("id", 'users', "active_status=1");
        return ($resp ? array_column($resp, 'id') : array());
    }
    //new/
    public function actives_left_right($position)
    {
        $resp = $this->conn->runQuery("id", 'users', "active_status=1 and position='$position'");
        return ($resp ? array_column($resp, 'id') : array());
    }

    public function pool_status($user_id, $pool_type = 'pool1')
    {
        $get_live_rank = $this->conn->runQuery('*', 'pool', "u_id='$user_id' and pool_type='$pool_type'");
        if ($get_live_rank) {
            $ret = "Active";
        } else {
            $ret = "Not Active";
        }
        return $ret;
    }
    public function pool_node($userid, $pool_id = 1)
    {
        $resp = $this->conn->runQuery('u_id', 'pool', "id='$userid' and pool_id='$pool_id'");
        $ret = ($resp ? $resp[0]->u_id : false);
        return $ret;
    }

    public function pool_node_binary($userid, $pool_id = 1)
    {
        $resp = $this->conn->runQuery('u_id', 'binary_pool', "id='$userid' and pool_id='$pool_id'");
        $ret = ($resp ? $resp[0]->u_id : false);
        return $ret;
    }
    public function pool_details($id, $pool_id = 1)
    {
        $resp = $this->conn->runQuery('*', 'pool', "id='$id' and pool_id='$pool_id'");
        return ($resp ? $resp[0] : false);
    }


    public function upline_team($userid)
    {


        return $this->getUpline($userid);
    }

    public function getUpline($userId, &$upline = array())
    {
        if ($userId != 0) {
            $userDetail = $this->conn->runQuery('u_sponsor', 'users', "id='$userId'");
            // print_r($userDetail);
            $u_sponsor = $userDetail[0]->u_sponsor;
            array_push($upline, $u_sponsor);

            // Recursively call the function to get the parent's upline
            $this->getUpline($u_sponsor, $upline);
        }
        return $upline;
    }


    public function upline_team_test($userid)
    {
        $rank_ids = array();
        $arr = 31; //array($userid);

        for ($i = 0; $i < $arr; $i++) {
            $u_code = $userid;
            $directs = $this->up_directs($u_code);
            if (!empty($directs)) {
                foreach ($directs as $direct) {
                    $userid = $direct;
                    $rank_ids[] = $direct;
                }
            }
        }

        return $rank_ids;
    }
    public function my_pool_level_team($pool_id, $level = 15)
    {
        $arrin = array($pool_id);
        $ret = array();

        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('parent_id', $arrin);
            $alldown = $this->db->get('pool');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
                if ($i > $level) {
                    break;
                }
            } else {
                $arrin = array();
            }
        }


        return $ret;
    }


    public function my_binary_matrix_team($userid)
    {
        $arrin = array($userid);
        $ret = array();

        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('parent_id', $arrin);
            $alldowns = $this->db->get('binary_pool');

            if ($alldowns->num_rows() > 0) {
                $resp = $alldowns->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
            } else {

                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }

    public function ben_pairs($u_code, $ban = 'matching')
    {
        $ret = 0;
        $get_mtch = $this->conn->runQuery("SUM($ban) as amnt", 'binary_matching', "u_code='$u_code' ");
        if ($get_mtch && $get_mtch[0]->amnt != '') {
            $ret = $get_mtch[0]->amnt;
        }
        return $ret;
    }


    public function inactives()
    {
        $resp = $this->conn->runQuery("id", 'users', "active_status=0");
        return ($resp ? array_column($resp, 'id') : array());
    }
    //new/
    public function inactives_left_right($position)
    {
        $resp = $this->conn->runQuery("id", 'users', "active_status=0 and position='$position'");
        return ($resp ? array_column($resp, 'id') : array());
    }

    public function my_generation($userid)
    {
        $arrin = array($userid);
        $ret = array();

        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('u_sponsor', $arrin);
            $alldown = $this->db->get('users');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
            } else {
                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }

    public function generation_from_array($arrin)
    {
        $ret[1] = $arrin;
        $i = 2;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('u_sponsor', $arrin);
            $alldown = $this->db->get('users');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
            } else {
                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }

    public function team_power_leg_and_other($userid, $for = 'power_leg')
    {   // 'other_leg' or 'power_leg'
        $res_array = array();
        $team_business = $this->business->top_legs_with_id($userid);
        //print_r($team_business);
        if ($team_business) {
            $max_value = max($team_business); // Get the highest value
            $power_leg_id = array_search($max_value, $team_business); // Find the index of that value (in this case, 34)
            $directs = $this->directs($userid);


            // Find the index in $directs that has the value of $power_leg_id
            if (($key = array_search($power_leg_id, $directs)) !== false) {
                unset($directs[$key]);
            }

            if ($for == 'power_leg') {
                $array = array($power_leg_id);
            } else {
                $array = $directs;
            }


            $res_array = $this->generation_from_array($array);
        }

        return $res_array;
    }

    public function my_generation_with_personal($userid, $level = 50)
    {
        $arrin = array($userid);
        $ret = array($userid);
        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('u_sponsor', $arrin);
            $alldown = $this->db->get('users');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
                if ($i > $level) {
                    break;
                }
            } else {
                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }
    public function my_pool_team($userid, $pool_id = 1, $level = 15)
    {
        $arrin = array($userid);
        $ret = array();
        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('*');
            $this->db->where('pool_id', $pool_id);
            $this->db->where_in('parent_id', $arrin);
            $alldown = $this->db->get('pool');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
                if ($i > $level) {
                    break;
                }
            } else {
                $arrin = array();
            }
        }
        return $ret;
    }

    function userNames_from_poolId($ids)
    {
        $users = array();
        if ($ids) {
            $implode = implode(',', $ids);
            $usersAr = $this->conn->runQuery('u_id,id', 'pool', "id IN ($implode)");
            $users = array();
            if ($usersAr) {
                $userids = array_column($usersAr, 'u_id', 'id');
                $userNames = $this->profile->ids_to_username_ar($userids);
                foreach ($userids as $userid) {
                    $users[] = $userNames[$userid];
                }
            }
        }
        return $users;
    }

    function get_user_cycle($userId, $pool_id)
    {
        $get_tree = $this->conn->runQuery("*", 'pool', "u_id='$userId' and pool_id='$pool_id'");

        if (!empty($get_tree)) {
            $cycles = count($get_tree);
        } else {
            $cycles = 0;
        }

        return $cycles;
        unset($get_tree);
    }

    public function my_level_team($userid, $level = 15)
    {
        $arrin = array($userid);
        $ret = array();

        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('u_sponsor', $arrin);
            $alldown = $this->db->get('users');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
                if ($i > $level) {
                    break;
                }
            } else {
                $arrin = array();
            }
        }


        return $ret;
    }

    public function my_binary($userid)
    {
        $arrin = array($userid);
        $ret = array();

        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('Parentid', $arrin);
            $alldown = $this->db->get('users');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[] = $arrin;
            } else {
                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }
    public function matrix_pool_data($userid, $pool_plan)
    {
        $res = array();
        $planAr = $this->conn->runQuery('*', 'plan', "type='$pool_plan'");
        $matrix = $pool_plan . "_matrix_node";
        $node = $this->conn->setting($matrix);
        foreach ($planAr as $plan) {
            $pool_id = $plan->id;
            $pool_cycles = $this->conn->runQuery('id', 'pool', "u_id='$userid' and pool_id='$pool_id' order by id asc");
            if ($pool_cycles) {
                $cycleArray = array();
                foreach ($pool_cycles as $key => $pool_cycle) {
                    $cycleNo = $key + 1;
                    $nodes = array();
                    $cycle_id = $pool_cycle->id;
                    $arrayTeam = $this->my_pool_team($cycle_id, $pool_id, 1)[1];
                    $child_nodes_array = array();
                    $child_nodes_usernames = array();
                    if (!empty($arrayTeam)) {
                        if ($pool_plan == 'g2') {
                            foreach ($arrayTeam as $next_level) {
                                $nextTeam = $this->my_pool_team($next_level, $pool_id, 1)[1];
                                $child_nodes_array[$next_level] = (!empty($nextTeam) ? $nextTeam : array());
                                $nodes = array_merge($nodes, $child_nodes_array[$next_level]);
                                $child_nodes_usernames[$next_level] = $this->userNames_from_poolId($child_nodes_array[$next_level]);
                            }
                        } else {
                            $nodes = $arrayTeam;
                        }
                    }
                    $nodeCount = (!empty($nodes) ? count($nodes) : 0);

                    $nodesUsernames = $this->userNames_from_poolId($arrayTeam);
                    $cycleArray[$cycle_id]['nodes'] = $arrayTeam;
                    $cycleArray[$cycle_id]['nodes_username'] = $nodesUsernames;
                    $cycleArray[$cycle_id]['child_Nodes'] = $child_nodes_array;
                    $cycleArray[$cycle_id]['child_Nodes_username'] = $child_nodes_usernames;
                    $cycleArray[$cycle_id]['cycleNo'] = $cycleNo;
                    $cycleArray[$cycle_id]['nodeCount'] = $nodeCount;
                    $cycleArray[$cycle_id]['income'] = $plan->pool_package * $nodeCount;
                    if ($nodeCount == $node && $nodeCount > 0) {
                        $cycleArray[$cycle_id]['recycle_amount'] = $plan->pool_recycle;
                        if ($cycleNo == 1) {
                            $cycleArray[$cycle_id]['upgrade_amount'] = $plan->pool_upgrade;
                        } else {
                            $cycleArray[$cycle_id]['upgrade_amount'] = 0;
                        }
                        $cycleArray[$cycle_id]['income'] = $cycleArray[$cycle_id]['income'] - $plan->pool_recycle - $cycleArray[$cycle_id]['upgrade_amount'];
                    } else {
                        $cycleArray[$cycle_id]['upgrade_amount'] = 0;
                        $cycleArray[$cycle_id]['recycle_amount'] = 0;
                    }
                    unset($child_nodes_array);
                    unset($child_nodes_usernames);
                    unset($nodes);
                }
            }
            $data['data'] = $cycleArray;
            $data['cycles'] = (!empty($cycleArray) ? count($cycleArray) : 0);
            $data['package_amount'] = $plan->pool_package;

            $res[$pool_id] = $data;
            unset($cycleArray);
            unset($data);
        }
        return $res;
    }

    public function my_binary_active($userid)
    {
        $arrin = array($userid);
        $ret = array();

        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('Parentid', $arrin);
            $this->db->where('active_status', 1);
            $alldown = $this->db->get('users');
            if ($alldown->num_rows() > 0) {
                $resp = $alldown->result();
                $arrin = array_column($resp, 'id');
                $ret[] = $arrin;
            } else {
                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }

    public function team_by_position($userid, $position)
    {
        $ret = array();
        $get_position_user = $this->conn->runQuery("id", 'users', "Parentid='$userid' and position='$position'");
        if ($get_position_user) {
            $ret = $this->my_binary($get_position_user[0]->id);
            $ret[] = $get_position_user[0]->id;
        }
        return $ret;
    }

    /* public function team_by_pv($userid,$position){
       $my_teams=$this->team_by_position($userid,$position);     
      
        if(!empty($my_teams)){
     	            //echo "enetr"; 
                    $implode=implode(',',$my_teams);
                    $personal_bv_qr=$this->conn->runQuery('SUM(pv) as amt','orders',"u_code IN ($implode)  and status='1' and tx_type='purchase'");
                   //echo $this->db->last_query();
                    return $ret = ($personal_bv_qr[0]->amt!='' ? $personal_bv_qr[0]->amt:0);                    
                
        }
       
    }
    public function team_by_business($userid,$position){
       $my_teams=$this->team_by_position($userid,$position);     
      
        if(!empty($my_teams)){
     	            //echo "enetr"; 
                    $implode=implode(',',$my_teams);
                    $personal_bv_qr=$this->conn->runQuery('SUM(order_bv) as amt','orders',"u_code IN ($implode)  and status='1' ");
                   //echo $this->db->last_query();
                    return $ret = ($personal_bv_qr[0]->amt!='' ? $personal_bv_qr[0]->amt:0);                    
                
        }
       
    }
    */

    public function team_by_pv($userid, $position)
    {
        $my_teams = $this->team_by_position($userid, $position);
        $total_personal_pv = 0;
        if (!empty($my_teams)) {
            //echo "enetr"; 
            $implode = implode(',', $my_teams);
            $personal_bv_qr = $this->conn->runQuery('SUM(pv) as amt', 'orders', "u_code IN ($implode)  and status='1' and tx_type='purchase'");
            //echo $this->db->last_query();
            $total_personal_pv = ($personal_bv_qr[0]->amt != '' ? $personal_bv_qr[0]->amt : 0);
        }
        $personal_carry = $this->conn->runQuery('SUM(carry) as amt', 'dummy_carry', "u_code='$userid' and position='$position' and status='1'");
        $total_dummy_carry = $personal_carry[0]->amt != '' ? $personal_carry[0]->amt : 0;
        return $ret = $total_personal_pv + $total_dummy_carry;
    }
    public function team_by_business($userid, $position)
    {
        $my_teams = $this->team_by_position($userid, $position);
        $total_personal_pv = 0;
        if (!empty($my_teams)) {
            //echo "enetr"; 
            $implode = implode(',', $my_teams);
            $personal_bv_qr = $this->conn->runQuery('SUM(order_bv) as amt', 'orders', "u_code IN ($implode)  and status='1' ");
            //echo $this->db->last_query();
            $total_personal_pv = ($personal_bv_qr[0]->amt != '' ? $personal_bv_qr[0]->amt : 0);
        }

        $personal_carry = $this->conn->runQuery('SUM(carry) as amt', 'dummy_carry', "u_code='$userid' and position='$position' and status='1'");
        $total_dummy_carry = $personal_carry[0]->amt != '' ? $personal_carry[0]->amt : 0;
        return $ret = $total_personal_pv + $total_dummy_carry;
    }



    public function team_by_position_active($userid, $position)
    {
        $ret = array();
        $get_position_user = $this->conn->runQuery("id", 'users', "Parentid='$userid' and position='$position' and active_status='1'");
        if ($get_position_user) {
            $ret = $this->my_binary_active($get_position_user[0]->id);
            $ret[] = $get_position_user[0]->id;
        }
        return $ret;
    }

    /*public function ben_pairs($u_code,$ban='matching_pairs'){
        $ret=0;
        $get_mtch=$this->conn->runQuery("SUM($ban) as amnt",'transaction',"u_code='$u_code' and source='binary'");
        if($get_mtch && $get_mtch[0]->amnt!=''){
            $ret=$get_mtch[0]->amnt;
        }
        return $ret;
    }*/

    public function downline_rank_team($userid, $rank_per)
    {
        $rank_ids = array();
        $arr = array($userid);

        for ($i = 0; $i < count($arr); $i++) {
            $u_code = $arr[$i];
            $directs = $this->directs($u_code);
            if (!empty($directs)) {
                foreach ($directs as $direct) {
                    $check_rank = $this->profile->my_rank_per($direct);
                    if ($check_rank >= $rank_per) {
                        $rank_ids[] = $direct;
                    } else {
                        $arr[] = $direct;
                    }
                }
            }
        }

        return $rank_ids;
    }


    public function downline_rank($userid)
    {
        $details = [];
        $directs = $this->directs($userid);

        foreach ($directs as $direct) {
            // Fetch the downline rank and user ID
            $downline_rank = $this->conn->runQuery('my_rank, id', 'users', "id='$direct'");

            // Ensure we have a valid result before proceeding
            if (!empty($downline_rank)) {
                $downline_rank = $downline_rank[0];

                // Append rank information to the details array
                $details[] = [
                    'id' => $downline_rank->id,
                    'rank' => $downline_rank->my_rank,
                ];
            }
        }

        return $details;
    }

    public function my_matrix_team($userid)
    {
        $arrin = array($userid);
        $ret = array();

        $i = 1;
        while (!empty($arrin)) {
            $this->db->select('id');
            $this->db->where_in('parent_id', $arrin);
            $alldowns = $this->db->get('pool');

            if ($alldowns->num_rows() > 0) {
                $resp = $alldowns->result();
                $arrin = array_column($resp, 'id');
                $ret[$i] = $arrin;
                $i++;
            } else {

                $arrin = array();
            }
        }

        $final = array();
        if (!empty($ret)) {
            array_walk_recursive($ret, function ($item, $key) use (&$final) {
                $final[] = $item;
            });
        }

        return $final;
    }



    public function my_single_leg($userid)
    {
        $ret = array();
        $all_ids = $this->conn->runQuery("id", 'users', " id > '$userid' ");
        if ($all_ids) {
            $ret = array_column($all_ids, 'id');
        }
        return $ret;
    }

    public function my_active_single_leg($userid)
    {
        $ret = array();
        $check_active = $this->conn->runQuery("id,active_id", 'users', "id='$userid' and active_status='1'");
        if ($check_active) {
            $active_id = $check_active[0]->active_id;
            $all_ids = $this->conn->runQuery("id", 'users', " active_status='1' and active_id > '$active_id' ");
            if ($all_ids) {
                $ret = array_column($all_ids, 'id');
            }
        }
        return $ret;
    }

    public function my_single_leg_rank($userid, $rank_type)
    {
        $ret = array();
        $check_active = $this->conn->runQuery("u_code,active_id", 'rank', "u_code='$userid' and rank_type='$rank_type'");
        if ($check_active) {
            $active_id = $check_active[0]->active_id;
            $all_ids = $this->conn->runQuery("u_code", 'rank', " rank_type='$rank_type' and active_id > '$active_id' ");
            if ($all_ids) {
                $ret = array_column($all_ids, 'u_code');
            }
        }
        return $ret;
    }
    public function tree($counter_matrix_level, $parent)
    {

        $treedata = false;

        if ($parent != '') {
            $treedata = $this->conn->runQuery("*", 'users', "Parentid='$parent' order by position asc");
        }

        $counter_matrix_level++;

        $matrix_node = $this->conn->setting('tree_node');
        $show_tree_level = $this->conn->setting('show_tree_level');
        $wdth = 100 / $matrix_node;
?>
        <div class="flex">
            <div class="flex-item" style="--item-width:100%">
                <img style="width:50%;min-width:50px;" src="<?= base_url(); ?>images/users/arrow.png">
                <div class="flex " style="color:#333;">
                    <?php
                    for ($n = 0; $n < $matrix_node; $n++) {
                        $pos = $n + 1;
                    ?>
                        <div class="flex-item" style="--item-width:<?= $wdth; ?>%">
                            <?php
                            $check_position = false;
                            if ($parent != '') {
                                $check_position = $this->conn->runQuery("*", 'users', "Parentid='$parent' and position='$pos'");
                            }
                            if ($check_position) {
                                $nxt_parent = $check_position[0]->id;
                                $u_code = $check_position[0]->id;
                                $_user_profile = $this->profile->profile_info($u_code, 'username,name,email,added_on,u_sponsor,active_status,active_date');
                                $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
                                $total_active = $this->team->actives();
                                $left_teams = $this->team->team_by_position($u_code, 1);
                                $active_left_team = array_intersect($total_active, $left_teams);
                                $left_team = count($left_teams);

                                $right_teams = $this->team->team_by_position($u_code, 2);
                                $active_right_team = array_intersect($total_active, $right_teams);
                                $right_team = count($right_teams);

                                $active_left = $this->team->actives_left_right(1);
                                $active_lefts = count($active_left);


                                $red_units = $this->team->inactives();
                                $inactive_right_team = array_intersect($red_units, $right_teams);
                                $inactive_left_team = array_intersect($red_units, $left_teams);

                                $total_direct_greens = $this->team->my_actives($u_code);
                                $total_direct_green = count($total_direct_greens);

                                $total_direct_reds = $this->team->my_inactives($u_code);
                                $total_direct_red = count($total_direct_reds);

                                $total_green_unit_left = $this->team->my_actives_left_right($u_code, 1);
                                $total_green_unit_lefts = count($total_green_unit_left);

                                $total_green_unit_right = $this->team->my_actives_left_right($u_code, 2);
                                $total_green_unit_rights = count($total_green_unit_right);

                                $total_direct_red_left = $this->team->my_inactives_left_right($u_code, 1);
                                $total_direct_red_lefts = count($total_direct_red_left);

                                $total_direct_red_right = $this->team->my_inactives_left_right($u_code, 2);
                                $total_direct_red_rights = count($total_direct_red_right);

                                $package = $this->business->package($u_code);

                            ?>
                                <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $_user_profile->name; ?><br>Sponser Id: <?= $sponsor_details ? $sponsor_details->name : ''; ?> (<?= $sponsor_details ? $sponsor_details->username : ''; ?>) <br> Total Member:&nbsp; L:<?= $left_team != '' ? $left_team : '0'; ?>&nbsp;R:<?= $right_team != '' ? $right_team : '0'; ?><br>Kit :&nbsp;&nbsp; <?= $package; ?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team) != '' ? count($active_left_team) : '0'; ?>&nbsp;R:<?= COUNT($active_right_team) != '' ? COUNT($active_right_team) : '0'; ?> <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team) != '' ? COUNT($inactive_left_team) : '0'; ?>&nbsp;R:<?= COUNT($inactive_left_team) != '' ? COUNT($inactive_right_team) : '0'; ?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts != '' ? $total_green_unit_lefts : '0'; ?>&nbsp;R:<?= $total_green_unit_rights != '' ? $total_green_unit_rights : '0'; ?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts != '' ? $total_direct_red_lefts : '0'; ?>&nbsp;R:<?= $total_direct_red_rights != '' ? $total_direct_red_rights : '0'; ?><br> Time :<?= $_user_profile->active_date ? $_user_profile->active_date : ''; ?>">
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                </span>
                                <br>
                            <?php
                                echo '<p><a href="?node=' . $nxt_parent . '">';
                                echo $_user_profile->active_status == '1' ? '<i class="fa fa-circle" style="color:green;"></i>' : '<i class="fa fa-circle" style="color:red;"></i>';
                                echo $_user_profile->username;
                                echo "<br>" . $_user_profile->name;
                                echo '</a></p>';
                            } else {
                            ?>
                                <span>
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                </span>
                                <br>
                            <?php
                                echo "<span style=color:#333;'>Null</span>";
                                echo "<br>";
                                $nxt_parent = '';
                            }




                            if ($counter_matrix_level <= $show_tree_level) {
                                $this->tree($counter_matrix_level, $nxt_parent);
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }

    public function make_svg($wdth, $nodes)
    {

        $plus_per = 50 / ($nodes - 1);
    ?>

        <svg style="width:<?= $wdth; ?>%;">
            <line x1="50%" y1="0%" x2="50%" y2="10%" style="stroke:#000000;stroke-width:1" />
            <line x1="25%" y1="10%" x2="75%" y2="10%" style="stroke:#000000;stroke-width:1" />
            <?php
            for ($m = 0; $m < $nodes; $m++) {
                $pl_ = $m * $plus_per;
            ?>
                <line x1="<?= 25 + $pl_; ?>%" y1="10%" x2="<?= 25 + $pl_; ?>%" y2="100%" style="stroke:#000000;stroke-width:1" />
            <?php
            }
            ?>



        </svg>

    <?php
    }


    public function new_tree($parent_id, $tree_no = 1)
    {
        $nodes = 2; //$this->conn->setting('tree_node');
        $plus_per = 80 / ($nodes - 1);

        $profile_i = $this->profile->profile_info($parent_id);

    ?>
        <span data-toggle="popover1" data-trigger="hover" data-html="true"></span>
        <img style="height:60px;width:60px;" class="rounded-circle img-thumbnail" src="<?= base_url('images/users/tree_user.png'); ?>">
        </span>
        <br>
        <?= $profile_i ? $profile_i->username : ''; ?>
        <br>
        <?= $profile_i ? $profile_i->name : ''; ?>
        <br>
        <?php
        if ($profile_i->active_status == '1') {
            echo '<i class="fa fa-circle btn-sm" style="color:green;" aria-hidden="true"></i>';
        } else {
            echo '<i class="fa fa-circle btn-sm" style="color:red;" aria-hidden="true"></i>';
        }
        ?>

        <svg style="width:100%;height:50px;margin:0px;">
            <line x1="50%" y1="0%" x2="50%" y2="100%" style="stroke:#000000;stroke-width:1" />
            <line x1="10%" y1="100%" x2="90%" y2="100%" style="stroke:#000000;stroke-width:1" />
        </svg>
        <svg style="width:100%;height:50px;margin:0px;">
            <?php
            for ($m = 0; $m < $nodes - 1; $m++) {
                $pl_ = $m * $plus_per;
            ?>
                <line x1="<?= 10 + $pl_; ?>%" y1="0%" x2="<?= 10 + $pl_; ?>%" y2="100%" style="stroke:#000000;stroke-width:1" />
            <?php
            }
            ?>
            <line x1="90%" y1="0%" x2="90%" y2="100%" style="stroke:#000000;stroke-width:1" />
        </svg>

        <svg style="width:100%;height:50px;">
            <?php

            for ($m = 0; $m < $nodes; $m++) {
                $pl_ = $m * $plus_per;
                $posi = $m + 1;
                $get_downline = $this->conn->runQuery('*', 'users', "Parentid='$parent_id' and position='$posi'");
            ?>
                <defs>
                    <pattern id="image<?= $m; ?>" patternUnits="userSpaceOnUse" height="50" width="50">
                        <image x="0" y="0" height="50" width="50" xlink:href="<?= base_url('images/users/tree_user.png'); ?>"></image>
                    </pattern>
                </defs>
                <circle stroke="black" cx="<?= 10 + $pl_; ?>%" cy="50%" r="25" fill="url(#image<?= $m; ?>)" <?php if ($get_downline) { ?> onclick="return my_new_func('<?= 10 + $pl_; ?>',<?= $tree_no; ?>,<?= $get_downline[0]->id ?>);" <?php } ?> />

            <?php


            }
            ?>
        </svg>

        <svg style="width:100%;height:50px;margin:0px;">

            <?php
            for ($m = 0; $m < $nodes; $m++) {

                $pl_ = $m * $plus_per;
                $posi = $m + 1;
                $get_downline = $this->conn->runQuery('*', 'users', "Parentid='$parent_id' and position='$posi'");

            ?>
                <text x="<?= 7.5 + $pl_; ?>%" y="25%" style="fill:black;" <?php if ($get_downline) { ?> onclick="return my_new_func('<?= 10 + $pl_; ?>',<?= $tree_no; ?>,<?= $get_downline[0]->id ?>);" <?php } ?>>

                    <?php
                    if ($get_downline[0]->id) {
                        echo $this->profile->profile_info($get_downline[0]->id)->username;

                    ?>
                        <tspan x="<?= 7.5 + $pl_; ?>%" y="55%" style="fill:black;">
                            <?= $this->profile->profile_info($get_downline[0]->id)->name; ?>

                        </tspan>
                        <tspan x="<?= 7.5 + $pl_; ?>%" y="90%" style="fill:black;">
                            <?= ($this->profile->profile_info($get_downline[0]->id)->active_status == '1' ? 'Active' : 'Inactive'); ?>

                        </tspan>
                    <?php


                    } else {
                        echo 'NULL';
                    }
                    ?>
                </text>


            <?php
            }

            ?>


        </svg>
    <?php
    }

    public function treen($counter_matrix_level, $parent)
    {

        $treedata = false;


        $counter_matrix_level++;

        $matrix_node = $this->conn->setting('tree_node');
        $show_tree_level = 3;
        $wdth = 100 / $matrix_node;
    ?>
        <div class="flex">
            <div class="flex-item">
                <center>
                    <svg style="width:<?= $wdth; ?>%;min-width:50px;">
                        <line x1="50%" y1="1%" x2="50%" y2="10%" style="stroke:#000000;stroke-width:1" />
                        <line x1="20%" y1="10%" x2="80%" y2="10%" style="stroke:#000000;stroke-width:1" />
                        <line x1="20%" y1="10%" x2="20%" y2="15%" style="stroke:#000000;stroke-width:1" />
                        <line x1="50%" y1="10%" x2="50%" y2="15%" style="stroke:#000000;stroke-width:1" />
                        <line x1="80%" y1="10%" x2="80%" y2="15%" style="stroke:#000000;stroke-width:1" />
                    </svg>
                </center>
                <!--<img  style="width:50%;min-width:50px;"  src="<?= base_url(); ?>images/users/arrow.png">-->
                <div class="flex">
                    <?php
                    for ($n = 0; $n < $matrix_node; $n++) {
                        $pos = $n + 1;
                    ?>
                        <div class="flex-item" style="--item-width:<?= $wdth; ?>%">
                            <?php
                            $check_position = false;

                            if ($check_position) {
                                echo '<p><a href="?node=' . $nxt_parent . '">';
                                echo $_user_profile->active_status == '1' ? '<i class="fa fa-circle" style="color:green;"></i>' : '<i class="fa fa-circle" style="color:red;"></i>';
                                echo $_user_profile->username;
                                echo "<br>" . $_user_profile->name;
                                echo '</a></p>';
                            } else {
                                echo "Null";
                                echo "<br>";

                                $nxt_parent = '';
                            }




                            if ($counter_matrix_level <= $show_tree_level) {
                                $this->treen($counter_matrix_level, $nxt_parent);
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }

    public function matrix($counter_matrix_level, $parent)
    {

        $treedata = false;

        if ($parent != '') {
            $treedata = $this->conn->runQuery("*", 'users', "matrix_pool='$parent' order by matrix_position asc");
        }

        $counter_matrix_level++;

        $matrix_node = $this->conn->setting('matrix_node');
        $show_tree_level = $this->conn->setting('show_matrix_level');
        $wdth = 100 / $matrix_node;
    ?>
        <div class="flex">
            <div class="flex-item" style="--item-width:100%">
                <img style="width:75%;min-width:50px;" src="<?= base_url(); ?>images/users/arrow.png">
                <div class="flex">
                    <?php
                    for ($n = 0; $n < $matrix_node; $n++) {
                    ?>
                        <div class="flex-item" style="--item-width:<?= $wdth; ?>%">
                            <?php
                            if ($treedata && count($treedata) > $n) {
                                $nxt_parent = $treedata[$n]->id;
                                $u_code = $treedata[$n]->id;
                                $_user_profile = $this->profile->profile_info($u_code);
                                $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
                            ?>
                                <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $_user_profile->name; ?><br>Sponser Id: <?= ($sponsor_details ? $sponsor_details->name : 'null'); ?> (<?= ($sponsor_details ? $sponsor_details->username : 'null'); ?>)<br> Email: <?= $_user_profile->email; ?><br>Join Date : <?= $_user_profile->added_on; ?>">
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                </span>
                                <br>
                            <?php
                                echo '<a href="?node=' . $nxt_parent . '">';
                                echo $_user_profile->name;
                                echo '</a>';
                            } else {
                            ?>
                                <span>
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                </span>
                                <br>
                            <?php
                                echo "Null";
                                $nxt_parent = '';
                            }

                            if ($counter_matrix_level <= $show_tree_level) {
                                $this->matrix($counter_matrix_level, $nxt_parent);
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }

    public function matrix_pool($counter_matrix_level, $parent, $pool_id = '1', $pool_type = 'pool1')
    {

        $treedata = false;

        if ($parent != '') {
            $treedata = $this->conn->runQuery("*", 'pool', "parent_id='$parent' and pool_type='$pool_type'  order by pool_position asc");
            //print_r($treedata);                                                   
        }

        $counter_matrix_level++;

        $matrix_node = $this->conn->setting('matrix_node');
        $show_tree_level = $this->conn->setting('show_matrix_level');
        $wdth = 100 / $matrix_node;
    ?>
        <div class="flex">
            <div class="flex-item" style="--item-width:100%">
                <img style="width:75%;min-width:50px;" src="<?= base_url(); ?>images/users/arrow.png">
                <div class="flex">
                    <?php
                    for ($n = 0; $n < $matrix_node; $n++) {
                    ?>
                        <div class="flex-item" style="--item-width:<?= $wdth; ?>%">
                            <?php
                            if ($treedata && count($treedata) > $n) {
                                $nxt_parent = $treedata[$n]->id;
                                $u_code = $treedata[$n]->u_id;
                                $_user_profile = $this->profile->profile_info($u_code);
                                // print_r($_user_profile);
                                $sponsor_details = $this->profile->sponsor_info($u_code);

                                $my_actives = $this->team->my_actives($u_code);

                            ?>
                                <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="FULL NAME :<?= $_user_profile ? $_user_profile->name : ''; ?><br>SPONCER NAME: <?= ($sponsor_details ? $sponsor_details->name : 'null'); ?> <br>JOINING DATE : <?= $_user_profile ? $_user_profile->added_on : ''; ?><br>ACTIVATION DATE : <?= $_user_profile ? $_user_profile->updated_on : ''; ?>">
                                    <?php

                                    if (count($my_actives) >= 2) {
                                    ?>
                                        <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                    <?php
                                    }
                                    ?>

                                </span>
                                <br>
                            <?php

                                $clr = '#fff';
                                //if(count($my_actives)>=2){
                                $clr = 'green';
                                //}
                                echo '<a style="color:' . $clr . ';" href="?node=' . $nxt_parent . '">';
                                echo $_user_profile ? $_user_profile->name : '';
                                echo "<br>";
                                echo $_user_profile ? $_user_profile->username : '';
                                echo '</a>';
                            } else {
                            ?>
                                <span>
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                </span>
                                <br>
                            <?php
                                echo "<span style='color:#fff'>Null</span>";
                                $nxt_parent = '';
                            }

                            if ($counter_matrix_level <= $show_tree_level) {
                                $this->matrix_pool($counter_matrix_level, $nxt_parent, $pool_id, $pool_type);
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }


    public function binary_matrix_tree($counter_binary_level, $parent, $pool_id = '1', $pool_type = 'pool1')
    {

        $treedata = false;

        if ($parent != '') {
            $treedata = $this->conn->runQuery("*", 'binary_pool', "parent_id='$parent' and pool_type='$pool_type'  order by pool_position asc");
        }

        $counter_binary_level++;

        $binary_node = $this->conn->setting('binary_node');
        $show_tree_level = $this->conn->setting('show_binary_level');
        $wdth = 100 / $binary_node;
    ?>
        <div class="flex">
            <div class="flex-item" style="--item-width:100%">
                <img style="width:67%;min-width:50px;" src="<?= base_url(); ?>images/users/arrow.png">
                <div class="flex">
                    <?php
                    for ($n = 0; $n < $binary_node; $n++) {
                    ?>
                        <div class="flex-item" style="--item-width:<?= $wdth; ?>%">
                            <?php
                            if ($treedata && count($treedata) > $n) {
                                $nxt_parent = $treedata[$n]->id;
                                $u_code = $treedata[$n]->u_id;
                                $_user_profile = $this->profile->profile_info($u_code);
                                // print_r($_user_profile);
                                $sponsor_details = $this->profile->sponsor_info($u_code);

                                $my_actives = $this->team->my_actives($u_code);

                            ?>
                                <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="FULL NAME :<?= $_user_profile ? $_user_profile->name : ''; ?><br>SPONCER NAME: <?= ($sponsor_details ? $sponsor_details->name : 'null'); ?> <br>JOINING DATE : <?= $_user_profile ? $_user_profile->added_on : ''; ?><br>ACTIVATION DATE : <?= $_user_profile ? $_user_profile->updated_on : ''; ?>">
                                    <?php

                                    if (count($my_actives) >= 2) {
                                    ?>
                                        <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                    <?php
                                    } else {
                                    ?>
                                        <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                    <?php
                                    }
                                    ?>

                                </span>
                                <br>
                            <?php

                                $clr = '';
                                //if(count($my_actives)>=2){
                                $clr = 'green';
                                //}
                                echo '<a style="color:' . $clr . ';" href="?node=' . $nxt_parent . '">';
                                echo $_user_profile ? $_user_profile->name : '';
                                echo "<br>";
                                echo $_user_profile ? $_user_profile->username : '';
                                echo '</a>';
                            } else {
                            ?>
                                <span>
                                    <img class="user" src="<?= base_url('images/users/tree_user.png'); ?>">
                                </span>
                                <br>
                            <?php
                                echo "Null";
                                $nxt_parent = '';
                            }

                            if ($counter_binary_level <= $show_tree_level) {
                                $this->binary_matrix_tree($counter_binary_level, $nxt_parent, $pool_id, $pool_type);
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
    }
}

?>