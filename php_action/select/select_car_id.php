<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once 'php_action/functions/function_clear.php';
    include_once 'php_action/db_connect.php';
    $id = clear($_GET['id']);
    $sql = "SELECT * FROM carros WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
        if (mysqli_num_rows($resultado) === 1) {
            $dados = mysqli_fetch_array($resultado);
            $_SESSION["car"] = $dados;
        } else {
            mysqli_close($connect);
            $_SESSION['mensagem'] = "O carro selecionado não existe!";
            header("Location: ../horto_automotivo/index.php?erro");
            exit;
        }
} else {
    $_SESSION['mensagem'] = "Você precisa selecionar um carro!";
    header("Location: ../horto_automotivo/index.php?erro");
    exit;
}