<?php
session_start();

include '../../vendor/autoload.php';
require "../Core/config.php";

/*spl_autoload_register(function ($class) {
    $root = dirname(__DIR__);   // get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root . '/' . str_replace('\\', '/', $class) . '.php';
    }
});*/

$app = Core\Application::getInstance();
$app->run();
