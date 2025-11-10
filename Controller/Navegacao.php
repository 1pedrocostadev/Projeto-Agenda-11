<?php
if(!isset($_SESSION))
{
 session_start();
}

switch ($_POST) {
 case isset($_POST[null]):
 include_once "View/login.php"; 
 break;

 case isset($_POST["btnPrimeiroAcesso"]):
 include_once "View/primeiroAcesso.php"; 
 break;

 case isset($_POST["btnCadastrar"]):
 require_once "Controller/UsuarioController.php"; 
 $uController = new UsuarioController();
 if ($uController->inserir(
 $_POST["txtNome"],
 $_POST["txtCPF"],
 $_POST["txtEmail"],
 $_POST["txtSenha"]
 ))
 {
 include_once "View/cadastroRealizado.php"; 
 } else {
 include_once "View/cadastroNaoRealizado.php"; 
 }
 break;

 case isset($_POST["btnAtualizar"]):
 require_once "Controller/UsuarioController.php"; 
 $uController = new UsuarioController();
 if ($uController->atualizar(
 $_POST["txtID"],
 $_POST["txtNome"],
 $_POST["txtCPF"],
 $_POST["txtEmail"],
 date("Y-m-d", strtotime($_POST["txtData"]))
 )
 ) {
 include_once "View/atualizacaoRealizada.php"; 
 } else {
 include_once "View/operacaoNaoRealizada.php"; 
 }
 break;

 case isset($_POST["btnLogin"]):
 require_once "Controller/UsuarioController.php"; 
 $uController = new UsuarioController();
 if ($uController->login($_POST["txtLogin"], $_POST["txtSenha"])) {
 include_once "View/principal.php"; 
 } else {
 include_once "View/cadastroNaoRealizado.php"; 
 }
 break;

 case isset($_POST["btnAddFormacao"]):
 require_once "Controller/FormacaoAcadController.php"; 
 include_once "Model/Usuario.php"; 
 $fController = new FormacaoAcadController();
 if ($fController->inserir(
 date("Y-m-d", strtotime($_POST["txtInicioFA"])),
 date("Y-m-d", strtotime($_POST["txtFimFA"])),
 $_POST["txtDescFA"],
 unserialize($_SESSION["Usuario"])->getID()
 ) != false
 ) {
 include_once "View/cadastroRealizado.php"; 
 } else {
 include_once "View/cadastroNaoRealizado.php"; 
 }
 break;

 case isset($_POST["btnExcluirFA"]):
 require_once "Controller/FormacaoAcadController.php"; 
 include_once "Model/Usuario.php"; 
 $fController = new FormacaoAcadController();
 if ($fController->remover($_POST["id"]) == true) {
 include_once "View/informacaoExcluida.php"; 
 } else {
 include_once "View/operacaoNaoRealizda.php"; 
 }
 break;

 case isset($_POST["btnAddEP"]):
 require_once "Controller/ExperienciaProfissionalController.php"; 
 include_once "Model/Usuario.php"; 
 $epController = new ExperienciaProfissionalController();
 if ($epController->inserir(
 date("Y-m-d", strtotime($_POST["txtInicioEP"])),
 date("Y-m-d", strtotime($_POST["txtFimEP"])),
 $_POST["txtEmpEP"],
 $_POST["txtDescEP"],
 unserialize($_SESSION["Usuario"])->getID()
 ) != false
 ) {
 include_once "View/informacaoInserida.php"; 
 } else {
 include_once "View/operacaoNRealizada.php"; 
 }
 break;

 case isset($_POST["btnExcluirEP"]):
 require_once "Controller/ExperienciaProfissionalController.php"; 
 include_once "Model/Usuario.php"; 
 $epController = new ExperienciaProfissionalController();
 if ($epController->remover ($_POST["idEP"]) == true) {
 include_once "View/informacaoExcluida.php"; 
 } else {
 include_once "View/operacaoNRealizada.php"; 
 }
 break;
 
 case isset($_POST["btnAddOF"]):
    require_once "Controller/OutrasFormacoesController.php";
    include_once "Model/Usuario.php";
    $ofController = new OutrasFormacoesController();
    if ($ofController->inserir(
        date("Y-m-d", strtotime($_POST["txtInicioOF"])),
        date("Y-m-d", strtotime($_POST["txtFimOF"])),
        $_POST["txtDescOF"],
        unserialize($_SESSION["Usuario"])->getID()
    ) != false
    ) {
        include_once "View/informacaoInserida.php";
    } else {
        include_once "View/operacaoNRealizada.php";
    }
    break;

 case isset($_POST["btnExcluirOF"]):
    require_once "Controller/OutrasFormacoesController.php";
    include_once "Model/Usuario.php";
    $ofController = new OutrasFormacoesController();
    if ($ofController->remover($_POST["idOF"]) == true) {
        include_once "View/informacaoExcluida.php";
    } else {
        include_once "View/operacaoNaoRealizda.php";
    }
    break;

 case isset($_POST["btnADM"]):
    include_once 'View/ADMLogin.php';
    break;

 case isset($_POST["btnLoginADM"]):
    require_once 'Controller/AdministradorController.php';
    $aController = new AdministradorController();
    if($aController->login($_POST['txtLoginADM'], $_POST['txtSenhaADM'])) {
        include_once 'View/ADMPrincipal.php';
    } else {
        include_once 'View/ADMLogin.php'; 
    }
    break;

 case isset($_POST["btnListarCadastrados"]):
    include_once 'View/ADMListarCadastrados.php';
    break;

 case isset($_POST["btnVoltar"]):
    include_once 'View/ADMPrincipal.php';
    break;
 
 case isset($_POST["btnListarADM"]):
    include_once 'View/ADMListarAdministradores.php';
    break;

 case isset($_POST["btnVisualizarUsuario"]):
    $_SESSION['idUsuarioVisualizar'] = $_POST['idUsuarioVisualizar'];
    include_once "View/ADMVisualizarCadastro.php";
    break;

 case isset($_POST["btnVoltarADMLista"]):
    include_once "View/ADMListarCadastrados.php";
    break;
    
}
?>