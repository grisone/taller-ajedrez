<?php

include('clases/juego.php');
include('clases/pintar.php');

$miJuego = new Juego();

session_start();

$miJuego->jugador = $_SESSION['JUGADOR'];
$miJuego->tablero = $_SESSION['JUEGO'];


$fila = $_POST['jugada']['desde']['fil'];
$col = $_POST['jugada']['desde']['col'];
$pieza = $_POST['jugada']['pieza'];


$miJuego->tablero[ $fila ][$col ] = $pieza;

$miJuego->jugador = ( $miJuego->jugador == 1 ? 2 : 1 );	


						 
$_SESSION['JUEGO'] = $miJuego->tablero;
$_SESSION['JUGADOR'] = $miJuego->jugador;

echo Pintar::tablero($miJuego->tablero, $miJuego->jugador);

