<?php
class Product_model extends CI_Model{
    
    public function new_items($limit){
        
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit);
        $res=$this->db->get('products');
        if($res->num_rows()>0){
          return  $res->result();
        }else{
            return FALSE;
        }
         // print_r($this->db->last_query());
    }
    
    public function trending_items($limit){
        
        $this->db->order_by('views', 'DESC');
        $this->db->limit($limit);
        $res=$this->db->get('products');
        if($res->num_rows()>0){
          return  $res->result();
        }else{
            return FALSE;
        }
       //   print_r($this->db->last_query());
    }

	public function best_seller_items($limit){        
        $this->db->order_by('purchases', 'DESC');
        $this->db->limit($limit);
        $res=$this->db->get('products');
        if($res->num_rows()>0){
          return  $res->result();
        }else{
            return FALSE;
        }
       //   print_r($this->db->last_query());
    }
    public function daily_deal_items($limit){
        $date=date('Y-m-d H:i:s');
		    $this->db->where("available > '0' and till_time>'$date'");
        $this->db->order_by('available DESC, till_time ASC');		
        $this->db->limit($limit);
        $res=$this->db->get('daily_deals');
        if($res->num_rows()>0){
          return  $res->result();
        }else{
            return FALSE;
        }
          // print_r($this->db->last_query());
    }
    
    public function available_by_size($p_id,$size){
        $avl=0;
        $get_total=$this->conn->runQuery('value','product_sizes',"post_id='$p_id' and slug='$size'");
        if($get_total){
            $ttl=$get_total[0]->value;
            
            $paid_arr=$this->conn->runQuery('SUM(quantity) as amnt','order_items',"product_id='$p_id'")[0]->amnt;
            $paid=$paid_arr!='' ? $paid_arr:0;
            $avl=$ttl-$paid;
            
        }
        return $avl;
    }
    
    public function top_rated_items($limit){       
      $this->db->order_by('review_rate', 'DESC');
      $this->db->limit($limit);
      $res=$this->db->get('products');
      if($res->num_rows()>0){
        return  $res->result();
      }else{
          return FALSE;
      }
     //   print_r($this->db->last_query());
  }

     public function product_detail($id){        
        $res=$this->conn->runQuery('*','products',array('id'=>$id));
        if($res){
          $resp=$res[0];
          $categories=$this->product_categories($id,array('returnType'=>'string'));
          $resp->categories=($categories ? $categories :'');
            return $resp;
        }else{
             return false;
        }        
    }   
     public function related_items($pr_id,$limit){

      $ret=false;
        $pro_details=$this->product_detail($pr_id);

        $cat_res=$this->product->product_categories($pr_id);
        if($cat_res){
          $implode=implode(',',$cat_res);
          $allids=$this->conn->runQuery('post_id','manage_data',"param_id IN ($implode)");
          if($allids){
            $get1=array_column($allids,'post_id');
            $this->db->where_in('id',$get1);
            $this->db->where("status='1' and qty > '0'");
            $this->db->order_by(' `views` DESC, `purchases` DESC, `qty` DESC, `id` DESC');		
            $this->db->limit($limit);
            $res=$this->db->get('products');
            if($res->num_rows()>0){
              return  $res->result();
            }
          }
        }
		
		    
          // print_r($this->db->last_query());
    }
    
    public function product_categories($product_id,$data=array()){
     $return = false;

     if(is_array($product_id)){
           $implodes=implode(',',$product_id);
           $whr = "type='product_category' and status=1 and post_id IN ($implodes)";
      }else{
        $whr=array(
          'type' => 'product_category',
          'post_id' => $product_id ,
          'status' => 1 ,
        );
      }

      
      $res=$this->conn->runQuery('param_id','manage_data',$whr);
      if($res){
          if(array_key_exists("returnType", $data)){
            if($data['returnType']=='count'){
              $return=count($res);
            }            
            if($data['returnType']=='string'){              
              $get=array_column($res,'param_id');
              $imp=implode(',',$get);  
              $get_arr=$this->conn->runQuery('name','categories',"id IN ($imp)");
              if($get_arr){
                $get1=array_column($get_arr,'name');
                $return=implode(', ',$get1);
              }
            }            
          }else{            
                $return=array_column($res,'param_id');            
          }
       }
      return $return;
    }

    public function category_products($cat_id,$data=array()){
     $return = false;
      $this->db->select('post_id');
      $this->db->where('type','product_category');
      $this->db->where('status',1);
     if(is_array($cat_id)){
        $this->db->where_in('param_id',$cat_id);
     }else{
        $this->db->where('param_id',$cat_id);
     }

      $resp=$this->db->get('manage_data');
      if($resp->num_rows()>0){
         $res = $resp->result_array();
        if(array_key_exists("returnType", $data)){
          if($data['returnType']=='count'){
            $return=count($res);
          }else{
            $return=array_column($res,'post_id');
          }                     
        }else{            
              $return=array_column($res,'post_id');            
        }
      }       
      return $return;
    }

    public function add_view($productID){
      $views=$this->product_detail($productID)->views;
      $set=array(
        'views'=> $views+1,
      );
      $this->db->update('products',$set," id='$productID'");
    }
    
    public function insertOrderItems($data = array()) {
        
      // Insert order items
      $insert = $this->db->insert_batch('order_items', $data);

      // Return the status
      return $insert?true:false;
  }

  public function getOrder($id){ 
    
    // Get order items
    $this->db->select('i.*,  p.*');
    $this->db->from('order_items as i');
    $this->db->join('products as p', 'p.id = i.product_id', 'left');
    $this->db->where('i.order_id', $id);
    $query2 = $this->db->get();
    $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
    
    // Return fetched data
    return !empty($result)?$result:false;
}

    public function child_categories($cat_id){
      $this->db->select('id');
      $this->db->where('status',1);
      $this->db->where('type','cat');

        if(is_array($cat_id)){
          $this->db->where_in('parent_id',$cat_id);
        }else{          
          $this->db->where('parent_id',$cat_id);

        }

        $query2 = $this->db->get('categories');
        $res = ($query2->num_rows() > 0) ? $query2->result_array():array();
        return (!empty($res) ? array_column($res,'id'):false);
    }

    public function category_details($cat_id){
      $res=$this->conn->runQuery('*','categories',array('id'=>$cat_id));
        return ($res ? $res[0]:false);   
    }

    public function category_options($id,$params=array(),$res='',$scp=''){
      $categoriess=$this->child_categories($id);
      $selected='';
      $category_id='';
      if(array_key_exists("selected", $params)){
        $selected=$params['selected'];
      }
      if(array_key_exists("category_id", $params)){
        $category_id=$params['category_id'];
      }

      if($categoriess){
          foreach($categoriess as $categorys){
           $super_category=$this->category_details($categorys);
           $categories2=$this->child_categories($categorys);
           
           if($category_id!=$super_category->id){
              $res .='<option value="'.$super_category->id.'"  '.($selected==$super_category->id ? 'Selected':'').'>'.$scp.$super_category->name.'</option>';
           }
            

            if($categories2){
              $scp .="&nbsp;&nbsp;&nbsp;&nbsp;";           
              $res = $this->category_options($categorys,$params,$res,$scp);
              $scp="";
            }

          }
      }

      return $res;
    }

    
    public function shipping_charges($afterdis){
        switch ($afterdis) {
                  case $afterdis<=10000:
                    $shipping_chrg=300;
                    break;
                  case $afterdis> 10000 && $afterdis<=50000:
                    $shipping_chrg=999;
                    break;
                  case $afterdis> 50000 && $afterdis<=99999:
                    $shipping_chrg=1399;
                    break;
                  default:
                     $shipping_chrg=300;
                }
                return $shipping_chrg;
    }
    
    public function rates($subtotal){
        
        $gst_per=12;
        
        //$rates['Sub Total']=$subtotal;
        //$rates['GST']=$gst=$subtotal*$gst_per/100;
        //$rates['Net amount']=$net_amnt=$subtotal;//+$gst;
        //$rates['Shipping charges']=$shpng=$this->shipping_charges($net_amnt);
        $rates['Total']=$subtotal;
        return $rates;
    }
    
    function combinations($arrays, $i = 0) {
      if (!isset($arrays[$i])) {
          return array();
      }
      if ($i == count($arrays) - 1) {
          return $arrays[$i];
      }
  
      // get combinations from subsequent arrays
      $tmp = $this->combinations($arrays, $i + 1);
  
      $result = array();
  
      // concat each array from tmp with each element from $arrays[$i]
      foreach ($arrays[$i] as $v) {
          foreach ($tmp as $t) {
              $result[] = is_array($t) ? 
                  array_merge(array($v), $t) :
                  array($v, $t);
          }
      }
      
      $res=array();
      if(!empty($result)){
        foreach($result as $resul){
          if(is_array($resul)){
            $res[] = implode('-',$resul);
          }
        }
      }
      return $res;
  }

 
  
  public function admin_stock($productID,$sku=''){
      $whr='';
      if($sku!=''){
          $whr= " AND sku='$sku'";
      }
    
    $get_stock=$this->conn->runQuery('SUM(qty) as stk','product_skus',"post_id='$productID' $whr")[0]->stk;
    $ttl=$get_stock!='' ? $get_stock:0;
    
    $sale_stk=$this->conn->runQuery('SUM(quantity) as stk','franchise_order_items',"product_id='$productID' $whr")[0]->stk;
    $sale=$sale_stk!='' ? $sale_stk:0;
    return $ttl-$sale;
  }
  
  
   public function company_admin_stock($productID,$sku=''){
      $whr='';
      if($sku!=''){
          $whr= " AND sku='$sku'";
      }
    
    $get_stock=$this->conn->runQuery('SUM(qty) as stk','product_skus',"post_id='$productID' $whr")[0]->stk;
    $ttl=$get_stock!='' ? $get_stock:0;
    return $ttl;
  }
  public function product_stock($productID,$sku=''){
      $whr='';
      if($sku!=''){
          $whr= " AND sku='$sku'";
      }
    
    $get_stock=$this->conn->runQuery('SUM(qty) as stk','product_skus',"post_id='$productID' $whr")[0]->stk;
    $ttl=$get_stock!='' ? $get_stock:0;
    
    $sale_stk=$this->conn->runQuery('SUM(quantity) as stk','franchise_order_items',"product_id='$productID' $whr")[0]->stk;
    $sale=$sale_stk!='' ? $sale_stk:0;
    
    $sale_usr=$this->conn->runQuery('SUM(quantity) as stk','order_items',"product_id='$productID' $whr")[0]->stk;
    $sale_usra=$sale_usr!='' ? $sale_usr:0;
    return $ttl-$sale-$sale_usra;
  }
  
  public function franchise_stock($f_code,$productID,$sku=''){
      $whr='';
      if($sku!=''){
          $whr= " AND sku='$sku'";
      }
    
    $ttl_stk=$this->conn->runQuery('SUM(quantity) as stk','franchise_order_items',"f_code='$f_code' and product_id='$productID' $whr")[0]->stk;
    $ttl=$ttl_stk!='' ? $ttl_stk:0;
    
    $sale_usr=$this->conn->runQuery('SUM(quantity) as stk','order_items',"franchise_id='$f_code' and product_id='$productID' $whr")[0]->stk;
    $sale=$sale_usr!='' ? $sale_usr:0;
    
    return $ttl-$sale;
  }
  
  
  public function fetch_order_bill($order_id){
     
        
        $order_details=$this->conn->runQuery('*','orders',"id='$order_id'");
       
        $u_code=$order_details[0]->u_code;
        $order_ids=$order_details[0]->id;
        $order_ids=$order_details[0]->id;
        $total_order_amt=$order_details[0]->order_amount;
        $total_order_bv=$order_details[0]->order_bv;
        $users_details=$this->conn->runQuery('*','users',"id='$u_code'")[0];
        $pkg_details1=$this->conn->runQuery('*','order_items',"order_id='$order_ids'");

           ?>
          <div class="row pt-2 pb-2">
        <div class="col-sm-9">
		    <h4 class="page-title">  Ordersss Bill </h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= $admin_path.'dashboard';?>">home</a></li>            
            <li class="breadcrumb-item"><a href="#"> Order</a></li>            
            <li class="breadcrumb-item"><a href="#"> Bill</a></li>            
            <li class="breadcrumb-item active" aria-current="page">  Order Bill </li>
         </ol>
	   </div>
	   <div class="col-sm-3">
       
     </div>
</div>
<h6 class="text-uppercase"> Order Bill</h6>
<hr>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<center>
		<a href="" class="btn btn-success" onclick='printDiv();' title="Print Form"><i class="fa fa-print"></i></a>
		</center>
		
		
		<div id="DivIdToPrint">
			
			<style>
				.invoice-box {
					max-width: 800px;
					margin: auto;
					padding: 30px;
					border: 1px solid #eee;
					box-shadow: 0 0 10px rgba(0, 0, 0, .15);
					font-size: 16px;
					line-height: 24px;
					font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
					color: #555;
				}
    
				.invoice-box table {
					width: 100%;
					line-height: inherit;
					text-align: left;
				}
				
				.invoice-box table td {
					padding: 5px;
					vertical-align: top;
				}
    
				.invoice-box table tr td:nth-child(2) {
					text-align: right;
				}
    
				.invoice-box table tr.top table td {
					padding-bottom: 20px;
				}
				
				.invoice-box table tr.top table td.title {
					font-size: 45px;
					line-height: 45px;
					color: #333;
				}
    
				.invoice-box table tr.information table td {
					padding-bottom: 40px;
				}
				
				.invoice-box table tr.heading td {
					background: #eee;
					border-bottom: 1px solid #ddd;
					font-weight: bold;
				}
    
				.invoice-box table tr.details td {
					padding-bottom: 20px;
				}
				
				.invoice-box table tr.item td{
					border-bottom: 1px solid #eee;
				}
				
				.invoice-box table tr.item.last td {
					border-bottom: none;
				}
				
				.invoice-box table tr.total td:nth-child(2) {
					border-top: 2px solid #eee;
					font-weight: bold;
				}
				
				@media only screen and (max-width: 600px) {
					.invoice-box table tr.top table td {
						width: 100%;
						display: block;
						text-align: center;
					}
								
					.invoice-box table tr.information table td {
						width: 100%;
						display: block;
						text-align: center;
					}
				}
    
				/** RTL **/
				.rtl {
					direction: rtl;
					font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				}
    
				.rtl table {
					text-align: right;
				}
				
				.rtl table tr td:nth-child(2) {
					text-align: left;
				}
    </style>
		
         <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="6">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?= $this->conn->company_info('logo');?>" style="width:<?= $this->conn->company_info('logo_width');?>;height:<?php echo $this->conn-> company_info('logo_height');?>" alt="<?php echo $this->conn->company_info('company_name');?>">
                            </td>
                            
                            <td>
                                Invoice #: <?php echo $order_details[0]->invoice_no;?><br>
                                Bill Date: <?php echo date('M d,Y ',strtotime($order_details[0]->added_on));?><br>
                               
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="6">
                    <table>
                        <tr>
                            <td>
							<?php

							echo '<strong>'.$this->conn->company_info('company_name').'</strong><br>';
							echo 'Email : '.$this->conn->company_info('company_email').'<br>';
							echo 'Mobile : '.$this->conn->company_info('company_mobile').'<br>';
							echo 'Website : '.$this->conn->company_info('base_url').'<br>';
							
							
						$order_address=	json_decode($order_details[0]->order_address,true);
							
							?>
							
                               
                            </td>
                            
                            <td>
						
							<strong><b>Shipping Info</b></strong><br>
                               <?php echo 'Name :'.$order_address['first_name'];?><br>
                               <?php echo 'Mobile :'.$users_details->mobile;?><br>
                               <?php echo 'Email :'.$order_address['email'];?><br>
                               <?php echo 'Address :'.$order_address['address'].' '.$order_address['address2'];?><br>
                               <?= $order_address['State'].' '.$order_address['zip'];?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <!--<tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td colspan="6">
                    Amount #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                   <?php $wt_type=$get_order_detail['wallet_type'];
				   if($wt_type=="transaction"){
					   $utr_nos=$get_order_detail['utr_no'];
					   echo "Transaction Id:".$utr_nos;
				   }else{
					   echo "Wallet";
				   }
				   ?>
                </td>
                
                <td colspan="6">
                   <?php echo $this->conn->company_info('currency');?> <?php echo $get_order_detail['order_total_amount'];?>
                </td>
            </tr>
            -->
            <tr class="heading">
                <td>
                    Sr No
                </td>
                <td class="text-left">
                    Product Name
                </td>
               
                
				 <td class="text-right">
                   Qty
                </td>
                <td class="text-right">Unit BV</td>
				<td class="text-right">
                   Total Price (<?php echo $this->conn->company_info('currency');?>)
                </td>
            </tr>
            <?php 
            $sr=0;
            foreach($pkg_details1 as $pkg_details2){
            
            ?>
            <tr class="item" >
                <td >
			 
                    <?php echo $sr+1;?>
					 
                </td>
                <td class="text-left" >
				 
                    <?php echo $pkg_details2->name;?>
					 
                </td >
                 
				<td class="text-right">
								 
                    <?php echo $pkg_details2->quantity;?>
								 
                </td>
                <td class="text-right">				 
                    <?php echo $pkg_details2->product_bv;?>
								 
                </td>
				 <td class="text-right">			 
                    <?php echo $pkg_details2->sub_total;?>
								 
                </td>
               
            </tr>
            <?php 
                $sr++;
                
            }
            
            ?>
          
            
            <tr class="total">
                <td></td>
               

                <td colspan="5">
                    	
                   Total Amount:<?php echo $this->conn->company_info('currency');?> <?php echo  $total_order_amt=$order_details[0]->order_amount;?><br>
               
			
					Total BV : <?php echo $total_order_bv=$order_details[0]->order_bv;?>
			
				 <br> <br><br> <br>
				 
				 Authorised Signatory
				 
				</td>
				
				
            </tr>
            <tr class="total">
                <td colspan="12">
             <center>More Information Visit <?= $this->conn->company_info('base_url');?><center></td>
           </tr>
        </table>
    </div>
		
 </div>
   
    </div>
</div>
 <script>

////////////////div print function /////////////////////////
//////////btn onclick  call this function ////////

function printDiv(){

  var divToPrint=document.getElementById('DivIdToPrint'); ////////////  <- div id /////////////

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
  ///////////////////////// end function //////////
</script>
 
           
           
           <?php  
    }
  
}

