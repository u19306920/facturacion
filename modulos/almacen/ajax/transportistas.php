<?php
session_start();
if ($_SESSION['sesion']==1) {
	require('../class/transportistas.php');
	$objTransportistas = new Transportistas();
	$transportista = $objTransportistas->transportesajax();
}
?>