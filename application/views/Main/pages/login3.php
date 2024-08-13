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
        color: #9dca00;
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

 <!-- login-page -->
   <!-- <div class="login-page-section">
        <div class="row">
            
            <div class="col-12">
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
    
                            //echo form_open('login', 'class="login_form"');
    
                                
                    
                        ?>
            <div id="log-in">
                  
                       
                        <h4 class="login_heading">Login</h4>
                        
                        <div class="login_input_data">
                            <input type="text"  class=""  placeholder="Username" id="username" autocomplete="none" name="username" value="<?php echo set_value('username')?>">
                            <span class="text-danger"><?php echo form_error('username');?></span>
                        </div>
                        <div class="login_input_data">
                             <input type="password" class="" placeholder="Password" id="password" name="password" value="<?php echo set_value('password')?>">
                            <span class="text-danger"><?php echo form_error('password');?></span>
                        </div>

                        <button class="log_in_button" type="submit" name="login">Log in</button>
                         <a class="create_account_link" href="<?= base_url('forgot');?>">Forgot Password?</a>
                       
                        <p class="login_data_link">Don't have an account?<a class="create_account_link_register" href="<?= base_url('register');?>"> Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>-->
    
<div class="login_register_page_detail">
   <div class="container">
       <div class="row">
           <div class="col-12">
               <div class="form_detail">
                   <h4>login</h4>
                   <form action="" method="post">
                    <p class="label_input_detail">
                         <span class="input_data_text"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id="user" type="text" name="username"  placeholder="Username" class="data_input" value="<?php echo set_value('username')?>">
                        <span class="text-danger"><?php echo form_error('username');?></span>
                    </p>
                    <p class="label_input_detail">
                        <span class="input_data_text"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input id="password" name="password" type="password" placeholder="Password" class="data_input" value="<?php echo set_value('password')?>">
                         <span class="text-danger"><?php echo form_error('password');?></span>
                    </p>
                    <p><a href="<?= base_url('forgot');?>" class="forget-pass font_color"> Forgot your password?</a></p>
                    <div class="form_footer_detail">
                        <button type="submit" name="login" class="login_button_detail" >Login</button>
                    </div>
                    </form>
               </div>
           </div>
       </div>
   </div>


</div>    
    
    
    
    
    
    