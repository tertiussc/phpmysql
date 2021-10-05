<?php

// Classes Autoloader and session start
require '../includes/init.php';
// Restrict page to logged in users only
Auth::requireLogin();
// create a database connection
$conn = require '../includes/db.php';



// Get the page value
$postsPerPage = 6;
$paginator = new Paginator($_GET['page'] ?? 1, $postsPerPage, Article::getTotal($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

// used to set the link as active in the Navbar
$thisPage = 'Admin';
$currentPage = $_GET['page'] ?? 1;

?>
<?php require '../includes/header.php'; ?>
<main>
    <h2 class="display-6">Article Admin Portal</h2>
    <a class="btn btn-primary btn-sm mb-3" href="./new_article.php"><i class="fas fa-plus"></i> Add a new article</a>
    <?php if (empty($articles)) : ?>
        <p class="lead">No articles found</p>
    <?php endif ?>
    <table class="table table-striped">
        <thead>
            <th class="col">Article ID</th>
            <th class="col">Article Title</th>
            <!-- <th class="col">Article Contents</th> -->
            <th class="col">Image File</th>
            <th class="col">Published Date</th>
            <!-- <th class="col">Select</th> -->
            <!-- <th class="col">Select</th> -->
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?= $article['id']; ?></td>
                    <td><a href="./article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></td>
                    <!-- <td><?= $article['content']; ?></td> -->
                    <td><?= $article['image_file']; ?></td>
                    <td><?= ($article['published_at']) ? $article['published_at'] : 'Unpublished'; ?></td>
                    <!-- <td class="text-center">
                        <input class="form-check-input" type="checkbox" name="<?= $article['id']; ?>" id="<?= $article['id']; ?>">
                        <label for="<?= $article['id']; ?>" class="visually-hidden"><?= $article['id']; ?></label>
                    </td> -->
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <!-- Pagination -->
    <!-- Need to fix pagination include to set $only_published = false -->
    <?php require '../includes/pagination.php'; ?>
</main>
<?php require '../includes/footer.php'; ?>