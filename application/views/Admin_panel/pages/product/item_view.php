<?php
$item_details=$this->conn->runQuery('*','franchise_orders',"id='$product_id'");
 
$t_data=$item_details[0];
?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">  Product Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Franchise</a></li>            
            <li class="breadcrumb-item"><a href="#"> Pending</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Product Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Product Detail</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
       

<div class="table-responsive">
<table class="table table-hover">
        <?php
         
          $tx_profile=$this->profile->franchise_info($t_data->f_code);
          
        ?>		
        
            <tr>               
                <th> Franchise Name</th><td>:</td><td><?= $tx_profile->franchise_name;?></td>
            </tr>
            <tr>               
                <th> Franchise Details</th><td>:</td><td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
            </tr>
            <tr>
                <th>Total MRP </th><td>:</td><td><?= $t_data->order_mrp;?></td>  
                </tr>
            <tr>
                <th>Total Dp</th><td>:</td><td><?= $t_data->order_amount;?></td>  
                </tr>
            <tr>
                <th>Total BV</th><td>:</td><td><?= $t_data->order_bv;?></td>  
                </tr>
                     
          
            <tr>
                
                
                <th>Status </th><td>:</td><td><span class="badge badge-warning badge-sm"><?= $t_data->status==1 ? 'Delivered':'Pending';?></span></td> 
                </tr>
            
         
        
    </table>
    
</div>



   
    </div>
     
	    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
	        <form action="" method="post">
	           <!-- <div class="form-group">
	              <label for="">Remark*</label>
	              <textarea name="remark" id="" class="form-control"></textarea>
	              <small class="text-muted"><?= form_error('reason');?></small>
	            </div>-->
	            
	            
	            <div class="form-group"> 		           
	        		<button type="submit" name="approve_btn" class="btn btn-success">Approve</button>		         
	            </div>
	    	</form>
	    </div>
	   
</div>
