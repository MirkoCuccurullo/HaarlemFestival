<?php

use router\router;

$url = $_SERVER['REQUEST_URI'];
require_once __DIR__ . '/../model/order.php';
session_start();
require_once("../router/router.php");
$router = new router();
$router->route($url);