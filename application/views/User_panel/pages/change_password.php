<?php
$user_id=$this->session->userdata('user_id');
$profile=$this->profile->profile_info($user_id);
?>
<div class="user_content">
        <div class="container pages">
            <div class="row">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home /</a></li>
            <li class="breadcrumb-item"><a href="<?= $panel_path.'profile';?>">Profile /</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Transaction Password</li>
         </ol>
	   </div>
	    
</div>

            <div class="user_main_card mb-3">
           
                <div class="user_card_body user_content_page">
                    <div class="card_body_header_content">
                     <h3 class="user_card_title">Change Login Password</h3>
                    </div>
                     <form id="" action="" method="post">
                    
                     <div class="user_form_row user_form_content">
                         <div class="row">
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
                         <div class="col-lg-12 mb-3">
                           <label class="label_user_title">Current Password</label>
                               <div class="input-group ">
                                <input name="old_password" type="old_password"  id="old_password" class="form-control user_input_text" placeholder="Old Password">
                                
                               </div>
                         <span class="text-danger "><?php echo form_error('old_password');?></span>
                         </div>
                         <div class="col-lg-12 mb-3 ">
                           <label class="label_user_title">New Password</label>
                               <div class="input-group ">
                                <input name="password" type="password" id="password" class="form-control user_input_text" placeholder="New Password">
                                    
                               </div>
                               <span class="text-danger "><?php echo form_error('password');?></span>
                         </div>
                         <div class="col-lg-12 mb-3">
                           <label class="label_user_title">Confirm Password</label>
                               <div class="input-group ">
                                   <input name="confirm_password" type="password"  id="confirm_password" class="form-control user_input_text" placeholder="Confirm Password">
                                    
                               </div>
                               <span class="text-danger"><?php echo form_error('confirm_password');?></span>
                         </div>
                        
                         
                         
                     </div>
                     
               </div>
                <div class="user_form_row_data user_form_content ">
                    <div class="user_submit_button mb-2">
                        <input type="submit" name="password_btn" value="Change Password" id="" class="user_btn_button">
                    </div>
                    
                </div>
                </form>
           </div>
        </div>



    </div>
</div>