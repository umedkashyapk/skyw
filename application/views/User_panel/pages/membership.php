<?php 
$profile=$this->session->userdata("profile"); 
$user_id=$this->session->userdata("user_id"); 
?>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <section class="membership_page" style="margin-top:120px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="package_heading">
                       <h2>PACKAGES</h2>
                      <!-- <span>fund wallet: <b>$0</b></span>-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="membership_page">
        <div class="container">
           <div class="row">
               <?php 
                $my_nvestment=$this->conn->runQuery('*','orders',"u_code='$user_id' and tx_type='purchase'");
                if($my_nvestment){
                foreach($my_nvestment as $new_my_nvestment){
                   ?>
                <div class="col-md-4">
                    <div class="member_page_content">
                       <div class="member_detail_package">
                        <ul>
                            <li>
                                <h4>My investment <span> <?= $new_my_nvestment->order_amount;?>&nbsp;<?=$currency;?></span></h4>
                            </li>
                            <li><h6>TX Type <span><?= $new_my_nvestment->tx_type;?></span></h6></li>
                            <li>
                                <h6>Package <span><?= $new_my_nvestment->order_amount;?>&nbsp;<?=$currency;?></span></h6>
                            </li>
                            <li>
                                <h6>Status <span style="color:#28c528;"><?php if($new_my_nvestment->status==1){ echo'<span class="badge bg-success">Success</span>';}elseif($new_my_nvestment->status==2){echo'<span class="badge bg-danger">Rejected</span>';}else{ echo '<span class="badge bg-primary">Pending</span>';}?></span></h6>
                            </li>
                        </ul>
                      <a href="<?= $panel_path.'invest/investment';?>" class="buy_membership">buy</a>
                       </div>
                    </div>
                </div>
                <?php
                }
                }
                ?>
             <?php 
                $my_renvestment=$this->conn->runQuery('*','orders',"u_code='$user_id' and tx_type='repurchase'");
                if($my_renvestment){
                foreach($my_renvestment as $new_my_nvestment){
                   ?>    
            <div class="col-md-4">
                <div class="member_page_content">
                    <div class="member_detail_package">
                        <ul>
                            <li>
                                <h4>My investment <span> <?= $new_my_nvestment->order_amount;?>&nbsp;<?=$currency;?></span></h4>
                            </li>
                            <li>
                                <h6>TX Type <span> <?= $new_my_nvestment->tx_type;?></span></h6>
                            </li>
                            <li>
                                <h6>Package <span><?= $new_my_nvestment->order_amount;?>&nbsp;<?=$currency;?></span></h6>
                            </li>
                            <li>
                                <h6>Status <span style="color:#28c528;"><?php if($new_my_nvestment->status==1){ echo'<span class="badge bg-success">Success</span>';}elseif($new_my_nvestment->status==2){echo'<span class="badge bg-danger">Rejected</span>';}else{ echo '<span class="badge bg-primary">Pending</span>';}?></span></h6>
                            </li>
                        </ul>
                        <a href="<?= $panel_path.'invest/reinvestment';?>" class="buy_membership">buy</a>
                    </div>
                </div>
            </div>
            <?php
                }
                }
            ?>
               <!-- <div class="col-md-4">
                    <div class="member_page_content">
                        <div class="member_detail_package">
                            <ul>
                                <li>
                                    <h4>My investment <span>$100</span></h4>
                                </li>
                                <li>
                                    <h6>TX Type <span>Purchase</span></h6>
                                </li>
                                <li>
                                    <h6>Package <span>$100</span></h6>
                                </li>
                                <li>
                                    <h6>Status <span style="color:#28c528;">success</span></h6>
                                </li>
                            </ul>
                            <button class="buy_membership">buy</button>
                        </div>
                    </div>
                </div>-->
           <!-- <div class="col-md-4">
                <div class="member_page_content">
                    <div class="member_detail_package">
                        <ul>
                            <li>
                                <h4>My investment <span>$100</span></h4>
                            </li>
                            <li>
                                <h6>TX Type <span>Purchase</span></h6>
                            </li>
                            <li>
                                <h6>Package <span>$100</span></h6>
                            </li>
                            <li>
                                <h6>Status <span style="color:#28c528;">success</span></h6>
                            </li>
                        </ul>
                        <button class="buy_membership">buy</button>
                    </div>
                </div>
            </div>-->
                <!--<div class="col-md-4">
                    <div class="member_page_content">
                        <div class="member_detail_package">
                            <ul>
                                <li>
                                    <h4>My investment <span>$100</span></h4>
                                </li>
                                <li>
                                    <h6>TX Type <span>Purchase</span></h6>
                                </li>
                                <li>
                                    <h6>Package <span>$100</span></h6>
                                </li>
                                <li>
                                    <h6>Status <span style="color:#28c528;">success</span></h6>
                                </li>
                            </ul>
                            <button class="buy_membership">buy</button>
                        </div>
                    </div>
                </div>-->
               <!-- <div class="col-md-4">
                    <div class="member_page_content">
                        <div class="member_detail_package">
                            <ul>
                                <li>
                                    <h4>My investment <span>$100</span></h4>
                                </li>
                                <li>
                                    <h6>TX Type <span>Purchase</span></h6>
                                </li>
                                <li>
                                    <h6>Package <span>$100</span></h6>
                                </li>
                                <li>
                                    <h6>Status <span style="color:#28c528;">success</span></h6>
                                </li>
                            </ul>
                            <button class="buy_membership">buy</button>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </section>


    <section class="membership_page">
        <div class="container">
          <div class="row">
            <div class="col-12">
               <div class="membership_table_desc">
                   <table class="user_table_info_record">
                            <tbody>
                              <tr>
                                <th>S No.</th>
                                <th>Package ID</th>
                                <th>Package amount</th>              
                                <!--<th>Package BV</th>                -->
                                <th>Package Date</th>
                                <th>Package Status</th>
                                <th>Action</th>
                                 
                            </tr>
                                <?php
                                $my_orders=$this->conn->runQuery('*','orders',"u_code='$user_id' ");
                                
                                if($my_orders){
                                    $sno=0;
                                    foreach($my_orders as $my_order){
                                        $sno++;
                                        ?>
                                        <tr>
                                            <td><?= $sno;?></td>
                                            <td>#<?= $my_order->id;?></td>
                                            <td><?= round($my_order->order_amount);?></td>
                                            <!--<td><?= round($my_order->order_bv);?></td>-->
                                            <td><?= $my_order->added_on;?></td>
                                            <td><?= $my_order->status==1 ? "Approved" : "Pending"; ?> </td>
                                            <td><a href="<?= $panel_path.'orders/bill?id='.$my_order->id;?>" class="user_btn_button">View Details</a></td>
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
    </section>

