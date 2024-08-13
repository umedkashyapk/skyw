
<div class="user_content">
    <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item"><a href="#">E-pin /</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Pin History</li>
         </ol>
	   </div>
	 
</div>

<?php
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
	 
}else{
	$likecondition=array();
}
 ?>
      
       
       
       <div class="user_main_card mb-3">
           
            <div class="user_card_body">
                 <h5 class="user_card_title_group"><i class="fa fa-filter"></i>Filter</h5>
                 <form action="<?= $panel_path.'pin/pin-history'?>" method="get">
                 <div class="user_form_row">
                     <div class="row">
                     <div class="col-12 mb-2">
                         <div class="data_detail_page_group">
                         <div class="detail_input_group">
                           <div class="input-group ">
                               <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">
                           </div>
                        </div>
                  
                    <div class="detail_input_group">
                      <div class="input-group ">
                               <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                           </div>
                          
                     </div>
                     <div class="detail_input_group">
                        <div class="input-group ">
                               <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">
                              
                           </div>
                     </div>
                     <div class="detail_input_group">
                        <div class="input-group ">
                               <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">
                               
                           </div>
                           
                     </div>
                     <div class="detail_input_group">
                        <select name="tx_type" id="" class="form-control user_input_select">
                            <option value="">Select Credit/Debit</option>
                        <option value='credit' <?= isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']=='credit' ? 'selected':'';?> >Credit</option>
                        <option value='debit' <?= isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']=='debit' ? 'selected':'';?> >debit</option>
                       </select>
                     </div>
                     
                   
                 <div class="user_form_row_data">
                   <div class="user_submit_button ">
                      
                       <input type="submit" name="submit" value="Filter" id="" class="user_btn_button">
                   </div>
                   <div class="user_submit_button">
                      <!-- <input type="submit" name="" value="Reset" id="" class="user_btn_button">-->
                       <a href="<?= $panel_path.'pin/pin-history'?>" class="user_btn_button" > Reset </a>
                       
                   </div>
                   </div>
               </div>
           </div>
            </div>
           </form>
            </div>
       </div>
       </div>
       
       
        <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
              
                <div class="user_card_body">
                   <div class="user_table_data">
                       <table class="user_table_info_record">
                            <tbody>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Tx user</th>
                                    <th>No of Pins</th>                
                                    <th>Pin Type</th>
                                    <th>Credit/Debit</th>
                                    <th>Balance</th>
                                    <th>Remark</th>
                                    <th>Date&Time</th>
                                </tr>
                                <?php

                                if($table_data){
                                        foreach($table_data as $t_data){
                            
                                            if($t_data['tx_type']=='credit'){                    
                                                $no_of_pins=$t_data['credit'];
                                            }else{
                                                $no_of_pins=$t_data['debit'];
                                            }
                            
                                                if($t_data['tx_user']!=''){
                                                    $tx_profile=$this->profile->profile_info($t_data['tx_user']);
                                                }else{
                                                    $tx_profile=$this->profile->profile_info($t_data['user_id']);
                                                }
                                                $sr_no++;
                                        ?>
                                        <tr>
                                            <td><?=  $sr_no;?></td>
                                            <td><?= ($tx_profile ? $tx_profile->name:'');?></td>
                                            
                                            <td><?= $no_of_pins;?></td>                               
                                            <td><?= $t_data['pin_type'];?></td>               
                                            <td><?= $t_data['tx_type'];?></td>               
                                            <td><?= $t_data['curr_pin'];?></td>               
                                            <td><?= $t_data['remark'];?></td> 
                                            <td><?= $t_data['added_on'];?></td>   
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

 <?php 
                
                echo $this->pagination->create_links();?>

</div>
</div>

