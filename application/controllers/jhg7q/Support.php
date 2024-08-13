<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Support extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }
    
    public function index(){
         $input_data = $_POST;//$this->conn->get_input();
         if(isset($input_data['u_id']) && isset($input_data['message'])){
             	
				if(isset($input_data['support_pic'])){
					$server_root = $_SERVER['DOCUMENT_ROOT']."/";
					$base64_string=$input_data['support_pic'];
					$image_name = rand(1000000,9999999).$input_data['u_id']."_paymentslip_.png";
					$payment_slip_image_path="images/users/".$image_name;
					$ifp = fopen($server_root ."images/users/".$image_name, "wb");// use your folder path
					fwrite($ifp, base64_decode(str_replace(' ', '', $base64_string)));
					fclose($ifp);					
                    $support['img']= $image_name;				
				}				
				
             	$u_id = $this->input->post('u_id');
	            $message = $this->input->post('message');         
	            $support_type = $this->input->post('support_type');         
	            $profile= $this->profile->profile_info($u_id);                
                $support['message']= $message;
                $support['first_name']=$profile->name;
                $support['u_code']=$profile->id;
                $support['email']=$profile->email;
                $support['contactno']=$profile->mobile;
                $support['type']=$support_type;
                $tk=$support['ticket']='TK'.random_string('alnum', 8);
                $support['status']=0;                
                $support['reply_status']=0;
                if($this->db->insert('support',$support)){
                    $res["res"]="success";
		            $res["message"]="Request Submitted succesfully";
                    //$this->session->set_flashdata("success", "$tk Ticket Generated successfully.");                     
                }else{
                    	$res["res"]="error";
		                $res["message"]="Error updating record, Please contact admin";
                    /*$this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));*/
                }
                
                
         }else{
                $res['res']='Error';
	            $res['message']='All parameter are required.';
         }
         
          print_r(json_encode($res));
    }
    
    public function chat_on(){
        $input_data = $_POST;//$this->conn->get_input();
        if(isset($_POST['u_id']) && isset($_POST['message']) && isset($_POST['ticket'])){
             
             	$u_id = $_POST['u_id'];
	            $message =$_POST['message'];         
	            $ticket = $_POST['ticket'];         
	            $support['message']= $message;   
	            $support['u_code']= $u_id;   
	            $support['ticket_id']= $ticket;   
               if($this->db->insert('support_chat',$support)){
                    $res["res"]="success";
		            $res["message"]="Request Submitted succesfully";
                    //$this->session->set_flashdata("success", "$tk Ticket Generated successfully.");                     
                }else{
                    	$res["res"]="error";
		                $res["message"]="Error updating record, Please contact admin";
                    /*$this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));*/
                }
                
        }else{
                $res['res']='Error';
	            $res['message']='All parameter are required.';
        }
         print_r(json_encode($res));
        
    }
    
    public function support_type(){
        $all_types = $this->conn->runQuery('type','support_type',"1=1");
        if($all_types){
                $res['res']='success';
	            $res['data'] = $all_types;
            
        }else{
                $res['res']='Error';
	            $res['message']='Data not found!.';
         }
         
         print_r(json_encode($res));
      
    }
    
    
    public function list(){
        $input_data = $_POST;//$this->conn->get_input();
        if(isset($input_data['u_id'])){
        	$u_id = $this->input->post('u_id');
        	
        	$statements = $this->conn->runQuery('*','support',"u_code='$u_id'");
        	if($statements){
        	    $statements = json_decode(json_encode($statements),true);
        	}else{
        		$statements = array();
        	}
        	//$result['sql'] = "select * from support where u_id='$u_id'";
        	$result['res'] = "success";
        	$result['message'] = "Statements fetched successfully.";
        	$result['statements'] = $statements;
        	$result['total_count'] = count($statements);
        }else{
        	$result['res'] = "error";
        	$result["message"]="All parameters are required";
        }
        
         print_r(json_encode($result));
    }
    
}