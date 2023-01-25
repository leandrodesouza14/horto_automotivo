<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

include_once 'includes/message.php';

?>

<style>
	
	#titulocategoria {
		height: 40px;
	}

</style>

<div class="section">

	<div class="container">
		<div class="row">
			<h5 id=titulocategoria class="col s12">Histórico de Manutenção</h5>
			<span class="text col s12"><strong> 
				<?php 				
					$id = mysqli_escape_string($connect, $_GET['id']);
					$sql1 = "SELECT * FROM carros WHERE id = '$id'";
					$resultado1 = mysqli_query($connect, $sql1);
					$dados1 = mysqli_fetch_array($resultado1);
				?>
				<a href="car.php?id=<?php echo $id; ?>">
				<?php
					echo $dados1['montadora'] ."  ". $dados1['modelo'] ."  ". $dados1['ano'];
				?>
					</a>
			</strong></span>

			<div class="row">
			</div>

			<div class="col s12 grey lighten-5">
				<table class="highlight centered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Manutenção</th>
							<th>Criador</th>
							<th>Kilometragem</th>
							<th>Tipo</th>
							<th>Data</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
<?php
if (isset($_GET['id'])):

    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "SELECT * FROM historico_manutencao WHERE id_carro = '$id' ORDER BY data DESC";
    $resultado = mysqli_query($connect, $sql);
    while($dados = mysqli_fetch_array($resultado)):
?>
						<tr>
							<td><?php echo $dados['id']; ?></td>
							<td><?php echo $dados['manutencao'] ?></td>
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
							<td><?php echo $dados['km']; ?></td>
							<td><?php echo $dados['tipo']; ?></td>
							<td>
								<?php 
									$datetime = $dados['data'];
									$date = strtotime($datetime);
		    						echo date('d/m/Y', $date);
								?>
							</td>

							<td><a href="#modal1<?php echo $dados['id']; ?>" class="btn-floating btn-small red modal-trigger"><i class="material-icons">delete</i></a></td>

							<td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating btn-small green modal-trigger"><i class="material-icons">add_box</i></a>

							<!-- Modal Structure -->
  						<div id="modal1<?php echo $dados['id']; ?>" class="modal">
    						<div class="modal-content">
      							<h4>Atenção!</h4>
      								<p>Tem certeza que deseja <strong>excluir</strong> essa manutenção?</p>
      								<p><strong><?php echo $dados['id'] . " - " . $dados['manutencao'] . " - " . $dados['tipo']; ?></strong></p>

    						</div>

    						<!--  Modal de exclusão -->

    						<div class="modal-footer">

      							<form action="php_action/delete_man.php" method="POST">
      								<input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
      								<input type="hidden" name="id_carro" value="<?php echo $dados['id_carro']; ?>">
      								<button type="submit" name="btn-man-deletar" class="btn red">Sim, quero excluir</button>
      								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      							</form>
    						</div>
  						</div>


							<!-- Modal Structure -->
  						<div id="modal<?php echo $dados['id']; ?>" class="modal">
    						<div class="modal-content">
      							
    						</div>

    						<!--  Modal de exclusão -->

    						<div class="modal-footer">
    						</div>
  						</div>
						</tr>

<?php
	endwhile;
endif;
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>

<?php
include_once 'includes/footer.php';
?>
