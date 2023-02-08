<?php
$url = $_SERVER['REQUEST_URI'];
session_start();
require_once("../router/router.php");
$router = new Router();
$router->route($url);
