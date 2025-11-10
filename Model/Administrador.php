<?php

class Administrador
{
    // 1. PROPRIEDADES
    private $id;
    private $nome;
    private $cpf;
    private $senha;

    // =======================================================
    // 2. GETTERS E SETTERS (Movidos para dentro da classe)
    // =======================================================
    public function setID($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }
    
    //nome
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }

    //cpf
    public function setCPF($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCPF()
    {
        return $this->cpf;
    }

    // Senha
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    // =======================================================
    // 3. MÉTODOS DA CLASSE (Movidos para dentro da classe)
    // =======================================================
    
    public function carregarAdministrador($cpf)
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // --- CORREÇÃO DE SEGURANÇA (SQL INJECTION) ---
        // A consulta SQL foi reescrita para usar Prepared Statements.
        $sql = "SELECT * FROM administrador WHERE cpf = ?";
        
        // Prepara a consulta
        $stmt = $conn->prepare($sql);
        // Associa o parâmetro $cpf (como 's' de string)
        $stmt->bind_param("s", $cpf);
        // Executa
        $stmt->execute();
        
        // Pega o resultado
        $re = $stmt->get_result();
        $r = $re->fetch_object();

        if ($r != null) {
            $this->id = $r->idadministrador;
            $this->nome = $r->nome;
            $this->cpf = $r->cpf;
            $this->senha = $r->senha;
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    } // <-- CORREÇÃO: Faltava esta chave '}' aqui

    public function listaCadastrados()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        // CORREÇÃO: Removida quebra de linha
        $conn = $con->conectar(); 
        // CORREÇÃO: Removida quebra de linha
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT idadministrador, nome, cpf FROM administrador;";
        $re = $conn->query($sql);
        // CORREÇÃO: Removida quebra de linha
        $conn->close();
        return $re;
    }

} // <-- CORREÇÃO: Esta é a chave de fechamento final da Classe