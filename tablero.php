<?php

include('clases/juego.php');
include('clases/pintar.php');

$miJuego = new Juego();

session_start();

$miJuego->jugador = $_SESSION['JUGADOR'];
$miJuego->tablero = $_SESSION['JUEGO'];


//error_log(print_r( $_POST, true) );


/*
 Array\n(
	[numeroJuego] => 123
	[jugada] => Array(
		[desde] => Array(
			[col] => 6
			[fil] => 4
		)
		[hasta] => Array(
			[col] => 4
			[fil] => 4
		)
	)
)

error_log( $_POST['jugada']['desde']['col'] );
error_log( $_POST['jugada']['desde']['fil'] );
error_log( $_POST['jugada']['hasta']['col'] );
error_log( $_POST['jugada']['hasta']['fil'] );

*/

error_log( $_POST['jugada']['hasta']['fil'] );

$validado = $miJuego->validarMovimiento(
                             $_POST['jugada']['desde']['fil'],
							 $_POST['jugada']['desde']['col'],
                             $_POST['jugada']['hasta']['fil'], 
                             $_POST['jugada']['hasta']['col'] );

$piezaOrigen = $miJuego->tablero[($_POST['jugada']['desde']['fil'])][($_POST['jugada']['desde']['col'])];

$cambiarPieza = false;
							

if( $validado ){
	
	if( $miJuego->validarJaque(
					$_POST['jugada']['desde']['fil'],
					$_POST['jugada']['desde']['col'],
					$_POST['jugada']['hasta']['fil'], 
					$_POST['jugada']['hasta']['col'] ) ){
		
		$miJuego->moverPieza(
					$_POST['jugada']['desde']['fil'],
					$_POST['jugada']['desde']['col'],
					$_POST['jugada']['hasta']['fil'], 
					$_POST['jugada']['hasta']['col'] );
		
		if( $miJuego->validarCoronacion(
					$_POST['jugada']['desde']['fil'],
					$_POST['jugada']['desde']['col'],
					$_POST['jugada']['hasta']['fil'], 
					$_POST['jugada']['hasta']['col'] ) ) {
			$cambiarPieza = true;	
		} else {
			$miJuego->jugador = ( $miJuego->jugador == 1 ? 2 : 1 );	
		}
		
	}
	
}

						 
$_SESSION['JUEGO'] = $miJuego->tablero;
$_SESSION['JUGADOR'] = $miJuego->jugador;



echo Pintar::tablero($miJuego->tablero, $miJuego->jugador);

if( $cambiarPieza ){
	echo Pintar::eleccion($miJuego->tablero, $miJuego->jugador,
					$_POST['jugada']['hasta']['fil'], 
					$_POST['jugada']['hasta']['col'],
					$piezaOrigen );
}


?>