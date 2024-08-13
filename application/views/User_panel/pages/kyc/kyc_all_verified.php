
<style>
  <?php
 $userid=$this->session->userdata('user_id');

$profile=$this->session->userdata("profile");

 $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
?>

}
span.badeg_btn2 {
    background: red;
}
span.badeg_btn1 {
    background: blue;
    padding: 2px 6px;
    border-radius: 16px;
    color:white;
}

span.badeg_btn3 {
    background: red;
    padding: 2px 6px;
    border-radius: 16px;
    color:white;
}

span.badeg_btn4 {
    background: yellow;
    padding: 2px 6px;
    border-radius: 16px;
    color:white;
}
</style>



 <div class="detail_tab_data">
    <div class="container pages">
         
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   <!-- <h4 class="page-title"> Kyc</h4>-->
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home/</a></li>
            <li class="breadcrumb-item"><a href="#">KYC</a></li>
            
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
    if($kyc_details && $kyc_details[0]->kyc_status=='submitted'){
?>


<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Information! </strong>kyc request submitted. Please wait for any action.
</div>
<?php

  }?>
 
        <ul class="tabs_detail">
             <li class="tab-link current" data-tab="tab-6">KYC Status</li>
            <li class="tab-link" data-tab="tab-1">Personal Info</li>
            <li class="tab-link" data-tab="tab-2">Identity Verification</li>
            <li class="tab-link" data-tab="tab-3">Pan Card Details </li>
            <li class="tab-link" data-tab="tab-4">Bank Details </li>
            <li class="tab-link" data-tab="tab-5">Nominee </li>
        </ul>
        
        <div id="tab-6" class="tab-content current">
            <div class="detail_form_tab">
                <table class="table table-bordered table-responsive table_detail">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Personal</th>
                    <th>Identity </th>
                    <th>Pan</th>
                    <th>Bank</th>
                    <th>Nominee</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                     
                    <td><?= $profile->username;?></td>
                    <td><?= $profile->name;?></td>
                 <td><?php if($kyc_details[0]->kyc_status_personal=='submitted'){ ?> <span class="badeg_btn1" style="background:blue; border-radius:16px; padding:2px 6px;color:white;">Submitted</span> <?php } ?><?php if($kyc_details[0]->kyc_status_personal=='approved'){ ?><span class="badeg_btn2" style="background:green; border-radius:16px; padding:2px 6px;color:white;">Approved</span><?php } ?><?php if($kyc_details[0]->kyc_status_personal=='rejected'){ ?><span class="badeg_btn3">Rejected</span><?php } ?><?php if($kyc_details[0]->kyc_status_personal==''){ ?><span class="badeg_btn4" style="background:black; border-radius:16px; padding:2px 6px;color:white;">x</span><?php } ?></td>                               
                 <td><?php if($kyc_details[0]->kyc_status_identity=='submitted'){ ?><span class="badeg_btn1" style="background:blue; border-radius:16px; padding:2px 6px;color:white;">Submitted</span><?php } ?><?php if($kyc_details[0]->kyc_status_identity=='approved'){ ?><span class="badeg_btn2" style="background:green; border-radius:16px; padding:2px 6px;color:white;">Approved</span><?php } ?><?php if($kyc_details[0]->kyc_status_identity=='rejected'){ ?><span class="badeg_btn3">Rejected</span><?php } ?><?php if($kyc_details[0]->kyc_status_identity==''){ ?><span class="badeg_btn4" style="background:black; border-radius:16px; padding:2px 6px;color:white;">x</span><?php } ?></td>                               
                 <td><?php if($kyc_details[0]->kyc_status_pan=='submitted'){ ?><span class="badeg_btn1" style="background:blue; border-radius:16px; padding:2px 6px;color:white;">Submitted</span><?php } ?><?php if($kyc_details[0]->kyc_status_pan=='approved'){ ?><span class="badeg_btn2" style="background:green; border-radius:16px; padding:2px 6px;color:white;">Approved</span><?php } ?><?php if($kyc_details[0]->kyc_status_pan=='rejected'){ ?><span class="badeg_btn3">Rejected</span><?php } ?><?php if($kyc_details[0]->kyc_status_pan==''){ ?><span class="badeg_btn4" style="background:black; border-radius:16px; padding:2px 6px;color:white;">x</span><?php } ?></td> 
                 <td><?php if($kyc_details[0]->kyc_status_bank=='submitted'){ ?><span class="badeg_btn1" style="background:blue; border-radius:16px; padding:2px 6px;color:white;">Submitted</span><?php } ?><?php if($kyc_details[0]->kyc_status_bank=='approved'){ ?><span class="badeg_btn2" style="background:green; border-radius:16px; padding:2px 6px;color:white;">Approved</span><?php } ?><?php if($kyc_details[0]->kyc_status_bank=='rejected'){ ?><span  class="badeg_btn3">Rejected</span><?php } ?><?php if($kyc_details[0]->kyc_status_bank==''){ ?><span class="badeg_btn4" style="background:black; border-radius:16px; padding:2px 6px;color:white;">x</span><?php } ?></td>    
                 <td><?php if($kyc_details[0]->kyc_status_nominee=='submitted'){ ?><span class="badeg_btn1" style="background:blue; border-radius:16px; padding:2px 6px;color:white;">Submitted</span><?php } ?><?php if($kyc_details[0]->kyc_status_nominee=='approved'){ ?><span class="badeg_btn2" style="background:green; border-radius:16px; padding:2px 6px;color:white;">Approved</span><?php } ?><?php if($kyc_details[0]->kyc_status_nominee=='rejected'){ ?><span class="badeg_btn3">Rejected</span><?php } ?><?php if($kyc_details[0]->kyc_status_nominee==''){ ?><span class="badeg_btn4" style="background:black; border-radius:16px; padding:2px 6px;color:white;">x</span><?php } ?></td>    
                  </tr>
                  
                </tbody>
              </table>
              
            </div>
        </div>
        <div id="tab-1" class="tab-content">
           <div class="detail_form_tab">
             
             <?php 
             $personal_read="";
        if($kyc_details && $kyc_details[0]->kyc_status_personal=='submitted'){
            $personal_read="readonly";
        }     
             
   if($kyc_details && $kyc_details[0]->kyc_status_personal=='approved'){
   $personal_read="readonly";
   
   ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
   }   
   if($kyc_details && $kyc_details[0]->kyc_status_personal=='rejected'){  
?>
       <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> KYC Rejected! </strong> Reason : <?= $kyc_details[0]->personal_remark;?>.
      </div>      
      <?php
    }
