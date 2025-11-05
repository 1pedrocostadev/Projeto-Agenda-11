<?php
if(!isset($_SESSION))
{
session_start();
}

if (empty($_POST)) {
 echo "Tela de login";
} elseif (isset($_POST["btnPrimeiroAcesso"])) {
 echo "Primeiro acesso";
}

switch ($_POST) {
//Caso a variavel seja nula mostrar tela de login
case isset($_POST[null]):
include_once "View/login.php";
break;
//---Primeiro Acesso--//
case isset($_POST["btnPrimeiroAcesso"]):
include_once "../View/primeiroAcesso.php";
break;

case isset($_POST["btnAtualizar"]):
require_once "../Controller/UsuarioController.php";
$uController = new UsuarioController();
if ($uController->atualizar(
$_POST["txtID"],
$_POST["txtNome"],
$_POST["txtCPF"],
$_POST["txtEmail"],
date("Y-m-d", strtotime($_POST["txtData"]))
)
) {
include_once "../View/atualizacaoRealizada.php";
} else {
include_once "../View/operacaoNaoRealizada.php";
}
break
}

//---Cadastrar--//
case isset($_POST["btnCadastrar"]):
require_once "../Controller/UsuarioController.php";
$uController = new UsuarioController();
if ($uController->inserir(
$_POST["txtNome"],
$_POST["txtCPF"],
$_POST["txtEmail"],
$_POST["txtSenha"]
))
{
include_once "../View/cadastroRealizado.php";
} else {
include_once "../View/cadastroNaoRealizado.php";
}
break;

?>