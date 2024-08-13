<?php
class Token_model extends CI_Model{
   
    
     public function generateToken($code){
        $static_str='AL';
        $currenttimeseconds = date("mdY_His");
        return  $static_str.$code.$currenttimeseconds;
      
    }
    
    public function userByToken($token){
        $get = $this->conn->runQuery('*','accesToken',"token='$token' and status='1'");
        return $get? $get[0]->u_code :false;
    }
}
