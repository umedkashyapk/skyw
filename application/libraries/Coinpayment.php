<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
 
class Coinpayment
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load($private_key='',$public_key=''){
        // Include PHPMailer library files
        require_once APPPATH.'third_party/coinpayments/coinpayments.inc.php';
        
        $obb= new CoinPaymentsAPI();
        
        $obb->Setup($private_key, $public_key);
	
	    return $obb;
        
          
    }
}