<?php
class FormacaoAcad
{
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    // CORREÇÃO: Todos os métodos foram movidos para DENTRO da classe.

    //ID
    public function setID($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }

    //idusuario
    public function setIdUsuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }
    public function getIdUsuario()
    {
        return $this->idusuario;
    }

    //inicio
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }
    public function getInicio()
    {
        return $this->inicio;
    }

    //fim
    public function setFim($fim)
    {
        $this->fim = $fim;
    }
    public function getFim()
    {
        return $this->fim;
    }

    //Descrição
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }

    public function inserirBD()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // CORREÇÃO: Query SQL colocada em uma única linha para evitar erro de sintaxe.
        $sql = "INSERT INTO formacaoAcademica (idusuario, inicio, fim, descricao) VALUES ('".$this->idusuario."','".$this->inicio."','".$this->fim."','".$this->descricao."')";
        
        if ($conn->query($sql) === true) {
            $this->id = mysqli_insert_id($conn);
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function excluirBD($id)
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM formacaoAcademica WHERE idformacaoAcademica = '".$id ."';";
        if ($conn->query($sql) === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function listaFormacoes($idusuario)
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM formacaoAcademica WHERE idusuario = '".$idusuario."'" ;
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }

// CORREÇÃO FINAL: Esta chave fecha a CLASSE e agora está no lugar correto.
}
?>