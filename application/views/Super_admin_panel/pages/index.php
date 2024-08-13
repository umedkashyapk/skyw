<?php
$date=date('Y-m-d H:i:s');
$currency=$this->conn->company_info('currency');
$data=$this->conn->setting('reg_type');
$total_needs=$this->conn->runQuery('count(id) as ttl','needs',"1=1")[0]->ttl;
$total_today_needs_pending=$this->conn->runQuery('count(id) as ttl','needs',"status='0' and DATE(added_on)=DATE(NOW())")[0]->ttl;
$total_today_needs_accepted=$this->conn->runQuery('count(id) as ttl','needs',"status='1' and DATE(added_on)=DATE(NOW())")[0]->ttl;

$yesterday_needs_pending=$this->conn->runQuery('count(id) as ttl','needs',"status='0' and date(added_on)= DATE(NOW() - INTERVAL 1 DAY)")[0]->ttl;
$yesterday_needs_accepted=$this->conn->runQuery('count(id) as ttl','needs',"status='1' and date(added_on)= DATE(NOW() - INTERVAL 1 DAY)")[0]->ttl;
$lastweek_needs=$this->conn->runQuery('count(id) as ttl','needs',"added_on > (NOW() - INTERVAL 24*7 HOUR)")[0]->ttl;
$start_date = date('Y-m-d 00:00:01',strtotime('first day of last month'));
$end_date = date('Y-m-d 23:59:59',strtotime('last day of last month'));
$lastmonth_needs=$this->conn->runQuery('count(id) as ttl','needs',"added_on >='$start_date' and added_on<='$end_date'")[0]->ttl;
$approved_needs=$this->conn->runQuery('COUNT(*) as cnt','needs',"status='1'")[0]->cnt;
$pending_needs=$this->conn->runQuery('COUNT(*) as cnt','needs',"status='0'")[0]->cnt;

