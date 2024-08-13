 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		   
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Captcha</a></li>            
            
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>

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
    
    //print_r($captcha1);
    ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="card card-body">
        <form action="" method="post">
           <div class="form-group">
              
            <input type="image"  src="<?php echo base_url().'images/'.$captcha1['filename'];?>"  alt="Submit" width="150" height="50">
             <input  type="hidden" name="captcha1" value="<?php echo $captcha1['word'];?>">
            </div>
             <div class="form-group">
           
            <input type="text" class="form-control" name="captcha" required="" placeholder="Enter Captcha Code*" class="contact-frm">
         </div>
           
            <button type="submit" class="btn btn-primary" name="captcha_btn">Submit Captcha</button>
            </form>
    </div>
    </div>
</div>
