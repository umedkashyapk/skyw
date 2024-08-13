<?php
class Payment_model extends CI_Model{
   
     public function payment_success($payment_id){
         $ret=false;
         $get_data=$this->conn->runQuery('*','capture_payments',"id='$payment_id' and payment_status='0'");
         if($get_data){
            $this->db->set('payment_status',1);
            $this->db->where('id',$payment_id);
            $this->db->where('payment_status',0);
            $this->db->update('capture_payments');
                 
             $u_code=$get_data[0]->u_code;
             $used_to=$get_data[0]->used_to;
             $data=json_decode($get_data[0]->data,true);
             if($used_to=='topup'){
                 $ret=$this->action->topup($u_code,$data);
                 $this->db->set('apply_status',1);
                 $this->db->where('id',$payment_id);
                 $this->db->where('apply_status',0);
                 $this->db->update('capture_payments');
             }
         }
         return $ret;
     }
     
     
     public function payment_cancel($payment_id)
    {
        // Get the transaction ID and user ID from the request
        $txn_id = $this->input->post('txn_id');
        $u_id = $this->input->post('u_id');
    
        // Validate the inputs
        if (empty($txn_id) || empty($u_id)) {
            $res['res'] = 'error';
            $res['message'] = 'Transaction ID or User ID is missing!';
            print_r(json_encode($res));
            return;
        }
    
        // Check the transaction status
        $transaction = $this->conn->runQuery('*', 'transaction', "tx_record='$txn_id' AND u_code='$u_id'");
        if ($transaction) {
            $tr_data = $transaction[0];
            $status = intval($tr_data->status);
    
            // If the transaction is not successful
            if ($status == 0) {
                $order_amount = $tr_data->order_amount;
                
                // Refund the amount to the user
                $this->payment->add_amnt($u_id, "refund", $order_amount);
    
                // Update the transaction status to cancelled
                $update = array('status' => 2); // Assuming status 2 is for cancelled transactions
                $this->db->where('tx_record', $txn_id);
                $this->db->update('transaction', $update);
    
                $res['res'] = 'success';
                $res['message'] = 'Payment has been successfully cancelled and refunded.';
            } else {
                $res['res'] = 'error';
                $res['message'] = 'Transaction is already processed or cancelled.';
            }
        } else {
            $res['res'] = 'error';
            $res['message'] = 'Invalid transaction ID or user ID.';
        }
    
        print_r(json_encode($res));
    }
    
    
    // public function add_amnt($u_id, $type, $amount)
    // {
    //     // Get the current balance
    //     $current_balance = $this->conn->runQuery('balance', 'users', "id='$u_id'")[0]->balance;

    //     // Update the balance
    //     if ($type == "refund") {
    //         $new_balance = $current_balance + $amount;
    //     } else if ($type == "offset") {
    //         $new_balance = $current_balance - $amount;
    //     }

    //     // Save the new balance
    //     $this->db->set('balance', $new_balance);
    //     $this->db->where('id', $u_id);
    //     $this->db->update('users');
    // }
    

}
