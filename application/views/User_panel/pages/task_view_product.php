<style>
.card-header:first-child {
   color: white;
}
</style>
<div class="container pages">  
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
                <li class="breadcrumb-item"><a href="#">Product</a></li>  |          
                <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
            </ol>
	   </div>
</div>

<?php
$usrId=$this->session->userdata('user_id');
$task_details=$this->conn->runQuery('*','task_data',"id='$task_id'");

?>    
 

 
    <div class="card card-body ">
        <div class="row">
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
            <form action="<?= $panel_path.'task/ads_request'?>" method="post" enctype= multipart/form-data>   
                <div class="col-lg-8">
                  
                <!--<div class="form-group">-->
                <!--  <label for="" class= "">Ads Name</label>-->
                <!--  <input type="text" name="task_name" value="<?= $task_details[0]->heading1;?>" data-response="username_res" class="form-control"  aria-describedby="helpId" readonly> -->
                     
                <!--</div>-->
                <div class="form-group">
                  <label for="" class="">Product Name</label>
                  <input type="text" name="product_name" id="product_name" value="<?= $task_details[0]->product_name;?>" class="form-control"  aria-describedby="helpId" readonly>
                  
                </div>
                
                 <div class="form-group">
                  <label for="" class="">Product Mrp</label>
                  <input type="text" name="product_mrp" id="product_mrp" value="<?= $task_details[0]->product_mrp;?>" class="form-control"  aria-describedby="helpId" readonly>
                  
                </div>
                
                 <div class="form-group">
                  <label for="" class="">Product Description</label>
                  <textarea type="text" name="product_description" id="product_description" value="" class="form-control"  aria-describedby="helpId" readonly><?= $task_details[0]->product_description;?></textarea>
                  
                </div>
                <br>
                  <div class="form-group">
                 
                  <a target="_blank" class="btn btn-sm btn-info" href="<?= $task_details[0]->product_link;?>">View Product</a>
                </div>
                
                <div class="form-group">
                  <label for="" class="">Image</label>
                   
                  <input hidden type="file" name="task_image" id="task_image" value="<?= $task_details[0]->task_image;?>" class="form-control"  aria-describedby="helpId" readonly>
                  <a href="<?= $task_details[0]->task_image;?>" target="_blank"><img src="<?= $task_details[0]->task_image;?>" style="height:200px;width:200px"></a> 
                </div>
              
              
            
      
                <input type="hidden" name="watch_id"  value="<?= $task_id;?>">
             
                <?php
                $task_details=$this->conn->runQuery('*','task_data_request',"task_id='$task_id' and req_status='0'");
                if($task_details){
                ?>
                <div class="info">
                  <p class="btn btn-info">Request Already Submit!</p>
                </div>
                <?php
                }else{
                ?>
                <div class="user_form_row_data  ">
                 <div class="user_submit_button mb-2 mt-2">
                 <input type="submit" class="user_btn_button btn-remove"  name="buy_btn" value="Buy Now" >
                 </div>
                    
                </div>
                <?php
                }
                ?>
                       
                
            
        </form>  
                
                
                
                
                
            </div>
        </div>
    </div>
   

                            
</div>

 
    
