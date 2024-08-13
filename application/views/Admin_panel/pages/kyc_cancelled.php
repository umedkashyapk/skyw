<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Cancelled Kyc</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Kyc</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Cancelled</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Cancelled Kyc</h6>
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
/*if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());	 
}else{
	$likecondition=array();
}*/
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="<?= $admin_path.'kyc/cancelled';?>" method="get">
             <div class="form-inline">
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Tx User" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                   <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                 <a href="<?=$admin_path.'kyc/cancelled';?>"class="btn btn-sm">Reset</a>
               
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
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Tx user</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>C/o</th>
                <th>Dob</th>
                <th>Id No.</th>
                <th>Address</th>
                <th>Tax id/Pan Number</th>
                <th>Bank Detail</th>
                <th>Remark</th>
               
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
                <td><?= $tx_profile->name;?></td>
                <td><?= $tx_profile->username;?></td>
                <td><?= $t_data['name'];?></td>
                <td><?= $t_data['father_name'];?></td>
                <td><?= $t_data['dob'];?></td>
                <td><?= $t_data['id_no'];?></td>
                <td><?= $t_data['address'];?></td>
                <td><?= $t_data['tax_id'];?></td>
                <td>Bank Name:<?= $t_data['bank_name'];?>
                <br>A/c Holder Name:<?= $t_data['account_holder_name'];?>
                <br>A/c Number:<?= $t_data['account_no'];?>
                <br>Ifsc:<?= $t_data['ifsc_code'];?>
                <br>Branch:<?= $t_data['bank_branch'];?>
                <br></td>
                <td><?= $t_data['kyc_remark'];?></td>
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