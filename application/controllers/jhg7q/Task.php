<?php
class Task extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        
        $key_data2 = $this->conn->runQuery('*','api_key',"key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }
    
    
    public function ppc(){
        $input_data = $this->conn->get_input();
       if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
            $user_details = $this->conn->runQuery('active_status,my_package','users',"id='$user_id'");
            if($user_details[0]->active_status==1){
                
                $my_packages=$user_details[0]->my_package;
                $pin_details = $this->conn->runQuery('*','pin_details',"business_volumn='$my_packages'");
                $total_ppc=$pin_details[0]->ppc;
                $all_tasks=$this->conn->runQuery("id","ppc_entry","u_code='$user_id'");
                if(!$all_tasks){
                    $all_task=$this->conn->runQuery("id","ppc","type='PPC'  order by id desc");
                    if($all_task){
                        $var=array_column($all_task,'id');
                        shuffle($var);
                        
                        for($i=0;$i<$total_ppc;$i++){
                            $task_ids=$var[$i];
                            $all_taskss=$this->conn->runQuery("*","ppc","type='PPC' and id='$task_ids'  order by id desc");
                            
                            $insert['status']= 0;
                            $insert['task_id']= $task_ids;
                            $insert['title']= $all_taskss[0]->title;
                            $insert['description']= $all_taskss[0]->description;
                            $insert['image']= $all_taskss[0]->image;
                            $insert['link']= $all_taskss[0]->link;
                            $insert['u_code']= $user_id;
                            $this->db->insert('ppc_entry',$insert);
                        }
                    }
                }
                
                $all_tasks_details=$this->conn->runQuery("*","ppc_entry","u_code='$user_id'");
                if($all_tasks_details){
                    $sr=1;
                    foreach($all_tasks_details as $all_tasks_detailss){
                        $detailss = json_decode(json_encode($all_tasks_detailss),true);
                        
                        $data[]=$detailss;
                        $details['data']= $data;
                        $sr++;
                    }
                    
                    }else{
                        $details['data']= array();
                    }
                
                    $details['res']='success';
                    $details['message']='';
                    $result = $details;
                
            }else{
                
                $result['res']='error';
                $result['message']='Please Active Your Account.';
                $result['data']=array();
                
            }
        }else{
            
            $result['res']='error';
            $result['message']='This user does not have account.';
            $result['data']=array();
             
        }
        print_r(json_encode($result)); 
        
    }
    
    
    public function ppv(){
        $input_data = $this->conn->get_input();
       if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
            $user_details = $this->conn->runQuery('active_status,my_package','users',"id='$user_id'");
            if($user_details[0]->active_status==1){
                
                $my_packages=$user_details[0]->my_package;
                $pin_details = $this->conn->runQuery('*','pin_details',"business_volumn='$my_packages'");
                $total_ppc=$pin_details[0]->ppv;
                $all_tasks=$this->conn->runQuery("id","ppv_entry","u_code='$user_id'");
                if(!$all_tasks){
                    $all_task=$this->conn->runQuery("id","ppc","type='PPV'  order by id desc");
                    if($all_task){
                        $var=array_column($all_task,'id');
                        shuffle($var);
                        
                        for($i=0;$i<$total_ppc;$i++){
                            $task_ids=$var[$i];
                            $all_taskss=$this->conn->runQuery("*","ppc","type='PPV' and id='$task_ids'  order by id desc");
                            
                            $insert['status']= 0;
                            $insert['task_id']= $task_ids;
                            $insert['title']= $all_taskss[0]->title;
                            $insert['description']= $all_taskss[0]->description;
                            $insert['image']= $all_taskss[0]->image;
                            $insert['link']= $all_taskss[0]->link;
                            $insert['u_code']= $user_id;
                            $this->db->insert('ppv_entry',$insert);
                        }
                    }
                }
                
                $all_tasks_details=$this->conn->runQuery("*","ppv_entry","u_code='$user_id'");
                if($all_tasks_details){
                    $sr=1;
                    foreach($all_tasks_details as $all_tasks_detailss){
                        $detailss = json_decode(json_encode($all_tasks_detailss),true);
                        
                        $data[]=$detailss;
                        $details['data']= $data;
                        $sr++;
                    }
                    
                    }else{
                        $details['data']= array();
                    }
                
                    $details['res']='success';
                    $details['message']='';
                    $result = $details;
                
            }else{
                
                $result['res']='error';
                $result['message']='Please Active Your Account.';
                $result['data']=array();
                
            }
        }else{
            
            $result['res']='error';
            $result['message']='This user does not have account.';
            $result['data']=array();
             
        }
        print_r(json_encode($result)); 
        
    }
    
    public function ppd(){
        $input_data = $this->conn->get_input();
       if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
            $user_details = $this->conn->runQuery('active_status,my_package','users',"id='$user_id'");
            if($user_details[0]->active_status==1){
                
                $my_packages=$user_details[0]->my_package;
                $pin_details = $this->conn->runQuery('*','pin_details',"business_volumn='$my_packages'");
                $total_ppc=$pin_details[0]->ppd;
                $all_tasks=$this->conn->runQuery("id","ppd_entry","u_code='$user_id'");
                if(!$all_tasks){
                    $all_task=$this->conn->runQuery("id","ppc","type='PPD'  order by id desc");
                    if($all_task){
                        $var=array_column($all_task,'id');
                        shuffle($var);
                        
                        for($i=0;$i<$total_ppc;$i++){
                            $task_ids=$var[$i];
                            $all_taskss=$this->conn->runQuery("*","ppc","type='PPD' and id='$task_ids'  order by id desc");
                            
                            $insert['status']= 0;
                            $insert['task_id']= $task_ids;
                            $insert['title']= $all_taskss[0]->title;
                            $insert['description']= $all_taskss[0]->description;
                            $insert['image']= $all_taskss[0]->image;
                            $insert['link']= $all_taskss[0]->link;
                            $insert['version']= $all_taskss[0]->version;
                            $insert['u_code']= $user_id;
                            $this->db->insert('ppd_entry',$insert);
                        }
                    }
                }
                
                $all_tasks_details=$this->conn->runQuery("*","ppd_entry","u_code='$user_id'");
                if($all_tasks_details){
                    $sr=1;
                    foreach($all_tasks_details as $all_tasks_detailss){
                        $detailss = json_decode(json_encode($all_tasks_detailss),true);
                        
                        $data[]=$detailss;
                        $details['data']= $data;
                        $sr++;
                    }
                    
                    }else{
                        $details['data']= array();
                    }
                
                    $details['res']='success';
                    $details['message']='';
                    $result = $details;
                
            }else{
                
                $result['res']='error';
                $result['message']='Please Active Your Account.';
                $result['data']=array();
                
            }
        }else{
            
            $result['res']='error';
            $result['message']='This user does not have account.';
            $result['data']=array();
             
        }
        print_r(json_encode($result)); 
        
    }
    
    public function ppc_result(){
        $input_data = $this->conn->get_input();
        if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
            $task_id = $input_data['task_id'];
            
            $all_taskss=$this->conn->runQuery("*","ppc_result","u_code='$user_id' and task_id='$task_id'");
            if(!$all_taskss){                
                $insert['status']= 1;
                $insert['task_id']= $task_id;
                $insert['u_code']= $user_id;
                $this->db->insert('ppc_result',$insert);
                
                $all_tasks_details=$this->conn->runQuery("*","ppc_entry","u_code='$user_id' and task_id='$task_id'");
                if($all_tasks_details){
                    
                    $this->db->set('status',1);
                    $this->db->where('task_id',$task_id);
                    $this->db->where('u_code',$user_id);
                    $this->db->update('ppc_entry');
                    
                }
                
                $result['res']='success';
                $result['message']='';
                
            }else{
                
                $result['res']='error';
                $result['message']='Alleady Complete This Task.';
                $result['data']=array();
            }
        }
        
               print_r(json_encode($result)); 
    }    
            
    
    public function ppd_result(){
        $input_data = $this->conn->get_input();
        if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
            $task_id = $input_data['task_id'];
            
            $all_taskss=$this->conn->runQuery("*","ppd_result","u_code='$user_id' and task_id='$task_id'");
            if(!$all_taskss){                
                $insert['status']= 1;
                $insert['task_id']= $task_id;
                $insert['u_code']= $user_id;
                $this->db->insert('ppd_result',$insert);
                
                $all_tasks_details=$this->conn->runQuery("*","ppd_entry","u_code='$user_id' and task_id='$task_id'");
                if($all_tasks_details){
                    
                    $this->db->set('status',1);
                    $this->db->where('task_id',$task_id);
                    $this->db->where('u_code',$user_id);
                    $this->db->update('ppd_entry');
                    
                }
                
                $result['res']='success';
                $result['message']='';
                
            }else{
                
                $result['res']='error';
                $result['message']='Alleady Complete This Task.';
                $result['data']=array();
            }
        }
        
               print_r(json_encode($result)); 
    }    
            
    
    public function ppv_result(){
        $input_data = $this->conn->get_input();
        if(isset($input_data['u_id'])){
            $user_id = $input_data['u_id'];
            $task_id = $input_data['task_id'];
            
            $all_taskss=$this->conn->runQuery("*","ppv_result","u_code='$user_id' and task_id='$task_id'");
            if(!$all_taskss){                
                $insert['status']= 1;
                $insert['task_id']= $task_id;
                $insert['u_code']= $user_id;
                $this->db->insert('ppv_result',$insert);
                
                $all_tasks_details=$this->conn->runQuery("*","ppv_entry","u_code='$user_id' and task_id='$task_id'");
                if($all_tasks_details){
                    
                    $this->db->set('status',1);
                    $this->db->where('task_id',$task_id);
                    $this->db->where('u_code',$user_id);
                    $this->db->update('ppv_entry');
                }
                
                $result['res']='success';
                $result['message']='';
                
            }else{
                
                $result['res']='error';
                $result['message']='Alleady Complete This Task.';
                $result['data']=array();
            }
        }
        print_r(json_encode($result)); 
    }    
            
    
}