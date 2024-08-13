<style>
    section.header_top {
    background: #000 !important;
}
a.tm-button.btn-block.text-center {
    width: 100%;
    display: block;
    background: #ffa419;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
    margin-bottom:10px;
}
h4.title.text-center.text-white {
    font-size: 36px;
}
h4.date.text-white.text-center{
    font-size:18px;
}
</style>


<!-- Breadcrumb Area -->
        <div class="tm-breadcrumb-area tm-padding-section" data-bgimage="<?= $panel_url;?>assets/images/bg/breadcrumb-bg-2.jpg">
            <div class="container">
                <div class="row">
				<div class="col-lg-3">
					 </div>
                    <div class="col-lg-6" style="background-color:#444444;padding:20px; margin-top: 40px;margin-bottom:40px;
    border-radius: 4px;">
                        <div class="tm-breadcrumb">
                            <h4 class="title text-center text-white">Success</h4>
							<h4 class="date text-white text-center"><?= date('Y-m-d H:i:s');?></h4>
                           <center><?php 
							 $success['param']='success';
							 $success['alert_class']='alert-success';
							 $success['type']='success';
							// echo "<h4 style='color:white;'> Your Account has been registered.<br> You can login now.Full Name : ".$_GET['name']." <br> Username : ".$_GET['username']." <br> Password :".$_GET['pass']."</h4>";
							   echo "<h4 style='color:white;font-size:20px;'> Your Account has been registered.<br> You can login now.<br>Full Name: ".$_GET['name']." <br> Username: ".$_GET['username']." <br> Password :".$_GET['pass']."</h4>";
							  //$this->show->show_alert($success);
								?></center>
								<a class="tm-button btn-block text-center" href="login">Login</a><a class="tm-button btn-block text-center" href="register">Register</a>
                        </div>
                    </div>
					<div class="col-lg-3">
					 </div>
                </div>
            </div>
        </div>
        <!--// Breadcrumb Area -->
