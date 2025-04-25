<?php 

namespace Api\Services;
use Api\Abstract\ServiceAbstract;
use Api\Database\UserGateway;
use Api\Database\Connection;

class UserService{


    public static function all(){
        $conn = Connection::open('database');
        UserGateway::setConnection($conn);
        $result = UserGateway::findAll();
       
        return $result;
    }
    public static function findById($id){
        $conn = Connection::open('database');
        UserGateway::setConnection(($conn));
        $result = UserGateway::findById($id);

        return $result;

    }

    public static function store($dados){
        // print_r($dados);
        $conn = Connection::open('database');
        UserGateway::setConnection($conn);
        $salgadinho = new UserGateway($dados['nome'], $dados['email'], $dados['senha']);
        $result = $salgadinho->save();
        // echo $result;
        return $result;
    }
}

?>