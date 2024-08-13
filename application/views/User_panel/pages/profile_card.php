<?php
$u_code=$this->session->userdata('user_id');
$profile=$this->profile->profile_info($u_code);
?>
<br><br>
	<style>	
.v_card_demo {
	width: 100%;
	max-width: 350px;
	border: 2px solid #c78e13;
	position: relative;
	overflow: hidden;
	z-index: 0;
	margin: auto;
	background: #171717 !important;
	border-radius: 20px;
	box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
}

.v_card_heading {
	padding: 15px 20px;
	margin-bottom:15px;
}
.v_card_inner_data ul li a:hover {
	color:#fff;
}
.v_card_heading h3 {
	font-size: 22px;
	text-align: center;
	text-transform: capitalize;
	color: white;
}

.v_card_image img {
	max-width: 100%;
	width: 124px;
	height: 124px;
	border-radius: 50%;
	border: 2px solid #D59B2D;
	margin-bottom: 5px;
	margin: auto;
}


.v_card_heading:before {
	position: absolute;
	content: "";
	background-color: var(--text1);
	height: 239px;
	width: 239px;
	top: -170px;
	right: -140px;
	border-radius: 50%;
	opacity: 1;
	transition: .7s;
	z-index: -1;
}


.v_card_content:after {
	position: absolute;
	content: "";
	background-color: var(--text1);
	height: 239px;
	width: 239px;
	bottom: -159px;
	left: -152px;
	border-radius: 50%;
	opacity: 1;
	transition: .7s;
	z-index: -1;
}

.v_card_image {
	text-align: center;
}

.v_card_inner_data {
	text-align: center;
}

.v_card_inner_data ul {
	list-style: none;
	padding: 0;
	margin: 0;
}
.v_card_inner_data {
    margin-bottom: 20px;
    margin-top: 10px;
}

.v_card_content {
	padding: 10px 20px;
}

.v_card_signature {
    text-align: end;
    padding-top: 20px;
}

.v_card_inner_data ul li h4 {
	font-size: 16px;
	margin-bottom: 0;
	color: white;
	text-transform: capitalize;
}

.v_card_inner_data ul li p {
	margin: 0;
	font-size: 16px;
	font-weight: 500;
}


.v_card_signature h6 {
	color: white;
}
@media screen and (max-width: 576px) {
	.v_card_heading:before {
		top: -195px;
		right: -152px;
	}
	.v_card_content:after {
		bottom: -168px;
		left: -176px;
} 

.v_card_inner_data ul li {
    font-size: 13px;
}

.v_card_content {
	padding: 10px 20px;
} 				
}
        
    				/* RTL */
    				.rtl {
    					direction: rtl;
    					font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    				}
        
    				.rtl table {
    					text-align: right;
    				}
    				
    				.rtl table tr td:nth-child(2) {
    					text-align: left;
    				}
    				.text-color{
    				     color:;
    				     color:#aa3b61;
    				}
    			/*	td.best6 {
    background: #0f143c;
    border: 2px dotted #0f143c;
}*/
	@media only screen and (max-width: 480px) {
.invoice-box1 table td{
    display: block;
}
}
img.margin_auto {
    margin: auto;
    display: block;
    margin-bottom: 10px;
}
.v_card_inner_data ul li  {
    font-size: 14px;
    color: #fff !important;
}

.v_card_heading {
    padding: 15px 20px;
     border: 2px solid #c78e13;
    position: relative;
    overflow: hidden;
    z-index: 0;
    background: #171717 !important;
    border-radius: 20px;
    box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
}

.v_card_content {
    padding: 10px 20px;
    background: red;
	margin-bottom: 10px;
    padding: 20px;
    padding: 15px 20px;
    border: 2px solid #c78e13;
    position: relative;
    overflow: hidden;
    z-index: 0;
    background: #171717 !important;
    border-radius: 20px;
    box-shadow: rgb(0 0 0 / 24%) 0px 3px 8px;
}

