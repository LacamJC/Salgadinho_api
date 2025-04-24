<?php 

require '../vendor/autoload.php';
use Api\Core\Router;

$router = new Router();

// Definindo a rota para a raiz
$router->get('/', 'SalgadinhoController@index');

// Definindo outra rota para "/teste"
$router->get('salgadinhos', 'SalgadinhoController@all');
$router->get('salgadinho/{id}', 'SalgadinhoController@findById');


return $router;
