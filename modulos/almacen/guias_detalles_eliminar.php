<?php
session_start();
if ($_SESSION['sesion']!=1) {
  header('Location: ../../login.php');
}
	unset($_SESSION['carrito'][$_REQUEST['pos']]);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	//print_r($_SESSION['carrito']);
?>