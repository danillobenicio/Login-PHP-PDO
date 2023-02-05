<?php

	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "dblogin";

	try {
		
		$conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);

		#echo "Conexão realizada com sucesso";

	} catch (PDOException $err) {
		
		#echo "Erro de conexão. " . $err->getMessage();

	}

?>