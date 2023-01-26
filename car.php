<?php
	// Inclusão do cabeçalho superior
	include_once 'includes/header.php';
	// Inclusão do script de mensagens
	include_once 'includes/message.php';

	// Inclusão da pesquisa de todos os dados do carro selecionado
	require_once 'php_action/functions/select_car_id.php';
	$carro = selectCarId($resultado);

	// Inclusão da pesquisa das observações do carro selecionado
	require_once 'php_action/select/select_obs_car.php';
	// Definição do array obs
	$obs[] = $_SESSION['obs'];

	// Inclusão da função que define a cor do botão status
	require_once 'php_action/functions/color_status.php';
	// Definição do array obs
	$color = colorStatus($observacao);
?>

<!-- Adiciona o arquivo Style das tabelas -->
<link rel="stylesheet" type="text/css" href="style/car.css" />

<!-- Inicio da sessão da pagina completa -->
<div class="section">
	<div class="row">
		<div class="col s4 push-s1 grey lighten-5">
			<div class="card blue darken-2">
				<div class="card-content white-text">
					<span class="card-title"><strong>Status</strong></span>
					<p>Esse é o status do veículo:</p>
					<br>
					<!-- Botão dinâmico de exibição de status do veículo -->
					<a href="status.php?id=<?php echo $obs['id']; ?>" class="btn <?php echo $color; ?>"><?php echo $obs['observacao']; ?></a>
					<!-- Botão para edição do Status atual -->
					<a href="edit_status.php?id=<?php echo $obs['id']; ?>" class="btn orange"><i class="material-icons">edit</i></a>
      			</div>
    		</div>
			<div class="card">
				<div class="card-image">
					<img class="materialboxed" src="/horto_automotivo/images/<?php echo $carro[7]; ?>">
				</div>
			</div>
      <div class="card">
        <div class="card-content black-text">
	      	<ul class="collection">
				    <li class="collection-item"><strong>Id:</strong> <?php echo $carro[0]; ?></li>
				    <li class="collection-item"><strong>Montadora:</strong> <?php echo $carro[1]; ?></li>
				    <li class="collection-item"><strong>Modelo:</strong> <?php echo $carro[2]; ?></li>
				    <li class="collection-item"><strong>Ano:</strong> <?php echo $carro[3]; ?></li>
				    <li class="collection-item"><strong>Motorização:</strong> <?php echo $carro[5]; ?></li>
				    <li class="collection-item"><strong>Chassis:</strong> <?php echo $carro[6]; ?></li>
	  			</ul>
	  		</div>
	  	</div>
	  </div>
	  		<div class="col s5 push-s1 grey lighten-5">
	      <div class="card purple darken-4">
	        <div class="card-content white-text">
	          <span class="card-title"><strong>Histórico de Manutenção</strong></span>
	          <p>Aqui você pode ver todas as manutenções desse veículo:</p>
	          <br>
	          <form method="POST" action="man.php?id=<?php echo $_GET['id']; ?>" name="manutencao" id="manutencao">
							<input type="hidden" name="id_carro" value="<?php echo $_GET['id']; ?>">
							<button type="submit" name="btn-man" class="btn orange"> Histórico Completo</button>
						</form>
        </div>
        <div class="card-action grey lighten-3">
<?php 

if (isset($_GET['id'])):

	$id = mysqli_escape_string($connect, $_GET['id']);

	$sql = "SELECT * FROM carros WHERE id = '$id'";
	$resultado = mysqli_query($connect, $sql);
	if(mysqli_num_rows($resultado) > 0):
		$dados = mysqli_fetch_array($resultado);

?>
					<tr>
						<td>
							<form method="POST" action="add_man.php" name="add_man" id="add_man">
								<input type="hidden" name="id_carro" value="<?php echo $dados['id']; ?>">
								<input type="hidden" name="montadora" value="<?php echo $dados['montadora']; ?>">
								<input type="hidden" name="modelo" value="<?php echo $dados['modelo']; ?>">
								<input type="hidden" name="ano" value="<?php echo $dados['ano']; ?>">
								<button type="submit" name="btn-add-man" class="btn"> Adicionar </button>
							</form>
								
						</td>
					</tr>
