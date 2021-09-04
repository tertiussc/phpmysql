<?php

// import DB connection data
require './includes/database.php';
// include auth functions
require './includes/auth_functions.php';
// Starte session
session_start();
// create DB connection and assign it to $conn
$conn = getDB();

// create SQL statement
$sql = "SELECT *
        FROM article
        ORDER BY id";

// run the query
$results = mysqli_query($conn, $sql);

// assign the returned results to a variable
if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
    // var_dump($articles);
}
?>
<?php require './includes/header.php'; ?>

<?php if (isLoggedIn()) : ?>
    <p>You are logged in. <a href="./logout.php">Log Out</a></p>
    <a class="btn btn-primary btn-sm mb-3" href="./new_article.php"><i class="fas fa-plus"></i> Add a new article</a>
<?php else : ?>
    <p>You are logged out. <a href="./login.php">Log In</a></p>
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

<?php require './includes/footer.php'; ?>