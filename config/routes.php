<?php 

require '../vendor/autoload.php';
use Api\Core\Router;

$router = new Router();

// Definindo a rota para a raiz
$router->get('/', 'SalgadinhoController@index');
$router->get('usuarios', 'UserController@all');
$router->get('avaliacoes', 'AvaliacaoController@index');
// Definindo outra rota para "/teste"
$router->get('salgadinhos', 'SalgadinhoController@all');
$router->get('usuarios/{id}', 'UserController@findById');
$router->get('salgadinhos/{id}', 'SalgadinhoController@findById');

$router->post('salgadinhos', 'SalgadinhoController@store');
$router->post('usuarios', 'UserController@store');

$router->post('avaliar', 'UserController@avaliar');
// $router->post('avaliar', 'AvaliacaoController@avaliar');

return $router;
