<?php
include_once '../vendor/autoload.php';

$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

try {
    $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    exit($e->getMessage());
}

$tron->setAddress('TEFkTeTuDoWoB3QNdagZVD5YoEHpWUdXr1');
$tron->setPrivateKey('c02f0a6ec5ef40b4af4bfa3104d79ac3');

try {
    $transfer = $tron->send( 'TG6ZaHkyT5dV4zH4XRQyRXrCxvMukpWC9W', 1);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
	
    die($e->getMessage());
}
$haxerror=$transfer['message'];
echo '<pre>';
$fromHex=$tron->fromHex($haxerror);
var_dump($fromHex);
echo '</pre>';