<?php
 $user_id=$this->session->userdata('user_id');
 $profile=$this->profile->profile_info($user_id);
 $w_balance=$this->conn->runQuery('*','user_wallets',"u_code='$user_id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->conn->company_info('company_name');?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= $panel_url;?>assets/css/style.css">
    <link rel="stylesheet" href="<?= $panel_url;?>assets/css/custom.css">
     <link rel="stylesheet" href="<?= $panel_url;?>assets/css/extra.css">
     <link rel="stylesheet" href="<?= $panel_url;?>assets/css/custom1.css">
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<style>

 
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

 
:root {
    --colorPrimary: #6057c4;
    --bgColor: #1d1d1d;
    --textColor: #fff;
    --bodybg: #282c47;
    --textPrimaryColor: #bb9036;
    --grident: #FAAC02;
    --shadow: 0px 0px 6px 1px #dbb84c;
}
.wallet_total a:hover {
    text-decoration: none;
    color: #fff;
}
.widthraw_heading_payout_request h3{
    font-size:24px !important;
}
.news_blog {
    margin-bottom: 15px;
}
.footerDiv {
    z-index: 99;
}
.total_ticket_number_emil h4, .total_ticket_number_emil p, .support_email_table h4, .support_datail h4, .support_datail ul li, .urgent_inner_content h4, .urgent_inner_content ul li, .recent_email_inquiry h4{
      color: var(--textColor) !important;
}
.tickets_buttons button{
     background:  var(--grident) !important;
}
.copy_link p {
    margin: 0px;
    color: #fff;
    font-size: 12px;
    text-align: center;
    margin-top: 10px;
}
hr.invest_data {
    width: 100%;
    color: #f7f7f775;
    opacity: 0.5;
    margin: 70px 0px;
}
ul.social_icons_list li a i {
    width: 40px;
    height: 40px;
    background: #f8ab05;
    text-align: center;
    line-height: 40px;
    border-radius: 40px;
    color: #ffff;
}
ul.social_icons_list {
    padding: 0px;
    margin: 0px;
    list-style: none;
    display: flex;
    align-items: center;
    gap: 12px;
}

.tickets_buttons button, .email_buttons a, .email_buttons button {
     background:  var(--grident) !important;
     margin: 0px 2px;
}

section.copy_footer {
    text-align: center;
    background: #171717;
    position: fixed;
    bottom: 0px;
    width: 100%;
    left: 0px;
}


section.copy_footer p {
    padding: 10px;
    margin: 0px;
    color: #fff;
    font-size: 14px;
}
.pcakge_btn a{
   
    display: inline-block;
    background: var(--grident) !important;
    padding: 10px 20px;
    border-radius: 4px;
    color: #fff;
    text-transform: capitalize;
    font-size: 18px;
    font-weight: 600;
    text-align: center;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
}
.pcakge_btn {
    text-align: end;
     margin-bottom: 10px;
}
.email_buttons {
  margin-top: 10px;
}
.proflie_table {
    overflow-x: auto;
}
.widthrwal_report_user h3, .widthrwal_report_user p{
     color:var(--textColor) !important;
}
.formContainer input, .formContainer select{
     color:#000 !important;
}
th {
    background: var(--textPrimaryColor) !important;
    color:var(--textColor) !important;
}
select.form-control.user_input_select {
    
    text-transform: capitalize;
}
button.amount_data{
     background:var(--grident) !important;
}
.accountLeftCol h3{
    color:var(--textPrimaryColor) !important;
}
p.text-dark {
    color: #fff !important;
}
.alert-danger {
   display: flex;
    align-items: center;
}
.alert-message {
    margin-left: 10px;
}

button.close {
    margin-right: 10px;
    padding: 5px;
    line-height: 13px;
    
}
.alert-success {
   display: flex;
    align-items: center;
}
.btnPrimary {
    
    width: 100%;
}
.earningTableHeading p {
    color: var(--textPrimaryColor) !important;
}
li.breadcrumb-item a {
     color: var(--textPrimaryColor) !important;
}
.earning-sec {
    margin-top: 60px;
}
button.btn.btn-default{
    background:var(--grident) !important;
    color:#fff;
    border:none;
}
.user_content {
    margin-top: 110px;
}
.main-sec {
    margin-top: 100px;
}
.dashboard-card {
   min-height: 160px; 
}
.dashboard-card img {
    position: absolute;
    bottom: 0;
}
.logout_icon i {
    color: var(--textPrimaryColor) !important;
}
a.user_btn_button.detail{
     color: var(--textPrimaryColor) !important;
}
a.btnPrimary:hover {
    color:#fff;
}
.pin_topup_page {
    margin-top: 50px;
}
.earning_link a{
     color:#fff;
}
input.user_btn_button{
      background:var(--grident) !important;
      color:#fff !important;
}
.card_profile_footer button, .profile_card_bottom button{
     background:var(--grident) !important;
}
.membership_table_desc tr th{
     background: var(--textPrimaryColor) !important;
     color: #fff;
}
.aboutDiv h5{
    color: var(--textPrimaryColor) !important;
}
input.user_btn_button.btn-remove.detail{
     background: var(--grident) !important;
      color: #fff !important;
}
a.button_data_link_anhor {
    background: var(--grident) !important;
    color: #fff;
    border: none;
    padding: 7px;
    display: inline-block;
   border-radius: 4px;
}
.mailAboutDiv, .mainAccountLeftCol {
   box-shadow: 1.5px 1.5px 5px #c2993b;
  
}
.earning_link, .earning_link.dark {
   font-size: 14px !important;
}
.earning_link.fund1 {
    background: green;
}
.earning_link.fund2 {
    background: green;
}
.earning_link.fund3 {
    background: green;
}
.earning_link.fund4{
    background: green;
}
.earning_link.fund5{
    background: green;
}
.earning_link.fund6{
    background: green;
}
.eraning_link_data {
    margin-bottom: 0px;
}
.formContainer {
    padding: 22px 20px 10px;
}
.btnPrimary, button.user_btn_button.send_otp{
      background:var(--grident) !important;
}
.earning_link {
    margin-bottom: 5px;
}
    .earning_link,
.earning_link.dark {
    position: relative;
    width: 100%;
    color: #fff;
    overflow: hidden;
    text-transform: capitalize;
    display: inline-block;
    transition: all 0.3s ease;
    cursor: pointer;
    font-size: 17px;
    font-weight: 400;
    border-radius: 40px;
    border: none;
    padding: 10px;
 background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
}
.user_main_card{
    background: var(--bgColor);
    border:1px solid #dddde540;
}

.header-wrap {
    padding: 5px 0px;
}
.table td, .table th {
    padding: 10px;
   color: #fff !important;
}


label.label_user_title {
    color: #fff;
}

table th, table td {
    text-align: center;
    border: 1px solid #d0cccc1f !important;
}
.drop_down {
    display: none;
}
/*.btnPrimary {
    width:auto;
}*/

.card_profile_footer a{
    margin: 5px 5px;
}

a {
    color: #ffa500;
}

.tableDiv {
   overflow-x: auto;
}

.form_topup {
   border: 1px solid #eaf0f700 !important;
}
.card {
    border: none;
}
.card-body{
     background: var(--bgColor) !important;
}
.detail_topup {
   background:var(--bgColor) !important;
}

p.mb-1 {
    text-align: center;
    color: #fff;
}

.profile_header h4{
    color: #fff;
}

.form-group label {
   color: #fff;
}

.profile_card_bottom a{
    margin: 5px 5px;
    box-shadow: none;
}
@media screen and (max-width: 1040px) {
  .topNavTabs p {
    margin-left: 14px !important;
}

}

@media screen and (max-width: 567px) {
  .user_main_card.mb-3.detail_data_pins form {
    width: 100%;
}
h4.all_incomes_detail{
    font-size: 20px !important;
}

.bottomNavCol i {
 
    font-size: 16px;
}
.headerDiv {
   
    padding: 15px 10px;

}
span.dash_wallet {
    
    font-size: 12px !important;
}
.wallet_income {
    gap: 10px !important;
    flex-direction: column !important;
    align-items: flex-start !important;
}
.user_income_package h4 {
    font-size: 16px !important;
}
table.table.row.table-borderless.w-100.m-0 {
    border: none !important;
}
.networkCard h1 {
    font-size: 15px;
}
.networkCard p {
    font-size: 12px;
}
.copY_write p{
    display:none;
}
.headerRight {
    flex-direction: row-reverse;
    text-align: right;
}
.headerInner {
    margin-right: 10px;
}
.headerInner>h5, .headerInner>p {
    display: block;
}

.bottomNavCol p {
    font-size: 10px;
   
}
}

.headerRight {
    position: relative;
    gap:5px;
}

.drop_down {
   position: absolute;
    top: 65px;
    right: 0;
    background: #303030;
    width: 113px;
    padding: 5px 8px;
    border-radius: 3px;
}
.drop_down:hover {
   
    color: #fff;
}
.drop_down p {
    margin: 0px;
    cursor: pointer;
    border-bottom: 1px solid #ffb31040;
    padding: 5px 3px;
}

.drop_down p a {
    color: #ffb310;
    font-size: 14px;
}
.drop_down p a i{
    margin-right:10px;
}
.earning_link.dark {
   
    background: green;
}
.earning_link.dark2{
     background: green;
}
.earning_link.team {
    background: green;
}
.earning_link.team {
    background: green;
}
.earning_link.team2 {
    background: green;
}
.earning_link.team3 {
    background: green;
}
.earning_link.dark3{
    background: green;
}
.earning_link {
  
    color: #fff;
}
.logout_icon p {
    font-size: 23px;
}
.headerInner {
    margin: 0px 5px;
}
.footerDiv {
   
    left: 0;
}
h1.total_wallet_income {
    color: #48f920;
}
.accountLeftCol img {
   
    width: 100%;
}
.user_p {
    width: 100px;
    height: 100px;
    margin: auto;
    border-radius: 4px;
    border: 1px solid #efedebd1;
    margin-bottom: 5px;
    padding: 20px;
}
.widthraw_heading {
   
    margin-bottom: 10px;
}
.widthraw_heading{
  background:var(--bgColor) !important;   
}
.user_image_desc a{
  background:var(--grident) !important; 
}
.widget_user_content h4, .widget_user_content h6{
    color:var(--textColor);
}
.crd-detail h4 {
    font-weight: 700;
}
.networkCard h1 {
   font-weight: 700;
}
.ntwrk-col h6 {
    font-weight: 600;
}

.support_datail, .urgent_email, .recent_email_inquiry, .total_ticket_number_emil, .support_email_table, .support_tcket_data{
    background:var(--bgColor) !important;
}


.royalty_bonus a:hover {
    transform: translateY(-4px);
}
.user_btn_new a:hover{
       transform: translateY(-4px);
}
.user_btn a {
  transform: translateY(-4px);
}
#all_margin_bottom_pages{
    margin-bottom:50px;
}
.headerRight>img {
    margin-right: 0px;
    border-radius: 50%;
    border: 2px solid #faac02;
    padding: 2px;
    object-fit: cover;
    height:40px;
}
.footer_desc h4 {
    color: #d5d5d56b;
}

