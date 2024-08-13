<?php
if (!function_exists('generate_qrcode')) {
    function generate_qrcode($data, $filename) {
        include_once APPPATH . 'third_party/phpqrcode/qrlib.php';

        // Generate QR code
        QRcode::png($data, $filename, QR_ECLEVEL_L, 10);
    }
}
?>