<!DOCTYPE html>
  <html lang="pt-br">
    <head>

      <meta charset="utf-8">

      <title>Oficina Educacional - Senai</title>

        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>

    <body>

      <?php

        include_once 'includes/session.php';
        include_once 'php_action/db_connect.php';

        $id = mysqli_escape_string($connect, $_SESSION['id_usuario']);
        $sql = "SELECT * FROM colaborador WHERE id = '$id'";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);

      ?>

      <nav class="blue">
        <div class="nav-wrapper">
          <a href="index.php" class="brand-logo center">SENAI HORTO</a>
            <div class="row">
              <a href="php_action/exit.php">
                <div class="col right">
                  <i class="material-icons right">exit_to_app</i>
                </div>
              </a>
              <a href="user.php">
                <div class="col s2 right">
                    <?php echo $dados['nome'];?>
                </div>
                <i class="material-icons right">account_circle</i>
              </a>
            </div>
              
        </div>
      </nav>

      <style>
        ::-webkit-scrollbar {
          display: none;
        }

      </style>
