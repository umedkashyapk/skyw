<?php
$control_details=$this->conn->runQuery('*','legal_data',"id='$control_id'");

?>
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">Control  Details </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Control</a></li>            
                      
            <li class="breadcrumb-item active" aria-current="page">  Control Detail </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Control Pages View</h6>
<hr>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       

<div class="table-responsive">
<table class="table table-hover">
        
            <tr>               
                <th> Title</th><td>:</td><td><?= $control_details[0]->legal_title;?></td>
            </tr>
            <tr>
                <th>Description</th><td>:</td><td><p><?= $control_details[0]->legal_desc;?></p></td>  
                </tr>
                 
            <tr> 
                <th>Image</th><td>:</td><td> <?php
                      if($control_details[0]->legal_img!=''){
                          ?>
                      <a href="<?php echo $control_details[0]->legal_img;?>" target="_blank"><img src="<?php echo $control_details[0]->legal_img;?>" style="width:50px; height:50px;"></a>
                      <?php 
                      }else{
                       echo'';
                      }
                      
                      ?></td>
                </tr>
           
               <tr> 
                <th>Page Type</th><td>:</td><td><?php echo $control_details[0]->lega_page_type;?></td>
                </tr>
    </table>
    
</div>



   
    </div>
   
</div>
