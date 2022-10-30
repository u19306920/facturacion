<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
//print_r($_REQUEST);
//Cambiamos el estado a la guia
require('class/guias.php');
require('class/guias_detalles.php');
require('class/ordenes.php');
require('class/ordenes_detalles.php');

//buscamos el detalle de la guia
$objDetalleGuia = new Guias_detalles();
$detalle = $objDetalleGuia->guia_detallePorIdGuia($_GET['id']);

//creamos objeto para detalle de orden
$objDetalleOrden = new Ordenes_detalles();

//creamos objeto para orden
$objOrden = new Ordenes();

foreach ($detalle as $key) {
	//restamos el detalle de guia a detalle entregado de la orden.
	$item = $objDetalleGuia->anular_cantidad_estado($key['cantidad'],$key['idordenes_detalles']);
	//Cambiar estado de Orden.
	$orden = $objDetalleOrden->ordenes_detallePorId($key['idordenes_detalles']);
	$objOrden->cambiar_estado('2',$orden[0]['idordenes']);
}

$objAnular = new Guias();
$anular = $objAnular->cambiar2('4',$_GET['id']);

?>