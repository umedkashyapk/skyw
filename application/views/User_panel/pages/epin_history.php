<div class="row pt-2 pb-2">
        <div class="col-sm-12">
		  
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#">Pin Request History</a></li>            
            <li class="breadcrumb-item active" aria-current="page"> Pin Request History</li>
         </ol>
	   </div>
	  
</div>

<?php
if($this->session->has_userdata($search_parameter)){
	$get_data=$this->session->userdata($search_parameter);
	$likecondition = (array_key_exists($search_string,$get_data) ? $get_data[$search_string]:array());
	 
}else{
	$likecondition=array();
}
 ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      
       <!-- <form action="<?= $panel_path.'pin/pin-history'?>" method="get">
              <div class="form-inline1">
                                     
                    <input type="text" Placeholder="Enter Name" name="name" class="" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 
                                      
                    <input type="text" Placeholder="Enter Username" name="username" class="" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 
                                      
                   <select name="pin_type" class="" id="">
                    <option value="">Select pin</option>
                        <option value='silver' <?= isset($_REQUEST['pin_type']) && $_REQUEST['pin_type']=='silver' ? 'selected':'';?> >silver</option>
                        <option value='gold' <?= isset($_REQUEST['pin_type']) && $_REQUEST['pin_type']=='gold' ? 'selected':'';?> >gold</option>
                   </select>                      
                
                  
                                     
                   <select name="tx_type" class="" id="">
                    <option value="">Select Credit/Debit</option>
                        <option value='credit' <?= isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']=='credit' ? 'selected':'';?> >Credit</option>
                        <option value='debit' <?= isset($_REQUEST['tx_type']) && $_REQUEST['tx_type']=='debit' ? 'selected':'';?> >debit</option>
                   </select>                      
                 
                   
                    <input type="text" class=""  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                    
                    <span class="input-group-text">to</span>
                    
                    <input type="text" class=""  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                    
              
                 
                 <input type="submit" name="submit" class="" value="Filter" />
                <a href="<?= $panel_path.'pin/pin-history'?>" class=""><input type="submit" name="submit" class="" value="Reset" /></a>
            </div>
        </form>-->
        
 <div class="card card-body card-bg-1">
<div class="table-responsive">
     <table class="<?= $this->conn->setting('table_classes'); ?>">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>No of Pins</th>                
                <th>Utr Number</th>
                <th>Slip</th>
                <th>Remark</th>
                <th>Status</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            <?php

        if($table_data){
                foreach($table_data as $t_data){
    
                      
                        $sr_no++;
                ?>
                <tr>
                     <td><?=  $sr_no;?></td>
                     <td><?= $t_data['number_of_pins'];?></td>               
                     <td><?= $t_data['utr_number'];?></td>               
                     <td><img src="<?= base_url().'images/slip/'.$t_data['slip'];?>" style="width:50px;"></td>             
                     <td><?= $t_data['remark'];?></td>  
                     <td><span class="badge badge-warning badge-sm"><?= $t_data['status']==0 ? 'Pending':'';?><?= $t_data['status']==1 ? 'Approved':'';?><?= $t_data['status']==2 ? 'Cancelled':'';?></span></td>
                    <td><?= $t_data['added_on'];?></td>                     
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
</div>
