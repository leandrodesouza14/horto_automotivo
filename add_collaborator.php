<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Adicionar Colaborador</h3>
			<form action="php_action/create_collaborator.php" method="POST" id="add_instructor" enctype="multipart/form-data">
				
				<div class="input-field col s12">
					<input type="text" name="nome" id="nome" requerid>
					<label for="nome">Nome</label>
				</div>

				<div class="input-field col s12">
    				<select name="cargo" required>
      					<option value="" disabled selected>Selecione um cargo</option>
      					<option value="Instrutor de Formação Profissional C">Instrutor de Formação Profissional C</option>
     						<option value="Supervisor Técnico">Supervisor Técnico</option>
     						<option value="Gerente">Gerente</option>
    				</select>
    				<label>Cargo</label>
  				</div>

				<div class="input-field col s12">
					<input type="email" name="email" id="email" required>
					<label for="email">Email</label>
				</div>

				<div class="input-field col s12">
					<input type="number" name="registro" id="registro" maxlength="8" required>
					<label for="registro">Registro</label>
				</div>

				<div class="input-field col s12">
					<input type="password" name="senha" id="senha" required>
					<label for="senha">Senha</label>
				</div>

				<div class="row">
				</div>

				<div class="file-field input-field">
		      <div class="btn">
		        <span>Foto</span>
		        <input name="foto" type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Seleciona uma foto do colaborador">
		      </div>
	    	</div>

	    	<div class="row">
				</div>

				<button type="submit" name="btn-cadastrar" class="btn"> Cadastrar Colaborador </button>

				<a href="index.php" class="btn green"> Lista de Colaboradores </a>

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

<?php
include_once 'includes/footer.php';
?>
