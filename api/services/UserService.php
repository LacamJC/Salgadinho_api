<?php

namespace Api\Services;

use Api\Abstract\ServiceAbstract;
use Api\Database\UserGateway;
use Api\Database\Connection;
use Api\Core\Response;
use Exception;

use function PHPSTORM_META\expectedArguments;

class UserService
{
    public static function all()
    {
        try {
            $conn = Connection::open('database');
            UserGateway::setConnection($conn);
            $result = UserGateway::findAll();

            Response::json($result);
        } catch (Exception $e) {
            return Response::json(['message' => 'Erro ao buscar usuários: ' . $e->getMessage()], 500);
        }
    }
    public static function findById($id)
    {
        try {
            $conn = Connection::open('database');
            UserGateway::setConnection(($conn));
            $result = UserGateway::findById($id);
            if (!$result) {
                return Response::json(['message' => "Usuario nao encontrado"], 404);
            }
            return Response::json($result);
        } catch (Exception $e) {
            return Response::json(['message' => "Erro ao encontra usuario: {$e->getMessage()}"], 500);
        }
    }

    public static function store($dados)
    {
        try {
            if (empty($dados['nome']) || empty($dados['email']) || empty($dados['senha'])) {
                return Response::json(['status' => 'error', 'message' => 'Campos obrigatórios estão ausentes'], 400);
            }
            $conn = Connection::open('database');
            UserGateway::setConnection($conn);
            $salgadinho = new UserGateway($dados['nome'], $dados['email'], $dados['senha']);
            $result = $salgadinho->save();
            if ($result) {
                return Response::json(['status' => 'success', 'message' => 'Usuário criado com sucesso', 'data' => $result], 201);
            } else {
                return Response::json(['status' => 'error', 'message' => 'Erro ao criar usuário'], 500);
            }
        } catch (Exception $e) {
            return Response::json(['message' => "Erro ao cadastrar usuario: {$e->getMessage()}"], 500);
        }
    }

    public static function delete($id){
        try{
            $conn = Connection::open('database');
            UserGateway::setConnection($conn);
            // echo $id;
            if (UserGateway::delete($id)){
                Response::json(['message' => "Usuario deletado com sucesso"]);    
            }else{
                Response::json(['message' => "Erro ao deletar usuario"]);
            }
            
        }catch(Exception $e){
             Response::json(['message' => "Erro ao deletar usuario: {$e->getMessage()}"], 500);
        }
    }
}
