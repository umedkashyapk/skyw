<?php
class Task extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->panel_url=$this->conn->company_info('panel_path');
    }

    public function index(){         
           // print_r($_SESSION);
           //die();  
         //    $this->show->user_panel('coming_soon'); 
     // $this->show->user_panel('index');
    }
  
    
    
    /*public function all(){
        $data['limit']=10;
        $data['search_string']='all_search';
        $data['from_table']='task_data';
        $data['base_url']=$this->panel_url.'/task/all';
        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];
        $data['sr_no']=$res['sr_no'];
        $this->show->user_panel('task_all',$data);
    }
    */
    public function all(){
       
        $this->show->user_panel('task_all');
    }
    
    public function view(){
        
          $data['task_id']=$_GET['id'];
         
          $this->show->user_panel('task_view',$data);
    }
    
     public function view_product(){
         $data['task_id']=$_GET['id'];
         $this->show->user_panel('task_view_product',$data);
    }
    
    
    
    
    
    public function add_view(){
        
        $usrId=$this->session->userdata('user_id');
         $task_id=$_POST['task'];
        
        $task_history_exist=$this->conn->runQuery('*','task_history',"u_id='$usrId' and task_id='$task_id'");
        if($task_history_exist){
           
        }else{
           
        $insert['u_id']=$usrId;
        $insert['task_id']=$_POST['task'];
        $insert['added_on']=date('Y-m-d H:i:s');
        $this->db->insert('task_history',$insert);
        
        $table_data=$this->conn->runQuery('*','task_data',"status=1 and id='$task_id'");
        $payable=3;//$table_data[0]->task_amount;
        ////////////////income///////////////////////
        $source="ads";
        
        $profile_info=$this->profile->profile_info($usrId,'name,username,retopup_status');
        $name=$profile_info->name;
        $username=$profile_info->username;
        
        $my_Act=$this->team->my_actives($usrId);
        $my_all_actives=COUNT($my_Act);
        if($my_all_actives>=1){
            $sts="1";
        }else{
            $sts="0";
        } 
        
        $get_amnt=$this->conn->runQuery('amount as ttl','transaction',"u_code='$usrId' and tx_type='income'")[0]->ttl;
        if($get_amnt>=5000){
            if($profile_info->retopup_status==1){
                $inc_st=1;
            }else{
                $inc_st=0;
            }
        }else{
            $inc_st=1;
        }
        
        /*if($inc_st==1){
            $check_task=$this->conn->runQuery('u_code','transaction',"source='$source' and u_code='$usrId' and tx_record='$task_id'");
            if(!$check_rank_){
                $income['u_code']=$usrId;
                $income['tx_type']='income';
                $income['source']=$source;
                $income['debit_credit']='credit';
                $income['amount']=$payable;
                $income['date']=date('Y-m-d H:i:s');
                $income['status']=$sts;
                $income['tx_record']=$task_id;
                $income['remark']="Recieve $source income of amount $payable from $name ($username) from task $task_id";
                $this->db->insert('transaction',$income);
                
               
                if($sts==1){
                    $this->update_ob->add_amnt($usrId,$source,$payable);
                    $this->update_ob->add_amnt($usrId,'ads_wallet',$payable);
                   
                }
            }
        }
        */
    }
    
    
    }
    
    
    
    
    
    public function ads_request(){
         if(isset($_POST['buy_btn'])){
            
           
            // $params['upload_path']= 'task'; 
            // $upload_pic=$this->upload_file->upload_image('task_image',$params);
           
            
            // if($this->form_validation->run() != False  && $upload_pic['upload_error']==false){
                
                $user_id=$this->session->userdata('user_id');
                $taskAdd['product_description']=$_POST['product_description'];
                $taskAdd['product_mrp']=$_POST['product_mrp'];
                $taskAdd['product_name']=$_POST['product_name'];
                //$taskAdd['heading1']=$_POST['task_name'];
                $taskAdd['task_id']=$_POST['watch_id'];
                $taskAdd['u_code']=$user_id;
                
                $taskAdd['req_status']='0';
                $taskAdd['type']='watch_ads';
                $taskAdd['added_on']=date('Y-m-d H:i:s');
                $taskAdd['task_image'] = base_url().'images/task/'.$upload_pic['file_name'];
                $this->db->insert('task_data_request',$taskAdd);
              
                $smsg="Product Request added successfully.";
                $this->session->set_flashdata("success", $smsg);
                redirect($_SERVER["HTTP_REFERER"]);
           // }
        }
        
        
        
    }
    
    
     public function request_history(){
        $data=array();
        $limit=$this->limit=10;
        
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $data['from_table']='task_data_request';
        $data['base_url']=$base_url=base_url().$this->panel_url.'/task/request_history';  
        $conditions['type']='watch_ads';
        
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
       
          
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $data['where']="date>='".$_REQUEST['start_date']."' and date<='".$_REQUEST['end_date']."'";
        }
        if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }
        
        $data['conditions']=$conditions;
        $data = $this->paging->search_response($data,$limit,$base_url);
        
        $data['base_url']=$base_url;
        
        $this->show->user_panel('task_request_history',$data);
        
    }
    
    
     public function payment(){
        $task_id=$_GET['id'];
        $data['task_id']=$task_id;
        
        if(isset($_POST['pay_btn'])){
           
            $this->form_validation->set_rules('amount', 'Amount', 'required');     
            $payment_type=$_POST['payment_type'];
            if($payment_type=="main_wallet"){
                   $this->form_validation->set_rules('amount', 'Wallet', 'required|callback_check_main_wallet_balance');
                   $params['upload_path']= 'payment_slip'; 
                   $upload_pic=$this->upload_file->upload_image('pay_slip',$params); 
             }else if($payment_type=="upi"){
                
                   $params['upload_path']= 'payment_slip'; 
                   $upload_pic=$this->upload_file->upload_image('pay_slip',$params);   
            }
            if($this->form_validation->run() != False){
                if($payment_type=="main_wallet"){
                    $userid=$this->session->userdata('user_id');
                   	$payment_type=$_POST['payment_type'];
                    $crncy=$this->conn->company_info('currency');
					$profile=$this->session->userdata('profile');
					$username=$profile->username;
					$name=$profile->name;
                   $payment_id=$_POST['payment_id'];
				   $inserttrans['wallet_type']='main_wallet';
				   $inserttrans['payment_type']=$payment_type;
				   $inserttrans['tx_type']='watch_ads';
                   $inserttrans['debit_credit']="debit";             
			 	   $inserttrans['u_code']=$this->session->userdata('user_id');
				   $inserttrans['date']=date('Y-m-d H:i:s');
				   $amnt=abs($_POST['amount']);
				   $tx_charge=$amnt*5/100;
				   $inserttrans['amount']=$amnt-$tx_charge;
				   $inserttrans['tx_charge']=$tx_charge;
				   $inserttrans['status']=0;
				   $inserttrans['payment_id']=$payment_id;
				   $inserttrans['open_wallet']=$this->update_ob->wallet($this->session->userdata('user_id'),'main_wallet');
				   $inserttrans['closing_wallet']=$inserttrans['open_wallet']-$inserttrans['amount'];
				   $inserttrans['remark']="$name ($username) Payment  $crncy $amnt";
                 
					if($this->db->insert('transaction',$inserttrans)){
					    $this->update_ob->add_amnt($userid,'main_wallet',-$amnt);
					   // $update['req_status']='2';
					   // $this->db->where('u_code',$this->session->userdata('user_id'));
        //                 $qury=$this->db->update('task_data_request',$update);
					    $smsg="Payment request success of amount  $crncy $amnt .";
						$this->session->set_flashdata("success", $smsg);
						 redirect($_SERVER["HTTP_REFERER"]);

					}else{
						$this->session->set_flashdata("error", "Something wrong.");
					}
					
                }elseif($payment_type=="upi"){
                  
                  	$userid=$this->session->userdata('user_id');
                    $crncy=$this->conn->company_info('currency');
					$profile=$this->session->userdata('profile');
					$username=$profile->username;
					$name=$profile->name;
                   $payment_id=$_POST['payment_id'];
                   $inserttrans['payment_type']=$payment_type;
				   $inserttrans['tx_type']='watch_ads';
                   $inserttrans['debit_credit']="debit";             
			 	   $inserttrans['u_code']=$this->session->userdata('user_id');
				   $inserttrans['date']=date('Y-m-d H:i:s');
				   $amnt=abs($_POST['amount']);
				   $tx_charge=$amnt*0/100;
				   $inserttrans['amount']=$amnt-$tx_charge;
				   $inserttrans['tx_charge']=$tx_charge;
				   $inserttrans['status']=0;
				   $inserttrans['payment_id']=$payment_id;
				   $inserttrans['payment_slip'] = base_url().'images/payment_slip/'.$upload_pic['file_name'];
				   $inserttrans['remark']="$name ($username) Payment  $crncy $amnt";
                 
					if($this->db->insert('transaction',$inserttrans)){
					   // $this->db->where('u_code',$this->session->userdata('user_id'));
					   // $update['req_status']='2';
        //                 $qury=$this->db->update('task_data_request',$update);
					    $smsg="Payment request success of amount  $crncy $amnt .";
						$this->session->set_flashdata("success", $smsg);
					    redirect($_SERVER["HTTP_REFERER"]);

					}else{
						$this->session->set_flashdata("error", "Something wrong.");
					}
                    
                    
                }
               
               
            }
            
           
        }
        
        
        
        $this->show->user_panel('task_payment_view',$data); 
           
     }
    
    
     public function check_main_wallet_balance($str){
        $wlt=$_POST['payment_type'];
       // $amt=$_POST['amount'];
        $balance=$this->update_ob->wallet($this->session->userdata('user_id'),$wlt);  
        if($balance>=$str){
            
            return true;
        }else{
            
            $this->form_validation->set_message('check_main_wallet_balance', "Insufficient Fund in wallet.");
            
            return false;
            
        }
    }
    
}