<?php
header("Access-Control-Allow-Origin: *");
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header("Access-Control-Allow-Headers: X-Requested-With");

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generateToken($code)
    {
        $static_str = 'GB';
        $currenttimeseconds = date("mdY_His");
        return $static_str . $code . $currenttimeseconds;

    }
    public function index()
    {
        // $input_data =$this->conn->get_input();
        //$referrer_id = $this->referrer_id($input_data['referrer_id']);
        // $this->form_validation->set_data($input_data);
        //$user_type = $input_data['user_type'];
        $res['tokenStatus'] = false;
        $res['status'] = false;
        $sponsor = $this->input->post('referrer_id');
        //   $username = $this->input->post('usename');
        $reg_full_name = $this->input->post('reg_full_name');
        $reg_mob_number = $this->input->post('reg_mob_number');
        $reg_email = $this->input->post('reg_email');
        $reg_password = $this->input->post('reg_password');
        $country = $this->input->post('country');
        $country = $this->input->post('country_code');
        $wallet_address = $this->input->post('wallet_address');
        //   $security_pin = $this->input->post('security_pin');
        // $transaction_pin = $this->input->post('transaction_pin');
        $testing = array();
        $testing['remark'] = json_encode($_POST);
        $this->db->insert('testing', $testing);

        $requires = $this->conn->runQuery("*", 'advanced_info', "title='Registration'");
        $value_by_lebel = array_column($requires, 'value', 'label');
        // $this->form_validation->set_rules('membership_type', 'Membership Type', 'required');
        //$this->form_validation->set_rules('wallet_address', 'Address', 'required|callback_is_address_available');
        if (array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required'] == 'yes') {
            // callback_is_sponsor_available
            if ($_POST['referrer_id'] != "") {

                $this->form_validation->set_rules('referrer_id', 'Sponsor', 'required|callback_is_sponsor_available');
                $register['u_sponsor'] = $this->profile->id_by_username($sponsor);

            } else {

                $register['u_sponsor'] = 1;
            }
        } else {
            $register['u_sponsor'] = 1;
        }

        $sponsor_id = $register['u_sponsor'];

        if (array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method'] == 'manual') {
            //  $this->form_validation->set_rules('usename', 'Usename', 'required|trim|callback_is_username_valid');
            $register['username'] = $value_by_lebel['user_gen_prefix'] . $usename;
        } else {
            $register['username'] = $this->get_username();
        }

        /* $this->form_validation->set_rules('position', 'Position', 'trim|required');
        $register['position'] = $input_data['position'];
        $register['Parentid'] = $this->binary->new_parent($register['u_sponsor'],$input_data['position']);*/

        $this->form_validation->set_rules('reg_full_name', 'Name', 'required|regex_match[/^[a-zA-Z ]+$/]');

        if (array_key_exists('mobile_users', $value_by_lebel)) {
            $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|callback_is_mobile_valid');
            $register['mobile'] = $mobile = $reg_mob_number;
        }
        /* if(array_key_exists('mobile_users', $value_by_lebel)){
        $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|regex_match[/^[0-9]{10}$/]|callback_is_mobile_valid');
        $register['mobile'] =$mobile= $input_data['reg_mob_number'];
        }*/

        if (array_key_exists('email_users', $value_by_lebel)) {
            $this->form_validation->set_rules('reg_email', 'E-mail', 'trim|required|valid_email|callback_is_email_valid');
            $register['email'] = $email = $reg_email;
        }

        if (array_key_exists('pass_gen_type', $value_by_lebel) && $value_by_lebel['pass_gen_type'] == 'manual') {
            $this->form_validation->set_rules('reg_password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[reg_password]');
            $pw = $register['password'] = md5($reg_password);
        } else {
            $pw = random_string($value_by_lebel['pass_gen_fun'], $value_by_lebel['pass_gen_digit']);
            $register['password'] = md5($pw);
        }

        $this->form_validation->set_rules('country', 'Country', 'required');
        //$this->form_validation->set_rules('transaction_pin', 'Transaction Pin', 'required');

        //   $this->form_validation->set_rules('security_pin', 'Security Pin', 'required');

            $reg_otp = $this->input->post('otp');
        
            $otps = $this->conn->runQuery('otp', 'api_otp', "user_email='$reg_email' ORDER BY ID DESC");
           $verify_otp=$otps[0]->otp;

            if ($verify_otp==$reg_otp) {


        if ($this->form_validation->run() != false) {

            $register['name'] = $user_name = ucwords($reg_full_name);
            $register['user_type'] = 'user';
            //     $register['security_pin'] = $security_pin;
            //$register['wallet_address'] = $wallet_address;
            $register['country'] = $country;
            $register['country_code '] = $country_code;
            //$register['tx_password'] = $transaction_pin;

            $code = $this->conn->get_insert_id('users', $register);
            if ($code) {

                $inser_wallet = array();
                $inser_wallet['u_code'] = $code;
                if ($this->db->insert('user_wallets', $inser_wallet)) {
                    $this->update_ob->add_direct($sponsor_id);
                    $this->update_ob->add_gen($sponsor_id);
                    $this->update_ob->add_gen_user($sponsor_id, $code);

                    $ge = array();
                    $ge['u_code'] = $code;
                    $ge['gen_team'] = "[]";
                    $this->db->insert('user_teams', $ge);

                    /*if($user_type=='binary'){
                $this->update_ob->update_binary($sponsor_id);
                }*/
                }

                // $this->session->set_flashdata("success", "Your Account has been registered. You can login now. Username : ".$register['username']." & Password :".$input_data['password']);
                $website = $this->conn->company_info('title');
                $company_url = $this->conn->company_info('base_url');
                //$msg2="Dear ".$register['name']." , Welcome to $website. Your User ID : ".$register['username'].", Password : ".$input_data['password']." . For more visit $company_url .";
                //$msg2="Welcome ".$register['name']." . You have been successfully registered as a member of $website.Your login Credentials as follows - Username ".$register['username'].", And Password : ".$_POST['password'].". Thanks! test.com team.";
                $msg2 = "Welcome " . $register['name'] . ". You have been successfully registered as a member of $website.Your login Credentials as follows - Username " . $register['username'] . ", And Password :" . $reg_password . ". Thanks! $website team.";

                //$this->message->sms($mobile,$msg2);
                 $this->message->send_mail($register['email'],'Registration success',$msg2,1);

                $token = $this->generateToken($code);
                $login_details['u_code'] = $code;

                $login_details['token'] = $token;
                $login_details['status'] = 1;
                $this->db->insert('accesToken', $login_details);

                $res['token'] = $token;
                $res['tokenStatus'] = true;
                $res['res'] = 'success';
                $res['status'] = true;
                $res['username'] = $register['username'];
                $res['name'] = $register['name'];
                $res['password'] = $reg_password;
                $res['u_id'] = $code;
                $res['message'] = "Your Account has been registered. You can login now. Username : " . $register['username'] . " & Password :" . $reg_password;

            } else {
                $res['status'] = false;
                $res['res'] = 'error';
                $res['message'] = "Somthing Wrong with database! Please try again.";

            }
            //redirect(base_url('success?username='.$register['username'].'&pass='.$_POST['password'].'&name='.$_POST['name']),"refresh");
        } else {
            $errors = validation_errors();
            $res['res'] = 'error';
            $res['error'] = $errors;
            $res['err_referrer_id'] = form_error('referrer_id');
            $res['err_reg_mob_number'] = form_error('reg_mob_number');
            $res['err_reg_password'] = form_error('reg_password');
            $res['err_reg_email'] = form_error('reg_email');
            $res['err_reg_full_name'] = form_error('reg_full_name');
            $res['message'] = 'Some Error in submittion'; //$errors;//json_encode(['error'=>$errors]);
            $res['status'] = false;
        }
            }
            else{
                $res['res'] = 'error';
                 $res['status'] = false;
            }

        print_r(json_encode($res));

    }

    public function is_sponsor_available($str)
    {
        $where = array(
            'username' => $str,
        );
        $details = $this->conn->runQuery('id,active_status', 'users', $where);

        if ($details) {

            return true;

        } else {
            $this->form_validation->set_message('is_sponsor_available', "Sponsor not Exists! Please Try another.");
            return false;
        }
    }
    public function is_address_available($str)
    {
        $where = array(
            'user_address' => $str,
        );
        $details = $this->conn->runQuery('id,active_status', 'users', $where);

        // $ss['remark']=$this->db->last_query();
        // $this->db->insert('testing',$ss);
        if ($details) {

            return false;
            $this->form_validation->set_message('is_address_available', "Address Already Exists! Please Try another.");

        } else {

            return true;
        }
    }
    public function check_address_exists()
    {
        $input_data = $this->conn->get_input();

        $str = $input_data['wallet_address'];

        $where = array(
            'user_address' => $str,
        );
        $details = $this->conn->runQuery('id,active_status,username', 'users', $where);

        if ($details) {
            $res['status'] = true;
            $res['res'] = 'success';
            $res['message'] = $details[0]->username;

        } else {
            $res['status'] = false;
            $res['res'] = 'error';

        }
        print_r(json_encode($res));
    }

    public function is_username_valid($str)
    {
        $where = array(
            'username' => $str,
        );
        if ($this->conn->runQuery('id', 'users', $where)) {
            $this->form_validation->set_message('is_username_valid', "Username Already Exists! Please Try another.");
            return false;
        } else {

            return true;
        }
    }

    public function is_mobile_valid($str)
    {
        $where = array(
            'mobile' => $str,
        );
        $result = $this->conn->runQuery('id', 'users', $where);
        if ($result) {
            $mobile_users = $this->conn->setting('mobile_users');
            if (count($result) >= $mobile_users) {
                $this->form_validation->set_message('is_mobile_valid', "You exceed maximum number of mobile use limit! Please Try another.");
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function is_email_valid($str)
    {
        $where = array(
            'email' => $str,
        );
        $result = $this->conn->runQuery('id', 'users', $where);
        if ($result) {
            $email_users = $this->conn->setting('email_users');
            if (count($result) >= $email_users) {
                $this->form_validation->set_message('is_email_valid', "You exceed maximum number of email use limit! Please Try another.");
                return false;

            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function check_mobile_valid()
    {

        if (preg_match('/^[0-9]{10}+$/', $_POST['mobile'])) {
            $where = array(
                'mobile' => $_POST['mobile'],
            );
            $result = $this->conn->runQuery('id', 'users', $where);
            if ($result) {
                $mobile_users = $this->conn->setting('mobile_users');
                if (count($result) >= $mobile_users) {
                    $res['error'] = true;
                    $res['msg'] = "You exceed maximum number of mobile use limit! Please Try another.";
                } else {
                    $res['error'] = false;
                    $res['msg'] = "Valid mobile.";
                }
            } else {
                $res['error'] = false;
                $res['msg'] = "Valid mobile.";
            }
        } else {
            $res['error'] = true;
            $res['msg'] = "Invalid mobile ! Please Enter valid mobile.";
        }
        print_r(json_encode($res));
    }

    public function check_email_valid()
    {

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $where = array(
                'email' => $_POST['email'],
            );
            $result = $this->conn->runQuery('id', 'users', $where);
            if ($result) {
                $email_users = $this->conn->setting('email_users');
                if (count($result) >= $email_users) {
                    $res['error'] = true;
                    $res['msg'] = "You exceed maximum number of email use limit! Please Try another.";
                } else {
                    $res['error'] = false;
                    $res['msg'] = "Valid Email.";

                }
            } else {
                $res['error'] = false;
                $res['msg'] = "Valid Email.";
            }
        } else {
            $res['error'] = true;
            $res['msg'] = "Invalid Email ! Please Enter valid Email.";
        }
        print_r(json_encode($res));
    }

    public function check_sponsor_exist()
    {
        $input_data = $_POST;

        //$res['error']=true;
        $where = array(
            'username' => $input_data['referrer_id'],
        );

        $details = $this->conn->runQuery('id,name,active_status', 'users', $where);

        if ($details) {
            $res['u_f_name'] = $details[0]->name;
            $res['res'] = 'success';

        } else {
            $res['res'] = "error";
            $res['msg'] = "Sponsor not exist";
        }
        print_r(json_encode($res));
    }


    public function verify_otp()
    {
$reg_email = $this->input->post('reg_email');
$reg_otp = $this->input->post('otp');
        
        if (isset($reg_otp) && isset($reg_email)) {
           // $reg_otp= $input_data["otp"];
           // $reg_email = $input_data["reg_email"];
     
            $otps = $this->conn->runQuery('otp', 'api_otp', "user_email='$reg_email' ORDER BY ID DESC");
           $verify_otp=$otps[0]->otp;

            if ($verify_otp==$reg_otp) {

                $res['res'] = "success";
                $res['message'] = "Success";

            }
            else{
                $res['res'] = "error";
                $res['message'] = "OTP NOT CORRECT";
            }
        } else {
            $res['res'] = 'Error';
            $res['res'] = 'please enter email address';
        }

        print_r(json_encode($res));
    }

    public function register()
    {
        $res['tokenStatus'] = false;
        $res['status'] = false;
        $sponsor = $this->input->post('referrer_id');
        $reg_full_name = $this->input->post('reg_full_name');
        $reg_mob_number = $this->input->post('reg_mob_number');
        $reg_email = $this->input->post('reg_email');
        $reg_password = $this->input->post('reg_password');
        $country = $this->input->post('country');
        $country = $this->input->post('country_code');

        $requires = $this->conn->runQuery("*", 'advanced_info', "title='Registration'");
        $value_by_lebel = array_column($requires, 'value', 'label');
        if (array_key_exists('is_sponsor_required', $value_by_lebel) && $value_by_lebel['is_sponsor_required'] == 'yes') {
            
            if ($_POST['referrer_id'] != "") {
                $this->form_validation->set_rules('referrer_id', 'Sponsor', 'required|callback_is_sponsor_available');
                $register['u_sponsor'] = $this->profile->id_by_username($sponsor);

            } else {

                $register['u_sponsor'] = 1;
            }
        } else {
            $register['u_sponsor'] = 1;
        }

        $sponsor_id = $register['u_sponsor'];

        if (array_key_exists('user_gen_method', $value_by_lebel) && $value_by_lebel['user_gen_method'] == 'manual') {
            $register['username'] = $value_by_lebel['user_gen_prefix'] . $usename;
        } else {
            $register['username'] = $this->get_username();
        }
        $this->form_validation->set_rules('reg_full_name', 'Name', 'required|regex_match[/^[a-zA-Z ]+$/]');

        if (array_key_exists('mobile_users', $value_by_lebel)) {
            $this->form_validation->set_rules('reg_mob_number', 'Mobile', 'required|callback_is_mobile_valid');
            $register['mobile'] = $mobile = $reg_mob_number;
        }
        if (array_key_exists('email_users', $value_by_lebel)) {
            $this->form_validation->set_rules('reg_email', 'E-mail', 'trim|required|valid_email|callback_is_email_valid');
            $register['email'] = $email = $reg_email;
        }
        if (array_key_exists('pass_gen_type', $value_by_lebel) && $value_by_lebel['pass_gen_type'] == 'manual') {
            $this->form_validation->set_rules('reg_password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|min_length[6]|matches[reg_password]');
            $pw = $register['password'] = md5($reg_password);
        } else {
            $pw = random_string($value_by_lebel['pass_gen_fun'], $value_by_lebel['pass_gen_digit']);
            $register['password'] = md5($pw);
        }

        $this->form_validation->set_rules('country', 'Country', 'required');
        if ($this->form_validation->run() != false) {

                $otp = rand(100000, 999999);
                $arr = array();
                $arr['u_id'] = "";
                $arr['otp_type'] = "register_validation";
                $arr['otp'] = $otp;
                $arr['user_email'] = $email;
                $this->db->insert('api_otp', $arr);

                $company_url = $this->conn->company_info('base_url');
                $company_name = $this->conn->company_info('company_name');
    
                $ottp = "$otp is your OTP for Registration verification. Thanks $company_name team.";
    
                $mail_Sent=true;// $this->message->send_mail($email, 'OTP Send', $ottp);
    if($mail_Sent){
                $res['sms'] = $ottp;
                $res['res'] = "success";
                $res['message'] = "$otp OTP sent Successfully!";
            } else {
                $res['res'] = 'Error';
                $res['res'] = 'please enter email address';
            }
        } else {
            $errors = validation_errors();
            $res['res'] = 'error';
            $res['error'] = $errors;
            $res['err_referrer_id'] = form_error('referrer_id');
            $res['err_reg_mob_number'] = form_error('reg_mob_number');
            $res['err_reg_password'] = form_error('reg_password');
            $res['err_reg_email'] = form_error('reg_email');
            $res['err_reg_full_name'] = form_error('reg_full_name');
            $res['message'] = 'Some Error in submittion'; 
            $res['status'] = false;
        }

        print_r(json_encode($res));

    }

    public function check_username_exist()
    {
        $input_data = $this->conn->get_input();
        if (isset($input_data['username']) && $input_data['username'] != '') {
            $where['username'] = $input_data['username'];
            $details = $this->conn->runQuery('name', 'users', $where);
            if ($details) {
                $res['name'] = $details[0]->name;
                $res['res'] = 'success';
                $res['message'] = "Username Exists";
            } else {

                $res['res'] = 'error';
                $res['message'] = "Invalid username";
            }
        } else {
            $res['res'] = 'error';
            $res['message'] = "Please Enter username";
        }
        print_r(json_encode($res));
    }

    public function get_username($user_type = 'user')
    {
        $selected = 'no';
        $user_gen_prefix = $this->conn->setting('user_gen_prefix');
        $user_gen_digit = $this->conn->setting('user_gen_digit');
        $user_gen_fun = $this->conn->setting('user_gen_fun');
        while ($selected == 'no') {
            $selected = 'yes';
            $username = $user_gen_prefix . random_string($user_gen_fun, $user_gen_digit);
            $check_username_exists = $this->conn->runQuery('username', 'users', "username='$username'");
            if ($check_username_exists) {
                $selected = 'no';
            }
        }
        return $username;
    }

    public function get_reg_conditions()
    {

        $sts = $this->conn->setting('register_enable');
        $sts_mobile = $this->conn->setting('mobile_users');
        $sts_enail = $this->conn->setting('email_users');

        $chk['reg_status'] = $sts;
        // $chk['reg_mob_status']=$sts_mobile;
        // $chk['reg_email_status']=$sts_enail;
        $chk['res'] = 'success';
        print_r(json_encode($chk));

    }

}
