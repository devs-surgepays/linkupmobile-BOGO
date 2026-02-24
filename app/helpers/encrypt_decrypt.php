<?php


/**
 * Encrypt and decrypt password
 * @param string $action  encrypt | decrypt
 * @param string $string 
 * @return string 
 */
function encrypt_decrypt($action, $string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'Hendrerit senectus donec phasellus tortor sodales, enim aptent ad eleifend commodo montes arcu.';
    $secret_iv = 'Sodales dapibus ridiculus fusce molestie magna, primis augue eros condimentum malesuada erat augue magna vivamus.';
    // hash
    $key = hash('sha256', $secret_key);
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
