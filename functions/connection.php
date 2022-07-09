<?php

//XAMPP
// $mysqli = new mysqli("localhost","root","","emma_consultora");

//Servidor
$mysqli = new mysqli("localhost","u354496887_emma_rh","1C/Lv71&Z4f#","u354496887_emma_rh");

//Evaluamos que se haya conectado correctamente

if($mysqli-> connect_errno){
    //echo "fallo al conectar, numero de error".$mysqli->connect_errno."<br>Descripcion de error ".$mysqli->connect_error;

    echo "Algo salio mal";
}
?>