.footer_desc p {
    color: #555;
}
.headerInner h5 {
    display: none;
}
span.dash_wallet {
    float: right;
    font-size: 14px;
    color: var(--black);
    background: var(--btn);
    font-weight:600;
    padding: 6px 10px;
    border-radius: 4px;
    letter-spacing: 0px;
    text-transform: capitalize;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
    font-family: 'Open Sans', sans-serif !important;
}
h4.rank_heading.rank {
    text-align: center;
}
.achievers_rank {
    border-radius: 10px;
    margin-bottom: 20px;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
    padding: 10px;
}
.topNavTabs p{
    margin-left: 30px;
}

@media screen and (max-width: 768px) {
   section.copy_footer{
       display:none;
   } 
   .widthraw_heading_text h2 {
    font-size: 21px;
   }
}
</style>
</head>
<body>

    <!-- Header Start -->
    <section class="headerDiv">
        <section class="logowithnav">
            <a href="<?= $panel_path.'dashboard';?>" style="margin: auto;">
                
                <img src="<?= $this->conn->company_info('logo');?>" alt="<?= $this->conn->company_info('company_name');?>" >
            </a>
            <nav class="topNavTabs">
                <a class="headerTabActive" href="<?= $panel_path.'dashboard';?>">
                    <p>Home</p>
                </a>
              <a href="<?= $panel_path.'profile/id-card';?>">
                    <p>Profile</p>
                </a>
               
                 <!--<a class="no" href="<?= $panel_path.'profile/meta_about';?>">
                    <p> Meta about </p>
                </a>
                <a class="no" href="<?= $panel_path.'profile/market';?>">
                    <p> Forex market </p>
                </a>-->
                
                
                <a class="no" href="<?= $panel_path.'income/details?source=affilate';?>">
                    <p>Income</p>
                </a>
                <a class="no" href="<?= $panel_path.'team/team-direct';?>">
                    <p>Network</p>
                </a>
                <a class="no" href="<?= $panel_path.'profile/account';?>">
                    <p>Account</p>
                </a>
                 <a class="no" href="<?= $panel_path.'transactions';?>">
                    <p>Transactions</p>
                </a>
                <!-- <a class="no" href="<?= $panel_path.'profile/news';?>">
                    <p>Market News</p>
                </a>-->
                 <a class="no" href="<?= $panel_path.'profile/blog';?>">
                    <p>Blog </p>
                </a>
                 <a class="no" href="<?= $panel_path.'profile/market';?>">
                    <p> Forex market </p>
                </a>
                
            </nav>
        </section>
        <div class="headerRight" onclick="dropToggle()">
  <!--          	<div class="logout_icon">-->
		<!--    <p style="margin:0px;"> <a href="<?= $panel_path.'logout' ?>"> <i class="fa fa-power-off" aria-hidden="true"></i> </a></p>-->
		<!--</div>-->
		<div class="wallet_total">
		<a href="<?= $panel_path.'fund/fund-withdraw';?>"><span class="dash_wallet"><i class="fa-solid fa-wallet"></i>: <?= $this->conn->company_info('currency');?>&nbsp;<?= round($w_balance[0]->c1,2);?></span></a>
		</div>
            <?php  if($profile->img!=''){?>	
                <img class="image_lx" src="<?= base_url('images/users/').$profile->img;?>" >
                <?php }else{ ?>
				<img class="image_lx" src="<?= $this->conn->company_info('logo');?>" >
			<?php
				}
			?>	
	
            <div class="headerInner">
                <p><?php 
               
                echo $profile->name;
                ?></p>
              <p><?php 
               
                echo $profile->username;
                ?></p>
                <p><?php 
               
                echo $profile->email;
                ?></p>
            </div>
            <div class="drop_down">
                
           
               <p> <a href="<?= $panel_path.'profile';?>"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></p>
                  <p> <a href="<?= $panel_path.'logout' ?>"><i class="fa fa-power-off" aria-hidden="true"></i>logout</a></p>
            </div>
        </div>
    </section>
    <!-- Header End -->
    
    <script>
        function dropToggle() {
            let myDropdown = document.querySelector('.drop_down');
            
            if (myDropdown.style.display === "block") {
                myDropdown.style.display = "none";
            } else {
                myDropdown.style.display = "block";
            }
        }
    </script>