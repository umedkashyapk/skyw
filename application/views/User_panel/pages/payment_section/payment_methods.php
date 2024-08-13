<?php
$user_id=$this->session->userdata('user_id');
$company_payment_methods=$this->conn->runQuery('*','company_payment_methods',"status='1'");
$user_payment_methods=$this->conn->runQuery('*','user_payment_methods',"status='1' and u_code='$user_id'");
?>

<style>
    table.user_table_info_record.pin_record th, td {
        border: 1px solid #dddde5;
}

button.user_btn_button.send_otp {
    margin: 5px 10px 10px 20px;
}
.user_form_row_data.user_form_content{
    padding-left:0px;
}
div#action_areap {
    margin: 0px 20px;
}
</style>


<div class="user_content">
    <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
                    
            <li class="breadcrumb-item active" aria-current="page">Add-Account</li>
         </ol>
	   </div>
	 
</div>

 <?php
      //  add one time address condition //
 
       // if($user_payment_methods[0]->status!='1'){
        ?>
        <div class="user_main_card mb-3 detail_data_pins">
       	<form role="form" method="post" action=""  enctype="multipart/form-data"/>
            <div class="user_card_body user_content_page pins_detail">
               
                 <div class="user_form_row user_form_content">
                     <div class="row">
                     
                     <div class="col-lg-12 mb-2">
                        <label class="label_user_title">Select Payment Type</label>
                        <select class="form-control d-inline form-control" name="account_type" id="account_type" data-response="add_account_sec" data-blursection="blursection" data-loader="account_add_loader">
                             <option value="">---Select Type---</option>
    							    <?php
    							    foreach($company_payment_methods as $method_details){
    							    ?>
    							    <option value="<?= $method_details->unique_name;?>" ><?= $method_details->method_name;?></option>
    							    <?php } ?>
                        </select>
                    </div>
                     <div id="add_account_sec">
    						      
    						  </div>
    						  
    						   <!--<div class="col-lg-12 mb-2">-->
             <!--           <label class="label_user_title">Qr Code</label>-->
             <!--           <input type="file" name="img" class="form-control" id="" placeholder="">-->
             <!--       </div>-->
                 </div>
                 
           </div>
          
        <?php
            if($profile_edited!='readonly'){
                $account_with_otp=$this->conn->setting('account_with_otp');
                if($account_with_otp=='yes'){
                  $display=(isset($_SESSION['otp']) ? 'block':'none');
                  ?>
                  <button type="button" data-response_area="action_areap" class="user_btn_button send_otp" >Send OTP</button>
                  
                  <div id="action_areap" style="display:<?= $display;?>"> 
                    <div class="form-group">
                      <label for="">Enter OTP </label>
                      <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1');?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                      <span class="text-danger" ><?= form_error('otp_input1');?></span> 
                    </div> 
                      <div class="user_form_row_data user_form_content ">
                        <div class="user_submit_button mb-2 mt-2">
                            <input type="submit" name="add_btn" value="Add Account" id="" class="user_btn_button" >
                        </div>
                        
                    </div>
                  </div>
                  <?php
                }else{
                  ?>
                   <div class="user_form_row_data user_form_content ">
            <div class="user_submit_button mb-2 mt-2">
                <input type="submit" name="add_btn" value="Add Account" id="" class="user_btn_button" style="margin-left:20px;">
            </div>
            
        </div>
                  <?php
                } 
          }
          
            
            ?>
           
            
            
       </div>
       </form>
        
       <div class="counting_of_pins">
        <div class="user_card_body">
            <div class="user_table_data">
              <!--  <table class="user_table_info_record pin_record">
                     <tbody>
                        <tr>
                            <th>S No. </th>
                            <th>Default</th>
                            <th>Account</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>1 </td>
                            <td>0</td>
                            <td>2</td>
                            <td>2</td>
                            <td>2</td>
                        </tr>
                     </tbody>
                </table>-->
                 <?php
                            $this->load->view($panel_directory.'/pages/payment_section/my_accounts');
                        ?>
                <!--<button class="detail_pin_button">Add Account</button>-->
            </div> 
        </div> 

       </div>
        

    </div>
     <?php
      //  }else{
    ?>
 <!--<div class="user_main_card mb-3 detail_data_pins">
      
        
      <div class="counting_of_pins">
    <div class="user_card_body">
          <div class="user_table_data">
             
                 <?php
                          //  $this->load->view($panel_directory.'/pages/payment_section/my_accounts');
                        ?>
              
          </div> 
       </div> 

     </div>
        

    </div>-->
    <?php
      //  }
    ?>


</div>
</div>