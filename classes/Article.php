<?php

/**
 * Article
 * 
 * A piece of writing for publication
 */
class Article
{
    // All Article Properties
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

    /**
     * @var datetime 
     */
    public $published_at;

    /**
     * @var string
     */
    public $image_file;

    /**
     * Validation errors array
     * @var array 
     */
    public $errors = [];

    /**
     * Get all the articles
     * 
     * @param object $conn Connection to the database
     * 
     * @return array An associative array of all the articles
     */
    public static function getAll($conn)
    {
        // Create thew SQL statement
        $sql = "SELECT *
                FROM article
                ORDER BY id;";

        // Run the sql statement
        $results = $conn->query($sql);

        // Convert results into associative array and return it
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a page of articles (pagination)
     * 
     * @param object $conn Connection to the database
     * @param integer $limit Number of records to return
     * @param integer $offset Number of records to skip
     * 
     * @return array An associative array articles per page
     */
    public static function getPage($conn, $limit, $offset)
    {
        // create the SQL 
        $sql = "SELECT * 
                FROM article
                ORDER BY id
                LIMIT :limit
                OFFSET :offset";

        // prepare statement
        $stmt = $conn->prepare($sql);

        // Bind the values
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        // Execute Statement 
        $stmt->execute();

        // Return an Associative array of the records
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the article record based on the ID
     * 
     * @param object $conn Connection to the database
     * @param integer $id the article's ID
     * @param string $columns Specify the required columns for the SQL statement
     * 
     * @return mixed An object of this class, or null if not found
     */

    public static function getArticleByID($conn, $id, $columns = '*')
    {
        // Create SQL statement
        $sql = "SELECT $columns FROM article WHERE id = :id";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        // Bind the value
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        // Execute statement
        if ($stmt->execute()) {
            // save the result
            return $stmt->fetch();
        }
    }

    /**
     * Add a new article
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the insert was successful and False if unsuccessful 
     */

    public function createArticle($conn)
    {
        if ($this->validateFields()) {
            // create SQL
            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES (:title, :content, :published_at)";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // Bind data to Statement
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            // If date is empty bind to null, otherwise bind the given data
            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            // execute the statement
            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        }
    }

    /**
     * Update an Article with new values supplied in the form 
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the update was successful, false otherwise
     */
    public function updateArticle($conn)
    {
        if ($this->validateFields()) {


            $sql = "UPDATE article
                SET title = :title,
                    content = :content,
                    published_at = :published_at
                WHERE id = :id";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // Bind data
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
            // Bind data to the optional published at value
            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }
            // Execute the statement
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Delete the current article
     * 
     * @param object $conn Connection to the database 
     * 
     * @return boolean True if the delete was successful and False if unsuccessful 
     */
    public function deleteArticle($conn)
    {
        $sql = "DELETE FROM article
                WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * Validate the article fields, putting any validation errors in the $errors array
     * 
     * @return boolean True if the current properties are valid and false if errors are found
     */
    protected function validateFields()
    {

        // Check for empty fields
        if ($this->title == '') {
            $this->errors[] = "Title is required";
        }
        if ($this->content == '') {
            $this->errors[] = 'Content is required';
        }

        // Validate Date 2 step validation
        // Check that the date format is correct
        if ($this->published_at != '') {
            $date_time = date_create_from_format('Y-m-d H:i:s', $this->published_at);

            if ($date_time === false) {
                $this->errors[] = 'Invalid date and time. Please try using this format e.g. 2021-08-23 20:15';
            } else {
                // Check that the date is valid e.g. not 30 Feb that does not exist
                $date_errors = date_get_last_errors();

                if ($date_errors['warning_count'] > 0) {
                    $this->errors[] = "Invalid date and time";
                }
            }
        }
        return empty($this->errors);
    }

    /**
     * Get the total number of records in the table
     * 
     * @param object $conn Connection to the database
     * 
     * @return integer The total number of records
     */
    public static function getTotal($conn)
    {
        return $conn->query('SELECT COUNT(*) FROM article')->fetchColumn();
    }

    /**
     * Set an image file to the article table
     * 
     * @param object $conn Connection to the database
     * @param string $filename The image filename
     * 
     * @return boolean True is filename was added false otherwise
     */
    public function setImageFile($conn, $filename)
    {
        // create SQL
        $sql = "UPDATE article
                SET image_file = :image_file
                WHERE id = :id";

        // Prepare the statement passing in the SQL statement to be prepared
        $stmt = $conn->prepare($sql);

        // Bind the data
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':image_file', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);

        // Return the executed statement
        return $stmt->execute();
    }
}
