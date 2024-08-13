<?php
class Binary_model extends CI_Model
{

    public function new_parent($node, $position)
    {

        $left_array_qr = $this->conn->runQuery("id,Parentid,position", 'users', "position='$position'");
        $left_array = (!empty($left_array_qr) ? array_column($left_array_qr, 'Parentid', 'id') : array());
        if (!empty($left_array)) {
            while (in_array($node, $left_array)) {
                $node = array_search($node, $left_array);
            }
        }
        return $node;
    }


    function get_legs($id, $pool_id)
    {
        $get_tree = $this->conn->runQuery("id,pool_position", 'pool', "parent_id='$id' and pool_id='$pool_id' order by pool_position asc");
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



    function get_legs_pool($id, $pool_id)
    {
        $get_tree = $this->conn->runQuery("id,pool_position,u_id", 'pool', "parent_id='$id' and pool_id='$pool_id' order by pool_position asc");
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



    function get_matrix_parent($id_in_pool, $pool_id)
    {
        $result = 'fail';
        $a[] = $id_in_pool;
        $i = 0;
        $planAr = $this->general->plan();
        $plan_type = array_column($planAr, 'type', 'id');
        $planName = $plan_type[$pool_id];
        $matrix = $planName . "_matrix_node";
        $res["plan name"] = $matrix;
        $res["matrix"] = $plan_type;
        $res["id in pool"] = $id_in_pool;
        $res['matrix nodes'] = $mtrx_nodes = $this->conn->setting($matrix);
        while ($i < count($a)) {
            $parent = $a[$i];
            $check_legs = $this->get_legs_pool($parent, $pool_id);
            $res['parent'] = $parent;
            $res['legs pool fn'] = $check_legs;
            $legs = $check_legs['legs'];

            if ($legs < $mtrx_nodes) {
                $result = 'success';
                $postion = $legs + 1;
                break;
            } else {
                $postion = 1;
                $a = array_merge($a, $check_legs['leg_users']);
                $i++;
            }
        }
        unset($a);
        return array('result' => $result, 'parent' => $parent, 'position' => $postion, 'message' => $res);
    }
}
