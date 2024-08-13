<?php


$tds_details=$this->conn->runQuery('*','transaction',"id='$tds_id' and status=1 and tx_type='withdrawal'");
if(!$tds_details){
    redirect($admin_path.'report/pending');
}
$t_data=$tds_details[0];



?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Tds Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Tds</a></li>            
                     
            <li class="breadcrumb-item active" aria-current="page">  Tds Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Tds Detail</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
       

<div class="table-responsive">
<table class="table table-hover">
        <?php
      $user_id=$t_data->u_code;
          $tx_profile=$this->profile->profile_info($t_data->u_code);
          $bank_details=json_decode($t_data->bank_details,true); 
          $fields_arr=array_key_exists($bank_details['account_type'],$fields) ? $fields[$bank_details['account_type']]:array();
          $get_amnt=$this->conn->runQuery('SUM(amount) as amnt','transaction',"u_code='$user_id' and tx_type='withdrawal' and status='1'")[0]->amnt;
                 $ttl_amnt=$get_amnt!='' ? $get_amnt:0;
                 $tds_amnt=$ttl_amnt*5/100; 
                 $total += $ttl_amnt;
                 $total_tds += $tds_amnt;
                 $accounts=$this->conn->runQuery('*','user_accounts',"u_code='$user_id'");
                 $pan_number=$accounts[0]->pan_no;
        ?>
            <tr>               
                <th> User</th><td>:</td><td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
            </tr>
            <tr>
                <th>Total TDS</th><td>:</td><td><?= $tds_amnt;?></td>
            </tr>
            <tr> 
                <th>Pan Card Number</th><td>:</td><td><?= $pan_number;?></td>  
               </tr>
           
            <tr>
                <th>Date </th><td>:</td><td><?= $t_data->date;?></td>  
                 
            </tr>
         
        
    </table>
    
</div>



   
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <form action="" method="post">
            <!--<div class="form-group">
              <label for="">Reason (Give Reason on cancellation)</label>
              <textarea name="reason" id="" class="form-control"></textarea>
              <small class="text-muted"><?= form_error('reason');?></small>
            </div>-->
            <div class="form-group">  
        <button type="submit" name="tds_approve_btn" class="btn btn-success">Approve</button>
        <!--<button type="submit" name="cancel_btn" class="btn btn-danger">Cancel</button>-->
            </div>
    </form>
    </div>
</div>
