<?php

namespace Api\Controllers;

use Api\Services\SalgadinhoService;
use Api\Services\Res;
class SalgadinhoController
{
    public function index($params = [])
    {
        echo "Bem vindo a salgadinho api";
    }

    public function all($params = [])
    {
        $response = new Res;
        if (empty($params)) {
            $result = SalgadinhoService::all();
            $response->send($result);
        }
    }
}
