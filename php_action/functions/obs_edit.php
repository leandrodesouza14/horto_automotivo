<?php

// Faz um Select na observação atual
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Função de limpeza dos campos
    include_once 'php_action/functions/function_clear.php';
    // Conexão com o banco de dados
    include_once 'php_action/db_connect.php';
    $id = clear($_GET['id']);
    $sql = "SELECT id_carro FROM observacao_carros WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    if (mysqli_num_rows($resultado) === 1) {
        $array = mysqli_fetch_array($resultado);
        $id_carro = $array['id_carro'];
        // Faz um Select e busca os dados do carro atual
        $sql = "SELECT * FROM carros WHERE id = '$id_carro'";
        $resultado = mysqli_query($connect, $sql);
        if (mysqli_num_rows($resultado) === 1) {
            function obsCar($resultado){
                return $resultado = mysqli_fetch_array($resultado);
            }
        } else {
            mysqli_close($connect);
            $_SESSION['mensagem'] = "Veículo não encontrado no sistema!";
            header("Location: ../horto_automotivo/index.php?erro");
            exit;
        }
    } else {
        mysqli_close($connect);
        $_SESSION['mensagem'] = "O status solicitado não existe!";
        header("Location: ../horto_automotivo/index.php?erro");
        exit;
    }
} else {
    $_SESSION['mensagem'] = "Você precisa selecionar o status de algum carro!";
    header("Location: ../horto_automotivo/index.php?erro");
    exit;
}




