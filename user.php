<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

include_once 'includes/message.php';


if (isset($_COOKIE['user'])):

    $id = mysqli_escape_string($connect, $_COOKIE['user']);
    $sql = "SELECT * FROM colaborador WHERE id = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);

endif;

?>

<style>
	
	#titulocategoria {
		height: 40px;
	}

</style>

<div class="section">

	<div class="container">
		<div class="row">
			<h5 id=titulocategoria class="col s12">Dados do usuário</h5>

			<div class="col s3">
				<?php if(empty($dados['foto'])): ?>
				<div class="card">
			        <div class="card-image">
			        	<img class="materialboxed" src="/horto_automotivo/images/no_photo.png">
			        </div>
		      	</div>
		      	<?php else: ?>
		      	<div class="card">
			        <div class="card-image">
			        	<img class="materialboxed" src="/horto_automotivo/images/<?php echo $dados['foto']; ?>">
			        </div>
		      	</div>
				<?php endif; ?>
			</div>

			<div class="col s8 grey lighten-5">

				<ul class="collection">
					<li class="collection-item"><strong>Nome: </strong><?php echo $dados['nome'] ?></li>
					<li class="collection-item"><strong>Cargo: </strong><?php echo $dados['cargo'] ?></li>
					<li class="collection-item"><strong>Email: </strong><?php echo $dados['email'] ?>
					<li class="collection-item"><strong>Registro: </strong><?php echo $dados['registro'] ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'includes/footer.php';
?>