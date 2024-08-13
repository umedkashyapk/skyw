<?php
class Kyc extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){         
          
      //$this->show->user_panel('index');
    }
    
    
     public function kyc_verified(){
        
         if(isset($_POST['personal_btn'])){
                
                $userid=$this->session->userdata('user_id');
                $this->form_validation->set_rules('name', 'Name', 'required');  
                $this->form_validation->set_rules('disribute_no', 'Distribute', 'required');  
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('mobile', 'Mobile', 'required');
               
                if($this->form_validation->run() != False){
                  
                  $update['name']=$this->input->post('name');
                  $update['disribute_no']=$this->input->post('disribute_no');
                  $update['email']=$this->input->post('email');
                  $update['mobile']=$this->input->post('mobile');
                  $update['kyc_status_personal']='submitted';
                  $update['added_on']=date('Y-m-d H:i:s');
                  $update['kyc_edited_personal']=1;
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                      
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Personal KYC Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }
         }  
     
      if(isset($_POST['identity_btn'])){
                
                $userid=$this->session->userdata('user_id');
                $this->form_validation->set_rules('select_service', 'Select Document', 'required');
                $this->form_validation->set_rules('tax_id', 'ID No', 'required');
                $params['upload_path']= 'kyc'; 
                $upload_pic=$this->upload_file->upload_image('front_image',$params);
                $upload_pic_back=$this->upload_file->upload_image('back_image',$params);
               
             if($this->form_validation->run() != False && $upload_pic['upload_error']==false  && $upload_pic_back['upload_error']==false){
                 
                  $update['front_image'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                  $update['back_image'] = base_url().'images/kyc/'.$upload_pic_back['file_name'];
                  $update['attached_doc']=$this->input->post('select_service');
                  $update['tax_id']=$this->input->post('tax_id');
                  $update['kyc_status_identity']='submitted';
                  $update['kyc_edited_identity']=1;
                  $update['added_on']=date('Y-m-d H:i:s');
                  
                 
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                      
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Identity KYC Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                    $data['upload_error']=($upload_pic_back['upload_error']==true ? $upload_pic_back['display_error'] : '');
                   
                }
         }  
        
        
         if(isset($_POST['pan_btn'])){
                
                $userid=$this->session->userdata('user_id');
              
                $this->form_validation->set_rules('pan_no', 'Pan No', 'required|callback_is_pan_valid');
                $params['upload_path']= 'kyc'; 
                $upload_pic=$this->upload_file->upload_image('front_image_pan',$params);
                if($this->form_validation->run() != False && $upload_pic['upload_error']==false){
                 
                  $update['front_image_pan'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                  $update['pan_no']=$this->input->post('pan_no');
                  $update['kyc_status_pan']='submitted';
                  $update['added_on']=date('Y-m-d H:i:s');
                  $update['kyc_edited_pan']=1;
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                      
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Pan kyc Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                    
                   
                }
         }  
         
         
      
           if(isset($_POST['bank_btn_kyc'])){
                
                $userid=$this->session->userdata('user_id');
              
                $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');  
                $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'required');  
                $this->form_validation->set_rules('account_no', 'Account Number', 'required');  
                $this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'required');  
                $this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required');
                $params['upload_path']= 'kyc'; 
                 $upload_pic_bank=$this->upload_file->upload_image('front_image_bank',$params);
                 
                if($this->form_validation->run() != False && $upload_pic['upload_error']==false){
                  
                  $update['front_image_bank'] = base_url().'images/kyc/'.$upload_pic_bank['file_name'];
                  $update['bank_name']=$this->input->post('bank_name');
                  $update['account_holder_name']=$this->input->post('account_holder_name');
                  $update['account_no']=$this->input->post('account_no');
                  $update['ifsc_code']=$this->input->post('ifsc_code');
                  $update['bank_branch']=$this->input->post('bank_branch');
                  $update['kyc_status_bank']='submitted';
                  $update['added_on']=date('Y-m-d H:i:s');
                  $update['kyc_edited_bank']=1;
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                      
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Bank KYC Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic_bank['upload_error']==true ? $upload_pic_bank['display_error'] : '');
                    
                   
                }
         }
         
          if(isset($_POST['nominee_btn'])){
                
                $userid=$this->session->userdata('user_id');
                $this->form_validation->set_rules('nominee_name', 'Nominee Name', 'required');  
                $this->form_validation->set_rules('nominee_relation', 'Nominee Relation', 'required');  
                $this->form_validation->set_rules('nominee_dob', 'Nominee DoB', 'required');
               
                if($this->form_validation->run() != False){
                  
                  $update['nominee_name']=$this->input->post('nominee_name');
                  $update['nominee_relation']=$this->input->post('nominee_relation');
                  $update['nominee_dob']=$this->input->post('nominee_dob');
                  $update['kyc_status_nominee']='submitted';
                  $update['added_on']=date('Y-m-d H:i:s');
                  $update['kyc_edited_nominee']=1;
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                      
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Nominee KYC Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }
         }  
      $this->show->user_panel('kyc/kyc_all_verified',$data);  
    }
   
   
   public  function is_pan_valid($str){
        $where = array(
            'pan_no' => $str            
        );
        $result=$this->conn->runQuery('id','user_accounts', $where);
        if($result){            
            $pan_users=$this->conn->setting('pan_users');
            if(count($result)>=$pan_users){
                  $this->form_validation->set_message('is_pan_valid', "You exceed maximum number of Pan use limit! Please Try another.");
                 return false;                
            }else{
                return true;
            }
        }else{
            return true;
        }
    }


    public function bank(){
        $data=array();
        if(isset($_POST['bank_kyc_btn'])){

            $userid=$this->session->userdata('user_id');
            $bank_details=$this->conn->runQuery('bank_kyc_status',"user_accounts","u_code='$userid' and bank_kyc_status IN ('submitted','approved')");
            if($bank_details==false){
                

                //$this->form_validation->set_rules('paytm_no', 'Paytm no', 'required|regex_match[/^[0-9]{10}$/]');
                $this->form_validation->set_rules('bank_name', 'Bank name', 'required');
                $this->form_validation->set_rules('account_holder_name', 'Account holder name', 'required');
                $this->form_validation->set_rules('account_no', 'Account no', 'required');
                $this->form_validation->set_rules('ifsc_code', 'IFSC code', 'required');

                $params['upload_path']= 'kyc';            
                        
                $upload_pic=$this->upload_file->upload_image('bank_kyc_img',$params);
                

                if($this->form_validation->run() != False && $upload_pic['upload_error']==false){


                    $update['bank_img'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                    $update['bank_name']=$this->input->post('bank_name');
                    $update['account_holder_name']=$this->input->post('account_holder_name');
                    $update['account_no']=$this->input->post('account_no');
                    $update['ifsc_code']=$this->input->post('ifsc_code');
                    $update['bank_branch']=$this->input->post('bank_branch');
                   // $update['paytm_no']=$this->input->post('paytm_no');
                   // $update['btc_address']=$this->input->post('btc_address');
                    //$update['eth_address']=$this->input->post('eth_address');
                    $update['bank_kyc_status']="submitted";
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
                        $this->session->set_flashdata("success", "Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                }
            }else{
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect(base_url(uri_string()));
            }

                        
        }

        $this->show->user_panel('kyc_bank',$data);
    }

    public function pan(){
        $data=array();
        if(isset($_POST['pan_kyc_btn'])){

            $userid=$this->session->userdata('user_id');
            $pan_details=$this->conn->runQuery('pan_kyc_status',"user_accounts","u_code='$userid' and pan_kyc_status IN ('submitted','approved')");
            if($pan_details==false){
                 
                $this->form_validation->set_rules('pan_name', 'Pan name', 'required');                 
                $this->form_validation->set_rules('pan_no', 'Pan no', 'required');               

                $params['upload_path']= 'kyc';            
                        
                $upload_pic=$this->upload_file->upload_image('pan_image',$params);
                

                if($this->form_validation->run() != False && $upload_pic['upload_error']==false){


                    $update['pan_image'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                    $update['pan_name']=$this->input->post('pan_name');
                     
                    $update['pan_no']=$this->input->post('pan_no');
                    
                    $update['pan_kyc_status']="submitted";
                    $update['pan_kyc_date']=date('Y-m-d H:i:s');

                    $userid=$this->session->userdata('user_id');
                    $pan_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                    if($pan_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                }
            }else{
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect(base_url(uri_string()));
            }

                        
        }

        $this->show->user_panel('kyc_pan',$data);
    }

    public function adhaar(){
        $data=array();
        if(isset($_POST['adhaar_kyc_btn'])){

            $userid=$this->session->userdata('user_id');
            $adhaar_details=$this->conn->runQuery('adhaar_kyc_status',"user_accounts","u_code='$userid' and adhaar_kyc_status IN ('submitted','approved')");
            if($adhaar_details==false){
                 
                $this->form_validation->set_rules('adhaar_name', 'Adhaar name', 'required');                 
                $this->form_validation->set_rules('adhaar_no', 'Adhaar no', 'required');               

                $params['upload_path']= 'kyc';            
                        
                $upload_pic=$this->upload_file->upload_image('adhaar_image',$params);
                

                if($this->form_validation->run() != False && $upload_pic['upload_error']==false){

                    $update['adhaar_image'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                    $update['adhaar_name']=$this->input->post('adhaar_name');
                     
                    $update['adhaar_no']=$this->input->post('adhaar_no');
                    
                    $update['adhaar_kyc_status']="submitted";
                    $update['adhaar_kyc_date']=date('Y-m-d H:i:s');

                    $userid=$this->session->userdata('user_id');
                    $adhaar_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                    if($adhaar_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                }
            }else{
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect(base_url(uri_string()));
            }

                        
        }

        $this->show->user_panel('kyc_adhaar',$data);
    
    }
    
    
     public function international(){
        $data=array();
        if(isset($_POST['kyc_btn'])){
           $userid=$this->session->userdata('user_id');
            /*$adhaar_details=$this->conn->runQuery('adhaar_kyc_status',"user_accounts","u_code='$userid' and adhaar_kyc_status IN ('submitted','approved')");
            if($adhaar_details==false){
                 */
               // $this->form_validation->set_rules('name', 'Adhaar name', 'required'); 
                $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');  
                $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'required');  
                $this->form_validation->set_rules('account_no', 'Account Number', 'required');  
                $this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'required');  
                $this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required');  
                
                $params['upload_path']= 'kyc'; 
                if($_POST['account_types']=='id_card'){
                    $upload_pic=$this->upload_file->upload_image('adhaar_image',$params);
                    $upload_pic_pan=$this->upload_file->upload_image('pan_image',$params);
                    $upload_pic_bank=$this->upload_file->upload_image('bank_image',$params);
                }elseif($_POST['account_types']=='pass_id'){
                    $upload_pic_pass=$this->upload_file->upload_image('pass_image',$params);
                    $upload_pic_bank=$this->upload_file->upload_image('bank_image',$params);
                }
 
                if($this->form_validation->run() != False){

                        $update['adhaar_image'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                        $update['pan_image'] = base_url().'images/kyc/'.$upload_pic_pan['file_name'];
                        $update['bank_img'] = base_url().'images/kyc/'.$upload_pic_bank['file_name'];
                        $update['passport_img'] = base_url().'images/kyc/'.$upload_pic_pass['file_name'];
                       
                        $update['adhaar_name']=$this->input->post('name');
                        $update['pan_name']=$this->input->post('name');
                        $update['adhaar_no']=$this->input->post('adhaar_no');
                        $update['pan_no']=$this->input->post('pan_no');
                        $update['passport_no']=$this->input->post('passport_no');
                        $update['account_type']=$this->input->post('account_types');
                         // Bank Detail //
                        $update['bank_name']=$this->input->post('bank_name');
                        $update['account_holder_name']=$this->input->post('account_holder_name'); 
                        $update['account_no']=$this->input->post('account_no'); 
                        $update['ifsc_code']=$this->input->post('ifsc_code'); 
                        $update['bank_branch']=$this->input->post('bank_branch'); 
                        
                        $update['adhaar_kyc_status']="submitted";
                        $update['pan_kyc_status']="submitted";
                        $update['bank_kyc_status']="submitted";
                        $update['passport_kyc_status']="submitted";
                        $update['adhaar_kyc_date']=date('Y-m-d H:i:s');
                        $update['bank_kyc_date']=date('Y-m-d H:i:s');
                        $update['pan_kyc_date']=date('Y-m-d H:i:s');
                        $update['passport_kyc_date']=date('Y-m-d H:i:s');
                      
                      
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                    $data['upload_error']=($upload_pic_pan['upload_error']==true ? $upload_pic_pan['display_error'] : '');
                    $data['upload_error']=($upload_pic_bank['upload_error']==true ? $upload_pic_bank['display_error'] : '');
                     $data['upload_error']=($upload_pic_pass['upload_error']==true ? $upload_pic_pass['display_error'] : '');
                    
                }
            /*}else{
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect(base_url(uri_string()));
            }*/

                        
        }

        $this->show->user_panel('kyc_international',$data);
    
    }
    
    
     public function veryfication(){
        
            $data=array();
         if(isset($_POST['kyc_veryfication'])){
                
                $userid=$this->session->userdata('user_id');
                $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');  
                $this->form_validation->set_rules('account_holder_name', 'Account Holder Name', 'required');  
                $this->form_validation->set_rules('account_no', 'Account Number', 'required');  
                $this->form_validation->set_rules('ifsc_code', 'Ifsc Code', 'required');  
                $this->form_validation->set_rules('bank_branch', 'Bank Branch', 'required');
                //$this->form_validation->set_rules('father_name', 'C/o', 'required');
                $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
                $this->form_validation->set_rules('address', 'Address', 'required');
                $this->form_validation->set_rules('name', 'Name', 'required');
                $this->form_validation->set_rules('id_no', 'ID No', 'required');
                $this->form_validation->set_rules('tax_id', 'Tax ID/Pan Number', 'required');
                
                $params['upload_path']= 'kyc'; 
               echo $upload_pic=$this->upload_file->upload_image('front_image',$params);
               die();
                $upload_picb=$this->upload_file->upload_image('back_image',$params);
                $upload_picu=$this->upload_file->upload_image('upload_images',$params);
                $upload_pica=$this->upload_file->upload_image('account_image',$params);
               
             if($this->form_validation->run() != False && $upload_pic['upload_error']==false && $upload_picb['upload_error']==false && $upload_picu['upload_error']==false && $upload_pica['upload_error']==false){
                 
                  $update['front_image'] = base_url().'images/kyc/'.$upload_pic['file_name'];
                  $update['back_image'] = base_url().'images/kyc/'.$upload_picb['file_name'];
                  $update['upload_images'] = base_url().'images/kyc/'.$upload_picu['file_name'];
                  $update['account_image'] = base_url().'images/kyc/'.$upload_pica['file_name'];
                  
                  $update['name']=$this->input->post('name');
                  $update['id_no']=$this->input->post('id_no');
                  //$update['father_name']=$this->input->post('father_name');
                  $update['dob']=$this->input->post('dob');
                  $update['address']=$this->input->post('address');
                  $update['bank_name']=$this->input->post('bank_name');
                  $update['account_holder_name']=$this->input->post('account_holder_name');
                  $update['account_no']=$this->input->post('account_no');
                  $update['ifsc_code']=$this->input->post('ifsc_code');
                  $update['bank_branch']=$this->input->post('bank_branch');
                  $update['tax_id']=$this->input->post('tax_id');
                  $update['kyc_status']='submitted';
                  $update['added_on']=date('Y-m-d H:i:s');
                 
                    $userid=$this->session->userdata('user_id');
                    $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
                   
                    if($kyc_details){
                        $this->db->where('u_code',$this->session->userdata('user_id'));
                        $qury=$this->db->update('user_accounts',$update);
                    }else{
                        $update['u_code']=$userid;
                        $qury=$this->db->insert('user_accounts',$update);
                       // echo $this->db->last_query();
                        //die();
                    }          

                    if($qury){                       
                        $this->session->set_flashdata("success", "Request submitted successfully.");
                        redirect(base_url(uri_string()));
                    }else{
                        
                        $this->session->set_flashdata("error", "Something Wrong.");
                        redirect(base_url(uri_string()));
                    }
                }else{
                    $data['upload_error']=($upload_pic['upload_error']==true ? $upload_pic['display_error'] : '');
                    $data['upload_error']=($upload_picb['upload_error']==true ? $upload_picb['display_error'] : '');
                    $data['upload_error']=($upload_picu['upload_error']==true ? $upload_picu['display_error'] : '');
                    $data['upload_error']=($upload_pica['upload_error']==true ? $upload_pica['display_error'] : '');
                    
                }
         }
         $this->show->user_panel('kyc_all');
     }
     
     
  }