 <br>
	 
		<div class="row">
		<div class="col-md-9">
			
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="#">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Report</a>
					</li>
					<li class="breadcrumb-item active">
						Tds
					</li>
				</ol>
		</div>
		<div class="col-md-3 text-right">
		    <div class="btn-group">
		    <button type="button" class="btn btn-facebook  btn-sm"><i class="fa fa-facebook mr-1"></i>Facebook</button>
		    <button class="btn btn-success btn-sm" >  <i class="fa fa-whatsapp mr-1" ></i> </button>
		    <button class="btn btn-info btn-sm" onclick="printDiv('report_section')"><i class="fa fa-print fs-16" ></i> Print </button>
		    </div>
		</div>
		</div>	
			<div class="row">
			    
				<div class="col-md-12">
				    <form action="" method="get">
    				    <div class="card card-body">
                            
                                <div class="form-inline1">
                                    <input type="date" class=" "  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                                    <input type="date" class=" "  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                                    <select name="month">
                                        <option value="all">All</option>
                                        <?php
                                        for ($i = 0; $i < 12; $i++) {
                                            $mnth=date("Y-m", strtotime( date( 'Y-m-01' )." -$i months"));
                                            ?>
                                            <option value="<?= $mnth;?>" <?= (isset($_REQUEST['month']) && $_REQUEST['month']==$mnth ? 'selected':''); ?> ><?= date("M", strtotime( date( 'Y-m-01' )." -$i months"));;?></option>
                                            <?php
                                        }
                                        
                                        ?>
                                    </select>
                                    <?php
                                    print_r($months);
                                    ?>
                                    <input type="submit" name="submit" class=" " value="Filter" />
                                    
                                    <button ><a href="<?= $admin_path.'report/tds';?>" class=" m-1" > Reset </a></button>
                                    <input type="submit" name="export_to_excel" class=" " value="Export To Excel" />
                                </div>
                            
                        </div> 
    				    <div class="card card-body">
    				        <div class="form-inline1">
                                <input name="today" type="submit" value="Today" <?= isset($_REQUEST['today']) ? 'disabled':'';?>/>
                                <input name="yesterday" type="submit" value="Yesterday" <?= isset($_REQUEST['yesterday']) ? 'disabled':'';?>/>
                                <input name="curr_week" type="submit" value="Current Week" <?= isset($_REQUEST['curr_week']) ? 'disabled':'';?>/>
                                <input name="last_week" type="submit" value="Last Week" <?= isset($_REQUEST['last_week']) ? 'disabled':'';?>/>
                            </div>
                        </div>
				 
				</form>
				</div>
				<?php
				if(isset($_REQUEST['submit']) || isset($_REQUEST['today']) || isset($_REQUEST['yesterday']) || isset($_REQUEST['curr_week']) || isset($_REQUEST['last_week'])){
				
				
				
				?>
				
    				<div class="col-md-12 " id="report_section">
        				    <div class=" row">
        				        <div class="col-md-2">
                				
                				</div>
                				<div class="card card-body col-md-8">
                				     <div class="text-right text-dark">
            				            <?= $this->session->userdata('profile')->name;?> (<?= $this->session->userdata('profile')->username;?>)
            				        </div>
            				        <div class="table-responsive">
            				        <table class="table table-sm borderless" style="border:none;">
                        				<thead>
                        					<tr>
                        						<th>
                        							S no.
                        						</th>
                        						<!--<th>
                        							Pan no.
                        						</th>-->
                        						<th>
                        							Username(Name)
                        						</th>
                        						<th class="text-right" >
                        							Total Amount
                        						</th>
                        						<th class="text-right" >
                        							Tds Amount
                        						</th>
                        					</tr>
                        				</thead>
                        				<tbody>
                        				    <?php
                        				        $currency=$this->conn->company_info('currency');
                        				        
                        				        
                        				        if($all_report_users){
                        				            
                        				            $total=0;
                        				            $total_tds=0;
                        				            $sn=0;
                        				             
                        				            foreach($all_report_users as $income_details){
                        				                $p_no=$income_details->p_no;
                        				                 $profile=$this->profile->profile_info($p_no,'name,username');
                        				                //$get_amnt=$this->conn->runQuery('SUM(amount) as amnt','transaction',"pan_number='$p_no' ".$income_where )[0]->amnt;
                        				                $get_amnt=$this->conn->runQuery('SUM(amount) as amnt','transaction',"u_code='$p_no' ".$income_where )[0]->amnt;
                        				                $ttl_amnt=$get_amnt!='' ? $get_amnt:0;
                        				                $tds_amnt=$ttl_amnt*5/100;
                        				                $sn++;
                        				               
                        				                $total += $ttl_amnt;
                        				                $total_tds += $tds_amnt;
                        				                //$income_where='';
                        				             
                        				               
                        				                ?>
                        				                <tr> 
                        				                    <td><?= $sn;?></td>
                        				                    <td><?= $profile ? $profile->username .'('.$profile->name.')':'';?></td>
                        				                    <td class="text-right"><?= $ttl_amnt;?></td>
                        				                    <td class="text-right"><?= $tds_amnt;?></td>
                        				                </tr>
                        				                
                        				                <?php
                        				            }
                        				        }
                        				        ?>
                        					
                        					 
                        				</tbody>
                        				<tfoot >
                        				    <tr>
                        						 <td colspan=2>
                        						     <strong>Total</strong>  
                        						</td> 
                        					 
                        						<td class="text-right">
                        								<strong><?= $currency;?> <?= $total;?></strong>  
                        						</td>
                        						<td class="text-right">
                        								<strong><?= $currency;?> <?= $total_tds;?></strong>  
                        						</td>
                        						 
                        					</tr>
                        				</tfoot>
                        			</table>
                				</div>
        				    </div>
        				    </div>
    				     
    				</div>
    				    
    				    
    				
				<?php }?>
			</div>
		
	 <p>&nbsp;</p>
	
 <script>
		function printDiv(divName){
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;

		}
	</script>