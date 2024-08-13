
<div class="user_content">
    <div class="container">
        <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		   
		    <ol class="breadcrumb ml-3 mr-3">
            <li class="breadcrumb-item"><a href="<?= $panel_path.'dashboard';?>">Home /</a></li>            
            <li class="breadcrumb-item"><a href="#">E-pin /</a></li>            
            <li class="breadcrumb-item active" aria-current="page">Pinbox</li>
         </ol>
	   </div>
	 
</div>
      <div class="user_main_card mb-3">
           
            <div class="user_card_body">
                 <h5 class="user_card_title_group"><i class="fa fa-filter"></i>Filter</h5>
                 <form action="<?= $panel_path.'pin/pin-box'?>" method="get">
                 <div class="user_form_row">
                     <div class="row">
                     <div class="col-12 mb-2">
                         <div class="data_detail_page_group">
                    <div class="detail_input_group">
                        <select name="use_status" id="" class="form-control user_input_select">
                            <option value="">Select Type</option>
                        <option value='0' <?= isset($_REQUEST['use_status']) && $_REQUEST['use_status']=='0' ? 'selected':'';?> >Unused</option>
                        <option value='1' <?= isset($_REQUEST['use_status']) && $_REQUEST['use_status']=='1' ? 'selected':'';?> >Used</option>
                       </select>
                     </div>
                     
                      <div class="detail_input_group">
                      <select name="limit" id="" class="form-control user_input_select">
                          <option value="20" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==20 ? 'selected':'';?> >20</option>
                         <option value="50" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==50 ? 'selected':'';?> >50</option>
                         <option value="100" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==100 ? 'selected':'';?> >100</option>
                         <option value="200" <?= isset($_REQUEST['limit']) && $_REQUEST['limit']==200 ? 'selected':'';?> >200</option>
                       </select>
                     </div>
                     
                   
                 <div class="user_form_row_data">
                   <div class="user_submit_button ">
                      
                       <input type="submit" name="submit" value="Filter" id="" class="user_btn_button">
                   </div>
                   <div class="user_submit_button">
                      <!-- <input type="submit" name="" value="Reset" id="" class="user_btn_button">-->
                       <a href="<?= $panel_path.'pin/pin-box'?>" class="user_btn_button" > Reset </a>
                       
                   </div>
                   </div>
               </div>
           </div>
            </div>
           </form>
            </div>
       </div>
       </div>
        <div class="user_main_card mb-3">
       
            <div class="user_card_body ">
              
                <div class="user_card_body">
                   <div class="user_table_data">
                       <table class="user_table_info_record">
                            <tbody>
                               <tr>
                                   <th>Sr No.</th>
                                   <th>Pin</th>
                                   <th>Use In</th>
                                   <th>Pin Type</th>
                                   <th>Use for</th>
                                   <th>Date&Time</th>
                                 
                               </tr>
                               <?php
 
                                if($table_data){
                                    foreach($table_data as $t_data){
                                        $tx_profile=$this->profile->profile_info($t_data['usefor']);
                                        $pin=$t_data['pin'];
                                       
                                        $sr_no++;
                                    ?>
                                    <tr>
                                        <td><?=  $sr_no;?></td>
                                        <?php 
                                        if($t_data['use_status']==0){ 
                                            $right_link=base_url("register?pin=$pin");
                                            ?>
                                           
                                        <td data-type="email"><?= $t_data['pin'];?><button data-type="copy"><i class="fa fa-copy"></i></button>
                                       
                                        <a href="<?php echo $right_link; ?>" target="_blank" >
											
                            						<i class="fa fa-link" style="color: #fff; font-size: 18px;"></i>
                            				</a>
                                        </td>
                                        
                                        <?php
                                        }else{
                                        ?>
                                           <td><?= $t_data['pin'];?></td>
                                        <?php
                                        }
                                        ?>
                                        <td><?= $t_data['used_in'];?></td>   
                                        <td><?= $t_data['pin_type'];?></td>  
                                        <td>
                                            <?php if($t_data['use_status']==0){ ?>
                                                 <?php    
                                                }else{
                                                 echo ($tx_profile ? $tx_profile->username:'');
                                                  } ?>
                                        </td>               
                                        <td><?= $t_data['added_on'];?></td>         
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>

                           

                            </tbody>
                       </table>
                        
                   </div> 
               </div> 
            
       </div>
    </div>

 <?php 
                
                echo $this->pagination->create_links();?>

</div>
</div>
<br>
<br>
<script>
document.querySelectorAll('button[data-type="copy"]')
  .forEach(function(button){
      button.addEventListener('click', function(){
      let email = this.parentNode.parentNode
        .querySelector('td[data-type="email"]')
        .innerText;
      
      let tmp = document.createElement('textarea');
          tmp.value = email;
          tmp.setAttribute('readonly', '');
          tmp.style.position = 'absolute';
          tmp.style.left = '-9999px';
          document.body.appendChild(tmp);
          tmp.select();
          document.execCommand('copy');
          document.body.removeChild(tmp);
          console.log(`${email} copied.`);
    });
});

</script>