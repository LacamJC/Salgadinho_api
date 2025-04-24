<?php 

require '../vendor/autoload.php';
use Api\Core\Router;

$router = new Router();

// Definindo a rota para a raiz
$router->get('/', 'SalgadinhoController@index');

// Definindo outra rota para "/teste"
$router->get('salgadinhos/', 'SalgadinhoController@all');
$router->get('salgadinhos/{id}', 'SalgadinhoController@findById');

$router->post('salgadinhos/', 'SalgadinhoController@store');


return $router;
