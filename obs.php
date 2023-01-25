<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

include_once 'includes/message.php';



if (isset($_GET['id'])):

    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "SELECT * FROM observacao_carros WHERE id = '$id'";
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
			<h5 id=titulocategoria class="col s12">Status</h5>


			<div class="col s12 grey lighten-5">
				
				<table class="highlight centered">
					<thead>
						<tr>
							<th>Carro</th>
							<th>Status</th>
							<th>Descrição</th>
							<th>Criador</th>
							<th>Data e Hora</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php 
									$id_carro = $dados['id_carro'];
									$sql1 = "SELECT * FROM carros WHERE id = '$id_carro'";
		    						$resultado1 = mysqli_query($connect, $sql1);
		    						$dados1 = mysqli_fetch_array($resultado1);
		    						?>
		    						<a href="car.php?id=<?php echo $id_carro; ?>">
			    						<?php
			    						echo $dados1['montadora'] ."  ". $dados1['modelo'] ."  ". $dados1['ano'];
										?>
									</a>
							</td>
							<td><?php echo $dados['observacao']; ?></td>
							<td><?php echo $dados['descricao']; ?></td>
							<td>
								<?php 
								$id_criador = $dados['id_criador'];
								$sql2 = "SELECT * FROM colaborador WHERE id = '$id_criador'";
	    						$resultado2 = mysqli_query($connect, $sql2);
	    						$dados2 = mysqli_fetch_array($resultado2);
	    						?>
	    						<a href="user_group.php?nome=<?php echo $dados2['nome']; ?>">
		    						<?php
		    						echo $dados2['nome'];
									?>
								</a>
							</td>
							<td>
								<?php 
								$datetime = $dados['data_criacao'];
								$date = strtotime($datetime);
	    						echo date('d/m/Y H:i:s', $date);
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

<?php
include_once 'includes/footer.php';
?>