<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
