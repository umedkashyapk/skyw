<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Watch Ads</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Ads</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Add Ads</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Add Watch Ads</h6>
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
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card card-body">
            <form  action="" method="post" enctype="multipart/form-data">
                <div class="row">                                           
				    <div class="col-md-6">
                        <div style="padding-top:10px;" class="row">											
						    <div class="col-md-12">  <label  class="">Ads Name</label></div>
							<div class="col-md-12">
								 <input class="form-control" id="task_name" name="task_name" type="text"  class="" placeholder="Ads name" required="" >
								 <span class=" " ><?= form_error('task_name');?></span>
							</div>												
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div style="padding-top:10px;" class="row">											
							<div class="col-md-12">  <label  class="">Ads Image</label></div>
							<div class="col-md-12">
							     <input type="file" class="form-control" id="task_image" name="task_image">
							</div>
                        </div>
                        </div>
                        	<div class="col-md-6">    
					    <div style="padding-top:10px;" class="row">											
						    <div class="col-md-12">  <label  class="">Product Name</label></div>
								<div class="col-md-12">
									<input  type="text" class="form-control" name="product_name" required="" value="" placeholder="Enter product name">
									<span class=" " ><?= form_error('product_name');?></span>
								</div>
					    </div>
                    </div>
                    	<div class="col-md-6">    
					    <div style="padding-top:10px;" class="row">											
						    <div class="col-md-12">  <label  class="">Product Mrp</label></div>
								<div class="col-md-12">
									<input type="number" class="form-control" name="product_mrp" required="" value="" placeholder="Enter product Mrp">
									<span class=" " ><?= form_error('product_mrp');?></span>
								</div>
					    </div>
                    </div>
                    	<div class="col-md-6">    
					    <div style="padding-top:10px;" class="row">											
						    <div class="col-md-12">  <label  class="">Product Description</label></div>
								<div class="col-md-12">
									<textarea type="text" class="form-control" name="product_description" required="" value="" placeholder="Enter product description"></textarea>
									<span class=" " ><?= form_error('product_description');?></span>
								</div>
					    </div>
                    </div>
                 <div class="col-md-6">
                    <div style="padding-top:10px;" class="row">										
						  <div class="col-md-12">  <label  class="">Product  Link</label></div>
							<div class="col-md-12">
							 <input class="form-control" id="product_link" name="product_link" type="text"  class="" placeholder="Enter Product Link" required="" value="">
								 <span class=" " ><?= form_error('product_link');?></span>
						</div>											
                   </div>
                </div>
				
                    
                    <div class="col-md-6">  
						<div style="padding-top:10px;" class="row">											
							<div class="col-md-12">  <label  class="">Ads Date</label></div>
								<div class="col-md-12">
									 <input class="form-control" id="task_date" name="task_date" type="date"  class="" placeholder="Date" >
									 
								</div>
							
                        </div>
                      
                        <div >
                         
                        </div>  
                    </div>
                </div>
     <!--          <div class="row">                                           -->
				    
					<!--<div class="col-md-6">  											   -->
					<!--	 <div style="padding-top:10px;" class="row">											-->
					<!--		<div class="col-md-5"> <label  class="">Ads Link Type</label></div>-->
					<!--			<div class="col-md-12">-->
					<!--			     <select class="form-control" name="task_type" required="">-->
					<!--			         <option value="">Select Link</option>-->
					<!--			         <option value="website">Website Link</option>-->
					<!--			         <option value="youtube">You-tube Link</option>-->
					<!--			         <option value="telegram">Telegram Link</option>-->
					<!--			      </select>-->
					<!--			      <span class=" " ><?= form_error('task_type');?></span>-->
					<!--			</div>												-->
     <!--                   </div>-->
     <!--               </div>-->
     <!--           </div>-->
				<div class="row"> 
                    <div class="col-md-12"> 
                        <div style="padding-top:40px;" class="col-lg-12 m-b-30">
                            <div class="form-group">
                                <center><input style="" type="submit"class="btn btn-success"  name="add_btn" id="change_pass_btn" value="Submit" >
								 </center>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
        <div class="card card-body">
            <div class="table-responsive">
                <table id="aaa" class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Ads Name</th> 
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Product Mrp</th>
                            <th>Product Description</th>
                            <!--<th>Product Link</th>-->
                            
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php 
                    
                    if(!empty($table_data)){
                        foreach($table_data as $arr){
                    ?>
                        <tr>
                            <td align="center"><?php echo $arr['id'];?></td>
                            <td align="center"><?php echo $arr['heading1'];?></td>
                            <td align="center"><a href="<?= $arr['task_image'];?>" target="_blank"><img src="<?= $arr['task_image'];?>" style="height:50px;width:50px"></a></td>  
                           <td align="center"><?php echo $arr['product_name'];?></td>
                           <td align="center"><?php echo $arr['product_mrp'];?></td>
                           <td align="center"><?php echo $arr['product_description'];?></td>
                            <td align="center"><?php echo $arr['task_time'];?></td>
                              <td align="center">
                                
                                  <a  onclick="return confirm('Are you sure you want to delete this item?');" href="<?= $admin_path.'task/enable?task_id='.$arr['id'];?>" class="btn btn-info btn-sm green">Delete</a>
                                 
                             </td>
                        </tr>
                    <?php  }
                        
                         	
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div>    
    </div>
    
    
</div>
