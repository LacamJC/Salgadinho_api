<?php

namespace Api\Controllers;

use Api\Services\SalgadinhoService;
use Api\Services\Res;
class SalgadinhoController
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

    public function findById($params = []){
        $id = $params['id'] ?? null;
        $response = new Res;
        if(!empty($id)){
            $salgadinho = SalgadinhoService::findById($id);
            $response->send($salgadinho);
        }else{
            echo "Nenhum registro encontrado";
        }
    }
}
