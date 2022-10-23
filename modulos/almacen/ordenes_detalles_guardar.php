<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require("class/reconexion.php");
print_r($_POST);

$sql = "INSERT INTO items values (null, null,'".$_POST['codigo']."' , '".$_POST['descripcion']."','".$_POST['um']."', '1', '1', now());";

$res = $mysqli->query($sql);

if (!$res) {
   printf("Errormessage: %s\n", $mysqli->error);
}

$_POST['iditems'] =  $mysqli->insert_id;

require('class/ordenes_detalles.php');
$objDetalle = new Ordenes_detalles();
$detalle = $objDetalle->add();
?>