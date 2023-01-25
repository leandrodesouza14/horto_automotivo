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

if(isset($_POST['btn-update-collaborator'])):

	$nome = clear ($_POST['nome']);
	$cargo = clear($_POST['cargo']);
	$email = clear($_POST['email']);
	$registro = clear($_POST['registro']);
	$id = clear($_POST['id']);
	$senha = clear($_POST['senha']);

	$senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

if(!empty($_FILES["foto"]) && file_exists($_FILES["foto"]['tmp_name'])):
        $info = getimagesize($_FILES['foto']['tmp_name']);
            if ($info === FALSE):
                $_SESSION['mensagem'] = "Não é uma imagem válida!";
                header("Location: ../edit_collaborator.php?erro&id=$id");
                exit;
            else:
                $tipo = $info[2];
                if ($tipo !== IMAGETYPE_JPEG && $tipo !== IMAGETYPE_BMP && $tipo !== IMAGETYPE_PNG && $tipo !== IMAGETYPE_GIF):
                    $_SESSION['mensagem'] = "Não é um formato de imagem permitido!";
                    header("Location: ../edit_collaborator.php?erro&id=$id");
                    exit;
                else:
                $tamanho_maximo = 2 * 1024 * 1024; // 2MB
                    if ($_FILES['foto']['size'] > $tamanho_maximo):
                        $_SESSION['mensagem'] = "Tamanho maximo permitido de 2MB!";
                        header("Location: ../edit_collaborator.php?erro&id=$id");
                        exit;
                    else:
                        // Exclui a imagem já cadastrar para esse carro
                        $verifica = "SELECT foto FROM colaborador WHERE id = '$id'";
                        $resultado = mysqli_query($connect, $verifica);
                            if(mysqli_num_rows($resultado) > 0):
                                while ($fotos = mysqli_fetch_array($resultado)):
                                    $foto = $fotos['foto'];
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
                                            $_SESSION['mensagem'] = "Erro ao atualizar o colaborador (imagem)!";
                                            header("Location: ../edit_collaborator.php?erro&id=$id");
                                            exit;
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
    $select_foto = "SELECT foto FROM colaborador WHERE id = '$id'";
    $query = mysqli_query($connect, $select_foto);
    $array = mysqli_fetch_array($query);
    $arquivo = !empty($array['foto']) ? $array['foto'] : "";
endif;

/*
if(!empty($_FILES["foto"]) && file_exists($_FILES["foto"]['tmp_name'])):
    $info = getimagesize($_FILES['foto']['tmp_name']);
        if ($info === FALSE):
            $_SESSION['mensagem'] = "Não é uma imagem válida!";
            header("Location: ../edit_collaborator.php?erro&id=$id");
            exit;
        else:
            $tipo = $info[2];
            if ($tipo !== IMAGETYPE_JPEG && $tipo !== IMAGETYPE_BMP && $tipo !== IMAGETYPE_PNG && $tipo !== IMAGETYPE_GIF):
                $_SESSION['mensagem'] = "Não é um formato de imagem permitido!";
                header("Location: ../edit_collaborator.php?erro&id=$id");
                exit;
            else:
                $tamanho_maximo = 2 * 1024 * 1024; // 2MB
                if ($_FILES['foto']['size'] > $tamanho_maximo):
                    $_SESSION['mensagem'] = "Tamanho maximo permitido de 2MB!";
                    header("Location: ../edit_collaborator.php?erro&id=$id");
                    exit;
                else:
                    // Faz o upload da imagem
                    $arquivo = $_FILES['foto']['name'];
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
    $select_foto = "SELECT foto FROM colaborador WHERE id = '$id'";
    $query = mysqli_query($connect, $select_foto);
    $array = mysqli_fetch_array($query);
    $arquivo = !empty($array['foto']) ? $array['foto'] : "";
endif;
*/

	if(empty($arquivo)){
    	$sql = "UPDATE colaborador SET nome = '$nome', cargo = '$cargo', email = '$email', registro = '$registro', senha = '$senhaSegura' WHERE id = '$id'";
	}else{
    	$sql = "UPDATE colaborador SET nome = '$nome', cargo = '$cargo', email = '$email', registro = '$registro', senha = '$senhaSegura', foto = '$arquivo' WHERE id = '$id'";
}

	if(mysqli_query($connect, $sql)):
		$_SESSION['mensagem'] = "Colaborador atualizado com sucesso!";
		header('Location: ../index.php?sucesso');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar o colaborador!";
		header('Location: ../index.php?erro');
	endif; 
	
else:
	header('Location: ../index.php?formulario-erro');
endif;

mysqli_close($connect); 