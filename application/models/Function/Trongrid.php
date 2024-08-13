<?php
class Trongrid extends CI_Model{
   
    public function getBalance($address){
        $this->load->library('trongrid_api');
        return $this->trongrid_api->getBalance($address);
    }
     
    public function generateAddress($u_code){
        $this->load->library('trongrid_api');
        $res=$this->trongrid_api->generateAddress();
        
        $address=$res['address'];
        $check_address_exists=$this->conn->runQuery('*','user_addresses',"address='$address'");
        if($check_address_exists){
            return $this->generateAddress($u_code);
        }else{
            $new=array();
            $new['u_code']=$u_code;
            $new['address']=$res['address'];
            $new['address_hex']=$res['address_hex'];
            $new['private_key']=$res['private_key'];
            $new['public_key']=$res['public_key'];
            $new['is_valid']=$res['isValid'];
            $new['res_data']=json_encode($res);
            $new['status']=0;
            $this->db->insert('user_addresses',$new);
            return $new;
        }
    }
    
    public function getAddress_arr($u_code){
        $check_exists=$this->conn->runQuery('*','user_addresses',"u_code='$u_code'");
        if($check_exists){
            return json_decode(json_encode($check_exists[0]),true);
        }else{
            return $this->generateAddress($u_code);
        }
    }
    
    public function getAddress($u_code){
        $getAddress_arr = $this->getAddress_arr($u_code);
        return $getAddress_arr['address'];
    }
    
    public function send($from,$to,$amount,$privateKey){
        $this->load->library('trongrid_api');
        $res=$this->trongrid_api->send($from,$to,$amount,$privateKey);
        return $res;
    }

}

