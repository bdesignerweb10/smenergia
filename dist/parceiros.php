<?php
	require_once('header.php');

	$parceiros = $conn->query("select * from clientes_parceiros where parceiro_ativo = '0'") or trigger_error($conn->error);
?> <!-- container --><div class="container-fluid"><div class="row cli-par"><div class="col-sm-12"><h3 class="title-cli-par">Nossos Parceiros</h3></div> <?php if ($parceiros && $parceiros->num_rows > 0) {
					  	while($parceiro = $parceiros->fetch_object()) {													
			?> <div class="col-sm-3"><button><img src="img/clientes/<?php echo $parceiro->img; ?>" class="img-thumbnail img-fluid" data-toggle="tooltip" data-placement="top" title="<?php echo $parceiro->telefone; ?>"></button><h3 class="nome-cli-par"><?php echo $parceiro->nome; ?></h3></div> <?php } ?> <?php } ?> </div></div> <?php
	require_once('footer.php');
?> <script>$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>