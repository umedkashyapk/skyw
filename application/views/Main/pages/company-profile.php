<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css" type="image/png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
::-webkit-scrollbar {
  width: 10px;
}
.responsive_moblie_view {
    position: relative;
    overflow-y: auto;
    max-width: 375px;
    height: 701px;
    background: #e5e5e5;
    margin: auto;
    padding: 20px;
    border: 0px solid black;
    border-radius: 32px;
    width:100%;
}

.responsive_detail_data {
    display: flex;
    align-items: center;
}

.responsive_logo_detail {
   
    margin-right: 15px;
    padding: 34px 5px;
    width: 50%;
}

.responsive_logo_detail img {
width: 100%;
}

.detail_about_owner {
    background: #0d2235;
    padding: 10px;
}

.detail_about_owner h2 {
    color: #fff;
    font-size: 22px;
    margin-top: 0px;
}

.detail_about_owner {
    width: 100%;
}



.detail_about_owner p {
    margin-bottom: 5px;
    color: #fff;
    text-transform: uppercase;
    font-size: 16px;
}

.social_detail_icons {
    margin-top: 10px;
    display: flex;
    justify-content: space-around;
    background: #fff;
    padding: 10px;
}

.detail_social {
    text-align: center;
    width: 25%;
}

.detail_social p {
    margin-bottom: 6px;
}

.detail_social p a i {
    color: #000;
}

.detail_social h6 {
    margin: 0;
}

.social_detail_icons_3 ul li a i {
    color: #000;
}

.detail_social p i {
    font-size: 20px;
}

.detail_social h6 {
    text-transform: capitalize;
    font-size: 14px;
}




.social_detail_icons_2 {
    margin-top: 10px;
    background: #fff;
    padding: 20px;
}

.social_detail_icons_2 ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.social_detail_icons_2 ul li {
    padding: 5px;
    border-bottom: 1px solid #e3e3e3;
    display: flex;
    align-items: baseline;
}

.social_detail_icons_2 ul li i {
    margin-right: 15px;
}

.social_detail_icons_3 {
    margin-top: 10px;
    background: white;
    padding: 11px 20px;
}

.social_detail_icons_3 ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-around;
}

.social_detail_icons_3 ul li {
    width: 20%;
    text-align: center;
}


.social_detail_icons_4 {
    margin-top: 10px;
    padding: 20px;
    background: reed;
    background: white;
}

.save_data_link {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding-top: 12px;
}

.save_data_link p {
    margin: 0;
}

.save_data_link p i {
    width: 40px;
    height: 40px;
    background: #0d2235;
    line-height: 40px;
    text-align: center;
    color: #fff;
    border-radius: 50%;
}

.save_data_link button {
    background: #0d2235;
    padding: 6px 10px;
    border: none;
    text-transform: capitalize;
    border-radius: 40px;
    color: #fff;
}

.social_detail_icons_4 {
    margin-top: 10px;
    padding: 20px;
    background: reed;
    background: white;
}

.save_data_link {
    display: flex;
    align-items: center;
    justify-content: space-around;
    padding-top: 12px;
}

.save_data_link p {
    margin: 0;
}

.save_data_link p i {
    width: 40px;
    height: 40px;
    background: #0d2235;
    line-height: 40px;
    text-align: center;
    color: #fff;
    border-radius: 50%;
}

.save_data_link button {
    background: #0d2235;
    padding: 6px 10px;
    border: none;
    text-transform: capitalize;
    border-radius: 40px;
    color: #fff;
}

.social_detail_icons_5 {
    margin-top: 10px;
    padding: 20px;
    background: white;
}



.social_detail_icons_5 h4 {
    text-transform: capitalize;
}

.detail_social.data_detail {
    background: #0d2235;
    padding: 4px;
    border-radius: 4px;
}

.detail_social.data_detail i {
    color: #fff;
}

.detail_social.data_detail h6 {
    color: #fff;
}

.detail_social.data_detail {
    background: #0d2235;
    padding: 4px;
    border-radius: 4px;
}

.detail_social.data_detail i {
    color: #fff;
}

.detail_social.data_detail h6 {
    color: #fff;
}

.save_data_link h6 i {
    width: 40px;
    height: 40px;
    background: #0d2235;
    line-height: 40px;
    text-align: center;
    color: #fff;
    border-radius: 50%;
}
.social_detail_icons_2 ul li p{
    margin: 0px;
    word-break: break-all;
}

