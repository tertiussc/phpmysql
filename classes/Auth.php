<?php
/**
 * Authentication
 * 
 * Check to see if a user is Login OR logout
 */
class Auth  
{
    /**
     * Return the user authentication status
     * 
     * @return boolean True if a user is logged in, false otherwise
     */
    public static function isLoggedIn()
    {
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    /**
     * Page requires users to be logged in, if not logged in display a message
     * 
     * @return void
     */
    public static function requireLogin()
    {
        if (! static::isLoggedIn()) {
            die("You must be logged in");
        }
    }

    /**
     * Log in using the session (set $_SESSION['is_logged_in'] = true)
     */
    public static function login()
    {
        // prevent fixation attacks
        session_regenerate_id(true);
        // setlogin status
        $_SESSION['is_logged_in'] = true;
    }

    /**
     * Logout a user from and destroy the session
     * 
     * @return void
     */
    public static function logout()
    {
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
    }
}