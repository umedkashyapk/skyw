<?php
$profile=$this->session->userdata("profile");

?>
<style>
    table.user_table_info_record.pin_record th, td {
    border: 1px solid #d9d9df;
}


</style>
<div class="user_content">
    <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home /</a></li>            
            <li class="breadcrumb-item"><a href="#">E-pin /</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Pin Request</li>
         </ol>
	   </div>
	 
</div>
        <div class="user_main_card mb-3 detail_data_pins">
       
            <div class="user_card_body user_content_page pins_detail">
               
                 <div class="user_form_row user_form_content">
                     <div class="row">
                     <div class="col-lg-12 mb-3">
                       <label class="label_user_title">Username</label>
                           <div class="input-group ">
                            <input name="user_id" type="text"  id="user_id" value="<?=$profile->username;?>" class="form-control user_input_text" placeholder="Username" readonly>
                            
                            <span class="text-danger " ><?= form_error('user_id');?></span>  
                           </div>
                     </div>
                     <div class="col-lg-12 mb-3 ">
                       <label class="label_user_title">Utr Number</label>
                           <div class="input-group ">
                            <input name="utr_number" type="text"  id="utr_number" class="form-control user_input_text" placeholder="Enter Utr Number">
                          
                            <span class="text-danger " ><?= form_error('utr_number');?></span>   
                           </div>
                     </div>
                     <div class="col-lg-12 mb-3">
                       <label class="label_user_title">Slip</label>
                           <div class="input-group ">
                               <input name="slip_img" type="file"  id="slip_img" class="form-control user_input_text" >
                           </div>
                     </div>
                     <div class="col-lg-12 mb-3">
                        <label class="label_user_title">Select Pin</label>
                        <select class="form-control d-inline " id="selected_pin" name="selected_pin" required>
                            <option value="">Select Pin</option>
                            <?php
                            $all_pin=$this->conn->runQuery("pin_rate,pin_type",'pin_details',"status=1");
                            if($all_pin){
                                foreach($all_pin as $pindetails){
                                    ?><option value="<?= $pindetails->pin_type;?>"><?= $pindetails->pin_type;?></option><?php
                                }
                            }
                            ?>
                            </select>
                            <span class=" " ><?= form_error('selected_pin');?></span>
                        </select>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="label_user_title">Number Of Pins</label>
                        <div class="input-group ">
                            <input name="number_of_pins" type="text"  id="text" class="form-control user_input_text cal_amnt" placeholder="Enter Number Of Pins " data-pin_rate="<?=$pin_rate;?>">
                            
                           
                            <span id="rate_area" class="text-danger " ><?= form_error('number_of_pins');?></span>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label class="label_user_title">Remark</label>
                        <div class="input-group ">
                            <input name="remark" type="text"  id="remark" class="form-control user_input_text" placeholder="Enter Remarks">
                            
                            
                             <span class="text-danger " ><?= form_error('remark');?></span>
                        </div>
                    </div>
                     
                 </div>
                 
           </div>
            <div class="user_form_row_data user_form_content ">
                <div class="user_submit_button mb-2 mt-2">
             
                    <input type="submit" name="epin_btn" value="Submit" name="epin_btn" class="user_btn_button">
                </div>
                
            </div>
       </div>
        
       <!--<div class="counting_of_pins">
        <div class="user_card_body">
            <div class="user_table_data">
                <table class="user_table_info_record pin_record">
                     <tbody>
                        <tr>
                            <th> </th>
                            <th>Amount( ₹ )</th>
                            <th>Qty</th>
                           
                        </tr>
                        <tr>
                            <td><input name="" type="checkbox" maxlength="10" id="" class="form-control user_input_text checkbox_data" placeholder=""> </td>
                            <td> Package -  700 ( 700 INR )</td>
                            <td>  <input name="" type="text" maxlength="10" id="" class="form-control user_input_text" placeholder=""></td>
                        </tr>
                     </tbody>
                </table>
                <button class="detail_pin_button">Calculate</button>
            </div> 
        </div> 

       </div>-->
        

    </div>



</div>
</div>
<br>
<br>