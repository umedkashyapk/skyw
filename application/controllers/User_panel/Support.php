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
        $this->limit=20;
         $this->panel_url=$this->conn->company_info('panel_path');
    }

    public function index(){
        if(isset($_POST['send'])){
            $this->form_validation->set_rules('description', 'Description', 'required');
            
            if($this->form_validation->run() != False){
                $support['message']=$_POST['description'];
                $support['first_name']=$this->session->userdata('profile')->name;
                $support['u_code']=$this->session->userdata('profile')->id;
                $support['email']=$this->session->userdata('profile')->email;
                $support['contactno']=$this->session->userdata('profile')->mobile;
                $tk=$support['ticket']='TK'.random_string('alnum', 8);
                $support['status']=0;
               
                $support['reply_status']=0;
                if($this->db->insert('support',$support)){
                    $this->session->set_flashdata("success", "$tk Ticket Generated successfully.");
                    redirect(base_url(uri_string()));
                }else{
                    $this->session->set_flashdata("error", "Something Wrong.");
                    redirect(base_url(uri_string()));
                }

            }
        }


        $limit=$this->limit;
        $conditions['u_code'] = $this->session->userdata('user_id');        
        $searchdata['from_table']='support';
        $searchdata['base_url']=$base_url=base_url().$this->panel_url.'/support';  
       
        if(isset($_REQUEST['status']) && $_REQUEST['status']!='all'){
            $conditions['status']=$_REQUEST['status'];
        }

        if(isset($_REQUEST['ticket']) && $_REQUEST['ticket']){
            $conditions['ticket']=$_REQUEST['ticket'];
        }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
          
       
        $data = $this->paging->search_response($searchdata,$limit,$this->panel_url.'/support'); 
        $data['base_url']=$base_url;
         
        $this->show->user_panel('support',$data);
        
    }

    

     

     

}