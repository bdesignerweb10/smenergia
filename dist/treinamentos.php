<?php
	require_once('header.php');

	$treinamentos = $conn->query("select * from vw_treinamentos") or trigger_error($conn->error);
	$treinamentos_servicos = $conn->query("select * from vw_treinamentos_servicos") or trigger_error($conn->error);

	if ($treinamentos && $treinamentos->num_rows > 0) {
	    while($treina = $treinamentos->fetch_object()) {
			$descricao = $treina->descricao;					
		}
	}
?> <!-- container --><div class="container-fluid"><div class="row cli-par"><div class="col-sm-11"><h3 class="title">Treinamentos</h3><p class="text-sobre"><?php echo nl2br (substr ($descricao, 0)); ?></p></div><div class="col-sm-4 offset-sm-1"><ul class="list-group list-palestra"><li class="list-group-item active">Confira a lista de de assuntos para palestras e treinamentoss</li> <?php if ($treinamentos_servicos && $treinamentos_servicos->num_rows > 0) {
					  	while($palestra = $treinamentos_servicos->fetch_object()) {													
				 ?> <li class="list-group-item"><?php echo $palestra->palestra; ?></li> <?php } ?> <?php } ?> </ul><h5 class="cont-treina">Entre em <a href="contato.php"><strong>contato</strong></a> conosco agora mesmo!</h5></div><div class="col-sm-6"><div class="card bg-dark text-white"><img class="card-img img-fluid" src="img/treinamento.png" alt="Card image"><div class="card-img-overlay"></div></div></div></div></div> <?php
	require_once('footer.php');
?> <script>$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})</script>