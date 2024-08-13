<?php
class Order extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->panel_url=$this->admin_url=$this->conn->company_info('admin_path');
         $this->limit=10;
    }

    public function index(){
        
         if(isset($_REQUEST['export_to_excel'])){
          
           $whr="tx_type='purchase'";
           $get_data=$this->conn->runQuery('*','orders', $whr );  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $order_status= $get_data[$f]->status;
                if($order_status=='1'){
                    $st="Success";
                }else{ 
                    $st="Pending";
                }
                $dta['USERID(NAME)']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Activation ID']=$get_data[$f]->id;
                $dta['Activation  AMOUNT']=$get_data[$f]->order_amount;
                $dta['PAYMENT STATUS']=$st;
                $dta['DATE']=$get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
         $searchdata['from_table']='orders'; 
         //$conditions['tx_type']='purchase'; 
         $conditions['status<=']='1'; 
        
        
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $spo=$this->profile->column_like($_REQUEST['username'],'username'); 
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
           
        } 
         
        if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
            $likeconditions['id']=$_REQUEST['id'];
        }
       
        if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']!=''){
            $conditions['status'] = $_REQUEST['payment_status'];
        }
        
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(added_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/order'); 
       
        $data['statusPyament']=$_REQUEST['payment_status'];
        $this->show->admin_panel('order_all',$data);    
        
        
    }
    
    
     public function repurchase(){
        
         if(isset($_REQUEST['export_to_excel'])){
          
           $whr="tx_type='repurchase'";
           $get_data=$this->conn->runQuery('*','orders', $whr);  
         
           if($get_data){
                
               for($f=0;$f<count($get_data);$f++){
                $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                $order_status= $get_data[$f]->status;
                if($order_status=='1'){
                    $st="Success";
                }else{ 
                    $st="Pending";
                }
                $dta['USERID(NAME)']=$tx_profile->username.'( '.$tx_profile->name.')';
                $dta['Staking ID']=$get_data[$f]->id;
                $dta['Staking  AMOUNT']=$get_data[$f]->order_amount;
                $dta['PAYMENT STATUS']=$st;
                $dta['DATE']=$get_data[$f]->added_on;
                $exdataval[$f]=$dta;

               }
           }
             
            $this->export->export_to_excel($exdataval);

        }
         $searchdata['from_table']='orders'; 
         $conditions['tx_type']='repurchase'; 
         $conditions['status<=']='1'; 
        
        
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $spo=$this->profile->column_like($_REQUEST['username'],'username'); 
            
            if($spo){
                $conditions['u_code'] = $spo;
            }
           
        } 
         
        if(isset($_REQUEST['id']) && $_REQUEST['id']!=''){
            $likeconditions['id']=$_REQUEST['id'];
        }
       
        if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']!=''){
            $conditions['status'] = $_REQUEST['payment_status'];
        }
        
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(added_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/order/repurchase'); 
         
        $data['statusPyament']=$_REQUEST['payment_status'];
        $this->show->admin_panel('order_all_repurchase',$data);    
       }
    
    public function delete(){
        $order_id=$_GET['id'];
        $this->db->where('id',$order_id);
        $this->db->delete('orders');
        
        $this->db->where('order_id',$order_id);
        $this->db->delete('order_items');
        
        $smsg="Order Deleted Successfully.";
        $this->session->set_flashdata("success", $smsg);
        redirect(base_url($this->panel_url.'/order'));
    }
    
    
    public function view(){
        
        $vd_id=$_REQUEST['id'];
        //$data['order_details']=$order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
        $date=date('Y-m-d H:i:s');
         
            if(isset($_POST['approve_btn'])){
               $order_status=$_POST['order_status'];
                if($order_detailsp['status']!=$order_status){
                    $payment_status=$_POST['payment_status'];
                    
                    
                    $this->db->set('payment_status',$payment_status);
                    $this->db->set('status',$order_status);
                    $date_column=$this->order->date_column($order_status);
                    $this->db->set($date_column,$date);
                    $this->db->where('id',$vd_id);
                    $this->db->update('orders');
                }
                
                $smsg=" Data Updated Successfully.";
                $this->session->set_flashdata("success", $smsg);
                redirect(base_url($this->panel_url.'/order/view?id='.$vd_id));
            }
         $data['vd_id']=$vd_id;
         $this->show->admin_panel('order_view',$data);
         
    }
    
    public function capping_edit(){
        
        $vd_id=$_REQUEST['id'];
        //$data['order_details']=$order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
        $date=date('Y-m-d H:i:s');
         
            if(isset($_POST['approve_btn'])){
               $order_status=$_POST['order_status'];
                
                    $capping=$_POST['capping'];
                    
                    
                    $this->db->set('order_capping',$capping);
                    $this->db->set('status',$order_status);
                    $date_column=$this->order->date_column($order_status);
                    $this->db->set($date_column,$date);
                    $this->db->where('id',$vd_id);
                    $this->db->update('orders');
              
                
                $smsg=" Data Updated Successfully.";
                $this->session->set_flashdata("success", $smsg);
                redirect(base_url($this->panel_url.'/order/capping_edit?id='.$vd_id));
            }
         $data['vd_id']=$vd_id;
         $this->show->admin_panel('order_capping',$data);
         
    }
    
    public function view_repurchse(){
        
        $vd_id=$_REQUEST['id'];
        //$data['order_details']=$order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
        $date=date('Y-m-d H:i:s');
         
            if(isset($_POST['approve_btn'])){
                
                $order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
                $codes=$order_details->u_code;
                /*$order_status=$_POST['order_status'];
                if($order_detailsp['status']!=$order_status){
                    $payment_status=$_POST['payment_status'];*/
                    
                   /* $this->db->set('payment_status',$payment_status);
                    $this->db->set('status',$order_status);
                    $date_column=$this->order->date_column($order_status);
                    $this->db->set($date_column,$date);*/
                    $oder_amounts=$_POST['order_amount'];
                    $order_bonus=$_POST['order_bonus'];
                    $total_bonusss=$oder_amounts+$order_bonus;
                    $this->db->set('order_bv',$oder_amounts);
                    $this->db->set('order_amount',$oder_amounts);
                    $this->db->set('order_mrp',$total_bonusss);
                    $this->db->set('is_admin_change',1);
                    $this->db->where('id',$vd_id);
                    $this->db->update('orders');
                    
                    $this->update_ob->add_amnt($codes,'self_bonus',-$order_bonus);
                /*}*/
                
                $smsg=" Data Updated Successfully.";
                $this->session->set_flashdata("success", $smsg);
                redirect(base_url($this->panel_url.'/order/view_repurchse?id='.$vd_id));
            }
         $data['vd_id']=$vd_id;
         $this->show->admin_panel('order_view_repurchse',$data);
         
    }
    public function capping_view_repurchse(){
        
        $vd_id=$_REQUEST['id'];
        //$data['order_details']=$order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
        $date=date('Y-m-d H:i:s');
         
            if(isset($_POST['approve_btn'])){
                
                $order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
                $codes=$order_details->u_code;
                    $order_status=$_POST['order_status'];
                    $oder_amounts=$_POST['order_amount'];
                    $order_bonus=$_POST['order_bonus'];
                     $capping=$_POST['capping'];
                    
                    
                    $total_bonusss=$oder_amounts+$order_bonus;
                    $this->db->set('order_capping',$capping);
                    $this->db->set('status',$order_status);
                    $this->db->set('order_bv',$oder_amounts);
                    $this->db->set('order_amount',$oder_amounts);
                    $this->db->set('order_mrp',$total_bonusss);
                    $this->db->set('is_admin_change',1);
                    $this->db->where('id',$vd_id);
                    $this->db->update('orders');
                    
                    $this->update_ob->add_amnt($codes,'self_bonus',-$order_bonus);
                /*}*/
                
                $smsg=" Data Updated Successfully.";
                $this->session->set_flashdata("success", $smsg);
                redirect(base_url($this->panel_url.'/order/capping_view_repurchse?id='.$vd_id));
            }
         $data['vd_id']=$vd_id;
         $this->show->admin_panel('order_capping_repurchse',$data);
         
    }
    
    
    public function gst_report(){
        $searchdata['from_table']='orders'; 
        
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
        
         if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
         $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/order/gst-report'); 
         $this->show->admin_panel('gst_report',$data);
    } 
    
    
    public function bill(){
        $this->show->admin_panel('order_bill');
    } 
    
    public function bill_new(){
        
        $this->show->admin_panel('order_product_bill_new');
    }
    
    ////This is a function designed to generate new package such as total invement - total income ,===
    /////This is specially for Gambit project only=====
    
    public function newPackage()
    {
        $res = array();
        $orders = $this->conn->runQuery('`u_code`,SUM(`order_amount`) as amount', 'orders', "`tx_type`='repurchase' and added_on<date('2024-02-03') GROUP BY `u_code`");
        foreach ($orders as $order) {
            $u_code = $order->u_code;
            $profile = $this->profile->profile_info($u_code);
            $res[$u_code]['username'] = $profile->username;
            $res[$u_code]['name'] = $profile->name;
            $res[$u_code]['investment'] = $investment = $order->amount;
            $incomeAr = $this->conn->runQuery('c27,SUM(`c3`+`c4`+`c5`+`c6`+`c7`+`c15`+`c16`+`c17`) as income', 'user_wallets', "u_code='$u_code'");
            /////=====//////======////////=========/////=====//////=======/////
            // $trxSum = $this->conn->runQuery('SUM(amount) as total', 'transaction', "`debit_credit`='debit' and wallet_type='main_wallet' and u_code='$u_code' and status=1")[0]->total;
            // $trxBkSum = $this->conn->runQuery('SUM(amount) as total', 'transaction_bkp', "`debit_credit`='debit' and wallet_type='main_wallet' and u_code='$u_code' and status=1")[0]->total;
            // $res[$u_code]['txSum'] = $trxSum;
            // $res[$u_code]['txBkSum'] = $trxBkSum;
            // $totalSum = $trxSum + $trxBkSum;
            // $this->db->set('c27', $totalSum);
            // $this->db->where('u_code', $u_code);
            // $this->db->update('user_wallets');
            /////=====//////======////////=========/////====/////======/////
            $res[$u_code]['usedFund'] =$usedFund=round(($incomeAr[0]->c27), 2);
            $res[$u_code]['income'] = $income = round(($incomeAr[0]->income), 2);
            $res[$u_code]['newPackage'] = $investment - $usedFund;
            // break;
        }

        // print_r(json_encode($res));
        // die();
        $data['users'] = $res;
        $this->show->admin_panel('investment_vs_income', $data);
    }
    
}