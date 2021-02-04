<?php
 const METHOD = 'AES-256-CBC';
 const SECRET_KEY = '91939';
 const SECRET_IV = '0405';
 class Cryptex
 {
     public static function encrypt($String)
     {
         $output = FALSE;
         $key=hash('sha256', SECRET_KEY);
         $iv = substr(hash('sha256', SECRET_IV), 0, 16);
         $output = openssl_encrypt($String, METHOD, $key, 0, $iv);
         $output = base64_encode($output);
         return $output;
     }
     public static function decrypt($String)
     {
         $key = hash('sha256', SECRET_KEY);
         $iv = substr(hash('sha256', SECRET_IV), 0, 16);
         $output = openssl_decrypt(base64_decode($String), METHOD, $key, 0, $iv);
         return $output;
     }
 }
?>