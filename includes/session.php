<?php

session_start();

$logado = $_SESSION['verificacao'];
$id_sessao = $_SESSION['id_sessao'];
session_regenerate_id();

if(isset($id_sessao)):
    
    if($logado == 1):
        
    else:
        header('Location: login.php');
    endif;
    
else:
    header('Location: login.php');
endif;

?>