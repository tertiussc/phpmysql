<?php
echo "<h2 style='text-align:center'>Autoloading Classes Example </h2>";
echo "<hr>";

spl_autoload_register(function ($class)
{
    require "../classes/{$class}.php";
});

$article = new Article();

var_dump($article);