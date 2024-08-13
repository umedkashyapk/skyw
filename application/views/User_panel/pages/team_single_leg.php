<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>/            
            <li class="breadcrumb-item"><a href="#">Team</a></li>/            
            <li class="breadcrumb-item active" aria-current="page"> Single Leg Team</li>
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
 <div class="card card-body card-bg-1">
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="user_main_card mb-3">
           
            <div class="user_card_body">
                 <h5 class="user_card_title filter_title"><i class="fa fa-filter"></i>Filter</h5>
                 <form action="<?= $panel_path.'team/team-single-leg'?>" method="get">
                 <div class="user_form_row">
                     <div class="row">
                     <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
                         
                           <div class="input-group ">
                               <input name="name" type="text" id="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' class="form-control user_input_text" placeholder="Search by Name">
                           </div>
                        
                     </div>
                     <div class="col-lg-3 col-sm-6 col-md-4 mb-2">
                      <div class="input-group ">
                               <input name="username" type="text" id="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' class="form-control user_input_text" placeholder="Search by User ID">
                           </div>
                          
                     </div>
                     </div>
                 <div class="user_form_row_data">
                   <div class="user_submit_button mb-2">
                      
                       <input type="submit" name="submit" value="Filter" id="" class="user_btn_button">
                   </div>
                   <div class="user_submit_button mb-2">
                     
                       <a href="<?= $panel_path.'team/team-single-leg'?>" class="user_btn_button" > Reset </a>
                       
                   </div>
               </div>
           </div>
           </form>
            </div>
       </div>

<div class="user_table_data">
    <table class="user_table_info_record">
        <thead>
            <tr>
                
                <th>S No.</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>                
                <th>Join Date</th>
                <th>Active Status</th>
            </tr>
        </thead>
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


    <?php 
    
    echo $this->pagination->create_links();?>
    </div>
</div>
</div>
</div>