 
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
 
 <style>
     .qr_data {
    margin-top: 134px;
}
 </style>

<?php
$user_id=$this->session->userdata('user_id');
$profile=$this->profile->profile_info($user_id);

$ref=base_url()."register?ref=".$profile->username;
?>


    <div class="qr_data">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail_qr">
                       <img style="height:;width:;" src="<?= base_url('user/fund/my_qr_code?address='.$ref);?>" /></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!--<script>-->
      
 <!--       var referralURL = getReferralURL();-->
 <!--       var qrcode = new QRCode(document.getElementById("qrcode"), referralURL);-->

 <!--       function getReferralURL() {-->
          
 <!--           return "https://test.mlmreadymade.com/Gambit-6/register?ref=demo";-->
 <!--       }-->
 <!--   </script>-->
<br>
