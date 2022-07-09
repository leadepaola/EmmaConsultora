<?php 


@$fecha = date("Y-m-d H:i:s",time());
$date = new DateTime($fecha, new DateTimeZone('America/Argentina/Buenos_Aires'));
date_default_timezone_set('America/Argentina/Buenos_Aires');
$zonahoraria = date_default_timezone_get();

@$fecha=date("d/m/Y",time());
@$hora= date("H:i",time());



