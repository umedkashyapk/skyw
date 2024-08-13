<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Control Pages detail</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Control Pages detail</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Control Pages detail</h6>
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
             <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Page Type</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
           
            foreach($table_data as $t_data){
                  
                  $desc=$t_data['legal_desc'];
                 
                             
                  $sr_no++;
          
                 ?>
            <tr>
                  <td><?= $sr_no;?></td> 
                  <td><?= $t_data['legal_title'];?></td>                  
                  <td>
                  
                <?php  if (strlen($desc) > 250) {
                    $trimstring = substr($desc, 0, 300). ' <a href="view?view_id='.$t_data['id'].'">Read More...</a>';
                    } else {
                    $trimstring = $string;
                    }
                    echo $trimstring;
                  
                    ?>
                                      
                  
                  
                  </td>  
                  <?php
                   if($t_data['lega_page_type']=='pdf'){
                  ?>
                  <td>
                      <?php
                      if($t_data['legal_img']!=''){
                          ?>
                    
                      <embed src="<?php echo $t_data['legal_img'];?>" style="width:50px; height:50px;"  target="_blank"/>
                      <?php 
                      }else{
                       echo'';
                      }
                      
                      ?>
                      
                      </td> 
                      <?php
                   }else{
                      ?>
                       <td>
                      <?php
                      if($t_data['legal_img']!=''){
                          ?>
                      <a href="<?php echo $t_data['legal_img'];?>" target="_blank"><img src="<?php echo $t_data['legal_img'];?>" style="width:50px; height:50px;"></a>
                      <?php 
                      }else{
                       echo'';
                      }
                      
                      ?>
                      
                      </td> 
                      
                      <?php
                   }
                      ?>
                      
                    <td><?= $t_data['lega_page_type'];?></td>         
                  <td><a class="btn btn-primary btn-sm" href="<?= $admin_path.'legals/edit_page?edit_id='.$t_data['id'];?>"><i class="fa fa-edit"></i></a>
                 <a class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item')" href="<?= $admin_path.'legals/delete?dele_id='.$t_data['id'];?>"><i class="fa fa-trash"></i></a>
                </td>              
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
<script>
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}
</script>