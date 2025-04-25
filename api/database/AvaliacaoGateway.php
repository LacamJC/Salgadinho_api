<?php

namespace Api\Database;

use Api\Database\UserGateway;
use PDO;
use Exception;

class AvaliacaoGateway
{
    private static $conn;
    private $id_salgadinho;
    private $id_usuario;
    private $avaliacao;

    public function __construct($id_salgadinho, $id_usuario, $avaliacao)
    {
        $this->id_salgadinho = $id_salgadinho;
        $this->id_usuario = $id_usuario;
        $this->avaliacao = $avaliacao;
    }

    public static function setConnection(PDO $conn)
    {
        self::$conn = $conn;
    }

    public function save()
    {
        try {

            $id = $this->getLastId() + 1;
            if (self::verifyExists($this->id_salgadinho, $this->id_usuario)) {
                echo json_encode(['message' => 'O usuario ja avaliou este item']);
                return;
            }
            $sql = "INSERT INTO avaliacoes(id, usuario_id, salgadinho_id, nota) VALUES('{$id}', '{$this->id_usuario}','{$this->id_salgadinho}','{$this->avaliacao}'
            )";

            self::$conn->exec($sql);
            echo json_encode(['message' => 'Sucesso ao salvar avaliacao']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function mediaSalgadinho($id_salgadinho)
    {
        try {
            $sql = "SELECT nota FROM avaliacoes WHERE salgadinho_id = '{$id_salgadinho}'";
            $result = self::$conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public static function all()
    {
        try {
            $sql = "SELECT avaliacoes.id, salgadinhos.nome, avaliacoes.nota FROM avaliacoes INNER JOIN salgadinhos ON salgadinhos.id = avaliacoes.salgadinho_id;
";
            $result = self::$conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public static function verifyExists($id_cliente, $id_usuario)
    {
        $sql = "SELECT * FROM avaliacoes WHERE usuario_id = '{$id_cliente}' AND salgadinho_id = '{$id_usuario}'";

        $result = self::$conn->query($sql);

        if ($result && is_array($result->fetch(PDO::FETCH_ASSOC))) {
            return true; // O usuario existe
        } else {
            return false; // O usuario não existe
        }
    }


    public function getLastId()
    {
        try {
            $sql = "SELECT max(id) as max FROM avaliacoes";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
            return $data->max;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
