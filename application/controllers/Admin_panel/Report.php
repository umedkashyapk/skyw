<?php
class Report extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->limit=10;
    }
    
     public function tds(){ 
        $where = " AND";
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where .=" (date BETWEEN '$start_date' and '$end_date') AND";
		}
		
		if(isset($_REQUEST['month']) && $_REQUEST['month']!='all'){
		    $month=date('Y-m-d 00:00:00',strtotime($_REQUEST['month']));
		    $where .=" (MONTH(date)=MONTH('$month')) AND YEAR(date)=YEAR('$month') AND";
		}
		
		if(isset($_REQUEST['date']) && $_REQUEST['date']!=''){
		    $date=date('Y-m-d 00:00:00',strtotime($_REQUEST['date']));
		    $where .=" (DATE(date)=DATE('$date')) AND";
		}
		if(isset($_REQUEST['today']) && $_REQUEST['today']!=''){
		    $date=date('Y-m-d 00:00:00');
		    $where .=" (DATE(date)=DATE('$date')) AND";
		}
		if(isset($_REQUEST['yesterday']) && $_REQUEST['yesterday']!=''){
		    $date=date('Y-m-d 00:00:00');
		    $yesterday=date('Y-m-d', strtotime($date. ' -1 days'));;
		    $where .=" (DATE(date)=DATE('$yesterday')) AND";
		}
		
		if(isset($_REQUEST['curr_week']) && $_REQUEST['curr_week']!=''){
		    $where .=" WEEKOFYEAR(date)=WEEKOFYEAR(NOW()) AND";
		}
		if(isset($_REQUEST['last_week']) && $_REQUEST['last_week']!=''){
		    $where .=" (WEEKOFYEAR(date)=WEEKOFYEAR(NOW())-1) AND";
		}
		
		$income_where=$data['income_where']=rtrim($where," AND");
        
        $all_report_users=$data['all_report_users']=$this->conn->runQuery('DISTINCT(u_code) as p_no','transaction',"tx_type='withdrawal' and status='1' ".$income_where );
        
        
        if(isset($_REQUEST['export_to_excel'])){
                  
           if($all_report_users){
                
               for($f=0;$f<count($all_report_users);$f++){
                   
                    $p_no=$all_report_users[$f]->p_no;
	                $get_amnt=$this->conn->runQuery('SUM(amount) as amnt','transaction',"u_code='$p_no' and status='1' and tx_type='withdrawal' ".$income_where )[0]->amnt;
	                $ttl_amnt=$get_amnt!='' ? $get_amnt:0;
	                $tds_amnt=$ttl_amnt*5/100;
	                $sn=$f+1;
	                 $profile=$this->profile->profile_info($p_no,'name,username');
                    $dta['S No.']=$sn;//$bank_details->account_no;
                    $dta['Username']=$profile->username;
                    $dta['Total Amount']=$ttl_amnt;
                    $dta['Total Tds']=$tds_amnt;
                    $exdataval[$f]=$dta;
               }
           }
             
            $this->export->export_to_excel($exdataval);
        }
        
        $this->show->admin_panel('report/tds',$data);
        
    }
    
    public function tds_old(){ 
        $where = " AND";
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where .=" (date BETWEEN '$start_date' and '$end_date') AND";
		}
		
		if(isset($_REQUEST['month']) && $_REQUEST['month']!='all'){
		    $month=date('Y-m-d 00:00:00',strtotime($_REQUEST['month']));
		    $where .=" (MONTH(date)=MONTH('$month')) AND YEAR(date)=YEAR('$month') AND";
		}
		
		if(isset($_REQUEST['date']) && $_REQUEST['date']!=''){
		    $date=date('Y-m-d 00:00:00',strtotime($_REQUEST['date']));
		    $where .=" (DATE(date)=DATE('$date')) AND";
		}
		if(isset($_REQUEST['today']) && $_REQUEST['today']!=''){
		    $date=date('Y-m-d 00:00:00');
		    $where .=" (DATE(date)=DATE('$date')) AND";
		}
		if(isset($_REQUEST['yesterday']) && $_REQUEST['yesterday']!=''){
		    $date=date('Y-m-d 00:00:00');
		    $yesterday=date('Y-m-d', strtotime($date. ' -1 days'));;
		    $where .=" (DATE(date)=DATE('$yesterday')) AND";
		}
		
		if(isset($_REQUEST['curr_week']) && $_REQUEST['curr_week']!=''){
		    $where .=" WEEKOFYEAR(date)=WEEKOFYEAR(NOW()) AND";
		}
		if(isset($_REQUEST['last_week']) && $_REQUEST['last_week']!=''){
		    $where .=" (WEEKOFYEAR(date)=WEEKOFYEAR(NOW())-1) AND";
		}
		
		$income_where=$data['income_where']=rtrim($where," AND");
        
        $all_report_users=$data['all_report_users']=$this->conn->runQuery('DISTINCT(pan_number) as p_no','transaction',"pan_number!='' and tx_type='withdrawal' ".$income_where );
        
        
        if(isset($_REQUEST['export_to_excel'])){
                  
           if($all_report_users){
                
               for($f=0;$f<count($all_report_users);$f++){
                   
                   $p_no=$all_report_users[$f]->p_no;
	                $get_amnt=$this->conn->runQuery('SUM(amount) as amnt','transaction',"pan_number='$p_no' ".$income_where )[0]->amnt;
	                $ttl_amnt=$get_amnt!='' ? $get_amnt:0;
	                $tds_amnt=$ttl_amnt*5/100;
	                $sn=$f+1;
	                
                    $dta['S No.']=$sn;//$bank_details->account_no;
                    $dta['Pan No.']=$p_no;
                    $dta['Total Amount']=$ttl_amnt;
                    $dta['Total Tds']=$tds_amnt;
                    $exdataval[$f]=$dta;
               }
           }
             
            $this->export->export_to_excel($exdataval);
        }
        
        $this->show->admin_panel('report/tds',$data);
        
    }
    
    public function pending(){
       
       
        $searchdata['search_string']='withdrawal_search';
        $conditions['tx_type']='withdrawal';
       $conditions['tds_status']=0; 
       $conditions['status']=1; 
        $searchdata['from_table']='transaction';        
       /* $this->db->select('u_code');
        $this->db->distinct();
        $this->db->where('tx_type','withdrawal');
        $this->db->where('status','1'); 
        $this->db->where('tds_status','0'); 
        $res=$this->db->get('transaction');
        $data['from_table']=$res->result_array();
         print_r($data);   */
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
        
          if(isset($_REQUEST['pan_no']) && $_REQUEST['pan_no']!=''){
            $pan_no=$_REQUEST['pan_no'];
            $whr .= "pan_no LIKE '%$pan_no%' AND";
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
          $whr = rtrim($whr," AND");
         
       //$data['directs']=$this->conn->runQuery('*','user_accounts',"$whr");
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/report/pending'); 
         
      
        $this->show->admin_panel('report/tds_pending',$data);
        
       
       
    }
     public function approved(){

       $searchdata['search_string']='withdrawal_approved_search';
        $conditions['tx_type']='withdrawal';
        $conditions['tds_status']=1;      
        //$searchdata['order_by']='date desc'; 
        $searchdata['from_table']='transaction';
       // $data['base_url']=$this->panel_url.'/withdrawal/approved';
          
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
        
         $searchdata['order_by']='updated_on desc';
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/report/approved'); 
         
            
        $this->show->admin_panel('report/tds_approved',$data);
        
        
    } 
    
    
    public function view(){
        
        
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_tds_id',$_REQUEST['id']);
        }
        $tds_id=$this->session->userdata('admin_tds_id');

        if(isset($_POST['tds_approve_btn'])){
            $this->approve($tds_id);
            $this->session->set_flashdata("success", "Tds Approved.");
            redirect(base_url($this->conn->company_info('admin_path').'/report/approved'));
        }

       

        $data['tds_id']=$tds_id;
        $this->show->admin_panel('report/tds_view',$data);
        
    } 
    
    public function approve($tds_id){
        $chk_exists=$this->conn->runQuery('id','transaction',"tds_status=0 and id='$tds_id'");
        if($chk_exists){
            $set['tds_status']=1;
            $set['added_on']=date('Y-m-d H:i:s');
            $this->db->where('id',$tds_id);
            $this->db->update('transaction',$set);
        }
    }

    
}