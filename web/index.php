<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

spl_autoload_register(function ($class) {
    require __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
});

// $user = new App\Models\User();
// $db = App\Core\Db::instance();

// var_dump($db);
// $user->save();
// exit;
$controller = new App\Controllers\IndexController();
$action = (filter_input(INPUT_GET, 'action')) ?: 'index';
$controller->action($action);