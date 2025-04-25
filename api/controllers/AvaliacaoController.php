<?php 

namespace Api\Controllers;
use Api\Services\AvaliarService;
class AvaliacaoController{
    public function index($params = []){
        AvaliarService::all();
    }
}

?>