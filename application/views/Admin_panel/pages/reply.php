  

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
    ?>

<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Auto Reply</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Reply</a></li>            
  
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Add Auto Reply</h6>
<hr>

<div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <form action="" method="post">
            
            <div class="form-group">
                <Select class="form-control" name='type'>
                    <option>Select Type</option>
                    <option value='withdrawal'>Withdrawal</option>
                    <option value='support'>Support</option>
                </Select>
              
            </div>
            <div class="form-group">
              <label for="">Auto Reply</label>
              <textarea name="massage" id="" class="form-control"></textarea>
              
            </div>
            <div class="form-group">  
        <button type="submit" name="reply_msg" class="btn btn-success">Submit</button>
        
            </div>
    </form>
    </div>
</div>
