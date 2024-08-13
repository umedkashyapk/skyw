            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= $admin_path.'dashboard';?>">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="<?= $admin_path.'settings';?>">Settings</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Payment Request Method</a>
					</li>
					 
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-12 card card-body">
		    
		    
		    
    		<div class="table-responsive">
    		    <table class="table   table-bordered">
    		    <tr>
		          <th>S No.</th>
		          <th>Setting Name</th>
		          <th>Value</th>
		          <th>Edit</th>
            	</tr>
    		    <?php
    		   // echo '<pre>';
    		   // print_r($table_data);
    		   
    		    if($table_data){
    		        $sno=0;
    		        foreach($table_data as $data){
    		            $sno++;
    		            $this_val=$data->status;
    		            //if($st=='1'){
    		                $op1=1;
    		            //}else{
    		                $op2=0;
    		            //}
    		            ?>
    		             <tr>
            		           <td><?= $sno;?>.</td>
            		           <td><?= $data->name;?></td>
            		           <td>
        		                    <div class="bt-switch mt-3">
                                        <input type="checkbox"  <?= $this_val==$op1 ? 'checked':'';?> data-slug="<?= $data->id;?>" name="change_request_payments" data-size="small" class="js-switch change_request_payments_setting" data-color="#008cff" data-on-text="<?= $op1;?>" data-off-text="<?= $op2;?>" data-off-color="danger" />
                                    </div>
                		            <!--<small class="badge badge-info"><?= $op1;?></small>
                		            <small class="badge badge-default"><?= $op2;?></small>-->
                		            <small>On Enable value = "<?= $op1;?>", On Disable value = "<?= $op2;?>"</small> 
            		            </td>
            		           <td><a href="<?= $admin_path.'settings/edits?req_id='.$data->id;?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a></td>

            		      </tr>
    		            <?php
    		        }
    		    }
    		    ?>
    		  </table>
    		</div>
    			
		</div>
		
		<div class="col-md-12 card card-body">
		    <h5>Add New</h5>
    		<div class="col-md-6 card card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <label>Name</label>
				<div class="form-group">
                    <input type="text" class="form-control" name="name" value="" requried>
                </div>
                
				<label> Address</label>
				<div class="form-group">
                    <input type="text" class="form-control" name="address" value="" requried>
                </div>
               
                 <div class="form-group" id="image_div">
                  
                    <input type="file" name="file" class="form-control" aria-describedby="helpId"> 
                  <span class=" " id="file_error"><?= form_error('file_error');?></span>  
                </div>               
                <button type="submit" class="btn btn-primary" name="add_btn" >Add</button>
            </form>
        </div> 
          </div> 
	</div>
 