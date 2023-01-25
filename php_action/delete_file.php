<?php

session_start();

require_once 'db_connect.php';

if(isset($_POST['btn-file-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);
	$idcarro = mysqli_escape_string($connect, $_POST['id_carro']);

	$sql = "SELECT arquivo FROM biblioteca WHERE id = '$id'";
	$query = mysqli_query($connect, $sql);
	if(mysqli_num_rows($query) > 0):
		while($arquivo = mysqli_fetch_array($query)):
			$arquivo = $arquivo['arquivo'];
			$diretorio = "../biblioteca/";
			$nomedoarquivo = $diretorio . $arquivo;
			$excluir = unlink($nomedoarquivo);
			if($excluir === false):
				$_SESSION['mensagem'] = "Falha ao excluir arquivo!";
				header("Location: ../car.php?erro&id=$idcarro");
				exit;
			endif; 
		endwhile;
	endif;

	$sql = "DELETE FROM biblioteca WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Arquivo excluído com sucesso!";
		header("Location: ../car.php?sucesso&id=$idcarro");
	else:
		$_SESSION['mensagem'] = "Erro ao excluir o arquivo!";
		header("Location: ../car.php?sucesso&id=$idcarro");
	endif; 

else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close();