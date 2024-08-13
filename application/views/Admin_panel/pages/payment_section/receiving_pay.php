<?php
$u_code=$this->session->userdata('user_id');
$currency=$this->conn->company_info('currency');


$this->db->where_in('unique_name',$methods);
$this->db->where('status',1);
$res=$this->db->get('payment_receiving_methods');
$arr=$res->result_array();

?>

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
<div class="col-lg-12">
           <div class="card">
             <div class="card-body"> 
             <form method="post" action="">
                <div class="row">
                 <div class="col-md-3">
                      <div class="tabs-vertical tabs-vertical-dark">
                             <ul class="nav nav-tabs flex-column top-icon">
                                 <?php
                                 
                                 if(!empty($arr)){
                                     $s=0;
                                     foreach($arr as $arr_val){
                                         $s++;
                                         ?>
                                         <li class="nav-item">
                                            <a class="nav-link <?= ($s==1 ? 'active show':'');?>" data-toggle="tab" href="#<?= $arr_val['unique_name'];?>"> <i class="icon-wallet"></i>  <span class="hidden-xs"><?= $arr_val['name'];?></span></a>
                                          </li>
                                         <?php
                                     }
                                 }
                                 ?>
                              </ul>
                     </div>
                </div>
                <div class="col-md-9 text-dark">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php
                                 
                                 if(!empty($arr)){
                                     $s=0;
                                     foreach($arr as $arr_val){
                                         $s++;
                                         ?>
                                          <div id="<?= $arr_val['unique_name'];?>" class="container tab-pane <?= ($s==1 ? 'active show':'fade');?>">
                                             
                                            <?php
                                            $unique_name=$arr_val['unique_name'];
                                            $field_type=$arr_val['field_type'];
                                            $select_from_methds=$arr_val['method_type'];
                                            
                                            if($field_type=='select'){
                                                $options=json_decode($arr_val['field_required'],true);
                                                ?>
                                                <div class="form-group">
                                                    <select name="<?= $unique_name;?>" class="<?= $select_from_methds;?> form-control">
                                                        <?php
                                                            foreach($options as $_kye=>$option){
                                                                ?>
                                                                    <option value="<?= $_kye;?>"><?= $option;?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <?php
                                            }
                                            
                                            if($select_from_methds=='wallet'){
                                                ?>
                                                <div class="form-group">
                                                    <input type="checkbox" id="wallet_<?= $unique_name;?>" checked />
                                                    <label for="wallet_<?= $unique_name;?>">
                                                        <?= $arr_val['name']." : $currency ".$this->update_ob->wallet($u_code,$unique_name);?>
                                                    </label>
                                                </div>
                                                <?php
                                                 
                                            }
                                            
                                            ?>
                                            <div class="form-group">
                                                <input type="submit" name="<?= $unique_name;?>_submit" value="Proceed" class="btn btn-info" />
                                            </div>
                                          </div>
                                          
                                <?php
                                     }
                                 }
                                 ?>
                           
                         </div>
                         
                </div>
              </div><!--End Row-->
              </form>
              
       </div>
           </div>
        </div>


