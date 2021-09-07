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
     * Get all the articles
     * 
     * @param object $conn Connection to the database
     * 
     * @return array An associative array of all the articles
     */
    public static function getAll($conn)
    {
        $sql = "SELECT *
                FROM article
                ORDER BY id;";
        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
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
     * Update an Article with new values supplied in the form 
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the update was successful, false otherwise
     */
    public function updateArticle($conn)
    {
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
    }
}
