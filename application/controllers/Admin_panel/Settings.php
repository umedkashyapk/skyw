<?php
class Settings extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
    }

    public function index(){
       
        $this->show->admin_panel('settings/list');
    }
    public function register(){

       
        $this->show->admin_panel('settings/register');
    }
    
    public function company(){
        
        if(isset($_POST['btn1'])){
            
          /*  $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){
              */  
                $company_name=$_POST['company_name'];
                $insert['value']=$company_name;
                $this->db->where('label','company_name');
                $this->db->update('company_info',$insert);
           // }
            
        }
        
        if(isset($_POST['btn2'])){
            
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $base_url=$_POST['base_url'];
                $insert['value']=$base_url;
                $this->db->where('label','base_url');
                $this->db->update('company_info',$insert);
            //}    
        }
        
        if(isset($_POST['btn3'])){
            
          /*  $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $param['upload_path']='logo';
                $upload_product=$this->upload_file->upload_image('logo',$param);
               if($upload_product['upload_error']==false){
                    
                    $insert['value']=base_url().'images/logo/'.$upload_product['file_name'];
                    $this->db->where('label','logo');
                    $this->db->update('company_info',$insert);
                  
                }
           // }    
        }
        
        if(isset($_POST['btn4'])){
            
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $logo_height=$_POST['logo_height'];
                $insert['value']=$logo_height;
                $this->db->where('label','logo_height');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        
        if(isset($_POST['btn5'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $logo_width=$_POST['logo_width'];
                $insert['value']=$logo_width;
                $this->db->where('label','logo_width');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
         if(isset($_POST['btn6'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $title=$_POST['title'];
                $insert['value']=$title;
                $this->db->where('label','title');
                $this->db->update('company_info',$insert);
            //}
           
        }
        
        if(isset($_POST['btn7'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_address=$_POST['company_address'];
                $insert['value']=$company_address;
                $this->db->where('label','company_address');
                $this->db->update('company_info',$insert);
         //   }    
           
        }
        
        if(isset($_POST['btn8'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_mobile=$_POST['company_mobile'];
                $insert['value']=$company_mobile;
                $this->db->where('label','company_mobile');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        if(isset($_POST['btn9'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $currency=$_POST['currency'];
                $insert['value']=$currency;
                $this->db->where('label','currency');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        if(isset($_POST['btn10'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $token_rate=$_POST['token_rate'];
                $insert['value']=$token_rate;
                $this->db->where('label','token_rate');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        if(isset($_POST['btn11'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $founder_name=$_POST['company_founder_name'];
                $insert['value']=$founder_name;
                $this->db->where('label','company_founder_name');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
         if(isset($_POST['btn12'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $founder_desgi=$_POST['company_founder_desgnation'];
                $insert['value']=$founder_desgi;
                $this->db->where('label','company_founder_desgnation');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        if(isset($_POST['btn13'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_facebook=$_POST['company_facebook_link'];
                $insert['value']=$company_facebook;
                $this->db->where('label','company_facebook_link');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        if(isset($_POST['btn14'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_twitter=$_POST['company_twitter_link'];
                $insert['value']=$company_twitter;
                $this->db->where('label','company_twitter_link');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
         if(isset($_POST['btn15'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_pinterest=$_POST['company_pinterest_link'];
                $insert['value']=$company_pinterest;
                $this->db->where('label','company_pinterest_link');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        if(isset($_POST['btn16'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_linkdin=$_POST['company_linkedin_link'];
                $insert['value']=$company_linkdin;
                $this->db->where('label','company_linkedin_link');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
         if(isset($_POST['btn17'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_telegram=$_POST['company_telegram_link'];
                $insert['value']=$company_telegram;
                $this->db->where('label','company_telegram_link');
                $this->db->update('company_info',$insert);
           // }    
           
        }
         if(isset($_POST['btn18'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_account=$_POST['company_account'];
                $insert['value']=$company_account;
                $this->db->where('label','company_account');
                $this->db->update('company_info',$insert);
           // }    
           
        }
		 if(isset($_POST['btn19'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $company_private_key=$_POST['company_private_key'];
                $insert['value']=$company_private_key;
                $this->db->where('label','company_private_key');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
         if(isset($_POST['btn20'])){
           /* $this->form_validation->set_rules('otp_input2', 'OTP', 'required|trim|callback_check_otp_valid');
            if($this->form_validation->run() != False){*/
                $cryptomailer=$_POST['cryptomailer'];
                $insert['value']=$cryptomailer;
                $this->db->where('label','mailer_username');
                $this->db->update('company_info',$insert);
           // }    
           
        }
        
        
        /*if(isset($_POST['edit_btn']){
           
                $param['upload_path']='logo';
                $upload_product=$this->upload_file->upload_image('logo',$param);
                     
                        
              
                if($upload_product['upload_error']==false){
                    $update['img']=$upload_product['file_name'];
                }
            }*/
        
        
        
        
        $this->show->admin_panel('settings/company_info');
        
    }
    
    
    
    public function edits(){
        $req_id=$_GET['req_id'];
        
        if(isset($_POST['edit_btn'])){
            $param['upload_path']='qr_code';
            $upload_product=$this->upload_file->upload_image('file',$param);
            if($upload_product['upload_error']==false){
               $insert['image']= base_url().$upload_product['full_path'];
            }
               $insert['address']=$_POST['address'];
            $this->db->where('id',$req_id);
            $this->db->update('payment_method',$insert);
           
            $this->session->set_flashdata('success',"Updated successfully.");
            redirect($_SERVER['HTTP_REFERER']);
           
        }
        
        $this->show->admin_panel('settings/setting_all',$data);
    }
    
    public function set(){
        $title=$_GET['title'];
        $data['table_data']=$this->conn->runQuery('*','advanced_info',"title='$title' and type!='not_edit' and admin_status='1'");
        $this->show->admin_panel('settings/setting_page',$data);
    }
    
    public function find(){
        $req_id=$_GET['req_id'];
        $payments=$this->conn->runQuery('*','payment_method',"id='$req_id'");
        $slugs=$payments[0]->slug;
        
        
        $data['table_data']=$this->conn->runQuery('*','payment_method',"parent_method='$slugs'");
        
        if(isset($_POST['add_btn'])){
             $this->form_validation->set_rules('name', 'Name', 'required'); 
             $this->form_validation->set_rules('address', 'Address','required'); 
            
            $param['upload_path']='qr_code';
            $upload_product=$this->upload_file->upload_image('file',$param);
            if($this->form_validation->run() != False && $upload_product['upload_error']==false){
                $str=$_POST['name'];
                $slug=str_replace(' ', '', $str);     
               $insert['image']= base_url().$upload_product['full_path'];
               $insert['address']=$_POST['address'];
               $insert['name']=$_POST['name'];
               $insert['slug']=$slug;
               $insert['parent_method']=$slugs;
               $insert['status']=1;
               
		       $this->db->insert('payment_method',$insert);
		    $this->session->set_flashdata('success',"Add successfully.");
            redirect($_SERVER['HTTP_REFERER']);
            } 
        }
        
        
        $this->show->admin_panel('settings/setting_request',$data);
    }
    
    public function set_details(){
        $label=$_POST['label'];
        //$value=$_POST['value'];
        if(is_array($_POST['value'])){
            $value=json_encode($_POST['value']);
        }else{
            $value=$_POST['value'];
        }
        
        if($value!=''){
            $this->db->set('value',$value);
            $this->db->where('admin_status',1);
            $this->db->where('label',$label);
            $this->db->update('advanced_info'); 
        }
        
        //echo 'hrer';
    }
    
    public function set_payment(){
        $label=$_POST['label'];
        //$value=$_POST['value'];
        $value=$_POST['value'];
        
        if($value!=''){
            $this->db->set('status',$value);
     
            $this->db->where('id',$label);
            $this->db->update('company_payment_methods'); 
        }
        
        //echo 'hrer';
    }
    
    
    public function set_admin_status(){
        $label=$_POST['label'];
        $value=$_POST['value'];
        
        
        if($value!=''){
            $this->db->set('admin_status',$value);
            $this->db->where('label',$label);
            $this->db->update('advanced_info'); 
        }
        
        
    }
    
    public function set_request_payment(){
         
        $label=$_POST['label'];
        //$value=$_POST['value'];
        $value=$_POST['value'];
        
        if($value!=''){
            $this->db->set('status',$value);
     
            $this->db->where('id',$label);
            $this->db->update('payment_method'); 
           // echo $this->db->last_query();
            
        }
        
        //echo 'hrer';
    }
    public function set_wallet_types(){
        
        $label=$_POST['label'];
        //$value=$_POST['value'];
        $value=$_POST['value'];
        
        if($value!=''){
            $this->db->set('closing_status',$value);
            // $data['closing_status']=$value;
            $this->db->where('id',$label);
            $this->db->update('wallet_types'); 
            // echo $this->db->last_query();
            // die();
            
        }
        
        echo 'Status Changed';
        // echo "$label<br>";
        // echo $value;
    }
    
    
    
    public function change_payment(){
        
            $this->form_validation->set_rules('method_name', 'Method Name', 'required'); 
            $this->form_validation->set_rules('unique_name', 'Unique Name','required'); 
            
            
            if($this->form_validation->run() != False ){
                  $aay=array();
                  $method=$_POST['method_name'];
                  $unique=$_POST['unique_name'];
                  $aay[$unique]=$method;
                  $fields_required=json_encode($aay);
                 
                   $insert['method_name']=$_POST['method_name'];
                   $insert['unique_name']=$_POST['unique_name'];
                   $insert['fields_required']=$fields_required;
                   $insert['status']=1;
                  
		        $this->db->insert('company_payment_methods',$insert);
		        $this->session->set_flashdata('success',"Add successfully.");
                redirect($_SERVER['HTTP_REFERER']);
            } 
        
        $this->show->admin_panel('settings/change_payment');
    }
    
    
    public function change_request_method(){
        $this->show->admin_panel('settings/change_request_method');
    }
    public function wallet_type(){
        $this->show->admin_panel('settings/wallet_type');
    }
    public function test(){
         
       $arr=array(
           'alnum' => 'Alpha-Numeric',
           'numeric' => 'Numeric Only',
           'alpha' => 'Alpha Only',
           );
           print_r(json_encode($arr));
    }
    
    public function send_otp(){ 
        $ret['error']=true;
          
                $check_username=$this->conn->runQuery('*','admin',"type='controller'");
                if($check_username){
                    $otp=random_string('numeric', 6);
                    $this->session->set_tempdata('admin_otp', $otp, 300);
                    $company_name=$this->conn->company_info('title');
                    $mobile=$check_username[0]->mobile;
                     $email=$check_username[0]->email;
                     $msg="$otp is your OTP for send $amount to $name. Team $company_name";
                    //$mobile=7827540939;
                 
                    //$this->message->sms($mobile,$msg);
                    $this->message->send_mail($email,'Profile Edit From Admin',$sms);
                    $ret['error']=false;
                    $ret['msg']="Success!. OTP has been sent to admin mobile number.";
                }else{
                    $ret['msg']="Invalid Username. Please check username.";
                }
           
            
       
        
        return print_r(json_encode($ret));
    }
    
    
    public function send_otp_edit(){ 
        $ret['error']=true;
          
                $check_username=$this->conn->runQuery('*','admin',"type='controller'");
                if($check_username){
                    $otp=random_string('numeric', 6);
                    $this->session->set_tempdata('admin_otp', $otp, 300);
                    $company_name=$this->conn->company_info('title');
                    $mobile=$check_username[0]->mobile;
                    $email=$check_username[0]->email;
                    $msg="$otp is your OTP for send $amount to $name. Team $company_name";
                    $this->message->send_mail($email,'Profile Edit From Admin',$sms);
                    $ret['error']=false;
                    $ret['msg']="Success!. OTP has been sent to admin mobile number.";
                }else{
                    $ret['msg']="Invalid Username. Please check username.";
                }
           
            
       
        
        return print_r(json_encode($ret));
    }
    
    
    
    public  function check_otp_valid($str){
        if(isset($_SESSION['admin_otp'])){
            if($_SESSION['admin_otp']==$str){
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
     
    
}