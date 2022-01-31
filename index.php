<?php
session_start();

error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once "vendor/autoload.php";

use Core\Router;

Router::getInstance()->route($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"], $_POST);
?>