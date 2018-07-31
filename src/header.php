<?php 
	require_once("acts/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Consultoria e Assessoria comercial para consumidores de energia elétrica que possuem transformador próprio/particular, Grupo A" />

	<meta name="keywords" content="economia, energia, elecktro, smenergia" />
	<meta name="author" content="Bruno Gomes"/>

	<meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />

	<link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<link rel="manifest" href="img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	

	<title>SM Energia</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row topo">
			<div class="col-sm-5 logo">
				<a href="./" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? ' nav-active' : ''; ?>"><img src="img/logo-sm.png" class="img-fluid"></a>
			</div>
			<div class="col-sm-7">				
				<nav class="navbar navbar-toggleable-md navbar-light menu">
				  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>
				  

				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item">
				        <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? ' nav-active' : ''; ?>" href="./">Inicio <span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'quem-somos.php' ? ' nav-active' : ''; ?>" href="quem-somos">Quem Somos</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'consultores.php' ? ' nav-active' : ''; ?>" href="consultores">Consultores</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'servicos.php' ? ' nav-active' : ''; ?>" href="servicos">Serviços</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'contato.php' ? ' nav-active' : ''; ?>" href="contato">Contato</a>
				      </li>
				    </ul>				    
				  </div>
				</nav>						
			</div>			
		</div><!-- row -->