<style>
    .col-md-4.card.card-body {
    border: 1px solid #ebe9e924;
    margin: 10px;
}

label.upload_pic {
    width: 100%;
 text-transform: uppercase;
    font-size: 14px;
}



input#pro_img {
   width: 100%;
 
}
img.upload_picimage {
    width: 100%;
}
input.btn.btn-primary.btn-remove {
    background: #eaa500;
    border: none;
    color: #000;
    font-size: 18px;
}
</style>


<br><br><br><br>
<?php 
$profile=$this->session->userdata("profile"); 
$user_id=$this->session->userdata("user_id"); 
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Reward</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Bonanza Rewards</li>
         </ol>
	   </div>
	 
</div>

 
             <div class="card card-body card-bg-1">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
<div class="table-responsive">
    <table class="<?= $this->conn->setting('table_classes'); ?>">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Self Business</th>
                <th>Direct Business</th>
                <th>Team Business</th>
                <th>Reward</th> 
                <th>Start Date</th>    
                <th>End Date</th>                 
                     
                <th>Status</th>                
                
                 
            </tr>
            <?php
            $my_plan=$this->conn->runQuery('*','plan',"1=1");
           
           // $top_legs1=$this->business->top_legs($user_id);
            //$max_leg_business=$top_legs1[0];
            //echo "<br>";
            //$other_leg=array_sum($top_legs1)-max($top_legs1);   
            $self_package=$this->business->package($user_id);
            if($my_plan){
                $sno=0;
                for($i=0;$i<1;$i++){
                    $bonanza_direct_business=$my_plan[$i]->bonanza_business;
                  $our_rank=$my_plan[$i]->package_name;
                   
                    $bonanza_self_business=$my_plan[$i]->bonanza_self_business;
                    $bonanza_team_business=$my_plan[$i]->bonanza_team_business;
                    $bonanza_reward=$my_plan[$i]->bonanza_reward;
                    $bonanza_start_date=$my_plan[$i]->bonanza_start_date;
                    $bonanza_end_date=$my_plan[$i]->bonanza_end_date;
                    
                    
                     $goalstatus=($self_package>=$bonanza_self_business  ? 'Achieved':'Pending');
                     if($goalstatus=="Achieved"){
                     	
                        $check_rank_=$this->conn->runQuery('u_code','rank_bonanza',"rank_id='$i' and u_code='$user_id' and rank='$our_rank'");
                        if(!$check_rank_){
                            $rankinsert['u_code']=$user_id;
                            $rankinsert['rank']=$our_rank;
                            $rankinsert['is_complete']=1;
                            $rankinsert['rank_id']=$i;
                            $this->db->insert('rank_bonanza',$rankinsert);
                        }
                       
                       
                     }  
                    ?>
                    <tr>
                         <td><?= $i+1;?></td>
                         <td><?= $bonanza_self_business;?></td>
                         <td><?= $bonanza_direct_business;?></td>
                         <td><?= $bonanza_team_business;?></td>
                         <td><?= $bonanza_reward;?></td>
                         <td><?= $bonanza_start_date;?></td>
                         <td><?= $bonanza_end_date;?></td>
                        <td><?= $goalstatus;?></td>
                       
                    </tr>
                    <?php
                }
            }
            ?>
        </thead>
        
    </table>
</div>



    
    </div>
</div>
<div class="row">
<?php
$bonanza_exists=$this->conn->runQuery('*','rank_bonanza',"u_code='$user_id'");
if(!empty($bonanza_exists)){
    if($bonanza_exists[0]->status=='0'){
?>
<div class="col-md-4 card card-body">
		    <?php 
                        $success['param']='success';
                        $success['alert_class']='alert-success';
                        $success['type']='success';
                        $this->show->show_alert($success);
                        ?>
                            <?php 
                        $erroralert['param']='error';
                        $erroralert['alert_class']='alert-danger';
                        $erroralert['type']='error';
                        $this->show->show_alert($erroralert);
                    ?>
		   <?php echo validation_errors(); ?>
		  
			<form action="" method="post" role="form" enctype="multipart/form-data">
			     
				<div class="form-group">
				<label class="upload_pic">Passport Size Image</label><br>
				 <input type="file" name="pro_img" id="pro_img" value="" class="form-control" placeholder="" aria-describedby="helpId">
					 <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
				</div>
				
				<div class="form-group">
				<label class="upload_pic">Passport Front Image</label><br>
				 <input type="file" name="front_img" id="front_img" value="" class="form-control" placeholder="" aria-describedby="helpId">
					 <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
				</div>
				
					<div class="form-group">
				<label class="upload_pic">Passport Back Image</label><br>
				 <input type="file" name="back_img" id="back_img" value="" class="form-control" placeholder="" aria-describedby="helpId">
					 <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
				</div>
				<br>
				<input type="submit" class="btn btn-primary btn-remove" value="Submit" name="add_pass" />
				 
			</form>
		
		</div>
			<?php
		   }
			?>
		
		<div class="col-md-4 card card-body">
		    <?php
		     if($bonanza_exists[0]->pro_img!=''){
		    ?>
		    <span style="color:#fff">Passport Size Image</span>
		     <img src="<?= $bonanza_exists[0]->pro_img;?>" style="width:150px; height:150px;" class="upload_picimage">
		    <?php
		     }
		    ?>
		    <?php
		     if($bonanza_exists[0]->front_img!=''){
		    ?>
		    
		    <span style="color:#fff">Front Image</span>
		    <img src="<?= $bonanza_exists[0]->front_img;?>" style="width:150px; height:150px;" class="upload_picimage">
		    <?php
		     }
		    ?>
		    <?php
		     if($bonanza_exists[0]->back_img!=''){
		    ?>
		    <span style="color:#fff">Back Image</span>
		    <img src="<?= $bonanza_exists[0]->back_img;?>" style="width:150px; height:150px;" class="upload_picimage">
		    <?php
		     }
		    ?>
		    </div>
		  </div>
		    
		<?php
}
		?>

</div>
<br>
<br>