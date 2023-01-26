<?php

if (isset($idcolab) && !empty($idcolab)) {
    include_once 'php_action/functions/function_clear.php';
    include_once 'php_action/db_connect.php';
    $id = clear($idcolab);
    $sql = "SELECT * FROM colaborador WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    if (mysqli_num_rows($resultado) === 1) {
        function selectColabStatus($resultado)
        {
            $array = mysqli_fetch_array($resultado);
            return array($array['id'], $array['nome']);
        }
    }
}
