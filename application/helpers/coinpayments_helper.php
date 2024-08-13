<?php
if (!function_exists('generate_hmac')) {
    function generate_hmac($data, $private_key) {
        return hash_hmac('sha512', $data, $private_key);
    }
}
