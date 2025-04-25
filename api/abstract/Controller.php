<?php 

namespace Api\Abstract;

abstract class Controller{
    abstract public function index();
    abstract public function all();
    abstract public function store();
    abstract public function findById();

}

?>