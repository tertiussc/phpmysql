<?php
// Create a DB connection
require './includes/database.php';
// Get access to Article Functions
require './includes/article_functions.php';

$conn = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($conn, $_GET['id'], 'id');

    if ($article) {
        // Assign variable to be used in the form
        $id = $article['id'];
    } else {
        die("Article not found");
    }
} else {

    die("Id not supplied, Article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create SQL statement
    $sql = "DELETE FROM article WHERE id = ?";

    // #2 Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // #3 Check to see if statement was prepared successfully
    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {

        // #4 insert the values into the prepared statement. The "sss" is the identify data type example s => string, i => Interger
        mysqli_stmt_bind_param($stmt, "i", $id);

        // #5 Execute the statement and check that it worked
        if (mysqli_stmt_execute($stmt)) {
            // redirect after update
            redirect("/index.php");
            // #6.2 If the execution of the statement fails show error
            echo mysqli_stmt_errno($stmt);
        }
    }
}
?>


<?php require './includes/header.php' ?>
<h3 class="text-primary lead">Delete Article</h3>
<p class="lead">Are you sure you want to Delete?</p>
<form method="post" style=" display:inline!important;">
    <button class="btn btn-danger btn-sm">Delete</button>
</form>
<a href="article.php?id=<?= $article['id']; ?>" class="btn btn-sm btn-primary">Cancel</a>

<?php require './includes/footer.php' ?>