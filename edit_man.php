<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Editar Manutenção</h3>
			<br/>

<?php

if (isset($_GET['carro'])):

	$id = mysqli_escape_string($connect, $_GET['carro']);

	$sql = "SELECT * FROM carros WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	if(mysqli_num_rows($resultado) > 0):
		while($dados = mysqli_fetch_array($resultado)):

?>
			<h6><strong>Veículo:</strong> <?php echo $dados['montadora']; echo "&nbsp;"; echo $dados['modelo']; echo "&nbsp;"; echo $dados['ano']; ?></h6>

<?php 

		endwhile;
	endif;
endif;


?>

<?php 

if (isset($_GET['id'])):

	$id = mysqli_escape_string($connect, $_GET['id']);

	$sql = "SELECT * FROM historico_manutencao WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	if(mysqli_num_rows($resultado) > 0):
		while($dados = mysqli_fetch_array($resultado)):

?>

			<br/>

			<form action="php_action/update_man.php" method="POST" name="edit_man" id="edit_man">

				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
				<input type="hidden" name="carro" value="<?php echo $_GET['carro']; ?>">

				<div class="input-field col s12">
    				<select name="tipo" required>
      					<option value="<?php echo $dados['tipo']?>"><?php echo $dados['tipo']?></option>
      					<option value="oleos_filtros">Oleos e Filtros</option>
      					<option value="arrefecimento">Arrefecimento</option>
      					<option value="freios">Freios</option>
      					<option value="suspensao">Suspensão</option>
      					<option value="transmissao">Transmissão</option>
    				</select>
    				<label>Tipo de Manutenção</label>
  				</div>

				<div class="input-field col s12">
					 <textarea name="descricao" id="textarea" class="materialize-textarea" required><?php echo $dados['manutencao']; ?></textarea>
          <label for="textarea">Descrição</label>
				</div>

				<div class="input-field col s12">
					<input type="number" name="km" id="km" value="<?php echo $dados['km']?>" required>
					<label for="data">Kilometragem</label>
				</div>

				<div class="input-field col s12">
					<input type="date" name="data" value="<?php echo $dados['data']?>" id="data" required>
					<label for="data">Data</label>
				</div>

<?php 

		endwhile;
	endif;
endif;


?>

				<button type="submit" name="btn-editar-man" class="btn"> Editar Manutenção </button>

				<a href="car.php?id=<?php echo $_GET['carro']; ?>" class="btn green"> Lista de Manutenção </a>

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