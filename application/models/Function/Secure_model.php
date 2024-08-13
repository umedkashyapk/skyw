<?php
require_once APPPATH . 'libraries/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
class Secure_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        /* error_reporting(E_ALL);
        
        // Display errors
        ini_set('display_errors', 1);*/
        $this->ga = new PHPGangsta_GoogleAuthenticator();
    }
     public function getQr($secret){
       return $this->ga->getQRCodeGoogleUrl(base_url(), $secret);
    }
    public function getSecret($user_id=null,$table="users"){
        if($user_id!=null){
            $res=$this->conn->runQuery('tfa_secret',$table,"id='$user_id'");
            if(!empty($res)){
                return $res[0]->tfa_secret;
            }
        }else{
            return $this->ga->createSecret();
        }
    }
    public function verify2FA($user_id,$otp,$table="users") {
        $secret=$this->getSecret($user_id,$table);
        $res=$this->ga->verifyCode($secret,$otp, 0);
        return $res;
    }
    public function getStatus($user_id,$table="users"){
        $res=$this->conn->runQuery('tfa_status',$table,"id='$user_id'");
            if(!empty($res)){
                return $res[0]->tfa_status;
            }else{
                return 0;
            }
    }
    public function saveSecret($user_id,$secret,$table="users"){
            $update['tfa_secret']=$secret;
            $update['tfa_status']=true;
            $this->db->where('id',$user_id);
            if($this->db->update($table,$update)){
                return "Secret saved successfully.";
            }
        return "Something went wrong";
    }

    public function acquireLock($user_id,$type='Rank')
{
    // Define a lock file path specific to the user
    $data=[];
    $lockFilePath = FCPATH ."/images/lock/$type$user_id.lock";
    // Attempt to acquire a lock
    $lockFile = fopen($lockFilePath, 'w');

    // Check if the lock was acquired successfully
    if (!$lockFile || !flock($lockFile, LOCK_EX)) {
        // Lock could not be acquired, return false
        return false;
    }

    // Return the lock file handle if the lock was acquired
    $data['path']=$lockFilePath;
    $data['file']=$lockFile;
    return $data;
}

public function releaseLock($lockFile, $lockFilePath)
{
    // Release the lock
    $lockReleased = flock($lockFile, LOCK_UN);
    fclose($lockFile);
    
    // Delete the lock file
    $fileDeleted = unlink($lockFilePath);
    
    // Return an array indicating the status of lock release and file deletion
    return [
        'lockReleased' => $lockReleased,
        'fileDeleted' => $fileDeleted
    ];
}
}