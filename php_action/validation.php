<?php

// Sessão

session_start();

// Conexão

require_once 'db_connect.php';

// Sessão

function clear($input) {
    global $connect;
    // sql
    $var = mysqli_escape_string($connect, $input);
    // xss
    $var = htmlspecialchars($var);
    return $var;
}

// Botão enviar

    if(isset($_POST['btn-login'])):

        $login = clear($_POST['login']);
        $senha = clear($_POST['senha']);

        if(empty($login) or empty($senha)):

            $_SESSION['mensagem'] = "O campo usário ou senha esta vazio!";
            header('Location: ../login.php?vazio');

        else:

            $sql = "SELECT * FROM colaborador WHERE registro = '$login'";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) > 0):

                $dados = mysqli_fetch_array($resultado);
                $verificacao = (password_verify($senha, $dados['senha']));

                if($verificacao === true):
                    session_unset();
                    session_destroy();
                    session_start();
                    session_create_id($dados['id']);
                    $_SESSION['verificacao'] = $verificacao;
                    $_SESSION['id_sessao'] = session_id();
                    $_SESSION['id_usuario'] = $dados['id'];
                    $_SESSION['mensagem'] = "Login efetuado com sucesso!";
                    mysqli_close($connect);
                    header('Location: ../index.php');
                endif;

                if($verificacao === false):
                    $_SESSION['mensagem'] = "Usuário e senha não conferem!";
                    header('Location: ../login.php?erro');
                endif;
                
            else:
                $_SESSION['mensagem'] = "Esse usário não possui cadastro!";
                header('Location: ../login.php?nouser');

            endif;
        
        endif;
    
    else:
            $_SESSION['mensagem'] = "Login Suspeito!";
            header('Location: ../login.php?suspeito');

    endif;
   


?>