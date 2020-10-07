<?php
include ("connection/connect.php");
session_start();

$activeuser=$_SESSION[username];

session_destroy();


header("Location:home.php?logout=logout successful");


?>

