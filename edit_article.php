<?php
// Create a DB connection
require './includes/database.php';
// Get access to Article Functions
require './includes/article_functions.php';

$conn = getDB();
$buttontext = '<i class="fas fa-save"></i> Update Article';


if (isset($_GET['id'])) {
    $article = getArticle($conn, $_GET['id']);

    if ($article) {
        // Assign variable to be used in the form
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("Article not found");
    }
} else {

    die("Id not supplied, Article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign Values to input on first submission so that if there is an error the form will be populated with the info the user surplied
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];
    $id = $article['id'];

    // Validate form fields
    $errors = validateArticle($title, $content, $published_at);


    if (empty($errors)) {
        // Update the article

        // Prepared sql statements
        // #1 Create the SQL Statement
        $sql = "UPDATE article 
                SET title = ?,
                    content = ?,
                    published_at = ?
                WHERE id = ?";

        // #2 Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // #3 Check to see if statement was prepared successfully
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            // check to see if published_at is empty
            if ($published_at == '') {
                $published_at = null;
            }

            // #4 insert the values into the prepared statement. The "sss" is the identify data type example s => string, i => Interger
            mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $published_at, $id);

            // #5 Execute the statement and check that it worked
            if (mysqli_stmt_execute($stmt)) {
                // redirect after update
                redirect("/article.php?id=" . $id);
                
            } else {
                // #6.2 If the execution of the statement fails show error
                echo mysqli_stmt_errno($stmt);
            }
        }
    }
}
?>

<!-- Add Page header -->
<?php require './includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Edit article</h3>
<!-- get the article form -->
<?php require './includes/article_form.php' ?>
<!-- get the footer -->
<?php require './includes/footer.php'; ?>