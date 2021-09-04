<?php 
/**
 * return the user's authentication status
 * @return boolean True is a user is logged in, otherwise false
 */
function isLoggedIn(){
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}