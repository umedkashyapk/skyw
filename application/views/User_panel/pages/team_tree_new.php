<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    <h4 class="page-title"> Tree</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="">Team</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Tree</li>
         </ol>
	   </div>
	   
</div>


<?php

 $nodes=2;

 $plus_per=80/($nodes-1);
  if($node_id){
                $_user_profile = $this->profile->profile_info($node_id);
                $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
            }
  $total_active=$this->team->actives();
  $left_teams=$this->team->team_by_position($node_id,1);
  $active_left_team= array_intersect($total_active, $left_teams);
  $left_team=count($left_teams);
  
    $right_teams=$this->team->team_by_position($node_id,2);
    $active_right_team= array_intersect($total_active, $right_teams);
    $right_team=count($right_teams);
  
    $active_left=$this->team->actives_left_right(1);
    $active_lefts=count($active_left);
   
 
    $red_units=$this->team->inactives();
    $inactive_right_team= array_intersect($red_units, $right_teams);
    $inactive_left_team= array_intersect($red_units, $left_teams);
 
    $total_direct_greens=$this->team->my_actives($node_id);
    $total_direct_green=count($total_direct_greens);

    $total_direct_reds=$this->team->my_inactives($node_id);
    $total_direct_red=count($total_direct_reds);
    
    $total_green_unit_left=$this->team->my_actives_left_right($node_id,1);
    $total_green_unit_lefts=count($total_green_unit_left);
    
    $total_green_unit_right=$this->team->my_actives_left_right($node_id,2);
    $total_green_unit_rights=count($total_green_unit_right);
    
    $total_direct_red_left=$this->team->my_inactives_left_right($node_id,1);
    $total_direct_red_lefts=count($total_direct_red_left);
    
    $total_direct_red_right=$this->team->my_inactives_left_right($node_id,2);
    $total_direct_red_rights=count($total_direct_red_right);
    
    $package=$this->business->package($node_id);
   
    $pv_bv=$this->conn->setting('binary_count_type');