.save_data_link h6 {
    margin: 0;
}
</style>

</head>
<body>
<br>
<div class="responsive_design">
   <div class="container">
      <div class="row">
          <div class="col-12">
              <div class="responsive_moblie_view">
                  <!-- owner-logo -->
                    <div class="responsive_detail_data">
                        <div class="responsive_logo_detail">
                            <img src="<?= base_url()?>images/logo/logo4.png" alt="images">
                        </div>
                        <div class="detail_about_owner">
                            <h2><?= $this->conn->company_info('company_founder_name');?></h2>
                            <p><?= $this->conn->company_info('company_founder_desgnation');?></p>
                        </div>
                    </div>
                <!-- owner-logo-end -->
                <!-- Call-history -->
                   <div class="social_detail_icons">
                       <div class="detail_social data_detail">
                           <p><a href="tel:<?= $this->conn->company_info('company_mobile');?>"><i class="fa fa-phone" aria-hidden="true"></i></a></p>
                           <h6>Call</h6>
                       </div>

                       <div class="detail_social">
                        <p><a href="mailto:<?= $this->conn->company_info('company_email');?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></p>
                        <h6>Mail</h6>
                    </div>

                    <div class="detail_social">
                        <p><a  href="https://wa.me/<?= $this->conn->company_info('company_mobile');?>/"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></p>
                        <h6>Whatsapp</h6>
                    </div>

                    <div class="detail_social">
                        <p><a  href="http://maps.google.com/?q=<?= $this->conn->company_info('company_address');?>"><i class="fa fa-map-marker" aria-hidden="true"></i></a></p>
                        <h6>Location</h6>
                    </div>

                   </div>
                    <!-- Call-history-end -->
                <!-- Call-history_start_one --> 
                 <div class="social_detail_icons_2">
                    <ul>
                        <li><i class="fa fa-phone" aria-hidden="true"></i><p><?= $this->conn->company_info('company_mobile');?></p></li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><p><?= $this->conn->company_info('company_email');?></p></li>
                        <li><i class="fa fa-globe" aria-hidden="true"></i><p><?= $this->conn->company_info('base_url');?></p></li>
                        <li><i class="fa fa-clock-o" aria-hidden="true"></i><p><?= $this->conn->company_info('open_time');?></p></li>
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i><p><?= $this->conn->company_info('company_address');?></p></li>
                    </ul>
                </div>
                 <!-- Call-history_start_one-end--> 
                  <!-- Call-history_start_two--> 
                 <div class="social_detail_icons_3">
                    <ul>
                        <li><a  target="_blank" href="<?= $this->conn->company_info('company_facebook_link');?>"><i class="fa fa-facebook-f" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="<?= $this->conn->company_info('company_twitter_link');?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="<?= $this->conn->company_info('company_pinterest_link');?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="<?= $this->conn->company_info('company_linkedin_link');?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="<?= $this->conn->company_info('company_telegram_link');?>"><i class="fa fa-telegram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                 <!-- Call-history_end--> 
                   <!-- Call-history_form--> 
                  <!-- <div class="social_detail_icons_4">
                      <form>
                        <input name="mobile" type="mobile" class="form-control" autocomplete="off" placeholder="+91" aria-label="mobile">
                      </form>
                      <div class="save_data_link">
                          <p><i class="fa fa-phone" aria-hidden="true"></i></p>
                          <button>save contact</button>
                          <h6><i class="fa fa-cogs"></i></h6>
                      </div>

                </div>-->
                  <!-- Call-history_form-end--> 
                  <!-- Call-history_about--> 
                  <div class="social_detail_icons_5">
                     <h4>About</h4>
                     <?php
                      $about_data=$this->conn->runQuery('*','legal_data','lega_page_type="about_us"');
                      if($about_data){
                      foreach($about_data as $about_data1){
                          
                      ?>
                       <h6><?= $about_data1->legal_title;?></h6>
                     <p><?= $about_data1->legal_desc;?></p>
                     <?php
                       }
                      }
                     ?>
                </div>
           <!-- Call-history_about_end--> 
              </div>
          </div>
      </div>
   </div>
</div>
<br>
</body>
</html>

