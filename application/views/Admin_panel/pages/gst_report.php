<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Gst Report</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Gst Report</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  All </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>

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
        
        <form action="<?= $admin_path.'order/gst-report';?>" method="get">
             <div class="form-inline">
                  <input type="text" Placeholder="Enter UserId" name="username" class="form-control " value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />
                <input type="text" Placeholder="Enter Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />
               
                 
                  
                 
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                <!--<input type="submit" name="reset" class="btn btn-sm" value="Reset" />-->
                 <a href="<?= $admin_path.'order/gst-report';?>" class="btn btn-sm">Reset</a>
                  
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
                      <th>Total Order Amount(<?= round($ttl_amnt)?>)</th>
                     
                      <th>Total Gst(<?= round($ttl_amnt*18/100)?>)</th>
                 
                   </tr>
                </table>
            </div>
        </div>    
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>USERID(NAME)</th>
                        <th>Order Amount (<?= $this->conn->company_info('currency');?>) </th>
                        
                         <?php
                     if($reg_type){
                       
                      ?>
                        <th>Order BV</th>
                       
                        
                        <?php
                        }
                        
                        ?>
                        
                        <th>Gst(18%)</th>
                       
                            <?php
                     if($reg_type){
                       
                      ?>
                        <th>Order Status </th>
                       
                        
                        <?php
                        }
                        
                        ?>
                        
                        <th>Date </th>
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
                       
                      $gst=$t_data['order_amount']*18/100;
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                                    
                        <td><?= $profile ? $profile->username .'('.$profile->name.')':'';?></td>                                
                                           
                           
                                              
                        <td><?= $t_data['order_amount'];?></td>  
                          <?php
                     if($reg_type){
                       
                      ?>                                    
                        <td><?= $t_data['order_bv'];?></td> 
                           <?php
                           }
                           ?>                             
                        <td><?= $gst;?></td> 
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
