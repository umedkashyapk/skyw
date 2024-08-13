<?php
class Distribute_model extends CI_Model{
    public function __construct()
    {
         $this->gen_plan = array(
            1 => array(
                37 => array(1=>'7',2=>'1.5',3=>'1'),
                41 => array(1=>'3',2=>'1',3=>'0.5'),
                42 => array(1=>'0.6',2=>'0.3',3=>'0.2'),
            ),
            2 => array(
                37 => array(1=>'7',2=>'4',3=>'2',4=>'1.5',5=>'1'),
                41 => array(1=>'3',2=>'2',3=>'1',4=>'1',5=>'0.5'),
                42 => array(1=>'0.6',2=>'0.5',3=>'0.4',4=>'0.3',5=>'0.2'),                
            ),
         );

    }
    
    
    function new_level_destribute($u_code,$amount,$no_of_levels=15){
        $code=$u_code;
       
        $ben_from=$u_code;
        $incomes=array();

        $l=1;

        $profile_info=$this->profile->profile_info($ben_from,'name,username');
        $name=$profile_info->name;
        $username=$profile_info->username;

        $plan=$this->conn->runQuery('*','plan','1=1');
        if($plan){
            $level_income=array_column($plan,'direct_income','id');
            while($code!=''){
                $source =($l==1 ? 'direct' : "level");
                $currenct_payout_id=$this->wallet->currenct_payout_id();
               
                $level_per=$level_income[$l];
                $payable=$amount*$level_per/100;
               
               
                
                $sponsor = $this->profile->sponsor_info($code,'id,active_status');
                $code = ($sponsor && $sponsor->active_status=='1'? $sponsor->id:'');
                
                $income=array();
                if($payable>0 && $code!='' ){
                    $income['tx_u_code']=$ben_from;
                    $income['u_code']=$code;
                    $income['tx_type']='income';
                    $income['source']=$source;
                    $income['debit_credit']='credit';
                    $income['amount']=$payable;
                    //$income['tx_charge']=$payable*5/100;
                    $income['date']=date('Y-m-d H:i:s');
                    $income['status']=1;
                    //$income['payout_id']=$currenct_payout_id;
                    $income['tx_record']=$l;
                    $income['remark']="Recieve $source income of amount $payable from $name ($username) from level $l";                   
                    
                    if($this->db->insert('transaction',$income)){
                        
                        $income_lvl=$income['amount'];//-$income['tx_charge'];
                        $this->update_ob->add_amnt($code,$source,$income_lvl);
                        $this->update_ob->add_amnt($code,'main_wallet',$income_lvl);
                        
             
                    }
                   // $incomes[]=$income;
                    
                }

                
                if($l>=$no_of_levels){
                    break;
                }
                $l++;
            }

        }
               
        
        /*if(!empty($incomes)){    
            //$this->db->insert_batch('transaction',$incomes);
        }*/

    }

    function level_destribute($u_code,$amount,$no_of_levels=15){
        $code=$u_code;
       
        $ben_from=$u_code;
        $incomes=array();

        $l=1;

        $profile_info=$this->profile->profile_info($ben_from,'name,username');
        $name=$profile_info->name;
        $username=$profile_info->username;

        $plan=$this->conn->runQuery('*','plan','1=1');
        if($plan){
           // $level_income=array_column($plan,'level_income','id');
            while($code!=''){
                $source ="upline";//($l==1 ? 'direct' : "level");
                $currenct_payout_id=$this->wallet->currenct_payout_id();
               
                //$level_per=$level_income[$l];
                $payable=$amount*5/100;
               
               
                
                $sponsor = $this->profile->sponsor_info($code,'id,active_status');
                $code = ($sponsor && $sponsor->active_status=='1'? $sponsor->id:'');
                
                $income=array();
                if($payable>0 && $code!='' ){
                    $income['tx_u_code']=$ben_from;
                    $income['u_code']=$code;
                    $income['tx_type']='income';
                    $income['source']=$source;
                    $income['debit_credit']='credit';
                    $income['amount']=$payable;
                    //$income['tx_charge']=$payable*5/100;
                    $income['date']=date('Y-m-d H:i:s');
                    $income['status']=1;
                    //$income['payout_id']=$currenct_payout_id;
                    $income['tx_record']=$l;
                    $income['remark']="Recieve $source income of amount $payable from $name ($username) from level $l";                   
                    
                    if($this->db->insert('transaction',$income)){
                        
                        $income_lvl=$income['amount'];//-$income['tx_charge'];
                        $this->update_ob->add_amnt($code,$source,$income_lvl);
                        $this->update_ob->add_amnt($code,'main_wallet',$income_lvl);
                        
                        $this->update_ob->add_amnt($ben_from,'main_wallet',-$income_lvl);
                    }
                   // $incomes[]=$income;
                    
                }

                
                if($l>=$no_of_levels){
                    break;
                }
                $l++;
            }

        }
               
        
        /*if(!empty($incomes)){    
            //$this->db->insert_batch('transaction',$incomes);
        }*/

    }
    
