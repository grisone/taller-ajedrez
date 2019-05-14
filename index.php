<?php

include('clases/juego.php');
include('clases/pintar.php');

$miJuego = new Juego();

session_start();

$_SESSION['JUEGO'] = $miJuego->tablero;
$_SESSION['JUGADOR'] = $miJuego->jugador;

?>
<!DOCTYPE html>
<html> 
  <head> 
    <title>Ajedrez</title> 
	
    <meta name="viewport" content="width=device-width, initial-scale=1">	
	
	<script src="res/js/jquery-1.12.4.js"></script>
<style>
table>tbody>tr>td{
	height: 40px !important;
	width: 40px !important
}

.moviendo{
	border: solid red 1px;
}

.moviendo_a{
	border: solid blue 1px;
}

.none{
	background-color:gray;
}
.par{
	background-color:white;
}
</style>

</head>
<body> 
<div id="tabla" style="border:solid red 1px;">
<?php

echo Pintar::tablero($miJuego->tablero, $miJuego->jugador);

echo time();
?>
</div>
<script>
"use strict"

var jugando = false;
var jugara = false;

function inicial() {
	
	$("table td.puedeMover").click(function() {
		if ( !jugando ){
			$("table td").removeClass('moviendo');
			$(this).addClass('moviendo');
			jugara = true;
		}
	});
	
	$("table td:not(.puedeMover)").click(function() {
		if ( !jugando && jugara ) {

			$(this).addClass('moviendo_a');	
			jugando = true
		
			var movimiento = {
				'desde': {
					'col': $("table td.moviendo").attr("col"),
					'fil': $("table td.moviendo").attr("fil")
				},
				'hasta': {
					'col' : $("table td.moviendo_a").attr("col"),
					'fil' : $("table td.moviendo_a").attr("fil")
				}
			}
			
			
			
			
			
			/// hola ya no soy el hector soy el santi
			
			
			
			$.ajax({
			  method: "POST",
			  url: "tablero.php",
			  data: { numeroJuego: 123, jugada: movimiento }
			}).done(function( datosServidor ) {				
				$("#tabla").html( datosServidor );
				
				//alert("ANTES " +jugando);
				
				jugando = false;
				jugara = false;
				
				//alert("DESUES " + jugando);
				
				inicial();
				
			});
		}
	});
}

$(function() {
	inicial();
});
</script>

<?php 
echo time();
?>

</body> 
</html>