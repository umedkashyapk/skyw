<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> Contact</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Contact</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Detail</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Contact Detail</h6>
<hr>
<?php

             $likecondition=($this->session->userdata($search_string) ? $this->session->userdata($search_string):array());
             
             ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         
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
            <th>Email</th>
            <th>Mobile</th>
            <th>Subject</th>
            <th>Message</th>
            
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
                <td><?= $t_data['email'];?></td> 
                <td><?= $t_data['mobile'];?></td> 
                <td><?= $t_data['subject'];?></td> 
                <td><?= $t_data['message'];?></td>               
                    
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
