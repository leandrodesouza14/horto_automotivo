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

	$nome = clear ($_POST['nome']);
	$cargo = clear($_POST['cargo']);
	$email = clear($_POST['email']);
	$registro = clear($_POST['registro']);
	$senha = clear($_POST['senha']);

	$senhaSegura = password_hash($senha, PASSWORD_DEFAULT);


if(!empty($_FILES["foto"]) && file_exists($_FILES["foto"]['tmp_name'])):
		$info = getimagesize($_FILES['foto']['tmp_name']);
			if ($info === FALSE):
	            $_SESSION['mensagem'] = "Não é uma imagem válida!";
	            header("Location: ../add_collaborator.php?erro");
	            exit;
	        else:
	        	$tipo = $info[2];
	            if ($tipo !== IMAGETYPE_JPEG && $tipo !== IMAGETYPE_BMP && $tipo !== IMAGETYPE_PNG && $tipo !== IMAGETYPE_GIF):
	                $_SESSION['mensagem'] = "Não é um formato de imagem permitido!";
	                header("Location: ../add_collaborator.php?erro");
	                exit;
	            else:
	            $tamanho_maximo = 2 * 1024 * 1024; // 2MB
		            if ($_FILES['foto']['size'] > $tamanho_maximo):
		                $_SESSION['mensagem'] = "Tamanho maximo permitido de 2MB!";
		                header("Location: ../add_collaborator.php?erro");
		                exit;
		            else:
				       	//nome do arquivo
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
    	echo "Não foi possivel salvar a imagem!";
endif; 

/*
	if(isset($_FILES["foto"])):

        $arquivo = $_FILES['foto']['name'];
        //diretorio dos arquivos
        $pasta_dir = "../images/";
        // Faz o upload da imagem
        $arquivo_nome = $pasta_dir . $arquivo;
        //salva no banco
        move_uploaded_file($_FILES["foto"]['tmp_name'], $arquivo_nome);

    else:
    	echo "Não foi possivel salvar a imagem!";

    endif; */

	$sql = "INSERT INTO colaborador (nome, cargo, email, registro, senha, foto) VALUES ('$nome', '$cargo', '$email', '$registro', '$senhaSegura', '$arquivo')";

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Funcionário cadastrado com sucesso!";
		header('Location: ../index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar funcionário!";
		header('Location: ../index.php?erro');
	endif; 

else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close();