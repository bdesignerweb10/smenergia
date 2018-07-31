<?php
	require_once('header.php');

	$slides = $conn->query("select * from vw_slides") or trigger_error($conn->error);
?>	
		<div class="row-fluid">			
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <div class="carousel-inner">
			  	<?php 		
			  		$count = 0;								
					if ($slides && $slides->num_rows > 0) {
					  	while($banner = $slides->fetch_object()) {	
				 ?>
				    <div class="carousel-item <?php if($count == 0) echo 'active'; ?>">
				      <img class="d-block w-100" src="img/slides/<?php echo $banner->img; ?>">
				    </div>	
			    <?php $count++; } ?> 
			  		<?php } ?>		    
			  </div>			  			
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>			  			
			</div>
		</div><!-- row -->	
		<div class="row-fluid utils">
			<div class="col-sm-12">
				<h1 class="slogan"><span>“</span> Consultoria e Assessoria comercial para consumidores de energia elétrica que possuem transformador próprio/particular, Grupo A<span>”</span></h1>
			</div>			
		</div><!-- row -->
		<div class="row-fluid cards">
			<div class="col-sm-12">
				<div class="card-deck">
				  <div class="card">
				    <img class="card-img-top img-fluid" src="img/card-1.png" alt="Card image cap">
				    <div class="card-body">
				      <h4 class="card-title">Consultores</h4>
				      <p class="card-text">Profissionais que irão ajudar a sua empresa a economizar.</p>
				      <a href="consultores.php" class="btn btn-primary btn-card">saiba mais</a>
				    </div>				    
				  </div>
				  <div class="card">
				    <img class="card-img-top img-fluid" src="img/card-2.png" alt="Card image cap">
				    <div class="card-body">
				      <h4 class="card-title">Serviços</h4>
				      <p class="card-text">Conheça os nossos serviços que irão auxiliar você e sua empresa.</p>
				      <a href="servicos.php" class="btn btn-primary btn-card">saiba mais</a>
				    </div>				    
				  </div>
				  <div class="card">
				    <img class="card-img-top img-fluid" src="img/card-3.png" alt="Card image cap">
				    <div class="card-body">
				      <h4 class="card-title">Você Sabia?</h4>
				      <p class="card-text">Confira as dicas mais importantes para sua empresa economizar.</p>
				      <a href="sabia.php" class="btn btn-primary btn-card">saiba mais</a>
				    </div>				    
				  </div>
				</div>
			</div>
		</div><!--row -->		
	</div><!-- Container -->
	<?php
	require_once('footer.php');
?>	
	