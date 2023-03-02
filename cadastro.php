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

if (!empty($_POST['nome']) && !empty($_POST['email'])) {
	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);
	$id_pai = $_SESSION['mmnlogin'];
	$senha = md5($email);

	$sql = $pdo->prepare("SELECT * FROM usuarios email = :email");
	$sql->bindValue(":email", $email);
	$sql->execute();

	if ($sql->rowCount() == 0) {
		$sql = $pdo->prepare("INSERT INTO usuarios (id_pai, nome, email, senha) VALUES (:id_pai, :nome, :email, :senha)");
		$sql->bindValue(":id_pai", $id_pai);
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", $senha);
		$sql->execute();

		header("Location: index.php");
		exit;
	} else {
		echo "Já existe este usuário cadastrado!";
	}
}
?>

<div class="container">
	<h1> Cadastrar Novo Usuário</h1>


	<form method="POST">
		<div class="form-group">
			Nome:<br />
			<input class="form-control" type="text" name="nome" /> <br /> <br />

			E-mail: <br />
			<input class="form-control" type="email" name="email" /> </br> <br />

			<input class="btn btn-primary" type="submit" name="Cadastrar">
		</div>
	</form>
</div>