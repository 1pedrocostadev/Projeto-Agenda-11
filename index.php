<?php
// Ativa a exibição de todos os erros.
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Página Principal - Inserindo um Usuário</h1>";
echo "<hr>";

// PASSO 1: Incluir a classe (já sabemos que funciona)
require_once 'Model/Usuario.php';

// PASSO 2: Criar o objeto
$novoUsuario = new Usuario();

// PASSO 3: Preencher o objeto com dados usando os métodos "set"
echo "Preenchendo o objeto com dados...<br>";
$novoUsuario->setNome("João da Silva");
$novoUsuario->setCPF("111.222.333-44");
$novoUsuario->setEmail("joao.silva@email.com");
$novoUsuario->setSenha("senha123"); // Em um projeto real, a senha deve ser criptografada!
echo "Dados preenchidos!<br>";

echo "<p>Objeto antes de salvar no banco:</p>";
echo "<pre>";
var_dump($novoUsuario);
echo "</pre>";
echo "<hr>";

// PASSO 4: Chamar o método para inserir no banco de dados
echo "<h2>Tentando inserir o usuário no banco de dados...</h2>";
$resultado = $novoUsuario->inserirBD();

// PASSO 5: Verificar o resultado
if ($resultado === true) {
    echo "<h3 style='color:green;'>SUCESSO! Usuário inserido no banco de dados.</h3>";
    echo "<p>O ID do novo usuário é: " . $novoUsuario->getID() . "</p>";
} else {
    echo "<h3 style='color:red;'>FALHA! Não foi possível inserir o usuário.</h3>";
    echo "<p>Verifique o método inserirBD() na classe Usuario ou as configurações do banco de dados.</p>";
}
?>