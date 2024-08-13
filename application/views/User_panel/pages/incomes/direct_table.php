        <?php
        $u_code=$this->session->userdata('user_id');
        
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
                   <div class="col-md-2">
                       <a href="<?= $panel_path.'income/details?source=direct';?>">
                        <div class="earning_link dark">
                            Direct Income
                        </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= $panel_path.'income/details?source=level';?>">
                        <div class="earning_link">
                            Daily Team Building Bonus
                        </div>
                        </a>
                    </div>
                     <div class="col-md-2">
                           <a href="<?= $panel_path.'income/details?source=autopool';?>">
                        <div class="earning_link">
                          Autopool Income
                        </div>
                        </a>
                    </div>
                  
                    </div>
                </div>
                
                 <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Direct Income</a></li>            
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
                               <a href="<?= $panel_path.'income/details'?>"  class="btnPrimary" name="submit">Reset</a>
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
                <div class="earningTableHeading">
                    <p>Total Income : <span><?= $total ? $total:0;?></span></p>
                    <p>Payable Income : <span><?= $payable ? $payable:0;?></span></p>
                </div>
               <table class="user_table_info_record">
                    <thead>
                        <tr>
                            <th class="text-left border-right" >Sl No.</th>
                            <th class="text-left" >User</th>
                            <th class="text-left" >From</th>
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
                                <td class="text-left border-right"><?= $sr_no;?></td>
                                <td class="text-left"><?= $user->name;?> (<?= $user->username;?>) </td>
                                <td class="text-left"><?= $tx_profile ? $tx_profile->name:'';?> ( <?= $tx_profile ? $tx_profile->username : '';?> )</td>
                                <td class="text-right"><?= round($t_data['amount'],2);?></td>                               
                               <!-- <td class="text-right"><?= round($t_data['tx_charge'],2);?></td>-->
                                <td class="text-left"><small><?= $t_data['remark'];?></small></td>                                
                                <td class="text-left"><?= $t_data['date'];?></td>                                
                                           
                            </tr>
                            <?php
                        }
                    }
                        ?>
                        
                    </tbody>
                </table>
                 <?php 
                
                echo $this->pagination->create_links();?>
                <!--<h3 id="noData">No Data To Show <i class="fa-regular fa-file-lines"></i> </h3>-->
            </div>
        </div>
    </section>
    <br>
   <br>
  
     