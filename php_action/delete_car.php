<?php

session_start();

require_once 'db_connect.php';

if(isset($_POST['btn-deletar'])):

	$id = mysqli_escape_string($connect, $_POST['id']);

	$sql = "SELECT foto FROM carros WHERE id = '$id'";
	$query = mysqli_query($connect, $sql);
	if(mysqli_num_rows($query) > 0):
		while($fotos = mysqli_fetch_array($query)):
			if($fotos['foto'] !== 'no_image.png'):
				$foto = $fotos['foto'];
				$diretorio = "../images/";
				$nomedoarquivo = $diretorio . $foto;
				unlink($nomedoarquivo);
			endif;
		endwhile;
	endif;

	$sql = "DELETE FROM carros WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Veículo excluído com sucesso!";
		header('Location: ../index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao excluir o veículo!";
		header('Location: ../index.php?erro');
	endif; 

else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close();