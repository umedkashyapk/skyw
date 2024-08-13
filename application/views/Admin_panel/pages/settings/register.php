            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= $panel_url.'dashboard';?>">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Settings</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Register</a>
					</li>
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-6 card card-body">
		 <?php
		 $get_all_data=$this->conn->runQuery('*','advanced_info',"title='Registration'");
		 if($get_all_data){
		     
		     foreach($get_all_data as $setting_data){
		         ?>
		         <div class="form-group">
		             <label><?= $setting_data->name;?></label>
		             <?php
		             if($setting_data->type=="array"){
		                 
		                 $all_value=explode(',',$setting_data->options);
		                 ?>
		                 <select name="<?= $setting_data->label;?>" class="form-control">
		                     <?php
		                     if(!empty($all_value)){
		                         foreach($all_value as $val){
    		                         ?>
    		                         <option value="<?= $val;?>" <?= $val==$setting_data->value ? 'selected':'';?> ><?= $val;?></option>
    		                         <?php
    		                     }
		                     }
		                     
		                     ?>
		                     
		                 </select>
		                 <?php
		             }else{
		                 ?>
		                 <input type="text" name="<?= $setting_data->label;?>" class="form-control" value="<?= $setting_data->value;?>">
		                 <?php
		             }
		             ?>
		         </div>
		         <?php
		     }
		     
		 }
		 
		 ?>
		 <input type="submit" name="sub_btn" class="btn btn-info" value="Change" />
		</div>
	</div>
 