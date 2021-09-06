<?php
/**
 * Database
 * 
 * A connection to the database
 */
class Database
{
    /**
     * Database connection method
     * 
     * @return PDO object Connection to the database server
     */
    public function getConnection()
    {
        // Connection details
        $db_host = "localhost";
        $db_name = "php_cms";
        $db_user = "cms_admin";
        $db_pass = "FG.RaLDMgtf1iEc_";

        $dsn =  'mysql:host=' . $db_host .
            ';dbname=' . $db_name .
            ';charset-utf8';

            try {
            $db = new PDO($dsn, $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;

            } catch(PDOException $e) {
                echo $e->getMessage();
                exit;
            }
    }
}
