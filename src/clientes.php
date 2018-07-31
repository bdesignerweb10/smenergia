<?php
	require_once('header.php');

	$clientes = $conn->query("select * from vw_clientes") or trigger_error($conn->error);
?>	
	</div><!-- container -->
	<div class="container-fluid">
		<div class="row cli-par">
			<div class="col-sm-12">
				<h3 class="title-cli-par">Nossos Clientes</h3>
			</div>		
			<?php if ($clientes && $clientes->num_rows > 0) {
					  	while($cliente = $clientes->fetch_object()) {													
			?>	
			<div class="col-sm-3">
				<button><img src="img/clientes/<?php echo $cliente->img; ?>" class="img-thumbnail img-fluid" data-toggle="tooltip" data-placement="top" title="<?php echo $cliente->telefone; ?>"></button>
				<h3 class="nome-cli-par"><?php echo $cliente->nome; ?></h3>
			</div>
				<?php } ?> 
			<?php } ?>			
		</div>
	</div>
<?php
	require_once('footer.php');
?>	

<script>
	$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>