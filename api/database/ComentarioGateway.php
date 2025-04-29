<?php

namespace Api\Database;

use PDO;
use Exception;


class ComentarioGateway
{
    private static $conn;
    private $id_usuario;
    private $id_salgadinho;
    private $comentario;

    public static function setConnection(PDO $conn)
    {
        self::$conn = $conn;
    }

    public function __construct(int $id_usuario, int $id_salgadinho, string $comentario)
    {
        $this->id_usuario = $id_usuario;
        $this->id_salgadinho = $id_salgadinho;
        $this->comentario = $comentario;
    }

    public function save()
    {
        try {
            $id = $this->getLastId() + 1;
            $sql = "INSERT INTO comentarios(id, usuario_id, salgadinho_id, comentario) VALUES ('{$id}','{$this->id_usuario}','{$this->id_salgadinho}','{$this->comentario}')";
            
            self::$conn->exec($sql);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getLastId()
    {
        try {
            $sql = "SELECT max(id) as max FROM comentarios";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
            return $data->max;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
