<?php

namespace App\Custom;

use DateTime;


define('METHOD', 'AES-256-CBC');
define('SECRET_KEY', '$brewtech@2022');
define('SECRET_IV', '101712');

class Authenticate
{
    /**
     * save and redimention image in folder
     *
     * @param String $string
     * @return String
     */
    public static function encryption(String $string): String
    {
        $output = FALSE;
        $key    = hash('sha256', SECRET_KEY);
        $iv     = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    /**
     * save and redimention image in folder
     *
     * @param String $string
     * @return String
     */
    public static function decryption(String $string): String
    {
        $key    = hash('sha256', SECRET_KEY);
        $iv     = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
}
