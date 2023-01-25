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

	$categoria = clear($_POST['categoria']);
	$titulo = clear($_POST['titulo']);
	$descricao = clear($_POST['descricao']);
	$id_carro = clear($_POST['id_carro']);
	$id_criador = mysqli_escape_string($connect, $_SESSION['id_usuario']);
	date_default_timezone_set('America/Sao_Paulo');
	$data = date('Y-m-d H:i:s');

	if(!empty($_FILES["arquivo"]) && file_exists($_FILES["arquivo"]['tmp_name'])):
		$info = getimagesize($_FILES['arquivo']['tmp_name']);
		if ($info === FALSE):
			$info = $_FILES['arquivo']['tmp_name'];
			$tipo = $_FILES['arquivo']['type'];
			if($tipo !== "application/pdf" &&  $tipo !== "application/msword" && $tipo !== "application/vnd.ms-excel" && $tipo !== "application/vnd.ms-powerpoint"):
				$_SESSION['mensagem'] = "Não é um formato de arquivo válido!";
		        header("Location: ../car.php?erro&id=$id_carro");
		    else:
		    	$tamanho_maximo = 100 * 1024 * 1024; // 100MB
	            if ($_FILES['arquivo']['size'] > $tamanho_maximo):
	                $_SESSION['mensagem'] = "Tamanho maximo permitido de 100MB!";
	                header("Location: ../car.php?erro&id=$id_carro");
	                exit;
	            else:
			        $arquivo = $_FILES['arquivo']['name'];
			        $verifica = "SELECT arquivo FROM biblioteca";
			        $resultado = mysqli_query($connect, $verifica);
				        while ($array_resultado = mysqli_fetch_array($resultado)):
				        	if($arquivo === $array_resultado['arquivo']):
				        		$arquivo = uniqid();
				        	endif;
				        endwhile;
				    $arquivo = uniqid();
				    //diretorio dos arquivos
			        $pasta_dir = "../biblioteca/";
			        // Faz o upload do arquivo
			        $arquivo_nome = $pasta_dir . $arquivo;
			        //salva no banco
			        move_uploaded_file($_FILES["arquivo"]['tmp_name'], $arquivo_nome);
		    	endif;
		    endif;
		else:
			$tipo = $info[2];
            if ($tipo !== IMAGETYPE_JPEG && $tipo !== IMAGETYPE_BMP && $tipo !== IMAGETYPE_PNG && $tipo !== IMAGETYPE_GIF):
                $_SESSION['mensagem'] = "Não é um formato de imagem permitido!";
                header("Location: ../car.php?erro&id=$id_carro");
                exit;
            else:
		    	$tamanho_maximo = 5 * 1024 * 1024; // 5MB
	            if ($_FILES['arquivo']['size'] > $tamanho_maximo):
	                $_SESSION['mensagem'] = "Tamanho maximo permitido de 5MB!";
	                header("Location: ../car.php?erro&id=$id_carro");
	                exit;
	            else:
			        $arquivo = $_FILES['arquivo']['name'];
			        $verifica = "SELECT arquivo FROM biblioteca";
			        $resultado = mysqli_query($connect, $verifica);
				        while ($array_resultado = mysqli_fetch_array($resultado)):
				        	if($arquivo === $array_resultado['arquivo']):
				        		$arquivo = uniqid();
				        	endif;
				        endwhile;
				    $arquivo = uniqid();
				    //diretorio dos arquivos
			        $pasta_dir = "../biblioteca/";
			        // Faz o upload do arquivo
			        $arquivo_nome = $pasta_dir . $arquivo;
			        //salva no banco
			        move_uploaded_file($_FILES["arquivo"]['tmp_name'], $arquivo_nome);
		    	endif;
		    endif;
		endif;
else:
    $arquivo = !empty($array['foto']) ? $array['foto'] : "";
endif; 

if(empty($arquivo)):
    	$sql = "INSERT INTO biblioteca (titulo, descricao, data, id_carro, id_criador, categoria) VALUES ('$titulo', '$descricao', '$data', '$id_carro', '$id_criador', '$categoria')";
	else:
    	$sql = "INSERT INTO biblioteca (titulo, descricao, data, id_carro, id_criador, categoria, arquivo) VALUES ('$titulo', '$descricao', '$data', '$id_carro', '$id_criador', '$categoria', '$arquivo')";
    endif;

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Arquivo cadastrado com sucesso!";
		header("Location: ../car.php?sucesso&id=$id_carro");
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar o arquivo!";
		header("Location: ../car.php?erro&id=$id_carro");
	endif; 

else:
	header('Location: ../index.php?formulario-erro'); 
endif;

mysqli_close($connect);