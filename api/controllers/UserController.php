<?php

namespace Api\Controllers;

use Api\Abstract\Controller;
use Api\Services\UserService;
use Api\Services\AvaliarService;
use Api\Services\Res;
use Api\Core\Response;
use Exception;

class UserController extends Controller
{
    public function index($params = [])
    {
        UserService::all();
    }

    public function all($params = []) {}

    public function store($params = [])
    {
  
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => ($_POST['nome']) ?? '',
                'senha' => ($_POST['senha']) ?? '',
                'email' => ($_POST['email']) ?? '',
            ];
            // print_r($_SERVER['REQUEST_METHOD']);
            // print_r($_POST['senha']);
            // return;
            foreach ($dados as $prop => $value) {
                if (empty($value) or strlen($value) <= 0) {
                    return Response::json("O campo '{$prop}' nao pode ser vazio", 400);
                }
            }
            // return;
            UserService::store($dados);
        }
    }

    public function findById($params = [])
    {
        $id = $params['id'] ?? null;
        UserService::findById($id);
    }

    public function avaliar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'id_salgadinho' => ($_POST['id_salgadinho']),
                'id_usuario' => ($_POST['id_usuario']),
                'nota' => ($_POST['nota'])
            ];
            foreach ($dados as $prop => $value) {
                if (empty($value) or strlen($value) <= 0) {
                    return Response::json("O campo '{$prop}' nao pode ser vazio", 400);
                }
            }
            $avaliar = new AvaliarService;
            $avaliar->avaliar($dados['id_usuario'], $dados['id_salgadinho'], $dados['nota']);
        } else {
            Response::json('Esta rota aceita somente requisicoes POST', 500);
        }
    }

}
