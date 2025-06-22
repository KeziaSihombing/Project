<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$controller = $_GET['c'] ?? 'Login';
$method = $_GET['m'] ?? 'loginPage';

require_once "controller/Controller.class.php";

$controllerFile = "controller/$controller.class.php";

if (!file_exists($controllerFile)) {
    die("Controller '$controller' not found.");
}

require_once $controllerFile;

if (!class_exists($controller)) {
    die("Class '$controller' does not exist.");
}

$c = new $controller;

if (!method_exists($c, $method)) {
    die("Method '$method' does not exist in controller '$controller'.");
}

$c->$method();