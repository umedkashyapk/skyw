<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>

.bg-white {
    background-color: #010101!important;
    padding: 10px;
}
            @media only screen and (max-width: 600px) {
                .flex > .flex-item{
                         width : var(--item-width);
                         font-size:8px;
                     } 
                     .flex-item > span > .user {
                            width:25px;        
                        }
            }
            @media only screen and (min-width: 601px) {
                .flex >  .flex-item{
                         width : var(--item-width);
                         font-size:16px;
                     } 
                .flex-item > span > .user {
                    width:50px;        
                }  
            }

            .flex{
                    display: flex;
                    flex-wrap: nowrap;                
                                 
                }
                
           select#select_pool {
    height: 35px !important;
}
form.form-inline {
    align-items: baseline;
}
       </style>
    <div class="container pages">   
    <br>
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="">Team</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Pool Matrix</li>
         </ol>
	   </div>
	    
</div>
 
 <?php 
$userid = $this->session->userdata('user_id');


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
                    ?>
                   
           <center>
               <div class="bg-white">    
            <div class="form-inline1 col-xl-12">  
               <!--navbar-light bg-light-->
                <nav class="navbar navbar-expand-lg navbar-light bg-white">

                
                <form action=""  class="form-inline" method="post" >
           
		  <div class="form-group">
		
			<select name="select_pool" class="form-control" id="select_pool" >
			 <option value="1" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='1' ? "selected":0);?>>Star</option>	
				<option value="2" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='2' ? "selected":0);?>>Sr. Star</option>			 
				<option value="3" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='3' ? "selected":0);?>>Silver</option>			 
				<option value="4" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='4' ? "selected":0);?>>Gold</option>			 
				<option value="5" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='5' ? "selected":0);?>>Emerald</option>	
				<option value="6" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='6' ? "selected":0);?>>Ruby</option>	
				<option value="7" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='7' ? "selected":0);?>>Diamond</option>	
			
			
			</select>
		  </div>		  
		  <button type="submit" name="submit1" class="btn btn-default">Submit</button>
		
	</form>
	<?php
	 if($this->session->has_userdata('user_selected_pool')){
					$user_selected_pool=$this->session->userdata('user_selected_pool');
				}else{
					$user_selected_pool=1;	
				}
		?>		
                
              
 
                </nav>
                
            <div class="card card-body card-bg-1">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
