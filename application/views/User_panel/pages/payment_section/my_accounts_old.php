<?php
$user_id=$this->session->userdata('user_id');
$company_payment_methods=$this->conn->runQuery('*','company_payment_methods',"status='1'");

$fields=array();
if($company_payment_methods){
	foreach($company_payment_methods as $payment_method_detais){
		$fields[$payment_method_detais->unique_name]=json_decode($payment_method_detais->fields_required,true);
	}
}
	

?>
					
    
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>S No.</th>
                                <th>Default</th>
                                <th>Account details</th>
                                <th>Action</th>
                            </tr>
							<?php
    				        $my_accounts_arr=$this->conn->runQuery('*','user_payment_methods',"u_code='$user_id' and status='1'");
    				        if($my_accounts_arr){
    				            $sno=0;
    				            $default=$my_accounts_arr[0]->default_account;
    				            $my_accounts=$my_accounts_arr[0]->accounts!='' ? json_decode($my_accounts_arr[0]->accounts,true):array();
    				              
    				            
						if(!empty($my_accounts)){
							foreach($my_accounts as $ky_acc=>$my_account){
								$indx=$ky_acc;
								$sno++;
								
								$acc_type=$my_account['account_type'];
								$fields_arr=!empty($fields) && array_key_exists($acc_type,$fields) ? $fields[$acc_type]:array();
								?>

<tr>
                				            <td><?= $sno;?></td>
                				            <td> <?php if($default==($indx)){ ?><i class="fa fa-hand-o-right" aria-hidden="true"></i><?php } ?> </td>
                				            <td>
                				                <?php
                				                foreach($my_account as $_key=>$account_details){
                				                    if($_key!='account_type'){
                    				                     $ky=!empty($fields_arr) && array_key_exists($_key,$fields_arr) ? $fields_arr[$_key]:$_key;
                    				                     echo "$ky : $account_details<br>";
                				                    }
                				                }
                				                
                				                /*echo '<pre>';
    				                            print_r($my_account);
    				                            echo '</pre>';*/
    				                            
                				                ?>
                				                
                				            </td>
                				            <td>
                				                <?php
                				                if($default!=($indx)){
                				                    $sd_id=$indx+1;
                    				                ?>
                    				                <a href="<?= $panel_path.'payment/add_account';?>?delete=<?= $sd_id;?>" class="text-danger fs-10">delete</a> <a href="<?= $panel_path.'payment/add_account';?>?default=<?= $sd_id;?>" class="text-info fs-10">Set default</a>
                    				                <?php
                				                }
                				                ?>
                				            </td>
                				             
                				        </tr>
        				                <?php
        				            } 
    				            }
    				        }else{
    				            ?>
    				            <tr>
    				                <td colspan=4><center><a class="add_account_button" href="<?= $panel_path.'payment/add_account';?>">Add Account</a></center></td>
    				            </tr>
    				            
    				            <?php
    				        }
    				        ?>
                            <!-- <tr>
                                <td colspan="4"><center><a class="add_account_button" href="button_data">Add Account</a></center></td>
                            </tr> -->
                        </tbody>
                
                    </table>
             