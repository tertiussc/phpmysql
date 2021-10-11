<?php
echo "<div class='bg-light text-secondary'>";
echo "<h4>Temporary PHP Block</h4>";
/**
 * PHP Code here
 */

$errors = [];

//  Catch errors
function errorHandler($level, $message, $file, $line)
{
    // convert error to exception so that all errors can be caught in the exception handles
    throw new ErrorException($message, 0, $level, $file, $line);
}
set_error_handler('errorHandler');

function exceptionHandler($exception)
{
    echo 'Exception error: ', $exception->getMessage();
}
set_exception_handler('exceptionHandler');


// $datetime = new DateTime('invalid');
$i = 1 / 0;

var_dump($errors);

echo "<hr>";
echo "</div>";

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />

    <title>Playground - HTML</title>
</head>

<body>
    <div class="container">
        <h1 class="display-5 text-center">Playground for <span class="text-muted fw-normal">PHP & MySQL</span></h1>
        <hr>
        <!--=== Playground Start ===-->

        <?php foreach ($errors as $error) : ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>


    </div>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- Custom scripts -->
    <script src="myscript.js"></script>
</body>

</html>