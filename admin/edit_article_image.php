<?php

// Classes Autoloader and session start
require '../includes/init.php';

// Restrict access to logged in only
Auth::requireLogin();

// create a database connection
$conn = require '../includes/db.php';

// Customizations
$buttontext = '<i class="fas fa-save"></i> Update Article';
$thisPage = 'Article Image';

// Get the article
if (isset($_GET['id'])) {

    $article = Article::getArticleByID($conn, $_GET['id']);

    if (!$article) {
        die("Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
    }
} else {

    die("Id not supplied, Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Upload file when the form is submitted
    ManageImage::uploadImage($conn, $article);
}


?>

<!-- Add Page header -->
<?php require '../includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Edit article image</h3>

<!-- upload image form -->
<?php if ($article->image_file) : ?>
    <p class="h4"><a class="text-decoration-none" href="/phpmysql/uploads/<?= $article->image_file; ?>"><img class="img-thumbnail img-height" src="/phpmysql/uploads/<?= $article->image_file; ?>" alt="<?= $article->image_file; ?>"></a></p>
    <a href="delete_article_image.php?id=<?= $article->id; ?>" class="btn btn-danger col-4 delete-article-btn">Delete</a>
    <a href="/phpmysql/admin/article.php?id=<?php echo $article->id; ?>" class="btn btn-secondary col-4 ">Cancel</a>

<?php endif; ?>
<?php if (isset($error)) : ?>
    <p class="callout-danger mt-3"><?= $error; ?></p>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label mt-2" for="file">Image File</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>
    <div class="mb-3 d-grid">
        <button type="submit" class="btn btn-primary col-md-4">Upload</button>
    </div>
</form>

<!-- get the footer -->
<?php require '../includes/footer.php'; ?>