<?php



class Juego {
	// VER LAS TRAMAS DE DEBUG
	private $DEBUG = TRUE;
	
	public $tablero;	
	public $jugador;
	
	function __construct(){
		
		$this->jugador = 1;
		
		$this->tablero = $this->juegoInicial();
		
	}
	
	private function juegoInicial(){
	// prueba alfiles
		return array (
			array( 1, 2, 3, 4, 5, 3, 2, 1),			
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array(-1,-2,-3,-4,-5,-3,-2,-1)
		);
	
/*	
	Inicial
	
		return array (
			array( 1, 2, 3, 4, 5, 3, 2, 1),
			array( 6, 6, 6, 6, 6, 6, 6, 6),
			
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			
			array(-6,-6,-6,-6,-6,-6,-6,-6),
			array(-1,-2,-3,-4,-5,-3,-2,-1)
		);
*/
	}
	
	// cambiar posicion de pieza
	public function moverPieza($fila, $col, $filaNueva, $colNueva){
		
		$this->tablero[ $filaNueva][$colNueva] = $this->tablero[$fila][$col];
		$this->tablero[ $fila ][ $col ] = Pieza::VACIA;
		
		return true;
	}

	public function validarJaque($fila, $col, $filaNueva, $colNueva){
			return true;
	}
	
