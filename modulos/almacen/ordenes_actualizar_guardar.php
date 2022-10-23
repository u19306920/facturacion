<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/ordenes.php');
//print_r($_POST);
$objOrdenes = new Ordenes();
$orden = $objOrdenes->update();
header('Location: ../../index.php?module=almacen&page=ordenes');
?>