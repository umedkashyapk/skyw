<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
.breadcrumb {
   
    margin-top: 100px;
}
li.breadcrumb-item.active {
    color: #000;
}
input.btn.btn-secondary.my-2.my-sm-0, a.btn.btn-secondary.my-2.my-sm-0 {
    background: #bb9033;
}
button.navbar-toggler {
    background: whitesmoke;
}
            @media only screen and (max-width: 600px) {
                .flex > .flex-item{
                         width : var(--item-width);
                         font-size:8px;
                     } 
                     .flex-item > span > .user {
                            width:25px;        
                        }
            }
            @media only screen and (min-width: 601px) {
                .flex >  .flex-item{
                         width : var(--item-width);
                         font-size:16px;
                     } 
                .flex-item > span > .user {
                    width:50px;        
                }  
            }

            .flex{
                    display: flex;
                    flex-wrap: nowrap;                
                                 
                }
       </style>
    <div class="container pages">   
    <br>
<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="">Team</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Team Board</li>
         </ol>
	   </div>
	    
</div>
 
 <?php 
$userid = $this->session->userdata('user_id');


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
               <div class="row pt-2 pb-2" >
                   <div class="col-12">
           <center>
               <div class="">    
            <div class="form-inline1">  
               <!--navbar-light bg-light-->
                <nav class="navbar navbar-expand-lg navbar-light ">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav">

                <form action="<?= $panel_path.'team/team-matrix-generation';?>" class="form-inline my-2 my-lg-0" method="post">
                   <!-- <input type="text" Placeholder="Enter Username" name="username" class="form-control mr-sm-2" value='<?= isset($_POST['username']) && $_POST['username']!='' ? $_POST['username']:'';?>' required/>                      
    -->
    
                <div class="form-group">
		
			<select name="select_pool" class="form-control" id="select_pool" >
			 <option value="1" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='1' ? "selected":0);?>>Board1</option>	
				<option value="2" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='2' ? "selected":0);?>>Board2</option>			 
				<option value="3" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='3' ? "selected":0);?>>Board3</option>			 
				<option value="4" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='4' ? "selected":0);?>>Board4</option>			 
			<!--	<option value="5" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='5' ? "selected":0);?>>Pool5</option>	
				<option value="6" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='6' ? "selected":0);?>>Pool6</option>	
				<option value="7" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='7' ? "selected":0);?>>Pool7</option>	
				<option value="8" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='8' ? "selected":0);?>>Pool8</option>	
				<option value="9" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='9' ? "selected":0);?>>Pool9</option>	
				<option value="10" <?php echo ($this->session->has_userdata('user_selected_pool') && $this->session->userdata('user_selected_pool')=='10' ? "selected":0);?>>Pool10</option>	
			-->
			
			</select>
		  </div>	
		    
    
                    <input type="submit" name="submit1" class="btn btn-secondary my-2 my-sm-0" value="Filter" />&nbsp;
                    <a href="<?= $panel_path.'team/team-matrix-generation';?>" class="btn btn-secondary my-2 my-sm-0">Reset</a>
                    </ul>
                    </div>
                </form>
             <?php
            	 if($this->session->has_userdata('user_selected_pool')){
            				$user_selected_pool=$this->session->userdata('user_selected_pool');
            				
            	     
            	 }else{
            		$user_selected_pool=1;	
            				}
            		?>	
					
                </nav>
                
                
                
                
            </div>
             
    <?php
    
            if($node_id){
                $u_id=$this->team->pool_node($node_id,$user_selected_pool);
                $_user_profile = $this->profile->profile_info($u_id);
                $sponsor_details = $this->profile->profile_info($_user_profile->u_sponsor);
            }
            if($user_selected_pool==2){
            $pool_ty="pool2";
            }elseif($user_selected_pool==3){
             $pool_ty="pool3";   
            }elseif($user_selected_pool==4){
               $pool_ty="pool4"; 
            }else{
              $pool_ty="pool1";  
            }
            
    ?>
           <div class="flex">
                <div class="flex-item" style="--item-width:100%">
                    <span <?php if($node_id){ ?> data-toggle="popover1" data-trigger="hover" data-html="true" data-content="Full NAME :<?= $_user_profile->name;?><br>SPONCER NAME: <?= ($sponsor_details ? $sponsor_details->name:'null');?>  <br>JOINING DATE : <?= $_user_profile->added_on;?><br>ACTIVATION DATE: <?= $_user_profile->updated_on;?>" <?php } ?> >
                        <img class="user" src="<?= base_url('images/users/tree_user.png');?>">  
                    </span>
                    
                    </br>
                    <span style="color:#fff"><?= $_user_profile->name;?></span>
                    </br>
                   <span style="color:#fff">
                     <?= $this->team->pool_status($u_id,$pool_ty);?>
                  </span>
                </div>
            </div>
            <?php
               
                $this->team->matrix_pool(1,$node_id,$user_selected_pool);
            ?>
       
           
   
        </center>
       </div>         
</div>   
</div>
</div>

<br>
<br>