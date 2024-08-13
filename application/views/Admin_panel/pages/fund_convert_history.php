<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Fund convert</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Fund convert</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Fund convert history </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Fund convert</h6>
<hr>
<?php

             $likecondition=($this->session->userdata($search_string) ? $this->session->userdata($search_string):array());
             
             ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <form action="<?= $admin_path.'fund/fund_convert_history';?>" method="get">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                  <div class="form-group">                      
                   <select name="tx_type" class="form-control" id="">
                    <option value="">Select Credit/Debit</option>
                        <option value='credit' <?= isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']=='credit' ? 'selected':'';?> >Credit</option>
                        <option value='debit' <?= isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']=='debit' ? 'selected':'';?> >debit</option>
                   </select>                      
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
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                  <a class="btn btn-sm" href="<?= $admin_path.'fund/fund_convert_history';?>" class="">Reset</a>
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
                <th>Amount</th>
                <th>Credit/Debit</th>
                <th>Wallet Type</th>
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
                <td><?= $t_data['amount'];?></td>
                <td><?= $t_data['debit_credit'];?></td>
                <td><?= $t_data['wallet_type'];?></td>
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
