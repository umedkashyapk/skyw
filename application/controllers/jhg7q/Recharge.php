<?php
class Recharge extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }
    
	public function wallet_detail(){
		$input_data = $this->conn->get_input();
        if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
			$plan_type=$this->conn->setting('reg_type'); 
            $currency = $this->conn->company_info('currency');			
			$company_info=$this->conn->runQuery('*','company_info',"1='1'");            
            
            $company_info_data = array_column(json_decode(json_encode($company_info),true),'value','label');
			$result['commission'] = 4;//$company_info_data['recharge_commission'];			
			$wallets=$this->conn->runQuery("*",'wallet_types',"wallet_type IN ('wallet','pin') and  status='1'  and $plan_type='1'");
            
            $w_balance=$this->conn->runQuery('*','user_wallets',"u_code='$user_id'");
            $wallet_balance=$w_balance ? $w_balance[0]:array();	
		
		
			$walletarr = array();
            if($wallets){
                foreach($wallets as $walletss){    
                        $slug =  $walletss->wallet_column;
                        $walletarr[$walletss->slug] =  (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug:0);
                }
            }
			
			$result['wallets']= $walletarr;

        } 		
		print_r(json_encode($result));
        unset($array);
	}
    public function mobile(){
    
        $input_data = $this->conn->get_input();
        if(isset($input_data['u_id']) &&  isset($input_data['operator'])  && isset($input_data['account_number'])  && isset($input_data['amount']) &&  isset($input_data['select_wallet'])){
            
            $crncy=$this->conn->company_info('currency');

            /*  $this->form_validation->set_rules('operator', 'Operator', 'required');            
              $this->form_validation->set_rules('account_number', 'Account Number', 'required');             
              $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_wallet_balance'); */
                      
                    $select_wallet=$input_data['select_wallet'];
                    $u_id=$input_data['u_id']; 
					$account_number=$input_data['account_number']; 
					$operator=$input_data['operator']; 
					$amount=$input_data['amount']; 
					$user_gen_digit=$this->conn->setting('user_gen_digit');
					$user_gen_fun=$this->conn->setting('user_gen_fun');					
                    $order_id=random_string($user_gen_fun, $user_gen_digit);
            
					$profile=$this->profile->profile_info($u_id);
					$username=$profile->username;
					$name=$profile->name;
                  //  $account_type=$profile->account_type;     
					
					
					$cash_amt1=$amount*4/100;
					
                    $balance=$this->update_ob->wallet($u_id,$select_wallet);     
                    					
					$cashback_balance=$this->update_ob->wallet($u_id,'cashback_wallet');    
                    if($cashback_balance>=$cash_amt1){
						$cash_amt=$cash_amt1;
						
					}else{
						$cash_amt=0;						
					} 
					 
					$bal=$amount-$cash_amt;
					  
					  
					  if($balance>=$bal){

                      					  
					    $amt=$amount;
						$recharge_account=$account_number;
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => "https://partner.imwallet.in/web_services/recharge_process.jsp?webToken=zEkWEOMo1Yb1BnYPugQvqjc0ZSqJoqxi&userCode=IMAPI1365439&orderid=$order_id&skey=$operator&accountNo=$recharge_account&amount=$amt&callBack=http://google.com",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'GET',
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json',
							'Cookie: JSESSIONID=90BBA8BA62FDC7A94474DCAC2D6D14DD'
						  ),
						));

						$response = curl_exec($curl);
						curl_close($curl);
						//echo $response;
						$ress=json_decode($response,true);
						/*echo "<pre>";
						print_R($res);
						echo "</pre>";*/
						$status=$ress['status'];
						$requestID=$ress['requestID'];
						$oprID=$ress['oprID'];
						$msg=$ress['msg'];						
						
						if($status=="SUCCESS"){
							
						   $inserttrans['u_code']=$u_id;
						   $inserttrans['user_account']=$account_number;
						   $inserttrans['type']='Mobile';
						   //$inserttrans['cripto_type']=$input_data['address'];
						   $inserttrans['operator']= $operator;
						   $inserttrans['amount']=$amount;             
						   $inserttrans['order_id']=$order_id;
						   $inserttrans['res_id']=$requestID;
						   $inserttrans['opr_id']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans['added_on']=date('Y-m-d H:i:s');
						   $inserttrans['status']=$status;			  	
							
						   $this->db->insert('recharge',$inserttrans);	

                        //////////////////////////transaction ////////////////////////////////////////////////
                           $inserttrans1['u_code']=$u_id;
						   $inserttrans1['recharge_account']=$account_number;
						   $inserttrans1['tx_type']='Recharge';
						   $inserttrans1['debit_credit']='debit';
						   $inserttrans1['wallet_type']= $select_wallet;
						   $inserttrans1['amount']=$bal;             
						   $inserttrans1['tx_id']=$order_id;
						   $inserttrans1['api_response']=$requestID;
						   $inserttrans1['api_key']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans1['added_on']=date('Y-m-d H:i:s');
						   $inserttrans1['date']=date('Y-m-d H:i:s');
						   $inserttrans1['status']=1;	
						   $inserttrans1['remark']="Recharged Successfully ($account_number) with INR $bal";						

						   $this->db->insert('transaction',$inserttrans1);	
                           //$res['res1']= $this->db->last_query();
                           
						   if($cash_amt>0){
							   
							   $inserttrans11['u_code']=$u_id;
							   $inserttrans11['recharge_account']=$account_number;
							   $inserttrans11['tx_type']='Recharge';
							   $inserttrans11['debit_credit']='debit';
							   $inserttrans11['wallet_type']= 'cashback_wallet';
							   $inserttrans11['amount']=$cash_amt;             
							   $inserttrans11['tx_id']=$order_id;
							   $inserttrans11['api_response']=$requestID;
							   $inserttrans11['api_key']=$oprID;
							   //$inserttrans['response']=$ress;			
							   $inserttrans11['added_on']=date('Y-m-d H:i:s');
							   $inserttrans11['date']=date('Y-m-d H:i:s');
							   $inserttrans11['status']=1;	
							   $inserttrans11['remark']="Recharged Successfully ($account_number) with INR $cash_amt";						

							   $this->db->insert('transaction',$inserttrans11);
							   
						   }
						   
						   
							
							$res['res']= 'success';
							
							$this->update_ob->add_amnt($u_id,$select_wallet,-$bal);
							$this->update_ob->add_amnt($u_id,'cashback_wallet',-$cash_amt);
							
						}elseif($status=="FAILED"){
							
						   $inserttrans['u_code']=$u_id;
						   $inserttrans['user_account']=$account_number;
						   $inserttrans['type']='Mobile';
						   //$inserttrans['cripto_type']=$input_data['address'];
						   $inserttrans['operator']= $operator;
						   $inserttrans['amount']=$amount;             
						   $inserttrans['order_id']=$order_id;
						    $inserttrans['res_id']=$requestID;
						   $inserttrans['opr_id']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans['added_on']=date('Y-m-d H:i:s');
						   $inserttrans['status']=$status;			  	
							
							$this->db->insert('recharge',$inserttrans);		

                              //////////////////////////transaction ////////////////////////////////////////////////
                           $inserttrans1['u_code']=$u_id;
						   $inserttrans1['recharge_account']=$account_number;
						   $inserttrans1['tx_type']='Recharge';
						   $inserttrans1['debit_credit']='debit';
						   $inserttrans1['wallet_type']= 'income_wallet';
						   $inserttrans1['amount']=$amount;             
						   $inserttrans1['tx_id']=$order_id;
						   $inserttrans1['api_response']=$requestID;
						   $inserttrans1['api_key']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans1['added_on']=date('Y-m-d H:i:s');
						   $inserttrans1['date']=date('Y-m-d H:i:s');
						   $inserttrans1['status']=2;	
							$inserttrans1['remark']="Recharged Successfully ($account_number) with INR $bal";							   
							

						   $this->db->insert('transaction',$inserttrans1);	

						//$res['res1']= $this->db->last_query();
                            if($cash_amt>0){
							   
							   $inserttrans11['u_code']=$u_id;
							   $inserttrans11['recharge_account']=$account_number;
							   $inserttrans11['tx_type']='Recharge';
							   $inserttrans11['debit_credit']='debit';
							   $inserttrans11['wallet_type']= 'cashback_wallet';
							   $inserttrans11['amount']=$cash_amt;             
							   $inserttrans11['tx_id']=$order_id;
							   $inserttrans11['api_response']=$requestID;
							   $inserttrans11['api_key']=$oprID;
							   //$inserttrans['response']=$ress;			
							   $inserttrans11['added_on']=date('Y-m-d H:i:s');
							   $inserttrans11['date']=date('Y-m-d H:i:s');
							   $inserttrans11['status']=1;	
							   $inserttrans11['remark']="Recharged Successfully ($account_number) with INR $cash_amt";						

							   $this->db->insert('transaction',$inserttrans11);
							   
						   }  
							
							$res['res']= 'error';
							
							
						}else{
							$inserttrans['u_code']=$u_id;
						   $inserttrans['user_account']=$account_number;
						   $inserttrans['type']='Mobile';
						   //$inserttrans['cripto_type']=$input_data['address'];
						   $inserttrans['operator']= $operator;
						   $inserttrans['amount']=$amount;    
							$inserttrans['res_id']=$requestID;
						   $inserttrans['opr_id']=$oprID;						   
						   $inserttrans['order_id']=$order_id;
						  // $inserttrans['response']=$ress;			
						   $inserttrans['added_on']=date('Y-m-d H:i:s');
						   $inserttrans['status']=$status;			  	
							
							$this->db->insert('recharge',$inserttrans);	


                              //////////////////////////transaction ////////////////////////////////////////////////
                           $inserttrans1['u_code']=$u_id;
						   $inserttrans1['recharge_account']=$account_number;
						   $inserttrans1['tx_type']='Recharge';
						   $inserttrans1['debit_credit']='debit';
						   $inserttrans1['wallet_type']= 'income_wallet';
						   $inserttrans1['amount']=$amount;             
						   $inserttrans1['tx_id']=$order_id;
						   $inserttrans1['api_response']=$requestID;
						   $inserttrans1['api_key']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans1['added_on']=date('Y-m-d H:i:s');
						   $inserttrans1['date']=date('Y-m-d H:i:s');
						   $inserttrans1['status']=1;	
							$inserttrans1['remark']="Recharged Successfully ($account_number) with INR $bal";							   
							

						   $this->db->insert('transaction',$inserttrans1);	
							//$res['res1']= $this->db->last_query();
							
							if($cash_amt>0){
							   
							   $inserttrans11['u_code']=$u_id;
							   $inserttrans11['recharge_account']=$account_number;
							   $inserttrans11['tx_type']='Recharge';
							   $inserttrans11['debit_credit']='debit';
							   $inserttrans11['wallet_type']= 'cashback_wallet';
							   $inserttrans11['amount']=$cash_amt;             
							   $inserttrans11['tx_id']=$order_id;
							   $inserttrans11['api_response']=$requestID;
							   $inserttrans11['api_key']=$oprID;
							   //$inserttrans['response']=$ress;			
							   $inserttrans11['added_on']=date('Y-m-d H:i:s');
							   $inserttrans11['date']=date('Y-m-d H:i:s');
							   $inserttrans11['status']=1;	
							   $inserttrans11['remark']="Recharged Successfully ($account_number) with INR $cash_amt";						

							   $this->db->insert('transaction',$inserttrans11);
							   
						   }
							
							
							
							
							
							
							$res['res']= 'success';
							
							$this->update_ob->add_amnt($u_id,$select_wallet,-$bal);
							$this->update_ob->add_amnt($u_id,'cashback_wallet',-$cash_amt);
							
						}
					   
					                        
                        $res['message']=$msg;
						//$this->session->set_flashdata("success", $smsg);
					    //	redirect(base_url(uri_string()));
    
					/*}else{
					     $res['res']= 'error';
                        $res['error_address'] = form_error('address');
                        $res['error_payment_type'] = form_error('payment_type');
                        $res['error_amount'] = form_error('amount');
                        $res['error_utr_number'] = form_error('utr_number');
                        $res['message']= "Something Wrong.";
						//$this->session->set_flashdata("error", "Something wrong.");
					}*/
					
		}else{
			 $res['res']= 'error';
             
            $res['message']= "Insufficient Fund in Wallet.";
			
		}
			
    }else{
            
            $res['res']= 'error';
             
            $res['message']= "Invalid UserId.";
        }
			 print_r(json_encode($res));
    } 
   
    public function dth(){
    
        $input_data = $this->conn->get_input();
        if(isset($input_data['u_id']) &&  isset($input_data['operator'])  && isset($input_data['account_number'])  && isset($input_data['amount']) &&  isset($input_data['select_wallet'])){
            
            $crncy=$this->conn->company_info('currency');

            /*  $this->form_validation->set_rules('operator', 'Operator', 'required');            
              $this->form_validation->set_rules('account_number', 'Account Number', 'required');             
              $this->form_validation->set_rules('amount', 'Amount', 'required|callback_check_wallet_balance'); */
             
                     $select_wallet=$input_data['select_wallet'];
                    $u_id=$input_data['u_id']; 
					$account_number=$input_data['account_number']; 
					$operator=$input_data['operator']; 
					$amount=$input_data['amount']; 
					$user_gen_digit=$this->conn->setting('user_gen_digit');
					$user_gen_fun=$this->conn->setting('user_gen_fun');					
                    $order_id=random_string($user_gen_fun, $user_gen_digit);
            
					$profile=$this->profile->profile_info($u_id);
					$username=$profile->username;
					$name=$profile->name;
                  //  $account_type=$profile->account_type;            
				    
                   
					$cash_amt1=$amount*4/100;
					
                    $balance=$this->update_ob->wallet($u_id,$select_wallet);     
                    					
					$cashback_balance=$this->update_ob->wallet($u_id,'cashback_wallet');    
                    if($cashback_balance>=$cash_amt1){
						$cash_amt=$cash_amt1;
						
					}else{
						$cash_amt=0;						
					} 
					 
					$bal=$amount-$cash_amt;
					  
					  
					  if($balance>=$bal){
                      					  
					    $amt=$amount;
						$recharge_account=$account_number;
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => "https://partner.imwallet.in/web_services/recharge_process.jsp?webToken=zEkWEOMo1Yb1BnYPugQvqjc0ZSqJoqxi&userCode=IMAPI1365439&orderid=$order_id&skey=$operator&accountNo=$recharge_account&amount=$amt&callBack=http://google.com",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'GET',
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json',
							'Cookie: JSESSIONID=90BBA8BA62FDC7A94474DCAC2D6D14DD'
						  ),
						));

						$response = curl_exec($curl);
						curl_close($curl);
						//echo $response;
						$ress=json_decode($response,true);
						/*echo "<pre>";
						print_R($res);
						echo "</pre>";*/
						$status=$ress['status'];
						$requestID=$ress['requestID'];
						$oprID=$ress['oprID'];
						$msg=$ress['msg'];						
						
						if($status=="SUCCESS"){
							
						   $inserttrans['u_code']=$u_id;
						   $inserttrans['user_account']=$account_number;
						   $inserttrans['type']='DTH';
						   //$inserttrans['cripto_type']=$input_data['address'];
						   $inserttrans['operator']= $operator;
						   $inserttrans['amount']=$amount;             
						   $inserttrans['order_id']=$order_id;
						   $inserttrans['res_id']=$requestID;
						   $inserttrans['opr_id']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans['added_on']=date('Y-m-d H:i:s');
						   $inserttrans['status']=$status;			  	
							
						   $this->db->insert('recharge',$inserttrans);	

                        //////////////////////////transaction ////////////////////////////////////////////////
                           $inserttrans1['u_code']=$u_id;
						   $inserttrans1['recharge_account']=$account_number;
						   $inserttrans1['tx_type']='Recharge';
						   $inserttrans1['debit_credit']='debit';
						   $inserttrans1['wallet_type']= 'income_wallet';
						   $inserttrans1['amount']=$amount;             
						   $inserttrans1['tx_id']=$order_id;
						   $inserttrans1['api_response']=$requestID;
						   $inserttrans1['api_key']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans1['added_on']=date('Y-m-d H:i:s');
						   $inserttrans1['date']=date('Y-m-d H:i:s');
						   $inserttrans1['status']=1;	
							$inserttrans1['remark']="Recharged Successfully ($account_number) with INR $bal";							   
							

						   $this->db->insert('transaction',$inserttrans1);	

                            if($cash_amt>0){
							   
							   $inserttrans11['u_code']=$u_id;
							   $inserttrans11['recharge_account']=$account_number;
							   $inserttrans11['tx_type']='Recharge';
							   $inserttrans11['debit_credit']='debit';
							   $inserttrans11['wallet_type']= 'cashback_wallet';
							   $inserttrans11['amount']=$cash_amt;             
							   $inserttrans11['tx_id']=$order_id;
							   $inserttrans11['api_response']=$requestID;
							   $inserttrans11['api_key']=$oprID;
							   //$inserttrans['response']=$ress;			
							   $inserttrans11['added_on']=date('Y-m-d H:i:s');
							   $inserttrans11['date']=date('Y-m-d H:i:s');
							   $inserttrans11['status']=1;	
							   $inserttrans11['remark']="Recharged Successfully ($account_number) with INR $cash_amt";						

							   $this->db->insert('transaction',$inserttrans11);
							   
						   }



							
							$res['res']= 'success';
							
							$this->update_ob->add_amnt($u_id,$select_wallet,-$bal);
							$this->update_ob->add_amnt($u_id,'cashback_wallet',-$cash_amt);
							
						}elseif($status=="FAILED"){
							
						   $inserttrans['u_code']=$u_id;
						   $inserttrans['user_account']=$account_number;
						   $inserttrans['type']='DTH';
						   //$inserttrans['cripto_type']=$input_data['address'];
						   $inserttrans['operator']= $operator;
						   $inserttrans['amount']=$amount;             
						   $inserttrans['order_id']=$order_id;
						    $inserttrans['res_id']=$requestID;
						   $inserttrans['opr_id']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans['added_on']=date('Y-m-d H:i:s');
						   $inserttrans['status']=$status;			  	
							
							$this->db->insert('recharge',$inserttrans);		

                              //////////////////////////transaction ////////////////////////////////////////////////
                           $inserttrans1['u_code']=$u_id;
						   $inserttrans1['recharge_account']=$account_number;
						   $inserttrans1['tx_type']='Recharge';
						   $inserttrans1['debit_credit']='debit';
						   $inserttrans1['wallet_type']= 'income_wallet';
						   $inserttrans1['amount']=$amount;             
						   $inserttrans1['tx_id']=$order_id;
						   $inserttrans1['api_response']=$requestID;
						   $inserttrans1['api_key']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans1['added_on']=date('Y-m-d H:i:s');
						   $inserttrans1['date']=date('Y-m-d H:i:s');
						   $inserttrans1['status']=2;	
							$inserttrans1['remark']="Recharged Successfully ($account_number) with INR $bal";							   
							

						   $this->db->insert('transaction',$inserttrans1);	

                            if($cash_amt>0){
							   
							   $inserttrans11['u_code']=$u_id;
							   $inserttrans11['recharge_account']=$account_number;
							   $inserttrans11['tx_type']='Recharge';
							   $inserttrans11['debit_credit']='debit';
							   $inserttrans11['wallet_type']= 'cashback_wallet';
							   $inserttrans11['amount']=$cash_amt;             
							   $inserttrans11['tx_id']=$order_id;
							   $inserttrans11['api_response']=$requestID;
							   $inserttrans11['api_key']=$oprID;
							   //$inserttrans['response']=$ress;			
							   $inserttrans11['added_on']=date('Y-m-d H:i:s');
							   $inserttrans11['date']=date('Y-m-d H:i:s');
							   $inserttrans11['status']=1;	
							   $inserttrans11['remark']="Recharged Successfully ($account_number) with INR $cash_amt";						

							   $this->db->insert('transaction',$inserttrans11);
							   
						   }

							
							$res['res']= 'error';
							
							
						}else{
							$inserttrans['u_code']=$u_id;
						   $inserttrans['user_account']=$account_number;
						   $inserttrans['type']='DTH';
						   //$inserttrans['cripto_type']=$input_data['address'];
						   $inserttrans['operator']= $operator;
						   $inserttrans['amount']=$amount;    
							$inserttrans['res_id']=$requestID;
						   $inserttrans['opr_id']=$oprID;						   
						   $inserttrans['order_id']=$order_id;
						  // $inserttrans['response']=$ress;			
						   $inserttrans['added_on']=date('Y-m-d H:i:s');
						   $inserttrans['status']=$status;			  	
							
							$this->db->insert('recharge',$inserttrans);	


                              //////////////////////////transaction ////////////////////////////////////////////////
                           $inserttrans1['u_code']=$u_id;
						   $inserttrans1['recharge_account']=$account_number;
						   $inserttrans1['tx_type']='Recharge';
						   $inserttrans1['debit_credit']='debit';
						   $inserttrans1['wallet_type']= 'income_wallet';
						   $inserttrans1['amount']=$amount;             
						   $inserttrans1['tx_id']=$order_id;
						   $inserttrans1['api_response']=$requestID;
						   $inserttrans1['api_key']=$oprID;
						   //$inserttrans['response']=$ress;			
						   $inserttrans1['added_on']=date('Y-m-d H:i:s');
						   $inserttrans1['date']=date('Y-m-d H:i:s');
						   $inserttrans1['status']=1;	
							$inserttrans1['remark']="Recharged Successfully ($account_number) with INR $bal";							   
							

						   $this->db->insert('transaction',$inserttrans1);	
							
							
							if($cash_amt>0){
							   
							   $inserttrans11['u_code']=$u_id;
							   $inserttrans11['recharge_account']=$account_number;
							   $inserttrans11['tx_type']='Recharge';
							   $inserttrans11['debit_credit']='debit';
							   $inserttrans11['wallet_type']= 'cashback_wallet';
							   $inserttrans11['amount']=$cash_amt;             
							   $inserttrans11['tx_id']=$order_id;
							   $inserttrans11['api_response']=$requestID;
							   $inserttrans11['api_key']=$oprID;
							   //$inserttrans['response']=$ress;			
							   $inserttrans11['added_on']=date('Y-m-d H:i:s');
							   $inserttrans11['date']=date('Y-m-d H:i:s');
							   $inserttrans11['status']=1;	
							   $inserttrans11['remark']="Recharged Successfully ($account_number) with INR $cash_amt";						

							   $this->db->insert('transaction',$inserttrans11);
							   
						   }
							
							
							
							
							
							
							$res['res']= 'success';
							$this->update_ob->add_amnt($u_id,$select_wallet,-$bal);
							$this->update_ob->add_amnt($u_id,'cashback_wallet',-$cash_amt);
							
						}
					   
					                        
                        $res['message']=$msg;
						//$this->session->set_flashdata("success", $smsg);
					    //	redirect(base_url(uri_string()));
    
					/*}else{
					     $res['res']= 'error';
                        $res['error_address'] = form_error('address');
                        $res['error_payment_type'] = form_error('payment_type');
                        $res['error_amount'] = form_error('amount');
                        $res['error_utr_number'] = form_error('utr_number');
                        $res['message']= "Something Wrong.";
						//$this->session->set_flashdata("error", "Something wrong.");
					}*/
		}else{
			
			$res['res']= 'error';
             
            $res['message']= "Insufficient Fund In Wallet.";
			
		}
    }else{
            
            $res['res']= 'error';
             
            $res['message']= "Invalid UserId.";
        }
			 print_r(json_encode($res));
    }
   
	
	
	
	public function check_wallet_balance($str){
			$input_data = $this->conn->get_input();         
            $rsss =  $this->get_user_id();
            if($rsss['res']=='success'){
                $u_id = $rsss['u_id'];
                $balance=$this->update_ob->wallet($u_id,$select_wallet);        
                if($balance>=$str){
                    return true;
                }else{
                    $this->form_validation->set_message('check_transfer_balance', "Insufficient Fund in wallet.");
                    return false;
                }
            }else{
                $this->form_validation->set_message('check_transfer_balance', $rsss['message']);
                return false;
            }
             
    }
    
	 public function get_user_id(){
         $input_data = $this->conn->get_input();
         if(isset($input_data['session_key']) && $input_data['session_key']!=''){
            $session_key = $input_data['session_key'];
            $session_data = $this->conn->aes128Decrypt($session_key,$this->session_encryption_key);
            
        
            $session_data_array = explode("_",$session_data);
            $session_username = $session_data_array[0];
			$session_password_md5 = $session_data_array[1];
            
            $u_id = $this->profile->id_by_username($session_username);
             if($u_id){
                 $res['u_id']=$u_id;
                 $res['res']='success';
             }else{
                 $res['message']='User not exists.';
                 $res['res']='error';
             }
         }else{
             $res['message']='User not exists.';
             $res['res']='error';
         }
         return $res;
    }
	
	
	
	
}