<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Adicionar Arquivo</h3>
			<br/>

<?php
	$id = mysqli_escape_string($connect, $_POST['id_carro']);

	$sql = "SELECT * FROM carros WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	if(mysqli_num_rows($resultado) > 0):
		while($dados = mysqli_fetch_array($resultado)):
			$_SESSION['id_carro'] = $dados['id'];
?>

			<h6><strong>Veículo:</strong> <?php echo $dados['montadora']; echo "&nbsp;"; echo $dados['modelo']; echo "&nbsp;"; echo $dados['ano']; ?></h6>

<?php
		endwhile;
	endif;
?>

			<br/>
			<br/>

			<form action="php_action/create_file.php" method="POST" name="add_file" id="add_file" enctype="multipart/form-data">
				<div class="input-field col s12">
    				<select name="categoria" required>
      					<option value="" disabled selected>Selecione uma Categoria</option>
      					<option value="Diagrama de Correias">Diagrama de Correias</option>
      					<option value="Esquemas Elétricos">Esquemas Elétricos</option>
      					<option value="Especificações">Especificações</option>
      					<option value="Manual">Manual</option>
      					<option value="Tabela de Torque">Tabela de Torque</option>
    				</select>
    				<label>Tipo de Arquivo</label>
  			</div>

  			<div class="input-field col s12">
  				<input type="text" name ="titulo" id="titulo" required>
  				<label>Titulo</label>
  			</div>

				<div class="input-field col s12">
					<textarea name="descricao" id="textarea" class="materialize-textarea"></textarea>
          <label for="textarea">Descrição</label>
				</div>

				<div class="row">
				</div>

				<div class="file-field input-field">
		      <div class="btn">
		        <span>Arquivo</span>
		        <input name="arquivo" type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Seleciona o arquivo que deseja enviar">
		      </div>
	    	</div>

		    <div class="row">
				</div>

				<input type="hidden" name="id_carro" value="<?php echo $_SESSION['id_carro']; unset($_SESSION['id_carro']); ?>">

				<button type="submit" name="btn-cadastrar-man" class="btn"> Adicionar Arquivo </button>

				<a href="car.php?id=<?php echo $_POST['id_carro']; ?>" class="btn green"> Lista de Arquivos </a>

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