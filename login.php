<?php

/**
 * Login Script
 * 
 */

// Classes Autoloader and session start
require 'includes/init.php';

// Initialize values
$username = '';
$password = '';
$thisPage = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // create a database connection
    $conn = require './includes/db.php';

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {
        // Login in with session
        Auth::login();
        // redirect after login
        Url::redirect("index.php");
    } else {
        // set error on incorrect login
        $error = "Incorrect username or password!";
        // set username so that user can view the entered username and possibly try just the password again
        $username = $_POST['username'];
    }
}


?>
<?php require './includes/header.php'; ?>
<h2>Login</h2>
<!-- Check and display if there is any errors -->
<?php if (!empty($error)) : ?>
    <p class="callout-danger text-danger"><?= $error; ?></p>
<?php endif; ?>

<form class="custom-form-shaddow p-3 bg-white" method="POST">
    <div class="my-3">
        <label for="username" class="visually-hidden">Username</label>
        <input name="username" type="text" id="username" placeholder="Username" class="form-control" value="<?= $username; ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="visually-hidden">Password</label>
        <input name="password" type="password" class="form-control" placeholder="Password" id="password">
    </div>
    <div class="row">
        <div class="col d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
        <div class="col d-grid">
            <a href="./index.php" class="btn btn-secondary">Cancel</a>
        </div>
    </div>

</form>

<?php require './includes/footer.php'; ?>