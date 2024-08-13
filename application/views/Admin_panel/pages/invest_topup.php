 <style>
     input.user_btn_button.btn-remove.detail {
    background: #f8ab06;
    padding: 10px;
    border: none;
    border-radius: 4px;
    color: #fff;
}

select#selected_pin {
    width: 100% !important;
    margin: 0px;
    max-width: 100%;
}
     
 </style>

<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Activation</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <!--<li class="breadcrumb-item"><a href="#"></a></li>            -->
            <li class="breadcrumb-item active" aria-current="page"> Activation</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase">Activation</h6>
<hr>
<?php 
                        $success['param']='success';
                        $success['alert_class']='alert-success';
                        $success['type']='success';
                        $this->show->show_alert($success);
                        ?>
                            <?php 
                        $erroralert['param']='error';
                        $erroralert['alert_class']='alert-danger';
                        $erroralert['type']='error';
                        $this->show->show_alert($erroralert);
                    ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div class="card card-body">
       <form action="" method="post">
                  <?php
                   
                   $currency=$this->conn->company_info('currency');
                   if($this->conn->setting('topup_type')=='amount'){
       
                  
                       $available_wallets=$this->conn->setting('invest_wallets');
       
                       if($available_wallets){
                           $useable_wallet=json_decode($available_wallets);
                       
                           if(count((array)$useable_wallet)>1){
       
       
                               foreach($useable_wallet as $wlt_key=>$wlt_name){
                                   $balance = round($this->update_ob->wallet($userid,$wlt_key),2);
                                   echo "$wlt_name : $currency $balance <br>";                           
                                  
                               }
       
                               ?>
                               <div class="form-group">
                                   <label for="">Select Wallet</label>
                                   <select name="selected_wallet" id="" class="form-control">
                                       <option value="">Select Wallet</option>
                                       <?php
                                       foreach($useable_wallet as $wlt_key=>$wlt_name){
                                           ?>
                                           <option value="<?= $wlt_key;?>"><?= $wlt_name;?></option>
                                           <?php
                                       }
                                       ?>
                                   </select>
                                   
                               </div>
                               <?php
                           }else{
                               foreach($useable_wallet as $wlt_key=>$wlt_name){
                                   $balance = round($this->update_ob->wallet($userid,$wlt_key),2);
                                    "<span id='wallet' >$wlt_name : $currency $balance</span>";
                                   
                                   ?><input type="hidden" name="selected_wallet" value="<?= $wlt_key;?>"><?php
                               }
                           }
                       }
                   }
                   ?>
                   <span class="text-danger" ><?= form_error('selected_wallet');?></span>
       
                     <div class="form-group">
                        <label>Enter User ID*</label>
                        <input type="text" name="tx_username" id="tx_username"  value="<?= set_value('tx_username');?>" data-response="username_res" class="form-control check_username_exist" placeholder="Enter User ID" aria-describedby="helpId">
                        <span class="" id="username_res"></span>
                        <span class="text-danger" id="username_res"><?= form_error('tx_username');?></span>   
                    </div>
                     <div class="form-group">
                        <label>Select Package*</label>
                        <select class="form-control selected_pins" name="selected_pin" onkeyup="fetch_amount();" id="selected_pin" data-response="total_pins" required="">
                        <option value="">Select Package</option>
                        <?php
                        $all_pin=$this->conn->runQuery("pin_rate,pin_type",'pin_details',"status!=0 ");
                        if($all_pin){
                            foreach($all_pin as $pindetails){
                                ?><option amount="<?= $pindetails->pin_rate;?>" value="<?= $pindetails->pin_type;?>"><?= $pindetails->pin_type;?></option><?php
                            }
                        }
                        ?>
                        </select>
                        <span class="text-danger" ><?= form_error('selected_pin');?></span>  
                     </div>
                  <!--   
                     <div class="form-group">
                         
                        <label>Income*</label>
                        <select class="form-control" name="income_status"  id="income_status"  required="">
                        <option value="">Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                        </select>
                        <span class="text-danger" ><?= form_error('income_status');?></span>  
                     </div>-->
                     
                      <!-- <div class="form-group">
                        <label>Select Colour*</label>
                        <select class="form-control" name="selected_color" id="selected_color"  required="">
                          <option>Select Colour</option>
                          <option  value="green">Green </option>
                          <option  value="pink">Pink </option>
                          <option  value="yellow">Yellow </option>
                          
                        </select>
                        <span class="text-danger" ><?= form_error('selected_color');?></span>  
                     </div> -->
                     
                    
                     <?php
                    if($profile_edited!='readonly'){
                        $invest_toup_with_otp=$this->conn->setting('invest_toup_with_otp');
                        if($invest_toup_with_otp=='yes'){
                          $display=(isset($_SESSION['otp']) ? 'block':'none');
                          ?>
                          <button type="button" data-response_area="action_areap" class="user_btn_button send_otp" >Send OTP</button>
                          
                          <div id="action_areap" style="display:<?= $display;?>"> 
                            <div class="form-group row">
                             <label for="input-1" class="col-sm-2 col-form-label">Enter Otp*</label>
                             <div class="col-sm-10">
                              <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1');?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                              <span class=" " ><?= form_error('otp_input1');?></span> 
                              </div> 
                              
                            </div> 
                                  <span id="status"></span> 
                             <!--<input type="submit" class="user_btn_button btn-remove" name="topup_btn"   onclick="return confirm('Are you sure? you wants to Submit.')" value="Topup">-->
                             <input type="submit" class="user_btn_button btn-remove" id="btn-connect" name="topup_btn"  value="AI Subscription">
                           
                          </div>
                          <?php
                        }else{
                          ?>
                                <!-- <span id="status"></span> 
                                 <b style="color:green">Token:<span style="color:green" id="token_amnt"> </span></b>-->
                                 
                              
                           <input type="submit" class="user_btn_button btn-remove detail" name="topup_btn"  onclick="return confirm('Are you sure? you wants to Submit.')" value="Activation">
                         
                           
                          <?php
                        } 
                     }
                  ?>
                    
                 </form>
       
       
       
    </div>
    </div>
</div>
 
