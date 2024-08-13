 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Add Bank Detail</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Add Bank</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Add Bank Detail</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Bank Detail</h6>
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
                    ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card card-body">
        <form action="" method="post">

       
            <div class="form-group">
              <label for="">Account Holder Name</label>
              <input type="text" name="account_holder_name" value="<?= set_value('account_holder_name');?>" class="form-control"  placeholder="Enter Username" aria-describedby="helpId"> 
              <span class=" " id="username_res"><?= form_error('account_holder_name');?></span>             
            </div>
            <div class="form-group">
              <label for="">Account Number</label>
              <input type="text" name="account_no" id="account_no" value="<?= set_value('account_no');?>" class="form-control" placeholder="Enter Account Number" aria-describedby="helpId">
              <span class=" " ><?= form_error('account_no');?></span>  
            </div>
              <div class="form-group">
              <label for="">Bank Name</label>
              <input type="text" name="bank_name" id="bank_name" value="<?= set_value('bank_name');?>" class="form-control" placeholder="Enter Bank Name" aria-describedby="helpId">
              <span class=" " ><?= form_error('bank_name');?></span>  
            </div>
            
              <div class="form-group">
              <label for="">Branch Name</label>
              <input type="text" name="bank_branch" id="bank_branch" value="<?= set_value('bank_branch');?>" class="form-control" placeholder="Enter Branch Name" aria-describedby="helpId">
              <span class=" " ><?= form_error('bank_branch');?></span>  
            </div>
            
            <div class="form-group">
              <label for="">Ifsc Code</label>
              <input type="text" name="ifsc_code" id="ifsc_code" value="<?= set_value('ifsc_code');?>" class="form-control" placeholder="Enter Ifsc Code" aria-describedby="helpId">
              <span class=" " ><?= form_error('ifsc_code');?></span>  
            </div>
            
            
           
             <button type="submit" class="btn btn-primary" name="add_bank_btn">Add Bank Detail</button>
                  
           


        </form>
    </div>
    </div>
</div>
