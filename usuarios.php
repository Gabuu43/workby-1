<!DOCTYPE html>
<html>
<head>
	<title>Registro de usuários</title>
	<link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/401c6a38e1.js" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
</head>
<body class="text-white">
	<div class="row">
		<div class="col-md-12">
			<?php
				include 'includes/testemenu.php';
			?>
		</div>
		<div class="row">
		<div class="col-md-12">
			<?php
				include 'includes/valida_login.php';
				if ($_SESSION['login'] ['usuario'] ['usuario_adm'] !==1) {
				 	header('Location: index.php');
				 } 
			?>
		</div>
	</div>
	<div class="container">
		<div class="row">
		</div>
		<div class="container" style="min-height: 500px;">
			<div class="col-md-10" style="padding-top: 50px;">
				<h2>Usuário</h2>
				<?php include 'includes/busca.php';?>
				<?php 
					require_once 'includes/funcoes.php';
					require_once 'core/conexao_mysql.php';
					require_once 'core/sql.php';
					require_once 'core/mysql.php';

					foreach ($_GET as $indice => $dado) {
						$$indice = limparDados($dado);
					}

					$data_atual = date('Y-m-d H:i:s');

					$criterio = [];

					if (!empty($busca)) {
						$criterio[] = ['usuario_cpf', 'like', "%{$busca}%"];
					}

					$result = buscar(
						'usuario',
						[
							'usuario_id',
							'usuario_nome',
							'usuario_email',
							'usuario_nascimento',
							'usuario_CPF',
							'usuario_telefone',
							'usuario_genero',
							'usuario_adm'
						],
						$criterio,
						'usuario_nome ASC'
					);
				?>
				<br>
				<table class="table table-borded table-hover table-striped table-responsive{-sm|-md|-lg|-xl}">
					<thead>
						<tr>
							<td>Nome</td>
							<td>E-mail</td>
							<td>Nascimento</td>
							<td>Telefone</td>
							<td>Gênero</td>
							<td>CPF</td>
							<td>Excluir</td>
							<td>Administrador</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($result as $entidade):
						?>
						<tr>
							<td><?php echo $entidade['usuario_nome']?></td>
							<td><?php echo $entidade['usuario_email']?></td>
							<td><?php echo $entidade['usuario_nascimento']?></td>
							<td><?php echo $entidade['usuario_telefone']?></td>
							<td><?php echo $entidade['usuario_genero']?></td>
							<td><?php echo $entidade['usuario_CPF']?></td>
							<td><a href='core/usuario_repositorio.php?acao=delete&usuario_id=<?php echo $entidade['usuario_id']?>'>Excluir</a></td>
							<td><a href='core/usuario_repositorio.php?acao=adm&usuario_id=<?php echo $entidade['usuario_id']?>&valor=<?php echo !$entidade['usuario_adm']?>'><?php echo ($entidade['usuario_adm']==1)?'Rebaixar':'Promover';?></a></td>
						</tr>
					<?php endforeach;?>
					</tbody>		
				</table>
			</div>
		
		<div class="row">
			<div class="col-md-12">
				<?php
					include 'includes/rodape.php';
				?>
			</div>
		</div>
		</div>	
	</div>
	<script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
</body>
</html>