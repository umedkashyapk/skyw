<?php
class Upline extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->currency=$this->conn->company_info('currency');
        $this->admin_url=$this->conn->company_info('admin_path');
        $this->limit=10;
    }

    public function test(){ 
        // $conditions['active_status']=1;
        $searchdata['from_table']='users';
        
        $upline_users = array();
         
      if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
         
        
            $usr=$this->profile->id_by_username($_REQUEST['username']);
          
            $spo=$this->profile->profile_info($usr,'u_sponsor');  
           
            if($spo->u_sponsor){
                $conditions['id'] = $spo->u_sponsor;
            }
            $upline_date = $this->profile->profile_info($spo->u_sponsor);
            
           
         }
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        
        
        //$data = $this->paging->search_response($searchdata,$this->limit,$this->admin_url.'/upline');
         
        $this->show->admin_panel('upline',$data); 
    }
    
    
    public function index(){
                 $upline_users = array(); // Array to store the upline users
                if (isset($_REQUEST['username']) && $_REQUEST['username'] != '') {
                    $usr = $this->profile->id_by_username($_REQUEST['username']);
                   
                
                    for ($i = 0; $i < 30; $i++) {// Loop until you have 30 upline users
                        $spo = $this->profile->profile_info($usr, 'u_sponsor');
                        
                        if ($spo->u_sponsor) {
                             
                
                            // Get the upline user based on the conditions (assuming you have a function for this)
                            $upline_user = $this->profile->profile_info($spo->u_sponsor);
                
                            if ($upline_user) {
                                $upline_users[] = $upline_user;
                            }
                
                            // Set the current user as the sponsor for the next iteration
                            $usr = $spo->u_sponsor;
                        } else {
                            // If there is no sponsor, break the loop
                            break;
                        }
                    }
                
        }
         
        $data['data']= json_decode( json_encode($upline_users), true);
        
         
         $this->show->admin_panel('upline',$data); 
        


    }


 
     
    
  
}