a.btn_edit {
    margin-bottom: 10px;
    display: inline-block;
    background: orange;
    padding: 8px 14px;
    border-radius: 4px;
    color: var(--black);
    text-transform: capitalize;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
    margin-top: 10px;
}
.share_link {
   background: orange;
    padding: 8px 14px;
    border-radius: 4px;
    color: var(--black);
    text-transform: capitalize;
    font-size: 14px;
    font-weight: 600;
    text-align: center;
    transition: .3s all ease-out;
    box-shadow: 0px 0px 8px 1px #a17800;
    margin-top: 10px;
    text-align: center;
    margin: 20px auto;
    display: block;
    max-width: 89px;
}
        </style>
<div class="container">
   <center>
      <input type='button' id='btn' value='Download' class="btn"  style="background-color:var(--text1);color:white; margin-bottom:20px;" onclick='printDiv();'>
   </center>
   <div id="DivIdToPrint">
      <?php
         $user_id=$this->session->userdata('user_id');
         $profile=$this->profile->profile_info($user_id);
         
         $ref=base_url()."register?ref=".$profile->username;
         ?>
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <div class="v_card_heading">
                  <h3><?= $this->conn->company_info('company_name');?></h3>
                  <img src="<?=  $this->conn->company_info('logo');?>" alt="images" class="margin_auto" style="width:100px;"> 
                  <img style="width:100%;max-width: 253px;" class="margin_auto" src="<?= base_url('user/fund/my_qr_code?address='.$ref);?>" />		
               
				 <div class="share_link">
							<i class="fa-solid fa-share"></i> share
						</div>
				</div>
            </div>
            <div class="col-md-6">
               <div class="">
                  <div class="v_card_content">
                     <div class="v_card_image">
                        <?php  if($profile->img!=''){?>
                        <img src="<?=  base_url('images/users/').$profile->img;?>" alt="images">
                        <?php }else{ ?>
                        <img src="<?=  $this->conn->company_info('logo');?>" alt="images">
                        <?php
                           }
                           ?>
						  
                     </div>
                     <div class="v_card_inner_data">
                        <ul>
                           <li>
                              <h4>Username : <?= $profile->username;?></h4>
                           </li>
                           <li>Name : <?= $profile->name;?></li>
                           <li>Moblie No : <?= $profile->mobile;?></li>
                           <li>Joining Date : <?= $profile->added_on;?></li>
                           <li>Active Date : <?= $profile->active_date;?></li>
                           <li>Website : <a href="<?=  $this->conn->company_info('base_url');?>"><?=  $this->conn->company_info('base_url');?></a></li>
                        </ul>
						<a href="<?= $panel_path.'profile/edit-profile';?>" class="btn_edit">edit profile</a>
                     </div>
                     <div class="v_card_signature">
                        <img src="<?=  $this->conn->company_info('logo_marvin');?>" alt="images" style="width:98px; height:40px;">
                        <h6>Signature</h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>

						

    <br><br>
    <script>

// Get the download button element
const downloadBtn = document.getElementById('download-btn');

// Add a click event listener to the button
downloadBtn.addEventListener('click', () => {
  // Get the card element
  const card = document.querySelector('.card');

  // Create a new canvas element
  const canvas = document.createElement('canvas');
  const context = canvas.getContext('2d');

  // Set the canvas dimensions
  canvas.width = card.offsetWidth;
  canvas.height = card.offsetHeight;

  // Draw the card onto the canvas
  context.drawImage(card, 0, 0, card.offsetWidth, card.offsetHeight);

  // Convert the canvas to a data URL
  const dataURL = canvas.toDataURL('image/png');

  // Create a temporary anchor element
  const downloadLink = document.createElement('a');
  downloadLink.href = dataURL;
  downloadLink.download = 'card.png';

  // Simulate a click on the anchor element to trigger the download
  downloadLink.click();
});
       
    </script>
     <br><br>
 




	 