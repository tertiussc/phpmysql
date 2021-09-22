<?php
// Classes Autoloader and session start
require '../includes/init.php';

// Restrick access to the page
Auth::requireLogin();

// create a database connection
$conn = require '../includes/db.php';

$thisPage = 'Article';

// Check if article ID is set (link is pressed)
if (isset($_GET['id'])) {
    $article = Article::getArticleByID($conn, $_GET['id']);
} else {
    $article = null;
}
?>
<!-- === START OF HTML DOC ===-->
<!-- Include header -->
<?php require '../includes/header.php'; ?>

<!-- Page content -->
<ul class="list-unstyled">
    <?php if ($article) : ?>
        <li>
            <article>
                <h4 class="text-primary">Title: <?php echo htmlspecialchars($article->title); ?></h4>
                <?php if ($article->image_file) : ?>
                    <p class="h4"><a class="text-decoration-none" href="/phpmysql/uploads/<?= $article->image_file; ?>"><img class="img-thumbnail img-height" src="/phpmysql/uploads/<?= $article->image_file; ?>" alt="<?= $article->image_file; ?>"></a></p>
                <?php endif; ?>
                <p class="lead"><?php echo htmlspecialchars($article->content); ?></p>
            </article>
        </li>
        <?php if (Auth::isLoggedIn()) : ?>
            <div class="mb-1 row">
                <a href="edit_article.php?id=<?php echo $article->id; ?>" class="btn btn-sm btn-primary col-3 me-1">Edit</a>
                <a href="edit_article_image.php?id=<?php echo $article->id; ?>" class="btn btn-sm btn-warning col-3 me-1">Edit Image</a>
                <a href="delete_article.php?id=<?php echo $article->id; ?>" class="btn btn-sm btn-danger col-3">Delete</a>
            <?php else : ?>
                <p class="callout-danger">You must be logged in to Edit or Delete. <a href="login.php">Login</a></p>
            <?php endif ?>
        <?php else : ?>
            <p>Article not found!</p>
            <a href="/phpmysql/" class="btn btn-primary">Back to Home</a>
        <?php endif; ?>
</ul>

<!-- Include footer -->
<?php require '../includes/footer.php'; ?>