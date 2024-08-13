          <style>
          .form-group.radio {flex-direction: column;align-items: baseline;}
.mailer_table {
    overflow-x: auto;
}

.redio_detail {
    display: flex;
    align-items: center;
    gap: 3px;
}
button.btn.btn-info.btn-sm {
    margin-left: 10px;
}
          table.table.table-sm.company_table {
    display: block !important;
    width: 100% !important;
    overflow-x: auto !important;
}
              .td.company_num {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        td.company_name {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }
        .form-control.company_form_list {
            margin-right: 10px;
        }
        .form-group.company_form_group {
            margin-left: 10px;
            margin-right: 10px;
        }
        label.company_form_list {
            margin-right: 5px !important;
        }
        .form-control.company_form_list.data_detail {
              padding: 4px !important;
         }
         button.btn.btn-info.btn-sm.radio {
    margin-left: 20px;
}
          </style>
          
          
           <?php   //$display=(isset($_SESSION['admin_otp']) ? 'block':'none'); ?>
            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= $admin_path.'dashboard';?>">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="<?= $admin_path.'settings';?>">Settings</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#"><?= $_GET['title'];?></a>
					</li>
					 
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-12 card card-body">
		    <div class="mailer_table">
		    <table class="table table-sm company_table">
		      
		   
		      <tr class="company_detail">
        		          <td class="company_num"><?= 1;?></td>
        		          <td  class="company_name">Company Name</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_name');?>"  name="company_name" id="company_name">
                              </div>
                          
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 send_button company_button" >Send OTP</button>
                      -->
                      <!--<div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              
                              <button type="submit" class="btn btn-info btn-sm" name="btn1">Submit</button>  
                            </form>
        		          </td>
        		      </tr>
        		      <tr>
        		          <td class="company_num"><?= 2;?></td>
        		          <td class="company_name">Base URL</td>
        		          <td  class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('base_url');?>"  name="base_url" id="base_url">
                              </div>
                              
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn2">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		     <tr>
        		          <td  class="company_num"><?= 3;?></td>
        		          <td class="company_name">Company Logo</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post"   enctype="multipart/form-data">
        		                    <div class="form-group">
                                    <img src="<?= $this->conn->company_info('logo');?>"  style="height:100px;width:130px;">
                                    </div>
                                    <div class="form-group">
                                  <input type="file" name="logo" id="logo" value="" class="form-control company_form_list data_detail" placeholder="" aria-describedby="helpId">
                              </div>
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn3">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		       <tr>
        		          <td  class="company_num"><?= 4;?></td>
        		          <td  class="company_name">Logo Height</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('logo_height');?>"  name="logo_height" id="logo_height">
                              </div>
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn4">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		       <tr>
        		          <td  class="company_num"><?= 5;?></td>
        		          <td  class="company_name">Logo Width</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group ">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('logo_width');?>"  name="logo_width" id="logo_width">
                              </div>
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn5">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		       <tr>
        		          <td  class="company_num"><?= 6;?></td>
        		          <td  class="company_name">Company Title</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('title');?>"  name="title" id="title">
                              </div>
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn6">Submit</button>
                            </form>
        		          </td>
        		      </tr> <tr>
        		          <td  class="company_num"><?= 7;?></td>
        		          <td  class="company_name">Company Address</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group ">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_address');?>"  name="company_address" id="company_address">
                              </div>
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for=""  class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn7">Submit</button>
                            </form>
        		          </td>
        		      </tr> <tr>
        		          <td  class="company_num"><?= 8;?></td>
        		          <td  class="company_name">Company Mobile</td>
        		          <td class="company_form">
        		              <form class="form-inline" action="" method="post">
                              <div class="form-group ">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_mobile');?>"  name="company_mobile" id="company_mobile">
                              </div>
                             <!-- <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control " placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn8">Submit</button>
                            </form>
        		          </td>
        		      </tr><tr>
        		          <td  class="company_num"><?= 9;?></td>
        		          <td  class="company_name">Company Currency</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('currency');?>"  name="currency" id="currency">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn9">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		      
        		      <tr>
        		          <td  class="company_num"><?= 10;?></td>
        		          <td  class="company_name">Token Rate</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('token_rate');?>"  name="token_rate" id="token_rate">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn10">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		        <tr>
        		          <td  class="company_num"><?= 11;?></td>
        		          <td  class="company_name">Company Founder Name</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_founder_name');?>"  name="company_founder_name" id="company_founder_name">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn11">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		       <tr>
        		          <td  class="company_num"><?= 12;?></td>
        		          <td  class="company_name">Company Founder Name</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_founder_desgnation');?>"  name="company_founder_desgnation" id="company_founder_desgnation">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn12">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		       <tr>
        		          <td  class="company_num"><?= 13;?></td>
        		          <td  class="company_name">Company Facebook Link</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_facebook_link');?>"  name="company_facebook_link" id="company_facebook_link">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn13">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		       <tr>
        		          <td  class="company_num"><?= 14;?></td>
        		          <td  class="company_name">Company Twitter Link</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_twitter_link');?>"  name="company_twitter_link" id="company_twitter_link">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn14">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		      
        		     <!-- <tr>
        		          <td  class="company_num"><?= 15;?></td>
        		          <td  class="company_name">Company Pinterest Link</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_pinterest_link');?>"  name="company_pinterest_link" id="company_pinterest_link">
                              </div>
                              <button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn15">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		      
        		     <!-- <tr>
        		          <td  class="company_num"><?= 16;?></td>
        		          <td  class="company_name">Company Linkdin Link</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_linkedin_link');?>"  name="company_linkedin_link" id="company_linkedin_link">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn16">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		      
        		      <tr>
        		          <td  class="company_num"><?= 17;?></td>
        		          <td  class="company_name">Company Telegram Link</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group">
                                <input type="text" class="form-control company_form_list" value="<?= $this->conn->company_info('company_telegram_link');?>"  name="company_telegram_link" id="company_telegram_link">
                              </div>
                              <!--<button type="button" data-response_area="action_areap" class="btn btn-primary btn-sm send_otp2 company_button" >Send OTP</button>
                              <div id="action_areap" style="display:<?= $display;?>"> 
                        <div class="form-group company_form_group">
                          <label for="" class="company_form_list">Enter OTP </label>
                          <input type="text" name="otp_input2" id="otp_input2" value="<?= set_value('otp_input2');?>" class="form-control" placeholder="Enter OTP" aria-describedby="helpId">
                          <span class=" " ><?= form_error('otp_input2');?></span> 
                        </div> 
                       
                      </div>-->
                              <button type="submit" class="btn btn-info btn-sm" name="btn17">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		      
        		     <tr>
        		          <td  class="company_num"><?= 20;?></td> 
        		          <td  class="company_name">Company  Mailer</td>
        		          <td class="company_form">
        		              <form class="form-inline"  method="post" action="">
                              <div class="form-group radio">
                                  <div class="redio_detail">
                                      
                                      <?php
                                      $mailer=$this->conn->company_info('mailer_username');
                                      
                                      ?>
                                <input type="radio" class="form-control"  value="support@gambitbot.io" <?php echo ($mailer=='support@gambitbot.io')?'checked':'' ?>  name="cryptomailer">support@gambitbot.io
                                </div>
                                 
                                <div class="redio_detail">
                                <input type="radio" class="form-control" value="info@gambitbot.io" <?php echo ($mailer=='info@gambitbot.io')?'checked':'' ?> name="cryptomailer">info@gambitbot.io
                                </div>

                                 <div class="redio_detail">
                                <input type="radio" class="form-control" value="noreply@gambitbot.io" <?php echo ($mailer=='noreply@gambitbot.io')?'checked':'' ?> name="cryptomailer" >noreply@gambitbot.io
                                
                              </div>
                              </div>
                             
                              <button type="submit" class="btn btn-info btn-sm  radio" name="btn20">Submit</button>
                            </form>
        		          </td>
        		      </tr>
        		      
        		     
        		      
		  </table>
		    </div>
    		
		</div>
	</div>
	

 