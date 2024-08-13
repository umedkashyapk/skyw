
<div class="row pt-2 pb-2">
<div class="col-sm-9">
  <h4 class="page-title">Delivered Franchise Order</h4>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Franchise</a></li>
    <li class="breadcrumb-item active" aria-current="page"> Delivered Franchise Order</li>
  </ol>
 </div>
</div>
<?PHP   
 $ord_id=$this->session->userdata('admin_order_id');
$total_product_bv=array();
        $ttl=$this->conn->runQuery('sum(order_mrp)as total,sum(order_amount)as charge,sum(order_bv) as bv','franchise_orders',"status='1'");
        
        ?>
<h6 class="text-uppercase pull-right" >Total MRP (<?= $ttl[0]->total;?>)
Total Dp(<?= $ttl[0]->charge;?>)
Total Bv(<?= $ttl[0]->bv;?>)</h6>
<hr>
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
                     <input type="submit" name="submit" class="btn btn-sm" value="filter" /><br>
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
  
    
    </tr>
    </table>
    </div>
     </div>
            <div class="row">
              <div class="col-md-12 bg-light">
                <div class="table-responsive">
                  <table class="table table-condensed ">
                   
                    <tr> 
                    <th>Sr. No.</th>
                    <th>Order No.</th>
                    <th>Franchaise User Name /Full Name </th>
                    <th>Franchaise Name</th>
                    <th>Total Mrp</th>
                    <th>Total Dp</th>
                    <th>Total Bv</th>
                    <th>Sale date & Time</th>
                    <th>Delivered Date</th>
                    <th>Remark</th>
                    
                    </tr>
                    <?php  
                    
                      if(!empty($table_data)){  
                      $sr=0;           
                        foreach($table_data as $t_data){
                             $fcode=$t_data['f_code'];
                             $f_detail=$this->conn->runQuery('*','franchise_users',"id='$fcode'");
                              $tx_profile=$this->profile->franchise_info($fcode);
                          ?>
                            <tr>
                              <td><?= $sr+1;?></td>
                               <td><?= $t_data['id'];?></td>
                                <td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
                              <td><?= $f_detail[0]->franchise_name;?></td>
                              
                              <td><?= $t_data['order_mrp'];?></td>
                              <td><?= $t_data['order_amount'];?></td>
                              <td><?= $t_data['order_bv'];?></td>
                              <td><?= $t_data['added_on'];?></td>                           
                  <td><?= $t_data['updated_on'];?></td> 
                  <td><?= $t_data['remark'];?></td> 
                             </td>
                             
                            </tr>
                          <?php
                          $sr++;
                        }
                      }
                    ?>           
                  </table>
                
                </div>
              </div>
            <?php  echo $this->pagination->create_links();?>      
            </div><!--End Row-->
























