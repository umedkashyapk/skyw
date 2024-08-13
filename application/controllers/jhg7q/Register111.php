<?php
class Register extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }    
    
    
    public function index(){
       $input_data =$this->conn->get_input();
       
       //$referrer_id = $this->referrer_id($input_data['referrer_id']);
       
       $this->form_validation->set_data($input_data);
       //$user_type = $input_data['user_type'];
        $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
            $value_by_lebel= array_column($requires, 'value', 'label');
           // $this->form_validation->set_rules('membership_type', 'Membership Type', 'required');
			
           /* if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){
                // callback_is_sponsor_available
				if($input_data['referrer_id']!=""){
				
					$this->form_validation->set_rules('referrer_id', 'Sponsor', 'required|callback_is_sponsor_available');                
					$register['u_sponsor']=$this->profile->id_by_username($input_data['referrer_id']);
			   
				}else{
					
					 $register['u_sponsor']= 1;
				}
            }else{
                $register['u_sponsor']= 1;
            }
            $sponsor_id=$register['u_sponsor'];*/
            
            /* if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){
                 $this->form_validation->set_rules('usename', 'Usename', 'required|trim|callback_is_username_valid');
                 $register['username']= $value_by_lebel['user_gen_prefix'].$input_data['usename'];
             }else{*/	
                 $register['username'] = $input_data['wallet_address'];
            /* }*/
             
            
            /*  $this->form_validation->set_rules('position', 'Position', 'trim|required');
              $register['position'] = $input_data['position'];
              $register['Parentid'] = $this->binary->new_parent($register['u_sponsor'],$input_data['position']);
                
             
             
              $this->form_validation->set_rules('reg_full_name', 'Name', 'required');
              if(array_key_exists('mobile_users', $value_by_lebel)){
                   $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
                  $register['mobile'] =$mobile= $input_data['reg_mob_number'];
              }
              if(array_key_exists('mobile_users', $value_by_lebel)){
                   $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
                  $register['mobile'] =$mobile= $input_data['reg_mob_number'];
              }
			  
			  if(array_key_exists('email_users', $value_by_lebel)){
                   $this->form_validation->set_rules('reg_email', 'E-mail', 'trim|required|valid_email');
                  $register['email'] =$email= $input_data['reg_email'];
              }
              */
              
             
                 // $this->form_validation->set_rules('reg_password', 'Password', 'trim|required|min_length[6]');
                //    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[reg_password]');
                    $pw=$register['password'] = md5($input_data['reg_password']);
              
              
               /*$this->form_validation->set_rules('security_pin', 'Security Pin', 'required');*/
			   
               // if($this->form_validation->run() != False){					
				
                  //  $register['name'] =$user_name= ucwords($input_data['reg_full_name']);
                    
                    $referral_id=$input_data['referral_id'];
                    $find_refer_id=$this->conn->runQuery("id",'users',"username='$referral_id'");
                    $reff_id=$find_refer_id[0]->id;
                    $register['u_sponsor'] = $reff_id;
                    $register['user_type'] = 'user';
				//	$register['security_pin'] = $input_data['security_pin'];
					
                    $code=$this->conn->get_insert_id('users',$register);
                    if($code){
                        $inser_wallet=array();
                        $inser_wallet['u_code']=$code;
                        // $inser_wallet['c1']=5;
                        if($this->db->insert('user_wallets',$inser_wallet)){
                            
                            $source='token';
                            $income1=array(); 
        					$income1['tx_u_code']=$code;
        					$income1['u_code']=$code;
        					$income1['tx_type']='income';
        					$income1['source']=$source;
        					$income1['debit_credit']='credit';
        					$income1['amount']=5; 
        					
        				    ///	$income['token']=$payable_amt1;					
        					$income1['date']=date('Y-m-d H:i:s');             
        					$income1['added_on']=date('Y-m-d H:i:s');
        					$income1['status']=1;
        					
        					$income1['wallet_type']='aave_wallet';
        					$income1['remark']="Recieve 5 Token";
        					
        					if($this->db->insert('transaction',$income1)){
        						$income_lvl1=$income1['amount'];//-$income['tx_charge'];
        						$this->update_ob->add_amnt($code,'aave_wallet',$income_lvl1); 
        				    }
                            
                            $this->update_ob->add_direct($sponsor_id);
                            $this->update_ob->add_gen($sponsor_id);
                            $this->update_ob->add_gen_user($sponsor_id,$code);
                            
                            $ge=array();
                            $ge['u_code']=$code;
                            $ge['gen_team']="[]";
                            $this->db->insert('user_teams',$ge);
                            
                            //$this->update_ob->add_amnt($reff_id,'aave_wallet',1);      
                            $source='token';
                            $income=array(); 
        					$income['tx_u_code']=$code;
        					$income['u_code']=$reff_id;
        					$income['tx_type']='income';
        					$income['source']=$source;
        					$income['debit_credit']='credit';
        					$income['amount']=1; 
        					
        				    ///	$income['token']=$payable_amt1;					
        					$income['date']=date('Y-m-d H:i:s');             
        					$income['added_on']=date('Y-m-d H:i:s');
        					$income['status']=1;
        					
        					$income['wallet_type']='aave_wallet';
        					$income['remark']="Recieve 1  from Refferal Token";
        					
        					if($this->db->insert('transaction',$income)){
        						$income_lvl=$income['amount'];//-$income['tx_charge'];
        						$this->update_ob->add_amnt($reff_id,'aave_wallet',$income_lvl);                   
        						
        				   }
                            
                           /*if($user_type=='binary'){
                                $this->update_ob->update_binary($sponsor_id);
                            }*/
                        }
                        
                        // $this->session->set_flashdata("success", "Your Account has been registered. You can login now. Username : ".$register['username']." & Password :".$input_data['password']);
                        $website=$this->conn->company_info('title');
                        $company_url=$this->conn->company_info('base_url');
                        //$msg2="Dear ".$register['name']." , Welcome to $website. Your User ID : ".$register['username'].", Password : ".$input_data['password']." . For more visit $company_url .";
                        //$msg2="Welcome ".$register['name']." . You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password : ".$_POST['password'].". Thanks! test.com team."; 
                        $msg2="Welcome ".$register['name'].". You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password :".$input_data['reg_password'].". Thanks! $website team.";
                        
                        //$this->message->sms($mobile,$msg2);
                        //$this->message->send_mail($register['email'],'Registration success',$msg2);
                        $res['res'] = 'success';
                        $res['userid'] = $code;                        
                        $res['username'] = $register['username'];                        
                        $res['message'] = "Your Account has been registered. You can login now. Username : ".$register['username']." & Password :".$input_data['reg_password'];
                    
					}else{
                        
                        $res['res'] = 'error';
                        $res['message'] = "Already Register! Please try again.";
                         
                    }
                         //redirect(base_url('success?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name']),"refresh");
                /*}else{
                    $errors = validation_errors();
                    $res['res'] = 'error';
                    $res['err_referrer_id'] = form_error('referrer_id');
                    $res['err_reg_mob_number'] = form_error('reg_mob_number');
                    $res['err_reg_password'] = form_error('reg_password');
                    $res['err_reg_email'] = form_error('reg_email');
                    $res['err_reg_full_name'] = form_error('reg_full_name');
                    $res['message'] = 'Some Error in submittion';//$errors;//json_encode(['error'=>$errors]);
                }*/
       
        print_r(json_encode($res));
        $ss['remark']=json_encode($input_data);
        $this->db->insert('testing',$ss);
        
    }
    
    
    public function restore(){
        $input_data =$this->conn->get_input();
       
        //$referrer_id = $this->referrer_id($input_data['referrer_id']);
       
        $this->form_validation->set_data($input_data);
        //$user_type = $input_data['user_type'];
        $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
            $value_by_lebel= array_column($requires, 'value', 'label');
           // $this->form_validation->set_rules('membership_type', 'Membership Type', 'required');
			
           /* if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){
                // callback_is_sponsor_available
				if($input_data['referrer_id']!=""){
				
					$this->form_validation->set_rules('referrer_id', 'Sponsor', 'required|callback_is_sponsor_available');                
					$register['u_sponsor']=$this->profile->id_by_username($input_data['referrer_id']);
			   
				}else{
					
					 $register['u_sponsor']= 1;
				}
            }else{
                $register['u_sponsor']= 1;
            }
            $sponsor_id=$register['u_sponsor'];*/
            
            /* if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){
                 $this->form_validation->set_rules('usename', 'Usename', 'required|trim|callback_is_username_valid');
                 $register['username']= $value_by_lebel['user_gen_prefix'].$input_data['usename'];
             }else{*/	
                 //$register['username'] = $input_data['wallet_address'];
            /* }*/
             
            
            /*  $this->form_validation->set_rules('position', 'Position', 'trim|required');
              $register['position'] = $input_data['position'];
              $register['Parentid'] = $this->binary->new_parent($register['u_sponsor'],$input_data['position']);
                
             
             
              $this->form_validation->set_rules('reg_full_name', 'Name', 'required');
              if(array_key_exists('mobile_users', $value_by_lebel)){
                   $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
                  $register['mobile'] =$mobile= $input_data['reg_mob_number'];
              }
              if(array_key_exists('mobile_users', $value_by_lebel)){
                   $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
                  $register['mobile'] =$mobile= $input_data['reg_mob_number'];
              }
			  
			  if(array_key_exists('email_users', $value_by_lebel)){
                   $this->form_validation->set_rules('reg_email', 'E-mail', 'trim|required|valid_email');
                  $register['email'] =$email= $input_data['reg_email'];
              }
              */
              
             
                 // $this->form_validation->set_rules('reg_password', 'Password', 'trim|required|min_length[6]');
                //    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[reg_password]');
                    $pw=$register['password'] = md5($input_data['reg_password']);
              
              
               /*$this->form_validation->set_rules('security_pin', 'Security Pin', 'required');*/
			   
               // if($this->form_validation->run() != False){					
				
                  //  $register['name'] =$user_name= ucwords($input_data['reg_full_name']);
                //    $register['user_type'] = 'user';
				//	$register['security_pin'] = $input_data['security_pin'];
					
					
					$wallet_add=$input_data['wallet_address'];
					$find_refer_id=$this->conn->runQuery("id",'users',"username='$wallet_add'");
                    $reff_id=$find_refer_id[0]->id;
					
					 $this->db->set('password',$pw);
                        $this->db->where('username',$wallet_add);
                        $this->db->update('users');
					
					
                   // $code=$this->conn->get_insert_id('users',$register);
                    //if($code){
                       // $inser_wallet=array();
                      //  $inser_wallet['u_code']=$code;
                       /* if($this->db->insert('user_wallets',$inser_wallet)){
                            $this->update_ob->add_direct($sponsor_id);
                            $this->update_ob->add_gen($sponsor_id);
                            $this->update_ob->add_gen_user($sponsor_id,$code);
                            
                           
                         
                        }*/
                        
                        // $this->session->set_flashdata("success", "Your Account has been registered. You can login now. Username : ".$register['username']." & Password :".$input_data['password']);
                        $website=$this->conn->company_info('title');
                        $company_url=$this->conn->company_info('base_url');
                        //$msg2="Dear ".$register['name']." , Welcome to $website. Your User ID : ".$register['username'].", Password : ".$input_data['password']." . For more visit $company_url .";
                        //$msg2="Welcome ".$register['name']." . You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password : ".$_POST['password'].". Thanks! test.com team."; 
                        $msg2="Welcome ".$register['name'].". You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password :".$input_data['reg_password'].". Thanks! $website team.";
                        
                        //$this->message->sms($mobile,$msg2);
                        //$this->message->send_mail($register['email'],'Registration success',$msg2);
                        $res['res'] = 'success';
                        $res['userid'] = $reff_id;   
                        $res['username'] = $wallet_add;                        
                        $res['message'] = "Your Account has been registered. You can login now. Username : ".$register['username']." & Password :".$input_data['reg_password'];
                    
					/*}else{
                        
                        $res['res'] = 'error';
                        $res['message'] = "Somthing Wrong with database! Please try again.";
                         
                    }*/
                         //redirect(base_url('success?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name']),"refresh");
                /*}else{
                    $errors = validation_errors();
                    $res['res'] = 'error';
                    $res['err_referrer_id'] = form_error('referrer_id');
                    $res['err_reg_mob_number'] = form_error('reg_mob_number');
                    $res['err_reg_password'] = form_error('reg_password');
                    $res['err_reg_email'] = form_error('reg_email');
                    $res['err_reg_full_name'] = form_error('reg_full_name');
                    $res['message'] = 'Some Error in submittion';//$errors;//json_encode(['error'=>$errors]);
                }*/
       
        print_r(json_encode($res));
        $ss['remark']=json_encode($input_data);
        $this->db->insert('testing',$ss);
        
    }
    
    
    
     public  function is_sponsor_available($str){
        $where = array(
            'username' => $str            
        );       
        $details=$this->conn->runQuery('id,active_status','users', $where);
        
        $ss['remark']=$this->db->last_query();
        $this->db->insert('testing',$ss);
        if($details){
            
                 return true;
           
        }else{
              $this->form_validation->set_message('is_sponsor_available', "Sponsor not Exists! Please Try another.");
               return false;
        }
    }

    public  function is_username_valid($str){
        $where = array(
            'username' => $str            
        );       
        if($this->conn->runQuery('id','users', $where)){
            $this->form_validation->set_message('is_username_valid', "Username Already Exists! Please Try another.");
            return false;
        }else{
              
               return true;
        }
    }

    public  function is_mobile_valid($str){
        $where = array(
            'mobile' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){            
            $mobile_users=$this->conn->setting('mobile_users');
            if(count($result)>=$mobile_users){
                  $this->form_validation->set_message('is_mobile_valid', "You exceed maximum number of mobile use limit! Please Try another.");
                 return false;                
            }else{
                return true;
            }
        }else{
            return true;
        }
    }
    
    
    public  function is_email_valid($str){
        $where = array(
            'email' => $str            
        );
        $result=$this->conn->runQuery('id','users', $where);
        if($result){           
            $email_users=$this->conn->setting('email_users');
            if(count($result)>=$email_users){               
                  $this->form_validation->set_message('is_email_valid', "You exceed maximum number of email use limit! Please Try another.");
                   return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    public  function check_mobile_valid(){
        
        if (preg_match('/^[0-9]{10}+$/', $_POST['mobile'])) {
            $where = array(
                'mobile' => $_POST['mobile']            
            );
            $result=$this->conn->runQuery('id','users', $where);
            if($result){            
                $mobile_users=$this->conn->setting('mobile_users');
                if(count($result)>=$mobile_users){
                    $res['error']=true; 
                    $res['msg']="You exceed maximum number of mobile use limit! Please Try another.";                
                }else{
                    $res['error']=false; 
                    $res['msg']="Valid mobile.";
                }
            }else{
                $res['error']=false; 
                $res['msg']="Valid mobile.";
            }
        }else{
            $res['error']=true; 
            $res['msg']="Invalid mobile ! Please Enter valid mobile.";
        }
        print_r(json_encode($res)); 
    }

    public  function check_email_valid(){
        
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $where = array(
                'email' => $_POST['email']            
            );
            $result=$this->conn->runQuery('id','users', $where);
            if($result){           
                $email_users=$this->conn->setting('email_users');
                if(count($result)>=$email_users){               
                    $res['error']=true; 
                    $res['msg']="You exceed maximum number of email use limit! Please Try another.";
                }else{
                    $res['error']=false; 
                    $res['msg']="Valid Email.";
                }
            }else{
                $res['error']=false; 
                $res['msg']="Valid Email.";
            }
        }else{
            $res['error']=true; 
            $res['msg']="Invalid Email ! Please Enter valid Email.";
        }
        print_r(json_encode($res)); 
    }

    public  function check_sponsor_exist(){
        $input_data = $this->conn->get_input();
        
        //$res['error']=true;
        $where = array(
            'username' => $input_data['referrer_id']          
        );
        
        $details  =  $this->conn->runQuery('id,name,active_status,account_type','users', $where);        
        if($details){
            if(/*$this->conn->setting('only_active_sponsor')=='yes'*/ 1==1){
                if($details[0]->active_status==1){
                    $res['account_type']=$details[0]->account_type;
                    $res['u_f_name']=$details[0]->name;
                    $res['res']='success';
                }else{
                    $res['res']="error";
                    $res['message']="Sponsor not active";
                    
                }
            }else{
                $res['account_type']=$details[0]->account_type;
                $res['u_f_name']=$details[0]->name;
                $res['res']='success';
            }
        }else{   
             $res['res']="error";
            $res['msg']="Sponsor not exist";
        }
        print_r(json_encode($res));
    }

    public  function check_username_exist(){
         $input_data = $this->conn->get_input();
        if(isset($input_data['username']) && $input_data['username']!=''){
            $where['username']= $input_data['username'];
            $details  =  $this->conn->runQuery('name','users', $where);        
            if($details){            
                $res['name'] = $details[0]->name;
                $res['res']='success'; 
                $res['message']="Username Exists";
            }else{            
                
                $res['res']='error';
                $res['message']="Invalid username";
            }
        }else{
            $res['res']='error';            
            $res['message']="Please Enter username";
        } 
        print_r(json_encode($res));      
    }
    
    
     public  function check_ip_exist(){
         $input_data = $this->conn->get_input();
        if(isset($input_data['ip_address']) && $input_data['ip_address']!=''){
            $where['ip_address']= $input_data['ip_address'];
            $details  =  $this->conn->runQuery('userid,','referral_ip', $where);        
            if($details){            
                $res['username'] = $details[0]->userid;
                $res['res']='success'; 
                $res['message']="Username Exists";
            }else{            
                
                $res['res']='error';
                $res['message']="Invalid username";
            }
        }else{
            $res['res']='error';            
            $res['message']="Please Enter username";
        } 
        print_r(json_encode($res));      
    }

    public function get_username($user_type='user'){
        $selected='no';
        $user_gen_prefix=$this->conn->setting('user_gen_prefix');
        $user_gen_digit=$this->conn->setting('user_gen_digit');
        $user_gen_fun=$this->conn->setting('user_gen_fun');
        while($selected=='no'){
            $selected='yes';
            $username=$user_gen_prefix.random_string($user_gen_fun, $user_gen_digit);
            $check_username_exists=$this->conn->runQuery('username','users',"username='$username'");
            if($check_username_exists){
                $selected='no';
            }
        }        
        return $username;
    }
    
    
}