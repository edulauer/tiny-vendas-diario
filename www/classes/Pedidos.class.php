<?php

class Pedidos extends Loja{

    private $url = 'https://api.tiny.com.br/api2/pedidos.pesquisa.php';
    private $formato = 'JSON';
    private $total_do_dia = 0;
    private $total_ontem = 0;
    private $total_anteontem = 0;
    private $counter = 0;
    private $data;
    private $pedidos;
    public $dataInicial;
    public $dataFinal;
    public $table;
    //Classe Loja
    private $loja;


    function __construct(){
        $this->ontem = date("d/m/Y", strtotime('-1 day'));
        $this->anteontem = date("d/m/Y", strtotime('-2 day'));
        $this->dataInicial = $this->anteontem;
        $this->dataFinal = date("d/m/Y");
    }

    function gerarParams(){
        
        $this->data = "token=".$this->loja->token."&dataInicial=".$this->dataInicial."&dataFinal=".$this->dataFinal."&formato=".$this->formato;

    }

    function ListarPedidos(){

        $table = '<table border="1"><tr><th colspan="3" spacing="0">'. $this->loja->nome_loja. '</th></tr>';
        $table .= '<tr><th>Data</th><th>Valor</th><th>Vendedor</th></tr>';
        foreach ($this->pedidos as $p) {

            if($p->pedido->data_pedido == date("d/m/Y")){

                $table .= '<tr>';
                $this->counter++;
                $table .= '<td>' . $p->pedido->data_pedido . '</td>';
                $table .= '<td>'. 'R$ ' . number_format($p->pedido->valor,2,",",".") .'</td>';
                $table .= '<td>'. $p->pedido->nome_vendedor .'</td>';
                $this->total_do_dia += $p->pedido->valor;
                $table .= '</tr>';

            }elseif ($p->pedido->data_pedido == $this->ontem){

                $this->total_ontem += $p->pedido->valor;

            }elseif ($p->pedido->data_pedido == $this->anteontem){

                $this->total_anteontem += $p->pedido->valor;

            }
        }
        $table .= '<td></td>';
        $table .= '<td>' . $this->getTotaldoDia() . '</td>';
        $table .= '<td>' . $this->getTotalOntem() . '<br/>';
        $table .= $this->getTotalAnteontem() . '</td>';
        $table .= '</table>';

        return $table;

    }

    function setLoja($loja){

        $this->loja = $loja;

    }

    function getTotaldoDia(){

        $retorno = '<strong>Total do Dia: </strong> R$ ' . number_format($this->total_do_dia,2,",",".");

        return $retorno;

    }

    function getTotalOntem(){

        $retorno = '<strong>Total Ontem: </strong> R$ ' . number_format($this->total_ontem,2,",",".");

        return $retorno;

    }


    function getTotalAnteontem(){

        $retorno = '<strong>Total Anteontem: </strong> R$ ' . number_format($this->total_anteontem,2,",",".");

        return $retorno;

    }

    function setPedidos($pedidos){

        $this->pedidos = $pedidos;
        
    }

    function getData(){

        return $this->data;
        
    }

    function getUrl(){

        return $this->url;
        
    }


}
?>