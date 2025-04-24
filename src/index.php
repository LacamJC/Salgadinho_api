<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);


require '../config/routes.php';
require '../vendor/autoload.php';

$router->dispatch();

// echo "URL Capturada: " . ($_GET['url'] ?? '/');
// echo "<br>";
?>