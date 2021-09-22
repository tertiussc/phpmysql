<?php

// Classes Autoloader and session start
require '../includes/init.php';

// Restrict access to logged in only
Auth::requireLogin();

// create a database connection
$conn = require '../includes/db.php';

// Button text
$buttontext = '<i class="fas fa-save"></i> Update Article';

$thisPage = 'Article Image';

$uploadStatus = '';

// Get the article
if (isset($_GET['id'])) {

    $article = Article::getArticleByID($conn, $_GET['id']);

    if (!$article) {
        die("Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
    }
} else {

    die("Id not supplied, Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
}

// Delete the article picture
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ManageImage::deleteImage($conn, $article);
}


?>

<!-- Add Page header -->
<?php require '../includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Delete article image</h3>

<!-- upload image form -->
<form method="POST">
    <?php if ($article->image_file) : ?>
        <p class="h4"><a class="text-decoration-none" href="/phpmysql/uploads/<?= $article->image_file; ?>"><img class="img-thumbnail img-height" src="/phpmysql/uploads/<?= $article->image_file; ?>" alt="<?= $article->image_file; ?>"></a></p>
    <?php endif; ?>
    <p class="lead">Are you sure?</p>
    <div class="mb-3">
        <button type="submit" class="btn btn-danger col-4">Delete</button>
        <a href="/phpmysql/admin/article.php?id=<?php echo $article->id; ?>" class="btn btn-secondary col-4">Cancel</a>
    </div>
</form>

<!-- get the footer -->
<?php require '../includes/footer.php'; ?>