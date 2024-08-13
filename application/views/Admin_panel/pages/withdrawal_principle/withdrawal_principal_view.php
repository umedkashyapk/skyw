<?php
$withdrawal_details=$this->conn->runQuery('*','transaction',"id='$wd_id' and status=0");
if(!$withdrawal_details){
    redirect($admin_path.'withdrawal_principal/pending');
}
$t_data=$withdrawal_details[0];


$company_payment_methods=$this->conn->runQuery('*','company_payment_methods',"status='1'");
                            
    $fields=array();
    if($company_payment_methods){
        foreach($company_payment_methods as $payment_method_detais){
            $fields[$payment_method_detais->unique_name]=json_decode($payment_method_detais->fields_required,true);
        }
    }
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Principal  Withdrwal Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Withdrwals</a></li>            
            <li class="breadcrumb-item"><a href="#"> Pending</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Principal  Withdrwal Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Principal Withdrwal Detail</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
       

<div class="table-responsive">
<table class="table table-hover">
        <?php
          $tx_profile=$this->profile->profile_info($t_data->u_code);
          $user_id=$t_data->u_code;
          $bank_details=json_decode($t_data->bank_details,true); 
          $fields_arr=array_key_exists($bank_details['account_type'],$fields) ? $fields[$bank_details['account_type']]:array();
          
           $bank_account_detail=$this->conn->runQuery('*','user_accounts',"u_code=$user_id");
          /* echo"<pre>";
           print_r($bank_account_detail);*/
        ?>
            <tr>               
                <th> User</th><td>:</td><td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
            </tr>
            <tr>
                <th>Principal Amount</th><td>:</td><td><?= $t_data->amount;?></td>
            </tr>
            <tr> 
                <th>Account Details</th><td>:</td>
                
                 <?php
                $bank_type=$this->conn->setting('bank_detail_type');
                if($bank_type=='automatic'){
                ?>
                <td>
                <?php
                 foreach($bank_details as $_key=>$account_details){
                    if($_key!='account_type' && !empty($fields_arr) && array_key_exists($_key,$fields_arr)){
	                     $ky=$fields_arr[$_key];
	                     echo "$ky : $account_details<br>";
                    }
                }
                ?>
                </td> 
               
                <?php
                 }elseif($bank_type=='manual'){
                     ?>
                    <td>
                        Bank Name:<b><?= $bank_account_detail[0]->bank_name;?></b><br>
                        Account Holder Name:<b><?= $bank_account_detail[0]->account_holder_name;?></b><br>
                        Account Number:<b><?= $bank_account_detail[0]->account_no;?><br>
                        Ifsc Code:<b><?= $bank_account_detail[0]->ifsc_code;?></b><br>
                        Bank Branch:<b><?= $bank_account_detail[0]->bank_branch;?></b>
                        </td> 
                     
                <?php
                 }
                ?>               
            </tr>
            <tr>
                
                
                <th>Status </th><td>:</td><td><span class="badge badge-warning badge-sm"><?= $t_data->status==1 ? 'Approved':$t_data->status==2 ? 'Rejected':'Pending';?></span></td> 
                </tr>
            <tr>
                <th>Date </th><td>:</td><td><?= $t_data->date;?></td>  
                 
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
        <button type="submit" name="approve_btn" class="btn btn-success btn-remove">Approve</button>
        <button type="submit" name="cancel_btn" class="btn btn-danger btn-remove">Cancel</button>
            </div>
    </form>
    </div>
</div>
