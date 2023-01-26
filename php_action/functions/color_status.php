<?php

if (isset($_SESSION['obs']) && !empty($_SESSION['obs'])) {
    include_once 'php_action/functions/function_clear.php';
    $obs[] = $_SESSION['obs'];
    $observacao = clear($obs['observacao']);
    function colorStatus($observacao)
    {
        if ($observacao === "Exclusivo de montadora" || $observacao === "Reservado para SAEP" || $observacao === "Em uso na Olimpíada" || $observacao === "Em manutenção") {
            return $color = 'deep-orange lighten-1';
        } elseif ($observacao === "Disponível para aula") {
            return $color = 'green';
        } elseif ($observacao === "Com problema mecânico" || $observacao === "Com problema elétrico" || $observacao === "Não disponível") {
            return $color = 'red';
        }
    }
} else {
    $_SESSION['mensagem'] = "O status do carro é inválido!";
    header("Location: ../horto_automotivo/index.php?erro");
    exit;
}