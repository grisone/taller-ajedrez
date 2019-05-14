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
			
			$.ajax({
				method: "POST",
				url: "tablero.php",
				data: { numeroJuego: 123, jugada: movimiento }
			}).done(function( datosServidor ) {
				
				$("#tabla").html( datosServidor );
				
				//alert("ANTES " +jugando);
				
				jugando = false;
				jugara = false;
				
				//alert("DESPUES " + jugando);
				
				inicial();
				
			});
		}

	});
}

$(function() {
	inicial();
});