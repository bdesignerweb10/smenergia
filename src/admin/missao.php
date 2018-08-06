<?php 
	require_once('header.php');
	$missao = $conn->query("select * from missao order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento de Missão, Visão e Valores</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-missao">
					<i class='fa fa-plus'></i> Novo Missã, Visão e Valores
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>			                
			                <th class='bigcolumn'>Missão</th>
			                <th class='bigcolumn'>Visão</th>
			                <th class='bigcolumn'>Valores</th>
			                <th class='center'>Ativo</th>
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($missao && $missao->num_rows > 0) {
						    while($mvv = $missao->fetch_object()) {
						    	$id = $mvv->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $mvv->id; ?></th> 
      							<td><?php echo nl2br (substr ($mvv->texto_missao, 0, 100)); ?>...</td>
      							<td><?php echo nl2br (substr ($mvv->texto_visao, 0, 100)); ?>...</td>     							
						        <td><?php echo nl2br (substr ($mvv->texto_valores, 0, 100)); ?>...</td>
						        <?php if ($mvv->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>
									<a href="#" class="btn-edit-missao" data-id="<?php echo $id;?>" alt="Editar Missão, Visão e Valores <?php echo $mvv->id; ?>" title="Editar missão, visão e valores <?php echo $mvv->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-missao" data-id="<?php echo $id;?>" alt="Remover missão, visão e valores <?php echo $mvv->id; ?>" title="Remover Missão, visão e valores <?php echo $mvv->id; ?>">
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
		<h3 class="headline">Gerenciar Missão, Visão e Valores</h3>
		<button type="button" id="btn-voltar-missao" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-missao" class="form-panel" data-toggle="validator" action="acts/acts.missao.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-missao" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-12">
						    <label for="texto_missao">Missão</label>
						    <textarea class="form-control form-control-lg" id="texto_missao" name="texto_missao" rows="6" placeholder="Informe a missão" data-error="Por favor, informe a missão." required></textarea>
			    			<div class="help-block with-errors"></div>
			    		</div>
					</div>
					<div class="row">
			  			<div class="col-12">
						    <label for="texto_visao">Visão</label>
						    <textarea class="form-control form-control-lg" id="texto_visao" name="texto_visao" rows="6" placeholder="Informe a visão." data-error="Por favor, informe a visão." required></textarea>
			    			<div class="help-block with-errors"></div>
			    		</div>
					</div>
					<div class="row">
			  			<div class="col-12">
						    <label for="texto_valores">Valores</label>
						    <textarea class="form-control form-control-lg" id="texto_valores" name="texto_valores" rows="6" placeholder="Informe os valores." data-error="Por favor, informe os valores." required></textarea>
			    			<div class="help-block with-errors"></div>
			    		</div>
					</div>
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">
			  			<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
									Se o evento está ativo, aparecerá na página missão visão e valores do site
								</label>
							</div>
			    		</div>
					</div>
  					<button type="button" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-missao">
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