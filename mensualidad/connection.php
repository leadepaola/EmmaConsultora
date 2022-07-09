<?php


//Hostinger

$servername = "localhost";
$database = "u354496887_emma_rh"; 
$username = "u354496887_emma_rh";
$password = "1C/Lv71&Z4f#";



//Local Joe
/*
$servername = "localhost";
$username = "root";
$password = "";
$database = "emma_consultora"; 
*/


//Local Lea
/*
$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "emma_rh"; 
*/



$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// Create a new connection to the MySQL database using PDO, $db_conection is an object
try { 
  $db_conection = new PDO($sql, $username, $password, $dsn_Options);
  //echo "Conexion a DB exitosa"."<br/>";
} catch (PDOException $error) {
  echo 'Error de conexion. Mensaje: ' . $error->getMessage();
}





//$mysqli = new mysqli($servername,$username,$password,$database);

//XAMPP
// $mysqli = new mysqli("localhost","root","","emma_consultora");

//Servidor
//$mysqli = new mysqli("localhost","u354496887_emma_rh","1C/Lv71&Z4f#","u354496887_emma_rh");


//Evaluamos que se haya conectado correctamente
/*
if($mysqli-> connect_errno){
    //echo "fallo al conectar, numero de error".$mysqli->connect_errno."<br>Descripcion de error ".$mysqli->connect_error;

    echo "Algo salio mal";
}
*/




?>