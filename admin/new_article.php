<?php

// Classes Autoloader and session start
require '../includes/init.php';

// Customize the button text
$buttontext = '<i class="fas fa-plus"></i> Add Article';

// Require a user t be logged in
Auth::requireLogin();

// Variable needed to indicate active link on the Navbar
$thisPage = 'New Article';

// Create article object
$article = new Article();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // create a database connection
    $conn = require '../includes/db.php';

    // Assign Values to input on first submission so that if there is an error the form will be populated with the info the user surplied
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if ($article->createArticle($conn)) {
        Url::redirect("admin/article.php?id={$article->id}");
    }
}
?>
<!-- end of PHP Head tag -->

<!-- Add Page header -->
<?php require '../includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Add a new article</h3>
<!-- get the article form -->
<?php require './includes/article_form.php' ?>
<!-- get the footer -->
<?php require '../includes/footer.php'; ?>