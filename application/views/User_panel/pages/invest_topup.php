<style>
input.user_btn_button{
  margin-top:10px;
}

input.form-control.check_username_exist {
    background: none;
    border: 1px solid #a4621657;
    color: #fff;
}
.form-control:focus {
    box-shadow: none !important;
    
}

select.form-control.selected_pins {
    border: 1px solid #a462165e;
    background: none;
    color: #adadad;
}
span#wallet {
    color: #fff;
}

span#status {
    color: #fff;
    word-break: break-word;
    display: block;
}
</style>


<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home /</a></li>            
            <li class="breadcrumb-item"><a href="">AI Subscription</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> AI Subscription</li>
         </ol>
	   </div>
</div>
<style>
  .pin_top_page_content h5 {
    color: var(--text2);
}
span#wallet {
    color: #fff !important;
}
   .pin_top_page_content {
   text-align: end;
   }
   .detail_topup p i {
   font-size: 14px;
   margin-right: 10px;
   }
   span#total_pins{
    color: var(--text2) !important;
   }
   
   button.user_btn_button {
   padding: 6px 12px;
   border: none;
   background: #5030ab;
   font-size: 14px;
   border-radius: 4px;
   text-transform: capitalize;
   color: #fff;
   font-weight: 500;
   }
   .detail_topup {
   padding: 16px 16px;
   border: none;
   background: #5030ab;
   font-size: 14px;
   border-radius: 4px;
   text-transform: capitalize;
   color: #fff;
   font-weight: 500;
 
   }
   .detail_topup h4 {
   font-size: 20px;
   font-weight: 500;
   text-transform: uppercase;
   }
   
   h4{
    color:#fff;
   }
   
   input.user_btn_button.btn-remove.detail {
   width: 100%;
    border-radius: 6px;
}
   .box_image img {
    width: 100%;
       max-width: 216px;
    margin: auto;
    display: block;
}
input.user_btn_button.btn-remove.detail:hover {
    background: none !important;
 
    box-shadow: 0px 0px 3px 3px #d3ae47 !important;
}
</style>
</head>
<body>
   <div class="pin_topup_page">
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
    <div class="col-md-3"></div>
            <div class="col-md-6">
                

               <div class="form_topup">
                   <div class="pcakge_btn">
                       <a href="<?= $panel_path.'orders';?>">Packages</a>
                   </div>
                                   <div class="box_image">
                    <img src="<?= base_url();?>images/logo/LOGO yellow.png" alt="images">
                    
                </div>
               <?php  
                $userid=$this->session->userdata('user_id');
                $available_pins=$this->conn->runQuery('count(pin) as cnt','epins',"use_status=0 and u_code='$userid'");
                $cnt_pins=($available_pins ? $available_pins[0]->cnt :0);
                ?>
               
                <div class="pin_top_page_content">
                      <!--<a href="<?= $panel_path.'invest/reinvestment';?>" class="user_btn_button detail">Upgrade</a>-->
                     <?php
                if($this->conn->setting('topup_type')=='pin'){
                ?>
                <h5>Pin Available</h5>
                <span id="total_pins" class="text_span"><i class="fa fa-thumb-tack" aria-hidden="true"></i>&nbsp; <?= $cnt_pins;?></span>
                <?php } ?>  
                  </div>
                  <form action="" method="post">
                  <?php
                   
                   $currency=$this->conn->company_info('currency');
                   if($this->conn->setting('topup_type')=='amount'){
       
                  
                       $available_wallets=$this->conn->setting('invest_wallet');
       
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
                                    echo "<span id='wallet' >$wlt_name : $currency $balance</span>";
                                   
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
                        $all_pin=$this->conn->runQuery("pin_rate,pin_type",'pin_details',"status=1 and topup_status=1");
                        if($all_pin){
                            foreach($all_pin as $pindetails){
                                ?><option amount="<?= $pindetails->pin_rate;?>" value="<?= $pindetails->pin_type;?>"><?= $pindetails->pin_type;?></option><?php
                            }
                        }
                        ?>
                        </select>
                        <span class="text-danger" ><?= form_error('selected_pin');?></span>  
                     </div>
                    
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
                                 
                              
                           <input type="submit" class="user_btn_button btn-remove detail" name="topup_btn"  onclick="return confirm('Are you sure? you wants to Submit.')" value="Topup">
                         
                           
                          <?php
                        } 
                     }
                  ?>
                    
                 </form>
               </div>
            </div>
            <div class="col-md-3"></div>
         </div>
      </div>
   </div>










<br>
<br>


 <script>
   ( function($) {
  $(".btn-remove").click(function() {  
    $(this).css("display", "none");      
  });
} ) ( jQuery );
</script>


   
<script src="https://unpkg.com/web3@latest/dist/web3.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/web3modal"></script>
	<script type="text/javascript" src="https://unpkg.com/evm-chains@0.2.0/dist/umd/index.min.js"></script>
	<script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider"></script>
	<script type="text/javascript" src="https://unpkg.com/fortmatic@2.0.6/dist/fortmatic.js"></script>
	<script src="https://cdn.ethers.io/lib/ethers-5.1.umd.min.js" type="text/javascript"></script>


 














