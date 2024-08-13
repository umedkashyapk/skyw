 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Add Member</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Add</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Add Member</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Add Member</h6>
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
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6">
    <div class="card card-body">
        <form action="" method="post" >
                        <?php 
                        $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
                        $value_by_lebel= array_column($requires, 'value', 'label');
                        
                        
                        ?>
						
							<!-- Input Field Starts -->
							<?php if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){ ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								<input type="text" class="form-control check_sponsor_exist no_space" id="u_sponsor" name="u_sponsor" placeholder="Sponsor ID" data-response="sponsor_res" value="<?php
                                                   //echo $profile->username;
                                                ?>" />
                                                    <small class=" " id="sponsor_res"><?php echo form_error('u_sponsor');?></small>
							</div>
							</div>
							
							 <?php } ?>
                                            
                                            <?php if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){?>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								 <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <?= (array_key_exists('user_gen_prefix', $value_by_lebel) && $value_by_lebel['user_gen_prefix']!='' ? $value_by_lebel['user_gen_prefix']:'<i class="fa fa-user"></i>');?>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control check_username_exist no_space" id="usename" name="usename" placeholder="Username" data-response="username_res" value="<?php echo set_value('usename');?>">                    
                                                    
                                                </div>
                                                <span class=" " id="username_res"><?php echo form_error('usename');?></span>
							</div>
							</div>
							<?php }?>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								<input type="text" class="form-control " id="name" name="name" placeholder="Name" data-response="name_res" value="<?php echo set_value('name');?>">
                                                <span class=" " id="name_res"><?php echo form_error('name');?></span> 
							</div>
							</div>
							<?php if(array_key_exists('reg_type', $value_by_lebel) && $value_by_lebel['reg_type']=='binary'){?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								 <select  class="form-control" name="position" id="position" required>
                                                <option value="">Select Position</option>
                                                <option value="1"  >Left</option>
                                                <option value="2" >Right</option>
                                                
                                                </select>
							</div>
							</div>
							
							<?php } ?>  
                                            
                                            <?php if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								 <select data-response="mobile_code" class="form-control country" name="country_code" id="country_code">
                                                <option value="">Select Country</option>
                                                <?php
                                                $countries=$this->conn->runQuery('*','countries','1=1');
                                                if($countries){
                                                    foreach($countries as $country){
                                                        ?> <option data-sortname="<?= $country->sortname;?>" data-phonecode="<?= $country->phonecode;?>" value="<?= $country->name;?>"  ><?= $country->name;?></option><?php
                                                    }
                                                }
                                                ?>
                                                </select>
							</div>
							</div>
							
							<?php } ?>
                                            
                                            <?php if(array_key_exists('mobile_users', $value_by_lebel) && $value_by_lebel['mobile_users']>0){?>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								
                                                <input type="number" class="form-control mobile no_space check_mobile_valid" id="mobile" name="mobile" placeholder="mobile" data-response="mobile_res" value="<?= set_value('mobile');?>">
                                            
                                                <span class=" " id="mobile_res"><?= form_error('mobile');?></span>
							</div>
							</div>
							 <?php }?>
                                            <?php if(array_key_exists('email_users', $value_by_lebel) && $value_by_lebel['email_users']>0){ ?>
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								<input type="email" class="form-control  check_email_valid" id="email" name="email" placeholder="Email" data-response="email_res" value="<?php echo set_value('email');?>" />
                                 <span class=" " id="email_res"><?php echo form_error('email');?></span>
							</div>
							</div>
							 <?php } ?>
                           
                            <?php if(array_key_exists('tx_pass_gen_type', $value_by_lebel) && $value_by_lebel['tx_pass_gen_type']=='manual'){ ?>
                             <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                             <div class="form-group">
                            <input type="password" class="form-control" id="tx_password" name="tx_password" placeholder="Transaction password" value="<?php echo set_value('tx_password');?>" />
                            <span class="text-danger" ><?php echo form_error('tx_password');?></span>
                            </div>
                             </div>
                              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <input type="password" class="form-control no_space" id="tx_confirm_password" name="tx_confirm_password" placeholder="Confirm Transaction password" data-response="tx_confirm_password_res" value="<?php echo set_value('tx_confirm_password');?>" />
                              	<span class="text-danger " id="tx_confirm_password_res"><?php echo form_error('tx_confirm_password');?></span>
                            </div>
                             </div>
                            <?php
                            }
                            ?>                   
                                        
                            <?php if(array_key_exists('pass_gen_type', $value_by_lebel) && $value_by_lebel['pass_gen_type']=='manual'){ ?>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								 <input type="password" class="form-control no_space" id="password" name="password" placeholder="password" data-response="password_res" value="<?php echo set_value('password');?>" />
                                <span class="text-danger " id="password_res"><?php echo form_error('password');?></span>
							</div>
							</div>
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
								<input type="password" class="form-control no_space" id="confirm_password" name="confirm_password" placeholder="Confirm password" data-response="confirm_password_res" value="<?php echo set_value('confirm_password');?>" />
                                <span class="text-danger " id="confirm_password_res"><?php echo form_error('confirm_password');?></span>
							</div>
							</div>
							
						
							<div class="col-lg-12 col-md-12 col-sm-12 col-12"  >		
					    
                          <button class="btn btn-warning btn-block" type="submit" name="register">Register</button>
                       </div>
					<!--	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						   <div class="form-group">
							<input type="checkbox" class="checkbox-box" required>
							<span class="text-white">&nbsp;&nbsp;I agree to the<a href="<?= $panel_path.'invest/terms';?>"><lable class="text-white">&nbsp;terms & conditions</lable> </a></span>
							</div>	</div>	-->
								
							<?php } ?>
							<!-- Input Field Ends -->
							<!-- Submit Form Button Starts -->
							<!--<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="form-group">
								<button class="btn btn-danger btn-block" type="submit" name="register">Register</button>
							
							</div>
							</div>-->
							<!-- Submit Form Button Ends -->
						</form>
    </div>
    </div>
</div>
