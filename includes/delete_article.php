<?php

require './database.php';
require '../article.php';
require './article_functions.php';


$conn = getDB();

if (isset($_GET['id'])) {
    $article = getArticle($conn, $_GET['id']);

    if ($article) {
        $id = $article['id'];
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("Article not found");
    }
} else {
    die("ID not supplied, article not found");
}

// Prepared statements
// #1 Create SQL statement
$sql = "DELETER FROM article WHERE id = ?";
// #2 Initiate the prepare statement
$stmt = mysqli_prepare($conn, $sql);
// #3 check for errors
if ($stmt === false) {
    // if error is found display error
    echo mysqli_error($conn);
} else {
    // #4 Bind the data
    mysqli_stmt_bind_param($stmt, 'i', $id);
    // #5 Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        redirect("./index.php");
    } else {
        ech
    }
}
