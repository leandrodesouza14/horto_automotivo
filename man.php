<?php
	// Inclusão do cabeçalho superior
	include_once 'includes/header.php';
	// Inclusão do script de mensagens
	include_once 'includes/message.php';
	// Inclusão da pesquisa do carro selecionado
	require_once 'php_action/functions/select_car_id.php';
	$carro = selectCarId($resultado);
	// Inclusão da função datatime
	require_once 'php_action/functions/datatime.php';
?>

<!-- Adiciona o arquivo Style da página -->
<link rel="stylesheet" type="text/css" href="style/man.css" />

<!-- Inicio da seção principal da página -->
<div class="section">
	<div class="container">
		<div class="row">
			<h5 id=titulocategoria class="col s12">Histórico de Manutenção</h5>
			<span class="text col s12"><strong><?php echo $carro[1] . " " . $carro[2] . " " . $carro[3] ." ". $carro[4]; ?></strong></span>
			<!-- Espaço vazio -->
			<div class="row">
			</div>
			<!-- Tabela para exibição dos dados das manutenções realizadas -->
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
						<!-- Requisição SELECT para as manutenções -->
						<?php
							require_once 'php_action/select/select_man_car.php';
							if (isset($_SESSION["man"]) && !empty($_SESSION["man"])) {
								foreach ($_SESSION["man"] as $man){
						?>
						<tr>
							<td><?php echo $man['id']; ?></td>
							<td><?php echo $man['manutencao']; ?></td>
							<td></td>
							<td><?php echo $man['km']; ?></td>
							<td><?php echo $man['tipo']; ?></td>
							<td>
								<?php 
									// Função de exibição da data
									$datetime = $man['data'];
									echo dataTime($datetime);
								?>
							</td>

							<td><a href="#modal1<?php echo ['id']; ?>" class="btn-floating btn-small red modal-trigger"><i class="material-icons">delete</i></a></td>

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
								}
							}
						unset($_SESSION["man"]);
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
