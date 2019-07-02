<?php

include('clases/juego.php');
include('clases/pintar.php');

$miJuego = new Juego();

session_start();

$_SESSION['JUEGO']		= $miJuego->tablero;
$_SESSION['JUGADOR']	= $miJuego->jugador;

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ajedrez</title> 
	
    <link href="res/css/bootstrap.css" rel="stylesheet">
    <link href="res/css/jumbotron-narrow.css" rel="stylesheet">
	
	<script src="res/js/jquery-1.12.4.js"></script>
	<script src="res/js/bootstrap.min.js"></script>
	<script src="res/js/juego.js"></script>
	<link href="res/css/estilo.css" rel="stylesheet">
	
</head>
<body>
    <div class="container-fluid">
	
      <div class="header clearfix">		
        <h3 class="text-muted">Ajedrez</h3>
      </div>

	  
	  
		<div class="row">
			<div class="col-lg-3 jumbotron">
<?php
	include('res/jugador.php');
?>

			</div>
			
			<div class="col-lg-1"></div>
			
			<div class="col-lg-4 jumbotron">
				<div id="tabla">
<?php		
echo Pintar::tablero($miJuego->tablero, $miJuego->jugador);
?>
				</div>
			</div>
			
			<div class="col-lg-1"></div>
			<div class="col-lg-3 jumbotron">
<?php
	include('res/jugador.php');
?>
			</div>
		</div>

<?php
	include('res/pieDePagina.php');
?>
	</div>
</body>
</html>