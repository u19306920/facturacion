<?php 
session_start();
$host= $_SERVER["HTTP_HOST"];

if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
?>