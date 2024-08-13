<?php
class Team extends CI_Controller{
    public function __construct()
    {
        parent::__construct();

        if($this->conn->plan_setting('team_section')!=1){
            $panel_path=$this->conn->company_info('panel_path');
            redirect(base_url($panel_path.'/dashboard'));
            $this->currency=$this->conn->company_info('currency');
           
        }
         $this->panel_url=$this->conn->company_info('panel_path');
         $this->limit=25;
    }
    
    
    public function tree_test(){
        $parent=$_GET['parentid'];
        
        $data['parent_id']=$parent;
        $this->show->user_panel('team_tree_test',$data);

    }
    
    public function get_tree(){
        $post_tree=$_POST['tree_no'];
        $parent_id=$_POST['parent_id'];
        $this->team->new_tree($parent_id,$post_tree);
    }
    
    /*public function team_direct(){
    
     $searchdata['from_table']='users';        
        $conditions['u_sponsor']=$this->session->userdata('user_id');
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(isset($_REQUEST['active_status']) && $_REQUEST['active_status']!=''){
            $likeconditions['active_status']=$_REQUEST['active_status'];
        }
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(added_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/team/team-direct'); 
         
        $data['select_status']=$_REQUEST['active_status'];     
        $this->show->user_panel('team_direct',$data);    
        
    }
    */
    
    
     public function team_direct(){
    
     $searchdata['from_table']='users';        
        $conditions['u_sponsor']=$this->session->userdata('user_id');
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
        }
        if(isset($_REQUEST['active_status']) && $_REQUEST['active_status']!=''){
            $likeconditions['active_status']=$_REQUEST['active_status'];
        }
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(added_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}  
		
	/*	if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
            $this->limit= $limit;
        }*/
          if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        
        if(!empty($conditions)){
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/team/team-direct'); 
         
       $data['select_status']=$_REQUEST['active_status'];     
        $this->show->user_panel('team_direct',$data);    
        
    }
    
    
    
    
     public function team_generation(){
        
        $my_id=$this->session->userdata('user_id');
        $check_my_level_team = $this->team->my_generation($my_id);
        
        if(isset($_REQUEST['selected_user']) && $_REQUEST['selected_user']!=''){
            $this->session->set_userdata('selected_user',$_REQUEST['selected_user']);
        }
        
        if($this->session->has_userdata('selected_user')){
            $user_id=$this->session->userdata('selected_user');
            if($user_id!=$my_id){
                if(!in_array($user_id,$check_my_level_team)){
                    redirect(base_url($this->panel_url.'/team/team_generation?selected_user='.$my_id));
                }
            }
        }else{
            $user_id=$this->session->userdata('user_id');
        }
        
        //echo $user_id;
        //die();
        
        if(isset($_REQUEST['selected_level']) && $_REQUEST['selected_level']!='' && $_REQUEST['selected_level']!='all'){
            $selected_level=$_REQUEST['selected_level'];
            $my_level_team = $this->team->my_level_team($user_id);
        
            $gen_team =  (array_key_exists($selected_level,$my_level_team) ? $my_level_team[$selected_level]:array());
        }else{
            $selected_level=1;
            $gen_team=$my_level_team = $this->team->my_generation($user_id);
        }
       
         
        if(!empty($gen_team)){
            $conditions['id'] = $gen_team;
            $searchdata['from_table']='users';        
            //$conditions['u_sponsor']=$this->session->userdata('user_id');
             
            if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
                $likeconditions['name']=$_REQUEST['name'];
            }
            if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
                $likeconditions['username']=$_REQUEST['username'];
            }
             if(isset($_REQUEST['active_status']) && $_REQUEST['active_status']!=''){
            $likeconditions['active_status']=$_REQUEST['active_status'];
        }
        
