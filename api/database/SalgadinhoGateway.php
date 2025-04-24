<?php

namespace Api\Database;

use PDO;
use Exception;

class SalgadinhoGateway
{
    private static $conn;
    private $data;
    private $nome;
    private $sabor;

    public static function setConnection(PDO $conn)
    {
        self::$conn = $conn;
    }

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }

    public function __get($prop)
    {
        return $this->data[$prop];
    }

    public function __construct(string $nome, string $sabor)
    {
        $this->nome = $nome;
        $this->sabor = $sabor;
    }

    public function save()
    {
        try {
            if (empty($this->id)) {
                // Inserção de um novo salgadinho
                $sql = "INSERT INTO salgadinhos (nome, sabor) VALUES ('{$this->nome}', '{$this->sabor}')";
            } else {
                // Atualização de um salgadinho existente
                $sql = "UPDATE salgadinhos SET nome = '{$this->nome}', sabor = '{$this->sabor}' WHERE id = {$this->id}";
            }

            // Executando o SQL
            return self::$conn->exec($sql);
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    // Função para buscar um salgadinho por id
    public static function findById($id)
    {
        $sql = "SELECT * FROM salgadinhos WHERE id = {$id}";
        $result = self::$conn->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // Função para listar todos os salgadinhos
    public static function findAll()
    {
        $sql = "SELECT id, nome, sabor FROM salgadinhos";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
