<?php
	require_once('header.php');
?> <!-- container --><div class="container-fluid cto"><div class="row"><h3 class="title">Entre em contato com a SM energia</h3><div class="col-sm-7"><div class="col-sm-8 form-contato"><form role="form" action="acts/acts.contato.php" method="post" enctype="multipart/form-data"><div class="row"><div class="col-xs-12 col-sm-12 col-md-12"><div class="form-group"><input type="text" name="nome" id="nome" class="form-control input-lg" placeholder="Nome" tabindex="1"></div></div><div class="col-xs-12 col-sm-12 col-md-12"><div class="form-group"><input type="email" name="email" id="email" class="form-control input-lg" placeholder="E-mail" tabindex="2"></div></div></div><div class="form-group"><input type="text" name="assunto" id="assunto" class="form-control input-lg" placeholder="Assunto" tabindex="3"></div><div class="row"><div class="col-xs-12 col-sm-12 col-md-12"><div class="form-group"><textarea class="form-control" id="mensagem" name="mensagem" rows="3" tabindex="4"></textarea></div></div></div><hr class="colorgraph"><div class="row"><div class="col-xs-12 col-md-12"><input type="submit" value="Enviar" class="btn btn-primary btn-block btn-lg btn-enviar" tabindex="5"></div></div></form></div></div><div class="col-sm-5"><h4>Você também pode entrar em contato pelos telefones:</h4><div class="col-sm-12 fones"><img src="img/phone.png"> <strong>(19) 99644-3301</strong></div><div class="col-sm-12 fones"><img src="img/phone.png"> <strong>(19) 99710-8771</strong></div></div></div><!-- row --></div> <?php
	require_once('footer.php');
?>