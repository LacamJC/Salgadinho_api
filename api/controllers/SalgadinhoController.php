<?php

namespace Api\Controllers;

use Api\Services\SalgadinhoService;

class SalgadinhoController
{
    public function index($params = [])
    {
        echo "Bem vindo a salgadinho api";
    }

    public function all($params = [])
    {
        if (empty($params)) {
            $result = SalgadinhoService::all();
            print_r($result);
        }
    }
}
