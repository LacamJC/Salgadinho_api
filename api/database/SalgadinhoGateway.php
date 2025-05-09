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
            if (empty($this->data['id'])) {
                // Inserção de um novo salgadinho
                if (self::verifyExists($this->nome, $this->sabor)) {
                    return json_encode(['message' => 'Sabor de salgadinho ja existe']);
                }
                $id = $this->getLastId() + 1;
                $sql = "INSERT INTO salgadinhos (id, nome, sabor) VALUES ('{$id}','{$this->nome}', '{$this->sabor}')";
            } else {
                // Atualização de um salgadinho existente
                $sql = "UPDATE salgadinhos SET nome = '{$this->nome}', sabor = '{$this->sabor}' WHERE id = {$this->data['id']}";
            }

            // Executando o SQL

            self::$conn->exec($sql);
            return json_encode(['message' => 'Sucesso ao salvar salgadinho']);
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return json_encode(['message' => 'Erro ao salvar salgadinho']);
        }
    }


    // Função para buscar um salgadinho por id
    public static function findById($id)
    {
        $sql = "SELECT * FROM salgadinhos WHERE id = {$id}";
        $result = self::$conn->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function verifyExists($name, $sabor)
    {
        $sql = "SELECT * FROM salgadinhos WHERE nome = '{$name}' AND sabor = '{$sabor}'";
        $result = self::$conn->query($sql);

        if ($result && is_array($result->fetch(PDO::FETCH_ASSOC))) {
            return true; // O salgadinho existe
        } else {
            return false; // O salgadinho não existe
        }
    }

    public static function idExists($id)
    {
        $sql = "SELECT * FROM salgadinhos WHERE id = '{$id}'";

        $result = self::$conn->query($sql);

        if ($result && is_array($result->fetch(PDO::FETCH_ASSOC))) {
            return true; // O usuario existe
        } else {
            return false; // O usuario não existe
        }
    }

    // Função para listar todos os salgadinhos
    public static function findAll()
    {
        $sql = "SELECT id, nome, sabor FROM salgadinhos";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function media($id){
        // $sql = "SELECT salgadinhos.nome, AVG(nota) as media FROM avaliacoes WHERE salgadinho_id = '{$id}' INNER JOIN salgadinhos";
        $sql = " ";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastId()
    {
        try {
            $sql = "SELECT max(id) as max FROM salgadinhos";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
            return $data->max;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
