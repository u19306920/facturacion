<?php
session_start();
if ($_SESSION['sesion']==1) {
	require('../class/items.php');
	$objCategoria = new Items();
	$categorias = $objCategoria->categoriasajax();
}
?>