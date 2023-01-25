<?php
	// Inclusão do cabeçalho superior
	include_once 'includes/header.php';
	// Inclusão do script de mensagens
	include_once 'includes/message.php';
?>

<!-- Adiciona o arquivo Style das tabelas de carros e colaboradores -->
<link rel="stylesheet" type="text/css" href="style/index.css" />

<!-- Inicio da seção de exibição dos carros -->
<div class="section">
	<div class="container">
		<h3 class="light">Carros</h3>
		<div class="col s12 m6 push-m3" id="tabela">
			<table class="striped">
				<thead>
					<tr>
						<th>Id</th>
						<th>Fabricante</th>
						<th>Modelo</th>
						<th>Ano</th>
						<th>Motor</th>
						<th>Cor</th>
						<th>Chassis</th>
					</tr>
				</thead>
				<tbody>
				
				<!-- Requisição SELECT para todos os carros -->
				<?php
					require_once 'php_action/select/select_all_cars.php';
					if (isset($_SESSION["cars"]) && !empty($_SESSION["cars"])) {
						foreach ($_SESSION["cars"] as $car):
				?>

				<!-- Tabela para exibição de todos os carros -->
					<tr>
						<td><?php echo $car['id']; ?></td>
						<td><?php echo $car['montadora']; ?></td>
						<td><?php echo $car['modelo']; ?></td>
						<td><?php echo $car['ano']; ?></td>
						<td><?php echo $car['motorizacao']; ?></td>
						<td><?php echo $car['cor']; ?></td>
						<td><?php echo $car['chassis']; ?></td>
						<!-- Botão que direciona a pagina car -->
						<td><a href="car.php?id=<?php echo $car['id']; ?>" class="btn-floating btn waves-effect waves-light green"><i class="material-icons">add</i></a></td>
						<!-- Botão que exibi a foto do carro em um modal -->
						<td><a href="#modalfoto<?php echo $car['id']; ?>" class="btn-floating blue modal-trigger"><i class="material-icons">insert_photo</i></a></td>
						<!-- Botão que chama a pagina edit_car para editar o carro -->
						<td><a href="edit_car.php?id=<?php echo $car['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
						<!-- Botão que chama o modal de exclusão do carro -->
						<td><a href="#modal<?php echo $car['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

						<!-- Estrutura do modal de exclusão de carro -->
  						<div id="modal<?php echo $car['id']; ?>" class="modal">
    						<div class="modal-content">
      							<h4>Atenção!</h4>
      								<p>Tem certeza que deseja <strong>excluir</strong> esse carro?</p>
      								<p><strong><?php echo $car['montadora'] . " " . $car['modelo'] . " " . $car['ano'] . " " . $car['motorizacao'] . " " . $car['chassis']; ?></strong></p>
    						</div>

    						<!--  Rodapé do modal de exclusão de carro -->
    						<div class="modal-footer">
      							<form action="php_action/delete_car.php" method="POST">
      								<input type="hidden" name="id" value="<?php echo $car['id']; ?>">
      								<button type="submit" name="btn-deletar" class="btn red">Sim, quero excluir</button>
      								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      							</form>
    						</div>
  						</div>

  						<!-- Estrutura do Modal de exibição de foto -->
  						<div id="modalfoto<?php echo $car['id']; ?>" class="modal">
    						<div class="modal-content">
    							<a href="#!" class="modal-close right"><i class="small   material-icons">close</i></a>
      							<h4>Esse é o veículo Listado!</h4>
      								<p><strong><?php echo $car['montadora'] . " " . $car['modelo'] . " " . $car['ano'] . " " . $car['motorizacao']; ?></strong></p>
  								<img class="materialboxed" width="250px" src="/horto_automotivo/images/<?php echo $car['foto']; ?>">
    						</div>
  						</div>
          
					</tr>

				<!-- Fim do Foreach para exibição de carros -->
				<?php 	
						endforeach;
					}else{
				?>

				<!-- Exibição para caso os resultados do SELECT venham vazios -->
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				
				<!-- Fim da verificação da variável car -->
				<?php	
					}
					unset($_SESSION['cars']);
				?>

				</tbody>
			</table>
			<br>
		</div>

		<!-- Botão para adicionar veículo -->
		<a href="add_car.php" class="btn">Adicionar Veículo</a>
	</div>

<!-- Fim da seção de exibição dos carros -->
</div>

<!-- Inicio da seção de exibição dos colaboradores -->
<div class="section">
	<div class="container">
		<h3 class="light">Colaboradores</h3>
		<div class="col s12 m6 push-m3" id="tabela">
			<table class="striped">
				<thead>
					<tr>
						<th>Registro</th>
						<th>Nome</th>
						<th>Cargo</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody>

				<!-- Requisição SELECT para todos os colaboradores -->
				<?php
					require_once 'php_action/select/select_all_colab.php';
					if (isset($_SESSION["colab"]) && !empty($_SESSION["colab"])) {
						foreach ($_SESSION["colab"] as $colab):
				?>

					<!-- Tabela para exibição de todos os colaboradores -->
					<tr>
						<td><?php echo $colab['registro']; ?></td>
						<td><a href="user_group.php?nome=<?php echo $colab['nome']; ?>"><?php echo $colab['nome']; ?></a></td>
						<td><?php echo $colab['cargo']; ?></td>
						<td><?php echo $colab['email']; ?></td>
						<!-- Botão que chama a página edit_collaborator.php para editar o colaborador -->
						<td><a href="edit_collaborator.php?id=<?php echo $colab['id']; ?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
						<!-- Botão que chama o modal de exclusão do colaborador -->
						<td><a href="#modal<?php echo $colab['id']; ?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>

						<!-- Estrutura do Modal de exclusão de colaborador -->
						<div id="modal<?php echo $colab['id']; ?>" class="modal">
    						<div class="modal-content">
      							<h4>Atenção!</h4>
      								<p>Tem certeza que deseja <strong>excluir</strong> esse colaborador?</p>
      								<p><strong><?php echo $colab['nome'] . " - " . $colab['cargo'] . " - " . $colab['email'] . " - " . $colab['registro']; ?></strong></p>
    						</div>

    						<!--  Rodapé do modal de exclusão de colaborador -->
    						<div class="modal-footer">
      							<form action="php_action/delete_collaborator.php" method="POST">
      								<input type="hidden" name="id" value="<?php echo $colab['id']; ?>">
      								<button type="submit" name="btn-deletar-collaborator" class="btn red">Sim, quero excluir</button>
      								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
      							</form>
    						</div>
  						</div>
					</tr>

				<!-- Fim do Foreach para exibição de colaboradores -->
				<?php 	
						endforeach;
					}else{
				?>

				<!-- Exibição para caso os resultados do SELECT venham vazios -->
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
				
				<!-- Fim da verificação da variável colab -->
				<?php	
					}
					unset($_SESSION['colab']);
				?>

				</tbody>
			</table>
			<br>
		</div>

		<!-- Botão para adicionar colaborador -->
		<a href="add_collaborator.php" class="btn">Adicionar Colaborador</a>
	</div>

<!-- Fim da seção de colaboradores -->
</div>

<?php
	//Fechamento da conexão com o banco de dados
	mysqli_close($connect);

	//Inclusão do rodapé da página
	include_once 'includes/footer.php';
?>