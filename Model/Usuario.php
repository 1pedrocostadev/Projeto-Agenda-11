class Usuario
{
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha; 
}
        //ID
        public function setID($id)
        {
        $this->id = $id;
        }
        public function getID()
        {
        return $this->id;
        }
        //Nome
        public function setNome($nome)
        {
        $this->nome = $nome;
        }
        public function getNome()
        {
        return $this->nome;
        }
        //CPF
        public function setCPF($cpf)
        {
        $this->cpf = $cpf;
        }
        public function getCPF()
        {
        return $this->cpf;
        }
        //Email
        public function setEmail($email)
        {
        $this->email = $email;
        }
        public function getEmail()
        {
        return $this->email;
        }
        //Data de nascimento
        public function setDataNascimento($dataNascimento)
        {
        $this->dataNascimento = $dataNascimento;
        }
        public function getDataNascimento()
        {
        return $this->dataNascimento;
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

public function inserirBD()
 {
 require_once 'ConexaoBD.php';
 $con = new ConexaoBD();
 $conn = $con->conectar();
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 $sql = "INSERT INTO usuario (nome, cpf, email, senha)VALUES ('".$this->nome."', '".$this-
>cpf."', '".$this->email."','".$this->senha."')";
 if ($conn->query($sql) === TRUE) {
 $this->id = mysqli_insert_id($conn);
 $conn->close();
 return TRUE;
 } else {
 $conn->close();
 return FALSE;
 }
 } 