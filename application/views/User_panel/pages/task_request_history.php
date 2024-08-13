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
<div class="user_content">
    <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item"><a href="#">Product /</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Product request </li>
         </ol>
	   </div>
	 
</div>
   <div class="container pages">
            	<div class="nk-content nk-content-fluid">
                	<div class="container-xl wide-lg">
            	    	<div class="nk-content-body">
            		    	<div class="components-preview wide-md mx-auto">
            			
            		      	<br>
                        	<div class="user_main_card mb-3">
       
            <div class="user_card_body ">
           
                <div class="user_card_body">
                   <div class="user_table_data">
                       <table class="user_table_info_record">
											<thead>
												<tr>
													<th>S No.</th>
													<th>Product Name</th>
													<th>Product Mrp</th>
													<th>Product Description</th>
													<th>Type</th>
													<!--<th> Slip</th>-->
													 <th>Status</th>
													 <th>Date </th>
													 
												</tr>
											</thead>
													 <tbody>
															<?php
														$user=$this->session->userdata('profile');
														if($table_data){
															
															foreach($table_data as $t_data){
															    $payment_id=$t_data['id'];
															    $user_id=$t_data['u_code'];
																$tx_profile=false;
																$tx_profile=$this->profile->profile_info($t_data['u_code']);
																$sr_no++;
															    $payment_status=$this->conn->runQuery('status','transaction',"u_code='$user_id' and payment_id='$payment_id'");
                                                               
																?>
																<tr>
																	<td class="text-left border-right"><?= $sr_no;?></td>
																	<td class="text-left border-right"><?= $t_data['product_name'];?></td>
																	<td class="text-left border-right"><?= $t_data['product_mrp'];?></td>
																	<td class="text-left border-right"><?= $t_data['product_description'];?></td>
																	<td class="text-left border-right"><?= $t_data['type'];?></td>
																	<?php
																	if($payment_status[0]->status=='1'){
																	?>
																		<td class="text-left border-right">
																		     <a class="btn btn-success btn-sm" href="">Payment Success</a>
																	</td>
																	<?php
																	}else{
																	?>
																	
																	<td class="text-left border-right"><?php
																	if($t_data['req_status']==1){
																	    ?>
																	    <a class="btn btn-primary btn-sm" href="<?= $panel_path.'task/payment?id='.$t_data['id'];?>">Pay</a>
    																<?php
    																}else{
    																	    echo"Pending";
    																	}
															        }
																	?></td>
																	
																	<td class="text-left"><?= $t_data['added_on'];?></td>                                
																			   
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