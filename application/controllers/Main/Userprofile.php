<?php
class Userprofile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){ 
		
		if(isset($_POST['mobile_update'])){
			 $update['mobile']=$_POST['mobile'];
			 $user_id=$_POST['u_ser_id'];
			
			$this->db->where('u_code',$user_id);
			$this->db->update('users_info',$update);
			
		}
        
         $this->load->view('Main/pages/userprofile.php');
       
    }
}