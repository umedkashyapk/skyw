        <?php
        $u_code=$this->session->userdata('user_id');
        $source='royalty';
        $ttl_income=$this->conn->runQuery('(SUM(amount) - SUM(tx_charge)) as amnt,SUM(amount) as ttl','transaction',"u_code='$u_code' and tx_type='income' and source='$source'");
        $total =  $ttl_income[0]->ttl!='' ? $ttl_income[0]->ttl:0;
        $payable =  $ttl_income[0]->amnt!='' ? $ttl_income[0]->amnt:0;
        
         
        ?>        
          <style>
            .btnPrimary{
                width:100%;
            }
        </style>
        
     <section class="earning-sec">
        <div class="container">
            <div class="eraning_link_data">
              <div class="row">
                    
                     <?php
                    $reg_plan=$this->session->userdata('reg_plan');
                   
                       $all_income=$this->conn->runQuery('*','wallet_types',"wallet_type='income' and status='1' and $reg_plan='1' ");
                       if($all_income){
                           foreach($all_income as $income){
                               ?>
                   <div class="col-md-3">
                       <a href="<?= $panel_path.'income/details?source='.$income->slug;?>">
                        <div class="earning_link">
                            <?= $income->name;?>
                        </div>
                        </a>
                    </div>
                    <?php
                               }
                           }
                           ?>
                   
                     <div class="col-md-3">
                       <a href="#">
                        <div class="earning_link">
                           Royalty By Company Turnover
                        </div>
                        </a>
                    </div>       
                   
                   
                    </div>
                </div>
                  <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"><?php
            if($source=='royalty'){
                echo"Royalty Income";
            }
            
            ?></a></li>            
            <!--<li class="breadcrumb-item active" aria-current="page">Autopool Income</li>-->
         </ol>
	   </div>
    </div>
            <div class="formContainer">
               <form action="<?= $panel_path.'income/details'?>" method="get">
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
                    <div class="col-sm-2 mb-3">
                         <select name="select_level" id="" >
                             <option value="">Select Level</option>
                           <?php
                         for($f=1;$f<=10;$f++){
                             ?>
                             <option value="<?= $f;?>" <?= isset($_REQUEST['select_level']) && $_REQUEST['select_level']==$f ? 'selected':'';?> >Level <?= $f;?></option>
                             <?php
                         }
                         ?>
                       </select>
                    </div>
                    <div class="col-sm-2 mb-3">
                         <select name="limit" id="" class="form-control select_user_panel">
                          <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                          <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                          <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                          <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                       </select>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="col-6">
                                <button class="btnPrimary" type="submit" name="submit">Filter</button>
                            </div>
                            <div class="col-6">
                                  <a href="<?= $panel_path.'income/details'?>"  class="btnPrimary" name="submit">Reset</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
 <section>>
        <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
               <div class="report_detail_data widthrawal_data">
                   <div class="widthrwal_report_user">
                    <h3>Total Income</h3>
                    <P><?= $total ? $total:0;?></P>
                   </div>
                   <div class="widthrwal_report_user">
                    <h3>Payable Income</h3>
                    <P><?= $payable ? $payable:0;?></P>
                   </div>
                  <?php
                    $is_payout=$this->conn->setting('earning_type');
                    if($is_payout=='payout'){
                        $generated_amts=$this->wallet->generated_payout_by_income($u_code,$source);
                        $pending_amts=$this->wallet->pending_payout_by_income($u_code,$source);
                        ?>
                         | Generated Payout : <?= $generated_amts!='' ? $generated_amts :0 ;?>
                         | Expected Payout : <?= $pending_amts!='' ? $pending_amts :0 ;?>
                        <?php
                    }
                   
                ?>
               </div>
                <div class="user_card_body">
                   <div class="user_table_data">
                      <table class="user_table_info_record">
                    <table class="user_table_info_record">
                    <thead>
                        <tr>
                            <th class="text-left" >S No.</th>
                            <th class="text-left" >User</th>
                            <th  class="text-right" >Amount (<?= $this->conn->company_info('currency');?>)</th>
                           <!-- <th  class="text-right" >Extra Charges (<?= $this->conn->company_info('currency');?>)</th>-->
                            <th  class="text-left" >Remark</th>
                            <th  class="text-left" >Date </th>
                             
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $user=$this->session->userdata('profile');
                    if($table_data){
                        
                        foreach($table_data as $t_data){
                            $tx_profile=false;
                                $tx_profile=$this->profile->profile_info($t_data['tx_u_code']);
                                $sr_no++;
                                
                        ?>
                        <tr>
                            <td class="text-left"><?= $sr_no;?></td>
                            <td class="text-left"><?= $user->name;?> (<?= $user->username;?>) </td>
                                                          
                            <td class="text-right"><?= round($t_data['amount'],2);?></td>                               
                            <!--<td class="text-right"><?= round($t_data['tx_charge'],2);?></td>-->
                            <td class="text-left"><small><?= $t_data['remark'];?></small></td>                                
                            <td class="text-left"><?= $t_data['date'];?></td>                                
                                       
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
        <br>
        
    <?php echo $this->pagination->create_links();?>
    <br>
   <br>