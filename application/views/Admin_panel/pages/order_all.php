<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Orders</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"></a></li>            
            <li class="breadcrumb-item active" aria-current="page">  All </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<?php

$tt_orders=$this->conn->runQuery('count(id) as total','orders',"1=1")[0]->total;
$reg_type=$this->conn->setting('reg_type')=='product_base';
?>
<h6 class="text-uppercase"> Order(<?=$tt_orders?>)</h6>
<hr>

<?php
        $success['param']='success';
        $success['alert_class']='alert-success';
        $success['type']='success';
        $this->show->show_alert($success);

        $resp=json_decode($this->conn->setting('order_status'),true);
        /*if($this->session->has_userdata($search_parameter)){
        	$get_data=$this->session->userdata($search_parameter);
        	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
        }else{
        	$likecondition=array();
        }*/
        
        //echo json_encode($resp);
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <form action="<?= $admin_path.'order';?>" method="get">
             <div class="form-inline">
                <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Ai Subscription id" name="id" class="form-control" value='<?= isset($_REQUEST['id']) && $_REQUEST['id']!='' ? $_REQUEST['id']:'';?>' />                      
                 </div>
                 &nbsp;
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                </div>
                
                
                 <div id="dateragne-picker">
                    <div class="input-daterange input-group">
                    <input type="text" class="form-control"  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                    <div class="input-group-prepend">
                    <span class="input-group-text">to</span>
                    </div>
                    <input type="text" class="form-control"  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                    </div>
               </div>
                 <div class="form-group m-1">
                 <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                  </div>
                 
               <!-- <div class="form-group m-1">
                  <select class="form-control" name="payment_status" id="">
                     <option value="">Select Payment Status</option>
                       <option value='0' <?= isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']=='0' ? 'selected':'';?> >Pending</option>
                    <option value='1' <?= isset($_REQUEST['payment_status']) && $_REQUEST['payment_status']=='1' ? 'selected':'';?> >Success</option>
                        
                  </select>
                 </div> -->
                
                    
                 
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                 <a href="<?= $admin_path.'order';?>" class="btn btn-sm">Reset</a>
                 <input type="submit" name="export_to_excel" class="btn btn-sm" value="Export to excel" /> 
            </div>
        </form>
        <?php
        $ttl=$this->conn->runQuery('sum(order_amount)as total,sum(order_bv)as bv','orders',"1=1");
        $ttl_amnt=$ttl[0]->total;
        $ttl_tx_charge=$ttl[0]->bv;
        ?>
         <div align="right">
            <div class="table table-responsive"> 
                <table>
                    <tr>
                      <th>Total Order Amount(<?=round($ttl_amnt)?>)</th>
                      
                      <?php
                     if($reg_type){
                       
                      ?>
                      <th>Total Order Bv(<?=round($ttl_tx_charge)?>)</th>
                  <?php
                  
                  }
                  ?>
                   </tr>
                </table>
            </div>
        </div>    
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Action</th>
                        <th>USERID(NAME)</th>
                        <th>Order Id</th>
                        <th>Order Amount (<?= $this->conn->company_info('currency');?>) </th>
                        <!-- <th>AI Sub. cappiing</th> -->
                        
                         <?php
                     if($reg_type){
                       
                      ?>
                        <th>Order BV</th>
                       
                        
                        <?php
                        }
                        
                        ?>
                        
                        <th>Payment Status </th>
                       
                            <?php
                     if($reg_type){
                       
                      ?>
                        <th>Order Status </th>
                       
                        
                        <?php
                        }
                        
                        ?>
                        
                        <th>Date & Time </th>
                    </tr>
                </thead>
                <tbody>
                     <?php

                if($table_data){
                    
                    foreach($table_data as $t_data){   
                        $sr_no++;
                        
                       $payment_status= $resp[$t_data['payment_status']];
                       $order_status= $resp[$t_data['status']];
                       $profile=false;
                       if($t_data['u_code']!=''){
                           $profile=$this->profile->profile_info($t_data['u_code'],'name,username');
                       }
                       
                       $date_column=$this->order->date_column($t_data['status']);
                       
                       
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                         <td>
                         <?php
                            if($payment_status=='Pending' || $order_status=='Pending'){
                                ?>
                           <a class="btn btn-sm btn-info" href="<?= $admin_path.'order/view?id='.$t_data['id'];?>">View</a>
                           <!-- <a class="btn btn-sm btn-info" href="<?= $admin_path.'order/capping_edit?id='.$t_data['id'];?>" style="background-color:#d32525;">edit</a> -->
                            <?php
                            }
                            if($payment_status=='0'){
                                ?>
                                <a class="btn btn-sm btn-danger" href="<?= $admin_path.'order/delete?id='.$t_data['id'];?>">Delete</a>
                                <?php
                            }
                            if($payment_status=="Success"){
                            ?>
                            <a class="btn btn-sm btn-info" href="<?= $admin_path.'order/bill?id='.$t_data['id'];?>">Print Bill</a>
                            <?php } ?>
                            
                        </td>                     
                        <td><?= $profile ? $profile->username .'('.$profile->name.')':'';?></td>                                
                        <td><?= $t_data['id'];?></td>                               
                           
                        <td><?= $t_data['order_amount'];?></td>  
                                              
                        <!-- <td><?= $t_data['order_capping'];?></td>                                -->
                          <?php
                     if($reg_type){
                       
                      ?>                                    
                        <td><?= $t_data['order_bv'];?></td> 
                           <?php
                           }
                           ?>                             
                        <td><?= $order_status;?></td> 
                             <?php
                     if($reg_type){
                       
                      ?>                                     
                        <td><?= $order_status;?></td>
                         <?php
                           }
                           ?>  
                        
                        <td><?= $t_data['added_on'];?></td> 
                                   
                    </tr>
                    <?php
                    }
                }
            ?>
                    
                </tbody>
            </table>
        </div>
          <?php 
    
    echo $this->pagination->create_links();?>
    </div>
</div>
