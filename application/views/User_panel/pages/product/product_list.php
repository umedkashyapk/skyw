   <br>
   <?php
        $u_code=$this->session->userdata('user_id');
        ?>
        <div class="container pages">
       <div class="row pt-2 pb-2">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
                    <li class="breadcrumb-item"><a href="#">Products</a></li>            
                     
                </ol>
        	</div>
        	  
        </div>
        
        <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
             <!-- <div class="reward_detail_page">
                    <div class="excel_button_user">
                        <button ><span> <i class="fa fa-file-excel-o" aria-hidden="true"></i>Excel Export</span></button>
                    </div>
                    <div class="serch_bar_ecxel">
                        <span>Search:</span>
                        <input type="search" class="form-control" placeholder="" aria-controls="responsive-table">
                        <select class="form-control d-inline ml-2" id="" style="width: 200px">
                            <option value="">-- Status Filter --</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                           
                        </select>
                    </div>
                </div>-->
                <div class="user_card_body">
                   <div class="user_table_data">
                      
                           <table class="user_table_info_record">
                    <thead>
                        <tr>
                            <th class="text-left border-right" >S No.</th>
                            <th  class="text-left" >Product Name</th>
                            <th  class="text-right" >MRP</th>
                            <th  class="text-right" >DP</th>
                            <th  class="text-right" >Available</th>
                            <th  class="text-left" >Qty</th>
                            <th  class="text-left" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        //$this->cart->destroy();
                        $product_qty=array();
                        $cart=$this->cart->contents();
                        if(!empty($cart)){
                            /*echo '<pre>';
                            print_r($cart);*/
                            $product_qty=array_column($cart,'qty','id');
                            $product_rowid=array_column($cart,'rowid','id');
                        }
                        
                        $all_products=$this->conn->runQuery('*','products',"status=1");
                        if($all_products){
                            $sno=0;
                            foreach($all_products as $product_details){
                                $sno++;
                                
                                $left_sale=$this->product->product_stock($product_details->id);
                                $left_sale_qty=($left_sale >='1'? $left_sale : "Out Of Stock");
                                $p_id=$product_details->id;
                                ?>
                                <tr>
                                    <td class="text-left border-right" ><?= $sno;?></td>
                                    <td  class="text-left" ><?= $product_details->name;?></td>
                                    <td  class="text-right" ><?= $product_details->mrp;?></td>
                                    <td  class="text-right" ><?= $product_details->dp;?></td>
                                    <td  class="text-right" ><?= $left_sale_qty;?></td>
                                    <td  class="text-left" ><input type="number" class="form-control" name="" id="qty_<?= $product_details->id;?>" value="<?= array_key_exists($p_id,$product_qty) ? $product_qty[$p_id]:0; ?>" min="1"/></td>
                                    <td  class="text-left" >
                                        <?php
                                        if(array_key_exists($p_id,$product_qty)){
                                            ?>
                                            <button class="btn btn-sm btn-success update_cart" data-productId="<?= $p_id;?>"  data-rowid="<?= $product_rowid[$p_id];?>">Update</button>
                                            <button class="btn btn-sm btn-danger remove_from_cart" data-productId="<?= $p_id;?>" data-rowid="<?= $product_rowid[$p_id];?>">delete</button>
                                            <?php
                                        }else{
                                            ?>
                                            <button class="btn btn-sm btn-success add_to_cart" data-productId="<?= $product_details->id;?>">Add to cart</button>
                                            <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                       
                    </tbody>
                </table> 
                        
                   </div> 
               </div> 
               
            <a href="<?= $panel_path.'/product/cart';?>" class="user_btn_button"  >Proceed</a>
       </div>
    </div>
       
       
        
        </div>       
     