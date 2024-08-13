<style>
    .btnPrimary {
    width:auto;
}
th {
    background: var(--grident) !important;
    color:var(--textColor) !important;
}
</style>

<section class="network-sec">
        <div class="container">
             <div class="eraning_link_data">
              <div class="row">
                    <div class="col-md-2">
                         <a href="<?= $panel_path.'team/team-direct';?>">
                        <div class="earning_link team">
                            Direct Team
                        </div>
                        </a>
                    </div>
                     <div class="col-md-2">
                         <a href="<?= $panel_path.'team/team-generation';?>">
                        <div class="earning_link">
                            Generation
                        </div>
                        </a>
                    </div>
                    
               <!-- <div class="col-md-2">
                         <a href="<?= $panel_path.'team/team-matrix-generation';?>">
                        <div class="earning_link">
                          Team Board
                        </div>
                        </a>
                    </div>-->
                    
                    </div>
                </div>
                  <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Direct Team</a></li>            
            <!--<li class="breadcrumb-item active" aria-current="page">Autopool Income</li>-->
         </ol>
	   </div>
    </div>
            <div class="formContainer">
                 <form action="<?= $panel_path.'team/team-direct'?>" method="get">
                <div class="row">
                    <div class="col-sm-2 mb-3">
                        <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">
                    </div>
                    <div class="col-sm-2 mb-3">
                         <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                    </div>
                    <div class="col-sm-2 mb-3">
                         <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">
                              
                    </div>
                    <div class="col-sm-2 mb-3">
                        <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">
                               
                    </div>
                    <!--<div class="col-sm-2 mb-3">
                        <select>
                            <option value="">All</option>
                            <option value="">20</option>
                            <option value="">50</option>
                            <option value="">100</option>
                            <option value="">200</option>
                        </select>
                    </div>-->
                    
                    
                    <div class="col-sm-2 mb-3">
                       <select name="active_status" id="">
                            <option value="" >-- Status --</option>
                            <option value="1" <?php if($select_status== "1") echo "selected"; ?>>Active</option>
                            <option value="0" <?php if($select_status== "0") echo "selected"; ?>>Inactive</option>
                           </select>
                    </div>
                </div>
                  
                <div class="networkButton">
                     <button class="btnPrimary" type="submit" name="submit">Filter</button>
                    <a href="<?= $panel_path.'team/team-direct'?>"  class="btnPrimary" name="submit">Reset</a>
                   
                </div>
                </form>
            </div>
        </div>
    </section>
 
    <section>
        <div class="container">
<?php
            
            $my_id=$this->session->userdata('user_id');
            //print_r($check_my_level_team);
            
            //$check_my_level_team = $this->team->my_generation($my_id);
                 
                
            if($u_id){
                $user_id=$u_id;
                
            }else{
                $user_id=$my_id;
            }
            
             if($user_id!=$my_id){
                 $sponsor=$this->profile->sponsor($my_id);
                if($my_id!=$sponsor && in_array($sponsor,$check_my_level_team)){
                    ?>
                        <a href="<?= $panel_path.'team/team_getdirect?selected_user='.$sponsor;?>"><i class="fa fa-reply" aria-hidden="true"></i></a> 
                    <?php
                    }
                ?>
                
                <a href="<?= $panel_path.'team/team_getdirect?selected_user='.$my_id;?>" class="user_btn_button">My Direct </a>
                <?php
                
                
                
            }
?>
            <div class="earningTable ">
                 <table class="user_table_info_record">
                           
                               <tr>
                                    <th>Sl No.</th>
                                    <th>Action</th>
									<th>Name</th>
                                    <th>User ID</th>
                                    <!--<th>Email</th>-->
                                   <!-- <th>Country Code</th>-->
                                    <th>Mobile</th>
                                    <th>Join Date</th>
                                    <th>Status</th>
                                    <th>Total Direct</th>
                                    <th>Total Team</th>
                                    <th>AI Package</th>
                                    <th>Subcription Package</th>
                                    <th>My Rank</th>
                                    <th>Total Team Business</th>
                                   <?php $plan_ty=$this->conn->setting('reg_type'); 
                                     if($plan_ty=='binary'){
                                    ?>
                                    <th>Current Business</th>
                                    <th>Previous Business</th>
                                    <th>Position</th>
                                    <?php } ?>
                                  
                               </tr>
                               <?php
                    if($table_data){            
                    foreach($table_data as $t_data){
                       
                            $sr_no++;
                         $user_id=$t_data['id'];
                         $w_balance=$this->conn->runQuery('*','user_wallets',"u_code='$user_id'");
                         $wallet_balance=$w_balance ? $w_balance[0]:array();
                         $gen_team=$this->team->my_generation_with_personal($t_data['id']);
                         if($t_data['active_status']==1){
                            $col="green";
                        }else{
                             $col="red";
                        }
                    ?>
                    <tr>
                        <td><?=  $sr_no;?></td>
						 <td><a href="<?= $panel_path.'team/team_getdirect?selected_user='.$t_data['id'];?>"><i class="fa fa-sitemap"></i></a></td>
                        <td><?= $t_data['name'];?></td>
                        <td><?= $t_data['username'];?></td>
                       <!-- <td><?= $t_data['email'];?></td>-->
                      <!-- <td><?= $t_data['country_code'];?>-->
                        <td><?= $t_data['mobile'];?></td>          
                        <td><?= $t_data['added_on'];?></td>               
                        <td><?php
                                    if($t_data['active_status']==1){
                                        echo "<span style='color:#44d944'>Active</span><br>";
                                        echo $t_data['active_date'];
                                    }else{
                                        echo "<span style='color:#ff4d4d'>Inactive</span>";
                                    }
                                    ?></td> 
                         <td><?= $wallet_balance->c8;?></td>
                         <td><?= $wallet_balance->c11;?></td> 
                        <td><?= $t_data['active_status']==1 ? $this->business->AI_package($t_data['id']):0;?></td> 
                         <td><?= $t_data['active_status']==1 ? $this->business->package_repurchase($t_data['id']):0;?></td> 
                        
                         <td><?= $t_data['active_status']==1 ? $t_data['my_rank']:0;?>(<?= $t_data['active_status']==1 ? $t_data['rank_per']:0;?>%)</td> 
                         <td><?php
                               $team_business=$this->business->top_legs($t_data['id']);
        						$top_legs=$team_business[0];
        						echo $total_team_business=array_sum($team_business);
                                   ?></td> 
                        <?php $plan_ty=$this->conn->setting('reg_type'); 
                         if($plan_ty=='binary'){
                        ?>
                        <td><?= $t_data['active_status']==1 ? $this->business->current_session_bv($gen_team):0;?></td> 
                        <td><?= $t_data['active_status']==1 ? $this->business->previous_bv($gen_team):0;?></td> 
                        <td><?= $t_data['position']==1 ? 'Left':'Right';?></td> 
                        <?php } ?>
                    </tr>
                        <?php
                        }
                    }else{
                        ?>
                    <h3 id="noData">No Data To Show <i class="fa-regular fa-file-lines"></i> </h3>
                  <?php
                    }
                  ?>
                           
                       </table>
                <?php 
                
                echo $this->pagination->create_links();?>
                
                <br><br>
            </div>
        </div>
    </section>
    
    <br>
<br>
    
