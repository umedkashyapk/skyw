<style>
    .btnPrimary {
    width:auto;
}

th {
    background: var(--grident) !important;
    color:var(--textColor) !important;
}
</style>

<section class="network-sec">
        <div class="container">
            
                  <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Transactions</a></li>            
            </ol>
	   </div>
    </div>
            <div class="formContainer">
                 <form action="<?= $panel_path.'transactions';?>" method="get">
                <div class="row">
                    <div class="col-sm-3 mb-3">
                       <input type="text" Placeholder="Tx User"  name="name" value="<?= (isset($_REQUEST['name']) ? $_REQUEST['name']:''); ?>"/>
                    </div>
                    <div class="col-sm-3 mb-3">
                         <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                    </div>
                       
             <div class="col-sm-3 mb-3">
                        <select name='wallet_type'>
                        <option>Select Wallet</option>
                        <option value='main_wallet'>Main Wallet</option>
                        <option value='fund_wallet'>Fund Wallet</option>
                    </select>
                        
                    </div>
                     
                    <div class="col-sm-3 mb-3">
                         <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">
                              
                    </div>
                    <div class="col-sm-3 mb-3">
                        <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">
                               
                    </div>
                   
                    
                   
                </div>
                  
                <div class="networkButton">
                     <button class="btnPrimary" type="submit" name="submit">Filter</button>
                    <a href="<?= $panel_path.'transactions';?>"  class="btnPrimary" name="submit">Reset</a>
                   
                </div>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="earningTable ">
                 <table class="user_table_info_record">
                  
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Tx user</th>
                        <th>Username</th>
                         <th>Debit/Credit</th>                
                         <th>Wallet Type</th>                
                        <th>Amount (<?= $this->conn->company_info('currency');?>)</th>
                        <th>Extra Charges (<?= $this->conn->company_info('currency');?>)</th>
                         
                        <th>Remark</th>
                        <th>Date </th>
                         
                    </tr>
                </thead>
                <tbody>
                    <?php
        
                if($table_data){
                    
                    foreach($table_data as $t_data){               
        
                            if($t_data['tx_u_code']!=''){
                                $tx_profile=$this->profile->profile_info($t_data['tx_u_code']);
                            }else{
                                $tx_profile=$this->profile->profile_info($t_data['u_code']);
                            }
                    $sr_no++; 
                    
                    $tx_type=$t_data['tx_type'];
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                        <td><?= $tx_profile->name;?></td>
                        <td><?= $tx_profile->username;?></td>                                             
						 <td><?= $t_data['debit_credit'];?></td>       					
						 <td><?= $t_data['wallet_type'];?></td>       					
                        <td><?= $t_data['amount'];?></td>                               
                        <td><?= $t_data['tx_charge'];?></td>                               
                          
                        <td><small><?= $t_data['remark'];?></small></td>                                
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
                
                <br><br>
            </div>
        </div>
    </section>
    
    <br>
<br>
    
