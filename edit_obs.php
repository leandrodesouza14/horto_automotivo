<?php
	// Inclusão do cabeçalho superior
	include_once 'includes/header.php';
	// Inclusão da função que recebe os dados da pagina
	require_once 'php_action/functions/obs_edit.php';
	// Variável que armazena os dados do carro
	$carro = obsCar($resultado);
?>
<!-- Inicio da sessão da pagina completa -->
<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Alterar Status</h3>
			<br/>
			<!-- Dados do veículo ao qual a observação se refere -->
			<h6><strong>Veículo:</strong> <?php echo $carro['montadora']; echo "&nbsp;"; echo $carro['modelo']; echo "&nbsp;"; echo $carro['ano']; ?></h6>
			<br/>
			<!-- Formulário para preenchimento no novo status -->
			<form action="php_action/create_obs.php" method="POST" name="add_obs" id="add_obs">
				
				<div class="input-field col s12">
    				<select name="obs" required>
      					<option value="" disabled selected>Selecione uma opção</option>
      					<option value="Disponível para aula">Disponível para aula</option>
     						<option value="Exclusivo de montadora">Exclusivo de montadora</option>
     						<option value="Em manutenção">Em manutenção</option>
     						<option value="Com problema mecânico">Com problema mecânico</option>
     						<option value="Com problema elétrico">Com problema elétrico</option>
     						<option value="Não disponível">Não disponível</option>
     						<option value="Reservado para SAEP">Reservado para SAEP</option>
     						<option value="Em uso na Olimpíada">Em uso na Olimpíada</option>
    				</select>
    				<label>Cargo</label>
  				</div>

				<div class="input-field col s12">
					<textarea name="descricao" id="descricao" class="materialize-textarea"></textarea>
          <label for="descricao">Descrição</label>
				</div>

				<input type="hidden" name="id_carro" value="<?php echo $_POST['id_carro']; ?>">
				<input type="hidden" name="id_criador" value="<?php echo $_SESSION['id_usuario'];?>"
				>

				<button type="submit" name="btn-add-obs" class="btn"> Adicionar Observação </button>

				<a href="car.php?id=<?php echo $_POST['id_carro']; ?>" class="btn green"> Lista de Observação </a>

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