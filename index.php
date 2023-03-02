<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Marketing Multi Nível</title>

	<link rel="stylesheet" href="assets\bootstrap\css\bootstrap.min">

	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/navbar-animation-fix.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	
</body>
</html>

<?php
session_start();
require 'config.php';
require 'funcoes.php';

if(empty($_SESSION['mmnlogin'])) {
	header("Location: login.php");
	exit;
}

$id = $_SESSION['mmnlogin'];

$sql = $pdo->prepare("SELECT
	usuarios.nome,
	patentes.nome as p_nome
	FROM usuarios 
	LEFT JOIN patentes ON patentes.id = usuarios.patente
	WHERE usuarios.id = :id");
$sql->bindValue(":id", $id);
$sql->execute();

if($sql->rowCount() > 0) {
	$sql = $sql->fetch();
	$nome = $sql['nome'];
	$p_nome = $sql['p_nome'];
} else {
	header("Location: login.php");
	exit;
}

// O "ID" se refere a sessão em que o sistema esta logado
// O "Limite" esta definido no arquivo "config.php"
$lista = listar($id, $limite);

?>

<div class="container">
<h1> Sistema de Marketing Multinivel</h1>
<b>Usuário Logado: <?php echo $nome. ' ('.$p_nome.')'; ?></b></br></br>

<a href="cadastro.php">Cadastrar novo usuario</a> 
<a href="sair.php"> Sair</a>

<hr/>

<h4>Lista de cadastros</h4>

<?php exibir($lista) ?>
</div>

