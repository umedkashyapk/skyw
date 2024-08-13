<?php
$vd_id=$_REQUEST['id'];
$order_details=$this->conn->runQuery('*','orders',"id='$vd_id'")[0];
$u_code=$order_details->u_code;
$order_ids=$order_details->id;
$order_ids=$order_details->id;
$total_order_amt=$order_details->amount;
$total_order_bv=$order_details->bv;
$users_details=$this->conn->runQuery('*','users',"id='$u_code'")[0];
$pkg_details1=$this->conn->runQuery('*','order_items',"order_id='$order_ids'");
	$order_address=	json_decode($order_details->order_address,true);
 ?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">  Order Bill </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Order</a></li>            
            <li class="breadcrumb-item"><a href="#"> Bill</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Order Bill </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Order Bill</h6><br>

		
		
<style>

 table {
        
        word-wrap: break-word;
        width: 100%;
        border:1px solid black;
       table-layout: inherit;
table-layout: initial;

 }
 .invoice-box {
        max-width: 950px;
        margin: auto;
        padding: 20px;
        
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

		 .invoice-box table {
        width: 100%;
        line-height: inherit;
        
    }
    
    .invoice-box table td {
        
        vertical-align:top;
    }

@media only screen and (max-width: 800px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
        }			
}
    
    hr {
      border:none;
      color:#eee;
      background-color:#2E2F30;
      height:1px;
      width:20%;
}

									
    
</style>
<center>
		<a href="" class="btn btn-success" onclick='printDiv();' title="Print Form"><i class="fa fa-print"></i></a>
		</center>
		
 <div id="DivIdToPrint"> 
<div class="container">
  <div class="row">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   
 <div class="card">
 <div class="card-body">
