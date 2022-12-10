<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
require('class/guias.php');
require('class/guias_detalles.php');
require('class/ordenes.php');
require('class/comprobantes.php');

$objComprobantes = new Comprobantes();
$comprobante = $objComprobantes->comprobantePorId($_POST['idcomprobantes']);


//Creamos la guia.
$numero = str_pad($_POST['numero_guia'], 8, "0", STR_PAD_LEFT);
$guia = $_POST['serie_guia']."-".$numero;
//echo $guia;
//Guardamos los datos de Guia, idcomprobante y estado "3"
$objGuia = new Guias();
$objGuia->addGF(
	$_POST['fecha_emision'],
	$_POST['fecha_traslado'],
	$_POST['serie_guia'],
	$_POST['numero_guia'],
	$guia,
	$_POST['motivo_traslado'],
	$_POST['identidades'],
	$_POST['iddirecciones'],
	$_POST['idtransportistas'],
	$_POST['idvehiculos'],
	$_POST['idconductores'],
	$_POST['tipo_documento'],
	$_POST['numero_documento'],
	$comprobante[0]['fecha_de_emision'],
	$comprobante[0]['numero_orden_de_compra'],
	$comprobante[0]['informacion_adicional'],
	$_POST['observacion'],
	'',
	$_POST['idcomprobantes']);

//Actualizamos ordenes_detalles_guia_factura con idguia buscado en guias con idcomprobantes
$idguia = $objGuia->guiaPorIdF($_POST['idcomprobantes']);
/*
echo "<pre>";
print_r($idguia);
echo "</pre>";
*/
$idguias = $idguia[0]['idguias'];

$amarre = $objGuia->amarreGC($idguias,$_POST['idcomprobantes']);

//Actualizamos pendientes de entrega en ordenes_detalles
//Actualizamos estado de la Orden
$objGd = new Guias_detalles();
$detalles = $objGd->guia_detallePorIdGuia($idguias);

$objOrden = new Ordenes();

foreach ($detalles as $key) {
	$objGd->update_cantidad_estado($key['cantidad_pedido']-$key['cantidad_entregada'],$key['idordenes_detalles']);
	$objOrden->cambiarOrdenCerrada($key['idordenes']);
}

header('Location: ' . "../../index.php?module=almacen&page=guias");

/*
echo "<pre>";
print_r($detalles);
echo "</pre>";
*/
?>