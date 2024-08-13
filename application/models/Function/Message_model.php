<?php
class Message_model extends CI_Model{

   /* public function sms($mobile,$sms){
        $msg=urlencode($sms);
        
        $url = "http://smartsms.smseasy.in/domestic/sendsms/bulksms_v2.php?apikey=ZXJhY29tOnl4UloyUUV2&type=TEXT&sender=YUNDAY&mobile=$mobile&message=$msg";
        $this->curl->simple_get($url);
    }*/
    
    /*public function sms($mobile,$sms){
        $sms=$sms." Bharat E Park";
        $mobile="91".$mobile;
        $msg=urlencode($sms); 
        $url="http://otp.smseasy.in/api/mt/SendSMS?user=BEPARK&password=BEPARK&senderid=BEPARK&channel=trans&DCS=0&flashsms=0&number=$mobile&text=$msg&route=1";
        //die();
        /////////////////////////////////////////////////////////
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url, 
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS =>"{\r\n    \"Username\":\"577BDD\",\r\n    \"Password\":\"M2UM93\",\r\n    \"mobile\":\"$mobile\"\r\n    \r\n    }",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Cookie: __cfduid=d5c5dc10889577854e9e9d0b9251db8291617346991"
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        ////////////////////////////////////////////////////////
       
    }*/
   
   public function sms($mobile,$sms){
        $sms=$sms." YUNDAY";
        $mobile="91".$mobile;
        $msg=urlencode($sms); 
        $url="http://otp.smseasy.in/api/mt/SendSMS?user=eracom&password=eracom&senderid=YUNDAY&channel=trans&DCS=0&flashsms=0&number=$mobile&text=$msg&route=1";
        //die();
        /////////////////////////////////////////////////////////
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url, 
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POSTFIELDS =>"{\r\n    \"Username\":\"577BDD\",\r\n    \"Password\":\"M2UM93\",\r\n    \"mobile\":\"$mobile\"\r\n    \r\n    }",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Cookie: __cfduid=d5c5dc10889577854e9e9d0b9251db8291617346991"
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        ////////////////////////////////////////////////////////
       
    }
    
    
    
    
    
