<?php
include_once '../vendor/autoload.php';

try {
    $tron = new \IEXBase\TronAPI\Tron();

    $generateAddress = $tron->generateAddress(); // or createAddress()
    $isValid = $tron->isAddress($generateAddress->getAddress());


    echo '<br>Address hex: '. $generateAddress->getAddress();
    echo '<br>Address base58: '. $generateAddress->getAddress(true);
    echo '<br>Private key: '. $generateAddress->getPrivateKey();
    echo '<br>Public key: '. $generateAddress->getPublicKey();
    echo '<br>Is Validate: '. $isValid;
    echo '<br>Raw data: ';
	
	echo '<pre>';
	print_r($generateAddress->getRawData());
	echo '</pre>';

} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    echo $e->getMessage();
}



