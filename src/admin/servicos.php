<?php 
	require_once('header.php');
	$servicos = $conn->query("select * from servicos order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento dos Serviços</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-servicos">
					<i class='fa fa-plus'></i> Novo servico
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="bigcolumn-title">Título</th>
			                <th class='bigcolumn'>Descrição</th>
			                <th class='center'>Ativo</th>
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($servicos && $servicos->num_rows > 0) {
						    while($servico = $servicos->fetch_object()) {
						    	$id = $servico->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $servico->id; ?></th>
      							<th scope="row" class="center"><?php echo $servico->titulo; ?></th>
						        <td><?php echo nl2br (substr ($servico->descricao, 0, 100)); ?>...</td>
						        <?php if ($servico->ativo == 0) { 
						        		$ativo ='Sim'; 
						      		} else { 
						      			$ativo ='Não';
						      	} 
						      	?>
						        <td class="center"><?php echo $ativo; ?></td>
						        <td class='center'>
									<a href="#" class="btn-edit-servicos" data-id="<?php echo $id;?>" alt="Editar Serviços <?php echo $servico->id; ?>" title="Editar serviços <?php echo $servico->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-servicos" data-id="<?php echo $id;?>" alt="Remover serviço <?php echo $servico->id; ?>" title="Remover servico <?php echo $servico->id; ?>">
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
		<h3 class="headline">Gerenciar Serviços</h3>
		<button type="button" id="btn-voltar-servicos" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-servicos" class="form-panel" data-toggle="validator" action="acts/acts.servicos.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-servicos" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="titulo">Título</label>
			    			<input type="text" class="form-control form-control-lg" id="titulo" name="titulo" aria-describedby="titulo" placeholder="Informe o título..." data-error="Por favor, informe o título." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
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
									<input type="checkbox" id="ativo" name="ativo" data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
									Se o evento está ativo, aparecerá na página servicos do site
								</label>
							</div>
			    		</div>
					</div>
  					<button type="button" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-servicos">
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