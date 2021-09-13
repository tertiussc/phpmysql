<?php
/**
 * Create a Database connection
 * 
 * @return object $conn Connection to the database
 */
// create DB connection and assign it to $conn
$db = new Database();
return $db->getConnection();