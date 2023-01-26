<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once 'php_action/functions/function_clear.php';
    include_once 'php_action/db_connect.php';
    $id = clear($_GET['id']);
    $sql = "SELECT * FROM observacao_carros WHERE id_carro = '$id' ORDER BY data_criacao DESC";
    $resultado = mysqli_query($connect, $sql);
    if (mysqli_num_rows($resultado) === 1) {
        $obs = mysqli_fetch_array($resultado);
        $_SESSION["obs"] = $obs;
    } else {
        mysqli_close($connect);
        $_SESSION['mensagem'] = "Erro ao carregar o status do veículo, contate o administrador do sistema!";
        header("Location: ../horto_automotivo/index.php?erro");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Você precisa selecionar um carro!";
    header("Location: ../horto_automotivo/index.php?erro");
    exit;
}