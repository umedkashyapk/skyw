<?php
$profile=$this->session->userdata("profile");
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>

input[type=file] {
    display: block;
    padding: 3px;
}
.kyc_form{
    margin-bottom:40px;
}
.kycbox {
    background: #f2f2f2;
}
  .form-group {
    margin-top: 15px;
}
.box1{
 border-radius: 5px;
  background-color: ;
  padding: 20px;
}
@media screen and (min-width: 1100px){
.container{
    padding-left: 210px;
}
}
@media (min-width: 768px) and (max-width: 1099px) {
  .container.pages {
    padding-left: 220px;
}
}
.kycbox {
    background: #f2f2f2;
   
}

.footer_text_field{
    position: fixed;
    background: none;
    bottom: 0px;
    width: 100%;
    text-align: center
}
  </style>
  
    
    
 <div class="kycbox">
<div class="container pages">
    
  <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb " style="background:#283663;color:#fff;">
            <li class="breadcrumb-item"><a href="<?= base_url();?>" style="color:#fff;">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= $panel_path.'profile';?>" style="color:#fff;">KYC</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color:#fff;">Verification</li>
         </ol>
	   </div>
	    
</div>  
<form action="" method="post" enctype="multipart/form-data" class="kyc_form">
<div class="row">

<div class="col-lg-12">
    <?php
 $userid=$this->session->userdata('user_id');
 $kyc_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");

 
   if($kyc_details && $kyc_details[0]->kyc_status=='submitted'){
  ?>
 <div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong> Information! </strong>kyc request submitted. Please wait for any action.
</div>
<?php

  }?>
  <?php 
   if($kyc_details && $kyc_details[0]->kyc_status=='approved'){?>
    <div class="alert alert-success ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
   }   
   if($kyc_details && $kyc_details[0]->kyc_status=='rejected'){  
?>
       <div class="alert alert-danger ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> KYC Rejected! </strong> Reason : <?= $kyc_details[0]->kyc_remark;?>.
      </div>      
      <?php
    }
?>

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
 
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">Full Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="name" id="name" value="<?= $kyc_details ? $kyc_details[0]->name :'';?>" placeholder="Full Name">
       <span class="text-danger " ><?= form_error('name');?></span>
    </div>
  </div>
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">Bank Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="bank_name" id="bank_name"  value="<?= $kyc_details ? $kyc_details[0]->bank_name :'';?>" placeholder="Bank Name">
       <span class="text-danger " ><?= form_error('bank_name');?></span>
    </div>
  </div>
  
  </div>
  </div>
  <div class="row">
   <div class="col-lg-12">
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">Tax Id/Pan Number</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="tax_id" id="tax_id" value="<?= $kyc_details ? $kyc_details[0]->tax_id :'';?>" placeholder="Tax Id/Pan Number">
      <span class="text-danger " ><?= form_error('tax_id');?></span>
    </div>
  </div>
  
 
    <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">A/c  Holder Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name='account_holder_name' id='account_holder_name' value="<?= $kyc_details ? $kyc_details[0]->account_holder_name :'';?>" placeholder="Account Holder Name">
      <span class="text-danger " ><?= form_error('account_holder_name');?></span>
    </div>
  </div>
  
  </div>
  </div>
  
  <div class="row">
<div class="col-lg-12">
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">DOB</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" name="dob" id="dob" value="<?= $kyc_details ? $kyc_details[0]->dob :'';?>" placeholder="DoB">
       <span class="text-danger " ><?= form_error('dob');?></span>
    </div>
  </div>
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">A/C Number</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="account_no" id="account_no" value="<?= $kyc_details ? $kyc_details[0]->account_no :'';?>" placeholder="Account Number">
      <span class="text-danger " ><?= form_error('account_no');?></span>
    </div>
  </div>
  
  </div>
  </div>
  
  <div class="row">
