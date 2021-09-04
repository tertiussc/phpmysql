<?php //PHP Head Start TAG

require './includes/database.php';
require './includes/article_functions.php';
require './includes/auth_functions.php';

// Start the session
session_start();

// check to see if the user is logged in
if (!isLoggedIn()) {
    die("You must be login to add articles");
}

$title = '';
$content = '';
$published_at = '';
$buttontext = '<i class="fas fa-plus"></i> Add Article';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign Values to input on first submission so that if there is an error the form will be populated with the info the user surplied
    $title = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];

    // Validate form fields
    $errors = validateArticle($title, $content, $published_at);
    

    if (empty($errors)) {

        // get a DB connection
        $conn = getDB();

        // Prepared sql statements
        // #1 Create the SQL Statement
        $sql = "INSERT INTO article (title, content, published_at)
                VALUES (?, ?, ?)";

        // #2 Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // #3 Check to see if statement was prepared successfully
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            // check to see if published_at is empty
            if ($published_at == '') {
                $published_at = null;
            }

            // #4 insert the values into the prepared statement. The "sss" is the identify data type example s => string, i => Interger
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

            // #5 Execute the statement and check that it worked
            if (mysqli_stmt_execute($stmt)) {

                // #6 get the ID of the inserted element if success
                $id = mysqli_insert_id($conn);

                // execute Redirect function
                redirect("/article.php?id=" . $id);

            } else {
                // #6.2 If the execution of the statement fails show error
                echo mysqli_stmt_errno($stmt);
            }
        }
    }
}
?>
<!-- end of PHP Head tag -->

<!-- Add Page header -->
<?php require './includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Add a new article</h3>
<!-- get the article form -->
<?php require './includes/article_form.php' ?>
<!-- get the footer -->
<?php require './includes/footer.php'; ?>