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
						<a href="#">Matching</a>
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
		         
            	</tr>
    		    <?php
    		   // echo '<pre>';
    		   // print_r($table_data);
    		    $table_data=$this->conn->runQuery('*','wallet_types',"wallet_type= 'income' AND generation = 1");
    		    if($table_data){
    		        $sno=0;
    		        foreach($table_data as $data){
    		            $sno++;
    		            $this_val=$data->closing_status;
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
                                        <input type="checkbox"  <?= $this_val==$op1 ? 'checked':'';?> data-slug="<?= $data->id;?>" name="change_wallet" data-size="small" class="js-switch change_wallet_setting" data-color="#008cff" data-on-text="<?= $op1;?>" data-off-text="<?= $op2;?>" data-off-color="danger" />
                                    </div>
                		            <!--<small class="badge badge-info"><?= $op1;?></small>
                		            <small class="badge badge-default"><?= $op2;?></small>-->
                		            <small>On Enable value = "<?= $op1;?>", On Disable value = "<?= $op2;?>"</small> 
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
 