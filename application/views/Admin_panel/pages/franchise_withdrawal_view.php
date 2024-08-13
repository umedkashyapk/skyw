<?php
$withdrawal_details=$this->conn->runQuery('*','transaction_franchise',"id='$wd_id' and status=0");

if(!$withdrawal_details){
    redirect($admin_path.'withdrawal/franchise-pending');
}
$t_data=$withdrawal_details[0];
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		   
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Franchise   Withdrwals</a></li>            
            <li class="breadcrumb-item"><a href="#"> Pending</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Franchise    Withdrwal Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Franchise   Withdrwal Detail</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
       

<div class="table-responsive">
<table class="table table-hover">
        <?php
          //$tx_profile=$this->profile->profile_info($t_data->u_code);
         // $bank_details=json_decode($t_data->bank_details); 
          
          $u_code=$t_data->u_code;

         $tx_profile=$this->conn->runQuery('*','franchise_users',"id='$u_code'");
         
        // print_r($withdrawal_details);
        
        ?>
            <tr>               
                <th> User</th><td>:</td><td><?= $tx_profile[0]->name.'( '.$tx_profile[0]->username.' )';?></td>
            </tr>
           
            <tr>
                <th>Amount</th><td>:</td><td><?= $withdrawal_details[0]->amount;?></td>  
                </tr>
            <tr> 
                <th>Bank Name</th><td>:</td><td><?= $tx_profile[0]->bank_name;?></td>
                </tr>
            <tr>
                <th>A/c Holder Name</th><td>:</td><td><?= $tx_profile[0]->holder_name;?></td> 
                </tr>
            <tr>
                <th>A/c No.</th><td>:</td><td><?= $tx_profile[0]->ac_no;?></td> 
                </tr>
            <tr>
                <th>IFSC</th><td>:</td><td><?= $tx_profile[0]->ifsc_code;?></td> 
                </tr>
            <tr>
                <th>Bank Branch</th><td>:</td><td><?= $tx_profile[0]->branch_name;?></td>
                </tr>
                 
            <tr>               
                <th> Mobile</th><td>:</td><td><?= $tx_profile[0]->mobile;?></td>
            </tr>
               <tr>               
                <th> Mail Id</th><td>:</td><td><?= $tx_profile[0]->email;?></td>
            </tr> 
          <!--  <tr>
                <th>BTC</th><td>:</td><td><?= $bank_details->btc_address;?></td> 
                </tr>
            <tr>    
                <th>ETH</th><td>:</td><td><?= $bank_details->eth_address;?></td> 
                </tr>-->
            <tr>
                
                
                <th>Status </th><td>:</td><td><span class="badge badge-warning badge-sm"><?= $withdrawal_details->status==1 ? 'Approved':'';?></span></td> 
                </tr>
            <tr>
                <th>Date </th><td>:</td><td><?= $t_data->date;?></td>  
                 
            </tr>
         
        
    </table>
    
</div>



   
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <form action="" method="post">
           <!-- <div class="form-group">
              <label for="">Reason (Give Reason on cancellation)</label>
              <textarea name="reason" id="" class="form-control"></textarea>
              <small class="text-muted"><?= form_error('reason');?></small>
            </div>-->
            <input type="hidden" value="<?= $t_data->u_code;?>" class="form-control" name="user_id">
            <input type="hidden" value="<?= $t_data->amount+$t_data->tx_charge;?>" class="form-control" name="amount">
            <input type="hidden" value="<?= $t_data->wallet_type;?>" class="form-control" name="wallet_type">
            
            <div class="form-group">  
        <button type="submit" name="approve_btn" class="btn btn-success">Approve</button>
        <!--<button type="submit" name="cancel_btn" class="btn btn-danger">Cancel</button>-->
            </div>
    </form>
    </div>
</div>
