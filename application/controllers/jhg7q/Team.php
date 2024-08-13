<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
// header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Team extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $key_data2 = $this->conn->runQuery('*', 'api_key', "key_type='session_encryption_key'");
        $this->session_encryption_key = $key_data2[0]->api_key;

        $this->limit = 20;
    }

    public function direct_team()
    {
        $lmt = $this->limit;
        $show_mobile = 'yes';

        // $input_data = $this->conn->get_input();

        if (isset($_POST['u_id']) && isset($_POST['init_val'])) {
            $start_from = $_POST['init_val'];
            $u_id = $_POST['u_id'];
            //$testing = array();
            //          $testing['remark'] = $_REQUEST['status'];
            //          $this->db->insert('testing',$testing);
            $where = '';
            // 			if($status=="all"){
            // 				$txn = $this->conn->runQuery('*','users',"u_sponsor='$u_id' limit $start_from,$lmt"); 
            // 				 $total_txn= $this->conn->runQuery('COUNT(id) as ids','users',"u_sponsor='$u_id'")[0]->ids;
            // 			}elseif($status=="active"){
            // 				$st=1;
            // 				$txn = $this->conn->runQuery('*','users',"u_sponsor='$u_id' and active_status='1' limit $start_from,$lmt");   
            // 			    $total_txn= $this->conn->runQuery('COUNT(id) as ids','users',"u_sponsor='$u_id' and active_status='1'")[0]->ids; 

            // 			}elseif($status=="inactive"){
            // 				$st=0;
            // 				$txn = $this->conn->runQuery('*','users',"u_sponsor='$u_id' and active_status='0' limit $start_from,$lmt");   
            // 			     $total_txn= $this->conn->runQuery('COUNT(id) as ids','users',"u_sponsor='$u_id' and active_status='0'")[0]->ids; 

            // 			}else{
            // 				$txn = $this->conn->runQuery('*','users',"u_sponsor='$u_id' limit $start_from,$lmt");
            // 				$total_txn= $this->conn->runQuery('COUNT(id) as ids','users',"u_sponsor='$u_id'")[0]->ids;
            // 			}



            $limit = $_POST['init_val'];

            $searchdata['from_table'] = 'users';
            $conditions['u_sponsor'] = $u_id; //$this->session->userdata('user_id');

            if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                $name = trim($_REQUEST['name']);
                $where .= " AND name LIKE '%$name%'";
            }
            if (isset($_REQUEST['username']) && $_REQUEST['username'] != '') {
                $usename = trim($_REQUEST['username']);
                $where .= " AND username LIKE '%$usename%'";
            }

            if (isset($_REQUEST['mobile']) && $_REQUEST['mobile'] != '') {
                $mobile = $_REQUEST['mobile'];
                $where = "  AND  mobile LIKE '%$mobile%'";
            }
            if ($_REQUEST['status'] != '') {
                $status = $_REQUEST['status'];
                $where = " and active_status= '$status'";
            }


            if (isset($_REQUEST['active_date'])  && $_REQUEST['active_date'] != '') {
                $active_date = date('Y-m-d 00:00:00', strtotime($_REQUEST['active_date']));
                $end_date = date('Y-m-d 23:59:00', strtotime($_REQUEST['end_date']));
                //  $conditions['added_on']=$_REQUEST['active_date'];
                $where = "(date BETWEEN '$start_date' and '$end_date')";
                //             $searchdata['where'] = $where;
            }

            $tdata = $this->conn->runQuery('*', 'users', "u_sponsor='$u_id' $where limit $start_from,$lmt");

            $total_txn = $this->conn->runQuery('COUNT(id) as ids', 'users', "u_sponsor='$u_id' $where")[0]->ids;

            //   if($limit!=''){

            //         $this->limit= $limit;
            //     }
            //      if(!empty($likeconditions)){
            //         $searchdata['likecondition'] = $likeconditions;
            //     }

            //     if(!empty($conditions)){
            //         $searchdata['conditions'] = $conditions;
            //     }  

            //$tdata=$this->paging->searching_data($data);
            //  $tsdata = $this->paging->search_response($searchdata,$this->limit,'');

            //   $tdata =  $tsdata['table_data'];

            $ins_val = $start_from;
            $ttlcnt = 0;
            if ($tdata) {

                foreach ($tdata as $txn_details) {
                    $ttlcnt++;

                    //$details['AI_Package']=$txn_details->active_status==1 ? $this->business->AI_package($user_id):0;
                    $details = json_decode(json_encode($txn_details), true);

                    $user_id = $details['id'];
                    $w_balance = $this->conn->runQuery('*', 'user_wallets', "u_code='$user_id'");
                    $wallet_balance = $w_balance ? $w_balance[0] : array();
                    $details['total_direct'] = $wallet_balance->c8;
                    $details['total_team'] = $wallet_balance->c11;
                    $details['ai_package'] = $txn_details->active_status == 1 ? $this->business->AI_package($user_id) : 0;
                    $details['subcription_package'] = $txn_details->active_status == 1 ? $this->business->package_repurchase($user_id) : 0;
                    $details['my_rank'] = $txn_details->active_status == 1 ? $txn_details->my_rank : 0;
                    $team_business = $this->business->top_legs($user_id);
                    $top_legs = $team_business[0];
                    $total_team_business = array_sum($team_business);
                    $details['team_business'] = $total_team_business;


                    $data[] = $details;
                    $ins_val++;
                }
                $res['total_count'] = $total_txn;
                $res['data'] = $data;
                $res['message'] = "";
            } else {
                $res['total_count'] = 0;
                $res['data'] = array();
                $res['message'] = "No data found";
            }


            $res['next_init_val'] = $ins_val;
            $res['start_from'] = $start_from;
            $res['prev_page'] = $start_from > 0 ? 'yes' : 'no';
            $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
            $res['show_mobile'] = $show_mobile;
            $res['res'] = 'success';
        } else {
            $res['show_mobile'] = $show_mobile;
            $res['next_init_val'] = 0;
            $res['next_page'] = 'no';
            $res['start_from'] = 0;
            $res['next_page'] = 'no';
            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }
        print_r(json_encode($res));
    }

    public function levels()
    {
        $res['res'] = 'success';
        $res['mesasge'] = 'success';
        $lvl = array();
        for ($l = 0; $l < 20; $l++) {
            $lvl[] = array('level' => $l + 1);
        }
        $res['data'] = $lvl;
        print_r(json_encode($res));
    }


    public function generation_team()
    {
        $lmt = $this->limit;
        $input_data = $this->conn->get_input();

        if (isset($_POST['u_id']) && isset($_POST['init_val']) && isset($_POST['level'])) {


            $u_id = $_POST['u_id'];
            $start_from = $_POST['init_val'];

            $my_level_team = $this->team->my_level_team($u_id);
            $lvl = $_POST['level'];

            // $rem['remark']=json_encode($_POST);
            // $this->db->insert('testing',$rem);

            $gen_team =  (array_key_exists($lvl, $my_level_team) ? $my_level_team[$lvl] : array());
            if (!empty($gen_team)) {
                $arr_implode = implode(',', $gen_team);

                $wr = '';

                if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                    $name = trim($_REQUEST['name']);
                    $wr .= " AND name LIKE '%$name%'";
                }
                if (isset($_REQUEST['username']) && $_REQUEST['username'] != '') {
                    $usename = trim($_REQUEST['username']);
                    $wr .= " AND username LIKE '%$usename%'";
                }
                /*if($input_data['day']!=2){
                 
                    if($input_data['day']==0){
                         $dt = date('Y-m-d H:i:s');
                      $wr = "DATE(added_on) = DATE('$dt')";
                    }
                
                    if($input_data['day']==1){
                        $dt = date('Y-m-d H:i:s',strtotime("-1 days"));
                        $wr = "DATE(added_on) = DATE('$dt')";
                    }
                }*/


                $txn = $this->conn->runQuery('*', 'users', " id IN ($arr_implode) $wr and 1='1'  limit $start_from,$lmt");
                $total_txn = $this->conn->runQuery('COUNT(id) as ids', 'users', "id IN ($arr_implode) $wr and 1='1'")[0]->ids;
                $ins_val = $start_from;

                $ttlcnt = 0;
                if ($txn) {

                    foreach ($txn as $txn_details) {
                        $ttlcnt++;
                        $details = json_decode(json_encode($txn_details), true);
                        $sponsorId = $txn_details->u_sponsor;
                        $sponsor_username = $this->profile->profile_info($sponsorId, 'username');
                        $details['sponsor'] = $sponsor_username->username;


                        $data[] = $details;


                        $ins_val++;
                    }

                    $res['data'] = $data;
                    $res['message'] = "";
                } else {
                    $res['data'] = array();
                    $res['message'] = "No data found";
                }
                $res['prev_page'] = $start_from > 0 ? 'yes' : 'no';

                $res['total_count'] = $total_txn;
                $res['next_init_val'] = $ins_val;
                $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
            } else {

                $res['next_page'] = 'no';
                $res['next_init_val'] = 0;
                $res['data'] = array();
                $res['message'] = "No data found";
            }

            $res['res'] = 'success';
        } else {
            $res['next_init_val'] = 0;
            $res['next_page'] = 'no';
            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }
        print_r(json_encode($res));
    }



    public function left_team()
    {
        $lmt = $this->limit;
        $input_data = $this->conn->get_input();

        if (isset($input_data['u_id']) && isset($input_data['init_val'])) {


            $u_id = $input_data['u_id'];
            $start_from = $input_data['init_val'];

            $left_team =  $this->team->team_by_position($u_id, '1');




            $rem['remark'] = json_encode($input_data);
            $this->db->insert('testing', $rem);


            if (!empty($left_team)) {
                $arr_implode = implode(',', $left_team);

                $wr = '';


                $txn = $this->conn->runQuery('*', 'users', " id IN ($arr_implode) and 1='1'  limit $start_from,$lmt");

                $ins_val = $start_from;

                $ttlcnt = 0;
                if ($txn) {

                    foreach ($txn as $txn_details) {
                        $ttlcnt++;
                        $details = json_decode(json_encode($txn_details), true);

                        $data[] = $details;

                        $ins_val++;
                    }

                    $res['data'] = $data;
                    $res['message'] = "";
                } else {
                    $res['data'] = array();
                    $res['message'] = "No data found";
                }

                $res['next_init_val'] = $ins_val;
                $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
            } else {
                $res['next_page'] = 'no';
                $res['next_init_val'] = 0;
                $res['data'] = array();
                $res['message'] = "No data found";
            }

            $res['res'] = 'success';
        } else {
            $res['next_init_val'] = 0;
            $res['next_page'] = 'no';
            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }
        print_r(json_encode($res));
    }

    public function right_team()
    {
        $lmt = $this->limit;
        $input_data = $this->conn->get_input();

        if (isset($input_data['u_id']) && isset($input_data['init_val'])) {


            $u_id = $input_data['u_id'];
            $start_from = $input_data['init_val'];

            $left_team =  $this->team->team_by_position($u_id, '2');




            $rem['remark'] = json_encode($input_data);
            $this->db->insert('testing', $rem);


            if (!empty($left_team)) {
                $arr_implode = implode(',', $left_team);

                $wr = '';


                $txn = $this->conn->runQuery('*', 'users', " id IN ($arr_implode) and 1='1'  limit $start_from,$lmt");

                $ins_val = $start_from;

                $ttlcnt = 0;
                if ($txn) {

                    foreach ($txn as $txn_details) {
                        $ttlcnt++;
                        $details = json_decode(json_encode($txn_details), true);

                        $data[] = $details;

                        $ins_val++;
                    }

                    $res['data'] = $data;
                    $res['message'] = "";
                } else {
                    $res['data'] = array();
                    $res['message'] = "No data found";
                }

                $res['next_init_val'] = $ins_val;
                $res['next_page'] = $ttlcnt >= $lmt ? 'yes' : 'no';
            } else {
                $res['next_page'] = 'no';
                $res['next_init_val'] = 0;
                $res['data'] = array();
                $res['message'] = "No data found";
            }

            $res['res'] = 'success';
        } else {
            $res['next_init_val'] = 0;
            $res['next_page'] = 'no';
            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }
        print_r(json_encode($res));
    }

    public function genealogy()
    {
        //$input_data = $this->conn->get_input();

        if (isset($_POST['u_id'])) {
            $u_id = $_POST['u_id'];
            $res['res'] = 'success';
            $res['data'] = $this->team->genealogy_data($u_id);
            $res['message'] = "";
        } else {
            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }
        print_r(json_encode($res));
    }
    public function tree()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['u_id'])) {
            $u_id = $input_data['u_id'];

            $plan_type = $this->conn->setting('reg_type');
            $team = $this->conn->runQuery("*", 'wallet_types', "wallet_type='team' and  status='1' and $plan_type='1'");
            $w_balance = $this->conn->runQuery('*', 'user_wallets', "u_code='$u_id'");
            $wallet_balance = $w_balance ? $w_balance[0] : array();

            $teamarr = array();
            if ($team) {
                foreach ($team as $teama) {
                    $slug =  $teama->wallet_column;
                    $teamarr[$teama->slug] =  (!empty($wallet_balance) && isset($wallet_balance->$slug) ? $wallet_balance->$slug : 0);
                }
            }


            $userdetails =  $this->profile->profile_info($u_id, 'username,name,active_status,u_sponsor');
            $sponsor_details = $this->profile->profile_info($userdetails->u_sponsor, 'username,name');



            $dtas['id'] = $u_id;
            $dtas['username'] = $userdetails->username;
            $dtas['name'] = $userdetails->name;
            $dtas['sponsor_name'] = $sponsor_details->name;
            $dtas['sponsor_username'] = $sponsor_details->username;
            $dtas['active_status'] = $userdetails->active_status == 1 ? 'Active' : 'Inactive';

            $data[0] = $dtas;
            $level1_arr = $this->conn->runQuery('*', 'users', "Parentid='$u_id'");
            $lvl1 = array();
            if ($level1_arr) {
                $lvl1 = array_column($level1_arr, 'id', 'position');
            }

            for ($l1 = 1; $l1 <= 2; $l1++) {
                if (array_key_exists($l1, $lvl1)) {
                    $userid = $lvl1[$l1];

                    $userdetails =  $this->profile->profile_info($userid, 'username,name,active_status,u_sponsor');
                    $sponsor_details = $this->profile->profile_info($userdetails->u_sponsor, 'username,name');

                    $dtas['id'] = $userid;
                    $dtas['username'] = $userdetails->username;
                    $dtas['name'] = $userdetails->name;
                    $dtas['sponsor_name'] = $sponsor_details->name;
                    $dtas['sponsor_username'] = $sponsor_details->username;
                    $dtas['active_status'] = $userdetails->active_status == 1 ? 'Active' : 'Inactive';

                    $data[1][$l1]  =  $dtas;
                } else {
                    $data[1][$l1] = 'null';
                }
            }

            for ($l2 = 1; $l2 <= 2; $l2++) {


                $aray =  $data[1][$l2];
                if (array_key_exists('id', $aray)) {
                    $usr = $aray['id'];
                } else {
                    $usr = 'null';
                }



                $nxtlvlarr = array();
                if ($usr != 'null') {
                    $lvlnxtarr = $this->conn->runQuery('*', 'users', "Parentid='$usr'");
                    if ($lvlnxtarr) {
                        $nxtlvlarr = array_column($lvlnxtarr, 'id', 'position');
                    }
                }


                for ($l21 = 1; $l21 <= 2; $l21++) {
                    if ($usr != 'null') {
                        if (array_key_exists($l21, $nxtlvlarr)) {

                            $userid = $nxtlvlarr[$l21];

                            $userdetails =  $this->profile->profile_info($userid, 'username,name,active_status,u_sponsor');
                            $sponsor_details = $this->profile->profile_info($userdetails->u_sponsor, 'username,name');

                            $dtas['id'] = $userid;
                            $dtas['username'] = $userdetails->username;
                            $dtas['name'] = $userdetails->name;
                            $dtas['sponsor_name'] = $sponsor_details->name;
                            $dtas['sponsor_username'] = $sponsor_details->username;
                            $dtas['active_status'] = $userdetails->active_status == 1 ? 'Active' : 'Inactive';

                            $data[2][$l2][$l21]  =  $dtas;
                        } else {
                            $data[2][$l2][$l21] = 'null';
                        }
                    } else {
                        $data[2][$l2][$l21] = 'null';
                    }
                }
            }
            /* $check = $this->conn->runQuery('*','users',"Parentid='$ckk'");
                         $lvl11 = array();
                           if($check){
                               $lvl11 = array_column($check,'id','position');
                           }
                         
                         if($check){
                             for($l11=1;$l11<=2;$l11++){
                               if(array_key_exists($l11,$lvl11)){
                                 $data[1][$l1][$l11]  = $ckk= $lvl11[$l11];
                                  
                               }else{
                                   $data[1][$l1][$l11] = 'null';
                               }
                          }
                         }*/
            $res['teams'] = $teamarr;
            $res['res'] = 'success';
            $res['data'] = $data;
            $res['message'] = '';
        } else {

            $res['res'] = 'error';
            $res['data'] = array();
            $res['message'] = "Invalid parameters.";
        }

        print_r(json_encode($res));
    }
}
