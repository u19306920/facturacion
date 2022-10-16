<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/clientes.php');
require('class/direcciones.php');
//print_r($_POST);

$Bubigeos = new Entidades3();
$Bubigeo = $Bubigeos->ubigeo($_POST['ubigeo']);

$direccion.=$_POST['direccion']." - ".$Bubigeo[0]['departamento']." - ".$Bubigeo[0]['provincia']." - ".$Bubigeo[0]['distrito'];

$objDirecciones = new Direcciones();
$direccion = $objDirecciones->add($direccion,$_POST['ubigeo'],$_POST['estado'],$_POST['identidades']);
?>