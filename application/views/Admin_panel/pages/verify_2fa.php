<!DOCTYPE html>
<html lang="en">

 <!--Mirrored from codervent.com/rukada/color-admin/authentication-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 22 Jan 2020 17:53:52 GMT -->
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
  <!--<link href="<?= $panel_url;?>assets/css/bootstrap.min.css" rel="stylesheet"/>-->
  <!-- animate CSS-->
  <!--<link href="<?= $panel_url;?>assets/css/animate.css" rel="stylesheet" type="text/css"/>-->
  <!-- Icons CSS-->
  <!--<link href="<?= $panel_url;?>assets/css/icons.css" rel="stylesheet" type="text/css"/>-->
  <!-- Custom Style-->
  <!--<link href="<?= $panel_url;?>assets/css/app-style.css" rel="stylesheet"/>-->
   <link href="https://gambitbot.io/Admin_panel/a1/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="https://gambitbot.io/Admin_panel/a1/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="https://gambitbot.io/Admin_panel/a1/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="https://gambitbot.io/Admin_panel/a1/assets/css/app-style.css" rel="stylesheet"/>
  
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
		  <div class="card-title text-uppercase text-center py-3">Verify 2FA</div>
		    <form action="get_verify_2fa" method="post">
			  <div class="form-group">
			  <label for="exampleInputPassword" class="">2FA Code</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="exampleInputPassword" name="2fa_code" class="form-control input-shadow" placeholder="Enter 2FA Code" required>
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			
			 <button type="submit" name="verify" class="btn btn-primary shadow-primary btn-block waves-effect waves-light">Verify Now</button>
			  
			 
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
