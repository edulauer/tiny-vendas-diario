<?php
//Chamada API para retornar a quantidade de pedidos de venda a partir de dois dias anteriores ao dia atual
require "header.php";

$loja1 = new Loja('Loja 1', $token1);

$pedidos_loja1 = new Pedidos;

$pedidos_loja1->setLoja($loja1); 

$pedidos_loja1->gerarParams();


$rest1 = new Rest;

$rest1->enviarREST($pedidos_loja1->getUrl(), $pedidos_loja1->getData());

$json_file = $rest1->gerarJson();

$jsonObj = $rest1->decodeJson($json_file);

$pedidos_loja1->setPedidos($jsonObj->retorno->pedidos);

echo $pedidos_loja1->ListarPedidos();
echo '<br/>'; 
echo '<hr>';
echo '<br/>'; 
$loja2 = new Loja('Loja 2', $token2);

$pedidos_loja2 = new Pedidos;

$pedidos_loja2->setLoja($loja2); 

$pedidos_loja2->gerarParams();


$rest2 = new Rest;

$rest2->enviarREST($pedidos_loja2->getUrl(), $pedidos_loja2->getData());

$json_file = $rest2->gerarJson();

$jsonObj = $rest2->decodeJson($json_file);

$pedidos_loja2->setPedidos($jsonObj->retorno->pedidos);

echo $pedidos_loja2->ListarPedidos();

require "footer.php";
