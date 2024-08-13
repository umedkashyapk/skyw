<?php
class Crypto extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->currency=$this->conn->company_info('currency');
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
        
        $api_key="325b5081c7d3317d1c7b6fe744a91a61";//"329fa83f6589850e3adf2b5c8acb4f1c";//$this->conn->company_info('api_key');
        $api_key_trc="7f0b9bbfe097f95261ca4c32c3f01708";//$this->conn->company_info('api_key');
        $this->payment_type =  "CRYPADD";
        $this->api_key =$api_key;
        $this->api_key_trc =$api_key_trc;
        
    }


    public function index(){ 
        $this->show->admin_panel('api');
    }
   
     public function fund_add_history(){
        
        $searchdata['search_string']='fund_transfer_history_search';
        $conditions['tx_type']='CRYPADD';
       
        $searchdata['order_by']='id desc';
        $searchdata['from_table']='transaction';        
        
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
        if(isset($_REQUEST['status']) && $_REQUEST['status']!=''){
          
          
            $status=$_REQUEST['status'];     
            
             
                $conditions['status'] = $status;
            
           
        }      
         
          if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(date BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}
	  
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/Crypto/fund-add-history'); 
         
            
        $this->show->admin_panel('fund_add_history',$data);
              
    }
    
    
    
    public function add_fund_expire(){ 
      
        if(isset($_GET['id'])){
         
         $txid=$_GET['id']; 
       // die();  
        $trsac_detail=$this->conn->runQuery('*','transaction',"cryp_paymentId='$txid' and tx_type='CRYPADD' ");
        if($trsac_detail){       
         $amts=$trsac_detail[0]->amount;
        $u_code = $this->session->userdata('user_id');
        $type = $this->payment_type;
        $url = "https://test.eracom.in/sendcryp/";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $headers = [
          "Content-Type: application/x-www-form-urlencoded"
        ];
        
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    
        $data = http_build_query([
          "api_key" => $this->api_key,
          "action" => "review_transaction",
          "txId" => $txid
          ]);
          
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    
        $result = json_decode(curl_exec($curl), true);
        curl_close($curl);   
        // print_R($result); 
        //  die();
         if($result['success']==true){
           
         	$this->session->set_flashdata("success", "Transaction Review Successfully");          
         
				$ary = array();
				$ary['status'] = 0;
				$ary['cryp_status'] ="";
				$this->db->where('cryp_paymentId',$txid);
				if($this->db->update('transaction',$ary)){
				  
				}          
           
         }else{
            $msgss=$result['message'];
            $this->session->set_flashdata("error", $msgss);
         }  
        ?>
          <script>window.location.href = 'https://gambitbot.io/control/Crypto/fund-add-history';</script> 
     <?php         
//redirect(base_url(uri_string()));
         //$this->show->user_panel('fund/add-fund-history');
          
        }else{
        $this->session->set_flashdata("error", "Invalid Transaction Id");
                ?>
          <script>window.location.href = 'https://gambitbot.io/control/Crypto/fund-add-history';</script> 
     <?php        
        } 
          
          
        }else{
        $this->session->set_flashdata("error", "Invalid Request");
                 ?>
          <script>window.location.href = 'https://gambitbot.io/control/Crypto/fund-add-history';</script> 
     <?php        
        }
          
    }
}