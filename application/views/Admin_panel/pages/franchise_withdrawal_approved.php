<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		   
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Withdrwals</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Franchise   Approved </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Franchise  Approved Withdrwals</h6>
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
<?php
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());	 
}else{
	$likecondition=array();
}
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="<?= $admin_path.'withdrawal/franchise-approved';?>" method="post">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                  <!--<div class="form-group ">                      
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
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />
                 <!--<input type="submit" name="reset" class="btn btn-sm" value="Reset" />-->
            </div>
        </form>
<br>
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
<?php
$ttl=$this->conn->runQuery('sum(amount)as total,sum(tx_charge)as charge','transaction_franchise',"status='1'");
$ttl_amnt=$ttl[0]->total;
//$ttl_tx_charge=$ttl[0]->charge;
?>
 <div align="right">
    <div class="table table-responsive"> 
        <table>
            <tr>
              <th>Payable Amount(<?=round($ttl_amnt)?>)</th>
              <!--<th>Total Tx Charge(<?=round($ttl_tx_charge)?>)</th>-->
          
           </tr>
        </table>
    </div>
</div>    
       

<div class="table-responsive">
<table class="table table-hover">
        <thead>
             <tr>
                <th>S No.</th>
                <th>User Name</th>
                <th>Full Name</th>
                <th>Total Amount</th>
                <th>Payable Amount</th>
                <!-- <th>Tx Charge</th>-->
                <th>A/c Holder Name</th>
                <th>A/c No.</th>
                 <th>Ifsc Code</th>
                <th>Bank Name</th>
                <th>Branch Name</th>
                <th>Mobile number</th>
                <th>Mail Id</th>
                <th>Status </th>
                <th>Date&time</th>
                 
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
            
            foreach($table_data as $t_data){               
                    $u_code= $t_data['u_code'];
               $tx_profile=$this->conn->runQuery('*','franchise_users',"id='$u_code'");
              
                $sr_no++;
            ?>
            <tr>
                <td><?= $sr_no;?></td>      
                <td><?= $tx_profile[0]->username;?></td>
                <td><?= $tx_profile[0]->name;?></td>
                                         
                <td><?= $t_data['amount']+$t_data['tx_charge'];?></td>                               
               <!-- <td><?= $t_data['tx_charge'];?></td>   -->                            
                <td><?= $t_data['amount'];?></td>
                <td><?= $tx_profile[0]->holder_name;?></td>
                <td><?= $tx_profile[0]->ac_no;?></td> 
                <td><?= $tx_profile[0]->ifsc_code;?></td>
                <td><?= $tx_profile[0]->bank_name;?></td> 
                <td><?= $tx_profile[0]->branch_name;?></td>      
                <td><?= $tx_profile[0]->mobile;?></td>                               
                <td><?= $tx_profile[0]->email;?></td>                             
               <!-- <td><?= $bank_details->btc_address;?></td>                               
                <td><?= $bank_details->eth_address;?></td>  -->                             
                                             
                <td><span class="badge badge-warning badge-sm"><?= $t_data['status']==1 ? 'Approved':'';?></span></td>                                
                <td><?= $t_data['approve_date'];?></td>                                
                           
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