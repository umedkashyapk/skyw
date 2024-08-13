            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= $panel_url.'dashboard';?>">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Contact-Detail</a>
					</li>
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-12">
		    <div class="card">
		        <div class="card-body">
		     <form action="<?= $superadmin_path.'contact';?>" method="REQUEST">
                     <div class="form-inline1">
                                             
                            <input type="text" Placeholder="Enter Name" name="name" class=" " value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />
                        <!--    <input type="text" Placeholder="Enter Username" name="username" class=" " value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />-->
                            <input type="text" Placeholder="Enter Email" name="email" class=" " value='<?= isset($_REQUEST['email']) && $_REQUEST['email']!='' ? $_REQUEST['email']:'';?>'>
                          
                            <input type="text" Placeholder="Enter Mobile" name="mobile" class=" " value='<?= isset($_REQUEST['mobile']) && $_REQUEST['mobile']!='' ? $_REQUEST['mobile']:'';?>'>
                           <select name="limit">
                                 <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                                 <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                                 <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                                 <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                                 <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                             </select>
                          
                         <input type="submit" name="submit" class="  " value="filter" />
                        <a href="<?= $superadmin_path.'contact';?>" class="btn btn-sm">Reset</a>
                        <!-- <input type="submit" name="export_to_excel" class=" " value="Export to excel" />-->
                    </div>
                </form>
                </div>
                </div>
		     <?php 
                $success['param']='success';
                $success['alert_class']='alert-success';
                $success['type']='success';
                $this->show->show_alert($success);
                ?>
		    
			<div class="table-responsive">
    			<table class="table">
    				<thead>
    					<tr>
    						<th>
    							#
    						</th>
    						<th>
    							Name
    						</th>
    						<th>
    							Email
    						</th>
    						 
    						<th>
    							Mobile
    						</th>
    							<th>
    							Message
    						</th>
    						<th>
    							Date
    						</th>
    						
    					</tr>
    				</thead>
    				<tbody>
    				    <?php
    				    //print_r($table_data);
    				     if($table_data){
                            foreach($table_data as $t_data){
                                $sr_no++;
                                $name=$t_data['name'];
                                $mobile=$t_data['mobile'];
                               
            				    ?>
            					<tr>
            						<td>
            							<?= $sr_no;?>
            						</td>
            						<td>
            							<?= $t_data['name'];?>
            						</td>
            					 
            						<td>
            							<?= $t_data['email'];?>
            						</td>
            					 
            						<td>
            							<?= $t_data['mobile'];?>
            						</td>
            						<td>
            							<?php $message=$t_data['message']; 
            							$message=html_entity_decode($message);
            					    	echo	$message;
            							?>
            						</td>
            					 
            						<td>
            						    <?= $t_data['added_on'];?>
            						</td>
            				
            						   
            						     
            						</td>
            					</tr>
            					<?php
                            }
    					}
    					?>
    				</tbody>
    			</table>
			</div>
			<?php 
    
    echo $this->pagination->create_links();?>
		</div>
	</div>
 