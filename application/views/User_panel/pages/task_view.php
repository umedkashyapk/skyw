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
                <li class="breadcrumb-item"><a href="#">Task</a></li>            
                <li class="breadcrumb-item active" aria-current="page"> View</li>
            </ol>
	   </div>
	  
</div>

<?php
$usrId=$this->session->userdata('user_id');
$task_details=$this->conn->runQuery('*','task_data',"id='$task_id'");
$task_user_details=$this->conn->runQuery('*','task_history',"task_id='$task_id' and u_id='$usrId'");

if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
	 
}else{
	$likecondition=array();
}  


?>
  <div class="caption">
        <div id="myProgress" class="progress ">
            <div id="myBar" class="progress-bar progress-bar bg-info"></div>
        </div>
    </div>
   
   
    <div class="card card-body card-bg-1">
        
        <div class="row">
            <div class="col-lg-12">
                 <a class="btn btn-sm btn-info" href="<?= $panel_path.'task/view_product?id='.$task_id;?>">View Product</a>
                <div class="task_view">
                    <div class="card-header"><i class="fa fa-table"></i>Ads</div>
                    <div class="card-body">
                     <img style="width:100%;height:480px" src="<?= $task_details[0]->task_image;?>" >   
                     </div>
                </div>
            </div>
        </div>
    </div>
  
 
                            
</div>

 <script>
    move(<?= $task_id;?>);
    
        function move(task) {
          var elem = document.getElementById("myBar");   
          var width = 0;
          var id = setInterval(frame, 50);
          function frame() {
            if (width >= 50) {
        		//alert(width);
                clearInterval(id);
               
        	    $.ajax({
                      type: "post",
                      url: "<?= $panel_path.'task/add_view';?>",
                      data: {task:task},          
                      success: function (response) {
                        $('#myBar').attr('class','progress-bar bg-success');
    		            $('#success').html("Success").css('color','green');
                      }
                });
            		    
            } else {
              width++; 
              elem.style.width = width + '%'; 
             
              //elem.innerHTML = width * 1  + '%';
        	   /*elem.innerHTML = Math.round(width / 5) + 'Sec'; */
            }
          }
        }

</script>
    
