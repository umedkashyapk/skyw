<?php
 $ttl_records=$this->conn->runQuery('COUNT(id) as total','users','1=1')[0]->total;
//echo date('2021-09-30 00:00:00');
?>


<div class="row pt-3 bg-default">
        <div class="col-sm-10">
		  <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Users Rank Report</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Users Rank Report</li>
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
            
               <form action="<?= $admin_path.'users/ranks';?>" method="request">
                     <div class="form-inline1">
                                             
                            <input type="text" Placeholder="Enter Name" name="name" class=" " value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />
                            <input type="text" Placeholder="Enter Username" name="username" class=" " value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />
                          
                            <select name="rank">
                                 <option value="">Select Rank</option>
                                 <?php
                                 $all_rank=$this->conn->runQuery('rank','plan','id<=8');
                                     foreach($all_rank as $all_rank1){
                                  ?>
                                 <option value="<?= $all_rank1->rank;?>" <?= isset($_REQUEST['rank']) && $_REQUEST['rank']==$all_rank1->rank ? 'selected':'';?> ><?= $all_rank1->rank;?></option>
                                 <?php
                                 }
                                 ?>
                             </select>
                       
                            <!-- <select name="limit">
                                 <option value="10" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==10 ? 'selected':'';?> >10</option>
                                 <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                                 <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                                 <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                                 <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                             </select>-->
                          
                       
                         <input type="submit" name="submit" class="  " value="filter" />
                       <button> <a href="<?= $admin_path.'users/ranks';?>" class="">Reset</a></button>&nbsp;
                       <!--  <input type="submit" name="export_to_excel" class=" " value="Export to excel" />-->
                    </div>
                </form>
            </div>
         
        
    <!-- <h3><button class="btn btn-primary">Total Records:
                  <?php echo $this->conn->runQuery('COUNT(id) as total','users','1=1')[0]->total;?>
              </button>
         </h3>  -->  
        
       
 
    <div class="card ">
    <div class="card-header text-right"></div>
        <div class="table-responsive">
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Rank</th>
                       
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
                        $sr_no++
                    ?>
                    <tr>
                        <td><?= $sr_no;?></td>
                        <td><?= $t_data['name'];?></td>
                        <td><?= $t_data['username'];?></td>
                        <td><?= $t_data['my_rank'];?></td>
                       
                       
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
