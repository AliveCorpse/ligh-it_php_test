<?php
session_start();

spl_autoload_register(function ($class) {
    require __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
});

$view = new App\Core\View();
$view->render('index.tpl.php');
// $controller = new App\Controllers\Index();
// $action = (filter_input(INPUT_GET, 'action')) ?: 'index';
// $controller->action($action);