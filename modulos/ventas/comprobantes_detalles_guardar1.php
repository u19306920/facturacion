<?php
require('class/comprobantes.php');
require('class/ordenes.php');
//Calculamos la fecha de vencimiento
//jalamos los dias de la forma de pago para crear fecha de vencimiento
$objfp = new Ordenes();
$metodo = $objfp->metodos_de_pagoPorId($_POST['formapago']);

if ($metodo[0]['dias']) {
	$dias = "+ ".$metodo[0]['dias']." days";

	$fecha = DateTime::createFromFormat('d-M-Y', $_POST['fecha_emision']);
	//sumo 1 día
	$fecha = date("Y-m-d",strtotime($fecha.$dias)); 
	
}
else{
	$dias = "0 days";
	$fecha = $_POST['fecha_emision'];
	
}
//mostramos fecha de vencimiento
$fecha_vencimiento = $fecha;
//echo $fecha_vencimiento;
//Agregamos los datos
$objComprobante = new Comprobantes();
$comprobante = $objComprobante->comprobanteEncabezado($fecha_vencimiento,$_POST['moneda'],$_POST['ocs'],$_POST['condicion_de_pago'],$_POST['anticipo'],$_POST['formapago'],$_POST['ots'],$_POST['idcomprobantes']);

//print_r($_POST);

?>