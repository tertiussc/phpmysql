<?php //PHP Head Start TAG

require './classes/Database.php';
require './classes/Article.php';
require './includes/url.php';
require './includes/auth_functions.php';

// Start the session
session_start();

// check to see if the user is logged in
if (!isLoggedIn()) {
    die("You must be login to add articles");
}

// Create article object
$article = new Article();

$buttontext = '<i class="fas fa-plus"></i> Add Article';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create the connection
    $db = new Database();
    $conn = $db->getConnection();
    // Assign Values to input on first submission so that if there is an error the form will be populated with the info the user surplied
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = $_POST['published_at'];

    if ($article->createArticle($conn)) {
        redirect("/article.php?id={$article->id}");
    }
}
?>
<!-- end of PHP Head tag -->

<!-- Add Page header -->
<?php require './includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Add a new article</h3>
<!-- get the article form -->
<?php require './includes/article_form.php' ?>
<!-- get the footer -->
<?php require './includes/footer.php'; ?>