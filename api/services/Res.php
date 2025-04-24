<?php

namespace Api\Services;

class Res
{
    public function send($data)
    {
        // Definindo o cabeçalho para JSON
        header('Content-Type: application/json');
        // Retornando os dados como JSON
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
