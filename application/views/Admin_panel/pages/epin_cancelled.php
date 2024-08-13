<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Cancelled Epin</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">  Cancelled Epin</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Cancelled Epin</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">  Cancelled Epin</h6>
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

?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    
         <form action="<?= $admin_path.'pin/cancelled ';?>" method="post">
             <div class="form-inline">
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 
                 <div id="dateragne-picker">
                    <div class="input-daterange input-group">
                    <input type="text" class="form-control"  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                    <div class="input-group-prepend">
                    <span class="input-group-text">to</span>
                    </div>
                    <input type="text" class="form-control"  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                    </div>
               </div>  &nbsp;&nbsp;
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;&nbsp;
                 <a href="<?= $admin_path.'pin/cancelled ';?>" class="btn btn-sm">Reset</a>
                <!-- <input type="submit" name="export_to_excel" class="btn btn-sm" value="Export to excel" />-->
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
<form action="<?= $admin_path.'withdrawal/action_multiple';?>" method="post">
<!--<input type="submit" class="btn btn-info btn-sm" name="withdrawal_btn" value="Approve all" />
<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#formemodal" onclick="return false;">Reject All</button><br><br>-->

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
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S No.</th>
				<!---<th>
                    <input type="checkbox" id="selectAll" />
                </th>-->
                <th>Tx user</th>
                <th>username</th>
                <th>Number Of Pins</th>
                <th>Utr Number</th>
                <th>Slip</th>
                <th>Status </th>
                <th>Date </th>
               
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
            
            foreach($table_data as $t_data){   
                $sr_no++;            
                    $tx_profile=$this->profile->profile_info($t_data['user_id']);
               

            ?>
            <tr>
                <td><?= $sr_no;?></td>
				<!--<td>
                    <input type="checkbox" name="wd_ids[]" id="<?= $sr_no;?>" value="<?= $t_data['id'];?>" />
                </td>-->
                <td><?= $tx_profile->name;?></td>
                <td><?= $tx_profile->username;?></td>
                <td><?= $t_data['number_of_pins'];?></td>
                 <td><?= $t_data['utr_number'];?></td>  
                <td><img src="<?= base_url().'images/slip/'.$t_data['slip'];?>" style="width:50px;"></td>
                
                <td><span class="badge badge-warning badge-sm"><?= $t_data['status']==2 ? 'Cancelled':'';?></span></td>                                
                <td><?= $t_data['added_on'];?></td>                                
                      
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
