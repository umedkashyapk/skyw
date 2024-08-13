<style>

.card_profile_footer {
    display: flex;
    align-items: center;
}
.profile_card_bottom {
    display: flex;
    align-items: center;
}
</style>
<?php
$profile=$this->session->userdata("profile");
$user_id=$profile->id;
?>



    <div class="page_profile" id="all_margin_bottom_pages">
        <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">My Account /</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
         </ol>
	   </div>
	 
</div>
           <div class="row">
              <div class="col-lg-5 col-xl-4 col-md-12 col-sm-12">
                 <div class="card_profile">
                    <div class="card_profile_page">
                       <div class="user_pic_profile">
                       <?php  if($profile->img!=''){?>
                         <img src="<?=base_url('images/users/').$profile->img;?>" alt="images">
                        <?php }else{ ?>
                        <img src="<?= $this->conn->company_info('logo');?>" alt="images">
                        <?php } ?>
                       </div>
                       <h3 class="username mb-2"><?= $profile->username;?></h3>
                       <p class="mb-1 "><?= $profile->name;?>, <?= $profile->country;?></p>
                    </div>
                 </div>
                 
                 <div class="card_profile">
                 
                    <div class="card_profile_page">
                       <div class="profile_header">
                          <h4>edit password</h4>
                       </div>
                      
                       <form action="" method="post">
                       <div class="card_content_profile">
                          <div class="form-group profile"> 
                             <label class="form-label">Old Password</label> 
                             <input type="password" class="form-control" value="" name="old_password" Placeholder="old Password">
                             <span class="text-danger "><?php echo form_error('old_password');?></span> 
                          </div>

                          <div class="form-group profile"> 
                             <label class="form-label">New Password</label> 
                             <input type="password" class="form-control" name="password" value="" Placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"> 
                             <span class="text-danger "><?php echo form_error('password');?></span>
                          </div>
                          <div class="form-group profile"> 
                             <label class="form-label">Confirm Password</label> 
                             <input type="password" class="form-control" name="confirm_password" value="" Placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"> 
                             <span class="text-danger"><?php echo form_error('confirm_password');?></span>
                          </div>
                          <div class="card_profile_footer">
                             <button type="submit" name="password_btn">Updated</button>
                             <a href="<?= $panel_path.'profile/edit-profile';?>" class="cancel_data"> Cancel</a>
                          </div>
                       </div>
                        </form>
                    </div>
                 </div>
              </div>
              <div class="col-lg-7 col-xl-8 col-md-12 col-sm-12">
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
                    $profile_status=$profile->profile_edited;
                    if($profile_status==1){
                       $onetime_edit='readonly'; 
                    }
                    ?>
                 <div class="card_profile">
                    <div class="profile_header">
                       <h4>Edit Profile</h4>
                    </div>
                    <form action="" method="post" enctype='multipart/form-data'>
                    <div class="cardproflie_form">
                       <div class="row">
                          <div class="col-lg-6 col-md-12">
                             <div class="form-group profile"> 
                                <label for="exampleInputname">User ID</label> 
                                <input type="text" class="form-control" id="exampleInputname" placeholder="" value="<?= $profile->username;?>" readonly> 
                             </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                             <div class="form-group profile"> 
                                <label for="exampleInputname">Name</label> 
                                <input type="text" class="form-control" id="exampleInputname" placeholder="Name" name="name" value="<?= $profile->name;?>" <?= $onetime_edit;?>> 
                             </div>
                          </div>
                       </div>
                      <div class="form-group profile"> 
                          <label for="exampleInputEmail1">Profile Pic</label> <input type="file" name="profile_pic"  class="form-control" id="exampleInputEmail1" placeholder="Email Address"> 
                        <span  class="text-danger"><?= (isset($upload_error) ? $upload_error:'');?></span>
                       </div>
                       <div class="form-group profile"> 
                          <label for="exampleInputEmail1">Email Address</label> <input type="email" name="email" value="<?= $profile->email;?>" class="form-control" id="exampleInputEmail1" placeholder="Email Address" readonly> 
                       </div>
                       <div class="form-group profile"> 
                          <label for="exampleInputEmail1">Contact Number</label> <input type="number" name="mobile" value="<?= $profile->mobile;?>" class="form-control" id="exampleInputEmail1" placeholder="Contact Number" <?= $onetime_edit;?>> 
                       </div>
                    </div>
                   
                    
                    
                     <?php
                if($profile_edited!='readonly'){
                    $edit_profile_with_otp=$this->conn->setting('edit_profile_with_otp');
                    if($edit_profile_with_otp=='yes'){
                      $display=(isset($_SESSION['otp']) ? 'block':'none');
                      ?>
                      <button type="button" data-response_area="action_areap" class="user_btn_button send_otp" >Send OTP</button>
                      
                      <div id="action_areap" style="display:<?= $display;?>">
                           <!--<p> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>-->
                           <!-- <button type="button" data-response_area="action_areap" id="proceed" class="user_btn_button send_otp" >Re-Send OTP</button>-->
                                       
                        <div class="form-group">
                          <label for="">Enter OTP </label>
                          <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1');?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input1');?></span> 
                        </div> 
                        <div class="profile_card_bottom">
                            <button type="submit" name="edit_btn">Save</button>
                            <a href="<?= $panel_path.'profile/edit-profile';?>" class="cancel_data"> Cancel</a>
                        </div>
                      </div>
                      <?php
                    }else{
                      ?>
                    <div class="profile_card_bottom">
                        <button type="submit" name="edit_btn">Save</button>
                        <a href="<?= $panel_path.'profile/edit-profile';?>" class="cancel_data"> Cancel</a>
                    </div>
                      <?php
                    } 
              }
              
                
                ?>
                 </div>
                </form>
              </div>
           </div>
        </div>
     </div>

     <br>