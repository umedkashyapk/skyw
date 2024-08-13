<style>
    .mark_view {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}

@media screen and (max-width: 768px) {
  .mark_view {
   flex-direction:column;
}
.detail_view {
    margin-bottom: 10px;
}
}
</style>


<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Pending Withdrwals</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Withdrwals</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Pending </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>

<?php
  $api_key="325b5081c7d3317d1c7b6fe744a91a61";//$this->conn->company_info('api_key');
        $api_key_trc="7f0b9bbfe097f95261ca4c32c3f01708";//$this->conn->company_info('api_key');
 //$api_key=$this->conn->company_info('api_key');
//$api_rest=$this->crypto->api_detail($api_key_trc);
//print_R($api_rest);
 $url = "https://test.eracom.in/sendcryp/";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    
                    $headers = [
                      "Content-Type: application/x-www-form-urlencoded"
                    ];
                    
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    
                    $data = http_build_query([
                     "api_key" => $api_key,
	                "action" => "vendor_info",
                    ]);
                    
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    
                    $api_rest = json_decode(curl_exec($curl), true);
                    curl_close($curl);
                    
                    
                    
                    ////////////////////tron//////////////////////////////////
                    
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    
                    $headers = [
                      "Content-Type: application/x-www-form-urlencoded"
                    ];
                    
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    
                    $data = http_build_query([
                     "api_key" => $api_key_trc,
	                 "action" => "vendor_info",
                    ]);
                    
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    
                    $api_rest1 = json_decode(curl_exec($curl), true);
                    curl_close($curl);
   
 ?>
<h6 class="text-uppercase"> Pending Withdrwals</h6>
<hr>
<?php

    $company_payment_methods=$this->conn->runQuery('*','company_payment_methods',"status='1'");
                            
    $fields=array();
    if($company_payment_methods){
        foreach($company_payment_methods as $payment_method_detais){
            $fields[$payment_method_detais->unique_name]=json_decode($payment_method_detais->fields_required,true);
        }
    }

 $success['param']='success';
$success['alert_class']='alert-success';
$success['type']='success';
$this->show->show_alert($success);

$erroralert['param']='error';
$erroralert['alert_class']='alert-danger';
$erroralert['type']='error';
$this->show->show_alert($erroralert);
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
}else{
	$likecondition=array();
}   
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="<?= $admin_path.'withdrawal/pending';?>" method="REQUEST">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 
                  <!--<select class="form-control" name="selected_color" id="selected_color"  >-->
                  <!--              <option value="">Select Colour</option>-->
                  <!--                <option  value="green" <?= isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']=='green' ? 'selected':'';?> >Green </option>-->
                  <!--                <option  value="pink" <?= isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']=='pink' ? 'selected':'';?>>Pink </option>-->
                  <!--                <option  value="yellow" <?= isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']=='yellow' ? 'selected':'';?>>Yellow </option>-->
                                  
                  <!--              </select>-->
                 
                 <select class="form-control" name="select_team" id="select_team"  >
                     <option  value="">Select Business</option>
                     <option  value="power_leg">Power Leg</option>
                     <option  value="other_leg">Other Leg</option>
                  </select>   
                 
                 
                  <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                 <!-- <div class="form-group ">                      
                    <input type="text" Placeholder="Enter amount" name="amount" class="form-control" value='<?= isset($_REQUEST['amount']) && $_REQUEST['amount']!='' ? $_REQUEST['amount']:'';?>' />                      
                 </div>
                 <div id="dateragne-picker">
                    <div class="input-daterange input-group">
                    <input type="text" class="form-control"  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                    <div class="input-group-prepend">
                    <span class="input-group-text">to</span>
                    </div>
                    <input type="text" class="form-control"  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                    </div>
               </div>  -->
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                 <a href="<?= $admin_path.'withdrawal/pending';?>" class="btn btn-sm">Reset</a>&nbsp;
               <input type="submit" name="export_to_excel" class="btn btn-sm" value="Export to excel" />
            </div>
        </form>
      <!--  <input type="button" id="btnExport" value="Export" />-->
<br>
<!-- Add this button wherever you want on your page -->

