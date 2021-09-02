<?php

/**
 * Get the article record based on the ID
 * 
 * @param object $conn Connection to the database
 * @param integer $id the article's ID
 * @param string $columns Specify the required columns for the SQL statement
 * 
 * @return mixed An Associative array containing the article with that ID, or null if not found
 */

function getArticle($conn, $id, $columns = '*')
{
    // Create SQL statement
    $sql = "SELECT $columns FROM article WHERE id = ?";

    // Prepare statement
    $stmt = mysqli_prepare($conn, $sql);

    // check to see if statement was prepared correctly 
    if ($stmt === false) {
        // If stmt prepare fails show error
        echo mysqli_error($conn);
    } else {
        // If statement was prepared correctly then bind the data
        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // save the result
            $result = mysqli_stmt_get_result($stmt);
            // return a associative array
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
    }
}


/**
 * Validate the article fields
 * 
 * @param string $title Title, Required 
 * @param string $content Content, Required 
 * @param string $published_at Published_at, Required. Format should be YYYY-MM-DD HH:MM:SS OR Blank (Null)
 * 
 * @return array An array of validation errors when found
 */
function validateArticle($title, $content, $published_at)
{
    $errors = [];

    // Check for empty fields
    if ($title == '') {
        $errors[] = "Title is required";
    }
    if ($content == '') {
        $errors[] = 'Content is required';
    }

    // Validate Date 2 step validation
    // Check that the date format is correct
    if ($published_at != '') {
        $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

        if ($date_time === false) {
            $errors[] = 'Invalid date and time. Please try using this format e.g. 2021-08-23 20:15';
        } else {
            // Check that the date is valid e.g. not 30 Feb that does not exist
            $date_errors = date_get_last_errors();

            if ($date_errors['warning_count'] > 0) {
                $errors[] = "Invalid date and time";
            }
        }
    }
    return $errors;
}


/**
 * Redirect to created/updated article
 * 
 * @param string $path The path to redirect to
 * 
 * @return void 
 */
function redirect($path){
    // check to see if protocal http OR https is being used
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $protocol = 'https';
    } else {
        $protocol = 'http';
    }

    // Redirect to URL
    header("Location:" . $protocol . "://" . $_SERVER['HTTP_HOST'] . $path);

    exit;
}
