 
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">

		    <h4 class="page-title"> Products</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Admin Stock</li>
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
             <th>Company Stock</th>
              <?php
            $franchise_user=$this->conn->runQuery('*','franchise_users',"1=1");
            foreach($franchise_user as $franchise_user1){
                 ?>
               <th><?= $franchise_user1->username;?></th>
            <?php
                }
            ?>
             <th>Total Sale</th>
             <th>Total Stock</th>
            
          </tr>
          <?php


          if(!empty($table_data)){
           
            foreach($table_data as $t_data){
              $product_details=$this->product->product_detail($t_data['id']);
                //print_r($t_data);
                $productID=$t_data['id'];
                /* $left_sale=$this->product->admin_stock($productID);
                            $left_sale_qty=($left_sale >='1'? $left_sale : "Out Of Stock");*/
                             
                       
                ?>
                <tr>
                    <td>#<?= $t_data['id'];?></td>
                    <td><?= $t_data['name'];?></td>
                    <td><?= $mrp_total[]=$t_data['mrp'];?></td>
                    
                    
                    <td><?= $total_bv[]=$t_data['product_bv'];?></td>
                    <td><?=  $total_stock=$this->product->company_admin_stock($productID);?></td>
                   <?php 
                     $franchise_user=$this->conn->runQuery('*','franchise_users',"1=1");
                     $ttlsa=array();
                       foreach($franchise_user as $franchise_user2){
                            $f_code=$franchise_user2->id;
                            $shopee_sale=$this->conn->runQuery('SUM(quantity) as stk','franchise_order_items',"product_id='$productID' and f_code=$f_code and franchise_order_status=1")[0]->stk;?> 
                    <td><?= $ttlsa[]=$shopee_sale ? $shopee_sale:0;?></td>
                    <?php  
                    }
                    ?>
                    <td> <?= $franchise_stock=array_sum($ttlsa);?></td>                     
                    <td> <?= $total_stock-$franchise_stock;?></td>  
                     
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