?>  
               
               
            <form action="" method="post">
                
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                <label>Name</label>
                <input type="text" id="name" name="name" class="tab_input_detail" value="<?= $kyc_details[0]->name;?>" placeholder="Name" <?= $personal_read;?>>
                <span class=" text-danger" ><?= form_error('name');?></span>    
                
                <label>Distributor Number</label>
                <input type="text" id="disribute_no" name="disribute_no"  class="tab_input_detail" value="<?= $kyc_details[0]->disribute_no;?>" placeholder="Distributor Number" <?= $personal_read;?>>
                <span class=" text-danger" ><?= form_error('disribute_no');?></span>   
                </div>
                 <div class="col-lg-6 col-md-12 col-sm-12">
                 
                <label>Email</label>
                <input type="text" id="email" name="email"  class="tab_input_detail" value="<?= $kyc_details[0]->email;?>" placeholder="Email" <?= $personal_read;?>>
                <span class=" text-danger" ><?= form_error('email');?></span>    
                
                
                <label>Mobile</label>
                 <input type="text" id="mobile" name="mobile"  class="tab_input_detail" value="<?= $kyc_details[0]->mobile;?>" placeholder="Mobile" <?= $personal_read;?>>
                 <span class=" text-danger" ><?= form_error('mobile');?></span>   
                  </div>
                 <?php
              if((!$kyc_details) || ($kyc_details[0]->kyc_status_personal=='rejected') || ($kyc_details[0]->kyc_status_personal=='')){
                ?> 
                  
                 <button type="submit" class="tab_button_click btn-remove" name="personal_btn">Submit</button>
                 <?php } ?>
                 
                 </div>
                 </div>
              </form> 
              
           </div>
        
         <form action="" method="post" enctype="multipart/form-data">
            
        <div id="tab-2" class="tab-content">
            
            <div class="detail_form_tab">
                
