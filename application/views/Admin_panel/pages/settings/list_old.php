            <br>
            <nav>
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="<?= $super_admin_path.'dashboard';?>">Home</a>
					</li>
					<li class="breadcrumb-item">
						<a href="#">Settings</a>
					</li>
					 
				 
				</ol>
			</nav>
	<div class="row">
		<div class="col-md-12 card card-body">
		  <table class="table table-sm">
		       <tr>
		          <th>S No.</th>
		          <th>Setting Name</th>
		          <th>Action</th>
		      </tr>
		      <?php
		      $all_distinct_val=$this->conn->runQuery('DISTINCT(title) as val','advanced_info',"type!='not_edit' and admin_status='1'");
		     
		      if($all_distinct_val){
		          $sno=0;
		          foreach($all_distinct_val as $all_settings){
		              $sno++;
		              ?>
		              <tr>
        		          <td><?= $sno;?></td>
        		          <td><?= $all_settings->val;?></td>
        		          <td><a href="<?= $super_admin_panel.'settings/set?title='.$all_settings->val;?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a></td>
        		      </tr>
		              <?php
		          }
		      }
		      ?>
		      <tr>
        		          <td><?= $sno+1;?></td>
        		          <td>Payment Method</td>
        		          <td><a href="<?= $super_admin_panel.'settings/change_payment'?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a></td>
        		      </tr>
        		      <tr>
        		          <td><?= $sno+2;?></td>
        		          <td>Payment Accept Method</td>
        		          <td><a href="<?= $super_admin_panel.'settings/change_request_method'?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a></td>
        		      </tr>
        		      <tr>
        		          <td><?= $sno+3;?></td>
        		          <td>Company Info</td>
        		          <td><a href="<?= $super_admin_panel.'settings/company'?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a></td>
        		      </tr>
        		      
		  </table>
		  
		</div>
	</div>
 