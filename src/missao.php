<?php
	require_once('header.php');

	$missao = $conn->query("select * from vw_missao") or trigger_error($conn->error);

	if ($missao && $missao->num_rows > 0) {
	    while($mvv = $missao->fetch_object()) {
			$missao_empresa = $mvv->texto_missao;
			$visao = $mvv->texto_visao;
			$valores = $mvv->texto_valores;		
		}
	}
?>	
	</div><!-- container -->
	<div class="container-fluid">
		<div class="row quem-somos">
			<div class="col-sm-12">
				<h3 class="missao-title">Missão</h3>
				<h1 class="missao"><span>“</span> <?php echo nl2br (substr ($missao_empresa, 0)); ?><span>”</span></h1>
				<h3 class="missao-title">Visão</h3>
				<h1 class="missao"><span>“</span> <?php echo nl2br (substr ($visao, 0)); ?><span>”</span></h1>
				<h3 class="missao-title">Valores</h3>
				<h1 class="missao"><span>“</span> <?php echo nl2br (substr ($valores, 0)); ?><span>”</span></h1>
			</div>					
		</div><!-- row -->
	</div><!-- container -->
<?php
	require_once('footer.php');
?>	