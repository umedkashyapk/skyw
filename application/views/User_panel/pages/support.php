<div class="user_content" id="all_margin_bottom_pages">
        <div class="container">
            <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Support</li>
         </ol>
	   </div>
	 
</div>




<style>


.email_buttons a {
    padding: 7px 10px;
    border: none;
    border-radius: 4px;
    background-color: var(--second);
    color: #fff;
    font-weight: 500;
    font-size: 14px;
    text-transform: capitalize;
}

.btn-danger {
    font-size: 12px;
 
}

.btn-success {
 
    font-size: 12px;
}
</style>

</head>


<body>
    <div class="support_page_design">
        <div class="container">
        <div class="row">
<form action="<?= $panel_path.'support'?>" method="get">
   <div class="col-12">
      <div class="support_tcket_data">
         <div class="row">
         
            <div class="col-lg-6 col-md-12 col-sm-12">
               <div class="ticket_data_detail">
                  <div class="form-group">
                     <label class="form-label" style="">Ticket ID</label>
                     
                     <input type="text" Placeholder="ticket id" name="ticket" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' ">
                  </div>
               </div>
            </div>
            <!--<div class="col-lg-3 col-md-12 col-sm-12">
               <div class="ticket_data_detail">
                  <div class="form-group">
                     <label class="form-label">Category</label>
                     <select class="form-control">
                        <option value="">Select Category</option>
                        <option value="1">General</option>
                        <option value="2">Error</option>
                        <option value="3">Commissions</option>
                        <option value="4">tds related</option>
                        <option value="5">Buisness plan related</option>
                        <option value="6">Account verification related</option>
                        <option value="7">demo</option>
                     </select>
                  </div>
               </div>
            </div>-->
            <!--<div class="col-lg-3 col-md-12 col-sm-12">
               <div class="ticket_data_detail">
                  <div class="form-group">
                     <label class="form-label">Priority</label>
                     <select class="form-control">
                        <option value="">Select Priority</option>
                        <option value="2">Low</option>
                        <option value="3">Critical</option>
                     </select>
                  </div>
               </div>
            </div>-->
            <div class="col-lg-6 col-md-12 col-sm-12">
               <div class="ticket_data_detail">
                  <div class="form-group">
                     <label class="form-label">Status</label>
                     <select class="form-control" name="status">
                        <option value="">Select Status</option>
                        <option value="0" <?= isset($_REQUEST['status']) && $_REQUEST['status']=='0' ? 'selected':'';?> >Not Replied</option>
                        <option value="1" <?= isset($_REQUEST['status']) && $_REQUEST['status']=='1' ? 'selected':'';?> >Replied</option>
                        
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-12">
               <div class="tickets_buttons email_buttons">
                  <button type="submit" name="submit">search</button>
                  <a href="<?= $panel_path.'support'?>" class="reset_cancel"> Reset </a>
               </div>
            </div>
         </div>
         
      </div>
      
   </div>
   </form>
