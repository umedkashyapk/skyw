<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Active From User</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Active From User</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  ALL</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>


<?php
        $success['param']='success';
        $success['alert_class']='alert-success';
        $success['type']='success';
        $this->show->show_alert($success);

       
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <form action="<?= $admin_path.'users/from-active';?>" method="get">
             <div class="form-inline">
                <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Tx User" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 
                     <div class="form-group m-1">
                 <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                  </div>
                 
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                <!--<input type="submit" name="reset" class="btn btn-sm" value="Reset" />-->
                 <a href="<?= $admin_path.'users/from-active';?>" class="btn btn-sm">Reset</a>
                  
            </div>
        </form>
       
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Userid(Name)</th>
                        <th>From User</th>
                        <th>Tx Type</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                     <?php

                if($table_data){
                    
                    foreach($table_data as $t_data){   
                        $sr_no++;
                      if($t_data['u_code']!=''){
                           $profile=$this->profile->profile_info($t_data['u_code'],'name,username');
                       }
                       $profile_tx_user=$this->profile->profile_info($t_data['tx_u_code'],'name,username');
                      ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                        <td><?= $profile ? $profile->username .'('.$profile->name.')':'';?></td>   
                        <td><?= $profile_tx_user ? $profile_tx_user->username .'('.$profile_tx_user->name.')':'';?></td>     
                        <td><?= $t_data['tx_type'];?></td>  
                        <td><?= $t_data['date'];?></td> 
                                   
                    </tr>
                    <?php
                    }
                }
            ?>
                    
                </tbody>
            </table>
        </div>
          <?php 
    
    echo $this->pagination->create_links();?>
    </div>
</div>
