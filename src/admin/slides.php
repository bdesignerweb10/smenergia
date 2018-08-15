<?php 
	require_once('header.php');
	$slides = $conn->query("select * from banner order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento dos slides</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-slides">
					<i class='fa fa-plus'></i> Novo slide
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="bigcolumn-title">Titulo</th>
			                <th class='center'>Imagem</th>
			                <th class='bigcolumn'>Link</th>			                
			                <th class='center'>Ativo</th>
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($slides && $slides->num_rows > 0) {
						    while($banner = $slides->fetch_object()) {
						    	$id = $banner->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $banner->id; ?></th>
      							<th scope="row" class="center"><?php echo $banner->nome; ?></th>
      							<th scope="row" class="center"><img src="../img/slides/<?php echo $banner->img; ?>" style="width: 80px; height: 50px;"></th>
						        <th scope="row" class="center"><?php echo $banner->link; ?></th>
						        <?php if ($banner->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>									
									<a href="#" class="btn-edit-slides" data-id="<?php echo $id;?>" alt="Editar slides <?php echo $banner->id; ?>" title="Editar slides <?php echo $banner->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-slides" data-id="<?php echo $id;?>" alt="Remover slide <?php echo $banner->id; ?>" title="Remover slide <?php echo $banner->id; ?>">
										<i class="fa fa-trash fa-2x del"></i>
									</a>									
								</td>						           
							</tr>	
							<?php } ?>			        	
			        	<?php } else { ?>
			        		<tr>
					        	<td colspan="6" class="center">Não há dados a serem exibidos para a listagem.</td>
				            </tr>
			        	<?php } ?>						
					</tbody>    
			    </table>
			</div><!-- col-sm-8-->
		</div><!-- row -->
	</div><!-- container-->
</main>

<main class="mainform">
	<div class="container">
		<h3 class="headline">Gerenciar Slides - Tamanho da imagem (1700 x 400)</h3>
		<button type="button" id="btn-voltar-slides" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-slides" class="form-panel" data-toggle="validator" action="acts/acts.slides.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-slides" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="nome">Tituo</label>
			    			<input type="text" class="form-control form-control-lg" id="nome" name="nome" aria-describedby="nome" placeholder="Informe o título..." data-error="Por favor, informe o título." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="img">Imagem</label>
			    			<input type="file" class="form-control form-control-lg" id="img" name="img" aria-describedby="img" placeholder="Insira sua foto" data-error="Por favor, insira sua foto." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="link">Link</label>
			    			<input type="text" class="form-control form-control-lg" id="link" name="link" aria-describedby="link" placeholder="Informe o link..." data-error="Por favor, informe o link." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
					</div>					
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">
			  			<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se o evento está ativo, aparecerá na páginainicial do site
								</label>
							</div>
			    		</div>
					</div>
  					<button type="submit" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-slides">
  						<i class='fa fa-save'></i> Salvar dados
  					</button>
				</div><!-- col-sm-8--> 
			</div>
		</form>
	</div>
</main>
<?php 
	require_once('footer.php'); 
?>