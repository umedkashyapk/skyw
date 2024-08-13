<?php
class Task extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->panel_url=$this->conn->company_info('admin_path');
    }

    public function index(){
        
        $this->show->admin_panel('index');
    }
    
    public function task_history(){

        $data['limit']=10;
        $data['search_string']='admin_task_search';
        $data['from_table']='task_history';
        $data['base_url']=$this->admin_url.'/task/task-history';
        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];
        $data['sr_no']=$res['sr_no'];
       
        $this->show->admin_panel('task_history',$data);
    }
    
    public function add(){
        if(isset($_POST['add_btn'])){
            
            $this->form_validation->set_rules('task_name', 'Task name', 'required');
            $this->form_validation->set_rules('product_description', 'Product Description', 'required');
            $this->form_validation->set_rules('product_link', 'Product Link', 'required');
            $this->form_validation->set_rules('product_mrp', 'Product Mrp', 'required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            $this->form_validation->set_rules('task_date', 'Task Date', 'required');
            
            $params['upload_path']= 'task'; 
            $upload_pic=$this->upload_file->upload_image('task_image',$params);
           
            
            if($this->form_validation->run() != False  && $upload_pic['upload_error']==false){
                
                $taskAdd['product_link']=$_POST['product_link'];
                $taskAdd['product_description']=$_POST['product_description'];
                $taskAdd['product_mrp']=$_POST['product_mrp'];
                $taskAdd['product_name']=$_POST['product_name'];
                $taskAdd['heading1']=$_POST['task_name'];
                //$taskAdd['content1']=$_POST['link'];
               // $taskAdd['task_amount']=$_POST['amount'];
                $taskAdd['task_time']=$_POST['task_date'];
                // $taskAdd['task_link']=$_POST['task_type'];
                $taskAdd['added_on']=date('Y-m-d H:i:s');
                $taskAdd['task_image'] = base_url().'images/task/'.$upload_pic['file_name'];
                $this->db->insert('task_data',$taskAdd);
               
                $smsg="Watch Ads added successfully.";
                $this->session->set_flashdata("success", $smsg);
                redirect(base_url(uri_string()));
            }
        }
        
        $data['limit']=10;
        $data['search_string']='admin_add_task_search';
        $data['from_table']='task_data';
        $data['base_url']=$this->panel_url.'/task/add';
        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];
        $data['sr_no']=$res['sr_no'];
        
        $this->show->admin_panel('task_add',$data);
    }
    
     public function disable(){
          if(isset($_GET['task_id'])){
                $task_id=$_GET['task_id'];
                $set['status']="0";
                $this->db->where('id',$task_id);
                $this->db->update('task_data',$set);
                redirect(base_url($this->conn->company_info('admin_path').'/task/add'));
                //redirect(base_url(uri_string()));
          }
      } 
      
      public function enable(){
          if(isset($_GET['task_id'])){
                $task_id=$_GET['task_id'];
               
                $this->db->where('id',$task_id);
                $this->db->delete('task_data');
                redirect(base_url($this->conn->company_info('admin_path').'/task/add'));
                //redirect(base_url(uri_string()));
          }
      }  
      
      
      public function watch_request(){
          
        $searchdata['from_table']='task_data_request'; 
        $conditions['type']='watch_ads'; 
        
         if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $spo=$this->profile->column_like($_REQUEST['username'],'username'); 
            if($spo){
                $conditions['u_code'] = $spo;
            }
        }
       
        if(isset($_REQUEST['req_status']) && $_REQUEST['req_status']!=''){
            $conditions['req_status'] = $_REQUEST['req_status'];
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/watch-request'); 
         
            
        $this->show->admin_panel('task_watch_request',$data);    
        
        
    }
    
    
      public function request_view(){
         $req_id=$_GET['id'];
         
        if(isset($_POST['approve_btn'])){
           if($_POST['req_status']=='1'){
                $req_status=$_POST['req_status'];
                $this->db->set('req_status',$req_status);
                $this->db->where('id',$req_id);
                $this->db->update('task_data_request');
                $smsg="Request Approved Successfully.";
                $this->session->set_flashdata("success", $smsg);
                   
             }
        }
         $data['task_id']=$req_id;
         $this->show->admin_panel('task_watch_view',$data);    
          
      }
     
      
    
}