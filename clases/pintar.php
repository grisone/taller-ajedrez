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
		$letras = [" ","A","B","C","D","E","F","G","H"];
		
		
		$retorno = "<table>";
		

		
		for($i=0; $i < 8; $i++){ //columnas 
			$retorno .= "<tr>";
			
			$retorno .= "<td>".($i+1)."</td>";
			
			for ($j=0; $j<=7;$j++) { //filas
				
				$retorno .= "<td title='[X=".$i.", Y=".$j."]' col='".$j."' fil='".$i."' class='".( (($i+$j)%2)==0?'par':'none')." ".
				(Pintar::puedeMover($tablero[$i][$j], $jugador ))." '>".Pintar::pieza($tablero[$i][$j])."</td>";
			}
			$retorno .= "</tr>";
		}
		
		$retorno .= "<tr>";
		for($i=0; $i <= 8; $i++){
			$retorno .= "<td>".($letras[$i])."</td>";
		}
		$retorno .= "</tr>";
		
		$retorno = $retorno."</table>";
		
		return $retorno;
	}
	
	function eleccion( $tablero, $jugador , $fila, $columna, $piezaReal){

$retorno = "<div class='modal' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title' id='myModalLabel'>Elije tu pieza ${fila},${columna} </h4>
      </div>
      <div class='modal-body'>
		<input type='hidden' id='columnaAnterior' value='${columna}' >
		<input type='hidden' id='filaAnterior' value='${fila}' >
		
		<button type='button' class='btn btn-default eleccion' value='".(Pieza::TORRE * ($piezaReal>0?1:-1))."'><img src='res/piezas/torre_".($piezaReal<0?'negro':'blanco').".png' ></button>
		<button type='button' class='btn btn-default eleccion' value='".(Pieza::CABALLO * ($piezaReal>0?1:-1))."'><img src='res/piezas/caballo_".($piezaReal<0?'negro':'blanco').".png' ></button>
		<button type='button' class='btn btn-default eleccion' value='".(Pieza::ALFIL * ($piezaReal>0?1:-1))."'><img src='res/piezas/alfil_".($piezaReal<0?'negro':'blanco').".png' ></button>
		<button type='button' class='btn btn-default eleccion' value='".(Pieza::REINA * ($piezaReal>0?1:-1))."'><img src='res/piezas/reina_".($piezaReal<0?'negro':'blanco').".png' ></button>

      </div>
      <!-- div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary'>Save changes</button>
      </div -->
    </div>
  </div>
</div>
<script>
$(function() {	
	$('#myModal').modal({
		show: true,
		keyboard: false,
		backdrop: 'static'
	});
});
</script>
";

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
		
		
		return $validado;
		
	}
	
	
	
	
}

?>