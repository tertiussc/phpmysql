<?php

/**
 * Log the user out
 * 
 */

// Classes Autoloader and session start
require 'includes/init.php';

// Log out of the session
Auth::logout();
// Redirect after logout
Url::redirect("index.php");
