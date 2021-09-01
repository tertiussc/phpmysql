<?php

/**
 * **Setup a database connection with the** 
 * * Host
 * * Database Name
 * * Username
 * * Password
 *
 *  @return object With a connection to the database
 */

function getDB()
{

    // Connection details
    $db_host = "localhost";
    $db_name = "php_cms";
    $db_user = "cms_admin";
    $db_pass = "FG.RaLDMgtf1iEc_";

    // Create Connection 
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // check for errors
    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    } else {
        return $conn;
    }
}
