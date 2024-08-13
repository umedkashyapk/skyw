<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<style> 

:root {
	--page-body-color: #151515;
	--primary_color: #1d1d1d;
	--secondary: #FAAC02;
	--white: #fff;
	--black: #333;
	--btn: #FAAC02;
	--extra:#d3d3d3;
	--black:#000;
}

.dashboard_heading {
	padding: 20px;
	border-radius: 10px;
	background: var(--primary_color);
	margin-bottom: 20px;
    transition: all 0.3s ease-out;
	background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
}
.dashboard_heading:hover{
transform: translateY(-6px);
}
.dashboard_heading h2 {
    -webkit-background-clip: text;
background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
	font-size: 32px;
	font-weight: 700;
	letter-spacing: 2px;
	margin-bottom: 0px;

	text-transform: uppercase;
}

.dashboard_heading p {
	color: var(--extra);
	margin-bottom: 0px;
	text-transform: capitalize;
	font-size: 14px;
}

.form-input {
	display: flex;
	align-items: center;
}

.form-input input[type="email"] {
	border-radius: 5px 0 0 5px;
	border: none;
	flex: 1;
	padding: 10px;
}

.form-input button {
	background: var(--secondary);
	border: none;
	border-radius: 0 5px 5px 0;
	color: #fff;
	cursor: pointer;
	font-size: 16px;
	padding: 10px 20px;
}

.referral-link {
	border-radius: 5px;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	padding: 16px;
	background: #1e1e1e;
	margin-top: 16px;
}

.referral-link p {
	font-size: 16px;
	margin-bottom: 10px;
}

.referral-link input[type="text"] {
	border: none;
	border-radius: 5px;
	font-size: 14px;
	padding: 10px;
	width: 100%;
	background: none;
	border: 1px solid #3e3e3e8c;
	color: #ddba4e;
	outline: none;
}

.referral-link button {
	background-color: var(--btn);
	border: none;
	border-radius: 5px;
	color: var(--black);
	cursor: pointer;
	font-size: 16px;
	margin-left: 10px;
	padding: 10px 20px;
	transition: .3s all ease-in-out;
}

.profile_section {
	padding: 25px 15px;
	background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
	border-radius: 10px;
	margin-bottom: 20px;
   transition: all 0.3s ease-out;
}
.profile_section:hover {
     transform: translateY(-6px);
}

.profile_section h2 {
	display: flex;
	align-items: center;
	justify-content: space-between;
	-webkit-background-clip: text;
	background-clip: text;
	background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
	color: transparent;
	font-family: Times New Roman, serif;
	font-size: 32px;
	font-weight: 700;
	letter-spacing: 2px;
	text-transform: uppercase;

}

.profile_section h2 span a i {
	font-size: 12px;
	background: var(--btn);
	width: 30px;
	height: 30px;
	border-radius: 40px;
	line-height: 30px;
	text-align: center;
	font-size: 16px;
	color: var(--white);
}

hr.line_tag {
	border-color: #dfdfdf40;
	margin: 15px 0px;
	width: 100%;
}

.user_incomes {
	background: #212122;
	padding: 6px 10px;
	margin-bottom: 5px;
	border-left: 4px solid #c09639;
	border-radius: 4px;
}

.user_incomes h4 {
	font-size: 16px;
	text-transform: capitalize;
	color: var(--white);
	margin-bottom: 5px;
}

.user_incomes p {
	margin-bottom: 0px;
	color: var(--extra);
	font-size: 14px;
}

.user_btn {
	margin-top: 20px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	gap: 6px;
}

.user_btn a {
    border: 1px solid transparent;
	width: 100%;
	background: var(--btn);
	padding: 10px 10px;
	border-radius: 4px;
	color: var(--black);
	text-transform: capitalize;
	font-size: 12px;
	font-weight: 600;
	text-align: center;
	transition: .3s all ease-out;
	box-shadow: 0px 0px 8px 1px #a17800;
}

.user_btn a:hover {
	background: none;
	border: 1px solid var(--btn);
	text-decoration: none;
	color: #fff;
	box-shadow: 0px 0px 8px 1px #a17800;
}

.user_income_detail {
	padding: 30px 20px;
	border-radius: 4px;
	background: var(--primary_color);
	margin-bottom: 20px;
	display: flex;
	justify-content: space-between;
    transition: all 0.3s ease-out;
}
.user_income_detail:hover {
    transform: translateY(-6px);
}


.user_graph_image img {
	width: 111px;
	height: 70px;
}

.user_icon i {
	width: 40px;
	height: 40px;
	background: #fff;
	text-align: center;
	line-height: 40px;
	border-radius: 4px;
}

.user_income_package h4 {
	font-size: 17px;
	text-transform: capitalize;
	color: var(--white);
	margin-bottom: 5px;
}

