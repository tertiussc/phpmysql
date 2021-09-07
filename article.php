<?php
// Create a DB connection
require './classes/Database.php';
// access all article functions
require './classes/Article.php';

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id'])) {
    $article = Article::getArticleByID($conn,$_GET['id']);
} else {
    $article = null;
}
?>

<!-- === START OF HTML DOC ===-->
<!-- Include header -->
<?php require './includes/header.php'; ?>
<!-- Page content -->
<ul class="list-unstyled">
    <?php if ($article) : ?>
        <li>
            <article>
                <h4 class="text-primary">Title: <?php echo htmlspecialchars($article->title); ?></h4>
                <p class="lead"><?php echo htmlspecialchars($article->content); ?></p>
            </article>
        </li>
        <a href="./edit_article.php?id=<?php echo $article->id; ?>" class="btn btn-sm btn-primary">Edit</a>
        <a href="./delete_article.php?id=<?php echo $article->id; ?>" class="btn btn-sm btn-danger">Delete</a>
    <?php else : ?>
        <p>Article not found!</p>
        <a href="./index.php" class="btn btn-primary">Back to Home</a>
    <?php endif; ?>
</ul>


<!-- Include footer -->
<?php require './includes/footer.php'; ?>