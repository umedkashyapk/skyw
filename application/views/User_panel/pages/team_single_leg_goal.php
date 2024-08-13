<br><br><br><br>
<?php
    $profile=$this->session->userdata("profile");
    $user_id=$this->session->userdata('user_id');
    $plan=$this->conn->runQuery("*",'plan',"1=1");
   
?>
<div class="content-wrapper">
<div class="row card-bg-1">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4>Goals</h4>
        <div class="table-responsive" >
            <table class="<?= $this->conn->setting('table_classes'); ?>   ">
                <tr>
                   <th>Sr No</th>
                    <th>Total Single Leg/Required Team</th>
                    <th>Total Direct/Requried Direct</th>
                     <!--<th>Direct Rank Required</th>-->
                   <!--  <th>Generation</th> -->
                    <th>Rank Name</th>
                    <!-- <th>Reward</th>
                    <th>Remaining Fluse Time</th>-->
                     <th>Income</th>
                    <th>Status</th>
                   
                </tr>
                <?php
                    $trclass="";
                    $goalstatus="Pending";
                    $todays = date('Y-m-d  H:i:s');
                    //$this->closing->rank_date_update($user_id);
                    
                    for($p=0;$p<10;$p++){
                    $lvl=$p+1;
                    $package_name=$plan[$p]->package_name;
                    $single_leg_required=$plan[$p]->single_leg_required;
                    $direct_required=$plan[$p]->direct_required;
                  
                    $total_income=$plan[$p]->total_income;
                    $per_day_income=$plan[$p]->per_day_income;
                   // $rank_achieve_day=$plan[$p]->rank_achieve_day;
                    //$reward_award=$plan[$p]->reward_award;
                    
                    $my_active_single_leg =$this->conn->runQuery('c22','user_wallets'," u_code='$user_id'")[0]->c22; //$this->team->my_single_leg_rank($user_id,$package_name); 
                    $my_total_single_leg=$my_active_single_leg!='' ? $my_active_single_leg : 0;
                    //if($my_total_single_leg>=$single_leg_required && $count_my_actives>=$direct_required){
                   
                    if($my_total_single_leg>=$single_leg_required){
                        
                        $user_active_date=$this->conn->runQuery('active_id','rank',"rank_type='$package_name' and u_code='$user_id'");
                        
                        $user_active_id=$user_active_date[0]->active_id;
                        $our_active_id=$user_active_id+$single_leg_required;
                        
                        $achieve_date=$this->conn->runQuery('added_on','rank',"active_id='$our_active_id' and rank_type='$package_name'")[0]->added_on;
                        $days="+".$rank_achieve_day ."day";
                        $com_date = date('Y-m-d  H:i:s', strtotime($days, strtotime($achieve_date)));
                        $my_actives_date =  $this->team->my_actives_date($user_id,$com_date);
                        //print_r($my_actives_date);
                        $count_my_actives_dt=!empty($my_actives_date) ? count($my_actives_date):0;
                       
                        if($count_my_actives_dt>=$direct_required){ 
                             $goalstatus="Achieved";
                             $trclass="background-color:green;";
                        }elseif($todays>$com_date){
                             $goalstatus="Fluse";
                             $trclass="background-color:red;";
                        }else{
                            $goalstatus="Pending";
                             $trclass="";
                        }
                        
                    }else{
                        
                        $my_actives =  $this->team->my_actives($user_id); 
                        $count_my_actives_dt=!empty($my_actives) ? count($my_actives):0;
                        
                        $goalstatus="Pending"; 
                        $com_date="";
                        $trclass="";
                    }
                   
                    
                ?>
                
                <tr style="<?= $trclass;?>" >  
                        <td><?= $p+1;?></td>
                        <td><?= $my_total_single_leg>=$single_leg_required? $single_leg_required : $my_total_single_leg ;?>/<?= $single_leg_required;?></td>
                        <td><?= $count_my_actives_dt>=$direct_required ? $direct_required : $count_my_actives_dt;?>/<?= $direct_required;?></td>
                       
                         <td><?= $plan[$p]->package_name;?></td>
                       <!--  <td><?= $plan[$p]->reward_award;?></td>
                         
                         <td><?= $goalstatus=='Pending'? $com_date : '' ;?></td> -->
                           <td><?= $total_income;?></td>
                         <td><?= $goalstatus;?></td>
                       
                        
                    </tr>
                 
                    
                <?php }  ?>   
                 
                
                
                  
                
               
                
                
               
                
               
               
                
               
            </table>
        </div>
    </div>
</div>
</div>