.user_income_package p {
	color: var(--extra);
	margin: 0;
}
.news_mar {
    border: 2px solid transparent;
    border-radius: 10px;
    color: #fff;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    height: 157px;
	margin-bottom:10px;
    padding: 15px;
}
.rank_section {
	padding: 20px;
	border-radius: 10px;
 transform: translateY(-6px);
	margin-bottom: 20px;
background:linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
}

.rank_sectionhover{
    transform: translateY(-6px);
}
.rank_section h4 {
	color: var(--white);

	font-size: 22px;
	text-transform: capitalize;
}

.rank_total h4 {
	font-size: 20px;
}

.team_setions {
	padding: 20px;
	border-radius:10px;
background:linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;

	margin-bottom: 20px;
}

.team_data {
	display: flex;
	align-items: center;
	gap: 10px;
	margin-bottom: 15px
}

.team_icon i {
	width: 30px;
	height: 30px;
	background: #2276fd;
	line-height: 30px;
	text-align: center;
	border-radius: 4px;
	color: var(--white);
	font-size: 14px;
}

.team_heading h6 {
	font-size: 14px;
	margin-bottom: 0px;
	text-transform: capitalize;
	color: var(--white);
}

.team_heading span {
	color: var(--white);
}

.team_setions h4 {
	color: var(--white);
	margin-bottom: 20px;
	font-size: 22px;
}

.wallet_income {
	display: flex;
	align-items: center;
	gap: 20px;
}

.wallet_income_icon i {
	width: 40px;
	height: 40px;
	background: var(--btn);
	line-height: 40px;
	font-size: 20px;
	text-align: center;
	border-radius: 4px;
	color: var(--white);
}

.wallet_income_icon_package h4 {
	font-size: 22px;
	text-transform: capitalize;
	color: var(--white);
	margin-bottom: 5px;
}

.wallet_income_icon_package p {
	color: var(--extra);
	margin: 0;
}

.rank_total h4 span {
    color: var(--btn) !important;
    float: right;
}

button:focus {
	outline: none !important;
}

.referral-link button:hover {
	box-shadow: 0px 0px 8px 1px #a17800;
}
button.owl-prev {
    background: #faac02 !important;
    padding: 8px 10px !important;
    line-height: 10px;
    font-size:  20px !important;
    border-radius: 4px !important;
}
.owl-carousel .owl-item img {
    
    height: 400px;
    object-fit: cover;
}
.owl-nav {
    display: flex;
    justify-content: center;
    gap: 10px;
}
button.owl-next {
	 background: #faac02 !important;
     padding: 8px 10px !important;
    line-height: 10px;
    font-size:  20px !important;
    border-radius: 4px !important;
}
div#sliderCarousel {
    margin-bottom: 20px;
}
button.owl-prev span {
    padding: 10px;
}
button.owl-next span{
	 padding: 10px;
}

.owl-nav.disabled {
   
    width: 100%;
    display: flex !important;
	gap:5px !important;
    justify-content: center;
}
.image_section img {
	width: 100%;
	max-width: 130px;
	margin: auto;
	display: block;
	box-shadow: 0px 0px 15px 0px #f08e65;
	border-radius: 50%;
	transition: .3s all ease-out;
	animation: glowing 1500ms infinite;
}

@keyframes glowing {
    
0% {
  background-color: #f08e65;
    box-shadow: 0 0 2px #f08e65;
  
}
50% {
  background-color: #f08e65;
    box-shadow: 0 0 16px #f08e65;
  
}
100% {
 background-color: #f08e65;
 box-shadow: 0 0 2px #f08e65;
    
}
}

.image_section {
	position: relative;
	margin: 20px 0px;
}

.rank_name {
	position: absolute;
	top: 50%;
	left: 50%;
	transform:translate(-36px, -16px);
}

.rank_name h6 {
	color: #f08e65;
	font-size: 22px;
	font-weight: 700;
	margin: 0px;
	text-transform: uppercase;
}

/* extra team section  */


.team_directs_detail {
	padding: 20px;
	background: #2c2c2c;
	margin-bottom: 10px;
	border-radius: 4px;
}

