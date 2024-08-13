
<?php
$profile=$this->session->userdata("profile");
?>
 <div class="container">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Kyc</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kyc</li>
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

    $userid=$this->session->userdata('user_id');
    $adhaar_details=$this->conn->runQuery('*',"user_accounts","status='1' and u_code='$userid'");
   /* echo"<pre>";
   print_r($adhaar_details);
*/
    if($adhaar_details && $adhaar_details[0]->adhaar_kyc_status=='submitted' && $adhaar_details && $adhaar_details[0]->pan_kyc_status=='submitted' && $adhaar_details && $adhaar_details[0]->passport_kyc_status=='submitted' && $adhaar_details && $adhaar_details[0]->bank_kyc_status=='submitted'){
      ?>
      
      <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Information! </strong>kyc verification request submitted. Please wait for any action.
      </div>
      
      <?php
    }

    if($adhaar_details && $adhaar_details[0]->adhaar_kyc_status=='approved' && $adhaar_details && $adhaar_details[0]->pan_kyc_status=='approved' && $adhaar_details && $adhaar_details[0]->passport_kyc_status=='approved' && $adhaar_details && $adhaar_details[0]->bank_kyc_status=='approved'){
      ?>      
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong> Success! </strong>kyc approved.
      </div>      
      <?php
    }

    if($adhaar_details && $adhaar_details[0]->adhaar_kyc_status=='rejected' && $adhaar_details && $adhaar_details[0]->pan_kyc_status=='rejected' && $adhaar_details && $adhaar_details[0]->passport_kyc_status=='rejected' && $adhaar_details && $adhaar_details[0]->bank_kyc_status=='rejected'){
      ?>      
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>kyc verification Rejected! </strong> Reason : <?= $adhaar_details[0]->adhaar_remark;?>.
        <strong>kyc verification Rejected! </strong> Reason : <?= $adhaar_details[0]->pan_remark;?>.
        <strong>kyc verification Rejected! </strong> Reason : <?= $adhaar_details[0]->bank_remark;?>.
      </div>      
      <?php
    }
