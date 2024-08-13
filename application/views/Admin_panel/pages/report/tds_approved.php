<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Approved Tds</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Approved Tds</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Approved Tds</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Approved Tds</h6>
<hr>
<?php 
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

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="<?= $admin_path.'report/approved';?>" method="post">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                  
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                <a href="<?= $admin_path.'report/approved';?>" class="btn btn-sm">Reset</a>
                 
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
       
<br>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Sr. No.</th>
			    <th>User id/full Name</th>
                <th>Total TDS</th>
                <th>Pan Card Number </th>
               
                </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
            
            foreach($table_data as $t_data){
              
                 $user_id=$t_data['u_code'];
                 $tx_profile=$this->profile->profile_info($t_data['u_code']);
                 $sr_no++;            
                
                 $get_amnt=$this->conn->runQuery('SUM(amount) as amnt','transaction',"tx_type='withdrawal' and tds_status='1'")[0]->amnt;
                 $ttl_amnt=$get_amnt!='' ? $get_amnt:0;
                 $tds_amnt=$ttl_amnt*5/100; 
                 $total += $ttl_amnt;
                 $total_tds += $tds_amnt;
                 $accounts=$this->conn->runQuery('*','user_accounts',"u_code='$user_id'");
                
                 $pan_number=$accounts[0]->pan_no;
            ?>
            <tr>
                <td><?= $sr_no;?></td>
				 
                <td><?= $tx_profile->name.'( '.$tx_profile->username.' )';?></td>
                <td><?= $tds_amnt;?></td>
                <td><?= $pan_number;?></td>                               
                             
                                 
                                         
                           
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
