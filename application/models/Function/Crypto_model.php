<?php
class Crypto_model extends CI_Model{

     
    function api_detail($api_key){	

        $url = "https://test.eracom.in/sendcryp/";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		
		$headers = [
		  "Content-Type: application/x-www-form-urlencoded"
		];
		
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		
		$data = http_build_query([
		  "api_key" => $api_key,
		  "action" => "vendor_info",
		]);
		
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		
		$result = json_decode(curl_exec($curl), true);
		curl_close($curl);
		return $result;
		
	}	

	// $this->crypto->coinPayments_createPayment($insert_id,$pkg_amt,'USD',$currency2);

	function coinPayments_createPayment($payment_id,$amount,$currency1,$currency2){
			try{
                $this->load->library('coinpayment');
                $private_key= $this->conn->company_info('coinpayment_private_key');
                $public_key=  $this->conn->company_info('coinpayment_public_key');
                $cps = $this->coinpayment->load($private_key,$public_key);
                    $req = array(
                		'amount' => $amount,
                		'currency1' => $currency1,
                		'currency2' => $currency2,
                		'buyer_email' => $this->conn->company_info('coinpayment_email'),
                		'item_name' => "$payment_id payment",
                		'address' => '', // leave blank send to follow your settings on the Coin Settings page
                		'ipn_url' => base_url().'user/callback/payment_coinpayment',
                	);
                	return $cps->CreateTransaction($req);
				}catch(Exception $e){
					return $e;
				}
	}

	public function coinPayments_withdrawal($amount, $currency, $address) {
		try {
			
			$this->load->library('coinpayment');
			
			$private_key = $this->conn->company_info('coinpayment_private_key');
			$public_key = $this->conn->company_info('coinpayment_public_key');
			
			$req = array(
				'cmd' => 'create_withdrawal',
				'amount' => $amount,
				'currency' => $currency,
				'address' => $address,
				'auto_confirm' => 1, 
				'key' => $public_key,
				'version' => 1,
				'format' => 'json'
			);
	
			$post_fields = http_build_query($req, '', '&');
	
			$hmac = hash_hmac('sha512', $post_fields, $private_key);
	
			$headers = array(
				'HMAC: ' . $hmac,
				'Content-Type: application/x-www-form-urlencoded'
			);
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://www.coinpayments.net/api.php');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
			$response = curl_exec($ch);
			if (curl_errno($ch)) {
				throw new Exception(curl_error($ch));
			}
			curl_close($ch);
	
			$result = json_decode($response, true);
			if ($result['error'] !== 'ok') {
				throw new Exception($result['error']);
			}
	
			return $result['result'];
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	
	
    
}

