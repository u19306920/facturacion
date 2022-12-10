<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/comprobantes_series.php');
//print_r($_POST);
$objCorrelativos = new Comprobantes_series();
$correlativo = $objCorrelativos->update2($_POST['numero_actual'],$_POST['estado'],$_POST['idc']);

?>