<div id="DivIdToPrint">
<style>


.btn-success {
    background: var(--second) !important;
    border-color:  var(--second) !important;
}


.btn-success:hover {
    background: var(--second) !important;
    border-color:  var(--second) !important;
}

.welcome_letter_design {
  
    background: var(--first) !important;
    box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 16px;
    max-width: 800px;
    margin: auto;
}

.welcome_data_letter {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.welcome_letter_detail h2 {
    text-transform: capitalize;
    font-size: 28px;
    color: var(--text2);
}

.welcome_letter_detail_personal ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.welcome_letter_detail_personal ul li {
    font-size: 13px;
    color: var(--text2);
}

.welcome_letter_detail_personal b {
    margin-left: 10px;
    font-size: 12px;
}

.welcome_letter_content {
    margin-top: 15px;
}

.welcome_letter_content strong {
    font-size: 14px;
     color: var(--text2);
}

.welcome_letter_content p {
    font-size: 14px;
    margin-top: 10px;
    color: var(--text2);
}

.welcome_letter_info h4 {
    font-size: 20px;
    margin-bottom: 4px;
    color: var(--text2);
    text-transform: capitalize;
}

.welcome_letter_info h6 {
    font-size: 16px;
    color: var(--text2);
    margin-bottom: 5px;
    text-transform: capitalize;
}

.welcome_letter_image img {
    width: 100px;
    border-radius: 50%;
    border: 1px solid #d2cece8c;
    padding: 5px;
}

.welcome_letter_profile {
    display: flex;
    align-items: center;
}

.welcome_letter_image {
    margin-right: 10px;
}

.welcome_letter_info p {
    color: var(--text2);
    margin: 0;
}

.welcome_letter_page.detail {
    margin-top: 20px;
}

.welcome_letter_info span {
    color: var(--text2);
}

@media only screen and (max-width: 768px) {
    .welcome_data_letter {
    flex-wrap: wrap;
}
.welcome_letter_detail h2 {
    font-size: 24px;
}
}

@media only screen and (max-width: 576px) {
.welcome_letter_info h4 {
    font-size: 16px;
}
.welcome_letter_info h6 {
    font-size: 14px;
}
}
</style>
<?php
$u_code=$this->session->userdata('user_id');
$profile=$this->profile->profile_info($u_code);
$my_package=$this->business->package($u_code);
?>
    <center>
		<a href="" class="btn btn-success" onclick='printDiv();' title="Print Form"><i class="fa fa-print"></i></a>
		</center>
		
    <div class="welcome_letter_page detail">
        <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="welcome_letter_design">
                        <div class="welcome_data_letter">
                            <div class="welcome_letter_detail">
                                <h2>welcome letter</h2>
                            </div>
                            <div class="welcome_letter_detail_personal">
                               <ul>
                                <li>Email: <b><?= $profile->email;?></b></li>
                                <li>Purchase Date: <b><?= $profile->added_on;?></b></li>
                                <li>Purchase Amount: <b><?= $my_package;?></b></li>
                               </ul>
                            </div>
                        </div>
                        <div class="welcome_letter_content">
                        <?php
                         $welcome_condition=$this->conn->runQuery('*','legal_data','lega_page_type="welcome_letter"');
                         if($welcome_condition){
                         foreach($welcome_condition as $welcome_condition1){
                        
                         ?> 
                            <strong>Dear <?php echo $welcome_condition1->legal_title;?></strong>
                            <p><?php echo $welcome_condition1->legal_desc;?></p>
                        </div>
                        <?php  
                             }
                          }
                        ?>
                        <div class="welcome_letter_profile">
                            <div class="welcome_letter_image">
                            <?php  if($profile->img!=''){?>
                            <img src="<?=  base_url('images/users/').$profile->img;?>" alt="images">
                            <?php }else{ ?>
                            <img src="<?=  $this->conn->company_info('logo');?>" alt="images">
                            <?php
                                }
                            ?>
                            </div>
                            <div class="welcome_letter_info">
                                <h4><?= $profile->username;?></h4>
                                <p><?= $profile->name;?></p>
                                <span><?= $profile->mobile;?></span>
                            </div>
                        </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
    </div>
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
