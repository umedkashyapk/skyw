<style>
p {
    
    color: red !important;
}
.error-massage-id{
    color:red;
}
.group_input input {
    background: none;
    outline:none;
}
.account_wrapper_form {
    margin: 40px 0px 40px 0px;
    background:#3a383869;
    padding: 20px;
    border-radius: 4px;
}
.m--5px {
    margin-top:5px;
    color: #b5b5b5;
    margin-bottom: 10px;
    font-size: 14px;
}
section.header_top {
    background: #000 !important;
}
h4.account_title {
    text-align: center;
  
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg,#462523 0,#cb9b51 22%,#ffa419 45%,#c58625 50%,#ffa419 55%,#cb9b51 78%,#462523);
    color: var(--colorPrimary);
    color: transparent;
    font-family: Abril Fatface,cursive;
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


a.text_sign.ms-2 {
    color: #d5b048;
}

button.cmn_btn.btn-remove {
   background: #ffa419;
    padding: 8px 24px;
    border: none;
    border-radius: 4px;
    color: #fff;
}
@media screen and (max-width:768px){
    h4.account_title{
      font-size: 24px;
    }

  .m--5px {
    margin-top:5px;
    color: #b5b5b5;
    margin-bottom: 10px;
    font-size: 12px;
}
}
</style>
<section class="account_section_form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    
                    <div class="account_wrapper_form">
                        <h4 class="account_title">Login Form</h4>
                       
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
                                    <label for="username" class="form_label">Username</label>
                                    <div class="group_input">
                                        <input type="text" id="username" name="username" placeholder="Enter Username" value='' >
                                        <div class="error-massage-id">
                                        <?php echo form_error('username');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="input_group">
                                    <label for="password" class="form_label">Password</label>
                                    <div class="group_input">
                                        <input type="password" id="password" name="password" placeholder="Enter Password" value='' >
                                    </div>
                                </div>
                                <div class="account_check">
                                    <div class="checkgroup">
                                        <input type="checkbox" id="remember-me" name="remember">
                                        <label for="remember-me" class="form-label">Remember Me</label>
                                    </div>
                                    <a class="text_base"
                                        href="<?= base_url('forgot');?>">Forgot
                                        password?</a>
                                </div>
                            </div>
                       
                        <div class="d-flex flex-wrap justify-content-between align-items-center m--5px-none  fs-14">
                            <div class="m--5px">
                                Don't have any account? <a href="<?= base_url('register');?>"
                                    class="text_sign ms-2">Sign
                                    Up</a>
                            </div>
                            <div class="btn_group m-0">
                                <button type="submit" name="login"  class="cmn_btn btn-remove">Sign In</button>
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
    ( function($) {
  $(".btn-remove").click(function() {  
    $(this).css("display", "none");      
  });
} ) ( jQuery );
 
    
    
    
</script>
