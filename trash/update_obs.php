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

if(isset($_POST['btn-edit-obs'])):

	$id = clear ($_POST['id']);
	$carro = clear ($_POST['id_carro']);
	$obs = clear ($_POST['obs']);
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d H:i:s');

	$sql = "UPDATE observacao_carros SET observacao = '$obs', data_criacao = '$date' WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Observação atualizado com sucesso!";
		header("Location: ../car.php?sucesso&id=$carro");
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar a observação!";
		header("Location: ../car.php?erro&id=$carro");
	endif; 

else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close();