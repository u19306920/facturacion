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

$hora = date('h:i:s', time());
$dia = date('Y-m-d h:i:s', time());
//echo $hora."<br>";
//echo $dia."<br>";

//buscamos serie y correlativo e incrementamos en 1
$comprobantes = new Comprobantes();
$correlativo = $comprobantes->comprobanteCorrelativo($_POST['serie_documento']);
$correlativo = $correlativo[0]['numero_actual'];
$aumcorrelativo = $comprobantes->comprobanteAumCorrelativo($correlativo+1,$_POST['serie_documento']);


$documento = $_POST['serie_documento']."-".str_pad($correlativo,8,0,STR_PAD_LEFT);

//registramos datos bases
$agregar = $comprobantes->add($_POST['serie_documento'],$correlativo,$documento,$_POST['fecha_emision'],$hora,$_POST['tipo_operacion'],$_POST['tipo_documento'],$idtipo_cambio,$_POST['identidades']);
?>