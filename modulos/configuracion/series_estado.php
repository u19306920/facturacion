<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/comprobantes_series.php');
//print_r($_GET);
$objComprobantes = new Comprobantes_series();
$Comprobantes_series = $objComprobantes->cambiar_estado($_GET['e'],$_GET['id']);
?>