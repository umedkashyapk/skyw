<?php
$profile=$this->session->userdata("profile");

?>
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">home</a></li>            
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Fund</a></li>            
                <li class="breadcrumb-item active" aria-current="page">Add Fund </li>
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
<div class="nk-content nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-body">
                            <div class="components-preview wide-md mx-auto">
<div class="row" >
        <div class="col-md-2 col-lg-2 ">
            
        </div>
        <div class="col-md-8 col-lg-8 card" style="border:1px solid #ccc;padding-top:20px;">
             <div class="row" >
                 <div class="col-md-12 col-lg-12">
                    <div class="input-group grid_2">
        			        <span class="input-group-addon">Address </span>
                            <input type="text" id="referral_link_right" class="form-control" value="<?= $txn_address;?>">
                            <div class="input-group-btn" >
                                <button type="submit" class="btn btn-default"  onclick="copyLink('right')">
                                    <i class="fa fa-copy" style="color: #D3B916; font-size: 18px;"></i>
                                </button>
                            </div>
                        </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <br>
                    <iframe name="iframe" src="<?= $qrcode_url;?>"  scrolling=yes frameborder=0 height="300"></iframe>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 m-0" >
                    <br>
                    
                        <?php
                            echo '<h2><strong>Pay:   '.$tx_amount.' '.$currency2.'</strong></h2>';
                            echo  "Amount in $currency : $payable ";
                            echo "<br>To :  $txn_address ";
                        ?>
                    
                      <a style="margin-top:2px;" href="<?= $status_url;?>" class="btn btn-info" target="_blank">Get Status</a>
                      <br> 
                     <?= "You will receive $currency $amount in your wallet after deduction 5% as transaction charge.";?>
                </div>
               
             </div>
        </div>
</div>
</div>
</div>
</div>




