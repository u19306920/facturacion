<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/vehiculos.php');
//print_r($_POST);
$objVehiculos = new Vehiculos();
$vehiculo = $objVehiculos->add($_POST['marca'],$_POST['placa'],$_POST['inscripcion'],$_POST['estado'],$_POST['idtransportistas']);
?>