    public function watsapp_sms($mobile,$country_code,$massage){
        
         $mobile=$country_code.$mobile;
         $msg=$massage;
    
         $curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => "https://wapi.smseasy.in/api/sendText?token=63317630ee2eb174cbb622f9&phone=.$mobile.&message=$msg",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'GET',
						  CURLOPT_HTTPHEADER => array(
							'Content-Type: application/json',
							'Cookie: JSESSIONID=90BBA8BA62FDC7A94474DCAC2D6D14DD'
						  ),
						));

						$response = curl_exec($curl);
						curl_close($curl);
					//	echo $response;
						$ress=json_decode($response,true);
        
        
        
        
        
        return json_encode(array('error'=>false));
    }
    
    
    
    
 function sendnotification($to, $title='fhusdhfuh', $message="test", $img = "https://www.google.co.in/images/branding/googleg/1x/googleg_standard_color_128dp.png", $datapayload = ""){
 $msg = urlencode($message);
 $datapayload = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

$pay_load=json_encode($datapayload);
$data = array(
    'title'=>$title,
    'sound' => "default",
    'msg'=>$msg,
    'data'=>$pay_load,
    'body'=>$message,
    'color' => "#79bc64"
);
if($img){
    $data["image"] = $img;
    $data["style"] = "picture";
    $data["picture"] = $img;
}
$fields = array(
    'to'=>$to,
    'notification'=>$data,
    'data'=>$pay_load,
    "priority" => "high",
);
$headers = array(
    'Authorization: key=AAAA2aL07Oo:APA91bHLCoBA9aztGsvM6W09FG7DVcuBUOUS8pIt8iJQag2juGPHMXFig230LWyqYMSQOkaVoxPgG1g8BiT0qmhTTpD2TP_oDC32OFjBi9Z0Cls4l0zf4UV74nq5Qr4Ek1Ao7GqAAcYU',
    'Content-Type: application/json'
);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close( $ch );
return $result;
    
}
    
    
    
    function testin_noti(){
        
         $url = "https://fcm.googleapis.com/fcm/send";
        $topico = "e76GNNW9Q4-e840U3C5dFC:APA91bGOmB-PTwXQmUf641f_jCObGRS6Y8b0yar1xkw4-MaqLeECIjtHJ5MKk1JGAR7vHlR15rfSeQlR3QQ1z7l_tNcwvE4aX7wB2-K2nYWGV78MJNPUnPIVQ83MSfw9c5RWnCdbC14q";
        $api_key = "AAAA2aL07Oo:APA91bHLCoBA9aztGsvM6W09FG7DVcuBUOUS8pIt8iJQag2juGPHMXFig230LWyqYMSQOkaVoxPgG1g8BiT0qmhTTpD2TP_oDC32OFjBi9Z0Cls4l0zf4UV74nq5Qr4Ek1Ao7GqAAcYU"; //FIREBASE KEY
        $titulo = "Notification Title";
        $corpo = "Notification Message...";
        $legenda = "SubTitle...";
     

            $headers = array
            (
                'Authorization: key='.$api_key,
                'Content-Type: application/json;charset=UTF-8'
            );
         
            $data = array
            (
              'data' =>
              array (
                'title' => $titulo,
                'body' => $corpo,
                'subtitle' => $legenda,
              ),
              'to' => $topico,
              'priority' => 'high',
              //'restricted_package_name' => 'com.onlyoneapp.test', //IF YOU WANT SEND TO ONLY ONE APP
            );
       

            $content = json_encode($data);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false );
            $result = curl_exec($curl);
            curl_close($curl);
            $arr = array();
            $arr = json_decode($result,true);
         
            if ($arr === FALSE) {
                echo "Json invalido!"."<br>";
            } else if (empty($arr)) {
                echo "Json invalido!"."<br>";
            }else{
                if (array_key_exists ('message_id', $arr)){
                    echo "Mensagem enviada! <br>Mensagem id: ".$arr['message_id']."<br>";
                }else{
                    echo "Ocorreu um erro ao enviar a notificação!"."<br>";
                }
            }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    function send_mail1($email,$Subject,$message){
        $mailer_username="d24e1e90f8b0e00d00a8fbea436e4202";//$this->conn->company_info('mailer_username');
		$mailer_password="48ab46705c49278f273e89bc770db91c";//$this->conn->company_info('mailer_password');
		$mailer_setFrom=$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		//$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	   // $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "in-v3.mailjet.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  25;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg='hello';//$this->temp($message,$Subject);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    }
	    else{
	         return false;
	    }
    }
    
    
    
    
    public function send_mail($email,$Subject,$message,$u_code) {

		$mailer_username=$this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "mail.privateemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->temp($message,$Subject);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}
	public function temp($message,$Subject){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
		
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		.container{
			padding:40px;
		}
		h1{
			text-align:center;
		}
		
		h2{
			text-align:center;
			background-color:#37326C;
			color:white;
		}
		
		h3{
			
			text-align:center;
			background-color:#FEC601;
			color:white;
		}
		
		h4{
			text-align:center;
			
			
		}
		h5{
			text-align:center;
		color:#ff8000;
		
		}
		P {
		font-family: "trebuchet MS";
		color: #222222; 
		font-size: 15pt;
		text-align: justify;  
		line-height: 18px;  
		
		margin-top: 10px;
		}
		
		.content-text {
		
		color: #222222; 
		font-size: 10pt;
		text-align: center;
		line-height: 20px; 
		
		}
		.email{
			color:blue;
		}
		</style>
		
		</head>
		<body>
		
		
				
				
			
		<div class="container">
		 
		
		         <h1>Important Message.</h1>             
		         <h2>'.$company.'</h2>             
		         <h3>'.$Subject.'</h3>
		
		
		 '.$message.'
		
		
				 
		      
		
		<hr>
		
		<h4>'.$company.'</h4>
		<h4>Ceo & Founder</h4>
		<h4>Email: <span class="email">'.$mailer_ReplyTo.'</span></h4>
		 
		
		<hr>
		<p class="content-text">The content of this email is confidential and intended for the recipient specified in message only. it is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. if you received this message by mistake, please reply  to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future. </p>
		
		 </div>       
				
		 
		  
		</body>
		</html>';
		 return $res;
	}
	 
	 
	 
	 
  
  
  public function send_mail22($email,$Subject,$message,$u_code) {

		$mailer_username=$this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$mailer_username;//$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$mailer_username;//$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "mail.privateemail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->temp22($message,$Subject,$u_code);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}
	public function temp22($message,$Subject,$u_code){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
		$logo=base_url().'images/logo/gambit.png';
		$back_footer=base_url().'images/logo/footer.png';
		$profile=$this->profile->profile_info($u_code);
		
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
       <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<style>
		
            .email_data {
                max-width: 600px;
                width: 100%;
                border: 1px solid #cdcaca;
                margin: auto;
                border-radius: 10px;
               background-blend-mode: overlay;
                background-color: rgba(0,0,0,.9);
                
                background-position: 50%;
                background-size: cover;
                
            }
            
            .email_logo img {
                width: 110px;
                 margin-bottom: 10px;
            }
            
            .email_logo {
                padding: 20px;
                text-align: center;
            }
            
            .email_logo h2 {
                margin: 0px;
                /* text-transform: capitalize; */
               font-size: 26px;
                font-family: fangsong;
                letter-spacing: 0.5;
                -webkit-background-clip: text;
                background-clip: text;
                background-image: linear-gradient(90deg,#462523 0,#cb9b51 22%,#f6e27a 45%,#f6f2c0 50%,#f6e27a 55%,#cb9b51 78%,#462523);
              color: transparent;
               text-align: center;
                text-transform: uppercase;
            }
            hr.email_line {
                width: 100%;
                color: #fdd16473;
            }
            .email_pass {
                padding: 10px 20px;
            }
            
            .email_pass h6 {
                font-size: 22px;
                text-transform: capitalize;
                font-weight: 400;
                text-align: center;
                color: #f2db76;
            }
            
            .email_pass h6 b {
                font-size: 20px;
            }
            
            .email_pass p {
                padding: 10px 20px;
            }
            
            .email_para {
                padding: 10px 20px 30px 20px;
            }
            .email_para p {
                margin: 0px;
                color: #ffffffbd;
            }
		</style>
		
		</head>
		<body>
		
		
		    
			 <div class="email_template">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="email_data" style="background-image:'.$back_footer.'">
                        <div class="email_logo">
                            <img src='.$logo.' alt="images">
                            <h2>'.$company.'</h2>
                        </div>
                        <hr class="email_line"></hr>
                        <div class="email_pass">
                            <h6>Broker Name:  <b>Marvel Profit Marketing Ltd</b></h6>
                            <h6>AC Number:  <b>781001</b></h6>
                           <h6>Password:  <b>gambit@1234</b></h6>
                        </div>
                        <hr class="email_line">
                        </hr>
                        <div class="email_para">
                        <p>
                        This Id is given for viewing your MT5 account only Is.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
		 
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://gambitbot.io/main/159/assets/css/script.js"></script>
   
		</body>
		</html>';
		 return $res;
	}
	 
	    public function send_mail_new($email,$Subject,$message,$userid,$otp) {

		$mailer_username=$this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$mailer_username;//$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$mailer_username;//$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	   $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtp.hostinger.in";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';;
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->tempnewone($message,$Subject,$userid,$otp);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}


	 	public function tempnewone($message,$Subject,$userid,$otp){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_username');
		$company=$this->conn->company_info('company_name');
        $company_address=$this->conn->company_info('company_address');
        $company_email=$this->conn->company_info('company_email');
        $company_mobile=$this->conn->company_info('company_mobile');
        
		$logo=$this->conn->company_info('logo');
		$facebook_logo=$this->conn->company_info('logo_fb');
		$twitter_logo=$this->conn->company_info('logo_twitter');
		$instagram_logo=$this->conn->company_info('logo_insta');
		$youtube_logo=$this->conn->company_info('logo_youtube');
		$linkdin_logo=$this->conn->company_info('linkdin_logo');
		$company_telegram_link=$this->conn->company_info('company_telegram_link');
		$company_twitter_link=$this->conn->company_info('company_twitter_link');
		$company_facebook_link=$this->conn->company_info('company_facebook_link');
		$company_linkedin_link=$this->conn->company_info('company_linkedin_link');
	//	$background_img=$this->conn->company_info('');
		$profile=$this->conn->runQuery('*','users',"username='$userid'");
	
	    $base_url=base_url();
	
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	   
	    <style>

.emailpage {
    width: 100%;
   
    text-align: center;
    padding: 20px 0px;
   
}
p.contact_us {
    color: #fff;
    font-size:12px;
}
h6.moreInfo_middle a p {
    color: #fff;
    font-size: 16px;
    
}
.emailDiv {
    width: 100%;
    max-width: 600px;
    text-align: center;
    margin: auto;
    background: #1d1d1d;
  
}

#anim {
    width: 200px;
    margin: auto;
}

#logo {
    width: 100px;
    margin-top: 10px;
    margin-bottom: 20px;
}

.header {
    width: 100%;
    height: 120px;
    background: #73ba3f;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 40px;
    font-weight: 700;
    letter-spacing: 1px;
}

.contentDiv {
    padding: 0px 40px;
}

.contentDiv h4 {
    color: #fff;
    font-size: 25px;
}

.contentDiv p {
    margin-top: 15px;
    color:#fff;
    font-size: 16px;
  line-height: 24px;
 text-align: center;
}

.contentDiv span {
    color:#fff;
    font-size: 12px;
}

.codeBtn {
    margin: auto;
    margin-bottom:5px;
    margin-top: 20px;
    padding: 10px 30px;
    border-radius: 5px;
    border: 1px solid #73ba3f;
    background: #73ba3f;
    color: #fff;
    letter-spacing: 4px;
    font-size: 24px;
    display: block;
    -webkit-user-select: text;
  -moz-user-select: text;
  -ms-user-select: text;
  user-select: text;
 
}
a {
    text-decoration: none;
}
.codePrimary {
    margin: auto;
    margin-top: 10px;
    padding: 5px 14px;
    border-radius: 5px;
    border: 1px solid #73ba3f;
    background: #73ba3f;
    color: #fff;
    font-size: 12px;
    display: block;

}

.socialMedia div {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 7px;
    gap: 10px;
}

.socialMedia h5 {
    margin-top: 10px;
}

.socialMedia div img {
    width: 20px;
}

.socialMedia p {
    color: #666666;
    font-size: 12px;
}
h6.moreInfo_middle a {
    color: #fff;
    margin-right: 16px;
}
.haveQuestion {
    padding: 20px;
    padding-bottom: 30px;
    background:#73ba3f;
    color: #fff;
    text-align: left;
    margin-top: 30px;
}

.haveQuestion h5 {
    font-size: 20px;
    font-weight: 500;
    margin:5px 0px;
}

.haveQuestion p {
    font-size: 14 px;
    font-weight: 300;
}
h6.moreInfo_middle {
  margin:0px;
    text-align:center;
    display: inline-flex;
    justify-content: space-around;
    width: auto;
   
}
.moreInfo {
   
    margin-top: 10px;
}

.moreInfo a {
    flex: 1;
    color: #0B5394;
    cursor: pointer;
    margin-bottom: 20px;
}

.moreInfo a:nth-child(2) {
    border-left: 1px solid #0B5394;
    border-right: 1px solid #0B5394;
}

#smallText {
    font-size: 12px;
    color: #666666;
    padding: 0px 40px;
}

h2.back_detail {
    background: #73ba3f;
    padding: 20px;
    color: #fff;
    text-transform: capitalize;
}
h5.demo_b{
     color: #000;
    text-transform: capitalize;
        text-align: center;
}

h5.demo_b a img {
    width: 30px;
    margin-right:5px;
}

h5.follow_us {
    color: #fff;
}

h6.moreInfo_middle a {
    color: #fff;
}

h6.moreInfo_middle a p {
    color: #fff;
}
p.moreInfo_bottom{
 margin-top:0px;
    text-align:center;
    margin-bottom:20px;
}
	    </style>
		</head>
		<body>
		
	        <section class="emailpage">
        <div class="emailDiv">
             <h2 class="back_detail">'.$Subject.'</h2>
            <!--<lottie-player id="anim" src="'.$background_img.'" background="transparent" speed="1" class="error_content"
                loop autoplay></lottie-player>-->
            <div class="contentDiv">
                <h4>'.$company.'</h4>
                <p>HI '.$userid.'<br />
                    '.$message.'</p>
                 <!-- <button class="codeBtn" id="code" onclick="CopyFromtag("code")">'.$otp.'</button>-->
                <button class="codeBtn" id="code" onclick="CopyFromtag("code")">'."$otp".'</button>
                <p>If did not make this request, just ignore this email. Otherwise, please click the button below to
                    change your password:</p>
               <a href="https://g.gambitbot.io/forget_password" ><button class="codePrimary" id="code">Reset Password</button>
           </a>
            </div>
            <div class="">
                <h5 class="follow_us">Follow us</h5>
                <div>
                <h5 class="demo_b">
                    <a href="'.$company_facebook_link.'"><img src="'.$facebook_logo.'" alt="facebook"></a>
                    <a href="'.$company_twitter_link.'"><img src="'.$twitter_logo.'" alt="twitter.png"></a>
                    <a href="'.$company_instagram_link.'"><img src="'.$instagram_logo.'" alt="instagram.png"></a>
                    <a href="'.$company_youtube_link.'"><img src="'.$youtube_logo.'" alt="youtube.png"></a>
                   
                    </h5>
                </div>
                <p class="contact_us">Contact us: '.$company_mobile.' | '.$company_email.'</p>
            </div>
            <div class="haveQuestion">
                <h5>Have quastions?</h5>
                <p>We are here to help, learn more about us here or contact us</p>
            </div>
            <div class="moreInfo">
            <h6 class="moreInfo_middle">
                <a href="https://g.gambitbot.io/register">
                    <p>Sign up</p>
                </a>
                <a href="https://g.gambitbot.io/">
                    <p>Login</p>
                </a>
                <a href="https://gambitbot.io/about">
                    <p>About us</p>
                </a>
                </h6>
            </div>
           
            <div><p class="moreInfo_bottom"><img id="logo" src="'.$logo.'" alt="" ></p></div>
        </div>

    </section>  
    
    
    
  
		</body>
		  <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    
		 <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script>
        async function CopyFromtag(id) {
        
            var text = document.getElementById(id).innerText;
            
            var elem = document.createElement("textarea");
            document.body.appendChild(elem);
            elem.value = text;
            elem.select();
            document.execCommand("copy");
            document.body.removeChild(elem);
            var temp = document.getElementById(id);
            temp.innerText = "Copied!"
            let delayres = await delay(1000);
            temp.innerText = text
        };

        const delay = (delayInms) => {
            return new Promise(resolve => setTimeout(resolve, delayInms));
        }

    </script>		
		 
		  
		
		</html>';
	
		 return $res;
	}
	
	 
	 
	 public function send_mail_admin($email,$Subject,$message,$u_code,$pass) {

		$mailer_username=$this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$mailer_username;//$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$mailer_username;//$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtp.hostinger.in";
	   // $config['smtp_host']    = "smtp.titan.email";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->tempadmin($message,$Subject,$u_code,$pass);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}
	public function tempadmin($message,$Subject,$u_code,$pass){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
		$logo=base_url().'images/logo/gambit.png';
		$back_footer=base_url().'images/logo/footer.png';
		$profile=$this->profile->profile_info($u_code);
		
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
       <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<style>
		
            .email_data {
                max-width: 600px;
                width: 100%;
                border: 1px solid #cdcaca;
                margin: auto;
                border-radius: 10px;
               background-blend-mode: overlay;
                background-color: rgba(0,0,0,.9);
                
                background-position: 50%;
                background-size: cover;
                
            }
            
            .email_logo img {
                width: 110px;
                 margin-bottom: 10px;
            }
            
            .email_logo {
                padding: 20px;
                text-align: center;
            }
            
            .email_logo h2 {
                margin: 0px;
                /* text-transform: capitalize; */
               font-size: 26px;
                font-family: fangsong;
                letter-spacing: 0.5;
                -webkit-background-clip: text;
                background-clip: text;
                background-image: linear-gradient(90deg,#462523 0,#cb9b51 22%,#f6e27a 45%,#f6f2c0 50%,#f6e27a 55%,#cb9b51 78%,#462523);
              color: transparent;
               text-align: center;
                text-transform: uppercase;
            }
            hr.email_line {
                width: 100%;
                color: #fdd16473;
            }
            .email_pass {
                padding: 10px 20px;
            }
            
            .email_pass h6 {
                font-size: 22px;
                text-transform: capitalize;
                font-weight: 400;
                text-align: center;
                color: #f2db76;
            }
            
            .email_pass h6 b {
                font-size: 20px;
            }
            
            .email_pass p {
                padding: 10px 20px;
            }
            
            .email_para {
                padding: 10px 20px 30px 20px;
            }
            .email_para p {
                margin: 0px;
                color: #ffffffbd;
            }
		</style>
		
		</head>
		<body>
		
		
		    
			 <div class="email_template">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="email_data" style="background-image:'.$back_footer.'">
                        <div class="email_logo">
                            <img src='.$logo.' alt="images">
                            <h2>'.$company.'</h2>
                        </div>
                        <hr class="email_line"></hr>
                        <div class="email_pass">
                            <h6>username: <b>'.$u_code.' </b></h6>
                           <h6>passowrd: <b>'.$pass.'</b></h6>
                           <h6>Broker Name:  <b>Marvel Profit Marketing Ltd</b></h6>
                            <h6>AC Number:  <b>781001</b></h6>
                           <h6>Password:  <b>gambit@1234</b></h6>
                        </div>
                          
                        <hr class="email_line">
                        </hr>
                        <div class="email_para">
                        <p>
                       This Id is given for viewing your MT5 account only Is.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
		 
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://test.mlmreadymade.com/Gambit-6/main/159/assets/css/script.js"></script>
   
		</body>
		</html>';
		 return $res;
	}
	 
	 

	 
	 
	
	
	 public function send_mail3($email,$Subject,$message) {

		$mailer_username='info@welifecare.co.in';
		$mailer_password='Raj@12345#';
		$mailer_setFrom='info@welifecare.co.in';
		$mailer_ReplyTo='info@welifecare.co.in';
		$company=$this->conn->company_info('title');
		
		//$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	   // $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtpout.secureserver.net";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->temp3($message,$Subject);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    }
	    else{
	         return false;
	    }
}
	public function temp3($message,$Subject){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
		
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		.container{
			padding:40px;
		}
		h1{
			text-align:center;
		}
		
		h2{
			text-align:center;
			background-color:#37326C;
			color:white;
		}
		
		h3{
			
			text-align:center;
			background-color:#FEC601;
			color:white;
		}
		
		h4{
			text-align:center;
			
			
		}
		h5{
			text-align:center;
		color:#ff8000;
		
		}
		P {
		font-family: "trebuchet MS";
		color: #222222; 
		font-size: 15pt;
		text-align: justify;  
		line-height: 18px;  
		
		margin-top: 10px;
		}
		
		.content-text {
		
		color: #222222; 
		font-size: 10pt;
		text-align: center;
		line-height: 20px; 
		
		}
		.email{
			color:blue;
		}
		</style>
		
		</head>
		<body>
		
		
				
				
			
		<div class="container">
		 
		
		         <h1>Important Message.</h1>             
		         <h2>'.$company.'</h2>             
		         <h3>'.$Subject.'</h3>
		
		
		 '.$message.'
		
		
				 
		      
		
		<hr>
		
		<h4>'.$company.'</h4>
		<h4>Ceo & Founder</h4>
		<h4>Email: <span class="email">'.$mailer_ReplyTo.'</span></h4>
		 
		
		<hr>
		<p class="content-text">The content of this email is confidential and intended for the recipient specified in message only. it is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. if you received this message by mistake, please reply  to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future. </p>
		
		 </div>       
				
		 
		  
		</body>
		</html>';
		 return $res;
	}
	
	
	
	
	
	
	
    public function send_mail5($email,$Subject,$message) {

		$mailer_username='coinexperia5@gmail.com';    //$this->conn->company_info('mailer_username');
		$mailer_password='jkp3vy8i';      //$this->conn->company_info('mailer_password');
		$mailer_setFrom='coinexperia5@gmail.com';      //$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo='coinexperia5@gmail.com';     //$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "sendmail"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtp.gmail.com";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->temp5($message,$Subject);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}
	public function temp5($message,$Subject){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
		
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		.container{
			padding:40px;
		}
		h1{
			text-align:center;
		}
		
		h2{
			text-align:center;
			background-color:#37326C;
			color:white;
		}
		
		h3{
			
			text-align:center;
			background-color:#FEC601;
			color:white;
		}
		
		h4{
			text-align:center;
			
			
		}
		h5{
			text-align:center;
		color:#ff8000;
		
		}
		P {
		font-family: "trebuchet MS";
		color: #222222; 
		font-size: 15pt;
		text-align: justify;  
		line-height: 18px;  
		
		margin-top: 10px;
		}
		
		.content-text {
		
		color: #222222; 
		font-size: 10pt;
		text-align: center;
		line-height: 20px; 
		
		}
		.email{
			color:blue;
		}
		</style>
		
		</head>
		<body>
		
		
				
				
			
		<div class="container">
		 
		
		         <h1>Important Message.</h1>             
		         <h2>'.$company.'</h2>             
		         <h3>'.$Subject.'</h3>
		
		
		 '.$message.'
		
		
				 
		      
		
		<hr>
		
		<h4>'.$company.'</h4>
		<h4>Ceo & Founder</h4>
		<h4>Email: <span class="email">'.$mailer_ReplyTo.'</span></h4>
		 
		
		<hr>
		<p class="content-text">The content of this email is confidential and intended for the recipient specified in message only. it is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. if you received this message by mistake, please reply  to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future. </p>
		
		 </div>       
				
		 
		  
		</body>
		</html>';
		 return $res;
	}
	 


public function send_mail_reg2($email,$Subject,$message) {

		$mailer_username=$this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$mailer_username;//$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$mailer_username;//$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtp.hostinger.in";
	   // $config['smtp_host']    = "smtp.titan.email";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->tempreg($message,$Subject);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}
	public function tempreg($message,$Subject){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
		
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
		.container{
			padding:40px;
		}
		h1{
			text-align:center;
		}
		
		h2{
			text-align:center;
			background-color:#37326C;
			color:white;
		}
		
		h3{
			
			text-align:center;
			background-color:#FEC601;
			color:white;
		}
		
		h4{
			text-align:center;
			
			
		}
		h5{
			text-align:center;
		color:#ff8000;
		
		}
		P {
		font-family: "trebuchet MS";
		color: #222222; 
		font-size: 15pt;
		text-align: justify;  
		line-height: 18px;  
		
		margin-top: 10px;
		}
		
		.content-text {
		
		color: #222222; 
		font-size: 10pt;
		text-align: center;
		line-height: 20px; 
		
		}
		.email{
			color:blue;
		}
		</style>
		
		</head>
		<body>
		
		
				
				
			
		<div class="container">
		 
		
		         <h1>Important Message.</h1>             
		         <h2>'.$company.'</h2>             
		         <h3>'.$Subject.'</h3>
		
		
		 '.$message.'
		
		
				 
		      
		
		<hr>
		
		<h4>'.$company.'</h4>
		<h4>Ceo & Founder</h4>
		<h4>Email: <span class="email">'.$mailer_ReplyTo.'</span></h4>
		 
		
		<hr>
		<p class="content-text">The content of this email is confidential and intended for the recipient specified in message only. it is strictly forbidden to share any part of this message with any third party, without a written consent of the sender. if you received this message by mistake, please reply  to this message and follow with its deletion, so that we can ensure such a mistake does not occur in the future. </p>
		
		 </div>       
				
		 
		  
		</body>
		</html>';
		 return $res;
	}
	 
	 
	
 public function send_mail_reg($email,$Subject,$message,$u_code) {

		$mailer_username=$this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$mailer_username;//$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$mailer_username;//$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtp.hostinger.in";
	    // $config['smtp_host']    = "smtp.titan.email";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->tempnew($message,$Subject,$u_code);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}


	public function tempnew($message,$Subject,$u_code){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
                $company_address=$this->conn->company_info('company_address');
		$logo=base_url().'images/logo/gambit.png';
                $fb=$this->conn->company_info('logo_fb');
                $insta=$this->conn->company_info('logo_insta');
                $tw=$this->conn->company_info('logo_twitter');
                $yt=$this->conn->company_info('logo_youtube');
		$res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
		 .news_letter_content {
            width: 100%;
            max-width: 600px;
            background: #f1ecec3d;
            border-radius: 4px;
            margin: auto;
        }

        .footer_news span {
            font-size: 14px;
        }

        .footer_news {
            padding: 15px;
            text-align: center;
        }

        .footer_data ul {
            display: flex;
            margin: 0px;
            margin-top: 10px;
            padding: 0px;
            text-align: center;
            list-style: none;
            gap: 10px;
            justify-content: center;
        }

        .footer_data ul li {
            width: 35px;
            height: 35px;
            background: #f8ab05;
            text-align: center;
            line-height: 35px;
            border-radius: 40px;
            color: #fff;
        }

        .btn_read button {
            padding: 6px 12px;
            border: none;
            background: #f8ab05;
            border-radius: 4px;
            color: #000;
            text-transform: capitalize;
            font-weight: 700;
            margin: auto;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .news_logo_content h2 {
            font-size: 24px;
            text-transform: capitalize;
            font-family: emoji;
            font-size: 700;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .news_logo img {
            width: 113px;
        }

        .news_logo {
            padding: 24px;
            background: #000000ed;
            text-align: center;
            margin: auto;
        }

        .news_logo_content {
            text-align: center;
            background: #f1f1f103;
            padding: 30px 30px 15px 30px;
        }

        .register_office p {
            font-size: 12px;
            margin: 0px;
        }

        .register_office {
            padding: 20px;
        }

        .news_logo_content p {
            font-size: 12px;
        }

        .news_pass h4 {
            font-size: 18px;
            text-transform: capitalize;
        }

        .btn_read {
            margin-top: 20px;
        }

        .btn_read h4 {
            font-size: 14px;
            font-weight: 600;
        }

        .footer_news h6 {
            text-transform: capitalize;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .footer_data span {
            color: #fff;
            font-size: 12px;
            text-transform: capitalize;
        }

        .footer_data h6 {
            color: #fff;
            font-size: 18px;
            text-transform: capitalize;
            margin-bottom: 5px;
        }

        .footer_data {
            background: #121212;
            text-align: center;
            padding: 15px;
        }

        .footer_news button {
            padding: 8px 12px;
            border: none;
            background: #f8ab05;
            border-radius: 4px;
            color: #000;
            text-transform: capitalize;
            font-weight: 700;
            margin-top: 10px;
            font-size: 12px;
        }

        .footer_data p {
            margin: 0px;
            font-size: 12px;
            margin-top: 5px;
            color: #fff;
        }

        .gam_link {
            display: block;
        }

        .compnay_email {
            color: #FAAC02;
            font-family: serif;
            font-size: 18px;
            font-weight: 900;
            letter-spacing: 2px;
            margin-bottom: 5px;
            text-transform: uppercase;
            text-shadow: 1px 1px #121212;
        }

		</style>
		
		</head>
		<body>
		

 <section class="news_letter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="news_letter_content">
                        <div class="news_logo">
                            <img src='.$logo.'>
                        </div>
                        <div class="news_logo_content">
                            <h3 class="compnay_email">Welcome To Gambitbot</h3>
                            <p>'.$message.'</p>
                            <div class="news_pass">
                                <h4>username: <b>'.$u_code.'</b></h4>
                            </div>
                            <div class="btn_read">
                                
                                <h4>General Risk Warning</h4>
                                <p>The financial products offered by the company carry a high level of risk and can
                                    result in the loss of all your funds. You should never invest money that you cannot
                                    afford to lose.Before deciding to participate in the Forex market, you should
                                    carefully consider your investment objectives, level of experience and risk
                                    appetite. Most importantly, do not invest money you cannot afford to lose.
                                </p>
                                <button class="gam_link">read more</button>
                            </div>
                        </div>
                        <div class="footer_news">
                            <h6>Any questions?We re here to help</h6>
                            <button>get in touch</button>
                        </div>
                        <div class="footer_data">
                            <h6>Stay Connected</h6>
                            <span>get all the latest news </span>
                            <ul>
                                <li style="background:blue;"><img src='.$fb.' style="widht:35px; height:35px;"></li>
                                <li ><img src='.$insta.' style="widht:35px; height:35px;"></li>
                                <li ><img src='.$tw.' style="widht:35px; height:35px;"></li>
                                <li ><img src='.$yt.' style="widht:35px; height:35px;"></li>
                            </ul>
                        </div>
                        <div class="register_office">
                            <p class="office_address"><b>Registered office:</b>
                                Gambit Limited whose registered office is 9th Floor 107 Cheapside, London, United
                                Kingdom, EC2V 6DN, is a registered company FRO UK Company House, Company registration
                                number : 232324, Operating trading service business globally according to UK Law and
                                regulation.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>     
				
		 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		  
		</body>
		</html>';
		 return $res;
	}






 public function send_mail_admin_new($email,$Subject,$message,$u_code,$pass) {

		$mailer_username= $this->conn->company_info('mailer_username');
		$mailer_password=$this->conn->company_info('mailer_password');
		$mailer_setFrom=$mailer_username;//'support@gambitbot.io';//$this->conn->company_info('mailer_setFrom');
		$mailer_ReplyTo=$mailer_username;//'support@gambitbot.io';//$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('title');
		
		$this->load->library('email');  
	    $from_email=$mailer_setFrom; 
	    $config = array();
	    $config['protocol']     = "smtp"; // you can use 'mail' instead of 'sendmail or smtp'
	    $config['smtp_host']    = "smtp.hostinger.in";
	    //$config['smtp_host']    = "smtp.titan.email";// you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
	    $config['smtp_port']    =  465;
	    $config['smtp_timeout'] = '60';
	    $config['smtp_crypto']  = 'ssl';
	    
	    $config['smtp_user']    = $mailer_username; // client email gmail id
	    $config['smtp_pass']    = $mailer_password; // client password
	    
	    $config['charset']      = 'utf-8';
	    $config['newline']      = "\r\n";
	    $config['mailtype']     = "html";
	    $config['validate']     = TRUE;
	    $this->email->initialize($config); // intializing email library, whitch is defiend in system
	
	    $this->email->set_mailtype("html");
	
	    $this->email->from($from_email);
	    $this->email->to($email);
	    $this->email->subject($Subject); 
	    $msg=$this->tempadn($message,$Subject,$u_code,$pass);
	    
	    $this->email->message($msg);  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
	    //Send mail
	    if($this->email->send()){
	    	 return true;
	    
	    }
	    else{
	         return false;
	    }
}


	public function tempadn($message,$Subject,$u_code,$pass){
		  
		
		 
		$mailer_ReplyTo=$this->conn->company_info('mailer_ReplyTo');
		$company=$this->conn->company_info('company_name');
                $company_address=$this->conn->company_info('company_address');
		$logo=base_url().'images/logo/gambit.png';
                $fb=$this->conn->company_info('logo_fb');
                $insta=$this->conn->company_info('logo_insta');
                $tw=$this->conn->company_info('logo_twitter');
                $yt=$this->conn->company_info('logo_youtube');
                
    $res='<!docytpe html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
       <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<style>
		
            .email_data {
                max-width: 600px;
                width: 100%;
                border: 1px solid #cdcaca;
                margin: auto;
                border-radius: 10px;
               background-blend-mode: overlay;
                background-color: rgba(0,0,0,.9);
                
                background-position: 50%;
                background-size: cover;
                
            }
            
            .email_logo img {
                width: 110px;
                 margin-bottom: 10px;
            }
            
            .email_logo {
                padding: 20px;
                text-align: center;
            }
            
            .email_logo h2 {
                margin: 0px;
                /* text-transform: capitalize; */
               font-size: 26px;
                font-family: fangsong;
                letter-spacing: 0.5;
                -webkit-background-clip: text;
                background-clip: text;
                background-image: linear-gradient(90deg,#462523 0,#cb9b51 22%,#f6e27a 45%,#f6f2c0 50%,#f6e27a 55%,#cb9b51 78%,#462523);
              color: transparent;
               text-align: center;
                text-transform: uppercase;
            }
            hr.email_line {
                width: 100%;
                color: #fdd16473;
            }
            .email_pass {
                padding: 10px 20px;
            }
            
            .email_pass h6 {
                font-size: 22px;
                text-transform: capitalize;
                font-weight: 400;
                text-align: center;
                color: #f2db76;
            }
            
            .email_pass h6 b {
                font-size: 20px;
            }
            
            .email_pass p {
                padding: 10px 20px;
            }
            
            .email_para {
                padding: 10px 20px 30px 20px;
            }
            .email_para p {
                margin: 0px;
                color: #ffffffbd;
            }
		</style>
		
		</head>
		<body>
		
		
		    
			 <div class="email_template">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="email_data" style="background-image:'.$back_footer.'">
                        <div class="email_logo">
                            <img src='.$logo.' alt="images">
                            <h2>'.$company.'</h2>
                        </div>
                        <hr class="email_line"></hr>
                        <div class="email_pass">
                            <h6>username: <b>'.$u_code.' </b></h6>
                           <h6>passowrd: <b>'.$pass.'</b></h6>
                           <h6>Broker Name:  <b> Marvel Profit Marketing Ltd</b></h6>
                            <h6>AC Number:  <b>781001</b></h6>
                           <h6>Password:  <b>gambit@1234</b></h6>
                        </div>
                          
                        <hr class="email_line">
                        </hr>
                        <div class="email_para">
                        <p>
                       This Id is given for viewing your MT5 account only Is.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>	
		 
		  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://test.mlmreadymade.com/Gambit-6/main/159/assets/css/script.js"></script>
   
		</body>
		</html>';
		 return $res;
	
	}
	 
	 

}