.list_directs {
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.list_direct_heading h4 {
	margin: 0;
	text-align: center;
	text-transform: capitalize;
}

.list_directs span {
	width: 30px;
	height: 30px;
	background: var(--btn);
	text-align: center;
	line-height: 30px;
	border-radius: 50%;
	color: var(--white);
	font-size: 15px;
}

/*reward section */
.reward_inco {
	
	background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
	border: 2px solid transparent;
	border-radius: 10px;
	padding: 10px;
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 20px;
}

.reward_money h6 {
	padding: 5px 20px;
	background: var(--btn);
	border-radius: 4px;
	color: var(--black);
	font-size: 22px;
	margin: 0;
	font-family: Times New Roman, serif;

}

.reward_money h6:hover{
transform: translateY(-4px);
}
.achievers_rank h4 {
    text-align: center;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 0px;
    text-transform: uppercase;
}
.reward_image img {
	width: 143px;
}


.reward_name h2 {

	-webkit-background-clip: text;
	background-clip: text;
	background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
	color: #bfa152;
	color: var(--colorPrimary);
	color: transparent;
	font-family: Abril Fatface, cursive;
	font-family: Times New Roman, serif;
	font-size: 26px;
	font-weight: 700;
	letter-spacing: 5px;
	margin-bottom: 0px;
	text-align: center;
	text-transform: uppercase;
}

@media screen and (max-width: 768px) {
	.reward_inco {
		flex-direction: column-reverse !important;
	}
	
	.user_btn a {
        padding: 10px 8px;
	}
	
  .wallet_income_icon_package h4 {
       font-size: 18px;
   }

	.reward_money h6 {
       font-size: 22px;
	}

	.reward_name h2 {
		padding: 10px 0px !important;
		font-size: 20px;
		letter-spacing: 3px;
	}
	.dashboard_heading h2, .profile_section h2{
	    	font-size: 20px;
	}
	
	h4.rank_heading, h4.team_section_head{
	   font-size: 20px !important;
	}
}

.dashboard_main {
	margin-top: 120px;
	
}

.wallet_upper {
	padding: 10px 20px;
	/* background:linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent; */
	border-radius: 4px;
    transition: all 0.3s ease-out;
    margin-bottom: 20px;
    background: var(--primary_color);
	display: flex;
	justify-content: space-between;
}

.wallet_upper:hover{
     transform: translateY(-6px);
}

.image_wallet img {
	width: 80px;
}

h4.rank_heading {
	-webkit-background-clip: text;
	background-clip: text;
	background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
	color: transparent;
	font-family: Times New Roman, serif;
	font-size: 32px;
	font-weight: 700;
	letter-spacing: 2px;
	margin-bottom: 0px;
	text-transform: uppercase;
}

h4.team_section_head {
	-webkit-background-clip: text;
	background-clip: text;
	background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
	color: transparent;
	font-family: Times New Roman, serif;
	font-size: 32px;
	font-weight: 700;
	letter-spacing: 2px;

	text-transform: uppercase;
}

.reward_money h6 a{
    	color: var(--black);
}
.reward_name p {
  	color: var(--white);
    text-align: center;
    font-size: 20px;
    margin-bottom: 10px;
}
.user_btn_new {
    margin-top: 10px;
}
.user_btn_new a{
   
    background: var(--btn);
    padding: 10px 23px;
	margin-bottom:10px;
    border-radius: 4px;
    color: var(--black);
    text-transform: capitalize;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
}
.royalty_bonus a {
       margin-bottom: 10px;
    display: inline-block;
  
    background: var(--btn);
    padding: 10px 20px;
    border-radius: 4px;
    color: var(--black);
    text-transform: capitalize;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
}

.royalty_bonus {
    margin-top: 15px;
}

.dashboard_main {
    background-blend-mode: overlay;
    background-color: rgb(0 0 0 / 71%)
   
    background-position: center center;
    background-size: cover;
    display: flex;
    min-height: 100vh;
}



.rank_section.mt-3 {
    padding: 10px 20px;
}

.rank_section.mt-3 h4 {
    margin-bottom: 4px;
    font-size: 18px;
}
.rank_total p {
    margin: 0px;
    color: #faac02;
    font-size: 16px;
}

marquee#new_id {
    background: none;
    height:100px;
}

.marquee_detail h4 {
    display: flex;
    align-items: center;
    justify-content: space-between;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
    font-size: 28px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
}

marquee.aciver_data {
    background: #171717;
    height: 77px;
}

.meta_tarde_five img {
    width: 150px;
}
.meta_tarde_five:hover{
    transform: translateY(-6px);
}
.meta_tarde_five {
    padding: 25px 20px;
    transition: all 0.3s ease-out;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
    border-radius: 10px;
    margin-bottom: 20px;
    text-align: center;
}

.meta_link h5 {
    color: var(--white);
    text-transform: capitalize;
    font-size: 16px;
}

.meta_link a {
    margin-bottom: 10px;
    display: inline-block;
    background: var(--btn);
    padding: 10px 20px;
    border-radius: 4px;
    color: var(--black);
    text-transform: capitalize;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
}span.current_detail {
    margin: auto;
    display: block;
    text-align: center;
    font-size: 23px;
    color: #fff;
}

.meta_link {
    margin-top: 10px;
}

