<?php
class Settings extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
    }

    public function index(){
       
        $this->show->super_admin_panel('settings/list');
    }
    public function register(){

       
        $this->show->super_admin_panel('settings/register');
    }
    public function set(){
        $title=$_GET['title'];
        
        
        $data['table_data']=$this->conn->runQuery('*','advanced_info',"title='$title' and type!='not_edit'");
        
        $this->show->super_admin_panel('settings/setting_page',$data);
    }
    public function set_details(){
        $label=$_POST['label'];
        //$value=$_POST['value'];
        if(is_array($_POST['value'])){
            $value=json_encode($_POST['value']);
        }else{
            $value=$_POST['value'];
        }
        
        if($value!=''){
            $this->db->set('value',$value);
            $this->db->where('label',$label);
            $this->db->update('advanced_info'); 
        }
        
        //echo 'hrer';
    }
    
    public function set_admin_status(){
        $label=$_POST['label'];
        $value=$_POST['value'];
        
        
        if($value!=''){
            $this->db->set('admin_status',$value);
            $this->db->where('label',$label);
            $this->db->update('advanced_info'); 
        }
        
        
    }
    
    public function test(){
         
       $arr=array(
           'alnum' => 'Alpha-Numeric',
           'numeric' => 'Numeric Only',
           'alpha' => 'Alpha Only',
           );
           print_r(json_encode($arr));
    }
     
    
}