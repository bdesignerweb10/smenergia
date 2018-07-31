<?php
//require_once('ErrorHandling.php');

date_default_timezone_set('America/Sao_Paulo');

// PRODUCAO
/*$host = "oficialagenda.mysql.dbaas.com.br";
$user = "oficialagenda";
$password = "rl11br01";
$dbname = "oficialagenda";
$conn = mysqli_connect($host, $user, $password) or die ("Erro ao tentar se conectar!");
mysqli_select_db($conn, $dbname) or die("Erro ao selecionar o banco!");*/

// HOMOLOG
// $host = "gomesdev.mysql.dbaas.com.br";
// $user = "gomesdev";
// $password = "rl11br01";
// $dbname = "gomesdev";
// mysqli_connect($host, $user, $password) or die ("Erro ao tentar se conectar!");
// mysqli_select_db($dbname) or die("Erro ao selecionar o banco!");

// DEV
 $host = "localhost";
 $user = "root";
 $password = "root";
 $dbname = "smenergia";
 $conn = mysqli_connect($host, $user, $password) or die ("Erro ao tentar se conectar!");
 mysqli_select_db($conn, $dbname) or die("Erro ao selecionar o banco!");

function url_origin( $s, $use_forwarded_host = false )
{
	$ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
	$sp       = strtolower( $s['SERVER_PROTOCOL'] );
	$protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
	$port     = $s['SERVER_PORT'];
	$port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
	$host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );
	$host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;
	return $protocol . '://' . $host;
}

function full_url($s, $descerNivel = 1)
{
	$path = "";

	$pathSplitted = explode("/", $s['REQUEST_URI']);

	for($i = 0; $i <= count($pathSplitted) - (1 + $descerNivel); $i++) {
		$path .= $pathSplitted[$i] . "/";
	}

	return url_origin( $s, false) . $path;
}