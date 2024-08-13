
<style>
    .btnPrimary{
        width: auto !important;
    }
</style>

<section class="network-sec">
        <div class="container">
             <div class="eraning_link_data">
              <div class="row">
                   
                    <div class="col-md-2">
                        <div class="earning_link">
                            <a href="<?= $panel_path.'fund/request_history';?>">Fund Deposit History</a>
                        </div>
                    </div>
                    <!-- <div class="col-md-2">-->
                    <!--    <div class="earning_link">-->
                    <!--        <a href="<?= $panel_path.'fund/fund-transfer';?>">Fund Transfer</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- <div class="col-md-2">-->
                    <!--    <div class="earning_link">-->
                    <!--        <a href="<?= $panel_path.'fund/transfer-history';?>">Fund Transfer History</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    <!--  <div class="col-md-2">-->
                    <!--    <div class="earning_link">-->
                    <!--        <a href="<?= $panel_path.'Fund/fund-convert';?>">Fund Convert</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="col-md-2">-->
                    <!--    <div class="earning_link">-->
                    <!--        <a href="<?= $panel_path.'fund/convert-history';?>">Fund Convert History</a>-->
                    <!--    </div>-->
                    <!--</div>-->
                   
                    
                    </div>
                </div>
            <div class="formContainer">
                 <form action="<?= $panel_path.'team/team-direct'?>" method="get">
                <div class="row">
                    <div class="col-sm-2 mb-3">
                        <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">
                    </div>
                    <div class="col-sm-2 mb-3">
                         <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                    </div>
                    <div class="col-sm-2 mb-3">
                         <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">
                              
                    </div>
                    <div class="col-sm-2 mb-3">
                        <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">
                               
                    </div>
                    <!--<div class="col-sm-2 mb-3">
                        <select>
                            <option value="">All</option>
                            <option value="">20</option>
                            <option value="">50</option>
                            <option value="">100</option>
                            <option value="">200</option>
                        </select>
                    </div>-->
                    
                    
                    <div class="col-sm-2 mb-3">
                       <select name="active_status" id="">
                            <option value="" >-- Status --</option>
                            <option value="1" <?php if($select_status== "1") echo "selected"; ?>>Active</option>
                            <option value="0" <?php if($select_status== "0") echo "selected"; ?>>Inactive</option>
                           </select>
                    </div>
                </div>
                  
                <div class="networkButton">
                     <button class="btnPrimary" type="submit" name="submit">Filter</button>
                    <a href="<?= $panel_path.'team/team-direct'?>"  class="btnPrimary" name="submit">Reset</a>
                   
                </div>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="earningTable ">
                 <table class="user_table_info_record">
                  
		<thead>
			<tr>
				<th>S No.</th>
				<th>Amount (<?= $this->conn->company_info('currency');?>)</th>
				<th> Method</th>
				<th> Type</th>
				<th>UTR Number</th>
				<th>Payment Slip</th>
				 <th>Status</th>
				<th>Reason</th>
				<th>Date </th>
				 
        			</tr>
        		</thead>
				 <tbody>
						<?php
					$user=$this->session->userdata('profile');
					if($table_data){
						
						foreach($table_data as $t_data){
							$tx_profile=false;
							$tx_profile=$this->profile->profile_info($t_data['tx_u_code']);
							$sr_no++;
							?>
							<tr>
								<td class="text-left border-right"><?= $sr_no;?></td>
								 
								 
														 
								<td><?= $t_data['amount'];?></td> 
								<td><?= $t_data['cripto_type'];?></td>                              
								<td><?= $t_data['payment_type'];?></td>                              
								<td><?= $t_data['cripto_address'];?></td>
								<td><a href="<?= $t_data['payment_slip'];?>" target="_blank"><img src="<?= $t_data['payment_slip'];?>" style="height:50px;width:50px;"></td>
								<td>
									<?php 
									switch($t_data['status']){
										case '1' :
											echo 'Approved';
											break;
										case '0' :
											echo 'Pending';
											break;
										case '2' :
											echo 'Rejected';
											break;
											}
									?>
								</td>
								<td class="text-left"><small><?= $t_data['reason'];?></small></td>                                
								<td class="text-left"><?= $t_data['updated_on'];?></td>                                
										   
							</tr>
							<?php
						}
					}
						?>
						
					</tbody>                                
            </table>
                <?php 
                
                echo $this->pagination->create_links();?>
            </div>
        </div>
    </section>
    <br>
<br>
    
    
