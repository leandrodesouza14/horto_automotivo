<?php

include_once 'includes/header.php';
include_once 'includes/message.php';

include_once 'php_action/db_connect.php';

if (isset($_GET['id'])):

	$id = mysqli_escape_string($connect, $_GET['id']);

	$sql = "SELECT * FROM carros WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados = mysqli_fetch_array($resultado);

endif;

?>

<div class="section">
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h3 class="light">Editar Carro</h3>
			<form action="php_action/update_car.php" method="POST" id="edit_car" enctype="multipart/form-data">
				<div class="input-field col s12">
						<input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
    				<select name="montadora" required>
      					<option value="<?php echo $dados['montadora']; ?>"><?php echo $dados['montadora']; ?></option>
      					<option value="Agrale">Agrale</option>
      					<option value="Alfa Romeo">Alfa Romeo</option>
      					<option value="Aston Martin">Aston Martin</option>
      					<option value="Audi">Audi</option>
      					<option value="Abarth">Abarth</option>
      					<option value="Amg">AMG</option>
      					<option value="Bmw">BMW</option>
      					<option value="Buggy">Buggy</option>
      					<option value="Chevrolet">Chevrolet</option>
      					<option value="Chery">Chery</option>
      					<option value="Chrysler">Chrysler</option>
      					<option value="Citroen">Citroen</option>
      					<option value="Cross Lander">Cross Lander</option>
      					<option value="Dodge">Dodge</option>
      					<option value="Ducati">Ducati</option>
      					<option value="Daimler">Daimler</option>
      					<option value="Ferrari">Ferrari</option>
      					<option value="Fiat">Fiat</option>
      					<option value="Ford">Ford</option>
      					<option value="Honda">Honda</option>
      					<option value="Harley Davidson">Harley-Davidson</option>
      					<option value="Hummer">Hummer</option>
      					<option value="Iveco">Iveco</option>
      					<option value="Jeep">Jeep</option>
      					<option value="Jac">JAC</option>
      					<option value="Kia">Kia</option>
      					<option value="Kawasaki">Kawasaki</option>
      					<option value="Land Rover">Land Rover</option>
      					<option value="Mercedes Benz">Mercedes Benz</option>
      					<option value="Mitsubishi">Mitsubishi</option>
      					<option value="Man">MAN</option>
      					<option value="Nissan">Nissan</option>
      					<option value="Opel">Opel</option>
      					<option value="Peugeout">Peugeout</option>
      					<option value="Ram">RAM</option>
      					<option value="Renault">Renault</option>
      					<option value="Suzuki">Suzuki</option>
      					<option value="Toyota">Toyota</option>
      					<option value="Troller">Troller</option>
      					<option value="Volvo">Volvo</option>
      					<option value="Volkswagem">Volkswagem</option>
      					<option value="Yamaha">Yamaha</option>
    				</select>
    				<label>Montadora</label>
  				</div>

				<div class="input-field col s12">
					<input type="text" name="modelo" id="modelo" requerid value="<?php echo $dados['modelo']; ?>">
					<label for="modelo">Modelo</label>
				</div>

				<div class="input-field col s12">
					<input type="number" name="ano" id="ano" required value="<?php echo $dados['ano']; ?>">
					<label for="ano">Ano</label>
				</div>

				<div class="input-field col s12">
					<input type="text" name="motor" id="motor" required value="<?php echo $dados['motorizacao']; ?>">
					<label for="motor">Motor</label>
				</div>

				<div class="row">
				</div>

				<div class="input-field col s12">
    				<select name="cor" required>
      					<option value="<?php echo $dados['cor']; ?>" selected><?php echo $dados['cor']; ?></option>
      					<option value="Branco">Branco</option>
      					<option value="Prata">Prata</option>
      					<option value="Preto">Preto</option>
      					<option value="Cinza">Cinza</option>
      					<option value="Vermelho">Vermelho</option>
      					<option value="Azul">Azul</option>
      					<option value="Verde">Verde</option>
      					<option value="Amarelo">Amarelo</option>
      					<option value="Bege">Bege</option>
      					<option value="Marrom">Marrom</option>
      					<option value="Laranja">Laranja</option>
      					<option value="Rosa">Rosa</option>
      					<option value="Roxo">Roxo</option>
      				</select>
    				<label>Cor do Veículo</label>
  				</div>

				<div class="input-field col s12">
					<input type="text" name="chassis" id="chassis" value="<?php echo $dados['chassis']; ?>">
					<label for="chassis" maxlenght="17">Chassis</label>
				</div>

				<div class="row">
				</div>

				<div class="file-field input-field">
		      <div class="btn">
		        <span>Foto</span>
		        <input name="foto" type="file">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Seleciona uma foto do veículo">
		      </div>
	    </div>

		    <div class="row">
				</div>

				<button type="submit" name="btn-editar" class="btn"> Editar Veículo </button>

				<a href="index.php" class="btn green"> Lista de Carros </a>

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

  document.getElementById("edit_car").addEventListener("submit", function(event) {
    	var ano = document.getElementById("ano").value;
    	if(ano.length != 4) {
      		event.preventDefault();
      		alert("O ano informado não é válido. Digite um valor com 4 digitos. Ex: 2022.");
    		}
  });

	document.getElementById("add_car").addEventListener("submit", function(event) {
	    var chassis = document.getElementById("chassis").value;
	    if (chassis.length <= 8) {
	        return;
	    }
	    var patternStart = /^[A-Za-z0-9]/;
	    var patternSpace = /\s/;
	    var patternChars = /[iIoOqQ]/;
	    var patternLastFour = /[0-9]{4}$/;
	    var patternRepeat = new RegExp("(?:([A-Za-z0-9])\\1{6}){1}", "g");
	    if(!patternStart.test(chassis) || patternSpace.test(chassis) || patternChars.test(chassis) || patternRepeat.test(chassis.slice(3)) || chassis.length !== 17 || !patternLastFour.test(chassis)) {
	        event.preventDefault();
	        alert("O número de Chassis esta inválido!");
	    }
	});

</script>

<script>

  M.AutoInit();

</script>

<?php
include_once 'includes/footer.php';
?>