<?php

// Classes Autoloader and session start
require '../includes/init.php';

// create a database connection
$conn = require '../includes/db.php';

$articles = Article::getAll($conn);


?>
<?php require '../includes/header.php'; ?>

<?php if (Auth::isLoggedIn()) : ?>
    <p class="callout-info">You are logged in. <a href="./logout.php">Log Out</a></p>
    <a class="btn btn-primary btn-sm mb-3" href="./new_article.php"><i class="fas fa-plus"></i> Add a new article</a>
<?php else : ?>
    <p class="callout-danger">You are logged out. <a href="login.php">Log In</a></p>
<?php endif ?>
<main>
    <ul class="list-unstyled ms-3">
        <?php if (empty($articles)) : ?>
            <p>No articles found</p>
        <?php endif ?>
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h2><a class="text-decoration-none" href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article["title"]); ?></a></h2>
                    <p><?php echo htmlspecialchars($article["content"]); ?></p>
                </article>
            </li>
        <?php endforeach ?>
    </ul>
</main>
<div class="add-space"></div>

<?php require '../includes/footer.php'; ?>