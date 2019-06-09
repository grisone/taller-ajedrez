<?php

include('pieza.php');

abstract class Pintar{	
	function pieza( $numeroPieza ){
		$valorPieza = "";		
		if($numeroPieza == 0 ){
			$valorPieza = "<span><br/></span>";
		} else {
			$paso = abs($numeroPieza);			
			if( $paso == Pieza::TORRE ){
				$valorPieza = "torre";
			}elseif( $paso == Pieza::CABALLO ){
				$valorPieza = "caballo";
			}elseif( $paso == Pieza::ALFIL ){
				$valorPieza = "alfil";
			}elseif( $paso == Pieza::REY ){
				$valorPieza = "rey";
			}elseif( $paso == Pieza::REINA ){
				$valorPieza = "reina";
			}elseif( $paso == Pieza::PEON ){
				$valorPieza = "peon";
			}			
			if( $numeroPieza > 0 ){
					$valorPieza = $valorPieza. "_blanco";
			}else{
					$valorPieza = $valorPieza. "_negro";
			}			
			$valorPieza = "<img src='res/piezas/".$valorPieza.".png' >";			
		}		
		return $valorPieza;
	}
	
	
	
	function tablero( $tablero, $jugador ){
		$retorno = "<table>";
		for($i=0; $i < 8; $i++){ //columnas 
			$retorno .= "<tr>";
			for ($j=0; $j<=7;$j++) { //filas	
				$retorno .= "<td title='[X=".$i.", Y=".$j."]' col='".$j."' fil='".$i."' class='".( (($i+$j)%2)==0?'par':'none')." ".
				(Pintar::puedeMover($tablero[$i][$j], $jugador ))." '>".Pintar::pieza($tablero[$i][$j])."</td>";
			}
			$retorno .= "</tr>";
		}
		$retorno = $retorno."</table>";
		
		return $retorno;
	}
	
	
	function puedeMover( $pieza, $jugador ){
		
		$retorno = "";
		
		if ( $jugador == 1 && $pieza < 0  ){
			$retorno = "puedeMover";
		}elseif ( $jugador == 2 && $pieza > 0  ){
			$retorno = "puedeMover";
		}
		
		return $retorno;
	}	
	
	function puedeComer($fila, $col, $filaNueva, $colNueva){
		$validado = false;
		
		if($colNueva == ($col - 1) && $filaNueva == $fila + 1  ){
			$validado=true;
		}elseif($colNueva == ($col + 1) && $filaNueva == $fila + 1  ){
			$validado=true;			
		}
		/*
		if(){
			//validar que com cuando pieza se contraria 
			
		}
	*/
		
		return $validado;
		
	}
	
	
	
	
}

?>