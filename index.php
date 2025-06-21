<?php

$controller = $_GET['c'] ?? 'Calendar';
$method = $_GET['m'] ?? 'landingPage';

require_once "controller/Controller.class.php";
require_once "controller/$controller.class.php";

//run
$c = new $controller;
$c->$method();