<?php
// Store the cipher method
$ciphering = "AES-128-CTR";
// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
// Non-NULL Initialization Vector for encryption
$encryption_iv = '2060045327141885';
// Store the encryption key
$encryption_key = "Dataserver";
// Non-NULL Initialization Vector for decryption
$decryption_iv = '2060045327141885';
  
// Store the decryption key
$decryption_key = "Dataserver";
?>