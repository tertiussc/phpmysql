<?php
/**
 * Create a Database connection
 * 
 * @return object $conn Connection to the database
 */
// create DB connection and assign it to $conn
$db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
return $db->getConnection();