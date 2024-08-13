  
          <div class="row pt-2 pb-2">
            <div class="col-sm-9">
              <h4 class="page-title">Top Earners</h4>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Top Earners</a></li>
                
              </ol>
            </div>
          </div>
          
          <div id=" ">
           
             
             
            
            <div class="row">
              <div class="col-md-12 bg-light">
               <form action="<?= $admin_path.'wallet';?>" method="Request">
             <div class="form-inline">
                 
                 <div class="form-group ">                      
                    <input type="text" Placeholder="Enter Username" name="username" class="form-control" value='<?= isset($_REQUEST['username']) && $_REQUEST['username']!='' ? $_REQUEST['username']:'';?>' />                      
                 </div>
                 <div class="form-group m-1">                      
                    <input type="text" Placeholder="Enter Full Name" name="name" class="form-control" value='<?= isset($_REQUEST['name']) && $_REQUEST['name']!='' ? $_REQUEST['name']:'';?>' />                       
                 </div>
                 <!-- <div class="form-group ">                      
                    <input type="text" Placeholder="Enter amount" name="amount" class="form-control" value='<?= isset($_REQUEST['amount']) && $_REQUEST['amount']!='' ? $_REQUEST['amount']:'';?>' />                      
                 </div>
                 <div id="dateragne-picker">
                    <div class="input-daterange input-group">
                    <input type="text" class="form-control"  Placeholder="From"  name="start_date" value="<?= (isset($_REQUEST['start_date']) ? $_REQUEST['start_date']:''); ?>"/>
                    <div class="input-group-prepend">
                    <span class="input-group-text">to</span>
                    </div>
                    <input type="text" class="form-control"  Placeholder="End date"  name="end_date" value="<?= (isset($_REQUEST['end_date']) ? $_REQUEST['end_date']:''); ?>" />
                    </div>
               </div>  -->
                 <input type="submit" name="submit" class="btn btn-sm" value="filter" />&nbsp;
                  <a  class="btn btn-sm" href="<?= $admin_path.'wallet';?>" class="">Reset</a>
                 <!--<input type="submit" name="reset" class="btn btn-sm" value="Reset" />
                 <input type="submit" name="export_to_excel" class="btn btn-sm" value="Export to excel" />-->
            </div>
        </form>
              
                <div class="table-responsive">
                  <table class="table table-condensed ">
                    <tr>
                      <th>Sr No.</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Total Earning</th>
                      <th>Higest Rank</th>
                      <th>Topup Date</th>
                     
                    </tr>
                    <?php  
                    
                    
              
                    
                    // print_r($table_data);
                      if(!empty($table_data)){ 
                         
                        foreach($table_data as $t_data){
                          $sr_no++;       
                         $_u_code=$t_data['u_code'];
                         $_amount=$t_data['total'];
                         
                         $user_details=$this->profile->profile_info($_u_code);
                          ?>
                            <tr>
                              <td><?= $sr_no;?></td>
                              <td><?= $user_details->username;?></td>
                              <td><?= $user_details->name;?></td>
                              <td><?= $ttl_qty[]=$_amount;?></td>
                              <td><?=  $this->business->higher_rank($_u_code);?></td>
                               <td><?= $user_details->active_date;?></td>
                             
                           
                            
                            </tr>
                          <?php
                          $sr++;
                        }
                      }
                    ?>    
                    
                  </table>
                   
                </div>
              </div>
            <?php  echo $this->pagination->create_links();?>      
            </div><!--End Row-->
</div>
 