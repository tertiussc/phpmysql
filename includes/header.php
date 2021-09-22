<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/640160ffb6.js" crossorigin="anonymous"></script>
    <!-- custom styles -->
    <link rel="stylesheet" href="/phpmysql/main.css">

    <title>PHP CMS</title>
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-5"><a class="text-decoration-none" href="/phpmysql/">My Site - Connected to a DB</a></i></h1>
                <hr class="border border-primary border-2 mb-3">
                <!-- Use results in HTML mixin -->
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="/phpmysql/">Awesome Site</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link <?= ($thisPage == 'Home') ? 'active' : ''; ?>" aria-current="page" href="/phpmysql/">Home</a>
                                </li>
                                <!-- Login Conditional links start -->
                                <?php if (Auth::isLoggedIn()) : ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?= ($thisPage == 'Admin') ? 'active' : ''; ?>" href="/phpmysql/admin/">Admin</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/phpmysql/logout.php">Log Out</a>
                                    </li>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/phpmysql/login.php">Log In</a>
                                    </li>
                                <?php endif ?>
                                <!-- Login Conditional link end -->
                            </ul>
                        </div>
                    </div>
                </nav>