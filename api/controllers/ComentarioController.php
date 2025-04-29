<?php 

namespace Api\controllers;

use Api\Services\ComentarioService;
use Api\Database\ComentarioGateway;
use Api\Database\Connection;
use Exception;

class ComentarioController{
    public function store(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $dados = [
                'id_usuario' => ($_POST['id_usuario'] ?? ''),
                'id_salgadinho' => ($_POST['id_salgadinho'] ?? ''),
                'comentario' => ($_POST['comentario']) ?? ''
            ];
            
            ComentarioService::save($dados);

            
        }
    }
}

?>