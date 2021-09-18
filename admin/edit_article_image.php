<?php

// Classes Autoloader and session start
require '../includes/init.php';

// Restrict access to logged in only
Auth::requireLogin();

// create a database connection
$conn = require '../includes/db.php';

// Button text
$buttontext = '<i class="fas fa-save"></i> Update Article';


if (isset($_GET['id'])) {

    $article = Article::getArticleByID($conn, $_GET['id']);

    if (!$article) {
        die("Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
    }
} else {

    die("Id not supplied, Article not found: <a href=\"../index.php\" class=\"btn btn-primary\">Back to Home</a>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form
    var_dump($_FILES['file']);

    // Handle errors
    try {

        if (empty($_FILES)) {
            throw new Exception("Invalid upload");
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
                break;
            case UPLOAD_ERR_INI_SIZE:
                throw new Exception("Upload file too big, max size 3mb");

            default:
                throw new Exception('An error has occurred');
                break;
        }

        if ($_FILES['file']['size'] > 5000000) {
            throw new Exception("File too big, max size is 1mb", 1);
        }

        // Set allowed upload types (MIME types)
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

        // Check validate the file type (not just the extension)
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception("Invalid file type, only *.png or *.jpeg or *.git is allowed", 1);
        }

        // Check filename and replace unwanted characters with underscores
        $pathinfo = pathinfo($_FILES['file']['name']);
        $base = $pathinfo['filename'];
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
        $filename = $base . "." . $pathinfo['extension'];
        // upload the file
        $destination = '../uploads/' . $filename;

        
        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)) {
            echo "file uploaded";
        } else {
            throw new Exception("Unable to move uploaded file");
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<!-- Add Page header -->
<?php require '../includes/header.php'; ?>

<!-- Adding page content -->
<h3 class="text-primary lead">Edit article image</h3>

<!-- upload image form -->
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="file">Image File</label>
        <input class="form-control" type="file" name="file" id="file">
    </div>
    <div class="mb-3 d-grid">
        <button type="submit" class="btn btn-primary col-md-4">Upload</button>
    </div>
</form>

<!-- get the footer -->
<?php require '../includes/footer.php'; ?>