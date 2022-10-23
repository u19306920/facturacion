<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/ordenes.php');
//print_r($_GET);
$objOrdenes = new Ordenes();
$orden = $objOrdenes->cambiar($_GET['e'],$_GET['id'],$_GET['id']);
?>