<?php
    session_start();
	include_once 'conexao.php';
	ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistema de Login</title>
</head>
<body>

	<?php

		#Exemplo criptografar a senha.
		#echo password_hash(123456, PASSWORD_DEFAULT);

		$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if(!empty($dados['SendLogin'])){
			
			#var_dump($dados);

			$query_usuario = "SELECT 
									id, 
									usuario, 
									senha,
									nome 
							 FROM 
						 			usuarios 
							 WHERE 
							 		usuario =:usuario  
							 LIMIT 1";

			/*NÃO RECOMENDADO '".$dados['usuario']."'*/				 	
			
			$result_usuario = $conn->prepare($query_usuario);
			$result_usuario->bindParam(':usuario', $dados['usuario']);
			$result_usuario->execute();

			if(($result_usuario) and ($result_usuario->rowCount() != 0))
			{
				$row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);

				#var_dump($row_usuario);

				if(password_verify($dados['senha'], $row_usuario['senha']))
				{
					$_SESSION['id'] = $row_usuario['id'];
					$_SESSION['nome'] = $row_usuario['nome'];

					header("Location: dashboard.php");
				}
				else
				{
					echo $_SESSION['msg'] = "Usuário ou Senha Invalida";
				}
			}
			else
			{
				$_SESSION['msg'] = "Usuário ou Senha Invalido";
			}

			


		}

		if(isset($_SESSION['msg']))
		{
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}

	?>

	<h1>Login</h1>

	<form method="POST" action="">
		<label>Usuário</label>
		<input type="text" name="usuario" placeholder="Digite o usuário">
		<br><br>
		<label>Senha</label>
		<input type="password" name="senha" placeholder="Digite sua senha">
		<br><br>
		<input type="submit" value="Acessar" name="SendLogin">
	</form>

</body>
</html>