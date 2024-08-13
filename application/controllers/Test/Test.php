<?php
class Test extends CI_Controller
{
    public function index()
    {
        echo 'CodeIgniter is working!';
    }

    public function tester()
    {
        $res = $this->team->tree_data(1);
        print_r(json_encode($res));
    }
    public function reset_data()
    {
        echo "here";
        die();
        $this->db->empty_table('transaction');
        $this->db->empty_table('orders');
        $this->db->empty_table('income_legder');
        $this->db->empty_table('rank');
        $this->db->empty_table('query_log');
        $this->db->where('id !=', 1);
        $this->db->delete('users');
        $this->db->where('id !=', 1);
        $this->db->delete('user_wallets');
        $this->db->where('id !=', 1);
        $this->db->delete('user_teams');
        $this->db->where('id >', 1);
        $this->db->delete('pool');
        echo "Data Truncated";
    }
}