    function matrix_destribute($matrix_id,$amount,$no_of_levels=15){
        $source='matrix_level';
        $pool_info=$this->profile->pool_info($matrix_id);
        if(!$pool_info){
            return false;
        }
        $u_code=$pool_info[0]->u_id;
        $ben_from=$u_code;
        $profile_info=$this->profile->profile_info($ben_from,'name,username');
        $name=$profile_info->name;
        $username=$profile_info->username;
        
        $incomes=array();
        $plan=$this->conn->runQuery('matrix_income,id','plan','1=1');
        $level_income=array_column($plan,'matrix_income','id');
        
        $currenct_payout_id=$this->wallet->currenct_payout_id();
        $level_distribution_in=$this->conn->setting('level_distribution_in');
        
        for($l=1;$l<=$no_of_levels;$l++){
            
            $pool_parent=$this->profile->pool_parent($matrix_id);
            if($pool_parent){
                $matrix_id=$pool_parent;
                $parent_info=$this->profile->pool_info($matrix_id);
                $u_code=$parent_info[0]->u_id;
                
                
                if($level_distribution_in=='fix'){
                    $level_per=$level_income[$l];
                    $payable=$level_per;
                }else{
                    $level_per=$level_income[$l];
                    $payable=$amount*$level_per/100;
                }
                
                if($payable>0){
                    $income['tx_u_code']=$ben_from;
                    $income['u_code']=$u_code;
                    $income['tx_type']='income';
                    $income['source']=$source;
                    $income['debit_credit']='credit';
                    $income['amount']=$payable;
                   /// $income['tx_charge']=$payable*5/100;
                    $income['date']=date('Y-m-d H:i:s');
                    $income['status']=1;
                    $income['payout_id']=$currenct_payout_id;
                    $income['tx_record']=$l;
                    $income['remark']="Recieve $source income of amount $payable from $name ($username) from level $l";
                    if($this->db->insert('transaction',$income)){
                        $income_lvl=$payable;
                        $this->update_ob->add_amnt($u_code,$source,$income_lvl);
                        $this->update_ob->add_amnt($u_code,'main_wallet',$income_lvl);
                    }
                   // $incomes[]=$income;
                    
                }
                
            }
            
            
        }
        /*if(!empty($incomes)){    
            //$this->db->insert_batch('transaction',$incomes);
        }*/

    }
    
    public function order_distribute($u_code,$id){
        $amnt_8000=8000;
        
        $order_details=$this->conn->runQuery('*','orders',"id='$id' and closing_status='0' and status='1'");
         
        if($order_details){
            $order_detail=$order_details[0];
            $order_bv= $order_detail->order_bv;
             switch ($order_bv) {
                case $order_bv<=$amnt_8000:
                    if($order_bv!=''){
                        $this->distribute_income($u_code,$order_bv);
                        $this->upgrade_rank($u_code,$order_bv);
                    }
                    break;
                case $order_bv>$amnt_8000:
                      if($order_bv!=''){
                        $this->distribute_income($u_code,$amnt_8000);
                        $this->upgrade_rank($u_code,$amnt_8000);
                        $pnding_amnt=$order_bv-$amnt_8000;
                        $this->distribute_income($u_code,$pnding_amnt);
                        $this->upgrade_rank($u_code,$pnding_amnt);
                      }
                    break;
            }
            $order_id=$order_detail->id;
            $this->db->set('closing_status','1');
            $this->db->where('id',$order_id);
            $this->db->update('orders');
        }
    }
    
    public function distribute_income($u_code,$amnt){        

        $ben_from=$u_code;
        $source='test';
        $pre_level_per=$level_per=0;
        $l=0;
        
        $nxt='yes';
        
        $currenct_payout_id=$this->wallet->currenct_payout_id();
        
        while($nxt=='yes'){
            $nxt='no';
            
            
            $my_rank_per=$this->profile->my_rank_per($u_code);
            $pre_level_per=$level_per;
            if($my_rank_per && $my_rank_per>$level_per){                
                $curr_per=$my_rank_per-$level_per;
                $level_per=$my_rank_per;
                $payable=$amnt*$curr_per/100;
                
                if($payable>0){
                    $income=array();
                    $income['tx_u_code']=$ben_from;
                    $income['u_code']=$u_code;
                    $income['tx_type']='income';
                    $income['source']=$source;
                    $income['debit_credit']='credit';
                    $income['amount']=$payable;
                    $income['date']=date('Y-m-d H:i:s');
                    $income['status']=1;
                    $income['payout_id']=$currenct_payout_id;
                    $income['user_prsnt']=$my_rank_per;
                    $income['distribute_per']=$curr_per;
                    $income['remark']="Recieve $source income of amount $payable from level $l";
                    $this->db->insert('transaction',$income);
                    $l++;
                }                
            }            
            
            if($my_rank_per>=37 && $pre_level_per==$my_rank_per){
                $this->gen_distribute($u_code,$my_rank_per,$amnt);
            }
            
            $u_code=$this->profile->sponsor($u_code);
            if($u_code){
                $nxt='yes';
            }
        }        
    } 
    

