<style>
    h3.level_setting_heading {
    text-align: center;
    text-transform: capitalize;
}
thead.table_head_level {
    background: #172b4d;
}
th.level_setting_table_data {
    color: #fff;
}
tbody.level_setting_body {
    background: #172b4d;
}
input.btn.btn-info.button_change {
    margin-top: 10px;
}

</style>

<?php
$get_roi_income=$this->conn->runQuery('*','plan',"id<'2'");
$get_level_on_roi_plan=$this->conn->runQuery('*','plan',"id<'7'");
$get_retreat_bonus_plan=$this->conn->runQuery('*','plan',"id<'4'");
$get_vip_bonus_plan=$this->conn->runQuery('*','plan',"id<'6'");
$get_dhb_plan=$this->conn->runQuery('*','plan',"id>'10' and id<15");
$get_one_time_rank_plan=$this->conn->runQuery('*','plan',"id>=1 and id<=14");
?>
            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#"> Plan settings</a>
					</li>
				 
				</ol>
			</nav>
	<div class="row">
	
		
	<div class="col-md-6 card card-body">
		    <h3 class="level_setting_heading"> Runer Bonus plan setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
							Team Turnover
    						</th>
    						<th  class="level_setting_table_data">
							Direct Referral
    						</th>
    						
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_roi_income as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				          
    				            <td class="level_setting_table_heading_data">
								<input name="runner_team_business_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->runner_team_business;?>" />
    				          
							</td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="runner_direct_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->runner_direct;?>" />
    				            </td>
    				            
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_runner_bonus_btn" value="Change" />
			 </form>
		</div> 
		
		
				
		<div class="col-md-6 card card-body">
		    <h3 class="level_setting_heading">Stacking Bonus (ROI) setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
    							#
    						</th>
    						<th  class="level_setting_table_data">
    							ROI Income(%)
    						</th>
    						
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_roi_income as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				          

							
							<td  class="level_setting_table_heading text-white">
    				                <?= $plan_details->package_name;?>
    				            </td>
    				            
							
    				            <td class="level_setting_table_heading_data">
    				                <input name="roi_income_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->roi;?>" />
    				            </td>
    				            
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_roi_income_btn" value="Change" />
			 </form>
		</div>
		
		
		
					
		 <div class="col-md-6 card card-body">
		    <h3 class="level_setting_heading">Vip Bonus plan setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
    							#
    						</th>
    						<th  class="level_setting_table_data">
							Vip Bonus(%)
    						</th>
    						
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_vip_bonus_plan as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				          
    				            <td class="level_setting_table_heading_data">
								<?= $plan_details->vip_rank;?>
							</td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="vip_bonus_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->vip_bonus;?>" />
    				            </td>
    				            
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_vip_bonus_btn" value="Change" />
			 </form>
		</div> 

		 
		<div class="col-md-6 card card-body">
		    <h3 class="level_setting_heading">Level Earning Bonus plan setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
    							#
    						</th>
    						<th  class="level_setting_table_data">
							Level Earning Bonus(%)
    						</th>
    						<!--	<th  class="level_setting_table_data">
    							Direct Required
    						</th>-->
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_level_on_roi_plan as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				            <td  class="level_setting_table_heading text-white">
    				                <?= $plan_details->package_name;?>
    				            </td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="level_on_roi_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->level_on_roi;?>" />
    				            </td>
    				            
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_level_on_roi_btn" value="Change" />
			 </form>
		</div>
		
		
		<div class="col-md-4 card card-body">
		    <h3 class="level_setting_heading">DHB plan setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
    							#
    						</th>
    						<th  class="level_setting_table_data">
							Dhb Bonus(%)
    						</th>
    						
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_dhb_plan as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				          
    				            <td class="level_setting_table_heading_data">
								<?= $plan_details->rank;?>
							</td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="dhb_bonus_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->dhb_bonus;?>" />
    				            </td>
    				            
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_dhb_bonus_btn" value="Change" />
			 </form>
		</div> 

		 
		<div class="col-md-8 card card-body">
		    <h3 class="level_setting_heading">Retreat Bonus plan setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
							Retreat
    						</th>
    						<th  class="level_setting_table_data">
							Time Limit
    						</th>
    							<th  class="level_setting_table_data">
    							Retreat Bonus
    						</th>
    						</th>
    							<th  class="level_setting_table_data">
    							TSV
    						</th>
    						</th>
    							<th  class="level_setting_table_data">
    							PSV
    						</th>
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_retreat_bonus_plan as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				            <td  class="level_setting_table_heading text-white">
    				                <?= $plan_details->reward;?>
    				            </td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="retreat_bonus_time_limit_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->retreat_bonus_time_limit;?>" />
    				            </td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="retreat_bonus_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->retreat_bonus;?>" />
    				            </td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="tsv_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->tsv;?>" />
    				            </td>
    				            <td class="level_setting_table_heading_data">
    				                <input name="psv_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->psv;?>" />
    				            </td>
    				            
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_retreat_btn" value="Change" />
			 </form>
		</div>


	
	 <div class="col-md-12 card card-body">
		    <h3 class="level_setting_heading">Rank Income setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
    							Rank
    						</th>
    						
    					
    							<th  class="level_setting_table_data">
    							One Time Rank Income
    						</th>
    							<th  class="level_setting_table_data">
    							Compensation Bonus (%)
    						</th>
    				
    							<th  class="level_setting_table_data">
    							Enrollments
    						</th>
    							<th  class="level_setting_table_data">
    							Group Volume
    						</th>
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_one_time_rank_plan as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				           
    				            
    				          
    				            <td class="level_setting_table_heading_data">
								<?= $plan_details->rank;?>
    				            </td>
    				            
    				            <td class="level_setting_table_heading_data">
    				                <input name="rank_income_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->rank_income;?>" />
    				            </td>
    				            
    				             <td class="level_setting_table_heading_data">
    				                <input name="compensation_bonus_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->compensation_bonus;?>" />
    				            </td>
    				             <td class="level_setting_table_heading_data">
    				                <input name="direct_required_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->direct_required;?>" />
    				            </td>
    				             <td class="level_setting_table_heading_data">
    				                <input name="team_business_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->team_business;?>" />
    				            </td>
    				          
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change__my_rank_btn" value="Change" />
			 </form>
		</div>
		
