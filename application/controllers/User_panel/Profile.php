<?php
class Profile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){ 
         if(isset($_POST['edit_btn'])){

            $edit_profile_with_otp=$this->conn->setting('edit_profile_with_otp');
            if($edit_profile_with_otp=='yes'){
                $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
            }
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
               
            if($this->form_validation->run() != False){
               
                $param['upload_path']='users';
                $upload_product=$this->upload_file->upload_image('profile_pic',$param);
                     
                        
              
                if($upload_product['upload_error']==false){
                    $update['img']=$upload_product['file_name'];
                }
                $update['name']=$this->input->post('name');
                $update['email']=$this->input->post('email');
                $update['mobile']=$this->input->post('mobile');
                $this->db->where('id',$this->session->userdata('user_id'));
                if($this->db->update('users',$update)){
                
                    $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                    $this->session->set_flashdata("success", "Profile Updated successfully.");
                    redirect(base_url(uri_string()));
                }else{
                    
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }  
            }           
        }
        
        $this->show->user_panel('profile');
    }

      public function edit_profile(){

        if(isset($_POST['edit_btn'])){

            $edit_profile_with_otp=$this->conn->setting('edit_profile_with_otp');
            if($edit_profile_with_otp=='yes'){
                $this->form_validation->set_rules('otp_input1', 'OTP', 'required|trim|callback_check_otp_valid');
            }
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|max_length[10]');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
                $param['upload_path']='users';
                $upload_product=$this->upload_file->upload_image('profile_pic',$param);
                     
                       
            if($this->form_validation->run() != False && $upload_product['upload_error']==false){
               
                   
              
                if($upload_product['upload_error']==false){
                    
                    $update['img']=$upload_product['file_name'];
                }
                $update['name']=$this->input->post('name');
                $update['email']=$this->input->post('email');
                $update['mobile']=$this->input->post('mobile');
                // $update['instagram_link']=$this->input->post('instagram_link');
                // $update['facebook_link']=$this->input->post('facebook_link');
                // $update['twitter_link']=$this->input->post('twitter_link');
                // $update['telegram_link']=$this->input->post('telegram_link');
                // $update['snap_chat']=$this->input->post('snap_chat');
                $this->db->where('id',$this->session->userdata('user_id'));
                if($this->db->update('users',$update)){
                    $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                    $this->session->set_flashdata("success", "Profile Updated successfully.");
                    redirect(base_url(uri_string()));
                }else{
                    
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }  
            }else{
                 $data['upload_error']=($upload_product['upload_error']==true ? $upload_product['display_error'] : '');
            }             
        }

       
            if(isset($_POST['edit_bank_btn'])){
                  
                $edit_profile_with_otp=$this->conn->setting('edit_profile_with_otp');
                if($edit_profile_with_otp=='yes'){
                    $this->form_validation->set_rules('otp_input', 'OTP', 'required|trim|callback_check_otp_valid');
                }
                
                $btc_withdrawal=$this->conn->setting('btc_withdrawal');
                if($btc_withdrawal=='yes'){
                    $this->form_validation->set_rules('btc_address', 'BTC address', 'required');
                }else{
                    $this->form_validation->set_rules('account_no', 'Account no', 'required');
                    $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required');
                }
                
                
               /* $this->form_validation->set_rules('paytm_no', 'Paytm no', 'required|regex_match[/^[0-9]{10}$/]');*/

                if($this->form_validation->run() != False){
                    if($btc_withdrawal=='yes'){
                        $update['btc_address']=$this->input->post('btc_address');
                        $update['eth_address']=$this->input->post('eth_address');
                    }else{
                        $update['bank_name']=$this->input->post('bank_name');
                        $update['account_holder_name']=$this->input->post('account_holder_name');
                        $update['account_no']=$this->input->post('account_no');
                        $update['ifsc_code']=$this->input->post('ifsc_code');
                        $update['bank_branch']=$this->input->post('bank_branch');
                    }
                    
                    //$update['paytm_no']=$this->input->post('paytm_no');
                    
                    $update['bank_kyc_status']="approved";
                    $update['bank_kyc_date']=date('Y-m-d H:i:s');

                    $userid=$this->session->userdata('user_id');
                    $bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                    if($bank_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                    }          

                    if($qury){
                        $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                        $this->session->set_flashdata("success", "Profile Updated successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }                            
            }

        


            if(isset($_POST['password_btn'])){

                $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_old_password');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]'); 
                if($this->form_validation->run() != False){
                    $update['password']=md5($this->input->post('password'));               
                    $this->db->where('id',$this->session->userdata('user_id'));
                    $update['pass_status']=1; 
                    if($this->db->update('users',$update)){
                        $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                        $this->session->set_flashdata("success", "Password successfully changed.");
                        redirect(base_url(uri_string()));
                    }else{                    
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }                        
            }    

        $this->show->user_panel('edit_profile',$data);
    }
    
    
    
    public function set_user_password(){
        
    if(isset($_POST['set_password_btn'])){
            // $this->form_validation->set_rules('otp_input', 'OTP', 'required|trim|callback_check_otp_valid'); 
             $this->form_validation->set_rules('tx_password', 'Set tx Password', 'required|min_length[6]|callback_check_set_password');
             $this->form_validation->set_rules('confirm_password', 'Password Confirmation','trim|required|matches[tx_password]'); 
            
            if($this->form_validation->run() != False){
                $update=array();
                $update['tx_password']=md5($this->input->post('tx_password'));
                $update['set_user_password_status']=1;
                
                $this->db->where('id',$this->session->userdata('user_id'));
                if($this->db->update('users',$update)){                
                    $this->session->set_flashdata("success", "Set transaction Password Added successfully.");
                    redirect(base_url(uri_string()));
                }else{                
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }
                        
        }
         $this->show->user_panel('set_user_password');
    }

    public function change_password(){

        if(isset($_POST['password_btn'])){

            $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_old_password');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]'); 
            if($this->form_validation->run() != False){
                $update['password']=md5($this->input->post('password'));               
                $this->db->where('id',$this->session->userdata('user_id'));
                $update['pass_status']=1; 
                if($this->db->update('users',$update)){
                    $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                    $this->session->set_flashdata("success", "Password successfully changed.");
                    redirect(base_url(uri_string()));
                }else{                    
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }                        
        }

        $this->show->user_panel('change_password');
    }

 public function tx_change_password(){

        if(isset($_POST['tx_password_btn'])){

            $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_old_tx_password');
            $this->form_validation->set_rules('tx_password', 'Transaction Password', 'trim|required');
            $this->form_validation->set_rules('tx_confirm_password', 'Confirmation Transaction Password', 'trim|required|matches[tx_password]'); 
            if($this->form_validation->run() != False){
                $update['tx_password']=$this->input->post('tx_password');               
                $this->db->where('id',$this->session->userdata('user_id'));
                $update['tx_pass_status']=1; 
                if($this->db->update('users',$update)){
                    
                    /*echo $this->db->last_query();
                    die();*/
                    $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                    $this->session->set_flashdata("success", "Transaction Transaction Password successfully changed.");
                    redirect(base_url(uri_string()));
                }else{                    
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }                        
        }

        $this->show->user_panel('change_tx_password');
    }


public  function check_old_tx_password($str){
   
          $user_id=$this->session->userdata('user_id');
          $prof=$this->profile->profile_info($user_id);
         
        if($prof->tx_password==$str){
            return true;
        }else{
              $this->form_validation->set_message('check_old_tx_password', "Old password not match! Please Try again.");
               return false;
        }
    }

    public  function check_old_password($str){
             $prof=$this->session->userdata('profile');
        if($prof->password==md5($str)){
            return true;
        }else{
              $this->form_validation->set_message('check_old_password', "Old password not match! Please Try again.");
               return false;
        }
    }

    public  function check_otp_valid($str){
        if(isset($_SESSION['otp'])){
            if($_SESSION['otp']==$str){
                return true;
            }else{
                $this->form_validation->set_message('check_otp_valid', "Incorect OTP. Please try again.");
                return false;
            }
        }else{
            $this->form_validation->set_message('check_otp_valid', "OTP not Valid.");
            return false;
        }        
    }

    public function verify_username(){
        $username=$_POST['username'];
        $ret['error']=true;
        if($username!=''){
            $check=$this->conn->runQuery('id,name','users',"username='$username'");
            if($check){
                $ret['error']=false;
                $ret['msg']=$check[0]->name;
            }else{                
                $ret['msg']="Invalid Username.";
            }
        }else{            
            $ret['msg']="Please enter username.";
        }        
        print_r(json_encode($ret));
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

     public function send_otp(){
        $email=$this->session->userdata('profile')->email;
        $u_code=$this->session->userdata('profile')->id;
        $otp=random_string('numeric', 6);
        $this->session->set_tempdata('otp', $otp, 300);
        $company_name=$this->conn->company_info('title');
         $msg="$otp is your OTP. Team $company_name";
        //$this->message->sms($mobile,$msg);
        $this->message->send_mail_reg($email,'otp',$msg,$u_code);
        return json_encode(array('error'=>false));
    }
    
    
    public function id_card(){
        $this->show->user_panel('profile_card');
        
    }
    
     public function welcome(){
        $this->show->user_panel('welcome_letter');
    }
    
    public function letter(){
        $this->show->user_panel('welcome_letter_new');
    }
    
     public function form(){ 
        $this->show->user_panel('form');
    }
    
    public function news(){
        $this->show->user_panel('news_event');
    }
    
    public function account(){
        $this->show->user_panel('account');
    }
    
    public function market(){
        $this->show->user_panel('market');
    }
    
    public function meta_about(){
        $this->show->user_panel('meta_about');
    }
    
    public function blog(){
        $this->show->user_panel('blog');
    }
    
    
    
    
    public function qr_code(){
       
         
        $this->show->user_panel('referral_qr_code');
    }
    
    
    
    public  function check_set_password($str){
             $prof=$this->session->userdata('profile');
            
        if($prof->password==md5($str)){
            $this->form_validation->set_message('check_set_password', "password match! Please Try again.");
            return false;
            
        }else{
             return true;
        }
    }



    public function edit_user_profile(){

        if(isset($_POST['edit_user_info'])){
                  
             $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
             $this->form_validation->set_rules('username', 'Username', 'required|callback_username_exits'); 
			 $this->form_validation->set_rules('name', 'Name', 'required'); 
			 $this->form_validation->set_rules('email', 'Email', 'required'); 
			 $this->form_validation->set_rules('mobile', 'Mobile', 'required'); 
			 $this->form_validation->set_rules('bio', 'Bio', 'required'); 
			 //$this->form_validation->set_rules('service_type', 'Service', 'required'); 
			  
                
            if($this->form_validation->run() != False){
			   $param['upload_path']='users';
               $upload_product=$this->upload_file->upload_image('profile_pic',$param);
               if($upload_product['upload_error']==false ){
                    $update['img']=$upload_product['file_name'];
                }
				 $u_code=$this->session->userdata('user_id');
			
			    $update['username']=$this->input->post('username');
				$update['name']=$this->input->post('name');
				$update['address']=$this->input->post('address');
				$update['service_time']=$this->input->post('service_time');
				$update['website_url']=$this->input->post('website_url');
				$update['service_type']=$this->input->post('service_type');
                $update['email']=$this->input->post('email');
                $update['mobile']=$this->input->post('mobile');
				$update['facebook_link']=$this->input->post('facebook_link');
				$update['instagram_link']=$this->input->post('instagram_link');
				$update['twitter_link']=$this->input->post('twitter_link');
				$update['linkdin_link']=$this->input->post('linkdin_link');
				$update['telegrame_link']=$this->input->post('telegrame_link');
				$update['bio']=$this->input->post('bio');
				$update['u_code']=$u_code;
               
                $personal_details=$this->conn->runQuery('*',"users_info","u_code=$u_code");
				if($personal_details){
					$this->db->where('u_code',$this->session->userdata('user_id'));
					$qury=$this->db->update('users_info',$update);
     
                }else{
					$update['u_code']=$u_code;
                    $qury=$this->db->insert('users_info',$update);
                      
                    }
				if($qury){                       
					$this->session->set_flashdata("success", "Personal Profile Added successfully.");
					redirect(base_url(uri_string()));
				}else{

					$this->session->set_flashdata("error", "Something Wrong.");
					redirect(base_url(uri_string()));
				}
				  
            }           
        }

      
        $this->show->user_panel('edit_user_info');
    }
	
	
	 public function verify_username1(){
        $username=$_POST['username'];
        $ret['error']=true;
       // if($username!=''){
            $check=$this->conn->runQuery('id,name','users_info',"username='$username'");
            if($check){
               $ret['error']=false;
               $ret['msg']="Username Already Exists.";
            }else{                
              // $ret['msg']="Please enter username.";
            }
      //  }else{            
          //   $ret['msg']="Please enter username.";
      //  }        
        print_r(json_encode($ret));
    }
	
	
	public function username_exits($str){
        $check_username=$this->conn->runQuery("id",'users_info',"username='$str'");
		if($check_username){
			 $this->form_validation->set_message('username_exits', "Username! Already Exists.");
             return false;
           
        }else{
              return true;
        }
    }
    
    
    public function user_wallet(){
        $searchdata['search_string']='user_wallet_search';   
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $searchdata['from_table']='user_wallets'; 
      
       // $searchdata['order_by']='c1 desc'; 
        
        
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
         if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
           $spo=$this->profile->column_like($_REQUEST['name'],'name');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
          
          
            $spo=$this->profile->column_like($_REQUEST['username'],'username');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
           
        }      
         
         
         if(isset($_REQUEST['my_rank']) && $_REQUEST['my_rank']!=''){
          
          
            $spo=$this->profile->column_like_rank($_REQUEST['my_rank'],'my_rank');     
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
           
        }   
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
         
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users/user_wallet'); 
         
            
        $this->show->user_panel('user_wallet',$data);
              
    }





}