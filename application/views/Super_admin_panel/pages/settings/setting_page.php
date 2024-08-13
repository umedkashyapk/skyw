            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= $super_admin_path.'dashboard';?>">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="<?= $super_admin_path.'settings';?>">Settings</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#"><?= $_GET['title'];?></a>
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
            		          <th>Change From Admin</th>
            		           
            		      </tr>
    		    <?php
    		   // echo '<pre>';
    		   // print_r($table_data);
    		    if($table_data){
    		        $sno=0;
    		        foreach($table_data as $data){
    		            $sno++;
    		            $type=$data->type;
    		            $this_val=$data->value;
    		            $slug=$data->label;
    		            ?>
    		             <tr>
            		          <td><?= $sno;?>.</td>
            		          <td><?= $data->name;?></td>
            		          <td>
                		          <?php
                		            if($type=='option'){
                		                $options=explode(',',$data->options);
                		                $op1=$options[0];
                		                $op2=$options[1];
                		                ?>
                		                   
                		                 <div class="bt-switch mt-3">
                                            <input type="checkbox"  <?= $this_val==$op1 ? 'checked':'';?> data-slug="<?= $data->label;?>" name="change_radio" data-size="small" class="js-switch change_radio_setting" data-color="#008cff" data-on-text="<?= $op1;?>" data-off-text="<?= $op2;?>" data-off-color="danger" />
                                            
                                        </div>
                    		            <!--<small class="badge badge-info"><?= $op1;?></small>
                    		            <small class="badge badge-default"><?= $op2;?></small>-->
                    		            <small>On Enable value = "<?= $op1;?>", On Disable value = "<?= $op2;?>"</small> 
                		                <?php
                		            }
                		             if($type=='text'){
                		                 ?>
                		                 <div class="form-group">
                            					<input class="form-control change_text_setting" data-slug="<?= $data->label;?>" data-response="res_<?= $data->label;?>" type="text" value="<?= $this_val;?>">
                            			        <small id="res_<?= $data->label;?>" class="text-muted"></small>
                            			</div>
                		                 <?php
                		             }
                		            if($type=='array'){
                		                $options=json_decode($data->options,true);
                		                 ?>
                		                 <div class="form-group">
                            					<select name="" class="form-control change_text_setting" data-slug="<?= $data->label;?>" data-response="res_<?= $data->label;?>">
                            					    <?php
                            					    foreach($options as $_ky=>$op_value){
                            					        ?>
                            					        <option value="<?= $_ky;?>" <?= $_ky==$this_val ? 'selected':'';?>><?= $op_value;?></option>
                            					        <?php
                            					    }
                            					    ?>
                            					</select>
                            			        <small class="text-muted"></small>
                            			</div>
                		                 <?php
                		             }
                		             if($type=='json_array'){
                		                 $json_array=json_decode($data->options,true);
                		                 $json_array_values=json_decode($data->value,true);
                		                    foreach($json_array as $ky=>$op_value){
                            				?>
                    		                 <div class="icheck-material-primary icheck-inline">
                                                <input type="checkbox" class="json_array_change" name="<?= $slug;?>" data-key="<?= $ky;?>" data-value="<?= $op_value;?>" data-data_name="<?= $slug;?>" id="<?= $slug.'_'.$ky;?>" <?= !empty($json_array_values) && array_key_exists($ky,$json_array_values) ? 'checked':'';?> />
                                                <label for="<?= $slug.'_'.$ky;?>"><?= $op_value;?></label>
                                              </div>
                                          
                		                 <?php
                		                    }
                		             }
                		             if($type=='multi_values'){
                		                 $json_array=json_decode($data->options,true);
                		                 $json_array_values=json_decode($data->value,true);
                		                 foreach($json_array as $op_value){
                            				?>
                        		                <div class="icheck-material-primary icheck-inline">
                                                    <input type="checkbox" class="multi_array_change" data-value="<?= $op_value;?>" id="<?= $slug.'_'.$op_value;?>" name="<?= $slug;?>" data-data_name="<?= $slug;?>" <?= !empty($json_array_values) && in_array($op_value,$json_array_values) ? 'checked':'';?> />
                                                    <label for="<?= $slug.'_'.$op_value;?>"><?= $op_value;?></label>
                                                </div>
                    		                 <?php
                		                    }
                		             }
                		          ?>
            		          </td>
            		          <td>
    		                    <div class="bt-switch mt-3">
                                    <input type="checkbox"  <?=  $data->admin_status==1 ? 'checked':'';?> data-slug="<?= $data->label;?>" data-size="small" class="js-switch change_admin_setting" data-color="#008cff" />
                                    
                                </div>
            		          </td>
            		      </tr>
    		            <?php
    		        }
    		    }
    		    ?>
    		  </table>
    		</div>
		</div>
	</div>
 