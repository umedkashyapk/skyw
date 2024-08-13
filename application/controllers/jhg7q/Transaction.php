<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Transaction extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
        
        $this->limit = 20;
    }
    
    
    public function index(){
        $lmt = $this->limit;
        $input_data = $_POST;//$this->conn->get_input();
        if(isset($_POST['u_id']) && isset($_POST['init_val'])){
            $start_from = $_POST['init_val'];
            $u_id = $_POST['u_id'];
            
            $where = '';
            
            if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
               $spo=$this->profile->column_like($_REQUEST['name'],'name');     
                $use = implode(',',$spo);
                if(!empty($spo)){
                   $where .= " and tx_u_code IN ($use) and 1='1' ";
                   
                }
            }
            
            if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            
              
                $spo=$this->profile->column_like($_REQUEST['username'],'username');
                $use = implode(',',$spo);
               
               
                if(!empty($spo)){
                  
                   $where .= " and tx_u_code IN ($use)  and 1='1'";
                }
               
            }    
            
            if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
    			
    			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
    			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
    			$where .=" and (date BETWEEN '$start_date' and '$end_date')";
               
		    } 
             
            $txn = $this->conn->runQuery('*','transaction',"u_code='$u_id' $where order by id desc limit $start_from,$lmt");
             
            $total_txn= $this->conn->runQuery('COUNT(id) as ids','transaction',"u_code='$u_id' $where")[0]->ids;
            $testing = array();
                $testing['remark'] = $this->db->last_query();
                 $this->db->insert('testing',$testing);
            $ins_val = $start_from;
            $ttlcnt=0;
            if($txn){
                
                foreach($txn as $txn_details){
                    $ttlcnt++;
                    
                    $details = json_decode(json_encode($txn_details),true);
                    
                    if($details['tx_u_code']!=''){
                        $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                        $details['tx_from_ucode_name'] = $this->profile->profile_info($details['tx_u_code'],'name')->name;
                    }else{
                        $details['tx_from_ucode'] = '';
                        $details['tx_from_ucode_name'] = '';
                    }
                    
                    if($details['u_code']!=''){
                        $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'],'username')->username;
                    }else{
                        $details['tx_to_ucode'] = '';
                    }
                    
                    $details['sno']=$ttlcnt;
                    
                    $data[]=$details;
                    $ins_val++;
                    
                }
                
                $res['total_count']= $total_txn;
                $res['data']= $data;
                $res['message']= "";
            }else{
                $res['total_count']= 0;
                $res['data']= array();
                $res['message']= "No data found";
            }
            
            
            $res['next_init_val']= $ins_val;
            $res['start_from']= $start_from;
            $res['prev_page']= $start_from>0 ? 'yes':'no';
            $res['next_page']= $ttlcnt>=$lmt ? 'yes':'no';
            $res['res']='success';
            
        }else{
            $res['next_init_val']= 0;
            $res['next_page']= 'no';
             $res['start_from']=0;
            $res['prev_page']= 'no';
            $res['res']= 'error';
            $res['data']= array();
            $res['message']= "Invalid parameters.";
        }
        print_r(json_encode($res)); 
    }
    
	public function get_passbook_wallet(){
        
        $chk['wallet_type']= $this->conn->runQuery("*",'invest_wallet',"type='passbook'");
        $chk['res']='success'; 
        print_r(json_encode($chk));
        
    }
	
	
	public function passbook(){
       
        $input_data = $this->conn->get_input();
        if(isset($input_data['from_date']) && isset($input_data['to_date'])  &&  $input_data['from_date']!='' &&  $input_data['to_date']!=''){
			
			$from_date1=$input_data['from_date'];
            $to_date1=$input_data['to_date'];
			$from_date = date('Y-m-d  00:00:01', strtotime($from_date1));
			$to_date = date('Y-m-d  23:59:59', strtotime($to_date1));
			$u_id=$input_data['u_id'];
			$wallet_type=$input_data['wallet_type'];
			
            $txn_credit = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id' and wallet_type='$wallet_type' and date>='$from_date' and date<='$to_date' and debit_credit='credit'")[0]->amts;          
            $txn_debit = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id' and wallet_type='$wallet_type' and date>='$from_date' and date<='$to_date' and debit_credit='debit'")[0]->amts;          
            
			/////////////////////////////////////////////////////////////////////////////////////////////
			$txn = $this->conn->runQuery('u_code,tx_u_code,tx_type,debit_credit,source,wallet_type,amount,date,added_on,remark','transaction',"u_code='$u_id' and wallet_type='$wallet_type' and date>='$from_date' and date<='$to_date' ");
			if($txn){
				$sr=1;
                foreach($txn as $txn1){
                   
                    $details = json_decode(json_encode($txn1),true);
                    if($details['tx_u_code']!=''){
                        $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                    }else{
                        $details['tx_from_ucode'] = '';
                    }
                    
                    if($details['u_code']!=''){
                        $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'],'username')->username;
                    }else{
                        $details['tx_to_ucode'] = '';
                    }
                    $data[]=$details;
                    $res['data']= $data;
                    $sr++;
                    
                }
			}else{
                $res['data']= array();
            }
            
            $res['res']='success';
            $res['message']='';
			////////////////////////////////////////////////////////////////////////////////////////////		
			
            
            $res['credit']= $trn_c=$txn_credit!="" ? $txn_credit : 0 ;
            $res['debit']= $trn_d=$txn_debit!="" ? $txn_debit : 0 ;
			$res['balance']= $trn_c-$trn_d;
            $res['res']='success';
            $result = $res;
        }else{
            $u_id=$input_data['u_id'];
			$wallet_type=$input_data['wallet_type'];
			
			$txn = $this->conn->runQuery('u_code,tx_u_code,tx_type,debit_credit,source,wallet_type,amount,date,added_on,remark','transaction',"u_code='$u_id' and wallet_type='$wallet_type'");
			if($txn){
				$sr=1;
                foreach($txn as $txn1){
                   
                    $details = json_decode(json_encode($txn1),true);
                    if($details['tx_u_code']!=''){
                        $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                    }else{
                        $details['tx_from_ucode'] = '';
                    }
                    
                    if($details['u_code']!=''){
                        $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'],'username')->username;
                    }else{
                        $details['tx_to_ucode'] = '';
                    }
                    $data[]=$details;
                    $res['data']= $data;
                    $sr++;
                    
                }
			}else{
                $res['data']= array();
            }
            
            $res['res']='success';
            $res['message']='';
            
			
			$txn_credit = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id' and wallet_type='$wallet_type' and debit_credit='credit'")[0]->amts;          
            $txn_debit = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id' and wallet_type='$wallet_type'  and debit_credit='debit'")[0]->amts;          
            $res['credit']= $trn_c=$txn_credit!="" ? $txn_credit : 0 ;
            $res['debit']= $trn_d=$txn_debit!="" ? $txn_debit : 0 ;
			$res['balance']= $trn_c-$trn_d;
            $res['res']='success';
			$result = $res;
			
        }
        print_r(json_encode($result)); 
    }
	
    public function income_types(){
        $plan_type = $this->conn->setting('reg_type');
        $incomes = $this->conn->runQuery("*", 'wallet_types', "wallet_type='income' and  status='1' and $plan_type='1'");
       
        $incomearr = array();
        if ($incomes) {
            foreach ($incomes as $income) {
                $obj = new stdClass();
                $obj->name = $income->name;
                $obj->type = $income->slug;
                $incomearr[] = $obj;
            }
        }

        print_r(json_encode($incomearr));

    }

    public function incomes(){
        $lmt = $this->limit;
        $input_data = $this->conn->get_input();
        if(isset($_POST['u_id']) && isset($_POST['init_val']) && isset($_POST['income_type'])){
            
            $income_type = $_POST['income_type'];
            $start_from = $_POST['init_val'];
            $u_id = $_POST['u_id'];
            
             if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $idsn=$this->profile->column_like($_REQUEST['name'],'name');
            if(!empty($idsn)){
                $conditions['u_code']=$idsn;
            }else{
                $conditions['u_code']='';
            }
        }
            if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
    			
    			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
    			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
    			$where .=" and (date BETWEEN '$start_date' and '$end_date')";
                 
		    } 
        
            $txn = $this->conn->runQuery('*','transaction',"u_code='$u_id' and source='$income_type' and tx_type='income' $where  order by id desc limit $start_from,$lmt");
            $total_earning = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id' and source='$income_type' and tx_type='income'")[0]->amts;
            
             
                
            $total_txn= $this->conn->runQuery('COUNT(id) as ids','transaction',"u_code='$u_id' and source='$income_type' and tx_type='income' $where")[0]->ids;
             
           
            $ins_val = $start_from;
            
            $ttlcnt=0;
            if($txn){
                
                foreach($txn as $txn_details){
                    $ttlcnt++;
                    $details = json_decode(json_encode($txn_details),true);
                    
                    if($details['tx_u_code']!=''){
                        $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                    }else{
                        $details['tx_from_ucode'] = '';
                    }
                    
                    if($details['u_code']!=''){
                        $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'],'username')->username;
                    }else{
                        $details['tx_to_ucode'] = '';
                    }
                    
                    if($_POST['income_type']=="binary"){
                        $tx_id=$txn_details['id'];
                            $binary_matching_info=$this->conn->runQuery('*','binary_matching',"tx_id='$tx_id'")[0];
                             $details['ben_matching']=round($binary_matching_info->ben_matching);
                             $details['flash']=round($binary_matching_info->flash);
                    }
                    
                    
                    $data[]=$details;                    
                    $ins_val++;                    
                }
                
				 $res['total_count']= $total_txn;
				$res['total_earning']= ($total_earning!="" ? $total_earning :0);
                $res['data']= $data;
                $res['message']= "";
            }else{
                 $res['total_count']=0;
                 $res['total_earning']=0;
                $res['data']= array();
                $res['message']= "No data found";
            }
            
             $res['start_from']= $start_from;
              $res['prev_page']= $start_from>0 ? 'yes':'no';
            $res['next_init_val']= $ins_val;
            $res['next_page']= $ttlcnt>=$lmt ? 'yes':'no';
            $res['res']='success';
            
            
        }else{
            $res['next_init_val']= 0;
            $res['next_page']= 'no';
             $res['prev_page']='no';
            $res['res']= 'error';
            $res['data']= array();
            $res['message']= "Invalid parameters.";
        }
        
         print_r(json_encode($res)); 
    }
    public function incomes_test(){
        $lmt = $this->limit;
        $input_data = $this->conn->get_input();
        if(isset($_POST['u_id']) && isset($_POST['init_val']) && isset($_POST['income_type'])){
            
            $income_type = $_POST['income_type'];
            $limit = $_POST['init_val'];
            $u_id = $_POST['u_id'];
            $searchdata['from_table']='transaction';        
            $conditions['u_code']=$u_id;//$this->session->userdata('user_id');
            $conditions['source']=$income_type;//$this->session->userdata('user_id');
            $conditions['status']=1;
            if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
                $idsn=$this->profile->column_like($_REQUEST['name'],'name');
                if(!empty($idsn)){
                    $conditions['u_code']=$idsn;
                }else{
                    $conditions['u_code']='';
                }
            }
            if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
                $ids=$this->profile->column_like($_REQUEST['username'],'username');
                if(!empty($ids)){
                    $conditions['u_code']=$ids;
                }else{
                    $conditions['u_code']='';
                }
                
            }
            if(isset($_REQUEST['select_level']) && $_REQUEST['select_level']!=''){
                $conditions['tx_record']=$_REQUEST['select_level'];
            }
             if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
    			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
    			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
    			$where="(date BETWEEN '$start_date' and '$end_date')";
                $searchdata['where'] = $where;
    		}
        //   if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
        //         $limit=$_REQUEST['limit'];
        //         $this->limit= $limit;
        //     }
             if(!empty($likeconditions)){
                $searchdata['likecondition'] = $likeconditions;
            }
            
            if(!empty($conditions)){
                $searchdata['conditions'] = $conditions;
            }
        //$res=$this->paging->searching_data($data);
        $tdata = $this->paging->search_response($searchdata,$this->limit,''); 
         
        
            $txn = $tdata['table_data']; //$this->conn->runQuery('*','transaction',"u_code='$u_id' and source='$income_type' and tx_type='income' limit $start_from,$lmt");
            $total_earning = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id' and source='$income_type' and tx_type='income'")[0]->amts;
             $total_txn= $this->conn->runQuery('COUNT(id) as ids','transaction',"u_code='$u_id' and source='$income_type' and tx_type='income'")[0]->ids;
           
            $ins_val = $start_from;
            
            $ttlcnt=0;
            if($txn){
                
                foreach($txn as $txn_details){
                    $ttlcnt++;
                    $details = json_decode(json_encode($txn_details),true);
                    
                    if($details['tx_u_code']!=''){
                        $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                    }else{
                        $details['tx_from_ucode'] = '';
                    }
                    
                    if($details['u_code']!=''){
                        $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'],'username')->username;
                    }else{
                        $details['tx_to_ucode'] = '';
                    }
                    
                    if($_POST['income_type']=="binary"){
                        $tx_id=$txn_details['id'];
                            $binary_matching_info=$this->conn->runQuery('*','binary_matching',"tx_id='$tx_id'")[0];
                             $details['ben_matching']=round($binary_matching_info->ben_matching);
                             $details['flash']=round($binary_matching_info->flash);
                    }
                    
                    
                    $data[]=$details;                    
                    $ins_val++;                    
                }
                
				 $res['total_count']= $total_txn;
				$res['total_earning']= ($total_earning!="" ? $total_earning :0);
                $res['data']= $data;
                $res['message']= "";
            }else{
                 $res['total_count']= 0;
                $res['data']= array();
                $res['message']= "No data found";
            }
            
             $res['start_from']= $start_from;
            $res['next_init_val']= $ins_val;
            $res['prev_page']= $start_from>0 ? 'yes':'no';
            $res['next_page']= $ttlcnt>=$lmt ? 'yes':'no';
            $res['res']='success';
            
            
        }else{
            $res['next_init_val']= 0;
             $res['start_from']= $start_from;
            $res['next_page']= 'no';
            $res['prev_page']= 'no';
            $res['res']= 'error';
            $res['data']= array();
            $res['message']= "Invalid parameters.";
        }
        
         print_r(json_encode($res)); 
    }
    
    
    public function withdrawal(){
        $lmt = $this->limit;
        $input_data = $this->conn->get_input();
        if(isset($_POST['u_id']) && isset($_POST['init_val'])){
            
          
            $start_from = $_POST['init_val'];
            $u_id = $_POST['u_id'];
            
             if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $idsn=$this->profile->column_like($_REQUEST['name'],'name');
            if(!empty($idsn)){
                $conditions['u_code']=$idsn;
            }else{
                $conditions['u_code']='';
            }
        }
            if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
    			
    			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
    			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
    			$where .=" and (date BETWEEN '$start_date' and '$end_date')";
                 
		    } 
        
            $txn = $this->conn->runQuery('*','transaction',"u_code='$u_id' and tx_type='withdrawal' $where order by id desc limit $start_from,$lmt");
            $total_earning = $this->conn->runQuery('SUM(amount) as amts','transaction',"u_code='$u_id'  and tx_type='withdrawal'")[0]->amts;
            $total_txn= $this->conn->runQuery('COUNT(id) as ids','transaction',"u_code='$u_id' and tx_type='withdrawal' $where")[0]->ids;
             
           
            $ins_val = $start_from;
            
            $ttlcnt=0;
            if($txn){
                
                foreach($txn as $txn_details){
                    $ttlcnt++;
                    $details = json_decode(json_encode($txn_details),true);
                    
                    if($details['tx_u_code']!=''){
                        $details['tx_from_ucode'] = $this->profile->profile_info($details['tx_u_code'],'username')->username;
                    }else{
                        $details['tx_from_ucode'] = '';
                    }
                    
                    if($details['u_code']!=''){
                        $details['tx_to_ucode'] = $this->profile->profile_info($details['u_code'],'username')->username;
                    }else{
                        $details['tx_to_ucode'] = '';
                    }
                    
                    
                    
                    
                    $data[]=$details;                    
                    $ins_val++;                    
                }
                
				 $res['total_count']= $total_txn;
				$res['total_earning']= ($total_earning!="" ? $total_earning :0);
                $res['data']= $data;
                $res['message']= "";
            }else{
                 $res['total_count']=0;
                 $res['total_earning']=0;
                $res['data']= array();
                $res['message']= "No data found";
            }
            
             $res['start_from']= $start_from;
              $res['prev_page']= $start_from>0 ? 'yes':'no';
            $res['next_init_val']= $ins_val;
            $res['next_page']= $ttlcnt>=$lmt ? 'yes':'no';
            $res['res']='success';
            
            
        }else{
            $res['next_init_val']= 0;
            $res['next_page']= 'no';
             $res['prev_page']='no';
            $res['res']= 'error';
            $res['data']= array();
            $res['message']= "Invalid parameters.";
        }
        
         print_r(json_encode($res)); 
    }
    
    
    
}