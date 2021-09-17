<?php

// Classes Autoloader and session start
require 'includes/init.php';

// create a database connection
$conn = require './includes/db.php';

$articles = Article::getAll($conn);

$thisPage = 'Home';


?>
<?php require './includes/header.php'; ?>

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

<?php require './includes/footer.php'; ?>