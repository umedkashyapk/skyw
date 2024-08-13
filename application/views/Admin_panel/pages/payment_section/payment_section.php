<?php
$method_details_arr=$this->conn->runQuery('*','company_payment_methods',"status='1' and unique_name='$payment_type'");

$method_details=$method_details_arr && $method_details_arr[0]->fields_required!='' ? json_decode($method_details_arr[0]->fields_required,true) :false;
if($method_details){
    foreach($method_details as $_key=>$method_detail){
        ?>
        <div class="form-group">
            <label for="<?= $_key;?>"><?= $method_detail;?></label>
            <input type="" class="form-control" id="<?= $_key;?>" name="account[<?= $_key;?>]" placeholder="<?= $method_detail;?>" />
        </div>
        <?php
    }
}

?>
