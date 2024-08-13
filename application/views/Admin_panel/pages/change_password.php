<?php

if(!isset($_SESSION['forgot_user'])){
    
   redirect(base_url('admin/forgot'),"refresh");
    die();
}

if($_SESSION['forgot_otp_verified']!==true){
    
   redirect(base_url('admin/verify'),"refresh");
    die();
}

 if(isset($_POST['change_btn'])){
    
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[password]');
    $update['password'] = md5($_POST['password']);
    if($this->form_validation->run() != False){
        
        $this->db->where('id',$_SESSION['forgot_user']);
        $this->db->update('admin',$update);

        unset($_SESSION['forgot_otp']);
        unset($_SESSION['forgot_user']);
        unset($_SESSION['forgot_otp_verified']);

        $this->session->set_flashdata('success'," Password successfully Changed.");
        redirect(base_url('admin/forgot'),"refresh");
        
    }

 }

 ?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/rukada/color-admin/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Jan 2020 17:53:52 GMT -->
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title><?= $this->conn->company_info('company_name');?></title>
  <!--favicon-->
  <link rel="icon" href="<?= $this->conn->company_info('symbol');?>" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="<?= $panel_url;?>assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?= $panel_url;?>assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?= $panel_url;?>assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="<?= $panel_url;?>assets/css/app-style.css" rel="stylesheet"/>
  
</head>

<body class="bg-dark">
 <!-- Start wrapper-->
 <div id="wrapper">
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		 	<div class="text-center">
		 		<img src="<?= $this->conn->company_info('logo');?>" class="logo-icon" alt="<?= $this->conn->company_info('company_name');?>" style="width:<?= $this->conn->company_info('logo_width');?>;height:<?php echo $this->conn-> company_info('logo_height');?>">
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
		  <div class="card-title text-uppercase text-center py-3">Verify</div>
		    <form action="" method="post">
			  <div class="form-group">
			  <label for="exampleInputUsername" class="">Forgot Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputUsername" name="password" class="form-control input-shadow" placeholder="Enter Password">
				 
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  
			   <div class="form-group">
		
			   <div class="position-relative has-icon-right">
				  <input type="text" id="exampleInputUsername" name="confirm_password" class="form-control input-shadow" placeholder="Enter Confirm Password">
				 
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  
			<button type="submit" name="change_btn" class="btn btn-primary shadow-primary btn-block waves-effect waves-light btn-remove">Verify</button>
			</form>
		   </div>
		  </div>
		  
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="<?= $panel_url;?>assets/js/jquery.min.js"></script>
  <script src="<?= $panel_url;?>assets/js/popper.min.js"></script>
  <script src="<?= $panel_url;?>assets/js/bootstrap.min.js"></script>
  
</body>

</html>
