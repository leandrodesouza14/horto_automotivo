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

if(isset($_POST['btn-editar-man'])):

	$carro = clear ($_POST['carro']);
	$id = clear ($_POST['id']);
	$descricao = clear ($_POST['descricao']);
	date_default_timezone_set('America/Sao_Paulo');
	$data = clear ($_POST['data']);
	$km = clear ($_POST['km']);
	$tipo = clear ($_POST['tipo']);

	$sql = "UPDATE historico_manutencao SET manutencao = '$descricao', tipo = '$tipo', data = '$data', km = '$km' WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Manutenção alterada com sucesso!";
		header("Location: ../car.php?sucesso&id=$carro");
	else:
		$_SESSION['mensagem'] = "Erro ao alterar a manutenção!";
		header("Location: ../car.php?erro&id=$carro");
	endif; 

else:
	header('Location: ../index.php?formulario-erro'); 
endif;

mysqli_close();