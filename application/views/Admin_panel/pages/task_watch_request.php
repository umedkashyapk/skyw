<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Product Request</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Product</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  All </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<?php
$tt_orders=$this->conn->runQuery('count(id) as total','task_data_request',"type='watch_ads'")[0]->total;

?>
<h6 class="text-uppercase"> Request(<?=$tt_orders?>)</h6>
<hr>

<?php
        $success['param']='success';
        $success['alert_class']='alert-success';
        $success['type']='success';
        $this->show->show_alert($success);

        $resp=json_decode($this->conn->setting('order_status'),true);
     
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <form action="<?= $admin_path.'task/watch-request';?>" method="get">
             <div class="form-inline">
                  <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 
                 <div class="form-group m-1">
                    <select class="form-control" name="req_status" id="">
                        <option value="">Select Request Status</option>
                        <option value='0' <?= isset($_REQUEST['req_status']) && $_REQUEST['req_status']=='0' ? 'selected':'';?> >Pending</option>
                        <option value='1' <?= isset($_REQUEST['req_status']) && $_REQUEST['req_status']=='1' ? 'selected':'';?> >Success</option>
                        
                    </select>
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
                 
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                <a href="<?= $admin_path.'task/watch-request';?>" class="btn btn-sm">Reset</a>
                  
            </div>
        </form>
      
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Action</th>
                        <th>USERID(NAME)</th>
                        <!--<th>Watch Id</th>-->
                        <th>Product Name</th>
                        <th>Product Mrp</th>
                        <th>Product Description</th>
                        <th>Status</th>
                        <th>Date </th>
                    </tr>
                </thead>
                <tbody>
                     <?php

                if($table_data){
                    
                    foreach($table_data as $t_data){   
                        $sr_no++;
                        
                       $profile=false;
                       if($t_data['u_code']!=''){
                           $profile=$this->profile->profile_info($t_data['u_code'],'name,username');
                       }
                    
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                         <td>
                         <a class="btn btn-sm btn-info" href="<?= $admin_path.'task/request_view?id='.$t_data['id'];?>">View</a>
                          </td>                     
                        <td><?= $profile ? $profile->username .'('.$profile->name.')':'';?></td>                                
                        <!--<td><?= $t_data['task_id'];?></td>-->
                        <td><?= $t_data['product_name'];?></td>
                        <td><?= $t_data['product_mrp'];?></td>
                        <td><?= $t_data['product_description'];?></td>
                        <td><?php 
                         if($t_data['req_status']==1){
                             echo"Success";
                         }else{
                             echo"Pending";
                         }
                        
                        ?></td>
                        
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
