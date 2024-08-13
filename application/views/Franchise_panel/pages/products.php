 
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">

		    <h4 class="page-title"> Products</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Product details</li>
            <li class="breadcrumb-item " aria-current="page"></li>

         </ol>
          
	   </div>
    <!--  <div class="col-sm-3">
                <div class="btn-group float-sm-right">
                <a class="btn btn-success btn-sm" href="<?= $fanchise_path.'product/add_product';?>">Add Product </a>
                    
                </div>
            </div> -->
     </div>
    <!-- End Breadcrumb-->

<!--End Row-->
<?php 

            $franchise_id=$this->session->userdata('franchise_id');
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
            <th>Product Id   </th>
          <!--  <th>#   </th>-->
            <th>Name   </th>
            <th>MRP   </th>
            <th>DP   </th>
            <th>Product bv   </th>
            <th>Pending qty   </th>
          
            <th>Action   </th>
          </tr>
          <?php


          if(!empty($table_data)){
            foreach($table_data as $t_data){
                $product_details=$this->product->product_detail($t_data['id']);
                $product_id=$t_data['id'];
                 
                  
                $left_sale= $this->product->franchise_stock($franchise_id,$product_id);
                $left_sale_qty=($left_sale >='1'? $left_sale : "Out Of Stock");
                ?>
                <tr>
                    <td>#<?= $t_data['id'];?></td>
                    <!--<td><img src="<?= base_url().'images/products/'.$t_data['imgs'];?>" style="width:50px;"></td>-->
                    <td><?= $t_data['name'];?></td>
                    <td><?= $t_data['mrp'];?></td>
                    <td><?= $t_data['dp'];?></td>
                    <td><?= $t_data['product_bv'];?></td>
                    
                    <td><?= $left_sale_qty;?></td>                    
                  
                   <td><?php if($left_sale >= '1') { ?><button class="btn btn-success btn-sm add_to_cart" data-productId="<?= $t_data['id'];?>" > Add to cart</button> <?php } ?></td>
                   
                </tr>
                <?php
            }
          }
          ?>
         
    </table>
         <a href="<?= $franchise_path.'products/cart';?>" class="btn btn-success btn-sm" > Proceed</a>
        </div>
        </div>
    <?php  echo $this->pagination->create_links();?>

     
        
       
    </div><!--End Row-->