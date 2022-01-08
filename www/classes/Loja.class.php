<?php

class Loja{

    protected $token;
    public $nome_loja;

    function __construct($nome, $token){

        $this->nome_loja = $nome;
        $this->token = $token;

    }

    function lerJson($json_file){

        $jsonObj = json_decode($json_file);

    }

    public function getToken(){

        return $this->token;

    }
}
?>