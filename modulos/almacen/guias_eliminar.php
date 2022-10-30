<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}

require('class/guias.php');
//recogemos el id de la guia
$objGuias = new Guias();
$guias = $objGuias->guiaPorId($_GET['id']);
//preguntamos si tiene estado 4
if ($guias[0]['estado'] == 4 or $guias[0]['estado'] == 0) {
	//procedemos con la eliminacion si tiene estado 4
	$eliminar = $objGuias->delete($_GET['id']);

}
else{
	//caso contrario volvemos
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>