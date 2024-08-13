<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Fund Add History</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Fund Add History</a></li>            
           
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Fund Add History</h6>
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

             $likecondition=($this->session->userdata($search_string) ? $this->session->userdata($search_string):array());
             
             ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <form action="<?= $admin_path.'Crypto/fund-add-history';?>" method="post">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <div class="form-group m-1">                      
                    <select name='status'>
                        <option>Select Status</option>
                        <option value='0'>Pending</option>
                        <option value='1'>Paid</option>
                        <option value='2'>Expired</option>
                    </select>
                 </div>
                 
                 <div id="dateragne-picker">
                    <div class="input-daterange input-group">
                    <input type="text" class="form-control"  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                    <div class="input-group-prepend">
                    <span class="input-group-text">to</span>
                    </div>
                    <input type="text" class="form-control"  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                    </div>
               </div>  
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />
                 <a href="<?= $admin_path.'Crypto/fund-add-history';?>" class="btn btn-sm">Reset</a>
               
            </div>
        </form>
<br>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Userid</th>
                <th>Full Name</th>
                <th>Tx Id</th>
                 <th>Request Amount</th>
                <th>Paid Amount</th>
                <th>Wallet Type</th>
                <th>Status</th>
                <th>Address</th>
                <th>Date </th>
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
            
            foreach($table_data as $t_data){  
                $sr_no++;
                    $tx_profile=$this->profile->profile_info($t_data['u_code']);
                    $usrid=$t_data['u_code'];
                 
            ?>
            <tr>
                <td><?= $sr_no;?></td>
                <td><?= $tx_profile->username;?></td>
                <td><?= $tx_profile->name;?></td>
                  <td><?= $t_data['cryp_paymentId'];?></td>
                   <td><?= $t_data['amount'];?></td>
                <td><?= $t_data['paidAmount'];?></td>
                <td><?= $t_data['wallet_type'];?></td>
               <!--  <td><?= $t_data['cryp_status'];?></td>-->
                  <td><?php $sts=$t_data['cryp_status'];
                     if($sts=="expired"){
                          $ids=$t_data['cryp_paymentId'];
                    ?>
                    <a class="btn btn-sm btn-info" href="<?= $admin_path.'crypto/add_fund_expire?id='.$ids;?>">Review Transaction</a>         
                    
                    <?php
                     }else{
						 echo $sts;
					 }	 
                     ?>
                       
                     </td>
                 
                 
                 
                  <td><?= $t_data['cryp_paymentWallet'];?></td>
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
