<?php
 $ttl_records=$this->conn->runQuery('COUNT(id) as total','users','1=1')[0]->total;
//echo date('2021-09-30 00:00:00');
?>


<div class="row pt-3 bg-default">
        <div class="col-sm-10">
		  <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Block/Unblock Team Member</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Block/Unblock Team Member</li>
         </ol>
	   </div>
	   <div class="col-sm-2">
       
     </div>
</div>
 
 

<div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php 
    $success['param']='success';
	$success['alert_class']='alert-success';
	$success['type']='success';
	$this->show->show_alert($success);

	$erroralert['param']='error';
	$erroralert['alert_class']='alert-danger';
	$erroralert['type']='error';
	$this->show->show_alert($erroralert);
?>
            <div class="card card-body">
            
               <form action="<?= $admin_path.'team/team_member';?>" method="post">
                     <div class="form-inline1">
                     <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' required/>
                     <input type="submit" name="submit" class="  " value="filter" />
                       <button> <a href="<?= $admin_path.'team/team_member';?>" class="">Reset</a></button>&nbsp;
                        
                    </div>
                </form>
            </div>
         
        
     
       
 
    <div class="card ">
    <div class="card-header text-right"></div>
        <div class="table-responsive">
            <form action="<?= $admin_path.'team/team_member';?>" method="post">
               <input type="submit" class="btn btn-danger btn-sm" name="block_btn" value="Block all" />
                   <input type="submit" class="btn btn-info btn-sm" name="unblock_btn" value="Un Block all" />
                             
            <table class="table table-hover">
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Status</th>
                        
                      
                    </tr>
                </thead>
                <tbody>
                   
                    <?php
                  
                   if(!empty($user_id)){
                       $team=$this->team->my_generation($user_id);
                      // print_r($team);
                    foreach($team as $teamuser){
                       $profile=$this->profile->profile_info($teamuser);
                       $sr++;
                      
                    ?>
                    <tr>
                    
                        <td><?= $sr;?></td>
                         <input type="hidden" name="block_ids[]" id="<?= $sr;?>" value="<?= $profile->id;?>" required/>
                         <input type="hidden" name="unblock_ids[]" id="<?= $sr;?>" value="<?= $profile->id;?>" required/>
                        <td><?= $profile->name;?></td>
                        <td><?= $profile->username;?></td>
                      
                       <td><?php
                       
                       if($profile->block_status==1){
                           echo"Block";
                       }else{
                           echo"Un-Block";
                       }
                       
                       ?></td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                   
                    
                </tbody>
            </table>
            
            </form>
        </div>
    </div>

    </div>
</div>
