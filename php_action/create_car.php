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

if(isset($_POST['btn-cadastrar'])):

	$montadora = clear($_POST['montadora']);
	$modelo = clear($_POST['modelo']);
	$ano = clear(filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT));
	$cor = clear($_POST['cor']);
	$motor = clear($_POST['motor']);
	$chassis = clear($_POST['chassis']);
	$id_criador = clear($_SESSION['id_usuario']);
	$observacao = clear($_POST['obs']);
	$descricao = '-';
	date_default_timezone_set('America/Sao_Paulo');
	$date = date('Y-m-d H:i:s'); 

if(!empty($_FILES["foto"]) && file_exists($_FILES["foto"]['tmp_name'])):
		$info = getimagesize($_FILES['foto']['tmp_name']);
			if ($info === FALSE):
	            $_SESSION['mensagem'] = "Não é uma imagem válida!";
	            header("Location: ../add_car.php?erro&id=$id");
	            exit;
	        else:
	        	$tipo = $info[2];
	            if ($tipo !== IMAGETYPE_JPEG && $tipo !== IMAGETYPE_BMP && $tipo !== IMAGETYPE_PNG && $tipo !== IMAGETYPE_GIF):
	                $_SESSION['mensagem'] = "Não é um formato de imagem permitido!";
	                header("Location: ../add_car.php?erro&id=$id");
	                exit;
	            else:
	            $tamanho_maximo = 2 * 1024 * 1024; // 2MB
		            if ($_FILES['foto']['size'] > $tamanho_maximo):
		                $_SESSION['mensagem'] = "Tamanho maximo permitido de 2MB!";
		                header("Location: ../add_car.php?erro&id=$id");
		                exit;
		            else:
				       	$arquivo = uniqid();
				        //diretorio dos arquivos
				        $pasta_dir = "../images/";
				        // Faz o upload da imagem
				        $arquivo_nome = $pasta_dir . $arquivo;
				        //salva no banco
				        move_uploaded_file($_FILES["foto"]['tmp_name'], $arquivo_nome);
        			endif;
        		endif;
        	endif;

    else:
    	$arquivo = 'no_image.png';
    	echo "Não foi possivel salvar a imagem!";
    endif; 

	$sql = "INSERT INTO carros (montadora, modelo, ano, cor, motorizacao, chassis, foto) VALUES ('$montadora', '$modelo', '$ano', '$motor', '$cor', '$chassis', '$arquivo')";

	if(mysqli_query($connect, $sql)):
		$last_id = mysqli_insert_id($connect);
		$sql = "INSERT INTO observacao_carros (id_carro, observacao, descricao, id_criador, data_criacao) VALUES ('$last_id', '$observacao', '$descricao', '$id_criador', '$date')";
		if(mysqli_query($connect, $sql)):
			$_SESSION['mensagem'] = "Veículo cadastrado com sucesso!";
			header('Location: ../index.php?sucesso');
		else:
			$_SESSION['mensagem'] = "Erro ao cadastrar a observação do veículo!";
			header('Location: ../index.php?erro');
		endif;
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar o veículo!";
		header('Location: ../index.php?erro');
	endif; 

else:
	header('Location: ../index.php?formulario-erro'); 
endif;

mysqli_close($connect);