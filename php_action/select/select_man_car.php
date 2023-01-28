<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    include_once 'php_action/functions/function_clear.php';
    include_once 'php_action/db_connect.php';
    $idcarro = clear($_GET['id']);
    $sql = "SELECT * FROM historico_manutencao WHERE id_carro = '$idcarro' ORDER BY data DESC";
    $resultado = mysqli_query($connect, $sql);
    if ($resultado !== false) {
        $man = array();
        while ($dados = mysqli_fetch_array($resultado)) {
            $man[] = $dados;
        }
        $_SESSION["man"] = $man;
    } else {
        $_SESSION['mensagem'] = "O resultado da query foi false";
        header("Location: ../horto_automotivo/index.php?erro");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Você precisa selecionar um carro!";
    header("Location: ../horto_automotivo/index.php?erro");
    exit;
}