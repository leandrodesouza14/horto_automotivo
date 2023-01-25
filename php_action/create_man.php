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


if(isset($_POST['btn-cadastrar-man'])):

	
	$id = clear ($_GET['id']);
	$descricao = clear ($_POST['descricao']);
	$data = clear ($_POST['data']);
	$km = clear ($_POST['km']);
	$tipo = clear ($_POST['tipo']);
	$criador = clear($_SESSION['id_usuario']);

	$sql = "INSERT INTO historico_manutencao (id_carro, id_criador, manutencao, data, km, tipo) VALUES ('$id', '$criador', '$descricao', '$data', '$km', '$tipo')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Manutenção adicionada com sucesso!";
		header("Location: ../car.php?sucesso&id=$id");
	else:
		$_SESSION['mensagem'] = "Erro ao adicionar a manutenção!";
		header("Location: ../car.php?erro&id=$id");
	endif; 

else:
	header('Location: ../car.php?formulario-erro'); 
endif;

mysqli_close();