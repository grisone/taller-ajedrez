<?php

class Juego{
	
	public $tablero;	
	public $jugador;
	
	function __construct(){
		
		$this->jugador = 1;
		
		$this->tablero = array (
			array( 1, 2, 3, 4, 5, 3, 2, 1),
			array( 6, 6, 6, 6, 6, 6, 6, 6),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			array( 0, 0, 0, 0, 0, 0, 0, 0),
			//array( 0, 0, 0, 0, 0, 0, 0, 0),
			array(-6,-6,-6,-6,-6,-6,-6,-6),
			array(-1,-2,-3,-4,-5,-3,-2,-1)
		);
		
	}
	
	function validarMovimiento($fila, $col, $filaNueva, $colNueva){
		
		if( abs($this->tablero[$fila][$col]) == Pieza::PEON ){
			
			if( $this->validarPeon($fila, $col, $filaNueva, $colNueva) ){				
				// cambiar posicion de pieza
				$this->tablero[$filaNueva][$colNueva] = $this->tablero[$fila][$col];
				$this->tablero[$fila][$col] = Pieza::VACIA;
				
				return true;
			}
			
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::CABALLO ){
			
			if( $this->validarCaballo($fila, $col, $filaNueva, $colNueva) ){				
				// cambiar posicion de pieza
				$this->tablero[$filaNueva][$colNueva] = $this->tablero[$fila][$col];
				$this->tablero[$fila][$col] = Pieza::VACIA;
				
				return true;
			}
			
			
			
		}elseif( abs($this->tablero[$fila][$col]) == Pieza::TORRE ){
			
			if( $this->validarTorre($fila, $col, $filaNueva, $colNueva) ){				
				// cambiar posicion de pieza
				$this->tablero[$filaNueva][$colNueva] = $this->tablero[$fila][$col];
				$this->tablero[$fila][$col] = Pieza::VACIA;
				
				return true;
			}			
		}//torre
		
		return false;
	}
	
	function validarTorre($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		$pieza = $this->tablero[$fila][$col];
		
		if( ($fila==$filaNueva) || ($col==$colNueva) ){
			
			
			if($fila==$filaNueva){
				echo "<h2 style='color:green'>DISTANCIA=".abs($col-$colNueva)."</h2>";
				$distancia = abs($col-$colNueva);
				
				$calculo = ($col  > $colNueva ? $colNueva : $col );
				
				$puedoCaminar = true;
				for($x=1; $x < ($distancia);$x++ ){
					//$this->tablero[$fila][$col+()]
					echo "<h2 style='color:blue'>EVALUAR=[$fila, ".($calculo+$x)."]</h2>";
					
					// IF esta ocupado $puedoCaminar=false
				}
				if($puedoCaminar){
					// if la filaNueva, columnaNueva es una pieza distinta o cero = TRUE
				}
				
				
				
				echo "<h2 style='color:red'>FILA=$fila, COLUMNA= $col, FILA=$filaNueva, COLUMNA= $colNueva</h2>";
				return true;
			}else{ //$col==$colNueva
				echo "<h2 style='color:green'>DISTANCIA=".abs($fila-$filaNueva)."</h2>";
				echo "<h2 style='color:red'>FILA=$fila, COLUMNA= $col, FILA=$filaNueva, COLUMNA= $colNueva</h2>";
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
		
		
	
	function validarPeon($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		
		//echo "<h2 style='color:red'>FILA=$fila, COLUMNA= $col</h2>";
		
		$pieza = $this->tablero[$fila][$col];
		
		if ( $pieza < 0 ){
			// VALIDA NEGRAS
			if($col == $colNueva && $fila == 6 && $filaNueva == $fila - 2){
				$validado=true;
			}elseif( $col == $colNueva && $filaNueva == $fila -1 ){
				$validado=true;	
			}
		} else {
			// VALIDAR BLANCAS
			if($col == $colNueva && $fila == 1 && $filaNueva == $fila + 2){
				$validado=true;
			}elseif( $col == $colNueva && $filaNueva == $fila + 1 ){
				$validado=true;	
			}
		}
		return $validado;
	}	
	
	function validarCaballo($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		$pieza = $this->tablero[$fila][$col];
		
			
		if($colNueva == ($col - 1) && $filaNueva == $fila - 2 ){
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
	
	
	
}


?>