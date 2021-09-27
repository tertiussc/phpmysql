<?php

// Classes Autoloader and session start
require 'includes/init.php';

// create a database connection
$conn = require './includes/db.php';

// Get the page value
$postsPerPage = 4;
$paginator = new Paginator($_GET['page'] ?? 1, $postsPerPage, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

$thisPage = 'Home';
$currentPage = $_GET['page'] ?? 1;

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
                    <h2><a class="text-decoration-none" href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article["title"]); ?>

                            <!-- Add category names from the array -->
                            <?php if ($article['category_names']) : ?>
                                <small class="fw-light">
                                    <?php foreach ($article['category_names'] as $i => $name) {
                                        echo " " . htmlspecialchars($name);
                                    } ?>
                                </small>
                            <?php endif; ?>
                        </a></h2>
                    <p><?php echo htmlspecialchars($article["content"]); ?></p>
                </article>
            </li>
        <?php endforeach ?>
    </ul>

    <!-- Pagination -->
    <?php require './includes/pagination.php'; ?>

</main>
<div class="add-space"></div>

<?php require './includes/footer.php'; ?>