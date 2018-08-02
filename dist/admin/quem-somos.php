<?php 
	require_once('header.php');
	$quemsomos = $conn->query("select * from quem_somos order by id") or trigger_error($conn->error);
?> <main class="maintable"><div class="container"><h3 class="headline">Gerenciamento do Quem somos</h3><div class="row" style="margin-bottom: 20px;"><div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8"><button type="button" class="btn btn-success btn-lg form-control" id="btn-add-quemsomos"><i class="fa fa-plus"></i> Novo texto</button></div><!-- col-sm-8--></div><!-- row --><div class="row tbl-position"><div class="col-12"><table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"><thead><tr><th class="center">#</th><th class="bigcolumn-title">Título</th><th class="bigcolumn">Descrição</th><th class="center">Ativo</th><th class="center">Opções</th></tr></thead><tbody> <?php if ($quemsomos && $quemsomos->num_rows > 0) {
						    while($sobrenos = $quemsomos->fetch_object()) {
						?> <tr><th scope="row" class="center"><?php echo $sobrenos->id; ?></th><th scope="row" class="center"><?php echo $sobrenos->titulo; ?></th><td><?php echo nl2br (substr ($sobrenos->descricao, 0, 100)); ?>...</td> <?php if ($sobrenos->ativ == 0) { 
						        		$ativo ='Sim'; 
						      		} else { $ativo ='Não';
						      	} 
						      	?> <td class="center"><?php echo $ativo; ?></td><td class="center"><a href="#" class="btn-edit-quemsomos" alt="Editar Quem Somos" title="Editar dados do Quem Somos"><i class="fa fa-edit fa-2x edit"></i> </a><a href="#" class="btn-del-quemsomos" alt="Remover Quem somos" title="Remover Quem Somos"><i class="fa fa-trash fa-2x del"></i></a></td></tr> <?php } ?> <?php } else { ?> <tr><td colspan="4" class="center">Não há dados a serem exibidos para a listagem.</td></tr> <?php } ?> </tbody></table></div><!-- col-sm-8--></div><!-- row --></div><!-- container--></main> <?php 
	require_once('footer.php'); 
?>