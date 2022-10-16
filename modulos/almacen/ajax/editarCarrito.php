<?php 
session_start();
if ($_SESSION['sesion']==1) {
	//print_r($_POST);
	//if ($_POST['cantidad']>=$_POST['minimo'] and $_POST['cantidad']<=$_POST['maximo']) {
		$_SESSION['carrito'][$_POST['posicion']]=array('iddetalles'=>$_POST['idordenes_detalles'],'idguias'=>$_POST['idguias'],'cantidad'=>$_POST['cantidad'],'posicion'=>$_POST['posicion']);
	//}
}	
?>