<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Adicionar Responsável</h3>
			<br/>

			<form action="php_action/create_group.php" method="POST" name="create_group" id="create_obs">
				
				<div class="input-field col s12">
    				<select name="colaborador" required>
      					<option value="" disabled selected>Selecione um Colaborador</option>
      					<?php
	      					$sql = "SELECT * FROM colaborador";
									$resultado = mysqli_query($connect, $sql);

									if(mysqli_num_rows($resultado) > 0):
										while($dados = mysqli_fetch_array($resultado)): 
								?>

      					<option value="<?php echo $dados['id']?>"><?php echo $dados['nome']?></option>

      					<?php 
									endwhile;
									endif;
								?>

    				</select>
    				<label>Responsável</label>
  				</div>

				<input type="hidden" name="id_carro" value="<?php echo $_POST['id_carro']; ?>">

				<button type="submit" name="btn-add-group" class="btn"> Adicionar </button>

				<a href="car.php?id=<?php echo $_POST['id_carro']; ?>" class="btn green"> Lista de Responsáveis </a>

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

<?php
include_once 'includes/footer.php';
?>