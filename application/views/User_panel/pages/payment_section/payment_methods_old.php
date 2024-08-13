            <?php
             
            
                $available_payment_methods_arr=$this->conn->setting($prm_label);
                $available_payment_methods=json_decode($available_payment_methods_arr,true);
                if(!empty($available_payment_methods) && count($available_payment_methods)>1){
                    ?>
                    <div class="form-group" >
                        <label>Select Payment method*</label>
                        <select name="product_prm" class="form-control get_method_advance_info" >
                            <option value="">Select method</option>
                            <?php
                            foreach($available_payment_methods as $m_key=>$payment_methods_details){
                                ?><option value="<?= $m_key;?>"><?= $payment_methods_details;?></option><?php
                            }
                            ?>
                        </select>
                        <small class=""></small>
                    </div>
                    <?php
                }
                
                
                
            ?>
           <div id="prm_types_section" style="display:none;" >
               <div class="form-group"  >
                    <label>Select Payment Type*</label>
                    <select name="prm" class="form-control get_method_info" data-responsearea="subpayment_section">
                        <option value="">Select Type</option>
                        <?php
                        $available_payment_arr=$this->conn->setting('prm');
                        $available_payments=json_decode($available_payment_arr,true);
                        foreach($available_payments as $m_key=>$payment_methods_details){
                            ?><option value="<?= $m_key;?>"><?= $payment_methods_details;?></option><?php
                        }
                        ?>
                    </select>
                    <small class=""></small>
                </div>
                 
                <div class="form-group">
                    <label>Select Payment Option</label>
                    <select name="prm_option" class="form-control payment_option_details" id="subpayment_section" data-responsearea="payment_option_details">
                        <option value="">Select option</option>
                    </select>
                </div>
                 
                <div id="payment_option_details" class="text-center" >
                    
                </div>
            </div>
            
            
            