<?php

if (!isset($_SESSION)) {
    session_start();
}

// =======================================================
// ARQUIVO DE NAVEGAÇÃO CORRIGIDO (Nomes de arquivos)
// =======================================================

if (empty($_POST)) {
    // CORRIGIDO: L maiúsculo
    include_once "../View/Login.php"; 
} 

elseif (isset($_POST["btnPrimeiroAcesso"])) {
    // CORRIGIDO: P e A maiúsculos
    include_once "../View/primeiroAcesso.php"; 
} 

elseif (isset($_POST["btnVisualizar"])) {
    $_SESSION['idUserVis'] = $_POST['idUserVis'];
    // CORRIGIDO: ADM, V, C maiúsculos
    include_once '../View/ADMVisualizarCadastro.php';
}

elseif (isset($_POST["btnListarCadastrados"])) {
    // CORRIGIDO: ADM, L, C maiúsculos
    include_once '../View/ADMListarCadastrados.php';
} 

elseif (isset($_POST["btnVoltar"])) {
    // CORRIGIDO: ADM, P maiúsculos
    include_once '../View/ADMPrincipal.php';
}

elseif (isset($_POST["btnCadastrar"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->inserir(
        $_POST["txtNome"],
        $_POST["txtCPF"],
        $_POST["txtEmail"],
        $_POST["txtSenha"]
    )) {
        // (Este nome de arquivo não estava na sua lista, mas estou supondo 'cadastroRealizado.php')
        include_once "../View/cadastroRealizado.php"; 
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 

elseif (isset($_POST["btnLogin"])) {
    require_once "../Controller/UsuarioController.php";
    $uController = new UsuarioController();
    if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
        // CORRIGIDO: P maiúsculo
        include_once "../View/principal.php"; 
    } else {
        include_once "../View/cadastroNaoRealizado.php";
    }
} 

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

// ... (O resto do arquivo está correto) ...


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

elseif (isset($_POST["btnExcluirFA"])) {
    require_once "../Controller/FormacaoAcadController.php";
    include_once "../Model/Usuario.php";
    $fController = new FormacaoAcadController();
    if ($fController->remover($_POST["id"]) == true) {
        include_once "../View/informacaoExcluida.php";
    } else {
        include_once "../View/operacaoNaoRealizada.php";
    }
} 

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
        include_once "../View/operacaoNaoRealizada.php";
    }
} 

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

else {
    echo "Rota não encontrada.";
    // CORRIGIDO: L maiúsculo
    include_once "../View/Login.php"; 
}