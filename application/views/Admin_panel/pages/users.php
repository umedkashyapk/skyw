<?php
 $ttl_records=$this->conn->runQuery('COUNT(id) as total','users','1=1')[0]->total;
//echo date('2021-09-30 00:00:00');
?>


<div class="row pt-3 bg-default">
        <div class="col-sm-10">
		  <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">users</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> All Users</li>
         </ol>
	   </div>
	   <div class="col-sm-2">
       
     </div>
</div>
 
 
<?php
    /*if($this->session->has_userdata($search_parameter)){
    	$get_data=$this->session->userdata($search_parameter);
    	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
    	 
    }else{
    	$likecondition=array();
    }*/
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card card-body">
            
               <form action="<?= $admin_path.'users';?>" method="request">
                     <div class="form-inline1">
                                             
                            <input type="text" Placeholder="Enter Name" name="name" class=" " value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />
                            <input type="text" Placeholder="Enter Username" name="username" class=" " value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />
                            <input type="text" Placeholder="Enter Email" name="email" class=" " value='<?= isset($_REQUEST['email']) && $_REQUEST['email']!='' ? $_REQUEST['email']:'';?>'>
                            <input type="text" Placeholder="Enter Sponsor" name="sponsor" class=" " value='<?= isset($_REQUEST['sponsor']) && $_REQUEST['sponsor']!='' ? $_REQUEST['sponsor']:'';?>'>
                            <input type="text" Placeholder="Enter Mobile" name="mobile" class=" " value='<?= isset($_REQUEST['mobile']) && $_REQUEST['mobile']!='' ? $_REQUEST['mobile']:'';?>'>
                            <select class=" " name="active_status" id="">
                                <option value="">Select Status</option>
                                <option value='1' <?= isset($_REQUEST['active_status']) && $_REQUEST['active_status']=='1' ? 'selected':'';?> >Active</option>
                                <option value='0' <?= isset($_REQUEST['active_status']) && $_REQUEST['active_status']=='0' ? 'selected':'';?> >Inactive</option>
                            </select>
                               <select class=" " name="block_status" id="">
                                <option value="">User Status</option>
                                <option value='1' <?= isset($_REQUEST['block_status']) && $_REQUEST['block_status']=='1' ? 'selected':'';?> >Block</option>
                                <option value='0' <?= isset($_REQUEST['block_status']) && $_REQUEST['block_status']=='0' ? 'selected':'';?> >Unblock</option>
                            </select>
                             
                                <select class="form-control" name="selected_color" id="selected_color"  >
                                <option value="">Select Colour</option>
                                  <option  value="green" <?= isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']=='green' ? 'selected':'';?> >Green </option>
                                  <option  value="pink" <?= isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']=='pink' ? 'selected':'';?>>Pink </option>
                                  <option  value="yellow" <?= isset($_REQUEST['selected_color']) && $_REQUEST['selected_color']=='yellow' ? 'selected':'';?>>Yellow </option>
                                  
                                </select>
                       
                             <select name="limit">
                                 <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                                 <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                                 <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                                 <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                                 <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                             </select>
                          
                        <!-- <?php
                             $ttl_pages=ceil($total_rows/$limit);
                             if($ttl_pages>1){  
                            ?>
                            <div class="form-group m-1 ">                      
                                <input type="text" list="pages" class="form-control" name="page" value="<?= (isset($_REQUEST['page']) ? $_REQUEST['page']:'1');?>" /> 
                                 <datalist id="pages">
                                     <?php
                                         for($pg=1;$pg<=$ttl_pages;$pg++){
                                             ?><option value="<?= $pg;?>" ><?= $pg;?></option><?php
                                         }
                                     ?>
                                </datalist>
                            </div>
                         <?php 
                         } ?>-->
                         <input type="submit" name="submit" class="  " value="filter" />
                       <button> <a href="<?= $admin_path.'users';?>" class="">Reset</a></button>&nbsp;
                         <input type="submit" name="export_to_excel" class=" " value="Export to excel" />
                    </div>
                </form>
            </div>
         
        
    <!-- <h3><button class="btn btn-primary">Total Records:
                  <?php echo $this->conn->runQuery('COUNT(id) as total','users','1=1')[0]->total;?>
              </button>
         </h3>  -->  
      
       
 
    <div class="card ">
    <div class="card-header text-right">| All Users:(<?= $ttl_records?>)</div>
        <div class="table-responsive">
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Action</th>
                        <th>Colour</th>
                        <th>Name</th>
                        <th>Username</th>
                        <!--<th>Address</th>-->
                        <th>Email</th>
                        <th>Mobile</th>
                      	<th>AI Subsciption</th>
                        <th>Subsciption</th>
                        <th>My Package</th>
                        <th>My Rank</th>
                        <th>Join Date</th>
                        <th>Active Status</th>
                        <th>Block Status</th>
                        <th>Sponsor</th>
                       <?php if($this->conn->plan_setting('reg_type')==1){?>
                        <th>Upline</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $page='';
                    if(isset($_REQUEST['page'])){
                        $page='&page='.$_REQUEST['page'];
                    }
                    if($table_data){            
                    foreach($table_data as $t_data){
                        $sr_no++;
                         // echo $t_data->id;
                        // $sub_pkg=$this->business->package_repurchase($t_data['id']); 
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                        <td><a class="btn btn-warning btn-sm" href="<?= $admin_path.'users/edit?id='.$t_data['id'].$page;?>"><i class="fa fa-edit"></i> </a>
                          <!--<a class="btn btn-info btn-sm" href="<?= 'https://dp3.mlmreadymade.com/admin_login?ref ='.$t_data['username'];?>" target="_blank">Login </a> -->
                         <a class="btn btn-info btn-sm" href="<?= $admin_path.'payment/add-account?user_id='.$t_data['id'].$page;?>" target="_blank">Edit Account </a>
                    </td>
                         <td><?php
                         
                        if($t_data['selected_color']=='pink'){
                            echo'<i class="fa fa-circle btn-sm" style="color:#FF10F0;" aria-hidden="true"></i>';
                            echo "Pink";
                            
                        }elseif($t_data['selected_color']=='yellow'){
                          echo'<i class="fa fa-circle btn-sm" style="color:#FFC300;" aria-hidden="true"></i>';
                            echo "Yellow";  
                        }elseif($t_data['selected_color']=='green'){
                          echo'<i class="fa fa-circle btn-sm" style="color:#006400;" aria-hidden="true"></i>';
                            echo "Green";  
                        }
                        ?>
                        </td> 
                        <td><?= $t_data['name'];?></td>
                        <td>
                          <?php
                        
                        if($t_data['active_status']==1){
                            echo'<i class="fa fa-circle btn-sm" style="color:green;" aria-hidden="true"></i>';
                        }else{
                            echo'<i class="fa fa-circle btn-sm" style="color:red;" aria-hidden="true"></i>';
                        }
                        ?><?= $t_data['username'];?></td>
                       <!-------------------------------------------- --> 
                       
                       
                       <!-------------------------------------------- -->
                         
                        <!--<td><?= $t_data['mobile'];?></td>-->
                        <td><?= $t_data['email'];?></td>
                        <td><?= $t_data['mobile'];?></td>  
                      
                      
                      
                      
                      
                      <!-- efjfjbwefkjwek.jf-->
                      	<td>
                      <?=$this->business->AI_package($t_data['id']);
                        
                      
                      
                     
                      
                      
                      
                        ?></td>
                      	<td>
                          
                     
                      </td>
                      	
                      
                      
                        <td><?= $t_data['my_package'];?></td> 
                        <td><?= $t_data['my_rank'];?></td> 
                        <td><?= $t_data['added_on'];?></td>               
                      <td><?php
                        if($t_data['active_status']==1){
                            echo "Active<br>";
                            echo $t_data['active_date'];
                        }else{
                            echo "Inactive";
                        }
                        ?></td> 
                         <td><?php
                        if($t_data['block_status']==1){
                            echo "Block<br>";
                            
                        }else{
                            echo "Unblock";
                        }
                        ?></td>
                        <td>
                            <?php
                            $sponsor_info=$this->profile->sponsor_info($t_data['id'],'username,name');
                                if($sponsor_info){
                                    echo "$sponsor_info->username ($sponsor_info->name)";
                                }
                            ?>
                        </td>
                        <?php if($this->conn->plan_setting('reg_type')==1){?>
                          <td>
                            <?php
                         
                            $parent_info=$this->profile->parent_info($t_data['id'],'username,name');
                                if($parent_info){
                                    echo "$parent_info->username ($parent_info->name)";
                                }
                            ?>
                        </td>
                        <?php } ?>
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
         $ttl_pages=ceil($total_rows/$limit);
         if($ttl_pages>1){
             ?>
              <form action="" method="get">
                <div class="form-group">
                    
                    Go to Page : 
                    <input type="text" list="pages" name="page" value="<?= (isset($_REQUEST['page']) ? $_REQUEST['page']:'');?>" />
                    
                    <datalist id="pages">
                         <?php
                             for($pg=1;$pg<=$ttl_pages;$pg++){
                                 ?><option value="<?= $pg;?>" ><?= $pg;?></option><?php
                             }
                         ?>
                    </datalist>
                    <input type="submit" name="submit" class=" " value="Go" />
                </div>
            </form>
             <?php
         }
        ?>

    <?php 
    echo $this->pagination->create_links();?>
    </div>
</div>
