<?php
class Testing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test2()
    {
        $array = [
            "1" => "g1",
            "2" => "g1",
            "3" => "g1",
            "4" => "g1",
            "5" => "g1",
            "6" => "g1",
            "7" => "g2",
            "8" => "g2",
            "9" => "g2",
            "10" => "g2",
            "11" => "g2",
            "12" => "g2",
            "13" => "g3",
        ];
        $values = array_keys($array, 'g3');
        echo end($values);
    }

    public function placeTestIds()
    {
        for ($i = 2; $i < 20; $i++) {
            $res[] = $this->distribute->gen_pool($i, 20, 1);
            $res[] = $this->distribute->gen_pool($i, 20, 7);
            $res[] = $this->distribute->gen_pool($i, 10, 13);
        }
        print_r(json_encode($res));
    }
    public function tester()
    {
        $res = array();
        $u_id = 3;
        if ($u_id != '') {
            $res[] = $this->team->matrix_pool_data($u_id, 'g1');
            $res[] = $this->team->matrix_pool_data($u_id, 'g2');
            $res[] = $this->team->matrix_pool_data($u_id, 'g3');
        }
        $plan = $this->conn->runQuery('id,pool_package,pool_recycle,pool_upgrade,pool_income', 'plan', "id<=13");
        $res[] = $plan;
        print_r(json_encode($res));
    }
    public function testArray()
    {
        // Initialize the array
        $a = [];
        $a["L1"][1] = [2, 3];
        $a["L2"][2] = [4, 5];
        $a["L2"][3] = [6, 7];
        print_r(json_encode($a));
    }
    public function api_test()
    {

        $ch = curl_init();

        $url = "https://gambitbot.io/beta2/jhg7q/user/matrix_data";

        $postData = array(
            'u_id' => 3 // Set the value of u_id here
        );

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            if ($response !== false) {

                // echo "Response: " . $response;
                // $ar = json_decode($response, true);
                print_r($response);
                // $g2 = $ar[0]['g2'];
                // foreach ($g2 as $k => $value) {
                //     echo "<br>" . $k;
                //     //print_r($value);
                //     foreach ($value as $key => $v2) {
                //         echo "<br>" . $key . "<br>";
                //         print_r($v2[$key]);
                //     }
                // }
            } else {
                echo "Error occurred while making the request.";
            }
        }
    }
}