<?php 

	endif;
endif;

?>
        </div>
      </div>
    </div>
    <div class="col s5 push-s1 grey lighten-5">
		<div class="card blue-grey darken-2" >
        <div class="card-content white-text">
          <span class="card-title"><strong>Responsáveis</strong></span>
          	<div id="tabela">
						<table class="highlight">
							<thead>
							</thead>
							<tbody>
<?php

$sql = "SELECT colaborador.* FROM colaborador JOIN grupo ON grupo.integrantes = colaborador.id WHERE grupo.carros = $id ORDER BY colaborador.nome ASC";
$resultado = mysqli_query($connect, $sql);

if(mysqli_num_rows($resultado) > 0):
    while($dados_colaborador = mysqli_fetch_array($resultado)):
?>
    <tr>
        <td><a href="user_group.php?nome=<?php echo $dados_colaborador['nome'];?>"><?php echo $dados_colaborador['nome']; ?></a></td>
        <td><?php echo $dados_colaborador['cargo'];?></td>
        <td><a href="#modal1<?php echo $dados_colaborador['id']; ?>" class="btn-floating btn-small red modal-trigger"><i class="material-icons">delete</i></a></td>
    </tr>

				<!-- Modal Structure -->
				<div id="modal1<?php echo $dados_colaborador['id']; ?>" class="modal">
					<div class="modal-content black-text">
							<h4>Atenção!</h4>
								<p>Tem certeza que deseja <strong>excluir</strong> esse responsável?</p>
								<br>
								<p><strong><?php echo $dados_colaborador['nome']; ?></strong></p>
					</div>

					<!--  Modal de exclusão -->

					<div class="modal-footer">

							<form action="php_action/delete_group.php" method="POST">
								<input type="hidden" name="id_colaborador" value="<?php echo $dados_colaborador['id']; ?>">
								<input type="hidden" name="id_carro" value="<?php echo $_GET['id']; ?>">
								<button type="submit" name="btn-col-deletar" class="btn red">Sim, quero excluir</button>
								<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
							</form>
					</div>
				</div>

<?php
		endwhile;
	endif;
?>
				</tbody>
			</table>
			</div>
		</div>
			<div class="card-action grey lighten-3">
				<form method="POST" action="add_group.php" name="add_group" id="add_group">
					<input type="hidden" name="id_carro" value="<?php echo $_GET['id']; ?>">
					<button type="submit" name="btn-add-group" class="btn"> Adicionar </button>
				</form>
		</div>
	</div>
</div>


	</div>

	
<div class="row">
	

 <div class="row">
    <div class="col s9 push-s1 grey lighten-5">
      <div class="card green darken-2">
        <div class="card-content white-text">
          <span class="card-title"><strong>Biblioteca Técnica</strong></span>
          <p>Aqui você pode acessar todos os materiais disponíveis para esse veículo!</p>
          <br>
          <form method="POST" action="biblioteca.php" name="biblioteca" id="biblioteca">
						<input type="hidden" name="id_carro" value="<?php echo $_GET['id']; ?>">
						<button type="submit" name="btn-biblioteca" class="btn orange"> Lista Completa </button>
					</form>
        </div>
        <div class="card-action grey lighten-3">
          <form method="POST" action="add_file.php" name="add_file" id="add_file">
						<input type="hidden" name="id_carro" value="<?php echo $_GET['id']; ?>">
						<button type="submit" name="btn-add-file" class="btn"> Adicionar Conteúdo </button>
					</form>
        </div>
      </div>
    </div>
  </div>

<div class="row">
  <div class="col s4 push-s2 grey lighten-5">

  </div>
</div>

<script>

  M.AutoInit();

	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems, options);
  });
</script>

<?php
include_once 'includes/footer.php';
?>