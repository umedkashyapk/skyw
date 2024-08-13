<style>

.earning-sec {
    margin-top: 10px;
}
</style>
<section class="network-sec">
        <div class="container">
             <div class="eraning_link_data">
              <div class="row">
                  <div class="col-md-2">
                       <a href="<?= $panel_path.'crypto/add-fund';?>">
                        <div class="earning_link"> 
                            Add Fund
                        </div>
                        </a>
                    </div><div class="col-md-2">
                        <a href="<?= $panel_path.'crypto/add_fund_history';?>">
                        <div class="earning_link">
                            Add Fund History
                        </div>
                        </a>
                    </div>
                     <div class="col-md-2">
                         <a href="<?= $panel_path.'fund/fund-transfer';?>">
                        <div class="earning_link">
                            Fund Transfer
                        </div>
                        </a>
                    </div>
                     <div class="col-md-2">
                         <a href="<?= $panel_path.'fund/transfer-history';?>">
                        <div class="earning_link">
                            Fund Transfer History
                        </div>
                        </a>
                    </div>
                    
                      <div class="col-md-2">
                          <a href="<?= $panel_path.'Fund/fund-convert';?>">
                        <div class="earning_link">
                            Fund Convert
                        </div>
                        </a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= $panel_path.'fund/fund_retrive_history';?>">
                        <div class="earning_link fund1">
                            Fund retrive History
                        </div>
                        </a>
                    </div>
                   
                   
                    </div>
               
           
            
      
   
        
        </div>
    </section>
<section class="earning-sec">
        <div class="container">
           
                
                
            <div class="formContainer">
               <form action="<?= $panel_path.'fund/fund_retrive_history'?>" method="get">
                <div class="row">
                  <div class="col-sm-2 mb-3">
                         <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">
                    </div>
                     <div class="col-sm-2 mb-3">
                         <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                    </div>
                    <div class="col-sm-2 mb-3">
                         <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">
                    </div>
                      <div class="col-sm-2 mb-3">
                        <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">
                               
                    </div>
                   <!-- <div class="col-sm-2 mb-3">
                        <select>
                            <option value="">Select Input Type</option>
                            <option value="">Passive Income</option>
                            <option value="">Level Income</option>
                        </select>
                    </div>-->
                   <!-- <div class="col-sm-2 mb-3">
                        <select>
                            <option value="">10</option>
                            <option value="">20</option>
                            <option value="">50</option>
                            <option value="">100</option>
                            <option value="">200</option>
                        </select>
                    </div>-->
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="col-6">
                               <button class="btnPrimary" type="submit" name="submit">Filter</button>
                            </div>
                            <div class="col-6">
                               <a href="<?= $panel_path.'fund/fund_retrive_history'?>"  class="btnPrimary" name="submit">Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="earningTable ">
                
         <table>
        <thead>
            <tr>
                <th>Sl No.</th>
                <th>Txn. User</th>
                <th>Txn. Type</th>
                <th>Credit/Debit</th>
                <th>Balance</th>
                <th>Remark</th>
                <th>Date&Time</th>
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
                foreach($table_data as $t_data){
    
                    if($t_data['tx_type']=='credit'){                    
                        $no_of_pins=$t_data['credit'];
                    }else{
                        $no_of_pins=$t_data['debit'];
                    }
    
                        if($t_data['tx_u_code']!=''){
                            $tx_profile=$this->profile->profile_info($t_data['tx_u_code']);
                        }else{
                            $tx_profile=$this->profile->profile_info($t_data['u_code']);
                        }
                        $sr_no++;
                ?>
                <tr>
                    <td><?=  $sr_no;?></td>
                    <td><?= ($tx_profile ? $tx_profile->name:'');?></td>
                    <td><?= $t_data['tx_type'];?></td>               
                    <td><?= $t_data['debit_credit'];?></td> 
                    <td><?= $t_data['amount'];?></td>               
                    <td><?= $t_data['remark'];?></td> 
                    <td><?= $t_data['added_on'];?></td>   
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
<br>
<br>
