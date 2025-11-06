<?php

if (!isset($_SESSION)) {
    session_start();
}

// CORREÇÃO: Movido o 'require_once' para o topo.
// É mais eficiente incluí-lo apenas uma vez, fora dos métodos.
require_once '../Model/ExperienciaProfissional.php';

class ExperienciaProfissionalController
{
    public function inserir($inicio, $fim, $empresa, $descricao, $idusuario)
    {
        $expP = new ExperienciaProfissional();
        $expP->setInicio($inicio);
        $expP->setFim($fim);
        $expP->setEmpresa($empresa);
        $expP->setDescricao($descricao);
        $expP->setIdUsuario($idusuario);
        $r = $expP->inserirBD();
        return $r;
    }

    public function remover($id)
    {
        $expP = new ExperienciaProfissional();
        $r = $expP->excluirBD($id);
        return $r;
    }

    public function gerarLista($idusuario)
    {
        $expP = new ExperienciaProfissional();
        
        // Simplificado
        return $expP->listaExperiencias($idusuario);
    }
}

// CORREÇÃO: Tag '?>' removida (boa prática para arquivos só de PHP)