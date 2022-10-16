<?php
session_start();
if ($_SESSION['sesion']==1) {
	require('../class/clientes.php');
	$objClientes = new Entidades();
	$cliente = $objClientes->entidadesajax();
}

?>