</div>
       
           <div class="row"><?php 
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
            $user_id=$this->session->userdata('user_id');
             $profile=$this->profile->profile_info($user_id);
             
             $support=$this->conn->runQuery('COUNT(id) as ttl','support',"u_code='$user_id'")[0]->ttl;
             $support_not_replied=$this->conn->runQuery('COUNT(id) as ttl','support',"u_code='$user_id' and status='0'")[0]->ttl;
             $support_replied=$this->conn->runQuery('COUNT(id) as ttl','support',"u_code='$user_id' and status='1'")[0]->ttl;
             
         
            ?>

              <div class="col-lg-4 col-md-12 col-sm-12">
                 <div class="support_page_new_design">
                     <div class="support_datail">
                          <h4>support detail</h4> 
                          <ul>
                           <!-- <li>
                                Support
                                <span class="green_color"><?= ($support) ? ($support):0;?></span>
                            </li>-->
                            <li>
                            Not Replied inquiry
                                <span class="red_color"><?= ($support_not_replied) ? ($support_not_replied):0;?></span>
                            </li>
                            <li>
                                Replied inquiry
                                <span class="green_color"><?= ($support_replied) ? ($support_replied):0;?></span>
                            </li>
                            <li>
                                Total inquiry
                                <span class="green_color"><?= ($support) ? ($support):0;?></span>
                            </li>
                          </ul>
                     </div>
                    <div class="urgent_email">
                        <div class="urgent_inner_content">
                      <h4>Urgent inquiry Information</h4>
                      <ul>
                        <!-- <li>Ticket No: 647547</li> -->
                        <li>Name: <?= $profile->name;?></li>
                        <li>Email: <?= $profile->email;?></li>
                        <li>Phone: <?= $profile->mobile;?></li>
                      </ul>
                    </div>
                    
                    </div>
                     <div class="recent_email_inquiry">
                        <h4>latest ticket</h4>
                        <ul>
                        <?php
                               $support_latest=$this->conn->runQuery('*','support',"u_code='$user_id' order by id DESC limit 5");
                               if($support_latest){
                                foreach($support_latest as $support){
                               ?>
                            <li>
                               <div class="email_inquiry">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                               </div>
                              
                               <div class="email_inquiry_text">
                                  <h6><?= $support->ticket;?></h6>
                                  <p><?= $support->timestamp;?></p>
                                  <p><?= $support->message;?></p>
                               </div>
                               
                            </li>
                            <?php
                                  }
                               }
                               ?>
                            <!-- <li>
                                <div class="email_inquiry">
                                 <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="email_inquiry_text">
                                   <h6>bons</h6>
                                   <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                </div>
 
                             </li> 
                             <!-- <li>
                                <div class="email_inquiry">
                                 <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="email_inquiry_text">
                                   <h6>bons</h6>
                                   <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                </div>
 
                             </li> -->
                             <!-- <li>
                                <div class="email_inquiry">
                                 <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="email_inquiry_text">
                                   <h6>bons</h6>
                                   <p>when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
                                </div>
 
                             </li> -->
                        </ul>
                     </div>
                 </div>
              </div>
              <div class="col-lg-8 col-md-12 col-sm-12">
              <div class="total_ticket_number_emil">
               <h4>
                NEW SUPPORT TICKET
               </h4>
               <p>Would you like to speak to one of our financial advisers over the phone? Just submit your details and we'll be in touch shortly. You can also email us if you would prefer.</p>
                <div class="email_enquiry_form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group"> 
                                    <label for="exampleInputname">name</label> 
                                    <input type="text" class="form-control" id="exampleInputname" placeholder="demo" value="<?= $this->session->userdata('profile')->name; ?>" readonly> 
                                </div>
                                <div class="form-group"> 
                                    <label for="exampleInputname">User ID</label> 
                                    <input type="email" id="" class="form-control " value="<?= $this->session->userdata('profile')->username; ?>" readonly>
                                </div>
                                <div class="form-group"> 
                                    <label for="exampleInputname">Description</label> 
                                    <textarea required="" class="form-control" rows="4" name="description"></textarea>
                                </div>
                                <div class="email_buttons">
                               
                               <button type="submit" name="send">Send</button>
                              
                               <a href="<?= $panel_path.'support'?>" class="reset_cancel"> Reset </a>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
              <div class="support_email_table">
                <h4>Support Ticket</h4>
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>Ticket Id</th>
                            <th>Description</th>
                            <th>Create Date</th>
                            <th>Status</th>
                            <th>Reply</th>
                        </tr>
                        <?php
                $user=$this->session->userdata('profile');
                if($table_data){
                    foreach($table_data as $t_data){
                        $sr_no++;
                        ?>
                        <tr>
                            <td><?= $t_data['ticket'];?></td>
                            <td><?= $t_data['message'];?></td>
                            <td><?= $t_data['updated_on'];?></td>
                            <td><?php 
                            $rst=$t_data['reply_status'];
                            if($rst==0){
                                ?>
                            <button class="btn btn-danger">Not Replied</button>	
                                <?php
                            }else{
                                ?>
                            <button class="btn btn-success">Replied</button>	
                                <?php
                            }
                            ?></th>
                            <td><?= $t_data['reply'];?></td> 
                        </tr>
                       <?php
                        }
                    }
                       ?>

                    </tbody>
            
                </table>


              </div>




            </div>
      

           </div>
        </div>
    </div>

     
    <br>
<br>
