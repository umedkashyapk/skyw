<style>
a.btn.btn-outline.btn-sm.green {
    color: #fff;
}

.table>:not(:last-child)>:last-child>* {
   color: white;
}
.btn-success{
    color: #fff;
    background-color: #0a404c !important;
    border-color: #0a404c !important;
}

.danger {
  background-color: #ffdddd;
  border-left: 6px solid #f44336;
}

.danger {
   
    width: 50%;
   
    margin-left: auto;
}

@media only screen and (max-width: 800px) {
 .danger {
   
    width: 100%;
   
   
}
}
.table>:not(:last-child)>:last-child>* {
    color: #000 !important;
}

</style>

	<div class="container pages">  
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home /</a></li>            
            <li class="breadcrumb-item"><a href="#">Ads /</a></li>            
            <li class="breadcrumb-item active" aria-current="page">My Daily Ads</li>
         </ol>
	   </div>
</div>

<?php
$profile=$this->session->userdata("profile");
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
	 
}else{
	$likecondition=array();
}  
?>
 
<!--<div class="danger">-->
<!--  <p><strong><h5 class="text-danger">Note :</h5></strong><h6 class="text-danger"> Don't Refresh page for two minutes !</h6></p>-->
<!--</div>-->

    <div class="card card-body card-bg-1">
       
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                
                <?php 
                $active_sts=$profile->active_status;
                if($active_sts==1){
                ?>
                <div class="table-responsive">
                        <table id="default-datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <!--<th>Ads Name</th>-->
                                    <th>Image</th>
                                     <th>Product Name</th>
                                    <th>Mrp</th>
                                    <th>Description</th>
                                    <th>Preview</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                $sr=0;
                                $dt=date('Y-m-d H:i:s');
                                $usrId=$this->session->userdata('user_id');
                                // and DATE(task_time)=DATE('$dt')
                                
                                
                                $table_data=$this->conn->runQuery('*','task_data',"status=1 and DATE(task_time)=DATE('$dt')");
                               
                                if($table_data){
                                foreach($table_data as $arr){
                                    $task_id=$arr->id;
                                ?>
                                    <tr>
                                        <td><?php echo $sr+1;;?></td>
                                        <!--<td><?php echo $arr->heading1;?></td>-->
                                        
                                        <td><img src="<?= $arr->task_image;?>" style="height:50px;width:50px"></td>  
                                        <td><?php echo $arr->product_name;?></td>  
                                        <td><?php echo $arr->product_mrp;?></td>  
                                        <td><?php echo $arr->product_description;?></td>  
                                    <?php
                                        $find_task=$this->conn->runQuery("*","task_history","u_id='$usrId' and task_id='$task_id'");
                                        if($find_task){
                                    ?>
                                     <td><a class="btn btn-sm btn-info">Allready Watch This Ads</a></td>
                                    <?php
                                        }else{
                                    ?>
                                     <td>
                                         
                                         <a class="btn btn-sm btn-info" href="<?= $panel_path.'task/view?id='.$arr->id;?>">Watch And Earn</a>
                                          <a class="btn btn-sm btn-info" href="<?= $panel_path.'task/view_product?id='.$task_id;?>">View Product</a>
                                         </td>
                                    <?php
                                        }
                                      ?>
                                      
                                       
                                    </tr>
                                <?php $sr++; }} ?>
                            </tbody>
                        </table>
                    </div>
                <?php }else{ ?>
                <div class="alert alert-success">
  <strong>Note!</strong> Please Active Your Id To Watch Ads.
</div>
                <?php } ?>
                    
                    
            <?php
             echo $this->pagination->create_links();?>
            </div>
        </div>
       
<!--<div id="countdown"></div>-->
</div>
</div>


<script>

$(function(){
    $("#click").click(function(){
        $(this).hide();
        return false;
    });
});
function countdown(elementName, minutes, seconds) {
  var element, endTime, hours, mins, msLeft, time;

  function twoDigits(n) {
    return (n <= 9 ? "0" + n : n);
  }

  function updateTimer() {
    msLeft = endTime - (+new Date);
    if (msLeft < 1000) {
      element.innerHTML = "countdown's over!";
    } else {
      time = new Date(msLeft);
      hours = time.getUTCHours();
      mins = time.getUTCMinutes();
      element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds());
      setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
    }
  }

  element = document.getElementById(elementName);
  endTime = (+new Date) + 1000 * (60 * 0 + 10) + 500;
  updateTimer();
}


var display_timer_interval;
    var timer_output_initial = 20
    var timer_output = timer_output_initial;
    var initial_text = "";
    $("#timer_link").on("click",function(){
        var clicked_element = $(this);
        initial_text = clicked_element.html();
        display_timer_interval = setInterval(function(){
            display_time(clicked_element);
        }, 1000);
    });
    
    function display_time(element){
        timer_output = timer_output-1;
        if(timer_output === 0) {
           
           clearInterval(display_timer_interval);
           timer_output = timer_output_initial;
           element.html(initial_text);
        }else if(timer_output === 19){
           location.replace("https://www.w3schools.com");
        }else{
           $(element).html(timer_output);
        }
        
    }
    
</script>  
