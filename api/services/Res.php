<?php

namespace Api\Services;

use stdClass;

class Res
{
    public function send($data)
    {
        // Definindo o cabeçalho para JSON
        header('Content-Type: application/json');
        // Retornando os dados como JSON
        if (empty($data)) {
            $this->httpCode(404);
            $res = new stdClass;
            $res->message = "Informacoes nao encontrado";
            echo json_encode($res, JSON_PRETTY_PRINT);
        } else {
            $this->httpCode(200);
            echo json_encode($data, JSON_PRETTY_PRINT);
        }
    }

    private function httpCode($code)
    {
        return http_response_code($code);
    }
}
