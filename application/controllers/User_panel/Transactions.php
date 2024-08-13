<?php
class Transactions extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->conn->plan_setting('transactions_section')!=1){
            $panel_path=$this->conn->company_info('panel_path');
           // redirect(base_url($panel_path.'/dashboard'));
            $this->currency=$this->conn->company_info('currency');
           
        }
         $this->panel_url=$this->conn->company_info('panel_path');
         $this->limit=10;
    }

    public function index(){
       /* $data['limit']=10;
        $data['search_string']='transaction_search';
        if(isset($_POST['reset'])){
            $this->session->unset_userdata($data['search_string']);
            $this->session->unset_userdata('show_income');
        }
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $data['from_table']='transaction';
        $data['base_url']=$this->panel_url.'/transactions';  
        $data['conditions']=$conditions;
        $data['order_by']='id desc';
        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];      
        $data['sr_no']=$res['sr_no'];
       //  $this->show->user_panel('coming_soon');        
       $this->show->user_panel('transactions',$data);   */    
       
      /*$conditions=array();
        if(isset($_REQUEST['income'])){
            $this->session->set_userdata('show_income',$_REQUEST['income']);
        }

        if(isset($_POST['reset'])){
            $this->session->unset_userdata($data['search_string']);
        }*/
       $conditions['u_code'] = $this->session->userdata('user_id');    
        //$conditions['wallet_type'] = 'fund_wallet';  	   
       $searchdata['from_table']='transaction';
       $searchdata['order_by']='id desc';  
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
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(date BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}
		if(isset($_REQUEST['source']) && $_REQUEST['source']!=''){
            $source=$_REQUEST['source'];
            if($source){
                $conditions['tx_type'] = $source;
            }
           
        }   
		if(isset($_REQUEST['wallet_type']) && $_REQUEST['wallet_type']!=''){
            $wallet=$_REQUEST['wallet_type'];
            if($wallet){
                $conditions['wallet_type'] = $wallet;
            }
           
        }   
        if(isset($_REQUEST['debit_credit']) && $_REQUEST['debit_credit']!=''){
            $debit_credit=$_REQUEST['debit_credit'];
            if($debit_credit){
                $conditions['debit_credit'] = $debit_credit;
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/transactions'); 
        $this->show->user_panel('transactions',$data);    
           
       
       
    }
    
    public function payouts(){
        $data=array();
        $limit=$this->limit;
        
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $data['from_table']='transaction';
        $data['base_url']=$base_url=$this->panel_url.'/transactions/payouts';  
         
        $conditions['tx_type']='payout';
        
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
            $conditions['status']=$_REQUEST['status'];
          
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
        
        $this->show->user_panel('transaction_payouts',$data);
        
    }
    
    public function withdrawals(){

        if(isset($_REQUEST['export_to_excel'])){
             $u_id=$_REQUEST['userid'];

           
            $whr="u_code='$u_id' and tx_type='withdrawal'";
              $get_data=$this->conn->runQuery('*','transaction', $whr);  
             
              if($get_data){
                   
                  for($f=0;$f<count($get_data);$f++){
                   $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                   $bank_details=json_decode($get_data[$f]->bank_details);
                  
                   //$dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                   $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                   $dta['Tx Charge']=$get_data[$f]->tx_charge;
                   $dta['PAYABLE AMOUNT']=$get_data[$f]->amount;
                   $dta['tx hash']=$get_data[$f]->tx_hash;
                   $dta['Reason']=$get_data[$f]->reason;
                   $dta['Hash']=$get_data[$f]->tx_hash;
                   $dta['Date']= $get_data[$f]->date;
                   $exdataval[$f]=$dta;
   
                  }
              }
                
               $this->export->export_to_excel($exdataval);
   
           }
           
             

        $data=array();
        $limit=$this->limit;
        
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $searchdata['from_table']='transaction';
        $searchdata['order_by']='id desc';  
        $searchdata['base_url']=$base_url=$this->panel_url.'/transactions/withdrawals';  
         
        $conditions['tx_type']='withdrawal';
        
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
        
        
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
            $conditions['status']=$_REQUEST['status'];
          
        }
          
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $data['where']="date>='".$_REQUEST['start_date']."' and date<='".$_REQUEST['end_date']."'";
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
       $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/transactions/withdrawals'); 
        
        $data['base_url']=$base_url;
        $data['search_status']=$_REQUEST['status'];
        $this->show->user_panel('transaction_withdrawal',$data);
        
    }
    
    public function principal_withdrawals(){

        if(isset($_REQUEST['export_to_excel'])){
             $u_id=$_REQUEST['userid'];

           
            $whr="u_code='$u_id' and tx_type='principal_withdrawal'";
              $get_data=$this->conn->runQuery('*','transaction', $whr);  
             
              if($get_data){
                   
                  for($f=0;$f<count($get_data);$f++){
                   $tx_profile=$this->profile->profile_info($get_data[$f]->u_code);
                   $bank_details=json_decode($get_data[$f]->bank_details);
                  
                   //$dta['Tx User']=$tx_profile->username.'( '.$tx_profile->name.')';
                   $dta['Amount']=$get_data[$f]->amount+$get_data[$f]->tx_charge;
                   $dta['Tx Charge']=$get_data[$f]->tx_charge;
                   $dta['PAYABLE AMOUNT']=$get_data[$f]->amount;
                   $dta['tx hash']=$get_data[$f]->tx_hash;
                   $dta['Reason']=$get_data[$f]->reason;
                   $dta['Hash']=$get_data[$f]->tx_hash;
                   $dta['Date']= $get_data[$f]->date;
                   $exdataval[$f]=$dta;
   
                  }
              }
                
               $this->export->export_to_excel($exdataval);
   
           }
           
             

        $data=array();
        $limit=$this->limit;
        
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $searchdata['from_table']='transaction';
        $searchdata['order_by']='id desc';  
        $searchdata['base_url']=$base_url=$this->panel_url.'/transactions/principal_withdrawals';  
         
        $conditions['tx_type']='principal_withdrawal';
        
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
        
        
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
            $conditions['status']=$_REQUEST['status'];
          
        }
          
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $data['where']="date>='".$_REQUEST['start_date']."' and date<='".$_REQUEST['end_date']."'";
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
       $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/transactions/principal_withdrawals'); 
        
        $data['base_url']=$base_url;
        $data['search_status']=$_REQUEST['status'];
        $this->show->user_panel('principal_withdrawal',$data);
        
    }

    public function paid_payout(){
        $data['limit']=10;
        $data['search_string']='payout_search';
        if(isset($_POST['reset'])){
            $this->session->unset_userdata($data['search_string']);
            $this->session->unset_userdata('show_income');
        }
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $conditions['tx_type'] = 'payout';        
        $data['from_table']='transaction';
        $data['base_url']=$this->panel_url.'/transactions/paid_payout';

        $data['conditions']=$conditions;
        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];      
        $data['sr_no']=$res['sr_no'];
       //  $this->show->user_panel('coming_soon');        
       $this->show->user_panel('transaction_paid_payout',$data);        
    }
   

    

     

     

}