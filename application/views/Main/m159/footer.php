<style>

.footer_desc {
    margin-top: 20px;
}

.footer_desc h4 {
    color: #fff;
}

.footer_desc p {
    color: #fff !important;
    font-size: 14px;
}
    </style>

<!-- Footer -->
 <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section class="footer-section">
    <div class="container">
          <figure class="footer-sideshape mb-0">
            <img src="<?= $panel_url;?>assets/images/choose-background-11.png" alt="" height="100px" class="img-fluid">
        </figure>
        <div class="middle-portion">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-12">
                    <a href="index-2.html">
                        <figure class="footer-logo">
                            <img src="<?= $this->conn->company_info('logo');?>" style="width:<?php echo $this->conn->company_info('logo_width');?>;height:<?php echo $this->conn->company_info('logo_height');?>" class="img-fluid" alt="">
                        </figure>
                    </a>
                    <p class="text-size-16 footer-text text-white">Award-Wining, fast, modern, beautiful real-time charts-and a familiar drag and drop experience, for every kind of investor.</p>
                    <ul class="social_icons_list">
                        <!--<li class="circle"><a href="https://www.facebook.com/gambitaibot"><i class="fa-brands fa-facebook-f"></i></a></li>-->
                        <!--<li class="circle"><a href="https://twitter.com/gambitaibot"><i class="fa-brands fa-twitter"></i></a></li>-->
                        <!--       <li class="circle"><a href="https://www.youtube.com/channel/UCxcMXfNSWLNY1boWt0e3W-A"><i class="fa-brands fa-youtube"></i></a></li>-->
                      <li>
                          <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                      </li>
                       <li>
                          <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      </li>
                       <li>
                          <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                      </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-12 col-12 d-md-block d-none">
                    <div class="links">
                        <h4 class="heading text-white">Useful Links</h4>
                        <ul class="list-unstyled mb-0">
                            <li><i class="fa-solid fa-angle-right"></i><a href="<?= base_url();?>index" class=" text-size-16 text text-decoration-none">Home</a></li>
                            <li><i class="fa-solid fa-angle-right"></i><a href="<?= base_url();?>about" class=" text-size-16 text text-decoration-none">About</a></li>
                            <li><i class="fa-solid fa-angle-right"></i><a href="<?= base_url();?>service" class=" text-size-16 text text-decoration-none">Services</a></li>
                         
                        </ul>
                    </div>
                </div>
               <div class="col-lg-3 col-md-2 col-sm-12 col-12 d-lg-block d-none">
                       <div class="links list-pd">
                        <h4 class="heading text-white">Our Services</h4>
                        <ul class="list-unstyled mb-0">
                           <li><i class="fa-solid fa-angle-right"></i><a href="#" class=" text-size-16 text text-decoration-none">Download App</a></li>
                            <li><i class="fa-solid fa-angle-right"></i><a href="<?= base_url();?>projects" class=" text-size-16 text text-decoration-none">Our Works</a></li>
                            <li><i class="fa-solid fa-angle-right"></i><a href="<?= base_url();?>contact" class=" text-size-16 text text-decoration-none">Contact us</a></li>
                           
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-sm-block">
                    <div class="icon">
                        <h4 class="heading text-white">Contact us</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="text">
                                <i class="fa fa-phone fa-icon footer-location"></i>
                                <a href="tel:+4733378901" class="mb-0 text text-decoration-none text-size-16"><?= $this->conn->company_info('company_mobile');?></a></li>
                            <li class="text">
                                <i class="fa fa-envelope fa-icon footer-location"></i>
                                <a href="" class="mb-0 text text-decoration-none text-size-16"><?= $this->conn->company_info('company_email');?></a></li>
                            <li class="text">
                                <i class="fa-solid fa-location-dot footer-location footer-location3"></i>
                                <p class="text-size-16"><?= $this->conn->company_info('company_address');?></p></li>
                               
                        </ul>
                    </div>
                </div>
            </div>
           <!--<div class="row">
          <div class="col-12">
              <div class="footer_desc">
                  <h4>General Risk Warning</h4>
                  <p>The financial products offered by the company carry a high level of risk and can result in the loss of all your funds. You should never invest money that you cannot afford to lose.Before deciding to participate in the Forex market, you should carefully consider your investment objectives, level of experience and risk appetite. Most importantly, do not invest money you cannot afford to lose. </p>
                  <p>There is considerable exposure to risk in any off-exchange foreign exchange transaction, including, but not limited to, leverage, creditworthiness, limited regulatory protection and market volatility that may substantially affect the price, or liquidity of a currency or currency pair. </p>
                  <p>Moreover, the leveraged nature of forex trading means that any market movement will have an equally proportional effect on your deposited funds. This may work against you as well as for you. The possibility exists that you could sustain a total loss of initial margin funds and be required to deposit additional funds to maintain your position. If you fail to meet any margin requirement, your position may be liquidated, and you will be responsible for any resulting losses. </p>
             <p>There are risks associated with utilizing an Internet-based trading system including, but not limited to, the failure of hardware, software, and Internet connection. <?= $this->conn->company_info('company_name');?> is not responsible for communication failures or delays when trading via the Internet. <?= $this->conn->company_info('company_name');?> employs backup systems and contingency plans to minimize the possibility of system failure, and trading via telephone is always available. </p>
             <p>Any opinions, news, research, analyses, prices, or other information contained on this website are provided as general market commentary, and do not constitute investment advice. <?= $this->conn->company_info('company_name');?> is not liable for any loss or damage, including without limitation, any loss of profit, which may arise directly or indirectly from use of or reliance on such information. <?= $this->conn->company_info('company_name');?> has taken reasonable measures to ensure the accuracy of the information on the website. The content on this website is subject to change at any time without notice.  </p>
            <h4><?= $this->conn->company_info('company_name');?></h4>
            <p><?= $this->conn->company_info('company_name');?> Limited whose registered office is 9th Floor 107 Cheapside, London, United Kingdom, EC2V 6DN, is a registered company FRO UK Company House, Company registration number : 232324, Operating trading service business globally according to UK Law and regulation.</p>
             
               
             
              </div></div></div>-->
        </div>
        <div id="fixed-form-container">
            <div class="image">
                <figure class="footer-image mb-0">
                    <img src="<?= $panel_url;?>assets/images/footer-image.png" alt="" class="img-fluid">
                </figure>
            </div>
            <div class="body">
                <form id="contactpage1" method="POST" action=" ">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Your Name:" name="name"> 
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Your Email:" name="emailid">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" placeholder="Phone:" name="phone">
                    </div>
                    <div class="form-group">
                        <textarea class="form_style" placeholder="Message" rows="3" name="msg"></textarea>
                    </div>
                    <button type="submit" class="submit_now text-decoration-none">Submit Now</button>
                </form>
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-12">
                    <p class="mb-0 text-white">Copyright 2024, <?= $this->conn->company_info('company_name');?> All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest compiled JavaScript -->
