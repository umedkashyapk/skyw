<div class="">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="">Member</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Success</li>
         </ol>
	   </div>
	 
</div>

<div class="container">
				<div class="row">
				<div class="col-lg-3">
					 </div>
                     <div class="col-lg-6" style="background-color:#1e375a;padding:20px;margin-top:90px;">
                        <div class="tm-breadcrumb">
                            <h4 class="title text-center text-white" style="color:white">Success</h4>
							<h4 class="date text-white text-center" style="color:white"><?= date('Y-m-d H:i:s');?></h4>
                           <center><?php 
							 $success['param']='success';
							 $success['alert_class']='alert-success';
							 $success['type']='success';
							 echo "<h4 style='color:white;'> Your Account has been registered.<br> You can login now.<br> Username : ".$_GET['username']." <br> Password :".$_GET['pass']."</h4>";
							  //$this->show->show_alert($success);
								?></center>
							<!--	<a class="btn btn-danger btn-block text-center" href="login">Login</a><p>&nbsp;</p><a class="btn btn-danger btn-block text-center" href="register">Register</a>-->
                        </div>
                    </div>
					<div class="col-lg-3">
					 </div>
                </div>
			</div>
</div>
