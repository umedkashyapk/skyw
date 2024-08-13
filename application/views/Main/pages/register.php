
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
p {
  color: red !important;
}
.error-massage-id{
    color:red;
}
 label.form_check_label {
    color: #fff;
}
.account_wrapper_form {
    margin: 40px 0px 40px 0px;
    background:#3a383869;
    padding: 20px;
    border-radius: 4px;
}
section.header_top {
    background: #000 !important;
}
h4.account_title {
    text-align: center;
   -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg,#462523 0,#cb9b51 22%,#ffa419 45%,#c58625 50%,#ffa419 55%,#cb9b51 78%,#462523);
    color: transparent;
    font-family: Times New Roman,serif;
    font-size: 30px;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 25px;
    text-align: center;
    text-transform: uppercase;
}

h6.account_subtitle {
    text-align: center;
    color: #fff;
}

.group_input input {
    width: 100%;
    padding: 10px;
    border: 1px solid #fda41b6b;
    border-radius: 10px;
    margin-bottom: 10px;
    color: #ffffffe3;
}
label.form_label {
    color: #fff;
    margin-bottom: 4px;
}

label.form-label {
    color: #fff;
}

a.text_base {
    color: #d4ae47;
}
option{
    color:#000 !important;
}
select#country_code {
    padding: 10px;
    border-radius: 10px;
    width: 100%;
    margin-bottom: 10px;
    background: none;
    color: #fff;
    outline: none;
    border: 1px solid #fda41b6b;
}
.m--5px {
    color: #b5b5b5;
    margin-bottom: 10px;
    font-size: 14px;
}
.group_input input {
    background: none;
    outline:none;
}
a.text_sign.ms-2 {
    color: #d4ae47;
}

button.cmn_btn.btn-remove {
  background: #ffa419;
    padding: 8px 24px;
    border: none;
    border-radius: 4px;
    color: #fff;
}
label.form_check_label {
    color: #fff;
    FONT-SIZE: 13PX;
    margin: 0px;
}
.form_check_data {
    DISPLAY: flex;
    ALIGN-ITEMS: center;
    GAP: 6px;
    margin-bottom: 7px;
}

input#rememberme {
    height: 12px;
    width: 10px;
}

@media screen and (max-width:768px){
    h4.account_title{
      font-size: 24px;
    }
}

