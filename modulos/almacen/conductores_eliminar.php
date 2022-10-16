<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/conductores.php');
$objConductores = new Conductores();
$conductores = $objConductores->delete($_GET['id']);
?>