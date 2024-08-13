<?php
$ttl=$this->conn->runQuery('sum(order_amount)as total,sum(order_bv)as bv','franchise_orders',"1=1");
$ttl_order_amnt=$ttl[0]->total;
$ttl_bv=$ttl[0]->bv;
?>
<div class="row pt-2 pb-2">
<div class="col-sm-9">
  <h4 class="page-title">Franchise purchase History</h4>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Franchise</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Purchase History</li>
  </ol>
 
      
      
      
 
 
</div>
</div>

    <!-- End Breadcrumb-->

<!--End Row-->
            <?php 
                    $success['param']='alert_success';
                    $success['alert_class']='alert-success';
                    $success['type']='success';
                      $this->show->show_alert($success);
                      ?>
                        <?php 
                    $erroralert['param']='alert_error';
                    $erroralert['alert_class']='alert-danger';
                    $erroralert['type']='error';
                      $this->show->show_alert($erroralert);
                      ?>
            <!--End Row-->
            <?php
            
            // $likecondition=($this->session->userdata($search_string) ? $this->session->userdata($search_string):array());
             
             
             ?>
             <form action="<?= $admin_path.'franchise/purchase';?>" method="get">
                 <div class="form-inline">
                     
                    
                     <div class="form-group"> 
                     <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />            
                      
                     </div> 
                      <div class="form-group"> 
                        <input type="text" Placeholder="Enter Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />            
                                              
                     </div>
                     <div class="form-group">
                         <input type="text" Placeholder="Enter Franchise name" name="franchise_name" class="form-control" value='<?= isset($_REQUEST['franchise_name']) && $_REQUEST['franchise_name']!='' ? $_REQUEST['franchise_name']:'';?>' />                                   
                       
                     </div>
                     <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                     <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                     <a href="<?=$admin_path.'franchise/purchase';?>" class="btn btn-sm">Reset</a>
                </div>
            </form>
            <?php
                 $ttl_pages=ceil($total_rows/$limit);
                 if($ttl_pages>1){
                     ?>
                      <form action="" method="get">
                        <div class="form-group">
                            
                            Go to Page : 
                            <input type="text" list="pages" name="page" value="<?= (isset($_REQUEST['page']) ? $_REQUEST['page']:'');?>" />
                            
                            <datalist id="pages">
                                 <?php
                                     for($pg=1;$pg<=$ttl_pages;$pg++){
                                         ?><option value="<?= $pg;?>" ><?= $pg;?></option><?php
                                     }
                                 ?>
                            </datalist>
                            <input type="submit" name="submit" class=" " value="Go" />
                        </div>
                    </form>
                     <?php
                 }
                ?>
               
             <br>
    <div align="right">
     <div class="table table-responsive"> 
    <table class="boarder=1px solid black">
    <tr>
    <th>Total Dp<b>(<?=$ttl_order_amnt?>)</b></th>
    <th>Total Bv<b>(<?=$ttl_bv?>)</b></th>
    
    </tr>
    </table>
    </div>
     </div>
            <div class="row">
              <div class="col-md-12 bg-light">
                <div class="table-responsive">
                  <table class="table table-condensed ">
                    <tr>
                      <th>Sr no.</th>
                      <th>Username</th>
                      <th>Full Name</th>
                      <th>Franchise Name</th>
                      <th>Total Mrp</th>
                      <th>Total Dp</th>
                      <th>Total Bv</th>
                      <th>Sale Date & time</th>
                      <th>Action</th>
                    </tr>
                    <?php  
                    
                      if(!empty($table_data)){             
                        foreach($table_data as $t_data){
                             $fcode=$t_data['f_code'];
                             $f_detail=$this->conn->runQuery('*','franchise_users',"id='$fcode'");
                             
                          ?>
                            <tr>
                              <td><?= $t_data['id'];?></td>
                              <td><?= $f_detail[0]->username;?></td>
                              <td><?= $f_detail[0]->name;?></td>
                              <td><?= $f_detail[0]->franchise_name;?></td>
                              
                              <td><?= $t_data['order_mrp'];?></td>
                              <td><?= $t_data['order_amount'];?></td>
                              <td><?= $t_data['order_bv'];?></td>
                              <td><?= $t_data['added_on'];?></td>
                              <td><a href="<?= $admin_path.'franchise/order?order_id='.$t_data['id'];?>" class="btn btn-success btn-sm" >View</a>
                             
                              </td> 
                            </tr>
                          <?php
                        }
                      }
                    ?>           
                  </table>
                
                </div>
              </div>
            <?php  echo $this->pagination->create_links();?>      
            </div><!--End Row-->

