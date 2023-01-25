<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'horto_automotivo';

// Conexão com o banco de dados, set de formato de caracteres:

$connect = mysqli_connect($servername, $username, $password, $dbname); 
mysqli_set_charset($connect, "utf8");

// Verificação de erro de conexão:

if (mysqli_connect_error()):
	echo "Não foi possivel conectar" .mysqli_connect_error();
endif;

?>