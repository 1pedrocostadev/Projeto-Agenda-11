<?php
if(!isset($_SESSION))
{
    session_start();
}
class ExperienciaProfissionalController{
    public function inserir($inicio, $fim, $empresa, $descricao, $idusuario) {
        require_once 'Model/ExperienciaProfissional.php';
        $expp = new ExperienciaProfissional();
        $expp->setInicio($inicio);
        $expp->setFim($fim);
        $expp->setEmpresa ($empresa);
        $expp->setDescricao($descricao);
        $expp->setIdUsuario($idusuario);
        $r = $expp->inserirBD();
        return $r;
    }
    public function remover ($id) {
        require_once 'Model/ExperienciaProfissional.php';
        $expp = new ExperienciaProfissional();
        $r = $expp->excluirBD($id);
        return $r;
    }
    public function gerarLista($idusuario)
    {
        require_once 'Model/ExperienciaProfissional.php';
        $expp = new ExperienciaProfissional();
        return $results = $expp->listaExperiencias ($idusuario);
    }
}
?>