    public function upgrade_rank($u_code,$amnt){
        
        
        $my_rank_per=$this->profile->my_rank_per($u_code);
        
        echo "<br>$u_code $amnt $my_rank_per";
        switch ($my_rank_per) {
            case 0:
                $this->upgrade($u_code,1);
                break;
            case 17:
                $this->upgrade($u_code,2);
                break;                     
            case 27:
                $this->rank_check_nxt($u_code,3);
                break;                     
           
        }
        //echo "<br>upgrade $u_code $amnt";
    }
    
    public function upgrade($u_code,$rank_id){
        echo "<br>$u_code $rank_id";
        
        
        $plan=$this->conn->runQuery('*','plan',"id='$rank_id'")[0];
        if($rank_id=='1'){
            $check_order=$this->conn->runQuery('SUM(order_bv) as amnt','orders',"u_code='$u_code' and status='1'");
            
            if($check_order && $check_order[0]->amnt!='' && $check_order[0]->amnt>=8000){
                
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=1;
                    $rank['complete_date']=date('Y-m-d H:i:s');
                    $this->db->insert('rank',$rank);
                    $sponsor=$this->profile->sponsor($u_code);
                    if($sponsor){
                        $this->upgrade($sponsor,2);
                    }
                    echo '<br>rank updated';
                }
            }
        }

        if($rank_id=='2'){
            $rank_ids=$this->team->downline_rank_team($u_code,17);
            if(!empty($rank_ids) && count($rank_ids)>=4){
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=1;
                    $rank['complete_date']=date('Y-m-d H:i:s');
                    $this->db->insert('rank',$rank);
                    $sponsor=$this->profile->sponsor($u_code);
                    if($sponsor){
                        $this->rank_check_nxt($sponsor,3);
                    }
                }
            }
            
