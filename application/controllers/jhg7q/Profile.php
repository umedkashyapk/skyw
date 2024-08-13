<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
// header("Access-Control-Allow-Headers: X-Requested-With");
class Profile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
         if(!array_key_exists('token',$this->input->request_headers())){
           
            
           $data['status']=false;
           $data['tokenStatus']=false;
           $data['message']="Invalid Token.";
            // print_r(json_encode($data));
            // die();
        }else{
            // $sdfg   = $this->input->request_headers()['token'];
           $sdfg = $this->input->get_request_header('token', TRUE);
           $this->user_id =  $this->token->userByToken($sdfg);
        }
        
    }
    
    public function change_profile_pic(){
        $input_data = $this->conn->get_input();
        if(isset($input_data['u_id']) && isset($input_data['profile_pic'])){
            $server_root = $_SERVER['DOCUMENT_ROOT']."/";
            $base64_string=$input_data['profile_pic'];
            $image_name = rand(1000000,9999999).$input_data['u_id']."_paymentslip_.png";
            $payment_slip_image_path="images/users/".$image_name;
            $ifp = fopen($server_root ."images/users/".$image_name, "wb");// use your folder path
            fwrite($ifp, base64_decode(str_replace(' ', '', $base64_string)));
            fclose($ifp);
             
            $this->db->set('img',$image_name);
            $this->db->where('id',$input_data['u_id']);
            if($this->db->update('users')){
                $res['res']= 'success';
                $res['pic_path']= "$image_name";
                $res['message']= "Profile images changed.";
            }else{
                $res['res']= 'error';
                $res['pic_path']= "";
                $res['message']= "Some Error in submittion";
            }
        }else{
            $res['res']= 'error';
            $res['pic_path']= "";
            $res['message']= "Invalid parameters.";
        }
        print_r(json_encode($res));
    }
    
     public function edit_account(){
            $sdfg = $this->input->get_request_header('token', TRUE);
        //$sdfg   = $this->input->request_headers()['token'];
        $u_id =  $this->token->userByToken($sdfg);
        if($u_id){
        $this->form_validation->set_rules('account', 'Account', 'required');
        $this->form_validation->set_rules('account_type','Account Type','required');
        if($this->form_validation->run() != False){
            $acc=array();
            $account_details=$_POST['account'];
            $account_type=$_POST['account_type'];
           
            $u_code=$u_id;
            $update=array();
            
            //$update['img'] = base_url().'images/users/'.$upload_pic['file_name'];
            if($account_type == 'TRC20'){
                $update1['tron_address']=$account_details;
            }elseif($account_type == 'BEP20'){
                $update1['btc_address']=$account_details;
            }
             
             $update1['account_type']=$account_type;
            $update1['u_code']=$u_code; 
             $update1['bank_kyc_status']="approved";
             $update1['bank_kyc_date']=date('Y-m-d H:i:s');
            $user_id = $u_code;
            $bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$user_id'");
            if($bank_details){
                $this->db->where('u_code',$user_id);
                $qury=$this->db->update('user_accounts',$update1);
            }else{
                $update1['u_code']=$user_id;
                $qury=$this->db->insert('user_accounts',$update1);
            }   
            
                $res['res']= 'success';
                $res['message']= "Profile Updated successfully.";
            }else{
                    $res['res']= 'error';
                    $res['message']= "Some Error in submittion";
            }
        }else{
            $res['res'] ='error';
            $res['tokenStatus'] ='false';
            $res['message']= 'Token Expired!';
        }
          print_r(json_encode($res));           
     }                
    
    public function change_profile_remove(){
         $input_data = $this->conn->get_input();
         if(isset($input_data['u_id'])){
             
             $this->db->set('img','');
             $this->db->where('id',$input_data['u_id']);
             if($this->db->update('users')){
                    $res['res']= 'success';
                    $res['message']= "Profile images removed.";
             }else{
                $res['res']= 'error';
                $res['message']= "Some Error in submittion";
             }
         }else{
            $res['res']= 'error';
            $res['message']= "Invalid parameters.";
        }
         print_r(json_encode($res));
    }   
    
    
    public function edit_profile(){
         $input_data = $this->conn->get_input();
         
        //$referrer_id = $this->referrer_id($input_data['referrer_id']);
         if(isset($input_data) ){
            
       /// $this->form_validation->set_data($_POST);
        //$userid = $_POST['u_id'];
        //$this->form_validation->set_rules('mobile', 'Mobile', 'numeric|required');
        //$this->form_validation->set_rules('email', 'E-mail', 'trim|required');
         //$this->form_validation->set_rules('otp_type', 'Otp Type', 'required');
         //$this->form_validation->set_rules('entered_otp','OTP','required');
         $userid=$input_data['u_id'];
          $mobile=$input_data['mobile'];
          $email=$input_data['email'];
          $otp_type=$input_data['otp_type'];
           $entered_otp=$input_data['entered_otp'];
         
         
        $sel_qq1 = $this->conn->runQuery('*','api_otp'," u_id='$userid' AND  otp_type='edit_profile'");
         
     if($sel_qq1){
              $otp = $sel_qq1[0]->otp;
             if($otp==$entered_otp){
                       
                                $user_details=$this->conn->runQuery('*',"users","id='$userid'"); 
                               
                                if($user_details){
                
                                $update['email']=$email;
                                $update['mobile']=$mobile;
                  
                                $update['profile_edited']=0;
                                $this->db->where('id',$userid);
                                if($this->db->update('users',$update)){
                
                                $userinfo = json_decode(json_encode($this->profile->profile_info($$userid)),true);
                         
                             
                               
                                if($userinfo['u_sponsor']!='' && $userinfo['u_sponsor']!=0){
                                    $userinfo['referrer_u_code']  = $this->profile->profile_info($userinfo['u_sponsor'],'username')->username;
                                }else{
                                    $userinfo['referrer_u_code']  = '';
                                }
                                
                                   
                                $userinfo['u_password']=md5($userinfo['password']);
                                    $res['res']= 'success';
                                     $res['user_info'] = $userinfo;
                              
                                    $res['message']= "Profile Updated successfully.";
                                     
                                        
                                }else{
                                    $res['res']= 'error';
                             
                                    $res['message']= "Something Wrong.";
                                     
                                } 
                        }else{ 
                             $res['res']= 'error';
                             
                             $res['message']= "You can update your profile only once.";
                            
                        }      
                    
    
            }else{
                $res['res']= 'error';
                $res['message']=  "Invalid  OTP!";
               }
    }else{
        $res['res']= 'error';
        $res['message']=  "Wrong OTP!";
    }
            
               

    } else
     {
          $res['res']= 'error';
        $res['message']=  "user not found!";
    
     } 
    
         print_r(json_encode($res));
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
    
}