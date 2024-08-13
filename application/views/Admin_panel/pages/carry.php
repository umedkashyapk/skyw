 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Dummy Power</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Fund</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Dummy Power Add</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Dummy Power</h6>
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
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="card card-body">
        <form action="" method="post">

       <div class="form-group">
              <label for="">Username</label>
              <input type="text" name="tx_username" value="<?= set_value('tx_username');?>" data-response="username_res" class="form-control check_username_exist"  placeholder="Enter Username" aria-describedby="helpId"> 
              <span class=" " id="username_res"><?= form_error('tx_username');?></span>             
            </div>
             <div class="form-group">
                <label for="">Select Position</label>
                <select name="selected_Position" id="" class="form-control">
                    
                    <option value="1">Left</option>
                    <option value="2">Right</option>
                </select>
                </div>
             <div class="form-group">
              <label for="">Enter Dummy Power</label>
              <input type="number" name="carry" id="carry" value="<?= set_value('carry');?>" class="form-control" placeholder="Enter Carry" aria-describedby="helpId">
              <span class=" "><?= form_error('carry');?></span>  
            </div>
            <button type="submit" class="btn btn-primary btn-remove" name="carry_btn">Add</button>
          
        </form>
    </div>
    </div>
</div>
