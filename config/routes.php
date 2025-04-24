<?php 

require '../vendor/autoload.php';
use Api\Core\Router;

$router = new Router();

// Definindo a rota para a raiz
$router->get('/', 'SalgadinhoController@index');

// Definindo outra rota para "/teste"
$router->get('teste', 'SalgadinhoController@all');


return $router;
