<style>
   table {
     border-collapse: collapse;
     width: 100%;
   }

   td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    white-space: nowrap;
}


   .table_api{
       overflow-X:auto;
   }

</style>

 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> API</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">Home</a></li>            
            <li class="breadcrumb-item"><a href="#">Api</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> API</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> API</h6>
<hr>
 <?php
$api_rest=$this->crypto->api_detail('e7c8045bd5373dfe39d37b69e8182e22');
//print_R($api_rest);

 ?>
<div class="row pt-2 pb-2">
   <div class="col-md-6">
      <div class="table_api">
         <table>
            
            <tr>
                <th>Network</th>
                <td><?= $api_rest['network'];?></td>
            </tr>
            <tr>
               <th>Account Id</td>
               <td><?= $api_rest['account_id'];?> </td>
            </tr>
             <tr>
               <th>Payout Wallet</td>
               <td><?= $api_rest['payout_wallet'];?></td>
            </tr>
            <tr>
               <th>Receiving Wallet</td>
               <td><?= $api_rest['receiving_wallet'];?></td>
            </tr>
            <tr>
               <th>Fee Wallet</td>
               <td><?= $api_rest['fee_wallet'];?></td>
            </tr>
             <tr>
               <th>Coin Balance</td>
               <td><?= $api_rest['coin_balance'];?></td>
            </tr>
             <tr>
               <th>Token Balance</td>
               <td><?= $api_rest['token_balance'];?></td>
            </tr>
         </table>
      </div>
   </div>
</div>