<?php
class Cart extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        /*print_r($_SESSION['cart_contents']);
        die();*/
        $this->show->main('cart',array());
        
       // $cartcon=$this->cart->contents();
        //print_r($cartcon);
    }
    
     public function add_to_cart(){
        
        $err['error']=false;
         $pro_id=$_POST['productId'];
          $qty=$_POST['productQty'];
       
    	/*$u_code=$this->session->userdata("admin_id");
        $csrf_test_name=json_encode($_POST);

        $check_ex=$this->conn->runQuery('id','form_request',"request='$csrf_test_name' and u_code='$u_code'");
        if($check_ex){
            $err['error']=true;
            $err['message'] = "You can not submit same request within 5 minutes.";
            
            //$this->session->set_flashdata("error", "You can not submit same request within 5 minutes.");
        }else{
            $request['u_code']=$u_code;
            $request['request']=$csrf_test_name;
            $this->db->insert('form_request',$request);*/
            $product_details=$this->product->product_detail($pro_id);
           
            
            $required_fielsa=$this->conn->runQuery('*','product_variants',"post_id='$pro_id'");
           
            if(!$required_fielsa){
              
               $product_stock=$this->product->product_stock($pro_id);
               
                if($product_stock>=1){
                  
                    $data = array(
                        "id"         => $_POST['productId'],
                        "name"       => $product_details->name,
                        "qty"        => $qty,
                        "price"      =>   $product_details->dp,           
                        "mrp"      =>   $product_details->mrp,           
                        "bv"      =>   $product_details->product_bv,
                        "sku"      =>   'product_qty',
                        "pv"      =>   $product_details->pv,
                        
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
               
                $product_stock=$this->product->product_stock($pro_id,$sku);
               
                if($product_stock>=1 && $err['error']===false){
                    $data = array(
                        "id"         => $_POST['productId'],
                        "name"       => $product_details->name,
                        "qty"        => $qty,
                        "price"      =>   $product_details->dp,   
                        "mrp"      =>   $product_details->mrp,
                        "bv"      =>   $product_details->product_bv,
                        "sku"      =>   $sku,
                        "pv"      =>   $product_details->pv,
                         
            		);
                    $this->cart->insert($data); 
                }
            }
            
       // }          
                    
        
        
        print_r(json_encode($err));
		//$this->session->set_flashdata("alert_success", "Product successfully added to cart.");
    }
	
    public function add_to_cart_old(){
       $res['error']=true;
      // if(isset($_POST['size']) && $_POST['size']!=''){
           
       
           $productId=$_POST['productId'];
           
           //$pending=$this->product->available_by_size($productId,$_POST['size']);
            //if($pending>=$_POST['productQty']){
                $product_details=$this->product->product_detail($productId);
                $img=$product_details->imgs;
                $productName=$product_details->name;
                $productPrice=$product_details->dp;
                $product_bv=$product_details->product_bv;
                $data = array(
                    "u_code"    =>($this->session->has_userdata('user_id') ? $this->session->userdata('user_id'):''),
                    "img"         => base_url('images/products/'.$img),
                    "id"         => $productId,
                    "name"       => $productName,//,
                    "qty"        => $_POST['productQty'],
                    "price"      => $productPrice,
                    "bv"      => $product_bv,
        		);
        		
        		//$options['Size']=$_POST['size'];
        		//$data['options']=$options;
        		
        	 	$this->cart->insert($data);
        
        		//print_r($data);
        		$this->session->set_flashdata("alert_success", "Product successfully added to cart.");
    		    $res['error']=false;
            /*}else{
                $res['msg']="Out of stock.";
            }*/
           
           
       /*}else{
           $res['msg']="Please select size.";
       }*/
       print_r(json_encode($res));
    }
    
   public function cart_destroy(){
        
          $this->cart->destroy();
          redirect(base_url().'/cart');
    }
    public function remove(){		
		 $data = array(
			'rowid' =>  $_POST['rowid'],
			'qty'   => 0
		 );
		 $this->session->set_flashdata('update_cart', 'You have modified your shopping cart!');
		 $this->cart->update($data);
	 }
    
    public function update_all(){		
		//print_r($_POST);
		$data=$this->cart->update($_POST);
		$this->session->set_flashdata('update_cart', 'You have modified your shopping cart!');
		redirect(base_url().'/cart');
	}
	
	public function update(){		
		 $data = array(
			'rowid' =>  $_POST['rowid'],
			'qty'   => $_POST['qty']
		 );
		 $this->session->set_flashdata('update_cart', 'You have modified your shopping cart!');
		 $this->cart->update($data);
	 }
    
}
