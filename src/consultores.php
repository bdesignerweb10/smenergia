<?php
	require_once('header.php');

	$consultores = $conn->query("select * from vw_consultores") or trigger_error($conn->error);
?>	
	</div><!-- container -->
	<div class="container-fluid">		
		<div class="row consultores">
				<?php if ($consultores && $consultores->num_rows > 0) {
					  	while($consultor = $consultores->fetch_object()) {													
				 ?>			
			<div class="col-sm-2">
				<img src="img/consultores/<?php echo $consultor->img; ?>" class="rounded img-consultores img-fluid">
			</div>
			<div class="col-sm-9">
				<h3 class="title"><?php echo $consultor->nome; ?></h3>				
				<p class="text-sobre"><?php echo nl2br (substr ($consultor->descricao, 0)); ?></p>				
			</div>	
		<?php } ?>
				<?php } ?>	
		</div><!-- row -->
	</div><!-- container -->
<?php
	require_once('footer.php');
?>	