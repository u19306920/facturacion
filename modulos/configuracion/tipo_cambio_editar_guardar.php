<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/tipo_cambio.php');
//print_r($_POST);
$objTipoCambio = new Tipos_cambios();
$tipo_cambio = $objTipoCambio->update($_POST['compra'],$_POST['venta'],$_POST['idtipo_cambio']);

?>