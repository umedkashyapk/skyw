<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">User Wallet</a></li>  |          
            <li class="breadcrumb-item active" aria-current="page">User Wallet</li>
         </ol>
	   </div>
	  
</div>

<?php
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
	 
}else{
	$likecondition=array();
}
 ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
            
                <div class="user_card_body">
                   <div class="user_table_data">
                   <?php
                    $crypto = $this->curl->simple_get("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=20&page=1&sparkline=false%22"); 
                      $pri=json_decode($crypto,true);
                      print_R($crypto);
                      die();
                      for($i=0;$i<=20;$i++){
                        echo  $pri[$i]['current_price'];
                        echo  $pri[$i]['name'];
                          
                      } 
                     ?>
                     
                      
                        
                   </div> 
               </div> 
            
       </div>
    </div>
 
    
   
    
    
</div>
</div>
</div>