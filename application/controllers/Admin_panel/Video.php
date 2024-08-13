<?php
class Video extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->limit=10;
        $this->admin_url=$this->conn->company_info('admin_path');
    }

 
    public function index(){
            if(isset($_POST['add_video_btn'])){
              
               $params['upload_path']= 'video';            
               $upload_pic=$this->upload_file->upload_vedio('pro_video',$params);
                  
                $this->form_validation->set_rules('title','Title','required');
                $this->form_validation->set_rules('description','Description','required');
               
                
                
                if($upload_pic['upload_error']==false && $this->form_validation->run() != False){
                    $update11['pro_video'] = base_url().'images/video/'.$upload_pic['file_name'];
                    
                     $update11['status'] =0;
                     $update11['title'] =$_POST['title'];
                     $update11['description'] =$_POST['description'];
                     
                     
                     $qury=$this->db->insert('youtube_video',$update11);
                   
                    $this->session->set_flashdata("success", "Vedio Upload successfully.");
                    redirect(base_url(uri_string())); 
                }else{
                     $this->session->set_flashdata("error", "Something wrong.");
                }
            }
          $this->show->admin_panel('video/video');
     } 
     
      public function list(){
        
        $searchdata['from_table']='youtube_video';
         
        
        $data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'video/list');
       
        $this->show->admin_panel('video/list',$data);
        
         
    }
    public function view(){
       $delete_id=$_GET['id'];
       $this->db->where('id',$delete_id);
       $this->db->delete('youtube_video');
       redirect($_SERVER['HTTP_REFERER']);
        
    }
        
    
}