<!-- Network Details Modal -->
<div class="modal fade" id="networkDetailsModal" tabindex="-1" role="dialog" aria-labelledby="networkDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="networkDetailsModalLabel">Network Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="networkTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="bscTab" data-toggle="tab" href="#bscDetails" role="tab" aria-controls="bscDetails" aria-selected="true">BSC Network</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tronTab" data-toggle="tab" href="#tronDetails" role="tab" aria-controls="tronDetails" aria-selected="false">Tron Network</a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="networkTabContent">
                    <!-- BSC Network Details -->
                    <div class="tab-pane fade show active" id="bscDetails" role="tabpanel" aria-labelledby="bscTab">
                        <p><strong>Network:</strong> <?= $api_rest['network'];?></p>
                        <p><strong>Account Id:</strong> <?= $api_rest['account_id'];?></p>
                        <p><strong>Payout Wallet:</strong> <?= $api_rest['payout_wallet'];?></p>
                        <p><strong>Receiving Wallet:</strong> <?= $api_rest['receiving_wallet'];?></p>
                        <p><strong>Fee Wallet:</strong><?= $api_rest['fee_wallet'];?></p>
                        <p><strong>BNB Balance:</strong> <?= $api_rest['coin_balance'];?></p>
                        <p><strong>Token Balance:</strong> <?= $api_rest['token_balance'];?></p>
                        <!-- Add more BSC network details here -->
                    </div>

                    <!-- Tron Network Details -->
                    <div class="tab-pane fade" id="tronDetails" role="tabpanel" aria-labelledby="tronTab">
                       <p><strong>Network:</strong> <?= $api_rest1['network'];?></p>
                        <p><strong>Account Id:</strong> <?= $api_rest1['account_id'];?></p>
                        <p><strong>Payout Wallet:</strong> <?= $api_rest1['payout_wallet'];?></p>
                        <p><strong>Receiving Wallet:</strong> <?= $api_rest1['receiving_wallet'];?></p>
                        <p><strong>Fee Wallet:</strong><?= $api_rest1['fee_wallet'];?></p>
                        <p><strong>TRX Balance:</strong> <?= $api_rest1['coin_balance'];?></p>
                        <p><strong>Token Balance:</strong> <?= $api_rest1['token_balance'];?></p>
                        <!-- Add more Tron network details here -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>






 <?php
         $ttl_pages=ceil($total_rows/$limit);
         if($ttl_pages>1){
             ?>
              <form action="" method="get">
                <div class="form-group">
                    
                    Go to Page : 
                    <input type="text" list="pages" name="page" value="<?= (isset($_REQUEST['page']) ? $_REQUEST['page']:'');?>" />
                    
                    <datalist id="pages">
                         <?php
                             for($pg=1;$pg<=$ttl_pages;$pg++){
                                 ?><option value="<?= $pg;?>" ><?= $pg;?></option><?php
                             }
                         ?>
                    </datalist>
                    <input type="submit" name="submit" class=" " value="Go" />
                </div>
            </form>
             <?php
         }
        ?>
       
<br>
<form action="<?= $admin_path.'withdrawal/action_multiple';?>" method="post">
    <div class="mark_view">
<div class="detail_view">
<!-- <input type="submit" class="btn btn-info btn-sm" name="withdrawal_btn" value="Approve all" /> -->
<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#formemodal" onclick="return false;">Reject All</button>
</div>
<!-- <div class="form_data">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#networkDetailsModal">API Details</button>
</div> -->
</div>
<div class="modal fade" id="formemodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Please give reject reason. </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                             <div class="form-group">
                               <label for="input-3">Enter Reason</label>
                               <textarea name="reject_reason" id=""  class="form-control"></textarea>
                             </div>
                            
                             <div class="form-group">
                              <button type="submit" name="reject_btn" class="btn btn-info shadow-info px-5"><i class="icon-lock"></i> Reject All</button>
                            </div>
                      </div>
                    </div>
                  </div>
                </div>
<div class="table-responsive">
    <table class="table table-hover" id="tblCustomers">
        <thead>
            <tr>
                
                <th>S No.</th>
				<th>
                    <input type="checkbox" id="selectAll" />
                </th>
                <th>Tx user</th>
                <th>User Color</th>
                <th>Action</th>
                <th>Amount</th>
                <th>Tx Charge</th>
                <th>Payable Amount</th>
                <th>Account Details</th>
               
                <th>Status </th>
                <!--<th>Hash </th>-->
                <th>Date </th>
                 
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
            
            foreach($table_data as $t_data){
                    $user_id=$t_data['u_code'];
                    $sr_no++;            
                    $tx_profile=$this->profile->profile_info($t_data['u_code']);
                    $selected_color=$tx_profile->selected_color;
                    $bank_details=json_decode($t_data['bank_details'],true);  
                    $fields_arr=array_key_exists($bank_details['account_type'],$fields) ? $fields[$bank_details['account_type']]:array();
                    $bank_account_detail=$this->conn->runQuery('*','user_accounts',"u_code=$user_id");
                    /*echo"<pre>";
                    print_r($bank_account_detail[0]->email);*/
                    
                   $withdrwal_sts=$t_data[' withdraw_status'];
            ?>
            <tr>
                <td><?= $sr_no;?></td>
				 <td>
                    <input type="checkbox" name="wd_ids[]" id="<?= $sr_no;?>" value="<?= $t_data['id'];?>" />
                </td>
                 
                <td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
                <td>
                   <?= $selected_color;?>
                </td>
                <td><a class="btn btn-sm btn-info" href="<?= $admin_path.'withdrawal/view?id='.$t_data['id'];?>">View</a></td>                               
                <td><?= $t_data['amount']+$t_data['tx_charge'];?></td>                               
                <td><?= $t_data['tx_charge'];?></td>                               
                <td><?= $t_data['amount'];?></td> 
                <?php
                if($withdrwal_sts==7){
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
                }else{
                ?>    
                    
               <td><?= $t_data['payment_type'];?> : <?= $t_data['bank_details'];?></td>    
                 <?php   
                }
                ?>
               <!-- <td><?= $t_data['tx_hash'];?></td>            -->                
                <td><span class="badge badge-warning badge-sm"><?= $t_data['status']==0 ? 'Pending':'';?></span></td>                                
                <!--<td><?= $t_data['tx_hash'];?></td>                                -->
                <td><?= $t_data['date'];?></td>                                
                           
            </tr>
            <?php
            }
        }
            ?>
            
        </tbody>
    </table>
</div>
</form>

    <?php 
    
    echo $this->pagination->create_links();?>
    </div>
</div>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
    </script>