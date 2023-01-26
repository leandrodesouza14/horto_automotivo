<?php
	// Inclusão do cabeçalho superior
	include_once 'includes/header.php';
	// Inclue o script de mensagens
	include_once 'includes/message.php';
	// Inclusão da pesquisa do status do carro selecionado
	require_once 'php_action/functions/select_status.php';
	// Definição do array status
	$status = selectStatus($resultado);
	// Inclusão da função selectCar
	$idcarro = $status['id_carro'];
	require_once 'php_action/functions/select_car_status.php';
	$carro = selectCar($resultado);
	// Inclusão da função selectColab
	$idcolab = $status['id_criador'];
	require_once 'php_action/functions/select_colab_status.php';
	$colaborador = selectColabStatus($resultado);
	// Inclusão da função datatime
	require_once 'php_action/functions/datatime.php';

?>

<!-- Adiciona o arquivo Style da página -->
<link rel="stylesheet" type="text/css" href="style/status.css" />

<!-- Inicia a seção principal da página -->
<div class="section">
	<div class="container">
		<div class="row">
			<h5 id=titulocategoria class="col s12">Status</h5>
			<div class="col s12 grey lighten-5">
				<!-- Tabela onde o status será exibido -->
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
							<td><a href="car.php?id=<?php echo $carro[1]; ?>"><?php echo $carro[0]; ?></a></td>
							<td><?php echo $status['observacao']; ?></td>
							<td><?php echo $status['descricao']; ?></td>
							<td><a href="user.php?id=<?php echo $colaborador[0]; ?>"><?php echo $colaborador[1]; ?></a>
							</td>
							<td>
								<?php 
									// Função de exibição da data
									$datetime = $status['data_criacao'];
									echo dataTime($datetime);
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<!-- Fim da seção da página -->
</div>

<?php
	//Inclusão do rodapé da página
	include_once 'includes/footer.php';
?>