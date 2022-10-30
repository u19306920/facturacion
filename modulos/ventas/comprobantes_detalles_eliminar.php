<?php
require('class/comprobantes_detalles2.php');
$objComprobantesDetalles = new Comprobantes_detalles();
$objComprobantesDetalles->delete($_GET['id']);

//print_r($_POST);
?>