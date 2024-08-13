<?php 
$profile=$this->session->userdata("profile"); 
$user_id=$this->session->userdata("user_id"); 
?>
<div class="user_content">
    <div class="container">
   <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home /</a></li>          
                    
            <li class="breadcrumb-item active" aria-current="page"> Packages</li>
         </ol>
	   </div>
	 
</div>
      <?php 
    $success['param']='success';
    $success['alert_class']='alert-success';
    $success['type']='success';
    $this->show->show_alert($success);
    ?>
        <?php 
    $erroralert['param']='error';
    $erroralert['alert_class']='alert-danger';
    $erroralert['type']='error';
    $this->show->show_alert($erroralert);

    $userid=$this->session->userdata('user_id');
    ?>
 <?php
        $userid=$this->session->userdata('user_id'); 
        $ttl=$this->conn->runQuery('sum(order_amount)as total,sum(order_bv)as bv','orders',"u_code='$user_id'");
        $ttl_amnt=$ttl[0]->total;
        $ttl_tx_charge=$ttl[0]->bv;
        ?>
        <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
               <div class="report_detail_data widthrawal_data">
                   <div class="widthrwal_report_user">
                    <h3>Total Package Amount</h3>
                    <P><?=round($ttl_amnt)?></P>
                   </div>
                   <!--<div class="widthrwal_report_user">-->
                   <!-- <h3>Total Package Bv</h3>-->
                   <!-- <P><?=round($ttl_tx_charge)?></P>-->
                   <!--</div>-->
                   
                  
               </div>
                <div class="user_card_body">
                   <div class="user_table_data">
                       <table class="user_table_info_record">
                            <tbody>
                              <tr>
                                <th>S No.</th>
                                <th>Package ID</th>
                                <th>Package amount</th>              
                                <!--<th>Package BV</th>                -->
                                <th>Package Date</th>
                                <th>Package Status</th>
                                <th>Claim Status</th>
                               
                                <th>Principal Amount Date</th>
                               <!-- <th>Action</th>-->
                                 
                            </tr>
                                <?php
                                $my_orders=$this->conn->runQuery('*','orders',"u_code='$user_id' ");
                                
                                if($my_orders){
                                    $sno=0;
                                    foreach($my_orders as $my_order){
                                        $sno++;
                                        $currs=date('Y-m-d  H:i:s');
                                        
                                        $get_direct_plan_income=$this->conn->runQuery('*','plan',"id='1'");
                                        $dayss=$get_direct_plan_income[0]->principal_days;
                                        $principal_status=$my_order->principal_status;
                                        if($my_order->tx_type=="repurchase"){
                                            $sts="yes";
                                            $join_date=$my_order->added_on;
                                            $principal_date=$my_order->principal_date;
                                            $next_effectiveDate = date('Y-m-d  H:i:s', strtotime("+3 day", strtotime($principal_date)));
                                            $effectiveDate = date('Y-m-d  H:i:s', strtotime("+$dayss day", strtotime($join_date)));
                                           
                                            
                                        }else{
                                           $sts="no";
                                           $effectiveDate="";
                                        }
                                        ?>
                                        <tr>
                                            <td><?= $sno;?></td>
                                            <td>#<?= $my_order->id;?></td>
                                            <td><?= round($my_order->order_amount);?></td>
                                            <!--<td><?= round($my_order->order_bv);?></td>-->
                                            <td><?= $my_order->added_on;?></td>
                                            <td><?= $my_order->status==1 ? "Approved" : "Pending"; ?> </td>
                                           <td><?= $principal_status==0 ? "Already Claim" : ""; ?>
                                           <?php if($principal_status==0){
                                           if($currs<$next_effectiveDate){
                                           ?>
                                           <p id="demo"></p>
                                           <a href="<?= $panel_path.'orders?order_id='.$my_order->id;?>" class="user_btn_button">Claim Reject</a>
                                           <?php }else{
                                           
                                           }} ?>
                                           </td>
                                           
                                            <td><?= $effectiveDate; ?> </td>
                                            <!--<td>
                                                <?php if($sts=="yes" && $principal_status==1){
                                                 if($currs>$effectiveDate){
                                                ?>
                                                <a href="<?= $panel_path.'orders?id='.$my_order->id;?>" class="user_btn_button">Claim</a>
                                                <?php } } ?>
                                                </td>-->
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                             

                            </tbody>
                       </table>
                        
                   </div> 
               </div> 
            
       </div>
    </div>



</div>
</div>

<script>
// Set the date we're counting down to
var countDownDate = new Date("<?= $next_effectiveDate;?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "";
  }
}, 1000);
</script>