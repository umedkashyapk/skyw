<?php
class Support extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->conn->plan_setting('support_section')!=1){
            $panel_path=$this->conn->company_info('panel_path');
            redirect(base_url($panel_path.'/dashboard'));
            $this->currency=$this->conn->company_info('currency');
         
        }
         $this->limit=10;
           $this->admin_url=$this->conn->company_info('admin_path');  
    }

    public function index(){

         
        
    }


public function pending(){
         
        $searchdata['from_table']='support';        
        $conditions['status']=0;      
        
         
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
			$where="(updated_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}
        
        
        if(isset($_REQUEST['ticket']) && $_REQUEST['ticket']!=''){
            $conditions['ticket']=$_REQUEST['ticket'];
        
           
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/support/pending'); 
         
            
        $this->show->admin_panel('support_pending',$data);
        
       
       
    }
    // public function pending(){
    //     $data['limit']=25;
    //     $data['search_string']='admin_pending_support'; 
    //     $data['from_table']='support';
    //     $data['base_url']=$this->panel_url.'/support/pending'; 
    //     $conditions['status']=0;
    //     $data['conditions']=$conditions;
    //     $res=$this->paging->searching_data($data);
    //     $data['table_data']=$res['table_data'];
    //     $data['sr_no']=$res['sr_no'];
    //     $data['total_rows']=$res['total_rows'];
    //     $this->show->admin_panel('support_pending',$data);
        
        
    // }
    
    
    
    
    
    
    public function approved(){
         
        $searchdata['from_table']='support';        
        $conditions['status']=1;      
        
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
			$where="(updated_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}
		
	
        
        if(isset($_REQUEST['ticket']) && $_REQUEST['ticket']!=''){
            $conditions['ticket']=$_REQUEST['ticket'];
        
           
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/support/approved'); 
        $this->show->admin_panel('support_approved',$data);
        
       
       
    }
    
    
    // public function approved(){
    //     $data['limit']=25;
    //     $data['search_string']='admin_pending_support'; 
    //     $data['from_table']='support';
    //     $data['base_url']=$this->panel_url.'/support/pending'; 
    //     $conditions['status']=1;
    //     $data['conditions']=$conditions;
    //     $res=$this->paging->searching_data($data);
    //     $data['table_data']=$res['table_data'];
    //     $data['sr_no']=$res['sr_no'];
    //     $data['total_rows']=$res['total_rows'];
    //     $this->show->admin_panel('support_approved',$data);
        
        
    // }

    public function view(){
        if(isset($_REQUEST['id'])){
            $this->session->set_userdata('admin_support_id',$_REQUEST['id']);
        }
        $wd_id=$this->session->userdata('admin_support_id');

        

        if(isset($_POST['reply_btn'])){
            $this->form_validation->set_rules('reply', 'Reply', 'required');
            if($this->form_validation->run() != False){
                $set['reply_status']=1;
                $set['status']=1;
                $set['reply']=$_POST['reply'];
                $this->db->where('id',$wd_id);
                $this->db->update('support',$set);
                redirect(base_url($this->conn->company_info('admin_path').'/support/pending'));
            }
        }

        $data['support_id']=$wd_id;
        $this->show->admin_panel('support_view',$data);
        
    }
    
    public function auto_reply(){
        
        
         if(isset($_POST['reply_msg'])){
             
          
            $this->form_validation->set_rules('type', 'Type', 'required');
            $this->form_validation->set_rules('massage', 'Massage', 'required');
            if($this->form_validation->run() != False){
                $set= array();
                $set['type']=$_POST['type'];
                $set['reply']= $_POST['massage'];
              
             
                $this->db->insert('reply_msg',$set);
                $this->session->set_flashdata("success", "Auto Reply Added Successfully");
                // redirect(base_url($this->conn->company_info('admin_path').'/support/approved'));
            }
        }

         
        $this->show->admin_panel('reply');
        
        
    }

     

     

}