<?php

/**
 * User
 * 
 * A person or entity that can log into the site
 */
class User
{
    /**
     * Unique identifyier
     * @var integer
     */
    public $id;

    /**
     * Unique username
     * @var string
     */
    public $username;

    /**
     * Encrypted Password
     * @var string
     */
    public $password;

    

    /**
     * Authenticate the user using username and password
     * 
     * @param object $conn Connection to the database
     * @param string $username The user's username
     * @param string $password The user's password
     * 
     * @return boolean True if the credentials is correct or null (false equivalent ) if incorrect 
     */

    public static function authenticate($conn, $username, $password)
    {
        // Create SQL statement
        $sql = "SELECT *
                FROM user
                WHERE username = :username";
        
        // create prepared statement
        $stmt = $conn->prepare($sql);

        // Bind value to the statement
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        // set fetch mode to object
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        // Execute
        $stmt->execute();

        // Fetch and check result
        if($user = $stmt->fetch()) {
            return password_verify($password, $user->password);
        }
    }
}