<script src="<?= $panel_url;?>assets/js/jquery-3.6.0.min.js"> </script>
<script src="<?= $panel_url;?>assets/js/bootstrap.min.js"> </script>
<script src="<?= $panel_url;?>assets/js/video_link.js"></script>
<script src="<?= $panel_url;?>assets/js/video.js"></script>
<script src="<?= $panel_url;?>assets/js/counter.js"></script>
<script src="<?= $panel_url;?>assets/js/custom.js"></script>
<script src="<?= $panel_url;?>assets/js/animation_links.js"></script>
<script src="<?= $panel_url;?>assets/js/animation.js"></script>


 <script type="text/javascript">
 $(document).ready(function () {
   $('.menu-icon').click(function() {
       $('.onepage').toggle();
   }) 
});
 </script>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            setTimeout(function(){
                jQuery('.coinpool-animation').addClass('start-animation');
            }, 1000);
            setTimeout(function(){
                jQuery('.coinpool-animation .lines').addClass('active');
            }, 2000);
        });


 </script>
 
 
	
	<script>
    $('.check_sponsor_exist').change(function (e) { 
        var ths = $(this);
        var res_area = $(ths).attr('data-response');
        var sponsor = $(this).val();        
        $.ajax({
          type: "post",
          url: "<?= base_url('register/check_sponsor_exist');?>",
          data: {u_sponsor:sponsor},          
          success: function (response) {            
             var res = JSON.parse(response);          
            if(res.error==true){
              $('#'+res_area).html(res.msg).css('color','red');              
            }else{
              $('#'+res_area).html(res.msg).css('color','green');              
            }
          }
        });
    });

    $('.check_username_exist').change(function (e) { 
        var ths = $(this);
        var res_area = $(ths).attr('data-response');
        var username = $(this).val();        
        $.ajax({
          type: "post",
          url: "<?= base_url('register/check_username_exist');?>",
          data: {username:username},          
          success: function (response) {  
            //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){
              $('#'+res_area).html(res.msg).css('color','red');              
            }else{
              $('#'+res_area).html(res.msg).css('color','green');              
            }
          }
        });
    });

    $('.check_mobile_valid').change(function (e) {
         
        var ths = $(this);
        var res_area = $(ths).attr('data-response');
        var mobile = $(this).val();        
        $.ajax({
          type: "post",
          url: "<?= base_url('register/check_mobile_valid');?>",
          data: {mobile:mobile},          
          success: function (response) {  
            //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){
              $('#'+res_area).html(res.msg).css('color','red');              
            }else{
              $('#'+res_area).html(res.msg).css('color','green');              
            }
          }
        });
    });

    $('.check_email_valid').change(function (e) {
         
        var ths = $(this);
        var res_area = $(ths).attr('data-response');
        var email = $(this).val();        
        $.ajax({
          type: "post",
          url: "<?= base_url('register/check_email_valid');?>",
          data: {email:email},          
          success: function (response) {  
            //alert(response);
            var res = JSON.parse(response);          
            if(res.error==true){
              $('#'+res_area).html(res.msg).css('color','red');              
            }else{
              $('#'+res_area).html(res.msg).css('color','white');              
            }
          }
        });
    });

    $('.country').change(function (e) { 
       var rr = $(this).find(':selected').attr('data-phonecode');       
       var mobile_code_sec =  $(this).attr('data-response');      
       $('.'+mobile_code_sec).html(rr);
    });

    $('.no_space').keyup(function (e) {         
         var TCode = $(this).val();
        var res_area = $(this).attr('data-response');
	    if( /[^a-zA-Z0-9@!#$%&?|_\-\/]/.test( TCode ) ) {
			$(this).val('');
			
			$('#'+res_area).html('Space Not Allowed.').css('color','red');
			return false;
		}                
    });





  </script>
</body>



</html>