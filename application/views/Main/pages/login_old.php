 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<style>
.form_inner_content {
    max-width: 570px;
    width: 100%;
    margin: 40px auto;
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

.form-group {
    position: relative;
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
.error-massage-id p {
    font-size: 13px;
    text-align: initial;
    color: red;
}
   .error-massage-id{
     text-align: initial;
   
 }
.form-group{
     margin-bottom:10px !important;
 }
.error-massage-id{
    margin-bottom:10px;
}
</style>
 <div class="form_section_detail">
        <div class="container">
          <div class="row">
              <div class="col-lg-12">
                
                  <div class="form_inner_content">
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
                      <h3>Login</h3>
                      <form action="" method="post">
                        <div class="form-group ">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username" aria-label=" " data-response="name_res">
                            
                        </div>
                        <div class="error-massage-id"  id="name_res">
                        <?php echo form_error('username');?>
                        </div>
                        <div class="form-group ">
                            <input name="password" type="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                          
                        </div>
                        <div class="checkbox form-group ">
                           <!-- <div class="form_check_data">
                                <input class="form_check_input" type="checkbox" id="rememberme">
                                <label class="form_check_label" for="rememberme">
                                    Remember me
                                </label>
                            </div>-->
                            <a href="<?= base_url('forgot');?>" class="link_forgot_page">Forgot your password?</a>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="submit_login btn-remove">Login</button>
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
 
    
    
    
</script>
