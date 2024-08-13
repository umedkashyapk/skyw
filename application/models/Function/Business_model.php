<?php
class Business_model extends CI_Model
{
    public function package($ids)
    {
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code='$ids' and status='1' ");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }
    public function my_package($ids)
    {
        $bv_qr = $this->conn->runQuery('order_bv', 'orders', "u_code='$ids' and status='1' and payout_status='2' order by id desc");
        $ret = ($bv_qr[0]->order_bv != '' ? $bv_qr[0]->order_bv : 0);
        return $ret;
    }

    public function capping_level($user_id)
    {
        $okk = $this->conn->runQuery('SUM(roi_capping) as net_capping', 'orders', "u_code='$user_id' order by id desc");
        return $net_capping = $okk[0]->net_capping;
    }

    public function capping($user_id, $order_id)
    {
        $oder_details = $this->conn->runQuery('*', 'orders', "id='$order_id'")[0];

        $amt = $oder_details->order_amount;
        $capping_amt = $oder_details->roi_capping;

        $okk = $this->conn->runQuery('net_capping', 'orders', "u_code='$user_id' and id <'$order_id' order by id desc");
        if ($okk) {
            $net_capping = $capping_amt + $okk[0]->net_capping;
        } else {
            $net_capping = $capping_amt;
        }
        $update_rank['net_capping'] = $net_capping;
        $this->db->where('id', $order_id);
        $this->db->update('orders', $update_rank);

        return $net_capping;
    }

    public function AI_package($ids)
    {

        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code='$ids' and status='1' and tx_type='purchase'");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }

    public function package_repurchase($ids)
    {

        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code='$ids' and status='1' and tx_type='repurchase' and principal_status=1");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }

    public function directs_business($ids)
    {
        $all_directs = $this->team->my_actives($ids);
        $total_directss = COUNT($all_directs);
        if ($total_directss > 0) {
            $implode = implode(',', $all_directs);
            $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' ");
            $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        } else {
            $ret = 0;
        }
        return $ret;
    }

    public function direct_business_volume($ids)
    {

        $left_teams = $this->team->my_actives($ids);

        if (is_array($left_teams)) {
            $users = $left_teams;
        } else {
            $users = array($left_teams);
        }
        $implode = implode(',', $users);
        if ($implode != '') {
            $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' ");
            $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        } else {
            $ret = 0;
        }
        return $ret;
    }


    public function business_volume($ids)
    {
        if (is_array($ids)) {
            $users = $ids;
        } else {
            $users = array($ids);
        }
        $implode = implode(',', $users);
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' ");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }

    public function team_business_volume($ids, $position)
    {
        $total_active = $this->team->actives();
        $left_teams = $this->team->team_by_position($ids, $position);
        $active_left_team = array_intersect($total_active, $left_teams);
        if (is_array($active_left_team)) {
            $users = $active_left_team;
        } else {
            $users = array($active_left_team);
        }
        $implode = implode(',', $users);
        if ($implode != '') {
            $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' ");
            $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        } else {
            $ret = 0;
        }
        return $ret;
    }

    public function team_pv($ids, $position)
    {
        $total_active = $this->team->actives();
        $left_teams = $this->team->team_by_position($ids, $position);
        $active_left_team = array_intersect($total_active, $left_teams);
        if (is_array($active_left_team)) {
            $users = $active_left_team;
        } else {
            $users = array($active_left_team);
        }
        $implode = implode(',', $users);
        if ($implode != '') {
            $bv_qr = $this->conn->runQuery('SUM(pv) as total_bv', 'orders', "u_code IN ($implode) and status='1' ");

            $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        } else {
            $ret = 0;
        }
        return $ret;
    }


    public function last_session_bv($ids)
    {
        $currenct_payout_id = $this->wallet->currenct_payout_id();
        $last_id = $currenct_payout_id - 1;

        if (is_array($ids)) {
            $users = $ids;
        } else {
            $users = array($ids);
        }
        $implode = implode(',', $users);
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' and payout_id='$last_id' ");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }

    public function previous_bv($ids)
    {
        $currenct_payout_id = $this->wallet->currenct_payout_id();
        if (is_array($ids)) {
            $users = $ids;
        } else {
            $users = array($ids);
        }
        $implode = implode(',', $users);
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' and payout_id<'$currenct_payout_id' ");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }

    public function current_session_bv($ids)
    {
        $currenct_payout_id = $this->wallet->currenct_payout_id();
        if (is_array($ids)) {
            $users = $ids;
        } else {
            $users = array($ids);
        }
        $implode = implode(',', $users);
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' and payout_id='$currenct_payout_id' ");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }



    public function top_legs_with_id($user_id)
    {
        $directs = $this->team->directs($user_id);

        $dir = array();
        if (!empty($directs)) {
            foreach ($directs as $direct_details) {
                $my_generation_with_personal = array();
                $my_generation_with_personal = $this->team->my_generation_with_personal($direct_details);
                if (!empty($my_generation_with_personal)) {
                    $implode = implode(',', $my_generation_with_personal);
                    $personal_bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode)  and status='1'");
                    $ret = ($personal_bv_qr[0]->total_bv != '' ? $personal_bv_qr[0]->total_bv : 0);
                    if ($ret > 0) {
                        $dir[$direct_details] = $ret;
                    }
                }
            }
        }
        /*if(!empty($dir)){
            rsort($dir);
        }*/
        return $dir;
    }


    public function top_legs_repurchase($user_id)
    {
        $directs = $this->team->directs($user_id);

        $dir = array();
        if (!empty($directs)) {
            foreach ($directs as $direct_details) {
                $my_generation_with_personal = array();
                $my_generation_with_personal = $this->team->my_generation_with_personal($direct_details);
                if (!empty($my_generation_with_personal)) {
                    $implode = implode(',', $my_generation_with_personal);
                    $personal_bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode)  and status='1' and tx_type='repurchase'");
                    $ret = ($personal_bv_qr[0]->total_bv != '' ? $personal_bv_qr[0]->total_bv : 0);
                    if ($ret > 0) {
                        $dir[$direct_details] = $ret;
                    }
                }
            }
        }
        if (!empty($dir)) {
            rsort($dir);
        }
        return $dir;
    }


    public function community_business($user_id, $first_date, $last_date)
    {
        $directs = $this->team->directs($user_id);

        $dir = array();
        if (!empty($directs)) {
            foreach ($directs as $direct_details) {
                $my_generation_with_personal = array();
                $my_generation_with_personal = $this->team->my_generation_with_personal($direct_details);
                if (!empty($my_generation_with_personal)) {
                    $implode = implode(',', $my_generation_with_personal);
                    //$personal_bv_qr=$this->conn->runQuery('SUM(order_bv) as total_bv','orders',"u_code IN ($implode)  and status='1'");
                    $personal_bv_qr = $this->conn->runQuery('SUM(amount) as amts', 'transaction', "u_code IN ($implode) and tx_type='income' and source!='self_bonus' and date>='$first_date' and date<='$last_date'");
                    $ret = ($personal_bv_qr[0]->amts != '' ? $personal_bv_qr[0]->amts : 0);
                    if ($ret > 0) {
                        $dir[$direct_details] = $ret;
                    }
                }
            }
        }
        if (!empty($dir)) {
            rsort($dir);
        }
        return $dir;
    }



    public function total_community_business($user_id)
    {
        $directs = $this->team->directs($user_id);

        $dir = array();
        if (!empty($directs)) {
            foreach ($directs as $direct_details) {
                $my_generation_with_personal = array();
                $my_generation_with_personal = $this->team->my_generation_with_personal($direct_details);
                if (!empty($my_generation_with_personal)) {
                    $implode = implode(',', $my_generation_with_personal);
                    //$personal_bv_qr=$this->conn->runQuery('SUM(order_bv) as total_bv','orders',"u_code IN ($implode)  and status='1'");
                    $personal_bv_qr = $this->conn->runQuery('SUM(amount) as amts', 'transaction', "u_code IN ($implode) and tx_type='income' and source!='self_bonus'");
                    $ret = ($personal_bv_qr[0]->amts != '' ? $personal_bv_qr[0]->amts : 0);
                    if ($ret > 0) {
                        $dir[$direct_details] = $ret;
                    }
                }
            }
        }
        if (!empty($dir)) {
            rsort($dir);
        }
        return $dir;
    }

    public function top_legs($user_id)
    {
        $directs = $this->team->directs($user_id);

        $dir = array();
        if (!empty($directs)) {
            foreach ($directs as $direct_details) {
                $my_generation_with_personal = array();
                $my_generation_with_personal = $this->team->my_generation_with_personal($direct_details);
                if (!empty($my_generation_with_personal)) {
                    $implode = implode(',', $my_generation_with_personal);
                    $personal_bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode)  and status='1'");
                    $ret = ($personal_bv_qr[0]->total_bv != '' ? $personal_bv_qr[0]->total_bv : 0);
                    if ($ret > 0) {
                        $dir[$direct_details] = $ret;
                    }
                }
            }
        }
        if (!empty($dir)) {
            rsort($dir);
        }
        return $dir;
    }

    public function team_business($ids)
    {

        $left_teams = $this->team->my_generation($ids);

        if (is_array($left_teams)) {
            $users = $left_teams;
        } else {
            $users = array($left_teams);
        }
        $implode = implode(',', $users);
        if ($implode != '') {
            $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "u_code IN ($implode) and status='1' ");
            $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        } else {
            $ret = 0;
        }
        return $ret;
    }

    public function top_legs_directs($user_id, $next_rank_requried)
    {
        $directs = $this->team->directs($user_id);

        $dir = array();
        if (!empty($directs)) {
            foreach ($directs as $direct_details) {
                $my_generation_with_personal = array();
                $my_generation_with_personal = $this->team->my_generation_with_personal($direct_details);
                if (!empty($my_generation_with_personal)) {
                    $implode = implode(',', $my_generation_with_personal);
                    $personal_bv_qr = $this->conn->runQuery('COUNT(id) as total_bv', 'users', "active_status=1 and rank_id>='$next_rank_requried' and id IN ($implode)");
                    //$personal_bv_qr=$this->conn->runQuery('SUM(order_bv) as total_bv','orders',"u_code IN ($implode)  and status='1'");
                    $ret = ($personal_bv_qr[0]->total_bv != '' ? $personal_bv_qr[0]->total_bv : 0);
                    if ($ret > 0) {
                        $dir[$direct_details] = $ret;
                    }
                }
            }
        }
        if (!empty($dir)) {
            rsort($dir);
        }
        return $dir;
    }



    public function purchase_volume_by_date($ids, $start_date = '', $end_date = '')
    {
        $whr = ' AND';
        if ($start_date != '' && $end_date != '') {
            $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
            $end_date = date('Y-m-d 23:59:00', strtotime($end_date));

            $whr .= " added_on>='$start_date' and added_on<='$end_date' AND";
        }
        $where = rtrim($whr, "AND");

        if (is_array($ids)) {
            $users = $ids;
        } else {
            $users = array($ids);
        }
        $implode = implode(',', $users);
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "tx_type='investment' and u_code IN ($implode) and status='1' $where");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }

    public function repurchase_volume_by_date($ids, $start_date = '', $end_date = '')
    {
        $whr = ' AND';
        if ($start_date != '' && $end_date != '') {
            $start_date = date('Y-m-d 00:00:00', strtotime($start_date));
            $end_date = date('Y-m-d 23:59:00', strtotime($end_date));

            $whr .= " added_on>='$start_date' and added_on<='$end_date' AND";
        }
        $where = rtrim($whr, "AND");

        if (is_array($ids)) {
            $users = $ids;
        } else {
            $users = array($ids);
        }
        $implode = implode(',', $users);
        $bv_qr = $this->conn->runQuery('SUM(order_bv) as total_bv', 'orders', "tx_type!='investment' and u_code IN ($implode) and status='1' $where");
        $ret = ($bv_qr[0]->total_bv != '' ? $bv_qr[0]->total_bv : 0);
        return $ret;
    }
    function get_legs_pool($id, $type)
    {
        $get_tree = $this->conn->runQuery("id,pool_position", 'pool', "parent_id='$id' and pool_type='$type' order by pool_position asc");
        if ($get_tree) {
            $res['legs'] = count($get_tree);
            $res['leg_users'] = array_column($get_tree, 'id');
        } else {
            $res['legs'] = 0;
            $res['leg_users'] = array();
        }
        return $res;
        unset($get_tree);
    }


    function get_pool_parent($donee, $type)
    {
        $result = 'fail';
        $a[] = $donee;
        $i = 0;
        $go = 'yes';
        while ($go == 'yes') {
            $parent = $a[$i];
            //echo "<br>";
            $check_legs = $this->get_legs_pool($parent, $type);
            $legs = $check_legs['legs'];
            $mtrx = $this->conn->setting('matrix_node');
            if ($legs < $mtrx) {
                $result = 'success';
                $postion = $legs + 1;
                $go = 'no';
                break;
            } else {
                $go = 'yes';
                $a = array_merge($a, $check_legs['leg_users']);
                $i++;
            }
        }
        unset($a);
        return array('result' => $result, 'parent' => $parent, 'position' => $postion);
    }


    public function higher_rank($user_id)
    {

        $personal_bv_qr = $this->conn->runQuery('rank', 'rank', "u_code='$user_id' order by rank_id desc LIMIT 1");
        if ($personal_bv_qr) {
            $personal_bv = ($personal_bv_qr[0]->rank != '' ? $personal_bv_qr[0]->rank : 'NA');
        } else {
            $personal_bv_qr1 = $this->conn->runQuery('rank', 'rank', "u_code='$user_id' order by rank_id desc LIMIT 1");
            $personal_bv = ($personal_bv_qr1[0]->rank != '' ? $personal_bv_qr1[0]->rank : 'NA');
        }
        return $personal_bv;
    }
}
