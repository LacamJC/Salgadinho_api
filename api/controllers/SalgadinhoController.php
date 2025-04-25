<?php

namespace Api\Controllers;

use Api\Abstract\Controller;
use Api\Services\SalgadinhoService;
use Api\Services\Res;
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

    public function store($params = []){
        // echo "cadastrando novo salgadinho";
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $dados = [
                'nome' => strtoupper($_POST['nome']) ?? '',
                'sabor' => strtoupper($_POST['sabor']) ?? ''
            ];
            // print_r($_SERVER['REQUEST_METHOD']);
            // print_r($dados);
            foreach($dados as $prop => $value){
                if(empty($value) or strlen($value) <= 0){
                    echo json_encode("O campo '{$prop}' nao pode ser vazio");
                    return;
                }
            }
            // return;
            $result = SalgadinhoService::store($dados);
            echo $result;    
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
