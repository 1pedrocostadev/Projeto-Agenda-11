<?php

if (!isset($_SESSION)) {
    session_start();
}

// =======================================================
// ESTRUTURA CORRIGIDA: Trocado 'switch' por 'if / elseif'
// =======================================================

// Caso nenhuma variável POST exista (primeiro acesso à página)
if (empty($_POST)) {
    include_once "View/login.php";
} 

// ---Primeiro Acesso--//
elseif (isset($_POST["btnPrimeiroAcesso"])) {
    include_once "../View/primeiroAcesso.php";
} 

// ---Cadastrar (Novo Usuário)--//
// CORREÇÃO: Este bloco estava 'solto' fora do switch. Agora está integrado.
elseif (isset($_POST["btnCadastrar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->inserir(
        $_POST["txtNome"],
        $_POST["txtCPF"],
        $_POST["txtEmail"],
        $_POST["txtSenha"]
    )) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 

// ---Login--//
elseif (isset($_POST["btnLogin"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
        include_once "../View/principal.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 

// ---Atualizar Dados Pessoais--//
elseif (isset($_POST["btnAtualizar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->atualizar(
        $_POST["txtID"],
        $_POST["txtNome"],
        $_POST["txtCPF"],
        $_POST["txtEmail"],
        date("Y-m-d", strtotime($_POST["txtData"]))
    )) {
        include_once "../View/atualizacaoRealizada.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 

// --Adicionar Formacao--//
elseif (isset($_POST["btnAddFormacao"])) {
    require_once "../Controller/FormacaoAcadController.php";
    include_once "../Model/Usuario.php";
    $fController = new FormacaoAcadController();
    if (
        $fController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioFA"])),
            date("Y-m-d", strtotime($_POST["txtFimFA"])),
            $_POST["txtDescFA"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false
    ) {
        include_once "../View/cadastroRealizado.php";
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 

// --Excluir Formacao-//
elseif (isset($_POST["btnExcluirFA"])) {
    require_once "../Controller/FormacaoAcadController.php";
    include_once "../Model/Usuario.php";
    $fController = new FormacaoAcadController();
    if ($fController->remover($_POST["id"]) == true) {
        include_once "../View/informacaoExcluida.php";
    } else {
        // CORREÇÃO: Corrigido typo "operacaoNaoRealizda.php"
        include_once "../View/operacaoNaoRealizada.php";
    }
} 

// --Adicionar Experiencia Profissional-//
elseif (isset($_POST["btnAddEP"])) {
    require_once "../Controller/ExperienciaProfissionalController.php";
    include_once "../Model/Usuario.php";
    $epController = new ExperienciaProfissionalController();
    if (
        $epController->inserir(
            date("Y-m-d", strtotime($_POST["txtInicioEP"])),
            date("Y-m-d", strtotime($_POST["txtFimEP"])),
            $_POST["txtEmpEP"],
            $_POST["txtDescEP"],
            unserialize($_SESSION["Usuario"])->getID()
        ) != false
    ) {
        include_once "../View/informacaoInserida.php";
    } else {
        // CORREÇÃO: Corrigido typo "operacaoNRealizada.php"
        include_once "../View/operacaoNaoRealizada.php";
    }
} 

// --Excluir Experiencia Profissional-//
elseif (isset($_POST["btnExcluirEP"])) {
    require_once "../Controller/ExperienciaProfissionalController.php";
    include_once "../Model/Usuario.php";
    $epController = new ExperienciaProfissionalController();
    if ($epController->remover($_POST["idEP"]) == true) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
}

// Adicione outros 'elseif' para novos botões (como btnAddOF) aqui...