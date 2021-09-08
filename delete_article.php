<?php
// Create a DB connection
require './classes/Database.php';
// Get access to Article Functions
require './classes/Article.php';
// Re-direct
require './includes/url.php';

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id'])) {
    $article = Article::getArticleByID($conn, $_GET['id']);

    if (!$article) {
        die("Article not found: <a href=\"./index.php\" class=\"btn btn-primary\">Back to Home</a>");
    }
} else {

    die("Id not supplied, Article not found: <a href=\"./index.php\" class=\"btn btn-primary\">Back to Home</a>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($article->deleteArticle($conn)) {
        // redirect after update
        redirect("/index.php");
    }
}

?>


<?php require './includes/header.php' ?>
<h3 class="text-primary lead">Delete Article</h3>
<p class="lead">Are you sure you want to Delete?</p>
<form method="post" style=" display:inline!important;">
    <button class="btn btn-danger btn-sm">Delete</button>
</form>
<a href="article.php?id=<?= $article->id; ?>" class="btn btn-sm btn-primary">Cancel</a>

<?php require './includes/footer.php' ?>