        if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $likeconditions=$_REQUEST['limit'];
            //$this->limit= $limit;
        }
        
         if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(added_on BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}  
            if(!empty($likeconditions)){
                $searchdata['likecondition'] = $likeconditions;
            }
            
            if(!empty($conditions)){
                $searchdata['conditions'] = $conditions;
            }
            $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/team/team-generation');
                
        }else{
            $data['table_data']=false;
        }
        $data['check_my_level_team']=$check_my_level_team;
        $data['select_status']=$_REQUEST['active_status'];     
        $this->show->user_panel('team_generation_test',$data); 
        
    }
    
    
    public function team_generation_test(){
        
     if(isset($_REQUEST['selected_level']) && $_REQUEST['selected_level']!=''){
            $this->session->set_userdata('selected_level',$_REQUEST['selected_level']);
        }
         if(!$this->session->has_userdata('selected_level')){
            $this->session->set_userdata('selected_level',1);
        }
        $my_level_team = $this->team->my_level_team($this->session->userdata('user_id'));
        $lvl=$this->session->userdata('selected_level');
        $gen_team =  (array_key_exists($lvl,$my_level_team) ? $my_level_team[$lvl]:array());
        if(!empty($gen_team)){
        $conditions['id'] = $gen_team;
        $searchdata['from_table']='users';        
        //$conditions['u_sponsor']=$this->session->userdata('user_id');
        if(!empty($condition)){
            $searchdata['condition']=$condition;
        }
         
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $likeconditions['name']=$_REQUEST['name'];
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $likeconditions['username']=$_REQUEST['username'];
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
        $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/team/team-generation');
            
        }else{
            $data['table_data']=false;
        }  
            
        $this->show->user_panel('team_generation',$data); 
        
    }
   /* public function team_generation(){
        $my_id=$this->session->userdata('user_id');
        $check_my_level_team = $this->team->my_generation($my_id);
        
        if(isset($_REQUEST['selected_user']) && $_REQUEST['selected_user']!=''){
            $this->session->set_userdata('selected_user',$_REQUEST['selected_user']);
        }
        
        if($this->session->has_userdata('selected_user')){
            $user_id=$this->session->userdata('selected_user');
            if($user_id!=$my_id){
                if(!in_array($user_id,$check_my_level_team)){
                    redirect(base_url($this->panel_url.'/team/team_generation?selected_user='.$my_id));
                }
            }
        }else{
            $user_id=$this->session->userdata('user_id');
        }
        
        //echo $user_id;
        //die();
        
        if(isset($_REQUEST['selected_level']) && $_REQUEST['selected_level']!=''){
            $selected_level=$_REQUEST['selected_level'];
        }else{
            $selected_level=1;
        }
        
        $my_level_team = $this->team->my_level_team($user_id);
        
        $gen_team =  (array_key_exists($selected_level,$my_level_team) ? $my_level_team[$selected_level]:array());
        
        if(!empty($gen_team)){
            $conditions['id'] = $gen_team;
            $searchdata['from_table']='users';        
            //$conditions['u_sponsor']=$this->session->userdata('user_id');
             
            if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
                $likeconditions['name']=$_REQUEST['name'];
            }
            if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
                $likeconditions['username']=$_REQUEST['username'];
            }
             if(isset($_REQUEST['limit']) && $_REQUEST['limit']!=''){
            $limit=$_REQUEST['limit'];
        }
            if(!empty($likeconditions)){
                $searchdata['likecondition'] = $likeconditions;
            }
            
            if(!empty($conditions)){
                $searchdata['conditions'] = $conditions;
            }
            $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/team/team-generation');
                
        }else{
            $data['table_data']=false;
        }
        $data['check_my_level_team']=$check_my_level_team;
        $this->show->user_panel('team_generation_test',$data); 
        
    }*/

    public function team_single_leg(){        
        $data['limit']=10;
        $data['search_string']='single_leg_search'; 
         if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
                $conditions['name']=$_REQUEST['name'];
            }
            if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
                $conditions['username']=$_REQUEST['username'];
            }
        $gen_team =  $this->team->my_single_leg($this->session->userdata('user_id'));
        if(!empty($gen_team)){
            $conditions['id'] = $gen_team;
            $data['from_table']='users';
            $data['base_url']=$this->panel_url.'/team/team-single-leg';        
            $data['conditions']=$conditions;
            $res=$this->paging->searching_data($data);
            $data['table_data']=$res['table_data'];
            $data['sr_no']=$res['sr_no'];
        }else{
            $data['table_data']=false;
        }        
       
        $this->show->user_panel('team_single_leg',$data);
    }

    public function team_left(){
        $data['limit']=10;
        $data['search_string']='left_team_search'; 
        $left_team =  $this->team->team_by_position($this->session->userdata('user_id'),'1');
        if(!empty($left_team)){
            $conditions['id'] = $left_team;
            $data['from_table']='users';
            $data['base_url']=$this->panel_url.'/team/team-left';        
            $data['conditions']=$conditions;
            $res=$this->paging->searching_data($data);
            $data['table_data']=$res['table_data'];
            $data['sr_no']=$res['sr_no'];
        }else{
            $data['table_data']=false;
        }               
        $this->show->user_panel('team_left',$data);
    }

    public function team_right(){
        $data['limit']=10;
        $data['search_string']='right_team_search'; 
        $left_team =  $this->team->team_by_position($this->session->userdata('user_id'),'2');
        if(!empty($left_team)){
            $conditions['id'] = $left_team;
            $data['from_table']='users';
            $data['base_url']=$this->panel_url.'/team/team-right';        
            $data['conditions']=$conditions;
            $res=$this->paging->searching_data($data);
            $data['table_data']=$res['table_data'];
            $data['sr_no']=$res['sr_no'];
        }else{
            $data['table_data']=false;
        }          
        $this->show->user_panel('team_right',$data);
    }
    public function tree_new(){
         if(isset($_REQUEST['node'])){
           $data['node_id']=$_REQUEST['node'];
           }else{
            $data['node_id']=$this->session->userdata('user_id');
        }
        
         

        $this->show->user_panel('team_tree_new',$data);
    }

    public function team_tree(){

        if(isset($_REQUEST['node'])){
            $data['node_id']=$_REQUEST['node'];
        }else{
            $data['node_id']=$this->session->userdata('user_id');
        }
        
        if(isset($_POST['search'])){
                
            $u_code=$this->session->userdata('user_id');
            $username=$_POST['username'];
            $user_detail_id=$this->conn->runQuery('id','users',"username='$username'");
            $u_id=$user_detail_id[0]->id;
            
            $position=$_POST['selected_postion'];
           
            if($position=='right'){
                  $team=$this->team->team_by_position($u_code,2);
                 
            }elseif($position=='left'){
               $team=$this->team->team_by_position($u_code,1);
              
            }else{
                  $team=$this->team->my_generation($u_code);
                
            }
             if(in_array($u_id,$team)){
                  $data['node_id']=$u_id;
                  $this->session->set_flashdata("success", "Your Downline users.");
               
             }else{
                  $data['node_id']=$this->session->userdata('user_id');
                  $this->session->set_flashdata("error", "Users  Not In Your Downline.");  
                } 
        }    

        $this->show->user_panel('team_tree',$data);
    }

    public function team_matrix(){
        if(isset($_REQUEST['node'])){
            $data['node_id']=$_REQUEST['node'];
        }else{
            $data['node_id']=$this->session->userdata('user_id');
        }
        
      if(isset($_POST['search'])){
            $u_code=$this->session->userdata('user_id');
            $user_details_id=$this->conn->runQuery('id','pool',"u_id='$u_code'");
            $matrix_parent_id=$user_details_id[0]->id;
            $teams=$this->team->my_matrix_team($matrix_parent_id);
                   $username=$_POST['username'];
                   $user_detail_id=$this->conn->runQuery('id','users',"username='$username'");
                   $u_id=$user_detail_id[0]->id;
                   $user_details_id_srch=$this->conn->runQuery('id','pool',"u_id='$u_id'");
                    $matrix_parent_id_srch=$user_details_id_srch[0]->id;
                    if($user_details_id_srch && in_array($matrix_parent_id_srch,$teams)){
                          $data['node_id']=$matrix_parent_id_srch;
                          $this->session->set_flashdata("success", "Your Downline users.");
                     }else{
                          $data['node_id']=$this->session->userdata('user_id');
                          $this->session->set_flashdata("error", "Users  Not In Your Downline.");  
                     } 
            }     

        $this->show->user_panel('team_matrix',$data);
    }
    
     public function team_binary_pool(){
        $pool='pool1';
        if(isset($_REQUEST['node'])){
            $data['node_id']=$_REQUEST['node'];
        }else{
            $user_id=$this->session->userdata('user_id');
            $get_node_id=$this->conn->runQuery('*','binary_pool',"u_id='$user_id' and pool_type='$pool' and pool_id='1'");
            $node_id=$get_node_id ? $get_node_id[0]->id:false;
            $data['node_id']=$node_id;
        }
        
     if(isset($_POST['search'])){
         $u_code=$this->session->userdata('user_id');
        
        $user_details_id=$this->conn->runQuery('id','binary_pool',"u_id='$u_code'");
        $matrix_parent_id=$user_details_id[0]->id;
        $teams=$this->team->my_binary_matrix_team($matrix_parent_id);
        
               $username=$_POST['username'];
               $user_detail_id=$this->conn->runQuery('id','users',"username='$username'");
               $u_id=$user_detail_id[0]->id;
              
               $user_details_id_srch=$this->conn->runQuery('id','binary_pool',"u_id='$u_id'");
                  $matrix_parent_id_srch=$user_details_id_srch[0]->id;
             
                if($user_details_id_srch && in_array($matrix_parent_id_srch,$teams)){
                    
                      $data['node_id']=$matrix_parent_id_srch;
                      $this->session->set_flashdata("success", "Your Downline users.");
                   
                 }else{
                      $data['node_id']=$this->session->userdata('user_id');
                      $this->session->set_flashdata("error", "Users  Not In Your Downline.");  
                    
                 } 
            }     
        
        $this->show->user_panel('team_binary_matrix_tree',$data);
    }
    
    public function team_matrix_generation(){
        $pool='pool1';
         if(isset($_REQUEST['node'])){
            $data['node_id']=$_REQUEST['node'];
        }elseif(isset($_POST['submit1'])){
            
            $select_pool=$_POST['select_pool'];	
          
			$this->session->set_userdata("user_selected_pool",$select_pool);
			$user_id=$this->session->userdata('user_id');
            $get_node_id=$this->conn->runQuery('*','pool',"u_id='$user_id' and pool_id='$select_pool' order by id asc");
            $node_id=$get_node_id ? $get_node_id[0]->id:false;
            $data['node_id']=$node_id;//$this->session->userdata('user_id');
			
        }else{
            $user_id=$this->session->userdata('user_id');
            $select_pool=1;	
			$this->session->set_userdata("user_selected_pool",$select_pool);
            $get_node_id=$this->conn->runQuery('*','pool',"u_id='$user_id' and pool_id='1' order by id asc");
            $node_id=$get_node_id ? $get_node_id[0]->id:false;
            $data['node_id']=$node_id;//$this->session->userdata('user_id');
        }
        
        
        /*if(isset($_POST['search'])){
             $u_code=$this->session->userdata('user_id');
            
            $user_details_id=$this->conn->runQuery('id','pool',"u_id='$u_code'");
            $matrix_parent_id=$user_details_id[0]->id;
            $teams=$this->team->my_matrix_team($matrix_parent_id);
            
                   $username=$_POST['username'];
                   $user_detail_id=$this->conn->runQuery('id','users',"username='$username'");
                   $u_id=$user_detail_id[0]->id;
                  
                   $user_details_id_srch=$this->conn->runQuery('id','pool',"u_id='$u_id'");
                      $matrix_parent_id_srch=$user_details_id_srch[0]->id;
                 
                    if($user_details_id_srch && in_array($matrix_parent_id_srch,$teams)){
                        
                          $data['node_id']=$matrix_parent_id_srch;
                          $this->session->set_flashdata("success", "Your Downline users.");
                       
                     }else{
                          $data['node_id']=$this->session->userdata('user_id');
                          $this->session->set_flashdata("error", "Users  Not In Your Downline.");  
                        
                     } 
                }     */
        $this->show->user_panel('team_matrix_generation',$data);
    }
    public function tds(){
        $this->show->user_panel('team_tds_report');
    }
    public function reward(){
        
       if(isset($_POST['add_pass'])){
              
               $params['upload_path']= 'users';            
               $upload_pic=$this->upload_file->upload_image('pro_img',$params);
               $upload_pic_front_img=$this->upload_file->upload_image('front_img',$params);
               $upload_pic_back_img=$this->upload_file->upload_image('back_img',$params);
               
               if($upload_pic['upload_error']==false && $upload_pic_front_img['upload_error']==false && $upload_pic_back_img['upload_error']==false){
                     $update['pro_img'] = base_url().'images/users/'.$upload_pic['file_name'];
                     $update['front_img'] = base_url().'images/users/'.$upload_pic_front_img['file_name'];
                     $update['back_img'] = base_url().'images/users/'.$upload_pic_back_img['file_name'];
                     $update['status'] ='1';
                     $this->db->where('u_code',$this->session->userdata('user_id'));
                     $qury=$this->db->update('rank_bonanza',$update);
                     
                   
                    $this->session->set_flashdata("success", "Image Upload successfully.");
                    redirect(base_url(uri_string())); 
                }else{
                     $this->session->set_flashdata("error", "Something wrong.");
                }
            }
        
        
        $this->show->user_panel('team_reward');
    }
    
     public function single_leg_goal(){
        $this->show->user_panel('team_single_leg_goal');
    }

public function team_getdirect(){
        $my_id=$_GET['selected_user'];
        $check_my_level_team = $this->team->directs($my_id);
       
         $conditions['u_sponsor'] = $my_id;
         $searchdata['from_table']='users';
         
          if(!empty($likeconditions)){
                $searchdata['likecondition'] = $likeconditions;
            }
            
            if(!empty($conditions)){
                $searchdata['conditions'] = $conditions;
            }
          $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/team/team_direct');
          $data['u_id']=$my_id;
          $data['check_my_level_team']=$check_my_level_team;      
          $this->show->user_panel('team_direct',$data); 
   }

   

    
}