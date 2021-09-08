<?php

/**
 * Redirect to created/updated article
 * 
 * @param string $path The path to redirect to
 * 
 * @return void 
 */
function redirect($path)
{
    // check to see if protocal http OR https is being used
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }

    // Redirect to URL
    header("Location:" . $protocol . "://" . $_SERVER['HTTP_HOST'] . "/phpmysql" . $path);

    exit;
}
