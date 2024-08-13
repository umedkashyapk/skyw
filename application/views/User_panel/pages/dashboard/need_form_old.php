                <?php
                $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
                $get_ip=$this->conn->runQuery('*','ip_whitelist',"ip='$ip'");
                $get_needs=$this->conn->runQuery('*','needs',"ip='$ip'");
                   
                    if(!$get_ip && !$this->session->has_userdata('need_set') && !$get_needs){
                       
                        ?>
                            <div class="modal fade" id="need_form">
                              <div class="modal-dialog">
                                  <div class="modal-content" style="border:#f13c47;margin-top:90px !important;">
                               <!-- <div class="modal-content border-warning">-->
                                  <div class="modal-body" style="color:black;">
                                    <!-- <?= $ip;?>   -->
                                      <h3>Let we help you</h3>
                                     <form action="" method="post">
                                         <div class="form-group">
                                             <input type="text" Placeholder="Enter Name" name="need_name" class="form-control" value="<?= set_value('need_name');?>" required />
                                             <small class="text-danger"><?= form_error('need_name');?></small>
                                         </div>
                                         <div class="form-group">
                                             <input type="email" Placeholder="Enter Email" name="need_email" value="<?= set_value('need_email');?>" class="form-control" required /> 
                                             <small class="text-danger"><?= form_error('need_email');?></small>
                                         </div>
                                         <div class="form-group">
                                             <input type="number" Placeholder="Enter Mobile" name="need_mobile" value="<?= set_value('need_mobile');?>" class="form-control" required /> 
                                             <small class="text-danger"><?= form_error('need_mobile');?></small>
                                         </div>
                                         <input type="submit" name="need_add" class="btn btn-primary pull-right" value="Continue" />
                                     </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php 
                         
                    } 
                ?>
                
              