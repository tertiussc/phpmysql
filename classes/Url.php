<?php

/**
 * URL redirect
 * 
 * Response method 
 */
class Url  
{
    /**
     * Redirect to another URL on the same site
     * 
     * @param string $path The path to redirect to
     * 
     * @return void
     */
    public static function redirect($path)
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocal = 'https';
        } else {
            $protocal = 'http';
        }

        header("Location: $protocal://" . $_SERVER['HTTP_HOST'] . "/phpmysql/$path");
        exit;
    }
}
