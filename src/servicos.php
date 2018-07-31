<?php
	require_once('header.php');

	$servicos = $conn->query("select * from vw_servicos") or trigger_error($conn->error);
?>
	</div><!-- container -->
	<div class="container-fluid">
		<div class="row">					
			<div class="col-sm-12">
				<h3 class="title">Serviços</h3>	
				<p class="text-sobre">A SM.energia possui diversos serviços para auxiliar você, e ajudar em todas suas dúvidas.</p>
				<p class="text-sobre"> Clique em todos os serviços listados abaixo para visualizar mais detalhes</p>
			</div>	
		</div><!-- row -->
		<div class="row">
			<div class="col-sm-10 offset-sm-1 services">
				<?php if ($servicos && $servicos->num_rows > 0) {
					  	while($servico = $servicos->fetch_object()) {													
				 ?>
				<div class="accordion" id="accordionExample">
					<div class="card">
				    	<div class="card-header" id="headingOne">
					      	<h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#<?php echo $servico->id; ?>" aria-expanded="true" aria-controls="<?php echo $servico->id; ?>">
						          <?php echo $servico->titulo; ?>
						        </button>
					      	</h5>
				    	</div>

					    <div id="<?php echo $servico->id; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					    	<div class="card-body">
					        	<?php echo $servico->descricao; ?>
					      	</div>
					    </div>
				  	</div>					 	
				</div>
					<?php } ?> 
				<?php } ?>								
			</div><!-- col-sm-10 -->
		</div><!-- row -->
	</div><!-- container -->
<?php
	require_once('footer.php');
?>			