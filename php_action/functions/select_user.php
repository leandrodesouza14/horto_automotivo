<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once 'php_action/functions/function_clear.php';
    include_once 'php_action/db_connect.php';
    $id = clear($_GET['id']);
    $sql = "SELECT * FROM colaborador WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    if (mysqli_num_rows($resultado) === 1) {
        function selectUser($resultado)
        {
            $array = mysqli_fetch_array($resultado);
            if (empty($array['foto'])) {
                return array($array['id'], $array['nome'], $array['cargo'], $array['email'], $array['registro'], 'no_image.png');
            } else {
                return array($array['id'], $array['nome'], $array['cargo'], $array['email'], $array['registro'], $array['foto']);
            }
        }
    } else {
        mysqli_close($connect);
        $_SESSION['mensagem'] = "Erro ao carregar os dados do usuário, contate o administrador do sistema!";
        header("Location: ../horto_automotivo/index.php?erro");
        exit;
    }
} else {
        $_SESSION['mensagem'] = "Você precisa selecionar um usuário!";
        header("Location: ../horto_automotivo/index.php?erro");
        exit;
    }
