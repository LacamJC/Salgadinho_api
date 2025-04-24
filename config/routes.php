<?php 

require '../vendor/autoload.php';
use Api\Core\Router;

$router = new Router();

$router->get('/', 'SalgadinhoController@index');

return $router;
?>