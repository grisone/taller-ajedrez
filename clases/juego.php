<?php

class Juego {
	
	private $DEBUG = TRUE;
	
	public $tablero;	
	public $jugador;
	
	function __construct(){
		
		$this->jugador = 1;
		
		$this->tablero = $this->juegoInicial();
		
	}
	
	private function juegoInicial(){
		
		

	
			return array (
				array( 1, 2, 3, 4, 5, 3, 2, 1),
				array( 6, 6, 6, 6, 6, 6, 6, 6),
				
				array( 0, 0, 0, 0, 0, 0, 0, 0),
				array( 0, 0, 0, 0, 0, 0, 0, 0),
				array( 0, 0, 0, 0, 0, 0, 0, 0),
				array( 0, 0, 0, 0, 0, 0, 0, 0),
				
				array(-6,-6,-6,-6,-6,-6,-6,-6),
				array(-1,-2,-3,-4,-5,-3,-2,-1)
			)
			
			
			;
		
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
		}
		//valido reina con reglas de alfil y torre
		elseif( abs($this->tablero[$fila][$col]) == Pieza::REINA ){			
			if( $this->validarAlfil($fila, $col, $filaNueva, $colNueva) || $this->validarTorre($fila, $col, $filaNueva, $colNueva)){				
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
				$celdaEvaluar = $this->tablero[($fila+($x*$factorFila))][($col+ ($x*$factorColumna) )];
				if($celdaEvaluar != Pieza::VACIA ){
					return false;
				}
				$this->logger( "FILA=desde[". ($fila+($x*$factorFila)).",".($col+ ($x*$factorColumna) )."]" );
			}

			
			$this->logger( "VALIDAR QUE NO SE SALTE LAS PIEZAS " );
			
			return true;
		
		}
		return $validado;
	}
	
	
	private function validarTorre($fila, $col, $filaNueva, $colNueva){		
		$validado = false;
		$distanciaColumna	= abs($col-$colNueva);
		$distanciaFilas		= abs($fila-$filaNueva);
		
		if( $fila==$filaNueva ){
			$factor  = ($col>$colNueva? -1 : 1 );
			#$this->logger( "INICIO[$fila,$col], FIN[$filaNueva,$colNueva]" );
			#$this->logger( "diferencia=[".($fila-$filaNueva)."], COLUMNA=[".($col-$colNueva)."][".($colNueva-$col)."] [$factor]" );
			#$this->logger( "for=[".($fila-$filaNueva)."], COLUMNA=[".($col-$colNueva)."][".($colNueva-$col)."] [$factor]" );
			for( $x=1; $x < $distanciaColumna; $x++ ){
				$celdaEvaluar = $this->tablero[($fila)][($col+($x*$factor))];
			#	$this->logger( "celda[$celdaEvaluar]=  COLUMNA[".($fila)."][".($col+($x*$factor))."][".($colNueva-$col)."]" );
				if($celdaEvaluar != Pieza::VACIA ){return false;}
			}
			$validado=true;
			
		}elseif ($col==$colNueva){
			$factor  = ($fila>$filaNueva? -1 : 1 );
			
			for( $x=1; $x < $distanciaFilas; $x++ ){
				$celdaEvaluar = $this->tablero[($fila+($x*$factor))][($col)];
				if($celdaEvaluar != Pieza::VACIA ){return false;}
			}
			$validado=true;
		}
		return $validado;	
	}
		
		
	
	function validarMovimientoPeon($fila, $col, $filaNueva, $colNueva){
		$validado = false;		
		$pieza = $this->tablero[$fila][$col];
		
		if ( $pieza < 0 ){
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
	
	
	function validarCoronacion($fila, $col, $filaNueva, $colNueva){
		$validado = false;		
		$pieza = $this->tablero[$filaNueva][$colNueva];
		
		if ( abs($pieza) == PIEZA::PEON ){
			if( $filaNueva == 0  || $filaNueva == 7 ) {
				$validado=true;	
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
		
		/*
		echo "<p><sub style='color:green'>$texto</sub></p>";
		*/
	}
	

}


?>