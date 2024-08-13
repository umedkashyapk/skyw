<?php
class Orders extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){         
           // print_r($_SESSION);
           //die();  
         //    $this->show->user_panel('coming_soon'); 
        if(isset($_GET['id'])){
            $ids=$_GET['id'];  
            
            $order_details=$this->conn->runQuery('*','orders',"id='$ids' and status=1 and principal_status=1");
            //echo $this->db->last_query();
            //die();
            if($order_details){
                $amount=$order_details[0]->order_amount;
                $bonus=$order_details[0]->order_mrp-$amount;
                $u_code=$this->session->userdata('user_id');
               // die();
               //$inserttrans['wallet_type']='';
               
               /*$bank_details=$bank_details=$this->profile->my_default_account($this->session->userdata('user_id'));//$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
    			$inserttrans['bank_details']=json_encode($bank_details);
			   $inserttrans['tx_type']='principal_withdrawal';
               $inserttrans['debit_credit']="debit";             
		 	   $inserttrans['u_code']=$u_code=$this->session->userdata('user_id');
			   $inserttrans['date']=date('Y-m-d H:i:s');
			   $amnt=$amount;
			   $tx_charge=$amnt*0/100;
			   $inserttrans['amount']=$amnt-$tx_charge;
			   $inserttrans['tx_charge']=$tx_charge;
			   $inserttrans['status']=0;
			   $inserttrans['order_id']=$ids;
			   $inserttrans['remark']="Principal Withdraw  $ $amnt";

				if($this->db->insert('transaction',$inserttrans)){*/
					
					$this->db->set('status',0);
					$this->db->set('principal_status',0);
					$this->db->set('principal_date',date('Y-m-d H:i:s'));
                    $this->db->where('id',$ids);
                    $this->db->update('orders');
					
					
					
                    $order_detailsss=$this->conn->runQuery('*','orders',"u_code='$u_code' and tx_type='repurchase' and status=1 and principal_status=1");
					if(!$order_detailsss){
                        $this->db->set('principal_status',0);
                    	$this->db->where('id',$this->session->userdata('user_id'));
                    	$this->db->update('users');
                    }
                    
                    
                    $this->update_ob->add_amnt($u_code,'package_wallet',$amount);      
                    $this->update_ob->add_amnt($u_code,'self_bonus',-$bonus);      
                    
					    
					$smsg="Principal Withdrawal request success of amount  $ $amnt .";
					$this->session->set_flashdata("success", $smsg);
					redirect(base_url(uri_string()));

				/*}else{
					$this->session->set_flashdata("error", "Something wrong.");
				}*/
                
                
            }
        }
        
        if(isset($_GET['order_id'])){
            $ids=$_GET['order_id'];  
             $order_details=$this->conn->runQuery('*','orders',"id='$ids' and status=1 and principal_status=1");
            //echo $this->db->last_query();
            //die();
            if($order_details){
                $amount=$order_details[0]->order_amount;
                $bonus=$order_details[0]->order_mrp-$amount;
                $u_code=$this->session->userdata('user_id');
                
                $wallet_amt=$this->update_ob->wallet($u_code,'package_wallet');
                if($wallet_amt==$amount){
                    
                    $this->db->set('status',1);
					$this->db->set('principal_status',1);
					$this->db->set('principal_date',NULL);
                    $this->db->where('id',$ids);
                    $this->db->update('orders');
                    
                    $this->db->set('principal_status',1);
                    $this->db->where('id',$this->session->userdata('user_id'));
                    $this->db->update('users');
                    
                    $this->update_ob->add_amnt($u_code,'package_wallet',-$amount);      
                    $this->update_ob->add_amnt($u_code,'self_bonus',$bonus);      
                    
					    
					$smsg="Principal Withdrawal request reject of amount  $ $amnt .";
					$this->session->set_flashdata("success", $smsg);
					redirect(base_url(uri_string()));
                    
                    
                    
                }else{
                    	$this->session->set_flashdata("error", "Allready Take Withdrawal.");
                }
                
            }
            
        }
        
        $this->show->user_panel('order_details');
    }
    
    public function details(){
        $data['currency']=$this->config->item('currency');
        $data['order_id']=$order_id=$_REQUEST['id'];
        $data['order_details']=$order_details=$this->conn->runQuery('*','order_items',"order_id='$order_id'")[0];
        $data['cart_details']=json_decode($order_details->order_details,true);
        echo '<pre>';
        print_r($data);
        //die();
        $this->show->user_panel('order_products',$data);
    }
    public function view(){
        
        $data['vd_id']=$vd_id=$_REQUEST['id'];
       
         $this->show->user_panel('order_products',$data);
         
         
    }
     public function bill(){
        $this->show->user_panel('order_bill');
    } 
     public function gen_details(){
        $data['limit']=10;
        $data['search_string']='generation_search';
        $my_level_team = $this->team->my_generation($this->session->userdata('user_id'));
        
        
        if(!empty($my_level_team)){
            
           
            $conditions['u_code'] = $my_level_team;
            if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
                $start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
                $end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
                $where="(added_on BETWEEN '$start_date' and '$end_date')";
                $data['where'] = $where;
            }
            if(!empty($likeconditions)){
                $data['likecondition'] = $likeconditions;
            }
        
            $data['from_table']='orders';
            $data['base_url']=$this->panel_url.'/orders/gen_details';        
            $data['conditions']=$conditions;
            $res=$this->paging->searching_data($data);
            $data['table_data']=$res['table_data'];
            $data['sr_no']=$res['sr_no'];
        }else{
            $data['table_data']=false;
        }
        $this->show->user_panel('order_gen_products',$data);
    }
    
    
    
    public function team_generation(){        
        $data['limit']=10;
        $data['search_string']='generation_search'; 
        if(!$this->session->has_userdata('selected_level')){
            $this->session->set_userdata('selected_level',1);
        }
        

        if(isset($_POST['selected_level']) && $_POST['selected_level']!=''){
            $this->session->set_userdata('selected_level',$_POST['selected_level']);
        }

        $my_level_team = $this->team->my_level_team($this->session->userdata('user_id'));
        $lvl=$this->session->userdata('selected_level');
        $gen_team =  (array_key_exists($lvl,$my_level_team) ? $my_level_team[$lvl]:array());
        if(!empty($gen_team)){
            $conditions['id'] = $gen_team;
            $data['from_table']='users';
            $data['base_url']=$this->panel_url.'/team/team-generation';        
            $data['conditions']=$conditions;
            $res=$this->paging->searching_data($data);
            $data['table_data']=$res['table_data'];
            $data['sr_no']=$res['sr_no'];
        }else{
            $data['table_data']=false;
        }        
       
        $this->show->user_panel('team_generation',$data);
    }
    
    
    
    
}