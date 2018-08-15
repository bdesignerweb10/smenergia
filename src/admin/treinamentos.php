<?php 
	require_once('header.php');
	$treinamentos = $conn->query("select * from treinamentos order by id") or trigger_error($conn->error);
	$servicos = $conn->query("select * from treinamentos_servicos order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento Treinamento</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-treinamentos">
					<i class='fa fa-plus'></i> Novo
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class='bigcolumn'>Descrição</th>
			                <th class='center'>Ativo</th>
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($treinamentos && $treinamentos->num_rows > 0) {
						    while($treinamento = $treinamentos->fetch_object()) {
						    	$id = $treinamento->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $treinamento->id; ?></th>
						        <td><?php echo nl2br (substr ($treinamento->descricao, 0, 100)); ?>...</td>
						        <?php if ($treinamento->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>
									<!--<a href="#" class="btn-edit-quemsomos" alt="Editar Quem Somos" title="Editar dados do Quem Somos">-->
									<a href="#" class="btn-edit-treinamentos" data-id="<?php echo $id;?>" alt="Editar Treinamento <?php echo $treinamento->id; ?>" title="Editar dados do treinamento <?php echo $treinamento->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-treinamentos" data-id="<?php echo $id;?>" alt="Remover Treinamento <?php echo $treinamento->id; ?>" title="Remover treinamento <?php echo $treinamento->id; ?>">
										<i class="fa fa-trash fa-2x del"></i>
									</a>									
								</td>						           
							</tr>	
							<?php } ?>			        	
			        	<?php } else { ?>
			        		<tr>
					        	<td colspan="4" class="center">Não há dados a serem exibidos para a listagem.</td>
				            </tr>
			        	<?php } ?>						
					</tbody>    
			    </table>
			</div><!-- col-sm-8-->
		</div><!-- row -->
	</div><!-- container-->


	<div class="container">
		<h3 class="headline">Gerenciamento Palestra</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-palestra">
					<i class='fa fa-plus'></i> Nova palestra
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class='bigcolumn'>Palestra</th>
			                <th class='center'>Ativo</th>
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($servicos && $servicos->num_rows > 0) {
						    while($palestra = $servicos->fetch_object()) {
						    	$id = $palestra->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $palestra->id; ?></th>
						        <td><?php echo nl2br (substr ($palestra->palestra, 0, 100)); ?>...</td>
						        <?php if ($palestra->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>																		
									<a href="#" class="btn-edit-palestra" data-id="<?php echo $id;?>" alt="Editar Palestra <?php echo $palestra->id; ?>" title="Editar dados da palestra <?php echo $palestra->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-palestra" data-id="<?php echo $id;?>" alt="Remover Palestra <?php echo $palestra->id; ?>" title="Remover palestra <?php echo $palestra->id; ?>">
										<i class="fa fa-trash fa-2x del"></i>
									</a>									
								</td>						           
							</tr>	
							<?php } ?>			        	
			        	<?php } else { ?>
			        		<tr>
					        	<td colspan="4" class="center">Não há dados a serem exibidos para a listagem.</td>
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
		<h3 class="headline">Gerenciar Treinamentos</h3>
		<button type="button" id="btn-voltar-treinamentos" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-treinamentos" class="form-panel" data-toggle="validator" action="acts/acts.treinamentos.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-treinamentos" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>			  			
					</div>
					<div class="row">
			  			<div class="col-12">
						    <label for="descricao">Descrição</label>
						    <textarea class="form-control form-control-lg" id="descricao" name="descricao" rows="6" placeholder="Informe a descrição..." data-error="Por favor, informe a descrição." required></textarea>
			    			<div class="help-block with-errors"></div>
			    		</div>
					</div>
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">
			  			<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se o evento está ativo, aparecerá na página treinamentos do site
								</label>
							</div>
			    		</div>
					</div>
  					<button type="button" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-treinamentos">
  						<i class='fa fa-save'></i> Salvar dados
  					</button>
				</div><!-- col-sm-8--> 
			</div>
		</form>
	</div>
</main>

<main class="mainform-palestra">
	<div class="container">
		<h3 class="headline">Gerenciar Palestras</h3>
		<button type="button" id="btn-voltar-palestra" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-palestra" class="form-panel" data-toggle="validator" action="acts/acts.palestras.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-palestra" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>			  			
					</div>
					<div class="row">
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="titulo">Palestra</label>
			    			<input type="text" class="form-control form-control-lg" id="titulo" name="titulo" aria-describedby="titulo" placeholder="Informe o tema da palestra..." data-error="Por favor, informe a palestra." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
					</div>
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">
			  			<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se o evento está ativo, aparecerá na página treinamentos do site
								</label>
							</div>
			    		</div>
					</div>
  					<button type="button" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-palestra">
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