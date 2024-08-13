<div id="DivIdToPrint">
 <style>
h5.text1 {
    text-align: initial;
}
.welcome_inner_content {
    text-align: center;
}

.letter_wrapper_detail {
    border: 1px solid #dddde5;
    padding: 20px;
    background:#e5eae9;
    max-width: 700px;
    margin: auto;
    margin-top:40px;
}

.persona_detail_data h6 {
    text-align: center;
    font-size: 20px;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom:10px;
}
.welcome_inner_content h4 {
    font-size: 28px;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.welcome_inner_content img {
    
    width: 100px;
    height: 100px;
    text-align: center;
    border-radius: 50%;
}

.welcome_inner_content p {
    margin: 20px 0px;
}

.inner_detail_data {
    width: 100%;
   
}

.persona_detail_data {
    max-width: 385px;
    margin: auto;
    width:100%;
}
.date_welcome_letter_inner p span {
    float: right;
}

.date_welcome_letter_inner p {
    font-weight: 500;
    font-size: 16px;
    margin-bottom: 5px;
    text-transform: capitalize;
}
@media screen and (max-width: 768px) {
    .date_welcome_letter_inner p {
   font-size:12px;
   
}
.welcome_inner_content h4{
    font-size: 24px;
}
.persona_detail_data h6{
     font-size: 18px;
}
  }
</style>
<?php
$u_code=$this->session->userdata('user_id');
$profile=$this->profile->profile_info($u_code);
$my_package=$this->business->package($u_code);
?>
 
 <div class="welcome_letter_data_detail">
   
     <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="letter_wrapper_detail">
                    <div class="welcome_inner_content">
                        <h5 class="user_card_title profile_edit welcome_edit"><a href="" onclick='printDiv();' title="Print Form"><i class="fa fa-print"></i></a></h5>
                    <h4>Welcome Letter</h4>
                     <a href="#"><img src="<?=  $this->conn->company_info('logo');?>" class="img-thumbnail"  style="width:<?php echo $this->conn->company_info('logo_width');?>;height:<?php echo $this->conn->company_info('logo_height');?>"></a>
                    <!--<img src="./assets/images/favicon.png" alt="images">-->
                      <?php
                         $welcome_condition=$this->conn->runQuery('*','legal_data','lega_page_type="welcome_letter"');
                         if($welcome_condition){
                         foreach($welcome_condition as $welcome_condition1){
                        
                         ?> 
                        <h5 class='text1' ><?php echo $welcome_condition1->legal_title;?></h5>
                        <p class=''><?php echo $welcome_condition1->legal_desc;?>
                        </p>
                        <?php  
                             }
                          }
                        ?>
                     <!--<p>We are building an exchange that will deliver absolutely everyone who believes in crypto to join the digital cryptocurrency revolution. The world is moving on to this revolution at a remarkable pace. Now is your time. With Your Dream, Your Success, you can buy, sell &amp; exchange digital currencies with amazing ease, confidence and trust. Whether you’re a first-time investor or an expert trader - Your Dream, Your Success has obtained you both covered!</p>
                     <p>We trade on the major currency and equity markets, we carry out a large number of transactions every day. Our experts carry out hundreds of daily transactions in the following markets: Forex Markets, Commodity Markets, Crypto Markets, Euronext and London Stock Exchange.</p>-->
                    </div>
                   
                    <div class="persona_detail_data">
                        <h6>Personal Detail</h6>
                    <div class="inner_detail_data">
                         
                   <div class="date_welcome_letter_inner">
                       <p>To: <span><?= $profile->username;?></span></p>
                       <p>Name: <span><?= $profile->name;?></span></p>
                       <p>Email: <span><?= $this->conn->company_info('company_email');?></span></p>
                   </div>
                   <div class="date_welcome_letter_inner">
                    
                    <p>Moblie No: <span><?= $this->conn->company_info('company_mobile');?></span></p>
                    <p>purchase date: <span><?= $profile->added_on;?></span></p>
                    <p>purchase amount: <span><?= $my_package;?></span></p>
                </div>
            </div>
               </div>
               
               
              </div>
            </div>
        </div>

     </div>
     </div>



  </div>

   <br>
 <script>

////////////////div print function /////////////////////////
//////////btn onclick  call this function ////////

function printDiv(){

  var divToPrint=document.getElementById('DivIdToPrint'); ////////////  <- div id /////////////

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
  ///////////////////////// end function //////////
</script>

<br>