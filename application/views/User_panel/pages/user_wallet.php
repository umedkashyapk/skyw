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
        
        
       <!-- <div class="user_main_card mb-3">-->
           
       <!--     <div class="user_card_body">-->
       <!--          <h5 class="user_card_title_group"><i class="fa fa-filter"></i>Filter</h5>-->
       <!--          <form action="" method="get">-->
       <!--          <div class="user_form_row">-->
       <!--              <div class="row">-->
       <!--              <div class="col-12 mb-2">-->
       <!--                  <div class="data_detail_page_group">-->
       <!--                  <div class="detail_input_group">-->
       <!--                    <div class="input-group ">-->
       <!--                        <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">-->
       <!--                    </div>-->
       <!--                 </div>-->
                  
       <!--             <div class="detail_input_group">-->
       <!--               <div class="input-group ">-->
       <!--                        <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">-->
       <!--                    </div>-->
                          
       <!--              </div>-->
                     <!--<div class="detail_input_group">-->
                     <!--   <div class="input-group ">-->
                     <!--          <input name="start_date" type="date" id="" class="form-control user_input_text" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>" placeholder="From Registration Date">-->
                              
                     <!--      </div>-->
                     <!--</div>-->
                     <!--<div class="detail_input_group">-->
                     <!--   <div class="input-group ">-->
                     <!--          <input name="end_date" type="date" id="end_date" class="form-control user_input_text" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" placeholder="To Registration Date">-->
                               
                     <!--      </div>-->
                           
                     <!--</div>-->
       <!--              <div class="detail_input_group">-->
       <!--                 <select name="limit" id="" class="form-control user_input_select">-->
       <!--                    <option selected="selected" value="0">--ALL--</option>-->
       <!--                    <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>-->
       <!--                   <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>-->
       <!--                   <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>-->
       <!--                   <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>-->
       <!--                </select>-->
       <!--              </div>-->
                    
                
       <!--          <div class="user_form_row_data">-->
       <!--            <div class="user_submit_button ">-->
                      
       <!--                <input type="submit" name="submit" value="Filter" id="" class="user_btn_button">-->
       <!--            </div>-->
       <!--            <div class="user_submit_button">-->
                      <!-- <input type="submit" name="" value="Reset" id="" class="user_btn_button">-->
       <!--                <a href="<?= $panel_path.'fund/transfer-history'?>" class="user_btn_button" > Reset </a>-->
                       
       <!--            </div>-->
       <!--            </div>-->
       <!--        </div>-->
       <!--    </div>-->
       <!--     </div>-->
       <!--    </form>-->
       <!--     </div>-->
       <!--</div>-->
       <!--</div>-->
        <br>

   <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
            
                <div class="user_card_body">
                   <div class="user_table_data">
                      <table class="table table-hover">
        <thead>
             <tr>
                      <th>Sr No.</th>
                      <th>Username</th>
                      <th>Full Name</th>
                      <th>Main Wallet</th>
                      <th>Fund Wallet</th>
                     <!-- <th>Shopping Wallet</th>
                  -->
                     <!-- <th>Active Date</th>-->
                     
                    </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
           
            foreach($table_data as $t_data){   
               
                $sr_no++;            
                    $tx_profile=$this->profile->profile_info($t_data['u_code']);
                 

            ?>
              <tr>
              <td><?= $sr_no;?></td>
              <td><?= $tx_profile->username;?></td>
              <td><?= $tx_profile->name;?></td>
              <td><?= round($t_data['c1'],2);?></td>
            <td><?= round($t_data['c2'],2);?></td>
              <!--     <td><?= round($t_data['c36'],2);?></td>-->
             <!-- <td><?= $tx_profile->active_date;?></td>-->
             
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
 
    
    <?php 
    
    echo $this->pagination->create_links();?>
    
    
</div>
</div>
</div>