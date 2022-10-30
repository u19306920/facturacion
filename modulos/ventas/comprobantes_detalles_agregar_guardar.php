<?php
require('class/comprobantes_detalles2.php');
$objComprobantesDetalles = new Comprobantes_detalles();
$objComprobantesDetalles->add($_POST['descripcion'],$_POST['cantidad'],$_POST['um'],$_POST['valor_unitario'],$_POST['idcomprobantes']);

//print_r($_POST);
?>