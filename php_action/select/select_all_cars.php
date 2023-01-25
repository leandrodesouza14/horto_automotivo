<?php 

include_once 'php_action/db_connect.php';

$sql = "SELECT * FROM carros ORDER BY montadora ASC";
$resultado = mysqli_query($connect, $sql);

$cars = array();
while($dados = mysqli_fetch_array($resultado)) {
    $cars[] = $dados;
}

$_SESSION["cars"] = $cars;