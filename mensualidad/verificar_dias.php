<?php 
	
	include('connection.php');
	include('fecha_y_hora.php');


	


	// Traigo toda los datos de la tabla facturacion 
	$sql_dias_disp = 'SELECT * FROM admin_dias_disp 

	WHERE id	= 1
	';

	$result_dias_disp = $db_conection->prepare($sql_dias_disp);



	// Ejecuto query
	if ($result_dias_disp->execute()) {

		$fila_dias_disp = $result_dias_disp->fetch(PDO::FETCH_ASSOC);

	}


	// Variable usada en mensualidad/web_en_pausa.php
	$pausa_position_img="";

	if ($fila_dias_disp['cantidad']<=0) {
		
		//mostrarlo
		$pausa_position_img= "display: flex;";

	}
	else{

		//ocultarlo
		$pausa_position_img= "display: none;";
		
	}

?>