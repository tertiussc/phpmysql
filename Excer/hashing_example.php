<?php

$password = 'secret';

// $hash = password_hash($password, PASSWORD_DEFAULT);

// echo $hash;

$hash = '$2y$10$UCyu1FUIZBFILgBDIyHgM.dFHfQJgnBaQk8rIO6lvhrvPHm2zJjr6';

var_dump(password_verify($password, $hash));