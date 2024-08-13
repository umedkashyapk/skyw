            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">All Video</a>
					</li>
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
    			<table class="table">
    				<thead>
    					<tr>
    						<th>
    							#
    						</th>
    					<!--	<th>
    							Course
    						</th>-->
    						<th>
    							Title
    						</th>
    						<th>
    							Video
    						</th>
    						 
    						<th>
    							Date
    						</th>
    						<th>
    							Action
    						</th>
    					</tr>
    				</thead>
    				<tbody>
    				    <?php
    				    
    				     if($table_data){
                            foreach($table_data as $t_data){
                                $sr_no++;
                               
    				    ?>
    					<tr>
    						<td>
    							<?= $sr_no;?>
    						</td>
    					
    						<td>
    							<?= $t_data['title'];?>
    						</td>
    						<td>
    						<a href="<?= $t_data['video'];?>" target="_blank"><video  style="width:100px%;height:100px" controls>
                                                <source src="<?= $t_data['pro_video'];?>" type="video/mp4">
                                                 <source src="<?= $t_data['pro_video'];?>" type="video/ogg">
 
                                                   </video></a>
    						  
    						</td>
    						<td>
    						    <?= $t_data['added_on'];?>
    						</td>
    						
    						 <td><a class="btn btn-sm btn-danger" href="<?= $admin_path.'video/view?id='.$t_data['id'];?>"  onclick="return confirm('Are you sure you want to delete this Video');" >Delete</a></td>   
    					</tr>
    					<?php }
    					}
    					?>
    				</tbody>
    			</table>
			</div>
			<?php 
    
    echo $this->pagination->create_links();?>
		</div>
	</div>
 