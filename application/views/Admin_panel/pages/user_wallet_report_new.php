<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> User Wallet Report</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> User Wallet Report</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  User Wallet Report</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> User Wallet Report</h6>
<hr>
<?php

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
         <form action="<?= $admin_path.'users/user_wallet_report';?>" method="get">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
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
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />
                 <!--<input type="submit" name="reset" class="btn btn-sm" value="Reset" />
                 <input type="submit" name="export_to_excel" class="btn btn-sm" value="Export to excel" />-->
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
        $ttl=$this->conn->runQuery('sum(c1)as total','user_wallets',"1=1");
        $ttl_amnt=$ttl[0]->total;
       
        ?>
         <div align="right">
            <div class="table table-responsive"> 
                <table>
                    <tr>
                      <th>Total Wallet Amount(<?=round($ttl_amnt)?>)</th>
                      
                      
                   </tr>
                </table>
            </div>
        </div>   

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
             <tr>
                      <th>Sr No.</th>
                      <th>Username</th>
                      <th>Full Name</th>
                      <th>Main Wallet</th>
                     <!-- <th>Topup Wallet</th>
                      <th>Shopping Wallet</th>
                  -->
                     <!-- <th>Active Date</th>-->
                     
                    </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
           
            foreach($table_data as $t_data){   
               
                $sr_no++;            
                    $tx_profile=$this->profile->profile_info($t_data['u_code']);
                 

            ?>
              <tr>
              <td><?= $sr_no;?></td>
              <td><?= $tx_profile->username;?></td>
              <td><?= $tx_profile->name;?></td>
              <td><?= round($t_data['c1'],2);?></td>
              <!-- <td><?= round($t_data['c2'],2);?></td>
                <td><?= round($t_data['c36'],2);?></td>-->
             <!-- <td><?= $tx_profile->active_date;?></td>-->
             
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