?>
      <!--Start Dashboard Content-->
      <div class="col-md-12">
          <div class="row mt-3">
        <div class="col-12 col-lg-6 col-xl-4">
        <a href="<?= $superadmin.'needs';?>">
          <div class="card gradient-ibiza">
            <div class="card-body">
              <div class="media align-items-center">
              
              <div class="media-body">
                 <p class="text-white">Total Needs</p>
                <h4 class="text-white line-height-5"><?= $total_needs;?></h4>
              </div>
            
              <div class=""><span id="dashboard2-chart-1"></span></div>
            </div>
            </div>
            <div class="card-footer border-light-2">
              <p class="mb-0 text-white">
                    <span class="mr-2"><i class="fa fa-arrow-up"></i> </span>
                    <span class="text-nowrap"></span>
                  </p>
            </div>
          </div>
           </a>
        </div>

        <div class="col-12 col-lg-6 col-xl-4">
      <a href="<?= $superadmin.'needs?name=&username=&email=&mobile=&status=0&submit=filter';?>">
          <div class="card gradient-branding">
            <div class="card-body">
              <div class="media align-items-center">
              
              <div class="media-body">
                 <p class="text-white">Pending Message</p>
                <h4 class="text-white line-height-5"><?= $pending_needs;?></h4>
              </div>
              
              <div class=""><span id="dashboard2-chart-2"></span></div>
            </div>
            </div>
         <div class="card-footer border-light-2">
              <p class="mb-0 text-white">
                    <span class="mr-2"><i class="fa fa-arrow-up"></i> </span>
                    <span class="text-nowrap"></span>
                  </p>
            </div>
          </div>
          </a>
        </div>

        <div class="col-12 col-lg-12 col-xl-4">
         <a href="<?= $superadmin.'needs?name=&username=&email=&mobile=&status=1&submit=filter';?>">
          <div class="card gradient-deepblue">
            <div class="card-body">
              <div class="media align-items-center">
             
              <div class="media-body">
                 <p class="text-white">Accepted Message</p>
                <h4 class="text-white line-height-5"><?=$approved_needs;?></h4>
              </div>
              
              <div class=""><span id="dashboard2-chart-3"></span></div>
            </div>
            </div>
            <div class="card-footer border-light-2">
              <p class="mb-0 text-white">
                    <span class="mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap"></span>
                  </p>
            </div>
          </div>
          </a>
        </div>
        
      </div><!--End Row-->
        <div class="row">
          <div class="col-md-6">
             <div class="card">
            <div class="card-header">
                <span id="bv_title"> Needs </span> 
                <!--<div class="card-action">
                 <div class="dropdown">
                 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                  <i class="icon-options"></i>
                 </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item change_bv" href="javascript:void();" data-val="all">All</a>
                        <a class="dropdown-item change_bv" href="javascript:void();" data-val="today">Today</a>
                        <a class="dropdown-item change_bv" href="javascript:void();" data-val="24hour">Yesterday</a>
                        
                   </div>
                  </div>
                 </div>-->
                </div>
                <div class="card-body">
                     <div id="loader_section" class="">
                         <div id="loader_img_section" class="">
                             <div id="bvdata" class="" >
                               <div class="table-responsive">
                                <table class="table table-sm table">
                                    
                                    <tr>
                                        
                                        <td><a href="#">Total</a></td>
                                        <td><?=$currs?>&nbsp;<?= $total_needs!='' ? $total_needs:0 ;?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td><a href="#">Today Pending</a></td>
                                        <td><?=$currs?>&nbsp;<?= $total_today_needs_pending!='' ? $total_today_needs_pending:0;?></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Today Accepted</a></td>
                                        <td><?=$currs?>&nbsp;<?= $total_today_needs_accepted!='' ? $total_today_needs_accepted:0;?></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">Yesterday Pending </a></td>
                                        <td><?=$currs?>&nbsp;<?= $yesterday_needs_pending!='' ? $yesterday_needs_pending:0;?></td>
                                    </tr>
                                     <tr>
                                        <td><a href="#">Yesterday Accepted </a></td>
                                        <td><?=$currs?>&nbsp;<?= $yesterday_needs_accepted!='' ? $yesterday_needs_accepted:0;?></td>
                                    </tr>
                                     <tr>
                                        <td><a href="#">Lastweek </a></td>
                                        <td><?=$currs?>&nbsp;<?= $lastweek_needs!='' ? $lastweek_needs:0;?></td>
                                    </tr>
                                     <tr>
                                        <td><a href="#">Last Month </a></td>
                                        <td><?=$currs?>&nbsp;<?= $lastmonth_needs!='' ? $lastmonth_needs:0;?></td>
                                    </tr>
                                    
                                </table>
</div>
                            </div>
                        </div>
                    </div>
                  <!--<canvas id="dashboard-chart-1"></canvas>-->
                </div>
          </div> 
          </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
        
            <div class="card-body">
                
                <?php
                
                $this->db->select('count(id) as count_id,DATE(added_on) as added_on');
                //$this->db->where('status',0);
                $this->db->group_by('DATE(added_on)');
                $qr=$this->db->get('needs');
                $all_users=$qr->result_array();
                $ids=!empty($all_users) ? array_column($all_users,'count_id'):array(0);
                $lbl=!empty($all_users) ? array_column($all_users,'added_on'):array(0);
                
                
                if(!empty($ids)){
                $data=json_encode($ids);
                
                $lebel=json_encode($lbl);
                //echo $data;
                ?>
                <canvas  id="dailychart"></canvas>
                <script>
                var ctx = document.getElementById('dailychart').getContext('2d');
                var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                
                // The data for our dataset
                data: {
                labels: <?= $lebel;?>,
                datasets: [{
                label: 'Total Pending Needs',
                backgroundColor: 'rgb(0,0,255)',
                //borderColor: 'rgb(227, 243, 92)',
                data: <?= $data;?>
                }]
                },
                
                // Configuration options go here
                options: {
                title: {
                display: true,
                text: 'Needs Chart'
                }
                }
                });
                </script>
                <?php
                }
                
                
                ?>
                
            </div>
            
            
        </div>
    
    </div>
</div>



</div>
