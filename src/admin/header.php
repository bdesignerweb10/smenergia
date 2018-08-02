<?php
	require_once("../acts/connect.php");
	
	/*if (!isset($_SESSION["usu_id"]) || empty($_SESSION["usu_id"]) || 
	!isset($_SESSION['usu_nivel']) || empty($_SESSION["usu_nivel"]) ||
	$_SESSION['usu_nivel'] == "3" || $_SESSION["usu_id"] == "0") header('Location: ./');*/
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

	<title>Admin | SM energia</title>

	<link rel="apple-touch-icon" sizes="180x180" href="../img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
	<link rel="manifest" href="../img/site.webmanifest">
	<link rel="mask-icon" href="../img/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="../img/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="../img/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-toggle.min.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css">
</head>
<body>
	<nav>
		<div class="sidebar">
			<div class="sidebar-header">
				<img src="../img/logo-sm-65.png" alt="Logo smenergia">
			</div><!-- sidebar-header -->

			<ul class="nav">
				<li class="nav-item">					
					<a href="home" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? ' nav-active' : ''; ?>">
					<i class="fa fa-home"></i>	
					Incio
					</a>
				</li>
				<li class="nav-item">					
					<a href="quem-somos" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'quem-somos' ? ' nav-active' : ''; ?>">
					<i class="fa fa-black-tie"></i>	
					Quem Somos
					</a>
				</li>
				<li class="nav-item">					
					<a href="consultores" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'consultores.php' ? ' nav-active' : ''; ?>">
						<i class="fa fa-address-card"></i>
						Consultores
					</a>
				</li>
				<li class="nav-item">					
					<a href="servicos" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'servicos.php' ? ' nav-active' : ''; ?>">
						<i class="fa fa-clipboard"></i>	
					Serviços
					</a>
				</li>
				
				<li class="nav-item">					
					<a href="treinamentos" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'treinamentos.php' ? ' nav-active' : ''; ?>">
					<i class="fa fa-bullhorn"></i>	
					Treinametos
					</a>
				</li>
				<li class="nav-item">					
					<a href="clientes-parceiros" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'clientes-parceiros.php' ? ' nav-active' : ''; ?>">
					<i class="fa fa-users"></i>	
					Clientes | Parceiros
					</a>
				</li>
				<li class="nav-item">					
					<a href="missao" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'missao.php' ? ' nav-active' : ''; ?>">
					<i class="fa fa-building"></i>	
					Missão | Visão
					</a>
				</li>
				<li class="nav-item">					
					<a href="sabia" class="nav-link<?php echo basename($_SERVER['PHP_SELF']) == 'sabia.php' ? ' nav-active' : ''; ?>">
						<i class="fa fa-info"></i>	
					Você Sabia?
					</a>
				</li>
			</ul>
		</div><!-- sidebar -->
	</nav>
	<header>
		<div class="header">
			<div class="container">
				<div class="offcanvas">
					<a href="#" class="js-open-sidebar item">
						<i class="fa fa-bars"></i>
					</a>
				</div><!-- offcanvas -->

				<div class="liga">					
					<p>
						<span class="mark hidden-xs-down">
							<?php echo strftime('Bom dia, hoje é %d de %B de %Y', strtotime('today')); ?>
						</span>
					</p>
				</div><!-- liga -->
				<div class="liga-logo">
					<div class="dropdown">
						<div class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mark hidden-xs-down"><?php echo $_SESSION["usu_nome"] ?></span>
							<span class="mark">								
									<i class='fa fa-user fa-2x'></i>								
							</span>
						</div>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    						<div class="dropdown-item"><a id="logout" href="#">Sair</a></div>
    					</div>	
					</div>
				</div><!-- liga-logo -->
			</div><!-- container -->	
		</div><!-- header -->
	</header>
