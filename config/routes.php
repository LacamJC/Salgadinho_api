<?php

require '../vendor/autoload.php';

use Api\Core\Router;

$router = new Router();

$router->get('/', 'SalgadinhoController@index');

$router->get('usuarios', 'UserController@index');
$router->get('usuarios/{id}', 'UserController@findById');
$router->post('usuarios', 'UserController@store');
$router->delete('usuarios/{id}', 'UserController@delete');

$router->get('salgadinhos', 'SalgadinhoController@all');
$router->get('salgadinhos/{id}', 'SalgadinhoController@findById');
$router->post('salgadinhos', 'SalgadinhoController@store');


$router->post('avaliacoes', 'AvaliacaoController@avaliar');
$router->get('avaliacoes', 'AvaliacaoController@index');
$router->get('avaliacoes/{id}', 'AvaliacaoController@findByIdSalgadinho');

$router->post('comentarios', 'ComentarioController@store');


return $router;
