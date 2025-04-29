<?php

namespace Api\Controllers;

use Api\Abstract\Controller;
use Api\Services\UserService;
use Api\Core\Response;


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
 
            foreach ($dados as $prop => $value) {
                if (empty($value) or strlen($value) <= 0) {
                    return Response::json("O campo '{$prop}' nao pode ser vazio", 400);
                }
            }
        
            UserService::store($dados);
        }
    }

    public function findById($params = [])
    {
        $id = $params['id'] ?? null;
        UserService::findById($id);
    }

    public function delete($params = []){
        if($_SERVER['REQUEST_METHOD'] === "DELETE"){
            $id = $params['id'] ?? null;
          
            UserService::delete($id);
            // echo "DELETANDO USUARIO: {$id_usuario}";
        }
    }
}
