<?php
/**
 * Initializations
 * 
 * Register an autoloader to automatically load required classes and automatically start session
 * 
 */

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "./classes/{$class}.php";
});

session_start();

require dirname(__DIR__) . '/config.php';