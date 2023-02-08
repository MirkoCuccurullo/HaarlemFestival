<?php

use router\router;

$url = $_SERVER['REQUEST_URI'];
session_start();
require_once("../router/router.php");
$router = new router();
$router->route($url);