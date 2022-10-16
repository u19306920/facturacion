<?php
session_start();
if ($_SESSION['sesion']==1) {
	require('../class/clientes.php');
	$objUbigeos = new Entidades3();
	$ubigeo = $objUbigeos->ubigeoajax();
}
?>