?>
<div class="card">
    <div class="card-body">
     <div class="row">            
        <div class="col-xl-6 col-lg-12 col-md-12 col-xm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-end justify-content-between">
                    <div>
                    <h2 class=" mb-1 fs-14">Left Team </h2>
                    
                    </div>
                    
                    </div>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                    
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                
                                <th scope="col">Member</th>
                                <th scope="col">BV</th>
                                <!-- <?php if($pv_bv=='pv'){?><th scope="col">P.V</th><?php }?>-->
                                
                                <th scope="col">Green Unit </th>
                                <th scope="col">Green Direct</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row"><?= $left_team!='' ? $left_team:'0';?></th>
                                <th scope="row"> <?= $this->business->team_business_volume($node_id,1); ?></th>
                                
                                <!-- <?php if($pv_bv=='pv'){?><td><?= $this->business->team_pv($node_id,1); ?></td><?php }?>-->
                                <td><?= COUNT($active_left_team)!='' ? count($active_left_team):'0';?></td>
                                <td><?= $total_green_unit_lefts!='' ? $total_green_unit_lefts:'0';?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                    </div>
                    
                </div>
            </div>
        </div>  
        
     <div class="col-xl-6 col-lg-12 col-md-12 col-xm-12">
		<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-end justify-content-between">
						<div>
							<h2 class=" mb-1 fs-14">Right Team </h2>
						
						</div>
					
					</div>
					<div class="table-wrapper-scroll-y my-custom-scrollbar">

                          <table class="table table-bordered table-striped mb-0">
                            <thead>
                              <tr>
                                 <th scope="col">Member</th>
                                <th scope="col">BV</th>
                                <!--<?php if($pv_bv=='pv'){?><th scope="col">P.V</th><?php }?>-->
                                <th scope="col"> Green Unit </th>
                                <th scope="col"> Green Direct</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <th scope="row"><?= $right_team!='' ? $right_team:'0';?></th>
                                <th scope="row"> <?= $this->business->team_business_volume($node_id,2); ?></th>
                              <!--  <?php if($pv_bv=='pv'){?><td> <?= $this->business->team_pv($node_id,2); ?></td><?php }?>-->
                                <td><?= COUNT($active_right_team)!='' ? COUNT($active_right_team):'0';?></td>
                                <td><?= $total_green_unit_rights!='' ? $total_green_unit_rights:'0';?></td>
                              </tr>
                              
                            </tbody>
                          </table>
                        
                        </div>
				
				</div>
			</div>
			</div>  
        	</div>
        
        
        	  <center>
            <div class="text-dark">
              
                <span <?php if($node_id){ ?> data-toggle="popover1" data-trigger="hover" data-html="true" 
                    data-content="Name :<?= $_user_profile ? $_user_profile->name:'';?><br>Sponsor Id:
                    <?= $sponsor_details ? $sponsor_details->username:'';?><br> Total Member:&nbsp; L:<?= $left_team!='' ? $left_team:'0';?>&nbsp;R:<?= $right_team!='' ? $right_team:'0';?>
                    <br>Kit :&nbsp;&nbsp; <?= $package;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team)!='' ? count($active_left_team):'0';?>&nbsp;R:<?= COUNT($active_right_team)!='' ? COUNT($active_right_team):'0';?> <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team)!='' ? COUNT($inactive_left_team):'0';?>&nbsp;R:<?= COUNT($inactive_left_team)!='' ? COUNT($inactive_right_team):'0';?>
                    <br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts!='' ? $total_green_unit_lefts:'0';?>&nbsp;R:<?= $total_green_unit_rights!='' ? $total_green_unit_rights:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts!='' ? $total_direct_red_lefts:'0';?>&nbsp;R:<?= $total_direct_red_rights!='' ? $total_direct_red_rights:'0';?><br> Time :<?= $_user_profile->active_date ? $_user_profile->active_date:'';?>" <?php } ?> >
                    <img style="height:60px;width:60px;" class="rounded-circle img-thumbnail" src="<?= base_url('images/users/tree_user.png');?>">  
                </span>
                
                    <br>
                    <?= $_user_profile->username;?>
                    <br>
                     <?= $_user_profile->name;?>
                    <br>
                    
                    <?php  
                    if($_user_profile->active_status=='1'){
                            echo'<i class="fa fa-circle btn-sm" style="color:green;" aria-hidden="true"></i>';
                        }else{
                            echo'<i class="fa fa-circle btn-sm" style="color:red;" aria-hidden="true"></i>';
                        } 
                    ?>
                    <br>
                    <svg style="width:80%;height:20px;margin:0px;">
                        <line x1="50%" y1="0%" x2="50%" y2="100%" style="stroke:#000000;stroke-width:1" />
                        <line x1="10%" y1="100%" x2="90%" y2="100%" style="stroke:#000000;stroke-width:1" />
                    </svg>
                    <svg style="width:80%;height:30px;margin:0px;">
                        <?php
                        for($m=0;$m<$nodes-1;$m++){
                             $pl_=$m*$plus_per;
                            ?>
                            <line x1="<?= 10+$pl_;?>%" y1="0%" x2="<?= 10+$pl_;?>%" y2="100%" style="stroke:#000000;stroke-width:1" />
                            <?php
                        }
                        ?>
                        <line x1="90%" y1="0%" x2="90%" y2="100%" style="stroke:#000000;stroke-width:1" />
                    </svg>
                    
                    
                    <svg style="width:80%;height:50px;">
                       <?php
                       for($m=0;$m<$nodes;$m++){
                                $pl_=$m*$plus_per;
                                
                                 $posi=$m+1;
                                 $get_downline=$this->conn->runQuery('*','users',"Parentid='$node_id' and position='$posi'");
                                 
                                $next_user= $get_downline[0]->id;
                                  $_user_profile = $this->profile->profile_info($next_user);
                                   $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
                                      $total_active=$this->team->actives();
                                      $left_teams=$this->team->team_by_position($next_user,1);
                                      $active_left_team= array_intersect($total_active, $left_teams);
                                      $left_team=count($left_teams);
                                      
                                        $right_teams=$this->team->team_by_position($next_user,2);
                                        $active_right_team= array_intersect($total_active, $right_teams);
                                        $right_team=count($right_teams);
                                      
                                        $active_left=$this->team->actives_left_right(1);
                                        $active_lefts=count($active_left);
                                       
                                     
                                        $red_units=$this->team->inactives();
                                        $inactive_right_team= array_intersect($red_units, $right_teams);
                                        $inactive_left_team= array_intersect($red_units, $left_teams);
                                     
                                        $total_direct_greens=$this->team->my_actives($next_user);
                                        $total_direct_green=count($total_direct_greens);
                                    
                                        $total_direct_reds=$this->team->my_inactives($next_user);
                                        $total_direct_red=count($total_direct_reds);
                                        
                                        $total_green_unit_left=$this->team->my_actives_left_right($next_user,1);
                                        $total_green_unit_lefts=count($total_green_unit_left);
                                        
                                        $total_green_unit_right=$this->team->my_actives_left_right($next_user,2);
                                        $total_green_unit_rights=count($total_green_unit_right);
                                        
                                        $total_direct_red_left=$this->team->my_inactives_left_right($next_user,1);
                                        $total_direct_red_lefts=count($total_direct_red_left);
                                        
                                        $total_direct_red_right=$this->team->my_inactives_left_right($next_user,2);
                                        $total_direct_red_rights=count($total_direct_red_right);
                                        
                                        $package=$this->business->package($next_user);
                                       
                                        $pv_bv=$this->conn->setting('binary_count_type');
                                ?>
                                 <defs>
                                    <pattern id="image<?= $m;?>" patternUnits="userSpaceOnUse" height="50" width="60">
                                      <image x1="0"  y="0" height="50" width="60" xlink:href="<?= base_url('images/users/tree_user.png');?>"></image>
                                    </pattern>
                                  </defs>
                                  <?php
                                  if($get_downline[0]->id){
                                  ?>
                                  <a data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?php echo $this->profile->profile_info($get_downline[0]->id)->name;?> Userame :<?php echo $this->profile->profile_info($get_downline[0]->id)->username;?><br>Sponsor Id:
                                  <?= $sponsor_details ? $sponsor_details->username:'';?>Total Member:&nbsp; L:<?= $left_team!='' ? $left_team:'0';?>&nbsp;R:<?= $right_team!='' ? $right_team:'0';?>
                                  Kit :&nbsp;&nbsp; <?= $package;?>Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team)!='' ? count($active_left_team):'0';?>&nbsp;R:<?= COUNT($active_right_team)!='' ? COUNT($active_right_team):'0';?>Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team)!='' ? COUNT($inactive_left_team):'0';?>&nbsp;R:<?= COUNT($inactive_left_team)!='' ? COUNT($inactive_right_team):'0';?>
                                 Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts!='' ? $total_green_unit_lefts:'0';?>&nbsp;R:<?= $total_green_unit_rights!='' ? $total_green_unit_rights:'0';?> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts!='' ? $total_direct_red_lefts:'0';?>&nbsp;R:<?= $total_direct_red_rights!='' ? $total_direct_red_rights:'0';?>Time :<?= $_user_profile->active_date ? $_user_profile->active_date:'';?>">
                                  <circle stroke="black" cx="<?= 10+$pl_;?>%" cy="50%" r="25" fill="url(#image<?= $m;?>)"  <?php if($get_downline){ ?>   onclick="return my_new_func('<?= 10+$pl_;?>',1,<?= $get_downline[0]->id?>);"  <?php } ?>  />
                                </a>
                                
                                <?php
                                }else{
                                    ?>
                                    <circle stroke="black" cx="<?= 10+$pl_;?>%" cy="50%" r="25" fill="url(#image<?= $m;?>)"/>
                                <?php
                                    
                                }
                            }
                    ?> 
                     </svg>
                    
                    <svg style="width:80%;height:70px;margin:0px;">
                        
                        <?php
                        for($m=0;$m<$nodes;$m++){
                            
                                 $pl_=$m*$plus_per;
                                 $posi=$m+1;
                                 $get_downline=$this->conn->runQuery('*','users',"Parentid='$node_id' and position='$posi'");
                                 $next_id=$this->profile->profile_info($get_downline[0]->id)->id;
                                ?>
                                <text x="<?= 6+$pl_;?>%" y="25%" style="fill:black;" <?php if($get_downline){ ?> <?php } ?>    >
                                          
                                  <?php
                                if($get_downline[0]->id){
                                      echo $this->profile->profile_info($get_downline[0]->id)->username;
                                   ?>
                                
                                <tspan x="<?= 6+$pl_;?>%" y="55%" style="fill:black;">
                                 <?= $this->profile->profile_info($get_downline[0]->id)->name;?>
                                  
                               </tspan>
                               <tspan x="<?= 6+$pl_;?>%" y="90%" style="fill:black;">
                                 <?= ($this->profile->profile_info($get_downline[0]->id)->active_status=='1' ? 'Active':'Inactive');?>
                                  
                               </tspan>
                              <?php
                                }else{
                                      echo 'NULL';
                                  }
                              ?>
                              </text>
                             
                                   
                                <?php
                            }
                        
                        ?>
                        
                        
                    </svg>
                    <br>
                <?php 
               
                   $nodes=2;
                   $plus_per=26/($nodes-1);
                   ?>
                  <svg style="width:100%;height:20px;margin:0px;">
                        <line x1="18%" y1="0%" x2="18%" y2="100%" style="stroke:#000000;stroke-width:1" />
                        <line x1="4%" y1="100%" x2="30%" y2="100%" style="stroke:#000000;stroke-width:1" />
                        
                        <line x1="82%" y1="0%" x2="82%" y2="100%" style="stroke:#000000;stroke-width:1" />
                        <line x1="95%" y1="100%" x2="69%" y2="100%" style="stroke:#000000;stroke-width:1" />
                    </svg>
                  
                    <svg style="width:100%;height:30px;margin:0px;">
                        <?php
                        for($m=0;$m<$nodes-1;$m++){
                             
                             $pl_=$m*$plus_per;
                            ?>
                            <line x1="<?= 4+$pl_;?>%" y1="0%" x2="<?= 4+$pl_;?>%" y2="100%" style="stroke:#000000;stroke-width:1" />
                            <line x1="<?= 69+$pl_;?>%" y1="0%" x2="<?= 69+$pl_;?>%" y2="100%" style="stroke:#000000;stroke-width:1" />
                           
                        <?php
                        }
                        ?>
                        <line x1="30%" y1="0%" x2="30%" y2="100%" style="stroke:#000000;stroke-width:1" />
                        <line x1="95%" y1="0%" x2="95%" y2="100%" style="stroke:#000000;stroke-width:1" />
                    </svg>
                    
                    
                    <svg style="width:100%;height:50px;">
                       <?php
                       
                            for($m=0;$m<$nodes;$m++){
                                $pl_=$m*$plus_per;
                                 $posil=$m+1;
                                 $posi=1;
                                 $posi2=2;
                                 $get_downline_left=$this->conn->runQuery('*','users',"Parentid='$node_id' and position='$posi'");
                                 $next_id=$this->profile->profile_info($get_downline_left[0]->id)->id;
                                
                                 $get_downline_right=$this->conn->runQuery('*','users',"Parentid='$node_id' and position='$posi2'");
                                 $next_id2=$this->profile->profile_info($get_downline_right[0]->id)->id;
                               
                                $get_downline_right_user=$this->conn->runQuery('*','users',"Parentid='$next_id2' and position='$posil'");
                                $get_downline_left_user=$this->conn->runQuery('*','users',"Parentid='$next_id' and position='$posil'");
                               
                              
                               
                                $next_user_r= $get_downline_left_user[0]->id;
                                $_user_profilee = $this->profile->profile_info($next_user_r);
                                $sponsor_detailss = $this->profile->profile_info($_user_profilee->u_sponsor);
                                
                                 $total_active=$this->team->actives();
                                  $left_teams_l=$this->team->team_by_position($next_user_r,1);
                                  $active_left_team= array_intersect($total_active, $left_teams_l);
                                  $left_team_l=count($left_teams_l);
                                  
                                    $right_teams=$this->team->team_by_position($next_user_r,2);
                                    $active_right_team= array_intersect($total_active, $right_teams);
                                    $right_team=count($right_teams);
                                  
                                    $active_left=$this->team->actives_left_right(1);
                                    $active_lefts=count($active_left);
                                   
                                 
                                    $red_units=$this->team->inactives();
                                    $inactive_right_team= array_intersect($red_units, $right_teams);
                                    $inactive_left_team= array_intersect($red_units, $left_teams);
                                 
                                    $total_direct_greens=$this->team->my_actives($next_user_r);
                                    $total_direct_green=count($total_direct_greens);
                                
                                    $total_direct_reds=$this->team->my_inactives($next_user_r);
                                    $total_direct_red=count($total_direct_reds);
                                    
                                    $total_green_unit_left=$this->team->my_actives_left_right($next_user_r,1);
                                    $total_green_unit_lefts=count($total_green_unit_left);
                                    
                                    $total_green_unit_right=$this->team->my_actives_left_right($next_user_r,2);
                                    $total_green_unit_rights=count($total_green_unit_right);
                                    
                                    $total_direct_red_left=$this->team->my_inactives_left_right($next_user_r,1);
                                    $total_direct_red_lefts=count($total_direct_red_left);
                                    
                                    $total_direct_red_right=$this->team->my_inactives_left_right($next_user_r,2);
                                    $total_direct_red_rights=count($total_direct_red_right);
                                    
                                    $package=$this->business->package($next_user_r);
                                   
                                    $pv_bv=$this->conn->setting('binary_count_type');
                                    
                                    
                                    
                                $next_user_right= $get_downline_right_user[0]->id;                             
                                $_user_profilee = $this->profile->profile_info($next_user_right);
                                $sponsor_detailsr= $this->profile->profile_info($_user_profilee->u_sponsor);
                                
                                 $total_active=$this->team->actives();
                                  $left_teams_l=$this->team->team_by_position($next_user_right,1);
                                  $active_left_team_r= array_intersect($total_active, $left_teams_l);
                                  $left_team_r=count($left_teams_l);
                                  
                                    $right_teams=$this->team->team_by_position($next_user_right,2);
                                    $active_right_team_r= array_intersect($total_active, $right_teams);
                                    $right_team_r=count($right_teams);
                                  
                                    $active_left=$this->team->actives_left_right(1);
                                    $active_lefts=count($active_left);
                                   
                                 
                                    $red_units=$this->team->inactives();
                                    $inactive_right_team_r= array_intersect($red_units, $right_teams);
                                    $inactive_left_team_r= array_intersect($red_units, $left_teams);
                                 
                                    $total_direct_greens=$this->team->my_actives($next_user_right);
                                    $total_direct_green=count($total_direct_greens);
                                
                                    $total_direct_reds=$this->team->my_inactives($next_user_right);
                                    $total_direct_red=count($total_direct_reds);
                                    
                                    $total_green_unit_left=$this->team->my_actives_left_right($next_user_right,1);
                                    $total_green_unit_lefts_r=count($total_green_unit_left);
                                    
                                    $total_green_unit_right=$this->team->my_actives_left_right($next_user_right,2);
                                    $total_green_unit_rights_r=count($total_green_unit_right);
                                    
                                    $total_direct_red_left=$this->team->my_inactives_left_right($next_user_right,1);
                                    $total_direct_red_lefts_r=count($total_direct_red_left);
                                    
                                    $total_direct_red_right=$this->team->my_inactives_left_right($next_user_right,2);
                                    $total_direct_red_rights_r=count($total_direct_red_right);
                                    
                                    $package=$this->business->package($next_user_right);
                                   
                                    $pv_bv=$this->conn->setting('binary_count_type');
                                      
                                if($get_downline_left_user[0]->id){
                                 ?>
                                 <a data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?php echo $this->profile->profile_info($get_downline_left_user[0]->id)->name;?> Userame :<?php echo $this->profile->profile_info($get_downline_left_user[0]->id)->username;?><br>Sponsor Id:
                                  <?= $sponsor_detailss ? $sponsor_detailss->name:'';?>(<?= $sponsor_detailss ? $sponsor_detailss->username:'';?>)Total Member:&nbsp; L:<?= $left_team_l!='' ? $left_team_l:'0';?>&nbsp;R:<?= $right_team!='' ? $right_team:'0';?>
                                  Kit :&nbsp;&nbsp; <?= $package;?>Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team)!='' ? count($active_left_team):'0';?>&nbsp;R:<?= COUNT($active_right_team)!='' ? COUNT($active_right_team):'0';?>Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team)!='' ? COUNT($inactive_left_team):'0';?>&nbsp;R:<?= COUNT($inactive_right_team)!='' ? COUNT($inactive_right_team):'0';?>
                                 Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts!='' ? $total_green_unit_lefts:'0';?>&nbsp;R:<?= $total_green_unit_rights!='' ? $total_green_unit_rights:'0';?> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts!='' ? $total_direct_red_lefts:'0';?>&nbsp;R:<?= $total_direct_red_rights!='' ? $total_direct_red_rights:'0';?>Time :<?php echo $this->profile->profile_info($get_downline_left_user[0]->id)->active_date;?>">
                                 <circle stroke="black" cx="<?= 4+$pl_;?>%" cy="50%" r="20" fill="url(#image<?= $m;?>)"  <?php if($get_downline_left_user){ ?>   onclick="return my_new_func('<?= 4+$pl_;?>',1,<?= $get_downline_left_user[0]->id?>);"  <?php } ?>  />
                                </a>
                                <?php
                                }else{
                                ?>
                                 <circle stroke="black" cx="<?= 4+$pl_;?>%" cy="50%" r="20" fill="url(#image<?= $m;?>)"/>
                                 <?php
                                }
                                 if($get_downline_right_user[0]->id){
                                ?>
                               <a data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?php echo $this->profile->profile_info($get_downline_right_user[0]->id)->name;?> Userame :<?php echo $this->profile->profile_info($get_downline_right_user[0]->id)->username;?><br>Sponsor Id:
                                  <?= $sponsor_detailsr ? $sponsor_detailsr->name:'';?>(<?= $sponsor_detailsr ? $sponsor_detailsr->username:'';?>)Total Member:&nbsp; L:<?= $left_team_r!='' ? $left_team_r:'0';?>&nbsp;R:<?= $right_team_r!='' ? $right_team_r:'0';?>
                                  Kit :&nbsp;&nbsp; <?= $package;?>Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team_r)!='' ? count($active_left_team_r):'0';?>&nbsp;R:<?= COUNT($active_right_team_r)!='' ? COUNT($active_right_team_r):'0';?>Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team_r)!='' ? COUNT($inactive_left_team_r):'0';?>&nbsp;R:<?= COUNT($inactive_right_team_r)!='' ? COUNT($inactive_right_team_r):'0';?>
                                 Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts_r!='' ? $total_green_unit_lefts_r:'0';?>&nbsp;R:<?= $total_green_unit_rights_r!='' ? $total_green_unit_rights_r:'0';?> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts_r!='' ? $total_direct_red_lefts_r:'0';?>&nbsp;R:<?= $total_direct_red_rights_r!='' ? $total_direct_red_rights_r:'0';?>Time :<?php echo $this->profile->profile_info($get_downline_right_user[0]->id)->active_date;?>">
                                <circle stroke="black" cx="<?= 69+$pl_;?>%" cy="50%" r="20" fill="url(#image<?= $m;?>)"  <?php if($get_downline_right_user){ ?>   onclick="return my_new_func('<?= 69+$pl_;?>',1,<?= $get_downline_right_user[0]->id?>);"  <?php } ?>  />
                                </a> 
                              <?php
                                 }else{
                                     ?>
                                      <circle stroke="black" cx="<?= 69+$pl_;?>%" cy="50%" r="20" fill="url(#image<?= $m;?>)"/>
                                <?php
                                }
                            }
                    ?> 
                    </svg>
                    
                    <svg style="width:100%;height:70px;margin:0px;">
                        
                        <?php
                        for($m=0;$m<$nodes;$m++){
                            
                                 $pl_=$m*$plus_per;
                                 $posil=$m+1;
                                 $posi=1;
                                 $posi2=2;
                                 $get_downline_left=$this->conn->runQuery('*','users',"Parentid='$node_id' and position='$posi'");
                                 $next_id=$this->profile->profile_info($get_downline_left[0]->id)->id;
                                
                                 $get_downline_right=$this->conn->runQuery('*','users',"Parentid='$node_id' and position='$posi2'");
                                 $next_id2=$this->profile->profile_info($get_downline_right[0]->id)->id;
                               
                                $get_downline_right_user=$this->conn->runQuery('*','users',"Parentid='$next_id2' and position='$posil'");
                                $get_downline_left_user=$this->conn->runQuery('*','users',"Parentid='$next_id' and position='$posil'");
                               
                                ?>
                                
                                
                                <text x="<?= 3+$pl_;?>%" y="25%" style="fill:black;" <?php if($get_downline_left_user){ ?>   onclick="return my_new_func('<?= 10+$pl_;?>',1,<?= $get_downline_left_user[0]->id?>);"  <?php } ?>    >
                                          
                                  <?php
                                if($get_downline_left_user[0]->id){
                                      echo $this->profile->profile_info($get_downline_left_user[0]->id)->username;
                                      
                                  
                                ?>
                                
                                <tspan x="<?= 3+$pl_;?>%" y="55%" style="fill:black;">
                                 <?= $this->profile->profile_info($get_downline_left_user[0]->id)->name;?>
                                  
                               </tspan>
                               <tspan x="<?= 3+$pl_;?>%" y="90%" style="fill:black;">
                                 <?= ($this->profile->profile_info($get_downline_left_user[0]->id)->active_status=='1' ? 'Active':'Inactive');?>
                                  
                               </tspan>
                                <?php
                             
                                }else{
                                    echo"Null";
                                }
                             ?>
                               
                              </text>
                            
                              <text x="<?= 66+$pl_;?>%" y="25%" style="fill:black;" <?php if($get_downline_right_user){ ?>   onclick="return my_new_func('<?= 10+$pl_;?>',1,<?= $get_downline_right_user[0]->id?>);"  <?php } ?>    >
                                          
                                  <?php
                                if($get_downline_right_user[0]->id){
                                      echo $this->profile->profile_info($get_downline_right_user[0]->id)->username;
                                      
                                 
                                ?>
                                
                                <tspan x="<?= 66+$pl_;?>%" y="55%" style="fill:black;">
                                 <?= $this->profile->profile_info($get_downline_right_user[0]->id)->name;?>
                                  
                               </tspan>
                               <tspan x="<?= 66+$pl_;?>%" y="90%" style="fill:black;">
                                 <?= ($this->profile->profile_info($get_downline_right_user[0]->id)->active_status=='1' ? 'Active':'Inactive');?>
                                  
                               </tspan>
                               <?php
                               
                                }else{
                                      echo 'NULL';
                                  }
                               ?>
                               
                              </text>
                              <?php
                            }
                        
                        ?>
                        
                        
                    </svg>  
                    
                    
               
                    
                    
                    <div id="section_1">
                             
                    </div>
                      
                   
                </center>
            </div>
             </div>
             </div>
             <script>
                function my_new_func(stpopint,res_id,parent_id){
                   var nx = res_id+1;
                    var dd = '<line x1="'+stpopint+'%" y1="0%" x2="50%" y2="100%" style="stroke:#000000;stroke-width:1" />';
                   
                  $.ajax({
                      type: "post",
                      url: "<?= $panel_path.'team/get_tree';?>",
                      data: {tree_no:nx,parent_id:parent_id},          
                      success: function (response) {  
                          
                          $('#section_'+res_id).html('<svg style="width:100%;height:100px;" id="new'+res_id+'" >'+dd+'</svg>'+response+'<div id="section_'+nx+'"></div>');
                        
                        
                      }
                    });
                  
                }
            </script>