.eye-icon {
    position: absolute;
    right: 10px;
    top: 43%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #ffa419;
}
</style>
<section class="account_section_form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2"></div>
             
                <div class="col-md-8">
                    <div class="account_wrapper_form">
                        <h4 class="account_title">Register Form</h4>
                    
                       <form action="<?= base_url('register');?>" method="post" enctype="multipart/form-data">
                       <?php 
                             $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
                             $value_by_lebel= array_column($requires, 'value', 'label');
                            ?>
                            
                            <div class="account_inner_detail">
                                <?php if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){ ?>
                                <div class="input_group">
                                    <label for="username" class="form_label">Sponsor ID</label>
                                    <div class="group_input">
                                       <input name="u_sponsor" type="user" id='u_sponsor' class="check_sponsor_exist" placeholder="Sponsor ID" data-response="sponsor_res" value="<?php
                                       if(isset($_REQUEST['ref'])){
							    $refff=$_REQUEST['ref'];
							    $top_id=$this->conn->runQuery('username,name','users',"username='$refff'");
							    echo $top_id[0]->username;
							     $name=$top_id[0]->name;
						    
						    $this->session->set_userdata('refer_name',$name);
							}elseif(set_value('u_sponsor')!=""){
							    
							     echo set_value('u_sponsor');
							}else{
							    $top_id=$this->conn->runQuery('username,name','users',"1=1");
							     $top_id[0]->username;
							}
							
                    												
                    	?>" 
                         aria-label="User">
                                    </div>
                                    
                                     <?php	
                			if(isset($_REQUEST['ref'])){
                			    ?>
                			    
                			 <div class="" style="color:green">
                                    Verification<i class="fa fa-check" style="font-size:18px"></i>
                                </div>    
                		
                			<?php
                			}else{
                			?>
                		
                			<div class="error-massage-id"  id="sponsor_res">
                                     <?php echo form_error('u_sponsor');?>
                                </div> 
                			<?php
                			}
                			?>      
                                </div>
                                       
                            <?php
                               }
                            ?>
                            
                            
                            
                             <?php if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){?> 
                               <div class="input_group">
                                    <label for="username" class="form_label">Name</label>
                                    <div class="group_input">
                                    <input name="usename" id="usename" type="text" class="form-control" autocomplete="off" placeholder="Enter  Username" data-response="username_res" value="<?php echo set_value('usename');?>">
                                  </div>
                                </div>
                                <div class="error-massage-id"  id="username_res">
                                    <?php echo form_error('usename');?>
                                </div> 
                            <?php
                                }
                            ?> 
                                <div class="input_group">
                                    <label for="username" class="form_label">Name</label>
                                    <div class="group_input">
                                        <input autocomplete="off"  type="text" class="" autocomplete="none" id="name" autocomplete="none" name="name" placeholder="Name" data-response="name_res" value="<?php echo set_value('name');?>">
                             
                                    </div>
                                     <div class="error-massage-id"  id="name_res">
                                          <?php echo form_error('name');?>
                                    </div>
                            
                                </div>
                                
                                  <?php if(array_key_exists('email_users', $value_by_lebel) && $value_by_lebel['email_users']>0){?>
                                <div class="input_group">
                                    <label for="username" class="form_label">E-mail I'd</label>
                                    <div class="group_input">
                                       <input name="email" id="email" type="email" class="check_email_valid" autocomplete="off" placeholder="E-mail I'd" data-response="email_res" value="<?= set_value('email');?>">
                                
                                    </div>
                                    <div class="error-massage-id"  id="email_res">
                                  <?php echo form_error('email');?>
                                 </div>
                                </div>
                                  <?php
                                   }
                                ?>
                                 <?php if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){?>
                            <div class="input_group ">
                                 <label for="username" class="form_label">Country</label>
                                <select id="country_code" data-response="mobile_code" class="select_data country" name="country_code">
                                    <option value="">Select Country</option>
                                        <?php
                                        $countries=$this->conn->runQuery('*','countries','1=1');
                                        if($countries){
                                            foreach($countries as $country){
                                                ?> <option data-sortname="<?= $country->sortname;?>" data-phonecode="<?= $country->phonecode;?>" value="<?= $country->name;?>"  ><?= $country->name;?>(+<?= $country->phonecode;?>)</option><?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                        <?php } ?>
                                
                              <?php if(array_key_exists('mobile_users', $value_by_lebel) && $value_by_lebel['mobile_users']>0){?>
                                <div class="input_group">
                                    <!--	<div class="input-group-prepend">
                                        <span class="input-group-text mobile_code" id="basic-addon1">
                                        <i class="fa fa-phone"></i>
                                        </span>
                                    </div>  -->
                                    <label for="username" class="form_label">Mobile no.</label>
                                    <div class="group_input">
                                       <input name="mobile" id="mobile" type="number" class="no_space check_mobile_valid" autocomplete="off" placeholder=" Mobile no." data-response="mobile_res" value="<?= set_value('mobile');?>">
                            
                                    </div>
                                </div>
                                <?php
                                  }
                                ?>
                             
                             
                        
                        
                       
						<!--	<div class="form-group">
                                <select  class="select_data" name="state" id="state"  onchange="change_state();" required>
            					<option value="">Select State*</option>
            					<?php  $states=$this->conn->runQuery("*",'state',"status='Active'");
            						if($states){
            						foreach($states as $states1){
            						?>					
            						<option value="<?= $states1->state_id;?>"><?= $states1->state_title;?></option>
            						<?php }
            						}
            					 	?>
            				</select>
                           </div>
					-->
						
						
				
						<!--<div class="form-group">
                            <select class="select_data" name="district" id="district" required>
        					<option value="">Select District*</option>
        					<?php  $district=$this->conn->runQuery("*",'district',"district_status='Active'");
        						if($district){
        						foreach($district as $district1){
        						?>					
        						<option value="<?= $district1->districtid;?>"><?= $district1->district_title;?></option>
        						<?php }
        						}
        					 	?>
        				</select>
                  
                           	</div>-->    
                                
                                
                                 <?php if(array_key_exists('reg_type', $value_by_lebel) && $value_by_lebel['reg_type']=='binary'){?>
                            <div class="form-group ">
                                <select id="position" class="select_data" name="position">
                                    <option value="">Select Position</option>
                                    <?php
                                        if(isset($_REQUEST['position'])){
                                            $position=$_REQUEST['position'];
                                            if($position==1){
                                        ?>
                                        
                                        <option value="1"  <?php if($position==1){ echo "selected";}?>>Left</option>
                                        
                                        <?php }else{  ?>
                                        <option value="2" <?php if($position==2){ echo "selected";}?>>Right</option>
                                        
                                            
                                        <?php   
                                        }
                                         }else{
                                       ?>
                                       <option value="1"  >Left</option>
                                     <option value="2" >Right</option>
                                       
                                       <?php     
                                        }
                                    ?>
                                    
                                </select>
                        </div>
                        <?php
                            }
                        ?>

                                 <?php if(array_key_exists('pass_gen_type', $value_by_lebel) && $value_by_lebel['pass_gen_type']=='manual'){ ?>  
                                <div class="input_group">
                                    <label for="username" class="form_label">Password</label>
                                    <div class="group_input" style="position:relative;">
                                    
                                        <input name="password" type="password" id="password1" class="no_space" autocomplete="off" placeholder="Password" data-response="password_res" value="<?php echo set_value('password');?>" >

                                      <span id="togglePassword1" class="fa fa-eye eye-icon" onclick="togglePasswordVisibility('password1' , 'togglePassword1')"></span>
                                    </div>
                                     <div class="error-massage-id"  id="password_res">
                                <?php echo form_error('password');?>
                             </div>
                                </div>
                                 
                                <div class="input_group">
                                    <label for="username" class="form_label">Confirm Password</label>
                                    <div class="group_input" style="position:relative;">

                                        <input name="confirm_password" type="password"id="password2" class="no_space" autocomplete="off" placeholder="Confirm password" data-response="confirm_password_res" value="<?php echo set_value('password');?>" >


                                   <span id="togglePassword2" class="fa fa-eye eye-icon" onclick="togglePasswordVisibility('password2','togglePassword2')"></span>
                                    </div>
                                     <div class="error-massage-id"  id="confirm_password_res">
                                <?php echo form_error('confirm_password');?>
                             </div>
                                </div>
                                <?php
                                   }
                                ?>
                                
                               <div class="checkbox ">
                            <div class="form_check_data">
                                <input class="form_check_input" type="checkbox" id="rememberme">
                                <label class="form_check_label" for="rememberme">
                                    I agree to the terms of service
                                </label>
                            </div>
                            
                        </div>
                            </div>
                        
                        <div class="d-flex flex-wrap justify-content-between align-items-center m--5px-none fs-14">
                            <div class="m--5px">
                            Already have an account?  <a href="<?= base_url();?>login" class="text_sign ms-2">Sign In</a>
                            </div>
                            <div class="btn_group m-0">
                                <button type="submit" name="register" class="cmn_btn btn-remove">Sign Up</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                  <div class="col-md-2"></div>
            </div>
        </div>
    </section>


    <script>
function togglePasswordVisibility(input,icon) {
    var passwordInput = document.getElementById(input);
    var togglePassword = document.getElementById(icon);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePassword.classList.remove("fa-eye");
        togglePassword.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        togglePassword.classList.remove("fa-eye-slash");
        togglePassword.classList.add("fa-eye");
    }
}



        </script>

 