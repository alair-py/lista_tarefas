<?php	
	//Seta variavel com valor para recuperação de dados quando requisitar 'tarefa_controller.php';
	$acao = 'recuperar';
	require 'tarefa_controller.php';

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

		<script>
			//funcao de edição dos elementos para atualizar
			function editar(id, txtTarefa) {

				//Criando formulário pelo DOM
				let form = document.createElement('form');
					form.action = 'tarefa_controller.php?acao=atualizar';
					form.method = 'post';
					form.className = 'row';

				let inputTarefa = document.createElement('input');
					inputTarefa.type = 'text';
					inputTarefa.name = 'tarefa';
					inputTarefa.className = 'col-9 form-control';
					inputTarefa.value = txtTarefa;

				//Guarda o ID do elemento a ser atualizado para enviar ao backend
				let inputId = document.createElement('input');
					inputId.type = 'hidden';
					inputId.name = 'id';
					inputId.value = id;

				let buttonTarefa = document.createElement('button');
					buttonTarefa.type = 'submit';
					buttonTarefa.className = 'col-3 btn btn-info';
					buttonTarefa.innerHTML = 'Atualizar';

				//Setando hierarquia dos elementos anteriormente criados
				form.appendChild(inputTarefa);
				form.appendChild(inputId);
				form.appendChild(buttonTarefa);

				//Recupera ID do elemento vindo do click editar() na DIV
				let tarefa = document.getElementById('tarefa_'+id);

				//Limpa o conteúdo da DIV clicada
				tarefa.innerHTML = '';

				//Método do DOM insere elemento criado na árvore de elementos já renderizada.
				tarefa.insertBefore(form, tarefa[0]);


			}

			function remover(id) {
				location.href = 'todas_tarefas.php?acao=remover&id='+id;
			}


			function concluir(id) {
				location.href = 'todas_tarefas.php?acao=concluir&id='+id;
			}

		</script>

	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="#">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />


								<? foreach($tarefas as $indice => $tarefa) { ?>
									
									<div class="row mb-3 d-flex align-items-center tarefa">

										<!--Através do ID de cada tarefa no banco, cria-se IDs únicos para os elementos DIV de cada tarefa-->
										<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
											<?= $tarefa->tarefa ?> (<?= $tarefa->status ?>) 
										</div>

										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover( <?= $tarefa->id ?> )"></i>

											<!--Passa para a function editar, o ID do elemento a ser atualizado e a string da tarefa em questão-->
											<!--condicional: Só exibe icones de editar e concluir, caso status seja pendente-->
											<? if($tarefa->status == 'pendente') { ?>

												<i class="fas fa-edit fa-lg text-info" onclick="editar( <?= $tarefa->id ?>, '<?= $tarefa->tarefa ?>') "></i>
												<i class="fas fa-check-square fa-lg text-success" onclick="concluir( <?= $tarefa->id ?> )"></i>

											<? } ?>

										</div>
									</div>

								<? } ?>

								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>