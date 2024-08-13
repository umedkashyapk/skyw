<?php
use Endroid\QrCode\QrCode;

class Qrcode_lib
{
    public function __construct(){
        require_once APPPATH.'third_party/QRCode_generator/vendor/autoload.php';
        
    }
    
    public function generate_qrcode($address){
       header("Content-Type: image/png");
       $qrCode = new QrCode($address);
       
	    echo $qrCode->writeString();
    }
    
    
    
}