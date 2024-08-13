   <style>
    a.user_btn_button {
   
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    font-weight: 500;
    margin: 0;
    display: inline-block;
    color: #000;
	background: var(--second) !important;
    color: var(--first) !important;
}


.user_form_row_data{
align-items: center;
}
    
    
</style>

   <div class="container pages">
            	<div class="nk-content nk-content-fluid">
                	<div class="container-xl wide-lg">
            	    	<div class="nk-content-body">
            		    	<div class="components-preview wide-md mx-auto">
            			
            		      	<br>
                        		
                                <div class="user_main_card mb-3">
                                    <div class="user_card_body">
                                    <h5 class="user_card_title filter_title"><i class="fa fa-filter"></i>Filter</h5>
                                       <form action="<?= $panel_path.'invest/topup-history'?>" method="get">
                                            <div class="user_form_row">
                                                <div class="row">
                                                   <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
                                                    <select name="limit" id="" class="form-control user_input_select">
                                                    <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                                                    <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                                                    <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                                                    <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
                                                   <select name="tx_type" class="form-control user_input_select">
                                                     <option value="all">Select Type</option>
                                                     <option value="topup">Topup</option>
                                                     <option value="retopup">Retoup</option>
                                                    
                                                     
                                                     </select>
                                                    </div>
                                                    
                                                    <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
                         
                                                       <div class="input-group ">
                                                           <input name="start_date" type="date" id="" value='<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"' class="form-control user_input_text" >
                                                       </div>
                                                    
                                                 </div>
                                                 <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
                         
                                                       <div class="input-group ">
                                                           <input name="end_date" type="date" id="" value='<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>"' class="form-control user_input_text" >
                                                       </div>
                                                    
                                                 </div>
                                                
                                                </div>
                                                <div class="user_form_row_data">
                                                <div class="user_submit_button mb-2">
                                                <input type="submit" name="submit" value="Filter" id="" class="user_btn_button">
                                                </div>
                                                <div class="user_submit_button mb-2">
                                                
                                                <a href="<?= $panel_path.'invest/topup-history'?>" class="user_btn_button"> Reset </a>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                
                                 <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
           
                <div class="user_card_body">
                   <div class="user_table_data">
                       <table class="user_table_info_record">
											<thead>
												<tr>
													<th>S No.</th>
													<th>Amount (<?= $this->conn->company_info('currency');?>)</th>
													<th>Type</th>
													<th>Remark</th>
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
																	<td><?= $t_data['tx_type'];?></td> 
																	<td><?= $t_data['remark'];?></td> 
																    <td class="text-left"><?= $t_data['updated_on'];?></td>                                
																			   
																</tr>
																<?php
															}
														}
															?>
															
														</tbody>                                
                                                </table>
                        
                   </div> 
               </div> 
            
       </div>
    </div>

								
                            </div><!-- .components-preview -->
                        </div>
                    </div>
                </div>
                </div>
                <?php echo $this->pagination->create_links();?>
                <br>
    <?php 