<?php 

namespace Api\Services;
use Api\Abstract\ServiceAbstract;
use Api\Database\SalgadinhoGateway;
use Api\Database\Connection;
use PDO;
class SalgadinhoService{


    public static function all(){
        $conn = Connection::open('database');
        SalgadinhoGateway::setConnection($conn);
        $result = SalgadinhoGateway::findAll();
       
        // print_r($result);
        return $result;
    }
    public static function findById($id){
        $conn = Connection::open('database');
        SalgadinhoGateway::setConnection(($conn));
        $result = SalgadinhoGateway::findById($id);

        return $result;

    }

    public static function store($dados){
        // print_r($dados);
        $conn = Connection::open('database');
        SalgadinhoGateway::setConnection($conn);
        $salgadinho = new SalgadinhoGateway($dados['nome'], $dados['sabor']);
        $result = $salgadinho->save();
        // echo $result;
        return $result;
    }
}

?>