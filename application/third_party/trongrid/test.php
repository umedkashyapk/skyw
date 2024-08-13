<?php
include_once 'vendor/autoload.php';
 
$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

try {
    $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    exit($e->getMessage());
}


$tron->setPrivateKey('6e9f4260c7710766817aff8ec2c65444b39d9f2c81eb7d3affb8b97d9bcbf852');
$tohex=$tron->toHex('TG6ZaHkyT5dV4zH4XRQyRXrCxvMukpWC9W');
 $tron->setAddress($tohex);
 
 $sendTrx=$tron->sendTrx('TEFkTeTuDoWoB3QNdagZVD5YoEHpWUdXr1',1);
 
echo '<pre>';
print_r(json_encode($sendTrx));
echo '</pre>';
//getEventByTransactionID
//print_r($frhex);

$getEventByTransactionID=$tron->getEventByTransactionID($sendTrx['txID']);
echo '<pre>';
print_r($getEventByTransactionID);
echo '</pre>';
?>