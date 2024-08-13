
  <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
-->
<style>
.dashboard_popup {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 99;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}
.dashboard_popup_inner {
    max-width: 500px;
    margin: 1.75rem auto;
    position: relative;
    width: auto;
    background: #151515;
    padding: 20px 30px 40px 30px;
    border-radius: 20px;
}

.dashboard_cross {
    text-align: end;
}


button#myPop3 {
background: none;
    border: none;
    color: grey;
    font-size: 25px;
    cursor: pointer;
}

.dashboard_popup_body {
    padding: 10px 0px;
}

.dashboard_popup_body h4 {
    font-size: 22px;
    color: #73BA3F;
    text-align: center;
    text-transform: capitalize;
    margin-bottom: 30px;
    font-weight: bold;
}

.dashboard_popup_body form input {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: none;
    outline: none;
    border-radius: 10px;
    background: #1D1D1D;
    color: grey;
}

.dashboard_popup_body select {
 width: 100%;
   margin-bottom: 10px;
   padding: 10px 6px;
   border: none;
   border-radius: 10px;
   background: #1D1D1D;
   color: grey;
   outline: none;
}

.whatapp_data a {
    color: #73BA3F;
    font-weight: 400;
    font-size: 14px;
    display: flex;
    align-items: center;
    text-decoration: none;
    
}
.whatapp_data a>i {
font-size: 26px;
    margin-right: 8px;
}

.whatapp_data {
    margin-bottom: 10px;
}

input.continue_popup {
    margin: 0px;
    background: #73BA3F !important;
    text-transform: uppercase;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
    color: black !important;
    box-shadow: 0 0 10px 0 #73BA3F;
    margin-top: 20px;
    border: 1px solid transparent !important;
    transition: all 0.4s;
}
input.continue_popup:hover{
background: transparent !important;
color: #73BA3F !important;
border-color: #73BA3F !important;
box-shadow: none;
}

input::placeholder{
color:#fff !important;
opacity:1 !important;
}

button.btn.continue_popup {
    color: #73ba3f;
    outline: none;
    border: 1px solid #73ba3f;
    box-shadow: 0 0 3px 0 #73ba3f;
}

.dashboard_popup{
    background: #151515d4;
}

</style>
 <?php
                
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
                $get_ip=$this->conn->runQuery('*','ip_whitelist',"ip='$ip'");
                $get_needs=$this->conn->runQuery('*','needs',"ip='$ip'");
                 
                    if(!$get_ip && !$this->session->has_userdata('need_set') && !$get_needs){
                         
                        ?>

    <div class="dashboard_popup">
        <div class="dashboard_popup_inner">
           <!-- <div class="dashboard_cross">
                <button id="myPop3">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>-->
            
            <div class="dashboard_popup_body">
              <h4>Let we help you</h4>
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
              <form action="" method="post">
                <input type="text" id="need_name" name="need_name" placeholder="Enter Name">
                 <small class="text-danger"><?= form_error('need_name');?></small>
                <input type="text" id="need_email" name="need_email" placeholder="Enter Email">
                 <small class="text-danger"><?= form_error('need_email');?></small>
                <select id="country_code"  class="" name="country_code" data-response="mobile_code" >
                    <option value="<?= set_value('phonecode');?>">Select Country</option>
                     <?php
                      $countries=$this->conn->runQuery('*','countries','1=1');
                      if($countries){
                          foreach($countries as $country){
                              ?> <option data-sortname="<?= $country->sortname;?>" data-phonecode="<?= $country->phonecode;?>" value="<?= $country->phonecode;?>"  ><?= $country->name;?>(<?= $country->phonecode;?>)</option><?php
                          }
                      }
                      ?>
                </select>
                 <small class="text-danger"><?= form_error('country_code');?></small>
                <input type="text" id="need_mobile" name="need_mobile" placeholder="Enter Mobile">
                 <small class="text-danger" ><?= form_error('need_mobile');?></small>
                <div class="whatapp_data">
                     <a href="https://wa.me/918837800687?text=Hi%2C%20I%20want%20to%20check%20the%20demo%2C%20Please%20Send%20me%20a%20Login%20Pin."> <button type="button" data-response_area="action_areap_a" class="btn continue_popup" ><i class="fa fa-whatsapp" style="color: green;font-size: 18px;"></i> Send Login pin on WhatsApp</button></a>
                </div>
                <input type="text" id="otp_input1" name="otp_input1" placeholder="Enter OTP">
                 <small class="text-danger" ><?= form_error('otp_input1');?></small>
                <div class="continue_popup_button">
                    <input type="submit" id="" class="continue_popup" name="submit" value="continue">
                </div>
              </form>
            </div>
        </div>
    </div>
    <?php 
                         
                    } 
                ?>
   
<script type="text/javascript">
        function RestrictFirstZero(e) {
            if (e.srcElement.value.length == 0 && e.which == 48) {
                e.preventDefault();
                return false;
            }
        };
 
        function PreventFirstZero(event) {
            if (event.srcElement.value.charAt(0) == '0') {
                event.srcElement.value = event.srcElement.value.slice(1);
            }
        };
        
       
        </script>
   <script>
    $(window).on('load', function () {
        $("#myPop3").click(function () {
            $(".dashboard_popup").css("display", "none");
        });
    });

</script>
