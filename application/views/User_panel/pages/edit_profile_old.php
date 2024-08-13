<?php
$profile=$this->session->userdata("profile");
    $edit_profile_once=$this->conn->setting('edit_profile_once');
    $profile_edited='';
    if($edit_profile_once=='yes'){
        $profile_edited=$profile->profile_edited=='1' ? 'readonly':'';
    }
    
    
?>
<div class="user_content">
        <div class="container">
            <div class="row pt-2 pb-2">
            <div class="col-sm-12">
               
                <ol class="breadcrumb ml-3 mr-3">
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
                        
                <li class="breadcrumb-item active" aria-current="page">Edit-Account</li>
             </ol>
           </div>
         
    </div>
  

            <div class="user_main_card mb-3 ">
                <div class="user_card_body user_content_page ">
                    <h5 class="user_card_title filter_title"><i class="fa fa-user-circle" aria-hidden="true"></i>USER DETAIL</h5>
                    </div>
                <div class="user_card_body user_content_page ">
                     <form id="" action="" method="post" enctype="multipart/form-data"> 
                     
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
                                <label class="label_user_title">Username</label>
                                    <div class="input-group ">
                                     <input name="" type="text"  id=""  value="<?= $profile->username;?>" class="form-control user_input_text" placeholder="Username" readonly>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Name</label>
                                    <div class="input-group ">
                                     <input name="name" type="text"  id="" value="<?= $profile->name;?>" class="form-control user_input_text" placeholder="Name" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Profile Pic</label>
                                    <div class="input-group ">
                                     <input type="file" name="profile_pic" type="file"  id="profile_pic" value="" class="form-control user_input_text" placeholder="">
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Email</label>
                                    <div class="input-group ">
                                     <input name="email" type="text"  id="" value="<?= $profile->email;?>"  class="form-control user_input_text" placeholder="your_mail1@gmail.com" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Mobile</label>
                                    <div class="input-group ">
                                     <input name="mobile" type="text" id="" value="<?= $profile->mobile;?>" class="form-control user_input_text" placeholder="1234567890" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Instagram Link</label>
                                    <div class="input-group ">
                                     <input name="instagram_link" type="text"  id="" value="<?= $profile->instagram_link;?>" class="form-control user_input_text" placeholder="Instagram" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Facebook Link</label>
                                    <div class="input-group ">
                                     <input name="facebook_link" type="text"  id="" value="<?= $profile->facebook_link;?>" class="form-control user_input_text" placeholder="Facebook Link" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Twitter Link</label>
                                    <div class="input-group ">
                                     <input name="twitter_link" type="text"  id="" value="<?= $profile->twitter_link;?>" class="form-control user_input_text" placeholder="Twitter Link" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Telegram Link</label>
                                    <div class="input-group ">
                                     <input name="telegram_link" type="text"  id="" value="<?= $profile->telegram_link;?>" class="form-control user_input_text" placeholder="Telegram link" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              <div class="col-lg-12 mb-3">
                                <label class="label_user_title">Snap chat Link</label>
                                    <div class="input-group ">
                                     <input name="snap_chat" type="text"  id="" value="<?= $profile->snap_chat;?>" class="form-control user_input_text" placeholder="Snap chat Link" <?= $profile_edited;?>>
                                    </div>
                              </div>
                              
                          </div>
                     
                   </div>
                  
                     <?php
                if($profile_edited!='readonly'){
                    $edit_profile_with_otp=$this->conn->setting('edit_profile_with_otp');
                    if($edit_profile_with_otp=='yes'){
                      $display=(isset($_SESSION['otp']) ? 'block':'none');
                      ?>
                      <button type="button" data-response_area="action_areap" class="user_btn_button send_otp" >Send OTP</button>
                      
                      <div id="action_areap" style="display:<?= $display;?>">
                           <!--<p> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>-->
                           <!-- <button type="button" data-response_area="action_areap" id="proceed" class="user_btn_button send_otp" >Re-Send OTP</button>-->
                                       
                        <div class="form-group">
                          <label for="">Enter OTP </label>
                          <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1');?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input1');?></span> 
                        </div> 
                         <div class="user_form_row_data user_form_content ">
                        <div class="user_submit_button mb-2 mt-2">
                            <input type="submit" name="edit_btn" value="Save" id="" class="user_btn_button">
                        </div>
                        
                    </div>
                      </div>
                      <?php
                    }else{
                      ?>
                       <div class="user_form_row_data user_form_content ">
                        <div class="user_submit_button mb-2 mt-2">
                            <input type="submit" name="edit_btn" value="Save" id="" class="user_btn_button">
                        </div>
                        
                    </div>
                      <?php
                    } 
              }
              
                
                ?>
                </form> 
            <div class="col-lg-12 mb-3">
                <div class="data_save">
                  <p>Edit your user profile details</p>
    			  <p>To edit your user profile details, follow the steps below:</p>
    			  <!--<p>* Click on the username at the top left of the screen. then enter username.</p>-->
    			  <p>* Type your name</p>
    			  <p>* Type your  email address</p>
    			  <p>* Type your mobile number</p>
    			  <p>* Click the Save option to save all user details </p> 
			   </div>
			   </div>
           </div>
            
        </div>
        
        <?php
        
        $userid=$this->session->userdata('user_id');
        $bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
        $edit_bank_once=$this->conn->setting('edit_bank_once');
        $bank_edited='';
        if($edit_bank_once=='yes'){
            $bank_edited=$bank_details ? 'readonly':'';
        }
        $edit_btc_enable=$this->conn->setting('edit_btc_enable');
                     if($edit_btc_enable=='yes'){
        ?>
           <div class="user_main_card mb-3">
            <div class="user_card_body">
                
                    <div class="row">
                      <form id="" action="" method="post" enctype="multipart/form-data"> 
                     
                        <div class="col-lg-12 mb-3">
                            <label class="label_user_title">BTC address</label>
                                <div class="input-group ">
                                 <input name="btc_address" type="text"  value="<?= $bank_details ? $bank_details[0]->btc_address :'';?>"  id="btc_address" class="form-control user_input_text" placeholder="BTC address" <?= $bank_edited;?>>
                                </div>
                          </div>
                          <div class="col-lg-12 mb-3">
                            <label class="label_user_title">ETH address</label>
                                <div class="input-group ">
                                 <input name="eth_address" type="text" id="eth_address" value="<?= $bank_details ? $bank_details[0]->eth_address :'';?>" class="form-control user_input_text" placeholder="ETH address" <?= $bank_edited;?>>
                                </div>
                          </div>
                          <div class="col-lg-12 mb-3">
                         <input type="submit" name="edit_bank_btn" value="Save" id="" class="user_btn_button">
                        </div>
                        </form>
                          <div class="col-lg-12 mb-2">
                              <div class="user_detail_lines">
                                  <h6>You can enter any number of bank details for each business partner.</h6>
                                 <ul>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>Write the name as it is appeared in your bank account. Refer your passbook or cheque book.</p>
                                     </li>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>Write the name of your bank e.g. HDFC Bank, ICICI Bank, Punjab National Bank etc.</p>
                                     </li>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>You can refer your passbook or cheque book for IFSC code.</p>
                                     </li>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>These codes are used when transferring money between banks, particularly for international wire transfers. Either you contact your bank for this or check the official website of the bank to know the swift code for your bank.</p>
                                     </li>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>I hope you know your bank account number. Don't copy paste when entering second time so that you can know the mistake.</p>
                                     </li>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>Check the box “Set this form of payment as Primary”.</p>
                                     </li>
                                     <li>
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                        <p>And then Click on Save button.</p>
                                     </li>
                                 </ul>
                              </div>
                          </div>
                    </div>

            </div> 
    
           </div>
           <?php
           }
           ?>
           
        </div>
    
    </div>
    </div>
<br>
<br>

<script>
  var timeleft = 30;
    var downloadTimer = setInterval(function(){
    timeleft--;
    document.getElementById("countdowntimer").textContent = timeleft;
    if(timeleft <= 0)
        clearInterval(downloadTimer);
        
    },1000);
    
     $(document).ready(function() {
  setTimeout(function() {
    $("#proceed").show();
  }, 30000);
});

    
</script>


