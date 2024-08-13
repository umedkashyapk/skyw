<?php
class Update_wallets extends CI_Model
{

    public function update_wallet($u_code, $slug, $value)
    {

        $column = $this->get_column($slug);

        if ($column != false) {
            $wallet[$column] = $value;
            $wallet_exists = $this->conn->runQuery("$column", 'user_wallets', "u_code='$u_code'");
            if ($wallet_exists) {

                $this->db->where('u_code', $u_code);
                $this->db->update('user_wallets', $wallet);
            } else {
                $wallet['u_code'] = $u_code;
                $this->db->insert('user_wallets', $wallet);
            }
        }
    }


    public function get_column($type)
    {
        $ret = false;
        $get = $this->conn->runQuery('*', 'wallet_types', "slug='$type' and status='1'");
        if ($get) {
            $ret = $get[0]->wallet_column;
        }
        return $ret;
    }

    public function wallet_name($slug)
    {
        $ret = false;
        $get = $this->conn->runQuery('*', 'wallet_types', "slug='$slug'");
        if ($get) {
            $ret = $get[0]->name;
        }
        return $ret;
    }

    public function add_amnt($u_code, $slug, $amnt)
    {
        $column = $this->get_column($slug);
        $wallet_exists = $this->conn->runQuery("$column", 'user_wallets', "u_code='$u_code'");

        if ($wallet_exists) {
            $this->db->set($column, "$column+$amnt", FALSE);
            $this->db->where('u_code', $u_code);
            $this->db->update('user_wallets');
        } else {
            $wallet[$column] = $amnt;
            $wallet['u_code'] = $u_code;
            $this->db->insert('user_wallets', $wallet);
        }
        return true;
    }

    public function any_update($u_code, $slug, $amnt)
    {
        $column = $this->get_column($slug);
        $wallet_exists = $this->conn->runQuery("$column", 'user_wallets', "u_code='$u_code'");

        if ($wallet_exists) {
            $this->db->set($column, $amnt, FALSE);
            $this->db->where('u_code', $u_code);
            $this->db->update('user_wallets');
        } else {
            $wallet[$column] = $amnt;
            $wallet['u_code'] = $u_code;
            $this->db->insert('user_wallets', $wallet);
        }
        return true;
    }

    public function wallet($u_code, $slug)
    {
        $ret = 0;
        $column = $this->get_column($slug);
        $wallet_exists = $this->conn->runQuery("$column", 'user_wallets', "u_code='$u_code'");
        if ($wallet_exists) {
            $ret = $wallet_exists[0]->$column;
        }
        return $ret;
    }
    public function direct_update($u_code)
    {
        $directs = $this->team->directs($u_code);

        $my_actives = $this->team->my_actives($u_code);

        $update = array();
        $total = !empty($directs) ? count($directs) : 0;
        $c1 = $this->get_column('total_directs');
        if ($c1 != false) {
            $update[$c1] = $total;
        }
        $my_actives_ttl = !empty($my_actives) ? count($my_actives) : 0;
        $c2 = $this->get_column('active_directs');
        if ($c2 != false) {
            $update[$c2] = $my_actives_ttl;
        }

        $inactive = $total - $my_actives_ttl;
        $c3 = $this->get_column('inactive_directs');
        if ($c3 != false) {
            $update[$c3] = $inactive;
        }

        $this->db->where('u_code', $u_code);
        $this->db->update('user_wallets', $update);

        $sponsor = $this->profile->sponsor($u_code);
        if ($sponsor) {
            $this->direct_update($sponsor);
        }
    }

