  <br>
			<nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Video</a>
					</li>
					<li class="breadcrumb-item active">
					    Video	Notification
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
			<form action="" method="post" role="form" enctype="multipart/form-data">
			        
			      <!--  <div class="form-group">
					<select class="form-control" name="subject" id="subject">
					<option value="">Select</option>
					<option value="ENGLISH SPEAKING COURSES">ENGLISH SPEAKING COURSES</option>
					<option value="COMPUTER BASIC COURSES">COMPUTER BASIC COURSES</option>
					<option value="ACCOUNTANT BASIC COURSES">ACCOUNTANT BASIC COURSES</option>
					<option value="MAKEUP ARTIST COURSES">MAKEUP ARTIST COURSES</option>
					<option value="WEB DISIGNING COURSES">WEB DISIGNING COURSES</option>
					<option value="AUTO CAD DESIGNING COURSES">AUTO CAD DESIGNING COURSES</option>
					<option value="COMPUTER SOFTWARE & HARDWARE COURSES">COMPUTER SOFTWARE & HARDWARE COURSES</option>
					<option value="SKILL DEVELOPMENT COURSE">SKILL DEVELOPMENT COURSE</option>
					<?= form_error('subject');?>
				</div>-->
				
			
				<div class="form-group">
					<input type="text" name="title" value="<?= set_value('title');?>" class="form-control"  placeholder="Enter Title"> 
					<?= form_error('title');?>
				</div>
				<div class="form-group">
				    <textarea name="description" class="form-control summernote"><?= set_value('description');?></textarea>
					<span class="text-danger"><?= form_error('description');?></span>
				</div>
				
				<!--<div class="form-group">
				    <p>Eg.https://www.youtube.com/embed/IrUDB0IZzVs<p>
				   	<input type="text" name="video" value="<?= set_value('video');?>" class="form-control"  placeholder="Enter Youtube Link">
					<span class="text-danger"><?= form_error('video');?></span>
				</div>-->
				
				
				<div class="form-group">
				<lable>Upload Video</lable>
				 <input type="file" name="pro_video" id="pro_video" value="" class="form-control" placeholder="" aria-describedby="helpId">
					 <small id="helpId" class=" text-danger  "><?= (isset($upload_error) ? $upload_error:'');?></small>
				</div>
				
				<input type="submit" class="btn btn-primary btn-remove" value="Submit" name="add_video_btn" />
				 
			</form>
		</div>
	</div>
	
	
 