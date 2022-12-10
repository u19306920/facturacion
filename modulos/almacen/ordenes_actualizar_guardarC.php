<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/ordenes.php');
//print_r($_POST);

$number = $_POST['correlativo'];
$length = 6;
$string = substr(str_repeat(0, $length).$number, - $length);

$orden = $_POST['serie']."-".$string;

//echo $orden;

$objOrdenes = new Ordenes();
$orden = $objOrdenes->update_correlativo($_POST['correlativo'],$orden,$_POST['idordenes']);
header('Location: ../../index.php?module=almacen&page=ordenes');
?>