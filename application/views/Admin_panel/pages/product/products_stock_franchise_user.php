 
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">

		    <h4 class="page-title"> Products</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Franchise Stock</li>
            <li class="breadcrumb-item " aria-current="page"></li>

         </ol>
          
	   </div>
  <!--   <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                <a class="btn btn-success btn-sm" href="<?= $admin_path.'product/add_product';?>">Add Product </a>
                    
                </div>
            </div>-->
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
             $likecondition=($this->session->userdata($search_string) ? $this->session->userdata($search_string):array());
             ?>
             <form action="" method="post">
             <div class="form-inline" >
                <div class="form-group" style="padding: 2px;">
                
                   <input type="text" Placeholder="Search" name="<?= $search_string;?>[name]" class="form-control" value='<?= (array_key_exists("name", $likecondition) ? $likecondition['name']:'');?>'> 
                </div>
                <div class="form-group" style="padding: 2px;">
                  <input type="submit" name="submit" class="btn" value="search"> 
                </div>
             </div>
              
              
            </form>
            <br>
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
            
    <div class="row">
     
    <div class="col-md-12 bg-light">
          
            
  

            
            <div class="table-responsive">
    <table class="table table-condensed ">
          <tr>
             <th>SR No.</th>
             <th>Product Name</th>
             <th>Mrp</th>
             <th>Bv</th>
             <th>Shopee Stock</th>
             <th>Total Sale</th>
             <th>Today Sale</th>
             <th>Pending Stock</th>
            
          </tr>
          <?php


          if(!empty($table_data)){
           
            foreach($table_data as $t_data){
              $product_details=$this->product->product_detail($t_data['id']);
                //print_r($t_data);
                $productID=$t_data['id'];
                /* $left_sale=$this->product->admin_stock($productID);
                $left_sale_qty=($left_sale >='1'? $left_sale : "Out Of Stock");*/
                   $shopee_sale=$this->conn->runQuery('SUM(quantity) as stk','franchise_order_items',"product_id='$productID'")[0]->stk;
                   $shopee_user_sale=$this->conn->runQuery('SUM(quantity) as stk','order_items',"product_id='$productID' and order_status=1")[0]->stk;
                   $shopee_user_today_sale=$this->conn->runQuery('SUM(quantity) as stk','order_items',"product_id='$productID' and order_status=1 and DATE(updated_on)=DATE(NOW())")[0]->stk;
                       
                ?>
                <tr>
                    <td>#<?= $t_data['id'];?></td>
                    <td><?= $t_data['name'];?></td>
                    <td><?= $mrp_total[]=$t_data['mrp'];?></td>
                    <td><?= $total_bv[]=$t_data['product_bv'];?></td>
                    <td><?= $shopee_sale ? $shopee_sale:0;?></td>
                    <td> <?= $shopee_user_sale ? $shopee_user_sale:0;?></td> 
                    <td> <?= $shopee_user_today_sale ? $shopee_user_today_sale:0;?></td>   
                    <td> <?= $shopee_sale-$shopee_user_sale ? $shopee_sale-$shopee_user_sale:0;?></td>  
                     
                </tr>
                
                <?php
                           
            }
          }
          ?>
      <tfoot>
    <tr>
     
      <td></td>
      <td></td>
       <td><b>Mrp Counting</b>:<?= array_sum($mrp_total);?></td>
      <td><b>BV Stock Counting</b>:<?= array_sum($total_bv);?></td>
    </tr>
  </tfoot>
    </table>
      
        </div>
        </div>
    <?php  echo $this->pagination->create_links();?>

     
        
       
    </div><!--End Row-->