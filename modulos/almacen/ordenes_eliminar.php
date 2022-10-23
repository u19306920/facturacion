<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/ordenes.php');
$objOrden = new Ordenes();
$orden = $objOrden->delete($_GET['id']);
?>