<?php 
require('../../functions/connection.php');
session_start();
session_destroy();
header("location: ../../login_EMMA.php");
?>