            $check_order=$this->conn->runQuery('SUM(order_bv) as amnt','orders',"u_code='$u_code' and status='1'");
            if($check_order && $check_order[0]->amnt!='' && $check_order[0]->amnt>=$plan->required_business){
                
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=1;
                    $rank['complete_date']=date('Y-m-d H:i:s');
                    $this->db->insert('rank',$rank);
                    
                    $free_pin=4;
                    for($f=0;$f<$free_pin;$f++){
                        $pin=random_string('alnum', 14);
                        $insert_pin=array();
                        $insert_pin['pin']=$pin;
                        $insert_pin['u_code']=$u_code;
                        $insert_pin['status']=1;
                        $insert_pin['use_status']=0;
                        $insert_pin['pin_type']='free_pin';
                        $this->db->insert('epins',$insert_pin);
                    }
                    $sponsor=$this->profile->sponsor($u_code);
                    if($sponsor){
                        $this->rank_check_nxt($sponsor,3);
                    }
                }
            }
        }
        
        

    }
    
    public function rank_check_nxt($u_code,$rank_id){
        $plan=$this->conn->runQuery('*','plan',"id='$rank_id'")[0];
        if($rank_id==3){
            $rank_ids=$this->team->downline_rank_team($u_code,27);
            if(!empty($rank_ids) && count($rank_ids)>=3){
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=1;
                    $rank['complete_date']=date('Y-m-d H:i:s');
                    $this->db->insert('rank',$rank);
                    $sponsor=$this->profile->sponsor($u_code);
                    if($sponsor){
                        $this->rank_check_nxt($sponsor,4);
                    }
                }
            }
            $check_order=$this->conn->runQuery('SUM(order_bv) as amnt','orders',"u_code='$u_code' and status='1'");
            if($check_order && $check_order[0]->amnt!='' && $check_order[0]->amnt>=$plan->required_business){
                
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=1;
                    $rank['complete_date']=date('Y-m-d H:i:s');
                    $this->db->insert('rank',$rank);
                    
                    $free_pin=12;
                    for($f=0;$f<$free_pin;$f++){
                        $pin=random_string('alnum', 14);
                        $insert_pin=array();
                        $insert_pin['pin']=$pin;
                        $insert_pin['u_code']=$u_code;
                        $insert_pin['status']=1;
                        $insert_pin['use_status']=0;
                        $insert_pin['pin_type']='free_pin';
                        $this->db->insert('epins',$insert_pin);
                    }
                    $sponsor=$this->profile->sponsor($u_code);
                    if($sponsor){
                        $this->rank_check_nxt($sponsor,4);
                    }
                }
            }
            
        }
        if($rank_id==4){
            $rank_ids=$this->team->downline_rank_team($u_code,37);
            if(!empty($rank_ids) && count($rank_ids)>=4){
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=0;
                    $this->db->insert('rank',$rank);
                    
                }
            }
            $check_order=$this->conn->runQuery('SUM(order_bv) as amnt','orders',"u_code='$u_code' and status='1'");
            if($check_order && $check_order[0]->amnt!='' && $check_order[0]->amnt>=$plan->required_business){
                
                $check_exists=$this->conn->runQuery('*','rank',"u_code='$u_code' and rank_id='$plan->id'");
                if(!$check_exists){
                    $rank=array();
                    $rank['rank']=$plan->rank;
                    $rank['u_code']=$u_code;
                    $rank['rank_per']=$plan->r_per;
                    $rank['rank_id']=$plan->id;
                    $rank['is_complete']=0;
                    $this->db->insert('rank',$rank);
                }
            }
            
        }
        if($rank_id==3){
            $sponsor=$this->profile->sponsor($u_code);
            if($sponsor){
                $this->rank_check_nxt($sponsor,$rank_id);
            }
        }
        
    }
    
    public function gen_distribute($u_code,$my_rank_per,$amnt){
        
        ///////////////// plan //////////////
        $plan=$this->gen_plan;
        $ben_from=$u_code;
        $source='gen';
        $nxt='yes';
        $lvl=1;
        $currenct_payout_id=$this->wallet->currenct_payout_id();
        
        while ($nxt=='yes') {
            $nxt='no';
            $rankper=$this->profile->my_rank_per($u_code);

            $curr_business=$this->conn->runQuery('SUM(order_bv) as sm','orders',"u_code='$u_code' and payout_id='$currenct_payout_id'")[0]->sm;
            if($curr_business!='' && $curr_business>=2251){
                if($rankper>=$my_rank_per){
                    
                    $directs=$this->team->my_actives($u_code);
                    if(!empty($directs)){
                        $dir_implode=implode(',',$directs);
                        $check_directs=$this->conn->runQuery('*','rank',"u_code IN ($dir_implode) and is_complete='1' and rank_per>='$my_rank_per'");
                        if($check_directs && count($check_directs)>=2){
                            $dir3=$plan[2];                     
                        }else{
                            $dir3=$plan[1];
                        }
    
                        if(array_key_exists($my_rank_per,$dir3)){
                            $pay_per=$dir3[$my_rank_per];
                            if(array_key_exists($lvl,$pay_per)){
                                $persnt=$pay_per[$lvl];
                                $payable=$amnt*$persnt/100;
                                if($payable>0){
                                    $income=array();
                                    $income['tx_u_code']=$ben_from;
                                    $income['u_code']=$u_code;
                                    $income['tx_type']='income';
                                    $income['source']=$source;
                                    $income['debit_credit']='credit';
                                    $income['amount']=$payable;
                                    $income['date']=date('Y-m-d H:i:s');
                                    $income['status']=1;
                                    $income['payout_id']=$currenct_payout_id;
                                    $income['user_prsnt']=$my_rank_per;
                                    $income['distribute_per']=$persnt;
                                    $income['remark']="Recieve $source income of amount $payable from level $lvl";
                                    $this->db->insert('transaction',$income);
                                    $lvl++;
                                }
                            }                    
                        }
                    }
                }
            }
            $u_code=$this->profile->sponsor($u_code);
            if($lvl<=5 && $u_code){
                $nxt='yes'; 
            }
            
            
        }       
        
    }
    
     public function distribute_pool_level_rev($p_id,$amount,$no_of_levels=2,$pool_id){
        /* echo "$p_id $amount $no_of_levels" ;
        die();
        */
        $currenct_payout_id=$this->wallet->currenct_payout_id();
        //$pol_id='1';
	$pol_id=$pool_id;
        $details=$this->team->pool_details($p_id,$pol_id);
        $source='club';
        if($details){
            $u_code=$details->u_id;
            $pool_type=$details->pool_type;
            $plan=$this->conn->runQuery('*','plan','1=1');
            $cl_name=$pool_type.'_income_total';			
	    $id_act=$pool_type.'_ids';
	    $dis_amt=$pool_type.'_dis_amt';
		
	    $level_income=array_column($plan,$cl_name,'id');
	    $total_id_act=array_column($plan,$id_act,'id');
	    $total_dist_amt=array_column($plan,$dis_amt,'id');
			
            $req_teams=array_column($plan,'req_team','id');            
            $deduct_incomes=array_column($plan,'deduct_for_next_club','club_name');
            $next_clubs=array_column($plan,'next_club','club_name');
            $id_retopup_with=array_column($plan,'id_retopup_with','club_name');   
           
            $p_id=$details->parent_id;
            for($l=1;$l<=$no_of_levels;$l++){
                
                $pdetails=$this->team->pool_details($p_id,$pol_id);
                if($pdetails){
                    $p_id=$pdetails->parent_id;
                    $code=$pdetails->u_id;
                    $ids=$pdetails->id;
                    $club=$pdetails->pool_type;                 
                    $payble=$level_income[$l];					
		    $total_ids=$total_id_act[$l];
		    $totals_dist_amt=$total_dist_amt[$l];					
                    $req_team=$req_teams[$l];                    
                    $all_team=$this->team->my_pool_team($ids,$pol_id,2);
                   
                    $bronze_lvl1=(!empty($all_team) ? count($all_team[$l]):0);
                    if($bronze_lvl1>=$req_team){
                        
                        if($club=='club1' && $l==1){
                        	$check_pool_enter=$this->conn->runQuery('COUNT(id) as ids','pool',"u_id='$code' and pool_id='1'");
                    		$check_pool_entry=$check_pool_enter[0]->ids;
                    	}else{
                    	        $check_pool_entry="";
                    	}
                    	
                    	if($check_pool_entry==1 ){
                              $stss="Pending";
                            }else{
                               $stss="Approved";
                            }
                    	//die();
                    	//$check_exists=$this->conn->runQuery('*','transaction',"u_code='$code' and source='$source' and tx_record='1' and txs_res='club1'");
                    	//if(!$check_exists){
						
                        if($payble>0 && $payble!=''){
                            
                            if($club=='club1'){
                               $tx_charge=0;//$payble*10/100;
                            }else{                          
                            	$tx_charge=0;//$payble*15/100;
                            
                            }                            
                            
                            
                            
                            if($stss=="Approved"){
	                            $income=array();
	                            $income['tx_u_code']=$u_code;
	                            $income['u_code']=$code;
	                            $income['tx_type']='income';
	                            $income['source']=$source;
	                            $income['debit_credit']='credit';
	                            $income['amount']=$payble;
	                            $income['tx_charge']=$tx_charge;                         
	                            $income['date']=date('Y-m-d H:i:s');
	                            $income['status']=1;
	                            $income['remark']="Recieve $source income of amount $payble from level $l";
				    $income['tx_record']=$l;
				    $income['txs_res']=$club;
								
	                            $this->db->insert('transaction',$income);
	                            $income_lvl=$income['amount']-$income['tx_charge'];
	                            $this->update_ob->add_amnt($code,$source,$income_lvl);
	                            $this->update_ob->add_amnt($code,'main_wallet',$income_lvl);
	                            //$this->gen_destribute($u_code,$payble,5);
			    } 	
			    		
                            if($l==2){
                                 $deduct_income=array_key_exists($club,$deduct_incomes) ? $deduct_incomes[$club]:0;
                                 
                                 if($deduct_income>0){
                                        
					$order1=array();
					$orders1['u_code']=$code;
					$orders1['tx_type']='updrade';
					$orders1['order_amount']=$deduct_income;
					$orders1['order_bv']=$deduct_income;
					$orders1['pv']=1;
					$orders1['status']=1;
					$orders1['payout_id']=$currenct_payout_id;
					$orders1['payout_status']=0;
					
					$this->db->insert('orders',$orders1);
					$income=array();
                                        $income['u_code']=$code;
                                        $income['tx_type']='CLUB UPGRADE';
                                        $income['debit_credit']='debit';
                                        $income['amount']=$deduct_income;
                                        $income['date']=date('Y-m-d H:i:s');
                                        $income['status']=1;
                                        $income['remark']="$deduct_income deduct for upgrade club";										
										
                                        $this->db->insert('transaction',$income);
                                        $this->update_ob->add_amnt($code,'main_wallet',-$deduct_income);
                                        $next_club=$next_clubs[$club];
					if($next_club=='club2'){
						$next_pool_id=2;
					}elseif($next_club=='club3'){
						$next_pool_id=3;
					}elseif($next_club=='club4'){
						$next_pool_id=4;
					}elseif($next_club=='club5'){
						$next_pool_id=5;
					}elseif($next_club=='club6'){
						$next_pool_id=6;
					}elseif($next_club=='club7'){
						$next_pool_id=7;
					}elseif($next_club=='club8'){
						$next_pool_id=8;
					}elseif($next_club=='club9'){
						$next_pool_id=9;
					}
					
                                        $this->distribute->gen_pool($code,$deduct_income,$next_club,1,$next_pool_id);
										
                                 }
                                 
                                 
                            }							
							
			////////////////////////////////////id rebirth///////////////////////////////////////////////////				
					if($total_ids>0){
					
					/////////////////////////////////////////////////////////////////
					$this->level_destribute($code,$totals_dist_amt,2);
					
					//////////////////////////////////////////////////////////////
					
						for($l1=1;$l1<=$total_ids;$l1++){
						       $retopup_amnt=100;
							$order=array();
							$orders['u_code']=$code;
							$orders['tx_type']='repurchase';
							$orders['order_amount']=$retopup_amnt;
							$orders['order_bv']=$retopup_amnt;
							$orders['pv']=1;
							$orders['status']=1;
							$orders['payout_id']=$currenct_payout_id;
							$orders['payout_status']=0;
							if($this->db->insert('orders',$orders)){
								
								$income=array();
								$income['u_code']=$code;
								$income['tx_type']='Re generate ID';
								$income['debit_credit']='debit';
								$income['amount']=$retopup_amnt;
								$income['date']=date('Y-m-d H:i:s');
								$income['status']=1;
								$income['remark']="$retopup_amnt deduct for re-generation";
								$this->db->insert('transaction',$income);
									
								$this->update_ob->add_amnt($code,'main_wallet',-$retopup_amnt);
								$this->distribute->gen_pool($code,$retopup_amnt);
								
							}
                				} 
							
					}	
							
				}		
                            /*if($l==1){
                                $retopup_amnt=array_key_exists($club,$id_retopup_with) ? $id_retopup_with[$club]:0;
                                if($retopup_amnt>0){
                                        $order=array();
                                        $orders['u_code']=$code;
                                        $orders['tx_type']='repurchase';
                                        $orders['order_amount']=$retopup_amnt;
                                        $orders['order_bv']=$retopup_amnt;
                                        $orders['pv']=1;
                                        $orders['status']=1;
                                        $orders['payout_id']=$currenct_payout_id;
                                        $orders['payout_status']=0;
                                        if($this->db->insert('orders',$orders)){
                                            
                                                    $income=array();
                                                    $income['u_code']=$code;
                                                    $income['tx_type']='Re generate ID';
                                                    $income['debit_credit']='debit';
                                                    $income['amount']=$retopup_amnt;
                                                    $income['date']=date('Y-m-d H:i:s');
                                                    $income['status']=1;
                                                    $income['remark']="$retopup_amnt deduct for re-generation";
                                                    $this->db->insert('transaction',$income);
                                                    
                                                $this->update_ob->add_amnt($code,'main_wallet',-$retopup_amnt);
                                                $this->distribute->gen_pool($code,$retopup_amnt);
                                            
                                        }
                                 }
                            }*/
                            
                       // }
                    }
                    
                    
                }else{
                    break;
                }
            }
        }
        
    }
    
   public function gen_pool($u_code,$top_amt=0,$pool_typ='club1',$topid='1',$pool_id=1){
       
       $check_exists=$this->conn->runQuery('*','pool',"u_id='$topid' and pool_type='$pool_typ'");
       if(!$check_exists){
           $update_position=array();
           $update_position['parent_id']=0;
            $update_position['pool_position']=1;
            $update_position['u_id']=$topid;
            $update_position['pool_type']=$pool_typ;
            $update_position['pool_id']=$pool_id;
            $pid=$this->conn->get_insert_id('pool',$update_position);
       }else{
           $pid=$check_exists[0]->id;
       }
       //if($u_code!=$topid && $pool_typ=='club1'){
            $get_matrix_parent=$this->binary->get_pool_parent($pid,$pool_typ);
            $update_position=array();
            $update_position['parent_id']=$get_matrix_parent['parent'];
            $update_position['pool_position']=$get_matrix_parent['position'];
            $update_position['u_id']=$u_code;
            $update_position['pool_type']=$pool_typ;
            $update_position['pool_id']=$pool_id;
            $pidd=$this->conn->get_insert_id('pool',$update_position);
            
            if($pool_id==1){
            	$check_pool_enter=$this->conn->runQuery('COUNT(id) as ids','pool',"u_id='$u_code' and pool_id='1'");
            	$check_pool_entry=$check_pool_enter[0]->ids;
            	if($check_pool_entry==1){
            	
            	    $income=array();
                    $source='club'; 
                    $club='club1';
                    $l=1;
                    $payble=150;
                    
                    $income['u_code']=$u_code;
                    $income['tx_type']='income';
                    $income['source']=$source;
                    $income['debit_credit']='credit';
                    $income['amount']=$payble;
                    //$income['tx_charge']=$tx_charge;                         
                    $income['date']=date('Y-m-d H:i:s');
                    $income['status']=1;
                    $income['remark']="Recieve $source income of amount $payble from level $l";
		    $income['tx_record']=$l;
		    $income['txs_res']=$club;
						
                    $this->db->insert('transaction',$income);
                    $income_lvl=$income['amount']-$income['tx_charge'];
                    $this->update_ob->add_amnt($u_code,$source,$income_lvl);
                    $this->update_ob->add_amnt($u_code,'main_wallet',$income_lvl);
            	}
            }
            $this->distribute->distribute_pool_level_rev($pidd,$top_amt,2,$pool_id);
      // }
        
      
    }
    
    
    
    
     public function gen_pool_new($u_code,$top_amt=0,$pool_typ='pool1',$topid='1',$pool_id=21){
       
       $check_exists=$this->conn->runQuery('*','pool',"u_id='$topid' and pool_type='$pool_typ'");
       if(!$check_exists){
           $update_position=array();
           $update_position['parent_id']=0;
            $update_position['pool_position']=1;
            $update_position['u_id']=$topid;
            $update_position['pool_type']=$pool_typ;
            $update_position['pool_id']=$pool_id;
            $pid=$this->conn->get_insert_id('pool',$update_position);
       }else{
           $pid=$check_exists[0]->id;
       }
       //if($u_code!=$topid && $pool_typ=='club1'){
            $get_matrix_parent=$this->binary->get_pool_parent($pid,$pool_typ);
            $update_position=array();
            $update_position['parent_id']=$get_matrix_parent['parent'];
            $update_position['pool_position']=$get_matrix_parent['position'];
            $update_position['u_id']=$u_code;
            $update_position['pool_type']=$pool_typ;
            $update_position['pool_id']=$pool_id;
            $pidd=$this->conn->get_insert_id('pool',$update_position);
            
     
            $this->distribute->distribute_pool_level_new($pidd,$top_amt,1,$pool_id);
      // }
        
      
    }
    
    
    
     public function distribute_pool_level_new($p_id,$amount,$no_of_levels=1,$pool_id){
        /* echo "$p_id $amount $no_of_levels" ;
        die();
        */
        $currenct_payout_id=$this->wallet->currenct_payout_id();
        //$pol_id='1';
	$pol_id=$pool_id;
        $details=$this->team->pool_details($p_id,$pol_id);
        $source='auto_pool';
        if($details){
            $u_code=$details->u_id;
            $pool_type=$details->pool_type;
            $plan=$this->conn->runQuery('*','plan','1=1');
            $cl_name=$pool_type.'_income_total';			
	    $id_act=$pool_type.'_ids';
	    $id_act_new=$pool_type.'_ids_new';
	    $dis_amt=$pool_type.'_dis_amt';
		
	    $level_income=array_column($plan,$cl_name,'id');
	    $total_id_act=array_column($plan,$id_act,'id');
	    $total_id_act_new=array_column($plan,$id_act_new,'id');
	    //$total_dist_amt=array_column($plan,$dis_amt,'id');
			
            $req_teams=array_column($plan,'req_team','id');            
            $deduct_incomes=array_column($plan,'deduct_for_next_pool','pool_name');
            $next_clubs=array_column($plan,'next_pool','pool_name');
            //$id_retopup_with=array_column($plan,'id_retopup_with','pool_name');   
           
            $p_id=$details->parent_id;
            for($l=1;$l<=$no_of_levels;$l++){
                
                $pdetails=$this->team->pool_details($p_id,$pol_id);
                if($pdetails){
                    $p_id=$pdetails->parent_id;
                    $code=$pdetails->u_id;
                    $ids=$pdetails->id;
                    $club=$pdetails->pool_type;                 
                    $payble=$level_income[$l];					
		    $total_ids=$total_id_act[$l];
		    $total_ids_new=$total_id_act_new[$l];
		    //$totals_dist_amt=$total_dist_amt[$l];	
		    
		          if($type=='pool1'){
           	 $req_team=2;
           }elseif($type=='pool2'){
                 $req_team=4;
           }elseif($type=='pool3'){
                 $req_team=8;
           }elseif($type=='pool4'){
                 $req_team=16;
           }elseif($type=='pool5'){           
                 $req_team=32;
           }elseif($type=='pool6'){
                 $req_team=2;
           }elseif($type=='pool7'){
                $req_team=4;
           }elseif($type=='pool8'){
                 $req_team=8;
           }elseif($type=='pool9'){
                  $req_team=16;
           }elseif($type=='pool10'){
                  $req_team=32;
           
           }
           
		    
		    
                                   
                    $all_team=$this->team->my_pool_team($ids,$pol_id,2);
                   
                    $bronze_lvl1=(!empty($all_team) ? count($all_team[$l]):0);
                    if($bronze_lvl1>=$req_team){
                        
                        
                    	//die();
                    	//$check_exists=$this->conn->runQuery('*','transaction',"u_code='$code' and source='$source' and tx_record='1' and txs_res='club1'");
                    	//if(!$check_exists){
						
                        if($payble>0 && $payble!=''){
                            
                            if($club=='club1'){
                               $tx_charge=0;//$payble*10/100;
                            }else{                          
                            	$tx_charge=0;//$payble*15/100;
                            
                            }                            
                            
                            
                            
                           // if($stss=="Approved"){
                           if(1=="1"){
	                            $income=array();
	                            $income['tx_u_code']=$u_code;
	                            $income['u_code']=$code;
	                            $income['tx_type']='income';
	                            $income['source']=$source;
	                            $income['debit_credit']='credit';
	                            $income['amount']=$payble;
	                            $income['tx_charge']=$tx_charge;                         
	                            $income['date']=date('Y-m-d H:i:s');
	                            $income['status']=1;
	                            $income['remark']="Recieve $source income of amount $payble from level $l";
				    $income['tx_record']=$l;
				    $income['txs_res']=$club;
								
	                            $this->db->insert('transaction',$income);
	                            $income_lvl=$income['amount']-$income['tx_charge'];
	                            $this->update_ob->add_amnt($code,$source,$income_lvl);
	                            $this->update_ob->add_amnt($code,'main_wallet',$income_lvl);
	                            //$this->gen_destribute($u_code,$payble,5);
			    } 	
			    		
                            if($l==1){
                                 $deduct_income=array_key_exists($club,$deduct_incomes) ? $deduct_incomes[$club]:0;
                                 
                                 if($deduct_income>0){
                                        
					$order1=array();
					$orders1['u_code']=$code;
					$orders1['tx_type']='updrade';
					$orders1['order_amount']=$deduct_income;
					$orders1['order_bv']=$deduct_income;
					$orders1['pv']=1;
					$orders1['status']=1;
					$orders1['payout_id']=$currenct_payout_id;
					$orders1['payout_status']=0;
					
					$this->db->insert('orders',$orders1);
					$income=array();
                                        $income['u_code']=$code;
                                        $income['tx_type']='Pool UPGRADE';
                                        $income['debit_credit']='debit';
                                        $income['amount']=$deduct_income;
                                        $income['date']=date('Y-m-d H:i:s');
                                        $income['status']=1;
                                        $income['remark']="$deduct_income deduct for upgrade pool";										
										
                                        $this->db->insert('transaction',$income);
                                        $this->update_ob->add_amnt($code,'main_wallet',-$deduct_income);
                                        $next_club=$next_clubs[$club];
					if($next_club=='pool2'){
						$next_pool_id=22;
						
					}elseif($next_club=='pool3'){
						$next_pool_id=23;
					}elseif($next_club=='pool4'){
						$next_pool_id=24;
					}elseif($next_club=='pool5'){
						$next_pool_id=25;
					}elseif($next_club=='pool6'){
						$next_pool_id=26;
					}elseif($next_club=='pool7'){
						$next_pool_id=27;
					}elseif($next_club=='pool8'){
						$next_pool_id=28;
					}elseif($next_club=='pool9'){
						$next_pool_id=29;
					}
					
                                        $this->distribute->gen_pool_new($code,$deduct_income,$next_club,1,$next_pool_id);
										
                                 }
                                 
                                 
                            }							
							
			////////////////////////////////////id rebirth///////////////////////////////////////////////////
			
					if($total_ids_new>0){
					
					/////////////////////////////////////////////////////////////////
					//$this->level_destribute($code,$totals_dist_amt,2);
					
					//////////////////////////////////////////////////////////////
					
						for($l1=1;$l1<=$total_ids_new;$l1++){
						       $retopup_amnt=350;
							$order=array();
							$orders['u_code']=$code;
							$orders['tx_type']='repurchase';
							$orders['order_amount']=$retopup_amnt;
							$orders['order_bv']=$retopup_amnt;
							$orders['pv']=1;
							$orders['status']=1;
							$orders['payout_id']=$currenct_payout_id;
							$orders['payout_status']=0;
							if($this->db->insert('orders',$orders)){
								
								$income=array();
								$income['u_code']=$code;
								$income['tx_type']='Re generate ID';
								$income['debit_credit']='debit';
								$income['amount']=$retopup_amnt;
								$income['date']=date('Y-m-d H:i:s');
								$income['status']=1;
								$income['remark']="$retopup_amnt deduct for re-generation";
								$this->db->insert('transaction',$income);
									
								$this->update_ob->add_amnt($code,'main_wallet',-$retopup_amnt);
								$this->distribute->gen_pool_new($code,$retopup_amnt);
								
							}
                				} 
							
					}	
			
					if($total_ids>0){
					
					/////////////////////////////////////////////////////////////////
					//$this->level_destribute($code,$totals_dist_amt,2);
					
					//////////////////////////////////////////////////////////////
					
						for($l1=1;$l1<=$total_ids;$l1++){
						       $retopup_amnt=100;
							$order=array();
							$orders['u_code']=$code;
							$orders['tx_type']='repurchase';
							$orders['order_amount']=$retopup_amnt;
							$orders['order_bv']=$retopup_amnt;
							$orders['pv']=1;
							$orders['status']=1;
							$orders['payout_id']=$currenct_payout_id;
							$orders['payout_status']=0;
							if($this->db->insert('orders',$orders)){
								
								$income=array();
								$income['u_code']=$code;
								$income['tx_type']='Re generate ID';
								$income['debit_credit']='debit';
								$income['amount']=$retopup_amnt;
								$income['date']=date('Y-m-d H:i:s');
								$income['status']=1;
								$income['remark']="$retopup_amnt deduct for re-generation";
								$this->db->insert('transaction',$income);
									
								$this->update_ob->add_amnt($code,'main_wallet',-$retopup_amnt);
								$this->distribute->gen_pool($code,$retopup_amnt);
								
							}
                				} 
							
					}	
							
				}		
                           
                            
                       // }
                    }
                    
                    
                }else{
                    break;
                }
            }
        }
        
    }
    
}

