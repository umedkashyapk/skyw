<?php
   $profile=$this->session->userdata("profile");
   $user_id=$this->session->userdata('user_id');
    $currency = $this->conn->company_info('currency');
   ?>
   
   <section class="network-sec">
        <div class="container">
             <div class="eraning_link_data">
              <div class="row">
                   
                     <div class="col-md-2">
                        <div class="earning_link">
                            <a href="<?= $panel_path.'transactions/withdrawals';?>">Withdrawal History</a>
                        </div>
                    </div>
                    
                  
                    
                    </div>
                </div>
          
        </div>
    </section>

<section class="widthraw_page" >
        <div class="container">
            <div class="row">
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



    
                <div class="col-md-6">
                    
                    <div class="widthraw_heading">
                         <!-- <a href="<?= $panel_path.'transactions/withdrawals';?>" class="user_btn_button detail">Withdrawal History</a>-->
                         <div class="widthraw_heading_text">
                            <h2>Withdraw</h2>
                            
                         </div> 
                         <div class="list_widthraw">
                               <?php
                              $total_paid_withdrawal=$this->conn->runQuery("SUM(amount) as amt",'transaction',"u_code='$user_id' and tx_type='withdrawal' and status='1'")[0]->amt;
                              ?>
                           <ul>
                              <li><p>Payout Paid Amount <span><?= $total_paid_withdrawal ? $total_paid_withdrawal:0;?> &nbsp;<?= $currency;?></span></p></li>
                            <li>
                                <p>Minimum Payout Amount <span><?= $this->conn->setting('min_withdrawal_limit');?>&nbsp; <?= $this->conn->company_info('currency');?></span></p>
                            </li>
                           <!-- <li>
                                <p>Withdrawal Conditions <span><?= $this->conn->setting('wd_conditions');?></span></p>
                            </li>-->
                            
                           </ul>
                         </div>  
                    </div>
                </div>
                <div class="col-md-6">
                    
                <form action="" method="post">
                    
                  <div class="widthraw_heading">    
                  
                  
                <?php
                   $userid=$this->session->userdata('user_id');
                   $currency=$this->conn->company_info('currency');
                   $available_wallets=$this->conn->setting('withdrawal_wallets');
                   
                   if($available_wallets){
                       $useable_wallet=json_decode($available_wallets);
                   
                       if(count((array)$useable_wallet)>1){
                           foreach($useable_wallet as $wlt_key=>$wlt_name){
                               $balance = $this->update_ob->wallet($userid,$wlt_key);
                               echo "<span class='text-white' >$wlt_name : $currency $balance </span><br>";                           
                             
                           }
                           ?>
                           <span class='text-white' >Color :<?php
                         
                        if($profile->selected_color=='pink'){
                            echo'<i class="fa fa-circle btn-sm" style="color:#FF10F0;" aria-hidden="true"></i>';
                            echo "Pink";
                            
                        }elseif($profile->selected_color=='yellow'){
                          echo'<i class="fa fa-circle btn-sm" style="color:#FFC300;" aria-hidden="true"></i>';
                            echo "Yellow";  
                        }elseif($profile->selected_color=='green'){
                          echo'<i class="fa fa-circle btn-sm" style="color:#006400;" aria-hidden="true"></i>';
                            echo "Green";  
                        }
                        ?> </span><br>
                           <div class="form-group row">
                           <label for="input-1" class="col-form-label">Select Wallet*</label>
                           <div class="col-sm-12">
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
                        </div>
                        <?php
                           }else{
                               foreach($useable_wallet as $wlt_key=>$wlt_name){
                                   $balance = $this->update_ob->wallet($userid,$wlt_key);
                                    "<span class=''>$wlt_name : $currency $balance</span>";
                                   ?><input type="hidden" name="selected_wallet" value="<?= $wlt_key;?>"><?php
                           }
                           }
                           }
                           ?>
                  
                        <div class="widthraw_heading_payout_request">
                           
                            <?php
                            foreach($useable_wallet as $wlt_key=>$wlt_name){
                                   $balance = round($this->update_ob->wallet($userid,$wlt_key),2);
                                     "<span class=''> $currency $balance</span>";
                            }
                            ?>
                           
                           
                            </span></h3>
                        </div>
                        <div class="form_widthrwa_request">
                            <label>
                                Payout Amount
                            </label>
                            <input type="number" placeholder="Enter Payout Amount" name="amount">
                             <span class="" style='color:white'><?= form_error('amount');?></span>
                             
                             
                               <?php
                           if($profile_edited!='readonly'){
                               $withdrawal_with_otp=$this->conn->setting('withdrawal_with_otp');
                               if($withdrawal_with_otp=='yes'){
                                 $display=(isset($_SESSION['otp']) ? 'block':'none');
                                 ?>
                        <button type="button" data-response_area="action_areap" class="submit_withrawal send_otp_withdrawal amount_data" >Send OTP</button><br>
                        <div id="action_areap" style="display:<?= $display;?>">
                           <div class="form-group">
                              <label for="">Enter OTP </label>
                              <input type="text" name="otp_input1" id="otp_input1" value="<?= set_value('otp_input1');?>" class="form-control user_input_text" placeholder="Enter OTP" aria-describedby="helpId">
                              <span class="text-danger" ><?= form_error('otp_input1');?></span> 
                           </div><br>
                           <button type="submit" class="amount_data btn-remove"  name="withdrawal_btn" onclick="return confirm('Are you sure? you wants to Submit.')">submit</button>
                        </div>
                        <?php
                           }else{
                             ?>
                              
                        <button type="submit" class="amount_data btn-remove"  name="withdrawal_btn" onclick="return confirm('Are you sure? you wants to Submit.')">submit</button>
                        <?php
                           } 
                           }
                           
                           
                           ?>
                           
                        </div>
                    </div>
                      </form>
                </div>
            </div>
        </div>
    </section>
 <script>
      ( function($) {
      $(".btn-remove").click(function() {  
       $(this).css("display", "none");      
      });
      } ) ( jQuery );
   </script>
   
   <br>
<br>
   