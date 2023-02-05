<?php
	session_start();
	include_once 'conexao.php';
	ob_start();

	if(!isset($_SESSION['id']) and !isset($_SESSION['nome'])){
		header("Location: index.php");
	}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inicio</title>
</head>
<body>
	<h1>Bem vindo! <?php echo $_SESSION['nome'];?></h1>

	<a href="sair.php">Sair</a>
</body>
</html>