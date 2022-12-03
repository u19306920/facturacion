<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
if (isset($_POST['exportacion'])) {
  $expo=1;
}
else{
  $expo=0;
}
$estado=1;

require('class/comprobantes_series.php');
print_r($_POST);
$objSeries = new Comprobantes_series();
$Series = $objSeries->add($_POST['tipo'],$_POST['serie'],$_POST['correlativo'],$expo,$estado);

?>