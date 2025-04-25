<?php

namespace Api\Controllers;

use Api\Abstract\Controller;
use Api\Services\UserService;
use Api\Services\AvaliarService;
use Api\Services\Res;

class UserController extends Controller
{
    public function index($params = [])
    {
        echo "Bem vindo a salgadinho api";
        echo "<br>";
        echo "AREA DOS USUARIOS";
    }

    public function all($params = [])
    {
        $response = new Res;
        if (empty($params)) {
            $result = UserService::all();
            $response->send($result);
        }
    }

    public function store($params = [])
    {
        // echo "cadastrando novo salgadinho";
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
                    echo json_encode("O campo '{$prop}' nao pode ser vazio");
                    return;
                }
            }
            // return;
            $result = UserService::store($dados);
            echo $result;
        }
    }

    public function findById($params = [])
    {
        $id = $params['id'] ?? null;
        $response = new Res;
        if (!empty($id)) {
            $salgadinho = UserService::findById($id);
            $response->send($salgadinho);
        } else {
            echo "Nenhum registro encontrado";
        }
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
                    echo json_encode("O campo '{$prop}' nao pode ser vazio");
                    return;
                }
            }

            $nota = $dados['nota'];
            $avaliar = new AvaliarService;
            $avaliar->avaliar($dados['id_usuario'], $dados['id_salgadinho'], $dados['nota']);
           
        } else {
            echo json_encode('Esta rota aceita somente requisicoes POST');
        }
    }

    public function mediaSalgadinho($params = []){
        echo "Puxando todas as medias";
        $id = $_GET['id'];
    }
}
