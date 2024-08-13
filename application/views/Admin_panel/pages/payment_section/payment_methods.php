<?php
 $user_id=$this->session->userdata('admin_edit_account');

$company_payment_methods=$this->conn->runQuery('*','company_payment_methods',"status='1'");
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Edit Account</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $admin_path.'users';?>">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Account</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<style>

.bg-image {
  background-image: url("<?= base_url('images/loader/ajax-loader.gif');?>");  
  filter: blur(0px);
}

/* Position text in the middle of the page/image */
.bg-text {
  /*background-color: rgb(0,0,0);*/ /* Fallback color */
 /* background-color: rgba(0,0,0, 0.4);*/ /* Black w/opacity/see-through */
  color: black;
  font-weight: bold;
  /*border: 3px solid #f1f1f1;*/
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 200;
  width: 80%;
  padding: 20px;
  text-align: center;
}
#blursection {
    z-index: 1;
}

</style>
<h6 class="text-uppercase">Edit Account</h6>
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
            <div class="row">
   
				<div class="col-md-6 card card-body "  >
				    <?= validation_errors('<span class="text-danger">','</span>'); ?>
				    <div id="account_add_loader" class="bg-text" style="display:none;"><img class="loading-image" src="<?= base_url('images/loader/ajax-loader.gif');?>"></div>
				        
				        
				        <div  id="blursection" > 
				    
    					<form role="form" method="post" action="" />
    						<div class="form-group">
    							<label for="account_type">
    								Select Type
    							</label>
    							<select name="account_type" class="form-control" id="account_type" data-response="add_account_sec" data-blursection="blursection" data-loader="account_add_loader">
    							    <option value="">Select Type</option>
    							    <?php
    							    foreach($company_payment_methods as $method_details){
    							    ?>
    							    <option value="<?= $method_details->unique_name;?>" ><?= $method_details->method_name;?></option>
    							    <?php } ?>
    							</select>
    							 
    						</div>
    						  <div id="add_account_sec">
    						      
    						  </div>
    						 
    						<button type="submit" name="add_btn" class="btn btn-primary">
    							Add Account
    						</button>
    					</form>
				        </div>
				</div>
				<div class="col-md-6 ">
    				<div class="card card-body table-responsive" >
    				    <?php
                            $this->load->view($admin_directory.'/pages/payment_section/my_accounts');
                        ?>
    				</div>
				</div>
		
    
    
</div>
