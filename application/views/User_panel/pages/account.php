<?php
$user_id=$this->session->userdata("user_id");
$profile= $this->profile->profile_info($user_id);
?>
<style>
.btnPrimary {
    width: auto;
    margin-bottom:5px;
}

</style>

    <section class="account-sec mb-3">
        <div class="container">
            <div class="aboutRow row">
                <div class="col-md-6 mt-3">
                    <div class="mailAboutDiv">
                        <div class="aboutDiv">
                            <h5>Sponsor : </h5>
                            <p><?php
                                        $check_existsspo=$this->conn->runQuery('id','users',"id='$profile->u_sponsor'");
                                        if($check_existsspo){
                                           echo $this->profile->profile_info($profile->u_sponsor)->username;
                                        }
                                        
                                        ?></p>
                        </div>
                        <div class="aboutDiv">
                            <h5>Name : </h5>
                            <p><?= $profile->name;?></p>
                        </div>
                        <div class="aboutDiv">
                            <h5>Email : </h5>
                            <p><?= $profile->email;?></p>
                        </div>
                        <div class="aboutDiv">
                            <h5>Status : </h5>
                            <p><?= $profile->active_status==1 ? '<span style="color:green";>Active</span>':'<span style="color:red";>Inactive</span>';?>  </p>
                        </div>
                       <!-- <div class="aboutDiv">
                            <h5>Sponsor Name : </h5>
                            <p><?= $this->profile->profile_info($profile->u_sponsor)->name;?></p>
                        </div>-->
                        <div class="aboutDiv">
                            <h5>Mobile : </h5>
                            <p><?= $profile->mobile;?></p>
                        </div>
                        <div class="aboutDiv">
                            <h5>Joining Date : </h5>
                            <p><?= $profile->added_on;?></p>
                        </div>
                        <div class="aboutDiv">
                            <h5>Activation Date : </h5>
                            <p><?= $profile->active_status==1 ? $profile->active_date:'';?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="mainAccountLeftCol">
                        <div class="accountLeftCol">
                            <div class="user_p">
                              <?php  if($profile->img!=''){?>
                            <img src="<?=base_url('images/users/').$profile->img;?>" alt="images">
                            <?php }else{ ?>
                            <img src="<?= $this->conn->company_info('logo');?>" alt="images">
                            <?php } ?>
                            </div>
                            <h3><?= $profile->username;?></h3>
                            <p>Status : <span style="color: green;"><?= $profile->active_status==1 ? '<span style="color:green";>Active</span>':'<span style="color:red";>Inactive</span>';?> </span>
                            </p>
                            <div class="text-center">

                                <a href="<?= $panel_path.'payment/add-account';?>" class="btnPrimary">Account</a>
                                <a  href="<?= $panel_path.'profile/edit-profile';?>"  class="btnPrimary">Edit Profile</a>
                                 <a  href="<?= $panel_path.'logout';?>"  class="btnPrimary">Logout</a>
                                <a href="<?= $panel_path.'support';?>" class="btnPrimary">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   
    <br>
<br>
