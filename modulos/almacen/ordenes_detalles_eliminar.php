<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/ordenes_detalles.php');
require('class/items.php');
/*
echo "<pre>";

print_r($_POST);
*/
$objDetalle = new Ordenes_detalles();
$detalle1 = $objDetalle->ordenes_detallePorId($_GET['id']);

$borrar = $objDetalle->delete($_GET['id']);

//print_r($detalle1);

$objItem = new Items();
$eliminar = $objItem->delete($detalle1[0]['iditems']);
/*
echo "</pre>";
*/
?>