<div class="table-responsive">
    <table class="<?= $this->conn->setting('table_classes'); ?>">
        <thead>
            <tr>
                <th>Level</th>
                <th>Income </th>
                <th>Time</th>              
                       
                <th>Status</th>                
                
                 
            </tr>
            <?php
            $profile=$this->session->userdata("profile"); 
            $user_id=$this->session->userdata("user_id"); 
            $my_plan=$this->conn->runQuery('*','plan',"1=1");
            if($my_plan){
                $sno=0;
                for($i=0;$i<10;$i++){
                    $lvl=$i+1;
                    $nxt_lvl=$lvl+1;
                    $my_rank=$my_plan[$i]->package_name;
                    $nxt_rank=$my_plan[$lvl]->package_name;
                    if($user_selected_pool==1){
                        $pool_typ="pool1";
                        $payble=$my_plan[$i]->pool1_income;
                        $pool_days=$my_plan[$i]->pool1_days;
                        $pool_amts=200;
                        $rank_royalty_type="pool1";
                        $wlt="autopool1_wallet";
                    }elseif($user_selected_pool==2){
                        $pool_amts=400;
                        $pool_typ="pool2";
                        $payble=$my_plan[$i]->pool2_income;
                        $pool_days=$my_plan[$i]->pool2_days;
                        $rank_royalty_type="pool2";
                         $wlt="autopool2_wallet";
                    }elseif($user_selected_pool==3){
                        $pool_amts=800;
                        $pool_typ="pool3";
                        $payble=$my_plan[$i]->pool3_income;
                        $pool_days=$my_plan[$i]->pool3_days;
                        $rank_royalty_type="pool3";
                        $wlt="autopool3_wallet";
                    }elseif($user_selected_pool==4){
                        $pool_amts=1600;
                        $pool_typ="pool4";
                        $payble=$my_plan[$i]->pool4_income;
                        $pool_days=$my_plan[$i]->pool4_days;
                        $rank_royalty_type="pool4";
                        $wlt="autopool4_wallet";
                    }elseif($user_selected_pool==5){
                        $pool_amts=3200;
                        $pool_typ="pool5";
                        $payble=$my_plan[$i]->pool5_income;
                        $pool_days=$my_plan[$i]->pool5_days;
                        $rank_royalty_type="pool5";
                        $wlt="autopool5_wallet";
                    }elseif($user_selected_pool==6){
                        $pool_amts=6400;
                        $pool_typ="pool6";
                        $payble=$my_plan[$i]->pool6_income;
                        $pool_days=$my_plan[$i]->pool6_days;
                        $rank_royalty_type="pool6";
                        $wlt="autopool6_wallet";
                    }elseif($user_selected_pool==7){
                        $pool_amts=12800;
                        $pool_typ="pool7";
                        $payble=$my_plan[$i]->pool7_income;
                        $pool_days=$my_plan[$i]->pool7_days;
                        $rank_royalty_type="pool7";
                        $wlt="autopool7_wallet";
                    }
                    
                    $goalstatus="Pending";
                    $check_user_details=$this->conn->runQuery('*','rank',"u_code='$user_id' and is_complete='1' and rank='$my_rank' and rank_type='$rank_royalty_type'");
                    if($check_user_details){
                        $join_date=$check_user_details[0]->added_on;
                        $effectiveDate = date('Y-m-d  H:i:s', strtotime("+$pool_days day", strtotime($join_date)));
                        
                      	$timestamp = strtotime($effectiveDate);
                        $pre_dy=$days= date('d', $timestamp);
                       
                        $tdy=date('d');
   
                	    $current_days=date("Y-m-d");
                	    $from= date("Y-m-d", strtotime($effectiveDate));
                        $dStart = new DateTime($from);
                        $dEnd  = new DateTime($current_days);
                        $dDiff = $dStart->diff($dEnd);
                         $ttl_dt_diff=$dDiff->format('%r%a');
                       // die();
                        if($ttl_dt_diff>=0){
                            
                            $goalstatus="Achieved";
                            
                            
                            $check_rank_detail=$this->conn->runQuery('*','rank',"u_code='$user_id' and rank='$nxt_rank' and rank_id='$nxt_lvl' and rank_type='$rank_royalty_type'");
                            if(!$check_rank_detail){
                                $income1=array();
                                $income1['u_code']=$user_id;
                                $income1['rank']=$nxt_rank;
                                $income1['rank_id']=$nxt_lvl;
                                $income1['rank_type']=$rank_royalty_type;
                                $income1['added_on']=date('Y-m-d H:i:s');
                                $income1['is_complete']=1;
                                $this->db->insert('rank',$income1);
                            }    
                                
                            //////////////////////////////////////////////////////////////////////////
                            $check_user_detail=$this->conn->runQuery('*','transaction',"u_code='$user_id' and txs_res='$lvl' and rank='$my_rank' and tx_record='$pool_typ'");
                            if(!$check_user_detail){
                            
                                $source='autopool';
                                $income=array();
                              
                                $income['u_code']=$user_id;
                                $income['tx_type']='income';
                                $income['source']=$source;
                                $income['debit_credit']='credit';
                                $income['amount']=$payble;
                                $income['date']=date('Y-m-d H:i:s');
                                $income['status']=1;
                                $income['tx_record']=$pool_typ;
                                $income['txs_res']=$lvl;
                                $income['rank']=$my_rank;
                                $income['remark']="Receive $source income of amount $payble from $pool_typ level $lvl";
                                $this->db->insert('transaction',$income);
                                $income_lvl=$income['amount'];
                                $this->update_ob->add_amnt($user_id,$source,$income_lvl);
                                $this->update_ob->add_amnt($user_id,$wlt,$income_lvl);
                                
                                
                                
                                
                                
                            }    
                        ////////////////////////////////////////////////////////////////////////////////////
                            
                        }else{
                            $check_user_detail=$this->conn->runQuery('*','transaction',"u_code='$user_id' and txs_res='$lvl' and rank='$my_rank' and tx_record='$pool_typ'");
                            if($check_user_detail){
                                $goalstatus="Achieved";
                            }    
                            
                        }
                    }else{
                        
                        $rank_royalty_type=$rank_royalty_type;
                        $my_rank=$my_rank;
                        $check_orders_detail=$this->conn->runQuery('*','orders',"u_code='$user_id' and order_amount='$pool_amts'");
                        //echo $this->db->last_query();
                        //die();
                        if($check_orders_detail){
                            $check_user_detailss=$this->conn->runQuery('*','rank',"u_code='$user_id' and is_complete='1' and rank_id='1' and rank_type='$rank_royalty_type' ");
                            //echo $this->db->last_query();
                            //die();
                            if(!$check_user_detailss){
                                $income1=array();
                                $income1['u_code']=$user_id;
                                $income1['rank']=$my_rank;
                                $income1['rank_id']=1;
                                $income1['rank_type']=$rank_royalty_type;
                                $income1['added_on']=date('Y-m-d H:i:s');
                                $income1['is_complete']=1;
                                $this->db->insert('rank',$income1);
                               
                            }
                        }
                        
                    }
                    
                     
                      
                    ?>
                    <tr>
                        <td>Level<?= $lvl?></td>
                        <td><?= $payble;?></td>
                        <td><?= $pool_days;?></td>
                       
                        <td><?= $goalstatus;?></td>
                       
                    </tr>
                 <?php }}?>  
        </thead>
        
    </table>
</div>
    
    </div>
</div>
</div>    
                
                
            </div>
             
  
   
        </center>
                

</div>
</div>

<br>
<br>