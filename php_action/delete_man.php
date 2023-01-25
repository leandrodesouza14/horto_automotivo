<?php

session_start();

require_once 'db_connect.php';

if(isset($_POST['btn-man-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idcarro = mysqli_escape_string($connect, $_POST['id_carro']);

	$sql = "DELETE FROM historico_manutencao WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Manutenção excluída com sucesso!";
		header("Location: ../man.php?sucesso&id=$idcarro");
	else:
		$_SESSION['mensagem'] = "Erro ao excluir a Manutenção!";
		header("Location: ../man.php?sucesso&id=$idcarro");
	endif; 

else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close();