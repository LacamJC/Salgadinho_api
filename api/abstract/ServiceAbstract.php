<?php 

namespace Api\Abstract;
use PDO;
abstract class ServiceAbstract{
    private static $conn;

    public function __construct(PDO $conn)
    {
        self::$conn = $conn;
    }

    public static function all(){}
    public static function findById(){}
    public static function delete(){}
    public static function save(){}
    
}

?>