<?php 
 if($kyc_details && $kyc_details[0]->kyc_status_identity=='submitted'){
            $identity_read="readonly";
        } 
   if($kyc_details && $kyc_details[0]->kyc_status_identity=='approved'){
    $identity_read="readonly";
   ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
   }   
   if($kyc_details && $kyc_details[0]->kyc_status_identity=='rejected'){  
?>
       <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> KYC Rejected! </strong> Reason : <?= $kyc_details[0]->kyc_remark;?>.
      </div>      
      <?php
    }
     if($kyc_details && $kyc_details[0]->kyc_status_identity=='submitted'){  
?>
     <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Information! </strong>kyc request submitted. Please wait for any action.
</div>         
   
   
   <?php } ?>  
   <div class="row">
       <div class="col-lg-6 col-md-12 col-sm-12">
   <label>Select Services</label>
                <select name="select_service" id="plan" class="select_services_tab" <?= $identity_read;?>>
                    <option value="">Select Document</option>
                    <option value="aadhaar"<?php if($kyc_details[0]->attached_doc=="aadhaar"){echo "selected";} ?>>Aadhaar</option>
                    <option value="voter"<?php if($kyc_details[0]->attached_doc=="voter"){echo "selected";} ?>>Voter ID</option>
                    <option value="driving"<?php if($kyc_details[0]->attached_doc=="driving"){echo "selected";} ?>>Driving Licence</option>
                    <option value="passport"<?php if($kyc_details[0]->attached_doc=="passport"){echo "selected";} ?>>Passport</option>
                </select>
                <label>Document No</label>
                <input type="text" id="tax_id" name="tax_id" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->tax_id :'';?>" placeholder="Document No" <?= $identity_read;?>>
                 <span class=" text-danger" ><?= form_error('tax_id');?></span> 
                  
                  <?php
                if((!$kyc_details) || ($kyc_details[0]->kyc_status_identity=='rejected') || ($kyc_details[0]->kyc_status_identity=='')){
                ?> 
                
                 <label>Front Image<label>
                <input type="file" id="front_image" name="front_image" class="tab_input_detail"  accept="image">
                 <span class=" text-danger" ><?= form_error('front_image');?></span>    
                 
                <label>Back Image<label>
                <input type="file" id="back_image" name="back_image" class="tab_input_detail"   accept="image">
                 <span class=" text-danger" ><?= form_error('back_image');?></span> 
                 
                
                <?php } ?> 
              
 </div>
                  <div class="col-lg-6 col-md-12 col-sm-12">
            
                <div class="tab_images_detail">
                    
                 <?php
                  if($kyc_details[0]->kyc_status_identity=='submitted' ||  $kyc_details[0]->kyc_status_identity=='approved'){
                    ?> 
                    <label>Front Image<label>
                   <img style="width:150px;" src="<?= $kyc_details[0]->front_image;?>" alt="images">
                 <?php
                  }
                 ?> 
              <?php
              if($kyc_details[0]->kyc_status_identity=='submitted' ||  $kyc_details[0]->kyc_status_identity=='approved'){
                ?> 
                  <label>Back Image<label>  
              <img style="width:150px;" src="<?= $kyc_details[0]->back_image;?>">
             <?php
              }
             ?>
            </div>
           
              </div>   
              <?php   
           
             
              if((!$kyc_details) || ($kyc_details[0]->kyc_status_identity=='rejected') || ($kyc_details[0]->kyc_status_identity=='')){
                ?> 
                <button type="submit" class="tab_button_click btn-remove" name="identity_btn">Submit</button>
                <?php
              }
                ?>
            </div>
            </div>
        </div>
        </form> 
        <form action="" method="post" enctype="multipart/form-data">
        <div id="tab-3" class="tab-content">
            <div class="detail_form_tab">
                
                <?php 
                
                if($kyc_details && $kyc_details[0]->kyc_status_pan=='submitted'){
            $pan_read="readonly";
        } 
   if($kyc_details && $kyc_details[0]->kyc_status_pan=='approved'){
   $pan_read="readonly";
   ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
   }   
   if($kyc_details && $kyc_details[0]->kyc_status_pan=='rejected'){  
?>
       <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> KYC Rejected! </strong> Reason : <?= $kyc_details[0]->pan_remark;?>.
      </div>      
      <?php
    }
      if($kyc_details && $kyc_details[0]->kyc_status_pan=='submitted'){  
?>
      <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Information! </strong>kyc request submitted. Please wait for any action.
</div>         
   
   
   <?php } ?>  
   
   <div class="row">
  <div class="col-lg-6 col-md-12 col-sm-12">
   <label>Pan No</label>
                <input type="text" id="pan_no" name="pan_no" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->pan_no :'';?>" placeholder="Pan No" <?= $pan_read;?>>
                <span class=" text-danger" ><?= form_error('pan_no');?></span>   
                <?php
                 if((!$kyc_details) || ($kyc_details[0]->kyc_status_pan=='rejected') || ($kyc_details[0]->kyc_status_pan=='')){
                ?> 
                
                <label>Pan Card Image<label>
                <input type="file" id="front_image_pan" name="front_image_pan" class="tab_input_detail" accept="image" <?= $pan_read;?>>
                 <span class=" text-danger" ><?= form_error('front_image_pan');?></span>
                 
                 <?php } ?>
                
                 </div>
                  <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="tab_images_detail">
                   <?php
                    if($kyc_details[0]->kyc_status_pan=='submitted' ||  $kyc_details[0]->kyc_status_pan=='approved'){
                 
                    ?> 
                    <label>Pan Card Image<label>
                   <img style="width:150px;" src="<?= $kyc_details[0]->front_image_pan;?>" alt="images">
                 <?php
                  }
                 ?> 
                   </div> 
                 </div>
                   <?php
                  if((!$kyc_details) || ($kyc_details[0]->kyc_status_pan=='rejected') || ($kyc_details[0]->kyc_status_pan=='')){
                    ?> 
                 <button type="submit" class="tab_button_click btn-remove" name="pan_btn">Submit</button>
                 <?php
                  }
                 ?>
                      
   </div>
            </div>
        </div>
        </form>
        <form action="" method="post" enctype="multipart/form-data">
        <div id="tab-4" class="tab-content">
            <div class="detail_form_tab">
                
                 <?php 
                  if($kyc_details && $kyc_details[0]->kyc_status_bank=='submitted'){
            $bank_read="readonly";
        } 
   if($kyc_details && $kyc_details[0]->kyc_status_bank=='approved'){
     $bank_read="readonly";
   ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
   }   
   if($kyc_details && $kyc_details[0]->kyc_status_bank=='rejected' ){  
?>
       <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> KYC Rejected! </strong> Reason : <?= $kyc_details[0]->bank_remark;?>.
      </div>      
      <?php
    }
