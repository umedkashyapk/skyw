<style>

.card.card-body.card-bg-1 {
    background:#181b23 !important;
}
input.user_btn_button {
    text-align: center;
    margin: auto;
    display: block;
}
img.deta_fund {
    margin-top: 15px;
    width: 100%;
    max-width: 200px;
}

.input-group.fund {
    margin-bottom: 10px;
}
button.data_button {
     margin-left: 0px; 
    padding: 8px;
     margin-top: 0px; 
   
    border: none;
    background: #964de3 !important;
}

button.data_button i {
    color: #fff;
}
</style>
<section class="network-sec">
        <div class="container">
             <div class="eraning_link_data">
              <div class="row">
                   
                   <div class="col-md-2">
                       <a href="<?= $panel_path.'crypto/add-fund';?>">
                        <div class="earning_link fund1"> 
                            Add Fund
                        </div>
                        </a>
                    </div><div class="col-md-2">
                        <a href="<?= $panel_path.'crypto/add_fund_history';?>">
                        <div class="earning_link">
                            Add Fund History
                        </div>
                        </a>
                    </div>
                     <!--<div class="col-md-2">
                         <a href="<?= $panel_path.'fund/fund-transfer';?>">
                        <div class="earning_link">
                            Fund Transfer
                        </div>
                        </a>
                    </div>
                     <div class="col-md-2">
                         <a href="<?= $panel_path.'fund/transfer-history';?>">
                        <div class="earning_link">
                            Fund Transfer History
                        </div>
                        </a>
                    </div>
                    
                      <div class="col-md-2">
                          <a href="<?= $panel_path.'Fund/fund-convert';?>">
                        <div class="earning_link">
                            Fund Convert
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= $panel_path.'fund/convert-history';?>">
                        <div class="earning_link">
                            Fund Convert History
                        </div>
                        </a>
                    </div>-->
                   
                    </div>
                </div>
           
            
        </div>
    </section>

<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">home</a></li>            
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Fund</a></li>            
                <li class="breadcrumb-item active" aria-current="page"> Fund add</li>
            </ol>
	   </div>
	  
</div>

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
    
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
       <!-- <div class="card card-body card-bg-1">
            
            	<div class="input-group card-bg-1 ">
                    <div class="input-group-prepend">
                      <span style="height:38px;" class="input-group-text">Address</span>
                    </div>
                    <input type="text"style="height:38px;"  id="referral_link_right" class="form-control" value="<?=$address;?>">
                    <div class="input-group-append input-group-btn">
                          
                        <button type="submit" class="btn btn-success"   onclick="copyLink('right')">
                            <i class="fa fa-copy" style="color: #D3B916; font-size: 18px;"></i>
                        </button>
                        
                </div>
            </div>
            <center>
           <img style="height:200px;width:200px;" src="<?= base_url('user/fund/my_qr_code?address='.$address);?>" />
            </center>
        </div>-->
         
        <div class="card card-body card-bg-1" id="mydiv">
            <!--<p style="color:white";>&nbsp; QR code valid for <?= $expiryDate?></p>-->
               <p style="color: white;" id="countdown-timer">&nbsp; QR code valid for </p>
            <center>
                <b class="detail_fund" style="color:#fff;"> Pay : <?= $amount;?> </b>
                <br>
           <img class="deta_fund" style="height:;width:;" src="<?= base_url('user/fund/my_qr_code?address='.$address);?>" /></center>
            
            <p>&nbsp;</p> 
           
             <div class="input-group fund ">
                    <!--<div class="input-group-prepend">
                      <span style="height:38px;" class="input-group-text">Address</span>
                    </div>-->
                    <input type="text" id="referral_link_right" class="form-control" value="<?=$address;?>">
                    <div class="input-group-append input-group-btn">
                          
                        
                       <button type="submit" class="data_button"  onclick="copyLink('right')">
                            <i class="fa fa-copy" style=" "></i>
                        </button>  
                        
                </div>
            </div>
            
        </div>
		</div>
</div>
</div>
<br>
<br>

<script>
        // Set the target date and time
        var targetDate = new Date("<?php echo $expiryDate; ?>").getTime();

        // Update the countdown every second
        var countdownInterval = setInterval(function() {
            // Get the current date and time
            var currentDate = new Date().getTime();

            // Calculate the time difference between current time and target time
            var timeDifference = targetDate - currentDate;

            if (timeDifference > 0) {
                // Calculate the remaining days, hours, minutes, and seconds
                var days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                // Update the countdown timer text
                document.getElementById("countdown-timer").innerHTML = '&nbsp; QR code valid for ' + days + ' days, ' + hours + ' hours, ' + minutes + ' minutes, ' + seconds + ' seconds';
            } else {
                // Update the countdown timer text when the QR code has expired
                document.getElementById("countdown-timer").innerHTML = '&nbsp; QR code has expired!';
                clearInterval(countdownInterval); // Stop the countdown interval
            }
        }, 1000); // Update the timer every 1000ms (1 second)
    </script>
<script>
    
  setTimeout(function() {
   // $('#mydiv').fadeOut('fast');
    $("#mydiv").hide();
      
}, 1800000);
    
</script>