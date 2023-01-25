<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

?>

<?php 

if (isset($_GET['carro'])):

	$id = mysqli_escape_string($connect, $_GET['carro']);

	$sql = "SELECT * FROM carros WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	if(mysqli_num_rows($resultado) > 0):
		while($dados = mysqli_fetch_array($resultado)):

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Editar Observação</h3>
			<br/>

			<h6><strong>Veículo:</strong> <?php echo $dados['montadora']; echo "&nbsp;"; echo $dados['modelo']; echo "&nbsp;"; echo $dados['ano']; ?></h6>

<?php 

endwhile;
endif;
endif;


?>

			<br/>

			<form action="php_action/update_obs.php" method="POST" name="add_obs" id="add_obs">
				
				<div class="input-field col s12">
					<textarea name="obs" id="obs" class="materialize-textarea" required><?php echo $_GET['obs']; ?></textarea>
          <label for="textarea">Descrição</label>
				</div>

				<input type="hidden" name="id_carro" value="<?php echo $_GET['carro']; ?>">
				<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

				<button type="submit" name="btn-edit-obs" class="btn"> Editar Observação </button>

				<a href="car.php?id=<?php echo $_GET['carro']; ?>" class="btn green"> Lista de Observação </a>

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
