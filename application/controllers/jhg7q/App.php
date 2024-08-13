<?php
class App extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function live_rates(){
        $crypto = $this->curl->simple_get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=20&page=1&sparkline=false%22");
        $stss['data']= json_decode($crypto,true);
        $stss['token_rate']= $this->conn->company_info('token_rate');
        print_r(json_encode($stss));
    }
    
    public function update_check(){
        $check = $this->conn->runQuery('*','app_update_notifications',"id='1'");
        if($check && $check[0]->is_update==1){
            
            $array = $check[0];
            $result['res'] = "success";
            $result['message'] = "App update Available";
        	$result['version_info'] = $array;
        	$result['is_strict_update'] = 1;
        	
        	$result['primary_ad_account'] = $this->conn->company_info('primary_ad_account');
        	
        }else{
            $result['res'] = "error";
	        $result['message'] = "No update Available";
        }
            
            $company_info=$this->conn->runQuery('*','company_info',"1='1'");            
            
            $company_info_data = array_column(json_decode(json_encode($company_info),true),'value','label');
			
			$social_info=$this->conn->runQuery('*','social_link',"status='1'");       
			if($social_info){
                $sr=1;
                foreach($social_info as $social_info1){
                   
                    $detailss = json_decode(json_encode($social_info1),true);                    
                    $data[]=$detailss;
                    $details['data']= $data;
                 $sr++;    
                }
            }
			$result['social_link'] =$details;
        	$result['base_url'] = $company_info_data['base_url'];
        	$result['term_condition'] = $company_info_data['term_condition'];
        	$result['privacy_policy'] = $company_info_data['privacy_policy'];
        	$result['return_refund_policy'] = $company_info_data['return_refund_policy'];
        	$result['cancellation_policy'] = $company_info_data['cancellation_policy'];
        	$result['shipping_policy'] = $company_info_data['shipping_policy'];
        	$result['process_flow'] = $company_info_data['process_flow'];
        	$result['about_us'] = 'index#about';//$company_info_data['about_us'];
        	$result['maintenance_mode'] = $company_info_data['maintenance_mode'];
        	$result['maintenance_mode_message'] = $company_info_data['maintenance_mode_message'];
         
        
        print_r(json_encode($result));
        unset($array);
        
    }
    
    
    
    
}