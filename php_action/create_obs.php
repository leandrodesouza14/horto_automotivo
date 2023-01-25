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

if(isset($_POST['btn-add-obs'])):

	$id_carro = clear ($_POST['id_carro']);
	$observacao = clear ($_POST['obs']);
	$descricao = clear ($_POST['descricao']);
	if ($descricao === ""):
		$descricao = "-";
	endif;
	$id_criador = clear ($_POST['id_criador']);
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d H:i:s');

	$sql = "SELECT id FROM observacao_carros WHERE id_carro = '$id_carro' ";
	$resultado = mysqli_query($connect, $sql);
	if(mysqli_num_rows($resultado) > 0):
		$array = mysqli_fetch_array($resultado);
		$id = $array['id'];
		$sql = "DELETE FROM observacao_carros WHERE id = '$id'";
		$resultado = mysqli_query($connect, $sql);
			if($resultado === false):
				$_SESSION['mensagem'] = "Não foi possível excluir a observação presente!";
	            header("Location: ../car.php?erro&id=$id_carro");
	            exit;
        	endif;
	endif;

	$sql = "INSERT INTO observacao_carros (id_carro, observacao, descricao, id_criador, data_criacao) VALUES ('$id_carro', '$observacao', '$descricao', '$id_criador', '$date')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Observação adicionada com sucesso!";
		header("Location: ../car.php?sucesso&id=$id_carro");
	else:
		$_SESSION['mensagem'] = "Erro ao adicionar a observação!";
		header("Location: ../car.php?erro&id=$id_carro");
	endif; 

else:
	header('Location: ../car.php?formulario-erro');
endif;

mysqli_close();