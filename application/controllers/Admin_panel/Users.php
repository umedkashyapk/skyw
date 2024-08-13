<?php
class Users extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

   
    
    public function index(){  
        
        $searchdata['from_table']='users';
		$searchdata['order_by']='id desc';
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(isset($_REQUEST['email']) && $_REQUEST['email']!=''){
            $likeconditions['email']=$_REQUEST['email'];
        }
        if(isset($_REQUEST['sponsor']) && $_REQUEST['sponsor']!=''){
            $spo=$this->profile->column_like($_REQUEST['sponsor'],'username');
            if($spo){
                $conditions['u_sponsor'] = $spo;
            }
        }
        if(isset($_REQUEST['active_status']) && $_REQUEST['active_status']!=''){
            $conditions['active_status'] = $_REQUEST['active_status'];
        }
         if(isset($_REQUEST['block_status']) && $_REQUEST['block_status']!=''){
            $conditions['block_status'] = $_REQUEST['block_status'];
        }
        
        //  if(isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']!=''){
        //     $conditions['selected_color'] = $_REQUEST['selected_color'];
        // }
         if(isset($_REQUEST['mobile']) && $_REQUEST['mobile']!=''){
            $conditions['mobile'] = $_REQUEST['mobile'];
        }
        
          if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users');
        $this->show->admin_panel('users',$data);
    
    if(isset($_REQUEST['export_to_excel'])){
           
           $get_data=$this->conn->runQuery('username,u_sponsor,name,email,mobile,country,state,city,post_code,added_on,active_date','users','1=1');          
          //print_R($get_data);
           if($get_data){
               for($f=0;$f<count($get_data);$f++){
                $dta['Username']=$get_data[$f]->username;
                $dta['Name']=$get_data[$f]->name;
                $dta['Email']=$get_data[$f]->email; 
                $dta['Mobile']=$get_data[$f]->mobile;
                $dta['Country']=$get_data[$f]->country;
                $dta['State']=$get_data[$f]->state;
                $dta['Post_code']=$get_data[$f]->post_code;
                $dta['My Package']=$get_data[$f]->my_package;
                $dta['My Rank']=$get_data[$f]->my_rank;
                $dta['Joining Date']=$get_data[$f]->added_on;
                $dta['Activation Date']=$get_data[$f]->active_date;
                $user_sponsor= $get_data[$f]->u_sponsor;
                $sponsor_info=$this->conn->runQuery('name,username','users',"id='$user_sponsor'");
                 if($sponsor_info){
                
                $dp_name=$sponsor_info[0]->name;
                $db_username=$sponsor_info[0]->username;
                 }else{
                    $dp_name=""; 
                    $db_username="";
                 }
                 $dta['Sponsor Name']=$dp_name;
                 $dta['Sponsor Username ']=$db_username;
                $exdataval[$f]=$dta;
               }
           }
             
            $this->export->export_to_excel($exdataval);

        }    
        
    } 
    
    
    public function edit(){
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_edit_user',$_REQUEST['id']);
        }
        $edit_user=$this->session->userdata('admin_edit_user');
         
        if(isset($_POST['edit_btn'])){
            
             $admin_edit_profile_with_otp=$this->conn->setting('admin_edit_profile_with_otp');
            if($admin_edit_profile_with_otp=='yes'){
                $this->form_validation->set_rules('otp_input', 'OTP', 'required|trim|callback_check_otp_valid');
                
            }
            
           // if($this->form_validation->run() != False){
            $update['name']=$this->input->post('name');
            $update['email']=$this->input->post('email');
            $update['mobile']=$this->input->post('mobile');
            // $update['subcription_date']=$this->input->post('subscription_date');
            // $update['selected_color']=$this->input->post('selected_color');
             
            $update['block_status']=$this->input->post('input_block');
            $update['admin_register_status']=$this->input->post('input_register_block');
            $my_rankss=$this->input->post('my_rank');
            
            $ranks_detail=$this->conn->runQuery('','plan',"rank='$my_rankss'");  
            if($ranks_detail){
                $rank_income=$ranks_detail[0]->rank_income;
                $rank_id=$ranks_detail[0]->id;
                $update['my_rank']=$this->input->post('my_rank');
                $update['rank_id']=$rank_id;
                $update['rank_per']=$rank_income;
                $update['current_rank_id']=$rank_id;
            }
            $this->db->where('id',$edit_user);
            if($this->db->update('users',$update)){                
                $this->session->set_flashdata("success", "Profile Updated successfully.");
                redirect(base_url(uri_string()));
            }else{                
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect(base_url(uri_string()));
            } 
          //}
        }


        if(isset($_POST['edit_bank_btn'])){
            $update['bank_name']=$this->input->post('bank_name');
            $update['account_holder_name']=$this->input->post('account_holder_name');
            $update['account_no']=$this->input->post('account_no');
            $update['ifsc_code']=$this->input->post('ifsc_code');
            $update['bank_branch']=$this->input->post('bank_branch');
            $update['btc_address']=$this->input->post('btc_address');
            $update['eth_address']=$this->input->post('eth_address');
            $update['tron_address']=$this->input->post('tron_address');

            $userid=$edit_user;
            $bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
            if($bank_details){
                $this->db->where('u_code',$userid);
                $qury=$this->db->update('user_accounts',$update);
            }else{
                $update['u_code']=$userid;
                $qury=$this->db->insert('user_accounts',$update);
            }          

            if($qury){               
                $this->session->set_flashdata("success", "Profile Updated successfully.");
                redirect(base_url(uri_string()));
            }else{
                
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect(base_url(uri_string()));
            }             
        }
        if(isset($_POST['set_pass_btn'])){
             $this->form_validation->set_rules('u_password', 'Password', 'required');
            
            if($this->form_validation->run() != False){
                $update=array();
                $update['password']=md5($this->input->post('u_password'));
                
                $this->db->where('id',$edit_user);
                if($this->db->update('users',$update)){                
                    $this->session->set_flashdata("success", "Password Updated successfully.");
                    redirect(base_url(uri_string()));
                }else{                
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }
                        
        }
        
        if(isset($_POST['set_pass_tx_btn'])){
             $this->form_validation->set_rules('tx_u_password', 'Tx Password', 'required');
            
            if($this->form_validation->run() != False){
                $update=array();
                $update['tx_password']=md5($this->input->post('tx_u_password'));
                
                $this->db->where('id',$edit_user);
                if($this->db->update('users',$update)){                
                    $this->session->set_flashdata("success", "Transaction Password Updated successfully.");
                    redirect(base_url(uri_string()));
                }else{                
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }
                        
        }
        
        if(isset($_POST['change_sp_btn'])){
           
            $this->form_validation->set_rules('sponsor', 'Sponsor', 'required|callback_valid_username');
           
            if($this->form_validation->run() != False){
               
                 $sponsor_user=$this->input->post('sponsor');
               
                $check_username=$this->conn->runQuery("u_sponsor",'users',"id='$edit_user'");
                $old_spo=$check_username[0]->u_sponsor;
                
                $tx_u_code=$this->profile->id_by_username($sponsor_user);
               
                $update=array();
                $update['u_sponsor']=$tx_u_code;
                $this->db->where('id',$edit_user);
               if($this->db->update('users',$update)){ 
                /* echo  $this->db->last_query();
                 die();*/
                ////////////////////////////////generation update/////////////////////////////////////////////
                
            $total_actives=$this->team->actives();        
         
      
            echo $userid=$tx_u_code;//$user_details->id;
            ////////////////////////////////////
            $actives=$this->team->my_inactives($userid);
                             
            $toatl_active=$actives!='' ? COUNT($actives) : 0;                         
            //$slug="inactive_directs";
            $this->update_ob->any_update($userid,'inactive_directs',$toatl_active); 
            /////////////////////////////////////////
            
             $all_directs=$this->team->directs($userid);
             $toatl_direct=$all_directs!='' ? COUNT($all_directs) : 0;                         
             //$slug="total_directs";
             $this->update_ob->any_update($userid,'total_directs',$toatl_direct);   
            
            ///////////////////////////////////////////////////////////
            $actives_direct=$this->team->my_actives($userid);
            $toatl_active_direct=$actives_direct!='' ? COUNT($actives_direct) : 0;                         
              // $slug="active_directs";
            $this->update_ob->any_update($userid,'active_directs',$toatl_active_direct);
            
            //////////////////////////////////////////////////////////////
            
            
            $my_actives=$this->team->my_generation($userid);
            $active_left_team= array_intersect($total_actives, $my_actives);
            $toatl_active_gen=$active_left_team!='' ? COUNT($active_left_team) : 0;                     
            $this->update_ob->any_update($userid,'active_gen',$toatl_active_gen);
            
            /////////////////////////////////////////////////////////////////
            
            $toatl_gen=$my_actives!='' ? COUNT($my_actives) : 0;                     
            $this->update_ob->any_update($userid,'total_gen',$toatl_gen);
            
            /////////////////////////////////////////////////////////////
       
                
            
            ////////////old sponsor update////////////////////////
            $actives_old=$this->team->my_inactives($old_spo);
                             
            $toatl_active_old=$actives_old!='' ? COUNT($actives_old) : 0;                         
            //$slug="inactive_directs";
            $this->update_ob->any_update($old_spo,'inactive_directs',$toatl_active_old); 
            /////////////////////////////////////////
            
             $all_directs_old=$this->team->directs($old_spo);
             $toatl_direct_old=$all_directs_old!='' ? COUNT($all_directs_old) : 0;                         
             //$slug="total_directs";
             $this->update_ob->any_update($old_spo,'total_directs',$toatl_direct_old); 
            /* echo $this->db->last_query();
             die();*/
            
            ///////////////////////////////////////////////////////////
            $actives_direct_old=$this->team->my_actives($old_spo);
            $toatl_active_direct_old=$actives_direct_old!='' ? COUNT($actives_direct_old) : 0;                         
              // $slug="active_directs";
            $this->update_ob->any_update($old_spo,'active_directs',$toatl_active_direct_old);
            
            //////////////////////////////////////////////////////////////
            
            
            $my_actives_old=$this->team->my_generation($old_spo);
            $active_left_team_old= array_intersect($total_actives, $my_actives_old);
            $toatl_active_gen_old=$active_left_team_old!='' ? COUNT($active_left_team_old) : 0;                     
            $this->update_ob->any_update($old_spo,'active_gen',$toatl_active_gen_old);
            
            /////////////////////////////////////////////////////////////////
            
            $toatl_gen_old=$my_actives_old!='' ? COUNT($my_actives_old) : 0;                     
            $this->update_ob->any_update($old_spo,'total_gen',$toatl_gen_old);
            
            /////////////////////////////////////////////////////////////    
                
             ////////////////////////////////generation update/////////////////////////////////////////////    
            $update11['u_code']=$edit_user;
            $update11['new_sp']=$tx_u_code;
            $update11['old_sp']=$old_spo;
            $qury11=$this->db->insert('sponsor_update',$update11);
                
                
                
                    $this->session->set_flashdata("success", "Sponsor Updated successfully.");
                    redirect(base_url(uri_string()));
                }else{                
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }
                        
        }

        $data['edit_user']=$edit_user;
        //$data['profile']=$this->profile->profile_info($edit_user);
        $this->show->admin_panel('user_edit',$data);
    }
    
     public function change_password(){

        if(isset($_POST['set_pass_btn'])){

            $this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_check_old_password');
            $this->form_validation->set_rules('u_password', 'Password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[u_password]'); 
            if($this->form_validation->run() != False){
                $update['password']=md5($this->input->post('u_password'));
                $typ='controller';
                $this->db->where('type',$typ);
                if($this->db->update('admin',$update)){
                    $this->session->set_userdata('profile', $this->profile->profile_info($this->session->userdata('user_id')));
                    $this->session->set_flashdata("success", "Password successfully changed.");
                    redirect(base_url(uri_string()));
                }else{                    
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }
            }                        
        }

        $this->show->admin_panel('user_admin_password');
    }

        public  function check_old_password($str){
            $pass=md5($str);
            $check=$this->conn->runQuery('*','admin',"type='controller' and password='$pass'");
           
        if($check){
            return true;
        }else{
              $this->form_validation->set_message('check_old_password', "Old password not match! Please Try again.");
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
    public function verify_franchise(){
        $username=$_POST['username'];
        $ret['error']=true;
        if($username!=''){
            $check=$this->conn->runQuery('id,name','franchise_users',"username='$username'");
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

    public function login(){
        $id=$_REQUEST['user'];
        $this->session->set_userdata("user_login", true);                            
        $this->session->set_userdata("user_id", $id);                            
        $this->session->set_userdata("profile", $this->profile->profile_info($id));
        redirect(base_url($this->conn->company_info('panel_path')."/dashboard"), "refresh");
    }
    
     public function auto_register(){
        if(isset($_POST['add_btn'])){
                $sponsor=$this->input->post('sponsor_name');
                $find_sp=$this->profile->id_by_username($sponsor);
                if($find_sp!=''){
                    
                    $total_entry=$this->input->post('total_entry');
                    if($total_entry<=50){
                    
                        $update1['value']=$find_sp;
                        $this->db->where('label',"auto_sponsor_id");
                        $this->db->update('advanced_info',$update1);
                        
                        $update5['value']=$this->input->post('total_entry');
                        $this->db->where('label',"auto_register_entry");
                        $this->db->update('advanced_info',$update5);
                        
                        $update2['value']=$this->input->post('name');
                        $this->db->where('label',"auto_name");
                        $this->db->update('advanced_info',$update2);
                        
                        $update3['value']=$this->input->post('email');
                        $this->db->where('label',"auto_email");
                        $this->db->update('advanced_info',$update3);
                        
                        $update4['value']=$this->input->post('mobile');
                        $this->db->where('label',"auto_mobile");
                        $this->db->update('advanced_info',$update4);
                        
                        $update5['value']=$this->input->post('total_entry');
                        $this->db->where('label',"auto_register_entry");
                        $this->db->update('advanced_info',$update5);
                        
                        $update6['value']=$this->input->post('auto_register_status');
                        $this->db->where('label',"auto_register_enable");
                        $this->db->update('advanced_info',$update6);
                        
                        $update7['value']=$this->input->post('auto_id');
                        $this->db->where('label',"auto_id");
                        $this->db->update('advanced_info',$update7);
                    }else{
                        
                        $this->session->set_flashdata("error", "Maximum 50 Total Entry Only.");
                        redirect(base_url(uri_string()));
                        
                    }
                }else{
                    
                    $this->session->set_flashdata("error", "Sponsor Invalid.");
                    redirect(base_url(uri_string()));
                    
                } 
            }
            $this->show->admin_panel('user_auto_register');
            
     }
        public function database_function(){
        
            $this->load->dbutil();
            $db_format=array('format'=>'zip','filename'=>'unniserv_demo_new_backup.sql');
            $backup=& $this->dbutil->backup($db_format);
            $dbname='backup-on-'.date('d-m-y H:i').'.zip';
            $save='assets/db_backup/'.$dbname;
            write_file($save,$backup);
            force_download($dbname,$backup);
          
        
    }
     
         public function captcha(){
     
         $this->load->helper('captcha');
         $files = glob('./images/*');
         foreach($files as $file){ 
            if(is_file($file))
                unlink($file); 
            }
        $captcha_array= array(
       
          'img_path'=>APPPATH.'../images/',
          'img_url'=>base_url().'images/',
          'img_width'=>'150',
          'img_height'=>50,
          'font_size'=>400,
          'word'=>rand('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz'),
         
          'colors'=>array(
           'background'=>array(255,256,555),
          'boarder'=>array(252,226,535),
          'text'=>array(115,236,445),
          'grid'=>array(30,50,578)
               
          )
       
       );
      
      $data['captcha1']=$datad=create_captcha($captcha_array);
   
     if(isset($_POST['captcha_btn'])){
       
         $this->form_validation->set_rules('captcha','Captcha','required');
       
     if($this->form_validation->run() != False){
          $enter_captcha=$_POST['captcha'];
          $valid_captcha=$_POST['captcha1'];
       
         if($enter_captcha==$valid_captcha){
         redirect(base_url($this->conn->company_info('admin_path')."/users/database"), "refresh");
        
        }else{
         $this->session->set_flashdata('error',"Please Enter valid Captcha"); 
     
            }
        }
    }
   
           $this->show->admin_panel('captcha',$data);
          
      }  
    
    public function database(){
        $this->show->admin_panel("database_backup");
    }
    
     public function reward(){
        $searchdata['from_table']='rank'; 
         
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
        
         if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users/reward'); 
         
            
        $this->show->admin_panel('user_royalty',$data);    
        
        
    }
    
    public function rank_bonaza(){
          $searchdata['from_table']='rank_bonanza'; 
         
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
        
        
         if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users/rank_bonaza'); 
         
       
       
        $this->show->admin_panel('rank_bonaza',$data);    
        
    }
    
    
    public function from_active(){
        $conditions['tx_type']=['topup'];
        $searchdata['from_table']='transaction'; 
         
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
        
        
         if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users/from-active'); 
         
            
        $this->show->admin_panel('user_from_active',$data);    
        
        
    }
    
     public function user_wallet_report(){
        $searchdata['search_string']='user_wallet_search';       
        
        $searchdata['from_table']='user_wallets'; 
        // $whr="tx_type='transfer' or tx_type='convert_recieve' and u_code='$codes'";      
  
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
         //$searchdata['order_by']='added_on DESC';
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users/user_wallet_report'); 
         
            
        $this->show->admin_panel('user_wallet_report_new',$data);
              
    }
    
     public function valid_username($str){
        $check_username=$this->conn->runQuery("id",'users',"username='$str'");
        if($check_username){
            return true;
        }else{
              $this->form_validation->set_message('valid_username', "Invalid Username! Please check username.");
               return false;
        }
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
	
	
	
	public function ranks(){  
	    
        $where = "my_rank IS NOT NULL and my_rank!='STATAR'";
        $searchdata['from_table']='users';
        $searchdata['where']=$where;
        
		if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(isset($_REQUEST['rank']) && $_REQUEST['rank']!=''){
            $likeconditions['my_rank']=$_REQUEST['rank'];
        }
        
        
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/users/ranks');
        $this->show->admin_panel('users_ranks',$data);
    
   
        
    } 
    
    
    
    
   public function check_email(){  
        echo $this->message->send_mail('nk95326@gmail.com','hello','test','1');
       
       
   }
    
    
    
    
    
    
}