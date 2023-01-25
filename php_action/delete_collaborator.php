<?php

session_start();

require_once 'db_connect.php';

if(isset($_POST['btn-deletar-collaborator'])):

	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "SELECT foto FROM colaborador WHERE id = '$id'";
	$query = mysqli_query($connect, $sql);
	if(mysqli_num_rows($query) > 0):
		while($fotos = mysqli_fetch_array($query)):
			$foto = $fotos['foto'];
			$diretorio = "../images/";
			$nomedoarquivo = $diretorio . $foto;
			unlink($nomedoarquivo);
		endwhile;
	endif;

	$sql = "DELETE FROM colaborador WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Colaborador excluído com sucesso!";
		header('Location: ../index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao excluir o colaborador!";
		header('Location: ../index.php?erro');
	endif; 

else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close();