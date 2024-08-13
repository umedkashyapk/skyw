<style>
.card-header:first-child {
   color: white;
}

.form-inline1>a input, select, button {
   width: 100%;
}
</style>
<div class="container pages">  
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
                <li class="breadcrumb-item"><a href="#">Payment View</a></li>  |          
                <li class="breadcrumb-item active" aria-current="page">Payment View</li>
            </ol>
	   </div>
</div>

    <?php
    $usrId=$this->session->userdata('user_id');
    $task_details=$this->conn->runQuery('*','task_data_request',"id='$task_id' and u_code='$usrId'");
    $wallet=$this->conn->runQuery('*','user_wallets',"u_code='$usrId'");
    $main_walltet = array_column($wallet, 'c1');
    $payment_status=$this->conn->runQuery('status','transaction',"u_code='$usrId' and payment_id='$task_id'");
    ?>    
     <div class="card card-body ">
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
            ?><span style="color:#fff">Main Wallet Balance : <?= $this->conn->company_info('currency');?> <?= $main_walltet[0];?></span>
             <div class="info">
                  <p class="btn btn-info btn-sm"><strong>Note :</strong> 5% TDS will be deducted on payment made through wallet</p>
                </div>
            <form action="<?= $panel_path.'task/payment'?>" method="post" enctype= multipart/form-data>  
               <div class="col-lg-6">
                <div class="form-group">
                  <label for="" class="">Payment Type</label><br>
                  <select name="payment_type" id="payment_type" onchange="return pay_control();"  required>
                  <option value="">Select Payment Type</option>
                  <option value="upi">UPI</option></option>
                  <option value="main_wallet">Main wallet</option>
                  </select>
                     
                </div>
               <div class="form-group" id="image_div">
                 <label for="" class="">Payment Slip</label>
                  <input type="file" name="pay_slip" id="" class="form-control" >
                  
                </div>
                <div class="form-group">
                  <label for="" class="">Pay Amount</label>
                  <input  type="text"  class="form-control" name="amount" value="<?= $task_details[0]->product_mrp;?>" readonly>
                   <span class="text-danger " ><?= form_error('amount');?></span>
                </div>
                <br>
                 <input type="hidden" name="payment_id" value="<?= $task_id;?>">
                  <label for="" class="">Qr Code</label>
                  <br>
                 <div class="form-group" id="qr_div">
                     
                     <img src="<?= base_url().'images/qr_code/eth_new.png';?>" style="height:200px; width:200px;">
                     </div>
                  <?php
                  if($payment_status[0]->status=='1'){
                  ?>
                   <div class="info">
                   <p class="btn btn-success btn-sm">Payment Approved Successfully !</p>
                   </div>
                  <?php
                  }elseif($payment_status[0]->status=='0'){
                  ?>
              
               <div class="info">
               <p class="btn btn-success btn-sm">Payment Request Submitted Successfully !</p>
               </div>
               <?php
              }else{
               ?>
                <div class="user_form_row_data  ">
                 <div class="user_submit_button mb-2 mt-2">
                 <input type="submit" class="user_btn_button"  name="pay_btn" value="Pay now" >
                 </div>
                    
                </div>
               <?php
              }
               ?>
            </form>  
                
                
                
                
                
            </div>
        </div>
    </div>
   

                            
</div>
<br>
<br>

 <script>
    function pay_control(){
        var pay_page=$( "#payment_type" ).val();
        
        if(pay_page=='main_wallet'){
            $("#image_div").hide();
            $("#qr_div").hide();
           
        }else if(pay_page=='upi'){
            
           $("#image_div").show(); 
            $("#qr_div").show();
        }
         
    }
    </script>
    
