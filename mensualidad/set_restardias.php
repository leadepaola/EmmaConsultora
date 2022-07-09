<?php 



include('connection.php');
include('fecha_y_hora.php');


$pedido_sql = 'UPDATE admin_dias_disp SET cantidad=cantidad-1
WHERE id = 1'
;


$resultado = $db_conection->prepare($pedido_sql);



/*----------------------------- Execute: restar dias -----------------------------*/
if ($resultado->execute()) {

	echo "Execute: Restar dias OK<br>";


	$pedido_sql_2 = 'INSERT INTO admin_registro_restardias (fecha, hora) 
	VALUES (
		"'.	$fecha			.'",
		"'.	$hora			.'"
		)';

	$resultado_2 = $db_conection->prepare($pedido_sql_2);

}
else{
	echo 'Error de conexion. Mensaje: ' . $error->getMessage();
}



/*----------------------------- Execute: Registrando en DB -----------------------------*/

if ($resultado_2->execute()) {
//	echo "Execute: Registrar evento en DB OK";
} 
else{
//	echo 'Error de conexion. Mensaje: ' . $error->getMessage();
}




















?>