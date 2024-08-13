<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Rank Bonaza</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Rank Bonaza</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  ALL</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>


<?php
        $success['param']='success';
        $success['alert_class']='alert-success';
        $success['type']='success';
        $this->show->show_alert($success);

       
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        
        <form action="<?= $admin_path.'users/rank_bonaza';?>" method="get">
             <div class="form-inline">
                <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Tx User" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 
                     <div class="form-group m-1">
                 <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                  </div>
                 
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                <!--<input type="submit" name="reset" class="btn btn-sm" value="Reset" />-->
                 <a href="<?= $admin_path.'users/rank_bonaza';?>" class="btn btn-sm">Reset</a>
                  
            </div>
        </form>
       
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S No.</th>
                        
                        <th>USERID(NAME)</th>
                        <th>Rank</th>
                        <th>Passport Size Image</th>
                        <th>Front Image</th>
                        <th>Back Image</th>
                        <th>Complete Date</th>
                    </tr>
                </thead>
                <tbody>
                     <?php

                if($table_data){
                    
                    foreach($table_data as $t_data){   
                        $sr_no++;
                        
                        
                       if($t_data['u_code']!=''){
                           $profile=$this->profile->profile_info($t_data['u_code'],'name,username');
                       }
                       
                       
                       
                       
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                                             
                        <td><?= $profile ? $profile->username .'('.$profile->name.')':'';?></td>                                
                                                    
                           
                                              
                        <td><?= $t_data['rank'];?></td> 
                         <?php
                         if($t_data['pro_img']!=''){
                          ?>
                         <td><a href="<?= $t_data['pro_img'];?>" target="_blank"> <img src="<?= $t_data['pro_img'];?>" style="width:50px; height:50px;"></a></td>  
                         <?php
                         }else{
                         ?>
                          <td></td> 
                          <?php
                         }
                          ?>
                           <?php
                         if($t_data['front_img']!=''){
                          ?>
                         <td><a href="<?= $t_data['front_img'];?>" target="_blank"> <img src="<?= $t_data['front_img'];?>" style="width:50px; height:50px;"></a></td>  
                         <?php
                         }else{
                         ?>
                          <td></td> 
                          <?php
                         }
                          ?>
                          
                         <?php
                         if($t_data['back_img']!=''){
                          ?>
                         <td><a href="<?= $t_data['back_img'];?>" target="_blank"> <img src="<?= $t_data['back_img'];?>" style="width:50px; height:50px;"></a></td>  
                         <?php
                         }else{
                         ?>
                          <td></td> 
                          <?php
                         }
                          ?>
                          
                          
                        <td><?= $t_data['added_on'];?></td> 
                                   
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