	function validarMovimiento($fila, $col, $filaNueva, $colNueva){	
		$jugadaValida = false;
		//pieza
		if( abs($this->tablero[$fila][$col]) == Pieza::PEON ){		
			if( $this->validarMovimientoPeon($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}elseif( $this->validarCapturaPeon($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}		
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::CABALLO ){	
		
			if( $this->validarCaballo($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}			
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::TORRE ){			
			if( $this->validarTorre($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}			
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::ALFIL ){
			if( $this->validarAlfil($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}			
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::REINA ){			
			if( $this->validarReina($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}			
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::REY ){	
			if( $this->validarRey($fila, $col, $filaNueva, $colNueva) ){				
				$jugadaValida = true;
			}			
		}			
		return $jugadaValida;
	}
	
	
	private function validarAlfil($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		
		$pieza = $this->tablero[$fila][$col];
		
		$distanciaColumna	= abs($col-$colNueva);
		$distanciaFilas		= abs($fila-$filaNueva);
		
		if( $distanciaColumna == $distanciaFilas ){

			$this->logger( "EVALUAR=desde[$fila,$col] hasta[$filaNueva, $colNueva]" );
			
			$factorColumna = ($col>$colNueva? -1 : 1 );
			$factorFila    = ($fila>$filaNueva? -1 : 1 );
			
			
			for( $x=1; $x < $distanciaColumna; $x++ ){
				$this->logger( "FILA=desde[". ($fila+($x*$factorFila)).",".($col+ ($x*$factorColumna) )."]" );
			}

			
			$this->logger( "VALIDAR QUE NO SE SALTE LAS PIEZAS " );
			
			return true;
		
		}
		return $validado;
	}
	
	
	private function validarTorre($fila, $col, $filaNueva, $colNueva){		
		
		$validado = false;		
		$pieza = $this->tablero[$fila][$col];		
		
		if( ($fila==$filaNueva) || ($col==$colNueva) ){
			
			if($fila==$filaNueva){
				
				$this->logger( "DISTANCIA=".abs($col-$colNueva) );
				
				$distancia = abs($col-$colNueva);
				
				$calculo = ($col  > $colNueva ? $colNueva : $col );
				
				$puedoCaminar = true;
				for($x=1; $x < ($distancia);$x++ ){
					//$this->tablero[$fila][$col+()]
					
					$this->logger( "EVALUAR=[$fila, ".($calculo+$x)."]" );
					
					// IF esta ocupado $puedoCaminar=false
				}
				
				if($puedoCaminar){
					// if la filaNueva, columnaNueva es una pieza distinta o cero = TRUE
					/*preguntar por la fila nueva este libre para moverse , 
					recorrer las filas y columnas preguntando si esta vacia
					si no preguntar si puede comer
					*/
					
					
				if( $col == $colNueva ){
				if(  $fila == 1 && $filaNueva == $fila + 2 ){
					if( $this->tablero[$filaNueva  ][$colNueva] == PIEZA::VACIA &&
						$this->tablero[$filaNueva-1][$colNueva] == PIEZA::VACIA ) {
						$validado=true;	
					}
				}elseif( $filaNueva == $fila + 1 ) {
					$celda = $this->tablero[$filaNueva][$colNueva];
					if( $celda == PIEZA::VACIA ) {
						$validado=true;	
					}
				}
			}

			

				
					
					
					
					
					
				}	
				
				$this->logger("FILA=$fila, COLUMNA= $col, FILA=$filaNueva, COLUMNA= $colNueva");
				
				return true;
			}else{ //$col==$colNueva
				$this->logger( "DISTANCIA=".abs($fila-$filaNueva) );
				$this->logger( "FILA=$fila, COLUMNA= $col, FILA=$filaNueva, COLUMNA= $colNueva" );
				return true;			
			}
		}
		
		
		
/* 		if(
		
		
		$colNueva == ($col - 1) || $colNueva == ($col - 2)|| $colNueva == ($col - 3)|| $colNueva == ($col - 4)|| $colNueva == ($col - 5) ||
		$colNueva == ($col + 1) ||$colNueva == ($col + 2) ||$colNueva == ($col + 3) ||$colNueva == ($col + 4) ||$colNueva == ($col + 4) ||$colNueva == ($col +5) ||
		$filaNueva == $fila - 1 || $filaNueva == $fila - 2 || $filaNueva == $fila - 3 || $filaNueva == $fila - 4 || $filaNueva == $fila - 5 || $filaNueva == $fila - 6 ||  
		$filaNueva == $fila + 1 || $filaNueva == $fila + 2 || $filaNueva == $fila + 3 || $filaNueva == $fila + 4 || $filaNueva == $fila + 5 || $filaNueva == $fila + 6 && $pieza ==0  
		)
		{
		$validado = true;
		
		} */
		return $validado;
	}
		
		
	
	function validarMovimientoPeon($fila, $col, $filaNueva, $colNueva){
		$validado = false;		
		$pieza = $this->tablero[$fila][$col];
		
		if ( $pieza < 0 ){
/* 			// VALIDA NEGRAS
			if( $col == $colNueva && $fila == 6 && $filaNueva == $fila - 2){
				$validado=true;
			}elseif( $col == $colNueva && $filaNueva == $fila -1 ){
				//crear funcion para no comer hacia adelante 				
				$validado=true;	
			} */
			
			// VALIDA NEGRAS
			if( $col == $colNueva ){
				if( ( $fila == 6 && $filaNueva == $fila - 2 ) ||
					( $filaNueva == $fila -1 ) ) {
					$piezaRival = $this->tablero[$filaNueva][$colNueva];
					if( $piezaRival == PIEZA::VACIA ) {
						$validado=true;	
					}
				}
			}
		} else {
			
			// VALIDAR BLANCAS
/*
			if($col == $colNueva && $fila == 1 && $filaNueva == $fila + 2){
				$validado=true;
			}elseif( $col == $colNueva && $filaNueva == $fila + 1 ){
				$validado=true;	
			}
*/
			if( $col == $colNueva ){
				if(  $fila == 1 && $filaNueva == $fila + 2 ){
					if( $this->tablero[$filaNueva  ][$colNueva] == PIEZA::VACIA &&
						$this->tablero[$filaNueva-1][$colNueva] == PIEZA::VACIA ) {
						$validado=true;	
					}
				}elseif( $filaNueva == $fila + 1 ) {
					$celda = $this->tablero[$filaNueva][$colNueva];
					if( $celda == PIEZA::VACIA ) {
						$validado=true;	
					}
				}
			}
		}
		return $validado;
	}
	
	
	function validarCapturaPeon($fila, $col, $filaNueva, $colNueva){
		$validado=false;
		$pieza = $this->tablero[$fila][$col];
		if ( $pieza < 0 ){
			if($filaNueva==($fila-1) && (($colNueva==($col+1))||($colNueva==($col-1)))){
				$piezaRival = $this->tablero[$filaNueva][$colNueva];
				
				if($piezaRival>0) {
					$validado=true;
				}
			}
		} else {
			if($filaNueva==($fila+1) && (($colNueva==($col+1))||($colNueva==($col-1)))){
				$piezaRival = $this->tablero[$filaNueva][$colNueva];
				if($piezaRival<0) {
					$validado=true;
				}
			}
		}
		return $validado;
	}	
	
	function validarCaballo($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		$pieza = $this->tablero[$fila][$col];
		
			
		if($colNueva == ($col - 1) && $filaNueva == ($fila - 2) ){
			$validado=true;
		}elseif($colNueva == ($col + 1) && $filaNueva == $fila - 2 ){
			$validado=true;
		}elseif($colNueva == ($col - 2) && $filaNueva == $fila - 1  ){
			$validado=true;
		}elseif($colNueva == ($col + 2) && $filaNueva == $fila - 1  ){
			$validado=true;
		}elseif($colNueva == ($col - 1) && $filaNueva == $fila + 2 ){
			$validado=true;
		}elseif($colNueva == ($col + 1) && $filaNueva == $fila + 2 ){
			$validado=true;
		}elseif($colNueva == ($col - 2) && $filaNueva == $fila + 1  ){
			$validado=true;
		}elseif($colNueva == ($col + 2) && $filaNueva == $fila + 1  ){
			$validado=true;
		}
			
		return $validado;
	}
	
		function validarReina($fila, $col, $filaNueva, $colNueva){
		
		$validado = false;
		$pieza = $this->tablero[$fila][$col];

        $distanciaColumna	= abs($col-$colNueva);
		$distanciaFilas		= abs($fila-$filaNueva);
		
		if( $distanciaColumna == $distanciaFilas ){
			/*
			$this->logger( "VALIDAR QUE NO SE SALTE LAS PIEZAS " );
			*/
			
			
			
			
			
			
			
			
			return true;
		
		}


		
		if( ($fila==$filaNueva) || ($col==$colNueva) ){
			
			if($fila==$filaNueva){
				
				$this->logger( "DISTANCIA=".abs($col-$colNueva) );
				
				$distancia = abs($col-$colNueva);
				
				$calculo = ($col  > $colNueva ? $colNueva : $col );
				
				$puedoCaminar = true;
				for($x=1; $x < ($distancia);$x++ ){
					//$this->tablero[$fila][$col+()]
					
					$this->logger( "EVALUAR=[$fila, ".($calculo+$x)."]" );
					
					// IF esta ocupado $puedoCaminar=false
				}
				
				if($puedoCaminar){
					// if la filaNueva, columnaNueva es una pieza distinta o cero = TRUE
				}
				
				
				$this->logger("FILA=$fila, COLUMNA= $col, FILA=$filaNueva, COLUMNA= $colNueva");
				
				return true;
			}else{ //$col==$colNueva
				$this->logger( "DISTANCIA=".abs($fila-$filaNueva) );
				$this->logger( "FILA=$fila, COLUMNA= $col, FILA=$filaNueva, COLUMNA= $colNueva" );
				return true;			
			}
		}
				
		return $validado;

		
		}
		
		
		
				
	function validarRey($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		$pieza = $this->tablero[$fila][$col];	

		if($colNueva == ($col - 1) && $filaNueva == $fila + 1  ){
			$validado=true;
		}elseif($colNueva == ($col + 1) && $filaNueva == $fila + 1  ){
			$validado=true;
		}elseif($colNueva == ($col + 1) && $filaNueva == $fila - 1  ){
			$validado=true;
		}elseif($colNueva == ($col - 1) && $filaNueva == $fila - 1  ){
			$validado=true;
		}
		
		/* Falta movimiento paralelas y verticales */
		
		elseif($colNueva == ($col + 1) && $filaNueva == $fila   ){
			$validado=true;
		}elseif($colNueva == ($col - 1) && $filaNueva == $fila   ){
			$validado=true;
		}elseif($colNueva == ($col) && $filaNueva == $fila - 1  ){
			$validado=true;
		}elseif($colNueva == ($col ) && $filaNueva == $fila + 1  ){
			$validado=true;
		}	
		
		
		return $validado;
		
		}
	
	private function logger($texto){
		if(!$this->DEBUG) return;
		
		echo "<p><sub style='color:green'>$texto</sub></p>";
	}
}


?>