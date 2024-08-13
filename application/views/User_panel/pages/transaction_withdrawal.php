<?php 

         $userid=$this->session->userdata('user_id');
         $total_withdrawal=$this->conn->runQuery("SUM(amount) as amt",'transaction',"u_code='$userid' and tx_type='withdrawal'");
         $total_paid_withdrawal=$this->conn->runQuery("SUM(amount) as amt",'transaction',"u_code='$userid' and tx_type='withdrawal' and status='1'");
         $total_reject_withdrawal=$this->conn->runQuery("SUM(amount) as amt",'transaction',"u_code='$userid' and tx_type='withdrawal' and status='2'");
         ?>

<section class="network-sec">
        <div class="container">
             <div class="eraning_link_data">
              <div class="row">
                   
                     <div class="col-md-2">
                        <div class="earning_link">
                            <a href="<?= $panel_path.'fund/fund-withdraw';?>">Withdrawal</a>
                        </div>
                        <div class="earning_link">
                            <a href="<?= $panel_path.'transactions/principal_withdrawals';?>">Principal Withdrawal</a>
                        </div>
                    </div>
                    
                  
                    
                    </div>
                </div>
          
        </div>
    </section>


    <section>
        <div class="container">
            <div class="earningTable ">
                 <table class="user_table_info_record">
                  
                        <tbody>
                            <tr>
                                <th>Sl No.</th>
                                <th>Amount (<?= $this->conn->company_info('currency');?>)</th>
                                <th>Deduction (5%) (<?= $this->conn->company_info('currency');?>)</th>
                                <th>Payable Amount (<?= $this->conn->company_info('currency');?>)</th>
                                <th>Status</th>
                                <th>Reason</th>
                                <th>Hash</th>
                                <th>Date and times </th>
                            </tr>
                            <?php
                            $user=$this->session->userdata('profile');
                            if($table_data){
                                
                                foreach($table_data as $t_data){
                                    $tx_profile=false;
                                    $tx_profile=$this->profile->profile_info($t_data['tx_u_code']);
                                    $sr_no++;
                                    ?>
                            <tr>
                                <td><?= $sr_no;?></td>
                                <td><?= $ttl=$t_data['amount']+$t_data['tx_charge'];?></td>
                               
                                <td><?= $t_data['tx_charge'];?></td>
                                <td><?= $ttl=$t_data['amount'];?></td>
                                <td><?php 
                                switch($t_data['status']){
                                    case 1 :
                                        echo 'Approved';
                                        break;
                                    case 0 :
                                        echo 'Pending';
                                        break;
                                    case 2 :
                                        echo 'Rejected';
                                        break;
                                }
                                ?></td> 
                                <td><?= $t_data['reason'];?></td> 
                                <td><?= $t_data['tx_hash'];?></td> 
                                <td><?= $t_data['date'];?></td> 
                               
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                
                    </table>
                <?php 
                
                echo $this->pagination->create_links();?>
            </div>
        </div>
    </section>
    
    
    
