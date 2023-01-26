<?php

if (isset($idcarro) && !empty($idcarro)) {
    include_once 'php_action/functions/function_clear.php';
    include_once 'php_action/db_connect.php';
    $id = clear($idcarro);
    $sql = "SELECT * FROM carros WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
        if (mysqli_num_rows($resultado) === 1) {
            function selectCar($resultado){
                $array = mysqli_fetch_array($resultado);
                return array($array['montadora'] . " " . $array['modelo'] . " " . $array['ano'] . " " . $array['cor'], $array['id']);
            }
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