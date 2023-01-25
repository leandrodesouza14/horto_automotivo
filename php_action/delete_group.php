<?php

session_start();

require_once 'db_connect.php';

if(isset($_POST['btn-col-deletar'])):

	$id_colaborador = mysqli_escape_string($connect, $_POST['id_colaborador']);
	$id_carro = mysqli_escape_string($connect, $_POST['id_carro']);

	$sql = "DELETE FROM grupo WHERE integrantes = '$id_colaborador' AND carros = '$id_carro'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Integrante excluído com sucesso!";
		header("Location: ../car.php?sucesso&id=$id_carro");
	else:
		$_SESSION['mensagem'] = "Erro ao excluir o integrante!";
		header("Location: ../car.php?erro&id=$id_carro");
	endif; 

else:
	header('Location: ../car.php?formulario-erro');
endif;

mysqli_close();

