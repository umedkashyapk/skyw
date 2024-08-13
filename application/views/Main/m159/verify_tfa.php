<style>
 label.form_check_label {
    color: #fff;
}
.account_wrapper_form {
    margin: 40px 0px 40px 0px;
    background:#3a383869;
    padding: 20px;
    border-radius: 4px;
}
.group_input input {
    background: none;
    outline:none;
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
    color:  #d4ae47;
}

.m--5px {
    color: #fff;
}

a.text_sign.ms-2 {
    color:  #d4ae47;
}

button.cmn_btn {
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
}
</style>

        <section class="account_section_form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-7">
                    
                    <div class="account_wrapper_form">
                        <h4 class="account_title">Verify Otp</h4>
                      
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
                                    <label for="username" class="form_label">Enter 2FA Code</label>
                                    <div class="group_input">
                                         <input type="text" class="" placeholder="Enter Code" id="2fa_code" name="2fa_code" value="">
                                   
                                    </div>
                                </div>
                               
                                </div>
                       
                        <div class="d-flex flex-wrap justify-content-between align-items-center m--5px-none mt-3 fs-14">
                           
                            <div class="btn_group m-0">
                                <button type="submit"  name="verify" class="cmn_btn">Verify</button>
                            </div>
                        </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
  
        