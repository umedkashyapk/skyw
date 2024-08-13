<?php
$username=$_GET['u_id'];
 $userdata=$this->conn->runQuery('*','users_info',"username='$username'");
 $user_id=$userdata[0]->u_code;
  $profile=$this->profile->profile_info_users($user_id);
 ?>

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

        /* width */
::-webkit-scrollbar {
  width: 0px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

:root {
	--primary: #042234;
	--secondary : #E3C380;
    --inner-color:#b9bbbd33;

}
      .web_inner_side {
        position: relative;
        overflow-y: auto;
        max-width: 400px;
        height: 701px;
        background: var(--inner-color);
        margin: auto;
        padding: 20px;
        border: 4px solid #152942;
        border-radius: 32px;
        width: 100%;
    }
    
    .web_card_logo img {
        width: 100px;
        background: var(--secondary);
        padding: 8px;
        border-radius: 12px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    
    }
    
    .web_card_logo {
        text-align: center;
    }
    
    .web_card_logo p {
        font-size: 16px;
        font-weight: 500;
    }
    
    .web_name_founder {
        text-align: center;
        background: var(--primary);
        padding: 4px 5px;
        border-radius: 40px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    
    .web_name_founder h4 {
        font-size: 18px;
        color: #fff;
        margin-bottom: 0px;
    }
    
    .web_name_founder p {
        margin-bottom: 0;
        color: #ffff;
        font-size: 16px;
        color: #E3C380;
    }
    
    .web_social_links {
        display: flex;
        /* justify-content: space-between; */
        text-align: center;
    }
    
    .web_social_inner_content {
        background: #fff;
        padding: 4px;
        width: 25%;
        margin-right: 10px;
        border-radius: 12px;
        line-height: 28px;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
    }
    
    .web_social_inner_content h4 i {
        font-size: 16px;
        color: var(--secondary);
    }
    
    .social_links_detail_new ul li i {
        color: var(--secondary);
    }
    
    .web_name_contact_detail i {
        color: var(--secondary);
    }
    
    .web_social_inner_content p {
        margin: 0px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .share_links {
        display: flex;
    }
    
    .web_social_inner_content h4 {
        margin-bottom: 0;
        line-height: 16px;
    }
    
    .web_social_links {
        margin: 20px 0px;
    }
    
    .card,
    .services_faq_detail {
        border-radius: 20px;
    }
    
    .card-header {
        background: #fff;
        border-radius: 20px !important;
    }
    
    .web_name_contact_detail {
        background: #fff;
        border-radius: 20px;
        padding: 15px;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
    }
    
    .web_name_contact_detail ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .web_name_contact_detail ul li {
        margin-bottom: 1px solid red;
        border-bottom: 1px solid #9da3a947;
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        padding: 10px;
    }
    
    .web_name_contact_detail p {
        margin: 0;
        font-size: 12px;
    }
    
    @media screen and (max-width: 400px) {
        .inner_input input {
            width: 100% !important;
            margin-bottom: 5px;
    
        }
    
        .web_social_inner_content:nth-child(4) {
            margin-right: 0px;
        }
    
    
        .web_name_inner_shre {
            align-items: center !important;
    
            flex-direction: column;
        }
    }
    
    .social_links_detail_new ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }
    
    .social_links_detail_new il li {
        width: 20%;
    }
    
    .social_links_detail_new ul li {
        width: 20%;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
        background: white;
        text-align: center;
        margin-right: 10px;
        padding: 10px;
        border-radius: 12px;
    }
    
    .social_links_detail_new {
        margin: 20px 0px;
    }
    
    .web_name_form_share {
        background: #fff;
        padding: 15px;
        border-radius: 20px;
        box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
    }
    
    .web_name_inner_shre {
        display: flex;
      
        align-items: baseline;
        margin-bottom: 10px;
    }
    
    .inner_input input {
        width: 100%;
        border: 1px solid #9b959569;
        border-radius: 40px;
        padding: 7px;
    
    }
    
    .inner_input {
        width: 100%;
        margin-right: 5px;
    }
    
    .services_faq_detail h5 {
        font-size: 16px;
        color: #000;
    }
    
    .share_links i {
        font-size: 20px;
        margin-right: 5px;
    }
    
    .web_name_form_share button {
        text-align: center;
        margin: auto;
        display: block;
        background: var(--secondary);
        border: none;
        padding: 8px 12px;
        border-radius: 40px;
        color: #fff;
        text-transform: capitalize;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        box-shadow: rgb(227 195 128) 0px 8px 12px 0px, rgb(227 195 128) 0px 0px 0px 1px;
    }
    
    .web_name_form_share button:focus{
        outline:none;
    }
    .about_start {
        margin: 20px 0px;
        background: #fff;
        padding: 10px;
        border-radius: 17px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }
    
    .about_start h4 {
        text: inherit;
        text-align: center;
        font-size: 18px;
        font-weight: 600;
    }
    
    .about_start p {
        font-size: 14px;
        margin: 0px;
    }
    
    .our_services ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }
    
    .our_services ul li {
        font-size: 16px;
        padding: 4px 0px;
    }
    
    .our_services ul li i {
        margin-right: 10px;
    }
    a.whatapp_color i {
    color: green;
}
    .card-body {
        padding: 10px;
    }
    
    .web_social_inner_content.socil_active {
        background: var(--primary);
    
        coloR: #fff;
    }
    
    li.social_active {
        background: var(--primary) !important;
    }
    
    </style>
   </head>
   <body>
      <div class="web_card_moblie_view">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <div class="web_inner_side">
                  <!-- web_logo -->
                  <div class="web_card_logo">
                     <img src="<?= base_url()?>/images/users/<?= $userdata[0]->img;?>" alt="images">
                     <p><?= $this->conn->company_info('company_name');?></p>
                  </div>
                  <!-- web_logo-end -->
                  <!-- web-name-founder -->
                  <div class="web_name_founder">
                     <h4><?= $userdata[0]->name;?></h4>
                     <p><?= $userdata[0]->username;?></p>
                  </div>
                  <!-- web-name-founder-end -->
                  <!-- web-name-social-start -->
                  <div class="web_social_links">
                     <div class="web_social_inner_content socil_active">
                        <h4><a href="tel:<?= $userdata[0]->mobile;?>"><i class="fa fa-phone" aria-hidden="true"></i></a></h4>
                        <p>Call</p>
                     </div>
                     <div class="web_social_inner_content">
                        <h4><a href="https://wa.me/<?= $userdata[0]->mobile;?>"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></h4>
                        <p>Whatsapp</p>
                     </div>
                     <div class="web_social_inner_content">
                        <h4><a href="mailto:<?= $userdata[0]->email;?>"><i class="fa fa-envelope" aria-hidden="true"></i></a></h4>
                        <p>Email</p>
                     </div>
                     <div class="web_social_inner_content">
                        <h4><a href="http://maps.google.com/?q=<?= $userdata[0]->address;?>"><i class="fa fa-map-marker" aria-hidden="true"></i></a></h4>
                        <p>Location</p>
                     </div>
                  </div>
                  <!-- web-name-social-end -->
                  <!-- web-name-contact-detail -->
                  <div class="web_name_contact_detail">
                     <ul>
                        <li>
                           <p><?= $userdata[0]->mobile;?></p>
                           <i class="fa fa-phone" aria-hidden="true"></i>
                        </li>
                        <li>
                           <p><?= $userdata[0]->email;?></p>
                           <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        </li>
                        <li>
                           <p><?= $userdata[0]->website_url;?></p>
                           <i class="fa fa-globe" aria-hidden="true"></i>
                        </li>
                        <li>
                           <p><?= $userdata[0]->service_time;?></p>
                           <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </li>
                        <li>
                           <p><?= $userdata[0]->address;?></p>
                           <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </li>
                     </ul>
                  </div>
                  <!-- web-name-contact-detail-end -->
                  <!-- web-name-social-links-start -->
                  <div class="social_links_detail_new">
                     <ul>
                        <li class="social_active">
						<a href="<?= $userdata[0]->facebook_link;?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li> <a href="<?= $userdata[0]->twitter_link;?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li> <a href="<?= $userdata[0]->telegrame_link;?>"><i class="fa fa-telegram" aria-hidden="true"></i></a></li>
                        <li> <a href="<?= $userdata[0]->instagram_link;?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li> <a href="<?= $userdata[0]->linkdin_link;?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                     </ul>
                  </div>
                  <!-- web-name-social-links-end -->
                  <!-- web-name-share-start -->
                  <div class="web_name_form_share">
					 <form action="" method="post">
                     <div class="web_name_inner_shre">
                        <div class="inner_input">
                           <input type="text" id="mobile" name="mobile" value="<?= $userdata[0]->mobile;?>">
                        </div>
						  <input type="hidden" id="u_ser_id" name="u_ser_id" value="<?= $user_id; ?>">
                        <div class="share_links">
                           <a href="https://wa.me/<?= $userdata[0]->mobile;?>" class="whatapp_color"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                           <i class="fa fa-share-alt" aria-hidden="true"></i>
                        </div>
                     </div>
                     <button type="submit" name="mobile_update">save contact</button>
				  </form>
                  </div>
                  <!-- web-name-share-end -->
                  <!-- web-name-about-start -->
                  <div class="about_start">
                     <h4>Bio</h4>
                     <p><?= $userdata[0]->bio;?></p>
                  </div>
                  <!-- web-name-about-start -->
                  <!-- web-name-service_faq -->
                  <div class="services_faq_detail">
                    <!--Accordion wrapper-->
<div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">

    <!-- Accordion card -->
    <div class="card">
  
      <!-- Card header -->
      <div class="card-header" role="tab" id="headingTwo1">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseTwo1"
          aria-expanded="false" aria-controls="collapseTwo1">
          <h5 class="mb-0">
            Our Services <i class="fa fa-angle-down rotate-icon" aria-hidden="true"></i>
          </h5>
        </a>
      </div>
  
      <!-- Card body -->
      <div id="collapseTwo1" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
        data-parent="#accordionEx1">
        <div class="card-body">
           <div class="our_services">
            <ul>
                <li>
                    <i class="fa fa-check" aria-hidden="true"></i><?= $userdata[0]->service_type;?>
                </li>
               <!-- <li>
                    <i class="fa fa-check" aria-hidden="true"></i>UI/UX Designing
                </li>
                <li>
                    <i class="fa fa-check" aria-hidden="true"></i>App Development
                </li>
                <li>
                    <i class="fa fa-check" aria-hidden="true"></i>Graphic Designing
                </li>
                <li>
                    <i class="fa fa-check" aria-hidden="true"></i>Digital Marketing
                </li>
                <li>
                    <i class="fa fa-check" aria-hidden="true"></i>QA & Testing
                </li>-->
            </ul>
           </div>
        </div>
      </div>
  
    </div>
    <!-- Accordion card -->
  
    
  
  </div>
  <!-- Accordion wrapper -->
                  </div>
                  <!-- web-name-service_faq-end -->
               </div>
            </div>
         </div>
      </div>
   </body>
</html>