<?php 
	require_once('header.php');
	$clipar = $conn->query("select * from clientes_parceiros order by id") or trigger_error($conn->error);
?>
<main class="maintable">
	<div class="container">
		<h3 class="headline">Gerenciamento de Clientes e Parceiros</h3>
		<div class="row" style="margin-bottom: 20px;">
			<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4 offset-md-6 offset-lg-8 offset-lg-8">
				<button type="button" class="btn btn-success btn-lg form-control" id="btn-add-clipar">
					<i class='fa fa-plus'></i> Novo cliente/parceiro
				</button>		
			</div><!-- col-sm-8-->
		</div><!-- row -->	
		<div class="row tbl-position">
			<div class="col-12">
				<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			        <thead>
			            <tr>
			                <th class='center'>#</th>
			                <th class="bigcolumn-title">Nome</th>
			                <th class='bigcolumn'>Telefone</th>
			                <th class='center'>Cliente Ativo</th>
			                <th class='center'>Parceiro Ativo</th>			                
			                <th class='center'>Opções</th>
			            </tr>
			        </thead>
			    	<tbody>
			        	<?php if ($clipar && $clipar->num_rows > 0) {
						    while($clientes = $clipar->fetch_object()) {
						    	$id = $clientes->id;
						?>
				        	<tr>
      							<th scope="row" class="center"><?php echo $clientes->id; ?></th>
      							<th scope="row" class="center"><?php echo $clientes->nome; ?></th>
      							<th scope="row" class="center"><?php echo $clientes->telefone; ?></th>
						        <?php if ($clientes->cliente_ativo == 0) { 
						        		$cliente ='Sim'; 
						      		} else { 
						      			$cliente ='Não';
						      	} 
						      	?>
						      	<?php if ($clientes->parceiro_ativo == 0) { 
						        		$parceiro ='Sim'; 
						      		} else { 
						      			$parceiro ='Não';
						      	} 
						      	?>						        
						        <td class="center"><?php echo $cliente; ?></td>
						        <td class="center"><?php echo $parceiro; ?></td>
						        <td class='center'>									
									<a href="#" class="btn-edit-clipar" data-id="<?php echo $id;?>" alt="Editar Clientes e Parceiros <?php echo $clientes->id; ?>" title="Editar dados do Cliente e Parceiro <?php echo $clientes->id; ?>">
										<i class="fa fa-edit fa-2x edit"></i>
									</a>
									<a href="#" class="btn-del-clipar" data-id="<?php echo $id;?>" alt="Remover Cliente / Parceiros <?php echo $clientes->id; ?>" title="Remover Clientes / Parceiros <?php echo $clientes->id; ?>">
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
		<h3 class="headline">Gerenciar Clientes e Parceiros</h3>
		<button type="button" id="btn-voltar-clipar" class="btn btn-link btn-lg form-control btn-voltar">
			<i class='fa fa-arrow-left'></i>&nbsp;&nbsp;&nbsp;Voltar
		</button>
		<form id="form-clipar" class="form-panel" data-toggle="validator" action="acts/acts.clipar.php" method="POST">
			<div class="row justify-content-md-center">
				<div id="box-clipar" class="col-sm-12 col-md-10 col-lg-9 col-xl-9 form-box">					
					<div class="row" style="padding-top: 15px;">
			  			<div class="col-sm-4 col-md-4 col-lg-2 col-xl-2">		    			
							<label for="id">ID</label>
			    			<input type="number" class="form-control form-control-lg" id="id" name="id" aria-describedby="id" maxlength="11" disabled />
			    		</div>
			  			<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="nome">Nome</label>
			    			<input type="text" class="form-control form-control-lg" id="nome" name="nome" aria-describedby="nome" placeholder="Informe o título..." data-error="Por favor, informe o título." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="telefone">Telefone</label>
			    			<input type="text" class="form-control form-control-lg" id="telefone" name="telefone" aria-describedby="telefone" placeholder="Informe o telefone..." data-error="Por favor, informe o telefone." maxlength="120" required>
			    			<div class="help-block with-errors"></div>
			    		</div>
			    		<div class="col-sm-8 col-md-8 col-lg-10 col-xl-10">		    			
							<label for="img">Foto</label>
			    			<input type="file" class="form-control form-control-lg" id="img" name="img" aria-describedby="img" placeholder="Insira sua foto" data-error="Por favor, insira sua foto." maxlength="120">
			    			<div class="help-block with-errors"></div>
			    		</div>			    		
					</div>
					
					<div class="row" style="margin-top:20px; margin-bottom: 10px;">	
						<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="cliente" name="cliente" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda como Sim o "Cliente" e aparecerá na página clientes
								</label>
							</div>
			    		</div>
			    		<div class="col-12">
			  				<div class="checkbox">
								<label>
									<input type="checkbox" id="parceiro" name="parceiro" data-toggle="toggle" data-on="Sim" data-off="Não" data-onstyle="success" data-offstyle="danger">
									Se a opção estiver marcarda Sim o "Parceiro" e aparecerá na página parceiros
								</label>
							</div>
			    		</div>
					</div>
  					<button type="submit" class="btn btn-success btn-lg form-control btn-form" id="btn-salvar-clipar">
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