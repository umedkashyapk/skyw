<?php
use IEXBase\TronAPI\Tron;

class Trongrid_api
{
    public function __construct(){
        
        require_once APPPATH.'third_party/trongrid/vendor/autoload.php';
        $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        
        try {
            $this->tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            exit($e->getMessage());
        }

        
    }
    
    public function getBalance($address){
        $tron=$this->tron;
        $tron->setAddress($address);
        return $tron->getBalance(null, true);
    }
    
    public function generateAddress(){
        $tron=$this->tron;
        $generateAddress = $tron->generateAddress();
        $isValid = $tron->isAddress($generateAddress->getAddress());
        
        $res['address']=$generateAddress->getAddress(true);
        $res['address_hex']=$generateAddress->getAddress();
        $res['private_key']=$generateAddress->getPrivateKey();
        $res['public_key']=$generateAddress->getPublicKey();
        $res['isValid']= $isValid;
        return $res;
    }
    
    public function send($from,$to,$amount,$privateKey){
        $tron=$this->tron;
        $tron->setPrivateKey($privateKey);
        $tron->setAddress($from);
        return $tron->send($to,$amount);
    }
    
}