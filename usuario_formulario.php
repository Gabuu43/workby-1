<!DOCTYPE html>
<html>
	<head>
		<title>Usuário | Projeto para Web com PHP</title>
		<link rel="stylesheet" href="lib/bootstrap-4.2.1-dist/css/bootstrap.min.css">
		<script src="https://kit.fontawesome.com/401c6a38e1.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
	</head>
	<body class="bg-dark text-white">
		<div class="row">
			<div class="col-md-12">
				<!--Topo //-->
				<?php
					include 'includes/testemenu.php'
				?>
			</div>
		</div>
		<?php 
			require_once 'includes/funcoes.php';
			require_once 'core/conexao_mysql.php';
			require_once 'core/sql.php';
			require_once 'core/mysql.php';

			if(isset($_SESSION['login'])){
				$id = (int) $_SESSION['login']['usuario']['id'];

				$criterio = [
					['id', '=', $id]
				];

				$retorno = buscar(
					'usuario',
					['id','nome','email'],
					$criterio
				);

				$entidade = $retorno[0];
			}
		?>
		<div class="container" style="min-height: 800px;">
			<div style="padding-top: 30px;">
				<h2>Usuário</h2>
				<form method="post" action="core/usuario_repositorio.php">
					<input type="hidden" name="acao" value="<?php echo empty($usuario_id) ? 'insert' : 'update' ?>">
					<input type="hidden" name="usuario_id" value="<?php echo $entidade['usuario_id'] ?? '' ?>">

					<div class="form-group">
						<label for="nome">Nome</label>
						<input class="form-control" type="text" require="required" id="nome" name="usuario_nome" value="<?php echo $entidade['usuario_nome'] ?? '' ?>"> 
					</div>

					<div class="form-group">
						<label for="email">E-mail</label>
						<input class="form-control" type="text" require="required" id="email" name="usuario_email" value="<?php echo $entidade['usuario_email'] ?? '' ?>">
					</div>
					
					<?php if(!isset($_SESSION['login'])) : ?>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input class="form-control" type="password" required="required" id="senha" name="usuario_senha">
					</div>
					<?php endif; ?>
					<div class="form-group">
						<label for="cpf">CPF</label>
						<input class="form-control" type="text" require="required" id="cpf" name="usuario_CPF" value="<?php echo $entidade['usuario_CPF'] ?? '' ?>">
					</div>
					<div class="form-group">
						<label for="telefone">Telefone</label>
						<input class="form-control" type="text" require="required" id="telefone" name="usuario_telefone" value="<?php echo $entidade['usuario_telefone'] ?? '' ?>">
					</div>
					<div class="form-group">
						<label for="nascimento">Nascimento</label>
						<input class="form-control" type="date" require="required" id="nascimento" name="usuario_nascimento" value="<?php echo $entidade['usuario_nascimento'] ?? '' ?>">
					</div>
					<div class="form-group">
						<label for="genero">Gênero</label>
						<select class="form-control" require="required" id="genero" name="usuario_genero" value="<?php echo $entidade['usuario_genero'] ?? '' ?>">
							<option value="masculino">Masculino</option>
							<option value="feminino">Feminino</option>
							<option value="outro">Outro</option>
						</select>
					</div>
					<div class="text-right">
						<button class="btn col-md-12 text-dark" type="submit" style="background-color: yellow;">Salvar</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php 
					include 'includes/rodape.php';
				?>
			</div>
		</div>
	<script src="lib/bootstrap-4.2.1-dist/js/bootstrap.min.js"></script>
	</body>
</html>