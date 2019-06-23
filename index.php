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
    <div class="container">
	
      <div class="header clearfix">
        <!-- nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav -->
		
        <h3 class="text-muted">Ajedrez</h3>
      </div>

		<div class="jumbotron">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					<div id="tabla">
<?php
			
echo Pintar::tablero($miJuego->tablero, $miJuego->jugador);

?>



	  
	  
	  
	  
					</div>
				</div>
				<div class="col-lg-2"></div>
			</div>
		</div>

		
	 <!-- LOG DE JUGADAS--->
	 
		
		
      <!-- div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div -->	  
	  <!-- Button trigger modal -->
	  
<?php
	include('res/pieDePagina.php');
?>
	</div>
</body>

</html>