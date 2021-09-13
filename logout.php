<?php

/**
 * Log the user out
 * 
 */

 require './classes/Url.php';

 // Start current session
session_start();
// Completely remove all session info and cookie information
$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["patch"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
// Destroy current session
session_destroy();
// Redirect after logout
Url::redirect("/index.php");
