<?php

namespace Api\Database;

use PDO;
use Exception;

class UserGateway
{
    private static $conn;
    private $data;
    private $nome;
    private $email;
    private $senha;

    public function __set($prop, $value)
    {
        $this->data[$prop] = $value;
    }

    public function __get($prop)
    {
        return $this->data[$prop];
    }


    public static function setConnection(PDO $conn)
    {
        self::$conn = $conn;
    }

    public function __construct(string $nome, string $email, string $senha)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function save()
    {
        try {
            if (empty($this->data['id'])) {
                // Inserção de um novo usuario
                if (self::verifyExists($this->email, $this->senha)) {
                    return json_encode(['message' => 'Email já cadastrado']);
                }
                $id = $this->getLastId() + 1;
                $sql = "INSERT INTO usuarios (id, nome, email, senha) VALUES ('{$id}','{$this->nome}', '{$this->email}', '{$this->senha}')";
            } else {
                // Atualização de um usuario existente
                $sql = "UPDATE usuarios SET nome = '{$this->nome}', email = '{$this->email}', senha = '{$this->senha}' WHERE id = {$this->data['id']}";
            }

            // Executando o SQL

            self::$conn->exec($sql);
            return json_encode(['message' => 'Sucesso ao salvar usuario']);
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return json_encode(['message' => 'Erro ao salvar usuario']);
        }
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = {$id}";
        $result = self::$conn->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll()
    {
        $sql = "SELECT * FROM usuarios";
        $result = self::$conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function verifyExists($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = '{$email}'";

        $result = self::$conn->query($sql);

        if ($result && is_array($result->fetch(PDO::FETCH_ASSOC))) {
            return true; // O usuario existe
        } else {
            return false; // O usuario não existe
        }
    }

    public static function userExists($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = '{$id}'";

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
            $sql = "SELECT max(id) as max FROM usuarios";
            $result = self::$conn->query($sql);
            $data = $result->fetch(PDO::FETCH_OBJ);
            return $data->max;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
