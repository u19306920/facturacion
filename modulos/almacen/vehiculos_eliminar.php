<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/vehiculos.php');
$objVehiculos = new Vehiculos();
$vehiculos = $objVehiculos->delete($_GET['id']);
?>