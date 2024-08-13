<?php
class Product extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){
        
        $this->show->user_panel('product/product_list');
    }
    
    public function cart(){
        
        $this->show->user_panel('product/cart');
    }
    
    
    public function checkout(){
        $u_code=$this->session->userdata('user_id');
        if(isset($_POST['continue_btn'])){
           
            $this->form_validation->set_rules('shipping[name]', 'Name', 'required');
            $this->form_validation->set_rules('shipping[email]', 'Email', 'required');
            $this->form_validation->set_rules('shipping[address1]', 'Address', 'required');
            $this->form_validation->set_rules('shipping[mobile]', 'Phone', 'required');
            $this->form_validation->set_rules('shipping[city]', 'City', 'required');
            $this->form_validation->set_rules('shipping[postcode]', 'Postcode', 'required');
            $this->form_validation->set_rules('shipping[pan_no]', 'Pan No', 'required');
           // $this->form_validation->set_rules('shipping[selected_wallet]', 'Selected Wallet', 'required|callback_check_wallet_balance');
            
            
            //$upload_product=$this->payment_validations();
            
            
            //$upload_product=$this->upload_file->upload_image('slip');
            if($this->form_validation->run() != false){  //&& $upload_product['error']==false){
                $shipping=json_encode($_POST['shipping']);
                $shipping_post=$_POST['shipping'];
                $order_arr['order_address']=$shipping;
                $order_arr['tx_type']='purchase';
                $order_arr['u_code']=$u_code;
                //$order_arr['utr_no']=$_POST['utr_no'];
                $order_arr['payout_id'] = $this->wallet->currenct_payout_id();
                $order_arr['invoice_no'] = $this->wallet->currenct_invoice_no();
                $order_arr['order_amount'] = $total=$this->cart->total();
                $order_arr['order_bv'] = $totalbv=$this->cart->totalbv();
                $order_arr['pv'] = 1;
                $order_arr['payment_status'] = 1;
                $order_arr['status'] = 1;
                
                /*if(array_key_exists('full_path',$upload_product)){
                    $order_arr['payment_response'] = $upload_product['full_path'];
                }*/
                $balance=$this->update_ob->wallet($this->session->userdata('user_id'),'main_wallet');
                if($balance>=$total){
                $order_arr['order_details']=json_encode($this->cart->contents());
                $odr_id=$this->placeOrder($order_arr,$u_code);
                if($odr_id){
                    
                    
                     $update=array(
                        'active_status' => 1,
                        'active_date' => date('Y-m-d H:i:s'),
                    );
                    $this->db->where('id',$u_code);
                    $this->db->update('users',$update);
                    
                    
                    
                    
                    $this->update_ob->add_amnt($this->session->userdata('user_id'),'main_wallet',-$total);
                    
                    if($this->conn->setting('level_distribution_on_topup')=='yes'){
                        $this->distribute->level_destribute($u_code,$totalbv,5);
                    }
                    
                    $sponsor_info=$this->profile->sponsor_info($u_code,'mobile,id');
                        
                        if($sponsor_info){
                            $sponsor_mobile = $sponsor_info->mobile;
                            $tx_profile_info=$this->profile->profile_info($u_code,'name');
                            $tx_name=$tx_profile_info->name;
                            $website=$this->conn->company_info('title');
                            $msg="Congratulations!! $tx_name Has activated his Position. Team $website";
                            //$this->message->sms($sponsor_mobile,$msg);
                            $this->update_ob->active_gen($sponsor_info->id);
                            $this->update_ob->active_direct($sponsor_info->id);
                        }
                        
                        $this->update_ob->update_binary($sponsor_info->id);
                    
                    
                    $this->session->set_userdata('new_order_id',$odr_id);
                    
                    $panel_path=$this->conn->company_info('panel_path');
                    $this->session->set_flashdata("success", "Order placed successfully.");
                    redirect(base_url($panel_path.'/product/order_success'));
                    
                    
                }
                
                }else{
                    $this->session->set_flashdata("error", "Insufficient Fund in wallet.");
                    
                }
            }else{
                $this->session->set_flashdata("error", "Something wrong.");
            } 
        }
        
        
        $this->show->user_panel('product/checkout');
    }
    
    
    function placeOrder($ordData,$u_code){       
       
        $insertOrder = $this->conn->get_insert_id('orders',$ordData);
        
        if($insertOrder){
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();
            
            // Cart items
            $ordItemData = array();
            $i=0;
            
            foreach($cartItems as $item){
                //$ordItemData[$i]['franchise_id']     = $f_code;
                $ordItemData[$i]['u_code']     = $u_code;
                $ordItemData[$i]['order_id']     = $insertOrder;
                $ordItemData[$i]['product_id']     = $item['id'];
                $ordItemData[$i]['name']     = $item['name'];
                $ordItemData[$i]['quantity']     = $item['qty'];
                $ordItemData[$i]['product_bv']     = $item['bv'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $ordItemData[$i]['options']     =  array_key_exists('options',$item) ? json_encode($item["options"]):null;
                $i++;
            }
            
            if(!empty($ordItemData)){
                // Insert order items
                $insertOrderItems = $this->db->insert_batch('order_items',$ordItemData);
                
                if($insertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    
                    // Return order ID
                    return $insertOrder;
                }
            }
        }
        return false;
    }
    
    
    
    public function payment_validations(){
        $validations['error']=false;
        
        $this->form_validation->set_rules('product_prm', 'Payment method', 'required');
        if($_POST['product_prm']!='' && $_POST['product_prm']=='prm'){
            
            $this->form_validation->set_rules('prm', 'Payment Type.', 'required');
            if($_POST['prm']!='' && $_POST['prm']!='gateway' && $_POST['prm']!='crypto'){
                $this->form_validation->set_rules('utr_no', 'UTR No.', 'required');
                $prm['upload_path']='payment_slip';
                $upload_product=$this->upload_file->upload_image('slip',$prm);
                if($upload_product['upload_error']==false){
                    $validations['full_path'] = $upload_product['full_path'];
                }else{
                    $validations['error'] = $upload_product['display_error'];
                }
                
            }
            if($_POST['prm']!='' && $_POST['prm']=='gateway'){
                $this->form_validation->set_rules('prm_option', 'Payment Option', 'required');
            }
        }
        
        return $validations;
        
    }
    
    
    public function order_success(){
        
        $this->show->user_panel('product/order_success');
    }
    
    
    
    public function add_to_cart(){
        $err['error']=false;
        $pro_id=$_POST['productId'];
        $qty=$_POST['qty'];
        $user_id=$this->session->userdata('user_id');
        
        
        
            $product_details=$this->product->product_detail($pro_id);
        
            $required_fielsa=$this->conn->runQuery('*','product_variants',"post_id='$pro_id'");
            if(!$required_fielsa){
                $product_stock=$this->product->product_stock($pro_id);
                if($product_stock>=$qty){
                    $data = array(
                        "id"         => $_POST['productId'],
                        "name"       => $product_details->name,
                        "qty"        => $qty,
                        "price"      =>   $product_details->dp,           
                        "mrp"      =>   $product_details->mrp,           
                        "bv"      =>   $product_details->product_bv,
                        "sku"      =>   'product_qty',
            		);
                    $this->cart->insert($data); 
                }else{
                    $err['error']=true;
                    $err['message'] = "Out of Stock";
                }
            }else{
                
                $sku='';
                
               
                foreach($required_fielsa as $required_field){
                   
                    if(!isset($_REQUEST[$required_field->slug])){
                        $err['error']=true;
                        $err['message'][$required_field->slug] = "Required";
                         
                        //$this->form_validation->set_message($required_field->slug, "Field required");
                    }else{
                        $sku=$_REQUEST[$required_field->slug].'-';
                    }
                }
                $sku=rtrim($sku,"-");
                //print_r($err);
                 
                $product_stock=$this->product->product_stock($pro_id,$sku);
                if($product_stock>=$qty && $err['error']===false){
                    $data = array(
                        "id"         => $_POST['productId'],
                        "name"       => $product_details->name,
                        "qty"        => $qty,
                        "price"      =>   $product_details->dp,           
                        "mrp"      =>   $product_details->mrp,           
                        "bv"      =>   $product_details->product_bv,
                        "sku"      =>   $sku,
                         
            		);
                    $this->cart->insert($data); 
                }
            }
      //  }
        print_r(json_encode($err));
		//$this->session->set_flashdata("alert_success", "Product successfully added to cart.");
    }
    public function update(){
        $err['error']=false;
	    $table_data=$this->cart->contents();
	    $rowid=$_POST['rowid'];
	    $qty=$_POST['qty'];
	    
	    $product_id=$_POST['productId'];
	    //$product_name=$table_data[$rowid]['name'];
	    //$franchise_id=$this->session->userdata('franchise_id');
        
        $left_sale=$this->product->product_stock($product_id);
	    if($left_sale>=$qty){
	        $data = array(
    			'rowid' =>  $rowid,
    			'qty'   => $qty
		    );
		    $this->session->set_flashdata('success', 'You have modified your shopping cart!');
		    $this->cart->update($data);
		    $err['error']=false;
	    }else{
	        $err['error']=true;
            $err['message'] = "Out of Stock";
	        //$this->session->set_flashdata('error', "You have $left_sale $product_name in stock!");
		    
	    }
	     print_r(json_encode($err));
	 }
	 public function remove(){
		 $data = array(
			'rowid' =>  $_POST['rowid'],
			'qty'   => 0
		 );
		 $this->session->set_flashdata('success', 'You have modified your shopping cart!');
		 $this->cart->update($data);
		 $this->db->empty_table('form_request'); 
		 
	 }
	 
	   public function user_order(){ 
        $searchdata['from_table']='orders';
        //$conditions['tx_type'] ='purchase';
        $conditions['u_code'] = $this->session->userdata('user_id');
        if(isset($_REQUEST['name']) && $_REQUEST['name']!=''){
            $spo=$this->profile->column_like_franchise($_REQUEST['name'],'name');
            if($spo){
                $conditions['tx_user_id'] = $spo;
            }
        }
        if(isset($_REQUEST['username']) && $_REQUEST['username']!=''){
            $spo=$this->profile->column_like_franchise($_REQUEST['username'],'username');
            if($spo){
                $conditions['tx_user_id'] = $spo;
            }
        }
        if(isset($_REQUEST['franchise_name']) && $_REQUEST['franchise_name']!=''){
            $spo=$this->profile->column_like_franchise($_REQUEST['franchise_name'],'franchise_name');
            if($spo){
                $conditions['tx_user_id'] = $spo;
            }
        }
        if(isset($_REQUEST['start_date']) && isset($_REQUEST['end_date']) && $_REQUEST['start_date']!='' && $_REQUEST['end_date']!='' ){
			$start_date=date('Y-m-d 00:00:00',strtotime($_REQUEST['start_date']));
			$end_date=date('Y-m-d 23:59:00',strtotime($_REQUEST['end_date']));
			$where="(`added_on` BETWEEN '$start_date' and '$end_date')";
            $searchdata['where'] = $where;
		}
        
        if(!empty($likeconditions)){
            $searchdata['likecondition'] = $likeconditions;
        }
        if(!empty($conditions)){
            
            $searchdata['conditions'] = $conditions;
        }
        $data = $this->paging->search_response($searchdata,$this->limit,$this->panel_url.'/product/user_order');
        $this->show->user_panel('user_order',$data);
    }
   
    public function check_wallet_balance($str){
        $checkable=$total;//=$this->cart->total();
       
            $balance=$this->update_ob->wallet($this->session->userdata('user_id'),'main_wallet');        
            if($balance>=$checkable){
                return true;
            }else{
                $this->form_validation->set_message('check_wallet_balance', "Insufficient Fund in wallet.");
                return false;
            }
      
        
    }
    
}
