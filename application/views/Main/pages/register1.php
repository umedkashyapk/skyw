 <style>
       .login_register_page_detail{
         margin:50px 0px ;
     }       
    input.data_input {
        width: 100%;
        font-size: 16px;
        font-weight: 400;
        border: 1px solid #f1f1f1;
        padding: 10px 10px 10px 57px;
        border-radius: 40px;
       height: 50px;
    }
    input.data_input:focus{
        outline: none;
    }
    select#position {
    width: 100%;
    width: 100%;
    font-size: 16px;
    font-weight: 400;
    border: 1px solid #f1f1f1;
    padding: 10px 10px 10px 57px;
    border-radius: 40px;
    height: 50px;
}
select#position:focus{
      outline: none;
}
    p.label_input_detail {
       position: relative;
    }
    span.input_data_text {
        position: absolute;
        top: 0px;
        width: 50px;
        border-top-left-radius: 30px;
    font-size: 23px;
    border-bottom-left-radius: 30px;
        height: 50px;
        background:#9dca00;
        line-height: 50px;
        text-align: center;
     }
     .form_detail {
        max-width: 500px;
        margin: auto;
        border: 1px solid #d4d2d2;
        padding: 20px;
        border-radius: 4px;
     }

    .form_detail h4 {
        text-align: center;
        margin-bottom: 20px;
        text-align: center;
        text-transform: uppercase;
    }

    a.forget-pass.font_color {
        color: red;
    }

span.input_data_text i {
    color: #fff;
}
    .form_footer_detail {
      
        margin-top: 15px;
    }

    button.login_button_detail {
        width: 100%;
        padding: 12px 10px;
        color: #fff;
        background:#9dca00;
        border: none;
    }
    </style>


 
  
<div class="login_register_page_detail">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="form_detail">
                    <h4>Register page </h4>
                    <form class="login_form" action="<?= base_url('register');?>" method="post" enctype="multipart/form-data" >
                    <?php 
                     $requires=$this->conn->runQuery("*",'advanced_info',"title='Registration'");
                     $value_by_lebel= array_column($requires, 'value', 'label');
                     ?>
                    <?php if(array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required']=='yes'){ ?>
                     <p class="label_input_detail">
                         <span class="input_data_text"><i class="fa fa-user" aria-hidden="true"></i></span>
                         <input type="text" class="check_sponsor_exist data_input" id="u_sponsor" name="u_sponsor" placeholder="Sponsor ID" data-response="sponsor_res" value="<?php
                            if(isset($_REQUEST['ref'])){
                                echo $_REQUEST['ref'];
                            }else{
                                echo set_value('u_sponsor');
                            }
                        ?>" />
                            <small class=" " id="sponsor_res"><?php echo form_error('u_sponsor');?></small>
                     </p>
                     <?php
                    }
                     ?> <?php if(array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method']=='manual'){?>
                     <p class="label_input_detail">
                         <span class="input_data_text"><i class="fa fa-user" aria-hidden="true"></i></span>
                         <input type="text" class="check_username_exist no_space data_input" id="usename" name="usename" placeholder="Username" data-response="username_res" value="<?php echo set_value('usename');?>">                    
                         <span class=" " id="username_res"><?php echo form_error('usename');?></span>
                    </p>
                     <?php
                     }
                     ?>
                    <!-- <p class="label_input_detail">
                        <span class="input_data_text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input type="text" class="data_input check_placement_exist" autocomplete="none" id="Parentid" name="Parentid" placeholder="Placement id" data-response="placement_user_res" value="<?php
                            if(isset($_REQUEST['parent'])){
                                $parentid=$_REQUEST['parent'];
                                 echo $result1=$this->conn->runQuery('username','users',"id='$parentid'")[0]->username;
                            }else{
                                echo set_value('Parentid');
                            }
                        ?>" />
                        <span class=" "  id="placement_user_res"><?php echo form_error('Parentid');?></span>
                    </p>-->
                     <p class="label_input_detail">
                         <span class="input_data_text"><i class="fa fa-user" aria-hidden="true"></i></span>
                         <input autocomplete="off"  type="text" class="data_input" autocomplete="none" id="name" autocomplete="none" name="name" placeholder="Name" data-response="name_res" value="<?php echo set_value('name');?>">
                         <span class=" " id="name_res"><?php echo form_error('name');?></span>   
                      </p>
                      <?php if(array_key_exists('reg_type', $value_by_lebel) && $value_by_lebel['reg_type']=='binary'){?>
                        <p class="label_input_detail"> 
                        <span class="input_data_text"><i class="fa fa-user" aria-hidden="true"></i></span>
                      <select class="login_input_data" name="position" id="position">
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
                    </p>
                    <?php } ?>
                     <?php if(array_key_exists('country_code', $value_by_lebel) && $value_by_lebel['country_code']=='yes'){?>
                    <div class="login_input_data">                 
                        <select data-response="mobile_code" class="country data_input" name="country_code" id="country_code">
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
                    <?php if(array_key_exists('mobile_users', $value_by_lebel) && $value_by_lebel['mobile_users']>0){?>
                     <p class="label_input_detail">
                       <!--	<div class="input-group-prepend">
                        <span class="input-group-text mobile_code" id="basic-addon1">
                        <i class="fa fa-phone"></i>
                        </span>
                    </div>  -->
                        <span class="input_data_text "><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <input type="number" class="mobile no_space check_mobile_valid data_input" id="mobile" autocomplete="none" name="mobile" placeholder="mobile" data-response="mobile_res" value="<?= set_value('mobile');?>">
                            <span class=" " id="mobile_res"><?= form_error('mobile');?></span>
                    </p>
                    <?php
                     }
                    ?>
                    <?php if(array_key_exists('email_users', $value_by_lebel) && $value_by_lebel['email_users']>0){?>
                    <p class="label_input_detail">
                        <span class="input_data_text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input type="email" class="check_email_valid data_input" autocomplete="none" id="email" name="email" placeholder="Email" data-response="email_res" value="<?php echo set_value('email');?>" />
                        <span class=" " id="email_res"><?php echo form_error('email');?></span>
                    </p>
                    <?php
                    }
                    ?>
                    <?php if(array_key_exists('pass_gen_type', $value_by_lebel) && $value_by_lebel['pass_gen_type']=='manual'){ ?> 
                    <p class="label_input_detail">
                        <span class="input_data_text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                         <input type="password"  class="no_space data_input" id="password" name="password" placeholder="password" data-response="password_res" value="<?php echo set_value('password');?>" />
                             <span class="text-danger" id="password_res"><?php echo form_error('password');?></span>
                    </p>
                    <p class="label_input_detail">
                         <span class="input_data_text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input id="confirm_password" name="confirm_password" type="password" placeholder="Confirm Password" class="data_input" data-response="confirm_password_res" value="<?php echo set_value('confirm_password');?>" >
                         <span class="text-danger" id="confirm_password_res"><?php echo form_error('confirm_password');?></span>
                    </p>
                     
                    <?php
                    }
                    ?>
                     <span class="already_data">Already have an account?<a href="#" class="font_color"> Login</a></span>
                    <?php
                        if($this->session->has_userdata('user_login')){
                            ?>
                            
                         <?php
                      }else{
                     ?>    
                            
                     <div class="form_footer_detail">
                         <button type="submit" name="register" class="login_button_detail" >Register</button>
                     </div>
                    <?php
                      }
                    ?>
                     </form>
                </div>
            </div>
        </div>
    </div>
 
    
 </div>    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    