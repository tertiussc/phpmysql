<?php

// import DB connection data
require './classes/Database.php';
// include auth functions
require './includes/auth_functions.php';
// Starte session
session_start();
// create DB connection and assign it to $conn
$db = new Database();
$conn = $db->getConnection();


// create SQL statement
$sql = "SELECT *
        FROM article
        ORDER BY id";

// run the query
$results = $conn->query($sql);

// assign the returned results to a variable

    $articles = $results->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($articles);
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