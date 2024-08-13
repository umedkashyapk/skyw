<style>

.card.card-body.card-bg-1 {
    background: var(--first) !important;
}
input.user_btn_button {
    text-align: center;
    margin: auto;
    display: block;
}

.input-group.fund {
    margin-bottom: 10px;
}
button.data_button {
    margin-left: 7px;
    padding: 10px;
    margin-top: 1px;
    background: var(--second) !important;
    border: none;
}

button.data_button i {
    color: #fff;
}
</style>


<div class="container pages">
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">home</a></li>            
                <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Fund</a></li>            
                <li class="breadcrumb-item active" aria-current="page"> Fund add</li>
            </ol>
	   </div>
	  
</div>

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
    
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
       <!-- <div class="card card-body card-bg-1">
            
            	<div class="input-group card-bg-1 ">
                    <div class="input-group-prepend">
                      <span style="height:38px;" class="input-group-text">Address</span>
                    </div>
                    <input type="text"style="height:38px;"  id="referral_link_right" class="form-control" value="<?=$address;?>">
                    <div class="input-group-append input-group-btn">
                          
                        <button type="submit" class="btn btn-success"   onclick="copyLink('right')">
                            <i class="fa fa-copy" style="color: #D3B916; font-size: 18px;"></i>
                        </button>
                        
                </div>
            </div>
            <center>
           <img style="height:200px;width:200px;" src="<?= base_url('user/fund/my_qr_code?address='.$address);?>" />
            </center>
        </div>-->
        <div class="card card-body card-bg-1">
            <p>&nbsp;</p>
            <center>
           <img style="height:;width:;" src="<?= base_url('user/fund/my_qr_code?address='.$address);?>" /></center>
            <br>
            <p>&nbsp;</p>
             <div class="input-group fund ">
                    <!--<div class="input-group-prepend">
                      <span style="height:38px;" class="input-group-text">Address</span>
                    </div>-->
                    <input type="text" id="referral_link_right" class="form-control" value="<?=$address;?>">
                    <div class="input-group-append input-group-btn">
                          
                        
                       <button type="submit" class="data_button"  onclick="copyLink('right')">
                            <i class="fa fa-copy" style=" "></i>
                        </button>  
                        
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="submit" class="user_btn_button" name="request_btn" value="Save">
            </form>
        </div>
		</div>
</div>
</div>
<br>
<br>
<br>
<br>