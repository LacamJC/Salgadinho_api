<?php 

namespace Api\Services;
use Api\Database\ComentarioGateway;
use Api\Database\Connection;
use Api\Core\Response;
class ComentarioService{
    public static function save($dados){
        $conn = Connection::open('database');
        ComentarioGateway::setConnection($conn);
        $comentario = new ComentarioGateway($dados['id_usuario'], $dados['id_salgadinho'], $dados['comentario']);

        $comentario->save();

        if($comentario){
            Response::json(['message' => 'Comentario cadastrado com sucesso']);
        }else{
            Response::json(['message' => 'Erro ao cadastrar comentario']);
        }

    }
}

?>