<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Home | <?= $this->conn->company_info('company_name');?></title>
    <!-- /SEO Ultimate -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="57x57" href="<?= $this->conn->company_info('logo');?>">
   <!-- <link rel="apple-touch-icon" sizes="60x60" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $panel_url;?>assets/images/favicon/trustq.png">
    <link rel="manifest" href="<?= $panel_url;?>assets/images/favicon/trustq.png">-->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.html">
    <meta name="theme-color" content="#ffffff">
    <!-- Latest compiled and minified CSS -->
    <link href="<?= $panel_url;?>assets/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/js/bootstrap.min.js">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- StyleSheet link CSS -->
    <link href="<?= $panel_url;?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= $panel_url;?>assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
    <link href="<?= $panel_url;?>unpkg.com/aos%402.3.1/dist/aos.css" rel="stylesheet">
    <style>
    
 :root {
  --background: #fbec9f;
  --textColor:orange;
}




.banner-section .banner_content .lets_talk:hover{
     background: var(--background) !important;
}
.banner-section .banner_content .circle {
    background: var(--background);
}

.banner-section .banner_content .lets_talk{
    color:var(--textColor) !important;
}

.navbar-nav .active > a{
     color:var(--textColor) !important;
}
.h5, h5{
     color:var(--textColor) !important;
}

.service-section{
    background-color: #fff;
}

.service-section .service_contentbox .service-box:hover h4{
     color:var(--textColor) !important;
}

.service-section .service_contentbox .service-box .read_more, .service-section .service_content .circle:before{
       color:var(--textColor) !important;
}

.service-section .service_content .read_more{
    color:var(--textColor) !important;
}
.service-section .service_contentbox .service-box{
    border-bottom: 2px solid var(--textColor);
}
.service-section .service_contentbox .service-box:hover{
    border-bottom: 2px solid var(--textColor) !important;
}
.service-section .service_content .read_more:hover{
      background: var(--background);
}

.choose-section .choose_content .circle{
      color:var(--textColor) !important;
}

.choose-section .choose_content .read_more{
     color:var(--textColor) !important;
}
.choose-section .choose_content .read_more:hover{
     background: var(--background);
}

.choose-section .choose_content .circle{
       background: var(--background);
}

.bg-warning{
      background: var(--background) !important;
}
.testimonial-section, .counter-section, .provide-section{
    background:#73ba3f17;
}
.faq-section .accordion-card {
    box-shadow: 1px 1px 16px rgb(115 186 63 / 41%);
}
.faq-section .need_content input{
     box-shadow: 1px 1px 16px rgb(115 186 63 / 41%);
}

.contact-section .contact-box{
     box-shadow: 1px 1px 16px rgb(115 186 63 / 41%);
}
.contact-section .need_content input{
     box-shadow: 1px 1px 16px rgb(115 186 63 / 41%);
}



.alert-danger{
    background: #5b191f !important;
    color:#77dc7b !important; 
   border: none;
}
.alert-success {
  background: #2c622f;
  color:#77dc7b !important; 
  border: none;
}

        .case-box.overlay img {
height: 183px;
    width: 100%;
    object-fit: unset;
   
}
th {
    background: var(--grident) !important;
    color:var(--textColor) !important;
}
.case-box.overlay h3 {
    font-size: 20px;
    text-align: center;
}

.case-box.overlay {
    text-align: center;
}
   .alert-danger {
    color: #e8aeb3 !important;
    background-color: #721c24 !important;
    border: none !important;
}

.alert-success{
     color: #efefef !important;
     background-color: #2f9937 !important;
     border: none !important;
}
.navbar-nav .nav-item a{
    font-size:16px;
}
        ul.social_icons_list li a i {
    width: 40px;
    height: 40px;
    background: var(--textColor);
    text-align: center;
    line-height: 40px;
    border-radius: 40px;
    color: #ffff;
}
.footer-section .middle-portion ul li:hover i{
     color: #000 !important;
}
    

 .footer-section .middle-portion ul li:hover {
    color: #000 !important;
}
ul.social_icons_list {
    padding: 0px;
    margin: 0px;
    list-style: none;
    display: flex;
    align-items: center;
    gap: 12px;
}

.alert-success, .alert-danger {
   display: flex;
    align-items: center;
}

.navbar-collapse ul {
   
    background: #040503;
}

@media only screen and (max-width: 991px){
.navbar-nav .active > a {
  background-color: #f8ab05 !important;
}
.navbar-nav .nav-item a{
    color:#fff !important;
}
.navbar-nav .nav-item a:hover {
     background-color: #f8ab05 !important;
}
}
    </style>
</head>

<body>
<!--Header  -->
<div class="banner_outer">
    <header class="header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#"><figure class="mb-0 banner-logo"><img src="<?= $this->conn->company_info('logo');?>" style="width:<?php echo $this->conn->company_info('logo_width');?>;height:<?php echo $this->conn->company_info('logo_height');?>" alt="" class="img-fluid"></figure></a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" 
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url();?>index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>about">About</a>
                        </li>
 <li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>meta_about">About Meta</a>
                        </li>
 <li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>market">Forex market</a>
                        </li>
 <li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>news">Market News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>service">Services</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>projects">Our Works</a>
                        </li>-->
                         <li class="nav-item">
                            <a class="nav-link" href="<?= base_url();?>contact">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://d.sky-world.uk/">Sign In </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="https://d.sky-world.uk/register">Sign Up</a>
                        </li>
                        
                        
                       <!-- <li class="nav-item">
                            <a class="nav-link" href="appdownload.html">Download App</a>
                        </li>-->
                    <!--    <li class="nav-space nav-item dropdown">
                            <a class="nav-link dropdown-toggle dropdown-color navbar-text-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"> Pages </a>
                            <div class="dropdown-menu drop-down-content">
                                <ul class="list-unstyled drop-down-pages">
                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link" href="team.html">Teams</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item nav-link" href="faq.html">Faq's</a>
                                    </li>
                                </ul>
                            </div>
                        </li>-->
                       
                       <!-- <li class="nav-item">
                            <a class="nav-link lets_talk" href="<?= base_url();?>register">Register<i class="circle fa-regular fa-angle-right"></i></a>
                        </li>-->
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <figure class="banner-sideshape mb-0">
        <img src="<?= $panel_url;?>assets/images/banner-sideshape.png" alt="" class="img-fluid">
    </figure>