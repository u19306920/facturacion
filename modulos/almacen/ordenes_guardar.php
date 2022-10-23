<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/ordenes.php');
//print_r($_POST);
$anio = date("Y");
$objBuscar = new Ordenes();
$buscar = $objBuscar->ordenPorTipoOrden($_POST['idordenes_tipos'],$anio);
$num=0;
if($buscar > 0){
	foreach ($buscar as $orden) {
		$num=$num+1;
	}
	$_POST['correlativo']=$buscar[$num-1]['correlativo']+1;
}
else{
	$_POST['correlativo']=$num+1;
}

$objTipoOrdenes = new Ordenes();
$TipoOrdenes = $objTipoOrdenes->orden_tipoPorId($_POST['idordenes_tipos']);
//print_r($TipoOrdenes);

//creamos la OT
$n = str_pad($_POST['correlativo'], 6, "0", STR_PAD_LEFT);
$orden = $TipoOrdenes[0]['orden_serie']."-".$anio."-".$n;

//echo $orden;

$objOrdenes = new Ordenes();
$orden = $objOrdenes->add($_POST['fecha_emision'], $_POST['fecha_entrega'], $_POST['idordenes_tipos'], $_POST['correlativo'], $anio, $orden, $_POST['identidades'], $_POST['cotizacion'], $_POST['orden_compra'], $_POST['vendedor'],str_pad($_POST['formapago'], 2, "0", STR_PAD_LEFT),$_POST['moneda'], '0', $_POST['exportacion'],'0','0');
?>