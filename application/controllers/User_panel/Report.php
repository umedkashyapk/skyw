<?php
class Report extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->conn->plan_setting('income_section')!=1){
            $panel_path=$this->conn->company_info('panel_path');
            redirect(base_url($panel_path.'/dashboard'));
            $this->currency=$this->conn->company_info('currency');
           
        }
         $this->panel_url=$this->conn->company_info('panel_path');
         $this->limit=20;
    }

     public function income(){  
        
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
		
		$data['income_where']=rtrim($where," AND");
        
        $this->show->user_panel('reports/income_reports',$data);
    }
    
    public function details_old(){
        
        $data=array();
       
        $limit=$this->limit;
        
        $data['from_table']='users';     
              
       $conditions['u_sponsor']=$this->session->userdata('user_id');
        $data['base_url']=$base_url=base_url().$this->panel_url.'/report/details';  
      
        
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $idsn=$this->profile->column_like($_REQUEST['name'],'name');
            if(!empty($idsn)){
                $conditions['tx_u_code']=$idsn;
            }else{
                $conditions['tx_u_code']='';
            }
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $ids=$this->profile->column_like($_REQUEST['username'],'username');
            if(!empty($ids)){
                $conditions['tx_u_code']=$ids;
            }else{
                $conditions['tx_u_code']='';
            }
            
        }
       
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $data['where']="date>='".$_REQUEST['start_date']."' and date<='".$_REQUEST['end_date']."'";
        }
        if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
        }
        
        $data['conditions']=$conditions;
        //$res=$this->paging->searching_data($data);
        $data = $this->paging->search_response($data,$limit,$base_url);
        
        $data['base_url']=$base_url;
       
        $this->show->user_panel('reports/business_report',$data);
    }
    
     public function details(){
    
    
     $searchdata['from_table']='users';        
        $conditions['u_sponsor']=$this->session->userdata('user_id');
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        /*if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$whr .= " added_on>='$start_date' and added_on<='$end_date' AND";
			$where="(added_on BETWEEN '$start_date' and '$end_date')";
            //$searchdata['where'] = $where;
		}  */
		
		 if(isset($_REQUEST['income'])){
            $this->session->set_userdata('show_income',$_REQUEST['income']);
        }
       /* $whr='1=1 AND';
    
            if(isset($_POST['select_month']) && $_POST['select_month']!=''){
                $select_month=date('Y-m-d',strtotime($_POST['select_month']));
                $whr .= " (MONTH(`added_on`)=MONTH('$select_month') AND YEAR(`added_on`)=YEAR('$select_month')) AND";
            }
           $whr=rtrim($whr,'AND');*/
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
          //$this->session->set_userdata('income_where',$whr);
        $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/report/details'); 
         
         // $data['query_where']=$whr;       
        $this->show->user_panel('reports/business_report',$data);    
        
    } 
    
    public function team_rank(){
        
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
      // $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'report/team_rank_report/team_rank'); 
        
        $this->show->user_panel('reports/team_rank_report');
    } 
    
    public function generation_report(){
        $source='gen';
        
        
        $data=array();
        $slug=$source;
        $limit=20;
        
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $data['from_table']='transaction';
        $data['base_url']=$base_url=base_url().$this->panel_url.'/report/generation_report';  
        $conditions['source']=$slug;
        
        if(isset($_REQUEST['reset'])){
             redirect(base_url($base_url));
        }
        
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $idsn=$this->profile->column_like($_REQUEST['name'],'name');
            if(!empty($idsn)){
                $conditions['tx_u_code']=$idsn;
            }else{
                $conditions['tx_u_code']='';
            }
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $ids=$this->profile->column_like($_REQUEST['username'],'username');
            if(!empty($ids)){
                $conditions['tx_u_code']=$ids;
            }else{
                $conditions['tx_u_code']='';
            }
            
        }
         
        if(isset($_REQUEST['start_date']) && $_REQUEST['start_date']!='' && isset($_REQUEST['end_date']) && $_REQUEST['end_date']!=''){
            $data['where']="date>='".$_REQUEST['start_date']."' and date<='".$_REQUEST['end_date']."'";
        }
        if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
        }
        
        $data['conditions']=$conditions;
        //$res=$this->paging->searching_data($data);
        $data = $this->paging->search_response($data,$limit,$base_url);
        
        $data['base_url']=$base_url;
        
        $this->show->user_panel('reports/generation_report',$data);
    }
    
    
    public function rank_team(){
        
        $u_code=$this->session->userdata('user_id');
        $whr="u_sponsor='$u_code' AND";
        
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $name=$_REQUEST['name'];
            $whr .= " name LIKE '%$name%' AND";
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $username=$_REQUEST['username'];
            $whr .= " username LIKE '%$username%' AND";
        }
        
         $whr = rtrim($whr," AND");
         
        $data['directs']=$this->conn->runQuery('*','users',"$whr");
      // $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'report/team_rank_report/team_rank'); 
        
        $this->show->user_panel('reports/team_rank_new',$data);
    }
   
}