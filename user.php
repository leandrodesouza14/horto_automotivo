<?php
	// Inclusão do cabeçalho superior
	include_once 'includes/header.php';
	// Inclusão da função selectUser
	require_once 'php_action/functions/select_user.php';
	$usuario = selectUser($resultado);
?>

<!-- Adiciona o arquivo Style da página -->
<link rel="stylesheet" type="text/css" href="style/user.css" />

<!-- Inicio da sessão da página -->
<div class="section">
	<div class="container">
		<div class="row">
			<h5 id=titulocategoria class="col s12">Dados do usuário</h5>
			<div class="col s3">
		      	<div class="card">
			        <div class="card-image">
						<!-- Imagem do usuário -->
			        	<img class="materialboxed" src="/horto_automotivo/images/<?php echo $usuario['5']; ?>">
			        </div>
		      	</div>
			</div>
			<div class="col s8 grey lighten-5">
				<ul class="collection">
					<li class="collection-item"><strong>Nome: </strong><?php echo $usuario['1']; ?></li>
					<li class="collection-item"><strong>Cargo: </strong><?php echo $usuario['2']; ?></li>
					<li class="collection-item"><strong>Email: </strong><?php echo $usuario['3']; ?></li>
					<li class="collection-item"><strong>Registro: </strong><?php echo $usuario['4']; ?></li>
				</ul>
			</div>
		</div>
	</div>
<!-- Fim da seção da página -->
</div>

<?php
	//Inclusão do rodapé da página
	include_once 'includes/footer.php';
?>