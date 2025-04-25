<?php

namespace Api\Services;

use Api\Database\Connection;
use Api\Database\UserGateway;
use Api\Database\AvaliacaoGateway;
use Api\Database\SalgadinhoGateway;

class AvaliarService
{

    public function avaliar($id_usuario, $id_salgadinho, $nota)
    {
        $conn = Connection::open('database');
        AvaliacaoGateway::setConnection($conn);
        UserGateway::setConnection($conn);
        SalgadinhoGateway::setConnection($conn);

        if (!UserGateway::userExists(($id_usuario))) {
            echo json_encode(['message' => 'Usuario nao existe']);
            return;
        }
        if (!SalgadinhoGateway::idExists($id_salgadinho)) {
            echo json_encode(['message' => 'Salgadinho nao existe']);
            return;
        }

        $avaliacao = new AvaliacaoGateway($id_salgadinho, $id_usuario, $nota);
        $avaliacao->save();
    }

    public static function all(){
        $conn = Connection::open('database');
        AvaliacaoGateway::setConnection($conn);

        $resultados = AvaliacaoGateway::all();

        echo json_encode($resultados, JSON_PRETTY_PRINT);
    }

    public function media($id_salgadinho)
    {
        $conn = Connection::open('database');
        AvaliacaoGateway::setConnection($conn);
        SalgadinhoGateway::setConnection($conn);

        if (!SalgadinhoGateway::idExists($id_salgadinho)) {
            echo json_encode(['message' => 'Salgadinho nao existe']);
            return;
        }

        $avaliacoes = AvaliacaoGateway::mediaSalgadinho($id_salgadinho); 
    }
}
