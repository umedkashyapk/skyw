<div class="user_content">
        <div class="container">
            <div class="row">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home /</a></li>
            <li class="breadcrumb-item"><a href="<?= $panel_path.'profile';?>">Profile /</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Transaction Password</li>
         </ol>
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

	    
</div>

            <div class="user_main_card mb-3">
            <form id="" action="" method="post">
                <div class="user_card_body user_content_page">
                    <div class="card_body_header_content">
                     <h3 class="user_card_title">Change Tx Password</h3>
                    </div>
                     <div class="user_form_row user_form_content">
                         <div class="row">
                         <div class="col-lg-12 mb-3">
                           <label class="label_user_title">Old Transaction Password</label>
                               <div class="input-group ">
                                <input name="old_password" type="password"  id="old_password" class="form-control user_input_text" placeholder="Old Transaction Password">
                                  
                               </div>
                                <span class="text-danger"><?php echo form_error('old_password');?></span>
                         </div>
                         <div class="col-lg-12 mb-3 ">
                           <label class="label_user_title">Transaction Password</label>
                               <div class="input-group ">
                                <input name="tx_password" type="text" id="tx_password" class="form-control user_input_text" placeholder="Transaction Password">
                               </div>
                               <span class="text-danger"><?php echo form_error('tx_password');?></span>
                         </div>
                         
                         
                         <div class="col-lg-12 mb-3">
                           <label class="label_user_title">Confirm Transaction Password</label>
                               <div class="input-group ">
                                   <input name="tx_confirm_password" type="password" id="tx_confirm_password" class="form-control user_input_text" placeholder="Confirm Transaction Password">
                               </div>
                               <span class="text-danger"><?php echo form_error('tx_confirm_password');?></span>
                         </div>
                        </div>
                     
               </div>
                <div class="user_form_row_data user_form_content ">
                    <div class="user_submit_button mb-2 mt-2">
                        <input type="submit" name="tx_password_btn" value="Change Password" id="" class="user_btn_button">
                    </div>
                    
                </div>
           </div>
           </form>
        </div>
          <p>A strong Transaction password:</p>
    	  <p>* Is at least eight characters long.</p>
    	  <p>* Does not contain your user name, real name, or company name.</p>
    	  <p>* Does not contain a complete word.</p>
    	  <p>* Is significantly different from previous passwords.</p>


    </div>
</div><br><br>