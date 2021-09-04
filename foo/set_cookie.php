<?php

setcookie('example', 'Hello', time() + 60* 60 * 24 *2, '/');

echo 'cookie set...';
?>
<br>
<a href="../session_example.php">Back</a>