<table border="1" cellspacing="0" cellpadding="0" >
    <tbody>
    
						
    <tr class="top">
     <td colspan="15" valign="top" height="50px">
       
           <h5 align="center"><span style="color:black;"><b>TAX INVOICE </b></span></h5>
           
        </td> 
        
    </tr>
        <tr>
            <td colspan="9" valign="top" >
                <b style="padding-left:10px"><?= $this->conn->company_info('bill_company_name') ?> </b><br>
                <span style="padding-left:10px"><?= $this->conn->company_info('bill_company_address') ?></span><br>
                <span style="padding-left:10px">Website: <?= $this->conn->company_info('bill_company_website') ?></span><br>
                <span style="padding-left:10px">Contact Number: <?= $this->conn->company_info('company_mobile') ?></span><br>
                <span style="padding-left:10px">GSTIN/UIN: <?= $this->conn->company_info('company_gst') ?></span><br>
                <span style="padding-left:10px">State Name: <?= $this->conn->company_info('bill_company_state') ?></span><br>
                <span style="padding-left:10px">CIN: <?= $this->conn->company_info('bill_company_cin') ?></span><br>
                <span style="padding-left:10px">Email: <?= $this->conn->company_info('company_email') ?></span>
                   
               </td>
            
            <td colspan="3">
              <b  style="padding-left:10px">Invoice No. :<?php echo $order_details->id;?> </b><br><br>
              <b  style="padding-left:10px">Delivery Date. :<?php echo date('M d,Y ',strtotime($order_details->added_on));?> </b><br><br>
              <b  style="padding-left:10px">Customer :<?php echo $order_address['name'];?> </b><br><br>
              <b  style="padding-left:10px">Despatch Document No. : </b><br>
              
                
           
            </td>
            <td colspan="3">
                <b  style="padding-left:10px">Mode/Terms of Payment : </b><br><br>
                <b  style="padding-left:10px">Other Reference(s) : </b><br><br>
                <b  style="padding-left:10px">Dated : <?php echo date('M d,Y ',strtotime($order_details->added_on));?></b><br><br>
                <b  style="padding-left:10px">Delivery Note Date : <?php echo date('M d,Y ',strtotime($order_details->added_on));?></b><br>
              
            
            </td>
        </tr>
             <tr>
             
                 
                
                <td colspan="9" valign="top" >
                     
                 
                   <b style="padding-left:10px">Buyer</b>:<br><span style="padding-left:10px;">
                    
                     <?php echo 'Name :'.$order_address['name'];?></span><br>
                             <span style="padding-left:10px;">  <?php echo 'Mobile :'.$order_address['mobile'];?></span><br>
                               
                                <span style="padding-left:10px;"><?php echo 'Email :'.$order_address['email'];?></span><br>
                                <span style="padding-left:10px;"><?php echo 'Address :'.$order_address['address1'].' '.$order_address['address2'];?></span><br>
                                <span style="padding-left:10px;"><?= $order_address['state'].' '.$order_address['postcode'];?></span><br>
                 
                </td>
                <td colspan="3">
                    <b  style="padding-left:10px">Despatched through : </b><br><br>
                    <b  style="padding-left:10px">Terms of Delivery : </b>
                    
              
            </td>
            <td colspan="3">
               <b  style="padding-left:10px">Destination : </b><br><br>
            </td>
            </tr>
                 <tr>
                        <td valign="top">
                        <p align="center" colspan="1"><b> S.No</b></p>
                        
                        </td>
                        <td valign="top" width="71" colspan="2">
                            <p align="center"><b>Description of Goods</b></p>
                       
                        
                        </td>
                         <!--<td valign="top" width="71" colspan="2">
                       
                        <p align="center"><b>Product</b></p>
                        </td>-->
                        <!-- <td valign="top" width="71" colspan="1">
                        <p align="center"><b>Name</b></p>
                         
                        </td> -->
                         <td valign="top" width="71" colspan="6">
                             <p align="center"><b>Product Code</b></p>
                         
                         </td>
                         <td valign="top" width="71" colspan="1">
                        <p align="center"><b>HSN/SAC</b></p>
                      
                        </td>
                        <td valign="top" width="71" colspan="1">
                        <p align="center"><b>Qty</b></p>
                      
                        </td>
                        
                         <td valign="top" width="71" colspan="1">
                            <p align="center"><b>IGST Rate</b></p>
                           
                        </td>
                          <td valign="top" width="71" colspan="1">
                           <p align="center"><b>IGST Amount</b></p>
                           
                        </td>
                         <td valign="top" width="71" colspan="1">
                           <p align="right"><b>Rate(<?php echo $this->conn->company_info('currency');?>)</b></p>
                           
                    </td>
                    <td valign="top" width="71" colspan="2">
                           <p align="right"><b>Amount(<?php echo $this->conn->company_info('currency');?>)</b></p>
                           
                    </td>
                  </tr>
                    <?php
                    $successorder_details=$order_details->order_details;
                    $order_details_arr=json_decode($successorder_details,true);
                    //print_r($order_details_arr);
                    
                    if(!empty($order_details_arr)){
                        $sno=0;
                        foreach($order_details_arr as $order_key=>$order_details_val){
                            $sno++;
                            $product_details=$this->product->product_detail($order_details_val['id']);
                           
                    ?>    
                  
                    <tr >
                        <td valign="top">
                        <p align="center" ><?= $sno;?></p>
                        
                        </td>
                        <td valign="top" width="71" colspan="2">
                            <p align="center"> <?php
                            if(array_key_exists('options',$order_details_val)){
                                foreach($order_details_val['options'] as $option_key=>$order_options){
                                    echo "$option_key : $order_options<br>";
                                }
                                
                            }
                                 
                            ?></p>
                        
                        
                        </td>
                        <!-- <td valign="top" width="71" colspan="2">
                       
                        <p align="center"><b> <center><div class="img" style="height: 75px; width: 75px;">
                                <?php $imageURL = $product_details->imgs!='' ? base_url('images/products/'.$product_details->imgs):base_url(); ?>
                                <img src="<?php echo $imageURL; ?>" width="75"/>
                            </div></center></b></p>
                        </td>-->
                        <!-- <td valign="top" width="71" colspan="1">
                        <p align="center"><b><?= $order_details_val['name'];?></b></p>
                         
                        </td>-->
                        <td valign="top" width="71" colspan="6">
                            <p align="center"> <?= $product_details->p_code;?></p>
                         
                         </td>
                         <td valign="top" width="71" colspan="1">
                        <p align="center"></p>
                      
                        </td>
                        <td valign="top" width="71" colspan="1">
                        <p align="center"><?= $order_details_val['qty'];?></p>
                      
                        </td>
                        <td valign="top" width="71" colspan="1">
                            <p align="center">0</p>
                           
                        </td>
                          <td valign="top" width="71" colspan="1">
                           <p align="center">0</p>
                           
                        </td>
                         <td valign="top" width="71" colspan="1">
                        <p align="right"><?= $order_details_val['price'];?></p>
                      
                        </td>
                         <td valign="top" width="71" colspan="2">
                        <p align="right"><?= $grand_amount[]=$order_details_val['subtotal'];?></p>
                      
                        </td>
                         <!--<td valign="top" width="71" colspan="1">
                            <p align="center"><b>4%</b></p>
                           
                        </td>
                          <td valign="top" width="71" colspan="1">
                           <p align="center"><b>66</b></p>
                           
                        </td>
                         <td valign="top" width="71" colspan="3">
                           <p align="center"><b>666</b></p>
                           
                        </td>-->
                  </tr>
                  <?php
                }
            }
            ?>
            <tr >
                        <td valign="top">
                        <p align="center" ></p>
                        
                        </td>
                        <td valign="top" width="71" colspan="2">
                         <p align="center"><b>Balance Payable</b></p>
                        
                        </td>
                        
                        <td valign="top" width="71" colspan="6">
                          
                         
                         </td>
                         <td valign="top" width="71" colspan="1">
                        <p align="center"><b>  </b></p>
                      
                        </td>
                        <td valign="top" width="71" colspan="1">
                        <p align="center"></p>
                      
                        </td>
                        <td valign="top" width="71" colspan="1">
                            <p align="center"></p>
                           
                        </td>
                          <td valign="top" width="71" colspan="1">
                           <p align="center"></p>
                           
                        </td>
                         <td valign="top" width="71" colspan="1">
                        <p align="right"></p>
                      
                        </td>
                         <td valign="top" width="71" colspan="2">
                        <p align="right"><b><?php if($grand_amount!=''){ echo $payamt=array_sum($grand_amount);}?> </b></p>
                      
                        </td>
                        
                  </tr>
                    <tr height="">
                       
                        
                       
                       
                        <td  colspan="16" valign="top" >
                           <p class="pull-right"><b>Amount Chargeable (in words):</b><?= $this->advance->pay_number($payamt);?></p>
                         
                           
                          
                        </td>
                        
                    </tr>
                     <tr height="">
                       
                        
                       
                      
                        <td  colspan="11" valign="top" >
                           <b style="padding-left:10px">Company's Bank Details</b><br>
                          <span style="padding-left:10px">Bank Name:<?php echo $this->conn->company_info('bill_company_bank_name');?> </span><br>
                          <span style="padding-left:10px">A/c No.:<?php echo $this->conn->company_info('bill_company_bank_account');?></span><br>
                           <span style="padding-left:10px">Branch & IFS Code:<?php echo $this->conn->company_info('bill_company_bank_ifsc');?></span><br>
                            <span style="padding-left:10px">Company's PAN :<?php echo $this->conn->company_info('bill_company_pan');?> </span>
                          
                        </td>
                        <td  colspan="5" valign="top">
                         
                          <span style="padding-left:10px">Total Payment Due:<?php echo $this->conn->company_info('currency');?> 0.00 </span><br>
                          <span style="padding-left:10px">Less:- Received:<?php echo $this->conn->company_info('currency');?> 0.00 </span><br>
                           <span style="padding-left:10px">Balance Payable/Refund:<?php echo $this->conn->company_info('currency');?> 0.00 </span>
                           
                          
                        </td>
                    </tr>
                    <tr >
                       
                        <td  colspan="12" valign="top" >
                           <b style="padding-left:10px">Terms & Conditions</b><br>
                          <span style="">  a) We declare that this invoice shows the actual contents of the goods delivered.</span><br>
                          <span style="">  b) All the disputes arise are subject to Zirakpur Jurisdiction Only.</span><br>
                           <span style="">  c) Exchange, Redemption shall be after considering the product towards weight, damage etc. subject to current maket price of gold.</span><br>
                           <span style="">  d) No return is allowed except faciltiy of life time exchange is available.</span>
                          
                        </td>
                        
                        <td colspan="3" valign="top" >
                            
                              <small><b>Receiver's Signature :</b></small><b><br><br>
                              <h6 style="" class="pull-right">For <?php echo $this->conn->company_info('bill_company_name');?></h6><br><br><br>
                              <h6 class="pull-right">Authorised Signatory</h6>
                        </td>
                    </tr>
                    
    </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

<script>

////////////////div print function /////////////////////////
//////////btn onclick  call this function ////////

function printDiv(){

  var divToPrint=document.getElementById('DivIdToPrint'); ////////////  <- div id /////////////

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
  ///////////////////////// end function //////////
</script>