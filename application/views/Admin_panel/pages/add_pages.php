 
<div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title"> </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">home</a></li>            
                        
            <li class="breadcrumb-item active" aria-current="page">Dynamic Page</li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"></h6>
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
                            
                            <div class="card card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    
                           
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                              <div class="pull-right">
                                     <!-- <button type="button" class="btn btn-default btn-sm">
                                      <span class="glyphicon glyphicon-edit"></span> Select page
                                    </button> -->
                                    </div>
                                  <div class="form-group">
                                     <label for="">Select Legal Page</label>
                                     
                                        <select name="legal_page" class="form-control" id="legal_page" style="width:200px;" onchange="return legal_control();">
                                            <option value="">Select Page</option>
                                           <!-- <option value="term_condition"> Terms and Conditions</option>
                                            <option value="privacy_policy"> Privacy Policy</option>
                                            <option value="about_us"> About us</option>
                                            <option value="our_mission"> Our Mission</option>
                                            <option value="our_vision"> Our Vision</option>
                                            <option value="legals">Legals</option>-->
                                            <option value="tradingimg">Trading</option>
                                            <option value="welcome_letter">Welcome Letter</option>
                                            <option value="pdf">Upload PDF</option>
                                        </select>
                                       
                                        <span class=" text-danger" ><?= form_error('legal_page');?></span>
                                  </div> 
                                 
                                        
                                    <div class="form-group" id="title_div">
                                      <label for=""> Title</label>
                                      <input type="text" name="title" value="<?= set_value('title');?>"  class="form-control"  placeholder="Enter title" aria-describedby="helpId"> 
                                      <span class=" " id="title"><?= form_error('title');?></span>             
                                    </div>
                                    
                                    <div style="display:none;" class="form-group" id="image_div">
                                        <label for="">Img/PDF</label>
                                        <input type="file" name="file" class="form-control" aria-describedby="helpId"> 
                                      <span class=" " id="file_error"><?= form_error('file_error');?></span>  
                                    </div>
                                    
                                    <div class="form-group" id="description_div">
                                        <label for="">Description</label>
                                        <textarea id="ad_txt" name="desc">
                                        </textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-remove" name="add_trm_btn" >Add</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        
    <script>
    
    function legal_control(){
        var legal_page=$( "#legal_page" ).val();
        if(legal_page=='term_condition' || legal_page=='privacy_policy' || legal_page=='welcome_letter'){
            $("#image_div").hide(); 
            $("#title_div").show(); 
            $("#description_div").show(); 
        }else if(legal_page=='legals'){
            $("#image_div").show();
            $("#title_div").hide(); 
            $("#description_div").hide();
        }else if(legal_page=='tradingimg'){
            $("#image_div").show();
            $("#title_div").hide(); 
            $("#description_div").hide();
        }else if(legal_page=='pdf'){
            $("#image_div").show();
            $("#title_div").hide(); 
            $("#description_div").hide();
        }else{
            $("#title_div").show(); 
            $("#description_div").show(); 
            $("#image_div").show();
        }
         
    }
    </script>
    