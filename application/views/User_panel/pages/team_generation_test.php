<style>
    .earning-sec {
    margin-top: 0px;
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
                         <a href="<?= $panel_path.'team/team-generation';?>">
                        <div class="earning_link team2">
                           Generation
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= $panel_path.'team/team-direct';?>">
                        <div class="earning_link ">
                            Direct Team
                        </div>
                         </a>
                    </div>
                    
              <!--   <div class="col-md-2"> 
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
            <li class="breadcrumb-item"><a href="#">Generation</a></li>            
            <!--<li class="breadcrumb-item active" aria-current="page">Autopool Income</li>-->
         </ol>
	   </div>
    </div>
          
        </div>
    </section>
         <section class="earning-sec">
        <div class="container">
           
                
                
            <div class="formContainer">
               <form action="<?= $panel_path.'team/team-generation'?>" method="get">
                <div class="row">
                  <div class="col-sm-2 mb-3">
                         <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">
                    </div>
                    <!-- <div class="col-sm-2 mb-3">
                         <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                    </div>-->
                    <div class="col-sm-2 mb-3">
                         <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">
                    </div>
                      <div class="col-sm-2 mb-3">
                        <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">
                               
                    </div>
                   <!-- <div class="col-sm-2 mb-3">
                        <select>
                            <option value="">Select Input Type</option>
                            <option value="">Passive Income</option>
                            <option value="">Level Income</option>
                        </select>
                    </div>-->
                   <!-- <div class="col-sm-2 mb-3">
                        <select>
                            <option value="">10</option>
                            <option value="">20</option>
                            <option value="">50</option>
                            <option value="">100</option>
                            <option value="">200</option>
                        </select>
                    </div>-->
                     <div class="col-sm-2 mb-3">
                       <select name="selected_level" id="" class="form-control user_input_select">
                          <option value="all" <?= (isset($_REQUEST['selected_level']) && $_REQUEST['selected_level']=='all' ? 'selected':'');?> >Select Level</option> 
                                 <?php
                                 for($l=1;$l<=10;$l++){
                                    ?><option value="<?= $l;?>" <?= (isset($_REQUEST['selected_level']) && $_REQUEST['selected_level']==$l ? 'selected':'');?> > Level <?= $l;?></option><?php
                                 }
                                 ?>
                         
                       </select>
                     </div>
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="col-6">
                               <button class="btnPrimary" type="submit" name="submit">Filter</button>
                            </div>
                            <div class="col-6">
                               <a href="<?= $panel_path.'team/team-generation'?>"  class="btnPrimary" name="submit">Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
         
          <section>
              <div class="container">
                 
              <ol class="breadcrumb">
           
            <li class="breadcrumb-item active" aria-current="page">  
            <?php
            
            $my_id=$this->session->userdata('user_id');
            
            
            //$check_my_level_team = $this->team->my_generation($my_id);
                 
                
            if($this->session->has_userdata('selected_user')){
                $user_id=$this->session->userdata('selected_user');
            }else{
                $user_id=$my_id;
            }
            
             if($user_id!=$my_id && in_array($user_id,$check_my_level_team)){
                 $sponsor=$this->profile->sponsor($user_id);
                if($my_id!=$sponsor && in_array($sponsor,$check_my_level_team)){
                    ?>
                        <a href="<?= $panel_path.'team/team-generation?selected_user='.$sponsor;?>"><i class="fa fa-reply" aria-hidden="true"></i></a> /
                    <?php
                    }
                ?>
                
                <a href="<?= $panel_path.'team/team-generation?selected_user='.$my_id;?>" class="user_btn_button">My team </a>/
                <?php
                
                
                
            }
            
            $details=$this->profile->profile_info($user_id,'name,username');
            $name=$details->name ;
            $username=$details->username ;
            echo " $name ";
            
            ?>
            
           
            
            </li>
         </ol>
         </div>
         
         
        <div class="container">
            <div class="earningTable ">
                <table class="user_table_info_record">
                            <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Action</th>
                            <th>Name</th>
                           <th>Userid</th>
                            <!--<th>Email</th>       --> 
                            <th>Country Code</th>
                            <!--<th>Mobile No.</th>-->
                            <th>Join Date</th>
                            <th>Status</th>
                            <th>Level</th>
                            <th>Sponsor ID(Name)</th>
                           <!-- <th>Current Business</th>
                            <th>Previous Business</th>-->
                        </tr>
                    </thead>
                            <tbody>
                        <?php
                         
                       //$my_level_team = $this->team->my_generation($user_id);
                     
                       $my_level_team = $this->team->my_level_team($my_id);
                     
                       $first_arrays=$my_level_team[1];
                       $first_arrays2=$my_level_team[2];
                       $first_arrays3=$my_level_team[3];
                       $first_arrays4=$my_level_team[4];
                       $first_arrays5=$my_level_team[5];
                       $first_arrays6=$my_level_team[6];
                       $first_arrays7=$my_level_team[7];
                       $first_arrays8=$my_level_team[8];
                       $first_arrays9=$my_level_team[9];
                       $first_arrays10=$my_level_team[10];
                       $first_arrays11=$my_level_team[11];
                       $first_arrays12=$my_level_team[12];
                       $first_arrays13=$my_level_team[13];
                       $first_arrays14=$my_level_team[14];
                       $first_arrays15=$my_level_team[15];
                         
                           
                            if($table_data){
                                foreach($table_data as $t_data){
                                    $ids=$t_data['id'];
                                    $sr_no++;
                                    $gen_team=$this->team->my_generation_with_personal($t_data['id']);
                                    $team_details=$this->conn->runQuery("*",'users',"id='$ids'");
                                    if($team_details){
                                   
                                    
                                    if(in_array($t_data['id'], $first_arrays)){
                                        $level="Level1";
                                    }elseif(in_array($t_data['id'],$first_arrays2)){
                                                  
                                         $level="Level2"; 
                                     }elseif(in_array($t_data['id'],$first_arrays3)){
                                                  
                                         $level="Level3"; 
                                     }elseif(in_array($t_data['id'],$first_arrays4)){
                                                  
                                         $level="Level4"; 
                                     }elseif(in_array($t_data['id'],$first_arrays5)){
                                                  
                                         $level="Level5"; 
                                     }elseif(in_array($t_data['id'],$first_arrays6)){
                                                  
                                         $level="Level6"; 
                                     }elseif(in_array($t_data['id'],$first_arrays7)){
                                                  
                                         $level="Level7"; 
                                     }elseif(in_array($t_data['id'],$first_arrays8)){
                                                  
                                         $level="Level8"; 
                                     }elseif(in_array($t_data['id'],$first_arrays9)){
                                                  
                                         $level="Level9"; 
                                     }elseif(in_array($t_data['id'],$first_arrays10)){
                                                  
                                         $level="Level10"; 
                                     }elseif(in_array($t_data['id'],$first_arrays11)){
                                                  
                                         $level="Level11"; 
                                     }
                                     elseif(in_array($t_data['id'],$first_arrays12)){
                                                  
                                         $level="Level12"; 
                                     }elseif(in_array($t_data['id'],$first_arrays13)){
                                                  
                                         $level="Level13"; 
                                     }elseif(in_array($t_data['id'],$first_arrays14)){
                                                  
                                         $level="Level14"; 
                                     }elseif(in_array($t_data['id'],$first_arrays15)){
                                                  
                                         $level="Level15"; 
                                     }
                                    
                                    }
                                    
                                    if($t_data['active_status']==1){
                                        $col="green";
                                    }else{
                                         $col="red";
                                    }
                                ?>
                                <tr>
                                    <td><?=  $sr_no;?></td>
                                    <td><a href="<?= $panel_path.'team/team-generation?selected_user='.$t_data['id'];?>"><i class="fa fa-sitemap"></i></a></td>
                                    <td><?= $t_data['name'];?></td>
                                  <td><?= $t_data['username'];?></td>
                                    <!--<td><?= $t_data['email'];?></td>      -->
                                    <td><?= $t_data['country_code'];?>
                                    <!--<td><?= $t_data['mobile'];?>-->
                                    <td><?= $t_data['added_on'];?></td>               
                                    <td><?php
                                    if($t_data['active_status']==1){
                                        echo "<span style='color:#44d944'>Active</span><br>";
                                        echo $t_data['active_date'];
                                    }else{
                                        echo "<span style='color:#ff4d4d'>Inactive</span>";
                                    }
                                    ?></td>  
                                    <td><?= (isset($_REQUEST['selected_level'])) ? $_REQUEST['selected_level'] : $level ;?> </td>
                                    <td>
                                        <?php
                                        $sponsor_info=$this->profile->sponsor_info($t_data['id']);
                                            if($sponsor_info){
                                                echo "$sponsor_info->username ($sponsor_info->name)";
                                            }
                                        ?>
                                    </td> 
                                   <!-- <td><?= $t_data['active_status']==1 ? $this->business->current_session_bv($gen_team):0;?></td> 
                                    <td><?= $t_data['active_status']==1 ? $this->business->previous_bv($gen_team):0;?></td> -->
                                </tr>
                                <?php
                                  //  }
                                }
                            }
                                ?>
                                
                            </tbody>
                       </table>
                <?php 
                
                echo $this->pagination->create_links();?>
            </div>
        </div>
    </section>
    
    <br>
<br>
    
