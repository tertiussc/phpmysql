<?php
/**
 * Category
 * 
 * Grouping for article
 */
class Category
{
    /**
     * Get all the categories
     * 
     * @param object $conn Connection to the database
     * 
     * @return array An associative array of all the categories
     */
    public static function getCategories($conn)
    {
        // Create thew SQL statement
        $sql = "SELECT *
                FROM category
                ORDER BY name;";

        // Run the sql statement
        $results = $conn->query($sql);

        // Convert results into associative array and return it
        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

}
