<?php
// Classes Autoloader and session start
require '../includes/init.php';

// Restrict access to logged in only
Auth::requireLogin();

// create a database connection
$conn = require '../includes/db.php';

// Button text
$buttontext = '<i class="fas fa-save"></i> Update Article';


if (isset($_GET['id'])) {

    $article = Article::getArticleByID($conn, $_GET['id']);

    if (!$article) {
        die("Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
    }
} else {

    die("Id not supplied, Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assign the new values from the form to the object
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    // Update the article
    if ($article->updateArticle($conn)) {
        // redirect after update
        Url::redirect("admin/article.php?id={$article->id}");
    }
}
?>

<!-- Add Page header -->
<?php require '../includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Edit article</h3>
<!-- get the article form -->
<?php require '../includes/article_form.php' ?>
<!-- get the footer -->
<?php require '../includes/footer.php'; ?>