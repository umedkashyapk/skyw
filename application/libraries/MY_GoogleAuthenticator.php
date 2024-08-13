<?php
require_once 'GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';

class MY_GoogleAuthenticator {
    protected $ga;

    public function __construct() {
        $this->ga = new PHPGangsta_GoogleAuthenticator();
    }

    public function createSecret() {
        return $this->ga->createSecret();
    }

    // Add other methods as needed...
}

?>