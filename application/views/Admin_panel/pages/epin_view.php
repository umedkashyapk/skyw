<?php
$epin_details=$this->conn->runQuery('*','epin_requests',"id='$wd_id' and status=0");
if(!$epin_details){
    redirect($admin_path.'pin/pending');
}
$t_data=$epin_details[0];
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">  Epin Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Epin </a></li>            
            <li class="breadcrumb-item"><a href="#">  Epin Details</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Epin  Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Epin Detail</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
       

<div class="table-responsive">
<table class="table table-hover">
        <?php
          $tx_profile=$this->profile->profile_info($t_data->user_id);
         // $bank_details=json_decode($t_data->bank_details); 
        ?>
            <tr>               
                <th> Username</th><td>:</td><td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
            </tr>
            <tr>
                <th>Number of Pins</th><td>:</td><td><?= $t_data->number_of_pins;?></td>  
                </tr>
            <tr>
                <th>Pin Type</th><td>:</td><td><?= $t_data->pin_type;?></td>  
                </tr>    
            <tr> 
                <th>Utr Number</th><td>:</td><td><?= $t_data->utr_number;?></td>
                </tr>
                <tr> 
                <th>Slip</th><td>:</td><td><img src="<?= base_url().'images/slip/'.$t_data->slip;?>" style="width:50px;"></td>
                </tr>
            <tr>
                
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
        <button type="submit" name="approve_btn" class="btn btn-success">Approve</button>
        <button type="submit" name="cancel_btn" class="btn btn-danger">Cancel</button>
            </div>
    </form>
    </div>
</div>
