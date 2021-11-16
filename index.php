<!DOCTYPE html>
<html>
<head>
	<title>Página inicial | Projeto para Web com PHP</title>
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
	<div class="container" style="min-height: 500px;">
		<div class="col-md-12" style="padding-top: 50px;">	
			<!-- Conteudo //-->
			<h2>Serviços disponíveis</h2>
			    <?php 
      				require_once 'includes/funcoes.php';
      				require_once 'core/conexao_mysql.php';
      				require_once 'core/sql.php';
     				require_once 'core/mysql.php';
			      	foreach ($_GET as $indice => $dado) {
			        $$indice = limparDados($dado);
			      	}
			      $data_atual = date('Y-m-d H:i:s');

			      $criterio = [['data_post', '<=',$data_atual]];

			      if (!empty($busca)) {
			        $criterio[] = [
			          'AND',
			          'tiposervico',
			          'like',
			          "%{$busca}%"
			        ];
			      }

			      $posts = buscar(
			        'post',
			        [
			          'tiposervico',
			          'contato',
			          'descricao',
			          'data_post',
			          'post_id',
			          '(select usuario_nome from usuario where usuario.usuario_id = post.	fk_usuario_usuario_id) as nome'
			        ],
			        $criterio,
			        'data_post DESC'
			      );
     			?>
			<div>
				<?php if (isset($_SESSION['login'])): ?>
					<div class="list-group">
						<?php
							foreach($posts as $post):
							$data = date_create($post['data_post']);
							$data = date_format($data, 'd/m/Y H:i:s');
						?>
						<a class="list-group-item list-group-item-action text-white bg-dark" href="post_detalhe.php?post=<?php echo $post['post_id']?>" style="border-color: yellow; border-style: inset;">
							<h3><?php echo $post['tiposervico']?> </h3>
							<p><?php echo $post['nome']?></p>
							<p><?php echo $post['contato']?></p>
							<p><?php echo $post['descricao']?></p>
						</a>

					<?php endforeach;?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<!--Rodapé//-->
			<?php 
				include 'includes/rodape.php';
			?>
		</div>
	</div>
	<script src="lib/bootstrap-4.2.1-dist/js/boostrap.min.js"></script>
</body>
</html>