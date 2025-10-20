<?php
// ======================================================================
// ARQUIVO DE DIAGNÓSTICO - verificar.php
// Este script vai forçar a exibição de todos os erros.
// ======================================================================
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "<h1>Iniciando Verificação do Sistema</h1>";
echo "<p>Versão do PHP: " . phpversion() . "</p>";
echo "<hr>";

function verificarArquivo($nomeArquivo) {
    echo "Verificando arquivo: <strong>{$nomeArquivo}</strong> ... ";
    if (file_exists($nomeArquivo)) {
        echo "<span style='color:green;'>ENCONTRADO.</span><br>";
        echo "Tentando incluir o arquivo... ";
        try {
            require_once $nomeArquivo;
            echo "<span style='color:green;'>INCLUÍDO COM SUCESSO (sem erros de sintaxe).</span><br>";
            return true;
        } catch (Throwable $t) {
            echo "<span style='color:red; font-weight:bold;'>ERRO FATAL AO INCLUIR: " . $t->getMessage() . "</span><br>";
            return false;
        }
    } else {
        echo "<span style='color:red; font-weight:bold;'>ARQUIVO NÃO ENCONTRADO!</span> Verifique o nome e o caminho.<br>";
        return false;
    }
}

// --- VERIFICAÇÃO DOS ARQUIVOS DE CLASSE ---
echo "<h2>Passo 1: Verificando arquivos de Classe</h2>";
verificarArquivo('ConexaoBD.php');
verificarArquivo('Usuario.php');
verificarArquivo('FormacaoAcad.php');
verificarArquivo('ExperienciaProfissional.php');
echo "<hr>";

// --- TENTATIVA DE CONEXÃO COM O BANCO ---
echo "<h2>Passo 2: Testando a Conexão com o Banco de Dados</h2>";
echo "Tentando conectar... ";
if (class_exists('ConexaoBD')) {
    $conexaoTeste = new ConexaoBD();
    $conn = $conexaoTeste->conectar();
    if ($conn && !$conn->connect_error) {
        echo "<span style='color:green;'>CONEXÃO BEM-SUCEDIDA!</span><br>";
        $conn->close();
    } else {
        echo "<span style='color:red; font-weight:bold;'>FALHA NA CONEXÃO!</span><br>";
        echo "Mensagem de erro: " . ($conn->connect_error ?? 'Não foi possível obter o erro específico.') . "<br>";
    }
} else {
    echo "<span style='color:red; font-weight:bold;'>Classe 'ConexaoBD' não existe. Verifique o Passo 1.</span><br>";
}
echo "<hr>";

echo "<h2>Diagnóstico Concluído</h2>";
echo "<p>Se você vê esta mensagem sem nenhum ERRO FATAL em vermelho, os seus arquivos de classe e a sua conexão com o banco de dados estão funcionando corretamente. O problema está no arquivo que você usa para cadastrar/listar os dados.</p>";

?>