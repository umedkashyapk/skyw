<?php
class Plan extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function generation_setting(){
        
        /*if(isset($_POST['change_generation_btn'])){
            $get_all_details=$this->conn->runQuery('*','plan',"max_bv_req>'0'");
            foreach($get_all_details as $plan_details){
                 $update=array();
                 $update['min_bv_req']=$_POST['min_'.$plan_details->id];
                 $update['max_bv_req']=$_POST['max_'.$plan_details->id];
                 $update['rank_per']=$_POST['per_'.$plan_details->id];
                 $update['self_bv_req']=$_POST['self_'.$plan_details->id];
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
            }
        }*/
        
        if(isset($_POST['change_roi_income_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"id<'2'");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['roi']=$_POST['roi_income_'.$plan_details->id];
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
            }
        }
        
        
        if(isset($_POST['change_vip_bonus_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"1='1'");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['vip_bonus']=$_POST['vip_bonus_'.$plan_details->id];
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
            }
        }
        
        
        
        
         if(isset($_POST['change_level_on_roi_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"id<'6'");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['level_on_roi']=$_POST['level_on_roi_'.$plan_details->id];
                 //$update['direct_required']=$_POST['direct_required_'.$plan_details->id];
               
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
            }
        }
        if(isset($_POST['change_dhb_bonus_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"id>'10' and id<15");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['dhb_bonus']=$_POST['dhb_bonus_'.$plan_details->id];
                 
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
            }
        }

        if(isset($_POST['change_runner_bonus_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"id='1'");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['runner_team_business']=$_POST['runner_team_business_'.$plan_details->id];
                 $update['runner_direct']=$_POST['runner_direct_'.$plan_details->id];
                 
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
            }
        }
        
        if(isset($_POST['change__my_rank_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"1='1'");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['rank_income']=$_POST['rank_income_'.$plan_details->id];
                 $update['direct_required']=$_POST['direct_required_'.$plan_details->id];
                 $update['compensation_bonus']=$_POST['compensation_bonus_'.$plan_details->id];
                 $update['team_business']=$_POST['team_business_'.$plan_details->id];
                 
               
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
               
            }
        }

       if(isset($_POST['change_retreat_btn'])){
            $get_direct_plan=$this->conn->runQuery('*','plan',"1='1'");
            foreach($get_direct_plan as $plan_details){
                 $update=array();
                 $update['retreat_bonus_time_limit']=$_POST['retreat_bonus_time_limit_'.$plan_details->id];
                 $update['retreat_bonus']=$_POST['retreat_bonus_'.$plan_details->id];
                 
                 $update['tsv']=$_POST['tsv_'.$plan_details->id];
                 $update['psv']=$_POST['psv_'.$plan_details->id];
                 
               
                 $this->db->where('id',$plan_details->id);
                 $this->db->update('plan',$update);
               
            }
        }
        
         $this->show->admin_panel('plan/generation',array());
         
    }
}