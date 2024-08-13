<?php
$user_id=$this->session->userdata("user_id");
$profile= $this->profile->profile_info($user_id);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-175669691-1"></script>

<style>
.table th, .table td {
    border:none !important;
    white-space: nowrap !important;
text-align: initial;
}
.profile_widget {
    margin-top: 63px;
}

.proflie_table table tr {
    border: none !important;
}
</style>




<div class="profile_text" id="all_margin_bottom_pages">
    <div class="container">
    <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">My Account /</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Profile</li>
         </ol>
	   </div>
	 
</div>
      <div class="row">
       <div class="col-12">
          <div class="profile_widget">
             <div class="wideget_user_img"> 
                <div class="wideget_inner_side">
             <?php  if($profile->img!=''){?>
                <img src="<?=base_url('images/users/').$profile->img;?>" alt="images">
                <?php }else{ ?>
                <img src="<?= $this->conn->company_info('logo');?>" alt="images">
                <?php } ?>
                </div>
                <div class="widget_user_content">
                <h4><?= $profile->username;?></h4>
                <h6>Status: <?= $profile->active_status==1 ? '<span style="color:green";>Active</span>':'<span style="color:red";>Inactive</span>';?> </h6>
             </div>
             </div>
             <div class="user_image_desc">
                <a href="<?= $panel_path.'profile/edit-profile';?>">Edit Profile</a>
                </div>
             
          </div>
          <div class="profile_widgetdetail">
             <div class="proflie_table">
                <table class="table row table-borderless w-100 m-0 ">
                   <tbody class="col-lg-6 p-0">
                      <tr>
                         <td><strong> Sponsor :</strong><?php
                                        $check_existsspo=$this->conn->runQuery('id','users',"id='$profile->u_sponsor'");
                                        if($check_existsspo){
                                           echo $this->profile->profile_info($profile->u_sponsor)->username;
                                        }
                                        
                                        ?></td>
                      </tr>
                      <tr>
                         <td><strong> Name :</strong><?= $profile->name;?></td>
                      </tr>
                      <tr>
                         <td><strong> Email :</strong> <?= $profile->email;?></td>
                      </tr>
                      <tr>
                         <td><strong> Status :</strong> <?= $profile->active_status==1 ? '<span style="color:green";>Active</span>':'<span style="color:red";>Inactive</span>';?>   </td>
                      </tr>
                   </tbody>
                   <tbody class="col-lg-6 p-0">
                      <tr>
                         <td><strong> Sponsor Name :</strong><?= $this->profile->profile_info($profile->u_sponsor)->name;?></td>
                      </tr>
                      <tr>
                         <td><strong> Mobile :</strong><?= $profile->mobile;?></td>
                      </tr>
                      <tr>
                         <td><strong> Date of Joinig  :</strong><?= $profile->added_on;?> </td>
                      </tr>
                      <tr>
                         <td><strong> Activation Date :</strong><?= $profile->active_status==1 ? $profile->active_date:'';?></td>
                      </tr>
                   </tbody>
                </table>
             </div>
          </div>
       </div>
    </div>
 </div>

 </div>




 <!-- <div class="user_content">
        <div class="container pages">
            <div class="row">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home /</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
         </ol>
	   </div>
	    
</div>
<div class="user_main_card mb-3">
           
             <div class="user_card_body">
                  <h5 class="user_card_title profile_edit"><a href="<?= $panel_path.'profile/edit-profile';?>"><i class="fa fa-edit"></i></a></h5>
                  <div class="user_form_row">
                      <h6 class="profile_information_heading">Sponsor information</h6>
                      <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Sponsor</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?php
                                        $check_existsspo=$this->conn->runQuery('id','users',"id='$profile->u_sponsor'");
                                        if($check_existsspo){
                                           echo $this->profile->profile_info($profile->u_sponsor)->username;
                                        }
                                        
                                        ?>" class="form-control user_input_text" placeholder="Sponsor ID" readonly>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Sponser Name</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?= $this->profile->profile_info($profile->u_sponsor)->name;?>" class="form-control user_input_text" placeholder="Sponser Name" readonly>
                                </div>
                        </div>
                     </div>
                     <h6 class="profile_information_heading">Profile Information</h6>
                     <div class="row">
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Name</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?= $profile->name;?>" class="form-control user_input_text" placeholder="Name" readonly>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Mobile</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?= $profile->mobile;?>" class="form-control user_input_text" placeholder="Mobile" readonly>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Email</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?= $profile->email;?>" class="form-control user_input_text" placeholder="Email" readonly>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Joining Date</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?= $profile->added_on;?>" class="form-control user_input_text" placeholder="2018-12-26 10:19:08" readonly>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Status</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id=""value="<?= $profile->active_status==1 ? 'Active':'Inactive';?>" class="form-control user_input_text" placeholder="Active" readonly>
                                </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-md-6 mb-2">
                            <label class="label_user_title">Active Date</label>
                                <div class="input-group ">
                                    <input name="" type="text" maxlength="10" id="" value="<?= $profile->active_status==1 ? $profile->active_date:'';?>" class="form-control user_input_text" placeholder="2020-10-30 11:26:14
                                    " readonly>
                                </div>
                        </div>
                     </div>
                      </div>
                  </div>
                  
            </div>

    </div>
</div>
<br>
<br> -->
