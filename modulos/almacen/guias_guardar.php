<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/guias.php');
//print_r($_POST);

//creamos la OT
$numero = str_pad($_POST['numero_guia'], 8, "0", STR_PAD_LEFT);
$nguia = $_POST['serie_guia']."-".$numero;

//creamos el numero documento
$numero_documento = $_POST['serie_documento']."-".str_pad($_POST['numero_documento'], 8, "0", STR_PAD_LEFT);

//echo $nguia;
$ocs="";
$ots="";
$extras="";
$idcomprobantes="0";

$objGuias = new Guias();
$guia = $objGuias->add(
  $_POST['fecha_emision'], 
  $_POST['fecha_traslado'], 
  $_POST['serie_guia'], 
  $_POST['numero_guia'], 
  $nguia, 
  $_POST['motivo_traslado'], 
  $_POST['identidades'], 
  $_POST['iddirecciones'], 
  $_POST['idtransportistas'], 
  $_POST['idvehiculos'], 
  $_POST['idconductores'], 
  $_POST['tipo_documento'], 
  $numero_documento,
  $_POST['fecha_documento'], 
  $ocs, 
  $ots, 
  $_POST['observacion'], 
  $extras, 
  $idcomprobantes);
?>