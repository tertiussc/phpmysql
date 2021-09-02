<?php
// Create a DB connection
require './includes/database.php';
// access all article functions
require './includes/article_functions.php';

$conn = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($conn, $_GET['id']);
} else {
    $article = null;
}
?>

<!-- === START OF HTML DOC ===-->
<!-- Include header -->
<?php require './includes/header.php'; ?>
<!-- Page content -->
<ul class="list-unstyled">
    <?php if ($article === null) : ?>
        <p>Article not found!</p>
    <?php else : ?>
        <li>
            <article>
                <h4 class="text-primary">Title: <?php echo htmlspecialchars($article["title"]); ?></h4>
                <p class="lead"><?php echo htmlspecialchars($article["content"]); ?></p>
            </article>
        <?php endif; ?>
        </li>
</ul>
<a href="./edit_article.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
<a href="./delete_article.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-danger">Delete</a>


<!-- Include footer -->
<?php require './includes/footer.php'; ?>