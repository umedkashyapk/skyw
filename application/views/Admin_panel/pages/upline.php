<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Upline</h4>
		    <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
                <li class="breadcrumb-item"><a href="#"> Upline</a></li> 
            </ol>
	   </div>
	    <div class="col-sm-3">
       
        </div>
</div>
<h6 class="text-uppercase"> Upline</h6>
<hr>
<?php

 $success['param']='success';
$success['alert_class']='alert-success';
$success['type']='success';
$this->show->show_alert($success);

$erroralert['param']='error';
$erroralert['alert_class']='alert-danger';
$erroralert['type']='error';
$this->show->show_alert($erroralert);
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
}else{
	$likecondition=array();
}   
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="<?= $admin_path.'upline';?>" method="get">
             <div class="form-inline">
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Tx User" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                       
                 </div>&nbsp;
                
                 
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                 <a href="<?=$admin_path.'upline';?>"class="btn btn-sm">Reset</a>
                 
               
            </div>
        </form>
<br>
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
       


<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                
                <th>Level</th>
				<th>Username</th>
				<th>Name</th>
				<th>Mobile</th>
                <th>Status </th>
                <th>Active Date </th>
                 
            </tr>
        </thead>
        <tbody>
            <?php

        if($data){
            
         
            
                foreach($data as $t_data){
             
                
                $sr_no++;            
                     
                  

            ?>
            <tr>
                <td><?= $sr_no;?></td>
				<td><?= $t_data['username']?></td>
				<td><?= $t_data['name']?></td>
				<td><?= $t_data['mobile']?></td>

                <td><span class="badge badge-warning badge-sm"><?= $t_data['active_status']==1 ? 'Active':'Inactive';?></span></td>                                
                <td><?= $t_data['active_date'];?></td>                                
                           
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
