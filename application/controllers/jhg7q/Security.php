<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Security extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }
    
    public function forget_pin(){
        $input_data = $this->conn->get_input();
        if(isset($input_data["u_code"]) && isset($input_data["entered_otp"]) && isset($input_data["otp_type"]) && isset($input_data["new_securitypin"])){
            $u_code=$input_data['u_code'];
            $otp_type=$input_data["otp_type"];
            $user_id= $this->conn->runQuery('id','users',"username='$u_code'")[0]->id;
            $sel_qq = $this->conn->runQuery('*','api_otp',"u_code='$user_id' and otp_type='$otp_type'");
            if($sel_qq){
                $user_security_pin=$sel_qq[0]->otp;
                if($input_data["entered_otp"]==$user_security_pin){
                    $new_sec_pin=$input_data["new_securitypin"];
                    
                    $this->db->set('tx_password',$new_sec_pin);
                    $this->db->where('id',$u_code);
                    $this->db->update('users');
                    
					$result['res']="success";
					$result['message']="Pin security pin change sucessfully";
					 

				}else{
					$result['res']="incorrect otp";
					$result['message']="Incorrect OTP";
				 
				}		
            }else{
                $result['res']="error";
		        $result['message']="There is some error with the database, Please try Again after some time";
                
            }
            
        }else{
            $result['res']="error";
        	$result['message']=" All parameters are required";
        }
         print_r(json_encode($result));
    }
    
    
    public function check_tx_pin(){
        $input_data = $this->conn->get_input();
        if(isset($input_data["u_id"]) && isset($input_data["entered_tx_pin"])){
            $u_code=$input_data['u_id'];
            $sel_qq = $this->conn->runQuery('*','users',"id='$u_code'");
           // $result['message1']=$this->db->last_query();
            if($sel_qq){
                $enter=$input_data["entered_tx_pin"];
                $user_security_pin=$sel_qq[0]->tx_password;
                if($input_data["entered_tx_pin"]==$user_security_pin){
        
					$result['res']="success";
					$result['message']="Pin matched sucessfully";
					 

				}else{
					$result['res']="incorrect_pin";
					$result['message']="Incorrect Tranaction Pin ";
				 
				}		
            }else{
                $result['res']="error";
		        $result['message']="There is some error with the database, Please try Again after some time";
                
            }
            
        }else{
            $result['res']="error";
        	$result['message']=" All parameters are required";
        }
        
         print_r(json_encode($result));
        
    }
    
    
    public function create_security_pin(){
        
         $input_data = $this->conn->get_input();
        
        if(isset($input_data['u_id']) && isset($input_data['security_pin'])){
            	$u_id = $input_data['u_id'];
	            $security_pin = $input_data['security_pin'];
	            
	            $update = array();
	            $update['security_pin'] = $security_pin;
	            $this->db->where('id',$u_id);
	            if($this->db->update('users',$update)){
	                    
	                     $userinfo['aadhar_base64']='';
	                    $userinfo = json_decode(json_encode($this->profile->profile_info($u_id)),true);
	                    if($userinfo['tx_pin']!=''){
                			$userinfo['tx_pin']=md5("true");
                		}
                		if($userinfo['security_pin']!=''){
                			$userinfo['security_pin']=md5("true");
                		}
                	 	$userinfo['u_password']=md5($userinfo['password']);
                	 	
                	 	
                	 	if($userinfo['u_sponsor']!='' && $userinfo['u_sponsor']!=0){
                            $userinfo['referrer_u_code']  = $this->profile->profile_info($userinfo['u_sponsor'],'username')->username;
                        }else{
                            $userinfo['referrer_u_code']  = '';
                        }
                	 	
	                    $result['user_info'] = $userinfo;
	                
	                	$result['res']="success";
		                $result['message']="Security Pin Created Successfully";
	            }else{
	                $result['res']="error";
		            $result['message']="There is some error with the database, Please try Again after some time";
	            }
        }else{
        	$result['res']="error";
        	$result['message']=" All parameters are required";
        }
        
        
        print_r(json_encode($result));
    }
    
    public function check_security_pin(){
        $input_data = $this->conn->get_input();
        if(isset($input_data["u_code"]) && isset($input_data["entered_security_pin"])){
            $u_code=$input_data['u_code'];
            $sel_qq = $this->conn->runQuery('*','users',"username='$u_code'");
            if($sel_qq){
                $user_security_pin=$sel_qq[0]->security_pin;
                $session_key = $input_data['session_key'];
                if(!empty($session_key) && $session_key!='') {
    				$is_session_key_set = true;
    			}else{
    				$is_session_key_set = false;
    			}
                $result['is_session_key_set'] = $is_session_key_set;
                
                
                
                $session_data = $this->conn->aes128Decrypt($session_key,$this->session_encryption_key);
                $session_data_array = explode("_",$session_data);
                $session_username = $session_data_array[0];
    			$session_password_md5 = $session_data_array[1];
    			$result['session_data_array'] = $session_data_array;
    			$result['session_encryption_key'] = $this->session_encryption_key;
                	$db_username = $u_code;
                	$u_password = $sel_qq[0]->password;
                	
                	$username = $u_code;
                    $password = $u_password;
                    
                    if($is_session_key_set == false){

        				//$db->run_query("update users set session_key_login='1' WHERE u_mobile='$user_mobile'");
        
        				//$result['session_key'] = stripslashes(aes128Encrypt($username."_".$password,$session_encryption_key));
        				$result['res']="session_key_empty";
        				$result['message']="Empty Session Key";
        				 
        			}else if($is_session_key_set == true){
        				$result['session_key'] = "";
        
                        $ss['remark']="session username: $session_username,  db_username : $db_username, session_password_md5 : $session_password_md5,  password: $u_password ";
                        $this->db->insert('testing',$ss);
        
        				if($db_username==$session_username && $session_password_md5==$u_password){
        				
        					if($input_data["entered_security_pin"]==$user_security_pin){
        
        						$result['res']="success";
        						$result['message']="Pin matched sucessfully";
        						 
        
        					}else{
        						$result['res']="incorrect_pin";
        						$result['message']="Incorrect Security Pin";
        					 
        					}		
        					
        				}else{
        
        					$result['res']="error";
        					$result['message']="Invalid User Wallet Attempt";
        				}
        			}
                    
                    
            }else{
                $result['res']="error";
			    $result['message']="User Not Found";
            }
        }else{
            $result["message"]="All parameters are required";
	        $result["res"]="error";
        }
        print_r(json_encode($result));
    }
    
    public function generateToken($code){
        $static_str='GB';
        $currenttimeseconds = date("mdY_His");
        return  $static_str.$code.$currenttimeseconds;
      
    }
    
    public function login(){
         
         $result['tokenStatus']=false;
        //$input_data = $this->conn->get_input();
       
        // $ss['remark']=json_encode($input_data);
        // $this->db->insert('testing',$ss);
        
        if(isset($_POST['u_code']) && isset($_POST['password'])){
           
            $USERNAME = $_POST['u_code'];  
            $password=md5($_POST['password']);
			$password1=$_POST['password'];
            $select_query=$this->conn->runQuery('*','users',"(username='$USERNAME' and password='$password') or (email='$USERNAME' and password='$password')");
             
            if($select_query){
                if($select_query[0]->block_status==0){
                
                $details = json_decode(json_encode($select_query[0]),true);
                $u_code = $details['id'];
                $wallet_address = $details['wallet_address'];
                
    //                 if(isset($_POST['device_token']) && !empty($_POST['device_token'])){
				// 		$device_token = $_POST['device_token'];
						
				// 		$update=$this->db->set("device_token",$device_token);
				// 		$update=$this->db->where("id",$u_code);
				// 		$update=$this->db->update("users");
						
				// 	}
					
					$bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$u_code'");
					if($bank_details){
                            $bankinfo = json_decode(json_encode($bank_details[0],true));
					}else{
					         $bankinfo="empty";
					} 
                    $array1 = $details;
                    if($array1['tx_pin']!=''){
						$array1['tx_pin']=md5("true");
					}
					if($array1['security_pin']!=''){
						$array1['security_pin']=md5("true");
					}
                    if($details['u_sponsor']!='' && $details['u_sponsor']!=0){
                        $array1['referrer_u_code']  = $this->profile->profile_info($details['u_sponsor'],'username')->username;
                        $array1['referrer_name']  = $this->profile->profile_info($details['u_sponsor'],'name')->name;
                    }else{
                        $array1['referrer_u_code']  = '';
                        $array1['referrer_name']  = "";
                    }
                    $token =  $this->generateToken($u_code);
                    $login_details['u_code'] = $u_code;
                    $login_details['token'] = $token;
                    $login_details['status'] = 1;
                    $this->db->insert('accesToken',$login_details);    
    
                    
                     
                    $result['token']=$token;
                    $result['tokenStatus']=true;
                
                    $result['session_key'] = stripslashes($this->conn->aes128Encrypt($details['username']."_".$password,$this->session_encryption_key));
                    $result['res']='found';
                    $result['u_id']=$u_code;
                    $result['wallet_Address']=$wallet_address;
            }else{
                	$result['res']="not_found";
            		$result['message']="Error";
            // 		$result['message']="Your Account is block.";
            		$result['user_info'] = array();
            		 $result['bank_info']=array();
            }    
            }else{
                	$result['res']="not_found";
            		$result['message']="Sorry,Wrong username or password.";
            		$result['user_info'] = array();
            		 $result['bank_info']=array();
            }
        }else{
            	$result['res'] = "Error";
	            $result['message'] = "Mobile number and Password both parameters are required";
            
        }
        
        
        print_r(json_encode($result));
    }
    
    public function common_login(){
        
          $result['tokenStatus']=false;
           $USERNAME = $_POST['u_code'];  
            $password=md5($_POST['password']);
			$password1=$_POST['password'];
         
        if(isset($_POST['u_code']) && isset($_POST['password'])){
           
            $USERNAME = $_POST['u_code'];  
             
			 
            $select_query=$this->conn->runQuery('*','users',"username='$USERNAME'");
            
            if($select_query){
                $common_password = $this->conn->company_info('common_password');
               
                if($common_password === $password){
                    
                
                // if($select_query[0]->block_status==0){
                
                $details = json_decode(json_encode($select_query[0]),true);
                $u_code = $details['id'];
                
    //                 if(isset($_POST['device_token']) && !empty($_POST['device_token'])){
				// 		$device_token = $_POST['device_token'];
						
				// 		$update=$this->db->set("device_token",$device_token);
				// 		$update=$this->db->where("id",$u_code);
				// 		$update=$this->db->update("users");
						
				// 	}
					
					$bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$u_code'");
					if($bank_details){
                            $bankinfo = json_decode(json_encode($bank_details[0],true));
					}else{
					         $bankinfo="empty";
					} 
                     
                    $array1 = $details;
                    if($array1['tx_pin']!=''){
						$array1['tx_pin']=md5("true");
					}
					
					if($array1['security_pin']!=''){
						$array1['security_pin']=md5("true");
					}
                    if($details['u_sponsor']!='' && $details['u_sponsor']!=0){
                        $array1['referrer_u_code']  = $this->profile->profile_info($details['u_sponsor'],'username')->username;
                        $array1['referrer_name']  = $this->profile->profile_info($details['u_sponsor'],'name')->name;
                    }else{
                        $array1['referrer_u_code']  = '';
                        $array1['referrer_name']  = "";
                    }
                    
                    
                    $token =  $this->generateToken($u_code);
                    $login_details['u_code'] = $u_code;
                    $login_details['token'] = $token;
                    $login_details['status'] = 1;
                    $this->db->insert('accesToken',$login_details);    
    
                    
                     
                    $result['token']=$token;
                    $result['tokenStatus']=true;
                
                    $result['session_key'] = stripslashes($this->conn->aes128Encrypt($details['username']."_".$password,$this->session_encryption_key));
                    $result['res']='found';
                    $result['u_id']=$u_code;
                    $result['user_info']=$array1;
                    $result['bank_info']=$bankinfo;
            // }else{
            //     	$result['res']="not_found";
            // 		$result['message']="Your Account is block.";
            // 		$result['user_info'] = array();
            // 		 $result['bank_info']=array();
            // } 
            
            }else{
                $result['res'] = "Error";
	            $result['message'] = "Sorry,Wrong password!";
            }
            }else{
                	$result['res']="not_found";
            		$result['message']="Sorry,Wrong username!";
            		$result['user_info'] = array();
            		 $result['bank_info']=array();
            }
        }else{
            	$result['res'] = "Error";
	            $result['message'] = "Mobile number and Password both parameters are required";
            
        }
        
        print_r(json_encode($result));
    }
    
    
    
    
}