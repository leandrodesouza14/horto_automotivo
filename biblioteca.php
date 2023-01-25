<?php

include_once 'includes/header.php';

include_once 'php_action/db_connect.php';

include_once 'includes/message.php';

function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

	$id = clear($_POST['id_carro']);
	$sql = "SELECT * FROM carros WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	$dados_carro = mysqli_fetch_array($resultado);

?>

<style>
	
	#titulocategoria {
		height: 40px;
	}

</style>

<div class="section">

	<div class="container">
		<div class="row">
			<h5 id=titulocategoria class="col s12">Biblíoteca Técnica</h5>
			<span class="text col s12"><strong>Veículo: </strong><?php echo $dados_carro['montadora']; echo "&nbsp;"; echo $dados_carro['modelo']; echo "&nbsp;"; echo $dados_carro['ano']; ?></span>
<?php

if (isset($_POST['id_carro'])):

    $id = mysqli_escape_string($connect, $_POST['id_carro']);
    $sql = "SELECT * FROM biblioteca WHERE id_carro = '$id' ORDER BY titulo ASC";
    $resultado = mysqli_query($connect, $sql);
    if(mysqli_num_rows($resultado) > 0):
    	while($dados = mysqli_fetch_array($resultado)):
?>		
			<div class="row">
			</div>

			<div class="card teal lighten-1">
				<div class="card-content white-text">
					<p><strong><?php echo $dados['categoria']; ?></strong></p>	
				</div>
			</div>

			<div class="row">
			</div>

			<div class="col s12 grey lighten-5">
				<table class="highlight centered" name="<?php echo $dados['categoria']; ?>">
					<thead>
						<tr>
							<th>Id</th>
							<th>Titulo</th>
							<th>Descriçao</th>
							<th>Criador</th>
							<th>Arquivo</th>
							<th>Data</th>
						</tr>
					</thead>
					<tbody>
				<tr>
							<td><?php echo $dados['id']; ?></td>
							<td><?php echo $dados['titulo'] ?></td>
							<td>
								<?php 
									if(!empty($dados['descricao'])):
										echo $dados['descricao'];
									else:
										echo '-';
									endif;
								?>
							</td>
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
							<td><a href="/horto_automotivo/biblioteca/<?php echo $dados['arquivo']; ?>" target="_blank">Acessar</a></td>
							<td>
								<?php 
								$datetime = $dados['data'];
								$date = strtotime($datetime);
	    						echo date('d/m/Y', $date);
								?>
							</td>
							<td><a href="#modal<?php echo $dados['id']; ?>" class="btn-floating btn-small red modal-trigger"><i class="material-icons">delete</i></a></td>

							<!-- Modal Structure -->
  						<div id="modal<?php echo $dados['id']; ?>" class="modal">
    						<div class="modal-content">
      							<h4>Atenção!</h4>
      								<p>Tem certeza que deseja <strong>excluir</strong> esse arquivo?</p>
      								<p><strong><?php echo $dados['id'] . " - " . $dados['titulo'] . " - " . $dados['categoria']; ?></strong></p>

    						</div>

    						<!--  Modal de exclusão -->

    						<div class="modal-footer">

      							<form action="php_action/delete_file.php" method="POST">
      								<input type="hidden" name="id" value="<?php echo $dados['id']; ?>">
      								<input type="hidden" name="id_carro" value="<?php echo $dados['id_carro']; ?>">
      								<button type="submit" name="btn-file-deletar" class="btn red">Sim, quero excluir</button>
      								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      							</form>
    						</div>
  						</div>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="row">
			</div>

			<hr>
<?php
		endwhile;
	endif;
endif;

?>
		</div>

	</div>

</div>

<?php
include_once 'includes/footer.php';
?>