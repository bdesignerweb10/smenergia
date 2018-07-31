<?php
	require_once('header.php');

	$quemsomos = $conn->query("select * from vw_quem_somos") or trigger_error($conn->error);

	if ($quemsomos && $quemsomos->num_rows > 0) {
	    while($sobrenos = $quemsomos->fetch_object()) {
			$titulo = $sobrenos->titulo;
			$descricao = $sobrenos->descricao;		
		}
	}
?> <!-- container --><div class="container-fluid"><div class="row quem-somos"><div class="col-sm-8"><h3 class="title"><?php echo $titulo; ?></h3><p class="text-sobre"><?php echo nl2br (substr ($descricao, 0)); ?></p></div><div class="col-sm-4"><img src="img/logo-sm.png" class="img-quemsomos img-fluid"></div></div><!-- row --></div><!-- container --> <?php
	require_once('footer.php');
?>