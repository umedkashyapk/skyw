<?php
class Legals extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->panel_url=$this->conn->company_info('admin_path');
    }

    public function pages(){ 
   
      
       
        if(isset($_POST['add_trm_btn'])){
         
          if(isset($_REQUEST['legal_page'])){
            $this->session->set_userdata('page_id',$_REQUEST['legal_page']);
        }
        $pages_id=$this->session->userdata('page_id');
           
          /* $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('desc','Description','required');
            
            if($this->form_validation->run()!=false){*/
               
               $insert['legal_title']= $_POST['title'];
                   $param['upload_path']='legal';
                   $upload_product=$this->upload_file->upload_image('file',$param);
                   if($upload_product['upload_error']==false){
                       $insert['legal_img']= base_url().$upload_product['full_path'];
                   }
               $insert['legal_desc']= $_POST['desc'];
               $insert['lega_page_type']=$pages_id;

              
               $this->db->insert('legal_data',$insert);
              
               if($pages_id=='privacy_policy'){
               $this->session->set_flashdata('success',"Privacy Policy added successfully.");
               redirect(base_url(uri_string()));
               }elseif($pages_id=='term_condition'){
                $this->session->set_flashdata('success',"Terms & Conditions added successfully.");
               redirect(base_url(uri_string()));
               }
               elseif($pages_id=='service'){
                $this->session->set_flashdata('success',"Service added successfully.");
               redirect(base_url(uri_string()));
               }
               elseif($pages_id=='about_us'){
               $this->session->set_flashdata('success',"About Us added successfully.");
               redirect(base_url(uri_string()));
               }
               elseif($pages_id=='our_mission'){
               $this->session->set_flashdata('success',"Our Mission added successfully.");
               redirect(base_url(uri_string()));
               }
               elseif($pages_id=='our_vision'){
               $this->session->set_flashdata('success',"Our Vision added successfully.");
               redirect(base_url(uri_string()));
               }
               elseif($pages_id=='legals'){
               $this->session->set_flashdata('success',"Upload Legals Document successfully.");
               redirect(base_url(uri_string()));
               }elseif($pages_id=='tradingimg'){
               $this->session->set_flashdata('success',"Upload Trading Image successfully.");
               redirect(base_url(uri_string()));
               }elseif($pages_id=='pdf'){
               $this->session->set_flashdata('success',"Upload pdf successfully.");
               redirect(base_url(uri_string()));
               }
               elseif($pages_id=='welcome_letter'){
               $this->session->set_flashdata('success',"Upload Welcome Letter successfully.");
               redirect(base_url(uri_string()));
               }
           /* }else{
                $this->session->set_flashdata('Error',"Invalid Request.");
            }*/
        }
      
        $this->show->admin_panel('add_pages');
    }
    
    
   
    
    public function pages_detail(){ 
        $data['from_table']='legal_data';
        $data['base_url']=$this->panel_url.'/legals/pages-detail';
        $res=$this->paging->searching_data($data);
        $data['table_data']=$res['table_data'];
        $this->show->admin_panel('legal_details',$data); 
    }
   
   
 
    public function edit_page(){
        
        $id=$_GET['edit_id'];
        $data['data']=$this->conn->runQuery('*','legal_data',"id='$id'");
        if(isset($_POST['edit_btn'])){
               $insert['legal_title']= $_POST['title'];
               $insert['legal_desc']= $_POST['desc'];
               $insert['legal_title']= $_POST['title'];
                   $param['upload_path']='legal';
                   $upload_product=$this->upload_file->upload_image('file',$param);
                   if($upload_product['upload_error']==false){
                       $insert['legal_img']= base_url().$upload_product['full_path'];
                   }
                   $this->db->where('id',$id);
                   $this->db->update('legal_data',$insert);
                   $this->session->set_flashdata('success',"Updated successfully.");
                   redirect($_SERVER['HTTP_REFERER']);
            
        }
        
        $this->show->admin_panel('legal_edit',$data);
        
    }
   
      public function delete(){
          
            $delete_id=$_GET['dele_id'];
            $this->db->where('id',$delete_id);
            $this->db->delete('legal_data');
            redirect($_SERVER['HTTP_REFERER']);
      }
    
    public function view(){
        if(isset($_REQUEST['view_id'])){
            $this->session->set_userdata('admin_control_view_id',$_REQUEST['view_id']);
        }
        $control_id=$this->session->userdata('admin_control_view_id');
        $data['control_id']=$control_id;
        $this->show->admin_panel('legal_view',$data);
        
    }
      
    
}