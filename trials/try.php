<?php
$simple_string = "Welcome to GeeksforGeeks\n";

echo "<br>Original String: " . $simple_string;

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "password";

$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

echo "<br>Encrypted String: " . $encryption . "\n";

$decryption_iv = '1234567891011121';
$decryption_key = "password";

$decryption=openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

echo "<br>Decrypted String: " . $decryption;
?>