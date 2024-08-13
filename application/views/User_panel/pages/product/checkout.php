<br><br>
<div class="container pages">



<form action="" method="post" enctype="multipart/form-data">
    
     <br>
                <h5 class="checkout-title">Payment Section</h5>
                <hr>
                
                <?php 
                if(isset($_SESSION['error'])){
                ?>
                <div class="alert alert-danger "><i class="fa fa-check-circle"></i> Success: <?php echo $_SESSION['error'];?>
                </div>
                <?php }?>
                
    <div class="row">
        <div class="col-lg-6">
            <div class="checkout-billing-details-wrap">
               
                <div class="billing-form-wrap">
                   
                         
                    <div class="row">
                        <div class="col-md-6 form-group">
                            
                            <input type="text" id="f_name" name="shipping[name]" class="form-control" placeholder="First Name" value="<?php if($this->session->has_userdata('user_login')){ echo $profile->name;  } ?>"  required />
                        </div>
                             
    
                        <div class="col-md-6 form-group">
                             
                            <input type="email" id="email" name="shipping[email]" class="form-control"  placeholder="Email Address" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->email; }?>" required />
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <input type="text" id="pan_no" name="shipping[pan_no]" class="form-control"  placeholder="Pan No" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->pan_no; }?>" required />
                        </div>
    
                        
    
                        <div class="col-md-12 form-group">
                             
                            <input type="text" name="shipping[address1]" class="form-control" id="street-address" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->address; }?>" placeholder="Street address Line 1" required />
                        </div>
    
                        <div class="col-md-12 form-group">
                            <input type="text"  name="shipping[address2]" class="form-control" placeholder="Street address Line 2 (Optional)" />
                        </div>
    
                        <div class="col-md-6 form-group">
                            
                            <input type="text"  name="shipping[city]" class="form-control"  id="town" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->city; }?>" placeholder="Town / City" required />
                        </div>
    
                        <div class="col-md-6 form-group">
                             
                            <input type="text"  name="shipping[state]" class="form-control"  id="state" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->state; }?>" placeholder="State / Divition" />
                        </div>
    
                        <div class="col-md-6 form-group">
                             
                            <input type="text"  name="shipping[postcode]" class="form-control"  id="postcode" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->post_code; }?>" placeholder="Postcode / ZIP" required />
                        </div>
    
                        <div class="col-md-6 form-group">
                            
                            <input type="text"  name="shipping[mobile]" class="form-control"  id="phone" value="<?php if($this->session->has_userdata('user_login')){  echo $profile->mobile; }?> " placeholder="Phone" />
                        </div>
    
    
                        <div class="col-md-12 form-group">
                            <label for="ordernote">Order Note</label>
                            <textarea name="shipping[ordernote]" class="form-control"  id="ordernote" cols="30" rows="3" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="order-summary-details">
                <div class="order-summary-content">
                    <div class="order-summary-table table-responsive text-center">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Products</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($this->cart->contents())){
                                        foreach ($this->cart->contents() as $items){
                                            ?>
                                            <tr>
                                                <td><a href="<?php echo base_url().'product?id='.$items['id'];?>"><?= $items['name'];?> <strong> × <?= $items['qty'];?></strong></a>
                                                </td>
                                                <td><?= $currency.' '.$this->cart->format_number($items['subtotal']);?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Sub Total</td>
                                    <td><strong><?= $currency.' '.$this->cart->format_number($this->cart->total());?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Order Payment Method -->
                    <div class="order-payment-method card card-body">
                        
                        <?php
                        $data['prm_label']='product_prm';
                        $this->load->view($panel_directory.'/pages/payment_section/payment_methods',$data);
                        ?>
                        
                        <button type="submit" name="continue_btn" class="btn btn-success btn-sqr">Place Order</button>
                       <?php echo validation_errors(); ?>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</form>
</div>