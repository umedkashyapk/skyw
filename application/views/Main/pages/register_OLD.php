<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
.form_inner_content {
    max-width: 570px;
    width: 100%;
    margin: 20px auto;
    text-align: center;
    padding: 42px 55px;
    background: #fff;
    position: relative;
    z-index: 0;
    box-shadow: 0 0 35px rgb(0 0 0 / 10%);
}


.form_inner_content h3 {
    margin: 0;
    padding-bottom: 15px;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: .8px;
}

input.form-control {
    height: 42px;
    border-radius: 40px;
}


.form-group i {
    position: absolute;
    top: 43%;
    right: 9px;
}
.checkbox.form-group {
    display: flex;
    justify-content: space-between;
}

.form_check_data {
    display: flex;
    align-items: center;
}

input.form_check_input {
    width: 20px;
    height: 20px;
    vertical-align: top;
    border: 2px solid #c5c3c3;
    border-radius: 0;
    margin-right: 7px;
}

label.form_check_label {
    margin-bottom: 0;
}

button.submit_login {
    position: relative;
    display: inline-block;
    width: 100%;
    color: #fff;
    overflow: hidden;
    text-transform: capitalize;
    display: inline-block;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 17px;
    font-weight: 400;
    border-radius: 40px;
    border: none;
    padding: 10px;
    background:#010f2e;
}
button.submit_login:focus{
    outline:none;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: none;
    outline: 0;
    box-shadow: none;
}

 .form-group{
     margin-bottom:10px !important;
 }
 .error-massage-id{
     text-align: initial;
   
 }

select.select_data {
    width: 100% !important;
    font-size: 14px !important;
    font-weight: 400 !important;
    border-radius: 40px !important; 
    border: 1px solid #d3d0d0 !important;
    padding: 5px 10px  !important;
   height:42px !important;
   
}
.error-massage-id p {
    font-size: 13px;
    text-align: initial;
    color: red;
}

.error-massage-id{
    margin-bottom:10px;
}

.nice-select.select_data.country {
    border-radius: 40px;
    height: 40px;
    line-height: 40px;
    margin-bottom: 10px;
}

ul.list {
    height: 200px !important;
    overflow-y: scroll !important;
}
</style>

<div class="form_section_detail">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
              <div class="form_inner_content">
                  <h3>Registration </h3>
                      <form action="<?= base_url('register');?>" method="post" enctype="multipart/form-data">
                        
                            <?php 
                             $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
                             $value_by_lebel= array_column($requires, 'value', 'label');
                            ?>
                            <?php if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){ ?>
                                <div class="form-group ">
                                    <input name="u_sponsor" type="user" id='u_sponsor' class="form-control check_sponsor_exist" placeholder="Sponsor ID" data-response="sponsor_res" value="<?php
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
                			    
                			 <div class="error-massage-id">
                                    <?= $this->session->userdata('refer_name');?>
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
                                
                                
                            <?php
                               }
                            ?>
                            
                            
                            <?php if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){?> 
                                <div class="form-group ">
                                    <input name="usename" id="usename" type="text" class="form-control" autocomplete="off" placeholder="Enter  Username" data-response="username_res" value="<?php echo set_value('usename');?>">
                                 
                                </div>
                                <div class="error-massage-id"  id="username_res">
                                    <?php echo form_error('usename');?>
                                </div> 
                            <?php
                                }
                            ?> 
                             
                            <div class="form-group ">
                                 <input autocomplete="off"  type="text" class="form-control" autocomplete="none" id="name" autocomplete="none" name="name" placeholder="Name" data-response="name_res" value="<?php echo set_value('name');?>">
                             
                            </div>
                            <div class="error-massage-id"  id="name_res">
                                  <?php echo form_error('name');?>
                            </div>
                            
                        
                        <?php if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){?>
                            <div class="form-group ">
                                <select id="country_code" data-response="mobile_code" class="select_data country" name="country_code">
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
                        <?php } ?>
                        
                        
                       
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
                           
                        <?php if(array_key_exists('mobile_users', $value_by_lebel) && $value_by_lebel['mobile_users']>0){?>
                            <div class="form-group ">
                                <input name="mobile" id="mobile" type="number" class="form-control no_space check_mobile_valid" autocomplete="off" placeholder=" Mobile" data-response="mobile_res" value="<?= set_value('mobile');?>">
                            
                            </div>
                            <div class="error-massage-id"  id="mobile_res">
                                  <?php echo form_error('mobile');?>
                            </div>
                        <?php
                          }
                        ?>
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

                        
                        <?php if(array_key_exists('email_users', $value_by_lebel) && $value_by_lebel['email_users']>0){?>
                            <div class="form-group ">
                                <input name="email" id="email" type="email" class="form-control check_email_valid" autocomplete="off" placeholder="Email" data-response="email_res" value="<?= set_value('email');?>">
                                
                            </div>
                            <div class="error-massage-id"  id="email_res">
                                  <?php echo form_error('email');?>
                            </div>
                        <?php
                           }
                        ?>
                        
                        
                        <?php if(array_key_exists('pass_gen_type', $value_by_lebel) && $value_by_lebel['pass_gen_type']=='manual'){ ?>    
                            <div class="form-group ">
                                    <input name="password" type="password" id="password" class="form-control no_space" autocomplete="off" placeholder="Password" data-response="password_res" value="<?php echo set_value('password');?>" >
                                    
                            </div>
                             <div class="error-massage-id"  id="password_res">
                                <?php echo form_error('password');?>
                             </div>
                             
                            
                            
                            
                            <div class="form-group ">
                                <input name="confirm_password" type="password" id="confirm_password" class="form-control no_space" autocomplete="off" placeholder="Confirm password" data-response="confirm_password_res" value="<?php echo set_value('password');?>" >
                               
                            </div>
                             <div class="error-massage-id"  id="confirm_password_res">
                                <?php echo form_error('confirm_password');?>
                             </div>
                        <?php
                            }
                        ?> 
    
                       <!-- <div class="checkbox form-group ">
                            <div class="form_check_data">
                                <input class="form_check_input" type="checkbox" id="rememberme">
                                <label class="form_check_label" for="rememberme">
                                    I agree to the terms of service
                                </label>
                            </div>
                            
                        </div>-->
                        <div class="form-group">
                            <button type="submit" class="submit_login btn-remove" name="register">Register</button>
                        </div>
                       
                    </form>
              </div>
          </div>
      </div>
    </div>
</div>

 <script>
   ( function($) {
  $(".btn-remove").click(function() {  
    $(this).css("display", "none");      
  });
} ) ( jQuery );



function change_state()
{
 var categorey = $("#state").val();
 //alert(categorey );
    $.ajax({
      type: "POST",
      url: "<?= base_url('register/find_district');?>",
      data: "pin_type="+categorey,
      cache: false,
      success: function(response)
       {
        //alert(response);//return false;
        $("#district").html(response);
       }
   });
 
}

  
	
            
        
    </script>