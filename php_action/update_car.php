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

if(isset($_POST['btn-editar'])):

	$montadora = clear ($_POST['montadora']);
	$modelo = clear ($_POST['modelo']);
	$ano = clear (filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT));
	$cor = clear($_POST['cor']);
	$motor = clear($_POST['motor']);
	$chassis = clear ($_POST['chassis']);
	$id = clear ($_POST['id']);

if(!empty($_FILES["foto"]) && file_exists($_FILES["foto"]['tmp_name'])):
        $info = getimagesize($_FILES['foto']['tmp_name']);
            if ($info === FALSE):
                $_SESSION['mensagem'] = "Não é uma imagem válida!";
                header("Location: ../edit_car.php?erro&id=$id");
                exit;
            else:
                $tipo = $info[2];
                if ($tipo !== IMAGETYPE_JPEG && $tipo !== IMAGETYPE_BMP && $tipo !== IMAGETYPE_PNG && $tipo !== IMAGETYPE_GIF):
                    $_SESSION['mensagem'] = "Não é um formato de imagem permitido!";
                    header("Location: ../edit_car.php?erro&id=$id");
                    exit;
                else:
                $tamanho_maximo = 2 * 1024 * 1024; // 2MB
                    if ($_FILES['foto']['size'] > $tamanho_maximo):
                        $_SESSION['mensagem'] = "Tamanho maximo permitido de 2MB!";
                        header("Location: ../edit_car.php?erro&id=$id");
                        exit;
                    else:
                        // Exclui a imagem já cadastrar para esse carro
                        $verifica = "SELECT foto FROM carros WHERE id = '$id'";
                        $resultado = mysqli_query($connect, $verifica);
                            if(mysqli_num_rows($resultado) > 0):
                                while ($fotos = mysqli_fetch_array($resultado)):
                                    $foto = $fotos['foto'];
                                    if($foto !== 'no_image.png'):
                                        $diretorio = "../images/";
                                        $nomedoarquivo = $diretorio . $foto;
                                        $excluir = unlink($nomedoarquivo);
                                            if($excluir === true):
                                                $arquivo = uniqid();
                                                //diretorio dos arquivos
                                                $pasta_dir = "../images/";
                                                // Faz o upload da imagem
                                                $arquivo_nome = $pasta_dir . $arquivo;
                                                //salva no banco
                                                move_uploaded_file($_FILES["foto"]['tmp_name'], $arquivo_nome);
                                            else:
                                                $_SESSION['mensagem'] = "Erro ao atualizar o veículo (imagem)!";
                                                header("Location: ../edit_car.php?erro&id=$id");
                                                exit;
                                            endif;
                                    else:
                                        $arquivo = uniqid();
                                        //diretorio dos arquivos
                                        $pasta_dir = "../images/";
                                        // Faz o upload da imagem
                                        $arquivo_nome = $pasta_dir . $arquivo;
                                        //salva no banco
                                        $upload = move_uploaded_file($_FILES["foto"]['tmp_name'], $arquivo_nome);
                                        if($upload === false):
                                            $_SESSION['mensagem'] = "Erro ao atualizar o veículo (imagem)!";
                                            header("Location: ../edit_car.php?erro&id=$id");
                                        exit;
                                    endif;
                                    endif;
                                endwhile;
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
            endif;
else:
    $select_foto = "SELECT foto FROM carros WHERE id = '$id'";
    $query = mysqli_query($connect, $select_foto);
    $array = mysqli_fetch_array($query);
    $arquivo = !empty($array['foto']) ? $array['foto'] : "";
endif;


	if(empty($arquivo)){
    	$sql = "UPDATE carros SET montadora = '$montadora', modelo = '$modelo', ano = '$ano', cor = '$cor', motorizacao = '$motor', chassis = '$chassis' WHERE id = '$id'";
	}else{
    	$sql = "UPDATE carros SET montadora = '$montadora', modelo = '$modelo', ano = '$ano', cor = '$cor', motorizacao = '$motor', chassis = '$chassis', foto = '$arquivo' WHERE id = '$id'";
}

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Veículo atualizado com sucesso!";
		header('Location: ../index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar o veículo!";
		header('Location: ../index.php?erro');
	endif; 
	
else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close($connect); 