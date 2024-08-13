
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
            <li class="breadcrumb-item"><a href="">Home</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Gambit Development Bonus</li>
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
                     <th>Direct</th>
                     <th>Income Monthly(<?= $this->conn->company_info('currency');?>)</th>
                     <th>Condition</th>
                     <th>Status</th>
                  </tr>
               </tbody>
               <tbody>
               <?php
                $all_team=array();
                $userid=$this->session->userdata('user_id');
                $profile=$this->session->userdata("profile");
                $my_rank_id=$profile->development_rank_id;
                $arr = $this->conn->runQuery("*",'plan',"1='1'");
                if($arr){
                  for($i=0;$i<5;$i++){
                     $p=$i+1;
                     $gambit_rank_id=$arr[$i]->id;
                     $gambit_direct=$arr[$i]->gambit_direct;
                     $gambit_income=$arr[$i]->gambit_income;
                     $rank=$arr[$i]->gambit_rank;
                     $gambit_reward=$arr[$i]->gambit_reward;
                     
                     $goalstatus=($my_rank_id>=$gambit_rank_id  ? 'Achieved':'Pending');
                 
               ?> 
                  <tr>
                  <td><?= $rank;?></td>
                  <td><?= $gambit_direct;?></td>
                  <td><?= $gambit_income;?></td>
                  <td><?= $gambit_reward;?></td>
                  <td><?= $goalstatus;?></td>
                 </tr>
                <?php } }?>
               </tbody>
            </div>
         </div>
      </div>
   </div>
</div>