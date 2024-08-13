<?php
class Advance extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
         $this->panel_url=$this->conn->company_info('admin_path');
    }

   public function alert(){
            $data['search_string']='admin_advance_search';
            $data['limit']=25;
            $data['from_table']='notice_board';
            $data['base_url']=$this->panel_url.'advance/alert';
            $res=$this->paging->searching_data($data);
            $data['table_data']=$res['table_data'];
            $data['sr_no']=$res['sr_no'];
            $this->show->admin_panel('advance_alert',$data);
   }
   
   public function add_alert(){
          $data=array();
          if(isset($_POST['alert_btn'])){
              
              
			$this->form_validation->set_rules('alert_type', 'Alert type', 'required');
			 

			if($_POST['alert_type']=='marquee'){
				$this->form_validation->set_rules('title', 'Title', 'required');
			    $this->form_validation->set_rules('description', 'Description', 'required');
			}
			
			if($this->form_validation->run()){ 
			    $alert['type']=	isset($_POST['alert_type']) ? $_POST['alert_type']:'';	 
			    $alert['title']=	isset($_POST['title']) ? $_POST['title']:'';	 
			    $alert['description']=	isset($_POST['description']) ? $_POST['description']:'';
			    $params['upload_path']= 'alerts'; 
                $upload_pic=$this->upload_file->upload_image('file',$params);
			     
			    $alert['img_path']=	$upload_pic['upload_error']==false ? base_url().'images/alerts/'.$upload_pic['file_name']:'';
			    $this->db->insert('notice_board',$alert);
			    
			    $this->session->set_flashdata("alert_success", "Alert Added Successfully.");
			    redirect($_SERVER['HTTP_REFERER']); 
			}			
		}
          
          
          $this->show->admin_panel('alert',$data);
          
          
      } 
      
      
       public function edit(){
        if(isset($_REQUEST['edit_enable'])){
            $this->session->set_userdata('admin_edit_user',$_REQUEST['edit_enable']);
             $edit_user=$this->session->userdata('admin_edit_user');
         if($edit_user){
             
          $news_event=$this->conn->runQuery('*','notice_board',"status='0' and id='$edit_user'");
          $update['status']=$news_event[0]->status;
        
           $this->db->where('id',$edit_user);
            if($this->db->update('notice_board',$update)){                
                $this->session->set_flashdata("success", "Status Updated successfully.");
                redirect($_SERVER['HTTP_REFERER']); 
            }else{                
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect($_SERVER['HTTP_REFERER']); 
            } 
         }
         
        }
       
         if(isset($_REQUEST['edit_disable'])){
           $this->session->set_userdata('admin_disable_user',$_REQUEST['edit_disable']);
            $edit_disable_user=$this->session->userdata('admin_disable_user');
            
           
         if($edit_disable_user){
             
          $news_event=$this->conn->runQuery('*','notice_board',"id='$edit_disable_user'");
          $update['status']=1;
        
           $this->db->where('id',$edit_disable_user);
            if($this->db->update('notice_board',$update)){                
                $this->session->set_flashdata("success", "Status Updated successfully.");
                redirect($_SERVER['HTTP_REFERER']); 
            }else{                
                $this->session->set_flashdata("error", "Something Wrong.");
                redirect($_SERVER['HTTP_REFERER']); 
            } 
         }
        
        }
       
      $this->show->admin_panel('advance_alert');
    }
      public function delete(){
        if(isset($_REQUEST['alert'])){
          $this->db->delete('notice_board', array('id' => $_REQUEST['alert']));
          $admin_path=$this->conn->company_info('admin_path');
          $this->session->set_flashdata("alert_success", "Alert Deleted successfully.");
          redirect($_SERVER['HTTP_REFERER']); 
        }
    
         
      }
      
      
     public function edit_alert(){
          
         if(isset($_REQUEST['alert_id'])){
            $this->session->set_userdata('admin_edit_alert',$_REQUEST['alert_id']);
        }
        $edit_id=$this->session->userdata('admin_edit_alert');

          $data=array();
          if(isset($_POST['edit_alert_btn'])){
         
			  $this->form_validation->set_rules('title', 'Title', 'required');
			  $this->form_validation->set_rules('description', 'Description', 'required');
			
			if($this->form_validation->run()){ 
			   
			    $alertupdate['title']=	isset($_POST['title']) ? $_POST['title']:'';	 
			    $alertupdate['description']=	isset($_POST['description']) ? $_POST['description']:'';
			   /* $params['upload_path']= 'alerts'; 
                $upload_pic=$this->upload_file->upload_image('file',$params);
			    $alertupdate['img_path']=	$upload_pic['upload_error']==false ? base_url().'images/alerts/'.$upload_pic['file_name']:'';*/
    			 $this->db->where('id',$edit_id);
                if($this->db->update('notice_board',$alertupdate)){  
    			   
    			  $this->session->set_flashdata("alert_success", "Alert Updated Successfully.");
    			  
    			}			
    		}
          
           
          
      } 
        $data['up_id']=$edit_id;
        $this->show->admin_panel('alert_edit',$data);
          
      }
         
      
   
}