if($kyc_details && $kyc_details[0]->kyc_status_bank=='submitted'){  
?>
      <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Information! </strong>kyc request submitted. Please wait for any action.
</div>         
   
   
   <?php } ?>            
                
                <div class="row">
                   <div class="col-lg-6 col-md-12 col-sm-12">
               
                <label>Account Holdername</label>
                <input type="text" id="account_holder_name" name="account_holder_name" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->account_holder_name :'';?>" placeholder="Account Holdername" <?= $bank_read;?>>
                  <span class=" text-danger" ><?= form_error('account_holder_name');?></span>
                
                   <label>Bank Name</label>
                <input type="text" id="bank_name" name="bank_name" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->bank_name :'';?>" placeholder="Bank Name" <?= $bank_read;?>>
                  <span class=" text-danger" ><?= form_error('bank_name');?></span>
                
                 <label>Account Number</label>
                <input type="text" id="account_no" name="account_no" class="tab_input_detail no_space" data-response="account_res" value="<?= $kyc_details ? $kyc_details[0]->account_no :'';?>" placeholder="Account Number" <?= $bank_read;?>>
                  <span class=" text-danger" id="account_res"><?= form_error('account_no');?></span>
                </div>
               
                <div class="col-lg-6 col-md-12 col-sm-12">
               <label>IFSC Code</label>
                <input type="text" id="ifsc_code" name="ifsc_code" class="tab_input_detail no_space" data-response="ifsc_res" value="<?= $kyc_details ? $kyc_details[0]->ifsc_code :'';?>" placeholder="IFSC Code" <?= $bank_read;?>>
                  <span class=" text-danger" id="ifsc_res"><?= form_error('ifsc_code');?></span>
                
                        
               <label>Bank Branch</label>
                <input type="text" id="bank_branch" name="bank_branch" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->bank_branch :'';?>" placeholder="Bank Branch" <?= $bank_read;?>>
                  <span class=" text-danger" ><?= form_error('bank_branch');?></span>
                  
                <?php
                       if((!$kyc_details) || ($kyc_details[0]->kyc_status_bank=='rejected') || ($kyc_details[0]->kyc_status_bank=='')){
                    ?>
                   
                 <label>Bank Passbook Image</label>  
               
                 <input type="file" id="front_image_bank" name="front_image_bank" class="tab_input_detail" >
                   <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
                <?php } ?>
                <div class="tab_images_detail">
                    
                 <?php
                    if($kyc_details[0]->kyc_status_bank=='submitted' ||  $kyc_details[0]->kyc_status_bank=='approved'){
                 
                    ?>  
                    <label>Bank Passbook Image</label>
                   <img style="width:150px;" src="<?= $kyc_details[0]->front_image_bank;?>" alt="images">
                 <?php
                  }
                 ?> 
                   
                 </div>
                 </div>
                    <?php
                  if((!$kyc_details) || ($kyc_details[0]->kyc_status_bank=='rejected') || ($kyc_details[0]->kyc_status_bank=='')){
                    ?> 
                 <button type="submit" class="tab_button_click btn-remove" name="bank_btn_kyc">Submit</button>
                 <?php
                  }
                 ?>
                  </div> 
            </div>
        </div>
        </form>
        <form action="" method="post" enctype="multipart/form-data">
           
        <div id="tab-5" class="tab-content">
            <div class="detail_form_tab">
                
                 <?php 
                  
     if($kyc_details && $kyc_details[0]->kyc_status_nominee=='submitted'){
            $nominee_read="readonly";
        } 
   if($kyc_details && $kyc_details[0]->kyc_status_nominee=='approved'){
    $nominee_read="readonly";
   ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
   }   
   if($kyc_details && $kyc_details[0]->kyc_status_nominee=='rejected'){  
?>
       <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> KYC Rejected! </strong> Reason : <?= $kyc_details[0]->nominee_remark;?>.
      </div>      
      <?php
    }
