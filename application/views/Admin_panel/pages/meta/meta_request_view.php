<?php
$withdrawal_details=$this->conn->runQuery('*','meta_request',"id='$rq_id' and status=0");
if(!$withdrawal_details){
    redirect($admin_path.'meta/pending');
}
$t_data=$withdrawal_details[0];
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">  Meta Request Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Meta Request</a></li>            
            <li class="breadcrumb-item"><a href="#"> Pending</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Meta Request Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Meta Request Detail</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
       

<div class="table-responsive">
<table class="table table-hover">
        <?php
          $tx_profile=$this->profile->profile_info($t_data->u_code);
           
        ?>
            <tr>               
                <th> User</th><td>:</td><td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
            </tr>
            <tr>
                <th>Amount</th><td>:</td><td><?= $t_data->amount;?></td>  
                </tr>
             <th>Status </th><td>:</td><td><span class="badge badge-warning badge-sm"><?= $t_data->status==0 ? 'Pending':'';?></span></td> 
                </tr>
            <tr>
                <th>Date </th><td>:</td><td><?= $t_data->added_on;?></td>  
                 
            </tr>
         
        
    </table>
    
</div>



   
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <form action="" method="post">
            <div class="form-group">
              <label for="">Reason (Give Reason on cancellation)</label>
              <textarea name="reason" id="" class="form-control"></textarea>
              <small class="text-muted"><?= form_error('reason');?></small>
            </div>
             <div class="form-group">
              <label for="">Username</label>
              <input name="username" id="" class="form-control" placeholder="Enter Username">
              <small class="text-muted"><?= form_error('username');?></small>
            </div>
             <div class="form-group">
              <label for="">Password</label>
              <input name="password" id="" class="form-control" placeholder="Enter Password">
              <small class="text-muted"><?= form_error('password');?></small>
            </div>
            
            <div class="form-group">  
        <button type="submit" name="approve_btn" class="btn btn-success">Approve</button>
        <button type="submit" name="cancel_btn" class="btn btn-danger">Cancel</button>
            </div>
    </form>
    </div>
</div>