    public function generation_update($u_code)
    {

        $actives = $this->team->actives();
        $my_generation = $this->team->my_generation($u_code);

        $active_gen = !empty($my_generation) ? array_intersect($my_generation, $actives) : array();

        $update = array();
        if (!empty($my_generation)) {
            $cnt_gen = count($my_generation);
            $c1 = $this->get_column('total_gen');
            $update[$c1] = $cnt_gen;
        }

        if (!empty($active_gen)) {
            $cnt_activegen = count($active_gen);
            $c2 = $this->get_column('active_gen');
            $update[$c2] = $cnt_activegen;
        }

        $this->db->where('u_code', $u_code);
        $this->db->update('user_wallets', $update);

        $sponsor = $this->profile->sponsor($u_code);
        if ($sponsor) {
            $this->generation_update($sponsor);
        }
    }
    public function active_direct($u_code)
    {
        // $this->add_amnt($u_code,'total_directs',1);
        $this->add_amnt($u_code, 'active_directs', 1);
        $this->add_amnt($u_code, 'inactive_directs', -1);
    }
    public function add_direct($u_code)
    {
        $this->add_amnt($u_code, 'total_directs', 1);
        $this->add_amnt($u_code, 'inactive_directs', 1);
    }

    public function active_gen($u_code)
    {
        //$this->add_amnt($u_code,'total_gen',1);
        $this->add_amnt($u_code, 'active_gen', 1);
        $sponsor = $this->profile->sponsor($u_code);
        if ($sponsor) {
            $this->active_gen($sponsor);
        }
    }
    public function add_gen($u_code)
    {
        $this->add_amnt($u_code, 'total_gen', 1);
        // $this->add_amnt($u_code,'active_gen',1);
        $sponsor = $this->profile->sponsor($u_code);
        if ($sponsor) {
            $this->add_gen($sponsor);
        }
    }
    public function add_pin($u_code, $no_of_pins = 1)
    {
        $this->add_amnt($u_code, 'total_pins', $no_of_pins);
        $this->add_amnt($u_code, 'unused_pins', $no_of_pins);
    }
    public function used_pin($u_code, $no_of_pins = 1)
    {
        //$this->add_amnt($u_code,'total_pins',$no_of_pins);
        $this->add_amnt($u_code, 'unused_pins', -$no_of_pins);
    }

    public function update_binary($u_code)
    {

        $binary_count_type = $this->conn->setting('binary_count_type');
        if ($binary_count_type == 'bv') {
            $left_team = $this->team->team_by_business($u_code, 1);
            $right_team = $this->team->team_by_business($u_code, 2);
        } else {
            $left_team = $this->team->team_by_pv($u_code, 1);
            $right_team = $this->team->team_by_pv($u_code, 2);
        }
        if ($left_team != '') {
            $this->any_update($u_code, 'left_team', $left_team);
        }
        if ($right_team != '') {
            $this->any_update($u_code, 'right_team', $right_team);
        }

        $Parentid = $this->profile->Parentid($u_code);
        if ($Parentid) {
            $this->update_binary($Parentid);
        }
        return true;
    }

    public function update_single_leg($u_code, $active_id)
    {
        $c2 = $this->get_column('single_leg_team');
        $this->db->set($c2, "$c2+1", FALSE);
        $this->db->where("active_id<'$active_id'");
        $this->db->where("active_id!='0'");
        $this->db->update('user_wallets');
    }

    public function update_left_right_pv($u_code)
    {
        $left_team = $this->team->team_by_business($u_code, 1);
        $right_team = $this->team->team_by_business($u_code, 2);
        $this->any_update($u_code, 'left_team', $left_team);
        $this->any_update($u_code, 'right_team', $right_team);
        $Parentid = $this->profile->Parentid($u_code);
        if ($Parentid) {
            $this->update_left_right_pv($Parentid);
        }
        return true;
    }

    public function add_gen_user($u_code, $user_id)
    {
        $check_exists = $this->conn->runQuery('gen_team', 'user_teams', "u_code='$u_code'");
        if ($check_exists) {

            $arr = json_decode($check_exists[0]->gen_team, true);

            if (!empty($arr)) {
                array_push($arr, $user_id);
            } else {
                $arr = array($user_id);
            }
            $arr_updated = array();
            $arr_updated['gen_team'] = json_encode($arr);
            $this->db->where('u_code', $u_code);
            $this->db->update('user_teams', $arr_updated);
            $sponsor = $this->profile->sponsor($u_code);
            if ($sponsor && $sponsor != '' && $sponsor != 0) {
                $this->add_gen_user($sponsor, $user_id);
            }
        }
        return true;
    }
}
