<?php
session_start();
if ($_SESSION['sesion']==1) {
	require('../class/items.php');
	$objItems = new Items();
	$item = $objItems->itemsajax();
}
?>