<!--
          <div class="col-md-12 card card-body">
		    <h3 class="level_setting_heading">Bonanza Reward setting </h3>
		    <form action="" method="post">
			<div class="table-responsive">
    			<table class="table">
    				<thead class="table_head_level">
    					<tr class="text-right">
    						<th class="level_setting_table_data">
    							Self Business
    						</th>

                                             <th class="level_setting_table_data">
    							Direct Business
    						</th>
                                                  <th class="level_setting_table_data">
    							Team Business
    						</th>
    						
    					
    							<th  class="level_setting_table_data">
    							Bonanza Reward
    						</th>
    				
    							<th  class="level_setting_table_data">
    							Start Date
    						</th>
                                                 <th  class="level_setting_table_data">
    							End Date
    						</th>
    						 
    					</tr>
    				</thead>
    				<tbody class="level_setting_body">
    				    <?php
    				     
    				    foreach($get_direct_plan_bonanza as $plan_details){
    				         
    				        ?>
    				        <tr  class="text-right">
    				           
    				            
    				           <td class="level_setting_table_heading_data">
    				                <input name="bonanza_self_business_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->bonanza_self_business;?>" />
    				            </td>

    				            <td class="level_setting_table_heading_data">
    				                <input name="bonanza_business_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->bonanza_business;?>" />
    				            </td>
                                            <td class="level_setting_table_heading_data">
    				                <input name="bonanza_team_business_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->bonanza_team_business;?>" />
    				            </td>
                                            
    				            
    				            <td class="level_setting_table_heading_data">
    				                <input name="bonanza_reward_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->bonanza_reward;?>" />
    				            </td>
    				            
    				             <td class="level_setting_table_heading_data">
    				                <input type="date" name="bonanza_start_date_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->bonanza_start_date;?>" />
    				            </td>
                                        <td class="level_setting_table_heading_data">
    				                <input type="date" name="bonanza_end_date_<?= $plan_details->id;?>" class="form-control text-right" value="<?= $plan_details->bonanza_end_date;?>" />
    				            </td>
    				          
    				        </tr>
    				        <?php
    				    }
    				    
    				    
    				    ?>
    				</tbody>
    			</table>
			</div>
			<input class="btn btn-info button_change" type="submit" name="change_bonanza_btn" value="Change" />
			 </form>
		</div>
		

	
	</div> -->
 
