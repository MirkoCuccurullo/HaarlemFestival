<?php
require_once __DIR__ . '/../model/order.php';
require_once __DIR__ . '/../model/accessPass.php';
require_once __DIR__ . '/../model/user.php';

session_start();

use router\router;

$url = $_SERVER['REQUEST_URI'];
require_once("../router/router.php");
$router = new router();
$router->route($url);