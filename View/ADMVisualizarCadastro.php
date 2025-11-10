<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once '../Controller/UsuarioController.php';
include_once '../Controller/FormacaoAcadController.php';
include_once '../Controller/ExperienciaProfissionalController.php';

$idUsuario = $_SESSION['idUserVis'];

$uController = new UsuarioController();
$usuario = $uController->buscarPorId($idUsuario);

$fController = new FormacaoAcadController();
$listaFormacao = $fController->gerarLista($idUsuario);

$eController = new ExperienciaProfissionalController();
$listaExp = $eController->gerarLista($idUsuario);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Visualizar Cadastro</title>
    <style>
        body, h1, h2, h3, h4, h5, h6 { font-family: "Montserrat", sans-serif }
    </style>
</head>

<body class="w3-light-grey">
    <div class="w3-padding-large" id="main"> 

        <header class="w3-container w3-padding-32 w3-center ">
            <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">
                Visualização de Cadastro
            </h1>
        </header>

        <div class="w3-content w3-text-grey w3-card w3-container" style="padding: 20px;">
            <h2 class="w3-text-cyan"><i class="fa fa-user"></i> Dados Pessoais</h2>
            
            <div class="w3-row-padding">
                <div class="w3-half w3-margin-bottom">
                    <label>Nome Completo</label>
                    <input class="w3-input w3-border w3-light-grey" type="text" value="<?php echo $usuario->getNome(); ?>" disabled>
                </div>
                <div class="w3-half">
                    <label>CPF</label>
                    <input class="w3-input w3-border w3-light-grey" type="text" value="<?php echo $usuario->getCPF(); ?>" disabled>
                </div>
            </div>
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label>Email</label>
                    <input class="w3-input w3-border w3-light-grey" type="text" value="<?php echo $usuario->getEmail(); ?>" disabled>
                </div>
                <div class="w3-half">
                    <label>Data de Nascimento</label>
                    <?php
                        $dataNasc = $usuario->getDataNascimento();
                        if($dataNasc) {
                            $dataNasc = date("d/m/Y", strtotime($dataNasc));
                        }
                    ?>
                    <input class="w3-input w3-border w3-light-grey" type="text" value="<?php echo $dataNasc; ?>" disabled>
                </div>
            </div>
        </div>

        <div class="w3-padding-32 w3-content w3-text-grey">
            <h2 class="w3-text-cyan"><i class="fa fa-mortar-board"></i> Formação Acadêmica</h2>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaFormacao != null && $listaFormacao->num_rows > 0) {
                            while ($row = $listaFormacao->fetch_object()) {
                                echo '<tr>';
                                echo '<td>' . date("d/m/Y", strtotime($row->inicio)) . '</td>';
                                echo '<td>' . date("d/m/Y", strtotime($row->fim)) . '</td>';
                                echo '<td>' . $row->descricao . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="3">Nenhuma formação cadastrada.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w3-padding-32 w3-content w3-text-grey">
            <h2 class="w3-text-cyan"><i class="fa fa-briefcase"></i> Experiência Profissional</h2>
            <div class="w3-container">
                <table class="w3-table-all w3-centered">
                    <thead>
                        <tr class="w3-center w3-blue">
                            <th>Início</th>
                            <th>Fim</th>
                            <th>Empresa</th>
                            <th>Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listaExp != null && $listaExp->num_rows > 0) {
                            while ($row = $listaExp->fetch_object()) {
                                echo '<tr>';
                                echo '<td>' . date("d/m/Y", strtotime($row->inicio)) . '</td>';
                                echo '<td>' . date("d/m/Y", strtotime($row->fim)) . '</td>';
                                echo '<td>' . $row->empresa . '</td>';
                                echo '<td>' . $row->descricao . '</td>';
                                echo '</tr>';
                            }
                        } else {
                             echo '<tr><td colspan="4">Nenhuma experiência cadastrada.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="w3-padding-32 w3-content">
            <form action="/Controller/navegacao.php" method="post" class="w3-container w3-margin w3-center">
                <button name="btnListarCadastrados" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 30%;">
                    <i class="fa fa-arrow-left"></i> Voltar para Lista
                </button>
            </form>
        </div>

    </div>
</body>
</html>