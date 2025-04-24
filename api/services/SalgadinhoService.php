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
        $toJson = json_encode($result);
        return $toJson;
    }
    public static function findById(){}
    public static function delete(){}
    public static function save(){}
}

?>