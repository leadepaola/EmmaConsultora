<?php
require('../../functions/connection.php');
session_start();

if(isset($_POST["usuario"]) && isset($_POST["password"])){
    $user = mysqli_real_escape_string($mysqli, $_POST["usuario"]);
    $password = mysqli_real_escape_string($mysqli, $_POST["password"]);
    $sql = "SELECT user FROM login_emma WHERE (user='$user') AND (pass='$password')";

    $result = mysqli_query($mysqli, $sql);

    $num_row = mysqli_num_rows($result);

    if($num_row == "1"){
        $data = mysqli_fetch_array($result);
        $_SESSION["user"] = $data["user"];
        echo "1";
    }else {
        echo "error";
    }
}else {
    echo "error";
}
?>