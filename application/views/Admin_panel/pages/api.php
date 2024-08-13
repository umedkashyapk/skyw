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
  $api_key="325b5081c7d3317d1c7b6fe744a91a61";//$this->conn->company_info('api_key');
        $api_key_trc="7f0b9bbfe097f95261ca4c32c3f01708";//$this->conn->company_info('api_key');
 //$api_key=$this->conn->company_info('api_key');
//$api_rest=$this->crypto->api_detail($api_key_trc);
//print_R($api_rest);
 $url = "https://test.eracom.in/sendcryp/";
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    
                    $headers = [
                      "Content-Type: application/x-www-form-urlencoded"
                    ];
                    
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    
                    $data = http_build_query([
                     "api_key" => $api_key,
		  "action" => "vendor_info",
                    ]);
                    
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    
                    $api_rest = json_decode(curl_exec($curl), true);
                    curl_close($curl);
                    
                    
                    
                    
                    // print_R($api_rest);
                    // die();
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
   <?php
   
    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    
                    $headers = [
                      "Content-Type: application/x-www-form-urlencoded"
                    ];
                    
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                    
                    $data = http_build_query([
                     "api_key" => $api_key_trc,
		  "action" => "vendor_info",
                    ]);
                    
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    
                    $api_rest1 = json_decode(curl_exec($curl), true);
                    curl_close($curl);
   
   ?>
   <div class="col-md-6">
      <div class="table_api">
         <table>
           
            <tr>
                <th>Network</th>
                <td><?= $api_rest1['network'];?></td>
            </tr>
            <tr>
               <th>Account Id</td>
               <td><?= $api_rest1['account_id'];?> </td>
            </tr>
             <tr>
               <th>Payout Wallet</td>
               <td><?= $api_rest1['payout_wallet'];?></td>
            </tr>
            <tr>
               <th>Receiving Wallet</td>
               <td><?= $api_rest1['receiving_wallet'];?></td>
            </tr>
            <tr>
               <th>Fee Wallet</td>
               <td><?= $api_rest1['fee_wallet'];?></td>
            </tr>
             <tr>
               <th>Coin Balance</td>
               <td><?= $api_rest1['coin_balance'];?></td>
            </tr>
             <tr>
               <th>Token Balance</td>
               <td><?= $api_rest1['token_balance'];?></td>
            </tr>
         </table>
      </div>
   </div>
   
</div>