<div class="col-lg-12">
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">Aadhar No.</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="id_no" id="id_no" value="<?= $kyc_details ? $kyc_details[0]->id_no :'';?>" placeholder="ID No">
      <span class="text-danger " ><?= form_error('id_no');?></span>
    </div>
  </div>
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">IFSC</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?= $kyc_details ? $kyc_details[0]->ifsc_code :'';?>" placeholder="Ifsc Code">
       <span class="text-danger " ><?= form_error('ifsc_code');?></span>
    </div>
  </div>
  
  </div>
  </div>
  <div class="row">
<div class="col-lg-12">
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
    <div class="col-sm-4">
      <textarea type="text" class="form-control" name="address" id="address" placeholder="Address"><?= $kyc_details ? $kyc_details[0]->address :'';?></textarea>
      <span class="text-danger " ><?= form_error('address');?></span>
    </div>
  </div>
  <div class="form-group ">
    <label for="inputPassword" class="col-sm-2 col-form-label">Branch</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="bank_branch" id="bank_branch" value="<?= $kyc_details ? $kyc_details[0]->bank_branch :'';?>" placeholder="Bank Branch">
        <span class="text-danger " ><?= form_error('bank_branch');?></span>
    </div>
  </div>
  
  </div>
  </div>
  <div class="row">

  </div>
  <p>&nbsp;</p>
   <div class="col-lg-12">
  <div class="row">
 
  <div class="col-sm-6">
  <label> Front Image</label>
      <input type="file" name="front_image" class="form-control" id="" placeholder="">
       <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
        <!-- <p class="text-center">Address Proof</p>
         <p class="text-center">(Adhaar Card /Voter Id /DL)</p>-->
         
    </div>
	<div class="col-sm-6">
	<label> Back Image</label>
      <input type="file" name="back_image" class="form-control" id="back_image">
    </div>
    </div>
    
    <div class="row">
          <div class="col-lg-12">
        <p class="text-center">Address Proof</p>
        <p class="text-center">(Adhaar Card /Voter Id /DL/Passport /National Id)</p>
        <div class="col-lg-6">
       <?php
      if($kyc_details && $kyc_details[0]->kyc_status!='pending'){
        ?> 
       <img style="width:100%;" src="<?= $kyc_details[0]->front_image;?>">
     <?php
      }
     ?>
     </div>
     <div class="col-lg-6">
      <?php
      if($kyc_details && $kyc_details[0]->kyc_status!='pending'){
        ?> 
      <img style="width:100%;" src="<?= $kyc_details[0]->back_image;?>">
     <?php
      }
     ?>
     </div>
      </div>
       </div>
    <div class="row">
	<div class="col-sm-6">
	<label>Upload</label>

      <input type="file" class="form-control" name="upload_images" id="" placeholder="">
      <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
      	<p>Tax ID</p>
        <p>(Pan Card)</p>
        <br>
      <?php
      if($kyc_details && $kyc_details[0]->kyc_status!='pending'){
        ?>  
       <img style="width:100%;" src="<?= $kyc_details[0]->upload_images;?>">
    <?php
      }
    ?>
    </div>
	<div class="col-sm-6">
	<label>Account </label>
	  <input type="file" class="form-control" name="account_image" id="" placeholder="">
      <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
      	<p>Cancelled Check / Passbook</p>
       <br>
       <br>
         <?php
      if($kyc_details && $kyc_details[0]->kyc_status!='pending'){
        ?>
         <img style="width:100%;" src="<?= $kyc_details[0]->account_image;?>">
      
    <?php
      }
    ?>
    </div>
  </div>
  </div>
    <?php
   if((!$kyc_details) || ($kyc_details[0]->kyc_status=='pending') ||  ($kyc_details[0]->kyc_status=='rejected')){
  ?>
  
  
    <div class="col-sm-12 text-center" style="margin-top:15px;">
      <button type="submit" class="btn btn-primary " name="kyc_veryfication">Submit</button>
    </div>
     <?php } ?>
  </div>
  </div>
   
    
   
  
  
</form>
</div>
</div>
</div>
<br>
<br>
