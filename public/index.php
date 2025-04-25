<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin: http://127.0.0.1:5500"); // Permite apenas essa origem
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Cabeçalhos permitidos

// Incluindo o arquivo de rotas
require '../config/routes.php';

// Incluindo o autoload do Composer
require '../vendor/autoload.php';

// // Exibindo a URL capturada
// echo "URL Capturada: " . ($_GET['url'] ?? '/');
// echo "<br>";

// Chamando o dispatch para processar a requisição
$router->dispatch();
?>