if($kyc_details && $kyc_details[0]->kyc_status_nominee=='submitted'){  
?>
      <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Information! </strong>kyc request submitted. Please wait for any action.
</div>         
   
   
   <?php } ?> 
   <div class="row">
       <div class="col-lg-6 col-md-12 col-sm-12">
   
                
                <label>Naminee Name</label>
                <input type="text" id="nominee_name" name="nominee_name" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->nominee_name :'';?>" placeholder="Naminee Name" <?= $nominee_read;?>>
                 <span class=" text-danger" ><?= form_error('nominee_name');?></span>
                <label>Namiee Relation</label>
                <input type="text" id="nominee_relation" name="nominee_relation" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->nominee_relation :'';?>" placeholder="Namiee Relation" <?= $nominee_read;?>>
                 <span class=" text-danger" ><?= form_error('nominee_relation');?></span>
               </div>
               <div class="col-lg-6 col-md-12 col-sm-12">
                <label>Namniee D.O.B</label>
                <input type="date" id="nominee_dob" name="nominee_dob" class="tab_input_detail" value="<?= $kyc_details ? $kyc_details[0]->nominee_dob :'';?>" placeholder="Namniee D.O.B" <?= $nominee_read;?>>
                 <span class=" text-danger" ><?= form_error('nominee_dob');?></span>
                  </div>
                   <?php
                   
                  if((!$kyc_details) || ($kyc_details[0]->kyc_status_nominee=='rejected') || ($kyc_details[0]->kyc_status_nominee=='')){
                    ?> 
                    <button type="submit" class="tab_button_click btn-remove" name="nominee_btn">Submit</button>
                    <?php
                  }
                ?>
                </div>
            </div>
        </div>
        </form>
    </div><!-- container -->

</div>

<script>
    $(document).ready(function(){
	
	$('ul.tabs_detail li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs_detail li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})

( function($) {
  $(".btn-remove").click(function() {  
    $(this).css("display", "none");      
  });
} ) ( jQuery );
</script>
<br>
<br><br><br><br><br>