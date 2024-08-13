   <style>
       /* RESET STYLES & HELPER CLASSES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    
     :root {
        --level-1: #8dccad;
        --level-2: #f5cc7f;
        --level-3: #7b9fe0;
        --level-4: #f27c8d;
        --black: black;
    }
    
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    
    ol {
        list-style: none;
    }
    
    body {
        margin: 50px 0 100px;
        text-align: center;
        font-family: "Inter", sans-serif;
    }
    
    .container {
        max-width: 1000px;
        padding: 0 10px;
        margin: 0 auto;
    }
    
    .rectangle {
        position: relative;
        padding: 20px;
        / box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15); /
    }
    /* LEVEL-1 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    
    .level-1 {
        width: 50%;
        margin: 0 auto 28px;
        / background: var(--level-1); /
    }
    
    .level-1::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 62px);
        width: 2px;
        height: 18px;
        background: var(--black);
        text-align: center;
    }
    /* LEVEL-2 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    
    .level-2-wrapper {
        position: relative;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .level-2-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 25%;
        width: 50%;
        height: 2px;
        background: var(--black);
    }
    
    .level-2-wrapper::after {
        display: none;
        content: "";
        position: absolute;
        left: -20px;
        bottom: -20px;
        width: calc(100% + 20px);
        height: 2px;
        background: var(--black);
    }
    
    .level-2-wrapper li {
        position: relative;
    }
    
    .level-2-wrapper>li::before {
        content: "";
        position: absolute;
        bottom: 96.7%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 31px;
        background: var(--black);
    }
    
    .level-2 {
        width: 70%;
        margin: 0 auto 24px;
        / background: var(--level-2); /
    }
    
    .level-2::before {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translate(-50%, -13px);
        width: 2px;
        height: 18px;
        background: var(--black);
    }
    /* .level-2::after {
display: none;
content: "";
position: absolute;
top: 50%;
left: 0%;
transform: translate(-100%, -50%);
width: 20px;
height: 2px;
background: var(--black);
} */
    
    .level-2::after {
        display: none;
        content: "";
        position: absolute;
        top: 36%;
        left: 0%;
        transform: translate(-15%, 91%);
        width: 117px;
        height: 2px;
        background: var(--black);
    }
    /* LEVEL-3 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    
    .level-3-wrapper {
        position: relative;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-column-gap: 20px;
        width: 90%;
        margin: 0 auto;
    }
    
    .level-3-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: calc(25% - 5px);
        width: calc(50% + 10px);
        height: 2px;
        background: var(--black);
    }
    
    .level-3-wrapper>li::before {
        content: "";
        position: absolute;
        top: 13px;
        left: 50%;
        transform: translate(-50%, -100%);
        width: 2px;
        height: 33px;
        background: var(--black);
    }
    
    .level-3 {
        margin-bottom: 20px;
        / background: var(--level-3); /
    }
    /* LEVEL-4 STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    
    .level-4-wrapper {
        position: relative;
        width: 80%;
        margin-left: auto;
    }
    
    .level-4-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: -20px;
        width: 2px;
        height: calc(100% + 20px);
        background: var(--black);
    }
    
    .level-4-wrapper li+li {
        margin-top: 20px;
    }
    
    .level-4 {
        font-weight: normal;
        background: var(--level-4);
    }
    
    .level-4::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0%;
        transform: translate(-100%, -50%);
        width: 20px;
        height: 2px;
        background: var(--black);
    }
    /* MQ STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
    /* new_css*/
    
    img.client_image {
        width: 35px;
        border: 1px solid #d43f93;
        height: 35px;
        border-radius: 50%;
        padding: 3px 3px;
        margin-bottom: 10px;
    }
    
    h1.level-1.rectangle {
        font-size: 14px;
    }
    
    h2.level-2.rectangle {
        font-size: 14px;
    }
    
    h3.level-3.rectangle {
        font-size: 14px;
    }
    
    p.user_name {
        margin: 5px 0px;
    }
    
    @media screen and (max-width:576px) {
        .rectangle {
            padding: 0px;
        }
        h3.level-3.rectangle {
            font-size: 11px;
        }
        h2.level-2.rectangle {
            font-size: 11px;
        }
        h1.level-1.rectangle {
            font-size: 11px;
        }
        .level-2-wrapper>li::before {
            height: 15px;
            / bottom: 243px; /
            top: -20px;
        }
        .level-1::before {
            height: 14px;
            top: 38px;
        }
        .level-1 {
            margin: 0px auto 39px;
        }
        .level-2 {
            margin: 0 auto 40px;
        }
        .level-2::before {
            top: 114px;
            height: 14px;
        }
        .level-3-wrapper>li::before {
            top: -5px;
            height: 15px;
        }
    }
    
    @media all and (max-width:1000px) and (min-width: 577px) {
        .level-2::before {
            top: 100%;
            height: 17px;
        }
    }
    / errow_css /
    
    .line_errow {
        position: relative;
    }
    
    .bottom:before {
        position: absolute;
        background: #696161;
        width: 61px;
        height: 2px;
        content: "";
        top: 25px;
        left: 97px;
        transform: rotate( 90deg);
    }
    
    .bottom1:before {
        position: absolute;
        background: #696161;
        width: 362px;
        height: 2px;
        content: "";
        top: 25px;
        left: 97px;
        transform: translate(31px, 30px);
    }
    
    .bottom2:before {
        position: absolute;
        content: "";
        width: 54px;
        height: 2px;
        background: #696161;
        transform: rotate( 90deg);
        top: 81px;
        left: 462px;
    }
    /*********media _query for errow line*******/
    
    @media all and (max-width:768px) and (min-width: 577px) {
        .bottom:before {
            width: 61px;
            height: 2px;
            top: 25px;
            left: 68px;
        }
        .bottom1:before {
            width: 146px;
            left: 66px
        }
        .bottom2:before {
            width: 54px;
            height: 2px;
            top: 81px;
            left: 216px;
        }
    }
    
    @media all and (max-width:576px) and (min-width: 425px) {
        .bottom:before {
            width: 61px;
            height: 2px;
            top: 28px;
            left: 33px;
        }
        .bottom1:before {
            width: 179px;
            top: 28px;
            left: 32px;
        }
        .bottom2:before {
            width: 44px;
            height: 2px;
            top: 79px;
            left: 221px;
        }
    }
    
    @media all and (max-width:424px) and (min-width: 320px) {
        .bottom:before {
            width: 61px;
            top: 27px;
            left: 12px;
        }
        .bottom1:before {
            width: 100px;
            top: 28px;
            left: 11px;
        }
        .bottom2:before {
            width: 54px;
            top: 85px;
            left: 114px;
        }
    }
    
    @media all and (max-width:340px) and (min-width: 320px) {
        .bottom:before {
            top: 17px;
        }
        .bottom1:before {
            top: 18px;
        }
        .bottom2:before {
            top: 75px;
        }
    }
        
        
      .level-5-wrapper {
        position: relative;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .level-5-wrapper::before {
        content: "";
        position: absolute;
        top: -20px;
        left: 25%;
        width: 50%;
        height: 2px;
        background: var(--black);
    }
    
    .level-5-wrapper::after {
        display: none;
        content: "";
        position: absolute;
        left: -20px;
        bottom: -20px;
        width: calc(100% + 20px);
        height: 2px;
        background: var(--black);
    }
    
    .level-5-wrapper li {
        position: relative;
    }
    
    .level-5-wrapper>li::before {
        content: "";
        position: absolute;
        bottom: 96.7%;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 31px;
        background: var(--black);
    }
    
    .level-5 {
        width: 70%;
        margin: 0 auto 24px;
        / background: var(--level-2); /
    }
    
    .level-5::before {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translate(-50%, -13px);
        width: 2px;
        height: 18px;
        background: var(--black);
    }
    /* .level-2::after {
display: none;
content: "";
position: absolute;
top: 50%;
left: 0%;
transform: translate(-100%, -50%);
width: 20px;
height: 2px;
background: var(--black);
} */
    
    .level-5::after {
        display: none;
        content: "";
        position: absolute;
        top: 36%;
        left: 0%;
        transform: translate(-15%, 91%);
        width: 117px;
        height: 2px;
        background: var(--black);
    }
    /* LEVEL-3 STYLES  
   </style>
   
    <div class="row ">
        <div class="col-sm-12">
       
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
                <li class="breadcrumb-item"><a href="">Team</a></li>            
                <li class="breadcrumb-item active" aria-current="page"> Tree</li>
            </ol>
        </div>

    </div>
 


    <div class="container">
        <?php

        $node_id=$this->session->userdata('user_id');
        if($node_id){
        $profile=$this->profile->profile_info($node_id);
        $_user_profile = $this->profile->profile_info($node_id);

        $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
        
        }

        ?>
        <?php  if($profile->img!=''){?>
            <h1 class="level-1 rectangle"><img src="<?=base_url('images/users/').$profile->img;?>" class="client_image" alt="images"><br><i class="client_name"><?= $_user_profile ? $_user_profile->name:'';?><br><?= $_user_profile ? $_user_profile->username:'';?><br><?php if($_user_profile->active_status=='1'){echo "Active";}else{ echo"inactive";}?></i>
            </h1>
        <?php }else{ ?>
            <h1 class="level-1 rectangle"><img src="<?= base_url('images/users/tree_user.png');?>" class="client_image" alt="images"><br><i class="client_name"><?= $_user_profile ? $_user_profile->name:'';?><br><?= $_user_profile ? $_user_profile->username:'';?><br><?php if($_user_profile->active_status=='1'){echo "Active";}else{ echo"inactive";}?></i>
            </h1>
        <?php }
        $matrix_node=$this->conn->setting('tree_node');      
        for($n=0;$n<$matrix_node;$n++){
        $parent=$node_id;
        $pos=$n+1;

        $check_position=false;
        if($parent!=''){
        $check_position=$this->conn->runQuery("*",'users',"Parentid='$parent' and position='$pos'");
        }
        if($check_position){
        $u_code=$check_position[0]->id;
        $_user_profiles=$this->profile->profile_info($u_code,'username,id,position,name,img,email,added_on,u_sponsor,active_status,active_date');
         
       
        }

        if($_user_profiles->position==1){
         
         $username=$_user_profiles->username;
         $name=$_user_profiles->name;
         $img=$_user_profiles->img;
         $status=$_user_profiles->active_status;
         $active_date=$_user_profiles->active_date;
         $left_id=$_user_profiles->id;
         $left_teams=$this->team->team_by_position($left_id,1);
        
         $total_active=$this->team->actives();
         $active_left_team= array_intersect($total_active,$left_teams);
         $left_team=count($left_teams);
         
         $right_teams=$this->team->team_by_position($left_id,2);
         $active_right_team= array_intersect($total_active, $right_teams);
         $right_team=count($right_teams);
         $package=$this->business->package($left_id); 
         $red_units=$this->team->inactives();
         $inactive_right_team= array_intersect($red_units, $right_teams);
         $inactive_left_team= array_intersect($red_units, $left_teams);
         
         $total_green_unit_left=$this->team->my_actives_left_right($left_id,1);
         $total_green_unit_lefts=count($total_green_unit_left);
        
         $total_green_unit_right=$this->team->my_actives_left_right($left_id,2);
         $total_green_unit_rights=count($total_green_unit_right);
        
        $total_direct_red_left=$this->team->my_inactives_left_right($left_id,1);
        $total_direct_red_lefts=count($total_direct_red_left);
        
        $total_direct_red_right=$this->team->my_inactives_left_right($left_id,2);
        $total_direct_red_rights=count($total_direct_red_right);


        }elseif($_user_profiles->position==2){
        $total_active=$this->team->actives();
        $null_vaue=$username2=$_user_profiles->username;
        $name2=$_user_profiles->name;
        $status1=$_user_profiles->active_status;
        $active_date2=$_user_profiles->active_date;
        $right_id=$_user_profiles->id;
        
         $left_teams2=$this->team->team_by_position($right_id,1);
         $active_left_team2= array_intersect($total_active,$left_teams2);
         $left_team2=count($left_teams2);
         
         $right_teams2=$this->team->team_by_position($right_id,2);
         $active_right_team2= array_intersect($total_active, $right_teams2);
         $right_team2=count($right_teams2);
         $package2=$this->business->package($right_id);
         
         $red_units=$this->team->inactives();
         $inactive_right_team2= array_intersect($red_units, $right_teams2);
         $inactive_left_team2= array_intersect($red_units, $left_teams2);
      
         $total_green_unit_left=$this->team->my_actives_left_right($right_id,1);
         $total_green_unit_lefts2=count($total_green_unit_left);
        
         $total_green_unit_right=$this->team->my_actives_left_right($right_id,2);
         $total_green_unit_rights2=count($total_green_unit_right);
         
        $total_direct_red_left=$this->team->my_inactives_left_right($right_id,1);
        $total_direct_red_lefts2=count($total_direct_red_left);
        
        $total_direct_red_right=$this->team->my_inactives_left_right($right_id,2);
        $total_direct_red_rights2=count($total_direct_red_right);

      
        } 

        ?>
        <?php
        }
        ?>

        <ol class="level-2-wrapper">
            <li>
                <?php
                if($username){
                    
                ?>
                 
                <h2 class="level-2 rectangle client"> 
                <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $name ? $name:'';?><br>Sponser Id: <?= $_user_profile ? $_user_profile->name:'';?> (<?= $_user_profile ? $_user_profile->username:'';?>)<br> Total Member:&nbsp; L:<?= $left_team!='' ? $left_team:'0';?>&nbsp;R:<?= $right_team!='' ? $right_team:'0';?><br>Kit :&nbsp;&nbsp; <?= $package;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team)!='' ? count($active_left_team):'0';?>&nbsp;R:<?= COUNT($active_right_team)!='' ? COUNT($active_right_team):'0';?>  <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team)!='' ? COUNT($inactive_left_team):'0';?>&nbsp;R:<?= COUNT($inactive_right_team)!='' ? COUNT($inactive_right_team):'0';?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts!='' ? $total_green_unit_lefts:'0';?>&nbsp;R:<?= $total_green_unit_rights!='' ? $total_green_unit_rights:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts!='' ? $total_direct_red_lefts:'0';?>&nbsp;R:<?= $total_direct_red_rights!='' ? $total_direct_red_rights:'0';?><br> Time :<?= $active_date ? $active_date:'';?>">
                
                <?php if($status==1){?>
                <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:green;"></i> 
               <?php
                }else{
                  ?>  
                  <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i>  
               <?php 
               }
               ?>
                
                
                <br><i class="client_name color_backgorund_text"><?= $username ? $username:'';?><br><?= $name ? $name:'';?></i>
                </span>
                 </h2>
                
                    <?php
                    }else{
                    ?>
                        <h2 class="level-2 rectangle client"><img src="<?= base_url('images/users/tree_user.png');?>" class="client_image" alt="images"><br><i class="client_name color_backgorund_text"><span>Null</span></i>
                        </h2>
                <?php 
                }
                for($n=0;$n<$matrix_node;$n++){
                    $parent_left=$left_id;
                    $pos=$n+1;
                    $check_position2=false;
                        if($parent_left!=''){
                        $check_position2=$this->conn->runQuery("*",'users',"Parentid='$parent_left' and position='$pos'");

                        }

                        if($check_position2){

                        $u_code=$check_position2[0]->id;
                        $_user_profile2=$this->profile->profile_info($u_code,'username,id,position,name,email,added_on,u_sponsor,active_status,active_date');

                        }

                    if($_user_profile2->position==1){
                      $username_left=$_user_profile2->username;
                      $name_left=$_user_profile2->name;
                      $status_left=$_user_profile2->active_status;
                       $active_date_dawn=$_user_profile2->active_date;
                         $left_id2=$_user_profile2->id;
                         $left_teams=$this->team->team_by_position($left_id2,1);
                        
                         $total_active=$this->team->actives();
                         $active_left_team_dawn= array_intersect($total_active,$left_teams);
                         $left_team_dawn=count($left_teams);
                         
                         $right_teams=$this->team->team_by_position($left_id2,2);
                         $active_right_team_dawn= array_intersect($total_active, $right_teams);
                         $right_team_dawn=count($right_teams);
                         
                         $package_dawn=$this->business->package($left_id2); 
                         $red_units=$this->team->inactives();
                         $inactive_left_team_dawn= array_intersect($red_units, $right_teams);
                         $inactive_left_team_daw= array_intersect($red_units, $left_teams);
                         
                          $inactive_right_team_dawn= array_intersect($red_units, $right_teams);
                         $inactive_left_team= array_intersect($red_units, $left_teams);
                         
                         $total_green_unit_left=$this->team->my_actives_left_right($left_id2,1);
                         $total_green_unit_lefts_dawn=count($total_green_unit_left);
                        
                         $total_green_unit_right=$this->team->my_actives_left_right($left_id2,2);
                         $total_green_unit_rights_dawn=count($total_green_unit_right);
                        
                        $total_direct_red_left=$this->team->my_inactives_left_right($left_id2,1);
                        $total_direct_red_lefts_dawn=count($total_direct_red_left);
                        
                        $total_direct_red_right=$this->team->my_inactives_left_right($left_id2,2);
                        $total_direct_red_rights_dawn=count($total_direct_red_right);

                      

                    }elseif($_user_profile2->position==2){
                        $null= $username_right=$_user_profile2->username;
                        $name_right=$_user_profile2->name;
                        $status_right=$_user_profile2->active_status;
                        $active_date_dawn2=$_user_profile2->active_date;
                            $right_id=$_user_profile2->id;
                            
                             $left_teams2=$this->team->team_by_position($right_id,1);
                             $active_left_team_dawn2= array_intersect($total_active,$left_teams2);
                             $left_team_dawn2=count($left_teams2);
                             
                             $right_teams2=$this->team->team_by_position($right_id,2);
                             $active_right_team_dawn2= array_intersect($total_active, $right_teams2);
                             $right_team_dawn2=count($right_teams2);
                             $package_dawn2=$this->business->package($right_id);
                             
                             $red_units=$this->team->inactives();
                             $inactive_right_team_dawn2= array_intersect($red_units, $right_teams2);
                             $inactive_left_team_dawn2= array_intersect($red_units, $left_teams2);
                          
                             $total_green_unit_left=$this->team->my_actives_left_right($right_id,1);
                             $total_green_unit_lefts_dawn2=count($total_green_unit_left);
                            
                             $total_green_unit_right=$this->team->my_actives_left_right($right_id,2);
                             $total_green_unit_rights_dawn2=count($total_green_unit_right);
                             
                            $total_direct_red_left=$this->team->my_inactives_left_right($right_id,1);
                            $total_direct_red_lefts2=count($total_direct_red_left);
                            
                            $total_direct_red_right=$this->team->my_inactives_left_right($right_id,2);
                            $total_direct_red_rights2=count($total_direct_red_right);

      
                        
                       } 
                   }
                
                ?>
                
                 
                <ol class="level-3-wrapper">
                   <?php
                   if($username_left){
                   ?>
                   
                    <li>
                      <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $name ? $name:'';?><br>Sponser Id: <?= $name ? $name:'';?> (<?= $username ? $username:'';?>)<br> Total Member:&nbsp; L:<?= $left_team_dawn!='' ? $left_team_dawn:'0';?>&nbsp;R:<?= $right_team_dawn!='' ? $right_team_dawn:'0';?><br>Kit :&nbsp;&nbsp; <?= $package_dawn;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team_dawn)!='' ? count($active_left_team_dawn):'0';?>&nbsp;R:<?= COUNT($active_right_team_dawn)!='' ? COUNT($active_right_team_dawn):'0';?>  <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team_daw)!='' ? COUNT($inactive_left_team_daw):'0';?>&nbsp;R:<?= COUNT($inactive_right_team_dawn)!='' ? COUNT($inactive_right_team_dawn):'0';?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts_dawn!='' ? $total_green_unit_lefts_dawn:'0';?>&nbsp;R:<?= $total_green_unit_rights_dawn!='' ? $total_green_unit_rights_dawn:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts_dawn!='' ? $total_direct_red_lefts_dawn:'0';?>&nbsp;R:<?= $total_direct_red_rights_dawn!='' ? $total_direct_red_rights_dawn:'0';?><br> Time :<?= $active_date_dawn ? $active_date_dawn:'';?>">
                        <h3 class="level-3 rectangle myclass" id="<?= $left_id2;?>"onclick="myFunction()">
                           <?php if($status_left==1){?>
               
                         <a  href="<?= $panel_path.'team/tree_test?parentid='.$left_id2;?>">
                                       <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:green;"></i> </a>
               <?php
                }else{
                  ?>  
                  <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i>  
               <?php 
               }
               ?>
                
                <br><i class="client_name "><?= $username_left ? $username_left:'';?><br><?= $name_left ?  $name_left:'';?><br></i></h3></span>

                    </li>
                    <?php
                    }else{?>
                      <li>
                        <h3 class="level-3 rectangle"> <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i><br><span>Null</span></i></h3>

                    </li>  
                   <?php

                   }
                   if($username_right){
                    ?>
                    <li>
                     <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $name ? $name:'';?><br>Sponser Id: <?= $name ? $name:'';?> (<?= $username ? $username:'';?>)<br> Total Member:&nbsp; L:<?= $left_team_dawn2!='' ? $left_team_dawn2:'0';?>&nbsp;R:<?= $right_team_dawn2!='' ? $right_team_dawn2:'0';?><br>Kit :&nbsp;&nbsp; <?= $package_dawn2;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team_dawn2)!='' ? count($active_left_team_dawn2):'0';?>&nbsp;R:<?= COUNT($active_right_team_dawn2)!='' ? COUNT($active_right_team_dawn2):'0';?>  <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team_dawn2)!='' ? COUNT($inactive_left_team_dawn2):'0';?>&nbsp;R:<?= COUNT($inactive_right_team_dawn2)!='' ? COUNT($inactive_right_team_dawn2):'0';?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts_dawn!='' ? $total_green_unit_lefts_dawn:'0';?>&nbsp;R:<?= $total_green_unit_rights_dawn!='' ? $total_green_unit_rights_dawn:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts_dawn2!='' ? $total_direct_red_lefts_dawn2:'0';?>&nbsp;R:<?= $total_direct_red_rights_dawn2!='' ? $total_direct_red_rights_dawn2:'0';?><br> Time :<?= $active_date_dawn2 ? $active_date_dawn2:'';?>">
                        
                        <h3 class="level-3 rectangle myclass" id="<?= $right_id;?>" onclick="myFunction()">
                        
                         <?php if($status_right==1){?>
                           <a  href="<?= $panel_path.'team/tree_test?parentid='.$right_id;?>"> <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:green;"></i></a> 
                           <?php
                            }else{
                              ?>  
                              <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i>  
                           <?php 
                           }
                           ?>
               <br><i class="client_name"><?= $username_right ? $username_right:'';?><br><?=  $name_right ? $name_right:'';?><br> </i></h3></span>

                    </li>
                    <?php
                   }else{
                       ?>
                        <li>
                        <h3 class="level-3 rectangle"> <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i><br><span>Null</span> </h3>

                    </li>
                  <?php
                  }
                    ?>
                </ol>
               
                </li>
            <li>
           
                <?php
                if($null_vaue){
                ?>
                
                
                <h2 class="level-2 rectangle">
                <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $name2 ? $name2:'';?><br>Sponser Id: <?= $_user_profile ? $_user_profile->name:'';?> (<?= $_user_profile ? $_user_profile->username:'';?>)<br> Total Member:&nbsp; L:<?= $left_team2!='' ? $left_team2:'0';?>&nbsp;R:<?= $right_team2!='' ? $right_team2:'0';?><br>Kit :&nbsp;&nbsp; <?= $package2;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team2)!='' ? count($active_left_team2):'0';?>&nbsp;R:<?= COUNT($active_right_team2)!='' ? COUNT($active_right_team2):'0';?><br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team2)!='' ? COUNT($inactive_left_team2):'0';?>&nbsp;R:<?= COUNT($inactive_right_team2)!='' ? COUNT($inactive_right_team2):'0';?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts2!='' ? $total_green_unit_lefts2:'0';?>&nbsp;R:<?= $total_green_unit_rights2!='' ? $total_green_unit_rights2:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts2!='' ? $total_direct_red_lefts2:'0';?>&nbsp;R:<?= $total_direct_red_rights2!='' ? $total_direct_red_rights2:'0';?><br> Time :<?= $active_date2 ? $active_date2:'';?> ">
                
                
                  <?php if($status==1){?>
                <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:green;"></i> 
               <?php
                }else{
                  ?>  
                  <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i>  
               <?php 
               }
               ?>
                
                <br><i class="client_name color_backgorund_text"><?= $username2 ? $username2:'';?><br><?= $name2 ? $name2:'';?><br></i></span></h2> 
                
                <?php
                }else{
                ?>
                <h2 class="level-2 rectangle client"> <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i><br><i class="client_name color_backgorund_text"><span>Null</span></i>
                </h2>
                <?php }
                for($n=0;$n<$matrix_node;$n++){
                    $parent_right=$right_id;
                    $pos=$n+1;
                    $check_position3=false;
                    if($parent_right!=''){
                    $check_position3=$this->conn->runQuery("*",'users',"Parentid='$parent_right' and position='$pos'");

                    }

                    if($check_position3){

                    $u_code3=$check_position3[0]->id;
                    $_user_profile3=$this->profile->profile_info($u_code3,'username,id,position,name,email,added_on,u_sponsor,active_status,active_date');

                    }

                    if($_user_profile3->position==1){
                        $null= $username_left3=$_user_profile3->username;
                        $name_left3=$_user_profile3->name;
                        $status_left3=$_user_profile3->active_status;
                        $active_date_dawn3=$_user_profile3->active_date;
                         $left_id3=$_user_profile3->id;
                         $left_teams=$this->team->team_by_position($left_id3,1);
                        
                         $total_active=$this->team->actives();
                         $active_left_team_dawn3= array_intersect($total_active,$left_teams);
                         $left_team_dawn2=count($left_teams);
                         
                         $right_teams=$this->team->team_by_position($left_id3,2);
                         $active_right_team_dawn2= array_intersect($total_active, $right_teams);
                         $right_team_dawn2=count($right_teams);
                         
                         $package_left_dawn=$this->business->package($left_id3); 
                         $red_units=$this->team->inactives();
                         $inactive_left_team_dawn3= array_intersect($red_units, $right_teams);
                         $inactive_left_team3= array_intersect($red_units, $left_teams);
                         
                         $total_green_unit_left=$this->team->my_actives_left_right($left_id3,1);
                         $total_green_unit_lefts_dawn3=count($total_green_unit_left);
                        
                         $total_green_unit_right=$this->team->my_actives_left_right($left_id3,2);
                         $total_green_unit_rights_dawn3=count($total_green_unit_right);
                        
                        $total_direct_red_left=$this->team->my_inactives_left_right($left_id3,1);
                        $total_direct_red_lefts_dawn3=count($total_direct_red_left);
                        
                        $total_direct_red_right=$this->team->my_inactives_left_right($left_id3,2);
                        $total_direct_red_rights_dawn=count($total_direct_red_right);

                      

                    }elseif($_user_profile3->position==2){
                        $null= $username_right3=$_user_profile3->username;
                        $name_right3=$_user_profile3->name;
                        $status_right3=$_user_profile3->active_status;
                        
                         $active_date3=$_user_profile3->active_date;
                            $right_id3=$_user_profile3->id;
                            
                             $left_teams2=$this->team->team_by_position($right_id3,1);
                             $active_left_team3= array_intersect($total_active,$left_teams2);
                             $left_teams3=count($left_teams2);
                             
                             $right_teams3=$this->team->team_by_position($right_id3,2);
                             $active_right_teams3= array_intersect($total_active, $right_teams3);
                             $right_teamss3=count($right_teams3);
                             $package3=$this->business->package($right_id3);
                             
                             $red_units=$this->team->inactives();
                             $inactive_right_team_dawn3= array_intersect($red_units, $right_teams3);
                             $inactive_left_teams3= array_intersect($red_units, $left_teams2);
                          
                             $total_green_unit_left=$this->team->my_actives_left_right($right_id3,1);
                             $total_green_unit_lefts3=count($total_green_unit_left);
                            
                             $total_green_unit_right=$this->team->my_actives_left_right($right_id3,2);
                             $total_green_unit_rights3=count($total_green_unit_right);
                             
                            $total_direct_red_left=$this->team->my_inactives_left_right($right_id3,1);
                            $total_direct_red_lefts3=count($total_direct_red_left);
                            
                            $total_direct_red_right=$this->team->my_inactives_left_right($right_id3,2);
                            $total_direct_red_rights3=count($total_direct_red_right);



                    } 
                }

                ?>
                <ol class="level-3-wrapper">
                   <?php
                    if($username_left3){
                    ?> 
                    <li>
                      <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $name_left3 ? $name_left3:'';?><br>Sponser Id: <?= $name2 ? $name2:'';?> (<?= $username2 ? $username2:'';?>)<br> Total Member:&nbsp; L:<?= $left_team_dawn2!='' ? $left_team_dawn2:'0';?>&nbsp;R:<?= $right_team_dawn2!='' ? $right_team_dawn2:'0';?><br>Kit :&nbsp;&nbsp; <?= $package_left_dawn;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team_dawn3)!='' ? count($active_left_team_dawn3):'0';?>&nbsp;R:<?= COUNT($active_right_team_dawn2)!='' ? COUNT($active_right_team_dawn2):'0';?>  <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_team_dawn3)!='' ? COUNT($inactive_left_team_dawn3):'0';?>&nbsp;R:<?= COUNT($inactive_left_team3)!='' ? COUNT($inactive_left_team3):'0';?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts_dawn3!='' ? $total_green_unit_lefts_dawn3:'0';?>&nbsp;R:<?= $total_green_unit_rights_dawn3!='' ? $total_green_unit_rights_dawn3:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts_dawn2!='' ? $total_direct_red_lefts_dawn2:'0';?>&nbsp;R:<?= $total_direct_red_lefts_dawn3!='' ? $total_direct_red_lefts_dawn3:'0';?><br> Time :<?= $active_date_dawn3 ? $active_date_dawn3:'';?>">
                    
                    <h3 class="level-3 rectangle myclass" id="<?= $left_id3;?>" onclick="myFunction()">
                   <?php if($status_left3==1){?>
                    <a  href="<?= $panel_path.'team/tree_test?parentid='.$left_id3;?>"><i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:green;"></i></a> 
                   <?php
                    }else{
                      ?>  
                      <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i>  
                   <?php 
                   }
                   ?><br><i class="client_name"><?= $username_left3 ? $username_left3:'';?><br><?= $name_left3 ? $name_left3:'';?><br></i></h3></span>

                    </li>
                    <?php
                    }else{
                        ?>
                         <li>
                    <h3 class="level-3 rectangle"> <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i><br><i class="client_name"><span>Null</span></i></h3>

                    </li>
                  <?php
                     }
                     if($username_right3){
                    ?>
                    <li>
                       
                   <span data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Name :<?= $name_right3 ? $name_right3:'';?><br>Sponser Id: <?= $name2 ? $name2:'';?> (<?= $username2 ? $username2:'';?>)<br> Total Member:&nbsp; L:<?= $left_teams3!='' ? $left_teams3:'0';?>&nbsp;R:<?= $right_teamss3!='' ? $right_teamss3:'0';?><br>Kit :&nbsp;&nbsp; <?= $package3;?><br> Total Green Unit :&nbsp;&nbsp;L<?= COUNT($active_left_team3)!='' ? count($active_left_team3):'0';?>&nbsp;R:<?= COUNT($active_right_teams3)!='' ? COUNT($active_right_teams3):'0';?>  <br> Total Red Unit :&nbsp;&nbsp;L:<?= COUNT($inactive_left_teams3)!='' ? COUNT($inactive_left_teams3):'0';?>&nbsp;R:<?= COUNT($inactive_right_team_dawn3)!='' ? COUNT($inactive_right_team_dawn3):'0';?><br> Total Direct Green :&nbsp;&nbsp;L:<?= $total_green_unit_lefts3!='' ? $total_green_unit_lefts3:'0';?>&nbsp;R:<?= $total_green_unit_rights3!='' ? $total_green_unit_rights3:'0';?><br> Total Direct Red :&nbsp;&nbsp;L:<?= $total_direct_red_lefts3!='' ? $total_direct_red_lefts3:'0';?>&nbsp;R:<?= $total_direct_red_rights3!='' ? $total_direct_red_rights3:'0';?><br> Time :<?= $active_date3 ? $active_date3:'';?>"> 
                    <h3 class="level-3 rectangle  myclass" id="<?= $right_id3;?>" onclick="return my_new_func(this.id);">
                    <?php if($status_right3==1){?>
              <a  href="<?= $panel_path.'team/tree_test?parentid='.$right_id3;?>"><i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:green;"></i></a> 
               <?php
                }else{
                  ?>  
                  <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i>  
               <?php 
               }
               ?><br><i class="client_name"><?= $username_right3 ? $username_right3:'';?><br><?= $name_right3 ? $name_right3:'';?><br></i></h3></span>
                    </li>
                    <?php
                     }else{
                         ?>
                    <li>
                    <h3 class="level-3 rectangle"> <i class="fa fa-circle" aria-hidden="true" style="font-size:35px; color:red;"></i><br><i class="client_name"><span>Null</span></i></h3>
                    </li>
                   <?php
                   }
                    ?>
                    
                   
                </ol>
            </li>
           
             
            </ol>
                      

<script>
   
  function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display ==="none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";

  }
}

</script>

