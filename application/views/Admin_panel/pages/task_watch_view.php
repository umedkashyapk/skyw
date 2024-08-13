<?php
 $order_details=$this->conn->runQuery('*','task_data_request',"id='$task_id' and type='watch_ads'")[0];
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Product request Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> request</a></li>            
            <li class="breadcrumb-item"><a href="#"> All</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  request Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> request Detail</h6>
<hr>

<div class="row">
  
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
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
<div class="table-responsive">
<table class="table table-hover">
        <?php
        $user_id=$order_details->u_code;
        $profile=$this->profile->profile_info($user_id);
        
        ?>
            <tr>               
                <th> User</th><td>:</td><td><?= $profile->username;?> </td>
            </tr>
            <tr>
                <th>Product Name</th><td>:</td><td><?= $order_details->product_name;?></td>  
                </tr>
            <tr>
                <th>Product Mrp</th><td>:</td><td><?= $order_details->product_mrp;?></td>  
           </tr>
           
             <tr>
                <th>Product Description</th><td>:</td><td><?= $order_details->product_description;?></td>  
           </tr>
             
            <tr>
                <th>Date </th><td>:</td><td><?= $order_details->added_on;?></td>  
                 
            </tr>
            
            
            <!--<tr>-->
            <!--    <th><b> Shipping Address</b> </th><td>:</td><td> <?= $shippingaddress->first_name; ?> <?= $shippingaddress->last_name; ?> <br>-->
            <!--    <?= $shippingaddress->email; ?><br>-->
            <!--    <?= $shippingaddress->address; ?><br>-->
            <!--    <?= $shippingaddress->address2; ?><br>-->
            <!--    <?= $shippingaddress->Country; ?><br>-->
            <!--    <?= $shippingaddress->State; ?><br>-->
            <!--    <?= $shippingaddress->zip; ?><br>-->
            <!--    <?= $shippingaddress->pan_no; ?><br>-->
            <!--    </td>  -->
                 
            <!--</tr>-->
           
           
           
        
    </table>
    
  
</div>



   
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        
        <form action="" method="post">
            <div class="form-group">
              <label for="">Request Status</label>
              <select name="req_status" class="form-control">
                  <option value="0" <?= ($order_details->req_status=='0' ? 'selected':'');?> >Pending</option>
                  <option value="1" <?= ($order_details->req_status=='1' ? 'selected':'');?>>Approve</option>
              </select>
              <small class="text-muted"><?= form_error('req_status');?></small>
            </div>
            <?php
            if($order_details->req_status=='0'){
            ?>
            <div class="form-group">  
        <button type="submit" name="approve_btn" class="btn btn-success">Save </button>
         
            </div>
            
            <?php
            }
            ?>
    </form>
   
    
    </div>
</div>
