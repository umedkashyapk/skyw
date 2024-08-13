<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Reward extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $key_data2 = $this->conn->runQuery('*', 'api_key', "key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;
    }

    public function index()
    {
        if (isset($_POST['u_id'])) {
            $user_id = $_POST['u_id'];
            // $new_achieve = $this->goal->rank($user_id);
            $user_detailss = $this->conn->runQuery('rank_id', 'users', "id='$user_id'");
            $my_rank_id = $user_detailss[0]->rank_id;

            $plan_details = $this->conn->runQuery('rank,id', 'plan', "id<=10");
            if ($plan_details) {

                $sr = 1;
                foreach ($plan_details as $plan_details1) {
                    $rankid = $plan_details1->id;
                    $detailss = json_decode(json_encode($plan_details1), true);
                    $rank_status = ($my_rank_id >= $rankid ? 'Achieved' : 'Pending');

                    $detailss['status'] = $rank_status;
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;
                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;

        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();

        }
        print_r(json_encode($result));

    }

    public function check(){
        $new_achieve = $this->goal->rank(141);

        print_r(json_encode($new_achieve));
    }
    public function fast_income()
    {
        if (isset($_POST['u_id'])) {
            $result = array();
            $details = [];

            $user_id = $_POST['u_id'];

            $order_details = $this->conn->runQuery('*', 'orders', "u_code='$user_id' and tx_type='repurchase' ORDER BY id DESC");

            if ($order_details) {
                $order_details_dts = $order_details[0]->added_on;
                $current_date = new DateTime();
                $start_date = new DateTime($order_details_dts);
                $interval = $current_date->diff($start_date);
                $total_days = $interval->days;
            } else {
                $total_days = 365;
                $start_date = new DateTime();
            }
            $r_id = 3;
            $plan = $this->conn->runQuery('*', 'plan', "id<=3");
            foreach ($plan as $plans) {
                $id = $plans->id;
                $check_rank = $this->conn->runQuery('*', 'rank', "rank_id='$r_id' and u_code='$user_id'");
                $my_rank = $check_rank[0]->rank;
                $fast_moving_income = $plans->fast_moving_income;
                $fast_income_days = $plans->fast_income_days;
                $fast_moving_rank = $plans->fast_moving_rank;
                $goalstatus = ($total_days <= $fast_income_days && $my_rank == $fast_moving_rank ? 'Achieved' : 'Pending');

                if ($total_days <= $fast_income_days && $my_rank == $fast_moving_rank) {
                    $res = $this->distribute->fast_destribute($user_id, $fast_moving_income);
                } 
                $target_date = date('Y-m-d', strtotime($start_date->format('Y-m-d') . " +$fast_income_days days"));

                $details[$id]['income'] = $fast_moving_income;
                $details[$id]['days_for_income'] = $fast_income_days;
                $details[$id]['target_date'] = $target_date;
                $details[$id]['required_rank'] = $fast_moving_rank;
                $details[$id]['status'] = $goalstatus;
                $details[$id]['my_rank'] = $my_rank;

                $result[$id] = $details[$id];
                $r_id++;
            }

        } else {
            $result['error'] = "error";
            $result['message'] = "id not found";
        }

        print_r(json_encode($result));
    }

    
    public function club_income()
    {
        if (isset($_POST['u_id'])) {
            $source = "club_income";
            $user_id = $_POST['u_id'];
            $result=$this->goal->rank($user_id);
        } else {
            $result['error'] = "error";
            $result['message'] = "id not found";

        }
        print_r(json_encode($result));
    }
    
    public function vip_pool()
    {
        if (isset($_POST['u_id'])) {
            $result = array();
            $details = [];
            $user_id = $_POST['u_id'];
            $plan = $this->conn->runQuery('*', 'plan', "id >=1 And id<=5");
            $check_rank = $this->conn->runQuery('*', 'rank', "rank_type='vip' and u_code='$user_id' order by rank_id desc");
            $my_rank_id = $check_rank[0]->rank_id;
            foreach ($plan as $plans) {
                $id = $plans->id;
                $goalstatus = ($my_rank_id >= $id  ? 'Achieved' : 'Pending');
                    $details[$id]['rank'] = $plans->vip_rank;
                    $details[$id]['min_rank'] = $plans->vip_min_rank;
                    $details[$id]['income'] = $plans->vip_bonus.' %';
                    $details[$id]['status'] = $goalstatus;
                    $result['data'] = $details;
            }

        } else {
            $result['error'] = "error";
            $result['message'] = "id not found";

        }
        print_r(json_encode($result));

    }

    public function dhb_pool()
    {
        if (isset($_POST['u_id'])) {
            $result = array();
            $details = [];
            $user_id = $_POST['u_id'];
            $plan = $this->conn->runQuery('*', 'plan', " id>10");
            $check_rank = $this->conn->runQuery('*', 'rank', "rank_type='rank' and u_code='$user_id' order by rank_id desc");
            $my_rank_id = $check_rank[0]->rank_id;
            $img=1;
            foreach ($plan as $plans) {
                $id = $plans->id;
                $goalstatus = ($my_rank_id >= $id  ? 'Achieved' : 'Pending');
                $company_url = $this->conn->company_info('base_url');
                    $details[$id]['img'] =$company_url . '/images/dhb_img/' . $img . '.jpg';
                    $details[$id]['rank'] = $plans->rank;
                    $details[$id]['dhb_bonus'] = $plans->dhb_bonus;
                    $details[$id]['status'] = $goalstatus;
                    $result['data'] = $details;
            $img++;

            if ($goalstatus=='Achieved') {
                $eligible = $this->conn->runQuery('*', 'rank', "rank_type='dhb_bonus' and rank='$plans->rank' AND u_code='$user_id'");
                if (empty($eligible)) {
                    $rankinser=[];
                    $rankinser ['u_code'] = $user_id;
                    $rankinser ['rank'] = $plans->rank;
                    $rankinser ['rank_type'] = 'dhb_bonus';
                    $rankinser ['is_complete'] = 0;
                    $rankinser ['rank_id'] =$id;
                    
                    
                    $check = $this->conn->runQuery('*', 'closing', "u_code='$user_id'  and type='dhb_bonus' and order_id='$id'");
                    if (empty($check)) {
                if($this->db->insert('rank', $rankinser)){

                $net_capping = $this->business->capping_level($user_id);
                $wallet_sum = $this->wallet->income($user_id, 'main_wallet');
                $bonus=$plans->dhb_bonus;
                if ($bonus + $wallet_sum > $net_capping) {
                    $bonus = $net_capping - $wallet_sum;
                }
                if ($bonus > 0) {

                        $this->update_ob->add_amnt($user_id, 'dhb_bonus', $bonus);
                        $this->update_ob->add_amnt($user_id, 'main_wallet', $bonus);
                    }
                }
            }
        }
        }

            }

        } else {
            $result['error'] = "error";
            $result['message'] = "id not found";

        }
        print_r(json_encode($result));

    }

    public function runner_pool()
    {
        if (isset($_POST['u_id'])) {
            $result = array();
            $details = [];
            $user_id = $_POST['u_id'];
            $data=$this->goal->runner_bonus($user_id);
            
                    $result['error'] = "success";
                    $result['data'] = $data;
            }

         else {
            $result['error'] = "error";
            $result['message'] = "id not found";

        }
        print_r(json_encode($result));

    }
   
    
    public function retreat_pool()
{
    $result = array();

    if (isset($_POST['u_id'])) {
        $company_url = $this->conn->company_info('base_url');
        $user_id = $_POST['u_id'];
        $data = $this->goal->retreat_bonus($user_id);
        
        $result['error'] = "success";
        $result['data'] = $data;

    } else {
        $result['error'] = "error";
        $result['message'] = "id not found";
    }

    print_r(json_encode($result));
}

    
    public function founder_club_income()
    {
        if (isset($_POST['u_id'])) {
            $source = "founder_club_income";
            $result = array();
            $details = [];

            $user_id = $_POST['u_id'];
            $plan = $this->conn->runQuery('*', 'plan', "id=10");
            foreach ($plan as $plans) {
                $id = $plans->id;
                $club_income = $plans->club_income;
                $rank = $plans->rank;
                $check_rank = $this->conn->runQuery('*', 'rank', "rank_id='$id' and u_code='$user_id'");
                $my_rank = $check_rank[0]->rank;
                $my_rank_id = $check_rank[0]->rank_id;
                $goalstatus = ($id == $my_rank_id  ? 'Achieved' : 'Pending');

                    $details[$id]['income'] = $club_income;
                    $details[$id]['required_rank'] = $rank;
                    $details[$id]['my_rank'] = $my_rank;

                    $details[$id]['status'] = $goalstatus;
                    $result['data'] = $details;
               

            }

        } else {
            $result['error'] = "error";
            $result['message'] = "id not found";

        }
        print_r(json_encode($result));

    }


    

    public function development_bonus()
    {

        //$input_data = $this->conn->get_input();
        if (isset($_POST['u_id'])) {
            $user_id = $_POST['u_id'];
            $user_detailss = $this->conn->runQuery('development_rank_id', 'users', "id='$user_id'");
            $my_rank_id = $user_detailss[0]->development_rank_id;

            $plan_details = $this->conn->runQuery('id,gambit_direct,gambit_income,gambit_rank,gambit_reward', 'plan', "id<=5");
            if ($plan_details) {
                $sr = 1;
                foreach ($plan_details as $plan_details1) {
                    $rankid = $plan_details1->id;
                    $detailss = json_decode(json_encode($plan_details1), true);

                    $rank_status = ($my_rank_id >= $rankid ? 'Achieved' : 'Pending');

                    $detailss['status'] = $rank_status;
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;
                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;

        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();

        }
        print_r(json_encode($result));

    }

    public function mission_mall()
    {

        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $user_id = $input_data['u_id'];

            $plan_details = $this->conn->runQuery('*', 'mission_mall', "1=1");
            if ($plan_details) {
                $sr = 1;
                foreach ($plan_details as $plan_details1) {

                    $detailss = json_decode(json_encode($plan_details1), true);
                    //$detailss['status']=$rank_status;
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;

                }
            } else {
                $details['data'] = array();
            }

            $plan_details2 = $this->conn->runQuery('*', 'member_income', "1=1");
            if ($plan_details2) {
                $sr1 = 1;
                foreach ($plan_details2 as $plan_details11) {

                    $detailss22 = json_decode(json_encode($plan_details11), true);
                    //$detailss['status']=$rank_status;
                    $data22[] = $detailss22;
                    $details['member'] = $data22;
                    $sr1++;

                }
            } else {
                $details['member'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;

        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();

        }
        print_r(json_encode($result));

    }

    public function member()
    {

        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $user_id = $input_data['u_id'];

            $plan_details = $this->conn->runQuery('*', 'member_income', "status=1 order by id desc limit 2");
            if ($plan_details) {
                $sr = 1;
                foreach ($plan_details as $plan_details1) {

                    $detailss = json_decode(json_encode($plan_details1), true);
                    //$detailss['status']=$rank_status;
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;

                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;

        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();

        }
        print_r(json_encode($result));

    }

    public function order()
    {

        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $user_id = $input_data['u_id'];

            $plan_details = $this->conn->runQuery('tx_type,order_amount,order_bv,invoice_no,added_on', 'orders', "u_code='$user_id' order by id desc");
            if ($plan_details) {
                $sr = 1;
                foreach ($plan_details as $plan_details1) {

                    $detailss = json_decode(json_encode($plan_details1), true);
                    //$detailss['status']=$rank_status;
                    $data[] = $detailss;
                    $details['data'] = $data;
                    $sr++;

                }
            } else {
                $details['data'] = array();
            }

            $details['res'] = 'success';
            $details['message'] = '';
            $result = $details;

        } else {

            $result['res'] = 'error';
            $result['message'] = 'This user does not have account.';
            $result['data'] = array();

        }
        print_r(json_encode($result));

    }

}
