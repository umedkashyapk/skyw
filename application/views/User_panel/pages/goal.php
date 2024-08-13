<style>
.goal_reward_tabel {
   
background: var(--first) !important;
   
    box-shadow: rgb(0 0 0 / 20%) 0px 5px 15px;
    border-radius: 8px;
    margin-bottom: 15px;
    padding: 16px;
    overflow: auto;
}

.goal_reward_tabel th {
   color: var(--text2);
    border: none;
}
    </style>

<div class="user_content">
    <div class="container">
        <div class="row">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home /</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Rank Income</li>
         </ol>
	   </div>
	    
</div>
      

<div class="goal_reward">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="goal_reward_tabel">
               <table class="user_table_info_record">
               <tbody>
                  <tr>
                     <th>Rank</th>
                     <th>Income(%)</th>
                     <th>Rank Income Condition</th>
                     <th>Current Month Community</th>
                     <th>Status</th>
                  </tr>
               </tbody>
               <tbody>
               <?php
                $first_date = date('Y-m-d H:i:s',strtotime('first day of last month'));
                $last_date = date('Y-m-d H:i:s',strtotime('last day of this month'));
               
                $source="reward";
                $all_team=array();
                $profile=$this->session->userdata("profile");
                $my_rank_id=$profile->rank_id;
                $user_id=$this->session->userdata("user_id");
                $userid=$this->session->userdata('user_id');
                $check_directs=$this->conn->runQuery('SUM(amount) as amts','transaction',"tx_type='income' and u_code='$userid' and date>='$first_date' and date<='$last_date'");  
                $total_income1=$check_directs[0]->amts;
                
                 $community_buss=$this->business->community_business($userid,$first_date,$last_date);
                    $total_community_inc=array_SUM($community_buss); 
                $arr = $this->conn->runQuery("*",'plan',"1='1'");
                if($arr){
                        for($i=0;$i<8;$i++){
                            $p=$i+1;
                           $rankid=$arr[$i]->id;
                            $rank=$arr[$i]->rank;
                            $rank_condition=$arr[$i]->rank_reward;
                            $incomess=$arr[$i]->rank_income;
                            $goalstatus=($my_rank_id>=$rankid  ? 'Achieved':'Pending');
                 
               ?> 
                  <tr>
                  <td><?= $rank;?></td>
                  <td><?= $incomess;?></td>
                  <td><?= $rank_condition;?></td>
                  <td><?= $total_community_inc+$total_income1;?></td>
                  <td><?php
                    if($goalstatus=='Achieved'){
                         echo"<span style='color:green';>Achieved</span>";
                    }else{
                         echo"<span style='color:red';>Pending</span>";
                    }
                  
                  ?></td>
                 </tr>
                <?php } }?>
               </tbody>
            </div>
         </div>
      </div>
   </div>
</div>