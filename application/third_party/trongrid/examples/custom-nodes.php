<?php
include_once '../vendor/autoload.php';

use IEXBase\TronAPI\Provider\HttpProvider;
use IEXBase\TronAPI\Tron;

$fullNode = new HttpProvider('https://api.trongrid.io');
$solidityNode = new HttpProvider('https://api.trongrid.io');
$eventServer = new HttpProvider('https://api.trongrid.io');
$privateKey = '6e9f4260c7710766817aff8ec2c65444b39d9f2c81eb7d3affb8b97d9bcbf852';

//Example 1
try {
    $tron = new Tron($fullNode, $solidityNode, $eventServer, $privateKey);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    die($e->getMessage());
}