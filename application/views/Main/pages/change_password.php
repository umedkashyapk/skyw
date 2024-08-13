<br>
 <?php

if(!isset($_SESSION['forgot_user'])){
    
    redirect(base_url('forgot'),"refresh");
    die();
}

if($_SESSION['forgot_otp_verified']!==true){
    
    redirect(base_url('verify'),"refresh");
    die();
}

 if(isset($_POST['change_btn'])){
    
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[password]');
    $update['password'] = md5($_POST['password']);
    if($this->form_validation->run() != False){
        
        $this->db->where('id',$_SESSION['forgot_user']);
        $this->db->update('users',$update);

        unset($_SESSION['forgot_otp']);
        unset($_SESSION['forgot_user']);
        unset($_SESSION['forgot_otp_verified']);

        $this->session->set_flashdata('success'," Password successfully Changed.");
        redirect(base_url('forgot'),"refresh");
        
    }

 }

 ?>
<section class="account_section_form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-7">
                    
                    <div class="account_wrapper_form">
                        <h4 class="account_title">Change Password</h4>
                      
                         <form action="" method="post">
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
                            <div class="account_inner_detail">
                                <div class="input_group">
                                    <label for="username" class="form_label">Password</label>
                                    <div class="group_input">
                                         <input type="password" class=" no_space" id="password" name="password" placeholder="password" data-response="password_res" value="<?php echo set_value('password');?>" />
                                             <span class="text-danger" id="password_res"><?php echo form_error('password');?></span>

                                    </div>
                                </div>
                               <div class="input_group">
                                    <label for="username" class="form_label">Confirm password</label>
                                    <div class="group_input">
                                            <input type="password" class="no_space" id="confirm_password" name="confirm_password" placeholder="Confirm password" data-response="confirm_password_res" value="<?php echo set_value('confirm_password');?>" />
                                            <span class="text-danger" id="confirm_password_res"><?php echo form_error('confirm_password');?></span>


                                    </div>
                                </div>
                               
                               
                              
                                </div>
                       
                        <div class="d-flex flex-wrap justify-content-between align-items-center m--5px-none mt-3 fs-14">
                            <div class="m--5px">
                                Don't have any account? <a href="<?= base_url('register');?>"
                                    class="text_sign ms-2">Sign
                                    Up</a>
                            </div>
                            <div class="btn_group m-0">
                                <button type="submit"  name="change_btn" class="cmn_btn">Change Password</button>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
  
        