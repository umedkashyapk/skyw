<?php
class Profile_model extends CI_Model
{
    public function id_by_username($username)
    {

        $res = $this->conn->runQuery('id', 'users', array('username' => $username));
        if ($res) {
            return $res[0]->id;
        } else {
            return false;
        }
    }


    public function id_by_username_info($username)
    {

        $res = $this->conn->runQuery('id', 'users_info', array('username' => $username));
        if ($res) {
            $res[0]->u_code;
        } else {
            return false;
        }
    }

    public function ids_to_username_ar($ids, $param = '*')
    {

        $implode = implode(',', $ids);
        $res = $this->conn->runQuery($param, 'users', "id IN ($implode)");
        if ($res) {
            return array_column($res, 'username', 'id');
        } else {
            return array();
        }
        unset($res);
    }

    public function profile_info_users($id, $param = '*')
    {
        $res = $this->conn->runQuery($param, 'users_info', array('u_code' => $id));
        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }

    public function my_default_account($u_code)
    {
        $my_accounts = array();
        $my_accounts_arr = $this->conn->runQuery('*', 'user_payment_methods', "u_code='$u_code' and status='1'");
        if ($my_accounts_arr) {
            $default = $my_accounts_arr[0]->default_account;
            $my_accounts_array = $my_accounts_arr[0]->accounts != '' ? json_decode($my_accounts_arr[0]->accounts, true) : array();
            $my_accounts = !empty($my_accounts_array) && array_key_exists($default, $my_accounts_array) ? $my_accounts_array[$default] : array();
        }
        return $my_accounts;
    }

    public function my_rank_per($_code,$rank_type='rank')
    {
        $res = $this->conn->runQuery('rank_per', 'rank', "u_code='$_code' and rank_type='$rank_type' order by rank_per desc");
        if ($res) {
            return $res[0]->rank_per;
        } else {
            return 0;
        }
    }
    public function my_rank($_code,$rank_type='rank')
    {
        $res = $this->conn->runQuery('rank_id', 'rank', "u_code='$_code' and rank_type='$rank_type' order by rank_id desc");
        if ($res) {
            return $res[0]->rank_id;
        } else {
            return false;
        }
    }
    public function my_rank_arr($_code, $rank_id,$rank_type='rank')
    {
        $res = $this->conn->runQuery('*', 'rank', "u_code='$_code' and rank_id='$rank_id' and rank_type='$rank_type' ");
        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }

    public function profile_info($id, $param = '*')
    {
        $res = $this->conn->runQuery($param, 'users', array('id' => $id));
        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }
    public function franchise_info($id, $param = '*')
    {
        $res = $this->conn->runQuery($param, 'franchise_users', array('id' => $id));
        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }

    public function sponsor($userid)
    {
        $sponsor = $this->conn->runQuery('u_sponsor', 'users', "id='$userid'");
        
        $ret = ($sponsor && $sponsor[0]->u_sponsor != 0 && $sponsor[0]->u_sponsor != '' ? $sponsor[0]->u_sponsor : false);
        return $ret;
    }

  

    public function Parentid($userid)
    {
        $Parentid = $this->conn->runQuery('Parentid', 'users', "id='$userid'");
        $ret = ($Parentid && $Parentid[0]->Parentid != 0 && $Parentid[0]->Parentid != '' ? $Parentid[0]->Parentid : false);
        return $ret;
    }
    public function sponsor_info($userid, $param = '*')
    {
        $ret = false;
        $sponsor = $this->sponsor($userid);
        if ($sponsor) {
            $res = $this->conn->runQuery($param, 'users', array('id' => $sponsor));
            if ($res) {
                $ret = $res[0];
            }
        }
        return $ret;
    }

    public function parent_info($userid, $param = '*')
    {
        $ret = false;
        $sponsor = $this->Parentid($userid);
        if ($sponsor) {
            $res = $this->conn->runQuery($param, 'users', array('id' => $sponsor));
            if ($res) {
                $ret = $res[0];
            }
        }
        return $ret;
    }
    public function pool_parent($matrix_id)
    {
        $sponsor = $this->conn->runQuery('parent_id', 'pool', "id='$matrix_id'");
        $ret = ($sponsor && $sponsor[0]->parent_id != 0 && $sponsor[0]->parent_id != '' ? $sponsor[0]->parent_id : false);
        return $ret;
    }
    public function pool_info($matrix_id)
    {
        $sponsor = $this->conn->runQuery('*', 'pool', "id='$matrix_id'");
        $ret = ($sponsor ? $sponsor : false);
        return $ret;
    }

    public function column_like($str, $column)
    {
        $res = $this->conn->runQuery("id", 'users', "$column LIKE '%$str%'");
        return ($res ? array_column($res, 'id') : array());
    }
    public function column_like_franchise($str, $column)
    {
        $res = $this->conn->runQuery("id", 'franchise_users', "$column LIKE '%$str%'");
        return ($res ? array_column($res, 'id') : array());
    }



    function thousandsCurrencyFormat($num)
    {

        if ($num > 1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;
        }

        return $num;
    }
}
