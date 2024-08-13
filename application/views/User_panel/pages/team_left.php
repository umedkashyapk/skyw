<style>
   


.user_form_row_data{
align-items: center;
}
    
    
</style>

<?php

             $likecondition=($this->session->userdata($search_string) ? $this->session->userdata($search_string):array());
             
             ?>

<div class="user_content">
    <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item"><a href="#">Team /</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Left Team</li>
         </ol>
	   </div>
	 
</div>
       
       <div class="user_main_card mb-3">
           
            <div class="user_card_body">
                 <h5 class="user_card_title_group"><i class="fa fa-filter"></i>Filter</h5>
                 <form action="<?= $panel_path.'team/team-left'?>" method="post">
                 <div class="user_form_row">
                     <div class="row">
                     <div class="col-12 mb-2">
                         <div class="data_detail_page_group">
                         <div class="detail_input_group">
                           <div class="input-group ">
                               <input type="text" Placeholder="Enter Name" name="<?= $search_string;?>[name]" class="input_user_panel" value='<?= (array_key_exists("name", $likecondition) ? $likecondition['name']:'');?>'>                       
                           </div>
                        </div>
                  
                    <div class="detail_input_group">
                      <div class="input-group ">
                              <input type="text" Placeholder="Enter Username" name="<?= $search_string;?>[username]" class="input_user_panel" value='<?= (array_key_exists("username", $likecondition) ? $likecondition['username']:'');?>'>                       
                           </div>
                          
                     </div>
                  
                   
                
                 <div class="user_form_row_data">
                   <div class="user_submit_button ">
                      
                       <input type="submit" name="submit" value="Filter" id="" class="user_btn_button">
                   </div>
                   <div class="user_submit_button">
                      <!-- <input type="submit" name="" value="Reset" id="" class="user_btn_button">-->
                       <a href="<?= $panel_path.'team/team-left'?>" class="user_btn_button" > Reset </a>
                       
                   </div>
                   </div>
               </div>
           </div>
            </div>
           </form>
            </div>
       </div>
       </div>
        <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
            
                <div class="user_card_body">
                   <div class="user_table_data">
                       <table class="user_table_info_record">
                            <tbody>
                               <tr>
                                <th>S No.</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>                
                                <th>Join Date</th>
                                <th>Active Status</th>
                            </tr>
                              <tbody>
                            <?php
                        if($table_data){
                            foreach($table_data as $t_data){
                                $sr_no++;
                            ?>
                            <tr>
                                <td><?= $sr_no;?></td>
                                <td><?= $t_data['name'];?></td>
                                <td><?= $t_data['username'];?></td>
                                <td><?= $t_data['email'];?></td>                               
                                <td><?= $t_data['added_on'];?></td>               
                                <td><?php
                                if($t_data['active_status']==1){
                                    echo "Active<br>";
                                    echo $t_data['active_date'];
                                }else{
                                    echo "Inactive";
                                }
                                ?></td>               
                            </tr>
                            <?php
                            }
                        }
                            ?>
                            
                        </tbody>
                       </table>
                        
                   </div> 
               </div> 
                 <?php 
    
                echo $this->pagination->create_links();?>
            
       </div>
    </div>



</div>
</div>
<br>
<br>
