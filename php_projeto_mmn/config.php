<?php
try {
	global $pdo;
	$pdo = new PDO("mysql:dbname=projeto_marketingmn;host=localhost", "root", "root");

} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

$limite = 3;

$patentes = array(
	
);