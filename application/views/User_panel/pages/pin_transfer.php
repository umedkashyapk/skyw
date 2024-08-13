<?php
$profile=$this->session->userdata("profile");

?>
<style>
.tabs {
  width: 600px;
  background-color: #09F;
  border-radius: 5px 5px 5px 5px;
}
ul#tabs-nav {
  list-style: none;
  margin: 0;
  padding: 5px;
  overflow: auto;
}
ul#tabs-nav li {
  float: left;
  font-weight: 500;
  margin-right: 2px;
  padding: 8px 10px;
  border-radius: 5px 5px 5px 5px;
  cursor: pointer;
}
ul#tabs-nav li:hover,
ul#tabs-nav li.active {
    background-color: var(--second) !important;
}
ul#tabs-nav li a:hover, 
ul#tabs-nav li a.active {
 
    color: #fff;
}
#tabs-nav li a {
    text-decoration: none;
    color: var(--text2);
}
.tab-content-pin {
    padding: 10px;
    border: 1px solid #d5d8da2e;
    background: var(--first) !important;
}

.tabs_data {
    background: var(--first) !important;
 
    box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 16px;

}
.tabs_content_data {
   
    margin-bottom: 10px;
}
.box_content_tabs {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

.tabs_content_data {
    display: flex;
    align-items: center;
}

.dollor_tab i {
    width: 35px;
    height: 35px;
    background-color: var(--second);
    text-align: center;
    line-height: 35px;
    color: #fff;
    border-radius: 40px;
}

.dollor_tab {
    margin-right: 10px;
}

.dollor_tab_content h4 {
    font-size: 16px;
    margin-bottom: 0;
}
.e_pin_data {
 
background: var(--first) !important;
box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 16px;
    display: flex;
    align-items: center;
}

.e_pin_image {
    background: linear-gradient(0deg,#5bc554 0,#11a666);
    padding: 10px;
    margin-right: 10px;
    border-radius: 10%;
    width: 51px;
    height: 51px;
    display: table;
    align-items: center;
}

.e_pin_image img {
    width: 100%;
}
button.e_pin_transfer {
    padding: 8px;
    background-color: var(--second);
    color: #fff;
    border-radius: 4px;
    border: none;
}
.e_pin_data_paragraph h4 {
    font-size: 14px;
    margin-bottom: 5px;
    color: var(--text2);
}

.e_pin_image.e_pin2 {
    background: linear-gradient(45deg,#44badc,#519eaf);
}
.e_pin_image.e_pin3 {
    background: linear-gradient(45deg,#f3e214,#e7d820);
}
.e_pin_data_paragraph span {
    font-size: 18px;
    color: var(--text2);
    font-weight: 500;
}
</style>

<?php
$user_id=$this->session->userdata('user_id');
$avalable_pin=$this->conn->runQuery('c19','user_wallets',"u_code='$user_id'");
$active_pin=$this->conn->runQuery('COUNT(id) as active_ttl','epins',"u_code='$user_id' and use_status='1'")[0]->active_ttl;
$pending_pin=$this->conn->runQuery('COUNT(id) as active_ttl','epins',"u_code='$user_id' and use_status='0'")[0]->active_ttl;
?>
    <div class="all_e_pin_pages">
       <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                 <div class="e_pin_data">
                     <div class="e_pin_image">
                        <img src="<?= base_url();?>/images/logo/e_pin_active.png">
                     </div>
                     <div class="e_pin_data_paragraph">
                        <h4>Active E-Pin Balance</h4>
                        <span><?= $active_pin!='' ? $active_pin:0;?>&nbsp;<i class="fa fa-thumb-tack" aria-hidden="true"></i></span>
                     </div>
                 </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="e_pin_data">
                    <div class="e_pin_image e_pin2">
                       <img src="<?= base_url();?>/images/logo/e_pin_active2.png">
                    </div>
                    <div class="e_pin_data_paragraph">
                       <h4>Available E-Pin Balance</h4>
                       <span><?= $avalable_pin[0]->c19!='' ? $avalable_pin[0]->c19:0;?>&nbsp;<i class="fa fa-thumb-tack" aria-hidden="true"></i></span>
                    </div>
                </div>
           </div>
           <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="e_pin_data ">
                <div class="e_pin_image e_pin3">
                   <img src="<?= base_url();?>/images/logo/e_pin_active_3.png">
                </div>
                <div class="e_pin_data_paragraph">
                   <h4>Pending E-Pin Balance</h4>
                   <span><?= $pending_pin!='' ? $pending_pin:0;?>&nbsp;<i class="fa fa-thumb-tack" aria-hidden="true"></i></span>
                </div>
            </div>
       </div>
        </div>

        <div class="row">
            <div class="col-12">
              <div class="tabs_data">
                  <ul id="tabs-nav">
                    <li><a href="#tab1">Pin Transfer</a></li>
                    <li><a href="#tab2">Pin Request</a></li>
                  
                  
                  </ul> <!-- END tabs-nav -->
                  <div id="tabs-content">
                    <div id="tab1" class="tab-content-pin">
                        <div class="pin_transfer">
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
                            <?php
                            $userid=$this->session->userdata('user_id');
                            $available_pins=$this->conn->runQuery('count(pin) as cnt','epins',"use_status=0 and u_code='$userid'");
                            $cnt_pins=($available_pins ? $available_pins[0]->cnt :0);
                            ?>
                            <form action="" method="post">
                                <div class="row">
                                   <div class="col-lg-12 mb-3">
                                      <label class="label_user_title">Username</label>
                                      <div class="input-group ">
                                         <input type="text" name="tx_username" value="<?= set_value('tx_username');?>" data-response="username_res"  class="form-control user_input_text check_username_exist" placeholder="Enter Username" aria-describedby="helpId">
                                      </div>
                                      <span class="" id="username_res"></span>
                                      <span class="text-danger" id="username_res"><?= form_error('tx_username');?></span>
                                   </div>
                                   <div class="col-lg-12 mb-3">
                                      <label class="label_user_title">Select Pin</label>
                                      <select class="form-control d-inline selected_pins" name="selected_pin" id="selected_pin" data-response="total_pins" required="">
                                         <option value="">Select Pin</option>
                                         </option>
                                        <?php
                                        $all_pin=$this->conn->runQuery("pin_rate,pin_type",'pin_details',"status=1");
                                        if($all_pin){
                                            foreach($all_pin as $pindetails){
                                                ?><option value="<?= $pindetails->pin_type;?>"><?= $pindetails->pin_type;?></option><?php
                                            }
                                        }
                                        ?>
                                      </select>
                                      <span class="text-danger"><?= form_error('selected_pin');?></span>
                                   </div>
                                   <div class="col-lg-12 mb-3 ">
                                      <label class="label_user_title">No. of pins</label>
                                      <div class="input-group ">
                                         <input name="no_of_pins" type="text" id="no_of_pins" class="form-control user_input_text" placeholder="No. of pins" value="" required="">
                                      </div>
                                      <small class="form-text text-danger"><?= form_error('no_of_pins');?></small>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="e_pin_transfer" type="submit" name="pin_transfer_btn">Transfer</button>
                                    </div>
                                </div>
                             </form>
                        </div>
                    </div>
                    
                    <div id="tab2" class="tab-content-pin">
                         <div class="pin_request">
                         <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                       <label class="label_user_title">Username</label>
                                       <div class="input-group ">
                                          <input name="user_id" type="text"  id="user_id" value="<?=$profile->username;?>" class="form-control user_input_text" placeholder="Username" readonly>
                                          <span class="text-danger "><?= form_error('user_id');?></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-12 mb-3 ">
                                       <label class="label_user_title">Utr Number</label>
                                       <div class="input-group ">
                                          <input name="utr_number" type="text" id="utr_number" class="form-control user_input_text" placeholder="Enter Utr Number">
                                          <span class="text-danger "><?= form_error('utr_number');?></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                       <label class="label_user_title">Slip</label>
                                       <div class="input-group ">
                                          <input name="slip_img" type="file" id="slip_img" class="form-control user_input_text">
                                       </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                       <label class="label_user_title">Select Pin</label>
                                       <select class="form-control d-inline " id="selected_pin" name="selected_pin" required="">
                                          <option value="">Select Pin</option>
                                          <?php
                                            $all_pin=$this->conn->runQuery("pin_rate,pin_type",'pin_details',"status=1");
                                            if($all_pin){
                                                foreach($all_pin as $pindetails){
                                                    ?><option value="<?= $pindetails->pin_type;?>"><?= $pindetails->pin_type;?></option><?php
                                                }
                                            }
                                            ?>
                                       </select>
                                       <span class=" "><?= form_error('selected_pin');?></span>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                       <label class="label_user_title">Number Of Pins</label>
                                       <div class="input-group ">
                                          <input name="number_of_pins" type="text" id="text" class="form-control user_input_text cal_amnt" placeholder="Enter Number Of Pins " data-pin_rate="">
                                          <span id="rate_area" class="text-danger "><?= form_error('number_of_pins');?></span>
                                       </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                       <label class="label_user_title">Remark</label>
                                       <div class="input-group ">
                                          <input name="remark" type="text" id="remark" class="form-control user_input_text" placeholder="Enter Remarks">
                                          <span class="text-danger "></span>
                                       </div>
                                    </div>
                                 </div>  
                                 <div class="row">
                                    <div class="col-12">
                                        <button class="e_pin_transfer" type="submit" name="epin_btn">Request</button>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>

                  </div> <!-- END tabs-content -->
                </div> <!-- END tabs -->
            </div>
         </div>
      </div>

       </div>
    </div>



<script>
    // Show the first tab and hide the rest
$('#tabs-nav li:first-child').addClass('active');
$('.tab-content-pin').hide();
$('.tab-content-pin:first').show();

// Click function
$('#tabs-nav li').click(function(){
  $('#tabs-nav li').removeClass('active');
  $(this).addClass('active');
  $('.tab-content-pin').hide();
  
  var activeTab = $(this).find('a').attr('href');
  $(activeTab).fadeIn();
  return false;
});
</script>

    
    
