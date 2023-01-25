<?php

session_start();

require_once 'db_connect.php';

function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['btn-add-group'])):

	$id_carro = clear ($_POST['id_carro']);
	$colaborador = clear ($_POST['colaborador']);

	$sql = "SELECT id FROM grupo WHERE integrantes = '$colaborador' and carros = '$id_carro'";
	$resultado = mysqli_query($connect, $sql);
	$array = (mysqli_fetch_array($resultado));

	if(mysqli_num_rows($resultado) > 0):
		$_SESSION['mensagem'] = "Esse colaborador ja é responsável por esse carro!";
		header("Location: ../car.php?erro&id=$id_carro");
	else:
		$sql = "INSERT INTO grupo (integrantes, carros) VALUES ('$colaborador', '$id_carro')";

		if(mysqli_query($connect, $sql)):
			$_SESSION['mensagem'] = "Responsável adicionado com sucesso!";
			header("Location: ../car.php?sucesso&id=$id_carro");
		else:
			$_SESSION['mensagem'] = "Erro ao adicionar o responsável!";
			header("Location: ../car.php?erro&id=$id_carro");
		endif; 
	endif;
else:
	header('Location: ../car.php?formulario-erro');
endif;

mysqli_close($connect);
