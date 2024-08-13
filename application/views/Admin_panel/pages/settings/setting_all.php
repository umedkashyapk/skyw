<?php 
 $req_id=$_GET['req_id'];
 $all_paypal=$this->conn->runQuery('*','payment_method',"id='$req_id'");
?>         
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
						<a href="#">Edit</a>
					</li>
					 
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-6 card card-body">
            <form action="" method="post" enctype="multipart/form-data">
				<label> Address</label>
				<div class="form-group">
                    <input type="text" class="form-control" name="address" value="<?= $all_paypal[0]->address; ?>">
                </div>
                <div class="form-group">
                    <img src="<?= $all_paypal[0]->image; ?>" style="height:200px;width:400px;">   
                </div>
                 <div class="form-group" id="image_div">
                  
                    <input type="file" name="file" class="form-control" aria-describedby="helpId"> 
                  <span class=" " id="file_error"><?= form_error('file_error');?></span>  
                </div>               
                <button type="submit" class="btn btn-primary" name="edit_btn" >Edit</button>
            </form>
       
          </div>                 
    		
		</div>
	</div>
 