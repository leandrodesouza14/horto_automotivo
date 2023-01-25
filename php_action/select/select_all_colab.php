<?php 

include_once 'php_action/db_connect.php';

$sql = "SELECT * FROM colaborador ORDER BY nome ASC";
$resultado = mysqli_query($connect, $sql);

$colab = array();
while($dados = mysqli_fetch_array($resultado)) {
    $colab[] = $dados;
}

$_SESSION["colab"] = $colab;