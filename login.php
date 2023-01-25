<?php

include_once 'includes/header_login.php';
include_once 'includes/message.php';

include_once 'php_action/db_connect.php';

?>

<head>
	<style type="text/css">
		#titulo {
			height: 120px;
			display: flex;
  		align-items: center;
		}

		#titulo h5 {
			width: 100%;
		}
		form {
			padding-top: 20px;
		}
	</style>
</head>

<div class="container">

	<div class="row" id="titulo">
			<h5 class="text center-align">Faça seu <strong>Login</strong> abaixo</h5>
	</div>


	<div class="row">
		<div class="col s6 push-s3 grey lighten-3 z-depth-3">

		<form action="php_action/validation.php" method="POST" name="login" id="login">
					
					<div class="input-field col s2">
						<i class="material-icons small">perm_identity</i>
					</div>

					<div class="input-field col s9">
						<input type="text" name="login" required>
	          <label for="login">Registro</label>
					</div>

					<div class="input-field col s2">
						<i class="material-icons small">lock_outline</i>
					</div>

					<div class="input-field col s9">
						<input type="password" name="senha" required>
	          <label for="password">Senha</label>
					</div>

					<div class="row center">
					</div>

					<div class="row">
						<div class="col s8 push-s2">
							<button type="submit" name="btn-login" class="btn">Fazer Login</button>
						</div>
					</div>

					<div class="row center">
					</div>


				</form>
		</div>
	</div>
</div>

<script>

	// Carregamento das propriedades do Select

	document.addEventListener('DOMContentLoaded', function() {
    var sel = document.querySelectorAll('select');
    M.FormSelect.init(sel)
  })

</script>

<script>

  document.getElementById("add_instructor").addEventListener("submit", function(event) {
    var registro = document.getElementById("registro").value;
    var pattern = /^[0-9]{8}$/;
    if(!pattern.test(registro)) {
        event.preventDefault();
        alert("Número de registro inválido, por favor digite um número de registro válido com 8 caracteres numéricos.");
    }
  });

</script>

<script>

  M.AutoInit();

</script>

<?php
include_once 'includes/footer.php';
?>
