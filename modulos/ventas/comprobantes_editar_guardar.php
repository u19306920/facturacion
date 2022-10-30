<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
//print_r($_POST);
require("class/comprobantes.php");
require("class/tipo_cambio.php");

//buscamos tipo de cambio
$tcs = new tipo_cambio();
$tc = $tcs->tipo_cambioPorFecha($_POST['fecha_emision']);

$idtipo_cambio = $tc[0]['idtipo_cambio'];

//echo "<pre>".$idtipo_cambio."</pre>";

$hora = date('h:i:s', time());
$dia = date('Y-m-d h:i:s', time());
/*
echo $hora."<br>";
echo $dia."<br>";
*/

//buscamos comprobante por id y estado
$comprobantes = new Comprobantes();
$estado = $comprobantes->comprobantePorId($_POST['idcomprobantes']);

//print_r($estado);

if ($estado[0]['estado']=='00') {
  echo "Editamos";
}
else{
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
//editamos datos bases
$editar = $comprobantes->actualizar($_POST['identidades'],$_POST['fecha_emision'],$hora,$_POST['tipo_operacion'],$idtipo_cambio,$_POST['idcomprobantes']);
?>