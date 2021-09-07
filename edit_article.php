<?php
// Create a DB connection
require './classes/Database.php';
// Get access to Article Functions
require './includes/article_functions.php';
// Load article class
require './classes/Article.php';


$db = new Database();
$conn = $db->getConnection();

// Button text
$buttontext = '<i class="fas fa-save"></i> Update Article';


if (isset($_GET['id'])) {

    $article = Article::getArticleByID($conn, $_GET['id']);

    if (!$article) {
        die("Article not found: <a href=\"./index.php\" class=\"btn btn-primary\">Back to Home</a>");
    }
} else {

    die("Id not supplied, Article not found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Assign the new values from the form to the object
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];
    // Validate form fields
    $errors = validateArticle($article->title, $article->content, $article->published_at);


    if (empty($errors)) {
        // Update the article
        if ($article->updateArticle($conn)) {
            # code...
            redirect("/article.php?id=" . $article->id);
            // redirect after update
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