<?php
require_once 'vendor/autoload.php';

use Endroid\QrCode\QrCode;

// The code or URL you want to convert to a QR code
$code = 'https://test.mlmreadymade.com/Quecoin/register?ref=demo';

// Create a new QR code instance
$qrCode = new QrCode($code);

// Set the size of the QR code
$qrCode->setSize(300);

// Set additional options if needed
// $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0]);
// $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255]);

// Output the QR code image
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();
?>