<?php 
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
require('class/guias_detalles.php');
require('class/guias.php');
$objGuiasDetalle = new Guias_detalles();
$objGuiasDetalle2 = new Guias_detalles();

foreach ($_SESSION["carrito"] as $key) {
	$objGuiasDetalle->add($key["iddetalles"],$key["idguias"],$key["cantidad"]);
	if ($_GET['modificar']==0) {
		$objGuiasDetalle2->update_cantidad_estado($key["cantidad"],$key["iddetalles"]);
	}
	else{
		$objGuiasDetalle2->update_cantidad($key["cantidad"],$key["iddetalles"]);
	}
}


$ocs = explode("|",$_SESSION['ocs']);
$ocs = array_unique($ocs);
$nocs = "";
foreach($ocs as $oc){
 $nocs.=$oc." | ";
}
$nocs = substr($nocs,0,-6);

$ots = explode("|",$_SESSION['ots']);
$ots = array_unique($ots);
$nots="";
foreach($ots as $ot){
 $nots.=$ot." | ";
}
$nots = substr($nots,0,-6);


$objGuia = new Guias();
$objGuia->update_ocs_ots($nocs,$nots,$_SESSION['idguias']);
$objGuia->cambiar('1',$_SESSION['idguias']);
/*
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
*/
unset($_SESSION['carrito']);
unset($_SESSION['ocs']);
unset($_SESSION['ots']);
unset($_SESSION['idguias']);


require($_SERVER['DOCUMENT_ROOT'].'/config/reconexion.php');
$inicio ="SET sql_mode = '';";
$consulta= "UPDATE ordenes o
	JOIN (
		SELECT 
		(COUNT(ordenes_detalles.estado) - SUM(ordenes_detalles.estado)) AS valor,
		ordenes.idordenes AS id,
		(ordenes_detalles.cantidad_entregada - ordenes_detalles_guia_factura.cantidad) AS pendiente
		FROM ordenes
		INNER JOIN ordenes_detalles ON ordenes.idordenes = ordenes_detalles.idordenes
		INNER JOIN ordenes_detalles_guia_factura ON ordenes_detalles.idordenes_detalles = ordenes_detalles_guia_factura.idordenes_detalles
		WHERE ordenes.estado = 2
		GROUP BY ordenes_detalles.idordenes
	) AS v
	ON v.valor = 0
SET o.estado = 3
WHERE o.idordenes = v.id and o.estado=2";
$mysqli1->query($inicio);
$mysqli1->query($consulta);
echo $mysqli1->error;

header('Location: ../../index.php?module=almacen&page=guias');

?>