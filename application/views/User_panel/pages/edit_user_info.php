<?php
$user_id=$this->session->userdata("user_id");
$profiles=$this->conn->runQuery('*','users_info',"u_code='$user_id' order by id desc");


?>
<style>
	
	.text-input {
    background: #0d1239;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 10px;
}

input#referral_link_right {
    padding: 5px 10px;
    border-radius: 4px;
    margin-bottom: 10px;
}

button.btn {
    width: 50px;
    margin: auto;
    display: block;
}
.form-inline1 > a input, select, button {
  width: 100%;
}
</style>
    <div class="container pages">
        <div class="row pt-2 pb-2">
                <div class="col-sm-12">
        		   
        		    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= $panel_path.'profile';?>">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Personal Profile</li>
                 </ol>
        	   </div>
        	    
        </div>


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
                  <div class="row">     
<div class="col-lg-6 col-md-12 col-sm-12 ">
	
	 <?php
				  if(!empty($profiles)){
				 ?>
				 <div class="">
                  <div class="text-input">
						 <input style="width:100%;" type="text" id="referral_link_right" class="" value="<?php echo                                                      base_url('Userprofile?u_id='.$profiles[0]->username);?>"  aria-describedby="basic-addon1">
						 <button type="submit" class="btn "  onclick="copyLink('right')" style="padding: 9px 9px 9px;padding-bottom:-1px">
							 <i class="fa fa-copy" style="color: #efb919;font-size: 18px;"></i>
						 </button>
					 </div>
				 </div>
				 <?php
				  }
				 ?>
	</div>
				 </div>	  
