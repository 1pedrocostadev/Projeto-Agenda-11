<?php

if (!isset($_SESSION)) {
    session_start();
}

// CORREÇÃO: Movido o 'require_once' para o topo.
// É mais eficiente incluí-lo apenas uma vez, fora dos métodos.
require_once '../Model/FormacaoAcad.php';

class FormacaoAcadController
{
    public function inserir($inicio, $fim, $descricao, $idusuario)
    {
        $formacao = new FormacaoAcad();
        $formacao->setInicio($inicio);
        $formacao->setFim($fim);
        $formacao->setDescricao($descricao);
        $formacao->setIdUsuario($idusuario);
        $r = $formacao->inserirBD();
        return $r;
    }

    public function remover($id)
    {
        $formacao = new FormacaoAcad();
        $r = $formacao->excluirBD($id);
        return $r;
    }

    public function gerarLista($idusuario)
    {
        $formacao = new FormacaoAcad();
        
        // Simplificado (não é um erro, apenas mais limpo)
        return $formacao->listaFormacoes($idusuario);
    }
}

// CORREÇÃO: Tag '?>' removida (boa prática para arquivos só de PHP)