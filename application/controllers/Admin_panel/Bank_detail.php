<?php
class Bank_detail extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

    public function Bank(){ 
        
        $data['title']='Add Bank detail';
         
        if(isset($_POST['add_bank_btn'])){
            
            $this->form_validation->set_rules('account_holder_name','Account holder name','required');
            $this->form_validation->set_rules('account_no','Account Number','required');
            $this->form_validation->set_rules('bank_name','Bank Name','required');
            $this->form_validation->set_rules('bank_branch','Branch Name','required');
            $this->form_validation->set_rules('ifsc_code','Ifsc Code','required');
                
                if($this->form_validation->run()!=false){
                 
                   $insert['account_holder_name']= $_POST['account_holder_name'];
                   $insert['account_no']= $_POST['account_no'];
                   $insert['bank_name']= $_POST['bank_name'];
                   $insert['bank_branch']= $_POST['bank_branch'];
                   $insert['ifsc_code']= $_POST['ifsc_code'];
                   
                   $this->db->insert('admin_bank_detail',$insert);
                   $this->session->set_flashdata('success',"Bank Detail added successfully.");
                   redirect(base_url(uri_string()));
                }else{
                    $this->session->set_flashdata('Error',"Invalid Request.");
                }
            }
            $this->show->admin_panel('add_bank_detail',$data);
    }
    
    
   
     public function detail(){
       // $searchdata['search_string']='fund_transfer_history_search';
      
        $searchdata['from_table']='admin_bank_detail';        
        
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
        
         
          if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/Bank_detail/detail'); 
         
            
        $this->show->admin_panel('bank_detail');
              
    }
    
  
    
    public function delete(){
             $delete_detail=$_GET['id'];
             $this->db->where('id',$delete_detail);
             $this->db->delete('admin_bank_detail');
    }
    
    
}