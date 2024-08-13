<?php
class Wallet extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }
  
   public function index(){  
         
      
       
       //$datas= $this->runQuery('u_code,tx_type,SUM(amount)as total','transaction ',"GROUP BY u_code HAVING tx_type='income'");
       
         $whr="1='1'";
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
           $s_by_name_arr=$this->profile->column_like($_REQUEST['name'],'name');   
           if(!empty($s_by_name_arr)){
           	$s_names=implode(',',$s_by_name_arr);
           	 $whr .= " AND u_code IN ($s_names) ";
           } 
           
        }
        
          
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
           $s_by_username_arr=$this->profile->column_like($_REQUEST['username'],'username');    
           if(!empty($s_by_username_arr)){
           	$s_usernames=implode(',',$s_by_username_arr);
           	$whr .= " AND u_code IN ($s_usernames) ";
           } 
        }
        
        $this->db->select("u_code,tx_type,SUM(amount)as total");
        $this->db->where($whr);
        $this->db->where('tx_type','income');
        $this->db->group_by('u_code');
        $this->db->order_by('total DESC');
        $this->db->limit('250');
        $res=$this->db->get('transaction');
        $data['table_data']=$res->result_array();
        $data['sr_no']=0;
        
        //echo '<pre>';
        //print_r($data);
         //$data = $this->conn->runQuery('','transaction ',"1='1' ".$whr." GROUP BY u_code HAVING tx_type='income'");
        // die();
         
        //$searchdata['order_by']='id desc';
       //$this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/wallet');
        $this->show->admin_panel('wallet/top_earners',$data);
    
   } 
    
    }