?>



      <div class="card card-body">
        
            <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
            	<label for="account_type">
					Select Kyc Type
				</label>
				<select name="account_types" class="form-control" id="account_type" onchange="return document_control();">
				    <option value="">Select Type</option>
				    <option value="id_card" >Adhaar/Pan/Bank</option>
				    <option value="pass_id" >Passport Id</option>
				   
				 </select>
				</div> 
				<div id='image_div' style='display:none;'>
				    <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" value="<?= $adhaar_details ? $adhaar_details[0]->adhaar_name :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('name');?></span>             
                </div>
                 <div class="form-group">
                  <label for="">Addhaar No.</label>
                  <input type="text" name="adhaar_no" id="adhaar_no" value="<?= $adhaar_details ? $adhaar_details[0]->adhaar_no :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  <span class="text-danger " ><?= form_error('adhaar_no');?></span>
                </div>
                
                 <div class="form-group">
                  <label for="">Pan No.</label>
                  <input type="text" name="pan_no" id="pan_no" value="<?= $adhaar_details ? $adhaar_details[0]->pan_no :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  <span class="text-danger " ><?= form_error('pan_no');?></span>
                </div>
                <div class="form-group">
                  <label for="">Adhaar Document</label>
                  <input type="file" name="adhaar_image" id="adhaar_image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
                </div>
                <div class="form-group">
                  <label for="">Pan Document</label>
                  <input type="file" name="pan_image" id="pan_image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
                </div>
                <div class="form-group">
                  <label for="">Bank Document</label>
                  <input type="file" name="bank_image" id="bank_image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
                </div>
                 
                 </div>
                 
                 
                 <div id='images_div' style='display:none;'>
                  <div class="form-group">
                      <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" value="<?= $adhaar_details ? $adhaar_details[0]->adhaar_name :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('name');?></span>             
                </div>
                  <label for="">Passport No.</label>
                  <input type="text" name="passport_no" id="passport_no" value="<?= $adhaar_details ? $adhaar_details[0]->passport_no :'';?>" class="form-control" placeholder="" aria-describedby="helpId">
                  <span class="text-danger " ><?= form_error('passport_no');?></span>
                </div>    
                <div class="form-group">
                  <label for="">Passport Document</label>
                  <input type="file" name="pass_image" id="pass_image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
                </div>
                <div class="form-group">
                  <label for="">Bank Document</label>
                  <input type="file" name="bank_image" id="bank_image" value="" class="form-control" placeholder="" aria-describedby="helpId">
                  <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
                </div>
                 </div>
                 </div>
                
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
               <div class="card text-center">
                   <div class="card-header">Bank Detail</div>
               </div>
                <div class="form-group">
                  <label for="">Bank Name</label>
                  <input type="text" name="bank_name" value="<?= $adhaar_details ? $adhaar_details[0]->bank_name :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('bank_name');?></span>             
                </div> 
                 <div class="form-group">
                  <label for="">Account Holder Name</label>
                  <input type="text" name="account_holder_name" value="<?= $adhaar_details ? $adhaar_details[0]->account_holder_name :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('account_holder_name');?></span>             
                </div>
                
                <div class="form-group">
                  <label for="">Account No.</label>
                  <input type="text" name="account_no" value="<?= $adhaar_details ? $adhaar_details[0]->account_no :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('account_no');?></span>             
                </div> 
                 <div class="form-group">
                  <label for="">Ifsc Code.</label>
                  <input type="text" name="ifsc_code" value="<?= $adhaar_details ? $adhaar_details[0]->ifsc_code :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('ifsc_code');?></span>             
                </div> 
                <div class="form-group">
                  <label for="">Branch Name.</label>
                  <input type="text" name="bank_branch" value="<?= $adhaar_details ? $adhaar_details[0]->bank_branch :'';?>" class="form-control" placeholder="" aria-describedby="helpId" >  
                  <span class=" text-danger" ><?= form_error('bank_branch');?></span>             
                </div>
                    
                  </div>     
                <?php
                   if((!$adhaar_details) || ($adhaar_details[0]->adhaar_kyc_status=='pending') ||  ($adhaar_details[0]->adhaar_kyc_status=='rejected')){
                ?>
                  <button type="submit" class="btn btne" name="kyc_btn">Save</button>
                <?php 
                    }  
                ?>
                   </div>    
            </form>
        <?php
       
       if($adhaar_details && $adhaar_details[0]->account_type=='id_card'){
        ?>
       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
            <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
          <?php
          if($adhaar_details && $adhaar_details[0]->adhaar_kyc_status!='pending'){
            ?>
            <div class="card">
              <div class="card-header">
              Adhaar-image
              </div>
              <div class=" card-body">          
                <img style="width:100%;" src="<?= $adhaar_details[0]->adhaar_image;?>">
              </div>
            </div>
            <?php
          }      
          ?>
          </div>
           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
          <?php
          if($adhaar_details && $adhaar_details[0]->pan_kyc_status!='pending'){
            ?>
            <div class="card">
              <div class="card-header">
              Pan-image
              </div>
              <div class=" card-body">          
                <img style="width:100%;" src="<?= $adhaar_details[0]->pan_image;?>">
              </div>
            </div>
            <?php
          }      
          ?>
          </div>
           <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
          <?php
          if($adhaar_details && $adhaar_details[0]->bank_kyc_status!='pending'){
            ?>
            <div class="card">
              <div class="card-header">
              Bank-image
              </div>
              <div class=" card-body">          
                <img style="width:100%;" src="<?= $adhaar_details[0]->bank_img;?>">
              </div>
            </div>
            <?php
          }      
          ?>
          </div>
          
         </div>
         </div>
         <?php
          }elseif($adhaar_details && $adhaar_details[0]->account_type=='pass_id'){
              ?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
            <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
          <?php
          if($adhaar_details && $adhaar_details[0]->passport_kyc_status!='pending'){
            ?>
            <div class="card">
              <div class="card-header">
              Passport-image
              </div>
              <div class=" card-body">          
                <img style="width:100%;" src="<?= $adhaar_details[0]->passport_img;?>">
              </div>
            </div>
            <?php
          }      
          ?>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
          <?php
          if($adhaar_details && $adhaar_details[0]->bank_kyc_status!='pending'){
            ?>
            <div class="card">
              <div class="card-header">
              Bank-image
              </div>
              <div class=" card-body">          
                <img style="width:100%;" src="<?= $adhaar_details[0]->bank_img;?>">
              </div>
            </div>
            <?php
          }      
          ?>
          </div>  
          
         </div>
         </div>  
              
              
              
              
              <?php
          }      
          ?>
 <script>
    function document_control(){
        var ducument =$("#account_type" ).val();
        if(ducument=='id_card'){
            $("#image_div").show(); 
             $("#images_div").hide();
           }else if(ducument=='pass_id'){
           $("#images_div").show();
             $("#image_div").hide(); 
        }
         
    }
    </script>