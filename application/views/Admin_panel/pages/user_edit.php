
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Edit Profile</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $admin_path.'users';?>">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Edit Profile</h6>
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
                        $profile=$this->profile->profile_info($edit_user);
                    ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card card-body">
          <form action="" method="post">
              <div class="form-group">
                <label for="">Username</label>
                <input type="text"  value="<?= $profile->username;?>" class="form-control" placeholder="" aria-describedby="helpId" readonly >               
              </div>
              <div class="form-group">
                <label for="">Sponsor</label>
                <input type="text" class="form-control check_sponsor_exist no_space" id="u_sponsor" name="u_sponsor" placeholder="Sponsor ID" data-response="sponsor_res" value="<?php
                    
                     $id=$profile->id;
                     $u_sponsorssss=$this->conn->runQuery('u_sponsor','users',"id='$id' and 1=1");
                     $spons_id=$u_sponsorssss[0]->u_sponsor;
                     $u_spos=$this->conn->runQuery('username,name','users',"id='$spons_id' and 1=1");
                     $u_spos[0]->name;
                     echo  $u_spos[0]->username;
                    ?>" readonly/>
                  
              </div>
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" id="name" value="<?= $profile->name;?>" class="form-control" placeholder="" aria-describedby="helpId">
                
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" id="email" value="<?= $profile->email;?>" class="form-control" placeholder="" aria-describedby="helpId">
                
              </div>
              <div class="form-group">
                <label for="">Mobile</label>
                <input type="text" name="mobile" id="mobile" value="<?= $profile->mobile;?>" class="form-control" placeholder="" aria-describedby="helpId">
                
              </div>
               <div class="form-group">
                <label for="">Change Status</label>
                  <select class="form-control" name="input_block" id="">
                     <option value="0" <?= ($profile->block_status==0 ? 'selected':'')?> >Enable</option>
                     <option value="1" <?= ($profile->block_status==1 ? 'selected':'')?> >disable</option>
                     
                </select>
                <div class="form-group">
                    <label for="subscription_date">Subscription Date</label>
                    <input type="text" name="subscription_date" id="subscription_date" value="<?= $profile->subcription_date; ?>" class="form-control" placeholder="" aria-describedby="helpId" data-inputmask="'alias': 'date', 'inputFormat': 'dd-mm-yyyy', 'placeholder': 'dd-mm-yyyy'">
                </div>



                </div>
                <div class="form-group">
                <label for="">Select Color</label>
                  <select class="form-control" name="selected_color" id="">
                     <option value="" >Select Color</option>
                     <option value="green" <?= ($profile->selected_color=='green' ? 'selected':'')?> >Green</option>
                     <option value="pink" <?= ($profile->selected_color=='pink' ? 'selected':'')?> >Pink</option>
                     <option value="yellow" <?= ($profile->selected_color=='yellow' ? 'selected':'')?> >Yellow</option>
                     
                </select>
                </div>
                <!-- Admin se Allow Inactive id Sponsor close open system Register page-->
                <?php
                if($this->conn->setting('only_inactive_sponsor')=='yes'){
                ?>
                 <div class="form-group">
                <label for="">Register Status</label>
                  <select class="form-control" name="input_register_block" id="">
                     
                     <option value="0" <?= ($profile->admin_register_status==0 ? 'selected':'')?> >Disable</option>
                     <option value="1" <?= ($profile->admin_register_status==1 ? 'selected':'')?> >Enable</option>
                     
                </select>
                </div>
                <?php
                }
                ?>
                
                <div class="form-group">
                    <label for="">Email verify Status</label>
                      <select class="form-control" name="is_email_verify" id="">
                          <option value="1" <?= ($profile->is_email_verify==1 ? 'selected':'')?> >Enable</option>
                         <option value="0" <?= ($profile->is_email_verify==0 ? 'selected':'')?> >disable</option>
                         
                         
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="">Rank Status</label>
                      <select class="form-control" name="my_rank" id="">
                          <option>Select Rank</option>
                          <?php
                          $my_rank_details=$this->conn->runQuery('rank','plan',"id<='8' and 1=1");
                          if($my_rank_details){
                              foreach($my_rank_details as $my_rank_details1){
                          ?> 
                          <option value="<?= $my_rank_details1->rank;?>"  <?= ($profile->my_rank==$my_rank_details1->rank ? "selected" : "");?>><?= $my_rank_details1->rank;?></option>
                          <?php } } ?>
                         
                    </select>
                </div>
                
                <?php
                $edit_profile_with_otp=$this->conn->setting('admin_edit_profile_with_otp');
                if($edit_profile_with_otp=='yes'){

                  $display=(isset($_SESSION['admin_otp']) ? 'block':'none');
                  ?>
                  <button type="button" data-response_area="action_area" class="btn btn-primary send_otp_edit" >Send OTP</button>
                  
                  <div id="action_area" style="display:<?= $display;?>"> 
                    <div class="form-group">
                      <label for="">Enter OTP </label>
                      <input type="text" name="otp_input" id="otp_input" value="<?= set_value('otp_input');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                      <span class=" " ><?= form_error('otp_input');?></span> 
                    </div> 
                    <button type="submit" class="btn btn-primary btn-remove" name="edit_btn">Save</button>
                  </div>
                  <?php
                }else{
                  ?>
                  <button type="submit" class="btn btn-primary btn-remove" name="edit_btn">Save</button>
                  <?php
                }
                ?>
           

              
          </form>
      </div>
    </div>
    <!--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card card-body">
        <?php
        $userid=$edit_user;
        $bank_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");

        ?>
            <form action="" method="post">
                 <?php
                       $with_drawal_mode=$this->conn->setting('withdrawals_mode')=='in_bank';
                       if($with_drawal_mode){
                       
                    ?>
                <div class="form-group">
                  <label for="">Bank Name</label>
                  <input type="text" name="bank_name" value="<?= $bank_details ? $bank_details[0]->bank_name :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >               
                </div>
                <div class="form-group">
                  <label for="">Account Holder Name</label>
                  <input type="text" name="account_holder_name" value="<?= $bank_details ? $bank_details[0]->account_holder_name :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                <div class="form-group">
                  <label for="">Account No.</label>
                  <input type="text" name="account_no" id="account_no" value="<?= $bank_details ? $bank_details[0]->account_no :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                <div class="form-group">
                  <label for="">IFSC</label>
                  <input type="text" name="ifsc_code" id="ifsc_code" value="<?= $bank_details ? $bank_details[0]->ifsc_code :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                <div class="form-group">
                  <label for="">Bank branch</label>
                  <input type="text" name="bank_branch" id="bank_branch" value="<?= $bank_details ? $bank_details[0]->bank_branch :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                  <?php
                       }
                       
                       $with_in_cripto_mode=$this->conn->setting('withdrawals_mode')=='in_cripto';
                       if($with_in_cripto_mode){
                ?>
                
                <div class="form-group">
                  <label for="">BTC address </label>
                  <input type="text" name="btc_address" id="btc_address" value="<?= $bank_details ? $bank_details[0]->btc_address :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                <div class="form-group">
                  <label for="">ETH address </label>
                  <input type="text" name="eth_address" id="eth_address" value="<?= $bank_details ? $bank_details[0]->eth_address :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                
                <div class="form-group">
                  <label for="">Tron address </label>
                  <input type="text" name="tron_address" id="tron_address" value="<?= $bank_details ? $bank_details[0]->tron_address :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  
                </div>
                <?php
                       }
                
                ?>

                <button type="submit" class="btn btn-primary" name="edit_bank_btn">Save</button>
            </form>
        </div>
    </div>-->
     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card card-body">
         
            <form action="" method="post">
                 
                <div class="form-group">
                  <label for="">Set New Password </label>
                  <input type="password" name="u_password" id="u_password" value="" class="form-control" placeholder="Enter New Password" aria-describedby="helpId">
                  
                </div>
               
                

                <button type="submit" class="btn btn-primary btn-remove" name="set_pass_btn">Set password</button>
            </form>
        </div>
    </div>
    <!--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card card-body">
         
            <form action="" method="post">
                 
                <div class="form-group">
                  <label for="">Set New Transaction Password </label>
                  <input type="password" name="tx_u_password" id="u_password" value="" class="form-control" placeholder="Enter New tx Password" aria-describedby="helpId">
                  
                </div>
               <button type="submit" class="btn btn-primary" name="set_pass_tx_btn">Set tx password</button>
            </form>
        </div>
    </div>-->
    <!--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card card-body">
         
            <form action="" method="post">
                 
                <div class="form-group">
                  <label for="">Sponsor Name</label>
                  <input type="text" name="sponsor" id="sponsor" value="<?php
                    
                     $id=$profile->id;
                     $u_sponsorssss=$this->conn->runQuery('u_sponsor','users',"id='$id' and 1=1");
                     $spons_id=$u_sponsorssss[0]->u_sponsor;
                     $u_spos=$this->conn->runQuery('username,name','users',"id='$spons_id' and 1=1");
                     $u_spos[0]->name;
                     echo  $u_spos[0]->username;
                    ?>" class="form-control" placeholder="Enter Sponsor" aria-describedby="helpId">
                    <p style="color:green"><?= $u_spos[0]->name;?></p>
                  
                </div>
               <button type="submit" class="btn btn-primary" name="change_sp_btn">Change Sponsor</button>
            </form>
        </div>
    </div>
    -->
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/jquery.inputmask.min.js"></script>
<script>
    $(document).ready(function () {
        $("#subscription_date").inputmask();
    });
</script>
