<?php
class General_model extends CI_Model
{
    public function all_active_users()
    {
        $resp = $this->conn->runQuery("id", 'users', "active_status=1");
        return ($resp ? array_column($resp, 'id') : array());
    }
    public function plan()
    {
        $resp = $this->conn->runQuery('*', 'plan', "1=1");
        return $resp;
    }
    public function pin_details()
    {
        $resp = $this->conn->runQuery('*', 'pin_details', "1=1");
        return $resp;
    }
}
