<div class="row pt-2 pb-2">
        <div class="col-sm-12">

		    <h4 class="page-title">   Subadmin </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Subadmin Edit</a></li>
            
         </ol>
	   </div>
	 
     </div>
<?php 
         $success['param']='alert_success';
         $success['alert_class']='alert-success';
         $success['type']='success';
          $this->show->show_alert($success);
           ?>
             <?php 
         $erroralert['param']='alert_error';
         $erroralert['alert_class']='alert-danger';
         $erroralert['type']='error';
         $this->show->show_alert($erroralert);
         $sub_admin_detail=$this->conn->runQuery('*','admin',"id='$edit_id'");
         $sub_admin_user=$sub_admin_detail[0]->user;
         
           ?>
     <div class="row">       
 <div class="col-md-4 card bg-light">

        <div class="card-header">
          Add Subadmin Edit
        </div>
        <div class="card-body">
       <form action="" method="POST">
            <div class="form-group">
             <label for="input-11">Username</label>
             <input type="text" class="form-control input-shadow bg-white" value="<?= $sub_admin_user;?>" name="username" id="input-11" required />
            <?php echo form_error('username');?>
            </div>
           <div class="form-group">
             <button type="submit" class="btn btn-dark shadow-dark px-5" name="edit_admin_btn"><i class="icon-lock"></i> Add Subadmin Edit</button>
           </div>
           </form>
        </div>
    </div> 
     </div>       
           
           
           
           
           
           
           
           
           
           
           