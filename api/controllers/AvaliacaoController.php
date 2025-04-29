<?php

namespace Api\Controllers;

use Api\Services\AvaliarService;
use Api\Core\Response;

class AvaliacaoController
{
    public function index($params = [])
    {
        AvaliarService::all();
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

    public function findByIdSalgadinho($params = []){
        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $id = $params['id'] ?? null;
            AvaliarService::findBySalgadinho($id);
        }
    }
}
