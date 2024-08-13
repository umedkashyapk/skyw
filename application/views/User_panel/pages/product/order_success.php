<br><br>
<div class="container pages">
  	<ul class="breadcrumb">
    	    		<li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> home</a></li>    	    		
    	    		<li><a href="#">Success</a></li>
    	  	</ul>
  	  	<div class="row">
            <div id="content" class="col-sm-12">
            
    		
    		<div class="so-onepagecheckout layout1 m-4" >
    			<div class="col-left col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
                
                <?php 
                if(isset($_SESSION['success'])){
                ?>
                <div class="alert alert-success "><i class="fa fa-check-circle"></i> Success: <?php echo $_SESSION['success'];?>
                </div>
                <?php }
                if(isset($_SESSION['success'])){
                    ?>
                    <div class="alert alert-danger "><i class="fa fa-check-circle"></i> Error: <?php echo $_SESSION['error'];?>
                    </div>
                 <?php
                  }

?>

                  <?php
                    if($this->session->has_userdata('new_order_id')){

                        $order_id=$this->session->userdata('new_order_id');

                        $order_details=$this->conn->runQuery('*','orders',"id='$order_id'");
                        $shippingaddress=json_decode($order_details[0]->order_address);

                            ?>
                            <div class="panel " >
                                <div style=" border: 1px solid #C2C7BC;border-radius: 10px;box-shadow: 1px 2px #888888;background-color:#EFF0EE;" class="panel-body card-body">
                                <div class="row">
                                    <div class="col-6 col-md-6">
                                        <b> Shipping Address</b> <br>
                                        <?= $shippingaddress->name; ?><br>
                                        <?= $shippingaddress->mobile; ?><br>
                                        <?= $shippingaddress->email; ?><br>
                                        <?= $shippingaddress->city; ?><br>
                                        <?= $shippingaddress->postcode; ?><br>
                                        <?= $shippingaddress->address1; ?><br>
                                    </div>
                                    
                                    <div class="col-6 col-md-6">
                                        <b> Order Details</b> <br>
                                        #<?= $order_details[0]->id; ?><br>
                                        <?= $this->conn->company_info('currency'); ?> <?= $order_details[0]->order_amount+$order_details[0]->ex_charge; ?><br>
                                       Payment Status : &nbsp;
                                       <?php
                                       $payment_status = $order_details[0]->payment_status;
                                       
                                        switch ($payment_status) {
                                            case 0:
                                                $output = 'Pending';
                                                break;
                                            case 1:
                                                $output = 'Success';
                                                break;
                                        }
                                        echo $output;
                                       ?>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="  table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>S no.</th>
                                                    <th>Product code</th>
                                                    <th>Product</th>
                                                    <th>Name</th>
                                                    <th>Qty</th>
                                                    <th>Details</th>
                                                </tr>
                                                <?php
                                                
                                                $successorder_details=$order_details[0]->order_details;
                                                $order_details_arr=json_decode($successorder_details,true);
                                                //print_r($order_details_arr);
                                                
                                                if(!empty($order_details_arr)){
                                                    $sno=0;
                                                    foreach($order_details_arr as $order_key=>$order_details_val){
                                                        $sno++;
                                                        $product_details=$this->product->product_detail($order_details_val['id']);
                                                       
                                                        ?>
                                                        <tr>
                                                            <td><?= $sno;?></td>
                                                            <td><?= $product_details->p_code;?></td>
                                                            <td> 
                                                                <div class="img" style="height: 75px; width: 75px;">
                                                                    <?php $imageURL = $product_details->imgs!='' ? base_url('images/products/'.$product_details->imgs):base_url(); ?>
                                                                    <img src="<?php echo $imageURL; ?>" width="75"/>
                                                                </div>
                                                            </td>
                                                            <td><?= $order_details_val['name'];?></td>
                                                            <td><?= $order_details_val['qty'];?></td>
                                                            <td>
                                                                <?php
                                                                if(array_key_exists('options',$order_details_val)){
                                                                    foreach($order_details_val['options'] as $option_key=>$order_options){
                                                                        echo "$option_key : $order_options<br>";
                                                                    }
                                                                    
                                                                }
                                                                     
                                                                ?>
                                                            </td>
                                                             
                                                             
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                
                                            </table>
                                        </div>
                                    </div>
                                        
                                </div>
                                  

                                </div>        
                            </div>
                            <div class="row ord-items">
                                <?php
                                

                                //  print_r($this->product->getOrder($order_details[0]->id));
                                //$order=$this->product->getOrder($order_details[0]->id);

                                  ?>
                            </div>

                            <?php
                    }
                  ?>   
                
    			
    		</div>
    
            
               
          </div> 
    </div>
</div>



</div>