.current_monthly h6 {
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #faac02 45%, #faac02 50%, #faac02 55%, #faac02 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
    font-size: 24px;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.current_monthly {
    text-align: center;
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 7px;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
}

.current_monthly span {
    color: #fff;
    font-size:18px;
}
.current_monthly_data {
    margin-bottom: 15px;
}
.news_mar h4 {
    color: #ff;
	text-align:center;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #faac02 45%, #faac02 50%, #faac02 55%, #faac02 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
    font-size: 24px;
    font-weight: 700;
    letter-spacing: 2px;
    margin-bottom: 5px;
    text-transform: uppercase;
}
.business_status {
    padding: 18px 20px;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
    border-radius: 10px;
    margin-bottom: 20px;
    
}

.business_status h4 {
    text-align:center;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
    font-size: 26px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.business_content h6 {
    color: #faac02;
    text-transform: capitalize;
    font-size: 18px;
}

.business_content {
    text-align: center;
}

.business_content span {
    color: #fff;
}

@media screen and (max-width:576px){
    .royalty_bonus a{
        width:100%;
    }
	.user_btn_new a{
		 display: block;
        width: 100%;
	}
	
    .current_monthly h6{
        font-size:20px;
    }
    .business_status h4 {
        font-size:20px;
    }
}


/* new-css */
.all_incomes {
    background: #171717;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
}

 h4.all_incomes_detail {
    color: #fff;
    -webkit-background-clip: text;
    background-clip: text;
    background-image: linear-gradient(90deg, #fb9d39 0, #cb9b51 22%, #f6e27a 45%, #f6f2c0 50%, #f6e27a 55%, #cb9b51 78%, #f8913b);
    color: transparent;
    font-family: Times New Roman, serif;
    font-size: 32px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
}


.wallet_link {
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
}

.item img {
    width:100%;
	height:400px !important;
	object-fit:cover !important;
}


/* slider-css */

element.style {
}
.item.data {
    text-align: center;
    padding: 10px 15px;
    border-radius: 10px;
    margin-bottom: 7px;
    background: linear-gradient(#171717 0 0) padding-box, linear-gradient(135deg, #faac02, #faac02, #d9a127, #f1b227, #aa771c) border-box;
    border: 2px solid transparent;
    margin-bottom: 20px;
}
</style>
<?php
   $plan_type=$this->session->userdata('reg_plan'); 
   $profile=$this->session->userdata("profile");
   $user_id=$this->session->userdata('user_id');
   $plan=$this->conn->runQuery("*",'plan',"1=1");
   $website_settings=$this->conn->plan_setting("dashboard"); 
   $currency = $this->conn->company_info('currency');
   $incomes=$this->conn->runQuery("*",'wallet_types',"wallet_type='income' and  status='1' and slug!='reward' and $plan_type='1'");
   $team=$this->conn->runQuery("*",'wallet_types',"wallet_type='team' and  status='1' and $plan_type='1'");
   $wallets=$this->conn->runQuery("*",'wallet_types',"wallet_type IN ('wallet') and  status='1'  and $plan_type='1'");
   $wallets_pin=$this->conn->runQuery("*",'wallet_types',"wallet_type IN ('pin') and  status='1'  and $plan_type='1'");
   $withdrawals=$this->conn->runQuery("*",'wallet_types',"wallet_type = 'withdrawal' and  status='1'  and $plan_type='1'");
   $payouts=$this->conn->runQuery("*",'wallet_types',"wallet_type = 'payout' and  status='1'  and $plan_type='1'");
   $w_balance=$this->conn->runQuery('*','user_wallets',"u_code='$user_id'");
   $wallet_balance=$w_balance ? $w_balance[0]:array();
   $latest_earnings=$this->conn->runQuery('*','transaction',"u_code='$user_id' and tx_type='income' order by id desc LIMIT 6");
   $total=$this->conn->runQuery('SUM(amount) as total','transaction',"u_code='$user_id' and tx_type='income' and source!='self_bonus'")[0]->total;
   $reward_income=$this->conn->runQuery('SUM(amount) as total','transaction',"u_code='$user_id' and tx_type='income' and source='rank_profit'")[0]->total;
   $my_package=$this->business->package($user_id);
   
    $u_infoss=$this->conn->runQuery('*','users',"id='$user_id' and 1=1");
    $spons_id=$u_infoss[0]->u_sponsor;
    $u_spos=$this->conn->runQuery('username,name','users',"id='$spons_id' and 1=1");
    $sponsor_name=$u_spos[0]->name;
    $sponsor_username=$u_spos[0]->username;
    $lastest_repurchase=$this->conn->runQuery('*','orders',"u_code='$user_id' and tx_type='repurchase' order by id desc LIMIT 1");
    
    $first_date = date('Y-m-d H:i:s',strtotime('first day of last month'));
    $last_date = date('Y-m-d H:i:s',strtotime('last day of this month'));   
    $userid=$this->session->userdata('user_id');
    $check_directs=$this->conn->runQuery('SUM(amount) as amts','transaction',"tx_type='income' and u_code='$userid' and date>='$first_date' and date<='$last_date' and source!='self_bonus'");  
    $total_income1=$check_directs[0]->amts;
    
    $community_buss=$this->business->community_business($userid,$first_date,$last_date);
    $total_community_inc=array_SUM($community_buss);  
    
    $total_community_buss=$this->business->total_community_business($userid);
     $totals_community_bv=array_SUM($total_community_buss);  
     $total_team_bv=$this->business->team_business($user_id);
     
    
   ?>
<div class="dashboard_main mt-120" id="pages_margin">
   <div class="container-fluid">
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
       <div class="row mb-2">
	   <div class="col-md-8">
	   <div class="news_mar">
                  <h4>news</h4> 
           <?php
                $get_alert_mar=$this->conn->runQuery('*','notice_board',"type='marquee' and status='1' order by id desc");
                if($get_alert_mar){
                ?>
	           
	              <marquee id="new_id" behavior="scroll" direction="up" scrollamount="5" class="card-bg-1 card"><i class="fa fa-warning" style="font-size:20px;color:red"></i><?= $get_alert_mar[0]->description;?></marquee>
	              <?php
           }else{?>
           
           	 <marquee id="new_id" behavior="scroll" direction="up" scrollamount="5" class="card-bg-1 card"><i class="fa fa-warning" style="font-size:20px;color:red"></i><?= $this->conn->company_info('news');?></marquee>
           <?php } ?>
           
            <?php
      /*	$panel_pa=$this->conn->company_info('panel_directory');
	$this->load->view($panel_pa.'/pages/dashboard/alert');*/
    ?>  
    </div>
	
	</div>
	<div class="col-md-4">
	 <div class="current_monthly_data">
               
        <div class="current_monthly">
           <h6> Rank Achievers</h6>
           <span>
		 <?php
                $get_rank_achiver=$this->conn->runQuery('*','ad_achievers',"status='1'");
                if(!empty($get_rank_achiver)){
                ?>
                <marquee class="aciver_data" behavior="scroll" direction="up" scrollamount="" class="card-bg-1 card">
                    <?php 
                    foreach($get_rank_achiver as $get_rank_achiver1){
                       
                       ?>
                       <br>
                     <?= $get_rank_achiver1->title;?>(<?= $get_rank_achiver1->description;?>)
                     <img src="<?= base_url().$get_rank_achiver1->img;?>" style="width:30px; height:20px;"> 
                    <?php
                    }
                    ?>
                    </marquee>
					
					 <?php
            
            }
            ?> </span>
        </div>
    
                
            </div>
    </div>
	</div>
	
          
      <div class="row">
            <div class="col-12">
                <div class="owl-carousel slider_list" id="sliderCarousel">
                     <?php
                          $tradingi=$this->conn->runQuery('*','legal_data','lega_page_type="tradingimg"');
                          foreach($tradingi as $legal_condition1){
                      ?> 
                    <div class="item data"><img src="<?= $legal_condition1->legal_img;?>" alt="Image 1" class="img-fluid data"></div>
                    <?php }?>

                    <!--<div class="item data"><img src="<?= $panel_url;?>assets/images/robot3.png" alt="Image 2" class="img-fluid"></div>
                    <div class="item data"><img src="<?= $panel_url;?>assets/images/robot3.png" alt="Image 3" class="img-fluid"></div>-->
                </div>
            </div>
     </div>
      <div class="row">
          
         <!--first-row-->
         <div class="col-lg-6 col-md-12">
            <div class="dashboard_heading">
               <h2>Dashboard </h2>
               <p>we always ready for your help.</p>
               <div class="referral-link">
                  <p>Your referral link <i class="fa fa-smile-o" aria-hidden="true"
                     style="color:#f08e65;"></i></p>
                  <div class="form-input">
                     <input type="text" value="<?php echo $left_link=base_url('register?ref='.$profile->username);?>" id="copy_input">
                     <button type="button" onclick="copyToClipboard()">Copy</button>
                  </div>
               </div>
               <div class="royalty_bonus">
                   <a href="<?= $panel_path.'goal/royalty';?>">Gambit development bonus</a>
                    <!--<a href="<?= $panel_path.'fund/fund-request';?>">Fund Request</a>-->
                       <a href="<?= $panel_path.'profile/news';?>">Market News</a>
                         <a href="<?= $panel_path.'team/reward';?>">Bonanza/Reward</a>
                         <a href="<?= $panel_path.'orders';?>">Package</a>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-md-12">
             <div class="meta_tarde_five">
                 <img src="<?= $panel_url;?>assets/images/robot3.png" alt="images">
                 <div class="meta_link">
                     <h5>Trading Account</h5>
                     <a href="<?= $panel_path.'dashboard?ids='.$user_id;?>" onclick="return confirm('Are you sure? you wants to Submit.')">click</a>
                 </div>
             </div>
         </div>
         <div class="col-lg-3 col-md-12">
            <div class="profile_section">
               <h2>Profile<span><a href="<?= $panel_path.'profile';?>"><i class="fa fa-user" aria-hidden="true"></i></a></span></h2>
               <hr class="line_tag">
               </hr>
               <div class="user_incomes">
                  <h4>My Portfolio</h4>
                  <p><?=$currency;?>&nbsp;<?= ($total) ? ($total):0;?></p>
               </div>
               <div class="user_btn">
                  <a href="<?= $panel_path.'invest/investment';?>" class="depsoit_btn">AI Subscription</a>
                  <a href="<?= $panel_path.'invest/reinvestment';?>" class="depsoit_btn">Subscription</a>
                 
               </div>
               <div class="user_btn_new">
			       <a href="<?= $panel_path.'crypto/add_fund';?>">Deposit</a>
                   <a href="<?= $panel_path.'fund/fund-withdraw';?>">withdrawal</a>
                    <!--<a href="<?= $panel_path.'fund/fund-withdraw';?>">withdrawal</a>-->
               </div>
            </div>
         </div>
      </div>
      <!--first-row-end-->
      <div class="row">
         <!--second-row-->
         
         <div class="col-md-8">
            <div class="all_incomes">
                    <h4 class="all_incomes_detail">all incomes</h4>
            <div class="row">

               <?php
                  foreach($incomes as $income){    
                    $slug =  $income->wallet_column; 
                    $source=$income->slug;
                   if($slug=='c4'){
                      $path='graph3.png';
                      $currr=$currency;
                      $urls="user/income/details?source=affilate";
                   }elseif($slug=='c5'){
                       $path='graph4.png';
                       $urls="user/income/details?source=daily_trade"; 
                   }elseif($slug=='c7'){
                       $path='graph4.png';
                       $urls="user/income/details?source=rank_profit";
                   }elseif($slug=='c16'){
                        $path='graph6.png';
                        $currr="";
                        $urls="user/income/details?source=development_bonus";
                   }elseif($slug=='c15'){
                        $path='graph3.png';
                        $currr=$currency;
                        $urls="user/income/details?source=same_rank";
                   }elseif($slug=='c6'){
                        $path='graph4.png';
                        $currr=$currency;
                        $urls="user/income/details?source=self_bonus";
                        
                   }else{
                       $path='graph3.png';
                       $currr=$currency;
                       $urls="";
                   }
                  
                 
                  ?>   
                  
               <div class="col-md-6">
                  <a href="<?= base_url().$urls;?>"><div class="user_income_detail">
                     <div class="user_income_inner">
                        <!-- <div class="user_icon">
                           <i class="fa fa-usd" aria-hidden="true"></i>
                           </div> -->
                        <div class="user_income_package">
                           <h4><?= $income->name;?></h4>
                           <p><?=$currr;?>&nbsp;<?= $ttl[]=round(!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug:0,2); ?></p>
                        </div>
                     </div>
                     <div class="user_graph_image">
                        <img src="<?= $panel_url;?>assets/images/<?= $path;?>" alt="images">
                     </div>
                  </div> </a>
               </div>
              
               <?php
                  }
                  $purchase=$this->conn->runQuery('*','orders',"u_code='$user_id' and tx_type='purchase' order by id desc");
                  $order_amt=$lastest_repurchase[0]->order_amount;
                  ?>
                    </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="rank_section">
                <h4 class="rank_heading rank">my rank</h4>
                <div class="image_section">
                  <img src="<?= base_url();?>images/logo/circle.png" alt="image">
                  <div class="rank_name">
                     <h6><?= $profile->my_rank;?></h6>
                  </div>
                </div>
                
            </div>
             
            
             <div class="rank_section mt-3">
                <div class="rank_total">
                  <h4>AI Subcription : <span><?= $purchase[0]->order_amount;?>$</span></h4>
                </div>
                <div class="rank_total">
                     <h4>Package : <span> <?php 
                            
                           if($order_amt=='100'){
                               $pack='STATAR';
                           }elseif($order_amt=='1000'){
                               $pack='CONSEILLER';
                           }elseif($order_amt=='5000'){
                               $pack='PREMIUM';
                           }elseif($order_amt=='10000'){
                               $pack='BRONZE';
                           }elseif($order_amt=='30000'){
                               $pack='RUBI';
                           }elseif($order_amt=='50000'){
                               $pack='PLATINUM';
                           }
                           echo $pack;
                  ?> </span></h4>
                </div>
                <div class="rank_total">
                   
                   <h4>Package Amount: <span><?= $this->business->package_repurchase($user_id);?>$</span></h4>   
                   <h4>Bonus : <span><?php 
                           
                            
                          
                           //echo $order_amt; 
                           if($order_amt>='100' && $order_amt<=999){
                               $bonus='0';
                           }elseif($order_amt>='1000' && $order_amt<=4999){
                               $check_pkg=$this->conn->runQuery('*','pin_details',"pin_rate>='1000' and max_amount<='4999'");
                               $bonus=$check_pkg[0]->bonus;//'10';
                           }elseif($order_amt>='5000' && $order_amt<=9999){
                               $check_pkg=$this->conn->runQuery('*','pin_details',"pin_rate>='5000' and max_amount<='9999'");
                               $bonus=$check_pkg[0]->bonus;
                               //$bonus='20';
                           }elseif($order_amt>='10000' && $order_amt<=29999){
                               $check_pkg=$this->conn->runQuery('*','pin_details',"pin_rate>='10000' and max_amount<='29999'");
                              // echo $this->db->last_query();
                               
                               $bonus=$check_pkg[0]->bonus;
                               //$bonus='30';
                           }elseif($order_amt>='30000' && $order_amt<=49999){
                               $check_pkg=$this->conn->runQuery('*','pin_details',"pin_rate>='30000' and max_amount<='49999'");
                               $bonus=$check_pkg[0]->bonus;
                               //$bonus='35';
                           }elseif($order_amt>='50000'){
                               $check_pkg=$this->conn->runQuery('*','pin_details',"pin_rate>='50000''");
                               $bonus=$check_pkg[0]->bonus;
                               //$bonus='40';
                           }
                           echo $bonus;
                  ?> %</span>
                  
                  
                  </h4>
                </div>
                
                 <div class="rank_total">
                  <h4>Al Remaining Days :<p id="demos"></p> <span><?php 
                     $order_date=$lastest_repurchase[0]->added_on;
                     if($purchase[0]->order_amount=='30'){
                         $subscription_month='3 month';
                         $total_days=114;
                     }elseif($purchase[0]->order_amount=='50'){
                         $subscription_month='6 month';
                         $total_days=228;
                     }elseif($purchase[0]->order_amount=='90'){
                         $subscription_month='12 month';
                         $total_days=461;
                     }

                    $join_date=$purchase[0]->added_on;
                    $effectiveDate = date('Y-m-d  H:i:s', strtotime("+$total_days Days", strtotime($join_date)));
                   
                  ?> </span>
                  </h4>
                </div>
             
               <!--<div class="rank_total">
                  <h4>Live Rate : <span><?= $this->conn->company_info('token_rate');?> $</span></h4>
               </div>-->
            </div>
         </div>
        
      </div>
      <!--second-row-end--> 
      <!--third-row-->
      <div class="row">
         <div class="col-md-8">
            <div class="reward_inco">
               <div class="reward_money">
                  <h6><a href="<?= $panel_path.'goal';?>">Rank Profit Goal</a></h6>
               </div>
               <div class="reward_name">
                  <h2>Rank income</h2>
                  <p><?= $currency;?><?= $reward_income ? $reward_income:0;?></p>
               </div>
               <div class="reward_image">
                  <img src="<?= base_url();?>images/logo/growth.png" alt="images">
               </div>
            </div>
         </div>
         <div class="col-md-4">
             <div class="achievers_rank">
                 <h4>Current Month Community</h4>
              
           
            <span class="current_detail"><?= $total_community_inc+$total_income1; ?> $</span>
              </div>
         </div>
      </div>
        <!--third-row-end-->
              <!--fouth-row-->
      <div class="row">
         <div class="col-md-6">
            <div class="team_setions">
               <h4 class="team_section_head">Team Section</h4>
               <div class="team_directs_detail">
                  <a href="<?= $panel_path.'team/team-direct';?>"><div class="list_directs">
                     <span style="background:#9d431d;"><?= $wallet_balance->c10 ? $wallet_balance->c10:0;?></span>
                     <span  style="background:#1f7e1f;"><?= $wallet_balance->c9 ? $wallet_balance->c9:0;?></span>
                  </div>
                  <div class="list_direct_heading">
                     <h4>directs</h4>
                  </div>
               </div></a>
               <a href="<?= $panel_path.'team/team-generation';?>"><div class="team_directs_detail">
                  <div class="list_directs">
                     <span><?= $wallet_balance->c11 ? $wallet_balance->c11:0;?></span>
                     <span style="background:#1f7e1f;"><?= $wallet_balance->c12 ? $wallet_balance->c12:0;?></span>
                  </div>
                  <div class="list_direct_heading">
                     <h4>team</h4>
                  </div>
               </div></a>
            </div>
         </div>
         <div class="col-md-6">
             <div class="wallet_link">
            <?php
               foreach($wallets as $section){ 
                $slug =  $section->wallet_column;   
               if($slug=='c1'){
                    $currr=$currency;
               }else{
                   $currr="";
               }
               ?>  
              
               <div class="wallet_upper">
            <div class="wallet_income">
               <div class="wallet_income_icon">
                  <i class="fa fa-google-wallet" aria-hidden="true"></i>
               </div>
               <div class="wallet_income_icon_package">
                  <h4><?= $section->name;?></h4>
                  <p><?= $currr;?>&nbsp;<?= round(!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug:0,2); ?></p>
               </div>
               </div>
               <div class="image_wallet">
                   <img src="<?= base_url();?>images/logo/width.png" alt="images">
               </div>
            </div>
             
            <?php
               } 
               ?>
           </div>
         </div>
      </div>
      <?php
        $team_business=$this->business->top_legs($user_id);
        $top_legs=$team_business[0];
        $total_team_business=array_sum($team_business);
        $other_leg_business=$total_team_business-$top_legs;
      ?>
      <div class="row">
          <div class="col-12">
              <div class="business_status">
                  <h4>your business status</h4>
                  <div class="row">
                      <div class="col-md-4">
                          <div class="business_content">
                              <h6>Power</h6>
                              <span><?= $top_legs!="" ?$top_legs :0 ;?></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="business_content">
                              <h6>Weaker</h6>
                              <span><?= $other_leg_business;?></span>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="business_content">
                              <h6>matching %</h6>
                              <span><?php $mt=$other_leg_business*100/$top_legs;
                              if($mt>=30){
                                  ?>
                                  <p style="color:green;"> <?= $mt>0 ? $mt :0 ;?></p>
                                  <?php
                              }else{
                                  ?>
                                  <p style='color:red'><?= $mt>0 ? $mt :0 ;?></p>
                                  <?php 
                              }
                              
                              ?></span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
      
       <div class="row">
          <div class="col-12">
              <div class="business_status">
                  <!--<h4>your business status</h4>-->
                  <div class="row">
                      <div class="col-md-6">
                          <div class="business_content">
                              <h6>Team Business</h6>
                              <span><?= $total_team_bv ? $total_team_bv:0;?>&nbsp; <?= $currency;?></span>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="business_content">
                              <h6>Total Community Business</h6>
                              <span><?= $totals_community_bv ? $totals_community_bv:0;?>&nbsp; <?= $currency;?></span>
                          </div>
                      </div>
                     
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12">
               <hr class="invest_data"></hr>
          </div>
      </div>
      
      <div class="row">
          <div class="col-12">
              <div class="footer_desc">
                  <h4>General Risk Warning</h4>
                  <p>The financial products offered by the company carry a high level of risk and can result in the loss of all your funds. You should never invest money that you cannot afford to lose.Before deciding to participate in the Forex market, you should carefully consider your investment objectives, level of experience and risk appetite. Most importantly, do not invest money you cannot afford to lose. </p>
                  <p>There is considerable exposure to risk in any off-exchange foreign exchange transaction, including, but not limited to, leverage, creditworthiness, limited regulatory protection and market volatility that may substantially affect the price, or liquidity of a currency or currency pair. </p>
                  <p>Moreover, the leveraged nature of forex trading means that any market movement will have an equally proportional effect on your deposited funds. This may work against you as well as for you. The possibility exists that you could sustain a total loss of initial margin funds and be required to deposit additional funds to maintain your position. If you fail to meet any margin requirement, your position may be liquidated, and you will be responsible for any resulting losses. </p>
             <p>There are risks associated with utilizing an Internet-based trading system including, but not limited to, the failure of hardware, software, and Internet connection. gambitbot.io is not responsible for communication failures or delays when trading via the Internet. gambitbot.io employs backup systems and contingency plans to minimize the possibility of system failure, and trading via telephone is always available. </p>
             <p>Any opinions, news, research, analyses, prices, or other information contained on this website are provided as general market commentary, and do not constitute investment advice. gambitbot.io is not liable for any loss or damage, including without limitation, any loss of profit, which may arise directly or indirectly from use of or reliance on such information. gambitbot.io has taken reasonable measures to ensure the accuracy of the information on the website. The content on this website is subject to change at any time without notice.  </p>
            <h4>Gambit</h4>
            <p>Gambit Limited whose registered office is 9th Floor 107 Cheapside, London, United Kingdom, EC2V 6DN, is a registered company FRO UK Company House, Company registration number : 232324, Operating trading service business globally according to UK Law and regulation.</p>
             <ul class="social_icons_list">


<li>
<a href="https://www.facebook.com/gambitaibot"><i class="fa fa-facebook" aria-hidden="true"></i></a>
</li>
<li>
<a href="https://twitter.com/gambitaibot"><i class="fa fa-twitter" aria-hidden="true"></i></a>
</li>
<li>
<a href="https://www.instagram.com/gambitaibot/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
</li>
</ul>
               
             
              </div>
          </div>
      </div>
   </div>
</div>
<br>
<br>

<script>
$('#sliderCarousel').owlCarousel({
    loop:true,
    margin:10,
	 nav: true,
    responsiveClass:true,
    autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:true
        },
        1000:{
            items:1,
            nav:true
        }
    }
})
</script>
<script>
  function copyToClipboard(){
   var copyText = document.getElementById("copy_input");
   
   // Select the text field
   copyText.select();
   copyText.setSelectionRange(0, 99999); // For mobile devices
   
   // Copy the text inside the text field
   navigator.clipboard.writeText(copyText.value);
   
   }
   
</script>

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?= $effectiveDate;?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demos").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demos").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<br>
<br>
