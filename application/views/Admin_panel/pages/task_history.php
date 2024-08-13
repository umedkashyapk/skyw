 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Task History</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Task</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Task History</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Task History</h6>
<hr>
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

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card card-body">
            <div class="table-responsive">
                <table id="aaa" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>Sr</th>
                            <th>Username</th>
                            <th>Task Title</th> 
                            <th>Status</th> 
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($table_data)){
                                //echo $num;
                                $sr=0;
                                foreach($table_data as $arr){
                                        $task_id=$arr['id'];
                                        $task_ids=$arr['task_id'];
                                         $user_id=$this->profile->profile_info($arr['u_id'],'username');;
                                        //echo "select * from task_history where u_id='$usrId' and task_id='$task_id'";
                                        $task_detail=$this->conn->runQuery("heading1",'task_data',"id='$task_ids'");
                                    ?>
                                        <tr>
                                            <td><?php echo $sr+1;;?></td>
                                            
                                            <td align="center"><?php echo $user_id->username;?></td>
                                            <td align="center"><?php echo $task_detail[0]->heading1;?></td>
                                            <td align="center"><?php echo "Task Complete";?></td>
                                            <td align="center"><?php echo $arr['added_on'];?></td>
                                        
                                        </tr>
                                    <?php $sr++; }
                                    
                                /*for($i=$pg;$i<$rec;$i++){
                                $ids=$table_info[$i]['u_id'];
                                $task_ids=$table_info[$i]['task_id'];
                                $user_detail=$db->runQuery("select username from users where id='$ids'");
                                $task_detail=$db->runQuery("select heading1 from task_data where id='$task_ids'");
                                ?>
                                <tr>
                                <td align="center"><?php echo $i+1;?></td>
                                <td align="center"><?php echo $user_detail[0]['username'];?></td>
                                <td align="center"><?php echo $task_detail[0]['heading1'];?></td>
                                <td align="center"><?php echo "Task Complete";?></td>
                                <td align="center"><?php echo $table_info[$i]['added_on'];?></td>
                                
                                </tr>
                                <?php	
                                }*/	
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
