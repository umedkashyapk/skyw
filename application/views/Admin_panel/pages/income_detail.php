<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Payment Credit</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Payment</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Payment Credit</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Payment Credit</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <form action="<?= $admin_path.'income/all-income';?>" method="REQUEST">
             <div class="form-inline">
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>&nbsp;
                 <select name="limit"  class="form-control" >
                     <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                     <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                     <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                     <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                      <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                  </select>&nbsp;
                 
                 <input type="submit" name="submit" class="btn btn-light" value="filter" />&nbsp;
                 <a class="btn btn-light" href="<?= $admin_path.'income/all-income';?>">Reset</a>&nbsp;
                 <input type="submit" name="export_to_excel" class="btn btn-light" value="Export to excel" />
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
                <th>S No.</th>                
                <th>Name</th>  
                <th>Username</th>   
                <th>Package</th>                
                <th>Cashback Income</th>
                <th>Referral Income</th>
                <th>TMF</th>
                <th>Admin Charges</th>
                <th>Total Amount To Be Paid(net Payment)</th>
               
            </tr>
        </thead>
        <tbody>
            <?php
         
        if($table_data){
            foreach($table_data as $t_data){
               
                $sr_no++;
                       $tx_profile=$this->profile->profile_info($t_data['u_code']);
                       $package=$this->business->package($t_data['u_code']);
                          $cashback=$t_data['c7']; 
                          $referral=$t_data['c3'];
                          $tmf=$t_data['c5'];
                          $ttl_income=$cashback+$referral+$tmf;
                          $admin_charge=$ttl_income/100*10;
                          $paid_amount=$ttl_income-$admin_charge;

            ?>
            <tr>
                <td><?= $sr_no;?></td>   
                <td><?= ($tx_profile ? $tx_profile->name:'');?></td> 
                <td><?= $tx_profile->username;?></td>
                <td><?= $package;?></td> 
                <td><?= $ttl=$t_data['c7'];?></td> 
                <td><?= $t_data['c3'];?></td> 
                <td><?= $t_data['c5'];?></td>
                <td><?= $admin_charge;?></td> 
                <td><?= $paid_amount;?></td> 
                             
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
