<?php

namespace Api\Controllers;

use Api\Abstract\Controller;
use Api\Services\SalgadinhoService;
use Api\Services\Res;
use Api\Core\Response;

class SalgadinhoController extends Controller
{
    public function index($params = [])
    {
        echo "Bem vindo a salgadinho api";
    }

    public function all($params = [])
    {
        $response = new Res;
        if (empty($params)) {
            $result = SalgadinhoService::all();
            $response->send($result);
        }
    }

    public function store($params = [])
    {
        // echo "cadastrando novo salgadinho";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => strtoupper($_POST['nome']) ?? '',
                'sabor' => strtoupper($_POST['sabor']) ?? ''
            ];

            foreach ($dados as $prop => $value) {
                if (empty($value) or strlen($value) <= 0) {
                    Response::json("O campo '{$prop}' nao pode ser vazio");
                    return;
                }
            }
            SalgadinhoService::store($dados);
        }
    }

    public function findById($params = [])
    {
        $id = $params['id'] ?? null;
        $response = new Res;
        if (!empty($id)) {
            $salgadinho = SalgadinhoService::findById($id);
            $response->send($salgadinho);
        } else {
            echo "Sem registros";
        }
    }
}
