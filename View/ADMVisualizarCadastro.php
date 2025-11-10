<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Visualizar Cadastro</title>
<style> body, h1, h2, h3, h4, h5, h6 { font-family: "Montserrat", sans-serif } </style>
</head>
<body class="w3-light-grey">
    <?php
    include_once 'Controller/UsuarioController.php';
    include_once 'Controller/FormacaoAcadController.php';
    include_once 'Controller/ExperienciaProfissionalController.php';
    include_once 'Controller/OutrasFormacoesController.php'; 
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    $idVis = $_SESSION['idUsuarioVisualizar'];
    $uController = new UsuarioController();
    $usuarioVis = $uController->visualizarUsuario($idVis);
    ?>

<div class="w3-padding-large" id="main">
<center> 
<header class="w3-container w3-padding-32 w3-center" id="home">
    <h1 class="w3-text-white w3-panel w3-cyan w3-round-large">Currículo de <?php echo $usuarioVis->getNome();?></h1>
</header>
</center> 

<div class="w3-content w3-text-grey" id="dPessoais">
<h2 class="w3-text-cyan">Dados Pessoais</h2>
</div>
<center>
<div class=" w3-row w3-light-grey w3-text-blue w3-margin w3-padding" style="width:70%;">
    <p><b>NOME:</b> <?php echo $usuarioVis->getNome();?></p>
    <p><b>CPF:</b> <?php echo $usuarioVis->getCPF();?></p>
    <p><b>EMAIL:</b> <?php echo $usuarioVis->getEmail();?></p>
    <p><b>DATA DE NASCIMENTO:</b> <?php echo $usuarioVis->getDataNascimento();?></p>
</div>
</center> 

<div class="w3-padding-128 w3-content w3-text-grey" id="formacao">
<h2 class="w3-text-cyan">Formação Acadêmica</h2>
</div>
<center>
<div class="w3-container" style="width:70%;">
<table class="w3-table-all w3-centered">
 <thead> 
 <tr class="w3-center w3-blue">
 <th>Início</th>
 <th>Fim</th>
 <th>Descrição</th>
 </tr>
 </thead> 
 <?php
 $fCon = new FormacaoAcadController();
 $results = $fCon->gerarLista($usuarioVis->getID());
 if($results != null)
 while($row = $results->fetch_object()) {
 echo '<tr>';
 echo '<td style="width: 20%;">'.$row->inicio.'</td>';
 echo '<td style="width: 20%;">'.$row->fim.'</td>';
 echo '<td style="width: 60%;">'.$row->descricao.'</td>';
 echo '</tr>';
 }
 ?>
 </table>
</div>
</center> 

<div class="w3-padding-128 w3-content w3-text-grey" id="eProfissional">
<h2 class="w3-text-cyan">Experiência Profissional</h2>
</div>
<center> 
<div class="w3-container" style="width:70%;">
<table class="w3-table-all w3-centered">
 <thead> 
 <tr class="w3-center w3-blue">
 <th>Início</th>
 <th>Fim</th>
 <th>Empresa</th>
 <th>Descrição</th>
 </tr>
 </thead> 
 <?php
 $ePro = new ExperienciaProfissionalController();
 $results = $ePro->gerarLista($usuarioVis->getID());
 if($results != null)
 while($row = $results->fetch_object()) {
 echo '<tr>';
 echo '<td style="width: 20%;">'.$row->inicio.'</td>';
 echo '<td style="width: 20%;">'.$row->fim.'</td>';
 echo '<td style="width: 30%;">'.$row->empresa.'</td>';
 echo '<td style="width: 30%;">'.$row->descricao.'</td>';
 echo '</tr>';
 }
 ?>
 </table>
</div>
</center> 

<div class="w3-padding-128 w3-content w3-text-grey" id="oFormacoes">
<h2 class="w3-text-cyan">Outras Formações</h2>
</div>
<center> 
<div class="w3-container" style="width:70%;">
<table class="w3-table-all w3-centered">
<thead> 
<tr class="w3-center w3-blue">
<th>Início</th>
<th>Fim</th>
<th>Descrição</th>
</tr>
</thead> 
 <?php
 $oCon = new OutrasFormacoesController();
 $results = $oCon->gerarLista($usuarioVis->getID());
 if($results != null)
 while($row = $results->fetch_object()) {
 echo '<tr>';
 echo '<td style="width: 20%;">'.$row->inicio.'</td>';
 echo '<td style="width: 20%;">'.$row->fim.'</td>';
 echo '<td style="width: 60%;">'.$row->descricao.'</td>';
 echo '</tr>';
 }
 ?>
</table>
</div>

<div class="w3-padding-128 w3-content w3-text-grey">
    <form action="index.php" method="post" class="w3-container w3-light-grey w3-text-blue w3-margin w3-center" style="width: 30%;">
        <div class="w3-row w3-section">
            <div>
                <button name="btnVoltarADMLista" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%;"> 
                    Voltar para Lista
                </button>
            </div>
        </div>
    </form>
</div>
</center> 
</div> 
</body>
</html>