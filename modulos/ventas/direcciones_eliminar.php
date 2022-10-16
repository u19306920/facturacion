<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/direcciones.php');
$objDirecciones = new Direcciones();
$direccion = $objDirecciones->delete($_GET['id']);
?>