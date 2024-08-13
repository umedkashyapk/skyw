<?php
class Kyc extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }

    public function index(){         
          
      //$this->show->user_panel('index');
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
    
    public function adhaar(){
        $data=array();
        $input_data = $this->conn->get_input();
        
       if(isset($input_data['u_id'])){
            
            $this->form_validation->set_data($input_data);
            
            
            $rsss=$this->get_user_id();
             if($rsss['res']=='success'){
            $userid=$rsss['u_id'];
            $adhaar_details=$this->conn->runQuery('adhaar_kyc_status',"user_accounts","u_code='$userid' and adhaar_kyc_status IN ('submitted','approved')");
            if($adhaar_details==false){
                 
                $this->form_validation->set_rules('name', 'Adhaar name', 'required');                 
                $this->form_validation->set_rules('aadhaarNumber', 'Adhaar no', 'required');               
               
                $this->form_validation->set_rules('state', 'State', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('pincode', 'Pin Code', 'required');
                $server_root = $_SERVER['DOCUMENT_ROOT']."/";
                    $base64_string=$input_data['front_image'];
                 	$image_name = rand(1000000,9999999).$userid."_adhar_kyc_pic.png";
					$payment_slip_image_path="/images/kyc/".$image_name;
					$ifp = fopen($server_root ."/images/kyc/".$image_name, "wb");// use your folder path
					fwrite($ifp, base64_decode(str_replace(' ', '', $base64_string)));
					fclose($ifp);
                
                 
                 $server_root1 = $_SERVER['DOCUMENT_ROOT']."/";
                    $base64_string1=$input_data['back_image'];
                 	$image_name1 = rand(1000000,9999999).$userid."_adhar_kyc_pic.png";
					$payment_slip_image_path1="/images/kyc/".$image_name1;
					$ifp1 = fopen($server_root1 ."/images/kyc/".$image_name1, "wb");// use your folder path
					fwrite($ifp1, base64_decode(str_replace(' ', '', $base64_string1)));
					fclose($ifp1);

                if($this->form_validation->run() != False ){
                    
                    $profile=$this->profile->profile_info($userid);
                    $account_type=$profile->account_type;
                    
					
					$update['state']=$states=$input_data['state'];
					$update['city']=$city=$input_data['city'];
					$update['pin_code']=$pincode=$input_data['pincode'];
					$update['address2']=$input_data['address2'];					
					
					
                    $update['adhaar_image'] = base_url().'images/kyc/'.$image_name;
                    $update['adhaar_back_image'] = base_url().'images/kyc/'.$image_name1;
                    $update['adhaar_name']=$input_data['name'];
                    $update['adhaar_no']=$input_data['aadhaarNumber'];
                    $update['address']=$input_data['address'];
                    $update['adhaar_kyc_status']="submitted";
                    $update['adhaar_kyc_date']=date('Y-m-d H:i:s');
                   // $update['user_type']=$account_type;
                    
                    $adhaar_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                    if($adhaar_details){
                        $this->db->where('u_code',$userid);
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                    }          
                    
					$update1['address2']=$input_data['address2'];
					$update1['address']=$input_data['address'];
					$update1['state']=$states;
					$update1['city']=$city;
					$update1['post_code']=$pincode;
					$this->db->where('id',$userid);
                    $qury=$this->db->update('users',$update1);
                    if($qury){ 
                        $res['res']= 'success';
                        $res['message']= "Request submitted successfully.";
                    //    $this->session->set_flashdata("success", "Request submitted successfully.");
                       // redirect(base_url(uri_string()));
                    }else{
                        
                       $res['res']= 'error';
                        $res['message']=  "Something Wrong.";
                    }
                }else{
                    $res['res']= 'error';
                    $res['message']=  "Something Wrong.";
                    
                }
            }else{
                //$this->session->set_flashdata("error", "Something Wrong.");
                    $res['res']= 'error';
                    $res['message']=  "Something Wrong.";
            }
             }else{
                        $res['res']= 'error';
                        $res['message']=  $rsss['message'];
                         
                    }
                        
        }
       
       print_r(json_encode($res));
       //$this->show->user_panel('kyc_adhaar',$data);
    
    }
    
     public function adhar_details(){
         $input_data = $this->conn->get_input();
         if(isset($input_data['u_id'])){
             $userid=$input_data['u_id'];
            $adhaar_details=$this->conn->runQuery('*',"user_accounts","u_code='$userid' and  adhaar_kyc_status IN ('submitted','approved')");
            if($adhaar_details){
                $adhaar_detailss=$adhaar_details[0];
                    $res1['adhaar_name'] = $adhaar_detailss->adhaar_name;
                    $res1['adhaar_no'] = $adhaar_detailss->adhaar_no;
                    $res1['adhaar_address'] = $adhaar_detailss->address;
					 $res1['adhaar_address2'] = $adhaar_detailss->address2;
					  $res1['state'] = $adhaar_detailss->state;
					   $res1['city'] = $adhaar_detailss->city;
					    $res1['pin_code'] = $adhaar_detailss->pin_code;
                    $res1['adhaar_image'] = $adhaar_detailss->adhaar_image;
                    $res1['adhaar_back_image'] = $adhaar_detailss->adhaar_back_image;
                    $res1['adhaar_kyc_date'] = $adhaar_detailss->adhaar_kyc_date;
                    $res1['adhaar_kyc_status'] = $adhaar_detailss->adhaar_kyc_status;
                    $res1['adhaar_remark'] = $adhaar_detailss->adhaar_remark;
                    $res['data'] = $res1;
                    $res['res'] = 'success';
                    
                }else{
                    $res['data'] = array();
                    $res['res'] = 'error';
                    $res['message'] = "Empty details";
                }
             }else{
                    $res['data'] = array();
                    $res['res'] = 'error';
                    $res['message'] = "Invalid params.";
            }
            print_r(json_encode($res));
    }
    
    public function pan_details(){
         $input_data = $this->conn->get_input();
         if(isset($input_data['u_id'])){
             $userid=$input_data['u_id'];
            $adhaar_details=$this->conn->runQuery('*',"user_accounts","u_code='$userid' and pan_kyc_status IN ('submitted','approved')");
            if($adhaar_details){
                
                    $adhaar_detailss = $adhaar_details[0];
                    $res1['pan_name'] = $adhaar_detailss->pan_name;
                    $res1['pan_no'] = $adhaar_detailss->pan_no;
                    $res1['pan_dob'] = $adhaar_detailss->pan_dob;
                    $res1['pan_image'] = $adhaar_detailss->pan_image;
                    $res1['pan_kyc_date'] = $adhaar_detailss->pan_kyc_date;
                    $res1['pan_kyc_status'] = $adhaar_detailss->pan_kyc_status;
                    $res1['pan_remark'] = $adhaar_detailss->pan_remark;
                    $res['data'] = $res1;
                    $res['res'] = 'success';
                    
                }else{
                    $res['data'] = array();
                    $res['res'] = 'error';
                    $res['message'] = "Empty details";
                }
            }else{
                    $res['data'] = array();
                    $res['res'] = 'error';
                    $res['message'] = "Invalid params.";
            }
            print_r(json_encode($res));
    }
    
    public function pan(){
        $data=array();
        $input_data = $this->conn->get_input();
        
        if(isset($input_data['u_id'])){
            
            $this->form_validation->set_data($input_data);
            $rsss=$this->get_user_id();
            if($rsss['res']=='success'){
            $userid=$rsss['u_id'];
            $adhaar_details=$this->conn->runQuery('pan_kyc_status',"user_accounts","u_code='$userid' and pan_kyc_status IN ('submitted','approved')");
            if($adhaar_details==false){
                 
                $this->form_validation->set_rules('pan_name', 'Pan Name', 'required');                 
                $this->form_validation->set_rules('pan_no', 'Pan Number', 'required');               
                $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');               

                $server_root = $_SERVER['DOCUMENT_ROOT']."/";
                    $base64_string=$input_data['pan_image'];
                 	$image_name = rand(1000000,9999999).$userid."_adhar_kyc_pic.png";
					$payment_slip_image_path="/images/kyc/".$image_name;
					$ifp = fopen($server_root ."/images/kyc/".$image_name, "wb");// use your folder path
					fwrite($ifp, base64_decode(str_replace(' ', '', $base64_string)));
					fclose($ifp);

                if($this->form_validation->run() != False ){
                    
                    $profile=$this->profile->profile_info($userid);
                    $account_type=$profile->account_type; 
                    
                    $update['pan_image'] = base_url().'images/kyc/'.$image_name;
                    $update['pan_name']=$input_data['pan_name'];
                    $update['pan_dob']=$input_data['dob'];
                     
                    $update['pan_no']=$input_data['pan_no'];
                    $update['pan_kyc_status']="submitted";
                    $update['pan_kyc_date']=date('Y-m-d H:i:s');
                   // $update['user_type']=$account_type;
                    
                    $adhaar_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                    if($adhaar_details){
                        $this->db->where('u_code',$userid);
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                    }          

                    if($qury){ 
                        $res['res']= 'success';
                        $res['message']= "Request submitted successfully.";
                    //    $this->session->set_flashdata("success", "Request submitted successfully.");
                       // redirect(base_url(uri_string()));
                    }else{
                        
                       $res['res']= 'error';
                        $res['message']=  "Something Wrong3.";
                    }
                }else{
                    $res['res']= 'error';
                    $res['message']=  "Something Wrong2.";
                    
                }
            }else{
                //$this->session->set_flashdata("error", "Something Wrong.");
                    $res['res']= 'error';
                    $res['message']=  "Something Wrong1.";
            }
             }else{
                        $res['res']= 'error';
                        $res['message']=  $rsss['message'];
                         
                    }
                        
        }
 print_r(json_encode($res));
       // $this->show->user_panel('kyc_adhaar',$data);
    
    }
     
}