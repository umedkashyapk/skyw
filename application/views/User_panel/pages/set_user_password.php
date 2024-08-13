<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $panel_path.'profile';?>">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Set Transaction Password</li>
         </ol>
	   </div>
	    
</div>


<?php 

$user_id=$this->session->userdata('user_id');

 $profile=$this->profile->profile_info($user_id);
 
 
 
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



<!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <form id="" action="" method="post">
                <h6 class=" text-uppercase">
                  <!--<i class="fa fa-lock-circle-o"></i>-->
                  Set Transaction password
                </h6>
                <div class="form-group row">
                  <label for="input-1" class="col-sm-2 col-form-label">Enter Transaction Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="tx_password"  value="<?php echo set_value('tx_password');?>" class="form-control" placeholder="Set Transaction  Password" aria-describedby="helpId"  >  
                <span class="text-danger"><?php echo form_error('tx_password');?></span>
                  </div>
                </div>
                 <div class="form-group row">
                  <label for="input-1" class="col-sm-2 col-form-label">Enter Confirm Transaction Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="confirm_password"  value="<?php echo set_value('confirm_password');?>" class="form-control" placeholder="Enter Confirm Transaction Password" aria-describedby="helpId"  >  
                <span class="text-danger"><?php echo form_error('confirm_password');?></span>
                  </div>
                </div>
                <!-- <button type="button" data-response_area="action_area" class="btn btn-primary send_otp" >Send OTP</button>
                      
                      <div id="action_area" style="display:<?= $display;?>"> 
                      -->
            <!-- <div class="form-group row">
                <div class="col-12">
			<label for="input-1" class="col-lg-2 col-form-label">Enter OTP</label>
			 <div class="col-lg-10">
			<input type="text" name="otp_input" id="otp_input" value="<?= set_value('otp_input');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
			<span class="text-danger "><?= form_error('otp_input');?></span>
			
			</div>
			</div>
			</div>-->
		<!--	<div class="form-group row">
                  <label for="input-1" class="col-sm-2 col-form-label">Enter OTP</label>
                  <div class="col-sm-10">
                    <input type="text" name="otp_input" id="otp_input" value="<?php echo set_value('otp_input');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId"  >  
                <span class="text-danger"><?php echo form_error('otp_input');?></span>
                  </div>
                </div>-->
			
               <div class="">
                    
                    <button type="submit"  name="set_password_btn" class="btn btne"><i class="fa fa-check-square-o"></i> Save</button>
                </div>
            
              
              
              </form>
              
			 
            </div>
          </div>
        </div>
      </div><!--End Row-->

</div>
