<?php

if(isset($_POST['btn_update_obs'])){
	// Conxão com o banco de dados
	require_once 'db_connect.php';
	// Função clear
	require_once 'functions/function_clear.php';
	// Recebe as variáveis via POST
	$id_carro = clear ($_POST['id_carro']);
	$observacao = clear ($_POST['status']);
	$descricao = clear ($_POST['descricao']);
	// Caso descrição estiver vázia, inserir um traço
	if ($descricao === "") {
		$descricao = "-";
	}
	// Obtem o ID do usuário via Session
	$id_criador = $_SESSION['id'];
	// Seleciona o fusu horário e define a data e hora da inserção
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d H:i:s');
	// Verifica se já existe um status inserido
	$sql = "SELECT id FROM observacao_carros WHERE id_carro = '$id_carro' ";
	$resultado = mysqli_query($connect, $sql);
	if (mysqli_num_rows($resultado) > 0) {
		$array = mysqli_fetch_array($resultado);
		$id = $array['id'];
		// Caso existe o exclui do banco de dados
		$sql = "DELETE FROM observacao_carros WHERE id = '$id'";
		$resultado = mysqli_query($connect, $sql);
		if ($resultado === false) {
			$_SESSION['mensagem'] = "Não foi possível alterar o status atual!";
			header("Location: ../car.php?erro&id=$id_carro");
			mysqli_close($connect);
			exit;
		}
	}
	// Realiza  a inserção do novo status
	$sql = "INSERT INTO observacao_carros (id_carro, observacao, descricao, id_criador, data_criacao) VALUES ('$id_carro', '$observacao', '$descricao', '$id_criador', '$date')";
	if(mysqli_query($connect, $sql)){
		mysqli_close($connect);
		$_SESSION['mensagem'] = "Status alterado com sucesso!";
		header("Location: ../car.php?sucesso&id=$id_carro");
	} else {
		mysqli_close($connect);
		$_SESSION['mensagem'] = "Erro ao inserir o novo Status!";
		header("Location: ../car.php?erro&id=$id_carro");
	}

} else {
	$_SESSION['mensagem'] = "Você deve selecionar um veículo antes de alterar o status!";
	header('Location: ../index.php?erro');
}

mysqli_close($connect);