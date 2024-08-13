  <br>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Message</a>
					</li>
					<li class="breadcrumb-item active">
					    Send Message
					</li>
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-6 card card-body">
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
		   <?php echo validation_errors(); ?>
			<form action="" method="post" role="form">
				 
				<div id="user_type_id" class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="tx_username" value="<?= set_value('tx_username');?>" data-response="username_res" class="form-control check_username_exist"  placeholder="Enter Username"> 
                    <span class=" " id="username_res"><?= form_error('tx_username');?></span>
				</div>
				 
				<div class="form-group">
				    <textarea name="message" class="form-control "><?= set_value('message');?></textarea>
					<span class="text-danger"><?= form_error('message');?></span>
				</div>
				
				<input type="submit" class="btn btn-primary" value="Send Message" name="send_btn" />
				 
			</form>
		</div>
	</div>
	
	
 