<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Adicionar Manutenção</h3>
			<br/>

			<h6><strong>Veículo:</strong> <?php echo $_POST['montadora']; echo "&nbsp;"; echo $_POST['modelo']; echo "&nbsp;"; echo $_POST['ano']; ?></h6>

			<br/>
			<br/>

			<form action="php_action/create_man.php?id=<?php echo $_POST['id_carro']; ?>" method="POST" name="add_man" id="add_man">

				<div class="input-field col s12">
    				<select name="tipo" required>
      					<option value="" disabled selected>Selecione um Tipo</option>
      					<option value="Oleos e Filtros">Oleos e Filtros</option>
      					<option value="Arrefecimento">Arrefecimento</option>
      					<option value="Freios">Freios</option>
      					<option value="Suspensão">Suspensão</option>
      					<option value="Transmissão">Transmissão</option>
    				</select>
    				<label>Tipo de Manutenção</label>
  				</div>

				
				<div class="input-field col s12">
					 <textarea name="descricao" id="textarea" class="materialize-textarea" required></textarea>
          <label for="textarea">Descrição</label>
				</div>

				<div class="input-field col s12">
					<input type="number" name="km" id="km" required>
					<label for="data">Kilometragem</label>
				</div>

				<div class="input-field col s12">
					<input type="date" name="data" id="data" required>
					<label for="data">Data</label>
				</div>

				<button type="submit" name="btn-cadastrar-man" class="btn"> Adicionar Manutenção </button>

				<a href="car.php?id=<?php echo $_POST['id_carro']; ?>" class="btn green"> Lista de Manutenção </a>

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