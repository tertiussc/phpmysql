<?php

setcookie('example', '', time() - 3600, '/');

echo 'Cookie Deleted';

?>
<br>
<a href="../session_example.php">Back</a>