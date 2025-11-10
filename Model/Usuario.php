<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'ConexaoBD.php';

class Usuario
{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha;

    public function setID($id){ $this->id = $id; }
    public function getID(){ return $this->id; }
    public function setNome($nome){ $this->nome = $nome; }
    public function getNome(){ return $this->nome; }
    public function setCPF($cpf){ $this->cpf = $cpf; }
    public function getCPF(){ return $this->cpf; }
    public function setEmail($email){ $this->email = $email; }
    public function getEmail(){ return $this->email; }
    public function setDataNascimento($dataNascimento){ $this->dataNascimento = $dataNascimento; }
    public function getDataNascimento(){ return $this->dataNascimento; }
    public function setSenha($senha){ $this->senha = $senha; }
    public function getSenha(){ return $this->senha; }

    public function inserirBD()
    {
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO usuario (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $this->nome, $this->cpf, $this->email, $this->senha);

        if ($stmt->execute() === TRUE) {
            $this->id = $conn->insert_id;
            $stmt->close();
            $conn->close();
            return TRUE;
        } else {
            $stmt->close();
            $conn->close();
            return FALSE;
        }
    }

    public function carregarUsuario($cpf)
    {
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usuario WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        
        $re = $stmt->get_result();
        $r = $re->fetch_object();

        if ($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    public function carregarUsuarioPorID($id)
    {
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM usuario WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $re = $stmt->get_result();
        $r = $re->fetch_object();

        if ($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $stmt->close();
            $conn->close();
            return true;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }

    public function atualizarBD()
    {
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE usuario SET nome = ?, cpf = ?, dataNascimento = ?, email = ? WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->nome, $this->cpf, $this->dataNascimento, $this->email, $this->id);

        if ($stmt->execute() === TRUE) {
            $stmt->close();
            $conn->close();
            return TRUE;
        } else {
            $stmt->close();
            $conn->close();
            return FALSE;
        }
    }

    public function listaCadastrados()
    {
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      
        $sql = "SELECT idusuario, nome FROM usuario;";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
}