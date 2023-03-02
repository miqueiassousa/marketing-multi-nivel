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

if (!empty($_POST['email'])) {
	$email = addslashes($_POST['email']);
	$senha = md5(addslashes($_POST['senha']));

	$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
	$sql->bindValue(":email", $email);
	$sql->bindValue(":senha", $senha);
	$sql->execute();

	if ($sql->rowCount() > 0) {
		$sql =  $sql->fetch();

		$_SESSION['mmnlogin'] = $sql['id'];

		header("Location: index.php");
		exit;
	} else {
		echo "Usuário e/ou Senha errados";
	}
}

?>
</br>
<div class="container">
	<form method="POST">
		<h2>Faça o Login</h2>
		<hr>
		<div class="form-group">
			E-mail:<br />
			<input class="form-control" type="email" name="email" /><br /><br />

			Senha:<br />
			<input class="form-control" type="password" name="senha" /><br /></br>

			<input class="btn btn-primary" type="submit" name="Entrar" />
		</div>
</div>
</form>