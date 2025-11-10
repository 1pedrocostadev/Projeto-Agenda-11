<?php
if(!isset($_SESSION))
{
    session_start();
}
class OutrasFormacoesController{

    public function inserir($inicio, $fim, $descricao, $idusuario) {
        require_once 'Model/OutrasFormacoes.php';
        $of = new OutrasFormacoes();
        $of->setInicio($inicio);
        $of->setFim($fim);
        $of->setDescricao($descricao);
        $of->setIdUsuario($idusuario);
        $r = $of->inserirBD();
        return $r;
    }

    public function remover($id) {
        require_once 'Model/OutrasFormacoes.php';
        $of = new OutrasFormacoes();
        $r = $of->excluirBD($id);
        return $r;
    }

    public function gerarLista($idusuario)
    {
        require_once 'Model/OutrasFormacoes.php';
        $of = new OutrasFormacoes();
        return $results = $of->listaFormacoes($idusuario);
    }
}
?>