<!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
			
				
                               
          <div class="card">
            <div class="card-body ">
				
				
              <form id="" action="" method="post" enctype="multipart/form-data">
                <h4 class=" text-uppercase">
                  <!--<i class="fa fa-lock-circle-o"></i>-->
                  Personal detail
                </h4>
                <div class="form-group row">
                  <label for="input-1" class="col-sm-2 col-form-label">Username*</label>
                  <div class="col-sm-10">
                  <input type="text" name="username" value="<?= $profiles[0]->username;?>" class="form-control check_username_exist1" placeholder="Enter Username" aria-describedby="helpId" data-response="username_res">
					   <div class="error-massage-id text-danger"  id="username_res">
						 <?php echo form_error('username');?>
					</div> 
                  </div>
					
                </div>
                <div class="form-group row">
                  <label for="input-2" class="col-sm-2 col-form-label">Name*</label>
                  <div class="col-sm-10">
                   <input type="text" name="name" id="name" value="<?= $profiles[0]->name;?>" data-response="name_res" class="form-control" placeholder="Enter name" aria-describedby="helpId"  />
					   <div class="error-massage-id text-danger"  id="name_res">
						 <?php echo form_error('name');?>
					</div>
                  </div>
                </div>
				  
				  <div class="form-group row">
                  <label for="input-2" class="col-sm-2 col-form-label">Service Type*</label>
                  <div class="col-sm-10">
                   <input type="text" name="service_type" id="service_type" value="<?= $profiles[0]->service_type;?>" data-response="service_res" class="form-control" placeholder="Enter Service" aria-describedby="helpId"  />
					   <div class="error-massage-id text-danger"  id="service_res">
						 <?php echo form_error('service_type');?>
					</div>
                  </div>
                </div>
				
                 <div class="form-group row">
                  <label for="input-2" class="col-sm-2 col-form-label">Profile Pic</label>
                  <div class="col-sm-10">
                   <input type="file" name="profile_pic" id="profile_pic" class="form-control" placeholder="Enter " aria-describedby="helpId" />                   
                  </div>
                </div>
                <div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Email*</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" id="email" value="<?= $profiles[0]->email;?>" data-response="email_res" class="form-control" placeholder="Enter Email" aria-describedby="helpId"  />
					  <div class="error-massage-id text-danger"  id="email_res">
						 <?php echo form_error('email');?>
					</div> 
                  </div>
                </div>
                
				
				
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Mobile*</label>
                  <div class="col-sm-10">
                   <input type="text" name="mobile" id="mobile" value="<?= $profiles[0]->mobile;?>" data-response="mobile_res" class="form-control" placeholder="Enter Mobile" aria-describedby="helpId" <?= $profile_edited;?> />
					  <div class="error-massage-id text-danger"  id="mobile_res">
						 <?php echo form_error('mobile');?>
					</div> 
                  </div>
					 
                </div>
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Address*</label>
                  <div class="col-sm-10">
                   <textarea type="text" name="address" id="address" value="" data-response="address_res" class="form-control" placeholder="Enter address" aria-describedby="helpId"  ><?= $profiles[0]->address;?></textarea>
					   <div class="error-massage-id text-danger"  id="address_res">
						 <?php echo form_error('address');?>
					</div> 
                  </div>
                </div>  
				  
				  
				  <div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Bio*</label>
                  <div class="col-sm-10">
                   <textarea type="text" name="bio" id="bio"  class="form-control " data-response="bio_res" placeholder="Enter bio" aria-describedby="helpId"  /><?= $profiles[0]->bio;?></textarea>
					    <div class="error-massage-id text-danger"  id="bio_res">
						 <?php echo form_error('bio');?>
					</div> 
                  </div>
                </div>
			  
			   <div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Website Link</label>
                  <div class="col-sm-10">
                   <input type="text" name="website_url" id="website_url" value="<?= $profiles[0]->website_url;?>" class="form-control " placeholder="Enter Website Link" aria-describedby="helpId"  />
                  </div>
                </div>
			  <div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Company open close Time</label>
                  <div class="col-sm-10">
                   <input type="text" name="service_time" id="service_time" value="<?= $profiles[0]->service_time;?>" class="form-control " placeholder="Enter open close time" aria-describedby="helpId"  />
                  </div>
                </div>
			
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Facebook Link</label>
                  <div class="col-sm-10">
                   <input type="text" name="facebook_link" id="facebook_link" value="<?= $profiles[0]->facebook_link;?>" class="form-control " placeholder="Enter Facebook Link" aria-describedby="helpId"  />
                  </div>
                </div>
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Instagram Link</label>
                  <div class="col-sm-10">
                   <input type="text" name="instagram_link" id="instagram_link" value="<?= $profiles[0]->instagram_link;?>" class="form-control " placeholder="Enter Instagram Link" aria-describedby="helpId" />
                  </div>
                </div>
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Twitter Link</label>
                  <div class="col-sm-10">
                   <input type="text" name="twitter_link" id="twitter_link" value="<?= $profiles[0]->twitter_link;?>" class="form-control " placeholder="Enter Twitter Link" aria-describedby="helpId"  />
                  </div>
                </div>
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Linkedin Link</label>
                  <div class="col-sm-10">
                   <input type="text" name="linkdin_link" id="mobile" value="<?= $profiles[0]->linkdin_link;?>" class="form-control " placeholder="Enter Linkedin Link" aria-describedby="helpId"  />
                  </div>
                </div>
				<div class="form-group row">
                  <label for="input-3" class="col-sm-2 col-form-label">Telegram</label>
                  <div class="col-sm-10">
                   <input type="text" name="telegrame_link" id="mobile" value="<?= $profiles[0]->telegrame_link;?>" class="form-control " placeholder="Enter Telegram Link" aria-describedby="helpId"  />
                  </div>
                </div>
               <button type="submit" class="btn  btn-primary" name="edit_user_info">Save</button>
              </form>
            
			
            </div>
          </div>
        </div>
		
	
	
</div>
<script>
 function copyLink(iid) {
		 / Get the text field /
		 var copyText = document.getElementById("referral_link_right");

		 / Select the text field /
		 copyText.select();
		 copyText.setSelectionRange(0, 99999); /*For mobile devices*/

		 / Copy the text inside the text field /
		 document.execCommand("copy");

		 / Alert the copied text /
		 alert("Copied the text: " + copyText.value);
                }


</script>
<br>
<br>
<br>